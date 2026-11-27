# Crawler trap traffic report

_Built from 2849 log files. Window: 2026-11-22 03:45 to 2026-11-27 17:39 UTC (133.9 h)._

| Metric | Value |
| --- | ---: |
| Logged hits | 439,282 |
| Bot-labelled hits | 402,867 (91.7%) |
| Distinct IPs | 4,141 |
| /16 ranges | 1,397 |
| Hostnames seen | 571 |
| Ban entries | 1,016 |
| Requests logged during bans | 856,812 |

## Traffic mix

| Source | Hits | Share |  |
| --- | ---: | ---: | --- |
| OAI-SearchBot | 178,357 | 40.6% | `████████████████████` |
| ClaudeBot | 167,369 | 38.1% | `███████████████████` |
| GPTBot | 56,869 | 12.9% | `██████` |
| non-bot user agents | 36,415 | 8.3% | `████` |
| l9scan | 128 | 0.0% | `█` |
| Applebot | 107 | 0.0% | `█` |
| Googlebot | 23 | 0.0% | `█` |
| Claude-User | 9 | 0.0% | `█` |
| ChatGPT-User | 5 | 0.0% | `█` |

## Daily totals (7 of 7 days)

Day = the date in the log filename (server-local day), newest first.

| Day | Hits | OAI-SearchBot | ClaudeBot | GPTBot | other bots | non-bot | IPs | During bans |
| --- | ---: | ---: | ---: | ---: | ---: | ---: | ---: | ---: |
| 2026-11-27 | 51,266 | 13,977 | 24,116 | 10,603 | 57 | 2,513 | 1,129 | 44,313 |
| 2026-11-26 | 82,976 | 30,588 | 34,903 | 14,333 | 56 | 3,096 | 1,222 | 125,324 |
| 2026-11-25 | 61,567 | 32,341 | 12,872 | 12,625 | 0 | 3,729 | 1,285 | 225,619 |
| 2026-11-24 | 60,065 | 27,437 | 14,924 | 13,275 | 13 | 4,416 | 983 | 160,593 |
| 2026-11-23 | 95,676 | 45,266 | 38,957 | 3,712 | 136 | 7,605 | 974 | 186,027 |
| 2026-11-22 | 86,226 | 28,355 | 41,191 | 2,282 | 10 | 14,388 | 1,189 | 106,354 |
| 2026-11-21 | 1,506 | 393 | 406 | 39 | 0 | 668 | 322 | 8,582 |

## Requests received (served plus logged during bans)

`Served` is the maze's normal hit counter. `During bans` counts requests that arrived while the source was banned and were tarpitted. Together they show how hard each source really pushes.

| Source | Served | During bans | Received | Share | % of requests banned |  |
| --- | ---: | ---: | ---: | ---: | ---: | --- |
| GPTBot | 56,869 | 644,972 | 701,841 | 54.2% | 91.9% | `████████████████████` |
| OAI-SearchBot | 178,357 | 180,100 | 358,457 | 27.7% | 50.2% | `██████████` |
| ClaudeBot | 167,369 | 31,511 | 198,880 | 15.3% | 15.8% | `██████` |
| non-bot | 36,415 | 229 | 36,644 | 2.8% | 0.6% | `█` |
| l9scan | 128 | 0 | 128 | 0.0% | 0.0% | `█` |
| Applebot | 107 | 0 | 107 | 0.0% | 0.0% | `█` |
| Googlebot | 23 | 0 | 23 | 0.0% | 0.0% | `█` |
| Claude-User | 9 | 0 | 9 | 0.0% | 0.0% | `█` |
| ChatGPT-User | 5 | 0 | 5 | 0.0% | 0.0% | `█` |

## Crawler behaviour

**Pace and IP use.** Single-use IPs were seen for under a minute. Requests per minute are averaged over each bot's own active window.

| Bot | Served req/min | Incl. banned req/min | IPs | Single-use IPs | Median IP lifetime (h) | Longest (h) |
| --- | ---: | ---: | ---: | ---: | ---: | ---: |
| OAI-SearchBot | 22.2 | 44.7 | 261 | 4 | 133.4 | 133.8 |
| ClaudeBot | 20.8 | 24.8 | 10 | 5 | 6.1 | 121.2 |
| GPTBot | 7.1 | 87.4 | 484 | 158 | 60.7 | 133.8 |
| l9scan | 2.5 | 2.5 | 4 | 4 | 0.0 | 0.0 |
| Applebot | 0.0 | 0.0 | 12 | 12 | 0.0 | 0.0 |
| Googlebot | 0.0 | 0.0 | 6 | 6 | 0.0 | 0.0 |

**IP churn per day.** Active IPs, with brand-new IPs in brackets. A bot that keeps finding new IPs has a pool larger than what has been seen.

| Day | OAI-SearchBot | ClaudeBot | GPTBot | l9scan | Applebot | Googlebot |
| --- | ---: | ---: | ---: | ---: | ---: | ---: |
| 2026-11-21 | 203 (+203) | 1 (+1) | 34 (+34) | - | - | - |
| 2026-11-22 | 257 (+54) | 1 (+0) | 172 (+152) | - | - | - |
| 2026-11-23 | 257 (+0) | 2 (+1) | 149 (+54) | 4 (+4) | 1 (+1) | 1 (+1) |
| 2026-11-24 | 255 (+1) | 5 (+3) | 270 (+76) | - | - | 4 (+4) |
| 2026-11-25 | 255 (+1) | 6 (+2) | 269 (+23) | - | - | - |
| 2026-11-26 | 257 (+1) | 6 (+2) | 294 (+79) | - | 9 (+9) | - |
| 2026-11-27 | 257 (+1) | 3 (+1) | 281 (+66) | - | 2 (+2) | 1 (+1) |

**Bans.** A median gap equal to the ban length means the source is re-banned the moment each ban expires.

| Bot | Bans | By kind | Median gap between bans (s) | Busiest hour (UTC) | Ban length |
| --- | ---: | --- | ---: | ---: | --- |
| OAI-SearchBot | 618 | ip 615, agent 2, subnet 1 | 3622 | 04:00 | 10 min |
| GPTBot | 368 | ip 355, group 6, subnet 6, agent 1 | 601 | 04:00 | 10 min |
| ClaudeBot | 24 | ip 11, subnet 6, group 5, agent 2 | 2870 | 04:00 | 10 min |
| non-bot | 6 | agent 2, ip 2, subnet 2 | 1895 | 04:00 | 10 min |

**Section focus.** Evenness runs from 0 (one section only) to 1 (perfectly even). robots.txt, sitemap.xml and favicon.ico are excluded.

| Bot | Content requests | Sections | Top-4 share | Evenness | Top sections |
| --- | ---: | ---: | ---: | ---: | --- |
| ClaudeBot | 137,429 | 38 | 64.7% | 0.66 | learn 57,639, tutorials 12,635, developers 10,445, docs 8,205 |
| GPTBot | 48,543 | 37 | 82.2% | 0.33 | learn 39,019, comparison 308, services 298, about 295 |
| l9scan | 112 | 25 | 25.0% | 0.98 | api 12, graphql 8, console 4, server 4 |

**Topic focus.** Counts come from /learn/<group>/<topic> page requests; evenness runs from 0 (one topic only) to 1 (perfectly even). Older logs have no topic data, so this grows as new logs arrive. 12 of these counts come from the one-time backfill of old logs' last paths (marked topics_backfilled in the logs).

| Bot | Topic requests | Topics | Top-4 share | Evenness | Top topics |
| --- | ---: | ---: | ---: | ---: | --- |
| ClaudeBot | 57,643 | 33 | 64.7% | 0.64 | python-programming 18,685, javascript 7,799, debugging-code 7,452, no-code-low-code 3,344 |
| GPTBot | 39,028 | 100 | 7.8% | 0.99 | data-privacy 1,308, mobile-app-development 701, cooking-and-recipes 525, game-development 497 |

## Crawl funnel

Requests at each step of the discovery path; the percentage is the share of the previous step that reached this one. Homepage hits are served requests with no section recorded (overwhelmingly the root path). The steps are request volumes, not sessions: a bot can fetch the sitemap without asking for robots.txt, or walk section pages without visiting the homepage, so a later step can exceed the one before it. Clicked and direct are shares of all served hits. The steps are section-based counts: the /learn/ step is the learn section count, counted separately from the topic-request counter behind Topic focus, so the two figures need not match.

| Bot | robots.txt | sitemap.xml | Homepage | Section pages | /learn/ pages | Clicked | Direct |
| --- | ---: | ---: | ---: | ---: | ---: | ---: | ---: |
| OAI-SearchBot | 178,357 | 0 (0.0%) | 0 (0%) | 0 (0%) | 0 (0%) | 0 (0.0%) | 178,357 (100.0%) |
| ClaudeBot | 17,466 | 11,250 (64.4%) | 1,224 (10.9%) | 79,790 (6518.8%) | 57,639 (72.2%) | 0 (0.0%) | 167,369 (100.0%) |
| GPTBot | 1 | 8,123 (812300.0%) | 69 (0.8%) | 9,524 (13802.9%) | 39,019 (409.7%) | 44,365 (78.0%) | 12,504 (22.0%) |
| l9scan | 0 | 0 (0%) | 16 (0%) | 112 (700.0%) | 0 (0.0%) | 0 (0.0%) | 128 (100.0%) |
| Applebot | 19 | 0 (0.0%) | 2 (0%) | 86 (4300.0%) | 0 (0.0%) | 0 (0.0%) | 107 (100.0%) |
| Googlebot | 0 | 0 (0%) | 10 (0%) | 8 (80.0%) | 0 (0.0%) | 9 (39.1%) | 14 (60.9%) |

**Topic groups.** Requests by topic group, across all visitors.

| Group | Requests | Share | Top bots |
| --- | ---: | ---: | --- |
| programming-and-software | 55,198 | 56.4% | ClaudeBot 50,960, GPTBot 4,119 |
| data-and-analytics | 9,229 | 9.4% | ClaudeBot 4,651, GPTBot 4,441 |
| cloud-security-and-it | 5,912 | 6.0% | GPTBot 3,680, ClaudeBot 2,024 |
| life-home-and-hobbies | 4,350 | 4.4% | GPTBot 4,243, non-bot 107 |
| career-and-professional-skills | 4,043 | 4.1% | GPTBot 3,927, non-bot 116 |
| health-fitness-and-wellness | 3,890 | 4.0% | GPTBot 3,788, non-bot 102 |
| ai-and-machine-learning | 3,851 | 3.9% | GPTBot 3,715, non-bot 129 |
| school-science-and-knowledge | 3,844 | 3.9% | GPTBot 3,729, non-bot 114 |
| creative-design-and-media | 3,844 | 3.9% | GPTBot 3,740, non-bot 104 |
| business-marketing-and-finance | 3,758 | 3.8% | GPTBot 3,646, non-bot 112 |

**robots.txt violations.** Requests that ignored a Disallow: crawling while banned (a banned visitor's robots.txt says Disallow: / for the ban duration), or fetching /admin/, /cart/ or /api/, which the public robots.txt disallows. The /robots.txt fetch itself never counts. Older logs have no violation data, so this grows as new logs arrive.

| Bot | Violations | Share | Banned requests |
| --- | ---: | ---: | ---: |
| GPTBot | 357,830 | 95.9% | 644,972 |
| ClaudeBot | 14,874 | 4.0% | 31,511 |
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

Per-host counting covers 244,949 of 439,282 served hits (55.8%). Older logs have no hostname data, so this grows as new logs arrive.

**By base domain** (last two labels, so a few multi-part suffixes may group oddly)

| Domain | Hostnames | Served | During bans | Top bots (served) |
| --- | ---: | ---: | ---: | --- |
| `nishad.top` | 1780 | 213,316 | 313,196 | ClaudeBot 93,084, OAI-SearchBot 77,998, non-bot 34,054 |
| `chickenkiller.com` | 2 | 16,156 | 5,847 | ClaudeBot 14,807, GPTBot 875, non-bot 472 |
| `twilightparadox.com` | 1 | 13,554 | 5,096 | ClaudeBot 11,842, GPTBot 879, non-bot 831 |
| `mooo.com` | 1 | 1,908 | 1,174 | GPTBot 889, non-bot 777, ClaudeBot 240 |
| `0.1` | 1 | 10 | 0 | non-bot 10 |
| `crabdance.com` | 1 | 3 | 0 | non-bot 3 |
| `my.to` | 1 | 2 | 0 | non-bot 2 |

**Busiest hostnames**

| Hostname | Served | During bans | Top bots (served) |
| --- | ---: | ---: | --- |
| `news.nishad.top` | 187,946 | 301,640 | ClaudeBot 80,554, OAI-SearchBot 77,751, non-bot 23,124 |
| `cleo.chickenkiller.com` | 16,151 | 5,847 | ClaudeBot 14,807, GPTBot 875, non-bot 467 |
| `recorded.twilightparadox.com` | 13,554 | 5,096 | ClaudeBot 11,842, GPTBot 879, non-bot 831 |
| `database-zone.nishad.top` | 4,757 | 1,649 | ClaudeBot 4,756, non-bot 1 |
| `kamka.mooo.com` | 1,908 | 1,174 | GPTBot 889, non-bot 777, ClaudeBot 240 |
| `support-base.nishad.top` | 1,538 | 731 | ClaudeBot 1,538 |
| `database-zone-updates.nishad.top` | 746 | 1 | ClaudeBot 741, non-bot 5 |
| `news.app.nishad.top` | 514 | 0 | non-bot 513, Googlebot 1 |
| `developer.nishad.top` | 284 | 205 | ClaudeBot 284 |
| `docs.nishad.top` | 337 | 137 | ClaudeBot 328, non-bot 7, GPTBot 2 |
| `appdev.nishad.top` | 467 | 0 | non-bot 467 |
| `metube.nishad.top` | 464 | 0 | non-bot 464 |
| `database.nishad.top` | 331 | 128 | ClaudeBot 307, non-bot 22, GPTBot 2 |
| `voicebridge.lab.nishad.top` | 416 | 0 | non-bot 416 |
| `apptest.nishad.top` | 384 | 0 | non-bot 384 |

## Named crawlers

### OAI-SearchBot

- **Owner:** Microsoft Corporation (AS8075)
- **Hits:** 178,357 (40.6%) from 261 IP(s) in 2 /16 range(s)
- **/24 ranges (IPs):** `74.7.230.0/24` (52), `74.7.244.0/24` (52), `74.7.228.0/24` (51), `74.7.241.0/24` (51), `74.7.175.0/24` (50), `51.8.102.0/24` (5)
- **Vendor range check:** all 261 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 178,357 (100.0%); sitemap.xml: 0
- **Requests per IP:** 683.4 average
- **Bans:** 1,285; 180,100 further requests logged while banned
- **Top sections:** robots.txt 178,357
- **User agent:** `Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36; c`

### ClaudeBot

- **Owner:** Amazon.com, Inc. (AS16509), Google LLC (AS396982)
- **Hits:** 167,369 (38.1%) from 10 IP(s) in 5 /16 range(s)
- **/24 ranges (IPs):** `216.73.216.0/24` (3), `136.79.143.0/24` (1), `216.73.217.0/24` (1), `34.152.124.0/24` (1), `34.162.111.0/24` (1), `34.162.191.0/24` (1), `34.162.27.0/24` (1), `34.186.252.0/24` (1)
- **Vendor range check:** all 10 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 17,466 (10.4%); sitemap.xml: 11,250
- **Requests per IP:** 16,736.9 average
- **Bans:** 125; 31,511 further requests logged while banned
- **robots.txt violations:** 14,874 requests that ignored a Disallow (crawling while banned under Disallow: /, or fetching /admin/, /cart/ or /api/)
- **Top sections:** learn 57,639, robots.txt 17,466, tutorials 12,635, sitemap.xml 11,250, developers 10,445, docs 8,205
- **Top topics:** python-programming 18,685, javascript 7,799, debugging-code 7,452, no-code-low-code 3,344, programming-languages 2,856, web-development 2,444
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; ClaudeBot/1.0; +claudebot@anthropic.com)`

### GPTBot

- **Owner:** Cloudflare, Inc. (AS13335), Fastly, Inc. (AS394192), Microsoft Corporation (AS8075)
- **Hits:** 56,869 (12.9%) from 484 IP(s) in 5 /16 range(s)
- **/24 ranges (IPs):** `74.7.227.0/24` (114), `132.196.86.0/24` (108), `74.7.241.0/24` (53), `172.182.207.0/24` (52), `74.7.242.0/24` (52), `172.182.202.0/24` (51), `74.7.243.0/24` (51), `87.81.224.0/24` (2), +1 more
- **Vendor range check:** 481/484 IPs inside published ranges; **not listed:** `104.29.196.211`, `87.81.224.107`, `87.81.224.64`
- **Link-follow vs direct:** 78.0% followed maze links, 22.0% direct fetches
- **robots.txt requests:** 1 (0.0%); sitemap.xml: 8,123
- **Requests per IP:** 117.5 average
- **Bans:** 447; 644,972 further requests logged while banned
- **robots.txt violations:** 357,830 requests that ignored a Disallow (crawling while banned under Disallow: /, or fetching /admin/, /cart/ or /api/)
- **Top sections:** learn 39,019, sitemap.xml 8,123, comparison 308, services 298, about 295, blog 293
- **Top topics:** data-privacy 1,308, mobile-app-development 701, cooking-and-recipes 525, game-development 497, learning-how-to-learn 486, relationships-and-communication 484
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
- **Hits:** 107 (0.0%) from 12 IP(s) in 1 /16 range(s)
- **/24 ranges (IPs):** `17.166.150.0/24` (1), `17.166.151.0/24` (1), `17.166.152.0/24` (1), `17.166.153.0/24` (1), `17.166.21.0/24` (1), `17.166.22.0/24` (1), `17.166.232.0/24` (1), `17.166.233.0/24` (1), +4 more
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 19 (17.8%); sitemap.xml: 0
- **Requests per IP:** 8.9 average
- **Top sections:** robots.txt 19, support 9, status 6, knowledge-base 5, tools 5, solutions 5
- **User agent:** `Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.4 Safari/605.1.15 (A`

### Googlebot

- **Owner:** AT&T Enterprises, LLC (AS7018), Cloudflare, Inc. (AS13335), Comcast Cable Communications, LLC (AS7922), Cox Communications Inc. (AS22773), Google LLC (AS396982), Verizon Business (AS701)
- **Hits:** 23 (0.0%) from 6 IP(s) in 7 /16 range(s)
- **/24 ranges (IPs):** `100.17.230.0/24` (1), `104.28.245.0/24` (1), `104.56.243.0/24` (1), `68.231.29.0/24` (1), `68.60.156.0/24` (1), `99.63.69.0/24` (1)
- **Link-follow vs direct:** 39.1% followed maze links, 60.9% direct fetches
- **robots.txt requests:** 0 (0.0%); sitemap.xml: 0
- **Requests per IP:** 3.8 average
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
| Microsoft Corporation (AS8075) | 236,235 | 53.8% | 24 | 766 | `74.7.0.0/16`, `172.182.0.0/16`, `132.196.0.0/16`, `20.219.0.0/16` |
| Amazon.com, Inc. (AS16509) | 167,897 | 38.2% | 57 | 69 | `216.73.0.0/16`, `18.217.0.0/16`, `74.220.0.0/16`, `13.52.0.0/16` |
| Google LLC (AS396982) | 10,048 | 2.3% | 134 | 215 | `34.154.0.0/16`, `34.96.0.0/16`, `34.79.0.0/16`, `34.62.0.0/16` |
| UCLOUD INFORMATION TECHNOLOGY (HK) LIMITED (AS135377) | 4,581 | 1.0% | 4 | 8 | `152.32.0.0/16`, `154.51.0.0/16`, `103.218.0.0/16`, `123.58.0.0/16` |
| Amazon.com, Inc. (AS14618) | 2,324 | 0.5% | 227 | 720 | `184.198.0.0/16`, `44.204.0.0/16`, `100.54.0.0/16`, `3.235.0.0/16` |
| Tencent Building, Kejizhongyi Avenue (AS132203) | 2,263 | 0.5% | 35 | 207 | `43.157.0.0/16`, `43.166.0.0/16`, `43.153.0.0/16`, `43.133.0.0/16` |
| Techoff Srv Limited (AS48090) | 1,973 | 0.4% | 3 | 10 | `195.178.0.0/16`, `45.148.0.0/16`, `93.123.0.0/16` |
| AGOTOZ PTE. LTD. (AS9465) | 1,393 | 0.3% | 1 | 7 | `156.225.0.0/16` |
| Facebook, Inc. (AS32934) | 1,278 | 0.3% | 4 | 145 | `173.252.0.0/16`, `69.63.0.0/16`, `69.171.0.0/16`, `57.141.0.0/16` |
| Tc Datacenter Limited (AS218785) | 921 | 0.2% | 2 | 7 | `45.138.0.0/16`, `185.218.0.0/16` |
| Alibaba (US) Technology Co., Ltd. (AS45102) | 651 | 0.1% | 13 | 50 | `43.106.0.0/16`, `8.218.0.0/16`, `47.84.0.0/16`, `43.98.0.0/16` |
| DigitalOcean, LLC (AS14061) | 626 | 0.1% | 52 | 105 | `146.190.0.0/16`, `68.183.0.0/16`, `178.128.0.0/16`, `143.198.0.0/16` |
| OVH SAS (AS16276) | 537 | 0.1% | 24 | 31 | `158.69.0.0/16`, `135.125.0.0/16`, `51.79.0.0/16`, `57.131.0.0/16` |
| Team Blue Carrier Limited (AS34282) | 507 | 0.1% | 1 | 2 | `85.92.0.0/16` |
| Cloudflare, Inc. (AS13335) | 504 | 0.1% | 2 | 36 | `104.29.0.0/16`, `104.28.0.0/16` |
| M247 Europe SRL (AS9009) | 447 | 0.1% | 12 | 47 | `146.70.0.0/16`, `103.4.0.0/16`, `104.253.0.0/16`, `104.239.0.0/16` |
| CHINANET Guangdong province network (AS58466) | 435 | 0.1% | 1 | 5 | `106.75.0.0/16` |
| NTT America, Inc. (AS2914) | 432 | 0.1% | 1 | 10 | `216.167.0.0/16` |
| Cablevision Systems Corp. (AS6128) | 427 | 0.1% | 4 | 4 | `47.17.0.0/16`, `69.115.0.0/16`, `67.87.0.0/16`, `69.121.0.0/16` |
| GitHub, Inc. (AS36459) | 320 | 0.1% | 1 | 13 | `140.82.0.0/16` |
| HostPapa (AS36352) | 246 | 0.1% | 14 | 33 | `23.94.0.0/16`, `107.173.0.0/16`, `23.95.0.0/16`, `107.172.0.0/16` |
| Fastly, Inc. (AS394192) | 235 | 0.1% | 1 | 191 | `87.81.0.0/16` |
| BestDC Limited (AS216014) | 190 | 0.0% | 1 | 1 | `193.47.0.0/16` |
| WholeSale Internet, Inc. (AS32097) | 188 | 0.0% | 1 | 1 | `23.128.0.0/16` |
| CustodianDC Limited (AS50300) | 188 | 0.0% | 1 | 3 | `5.102.0.0/16` |
| GTT Communications Inc. (AS3257) | 180 | 0.0% | 2 | 5 | `70.39.0.0/16`, `216.36.0.0/16` |
| VPS Dedicated LLC (AS197769) | 177 | 0.0% | 1 | 2 | `102.220.0.0/16` |
| Eweka Internet Services B.V. (AS34343) | 173 | 0.0% | 2 | 5 | `81.171.0.0/16`, `91.148.0.0/16` |
| Datacamp Limited (AS212238) | 165 | 0.0% | 23 | 68 | `205.188.0.0/16`, `64.137.0.0/16`, `169.150.0.0/16`, `84.233.0.0/16` |
| 1337 Services GmbH (AS210558) | 165 | 0.0% | 2 | 2 | `45.94.0.0/16`, `185.19.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS203020) | 159 | 0.0% | 17 | 48 | `45.92.0.0/16`, `31.209.0.0/16`, `155.94.0.0/16`, `109.196.0.0/16` |
| Censys, Inc. (AS398324) | 137 | 0.0% | 1 | 6 | `66.132.0.0/16` |
| CtrlS (AS18229) | 113 | 0.0% | 1 | 2 | `45.249.0.0/16` |
| Apple Inc. (AS714) | 108 | 0.0% | 2 | 13 | `17.166.0.0/16`, `17.183.0.0/16` |
| Akamai Connected Cloud (AS63949) | 106 | 0.0% | 18 | 44 | `172.236.0.0/16`, `45.79.0.0/16`, `66.228.0.0/16`, `172.239.0.0/16` |
| Colocation America Corporation (AS47007) | 100 | 0.0% | 1 | 1 | `173.46.0.0/16` |
| TechTies Inc. (AS197170) | 90 | 0.0% | 4 | 8 | `85.11.0.0/16`, `91.92.0.0/16`, `94.26.0.0/16`, `45.156.0.0/16` |
| Hetzner Online GmbH (AS24940) | 84 | 0.0% | 16 | 24 | `204.168.0.0/16`, `88.198.0.0/16`, `91.98.0.0/16`, `116.202.0.0/16` |
| Virtual Systems LLC (AS6698) | 77 | 0.0% | 2 | 2 | `91.218.0.0/16`, `85.137.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS207990) | 76 | 0.0% | 13 | 39 | `83.229.0.0/16`, `217.194.0.0/16`, `203.166.0.0/16`, `213.255.0.0/16` |
| T-Mobile USA, Inc. (AS21928) | 75 | 0.0% | 3 | 9 | `172.56.0.0/16`, `172.59.0.0/16`, `172.58.0.0/16` |
| Web2Objects LLC (AS62874) | 70 | 0.0% | 4 | 26 | `142.147.0.0/16`, `104.238.0.0/16`, `45.61.0.0/16`, `45.56.0.0/16` |
| Oracle Corporation (AS31898) | 70 | 0.0% | 4 | 4 | `129.213.0.0/16`, `141.148.0.0/16`, `129.121.0.0/16`, `157.151.0.0/16` |
| EGIHosting (AS18779) | 66 | 0.0% | 7 | 28 | `23.27.0.0/16`, `104.165.0.0/16`, `172.120.0.0/16`, `166.88.0.0/16` |
| Hangzhou Alibaba Advertising Co.,Ltd. (AS37963) | 64 | 0.0% | 10 | 13 | `8.163.0.0/16`, `8.148.0.0/16`, `121.196.0.0/16`, `47.114.0.0/16` |
| B2 Net Solutions Inc. (AS55286) | 64 | 0.0% | 10 | 40 | `38.154.0.0/16`, `152.232.0.0/16`, `192.241.0.0/16`, `23.236.0.0/16` |
| LogicWeb Inc. (AS64286) | 62 | 0.0% | 6 | 23 | `149.57.0.0/16`, `154.6.0.0/16`, `64.64.0.0/16`, `98.159.0.0/16` |
| CHINA UNICOM China169 Backbone (AS4837) | 61 | 0.0% | 6 | 11 | `113.232.0.0/16`, `113.224.0.0/16`, `153.0.0.0/16`, `113.233.0.0/16` |
| Tier.Net Technologies LLC (AS397423) | 59 | 0.0% | 8 | 25 | `145.223.0.0/16`, `31.57.0.0/16`, `31.59.0.0/16`, `154.29.0.0/16` |
| Driftnet Ltd (AS211298) | 56 | 0.0% | 3 | 28 | `195.96.0.0/16`, `87.236.0.0/16`, `185.247.0.0/16` |
| Unidentified | 51 | 0.0% | 11 | 11 | `172.18.0.0/16`, `127.0.0.0/16`, `121.76.0.0/16`, `141.97.0.0/16` |
| Dedik Services Limited (AS209413) | 51 | 0.0% | 1 | 1 | `176.65.0.0/16` |
| WebWorld (AS30900) | 49 | 0.0% | 4 | 22 | `82.23.0.0/16`, `82.22.0.0/16`, `82.29.0.0/16`, `82.25.0.0/16` |
| The Constant Company, LLC (AS20473) | 48 | 0.0% | 8 | 9 | `137.220.0.0/16`, `45.32.0.0/16`, `192.248.0.0/16`, `45.63.0.0/16` |
| Charter Communications LLC (AS20115) | 42 | 0.0% | 10 | 21 | `198.138.0.0/16`, `74.112.0.0/16`, `199.58.0.0/16`, `45.58.0.0/16` |
| Comcast Cable Communications, LLC (AS7922) | 42 | 0.0% | 25 | 31 | `48.46.0.0/16`, `48.45.0.0/16`, `48.44.0.0/16`, `68.60.0.0/16` |
| NetLab Global (AS979) | 37 | 0.0% | 2 | 2 | `154.44.0.0/16`, `64.81.0.0/16` |
| Scloud Pte Ltd (AS142002) | 37 | 0.0% | 1 | 2 | `165.154.0.0/16` |
| FiberPower LLC (AS214483) | 36 | 0.0% | 1 | 1 | `23.148.0.0/16` |
| Leaseweb Canada Inc. (AS32613) | 30 | 0.0% | 2 | 19 | `192.175.0.0/16`, `64.188.0.0/16` |
| Evoxt Sdn. Bhd. (AS149440) | 28 | 0.0% | 1 | 1 | `96.126.0.0/16` |
| FDCservers.net (AS30058) | 25 | 0.0% | 2 | 12 | `213.169.0.0/16`, `82.108.0.0/16` |
| Hydra Communications Ltd (AS25369) | 24 | 0.0% | 6 | 18 | `2.57.0.0/16`, `154.16.0.0/16`, `200.138.0.0/16`, `5.252.0.0/16` |
| Psychz Networks (AS40676) | 23 | 0.0% | 3 | 9 | `136.0.0.0/16`, `146.103.0.0/16`, `205.236.0.0/16` |
| Cox Communications Inc. (AS22773) | 23 | 0.0% | 6 | 11 | `90.96.0.0/16`, `68.231.0.0/16`, `184.181.0.0/16`, `68.102.0.0/16` |
| Latitude.sh (AS396356) | 23 | 0.0% | 3 | 15 | `81.168.0.0/16`, `185.48.0.0/16`, `43.229.0.0/16` |
| IP Volume inc (AS202425) | 23 | 0.0% | 5 | 9 | `94.102.0.0/16`, `89.248.0.0/16`, `80.82.0.0/16`, `93.174.0.0/16` |
| GRUPO PANAGLOBAL 15 S.A (AS264617) | 22 | 0.0% | 3 | 9 | `45.39.0.0/16`, `170.231.0.0/16`, `185.191.0.0/16` |
| Modat B.V. (AS209334) | 22 | 0.0% | 1 | 8 | `85.217.0.0/16` |
| Microsoft Azure | 20 | 0.0% | 3 | 4 | `10.0.0.0/16`, `10.234.0.0/16`, `9.8.0.0/16` |
| Latitude.sh LTDA (AS262287) | 20 | 0.0% | 3 | 11 | `104.252.0.0/16`, `91.123.0.0/16`, `85.198.0.0/16` |
| Hype Enterprises (AS13332) | 19 | 0.0% | 4 | 11 | `206.206.0.0/16`, `67.227.0.0/16`, `174.140.0.0/16`, `216.74.0.0/16` |
| Charter Communications Inc (AS11426) | 18 | 0.0% | 4 | 10 | `175.29.0.0/16`, `108.59.0.0/16`, `62.72.0.0/16`, `94.103.0.0/16` |
| Leaseweb USA, Inc. (AS395954) | 18 | 0.0% | 6 | 14 | `152.163.0.0/16`, `89.249.0.0/16`, `208.70.0.0/16`, `212.42.0.0/16` |
| Yanoor Islam Khan (AS213186) | 18 | 0.0% | 1 | 1 | `98.142.0.0/16` |
| AT&T Enterprises, LLC (AS7018) | 17 | 0.0% | 15 | 15 | `104.56.0.0/16`, `99.63.0.0/16`, `107.206.0.0/16`, `108.79.0.0/16` |
| Chinanet (AS4134) | 17 | 0.0% | 7 | 9 | `123.160.0.0/16`, `171.217.0.0/16`, `49.87.0.0/16`, `120.39.0.0/16` |
| Comcast Cable Communications, LLC (AS33659) | 17 | 0.0% | 2 | 9 | `138.226.0.0/16`, `170.100.0.0/16` |
| Ace Data Centers, Inc. (AS11798) | 17 | 0.0% | 3 | 13 | `142.111.0.0/16`, `23.26.0.0/16`, `185.216.0.0/16` |
| Turk Telekom (AS9121) | 17 | 0.0% | 2 | 2 | `212.156.0.0/16`, `95.3.0.0/16` |
| Lancom Ltd. (AS199081) | 17 | 0.0% | 1 | 8 | `92.112.0.0/16` |
| Verizon Business (AS701) | 16 | 0.0% | 10 | 10 | `100.17.0.0/16`, `108.39.0.0/16`, `65.206.0.0/16`, `71.111.0.0/16` |
| Getechbrothers, MB (AS202044) | 16 | 0.0% | 3 | 10 | `216.173.0.0/16`, `104.233.0.0/16`, `104.143.0.0/16` |
| HostRoyale LLC (AS46516) | 16 | 0.0% | 2 | 9 | `45.41.0.0/16`, `104.232.0.0/16` |
| Scaleway SAS (AS12876) | 16 | 0.0% | 4 | 6 | `62.210.0.0/16`, `151.115.0.0/16`, `51.158.0.0/16`, `195.154.0.0/16` |
| HIVELOCITY, Inc. (AS29802) | 16 | 0.0% | 5 | 10 | `92.113.0.0/16`, `185.101.0.0/16`, `45.87.0.0/16`, `45.91.0.0/16` |
| UAB code200 (AS203061) | 15 | 0.0% | 1 | 9 | `189.81.0.0/16` |
| SYN LTD (AS64080) | 14 | 0.0% | 5 | 9 | `107.181.0.0/16`, `155.254.0.0/16`, `198.105.0.0/16`, `87.239.0.0/16` |
| Alex Largman (AS59651) | 14 | 0.0% | 2 | 7 | `170.168.0.0/16`, `122.8.0.0/16` |
| GLOBAL COMMUNICATION NETWORK LIMITED (AS152179) | 14 | 0.0% | 3 | 7 | `13.143.0.0/16`, `31.77.0.0/16`, `2.26.0.0/16` |
| Cogent Communications, LLC (AS174) | 14 | 0.0% | 6 | 11 | `154.21.0.0/16`, `154.9.0.0/16`, `154.12.0.0/16`, `154.3.0.0/16` |
| SYN LTD (AS50077) | 14 | 0.0% | 1 | 8 | `185.135.0.0/16` |
| Cablevision Lightpath LLC (AS54004) | 14 | 0.0% | 1 | 6 | `74.48.0.0/16` |
| Colocation America Corporation (AS21769) | 13 | 0.0% | 5 | 12 | `184.174.0.0/16`, `104.224.0.0/16`, `45.127.0.0/16`, `173.211.0.0/16` |
| SONDATECH S.A.S. (AS263812) | 13 | 0.0% | 2 | 6 | `108.165.0.0/16`, `50.114.0.0/16` |
| British Telecommunications Limited (AS2856) | 13 | 0.0% | 2 | 6 | `31.121.0.0/16`, `151.245.0.0/16` |
| Leaseweb USA, Inc. (AS396190) | 13 | 0.0% | 2 | 4 | `191.101.0.0/16`, `191.96.0.0/16` |
| Nessus GmbH (AS47692) | 13 | 0.0% | 1 | 8 | `46.203.0.0/16` |
| Hosting Ukraine LTD (AS200525) | 12 | 0.0% | 1 | 2 | `104.250.0.0/16` |
| Limestone Networks, Inc. (AS46475) | 12 | 0.0% | 4 | 8 | `77.83.0.0/16`, `178.20.0.0/16`, `194.99.0.0/16`, `91.247.0.0/16` |
| Internet Resources Management SRL (AS48955) | 12 | 0.0% | 6 | 10 | `188.214.0.0/16`, `188.213.0.0/16`, `193.176.0.0/16`, `193.239.0.0/16` |
| trafficforce, UAB (AS202496) | 12 | 0.0% | 1 | 6 | `45.43.0.0/16` |
| LINZ STROM GAS WAERME GmbH fuer Energiedienstleistungen und Telekommunikation (AS35369) | 11 | 0.0% | 1 | 2 | `185.242.0.0/16` |
| Korea Telecom (AS4766) | 11 | 0.0% | 2 | 2 | `59.14.0.0/16`, `211.230.0.0/16` |
| Windstream Communications LLC (AS7029) | 10 | 0.0% | 5 | 8 | `64.84.0.0/16`, `109.72.0.0/16`, `91.124.0.0/16`, `208.52.0.0/16` |
| Owl Limited (AS43357) | 10 | 0.0% | 2 | 2 | `147.78.0.0/16`, `176.119.0.0/16` |
| AltusHost B.V. (AS51430) | 10 | 0.0% | 3 | 4 | `82.24.0.0/16`, `37.46.0.0/16`, `79.142.0.0/16` |
| Blatant (AS403005) | 10 | 0.0% | 1 | 1 | `64.89.0.0/16` |
| EN Technologies Pte Ltd (AS133210) | 10 | 0.0% | 1 | 7 | `82.21.0.0/16` |
| Global Transit Systems LLC (AS213954) | 9 | 0.0% | 2 | 5 | `185.201.0.0/16`, `185.168.0.0/16` |
| UAB code200 (AS209709) | 9 | 0.0% | 1 | 5 | `185.210.0.0/16` |
| BlueVPS OU (AS62005) | 9 | 0.0% | 1 | 7 | `82.26.0.0/16` |
| Shenzhen Tencent Computer Systems Company Limited (AS45090) | 8 | 0.0% | 6 | 7 | `49.233.0.0/16`, `119.45.0.0/16`, `119.91.0.0/16`, `192.144.0.0/16` |
| MEVSPACE sp. z o.o. (AS201814) | 8 | 0.0% | 1 | 1 | `149.50.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS39486) | 8 | 0.0% | 3 | 7 | `171.22.0.0/16`, `194.116.0.0/16`, `193.42.0.0/16` |
| Level 3 Parent, LLC (AS3356) | 8 | 0.0% | 1 | 6 | `205.169.0.0/16` |
| AIS Fibre (AS133481) | 8 | 0.0% | 2 | 3 | `27.130.0.0/16`, `58.136.0.0/16` |
| Heart Internet limited (AS20738) | 8 | 0.0% | 1 | 4 | `45.38.0.0/16` |
| Netlen Internet Hizmetleri Ltd. Sti. (AS44620) | 8 | 0.0% | 1 | 1 | `45.74.0.0/16` |
| LeaseWeb Netherlands B.V. (AS60781) | 7 | 0.0% | 4 | 5 | `148.135.0.0/16`, `193.25.0.0/16`, `82.192.0.0/16`, `140.233.0.0/16` |
| PT Telekomunikasi Indonesia (AS7713) | 7 | 0.0% | 2 | 2 | `36.65.0.0/16`, `36.69.0.0/16` |
| web2objects GmbH (AS204646) | 7 | 0.0% | 2 | 4 | `45.159.0.0/16`, `45.150.0.0/16` |
| Palestine Telecommunications Company (PALTEL) (AS12975) | 6 | 0.0% | 4 | 4 | `103.239.0.0/16`, `150.253.0.0/16`, `188.161.0.0/16`, `212.14.0.0/16` |
| Zenlayer Inc (AS21859) | 6 | 0.0% | 1 | 4 | `109.105.0.0/16` |
| SAKURA Internet Inc. (AS7684) | 6 | 0.0% | 1 | 1 | `133.242.0.0/16` |
| GSL Networks Pty LTD (AS137409) | 6 | 0.0% | 5 | 6 | `203.25.0.0/16`, `14.102.0.0/16`, `147.90.0.0/16`, `217.145.0.0/16` |
| HZ Hosting Ltd (AS59711) | 6 | 0.0% | 2 | 6 | `140.99.0.0/16`, `204.93.0.0/16` |
| Reliance Jio Infocomm Limited (AS55836) | 6 | 0.0% | 4 | 5 | `152.59.0.0/16`, `152.58.0.0/16`, `49.37.0.0/16`, `49.43.0.0/16` |
| ASLINE LIMITED (AS137951) | 6 | 0.0% | 1 | 1 | `168.76.0.0/16` |
| Charter Communications Inc (AS10796) | 6 | 0.0% | 4 | 4 | `24.33.0.0/16`, `76.35.0.0/16`, `173.91.0.0/16`, `76.39.0.0/16` |
| China Mobile Communications Group Co., Ltd. (AS9808) | 6 | 0.0% | 1 | 4 | `183.204.0.0/16` |
| F.n.s. Holdings Limited (AS206092) | 6 | 0.0% | 2 | 5 | `45.86.0.0/16`, `185.238.0.0/16` |
| web2objects GmbH (AS50495) | 6 | 0.0% | 3 | 5 | `194.39.0.0/16`, `194.113.0.0/16`, `45.151.0.0/16` |
| ASN for TIANJIN Provincial Net of CT (AS17638) | 6 | 0.0% | 2 | 3 | `221.238.0.0/16`, `221.239.0.0/16` |
| Kaspersky Lab Switzerland GmbH (AS200107) | 6 | 0.0% | 2 | 4 | `93.159.0.0/16`, `77.74.0.0/16` |
| Cyberneticos Hosting SL (AS198968) | 6 | 0.0% | 1 | 4 | `82.27.0.0/16` |
| RCN (AS6079) | 5 | 0.0% | 3 | 4 | `108.171.0.0/16`, `216.133.0.0/16`, `170.124.0.0/16` |
| Zkillu SAS (AS215599) | 5 | 0.0% | 1 | 1 | `169.40.0.0/16` |
| Blix Solutions AS (AS50304) | 5 | 0.0% | 2 | 3 | `181.214.0.0/16`, `193.138.0.0/16` |
| TOTAL PLAY TELECOMUNICACIONES, S.A.P.I. DE C.V. (AS17072) | 5 | 0.0% | 3 | 3 | `187.189.0.0/16`, `187.188.0.0/16`, `189.203.0.0/16` |
| Leaseweb USA, Inc. (AS27411) | 5 | 0.0% | 1 | 4 | `46.202.0.0/16` |
| INCUBATEC GmbH - Srl (AS34081) | 5 | 0.0% | 1 | 3 | `84.33.0.0/16` |
| 1&1 Versatel GmbH (AS8881) | 5 | 0.0% | 3 | 3 | `89.245.0.0/16`, `89.247.0.0/16`, `89.246.0.0/16` |
| Cyber Internet Services (Pvt) Ltd. (AS9541) | 4 | 0.0% | 3 | 3 | `101.53.0.0/16`, `43.242.0.0/16`, `72.255.0.0/16` |
| Philippine Long Distance Telephone Company (AS9299) | 4 | 0.0% | 2 | 2 | `119.93.0.0/16`, `112.209.0.0/16` |
| TM TECHNOLOGY SERVICES SDN. BHD. (AS4788) | 4 | 0.0% | 4 | 4 | `115.135.0.0/16`, `180.75.0.0/16`, `202.188.0.0/16`, `218.111.0.0/16` |
| Connect Northwest Internet Services, LLC (AS10557) | 4 | 0.0% | 1 | 3 | `142.252.0.0/16` |
| 31173 Services AB (AS39351) | 4 | 0.0% | 3 | 4 | `151.241.0.0/16`, `185.209.0.0/16`, `185.213.0.0/16` |
| Internet Vikings International AB (AS51747) | 4 | 0.0% | 4 | 4 | `151.248.0.0/16`, `192.36.0.0/16`, `192.71.0.0/16`, `193.182.0.0/16` |
| Servers.com, Inc. (AS7979) | 4 | 0.0% | 2 | 3 | `172.84.0.0/16`, `23.109.0.0/16` |
| EVEO S.A. (AS53107) | 4 | 0.0% | 1 | 1 | `177.136.0.0/16` |
| Vodafone GmbH (AS3209) | 4 | 0.0% | 2 | 2 | `178.27.0.0/16`, `92.208.0.0/16` |
| Telefonica de Argentina (AS22927) | 4 | 0.0% | 3 | 3 | `201.177.0.0/16`, `181.20.0.0/16`, `186.128.0.0/16` |
| JSC Selectel (AS49505) | 4 | 0.0% | 2 | 2 | `91.206.0.0/16`, `188.124.0.0/16` |
| Ryamer, LLC (AS400587) | 4 | 0.0% | 1 | 1 | `192.197.0.0/16` |
| trafficforce, UAB (AS133944) | 4 | 0.0% | 3 | 3 | `45.141.0.0/16`, `209.35.0.0/16`, `43.245.0.0/16` |
| NetJoin Srl (AS64445) | 4 | 0.0% | 2 | 3 | `45.83.0.0/16`, `217.198.0.0/16` |
| UAB Bite Lietuva (AS210906) | 4 | 0.0% | 3 | 4 | `217.69.0.0/16`, `86.38.0.0/16`, `89.116.0.0/16` |
| Charter Communications Inc (AS12271) | 4 | 0.0% | 2 | 2 | `47.230.0.0/16`, `98.15.0.0/16` |
| VeriSign Infrastructure & Operations (AS11840) | 4 | 0.0% | 1 | 1 | `72.13.0.0/16` |
| kabelplus GmbH (AS8339) | 4 | 0.0% | 1 | 1 | `81.217.0.0/16` |
| Server Galactic Private Limited (AS150423) | 4 | 0.0% | 2 | 4 | `87.82.0.0/16`, `82.119.0.0/16` |
| WS Telecom Inc (AS213541) | 4 | 0.0% | 1 | 1 | `85.28.0.0/16` |
| ROMARG SRL (AS205275) | 4 | 0.0% | 1 | 2 | `89.40.0.0/16` |
| Lexistar Alliance Ltd. (AS329225) | 3 | 0.0% | 1 | 2 | `102.212.0.0/16` |
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
| Leaseweb UK Limited (AS205544) | 3 | 0.0% | 3 | 3 | `176.113.0.0/16`, `185.236.0.0/16`, `37.44.0.0/16` |
| UNIFIQUE TELECOMUNICACOES S/A (AS28343) | 3 | 0.0% | 1 | 1 | `186.232.0.0/16` |
| Hostinger Operations UAB (AS47583) | 3 | 0.0% | 2 | 2 | `45.13.0.0/16`, `187.124.0.0/16` |
| Kyivstar PJSC (AS15895) | 3 | 0.0% | 1 | 1 | `188.163.0.0/16` |
| Keminet SHPK (AS197706) | 3 | 0.0% | 2 | 3 | `188.68.0.0/16`, `31.171.0.0/16` |
| Realcloud OU (AS206804) | 3 | 0.0% | 1 | 1 | `192.159.0.0/16` |
| Cyberzone S.A. (AS209854) | 3 | 0.0% | 2 | 2 | `45.95.0.0/16`, `193.56.0.0/16` |
| Glesys Sweden AB (AS42708) | 3 | 0.0% | 2 | 2 | `85.203.0.0/16`, `194.14.0.0/16` |
| ONYPHE SAS (AS213412) | 3 | 0.0% | 3 | 3 | `195.184.0.0/16`, `91.230.0.0/16`, `91.231.0.0/16` |
| Leaseweb Deutschland GmbH (AS28753) | 3 | 0.0% | 2 | 3 | `206.232.0.0/16`, `204.217.0.0/16` |
| Uzbektelekom Joint Stock Company (AS8193) | 3 | 0.0% | 2 | 2 | `213.230.0.0/16`, `84.54.0.0/16` |
| tzulo, inc. (AS11878) | 3 | 0.0% | 1 | 1 | `23.234.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS44144) | 3 | 0.0% | 3 | 3 | `31.223.0.0/16`, `45.12.0.0/16`, `84.247.0.0/16` |
| JSC Ukrtelecom (AS6849) | 3 | 0.0% | 2 | 2 | `46.201.0.0/16`, `37.55.0.0/16` |
| INEA sp. z o.o. (AS13110) | 3 | 0.0% | 1 | 1 | `77.65.0.0/16` |
| SOCIETE NATIONALE DES TELECOMMUNICATIONS (Tunisie Telecom) (AS327934) | 2 | 0.0% | 1 | 1 | `102.152.0.0/16` |
| Chittagong multi channel limited, (AS137029) | 2 | 0.0% | 1 | 1 | `103.102.0.0/16` |
| Kwikzo Telecomm Pvt Ltd (AS137114) | 2 | 0.0% | 1 | 2 | `103.111.0.0/16` |
| Antaranga Dot Com Ltd (AS132298) | 2 | 0.0% | 2 | 2 | `103.133.0.0/16`, `103.135.0.0/16` |
| Smart Online (AS139813) | 2 | 0.0% | 1 | 1 | `103.145.0.0/16` |
| Varendra IT (AS151391) | 2 | 0.0% | 1 | 1 | `103.150.0.0/16` |
| UNIVISION LLC (AS17882) | 2 | 0.0% | 1 | 1 | `103.212.0.0/16` |
| HZ Hosting Ltd (AS202015) | 2 | 0.0% | 1 | 1 | `103.228.0.0/16` |
| Comilla Online (AS133443) | 2 | 0.0% | 1 | 1 | `103.229.0.0/16` |
| Adeo Datacenter ApS (AS202914) | 2 | 0.0% | 1 | 2 | `103.37.0.0/16` |
| Sky Broadband Pvt. Ltd (AS136908) | 2 | 0.0% | 1 | 1 | `103.96.0.0/16` |
| Wave Broadband (AS11404) | 2 | 0.0% | 1 | 2 | `104.164.0.0/16` |
| FPT Telecom Company (AS18403) | 2 | 0.0% | 2 | 2 | `113.22.0.0/16`, `42.114.0.0/16` |
| PPCTV broadband service is the first cable and DSL internet in Cambodia (AS38286) | 2 | 0.0% | 1 | 1 | `122.252.0.0/16` |
| Google Fiber Inc. (AS16591) | 2 | 0.0% | 2 | 2 | `136.38.0.0/16`, `136.53.0.0/16` |
| Giganet Comunicacoes Multimidia Ltda (AS263487) | 2 | 0.0% | 1 | 1 | `143.255.0.0/16` |
| Breezeline (AS11776) | 2 | 0.0% | 2 | 2 | `146.168.0.0/16`, `23.245.0.0/16` |
| Wind Tre S.p.A. (AS1267) | 2 | 0.0% | 1 | 1 | `151.56.0.0/16` |
| ENEL S.p.A (AS202098) | 2 | 0.0% | 1 | 1 | `158.47.0.0/16` |
| Proton AG (AS208172) | 2 | 0.0% | 1 | 1 | `159.26.0.0/16` |
| BL Networks (AS399629) | 2 | 0.0% | 2 | 2 | `168.100.0.0/16`, `206.188.0.0/16` |
| Fusiora OU (AS214693) | 2 | 0.0% | 1 | 1 | `169.128.0.0/16` |
| Earthlink Telecommunications Equipment Trading & Services DMCC (AS199739) | 2 | 0.0% | 1 | 2 | `169.224.0.0/16` |
| Uniti Fiber Holdings Inc. (AS13760) | 2 | 0.0% | 1 | 1 | `170.249.0.0/16` |
| True Online (AS17552) | 2 | 0.0% | 1 | 1 | `171.96.0.0/16` |
| Rogers Communications Canada Inc. (AS812) | 2 | 0.0% | 1 | 1 | `173.32.0.0/16` |
| LLC Multiservice (AS52043) | 2 | 0.0% | 1 | 1 | `176.124.0.0/16` |
| Emirates Telecommunications Group Company (etisalat Group) Pjsc (AS5384) | 2 | 0.0% | 2 | 2 | `176.204.0.0/16`, `5.193.0.0/16` |
| UFINET PANAMA S.A. (AS52468) | 2 | 0.0% | 2 | 2 | `177.234.0.0/16`, `190.60.0.0/16` |
| Natel Telecom Ltda. - ME (AS262468) | 2 | 0.0% | 1 | 1 | `177.53.0.0/16` |
| Space Exploration Technologies Corporation (AS14593) | 2 | 0.0% | 1 | 1 | `179.65.0.0/16` |
| CORPORACION NACIONAL DE TELECOMUNICACIONES - CNT EP (AS28006) | 2 | 0.0% | 2 | 2 | `181.211.0.0/16`, `186.46.0.0/16` |
| Comfort XXI Century Ltd. (AS204144) | 2 | 0.0% | 1 | 1 | `185.112.0.0/16` |
| Energy Bridge Sarl (AS56902) | 2 | 0.0% | 1 | 1 | `185.128.0.0/16` |
| SERVICIOS DE TELECOMUNICACIONES SETEL S.A. (XTRIM EC) (AS14522) | 2 | 0.0% | 1 | 1 | `186.66.0.0/16` |
| Mega Cable, S.A. de C.V. (AS13999) | 2 | 0.0% | 2 | 2 | `187.244.0.0/16`, `201.165.0.0/16` |
| UNINET (AS8151) | 2 | 0.0% | 1 | 1 | `189.179.0.0/16` |
| INTERNET CORDOBA S.A.S (AS270099) | 2 | 0.0% | 1 | 1 | `190.109.0.0/16` |
| COLOMBIA TELECOMUNICACIONES S.A. ESP BIC (AS3816) | 2 | 0.0% | 1 | 1 | `190.66.0.0/16` |
| Google LLC (AS15169) | 2 | 0.0% | 1 | 2 | `192.178.0.0/16` |
| O.m.c. Computers & Communications Ltd (AS44709) | 2 | 0.0% | 2 | 2 | `194.36.0.0/16`, `79.108.0.0/16` |
| Naukowa I Akademicka Siec Komputerowa - Panstwowy Instytut Badawczy (AS8308) | 2 | 0.0% | 1 | 1 | `195.164.0.0/16` |
| Web Telecom Services (PTY) Ltd (AS328029) | 2 | 0.0% | 1 | 1 | `196.61.0.0/16` |
| 3S INF (AS37671) | 2 | 0.0% | 1 | 1 | `197.15.0.0/16` |
| Leaseweb USA, Inc. (AS394380) | 2 | 0.0% | 1 | 2 | `199.180.0.0/16` |
| Clouvider Limited (AS62240) | 2 | 0.0% | 1 | 2 | `200.162.0.0/16` |
| BIA PADUA INTERNET E S.C.M. LTDA (AS262519) | 2 | 0.0% | 1 | 1 | `201.131.0.0/16` |
| Webhosting Holdings LLC (AS965) | 2 | 0.0% | 1 | 2 | `23.129.0.0/16` |
| Link3 Technologies Ltd. (AS23688) | 2 | 0.0% | 1 | 1 | `27.147.0.0/16` |
| Spetsnet LLC (AS44019) | 2 | 0.0% | 1 | 1 | `31.128.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS204287) | 2 | 0.0% | 2 | 2 | `31.98.0.0/16`, `86.104.0.0/16` |
| ONETECH SERVICOS DE COMUNICACAO E MULTIMIDIA LTDA (AS269501) | 2 | 0.0% | 1 | 1 | `38.43.0.0/16` |
| GALAXY ENTERTAINMENT DE VENEZUELA, S.C.A. (AS263806) | 2 | 0.0% | 1 | 1 | `38.74.0.0/16` |
| Doornet sa de cv (AS28433) | 2 | 0.0% | 1 | 1 | `45.174.0.0/16` |
| Sino Worldwide Trading Limited (AS211443) | 2 | 0.0% | 1 | 1 | `46.151.0.0/16` |
| Super Cell Network For Internet Services Ltd (AS201749) | 2 | 0.0% | 1 | 1 | `5.175.0.0/16` |
| Joint stock company For (AS48642) | 2 | 0.0% | 1 | 1 | `5.199.0.0/16` |
| Digicel Jamaica (AS40786) | 2 | 0.0% | 1 | 1 | `63.143.0.0/16` |
| CariNet, Inc. (AS10439) | 2 | 0.0% | 1 | 1 | `71.6.0.0/16` |
| University of Illinois (AS40387) | 2 | 0.0% | 1 | 1 | `72.36.0.0/16` |
| Lanet Network Ltd (AS49332) | 2 | 0.0% | 1 | 1 | `80.243.0.0/16` |
| IONOS SE (AS8560) | 2 | 0.0% | 1 | 1 | `82.223.0.0/16` |
| Hivelocity LLC (AS61317) | 2 | 0.0% | 1 | 1 | `83.168.0.0/16` |
| Virgin Media (AS5089) | 2 | 0.0% | 1 | 1 | `86.18.0.0/16` |
| Deutsche Telekom AG (AS3320) | 2 | 0.0% | 1 | 1 | `91.16.0.0/16` |
| Caspian Telecom LLC (AS201167) | 2 | 0.0% | 1 | 1 | `94.20.0.0/16` |
| Elisa Eesti AS (AS2586) | 2 | 0.0% | 1 | 1 | `94.246.0.0/16` |
| Verizon Business (AS6167) | 2 | 0.0% | 2 | 2 | `97.237.0.0/16`, `97.244.0.0/16` |
| AWS | 1 | 0.0% | 1 | 1 | `100.64.0.0/16` |
| PT Remala Abadi (AS38511) | 1 | 0.0% | 1 | 1 | `101.255.0.0/16` |
| Glide Student & Residential Limited (AS42689) | 1 | 0.0% | 1 | 1 | `103.104.0.0/16` |
| MD Firozur Rahman (AS137976) | 1 | 0.0% | 1 | 1 | `103.119.0.0/16` |
| Net Gate (Pvt) Ltd (AS142295) | 1 | 0.0% | 1 | 1 | `103.167.0.0/16` |
| KKD BROADBAND PRIVATE LIMITED (AS142527) | 1 | 0.0% | 1 | 1 | `103.171.0.0/16` |
| Elyzium Technologies Pvt. Ltd. (AS134319) | 1 | 0.0% | 1 | 1 | `103.194.0.0/16` |
| WISH NET PRIVATE LIMITED (AS45775) | 1 | 0.0% | 1 | 1 | `103.219.0.0/16` |
| eTOP sp. z o.o. (AS20853) | 1 | 0.0% | 1 | 1 | `104.222.0.0/16` |
| LLC McLaut-Invest (AS25133) | 1 | 0.0% | 1 | 1 | `109.227.0.0/16` |
| Donbass Electronic Communications Ltd. (AS20590) | 1 | 0.0% | 1 | 1 | `109.254.0.0/16` |
| Binariang Berhad (AS9534) | 1 | 0.0% | 1 | 1 | `113.211.0.0/16` |
| PT. Simaya Jejaring Mandiri (AS38783) | 1 | 0.0% | 1 | 1 | `115.178.0.0/16` |
| NTT SINGAPORE PTE LTD (AS17645) | 1 | 0.0% | 1 | 1 | `116.51.0.0/16` |
| Vodafone Next Generation Services Limited (AS17435) | 1 | 0.0% | 1 | 1 | `118.90.0.0/16` |
| BDCOM Online Limited (AS24122) | 1 | 0.0% | 1 | 1 | `119.40.0.0/16` |
| Fast Servers (Pty) Ltd (AS35830) | 1 | 0.0% | 1 | 1 | `130.49.0.0/16` |
| Globe Telecoms (AS4775) | 1 | 0.0% | 1 | 1 | `138.84.0.0/16` |
| N. DE CARVALHO SANTANA EIRELI (AS264050) | 1 | 0.0% | 1 | 1 | `143.137.0.0/16` |
| PureVoltage Hosting Inc. (AS26548) | 1 | 0.0% | 1 | 1 | `146.19.0.0/16` |
| Tele2 SWIPnet (AS1257) | 1 | 0.0% | 1 | 1 | `150.241.0.0/16` |
| Twin Lakes Telephone Cooperative Corporation (AS19331) | 1 | 0.0% | 1 | 1 | `150.252.0.0/16` |
| netcup GmbH (AS214996) | 1 | 0.0% | 1 | 1 | `152.53.0.0/16` |
| RouterHosting LLC (AS14956) | 1 | 0.0% | 1 | 1 | `153.75.0.0/16` |
| Hytron Network Services Limited (AS151407) | 1 | 0.0% | 1 | 1 | `154.88.0.0/16` |
| Fast Servers (Pty) Ltd (AS43444) | 1 | 0.0% | 1 | 1 | `155.212.0.0/16` |
| CONNECT 3 (AS138548) | 1 | 0.0% | 1 | 1 | `157.15.0.0/16` |
| TIME dotCom Berhad No. 14, Jalan Majistret U1/26 Hicom Glenmarie Industrial Park 40150 Shah A (AS9930) | 1 | 0.0% | 1 | 1 | `161.142.0.0/16` |
| ColoUp (AS19084) | 1 | 0.0% | 1 | 1 | `162.245.0.0/16` |
| HK Broadband Network Ltd. (AS10103) | 1 | 0.0% | 1 | 1 | `165.84.0.0/16` |
| CoreWeave, Inc (AS33425) | 1 | 0.0% | 1 | 1 | `166.19.0.0/16` |
| Dedicated.com (AS63018) | 1 | 0.0% | 1 | 1 | `167.160.0.0/16` |
| LINKEAR SRL (AS263801) | 1 | 0.0% | 1 | 1 | `168.196.0.0/16` |
| 4G Telecom (AS327786) | 1 | 0.0% | 1 | 1 | `169.255.0.0/16` |
| Ezee Fiber (AS35847) | 1 | 0.0% | 1 | 1 | `170.203.0.0/16` |
| FedEx Internet Technologies Corporation (AS7726) | 1 | 0.0% | 1 | 1 | `170.86.0.0/16` |
| PE Zinstein Hariton Vladimirovich (AS43936) | 1 | 0.0% | 1 | 1 | `176.101.0.0/16` |
| Limited Liability Company Radio Network (AS198820) | 1 | 0.0% | 1 | 1 | `176.118.0.0/16` |
| ACESSOLINE TELECOMUNICACOES LTDA (AS262391) | 1 | 0.0% | 1 | 1 | `177.131.0.0/16` |
| BTT TELECOMUNICACOES S.A. (AS28656) | 1 | 0.0% | 1 | 1 | `177.55.0.0/16` |
| Republican Unitary Telecommunication Enterprise Beltelecom (AS6697) | 1 | 0.0% | 1 | 1 | `178.120.0.0/16` |
| Mada Al-Arab General Services Company (AS51407) | 1 | 0.0% | 1 | 1 | `178.130.0.0/16` |
| PrJSC VF UKRAINE (AS21497) | 1 | 0.0% | 1 | 1 | `178.136.0.0/16` |
| Pombonet Telecomunicacoes e Informatica (AS262988) | 1 | 0.0% | 1 | 1 | `179.125.0.0/16` |
| Leaseweb USA, Inc. (AS7203) | 1 | 0.0% | 1 | 1 | `179.61.0.0/16` |
| FASTNET TELECOM (AS52711) | 1 | 0.0% | 1 | 1 | `179.96.0.0/16` |
| Bangladesh Telecommunications Company Limited (BTCL), Nationwide PSTN Operator and Data and  (AS45588) | 1 | 0.0% | 1 | 1 | `180.211.0.0/16` |
| Telecel S.A. (AS23201) | 1 | 0.0% | 1 | 1 | `181.120.0.0/16` |
| Telefonica del Sur S.A. (AS14117) | 1 | 0.0% | 1 | 1 | `181.226.0.0/16` |
| Datacamp Limited (AS60068) | 1 | 0.0% | 1 | 1 | `185.152.0.0/16` |
| Tarin General Trading and Setting Up Internet Device LTD (AS197882) | 1 | 0.0% | 1 | 1 | `185.184.0.0/16` |
| Bamboozle Web Services MEA FZ-LLC (AS200851) | 1 | 0.0% | 1 | 1 | `185.243.0.0/16` |
| BRASIL TECPAR AMIGO AVATO (AS262907) | 1 | 0.0% | 1 | 1 | `186.195.0.0/16` |
| SIM INTERNET PROVEDORES DE INTERNET EIRELI. (AS28267) | 1 | 0.0% | 1 | 1 | `187.17.0.0/16` |
| Crelcom LLC (AS6789) | 1 | 0.0% | 1 | 1 | `188.114.0.0/16` |
| Three (AS206067) | 1 | 0.0% | 1 | 1 | `188.30.0.0/16` |
| BVNET S.A. (AS27833) | 1 | 0.0% | 1 | 1 | `190.1.0.0/16` |
| networksdelmanana.com (AS52485) | 1 | 0.0% | 1 | 1 | `190.123.0.0/16` |
| Manquehuenet (AS18822) | 1 | 0.0% | 1 | 1 | `190.215.0.0/16` |
| Telecom Argentina S.A. (AS7303) | 1 | 0.0% | 1 | 1 | `190.247.0.0/16` |
| H4Y Technologies LLC (AS397373) | 1 | 0.0% | 1 | 1 | `192.154.0.0/16` |
| Cincinnati Bell Telephone Company LLC (AS6181) | 1 | 0.0% | 1 | 1 | `192.24.0.0/16` |
| Performive LLC (AS46562) | 1 | 0.0% | 1 | 1 | `192.252.0.0/16` |
| Saudi Telecom Company JSC (AS25019) | 1 | 0.0% | 1 | 1 | `192.7.0.0/16` |
| UAB Baltnetos komunikacijos (AS213772) | 1 | 0.0% | 1 | 1 | `193.187.0.0/16` |
| Gigahost AS (AS56655) | 1 | 0.0% | 1 | 1 | `193.200.0.0/16` |
| GlobalConnect AB (AS12552) | 1 | 0.0% | 1 | 1 | `194.132.0.0/16` |
| LLC Eksintech (AS3255) | 1 | 0.0% | 1 | 1 | `194.44.0.0/16` |
| WebSupport s.r.o. (AS51013) | 1 | 0.0% | 1 | 1 | `195.210.0.0/16` |
| Orion Network Limited (AS41564) | 1 | 0.0% | 1 | 1 | `196.196.0.0/16` |
| RAIN GROUP HOLDINGS (PTY) LTD (AS37105) | 1 | 0.0% | 1 | 1 | `197.184.0.0/16` |
| Airtel Congo S.A (AS37550) | 1 | 0.0% | 1 | 1 | `197.214.0.0/16` |
| A1 Srbija d.o.o. Beograd (AS44143) | 1 | 0.0% | 1 | 1 | `198.143.0.0/16` |
| The Shadowserver Foundation, Inc. (AS22168) | 1 | 0.0% | 1 | 1 | `199.165.0.0/16` |
| Dauphin Telecom (AS33392) | 1 | 0.0% | 1 | 1 | `199.19.0.0/16` |
| Digicel St.Lucia Ltd (AS395561) | 1 | 0.0% | 1 | 1 | `199.223.0.0/16` |
| TDC Holding A/S (AS3292) | 1 | 0.0% | 1 | 1 | `2.107.0.0/16` |
| Poxley Provedor de Internet Ltda (AS61763) | 1 | 0.0% | 1 | 1 | `201.159.0.0/16` |
| ANGKOR DATA COMMUNICATION (AS38235) | 1 | 0.0% | 1 | 1 | `203.147.0.0/16` |
| Cogetel Online, Cambodia, ISP (AS23673) | 1 | 0.0% | 1 | 1 | `203.189.0.0/16` |
| Brightspeed (AS19901) | 1 | 0.0% | 1 | 1 | `208.161.0.0/16` |
| United States Department of Defense (DoD) (AS749) | 1 | 0.0% | 1 | 1 | `21.37.0.0/16` |
| VIM TV LTD (AS199702) | 1 | 0.0% | 1 | 1 | `213.149.0.0/16` |
| Alexhost S.r.l. (AS200019) | 1 | 0.0% | 1 | 1 | `217.156.0.0/16` |
| QTnet,Inc. (AS7679) | 1 | 0.0% | 1 | 1 | `218.219.0.0/16` |
| China Mobile communications corporation (AS56044) | 1 | 0.0% | 1 | 1 | `223.100.0.0/16` |
| CMPak Limited (AS138423) | 1 | 0.0% | 1 | 1 | `223.123.0.0/16` |
| Kazi Sazzad Hossain T/A Millennium Computers & Networking (AS134113) | 1 | 0.0% | 1 | 1 | `27.123.0.0/16` |
| Dhaka Fiber Net Limited (AS55492) | 1 | 0.0% | 1 | 1 | `27.131.0.0/16` |
| WorldLink Communications Pvt Ltd (AS17501) | 1 | 0.0% | 1 | 1 | `27.34.0.0/16` |
| Hathway IP Over Cable Internet (AS17488) | 1 | 0.0% | 1 | 1 | `27.4.0.0/16` |
| IPAX GmbH (AS44133) | 1 | 0.0% | 1 | 1 | `37.252.0.0/16` |
| Aztelekom LLC (AS28787) | 1 | 0.0% | 1 | 1 | `37.61.0.0/16` |
| Tech Futures Interactive Inc. (AS394256) | 1 | 0.0% | 1 | 1 | `38.240.0.0/16` |
| China Mobile communications corporation (AS56041) | 1 | 0.0% | 1 | 1 | `39.182.0.0/16` |
| Safaricom Limited (AS37061) | 1 | 0.0% | 1 | 1 | `41.139.0.0/16` |
| Vox Telecom Ltd (AS11845) | 1 | 0.0% | 1 | 1 | `41.193.0.0/16` |
| IDDQD-AS (AS8452) | 1 | 0.0% | 1 | 1 | `41.35.0.0/16` |
| ELXIRE (AS153252) | 1 | 0.0% | 1 | 1 | `45.115.0.0/16` |
| BIZNET NETWORKS (AS17451) | 1 | 0.0% | 1 | 1 | `45.126.0.0/16` |
| Pfcloud UG (haftungsbeschrankt) (AS51396) | 1 | 0.0% | 1 | 1 | `45.144.0.0/16` |
| High Speed For Internet Services L.L.C (AS216472) | 1 | 0.0% | 1 | 1 | `45.149.0.0/16` |
| DB3 SERVICOS DE TELECOMUNICACOES S.A (AS28598) | 1 | 0.0% | 1 | 1 | `45.179.0.0/16` |
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
| `Chrome 131 / Macintosh` | 2,707 | 26 | 26 | Amazon.com, Inc. (AS16509), Google LLC (AS396982), Hivelocit | direct fetch | env / secrets, config / framework dirs |
| `Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb` | 2,544 | 17 | 16 | Alexhost S.r.l. (AS200019), Amazon.com, Inc. (AS16509), Goog | direct fetch | env / secrets, config / framework dirs |
| `Chrome 131 / Windows NT 10` | 2,522 | 38 | 40 | Akamai Connected Cloud (AS63949), Alibaba (US) Technology Co | direct fetch | env / secrets, config / framework dirs |
| `Chrome 131 / Linux` | 2,455 | 22 | 26 | Amazon.com, Inc. (AS16509), Google LLC (AS396982), Techoff S | direct fetch | env / secrets, config / framework dirs |
| `Safari 13 / iPhone OS 13.2.3` | 1,316 | 395 | 39 | Shenzhen Tencent Computer Systems Company Limited (AS45090), | direct fetch | learn, integrations, tools |
| `facebookexternalhit/1.1 (+http://www.facebook.com/` | 1,217 | 345 | 3 | Facebook, Inc. (AS32934) | direct fetch | robots.txt |
| `Chrome 120 / Windows NT 10` | 1,021 | 34 | 44 | 1&1 Versatel GmbH (AS8881), Akamai Connected Cloud (AS63949) | direct fetch | wordpress, php shells / probes |
| `Chrome 151 / Linux` | 1,019 | 425 | 186 | Amazon.com, Inc. (AS14618) | direct fetch | favicon.ico |
| `Chrome 151 / Android 16` | 994 | 430 | 180 | Amazon.com, Inc. (AS14618) | direct fetch | favicon.ico |
| `Chrome 114 / Android 12` | 983 | 13 | 12 | Google LLC (AS396982) | direct fetch | learn, support, pricing |
| `Chrome 147 / Windows NT 10` | 880 | 26 | 14 | Alibaba (US) Technology Co., Ltd. (AS45102), Clouvider Limit | link-follower | env / secrets |
| `Safari 17 / iPhone OS 17.2` | 793 | 648 | 208 | Ace Data Centers, Inc. (AS11798), Adeo Datacenter ApS (AS202 | direct fetch | favicon.ico |
| `Chrome 133 / Linux` | 749 | 6 | 4 | Google LLC (AS396982), Tc Datacenter Limited (AS218785), Tec | direct fetch | version control / CI, config / framework dirs |
| `Chrome 133 / Macintosh` | 706 | 4 | 3 | DigitalOcean, LLC (AS14061), Tc Datacenter Limited (AS218785 | direct fetch | config / framework dirs, env / secrets |

## What the probes ask for

| Category | Requests |  |
| --- | ---: | --- |
| env / secrets | 1,598 | `████████████████████` |
| wordpress | 876 | `███████████` |
| config / framework dirs | 611 | `████████` |
| php shells / probes | 381 | `█████` |
| version control / CI | 265 | `███` |
| backups / db dumps | 144 | `██` |
| actuator / swagger | 121 | `██` |

Most requested paths: `wp-includes` (356), `.env` (212), `.git` (158), `wp-content` (143), `wp-admin` (124), `actuator` (104), `config` (104), `app` (99), `xmlrpc.php` (97), `wp-login.php` (84), `core` (67), `.env.production` (65)

## Notes

- Totals use each group's own hit counter; per-IP counters in the logs are rolling-window values and undercount heavy hitters.
- Owners come from the MaxMind GeoLite2-ASN database (majority ASN of the IPs seen in each /16).
- Bot IPs were checked against the vendors' published range files. Bots without a file are unchecked.
- User agents can be spoofed; vendor tokens are only trustworthy when the IP range matches the vendor.
