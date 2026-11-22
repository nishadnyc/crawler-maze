#!/usr/bin/env python3
"""Counts-only stats refresh for README.md and docs/index.html.

WHAT THIS SCRIPT DOES (Nishad's standing rule, issue #29):
    It recomputes the maze-log counts for the section's day and updates
    NUMERIC fields only:

      * the headline totals line in README.md (hits / unique IPs /
        subnet log files / banned hits) and the four totals tiles in
        docs/index.html;
      * for crawler rows that ALREADY exist in the README table, the
        Requests / Banned hits / IPs numbers — and the matching per-bot
        count figures in the docs/index.html panel.

WHAT IT NEVER DOES:
    * It never adds, removes, or reorders table rows.
    * It never edits the "What it was after" story column, the Patterns
      paragraph, the "looking for" line, the honeypot line, or any other
      narrative text. Stories are written by AI agents, manually.
    * It never restructures the stats section. It locates the existing
      rows and replaces only the numeric cell contents; if the expected
      structure is not found (markers, headline format, row names,
      panel tiles), it exits non-zero and writes NOTHING.
    * A crawler present in the logs with no existing row is reported
      as a notice on stdout and left alone — agents add rows manually.

COUNTING METHOD (issue #23 / PR #24 — must not drift):
    Scope is the log files for the section's day (the most recent date
    in the log filenames; the script refuses to run if that differs
    from the day named in the README section's subtitle).
    Requests / Banned hits come from the per-file `groups` cumulative
    counters (banned hits are counted separately by the logger and
    never enter Requests). Distinct IPs are the size of the union of
    each group's `ip_hashes` set (md5(ip) 10-hex prefixes, capped at
    200 per group by the logger) and the md5 prefixes of that group's
    `ips`-bucket IPs — the bucket alone understates because the logger
    prunes it to roughly the last 2 hours of activity (see index.php).

    Classification is by the groups' user agents. Known operator IP
    ranges (KNOWN_RANGES) are used as a cross-check for the curated
    operator reference notes in the IPs cells: if a note cites a range
    that no longer matches the row's dominant bucket range, the script
    prints a warning for an agent to review — it does not rewrite the
    note itself.

HISTORY: the original version of this script regenerated the entire
stats section from a fixed category list, which silently wiped
manually curated rows (issue #21). It was disabled, then stubbed
(issue #27), and this counts-only rewrite replaces it (issue #29).
The original remains available in git history.

Run locally:  python3 scripts/refresh_stats.py
"""

import glob
import hashlib
import json
import os
import re
import sys
from datetime import datetime

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
LOGS = os.path.join(ROOT, "logs")
PAGE = os.path.join(ROOT, "docs", "index.html")
README = os.path.join(ROOT, "README.md")

PROBES = (".env", "firebase", "wp-login", "phpinfo", ".git",
          "config.json", "aws", "secret")

# Known operator /16 prefixes, used ONLY as a cross-check for the
# curated reference notes in the IPs cells (never to rewrite them).
KNOWN_PREFIX16 = {
    "claude": {"216.73", "160.79"},        # Anthropic
    "claudeuser": {"216.73", "160.79"},    # Anthropic
    "gpt": {"20.161", "52.230", "52.231", "68.220", "72.255", "74.7",
            "103.196", "132.196", "172.183", "192.100", "195.250"},
    "oai": {"74.7", "51.8"},               # OpenAI search
    "fb": {"57.141", "69.171", "173.252"},          # Meta
    "metawebindexer": {"57.141", "69.171", "173.252"},  # Meta
}

# README display name -> aggregation key. The script expects exactly
# these rows; an unknown row name in the table is a hard failure.
ROW_KEYS = {
    "ClaudeBot": "claude",
    "GPTBot": "gpt",
    "OAI-SearchBot": "oai",
    "facebookexternalhit": "fb",
    "Fake old-Chrome scanner fleet": "fleet",
    "Credential hunters": "hunters",
    "API hammerer (fake Chrome 147)": "api147",
    "XML Sitemaps Generator": "xmlsitemaps",
    "meta-webindexer": "metawebindexer",
    "Claude-User": "claudeuser",
}

# Tokens that mark a user agent as a named bot / tool worth a notice
# when it has no row of its own.
BOT_TOKENS = ("bot", "crawler", "spider", "indexer", "hookshot", "curl",
              "urllib", "http-client", "python", "go-http", "validator",
              "monitor", "preview", "fetcher", "search", "scanner")


def classify(ua):
    """Map a group user agent to a table-row key, or None."""
    if "ClaudeBot" in ua:
        return "claude"
    if "Claude-User" in ua:
        return "claudeuser"
    if "GPTBot" in ua:
        return "gpt"
    if "OAI-SearchBot" in ua:
        return "oai"
    if "facebookexternalhit" in ua:
        return "fb"
    if "meta-webindexer" in ua:
        return "metawebindexer"
    if "XML Sitemaps Generator" in ua:
        return "xmlsitemaps"
    if "Chrome/147" in ua:
        return "api147"
    if "Chrome/49" in ua and "Windows NT 6.1" in ua:
        return "fleet"
    return None


def is_probe(group):
    """Credential-hunter overlay: independent of the UA classification,
    exactly as the pre-#24 counts treated it."""
    if any(p in (group.get("last_path") or "") for p in PROBES):
        return True
    return any(any(p in s for p in PROBES)
               for s in (group.get("sections") or {}))


def fmt(n):
    return f"{n:,}"


def ip_hash(ip):
    return hashlib.md5(ip.encode()).hexdigest()[:10]


def fail(msg):
    print(f"refresh_stats: ERROR: {msg}", file=sys.stderr)
    print("refresh_stats: nothing was written.", file=sys.stderr)
    return 1


def aggregate(day_files):
    """Aggregate the day's logs under the issue-#23 counting method."""
    totals = {"hits": 0, "banned": 0, "files": len(day_files)}
    all_hashes = set()
    rows = {k: {"hits": 0, "banned": 0, "hashes": set(), "bucket_ips": {}}
            for k in set(ROW_KEYS.values())}
    unroled = {}  # ua -> hits, for groups with no row classification

    for path in day_files:
        try:
            data = json.load(open(path))
        except Exception:
            continue
        groups = data.get("groups") or {}
        bucket = data.get("ips") or {}
        bucket_by_group = {}
        for ip, rec in bucket.items():
            bucket_by_group.setdefault(rec.get("agent"), set()).add(ip)
            all_hashes.add(ip_hash(ip))
        for gkey, g in groups.items():
            t = g.get("total", 0)
            b = g.get("banned_hits", 0)
            totals["hits"] += t
            totals["banned"] += b
            ih = g.get("ip_hashes") or {}
            hashes = set(ih.keys() if isinstance(ih, dict) else ih)
            bucket_ips = bucket_by_group.get(gkey, set())
            hashes |= {ip_hash(ip) for ip in bucket_ips}
            all_hashes |= hashes

            keys = []
            kind = classify(g.get("user_agent") or "")
            if kind:
                keys.append(kind)
            else:
                ua = g.get("user_agent") or ""
                unroled[ua] = unroled.get(ua, 0) + t
            if is_probe(g):
                keys.append("hunters")
            for k in keys:
                r = rows[k]
                r["hits"] += t
                r["banned"] += b
                r["hashes"] |= hashes
                for ip in bucket_ips:
                    r["bucket_ips"][ip] = r["bucket_ips"].get(ip, 0) + 1

    totals["ips"] = len(all_hashes)
    for r in rows.values():
        r["ips"] = len(r["hashes"])
    return totals, rows, unroled


def split_stats_block(text):
    """Return (prefix, block, suffix) around the STATS markers."""
    m = re.search(r"<!-- STATS:START -->\n(.*?)\n<!-- STATS:END -->",
                  text, flags=re.S)
    if not m:
        return None
    return text[:m.start(1)], m.group(1), text[m.end(1):]


HEADLINE_RE = re.compile(
    r"^\*\*([\d,]+)\*\* crawler hits served · \*\*([\d,]+)\*\* unique IPs · "
    r"\*\*([\d,]+)\*\* subnet log files · \*\*([\d,]+)\*\* banned hits$",
    flags=re.M)

SUBTITLE_DAY_RE = re.compile(
    r"\*What the logs say · [A-Za-z]+, ([A-Za-z]+) (\d{1,2}), (\d{4}) ·")


def update_readme(text, totals, rows, changes, warnings):
    """Return the new README text with ONLY numbers replaced, or None
    on a structure failure (the caller must then write nothing)."""
    parts = split_stats_block(text)
    if parts is None:
        print("refresh_stats: ERROR: STATS markers not found in README.md",
              file=sys.stderr)
        return None
    prefix, block, suffix = parts

    # Headline totals line.
    m = HEADLINE_RE.search(block)
    if not m:
        print("refresh_stats: ERROR: headline totals line not in the "
              "expected format in README.md", file=sys.stderr)
        return None
    old = [int(x.replace(",", "")) for x in m.groups()]
    new = [totals["hits"], totals["ips"], totals["files"],
           totals["banned"]]
    labels = ["headline hits", "headline unique IPs",
              "headline subnet log files", "headline banned hits"]
    for lab, o, n in zip(labels, old, new):
        if o != n:
            changes.append(f"README {lab}: {fmt(o)} -> {fmt(n)}")
    block = HEADLINE_RE.sub(
        f"**{fmt(new[0])}** crawler hits served · **{fmt(new[1])}** "
        f"unique IPs · **{fmt(new[2])}** subnet log files · "
        f"**{fmt(new[3])}** banned hits", block, count=1)

    # Table rows: replace only the numeric cells of existing rows.
    lines = block.split("\n")
    seen_keys = set()
    for i, line in enumerate(lines):
        if not line.startswith("| "):
            continue
        cells = line.split("|")
        if len(cells) != 7:
            print(f"refresh_stats: ERROR: table row does not have the "
                  f"expected 5 columns: {line[:80]}", file=sys.stderr)
            return None
        name = cells[1].strip()
        if name == "Crawler" or set(cells[2].strip()) <= set("-: "):
            continue  # header / separator
        if name not in ROW_KEYS:
            print(f"refresh_stats: ERROR: unknown table row {name!r} — "
                  "the table structure changed; an agent must review it",
                  file=sys.stderr)
            return None
        key = ROW_KEYS[name]
        seen_keys.add(key)
        r = rows[key]
        old_req, old_ban = cells[2].strip(), cells[3].strip()
        if fmt(r["hits"]) != old_req:
            changes.append(f"README row {name!r} Requests: "
                           f"{old_req} -> {fmt(r['hits'])}")
        if fmt(r["banned"]) != old_ban:
            changes.append(f"README row {name!r} Banned hits: "
                           f"{old_ban} -> {fmt(r['banned'])}")
        ips_cell = cells[4].strip()
        im = re.match(r"^([\d,]+)(.*)$", ips_cell, flags=re.S)
        if not im:
            print(f"refresh_stats: ERROR: IPs cell for row {name!r} "
                  "does not start with a number", file=sys.stderr)
            return None
        if im.group(1) != fmt(r["ips"]):
            changes.append(f"README row {name!r} IPs: "
                           f"{im.group(1)} -> {fmt(r['ips'])}")
        note = im.group(2)
        if re.search(r"all from `[\d.]+`", note) and r["ips"] != 1:
            # 'all from' a single bare address (a range note like
            # 'all from `57.141.0.0/16`' is fine at any count).
            warnings.append(
                f"row {name!r}: IPs note says 'all from' one address "
                f"but the distinct-IP count is now {fmt(r['ips'])} — an "
                "agent should review the note (the script does not "
                "edit notes)")
        new_ips_cell = fmt(r["ips"]) + note
        lines[i] = (f"| {name} | {fmt(r['hits'])} | {fmt(r['banned'])} | "
                    f"{new_ips_cell} | {cells[5].strip()} |")

    # Every classified crawler with activity must have its row.
    for key, r in rows.items():
        if (r["hits"] or r["banned"]) and key not in seen_keys:
            print(f"refresh_stats: ERROR: crawler {key!r} has log "
                  "activity but no row in the README table — an agent "
                  "must add the row (with its story) manually",
                  file=sys.stderr)
            return None
    block = "\n".join(lines)
    return prefix + block + suffix


def update_page(text, totals, rows, changes):
    """Return the new docs/index.html text with ONLY the totals tiles
    and per-bot count figures replaced, or None on structure failure.
    Detail prose, chips and all other text are narrative: untouched."""
    if "<!-- STATS:START -->" not in text or \
            "<!-- STATS:END -->" not in text:
        print("refresh_stats: ERROR: STATS markers not found in "
              "docs/index.html", file=sys.stderr)
        return None
    tiles = [("crawler hits served", totals["hits"]),
             ("unique IPs", totals["ips"]),
             ("subnet log files", totals["files"]),
             ("banned hits", totals["banned"])]
    for label, value in tiles:
        pat = re.compile(r'(<div class="stat"><b>)([\d,]+)(</b><span>'
                         + re.escape(label) + r"</span></div>)")
        m = pat.search(text)
        if not m:
            print(f"refresh_stats: ERROR: totals tile {label!r} not "
                  "found in docs/index.html", file=sys.stderr)
            return None
        if m.group(2) != fmt(value):
            changes.append(f"Pages tile {label!r}: "
                           f"{m.group(2)} -> {fmt(value)}")
        text = pat.sub(lambda mm: mm.group(1) + fmt(value) + mm.group(3),
                       text, count=1)
    for name, key in ROW_KEYS.items():
        r = rows[key]
        pat = re.compile(
            r'(<span class="name">' + re.escape(name) +
            r'</span> — <span class="count">)([\d,]+) '
            r"(requests|hits|banned hits)(</span>)")
        m = pat.search(text)
        if not m:
            print(f"refresh_stats: ERROR: panel entry for {name!r} not "
                  "found in docs/index.html", file=sys.stderr)
            return None
        value = r["banned"] if m.group(3) == "banned hits" \
            else r["hits"]
        if m.group(2) != fmt(value):
            changes.append(f"Pages count {name!r}: "
                           f"{m.group(2)} -> {fmt(value)}")
        text = pat.sub(lambda mm: mm.group(1) + fmt(value) + " " +
                       mm.group(3) + mm.group(4), text, count=1)
    return text


def main():
    files = sorted(glob.glob(os.path.join(LOGS, "*_*.json")))
    dated = []
    for f in files:
        m = re.search(r"(\d{4}-\d{2}-\d{2})\.json$", f)
        if m:
            dated.append((m.group(1), f))
    if not dated:
        return fail("no dated log files found in logs/")
    day = max(d for d, _ in dated)
    day_files = [f for d, f in dated if d == day]

    readme = open(README).read()
    sm = SUBTITLE_DAY_RE.search(readme)
    if not sm:
        return fail("could not find the section day in the README "
                    "subtitle")
    section_day = datetime.strptime(
        f"{sm.group(1)} {sm.group(2)} {sm.group(3)}",
        "%B %d %Y").strftime("%Y-%m-%d")
    if section_day != day:
        return fail(f"the README section describes {section_day} but "
                    f"the newest logs are for {day} — an agent must "
                    "roll the section to the new day (the script never "
                    "edits the section's narrative)")

    totals, rows, unroled = aggregate(day_files)

    changes, warnings = [], []
    new_readme = update_readme(readme, totals, rows, changes, warnings)
    if new_readme is None:
        print("refresh_stats: nothing was written.", file=sys.stderr)
        return 1
    page = open(PAGE).read()
    new_page = update_page(page, totals, rows, changes)
    if new_page is None:
        print("refresh_stats: nothing was written.", file=sys.stderr)
        return 1

    # Cross-check the rows' dominant bucket /16 against the known
    # operator prefixes; warn (never rewrite) on a mismatch.
    for name, key in ROW_KEYS.items():
        known = KNOWN_PREFIX16.get(key)
        if not known:
            continue
        prefixes = {}
        for ip in rows[key]["bucket_ips"]:
            p = ".".join(ip.split(".")[:2])
            prefixes[p] = prefixes.get(p, 0) + 1
        if prefixes:
            dominant = max(prefixes, key=prefixes.get)
            if dominant not in known:
                warnings.append(
                    f"row {name!r}: dominant bucket range is now "
                    f"{dominant}.0.0/16, outside the known operator "
                    "prefixes — an agent should review its IPs "
                    "reference note")

    for w in warnings:
        print(f"refresh_stats: WARNING: {w}")
    for ua, hits in sorted(unroled.items(), key=lambda kv: -kv[1]):
        low = ua.lower()
        if hits >= 5 and any(tok in low for tok in BOT_TOKENS):
            print(f"refresh_stats: NOTICE: crawler with no table row: "
                  f"{hits} hits from {ua[:100]!r} — left unchanged; "
                  "an agent can add a row (with its story) manually")

    wrote = []
    if new_readme != readme:
        open(README, "w").write(new_readme)
        wrote.append("README.md")
    if new_page != page:
        open(PAGE, "w").write(new_page)
        wrote.append("docs/index.html")
    for c in changes:
        print(f"refresh_stats: updated {c}")
    if wrote:
        print(f"refresh_stats: {day}: {fmt(totals['hits'])} hits, "
              f"{fmt(totals['banned'])} banned, {totals['files']} "
              f"files — updated numbers in {', '.join(wrote)}.")
    else:
        print(f"refresh_stats: {day}: numbers already up to date "
              f"({fmt(totals['hits'])} hits, {fmt(totals['banned'])} "
              "banned) — no files changed.")
    return 0


if __name__ == "__main__":
    sys.exit(main())
