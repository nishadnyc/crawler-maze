#!/usr/bin/env python3
"""Generate a crawler-trap traffic report (Markdown) from per-subnet daily JSON logs.

Usage: python scripts/generator.py [--logs logs] [--out readme.md]
Stdlib only, so the workflow needs no pip install.
"""
import argparse
import collections
import datetime as dt
import glob
import ipaddress
import json
import os
import re

# ---------------------------------------------------------------- owner lookup
# Matched on the first two octets, then the first octet. Extend freely.
# Best-effort knowledge of well-known ranges, not a live WHOIS lookup.
OWNERS_2 = {}


def _add(org, *prefixes):
    for p in prefixes:
        OWNERS_2[p] = org


_add("OpenAI (Microsoft Azure)", "74.7", "132.196", "172.182", "51.8", "20.125")
_add("Anthropic", "216.73", "160.79")
_add("Meta", "173.252", "69.171", "57.141", "31.13", "66.220", "157.240")
_add("GitHub", "140.82", "192.30", "185.199")
_add("DigitalOcean", "104.248", "64.227", "137.184", "46.101", "143.198", "157.230",
     "159.203", "165.232", "167.99", "134.209", "146.190", "147.182", "157.245", "178.128")
_add("Hetzner", "168.119", "188.245", "5.9", "78.46", "88.99", "95.216", "116.202",
     "135.181", "136.243", "144.76", "148.251", "157.90", "159.69", "162.55", "176.9", "195.201")
_add("Akamai/Linode", "172.234", "172.239", "172.236", "172.235", "192.155", "172.104",
     "172.105", "45.79", "45.33", "96.126", "139.162")
_add("Oracle Cloud", "129.213", "129.146", "129.151", "129.153", "129.159", "132.145",
     "140.238", "141.148", "150.136", "152.67", "158.101", "193.122")
_add("Tencent Cloud", "49.51", "119.91", "129.226", "150.109", "101.32", "101.33", "119.28", "124.156")
_add("China-region cloud (guess)", "152.32", "156.225", "106.75", "103.218", "45.249",
     "154.51", "123.58", "165.154", "154.44")
_add("Alibaba Cloud", "8.218", "8.216", "47.96", "47.108", "47.254")
_add("ColoCrossing (budget VPS)", "23.94", "23.95", "107.172", "107.173", "107.174")
_add("M247 (VPN/proxy hosting)", "146.70", "31.209")
_add("Scanner-hosting ISPs", "93.174", "80.82", "89.248", "94.102")
_add("Google Cloud", "35.230", "35.189", "35.190", "35.221")
_add("AWS", "35.175", "35.153", "35.95", "35.88", "34.203", "34.209", "34.239", "34.201")

FIRST_OCTET = {
    **dict.fromkeys(["3", "13", "16", "18", "32", "44", "50", "52", "54", "98", "100", "174", "184"], "AWS"),
    **dict.fromkeys(["20", "4", "9", "10"], "Microsoft Azure"),
    "43": "Tencent Cloud", "34": "Google Cloud", "35": "Google Cloud", "47": "Alibaba Cloud",
}


SUBNET_OWNER = {}   # filled from the ASN database when one is supplied


def owner(subnet):
    if subnet in SUBNET_OWNER:
        return SUBNET_OWNER[subnet]
    p = subnet.split("/")[0].split(".")
    return OWNERS_2.get(".".join(p[:2])) or FIRST_OCTET.get(p[0]) or "Unidentified"


# ------------------------------------------------ ASN database + vendor ranges
BOT_RANGE_FILE = {
    "bot:GPTBot": "gptbot.json",
    "bot:OAI-SearchBot": "searchbot.json",
    "bot:ChatGPT-User": "chatgpt-user.json",
    "bot:ClaudeBot": "claude-bots.json",
    "bot:Claude-User": "claude-bots.json",
}


def open_asn(path):
    """Open a MaxMind GeoLite2-ASN .mmdb. Returns None (and the built-in table is used) if unavailable."""
    if not path or not os.path.exists(path):
        return None
    try:
        import maxminddb
        return maxminddb.open_database(path)
    except Exception as e:  # missing package or unreadable file
        print(f"ASN database not used ({e}); falling back to built-in table")
        return None


def asn_label(reader, ip):
    try:
        r = reader.get(ip)
    except Exception:
        return None
    if r and r.get("autonomous_system_organization"):
        return f"{r['autonomous_system_organization']} (AS{r.get('autonomous_system_number', '?')})"
    return None


def build_owner_map(reader, subnets):
    """Per /16, use the most common ASN among the IPs actually seen in it."""
    for sn, s in subnets.items():
        c = collections.Counter(filter(None, (asn_label(reader, ip) for ip in s["ips"])))
        if c:
            SUBNET_OWNER[sn] = c.most_common(1)[0][0]


def _prefixes(obj, out):
    if isinstance(obj, dict):
        for k, v in obj.items():
            if k in ("ipv4Prefix", "ipv6Prefix", "cidr") and isinstance(v, str):
                out.append(v)
            else:
                _prefixes(v, out)
    elif isinstance(obj, list):
        for v in obj:
            _prefixes(v, out)


def load_ranges(directory):
    nets = {}
    if not directory or not os.path.isdir(directory):
        return nets
    for fname in set(BOT_RANGE_FILE.values()):
        path = os.path.join(directory, fname)
        try:
            raw = []
            _prefixes(json.load(open(path, encoding="utf-8")), raw)
            nets[fname] = [ipaddress.ip_network(c, strict=False) for c in raw]
        except (OSError, ValueError):
            continue
    return nets


def check_ranges(bot_key, ips, nets):
    """Returns (inside, total, outside_ips) or None if no list is available for this bot."""
    lst = nets.get(BOT_RANGE_FILE.get(bot_key, ""))
    if not lst:
        return None
    outside = []
    for ip in ips:
        try:
            a = ipaddress.ip_address(ip)
        except ValueError:
            continue
        if not any(a in n for n in lst if n.version == a.version):
            outside.append(ip)
    return len(ips) - len(outside), len(ips), sorted(outside)


# ------------------------------------------------------------- path categories
PATH_CATS = [
    ("env / secrets", r"^\.env|\.aws|\.ssh|secret|credential|\.npmrc|id_rsa"),
    ("version control / CI", r"^\.git|\.svn|\.hg|\.circleci|\.azure|\.gitlab"),
    ("wordpress", r"^wp-|xmlrpc"),
    ("backups / db dumps", r"backup|\.sql|\.zip|\.tar|dump|database"),
    ("actuator / swagger", r"actuator|swagger|api-docs|graphql"),
    ("php shells / probes", r"\.php$|shell"),
    ("config / framework dirs", r"^(config|app|core|server|backend|frontend|storage|assets|admin)$|\.config|\.nuget|\.gem|vendor"),
]
SITE_SECTIONS = {"robots.txt", "sitemap.xml", "favicon.ico"}


def categorize(path):
    for name, pat in PATH_CATS:
        if re.search(pat, path, re.I):
            return name
    return None


# ---------------------------------------------------------------------- load
def new_group():
    return dict(total=0, clicked=0, direct=0, robots=0, banned=0, bans=0, forms=0,
                subnets=set(), ips=set(), iphashes=set(), sections=collections.Counter(),
                ua="", first=10**12, last=0)


def load(logs_dir):
    files = sorted(f for f in glob.glob(os.path.join(logs_dir, "**", "*.json"), recursive=True)
                   if "__MACOSX" not in f)
    groups = collections.defaultdict(new_group)   # key: bot name, or ua:<hash> for others
    subnets = collections.defaultdict(lambda: dict(total=0, ips=set(), banned=0))
    all_ips, hosts = set(), set()
    botips = collections.defaultdict(set)
    ban_entries = 0
    for f in files:
        try:
            d = json.load(open(f, encoding="utf-8"))
        except (OSError, ValueError):
            continue
        sn = d.get("subnet", "unknown")
        ban_entries += len(d.get("bans", {}))
        for ip, v in d.get("ips", {}).items():
            all_ips.add(ip)
            subnets[sn]["ips"].add(ip)
            a = v.get("agent", "")
            if a.startswith("bot:"):
                botips[a].add(ip)
        for key, g in d.get("groups", {}).items():
            x = groups[key]
            for k, src in (("total", "total"), ("clicked", "clicked"), ("direct", "direct"),
                           ("robots", "robots"), ("banned", "banned_hits"), ("bans", "ban_count")):
                x[k] += g.get(src, 0)
            x["forms"] += g.get("form_submissions", 0)
            x["subnets"].add(sn)
            x["iphashes"].update(g.get("ip_hashes", {}))
            x["ua"] = g.get("user_agent", x["ua"])
            x["first"] = min(x["first"], g.get("first_seen", x["first"]))
            x["last"] = max(x["last"], g.get("last_seen", x["last"]))
            if isinstance(g.get("sections"), dict):
                x["sections"].update(g["sections"])
            if g.get("last_host"):
                hosts.add(g["last_host"])
            subnets[sn]["total"] += g.get("total", 0)
            subnets[sn]["banned"] += g.get("banned_hits", 0)
    for a, ips in botips.items():
        groups[a]["ips"] |= ips
    return groups, subnets, all_ips, hosts, ban_entries, len(files)


# -------------------------------------------------------------------- render
def bar(v, m, width=20):
    return "█" * max(1, round(v / m * width)) if v and m else ""


def pct(a, b):
    return f"{a / b * 100:.1f}%" if b else "0%"


def table(head, rows, align=None):
    align = align or ["l"] * len(head)
    sep = ["---:" if a == "r" else "---" for a in align]
    out = ["| " + " | ".join(head) + " |", "| " + " | ".join(sep) + " |"]
    out += ["| " + " | ".join(str(c) for c in r) + " |" for r in rows]
    return "\n".join(out)


def ranges24(ips, limit=8):
    c = collections.Counter(".".join(i.split(".")[:3]) + ".0/24" for i in sorted(ips) if "." in i)
    items = [f"`{k}` ({n})" for k, n in c.most_common(limit)]
    more = len(c) - limit
    return ", ".join(items) + (f", +{more} more" if more > 0 else "")


def ua_label(ua):
    m = re.search(r"(Chrome|Firefox|Version)/(\d+)", ua)
    osm = re.search(r"Windows NT 6\.1|Windows NT 10|Macintosh|Android \d+|iPhone OS [\d_]+|X11; Linux", ua)
    if m and osm:
        return f"{'Safari' if m.group(1) == 'Version' else m.group(1)} {m.group(2)} / {osm.group(0).replace('X11; ', '').replace('_', '.')}"
    return ua[:50]


def esc(s):
    return s.replace("|", "\\|")


def main():
    ap = argparse.ArgumentParser()
    ap.add_argument("--logs", default="logs")
    ap.add_argument("--out", default="readme.md")
    ap.add_argument("--top-ua", type=int, default=15)
    ap.add_argument("--asn-db", default="", help="path to GeoLite2-ASN.mmdb (optional)")
    ap.add_argument("--ranges-dir", default="", help="folder with vendor range JSON files (optional)")
    args = ap.parse_args()

    groups, subnets, all_ips, hosts, ban_entries, nfiles = load(args.logs)
    if not groups:
        raise SystemExit(f"No usable logs found in {args.logs}/")

    reader = open_asn(args.asn_db)
    if reader:
        build_owner_map(reader, subnets)
    nets = load_ranges(args.ranges_dir)

    total = sum(g["total"] for g in groups.values())
    banned = sum(g["banned"] for g in groups.values())
    bots = {k: g for k, g in groups.items() if k.startswith("bot:")}
    others = {k: g for k, g in groups.items() if not k.startswith("bot:")}
    ai_hits = sum(g["total"] for g in bots.values())
    first = min(g["first"] for g in groups.values())
    last = max(g["last"] for g in groups.values())
    U = lambda t: dt.datetime.fromtimestamp(t, dt.timezone.utc).strftime("%Y-%m-%d %H:%M")
    hours = (last - first) / 3600

    L = []
    L.append("# Crawler trap traffic report\n")
    L.append(f"_Built from {nfiles} log files. "
             f"Window: {U(first)} to {U(last)} UTC ({hours:.1f} h)._\n")
    L.append(table(["Metric", "Value"], [
        ["Logged hits", f"{total:,}"],
        ["Bot-labelled hits", f"{ai_hits:,} ({pct(ai_hits, total)})"],
        ["Distinct IPs", f"{len(all_ips):,}"],
        ["/16 ranges", f"{len(subnets):,}"],
        ["Hostnames seen", f"{len(hosts):,}"],
        ["Ban entries", f"{ban_entries:,}"],
        ["Requests logged during bans", f"{banned:,}"],
        ["Form submissions (honeypot)", f"{sum(g['forms'] for g in groups.values()):,}"],
    ], ["l", "r"]))

    # --- traffic mix
    L.append("\n## Traffic mix\n")
    rows = sorted(((k[4:], g["total"]) for k, g in bots.items()), key=lambda r: -r[1])
    rows.append(("non-bot user agents", sum(g["total"] for g in others.values())))
    rows.sort(key=lambda r: -r[1])
    m = rows[0][1]
    L.append(table(["Source", "Hits", "Share", ""],
                   [[n, f"{v:,}", pct(v, total), f"`{bar(v, m)}`"] for n, v in rows], ["l", "r", "r", "l"]))

    # --- named crawlers
    L.append("\n## Named crawlers\n")
    for k, g in sorted(bots.items(), key=lambda kv: -kv[1]["total"]):
        name = k[4:]
        nips = len(g["ips"])
        sec = g["sections"]
        tops = ", ".join(f"{s} {c:,}" for s, c in sec.most_common(6))
        L.append(f"### {name}\n")
        L.append(f"- **Owner:** {', '.join(sorted({owner(s) for s in g['subnets']}))}")
        L.append(f"- **Hits:** {g['total']:,} ({pct(g['total'], total)}) from {nips:,} IP(s) in {len(g['subnets'])} /16 range(s)")
        L.append(f"- **/24 ranges (IPs):** {ranges24(g['ips'])}")
        chk = check_ranges(k, g["ips"], nets)
        if chk:
            inside, n, outside = chk
            if outside:
                L.append(f"- **Vendor range check:** {inside}/{n} IPs inside published ranges; "
                         f"**not listed:** {', '.join(f'`{i}`' for i in outside[:8])}"
                         f"{' ...' if len(outside) > 8 else ''}")
            else:
                L.append(f"- **Vendor range check:** all {n} IPs are inside the vendor's published ranges")
        if g["total"]:
            L.append(f"- **Link-follow vs direct:** {pct(g['clicked'], g['total'])} followed maze links, "
                     f"{pct(g['direct'], g['total'])} direct fetches")
            L.append(f"- **robots.txt requests:** {g['robots']:,} ({pct(g['robots'], g['total'])}); "
                     f"sitemap.xml: {sec.get('sitemap.xml', 0):,}")
        if nips:
            L.append(f"- **Requests per IP:** {g['total'] / nips:,.1f} average")
        if g["bans"] or g["banned"]:
            L.append(f"- **Bans:** {g['bans']:,}; {g['banned']:,} further requests logged while banned")
        if tops:
            L.append(f"- **Top sections:** {tops}")
        L.append(f"- **User agent:** `{g['ua'][:120]}`\n")

    # --- owners
    L.append("## Hits by network owner\n")
    by_owner = collections.defaultdict(lambda: dict(hits=0, subs=[], ips=set()))
    for sn, s in subnets.items():
        o = by_owner[owner(sn)]
        o["hits"] += s["total"]
        o["subs"].append(sn)
        o["ips"] |= s["ips"]
    rows = []
    for name, o in sorted(by_owner.items(), key=lambda kv: -kv[1]["hits"]):
        top = sorted(o["subs"], key=lambda s: -subnets[s]["total"])[:4]
        rows.append([name, f"{o['hits']:,}", pct(o["hits"], total), len(o["subs"]), len(o["ips"]),
                     ", ".join(f"`{s}`" for s in top)])
    L.append(table(["Owner", "Hits", "Share", "/16s", "IPs", "Top ranges"], rows, ["l", "r", "r", "r", "r", "l"]))

    # --- UA fingerprints
    L.append(f"\n## Non-bot fingerprints (top {args.top_ua} by hits)\n")
    L.append("Same user-agent hash across many ranges usually means one operator or toolkit.\n")
    rows = []
    for k, g in sorted(others.items(), key=lambda kv: -kv[1]["total"])[:args.top_ua]:
        sec = g["sections"]
        probe = collections.Counter()
        for s, c in sec.items():
            cat = categorize(s)
            if cat:
                probe[cat] += c
        what = ", ".join(f"{c}" for c, _ in probe.most_common(2)) or ", ".join(s for s, _ in sec.most_common(3)) or "root only"
        kind = "link-follower" if g["total"] and g["clicked"] / g["total"] > 0.5 else "direct fetch"
        rows.append([f"`{esc(ua_label(g['ua']))}`", f"{g['total']:,}", len(g["iphashes"]), len(g["subnets"]),
                     ", ".join(sorted({owner(s) for s in g["subnets"]}))[:60], kind, esc(what)])
    L.append(table(["User agent", "Hits", "IPs", "/16s", "Owners", "Mode", "Requests"], rows,
                   ["l", "r", "r", "r", "l", "l", "l"]))

    # --- probe paths
    cats, paths = collections.Counter(), collections.Counter()
    for g in others.values():
        for s, c in g["sections"].items():
            cat = categorize(s)
            if cat:
                cats[cat] += c
                paths[s] += c
    L.append("\n## What the probes ask for\n")
    if cats:
        mc = max(cats.values())
        L.append(table(["Category", "Requests", ""], [[c, f"{v:,}", f"`{bar(v, mc)}`"] for c, v in cats.most_common()],
                       ["l", "r", "l"]))
        L.append("\nMost requested paths: " + ", ".join(f"`{p}` ({c})" for p, c in paths.most_common(12)))
    else:
        L.append("No probe-style paths seen.")

    # --- honeypot
    forms = [(k, g) for k, g in groups.items() if g["forms"]]
    if forms:
        L.append("\n## Honeypot form submissions\n")
        L.append(table(["Group", "Submissions", "Ranges"],
                       [[f"`{k}`", g["forms"], ", ".join(f"`{s}`" for s in sorted(g["subnets"]))] for k, g in forms],
                       ["l", "r", "l"]))

    L.append("\n## Notes\n")
    L.append("- Totals use each group's own hit counter; per-IP counters in the logs are rolling-window values and undercount heavy hitters.")
    if reader:
        L.append("- Owners come from the MaxMind GeoLite2-ASN database (majority ASN of the IPs seen in each /16).")
    else:
        L.append("- Owner names come from a built-in prefix table (`OWNERS_2` in `scripts/generator.py`), not live WHOIS. Pass `--asn-db` for real ASN data.")
    if nets:
        L.append("- Bot IPs were checked against the vendors' published range files. Bots without a file are unchecked.")
    L.append("- User agents can be spoofed; vendor tokens are only trustworthy when the IP range matches the vendor.")

    with open(args.out, "w", encoding="utf-8") as fh:
        fh.write("\n".join(L) + "\n")
    print(f"wrote {args.out}: {total:,} hits, {len(all_ips):,} IPs, {len(subnets)} ranges")


if __name__ == "__main__":
    main()
