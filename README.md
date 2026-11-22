# Crawler Maze — wildcard fake-site generator

**One PHP file** (`public_html/index.php`, Soltris server 6 "PHP Maze") that answers
for **any subdomain of nishad.top that has no real site** and generates a brand-new
fake hosting-company page on every single load. Its job: keep crawlers (GPTBot,
ClaudeBot, and friends) wandering an endless, never-repeating maze of plausible
pages, links, sitemaps and forms — and log what they do while costing almost
no CPU.

This README lives in the **server volume root, next to `public_html/`** — it is
deliberately **not** inside `public_html`, so it is never web-served. The script
itself is fully commented; section numbers below match the `SECTION n` banners
in the code.

---

## Branch: timed-domain-shift — timed domain rotation (EXPERIMENT, not on main)

**Per-visitor version (Nishad, 2026-11-22 ~03:40 EST)** — this supersedes
the earlier global-tracker version on this branch. There is **no global
tracker file any more** (`.maze-domain.json` is no longer read or written
for link domains); each visitor carries their own link domain in their
own cookie, so one visitor's timing/domain never impacts anyone else.

- **All page links for a visitor use ONE link domain at a time** instead
  of each link pointing at a different random sibling subdomain.
- **No session cookie → the host being visited**: if the visitor presents
  no valid `maze_link` cookie, the domain they are actually visiting
  right now (e.g. landing on `abc.nishad.top`) becomes their link
  domain. A cookie storing **that domain + the current timestamp** is
  set, and all links on the page point only to that domain.
- **Cookie younger than 5 seconds**: all links use the domain stored in
  the cookie, unchanged.
- **Cookie 5+ seconds old**: ONE new random `*.nishad.top` subdomain is
  generated (same word style as the other maze subdomains), that
  visitor's cookie is updated to the new domain + a fresh timestamp, and
  all their links point to the new domain for the next 5 seconds.
- **Cookie scope is the whole point**: the cookie is set with
  `Domain=.nishad.top`, because a host-only cookie set on
  `abc.nishad.top` would never be sent after following a link to a
  different subdomain. Cookie value shape: `<domain>__<unix timestamp>`;
  both parts are validated (domain must be the base domain or a
  subdomain of it in plain hostname shape; timestamp a positive integer
  not in the future) and anything invalid falls back to the current
  host + a fresh cookie.
- **Separate cookies, separate jobs**: `maze_link` (link domain, this
  feature) is distinct from `maze_visit` (first-seen group, for
  logging/banning) and `maze_session` (honeypot) — those are untouched.
  Nothing about the link domain is mixed into the per-subnet daily logs.
- **Unchanged**: robots.txt / sitemap.xml still list only the current host
  (the sitemap builds random-host URLs then overrides them to the
  visited host, as before); canonical/OG URLs still use the visited
  host; ban, honeypot and logging behaviour are untouched. Paths still
  end in the 2000–3000 sugar.

## Latest changes — 2026-11-22 (5-second hold for banned visitors)

- **Banned visitors now wait 5 seconds before the 429**: when a visitor is
  banned, the hit is **logged first**, then the script does `sleep(5)`,
  and only then answers with the bare **429 + Retry-After** — no page,
  no data during the wait.
- **Both ban paths do this**:
  1. the **already-banned fast path** (§5) — the ban file is checked,
     the banned hit is counted in the group's daily log, then
     `sleep(5)`, then 429;
  2. the **new-ban path** (§6) — the hit that trips the 2000/hour limit
     is logged, the new ban is merged into `.maze-bans.json`, then
     `sleep(5)`, then 429.
- **Per-request only**: the sleep holds only that one banned request.
  Other visitors are not blocked or slowed by it — PHP serves each
  request separately, so normal (non-banned) visitors still get their
  page instantly, with no delay at all.
- Why: banned bots were ignoring the instant 429 and knocking again
  immediately. The 5-second hold costs the server almost nothing
  (no page is generated) but wastes the banned bot's time on every
  single knock.

## Latest changes — 2026-11-22 (cookie + first-seen group)

- **Cookie probe**: every first-time visitor now gets a `maze_visit` cookie
  (set at the very top of the script; the server stores nothing about it).
  A short live capture proved ClaudeBot stores and returns cookies (one
  token resent on 3 separate requests); GPTBot returned none in the window.
- **First-seen group identity**: the cookie's value is the visitor's
  **first-seen group** (its /16 subnet) plus a random token — no bot name.
  Grouping, counting, the daily log file and bans now follow the group in
  the cookie, so a bot returning from a rotated IP is treated as its
  original group; its current subnet is logged under `alias_subnets`.
  Bot/agent names are stats only and no longer group or ban anyone.
- **Ban rule**: a visitor is blocked if their IP/subnet **or** the group in
  their cookie is banned (keys: `ip:`, `subnet:<group>`, `group:<group>`).
  Banned hits are still tracked in the group's daily file.
- **Rate limit raised**: 200 → **2000** hits per 1-hour window (per IP or
  per group) before the 10-minute ban — bots get more maze before the wall.
- **Old archive removed**: the `old-files/` folder (the archived original
  single-file tracker) was deleted 2026-11-22. The project keeps only
  `index.php` + the root `.htaccess`; the script creates `logs/` and its
  deny-all `.htaccess` by itself when missing.

## Where things live

| Thing | Path (on the Oracle host) |
|---|---|
| Script | `/var/lib/soltris-wings/volumes/64ebbbde-c8b1-4191-bc4b-954e090bd351/public_html/index.php` |
| Inside container | `/home/container/public_html/index.php` (PHP binary: `/usr/bin/php83`) |
| Daily logs | `public_html/logs/<group subnet>_<YYYY-MM-DD>.json` (deny-all `.htaccess` in that folder) |
| Global ban file | `public_html/.maze-bans.json` |
| Backups | `public_html/index.php.bak-<label>-<timestamp>` beside the script |
| This README | volume root: `…/64ebbbde-c8b1-4191-bc4b-954e090bd351/MAZE-README.md` |

## The .htaccess files — copy-paste

There are three .htaccess files. To recreate any of them, create a file
with that exact name in that exact folder and paste the code as-is.

**1. Create a file named `.htaccess` inside `public_html/` and paste this:**

```apache
RewriteEngine On

# Only index.php may be reached directly. Any other real file on disk
# (ban list, script backups, data files) is forbidden over the web.
# The script itself still reads/writes those files normally.
RewriteCond %{REQUEST_FILENAME} -f
RewriteCond %{REQUEST_FILENAME} !/index\.php$
RewriteRule ^ - [F,L]

# Everything that is not a real file or folder goes to the maze script.
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [L,QSA]

ErrorDocument 404 /index.php
ErrorDocument 403 /index.php
```

This is the router, and it is what makes the whole maze work: any URL that
is not a real file or folder on disk is sent to `index.php`, and 404/403
errors are sent to `index.php` too — so every random path on every
subdomain runs the maze script instead of an error page. The first rule
also locks the folder down: `index.php` is the **only** file that can be
reached over the web at all. Every other real file on disk — the ban list
`.maze-bans.json`, the `index.php.bak-*` backups, anything else — returns
403 (and gets the maze page as the error document) if anyone asks for it
directly. The script itself still reads and writes those files normally;
only web access is blocked. (Verified live 2026-11-21: before this rule,
the ban list and the full script source were downloadable; after it, both
return 403 with no contents.)

**2. Create a file named `.htaccess` inside `public_html/logs/` and paste this:**

```apache
Require all denied
Deny from all
```

This blocks all web access to the daily log files. (The script also
re-creates this file by itself if it is missing — see §6 in the code.)

Access from Cleo's VM (direct SSH is blocked):
`ssh -o ProxyCommand="python3 /home/hatch/workspace/proxyconnect.py %h %p" ubuntu@100.125.66.28`, then `sudo docker …`.

---

## How a request flows (matches the sections in the code)

1. **Helpers (§1)** — `pick()` one random item, `picks()` several without repeats,
   `e()` HTML-escape output, `slugify()`.
2. **Content pools (§2)** — base lists for everything visible: brands, topics,
   adjectives, nouns, features, sections, doc pages, blog topics, taglines, plan
   names, testimonials, FAQs, locations, status lines, subdomain words, authors,
   categories, tags, glossary, SEO keywords.
3. **Pool expansion (§3)** — the base lists are cross-multiplied (brand
   prefixes × suffixes, adjectives × nouns, sections × page types, topics ×
   year/audience suffixes, first × last names, …) until each pool holds hundreds
   to thousands of entries. Plus 24 extra paragraphs built from
   starter × middle × ender sentence parts (576 combinations).
4. **Request context (§4)** — scheme (honouring `X-Forwarded-Proto`), host,
   port, path. The current subdomain becomes the page's site name; the base
   domain (last two labels) is used to build links to sibling subdomains.
   Visitor identity: real IP (first `X-Forwarded-For` entry), user-agent, and
   the **/16 subnet** (IPv6: /48) — crawlers rotate IPs inside a subnet. The
   visitor's **group** is then resolved (see "First-seen group identity"
   below): the group baked into their `maze_visit` cookie if they carry one,
   otherwise today's subnet. The group — never the bot name — is the unit
   that gets counted and banned. An agent key (`bot:<name>` for known
   crawlers, else `ua:<md5-12>` of the exact user-agent) is still computed,
   but only as a stats label inside the log file.
5. **Ban check (§5)** — `.maze-bans.json` is read first (shared lock). If the
   visitor's IP, group subnet or group key has an unexpired ban, the hit is counted
   against their group in today's log (`banned_hits`, `last_banned_hit`),
   then the script holds the request with `sleep(5)` and the answer is a
   bare **429 + Retry-After** — no page is generated. Ban
   length: **600 s (10 min)**, enforced inside PHP only (no firewall changes).
6. **Daily per-group log (§6)** — one locked read/modify/write of
   `logs/<group subnet>_<date>.json` (date in **America/New_York**; a fresh
   file starts each day, old days are kept). Everything for the hit happens in
   this single pass — counters, group stats, honeypot, ban decisions — so the
   file is never opened twice per hit. See "Log file format" below.
   - Rate limit: **> 2000 hits in the current 1-hour window** from the IP
     **or** the first-seen group → 10-minute ban for the IP and group keys,
     merged into `.maze-bans.json` (expired entries pruned), and this request
     gets `sleep(5)` then 429.
   - Housekeeping: ips/agents/groups idle **2 hours** are dropped from today's
     file so it stays small.
7. **robots.txt / sitemap.xml (§7)** — generated on the fly by the same script
   (no separate files). `robots.txt` allows everything and advertises **only
   this host's own** `/sitemap.xml`. The sitemap lists **50 URLs, all on the
   current host**, with randomised lastmod/changefreq/priority. (Cross-host
   URLs would reveal that the subdomains are connected — never reintroduce
   them.)
8. **Page assembly (§8)** — random brand/topic/heading/features/FAQs/
   testimonials/dates/numbers for this load; ~160 unique links built by
   `buildUrl()`/`uniqueLinks()` (nav 8, body 80, extra/tag 18, related 6,
   footer 40, plus the main CTA). **Every link path ends in a random number
   2000–3000** (the "sugar") so each URL looks like a distinct article. On
   `main`, links point at random **sibling subdomains**; on the
   `timed-domain-shift` branch, all links use the ONE per-visitor link
   domain from the visitor's `maze_link` cookie (see the branch note at
   the top), rotating every 5 seconds per visitor. Either way, following them stays in the maze. Full SEO bait: meta/OG/Twitter tags, canonical + hreflang, and a
   JSON-LD graph (Organization, WebSite, WebPage, BlogPosting, BreadcrumbList,
   FAQPage, Product+rating, ItemList). Headers forbid caching — every load is
   a fresh page.
9. **HTML template (§9)** — text-only page, minimal inline CSS, **no images
   and no external assets** (deliberate: no outside dependency, no trail,
   minimal load). Header/nav/breadcrumb, article with shuffled sections
   (features, pricing table, FAQ, testimonials, glossary, related cards, the
   big link list, tags, status numbers), aside, footer with 40 more links.
   Comments inside the template are PHP comments (`<?php /* … */ ?>`) so they
   never appear in the served page source.

## The honeypot login form (§6 + §9)

Every page carries a **hidden form** (positioned at `-9999px`, `aria-hidden`,
all fields `tabindex="-1"` — humans never see it; form-filling bots do).
Field order is deliberate, so it reads like a real login:

1. Website (url) 2. Login email 3. Login username 4. Login password
5. Full name 6. Message — plus a hidden `contact_form=1` marker field.

Behaviour:

- A POST with the marker counts as a submission **for the visitor's group**.
- The **first 5** submissions per group per day are logged in full in that
  group's `form_posts` (timestamp, host, path, and the submitted values,
  trimmed to 120 chars each) and counted in `form_submissions`.
- Each logged submission also gets the payoff: the response page shows a
  green **"Login successful"** popup (auto-hides after 5 s) and a
  **`maze_session` cookie** (random token, 30 days) is set.
- **Sessions are checked in the visitor's headers only.** The server stores
  **no** session list and cross-checks **nothing** — if a request arrives
  carrying any `maze_session` cookie, the form is simply not rendered.
- Past 5 submissions the form stops being rendered for that group; further
  direct POSTs are only counted in `form_submissions_blocked`, not logged.
- Bots that ignore cookies are still stopped by the 5-per-group rule; bots
  that keep cookies stop seeing the form after their first "login".

## Log file format (`logs/<group subnet>_<date>.json`)

```jsonc
{
  "subnet": "74.7.0.0/16", "first_seen": …, "last_seen": …,   // the GROUP subnet (first-seen, from the cookie when carried)
  "alias_subnets": { "52.1.0.0/16": 12 },       // other subnets this group arrived from, with hit counts
  "window_start": …, "count": 123,              // group hits in current hour window
  "ips":    { "<ip>":        { "first_seen":…, "window_start":…, "count":…, "last_seen":…, "agent":"bot:GPTBot" } },
  "agents": { "bot:GPTBot":  { "first_seen":…, "window_start":…, "count":…, "last_seen":…, "user_agent":"…", "user_agents":["… up to 5 distinct …"] } },
  "groups": { "bot:GPTBot":  {
      "first_seen":…, "last_seen":…, "total":…, "unique_ips":…, "ip_hashes":{"<md5-10>":1},
      "clicked":…,            // arrived with a referrer on this domain (followed a maze link)
      "direct":…,             // arrived with no/foreign referrer
      "robots":…,             // hits on /robots.txt
      "banned_hits":…, "ban_count":…, "last_ban":{"since":…,"until":…},
      "sections": {"blog": 12, …},            // first path segment counts (max 50)
      "last_host":"…", "last_path":"…",
      "user_agent":"…", "user_agents":["… up to 5 …"],
      "form_submissions":…, "form_submissions_blocked":…,
      "form_posts":[ {"ts":…, "host":"…", "path":"…",
                      "data":{"website":"…","email":"…","username":"…","password":"…","name":"…","message":"…"}} ]
  } },
  "bans": { "ip:… / subnet:… / group:…": {"since":…, "until":…, "user_agent":"…"} }
}
```

`.maze-bans.json` is the same `bans` shape at top level, plus `hits` /
`last_hit` counters incremented when a banned visitor keeps knocking.

## First-seen group identity (the `maze_visit` cookie)

A visitor's **group is the /16 subnet they were first seen in** — not their
bot name (names are unreliable and changeable; agent stats are logged for
information only and never group or ban anyone).

- On the **first visit** (no cookie), the script sets a `maze_visit` cookie
  whose value is `<first-seen subnet>__<random token>`, e.g.
  `216.73.0.0_16__ab12…`. The server stores nothing about the cookie.
  (The first cookie version was `<agent>__<subnet>__<token>`; its middle
  part is still accepted as the group.)
- On later visits the group is read **out of the cookie** (the subnet is
  validated against the IPv4 /16 shape first). Counting, the daily log
  file, and bans all follow that group — so a bot returning from a rotated
  IP with its cookie is counted and banned as its original group. Its
  current subnet is recorded in the group file's `alias_subnets`.
- Verified live 2026-11-22: ClaudeBot stores and returns the cookie (one
  token resent on 3 separate requests); GPTBot returned no cookie in the
  same window.
- Ban keys are `ip:<ip>`, `subnet:<group subnet>` and `group:<group subnet>`:
  a visitor is blocked if **either** their IP/subnet **or** the group in
  their cookie is banned. Banned hits are still logged (`banned_hits`).

## Key numbers (all in the code, §5–§6)

| Constant | Value |
|---|---|
| Rate window | 1 hour (3600 s), per IP / first-seen group |
| Rate limit | 2000 hits per window → ban |
| Ban length | 600 s (10 min), 429 + `Retry-After` |
| Ban hold | `sleep(5)` after logging, before the 429 — both ban paths, per-request only |
| Visit cookie | `maze_visit`, 30 days, path `/`, value = first-seen group + token |
| Link-domain cookie (branch) | `maze_link`, 30 days, path `/`, `Domain=.nishad.top`, value = `<link domain>__<unix ts>`; <5 s old = links stay on its domain, 5+ s old = new random domain + fresh ts in a new cookie |
| Idle pruning | entries idle ≥ 7200 s dropped from today's log |
| Honeypot logging | first 5 submissions per group per day |
| Logged field trim | 120 chars per field |
| Session cookie | `maze_session`, 30 days, path `/` |
| Link "sugar" | trailing random number 2000–3000 |
| Sitemap size | 50 URLs, current host only |
| Log timezone | America/New_York (daily rollover) |

## Maintenance rules

- **Back up before every edit**: `cp index.php index.php.bak-<label>-<timestamp>`.
- **Never edit the file through a shell heredoc / inline `ssh "…$…"` command** —
  the shell eats `$variables` and corrupts the PHP (this actually happened on
  2026-11-21 and took the maze down with 500s until restored). Edit a local
  copy, transfer the whole file (scp), then lint.
- **Always lint after an edit**:
  `sudo docker exec 64ebbbde-c8b1-4191-bc4b-954e090bd351 /usr/bin/php83 -l /home/container/public_html/index.php`
  then check one random subdomain returns 200 and still contains the form.
- **Test like a visitor, once** — one page load or one form submission, then
  verify in the log file. Do not loop submissions: the maze generates a fresh
  page every time, and repeated testing just fills the logs (and gets the
  test group banned, by design).
- Keep it **one file, text-only, no external assets**. Anything that writes
  files must hold `flock()` — many requests run concurrently.
- If the site returns 500: lint first, and restore the newest good
  `index.php.bak-*` — a backup restore has fixed every incident so far.

## Quick checks

```bash
# who is hammering today (top groups by hits)
sudo python3 -c "import json,glob; [print(f, sorted([(k,v.get('total',0)) for k,v in json.load(open(f)).get('groups',{}).items()], key=lambda x:-x[1])[:3]) for f in sorted(glob.glob('/var/lib/soltris-wings/volumes/64ebbbde-c8b1-4191-bc4b-954e090bd351/public_html/logs/*'))[-3:]]"

# honeypot catches so far
sudo grep -rh '"form_posts"' /var/lib/soltris-wings/volumes/64ebbbde-c8b1-4191-bc4b-954e090bd351/public_html/logs/ | head

# container load
sudo docker stats 64ebbbde-c8b1-4191-bc4b-954e090bd351 --no-stream
```
