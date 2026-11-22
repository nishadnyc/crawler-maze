#!/usr/bin/env python3
"""Regenerate the stats panel in docs/index.html from the maze logs in logs/.

Counts the most recent day present in the log filenames
(<subnet>_16_<YYYY-MM-DD>.json) and rewrites everything between the
<!-- STATS:START --> and <!-- STATS:END --> markers, plus the panel's
heading/subtitle. Run by the "Refresh page stats" workflow (manual trigger);
can also be run locally:  python3 scripts/refresh_stats.py
"""
import glob
import json
import os
import re
import sys
from datetime import datetime

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
LOGS = os.path.join(ROOT, "logs")
PAGE = os.path.join(ROOT, "docs", "index.html")

CLAUDE_SVG = '<svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true"><defs><path id="cray" d="M12 1.5 L13.4 10.6 L12 12 L10.6 10.6 Z"/></defs><g fill="#D97757"><use href="#cray"/><use href="#cray" transform="rotate(45 12 12)"/><use href="#cray" transform="rotate(90 12 12)"/><use href="#cray" transform="rotate(135 12 12)"/><use href="#cray" transform="rotate(180 12 12)"/><use href="#cray" transform="rotate(225 12 12)"/><use href="#cray" transform="rotate(270 12 12)"/><use href="#cray" transform="rotate(315 12 12)"/><circle cx="12" cy="12" r="1.6"/></g></svg>'
OPENAI_SVG = '<svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true"><g fill="none" stroke="#e6edf3" stroke-width="1.7"><ellipse cx="12" cy="12" rx="4.2" ry="8.6"/><ellipse cx="12" cy="12" rx="4.2" ry="8.6" transform="rotate(60 12 12)"/><ellipse cx="12" cy="12" rx="4.2" ry="8.6" transform="rotate(120 12 12)"/></g></svg>'
FB_SVG = '<svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true"><rect width="24" height="24" rx="5" fill="#1877F2"/><path fill="#fff" d="M13.6 21v-6.9h2.3l.35-2.7h-2.65V9.7c0-.78.22-1.31 1.34-1.31h1.43V5.98c-.25-.03-1.1-.11-2.08-.11-2.06 0-3.47 1.26-3.47 3.57v1.96H8.5v2.7h2.32V21h2.78Z"/></svg>'

PROBES = (".env", "firebase", "wp-login", "phpinfo", ".git", "config.json", "aws", "secret")
SECTION_LABELS = {
    "api": "API docs",
    "developers": "Developer pages",
    "tutorials": "Tutorials",
    "docs": "Docs",
}


def classify(ua):
    if "ClaudeBot" in ua:
        return "claude"
    if "GPTBot" in ua:
        return "gpt"
    if "OAI-SearchBot" in ua:
        return "oai"
    if "facebookexternalhit" in ua:
        return "fb"
    if "Chrome/49" in ua and "Windows NT 6.1" in ua:
        return "fleet"
    return None


def fmt(n):
    return f"{n:,}"


def main():
    files = sorted(glob.glob(os.path.join(LOGS, "*_*.json")))
    dated = []
    for f in files:
        m = re.search(r"(\d{4}-\d{2}-\d{2})\.json$", f)
        if m:
            dated.append((m.group(1), f))
    if not dated:
        print("No dated log files found in logs/", file=sys.stderr)
        return 1
    day = max(d for d, _ in dated)
    day_files = [f for d, f in dated if d == day]

    total = banned = 0
    day_ips = set()
    sections = {}
    bots = {k: {"hits": 0, "banned": 0, "ips": 0, "files": 0} for k in ("claude", "gpt", "oai", "fb", "fleet")}
    claude_ip_counts = {}
    hunters = {"hits": 0, "ips": 0}

    for path in day_files:
        try:
            data = json.load(open(path))
        except Exception:
            continue
        file_ips = set((data.get("ips") or {}).keys())
        day_ips |= file_ips
        groups = data.get("groups") or {}
        file_bots = set()
        for g in groups.values():
            t = g.get("total", 0)
            total += t
            banned += g.get("banned_hits", 0)
            for sec, c in (g.get("sections") or {}).items():
                sections[sec] = sections.get(sec, 0) + c
            ua = g.get("user_agent") or ""
            kind = classify(ua)
            if kind:
                b = bots[kind]
                b["hits"] += t
                b["banned"] += g.get("banned_hits", 0)
                b["ips"] += g.get("unique_ips", 0)
                file_bots.add(kind)
                if kind == "claude":
                    for ip, rec in (data.get("ips") or {}).items():
                        claude_ip_counts[ip] = claude_ip_counts.get(ip, 0) + rec.get("count", 0)
            probe = any(p in (g.get("last_path") or "") for p in PROBES) or \
                any(any(p in s for p in PROBES) for s in (g.get("sections") or {}))
            if probe:
                hunters["hits"] += t
                hunters["ips"] += g.get("unique_ips", 0)
        for kind in file_bots:
            bots[kind]["files"] += 1

    top_sections = sorted(sections.items(), key=lambda kv: -kv[1])[:6]
    chips = "".join(
        f'<span class="chip">{SECTION_LABELS.get(k, k)} <b>{fmt(v)}</b></span>'
        for k, v in top_sections
    )

    rows = ""
    c = bots["claude"]
    if c["hits"]:
        top_ip = max(claude_ip_counts, key=claude_ip_counts.get) if claude_ip_counts else ""
        ip_txt = f' All from a single IP, <code>{top_ip}</code>.' if c["ips"] <= 1 and top_ip else (f' Top IP <code>{top_ip}</code>.' if top_ip else "")
        rows += f'''<div class="bot"><div class="badge">{CLAUDE_SVG}</div><div class="body"><span class="name">ClaudeBot</span> — <span class="count">{fmt(c["hits"])} requests</span><div class="detail">{ip_txt} {fmt(c["banned"])} banned hits.</div></div></div>\n    '''
    g = bots["gpt"]
    if g["hits"] or g["banned"]:
        rows += f'''<div class="bot"><div class="badge">{OPENAI_SVG}</div><div class="body"><span class="name">GPTBot</span> — <span class="count">{fmt(g["banned"])} banned hits</span><div class="detail">Only {fmt(g["hits"])} counted hits got through; the rest bounced off bans. {g["ips"]} IPs.</div></div></div>\n    '''
    o = bots["oai"]
    if o["hits"]:
        rows += f'''<div class="bot"><div class="badge">{OPENAI_SVG}</div><div class="body"><span class="name">OAI-SearchBot</span> — <span class="count">{fmt(o["hits"])} requests</span><div class="detail">Spread across {fmt(o["ips"])} different IPs.</div></div></div>\n    '''
    f = bots["fb"]
    if f["hits"]:
        rows += f'''<div class="bot"><div class="badge" style="background:#1877F2;border-color:#1877F2;">{FB_SVG}</div><div class="body"><span class="name">facebookexternalhit</span> — <span class="count">{fmt(f["hits"])} requests</span><div class="detail">From {fmt(f["ips"])} IPs. The polite one — checks in, takes a look, behaves.</div></div></div>\n    '''
    fl = bots["fleet"]
    if fl["hits"]:
        rows += f'''<div class="bot"><div class="badge">?</div><div class="body"><span class="name">Fake old-Chrome scanner fleet</span> — <span class="count">{fmt(fl["hits"])} hits</span><div class="detail">Dozens of IPs all claiming to be Chrome 49 on Windows 7. {fmt(fl["ips"])} IPs.</div></div></div>\n    '''
    if hunters["hits"]:
        rows += f'''<div class="bot"><div class="badge">⚿</div><div class="body"><span class="name">Credential hunters</span> — <span class="count">{fmt(hunters["hits"])} hits</span><div class="detail">Probing for /.env, firebase keys and similar files that don't exist here.</div></div></div>\n    '''

    panel = f'''<div class="totals">
      <div class="stat"><b>{fmt(total)}</b><span>crawler hits served</span></div>
      <div class="stat"><b>{fmt(len(day_ips))}</b><span>unique IPs</span></div>
      <div class="stat"><b>{fmt(len(day_files))}</b><span>subnet log files</span></div>
      <div class="stat"><b>{fmt(banned)}</b><span>banned hits</span></div>
    </div>

    {rows}<div class="looking">
      <h3>What they were looking for</h3>
      <div class="chips">{chips}</div>
    </div>'''

    html = open(PAGE).read()
    if "<!-- STATS:START -->" not in html or "<!-- STATS:END -->" not in html:
        print("STATS markers not found in docs/index.html", file=sys.stderr)
        return 1
    html = re.sub(
        r"<!-- STATS:START -->.*?<!-- STATS:END -->",
        "<!-- STATS:START -->\n    " + panel + "\n    <!-- STATS:END -->",
        html, flags=re.S,
    )
    pretty = datetime.strptime(day, "%Y-%m-%d").strftime("%A, %B %-d, %Y")
    html = re.sub(r"<h2>One (morning|day) in the maze</h2>", "<h2>One day in the maze</h2>", html)
    html = re.sub(
        r'<p class="sub">.*?</p>',
        f'<p class="sub">What the logs say · {pretty} · counted from the maze\'s own logs</p>',
        html, count=1, flags=re.S,
    )
    open(PAGE, "w").write(html)
    print(f"Refreshed panel for {day}: {fmt(total)} hits, {fmt(banned)} banned, {len(day_files)} files.")
    return 0


if __name__ == "__main__":
    sys.exit(main())
