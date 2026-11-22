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

## Where things live

| Thing | Path (on the Oracle host) |
|---|---|
| Script | `/var/lib/soltris-wings/volumes/64ebbbde-c8b1-4191-bc4b-954e090bd351/public_html/index.php` |
| Inside container | `/home/container/public_html/index.php` (PHP binary: `/usr/bin/php83`) |
| Daily logs | `public_html/logs/<subnet>_<YYYY-MM-DD>.json` (deny-all `.htaccess` in that folder) |
| Global ban file | `public_html/.maze-bans.json` |
| Archived old tracker | `public_html/old-files/` (the original single-file `.maze-visitors.json`, kept for review) |
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

**3. Create a file named `.htaccess` inside `public_html/old-files/` and paste this:**

```apache
Require all denied
Deny from all
```

Same as the logs one — it blocks web access to the archived old tracker
file kept in that folder.

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
   the **/16 subnet** (IPv6: /48) — crawlers rotate IPs inside a subnet, so the
   subnet is the unit that gets counted and banned. Known crawlers are grouped
   by **bot name** (`bot:GPTBot`, …); everything else by a hash of its exact
   user-agent (`ua:<md5-12>`).
5. **Ban check (§5)** — `.maze-bans.json` is read first (shared lock). If the
   visitor's IP, subnet or agent key has an unexpired ban, the hit is counted
   against their group in today's log (`banned_hits`, `last_banned_hit`) and
   the answer is a bare **429 + Retry-After** — no page is generated. Ban
   length: **600 s (10 min)**, enforced inside PHP only (no firewall changes).
6. **Daily per-subnet log (§6)** — one locked read/modify/write of
   `logs/<subnet>_<date>.json` (date in **America/New_York**; a fresh file
   starts each day, old days are kept). Everything for the hit happens in this
   single pass — counters, group stats, honeypot, ban decisions — so the file
   is never opened twice per hit. See "Log file format" below.
   - Rate limit: **> 200 hits in the current 1-hour window** from the IP, the
     subnet **or** the agent group → 10-minute ban for all three keys, merged
     into `.maze-bans.json` (expired entries pruned), and this request gets 429.
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
   2000–3000** (the "sugar") so each URL looks like a distinct article, and
   links point at random **sibling subdomains** so following them stays in
   the maze. Full SEO bait: meta/OG/Twitter tags, canonical + hreflang, and a
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

## Log file format (`logs/<subnet>_<date>.json`)

```jsonc
{
  "subnet": "74.7.0.0/16", "first_seen": …, "last_seen": …,
  "window_start": …, "count": 123,              // subnet hits in current hour window
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
| Visit cookie | `maze_visit`, 30 days, path `/`, value = first-seen group + token |
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
