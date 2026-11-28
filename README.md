# Crawler trap traffic report

_Built from 3153 log files. Window: 2026-11-22 03:45 to 2026-11-28 08:29 UTC (148.7 h)._

| Metric | Value |
| --- | ---: |
| Logged hits | 497,365 |
| Bot-labelled hits | 459,523 (92.4%) |
| Distinct IPs | 4,451 |
| /16 ranges | 1,514 |
| Hostnames seen | 564 |
| Ban entries | 1,056 |
| Requests logged during bans | 907,942 |

## Traffic mix

| Source | Hits | Share |  |
| --- | ---: | ---: | --- |
| ClaudeBot | 195,613 | 39.3% | `████████████████████` |
| OAI-SearchBot | 195,126 | 39.2% | `████████████████████` |
| GPTBot | 68,500 | 13.8% | `███████` |
| non-bot user agents | 37,842 | 7.6% | `████` |
| l9scan | 128 | 0.0% | `█` |
| Applebot | 118 | 0.0% | `█` |
| Googlebot | 24 | 0.0% | `█` |
| Claude-User | 9 | 0.0% | `█` |
| ChatGPT-User | 5 | 0.0% | `█` |

## Daily totals (8 of 8 days)

Day = the date in the log filename (server-local day), newest first.

| Day | Hits | ClaudeBot | OAI-SearchBot | GPTBot | other bots | non-bot | IPs | During bans |
| --- | ---: | ---: | ---: | ---: | ---: | ---: | ---: | ---: |
| 2026-11-28 | 15,006 | 7,136 | 4,445 | 3,059 | 2 | 364 | 761 | 9,469 |
| 2026-11-27 | 94,343 | 45,224 | 26,301 | 19,175 | 67 | 3,576 | 1,299 | 85,974 |
| 2026-11-26 | 82,976 | 34,903 | 30,588 | 14,333 | 56 | 3,096 | 1,222 | 125,324 |
| 2026-11-25 | 61,567 | 12,872 | 32,341 | 12,625 | 0 | 3,729 | 1,285 | 225,619 |
| 2026-11-24 | 60,065 | 14,924 | 27,437 | 13,275 | 13 | 4,416 | 983 | 160,593 |
| 2026-11-23 | 95,676 | 38,957 | 45,266 | 3,712 | 136 | 7,605 | 974 | 186,027 |
| 2026-11-22 | 86,226 | 41,191 | 28,355 | 2,282 | 10 | 14,388 | 1,189 | 106,354 |
| 2026-11-21 | 1,506 | 406 | 393 | 39 | 0 | 668 | 322 | 8,582 |

## Requests received (served plus logged during bans)

`Served` is the maze's normal hit counter. `During bans` counts requests that arrived while the source was banned and were tarpitted. Together they show how hard each source really pushes.

| Source | Served | During bans | Received | Share | % of requests banned |  |
| --- | ---: | ---: | ---: | ---: | ---: | --- |
| GPTBot | 68,500 | 677,485 | 745,985 | 53.1% | 90.8% | `████████████████████` |
| OAI-SearchBot | 195,126 | 185,111 | 380,237 | 27.1% | 48.7% | `██████████` |
| ClaudeBot | 195,613 | 45,117 | 240,730 | 17.1% | 18.7% | `██████` |
| non-bot | 37,842 | 229 | 38,071 | 2.7% | 0.6% | `█` |
| l9scan | 128 | 0 | 128 | 0.0% | 0.0% | `█` |
| Applebot | 118 | 0 | 118 | 0.0% | 0.0% | `█` |
| Googlebot | 24 | 0 | 24 | 0.0% | 0.0% | `█` |
| Claude-User | 9 | 0 | 9 | 0.0% | 0.0% | `█` |
| ChatGPT-User | 5 | 0 | 5 | 0.0% | 0.0% | `█` |

## Crawler behaviour

**Pace and IP use.** Single-use IPs were seen for under a minute. Requests per minute are averaged over each bot's own active window.

| Bot | Served req/min | Incl. banned req/min | IPs | Single-use IPs | Median IP lifetime (h) | Longest (h) |
| --- | ---: | ---: | ---: | ---: | ---: | ---: |
| ClaudeBot | 21.9 | 27.0 | 12 | 6 | 2.4 | 121.2 |
| OAI-SearchBot | 21.9 | 42.6 | 261 | 4 | 147.6 | 148.6 |
| GPTBot | 7.7 | 83.6 | 523 | 150 | 76.6 | 148.6 |
| l9scan | 2.5 | 2.5 | 4 | 4 | 0.0 | 0.0 |
| Applebot | 0.0 | 0.0 | 14 | 14 | 0.0 | 0.0 |
| Googlebot | 0.0 | 0.0 | 6 | 6 | 0.0 | 0.0 |

**IP churn per day.** Active IPs, with brand-new IPs in brackets. A bot that keeps finding new IPs has a pool larger than what has been seen.

| Day | ClaudeBot | OAI-SearchBot | GPTBot | l9scan | Applebot | Googlebot |
| --- | ---: | ---: | ---: | ---: | ---: | ---: |
| 2026-11-22 | 1 (+0) | 257 (+54) | 172 (+152) | - | - | - |
| 2026-11-23 | 2 (+1) | 257 (+0) | 149 (+54) | 4 (+4) | 1 (+1) | 1 (+1) |
| 2026-11-24 | 5 (+3) | 255 (+1) | 270 (+76) | - | - | 4 (+4) |
| 2026-11-25 | 6 (+2) | 255 (+1) | 269 (+23) | - | - | - |
| 2026-11-26 | 6 (+2) | 257 (+1) | 294 (+79) | - | 9 (+9) | - |
| 2026-11-27 | 6 (+3) | 257 (+1) | 289 (+55) | - | 3 (+3) | 1 (+1) |
| 2026-11-28 | 4 (+0) | 254 (+0) | 353 (+50) | - | 1 (+1) | - |

**Bans.** A median gap equal to the ban length means the source is re-banned the moment each ban expires.

| Bot | Bans | By kind | Median gap between bans (s) | Busiest hour (UTC) | Ban length |
| --- | ---: | --- | ---: | ---: | --- |
| OAI-SearchBot | 640 | ip 637, agent 2, subnet 1 | 3623 | 04:00 | 10 min |
| GPTBot | 381 | ip 366, group 7, subnet 7, agent 1 | 601 | 04:00 | 10 min |
| ClaudeBot | 29 | ip 14, subnet 7, group 6, agent 2 | 4556 | 04:00 | 10 min |
| non-bot | 6 | agent 2, ip 2, subnet 2 | 1895 | 04:00 | 10 min |

**Section focus.** Evenness runs from 0 (one section only) to 1 (perfectly even). robots.txt, sitemap.xml and favicon.ico are excluded.

| Bot | Content requests | Sections | Top-4 share | Evenness | Top sections |
| --- | ---: | ---: | ---: | ---: | --- |
| ClaudeBot | 161,148 | 38 | 68.6% | 0.61 | learn 78,863, tutorials 12,797, developers 10,585, docs 8,325 |
| GPTBot | 59,044 | 37 | 84.7% | 0.29 | learn 48,980, about 344, blog 341, comparison 320 |
| l9scan | 112 | 25 | 25.0% | 0.98 | api 12, graphql 8, console 4, server 4 |

**Topic focus.** Counts come from /learn/<group>/<topic> page requests; evenness runs from 0 (one topic only) to 1 (perfectly even). Older logs have no topic data, so this grows as new logs arrive. 12 of these counts come from the one-time backfill of old logs' last paths (marked topics_backfilled in the logs).

| Bot | Topic requests | Topics | Top-4 share | Evenness | Top topics |
| --- | ---: | ---: | ---: | ---: | --- |
| ClaudeBot | 78,867 | 34 | 65.0% | 0.64 | python-programming 25,136, javascript 10,933, debugging-code 10,409, no-code-low-code 4,754 |
| GPTBot | 48,989 | 100 | 8.6% | 0.99 | data-privacy 1,949, mobile-app-development 986, cooking-and-recipes 668, game-development 610 |

## Crawl funnel

Requests at each step of the discovery path; the percentage is the share of the previous step that reached this one. Homepage hits are served requests with no section recorded (overwhelmingly the root path). The steps are request volumes, not sessions: a bot can fetch the sitemap without asking for robots.txt, or walk section pages without visiting the homepage, so a later step can exceed the one before it. Clicked and direct are shares of all served hits. The steps are section-based counts: the /learn/ step is the learn section count, counted separately from the topic-request counter behind Topic focus, so the two figures need not match.

| Bot | robots.txt | sitemap.xml | Homepage | Section pages | /learn/ pages | Clicked | Direct |
| --- | ---: | ---: | ---: | ---: | ---: | ---: | ---: |
| ClaudeBot | 20,031 | 13,129 (65.5%) | 1,305 (9.9%) | 82,285 (6305.4%) | 78,863 (95.8%) | 0 (0.0%) | 195,613 (100.0%) |
| OAI-SearchBot | 195,126 | 0 (0.0%) | 0 (0%) | 0 (0%) | 0 (0%) | 0 (0.0%) | 195,126 (100.0%) |
| GPTBot | 1 | 9,235 (923500.0%) | 87 (0.9%) | 10,064 (11567.8%) | 48,980 (486.7%) | 52,549 (76.7%) | 15,951 (23.3%) |
| l9scan | 0 | 0 (0%) | 16 (0%) | 112 (700.0%) | 0 (0.0%) | 0 (0.0%) | 128 (100.0%) |
| Applebot | 22 | 0 (0.0%) | 2 (0%) | 94 (4700.0%) | 0 (0.0%) | 0 (0.0%) | 118 (100.0%) |
| Googlebot | 1 | 0 (0.0%) | 10 (0%) | 8 (80.0%) | 0 (0.0%) | 9 (37.5%) | 15 (62.5%) |

**Topic groups.** Requests by topic group, across all visitors.

| Group | Requests | Share | Top bots |
| --- | ---: | ---: | --- |
| programming-and-software | 75,261 | 58.1% | ClaudeBot 69,927, GPTBot 5,180 |
| data-and-analytics | 12,512 | 9.7% | ClaudeBot 6,532, GPTBot 5,805 |
| cloud-security-and-it | 7,204 | 5.6% | GPTBot 4,563, ClaudeBot 2,398 |
| life-home-and-hobbies | 5,469 | 4.2% | GPTBot 5,333, non-bot 136 |
| career-and-professional-skills | 5,072 | 3.9% | GPTBot 4,923, non-bot 149 |
| health-fitness-and-wellness | 4,854 | 3.7% | GPTBot 4,716, non-bot 138 |
| school-science-and-knowledge | 4,845 | 3.7% | GPTBot 4,696, non-bot 147 |
| creative-design-and-media | 4,787 | 3.7% | GPTBot 4,637, non-bot 150 |
| ai-and-machine-learning | 4,761 | 3.7% | GPTBot 4,583, non-bot 170 |
| business-marketing-and-finance | 4,700 | 3.6% | GPTBot 4,553, non-bot 147 |

**robots.txt violations.** Requests that ignored a Disallow: crawling while banned (a banned visitor's robots.txt says Disallow: / for the ban duration), or fetching /admin/, /cart/ or /api/, which the public robots.txt disallows. The /robots.txt fetch itself never counts. Older logs have no violation data, so this grows as new logs arrive.

| Bot | Violations | Share | Banned requests |
| --- | ---: | ---: | ---: |
| GPTBot | 390,343 | 93.4% | 677,485 |
| ClaudeBot | 27,241 | 6.5% | 45,117 |
| non-bot | 163 | 0.0% | 0 |
| non-bot | 31 | 0.0% | 0 |
| non-bot | 23 | 0.0% | 0 |
| non-bot | 16 | 0.0% | 0 |
| non-bot | 15 | 0.0% | 0 |
| non-bot | 13 | 0.0% | 7 |
| non-bot | 7 | 0.0% | 0 |
| non-bot | 3 | 0.0% | 0 |
| non-bot | 3 | 0.0% | 0 |
| non-bot | 3 | 0.0% | 0 |
| non-bot | 3 | 0.0% | 0 |
| non-bot | 2 | 0.0% | 0 |
| non-bot | 2 | 0.0% | 68 |
| non-bot | 2 | 0.0% | 0 |
| non-bot | 1 | 0.0% | 0 |
| non-bot | 1 | 0.0% | 68 |
| non-bot | 1 | 0.0% | 0 |
| non-bot | 1 | 0.0% | 0 |
| non-bot | 1 | 0.0% | 0 |
| non-bot | 1 | 0.0% | 0 |
| non-bot | 1 | 0.0% | 0 |

## Hits by domain

Per-host counting covers 251,888 of 497,365 served hits (50.6%). Older logs have no hostname data, so this grows as new logs arrive.

**By base domain** (last two labels, so a few multi-part suffixes may group oddly)

| Domain | Hostnames | Served | During bans | Top bots (served) |
| --- | ---: | ---: | ---: | --- |
| `nishad.top` | 2006 | 216,519 | 317,734 | ClaudeBot 94,431, OAI-SearchBot 78,050, non-bot 35,164 |
| `chickenkiller.com` | 2 | 16,903 | 10,163 | ClaudeBot 14,807, GPTBot 1,447, non-bot 647 |
| `twilightparadox.com` | 1 | 15,620 | 9,709 | ClaudeBot 13,309, GPTBot 1,382, non-bot 927 |
| `mooo.com` | 1 | 2,819 | 2,028 | GPTBot 1,413, non-bot 809, ClaudeBot 595 |
| `crabdance.com` | 1 | 15 | 0 | non-bot 15 |
| `0.1` | 1 | 10 | 0 | non-bot 10 |
| `my.to` | 1 | 2 | 0 | non-bot 2 |

**Busiest hostnames**

| Hostname | Served | During bans | Top bots (served) |
| --- | ---: | ---: | --- |
| `news.nishad.top` | 188,056 | 301,640 | ClaudeBot 80,554, OAI-SearchBot 77,751, non-bot 23,234 |
| `cleo.chickenkiller.com` | 16,890 | 10,163 | ClaudeBot 14,807, GPTBot 1,447, non-bot 634 |
| `recorded.twilightparadox.com` | 15,620 | 9,709 | ClaudeBot 13,309, GPTBot 1,382, non-bot 927 |
| `database-zone.nishad.top` | 4,761 | 3,360 | ClaudeBot 4,760, non-bot 1 |
| `kamka.mooo.com` | 2,819 | 2,028 | GPTBot 1,413, non-bot 809, ClaudeBot 595 |
| `support-base.nishad.top` | 1,538 | 731 | ClaudeBot 1,538 |
| `database-zone-updates.nishad.top` | 892 | 12 | ClaudeBot 887, non-bot 5 |
| `docs.nishad.top` | 400 | 204 | ClaudeBot 390, non-bot 7, GPTBot 3 |
| `database.nishad.top` | 384 | 164 | ClaudeBot 357, non-bot 23, GPTBot 4 |
| `developer.nishad.top` | 285 | 260 | ClaudeBot 284, non-bot 1 |
| `news.app.nishad.top` | 514 | 0 | non-bot 513, Googlebot 1 |
| `appdev.nishad.top` | 469 | 0 | non-bot 469 |
| `metube.nishad.top` | 465 | 0 | non-bot 465 |
| `voicebridge.lab.nishad.top` | 419 | 0 | non-bot 419 |
| `domain-lab.nishad.top` | 325 | 92 | ClaudeBot 319, non-bot 6 |

## Named crawlers

### ClaudeBot

- **Owner:** Amazon.com, Inc. (AS16509), Google LLC (AS396982)
- **Hits:** 195,613 (39.3%) from 12 IP(s) in 5 /16 range(s)
- **/24 ranges (IPs):** `216.73.216.0/24` (3), `216.73.217.0/24` (2), `136.79.143.0/24` (1), `34.152.124.0/24` (1), `34.162.111.0/24` (1), `34.162.153.0/24` (1), `34.162.191.0/24` (1), `34.162.27.0/24` (1), +1 more
- **Vendor range check:** all 12 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 20,031 (10.2%); sitemap.xml: 13,129
- **Requests per IP:** 16,301.1 average
- **Bans:** 161; 45,117 further requests logged while banned
- **robots.txt violations:** 27,241 requests that ignored a Disallow (crawling while banned under Disallow: /, or fetching /admin/, /cart/ or /api/)
- **Top sections:** learn 78,863, robots.txt 20,031, sitemap.xml 13,129, tutorials 12,797, developers 10,585, docs 8,325
- **Top topics:** python-programming 25,136, javascript 10,933, debugging-code 10,409, no-code-low-code 4,754, programming-languages 4,009, web-development 3,384
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; ClaudeBot/1.0; +claudebot@anthropic.com)`

### OAI-SearchBot

- **Owner:** Microsoft Corporation (AS8075)
- **Hits:** 195,126 (39.2%) from 261 IP(s) in 2 /16 range(s)
- **/24 ranges (IPs):** `74.7.230.0/24` (52), `74.7.244.0/24` (52), `74.7.228.0/24` (51), `74.7.241.0/24` (51), `74.7.175.0/24` (50), `51.8.102.0/24` (5)
- **Vendor range check:** all 261 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 195,126 (100.0%); sitemap.xml: 0
- **Requests per IP:** 747.6 average
- **Bans:** 1,309; 185,111 further requests logged while banned
- **Top sections:** robots.txt 195,126
- **User agent:** `Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36; c`

### GPTBot

- **Owner:** Cloudflare, Inc. (AS13335), Fastly, Inc. (AS394192), Microsoft Corporation (AS8075)
- **Hits:** 68,500 (13.8%) from 523 IP(s) in 5 /16 range(s)
- **/24 ranges (IPs):** `132.196.86.0/24` (136), `74.7.227.0/24` (114), `172.182.207.0/24` (59), `172.182.202.0/24` (55), `74.7.241.0/24` (53), `74.7.242.0/24` (52), `74.7.243.0/24` (51), `87.81.224.0/24` (2), +1 more
- **Vendor range check:** 520/523 IPs inside published ranges; **not listed:** `104.29.196.211`, `87.81.224.107`, `87.81.224.64`
- **Link-follow vs direct:** 76.7% followed maze links, 23.3% direct fetches
- **robots.txt requests:** 1 (0.0%); sitemap.xml: 9,235
- **Requests per IP:** 131.0 average
- **Bans:** 464; 677,485 further requests logged while banned
- **robots.txt violations:** 390,343 requests that ignored a Disallow (crawling while banned under Disallow: /, or fetching /admin/, /cart/ or /api/)
- **Top sections:** learn 48,980, sitemap.xml 9,235, about 344, blog 341, comparison 320, platform 310
- **Top topics:** data-privacy 1,949, mobile-app-development 986, cooking-and-recipes 668, game-development 610, relationships-and-communication 606, baking-and-cuisines 604
- **User agent:** `Mozilla/5.0 (compatible; GPTBot/1.2)`

### l9scan

- **Owner:** DigitalOcean, LLC (AS14061)
- **Hits:** 128 (0.0%) from 4 IP(s) in 4 /16 range(s)
- **/24 ranges (IPs):** `138.68.86.0/24` (1), `142.93.129.0/24` (1), `206.189.19.0/24` (1), `68.183.180.0/24` (1)
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 0 (0.0%); sitemap.xml: 0
- **Requests per IP:** 32.0 average
- **Top sections:** api 12, graphql 8, console 4, server 4, server-status 4, about 4
- **User agent:** `Mozilla/5.0 (l9scan/2.0.4363e28383e2331323e2932313; +https://leakix.net)`

### Applebot

- **Owner:** Apple Inc. (AS714)
- **Hits:** 118 (0.0%) from 14 IP(s) in 1 /16 range(s)
- **/24 ranges (IPs):** `17.166.236.0/24` (3), `17.166.150.0/24` (2), `17.166.152.0/24` (1), `17.166.153.0/24` (1), `17.166.21.0/24` (1), `17.166.22.0/24` (1), `17.166.232.0/24` (1), `17.166.233.0/24` (1), +3 more
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 22 (18.6%); sitemap.xml: 0
- **Requests per IP:** 8.4 average
- **Top sections:** robots.txt 22, support 10, status 7, services 5, knowledge-base 5, tools 5
- **User agent:** `Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.4 Safari/605.1.15 (A`

### Googlebot

- **Owner:** AT&T Enterprises, LLC (AS7018), Cloudflare, Inc. (AS13335), Comcast Cable Communications, LLC (AS7922), Cox Communications Inc. (AS22773), Google LLC (AS15169), Google LLC (AS396982), Verizon Business (AS701)
- **Hits:** 24 (0.0%) from 6 IP(s) in 8 /16 range(s)
- **/24 ranges (IPs):** `100.17.230.0/24` (1), `104.56.243.0/24` (1), `66.249.68.0/24` (1), `68.231.29.0/24` (1), `68.60.156.0/24` (1), `99.63.69.0/24` (1)
- **Link-follow vs direct:** 37.5% followed maze links, 62.5% direct fetches
- **robots.txt requests:** 1 (4.2%); sitemap.xml: 0
- **Requests per IP:** 4.0 average
- **Top sections:** favicon.ico 5, wp-json 2, .env.dist 1, .env.save 1, config.yaml 1, wp-includes 1
- **User agent:** `Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)`

### Claude-User

- **Owner:** Google LLC (AS396982)
- **Hits:** 9 (0.0%) from 4 IP(s) in 1 /16 range(s)
- **/24 ranges (IPs):** `160.79.106.0/24` (4)
- **Vendor range check:** 0/4 IPs inside published ranges; **not listed:** `160.79.106.128`, `160.79.106.137`, `160.79.106.138`, `160.79.106.139`
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 4 (44.4%); sitemap.xml: 0
- **Requests per IP:** 2.2 average
- **Top sections:** robots.txt 4
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; Claude-User/1.0; +claude-user@anthropic.com)`

### ChatGPT-User

- **Owner:** Cloudflare, Inc. (AS13335), Microsoft Corporation (AS8075)
- **Hits:** 5 (0.0%) from 3 IP(s) in 2 /16 range(s)
- **/24 ranges (IPs):** `104.28.222.0/24` (1), `104.28.254.0/24` (1), `20.125.144.0/24` (1)
- **Vendor range check:** 1/3 IPs inside published ranges; **not listed:** `104.28.222.133`, `104.28.254.134`
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 0 (0.0%); sitemap.xml: 0
- **Requests per IP:** 1.7 average
- **Top sections:** wp-config.php.bak 1, config.php.bak 1
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko); compatible; ChatGPT-User/1.0; +https://openai.com/bot`

## Hits by network owner

| Owner | Hits | Share | /16s | IPs | Top ranges |
| --- | ---: | ---: | ---: | ---: | --- |
| Microsoft Corporation (AS8075) | 264,719 | 53.2% | 27 | 810 | `74.7.0.0/16`, `132.196.0.0/16`, `172.182.0.0/16`, `20.219.0.0/16` |
| Amazon.com, Inc. (AS16509) | 196,153 | 39.4% | 58 | 73 | `216.73.0.0/16`, `18.217.0.0/16`, `74.220.0.0/16`, `13.52.0.0/16` |
| Google LLC (AS396982) | 10,081 | 2.0% | 135 | 225 | `34.154.0.0/16`, `34.96.0.0/16`, `34.79.0.0/16`, `34.62.0.0/16` |
| UCLOUD INFORMATION TECHNOLOGY (HK) LIMITED (AS135377) | 4,581 | 0.9% | 4 | 8 | `152.32.0.0/16`, `154.51.0.0/16`, `103.218.0.0/16`, `123.58.0.0/16` |
| Tencent Building, Kejizhongyi Avenue (AS132203) | 2,469 | 0.5% | 35 | 236 | `43.157.0.0/16`, `43.166.0.0/16`, `43.153.0.0/16`, `43.133.0.0/16` |
| Amazon.com, Inc. (AS14618) | 2,453 | 0.5% | 234 | 720 | `184.198.0.0/16`, `44.204.0.0/16`, `32.197.0.0/16`, `100.54.0.0/16` |
| Techoff Srv Limited (AS48090) | 1,984 | 0.4% | 3 | 11 | `195.178.0.0/16`, `45.148.0.0/16`, `93.123.0.0/16` |
| AGOTOZ PTE. LTD. (AS9465) | 1,393 | 0.3% | 1 | 7 | `156.225.0.0/16` |
| Facebook, Inc. (AS32934) | 1,314 | 0.3% | 4 | 144 | `173.252.0.0/16`, `69.63.0.0/16`, `69.171.0.0/16`, `57.141.0.0/16` |
| Tc Datacenter Limited (AS218785) | 963 | 0.2% | 2 | 9 | `45.138.0.0/16`, `185.218.0.0/16` |
| DigitalOcean, LLC (AS14061) | 656 | 0.1% | 52 | 112 | `146.190.0.0/16`, `68.183.0.0/16`, `178.128.0.0/16`, `206.189.0.0/16` |
| Alibaba (US) Technology Co., Ltd. (AS45102) | 655 | 0.1% | 14 | 51 | `43.106.0.0/16`, `8.218.0.0/16`, `47.84.0.0/16`, `43.98.0.0/16` |
| Cablevision Systems Corp. (AS6128) | 550 | 0.1% | 4 | 6 | `47.17.0.0/16`, `69.115.0.0/16`, `67.87.0.0/16`, `69.121.0.0/16` |
| OVH SAS (AS16276) | 539 | 0.1% | 24 | 32 | `158.69.0.0/16`, `135.125.0.0/16`, `51.79.0.0/16`, `57.131.0.0/16` |
| Team Blue Carrier Limited (AS34282) | 507 | 0.1% | 1 | 2 | `85.92.0.0/16` |
| Cloudflare, Inc. (AS13335) | 505 | 0.1% | 2 | 33 | `104.29.0.0/16`, `104.28.0.0/16` |
| M247 Europe SRL (AS9009) | 486 | 0.1% | 13 | 57 | `146.70.0.0/16`, `103.4.0.0/16`, `104.253.0.0/16`, `104.239.0.0/16` |
| CHINANET Guangdong province network (AS58466) | 435 | 0.1% | 1 | 5 | `106.75.0.0/16` |
| NTT America, Inc. (AS2914) | 432 | 0.1% | 1 | 10 | `216.167.0.0/16` |
| CustodianDC Limited (AS50300) | 355 | 0.1% | 1 | 3 | `5.102.0.0/16` |
| GitHub, Inc. (AS36459) | 323 | 0.1% | 1 | 15 | `140.82.0.0/16` |
| HostPapa (AS36352) | 243 | 0.0% | 13 | 35 | `23.94.0.0/16`, `107.173.0.0/16`, `107.172.0.0/16`, `107.175.0.0/16` |
| Fastly, Inc. (AS394192) | 235 | 0.0% | 1 | 191 | `87.81.0.0/16` |
| BestDC Limited (AS216014) | 190 | 0.0% | 1 | 1 | `193.47.0.0/16` |
| WholeSale Internet, Inc. (AS32097) | 188 | 0.0% | 1 | 1 | `23.128.0.0/16` |
| VPS Dedicated LLC (AS197769) | 185 | 0.0% | 1 | 2 | `102.220.0.0/16` |
| GTT Communications Inc. (AS3257) | 180 | 0.0% | 2 | 5 | `70.39.0.0/16`, `216.36.0.0/16` |
| Datacamp Limited (AS212238) | 176 | 0.0% | 24 | 73 | `205.188.0.0/16`, `64.137.0.0/16`, `169.150.0.0/16`, `84.233.0.0/16` |
| Eweka Internet Services B.V. (AS34343) | 173 | 0.0% | 2 | 5 | `81.171.0.0/16`, `91.148.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS203020) | 172 | 0.0% | 19 | 55 | `45.92.0.0/16`, `31.209.0.0/16`, `155.94.0.0/16`, `161.123.0.0/16` |
| 1337 Services GmbH (AS210558) | 166 | 0.0% | 2 | 3 | `45.94.0.0/16`, `185.19.0.0/16` |
| Scaleway SAS (AS12876) | 152 | 0.0% | 5 | 15 | `51.158.0.0/16`, `151.115.0.0/16`, `62.210.0.0/16`, `51.159.0.0/16` |
| Censys, Inc. (AS398324) | 139 | 0.0% | 1 | 7 | `66.132.0.0/16` |
| Apple Inc. (AS714) | 119 | 0.0% | 2 | 15 | `17.166.0.0/16`, `17.183.0.0/16` |
| CtrlS (AS18229) | 113 | 0.0% | 1 | 2 | `45.249.0.0/16` |
| Akamai Connected Cloud (AS63949) | 110 | 0.0% | 19 | 45 | `172.236.0.0/16`, `45.79.0.0/16`, `66.228.0.0/16`, `172.239.0.0/16` |
| Colocation America Corporation (AS47007) | 100 | 0.0% | 1 | 1 | `173.46.0.0/16` |
| TechTies Inc. (AS197170) | 90 | 0.0% | 3 | 7 | `85.11.0.0/16`, `91.92.0.0/16`, `94.26.0.0/16` |
| Oracle Corporation (AS31898) | 86 | 0.0% | 6 | 7 | `129.213.0.0/16`, `141.148.0.0/16`, `145.241.0.0/16`, `129.121.0.0/16` |
| Hetzner Online GmbH (AS24940) | 85 | 0.0% | 16 | 24 | `204.168.0.0/16`, `88.198.0.0/16`, `91.98.0.0/16`, `116.202.0.0/16` |
| Virtual Systems LLC (AS6698) | 77 | 0.0% | 2 | 2 | `91.218.0.0/16`, `85.137.0.0/16` |
| B2 Net Solutions Inc. (AS55286) | 75 | 0.0% | 10 | 43 | `38.154.0.0/16`, `152.232.0.0/16`, `192.241.0.0/16`, `23.236.0.0/16` |
| T-Mobile USA, Inc. (AS21928) | 75 | 0.0% | 3 | 9 | `172.56.0.0/16`, `172.59.0.0/16`, `172.58.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS207990) | 74 | 0.0% | 13 | 38 | `83.229.0.0/16`, `217.194.0.0/16`, `203.166.0.0/16`, `213.255.0.0/16` |
| EGIHosting (AS18779) | 71 | 0.0% | 7 | 32 | `23.27.0.0/16`, `104.165.0.0/16`, `172.120.0.0/16`, `166.88.0.0/16` |
| Web2Objects LLC (AS62874) | 64 | 0.0% | 3 | 20 | `142.147.0.0/16`, `104.238.0.0/16`, `45.56.0.0/16` |
| Hangzhou Alibaba Advertising Co.,Ltd. (AS37963) | 64 | 0.0% | 10 | 13 | `8.163.0.0/16`, `8.148.0.0/16`, `121.196.0.0/16`, `47.114.0.0/16` |
| LogicWeb Inc. (AS64286) | 63 | 0.0% | 5 | 20 | `149.57.0.0/16`, `154.6.0.0/16`, `64.64.0.0/16`, `173.239.0.0/16` |
| CHINA UNICOM China169 Backbone (AS4837) | 61 | 0.0% | 6 | 11 | `113.232.0.0/16`, `113.224.0.0/16`, `153.0.0.0/16`, `113.233.0.0/16` |
| Driftnet Ltd (AS211298) | 57 | 0.0% | 3 | 28 | `195.96.0.0/16`, `87.236.0.0/16`, `185.247.0.0/16` |
| Unidentified | 51 | 0.0% | 11 | 11 | `172.18.0.0/16`, `127.0.0.0/16`, `121.76.0.0/16`, `141.97.0.0/16` |
| Dedik Services Limited (AS209413) | 51 | 0.0% | 1 | 1 | `176.65.0.0/16` |
| The Constant Company, LLC (AS20473) | 48 | 0.0% | 8 | 9 | `137.220.0.0/16`, `45.32.0.0/16`, `192.248.0.0/16`, `45.63.0.0/16` |
| Charter Communications LLC (AS20115) | 48 | 0.0% | 10 | 23 | `198.138.0.0/16`, `74.112.0.0/16`, `199.58.0.0/16`, `45.58.0.0/16` |
| Comcast Cable Communications, LLC (AS7922) | 46 | 0.0% | 27 | 34 | `48.46.0.0/16`, `48.45.0.0/16`, `48.44.0.0/16`, `68.60.0.0/16` |
| WebWorld (AS30900) | 40 | 0.0% | 3 | 16 | `82.23.0.0/16`, `82.29.0.0/16`, `82.25.0.0/16` |
| NetLab Global (AS979) | 37 | 0.0% | 2 | 2 | `154.44.0.0/16`, `64.81.0.0/16` |
| Scloud Pte Ltd (AS142002) | 37 | 0.0% | 1 | 2 | `165.154.0.0/16` |
| IP Volume inc (AS202425) | 36 | 0.0% | 6 | 11 | `94.102.0.0/16`, `185.242.0.0/16`, `89.248.0.0/16`, `80.82.0.0/16` |
| FiberPower LLC (AS214483) | 36 | 0.0% | 1 | 1 | `23.148.0.0/16` |
| GRUPO PANAGLOBAL 15 S.A (AS264617) | 34 | 0.0% | 4 | 13 | `45.39.0.0/16`, `191.101.0.0/16`, `170.231.0.0/16`, `185.191.0.0/16` |
| Latitude.sh (AS396356) | 34 | 0.0% | 4 | 20 | `81.168.0.0/16`, `92.113.0.0/16`, `185.48.0.0/16`, `43.229.0.0/16` |
| Latitude.sh LTDA (AS262287) | 31 | 0.0% | 4 | 15 | `104.252.0.0/16`, `45.38.0.0/16`, `91.123.0.0/16`, `85.198.0.0/16` |
| Leaseweb Canada Inc. (AS32613) | 31 | 0.0% | 2 | 20 | `192.175.0.0/16`, `64.188.0.0/16` |
| SYN LTD (AS64080) | 29 | 0.0% | 6 | 16 | `45.43.0.0/16`, `107.181.0.0/16`, `155.254.0.0/16`, `94.177.0.0/16` |
| Ace Data Centers, Inc. (AS11798) | 29 | 0.0% | 4 | 20 | `142.111.0.0/16`, `23.26.0.0/16`, `50.114.0.0/16`, `185.216.0.0/16` |
| LeaseWeb Netherlands B.V. (AS60781) | 28 | 0.0% | 5 | 13 | `145.223.0.0/16`, `148.135.0.0/16`, `193.25.0.0/16`, `82.192.0.0/16` |
| Cox Communications Inc. (AS22773) | 28 | 0.0% | 6 | 12 | `90.96.0.0/16`, `184.181.0.0/16`, `68.231.0.0/16`, `68.102.0.0/16` |
| Evoxt Sdn. Bhd. (AS149440) | 28 | 0.0% | 1 | 1 | `96.126.0.0/16` |
| Psychz Networks (AS40676) | 27 | 0.0% | 3 | 11 | `136.0.0.0/16`, `146.103.0.0/16`, `205.236.0.0/16` |
| Tier.Net Technologies LLC (AS397423) | 27 | 0.0% | 6 | 15 | `31.59.0.0/16`, `198.37.0.0/16`, `31.58.0.0/16`, `173.0.0.0/16` |
| FDCservers.net (AS30058) | 27 | 0.0% | 3 | 12 | `213.169.0.0/16`, `82.108.0.0/16`, `217.117.0.0/16` |
| HostRoyale LLC (AS46516) | 25 | 0.0% | 3 | 14 | `45.41.0.0/16`, `45.61.0.0/16`, `104.232.0.0/16` |
| Limestone Networks, Inc. (AS46475) | 25 | 0.0% | 4 | 9 | `178.20.0.0/16`, `194.99.0.0/16`, `193.151.0.0/16`, `88.218.0.0/16` |
| Alex Largman (AS59651) | 23 | 0.0% | 4 | 11 | `170.168.0.0/16`, `122.8.0.0/16`, `5.181.0.0/16`, `213.232.0.0/16` |
| Modat B.V. (AS209334) | 23 | 0.0% | 1 | 8 | `85.217.0.0/16` |
| Microsoft Azure | 21 | 0.0% | 3 | 5 | `10.0.0.0/16`, `10.234.0.0/16`, `9.8.0.0/16` |
| Hype Enterprises (AS13332) | 21 | 0.0% | 4 | 13 | `206.206.0.0/16`, `67.227.0.0/16`, `216.74.0.0/16`, `174.140.0.0/16` |
| Comcast Cable Communications, LLC (AS33659) | 20 | 0.0% | 2 | 8 | `138.226.0.0/16`, `170.100.0.0/16` |
| Getechbrothers, MB (AS202044) | 19 | 0.0% | 3 | 10 | `216.173.0.0/16`, `104.233.0.0/16`, `104.143.0.0/16` |
| Charter Communications Inc (AS11426) | 19 | 0.0% | 4 | 10 | `108.59.0.0/16`, `175.29.0.0/16`, `62.72.0.0/16`, `94.103.0.0/16` |
| Lancom Ltd. (AS199081) | 19 | 0.0% | 1 | 8 | `92.112.0.0/16` |
| Chinanet (AS4134) | 18 | 0.0% | 8 | 10 | `123.160.0.0/16`, `171.217.0.0/16`, `49.87.0.0/16`, `1.183.0.0/16` |
| Cogent Communications, LLC (AS174) | 18 | 0.0% | 7 | 15 | `154.21.0.0/16`, `154.9.0.0/16`, `151.241.0.0/16`, `154.12.0.0/16` |
| Cablevision Lightpath LLC (AS54004) | 18 | 0.0% | 1 | 7 | `74.48.0.0/16` |
| Yanoor Islam Khan (AS213186) | 18 | 0.0% | 1 | 1 | `98.142.0.0/16` |
| AT&T Enterprises, LLC (AS7018) | 17 | 0.0% | 15 | 15 | `104.56.0.0/16`, `99.63.0.0/16`, `107.206.0.0/16`, `108.79.0.0/16` |
| Turk Telekom (AS9121) | 17 | 0.0% | 2 | 2 | `212.156.0.0/16`, `95.3.0.0/16` |
| Verizon Business (AS701) | 16 | 0.0% | 10 | 10 | `100.17.0.0/16`, `108.39.0.0/16`, `65.206.0.0/16`, `71.111.0.0/16` |
| eTOP sp. z o.o. (AS20853) | 16 | 0.0% | 2 | 9 | `46.203.0.0/16`, `104.222.0.0/16` |
| Internet Resources Management SRL (AS48955) | 16 | 0.0% | 7 | 12 | `188.214.0.0/16`, `89.40.0.0/16`, `188.213.0.0/16`, `193.176.0.0/16` |
| GLOBAL COMMUNICATION NETWORK LIMITED (AS152179) | 15 | 0.0% | 3 | 8 | `13.143.0.0/16`, `2.26.0.0/16`, `31.77.0.0/16` |
| UAB code200 (AS203061) | 15 | 0.0% | 1 | 9 | `189.81.0.0/16` |
| Level 3 Parent, LLC (AS3356) | 15 | 0.0% | 1 | 10 | `205.169.0.0/16` |
| Colocation America Corporation (AS21769) | 14 | 0.0% | 5 | 11 | `184.174.0.0/16`, `104.224.0.0/16`, `45.127.0.0/16`, `173.211.0.0/16` |
| SYN LTD (AS50077) | 14 | 0.0% | 1 | 8 | `185.135.0.0/16` |
| Xneelo (Pty) Ltd (AS37153) | 14 | 0.0% | 1 | 8 | `82.22.0.0/16` |
| Hosting Ukraine LTD (AS200525) | 13 | 0.0% | 1 | 2 | `104.250.0.0/16` |
| Fast Servers (Pty) Ltd (AS35830) | 13 | 0.0% | 2 | 8 | `130.49.0.0/16`, `45.66.0.0/16` |
| British Telecommunications Limited (AS2856) | 13 | 0.0% | 2 | 6 | `31.121.0.0/16`, `151.245.0.0/16` |
| Global Transit Systems LLC (AS213954) | 13 | 0.0% | 3 | 7 | `185.201.0.0/16`, `157.22.0.0/16`, `185.168.0.0/16` |
| AltusHost B.V. (AS51430) | 13 | 0.0% | 3 | 6 | `82.24.0.0/16`, `37.46.0.0/16`, `79.142.0.0/16` |
| Windstream Communications LLC (AS7029) | 12 | 0.0% | 5 | 10 | `64.84.0.0/16`, `91.124.0.0/16`, `109.72.0.0/16`, `208.52.0.0/16` |
| Hydra Communications Ltd (AS25369) | 12 | 0.0% | 4 | 10 | `154.16.0.0/16`, `200.138.0.0/16`, `77.67.0.0/16`, `64.205.0.0/16` |
| Sistemas Informaticos, S.A. (AS211680) | 12 | 0.0% | 1 | 2 | `45.156.0.0/16` |
| Leaseweb USA, Inc. (AS395954) | 11 | 0.0% | 5 | 11 | `89.249.0.0/16`, `208.70.0.0/16`, `212.42.0.0/16`, `185.202.0.0/16` |
| Leaseweb USA, Inc. (AS396362) | 11 | 0.0% | 1 | 8 | `2.57.0.0/16` |
| Korea Telecom (AS4766) | 11 | 0.0% | 2 | 2 | `59.14.0.0/16`, `211.230.0.0/16` |
| EN Technologies Pte Ltd (AS133210) | 11 | 0.0% | 1 | 4 | `82.21.0.0/16` |
| BlueVPS OU (AS62005) | 11 | 0.0% | 1 | 7 | `82.26.0.0/16` |
| Owl Limited (AS43357) | 10 | 0.0% | 2 | 2 | `147.78.0.0/16`, `176.119.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS39486) | 10 | 0.0% | 3 | 9 | `171.22.0.0/16`, `194.116.0.0/16`, `193.42.0.0/16` |
| web2objects GmbH (AS50495) | 10 | 0.0% | 4 | 9 | `77.83.0.0/16`, `194.39.0.0/16`, `194.113.0.0/16`, `45.151.0.0/16` |
| Blatant (AS403005) | 10 | 0.0% | 1 | 1 | `64.89.0.0/16` |
| Shenzhen Tencent Computer Systems Company Limited (AS45090) | 9 | 0.0% | 7 | 8 | `49.233.0.0/16`, `119.45.0.0/16`, `119.91.0.0/16`, `146.56.0.0/16` |
| HZ Hosting Ltd (AS59711) | 9 | 0.0% | 2 | 7 | `140.99.0.0/16`, `204.93.0.0/16` |
| Fast Servers (Pty) Ltd (AS43444) | 9 | 0.0% | 1 | 5 | `155.212.0.0/16` |
| Servers.com, Inc. (AS7979) | 9 | 0.0% | 4 | 7 | `172.84.0.0/16`, `45.84.0.0/16`, `23.109.0.0/16`, `45.85.0.0/16` |
| UAB code200 (AS209709) | 9 | 0.0% | 1 | 5 | `185.210.0.0/16` |
| web2objects GmbH (AS204646) | 9 | 0.0% | 2 | 5 | `45.159.0.0/16`, `45.150.0.0/16` |
| Netlen Internet Hizmetleri Ltd. Sti. (AS44620) | 9 | 0.0% | 1 | 1 | `45.74.0.0/16` |
| INCUBATEC GmbH - Srl (AS34081) | 9 | 0.0% | 1 | 3 | `84.33.0.0/16` |
| SONDATECH S.A.S. (AS263812) | 8 | 0.0% | 1 | 3 | `108.165.0.0/16` |
| MEVSPACE sp. z o.o. (AS201814) | 8 | 0.0% | 1 | 1 | `149.50.0.0/16` |
| Leaseweb USA, Inc. (AS393886) | 8 | 0.0% | 1 | 4 | `152.163.0.0/16` |
| Zkillu SAS (AS215599) | 8 | 0.0% | 1 | 1 | `169.40.0.0/16` |
| CORPORACION NACIONAL DE TELECOMUNICACIONES - CNT EP (AS28006) | 8 | 0.0% | 6 | 7 | `181.112.0.0/16`, `181.211.0.0/16`, `181.113.0.0/16`, `186.46.0.0/16` |
| AIS Fibre (AS133481) | 8 | 0.0% | 2 | 3 | `27.130.0.0/16`, `58.136.0.0/16` |
| Palestine Telecommunications Company (PALTEL) (AS12975) | 7 | 0.0% | 4 | 5 | `103.239.0.0/16`, `150.253.0.0/16`, `188.161.0.0/16`, `212.14.0.0/16` |
| GSL Networks Pty LTD (AS137409) | 7 | 0.0% | 6 | 7 | `203.25.0.0/16`, `14.102.0.0/16`, `147.90.0.0/16`, `217.145.0.0/16` |
| QuickPacket, LLC (AS46261) | 7 | 0.0% | 1 | 3 | `154.29.0.0/16` |
| HIVELOCITY, Inc. (AS29802) | 7 | 0.0% | 4 | 6 | `185.101.0.0/16`, `45.87.0.0/16`, `45.91.0.0/16`, `194.38.0.0/16` |
| trafficforce, UAB (AS133944) | 7 | 0.0% | 3 | 5 | `45.141.0.0/16`, `209.35.0.0/16`, `43.245.0.0/16` |
| UAB Bite Lietuva (AS210906) | 7 | 0.0% | 3 | 7 | `217.69.0.0/16`, `89.116.0.0/16`, `86.38.0.0/16` |
| Nexeon Technologies, Inc. (AS20278) | 7 | 0.0% | 1 | 2 | `23.95.0.0/16` |
| PT Telekomunikasi Indonesia (AS7713) | 7 | 0.0% | 2 | 2 | `36.65.0.0/16`, `36.69.0.0/16` |
| Zenlayer Inc (AS21859) | 6 | 0.0% | 1 | 4 | `109.105.0.0/16` |
| SAKURA Internet Inc. (AS7684) | 6 | 0.0% | 1 | 1 | `133.242.0.0/16` |
| Internet Vikings International AB (AS51747) | 6 | 0.0% | 6 | 6 | `151.248.0.0/16`, `192.36.0.0/16`, `192.71.0.0/16`, `193.182.0.0/16` |
| Reliance Jio Infocomm Limited (AS55836) | 6 | 0.0% | 4 | 5 | `152.59.0.0/16`, `152.58.0.0/16`, `49.37.0.0/16`, `49.43.0.0/16` |
| ASLINE LIMITED (AS137951) | 6 | 0.0% | 1 | 1 | `168.76.0.0/16` |
| Charter Communications Inc (AS10796) | 6 | 0.0% | 4 | 4 | `24.33.0.0/16`, `76.35.0.0/16`, `173.91.0.0/16`, `76.39.0.0/16` |
| China Mobile Communications Group Co., Ltd. (AS9808) | 6 | 0.0% | 1 | 4 | `183.204.0.0/16` |
| F.n.s. Holdings Limited (AS206092) | 6 | 0.0% | 2 | 5 | `45.86.0.0/16`, `185.238.0.0/16` |
| Leaseweb Deutschland GmbH (AS28753) | 6 | 0.0% | 3 | 5 | `206.232.0.0/16`, `31.56.0.0/16`, `204.217.0.0/16` |
| ASN for TIANJIN Provincial Net of CT (AS17638) | 6 | 0.0% | 2 | 3 | `221.238.0.0/16`, `221.239.0.0/16` |
| Kaspersky Lab Switzerland GmbH (AS200107) | 6 | 0.0% | 2 | 4 | `93.159.0.0/16`, `77.74.0.0/16` |
| Cyberneticos Hosting SL (AS198968) | 6 | 0.0% | 1 | 4 | `82.27.0.0/16` |
| RCN (AS6079) | 5 | 0.0% | 3 | 4 | `108.171.0.0/16`, `216.133.0.0/16`, `170.124.0.0/16` |
| Rackspace.com Sydney (AS58683) | 5 | 0.0% | 1 | 2 | `119.9.0.0/16` |
| Telefonica de Argentina (AS22927) | 5 | 0.0% | 4 | 4 | `201.177.0.0/16`, `179.41.0.0/16`, `181.20.0.0/16`, `186.128.0.0/16` |
| Blix Solutions AS (AS50304) | 5 | 0.0% | 2 | 3 | `181.214.0.0/16`, `193.138.0.0/16` |
| TOTAL PLAY TELECOMUNICACIONES, S.A.P.I. DE C.V. (AS17072) | 5 | 0.0% | 3 | 3 | `187.189.0.0/16`, `187.188.0.0/16`, `189.203.0.0/16` |
| Leaseweb USA, Inc. (AS27411) | 5 | 0.0% | 1 | 4 | `46.202.0.0/16` |
| 1&1 Versatel GmbH (AS8881) | 5 | 0.0% | 3 | 3 | `89.245.0.0/16`, `89.247.0.0/16`, `89.246.0.0/16` |
| Cyber Internet Services (Pvt) Ltd. (AS9541) | 4 | 0.0% | 3 | 3 | `101.53.0.0/16`, `43.242.0.0/16`, `72.255.0.0/16` |
| Lexistar Alliance Ltd. (AS329225) | 4 | 0.0% | 1 | 3 | `102.212.0.0/16` |
| Philippine Long Distance Telephone Company (AS9299) | 4 | 0.0% | 2 | 2 | `119.93.0.0/16`, `112.209.0.0/16` |
| TM TECHNOLOGY SERVICES SDN. BHD. (AS4788) | 4 | 0.0% | 4 | 4 | `115.135.0.0/16`, `180.75.0.0/16`, `202.188.0.0/16`, `218.111.0.0/16` |
| Cogetel Online, Cambodia, ISP (AS23673) | 4 | 0.0% | 3 | 3 | `202.62.0.0/16`, `124.248.0.0/16`, `203.189.0.0/16` |
| Connect Northwest Internet Services, LLC (AS10557) | 4 | 0.0% | 1 | 3 | `142.252.0.0/16` |
| Leaseweb UK Limited (AS205544) | 4 | 0.0% | 3 | 4 | `37.44.0.0/16`, `176.113.0.0/16`, `185.236.0.0/16` |
| EVEO S.A. (AS53107) | 4 | 0.0% | 1 | 1 | `177.136.0.0/16` |
| Vodafone GmbH (AS3209) | 4 | 0.0% | 2 | 2 | `178.27.0.0/16`, `92.208.0.0/16` |
| JSC Selectel (AS49505) | 4 | 0.0% | 2 | 2 | `91.206.0.0/16`, `188.124.0.0/16` |
| Google LLC (AS15169) | 4 | 0.0% | 3 | 4 | `192.178.0.0/16`, `66.249.0.0/16`, `74.125.0.0/16` |
| Ryamer, LLC (AS400587) | 4 | 0.0% | 1 | 1 | `192.197.0.0/16` |
| NetJoin Srl (AS64445) | 4 | 0.0% | 2 | 3 | `45.83.0.0/16`, `217.198.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS44144) | 4 | 0.0% | 3 | 4 | `84.247.0.0/16`, `31.223.0.0/16`, `45.12.0.0/16` |
| Charter Communications Inc (AS12271) | 4 | 0.0% | 2 | 2 | `47.230.0.0/16`, `98.15.0.0/16` |
| VeriSign Infrastructure & Operations (AS11840) | 4 | 0.0% | 1 | 1 | `72.13.0.0/16` |
| kabelplus GmbH (AS8339) | 4 | 0.0% | 1 | 1 | `81.217.0.0/16` |
| Server Galactic Private Limited (AS150423) | 4 | 0.0% | 2 | 4 | `87.82.0.0/16`, `82.119.0.0/16` |
| WS Telecom Inc (AS213541) | 4 | 0.0% | 1 | 1 | `85.28.0.0/16` |
| Oy Crea Nova Hosting Solution Ltd (AS51765) | 3 | 0.0% | 1 | 3 | `103.99.0.0/16` |
| Office National des Postes et Telecommunications ONPT (Maroc Telecom) / IAM (AS36903) | 3 | 0.0% | 3 | 3 | `105.156.0.0/16`, `196.89.0.0/16`, `41.141.0.0/16` |
| Bharti Airtel Ltd., Telemedia Services (AS24560) | 3 | 0.0% | 3 | 3 | `106.219.0.0/16`, `122.161.0.0/16`, `122.176.0.0/16` |
| Interserver, Inc (AS19318) | 3 | 0.0% | 1 | 1 | `107.148.0.0/16` |
| DZCRD Networks Ltd (AS132817) | 3 | 0.0% | 1 | 2 | `119.42.0.0/16` |
| Google LLC (AS36040) | 3 | 0.0% | 1 | 2 | `136.22.0.0/16` |
| IT7 Networks Inc (AS25820) | 3 | 0.0% | 1 | 1 | `144.34.0.0/16` |
| Sia Nano IT (AS43513) | 3 | 0.0% | 1 | 3 | `150.107.0.0/16` |
| Contabo GmbH (AS51167) | 3 | 0.0% | 2 | 3 | `157.173.0.0/16`, `161.97.0.0/16` |
| China Telecom (AS138169) | 3 | 0.0% | 1 | 1 | `171.111.0.0/16` |
| Code200, UAB (AS149428) | 3 | 0.0% | 1 | 3 | `172.102.0.0/16` |
| Emirates Telecommunications Group Company (etisalat Group) Pjsc (AS5384) | 3 | 0.0% | 3 | 3 | `176.204.0.0/16`, `217.165.0.0/16`, `5.193.0.0/16` |
| UNIFIQUE TELECOMUNICACOES S/A (AS28343) | 3 | 0.0% | 1 | 1 | `186.232.0.0/16` |
| DB3 SERVICOS DE TELECOMUNICACOES S.A (AS28598) | 3 | 0.0% | 3 | 3 | `187.120.0.0/16`, `201.20.0.0/16`, `45.179.0.0/16` |
| Hostinger Operations UAB (AS47583) | 3 | 0.0% | 2 | 2 | `45.13.0.0/16`, `187.124.0.0/16` |
| Kyivstar PJSC (AS15895) | 3 | 0.0% | 1 | 1 | `188.163.0.0/16` |
| Keminet SHPK (AS197706) | 3 | 0.0% | 2 | 3 | `188.68.0.0/16`, `31.171.0.0/16` |
| Realcloud OU (AS206804) | 3 | 0.0% | 1 | 1 | `192.159.0.0/16` |
| Cyberzone S.A. (AS209854) | 3 | 0.0% | 2 | 2 | `45.95.0.0/16`, `193.56.0.0/16` |
| Glesys Sweden AB (AS42708) | 3 | 0.0% | 2 | 2 | `85.203.0.0/16`, `194.14.0.0/16` |
| ONYPHE SAS (AS213412) | 3 | 0.0% | 3 | 3 | `195.184.0.0/16`, `91.230.0.0/16`, `91.231.0.0/16` |
| Leaseweb USA, Inc. (AS394380) | 3 | 0.0% | 1 | 2 | `199.180.0.0/16` |
| Uzbektelekom Joint Stock Company (AS8193) | 3 | 0.0% | 2 | 2 | `213.230.0.0/16`, `84.54.0.0/16` |
| tzulo, inc. (AS11878) | 3 | 0.0% | 1 | 1 | `23.234.0.0/16` |
| Link3 Technologies Ltd. (AS23688) | 3 | 0.0% | 1 | 2 | `27.147.0.0/16` |
| JSC Ukrtelecom (AS6849) | 3 | 0.0% | 2 | 2 | `46.201.0.0/16`, `37.55.0.0/16` |
| ELXIRE (AS153252) | 3 | 0.0% | 1 | 1 | `45.115.0.0/16` |
| Surwitel Comunicaciones, S.l. (AS215927) | 3 | 0.0% | 1 | 2 | `5.252.0.0/16` |
| INEA sp. z o.o. (AS13110) | 3 | 0.0% | 1 | 1 | `77.65.0.0/16` |
| SOCIETE NATIONALE DES TELECOMMUNICATIONS (Tunisie Telecom) (AS327934) | 2 | 0.0% | 1 | 1 | `102.152.0.0/16` |
| Airtel Networks Kenya Limited (AS36926) | 2 | 0.0% | 2 | 2 | `102.216.0.0/16`, `154.79.0.0/16` |
| Chittagong multi channel limited, (AS137029) | 2 | 0.0% | 1 | 1 | `103.102.0.0/16` |
| PT Cyberindo Aditama (AS4787) | 2 | 0.0% | 1 | 2 | `103.111.0.0/16` |
| Antaranga Dot Com Ltd (AS132298) | 2 | 0.0% | 2 | 2 | `103.133.0.0/16`, `103.135.0.0/16` |
| Smart Online (AS139813) | 2 | 0.0% | 1 | 1 | `103.145.0.0/16` |
| Varendra IT (AS151391) | 2 | 0.0% | 1 | 1 | `103.150.0.0/16` |
| Juweriyah Networks Private Limited (AS138296) | 2 | 0.0% | 1 | 1 | `103.179.0.0/16` |
| UNIVISION LLC (AS17882) | 2 | 0.0% | 1 | 1 | `103.212.0.0/16` |
| HZ Hosting Ltd (AS202015) | 2 | 0.0% | 1 | 1 | `103.228.0.0/16` |
| Comilla Online (AS133443) | 2 | 0.0% | 1 | 1 | `103.229.0.0/16` |
| Adeo Datacenter ApS (AS202914) | 2 | 0.0% | 1 | 2 | `103.37.0.0/16` |
| Sky Broadband Pvt. Ltd (AS136908) | 2 | 0.0% | 1 | 1 | `103.96.0.0/16` |
| Wave Broadband (AS11404) | 2 | 0.0% | 1 | 2 | `104.164.0.0/16` |
| BIZNET NETWORKS (AS17451) | 2 | 0.0% | 2 | 2 | `112.78.0.0/16`, `45.126.0.0/16` |
| Rangs Nilu Square, 5th Floor, House 75, Road 5/A, Dhanmondi R/A, Dhaka 1209 (AS7565) | 2 | 0.0% | 1 | 1 | `113.11.0.0/16` |
| FPT Telecom Company (AS18403) | 2 | 0.0% | 2 | 2 | `113.22.0.0/16`, `42.114.0.0/16` |
| ANGKOR DATA COMMUNICATION (AS38235) | 2 | 0.0% | 2 | 2 | `116.212.0.0/16`, `203.147.0.0/16` |
| PPCTV broadband service is the first cable and DSL internet in Cambodia (AS38286) | 2 | 0.0% | 1 | 1 | `122.252.0.0/16` |
| Google Fiber Inc. (AS16591) | 2 | 0.0% | 2 | 2 | `136.38.0.0/16`, `136.53.0.0/16` |
| Giganet Comunicacoes Multimidia Ltda (AS263487) | 2 | 0.0% | 1 | 1 | `143.255.0.0/16` |
| Breezeline (AS11776) | 2 | 0.0% | 2 | 2 | `146.168.0.0/16`, `23.245.0.0/16` |
| PureVoltage Hosting Inc. (AS26548) | 2 | 0.0% | 2 | 2 | `146.19.0.0/16`, `77.220.0.0/16` |
| Wind Tre S.p.A. (AS1267) | 2 | 0.0% | 1 | 1 | `151.56.0.0/16` |
| CONNECT 3 (AS138548) | 2 | 0.0% | 1 | 2 | `157.15.0.0/16` |
| ENEL S.p.A (AS202098) | 2 | 0.0% | 1 | 1 | `158.47.0.0/16` |
| Proton AG (AS208172) | 2 | 0.0% | 1 | 1 | `159.26.0.0/16` |
| Performive LLC (AS46562) | 2 | 0.0% | 2 | 2 | `162.253.0.0/16`, `192.252.0.0/16` |
| LINKFIRE TELECOM LTDA (AS265204) | 2 | 0.0% | 1 | 1 | `167.250.0.0/16` |
| BL Networks (AS399629) | 2 | 0.0% | 2 | 2 | `168.100.0.0/16`, `206.188.0.0/16` |
| Fusiora OU (AS214693) | 2 | 0.0% | 1 | 1 | `169.128.0.0/16` |
| Earthlink Telecommunications Equipment Trading & Services DMCC (AS199739) | 2 | 0.0% | 1 | 2 | `169.224.0.0/16` |
| Uniti Fiber Holdings Inc. (AS13760) | 2 | 0.0% | 1 | 1 | `170.249.0.0/16` |
| True Online (AS17552) | 2 | 0.0% | 1 | 1 | `171.96.0.0/16` |
| Rogers Communications Canada Inc. (AS812) | 2 | 0.0% | 1 | 1 | `173.32.0.0/16` |
| LLC Multiservice (AS52043) | 2 | 0.0% | 1 | 1 | `176.124.0.0/16` |
| UFINET PANAMA S.A. (AS52468) | 2 | 0.0% | 2 | 2 | `177.234.0.0/16`, `190.60.0.0/16` |
| Natel Telecom Ltda. - ME (AS262468) | 2 | 0.0% | 1 | 1 | `177.53.0.0/16` |
| O2 Czech Republic, a.s. (AS41046) | 2 | 0.0% | 1 | 1 | `178.72.0.0/16` |
| Space Exploration Technologies Corporation (AS14593) | 2 | 0.0% | 1 | 1 | `179.65.0.0/16` |
| Comfort XXI Century Ltd. (AS204144) | 2 | 0.0% | 1 | 1 | `185.112.0.0/16` |
| Energy Bridge Sarl (AS56902) | 2 | 0.0% | 1 | 1 | `185.128.0.0/16` |
| 31173 Services AB (AS39351) | 2 | 0.0% | 2 | 2 | `185.209.0.0/16`, `185.213.0.0/16` |
| Dialnet de Colombia S.A. E.S.P. (AS27837) | 2 | 0.0% | 1 | 1 | `186.1.0.0/16` |
| BRASIL TECPAR AMIGO AVATO (AS262907) | 2 | 0.0% | 2 | 2 | `186.195.0.0/16`, `187.84.0.0/16` |
| SERVICIOS DE TELECOMUNICACIONES SETEL S.A. (XTRIM EC) (AS14522) | 2 | 0.0% | 1 | 1 | `186.66.0.0/16` |
| Mega Cable, S.A. de C.V. (AS13999) | 2 | 0.0% | 2 | 2 | `187.244.0.0/16`, `201.165.0.0/16` |
| UNINET (AS8151) | 2 | 0.0% | 1 | 1 | `189.179.0.0/16` |
| INTERNET CORDOBA S.A.S (AS270099) | 2 | 0.0% | 1 | 1 | `190.109.0.0/16` |
| COLOMBIA TELECOMUNICACIONES S.A. ESP BIC (AS3816) | 2 | 0.0% | 1 | 1 | `190.66.0.0/16` |
| Leaseweb USA, Inc. (AS396190) | 2 | 0.0% | 1 | 1 | `191.96.0.0/16` |
| Cincinnati Bell Telephone Company LLC (AS6181) | 2 | 0.0% | 2 | 2 | `192.24.0.0/16`, `208.102.0.0/16` |
| UAB Baltnetos komunikacijos (AS213772) | 2 | 0.0% | 1 | 2 | `193.187.0.0/16` |
| O.m.c. Computers & Communications Ltd (AS44709) | 2 | 0.0% | 2 | 2 | `194.36.0.0/16`, `79.108.0.0/16` |
| Naukowa I Akademicka Siec Komputerowa - Panstwowy Instytut Badawczy (AS8308) | 2 | 0.0% | 1 | 1 | `195.164.0.0/16` |
| Web Telecom Services (PTY) Ltd (AS328029) | 2 | 0.0% | 1 | 1 | `196.61.0.0/16` |
| 3S INF (AS37671) | 2 | 0.0% | 1 | 1 | `197.15.0.0/16` |
| Clouvider Limited (AS62240) | 2 | 0.0% | 1 | 2 | `200.162.0.0/16` |
| BIA PADUA INTERNET E S.C.M. LTDA (AS262519) | 2 | 0.0% | 1 | 1 | `201.131.0.0/16` |
| Hathway IP Over Cable Internet (AS17488) | 2 | 0.0% | 2 | 2 | `210.18.0.0/16`, `27.4.0.0/16` |
| Vivacom Bulgaria EAD (AS8866) | 2 | 0.0% | 1 | 1 | `212.25.0.0/16` |
| Webhosting Holdings LLC (AS965) | 2 | 0.0% | 1 | 2 | `23.129.0.0/16` |
| Spetsnet LLC (AS44019) | 2 | 0.0% | 1 | 1 | `31.128.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS204287) | 2 | 0.0% | 2 | 2 | `31.98.0.0/16`, `86.104.0.0/16` |
| ONETECH SERVICOS DE COMUNICACAO E MULTIMIDIA LTDA (AS269501) | 2 | 0.0% | 1 | 1 | `38.43.0.0/16` |
| GALAXY ENTERTAINMENT DE VENEZUELA, S.C.A. (AS263806) | 2 | 0.0% | 1 | 1 | `38.74.0.0/16` |
| Gujarat Telelink Pvt Ltd (AS45916) | 2 | 0.0% | 2 | 2 | `43.241.0.0/16`, `43.250.0.0/16` |
| Doornet sa de cv (AS28433) | 2 | 0.0% | 1 | 1 | `45.174.0.0/16` |
| Sino Worldwide Trading Limited (AS211443) | 2 | 0.0% | 1 | 1 | `46.151.0.0/16` |
| Super Cell Network For Internet Services Ltd (AS201749) | 2 | 0.0% | 1 | 1 | `5.175.0.0/16` |
| Joint stock company For (AS48642) | 2 | 0.0% | 1 | 1 | `5.199.0.0/16` |
| Pishgaman Toseeh Ertebatat Company (Private Joint Stock) (AS49100) | 2 | 0.0% | 1 | 1 | `5.202.0.0/16` |
| Digicel Jamaica (AS40786) | 2 | 0.0% | 1 | 1 | `63.143.0.0/16` |
| Cipherkey Exchange Corp. (AS25668) | 2 | 0.0% | 1 | 1 | `65.110.0.0/16` |
| Hulum Almustakbal Company for Communication Engineering and Services Ltd (AS203214) | 2 | 0.0% | 1 | 2 | `65.20.0.0/16` |
| CariNet, Inc. (AS10439) | 2 | 0.0% | 1 | 1 | `71.6.0.0/16` |
| University of Illinois (AS40387) | 2 | 0.0% | 1 | 1 | `72.36.0.0/16` |
| Lanet Network Ltd (AS49332) | 2 | 0.0% | 1 | 1 | `80.243.0.0/16` |
| IONOS SE (AS8560) | 2 | 0.0% | 1 | 1 | `82.223.0.0/16` |
| Hivelocity LLC (AS61317) | 2 | 0.0% | 1 | 1 | `83.168.0.0/16` |
| Aria Shatel PJSC (AS31549) | 2 | 0.0% | 1 | 1 | `84.241.0.0/16` |
| Virgin Media (AS5089) | 2 | 0.0% | 1 | 1 | `86.18.0.0/16` |
| Deutsche Telekom AG (AS3320) | 2 | 0.0% | 1 | 1 | `91.16.0.0/16` |
| PROMEDIA NOWICKI WESOLOWSKI Sp.J. (AS51944) | 2 | 0.0% | 1 | 1 | `91.227.0.0/16` |
| Performance-Net LLC (AS209221) | 2 | 0.0% | 1 | 2 | `91.247.0.0/16` |
| Caspian Telecom LLC (AS201167) | 2 | 0.0% | 1 | 1 | `94.20.0.0/16` |
| Elisa Eesti AS (AS2586) | 2 | 0.0% | 1 | 1 | `94.246.0.0/16` |
| Albanian Satellite Communications sh.p.k. (AS47394) | 2 | 0.0% | 1 | 2 | `95.107.0.0/16` |
| Verizon Business (AS6167) | 2 | 0.0% | 2 | 2 | `97.237.0.0/16`, `97.244.0.0/16` |
| GoDaddy.com, LLC (AS26496) | 2 | 0.0% | 1 | 1 | `97.74.0.0/16` |
| AWS | 1 | 0.0% | 1 | 1 | `100.64.0.0/16` |
| PT Remala Abadi (AS38511) | 1 | 0.0% | 1 | 1 | `101.255.0.0/16` |
| Glide Student & Residential Limited (AS42689) | 1 | 0.0% | 1 | 1 | `103.104.0.0/16` |
| MD Firozur Rahman (AS137976) | 1 | 0.0% | 1 | 1 | `103.119.0.0/16` |
| U.P. COMMUNICATION SERVICES PVT LTD (AS59162) | 1 | 0.0% | 1 | 1 | `103.134.0.0/16` |
| PT. Putra Lebak Banten (AS139972) | 1 | 0.0% | 1 | 1 | `103.147.0.0/16` |
| Net Gate (Pvt) Ltd (AS142295) | 1 | 0.0% | 1 | 1 | `103.167.0.0/16` |
| KKD BROADBAND PRIVATE LIMITED (AS142527) | 1 | 0.0% | 1 | 1 | `103.171.0.0/16` |
| PT Aplikanusa Lintasarta (AS4800) | 1 | 0.0% | 1 | 1 | `103.187.0.0/16` |
| Elyzium Technologies Pvt. Ltd. (AS134319) | 1 | 0.0% | 1 | 1 | `103.194.0.0/16` |
| Business Network (AS134204) | 1 | 0.0% | 1 | 1 | `103.211.0.0/16` |
| WISH NET PRIVATE LIMITED (AS45775) | 1 | 0.0% | 1 | 1 | `103.219.0.0/16` |
| ACE IT Networks Limited (AS58800) | 1 | 0.0% | 1 | 1 | `103.245.0.0/16` |
| Pioneer Elabs Ltd. (AS150008) | 1 | 0.0% | 1 | 1 | `103.252.0.0/16` |
| LLC McLaut-Invest (AS25133) | 1 | 0.0% | 1 | 1 | `109.227.0.0/16` |
| Donbass Electronic Communications Ltd. (AS20590) | 1 | 0.0% | 1 | 1 | `109.254.0.0/16` |
| Subisu Cablenet (Pvt) Ltd, Baluwatar, Kathmandu, Nepal (AS4007) | 1 | 0.0% | 1 | 1 | `110.34.0.0/16` |
| National Telecom Public Company Limited (AS131090) | 1 | 0.0% | 1 | 1 | `110.77.0.0/16` |
| Binariang Berhad (AS9534) | 1 | 0.0% | 1 | 1 | `113.211.0.0/16` |
| China Unicom Shanghai network (AS17621) | 1 | 0.0% | 1 | 1 | `113.31.0.0/16` |
| Tire-1 IP Transit Provider of Bangladesh (AS17806) | 1 | 0.0% | 1 | 1 | `114.130.0.0/16` |
| BRACNet Limited (AS24342) | 1 | 0.0% | 1 | 1 | `115.127.0.0/16` |
| PT. Simaya Jejaring Mandiri (AS38783) | 1 | 0.0% | 1 | 1 | `115.178.0.0/16` |
| NTT SINGAPORE PTE LTD (AS17645) | 1 | 0.0% | 1 | 1 | `116.51.0.0/16` |
| National Internet Backbone (AS9829) | 1 | 0.0% | 1 | 1 | `117.244.0.0/16` |
| XYZ Telecom Pty Ltd (AS9336) | 1 | 0.0% | 1 | 1 | `118.127.0.0/16` |
| Vodafone Next Generation Services Limited (AS17435) | 1 | 0.0% | 1 | 1 | `118.90.0.0/16` |
| BDCOM Online Limited (AS24122) | 1 | 0.0% | 1 | 1 | `119.40.0.0/16` |
| PT SELARAS CITRA TERABIT (AS131706) | 1 | 0.0% | 1 | 1 | `121.101.0.0/16` |
| Converge ICT Solutions Inc. (AS17639) | 1 | 0.0% | 1 | 1 | `136.158.0.0/16` |
| VICONTEC TECNOLOGIA INTERNET E REDES LTDA (AS263908) | 1 | 0.0% | 1 | 1 | `138.204.0.0/16` |
| Globe Telecoms (AS4775) | 1 | 0.0% | 1 | 1 | `138.84.0.0/16` |
| Hanoi Telecom Joint Stock Company - HCMC Branch (AS24088) | 1 | 0.0% | 1 | 1 | `14.0.0.0/16` |
| N. DE CARVALHO SANTANA EIRELI (AS264050) | 1 | 0.0% | 1 | 1 | `143.137.0.0/16` |
| ITS Technology Group Limited (AS41354) | 1 | 0.0% | 1 | 1 | `149.86.0.0/16` |
| Tele2 SWIPnet (AS1257) | 1 | 0.0% | 1 | 1 | `150.241.0.0/16` |
| Twin Lakes Telephone Cooperative Corporation (AS19331) | 1 | 0.0% | 1 | 1 | `150.252.0.0/16` |
| Iran Telecommunication Company PJS (AS58224) | 1 | 0.0% | 1 | 1 | `151.233.0.0/16` |
| Telefonica Moviles del Uruguay SA (AS19422) | 1 | 0.0% | 1 | 1 | `152.156.0.0/16` |
| netcup GmbH (AS214996) | 1 | 0.0% | 1 | 1 | `152.53.0.0/16` |
| RouterHosting LLC (AS14956) | 1 | 0.0% | 1 | 1 | `153.75.0.0/16` |
| Hytron Network Services Limited (AS151407) | 1 | 0.0% | 1 | 1 | `154.88.0.0/16` |
| PT DES Teknologi Informasi (AS45302) | 1 | 0.0% | 1 | 1 | `157.119.0.0/16` |
| TIME dotCom Berhad No. 14, Jalan Majistret U1/26 Hicom Glenmarie Industrial Park 40150 Shah A (AS9930) | 1 | 0.0% | 1 | 1 | `161.142.0.0/16` |
| ColoUp (AS19084) | 1 | 0.0% | 1 | 1 | `162.245.0.0/16` |
| PT Rajasa Sinergi Komunikasi (AS153895) | 1 | 0.0% | 1 | 1 | `163.227.0.0/16` |
| HK Broadband Network Ltd. (AS10103) | 1 | 0.0% | 1 | 1 | `165.84.0.0/16` |
| CoreWeave, Inc (AS33425) | 1 | 0.0% | 1 | 1 | `166.19.0.0/16` |
| Dedicated.com (AS63018) | 1 | 0.0% | 1 | 1 | `167.160.0.0/16` |
| LINKEAR SRL (AS263801) | 1 | 0.0% | 1 | 1 | `168.196.0.0/16` |
| 4G Telecom (AS327786) | 1 | 0.0% | 1 | 1 | `169.255.0.0/16` |
| Ezee Fiber (AS35847) | 1 | 0.0% | 1 | 1 | `170.203.0.0/16` |
| VIVA TECNOLOGIA TELECOMUNICACOES LTDA (AS61618) | 1 | 0.0% | 1 | 1 | `170.81.0.0/16` |
| FedEx Internet Technologies Corporation (AS7726) | 1 | 0.0% | 1 | 1 | `170.86.0.0/16` |
| PE Zinstein Hariton Vladimirovich (AS43936) | 1 | 0.0% | 1 | 1 | `176.101.0.0/16` |
| Limited Liability Company Radio Network (AS198820) | 1 | 0.0% | 1 | 1 | `176.118.0.0/16` |
| Superonline Iletisim Hizmetleri A.S. (AS34984) | 1 | 0.0% | 1 | 1 | `176.235.0.0/16` |
| ACESSOLINE TELECOMUNICACOES LTDA (AS262391) | 1 | 0.0% | 1 | 1 | `177.131.0.0/16` |
| BTT TELECOMUNICACOES S.A. (AS28656) | 1 | 0.0% | 1 | 1 | `177.55.0.0/16` |
| Republican Unitary Telecommunication Enterprise Beltelecom (AS6697) | 1 | 0.0% | 1 | 1 | `178.120.0.0/16` |
| Mada Al-Arab General Services Company (AS51407) | 1 | 0.0% | 1 | 1 | `178.130.0.0/16` |
| PrJSC VF UKRAINE (AS21497) | 1 | 0.0% | 1 | 1 | `178.136.0.0/16` |
| Pombonet Telecomunicacoes e Informatica (AS262988) | 1 | 0.0% | 1 | 1 | `179.125.0.0/16` |
| AXES SERVICOS DE COMUNICACAO LTDA. (AS263422) | 1 | 0.0% | 1 | 1 | `179.191.0.0/16` |
| Leaseweb USA, Inc. (AS7203) | 1 | 0.0% | 1 | 1 | `179.61.0.0/16` |
| FASTNET TELECOM (AS52711) | 1 | 0.0% | 1 | 1 | `179.96.0.0/16` |
| Bangladesh Telecommunications Company Limited (BTCL), Nationwide PSTN Operator and Data and  (AS45588) | 1 | 0.0% | 1 | 1 | `180.211.0.0/16` |
| Telecel S.A. (AS23201) | 1 | 0.0% | 1 | 1 | `181.120.0.0/16` |
| Telefonica del Sur S.A. (AS14117) | 1 | 0.0% | 1 | 1 | `181.226.0.0/16` |
| Ei Telecom LTDA (AS267563) | 1 | 0.0% | 1 | 1 | `181.233.0.0/16` |
| CT-HangZhou-IDC (AS58461) | 1 | 0.0% | 1 | 1 | `183.134.0.0/16` |
| Datacamp Limited (AS60068) | 1 | 0.0% | 1 | 1 | `185.152.0.0/16` |
| Tarin General Trading and Setting Up Internet Device LTD (AS197882) | 1 | 0.0% | 1 | 1 | `185.184.0.0/16` |
| Bamboozle Web Services MEA FZ-LLC (AS200851) | 1 | 0.0% | 1 | 1 | `185.243.0.0/16` |
| BR.Digital Telecom (AS14840) | 1 | 0.0% | 1 | 1 | `186.211.0.0/16` |
| Claro NXT Telecomunicacoes Ltda (AS28573) | 1 | 0.0% | 1 | 1 | `186.218.0.0/16` |
| REDE MINAS TELECOM LTDA (AS262805) | 1 | 0.0% | 1 | 1 | `186.250.0.0/16` |
| SIM INTERNET PROVEDORES DE INTERNET EIRELI. (AS28267) | 1 | 0.0% | 1 | 1 | `187.17.0.0/16` |
| ALGAR TELECOM S/A (AS16735) | 1 | 0.0% | 1 | 1 | `187.32.0.0/16` |
| Crelcom LLC (AS6789) | 1 | 0.0% | 1 | 1 | `188.114.0.0/16` |
| Three (AS206067) | 1 | 0.0% | 1 | 1 | `188.30.0.0/16` |
| BVNET S.A. (AS27833) | 1 | 0.0% | 1 | 1 | `190.1.0.0/16` |
| networksdelmanana.com (AS52485) | 1 | 0.0% | 1 | 1 | `190.123.0.0/16` |
| Manquehuenet (AS18822) | 1 | 0.0% | 1 | 1 | `190.215.0.0/16` |
| Telecom Argentina S.A. (AS7303) | 1 | 0.0% | 1 | 1 | `190.247.0.0/16` |
| UNE EPM TELECOMUNICACIONES S.A. (AS13489) | 1 | 0.0% | 1 | 1 | `190.71.0.0/16` |
| H4Y Technologies LLC (AS397373) | 1 | 0.0% | 1 | 1 | `192.154.0.0/16` |
| Saudi Telecom Company JSC (AS25019) | 1 | 0.0% | 1 | 1 | `192.7.0.0/16` |
| Gigahost AS (AS56655) | 1 | 0.0% | 1 | 1 | `193.200.0.0/16` |
| GlobalConnect AB (AS12552) | 1 | 0.0% | 1 | 1 | `194.132.0.0/16` |
| LLC Eksintech (AS3255) | 1 | 0.0% | 1 | 1 | `194.44.0.0/16` |
| WebSupport s.r.o. (AS51013) | 1 | 0.0% | 1 | 1 | `195.210.0.0/16` |
| Orion Network Limited (AS41564) | 1 | 0.0% | 1 | 1 | `196.196.0.0/16` |
| TELEKOM NETWORKS MALAWI LTD (AS36913) | 1 | 0.0% | 1 | 1 | `196.216.0.0/16` |
| Eduardo Mondlane University (AS31960) | 1 | 0.0% | 1 | 1 | `196.3.0.0/16` |
| RAIN GROUP HOLDINGS (PTY) LTD (AS37105) | 1 | 0.0% | 1 | 1 | `197.184.0.0/16` |
| Inq. Digital Limited (AS37187) | 1 | 0.0% | 1 | 1 | `197.211.0.0/16` |
| Airtel Congo S.A (AS37550) | 1 | 0.0% | 1 | 1 | `197.214.0.0/16` |
| A1 Srbija d.o.o. Beograd (AS44143) | 1 | 0.0% | 1 | 1 | `198.143.0.0/16` |
| The Shadowserver Foundation, Inc. (AS22168) | 1 | 0.0% | 1 | 1 | `199.165.0.0/16` |
| Dauphin Telecom (AS33392) | 1 | 0.0% | 1 | 1 | `199.19.0.0/16` |
| Digicel St.Lucia Ltd (AS395561) | 1 | 0.0% | 1 | 1 | `199.223.0.0/16` |
| TDC Holding A/S (AS3292) | 1 | 0.0% | 1 | 1 | `2.107.0.0/16` |
| Poxley Provedor de Internet Ltda (AS61763) | 1 | 0.0% | 1 | 1 | `201.159.0.0/16` |
| AmberIT Limited (AS23956) | 1 | 0.0% | 1 | 1 | `202.4.0.0/16` |
| Brightspeed (AS19901) | 1 | 0.0% | 1 | 1 | `208.161.0.0/16` |
| United States Department of Defense (DoD) (AS749) | 1 | 0.0% | 1 | 1 | `21.37.0.0/16` |
| VIM TV LTD (AS199702) | 1 | 0.0% | 1 | 1 | `213.149.0.0/16` |
| J.c. Tecnics, S.l. (AS212849) | 1 | 0.0% | 1 | 1 | `217.150.0.0/16` |
| Alexhost S.r.l. (AS200019) | 1 | 0.0% | 1 | 1 | `217.156.0.0/16` |
| QTnet,Inc. (AS7679) | 1 | 0.0% | 1 | 1 | `218.219.0.0/16` |
| China Mobile communications corporation (AS56044) | 1 | 0.0% | 1 | 1 | `223.100.0.0/16` |
| CMPak Limited (AS138423) | 1 | 0.0% | 1 | 1 | `223.123.0.0/16` |
| Kazi Sazzad Hossain T/A Millennium Computers & Networking (AS134113) | 1 | 0.0% | 1 | 1 | `27.123.0.0/16` |
| Dhaka Fiber Net Limited (AS55492) | 1 | 0.0% | 1 | 1 | `27.131.0.0/16` |
| WorldLink Communications Pvt Ltd (AS17501) | 1 | 0.0% | 1 | 1 | `27.34.0.0/16` |
| Gatik Business Solutions (AS132559) | 1 | 0.0% | 1 | 1 | `36.255.0.0/16` |
| IPAX GmbH (AS44133) | 1 | 0.0% | 1 | 1 | `37.252.0.0/16` |
| Aztelekom LLC (AS28787) | 1 | 0.0% | 1 | 1 | `37.61.0.0/16` |
| CONNECTBR TELECOM (AS274469) | 1 | 0.0% | 1 | 1 | `38.19.0.0/16` |
| Tech Futures Interactive Inc. (AS394256) | 1 | 0.0% | 1 | 1 | `38.240.0.0/16` |
| China Mobile communications corporation (AS56041) | 1 | 0.0% | 1 | 1 | `39.182.0.0/16` |
| Safaricom Limited (AS37061) | 1 | 0.0% | 1 | 1 | `41.139.0.0/16` |
| Vox Telecom Ltd (AS11845) | 1 | 0.0% | 1 | 1 | `41.193.0.0/16` |
| Vodacom Tanzania Ltd (AS36908) | 1 | 0.0% | 1 | 1 | `41.223.0.0/16` |
| IDDQD-AS (AS8452) | 1 | 0.0% | 1 | 1 | `41.35.0.0/16` |
| Pfcloud UG (haftungsbeschrankt) (AS51396) | 1 | 0.0% | 1 | 1 | `45.144.0.0/16` |
| High Speed For Internet Services L.L.C (AS216472) | 1 | 0.0% | 1 | 1 | `45.149.0.0/16` |
| CDM TELECOM (AS268554) | 1 | 0.0% | 1 | 1 | `45.163.0.0/16` |
| CONECT TEC TELECOMUNICACOES LTDA (AS269405) | 1 | 0.0% | 1 | 1 | `45.185.0.0/16` |
| WELINK (AS135405) | 1 | 0.0% | 1 | 1 | `45.195.0.0/16` |
| M M da Silva (AS267324) | 1 | 0.0% | 1 | 1 | `45.233.0.0/16` |
| NARI EQUIPAMENTOS DE COMUNICACAO (AS268277) | 1 | 0.0% | 1 | 1 | `45.237.0.0/16` |
| Kappa Internet Services Private Limited (AS45433) | 1 | 0.0% | 1 | 1 | `45.250.0.0/16` |
| ISP Alliance a.s. (AS47232) | 1 | 0.0% | 1 | 1 | `46.29.0.0/16` |
| Omani Qatari Telecommunication Company SAOC (AS50010) | 1 | 0.0% | 1 | 1 | `46.40.0.0/16` |
| LG POWERCOMM (AS17858) | 1 | 0.0% | 1 | 1 | `49.173.0.0/16` |
| Rostelecom (AS12389) | 1 | 0.0% | 1 | 1 | `5.139.0.0/16` |
| MTS PJSC (AS8359) | 1 | 0.0% | 1 | 1 | `5.144.0.0/16` |
| GHOSTnet GmbH (AS12586) | 1 | 0.0% | 1 | 1 | `5.231.0.0/16` |
| Saudi Telecom Company JSC (AS39891) | 1 | 0.0% | 1 | 1 | `51.235.0.0/16` |
| SK Broadband Co Ltd (AS9318) | 1 | 0.0% | 1 | 1 | `58.127.0.0/16` |
| China Telecom (Group) (AS4812) | 1 | 0.0% | 1 | 1 | `58.38.0.0/16` |
| Companhia de Telecomunicacoes de Macau SARL (AS4609) | 1 | 0.0% | 1 | 1 | `60.246.0.0/16` |
| I.Q Online for Internet Services and Communications LLC (AS62419) | 1 | 0.0% | 1 | 1 | `62.201.0.0/16` |
| LREMC Technologies, L.L.C. (AS33574) | 1 | 0.0% | 1 | 1 | `64.255.0.0/16` |
| Horry Telephone Cooperative, Inc. (AS21565) | 1 | 0.0% | 1 | 1 | `66.153.0.0/16` |
| Shaw Communications (AS6327) | 1 | 0.0% | 1 | 1 | `68.146.0.0/16` |
| WideOpenWest Finance LLC (AS12083) | 1 | 0.0% | 1 | 1 | `69.73.0.0/16` |
| CenturyLink Communications, LLC (AS209) | 1 | 0.0% | 1 | 1 | `71.218.0.0/16` |
| Charter Communications Inc (AS11427) | 1 | 0.0% | 1 | 1 | `72.181.0.0/16` |
| Cogeco Connexion Inc. (AS7992) | 1 | 0.0% | 1 | 1 | `72.38.0.0/16` |
| Columbus Telecommunications (Barbados) Limited (AS14813) | 1 | 0.0% | 1 | 1 | `72.51.0.0/16` |
| Hurricane Electric LLC (AS6939) | 1 | 0.0% | 1 | 1 | `74.82.0.0/16` |
| Charter Communications Inc (AS20001) | 1 | 0.0% | 1 | 1 | `76.94.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS133499) | 1 | 0.0% | 1 | 1 | `77.95.0.0/16` |
| Abissnet sh.a. (AS35047) | 1 | 0.0% | 1 | 1 | `80.91.0.0/16` |
| Etihad Salam Telecom CJSC (AS35753) | 1 | 0.0% | 1 | 1 | `82.167.0.0/16` |
| T-Mobile Austria GmbH (AS8412) | 1 | 0.0% | 1 | 1 | `84.113.0.0/16` |
| TTNET LLC (AS213670) | 1 | 0.0% | 1 | 1 | `85.132.0.0/16` |
| Aire Networks Del Mediterraneo Sl Unipersonal (AS29119) | 1 | 0.0% | 1 | 1 | `88.148.0.0/16` |
| Davydov Vladimir Dmitrievich (AS44533) | 1 | 0.0% | 1 | 1 | `89.251.0.0/16` |
| Charter Communications Inc (AS7843) | 1 | 0.0% | 1 | 1 | `9.236.0.0/16` |
| Nikita Sergienko (AS35381) | 1 | 0.0% | 1 | 1 | `91.207.0.0/16` |
| Global Technologies of Ukraine LLC (AS61163) | 1 | 0.0% | 1 | 1 | `91.236.0.0/16` |
| JSC Ufanet (AS41704) | 1 | 0.0% | 1 | 1 | `94.41.0.0/16` |
| Global Network Management Inc (AS42065) | 1 | 0.0% | 1 | 1 | `95.161.0.0/16` |
| Awaser Oman LLC (AS204170) | 1 | 0.0% | 1 | 1 | `96.9.0.0/16` |

## Non-bot fingerprints (top 15 by hits)

Same user-agent hash across many ranges usually means one operator or toolkit.

| User agent | Hits | IPs | /16s | Owners | Mode | Requests |
| --- | ---: | ---: | ---: | --- | --- | --- |
| `Chrome 49 / Windows NT 6.1` | 6,521 | 61 | 7 | AGOTOZ PTE. LTD. (AS9465), CHINANET Guangdong province netwo | direct fetch | favicon.ico |
| `Chrome 131 / Macintosh` | 2,719 | 27 | 28 | Amazon.com, Inc. (AS16509), Google LLC (AS396982), Hivelocit | direct fetch | env / secrets, config / framework dirs |
| `Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb` | 2,563 | 18 | 17 | Alexhost S.r.l. (AS200019), Amazon.com, Inc. (AS16509), Cabl | direct fetch | env / secrets, config / framework dirs |
| `Chrome 131 / Windows NT 10` | 2,541 | 41 | 41 | Akamai Connected Cloud (AS63949), Alibaba (US) Technology Co | direct fetch | env / secrets, config / framework dirs |
| `Chrome 131 / Linux` | 2,456 | 22 | 26 | Amazon.com, Inc. (AS16509), Google LLC (AS396982), Techoff S | direct fetch | env / secrets, config / framework dirs |
| `Safari 13 / iPhone OS 13.2.3` | 1,523 | 407 | 40 | Shenzhen Tencent Computer Systems Company Limited (AS45090), | direct fetch | learn, integrations, tools |
| `facebookexternalhit/1.1 (+http://www.facebook.com/` | 1,253 | 353 | 3 | Facebook, Inc. (AS32934) | direct fetch | robots.txt |
| `Chrome 120 / Windows NT 10` | 1,096 | 34 | 45 | 1&1 Versatel GmbH (AS8881), Akamai Connected Cloud (AS63949) | direct fetch | wordpress, php shells / probes |
| `Chrome 151 / Linux` | 1,072 | 434 | 192 | Amazon.com, Inc. (AS14618) | direct fetch | favicon.ico |
| `Chrome 151 / Android 16` | 1,047 | 436 | 184 | Amazon.com, Inc. (AS14618) | direct fetch | favicon.ico |
| `Chrome 114 / Android 12` | 983 | 13 | 12 | Google LLC (AS396982) | direct fetch | learn, support, pricing |
| `Chrome 147 / Windows NT 10` | 920 | 28 | 14 | Alibaba (US) Technology Co., Ltd. (AS45102), Clouvider Limit | link-follower | env / secrets |
| `Safari 17 / iPhone OS 17.2` | 910 | 726 | 216 | Ace Data Centers, Inc. (AS11798), Adeo Datacenter ApS (AS202 | direct fetch | favicon.ico |
| `Chrome 133 / Linux` | 750 | 6 | 4 | Google LLC (AS396982), Tc Datacenter Limited (AS218785), Tec | direct fetch | version control / CI, config / framework dirs |
| `Chrome 133 / Macintosh` | 706 | 3 | 3 | DigitalOcean, LLC (AS14061), Tc Datacenter Limited (AS218785 | direct fetch | config / framework dirs, env / secrets |

## What the probes ask for

| Category | Requests |  |
| --- | ---: | --- |
| env / secrets | 1,598 | `████████████████████` |
| wordpress | 905 | `███████████` |
| config / framework dirs | 618 | `████████` |
| php shells / probes | 381 | `█████` |
| version control / CI | 265 | `███` |
| backups / db dumps | 155 | `██` |
| actuator / swagger | 137 | `██` |

Most requested paths: `wp-includes` (368), `.env` (212), `.git` (158), `wp-content` (144), `wp-admin` (136), `actuator` (111), `config` (104), `app` (99), `xmlrpc.php` (97), `wp-login.php` (84), `core` (70), `.env.production` (65)

## Notes

- Totals use each group's own hit counter; per-IP counters in the logs are rolling-window values and undercount heavy hitters.
- Owners come from the MaxMind GeoLite2-ASN database (majority ASN of the IPs seen in each /16).
- Bot IPs were checked against the vendors' published range files. Bots without a file are unchecked.
- User agents can be spoofed; vendor tokens are only trustworthy when the IP range matches the vendor.
