# Crawler trap traffic report

_Built from 1839 log files. Window: 2026-11-22 03:45 to 2026-11-25 23:05 UTC (91.3 h)._

| Metric | Value |
| --- | ---: |
| Logged hits | 289,997 |
| Bot-labelled hits | 259,610 (89.5%) |
| Distinct IPs | 2,938 |
| /16 ranges | 1,150 |
| Hostnames seen | 394 |
| Ban entries | 873 |
| Requests logged during bans | 644,306 |

## Traffic mix

| Source | Hits | Share |  |
| --- | ---: | ---: | --- |
| OAI-SearchBot | 125,973 | 43.4% | `████████████████████` |
| ClaudeBot | 104,974 | 36.2% | `█████████████████` |
| non-bot user agents | 30,387 | 10.5% | `█████` |
| GPTBot | 28,504 | 9.8% | `█████` |
| l9scan | 128 | 0.0% | `█` |
| Googlebot | 16 | 0.0% | `█` |
| Claude-User | 9 | 0.0% | `█` |
| Applebot | 4 | 0.0% | `█` |
| ChatGPT-User | 2 | 0.0% | `█` |

## Daily totals (5 of 5 days)

Day = the date in the log filename (server-local day), newest first.

| Day | Hits | OAI-SearchBot | ClaudeBot | GPTBot | other bots | non-bot | IPs | During bans |
| --- | ---: | ---: | ---: | ---: | ---: | ---: | ---: | ---: |
| 2026-11-25 | 46,524 | 24,522 | 9,496 | 9,196 | 0 | 3,310 | 1,233 | 182,750 |
| 2026-11-24 | 60,065 | 27,437 | 14,924 | 13,275 | 13 | 4,416 | 983 | 160,593 |
| 2026-11-23 | 95,676 | 45,266 | 38,957 | 3,712 | 136 | 7,605 | 974 | 186,027 |
| 2026-11-22 | 86,226 | 28,355 | 41,191 | 2,282 | 10 | 14,388 | 1,189 | 106,354 |
| 2026-11-21 | 1,506 | 393 | 406 | 39 | 0 | 668 | 322 | 8,582 |

## Requests received (served plus logged during bans)

`Served` is the maze's normal hit counter. `During bans` counts requests that arrived while the source was banned and were tarpitted. Together they show how hard each source really pushes.

| Source | Served | During bans | Received | Share | % of requests banned |  |
| --- | ---: | ---: | ---: | ---: | ---: | --- |
| GPTBot | 28,504 | 502,093 | 530,597 | 56.8% | 94.6% | `████████████████████` |
| OAI-SearchBot | 125,973 | 126,932 | 252,905 | 27.1% | 50.2% | `██████████` |
| ClaudeBot | 104,974 | 15,052 | 120,026 | 12.8% | 12.5% | `█████` |
| non-bot | 30,387 | 229 | 30,616 | 3.3% | 0.7% | `█` |
| l9scan | 128 | 0 | 128 | 0.0% | 0.0% | `█` |
| Googlebot | 16 | 0 | 16 | 0.0% | 0.0% | `█` |
| Claude-User | 9 | 0 | 9 | 0.0% | 0.0% | `█` |
| Applebot | 4 | 0 | 4 | 0.0% | 0.0% | `█` |
| ChatGPT-User | 2 | 0 | 2 | 0.0% | 0.0% | `█` |

## Crawler behaviour

**Pace and IP use.** Single-use IPs were seen for under a minute. Requests per minute are averaged over each bot's own active window.

| Bot | Served req/min | Incl. banned req/min | IPs | Single-use IPs | Median IP lifetime (h) | Longest (h) |
| --- | ---: | ---: | ---: | ---: | ---: | ---: |
| OAI-SearchBot | 23.1 | 46.5 | 259 | 2 | 90.4 | 90.7 |
| ClaudeBot | 19.2 | 21.9 | 7 | 3 | 21.7 | 91.3 |
| GPTBot | 5.2 | 96.8 | 337 | 69 | 52.0 | 90.7 |
| l9scan | 2.5 | 2.5 | 4 | 4 | 0.0 | 0.0 |

**IP churn per day.** Active IPs, with brand-new IPs in brackets. A bot that keeps finding new IPs has a pool larger than what has been seen.

| Day | OAI-SearchBot | ClaudeBot | GPTBot | l9scan |
| --- | ---: | ---: | ---: | ---: |
| 2026-11-21 | 203 (+203) | 1 (+1) | 34 (+34) | - |
| 2026-11-22 | 257 (+54) | 1 (+0) | 172 (+152) | - |
| 2026-11-23 | 257 (+0) | 2 (+1) | 149 (+54) | 4 (+4) |
| 2026-11-24 | 255 (+1) | 5 (+3) | 270 (+76) | - |
| 2026-11-25 | 257 (+1) | 6 (+2) | 270 (+21) | - |

**Bans.** A median gap equal to the ban length means the source is re-banned the moment each ban expires.

| Bot | Bans | By kind | Median gap between bans (s) | Busiest hour (UTC) | Ban length |
| --- | ---: | --- | ---: | ---: | --- |
| OAI-SearchBot | 562 | ip 559, agent 2, subnet 1 | 3623 | 04:00 | 10 min |
| GPTBot | 290 | ip 281, group 4, subnet 4, agent 1 | 601 | 04:00 | 10 min |
| ClaudeBot | 15 | ip 6, subnet 4, group 3, agent 2 | 3938 | 04:00 | 10 min |
| non-bot | 6 | agent 2, ip 2, subnet 2 | 1895 | 04:00 | 10 min |

**Section focus.** Evenness runs from 0 (one section only) to 1 (perfectly even). robots.txt, sitemap.xml and favicon.ico are excluded.

| Bot | Content requests | Sections | Top-4 share | Evenness | Top sections |
| --- | ---: | ---: | ---: | ---: | --- |
| ClaudeBot | 84,469 | 38 | 49.3% | 0.80 | tutorials 12,246, learn 11,557, developers 10,051, docs 7,810 |
| GPTBot | 23,061 | 37 | 69.0% | 0.52 | learn 15,134, comparison 266, knowledge-base 256, pricing 252 |
| l9scan | 112 | 25 | 25.0% | 0.98 | api 12, graphql 8, console 4, server 4 |

**Topic focus.** Counts come from /learn/<group>/<topic> page requests; evenness runs from 0 (one topic only) to 1 (perfectly even). Older logs have no topic data, so this grows as new logs arrive. 12 of these counts come from the one-time backfill of old logs' last paths (marked topics_backfilled in the logs).

| Bot | Topic requests | Topics | Top-4 share | Evenness | Top topics |
| --- | ---: | ---: | ---: | ---: | --- |
| ClaudeBot | 11,561 | 20 | 69.9% | 0.70 | python-programming 4,091, javascript 1,712, debugging-code 1,687, game-development 587 |
| GPTBot | 15,143 | 100 | 4.6% | 1.00 | machine-learning 176, cooking-and-recipes 174, wordpress-care 173, ai-marketing 173 |

## Crawl funnel

Requests at each step of the discovery path; the percentage is the share of the previous step that reached this one. Homepage hits are served requests with no section recorded (overwhelmingly the root path). The steps are request volumes, not sessions: a bot can fetch the sitemap without asking for robots.txt, or walk section pages without visiting the homepage, so a later step can exceed the one before it. Clicked and direct are shares of all served hits. The steps are section-based counts: the /learn/ step is the learn section count, counted separately from the topic-request counter behind Topic focus, so the two figures need not match.

| Bot | robots.txt | sitemap.xml | Homepage | Section pages | /learn/ pages | Clicked | Direct |
| --- | ---: | ---: | ---: | ---: | ---: | ---: | ---: |
| OAI-SearchBot | 125,973 | 0 (0.0%) | 0 (0%) | 0 (0%) | 0 (0%) | 0 (0.0%) | 125,973 (100.0%) |
| ClaudeBot | 11,652 | 7,807 (67.0%) | 1,046 (13.4%) | 72,912 (6970.6%) | 11,557 (15.9%) | 0 (0.0%) | 104,974 (100.0%) |
| GPTBot | 1 | 5,291 (529100.0%) | 18 (0.3%) | 7,927 (44038.9%) | 15,134 (190.9%) | 22,878 (80.3%) | 5,626 (19.7%) |
| l9scan | 0 | 0 (0%) | 16 (0%) | 112 (700.0%) | 0 (0.0%) | 0 (0.0%) | 128 (100.0%) |

**Topic groups.** Requests by topic group, across all visitors.

| Group | Requests | Share | Top bots |
| --- | ---: | ---: | --- |
| programming-and-software | 11,964 | 44.2% | ClaudeBot 10,427, GPTBot 1,502 |
| data-and-analytics | 2,336 | 8.6% | GPTBot 1,507, ClaudeBot 800 |
| cloud-security-and-it | 2,019 | 7.5% | GPTBot 1,580, ClaudeBot 334 |
| ai-and-machine-learning | 1,575 | 5.8% | GPTBot 1,539, non-bot 36 |
| health-fitness-and-wellness | 1,549 | 5.7% | GPTBot 1,523, non-bot 26 |
| life-home-and-hobbies | 1,547 | 5.7% | GPTBot 1,518, non-bot 29 |
| business-marketing-and-finance | 1,542 | 5.7% | GPTBot 1,513, non-bot 29 |
| career-and-professional-skills | 1,535 | 5.7% | GPTBot 1,507, non-bot 28 |
| school-science-and-knowledge | 1,526 | 5.6% | GPTBot 1,494, non-bot 32 |
| creative-design-and-media | 1,488 | 5.5% | GPTBot 1,460, non-bot 28 |

**robots.txt violations.** Requests that ignored a Disallow: crawling while banned (a banned visitor's robots.txt says Disallow: / for the ban duration), or fetching /admin/, /cart/ or /api/, which the public robots.txt disallows. The /robots.txt fetch itself never counts. Older logs have no violation data, so this grows as new logs arrive.

| Bot | Violations | Share | Banned requests |
| --- | ---: | ---: | ---: |
| GPTBot | 214,951 | 100.0% | 502,093 |
| non-bot | 15 | 0.0% | 0 |
| non-bot | 14 | 0.0% | 0 |
| non-bot | 13 | 0.0% | 7 |
| non-bot | 13 | 0.0% | 0 |
| non-bot | 3 | 0.0% | 0 |
| non-bot | 3 | 0.0% | 0 |
| non-bot | 3 | 0.0% | 0 |
| non-bot | 3 | 0.0% | 0 |
| non-bot | 2 | 0.0% | 68 |
| non-bot | 2 | 0.0% | 0 |
| non-bot | 2 | 0.0% | 0 |
| non-bot | 1 | 0.0% | 0 |
| non-bot | 1 | 0.0% | 68 |
| non-bot | 1 | 0.0% | 0 |
| non-bot | 1 | 0.0% | 0 |
| non-bot | 1 | 0.0% | 0 |

## Hits by domain

Per-host counting covers 206,669 of 289,997 served hits (71.3%). Older logs have no hostname data, so this grows as new logs arrive.

**By base domain** (last two labels, so a few multi-part suffixes may group oddly)

| Domain | Hostnames | Served | During bans | Top bots (served) |
| --- | ---: | ---: | ---: | --- |
| `nishad.top` | 1013 | 198,274 | 305,458 | ClaudeBot 84,441, OAI-SearchBot 77,883, non-bot 28,875 |
| `chickenkiller.com` | 2 | 4,974 | 93 | ClaudeBot 4,780, non-bot 194 |
| `twilightparadox.com` | 1 | 2,674 | 53 | ClaudeBot 2,078, non-bot 595, GPTBot 1 |
| `mooo.com` | 1 | 747 | 8 | non-bot 492, ClaudeBot 240, GPTBot 15 |

**Busiest hostnames**

| Hostname | Served | During bans | Top bots (served) |
| --- | ---: | ---: | --- |
| `news.nishad.top` | 187,729 | 301,640 | ClaudeBot 80,554, OAI-SearchBot 77,751, non-bot 22,907 |
| `cleo.chickenkiller.com` | 4,973 | 93 | ClaudeBot 4,780, non-bot 193 |
| `recorded.twilightparadox.com` | 2,674 | 53 | ClaudeBot 2,078, non-bot 595, GPTBot 1 |
| `database-zone.nishad.top` | 1,347 | 31 | ClaudeBot 1,347 |
| `kamka.mooo.com` | 747 | 8 | non-bot 492, ClaudeBot 240, GPTBot 15 |
| `support-base.nishad.top` | 580 | 0 | ClaudeBot 580 |
| `appdev.nishad.top` | 420 | 0 | non-bot 420 |
| `metube.nishad.top` | 393 | 0 | non-bot 393 |
| `voicebridge.lab.nishad.top` | 371 | 0 | non-bot 371 |
| `apptest.nishad.top` | 342 | 0 | non-bot 342 |
| `firefox.nishad.top` | 342 | 0 | non-bot 342 |
| `io.nishad.top` | 262 | 0 | non-bot 262 |
| `github-streak.nishad.top` | 212 | 0 | non-bot 212 |
| `news.app.nishad.top` | 190 | 0 | non-bot 189, Googlebot 1 |
| `updates-central.nishad.top` | 19 | 157 | non-bot 12, ClaudeBot 7 |

## Named crawlers

### OAI-SearchBot

- **Owner:** Microsoft Corporation (AS8075)
- **Hits:** 125,973 (43.4%) from 259 IP(s) in 2 /16 range(s)
- **/24 ranges (IPs):** `74.7.230.0/24` (52), `74.7.244.0/24` (52), `74.7.228.0/24` (51), `74.7.241.0/24` (51), `74.7.175.0/24` (50), `51.8.102.0/24` (3)
- **Vendor range check:** all 259 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 125,973 (100.0%); sitemap.xml: 0
- **Requests per IP:** 486.4 average
- **Bans:** 1,226; 126,932 further requests logged while banned
- **Top sections:** robots.txt 125,973
- **User agent:** `Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36; c`

### ClaudeBot

- **Owner:** Amazon.com, Inc. (AS16509), Google LLC (AS396982)
- **Hits:** 104,974 (36.2%) from 7 IP(s) in 4 /16 range(s)
- **/24 ranges (IPs):** `216.73.216.0/24` (3), `34.152.124.0/24` (1), `34.162.191.0/24` (1), `34.162.27.0/24` (1), `34.186.252.0/24` (1)
- **Vendor range check:** all 7 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 11,652 (11.1%); sitemap.xml: 7,807
- **Requests per IP:** 14,996.3 average
- **Bans:** 76; 15,052 further requests logged while banned
- **Top sections:** tutorials 12,246, robots.txt 11,652, learn 11,557, developers 10,051, docs 7,810, sitemap.xml 7,807
- **Top topics:** python-programming 4,091, javascript 1,712, debugging-code 1,687, game-development 587, no-code-low-code 556, data-visualization 488
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; ClaudeBot/1.0; +claudebot@anthropic.com)`

### GPTBot

- **Owner:** Cloudflare, Inc. (AS13335), Fastly, Inc. (AS394192), Microsoft Corporation (AS8075)
- **Hits:** 28,504 (9.8%) from 337 IP(s) in 5 /16 range(s)
- **/24 ranges (IPs):** `74.7.227.0/24` (113), `74.7.241.0/24` (52), `74.7.242.0/24` (52), `74.7.243.0/24` (51), `132.196.86.0/24` (31), `172.182.207.0/24` (18), `172.182.202.0/24` (17), `87.81.224.0/24` (2), +1 more
- **Vendor range check:** 334/337 IPs inside published ranges; **not listed:** `104.29.196.211`, `87.81.224.107`, `87.81.224.64`
- **Link-follow vs direct:** 80.3% followed maze links, 19.7% direct fetches
- **robots.txt requests:** 1 (0.0%); sitemap.xml: 5,291
- **Requests per IP:** 84.6 average
- **Bans:** 367; 502,093 further requests logged while banned
- **robots.txt violations:** 214,951 requests that ignored a Disallow (crawling while banned under Disallow: /, or fetching /admin/, /cart/ or /api/)
- **Top sections:** learn 15,134, sitemap.xml 5,291, comparison 266, knowledge-base 256, pricing 252, services 251
- **Top topics:** machine-learning 176, cooking-and-recipes 174, wordpress-care 173, ai-marketing 173, psychology 172, google-cloud 172
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

### Googlebot

- **Owner:** AT&T Enterprises, LLC (AS7018), Cloudflare, Inc. (AS13335), Comcast Cable Communications, LLC (AS7922), Cox Communications Inc. (AS22773), Google LLC (AS396982), Verizon Business (AS701)
- **Hits:** 16 (0.0%) from 5 IP(s) in 7 /16 range(s)
- **/24 ranges (IPs):** `100.17.230.0/24` (1), `104.56.243.0/24` (1), `68.231.29.0/24` (1), `68.60.156.0/24` (1), `99.63.69.0/24` (1)
- **Link-follow vs direct:** 37.5% followed maze links, 62.5% direct fetches
- **robots.txt requests:** 0 (0.0%); sitemap.xml: 0
- **Requests per IP:** 3.2 average
- **Top sections:** favicon.ico 5, .env.dist 1, .env.save 1
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

### Applebot

- **Owner:** Apple Inc. (AS714)
- **Hits:** 4 (0.0%) from 1 IP(s) in 1 /16 range(s)
- **/24 ranges (IPs):** `17.166.237.0/24` (1)
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 2 (50.0%); sitemap.xml: 0
- **Requests per IP:** 4.0 average
- **Top sections:** robots.txt 2
- **User agent:** `Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.4 Safari/605.1.15 (A`

### ChatGPT-User

- **Owner:** Cloudflare, Inc. (AS13335), Microsoft Corporation (AS8075)
- **Hits:** 2 (0.0%) from 1 IP(s) in 2 /16 range(s)
- **/24 ranges (IPs):** `20.125.144.0/24` (1)
- **Vendor range check:** all 1 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 0 (0.0%); sitemap.xml: 0
- **Requests per IP:** 2.0 average
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko); compatible; ChatGPT-User/1.0; +https://openai.com/bot`

## Hits by network owner

| Owner | Hits | Share | /16s | IPs | Top ranges |
| --- | ---: | ---: | ---: | ---: | --- |
| Microsoft Corporation (AS8075) | 155,168 | 53.5% | 13 | 605 | `74.7.0.0/16`, `20.219.0.0/16`, `172.182.0.0/16`, `132.196.0.0/16` |
| Amazon.com, Inc. (AS16509) | 105,268 | 36.3% | 40 | 45 | `216.73.0.0/16`, `18.217.0.0/16`, `184.32.0.0/16`, `34.209.0.0/16` |
| Google LLC (AS396982) | 9,302 | 3.2% | 110 | 154 | `34.154.0.0/16`, `34.96.0.0/16`, `34.79.0.0/16`, `34.62.0.0/16` |
| UCLOUD INFORMATION TECHNOLOGY (HK) LIMITED (AS135377) | 4,694 | 1.6% | 5 | 10 | `152.32.0.0/16`, `154.51.0.0/16`, `45.249.0.0/16`, `103.218.0.0/16` |
| Techoff Srv Limited (AS48090) | 1,770 | 0.6% | 2 | 7 | `195.178.0.0/16`, `45.148.0.0/16` |
| Tencent Building, Kejizhongyi Avenue (AS132203) | 1,702 | 0.6% | 34 | 161 | `43.157.0.0/16`, `43.166.0.0/16`, `43.153.0.0/16`, `43.133.0.0/16` |
| AGOTOZ PTE. LTD. (AS9465) | 1,393 | 0.5% | 1 | 7 | `156.225.0.0/16` |
| Amazon.com, Inc. (AS14618) | 1,204 | 0.4% | 190 | 394 | `3.235.0.0/16`, `3.238.0.0/16`, `184.195.0.0/16`, `100.54.0.0/16` |
| Facebook, Inc. (AS32934) | 1,080 | 0.4% | 4 | 116 | `173.252.0.0/16`, `69.63.0.0/16`, `57.141.0.0/16`, `69.171.0.0/16` |
| Alibaba (US) Technology Co., Ltd. (AS45102) | 611 | 0.2% | 11 | 36 | `43.106.0.0/16`, `8.218.0.0/16`, `43.98.0.0/16`, `47.84.0.0/16` |
| OVH SAS (AS16276) | 521 | 0.2% | 24 | 31 | `158.69.0.0/16`, `51.79.0.0/16`, `57.131.0.0/16`, `139.99.0.0/16` |
| Team Blue Carrier Limited (AS34282) | 507 | 0.2% | 1 | 2 | `85.92.0.0/16` |
| DigitalOcean, LLC (AS14061) | 448 | 0.2% | 42 | 72 | `68.183.0.0/16`, `146.190.0.0/16`, `178.128.0.0/16`, `138.68.0.0/16` |
| CHINANET Guangdong province network (AS58466) | 435 | 0.2% | 1 | 5 | `106.75.0.0/16` |
| NTT America, Inc. (AS2914) | 432 | 0.1% | 1 | 10 | `216.167.0.0/16` |
| Tc Datacenter Limited (AS218785) | 421 | 0.1% | 2 | 4 | `45.138.0.0/16`, `185.218.0.0/16` |
| GitHub, Inc. (AS36459) | 311 | 0.1% | 1 | 28 | `140.82.0.0/16` |
| M247 Europe SRL (AS9009) | 310 | 0.1% | 13 | 38 | `146.70.0.0/16`, `103.4.0.0/16`, `104.253.0.0/16`, `104.239.0.0/16` |
| Cloudflare, Inc. (AS13335) | 242 | 0.1% | 2 | 23 | `104.29.0.0/16`, `104.28.0.0/16` |
| Nexeon Technologies, Inc. (AS20278) | 199 | 0.1% | 2 | 3 | `23.94.0.0/16`, `23.95.0.0/16` |
| Fastly, Inc. (AS394192) | 199 | 0.1% | 1 | 186 | `87.81.0.0/16` |
| WholeSale Internet, Inc. (AS32097) | 188 | 0.1% | 1 | 1 | `23.128.0.0/16` |
| Cablevision Systems Corp. (AS6128) | 184 | 0.1% | 3 | 3 | `69.115.0.0/16`, `67.87.0.0/16`, `69.121.0.0/16` |
| GTT Communications Inc. (AS3257) | 180 | 0.1% | 2 | 5 | `70.39.0.0/16`, `216.36.0.0/16` |
| VPS Dedicated LLC (AS197769) | 177 | 0.1% | 1 | 2 | `102.220.0.0/16` |
| Eweka Internet Services B.V. (AS34343) | 171 | 0.1% | 2 | 4 | `81.171.0.0/16`, `91.148.0.0/16` |
| 1337 Services GmbH (AS210558) | 165 | 0.1% | 2 | 2 | `45.94.0.0/16`, `185.19.0.0/16` |
| CustodianDC Limited (AS50300) | 154 | 0.1% | 1 | 3 | `5.102.0.0/16` |
| Censys, Inc. (AS398324) | 137 | 0.0% | 1 | 6 | `66.132.0.0/16` |
| BestDC Limited (AS216014) | 128 | 0.0% | 1 | 1 | `193.47.0.0/16` |
| Datacamp Limited (AS212238) | 124 | 0.0% | 20 | 54 | `205.188.0.0/16`, `169.150.0.0/16`, `64.137.0.0/16`, `46.203.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS203020) | 121 | 0.0% | 13 | 29 | `45.92.0.0/16`, `31.209.0.0/16`, `155.94.0.0/16`, `209.242.0.0/16` |
| Colocation America Corporation (AS47007) | 100 | 0.0% | 1 | 1 | `173.46.0.0/16` |
| Akamai Connected Cloud (AS63949) | 85 | 0.0% | 14 | 30 | `172.236.0.0/16`, `45.79.0.0/16`, `66.228.0.0/16`, `172.239.0.0/16` |
| T-Mobile USA, Inc. (AS21928) | 69 | 0.0% | 3 | 5 | `172.56.0.0/16`, `172.58.0.0/16`, `172.59.0.0/16` |
| Virtual Systems LLC (AS6698) | 64 | 0.0% | 2 | 2 | `91.218.0.0/16`, `85.137.0.0/16` |
| TechTies Inc. (AS197170) | 60 | 0.0% | 4 | 6 | `85.11.0.0/16`, `91.92.0.0/16`, `94.26.0.0/16`, `45.156.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS207990) | 55 | 0.0% | 10 | 27 | `83.229.0.0/16`, `217.194.0.0/16`, `213.255.0.0/16`, `188.212.0.0/16` |
| Hangzhou Alibaba Advertising Co.,Ltd. (AS37963) | 46 | 0.0% | 7 | 8 | `8.163.0.0/16`, `8.148.0.0/16`, `120.55.0.0/16`, `47.108.0.0/16` |
| The Constant Company, LLC (AS20473) | 43 | 0.0% | 6 | 6 | `137.220.0.0/16`, `192.248.0.0/16`, `45.63.0.0/16`, `216.238.0.0/16` |
| Driftnet Ltd (AS211298) | 42 | 0.0% | 3 | 20 | `195.96.0.0/16`, `87.236.0.0/16`, `185.247.0.0/16` |
| Hetzner Online GmbH (AS24940) | 38 | 0.0% | 11 | 14 | `88.198.0.0/16`, `116.202.0.0/16`, `91.98.0.0/16`, `157.90.0.0/16` |
| Oracle Corporation (AS31898) | 38 | 0.0% | 3 | 3 | `129.213.0.0/16`, `141.148.0.0/16`, `129.121.0.0/16` |
| NetLab Global (AS979) | 37 | 0.0% | 2 | 2 | `154.44.0.0/16`, `64.81.0.0/16` |
| Scloud Pte Ltd (AS142002) | 37 | 0.0% | 1 | 2 | `165.154.0.0/16` |
| FiberPower LLC (AS214483) | 36 | 0.0% | 1 | 1 | `23.148.0.0/16` |
| EGIHosting (AS18779) | 34 | 0.0% | 6 | 20 | `104.165.0.0/16`, `23.27.0.0/16`, `172.120.0.0/16`, `136.0.0.0/16` |
| Dedik Services Limited (AS209413) | 32 | 0.0% | 1 | 1 | `176.65.0.0/16` |
| Comcast Cable Communications, LLC (AS7922) | 32 | 0.0% | 21 | 24 | `48.46.0.0/16`, `48.44.0.0/16`, `48.45.0.0/16`, `68.60.0.0/16` |
| Web2Objects LLC (AS62874) | 31 | 0.0% | 3 | 10 | `142.147.0.0/16`, `104.238.0.0/16`, `45.56.0.0/16` |
| HostPapa (AS36352) | 31 | 0.0% | 11 | 21 | `107.173.0.0/16`, `107.175.0.0/16`, `192.227.0.0/16`, `75.127.0.0/16` |
| Unidentified | 31 | 0.0% | 2 | 2 | `172.18.0.0/16`, `unknown` |
| WebWorld (AS30900) | 30 | 0.0% | 5 | 13 | `82.23.0.0/16`, `82.24.0.0/16`, `82.21.0.0/16`, `82.25.0.0/16` |
| Evoxt Sdn. Bhd. (AS149440) | 28 | 0.0% | 1 | 1 | `96.126.0.0/16` |
| LogicWeb Inc. (AS64286) | 26 | 0.0% | 5 | 11 | `149.57.0.0/16`, `154.6.0.0/16`, `64.64.0.0/16`, `173.239.0.0/16` |
| B2 Net Solutions Inc. (AS55286) | 26 | 0.0% | 9 | 17 | `38.154.0.0/16`, `152.232.0.0/16`, `209.127.0.0/16`, `23.229.0.0/16` |
| Leaseweb Canada Inc. (AS32613) | 24 | 0.0% | 1 | 15 | `192.175.0.0/16` |
| Latitude.sh (AS396356) | 22 | 0.0% | 5 | 16 | `81.168.0.0/16`, `185.48.0.0/16`, `92.113.0.0/16`, `216.173.0.0/16` |
| Latitude.sh LTDA (AS262287) | 21 | 0.0% | 5 | 13 | `45.39.0.0/16`, `104.252.0.0/16`, `45.38.0.0/16`, `85.198.0.0/16` |
| Tier.Net Technologies LLC (AS397423) | 19 | 0.0% | 5 | 9 | `31.59.0.0/16`, `198.37.0.0/16`, `31.58.0.0/16`, `173.0.0.0/16` |
| Modat B.V. (AS209334) | 18 | 0.0% | 1 | 8 | `85.217.0.0/16` |
| Charter Communications LLC (AS20115) | 17 | 0.0% | 6 | 11 | `198.138.0.0/16`, `162.218.0.0/16`, `199.58.0.0/16`, `35.144.0.0/16` |
| IP Volume inc (AS202425) | 17 | 0.0% | 5 | 8 | `94.102.0.0/16`, `89.248.0.0/16`, `93.174.0.0/16`, `45.140.0.0/16` |
| AT&T Enterprises, LLC (AS7018) | 16 | 0.0% | 14 | 14 | `104.56.0.0/16`, `99.63.0.0/16`, `107.206.0.0/16`, `108.79.0.0/16` |
| Verizon Business (AS701) | 15 | 0.0% | 9 | 9 | `100.17.0.0/16`, `108.39.0.0/16`, `65.206.0.0/16`, `71.111.0.0/16` |
| Hydra Communications Ltd (AS25369) | 15 | 0.0% | 5 | 14 | `2.57.0.0/16`, `200.138.0.0/16`, `154.16.0.0/16`, `77.67.0.0/16` |
| HostRoyale LLC (AS46516) | 14 | 0.0% | 3 | 9 | `45.41.0.0/16`, `45.61.0.0/16`, `104.232.0.0/16` |
| HIVELOCITY, Inc. (AS29802) | 14 | 0.0% | 3 | 7 | `92.112.0.0/16`, `185.101.0.0/16`, `45.91.0.0/16` |
| SYN LTD (AS64080) | 13 | 0.0% | 4 | 8 | `45.43.0.0/16`, `107.181.0.0/16`, `155.254.0.0/16`, `198.105.0.0/16` |
| Charter Communications Inc (AS11426) | 13 | 0.0% | 5 | 9 | `108.59.0.0/16`, `175.29.0.0/16`, `62.72.0.0/16`, `94.103.0.0/16` |
| Ace Data Centers, Inc. (AS11798) | 13 | 0.0% | 4 | 9 | `142.111.0.0/16`, `50.114.0.0/16`, `23.26.0.0/16`, `185.216.0.0/16` |
| Cox Communications Inc. (AS22773) | 13 | 0.0% | 6 | 10 | `90.96.0.0/16`, `68.231.0.0/16`, `184.181.0.0/16`, `68.102.0.0/16` |
| CHINA UNICOM China169 Backbone (AS4837) | 12 | 0.0% | 5 | 7 | `113.224.0.0/16`, `113.232.0.0/16`, `153.0.0.0/16`, `124.90.0.0/16` |
| Korea Telecom (AS4766) | 11 | 0.0% | 2 | 2 | `59.14.0.0/16`, `211.230.0.0/16` |
| Colocation America Corporation (AS21769) | 10 | 0.0% | 5 | 8 | `184.174.0.0/16`, `67.227.0.0/16`, `104.224.0.0/16`, `173.211.0.0/16` |
| Comcast Cable Communications, LLC (AS33659) | 10 | 0.0% | 3 | 6 | `170.100.0.0/16`, `138.226.0.0/16`, `45.58.0.0/16` |
| British Telecommunications Limited (AS2856) | 10 | 0.0% | 2 | 4 | `31.121.0.0/16`, `151.245.0.0/16` |
| Hype Enterprises (AS13332) | 10 | 0.0% | 3 | 5 | `206.206.0.0/16`, `174.140.0.0/16`, `216.74.0.0/16` |
| Internet Resources Management SRL (AS48955) | 10 | 0.0% | 5 | 7 | `188.214.0.0/16`, `89.40.0.0/16`, `193.176.0.0/16`, `193.239.0.0/16` |
| Turk Telekom (AS9121) | 10 | 0.0% | 2 | 2 | `212.156.0.0/16`, `95.3.0.0/16` |
| Blatant (AS403005) | 10 | 0.0% | 1 | 1 | `64.89.0.0/16` |
| Yanoor Islam Khan (AS213186) | 10 | 0.0% | 1 | 1 | `98.142.0.0/16` |
| Chinanet (AS4134) | 9 | 0.0% | 6 | 7 | `49.87.0.0/16`, `123.160.0.0/16`, `120.39.0.0/16`, `182.138.0.0/16` |
| GLOBAL COMMUNICATION NETWORK LIMITED (AS152179) | 9 | 0.0% | 2 | 4 | `13.143.0.0/16`, `31.77.0.0/16` |
| Global Transit Systems LLC (AS213954) | 9 | 0.0% | 2 | 5 | `185.201.0.0/16`, `185.168.0.0/16` |
| LINZ STROM GAS WAERME GmbH fuer Energiedienstleistungen und Telekommunikation (AS35369) | 9 | 0.0% | 1 | 2 | `185.242.0.0/16` |
| Leaseweb USA, Inc. (AS396190) | 9 | 0.0% | 1 | 4 | `191.101.0.0/16` |
| Level 3 Parent, LLC (AS3356) | 8 | 0.0% | 1 | 6 | `205.169.0.0/16` |
| FDCservers.net (AS30058) | 8 | 0.0% | 2 | 5 | `82.108.0.0/16`, `213.169.0.0/16` |
| Hosting Ukraine LTD (AS200525) | 7 | 0.0% | 1 | 1 | `104.250.0.0/16` |
| Psychz Networks (AS40676) | 7 | 0.0% | 2 | 3 | `146.103.0.0/16`, `205.236.0.0/16` |
| Cogent Communications, LLC (AS174) | 7 | 0.0% | 5 | 6 | `154.21.0.0/16`, `149.100.0.0/16`, `151.241.0.0/16`, `154.9.0.0/16` |
| Leaseweb USA, Inc. (AS395954) | 7 | 0.0% | 3 | 6 | `152.163.0.0/16`, `208.70.0.0/16`, `212.42.0.0/16` |
| Leaseweb USA, Inc. (AS27411) | 7 | 0.0% | 1 | 3 | `166.88.0.0/16` |
| GRUPO PANAGLOBAL 15 S.A (AS264617) | 7 | 0.0% | 3 | 4 | `170.231.0.0/16`, `185.191.0.0/16`, `89.249.0.0/16` |
| SYN LTD (AS50077) | 7 | 0.0% | 1 | 4 | `185.135.0.0/16` |
| Palestine Telecommunications Company (PALTEL) (AS12975) | 6 | 0.0% | 4 | 4 | `103.239.0.0/16`, `150.253.0.0/16`, `188.161.0.0/16`, `212.14.0.0/16` |
| Getechbrothers, MB (AS202044) | 6 | 0.0% | 2 | 3 | `104.233.0.0/16`, `104.143.0.0/16` |
| MEVSPACE sp. z o.o. (AS201814) | 6 | 0.0% | 1 | 1 | `149.50.0.0/16` |
| Reliance Jio Infocomm Limited (AS55836) | 6 | 0.0% | 4 | 5 | `152.59.0.0/16`, `152.58.0.0/16`, `49.37.0.0/16`, `49.43.0.0/16` |
| ASLINE LIMITED (AS137951) | 6 | 0.0% | 1 | 1 | `168.76.0.0/16` |
| Charter Communications Inc (AS10796) | 6 | 0.0% | 4 | 4 | `24.33.0.0/16`, `76.35.0.0/16`, `173.91.0.0/16`, `76.39.0.0/16` |
| F.n.s. Holdings Limited (AS206092) | 6 | 0.0% | 2 | 5 | `45.86.0.0/16`, `185.238.0.0/16` |
| AIS Fibre (AS133481) | 6 | 0.0% | 1 | 2 | `27.130.0.0/16` |
| Cablevision Lightpath LLC (AS54004) | 6 | 0.0% | 1 | 5 | `74.48.0.0/16` |
| Wave Broadband (AS11404) | 6 | 0.0% | 1 | 4 | `82.22.0.0/16` |
| SONDATECH S.A.S. (AS263812) | 5 | 0.0% | 1 | 1 | `108.165.0.0/16` |
| RCN (AS6079) | 5 | 0.0% | 3 | 4 | `108.171.0.0/16`, `216.133.0.0/16`, `170.124.0.0/16` |
| Zenlayer Inc (AS21859) | 5 | 0.0% | 1 | 3 | `109.105.0.0/16` |
| Shenzhen Tencent Computer Systems Company Limited (AS45090) | 5 | 0.0% | 4 | 4 | `49.233.0.0/16`, `119.91.0.0/16`, `192.144.0.0/16`, `42.193.0.0/16` |
| GSL Networks Pty LTD (AS137409) | 5 | 0.0% | 4 | 5 | `203.25.0.0/16`, `147.90.0.0/16`, `217.145.0.0/16`, `69.33.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS39486) | 5 | 0.0% | 3 | 5 | `171.22.0.0/16`, `194.116.0.0/16`, `193.42.0.0/16` |
| Blix Solutions AS (AS50304) | 5 | 0.0% | 2 | 3 | `181.214.0.0/16`, `193.138.0.0/16` |
| TOTAL PLAY TELECOMUNICACIONES, S.A.P.I. DE C.V. (AS17072) | 5 | 0.0% | 3 | 3 | `187.189.0.0/16`, `187.188.0.0/16`, `189.203.0.0/16` |
| ASN for TIANJIN Provincial Net of CT (AS17638) | 5 | 0.0% | 2 | 3 | `221.239.0.0/16`, `221.238.0.0/16` |
| AltusHost B.V. (AS51430) | 5 | 0.0% | 2 | 3 | `82.27.0.0/16`, `37.46.0.0/16` |
| Netlen Internet Hizmetleri Ltd. Sti. (AS44620) | 5 | 0.0% | 1 | 1 | `45.74.0.0/16` |
| 1&1 Versatel GmbH (AS8881) | 5 | 0.0% | 3 | 3 | `89.245.0.0/16`, `89.247.0.0/16`, `89.246.0.0/16` |
| Microsoft Azure | 4 | 0.0% | 2 | 2 | `10.0.0.0/16`, `10.234.0.0/16` |
| Cyber Internet Services (Pvt) Ltd. (AS9541) | 4 | 0.0% | 3 | 3 | `101.53.0.0/16`, `43.242.0.0/16`, `72.255.0.0/16` |
| Trytek LLC (AS44056) | 4 | 0.0% | 1 | 2 | `109.196.0.0/16` |
| Philippine Long Distance Telephone Company (AS9299) | 4 | 0.0% | 2 | 2 | `119.93.0.0/16`, `112.209.0.0/16` |
| TM TECHNOLOGY SERVICES SDN. BHD. (AS4788) | 4 | 0.0% | 4 | 4 | `115.135.0.0/16`, `180.75.0.0/16`, `202.188.0.0/16`, `218.111.0.0/16` |
| SAKURA Internet Inc. (AS7684) | 4 | 0.0% | 1 | 1 | `133.242.0.0/16` |
| Apple Inc. (AS714) | 4 | 0.0% | 1 | 1 | `17.166.0.0/16` |
| Alex Largman (AS59651) | 4 | 0.0% | 1 | 2 | `170.168.0.0/16` |
| Vodafone GmbH (AS3209) | 4 | 0.0% | 2 | 2 | `178.27.0.0/16`, `92.208.0.0/16` |
| Telefonica de Argentina (AS22927) | 4 | 0.0% | 3 | 3 | `201.177.0.0/16`, `181.20.0.0/16`, `186.128.0.0/16` |
| UAB code200 (AS203061) | 4 | 0.0% | 1 | 4 | `189.81.0.0/16` |
| LeaseWeb Netherlands B.V. (AS60781) | 4 | 0.0% | 2 | 2 | `193.25.0.0/16`, `82.192.0.0/16` |
| UAB Bite Lietuva (AS210906) | 4 | 0.0% | 3 | 4 | `217.69.0.0/16`, `86.38.0.0/16`, `89.116.0.0/16` |
| Charter Communications Inc (AS12271) | 4 | 0.0% | 2 | 2 | `47.230.0.0/16`, `98.15.0.0/16` |
| VeriSign Infrastructure & Operations (AS11840) | 4 | 0.0% | 1 | 1 | `72.13.0.0/16` |
| kabelplus GmbH (AS8339) | 4 | 0.0% | 1 | 1 | `81.217.0.0/16` |
| WS Telecom Inc (AS213541) | 4 | 0.0% | 1 | 1 | `85.28.0.0/16` |
| Office National des Postes et Telecommunications ONPT (Maroc Telecom) / IAM (AS36903) | 3 | 0.0% | 3 | 3 | `105.156.0.0/16`, `196.89.0.0/16`, `41.141.0.0/16` |
| Bharti Airtel Ltd., Telemedia Services (AS24560) | 3 | 0.0% | 3 | 3 | `106.219.0.0/16`, `122.161.0.0/16`, `122.176.0.0/16` |
| Interserver, Inc (AS19318) | 3 | 0.0% | 1 | 1 | `107.148.0.0/16` |
| Datacamp Limited (AS60068) | 3 | 0.0% | 2 | 2 | `138.199.0.0/16`, `185.152.0.0/16` |
| IT7 Networks Inc (AS25820) | 3 | 0.0% | 1 | 1 | `144.34.0.0/16` |
| Internet Vikings International AB (AS51747) | 3 | 0.0% | 3 | 3 | `151.248.0.0/16`, `192.36.0.0/16`, `193.182.0.0/16` |
| Contabo GmbH (AS51167) | 3 | 0.0% | 2 | 3 | `157.173.0.0/16`, `161.97.0.0/16` |
| China Telecom (AS138169) | 3 | 0.0% | 1 | 1 | `171.111.0.0/16` |
| UAB code200 (AS209709) | 3 | 0.0% | 1 | 3 | `185.210.0.0/16` |
| UNIFIQUE TELECOMUNICACOES S/A (AS28343) | 3 | 0.0% | 1 | 1 | `186.232.0.0/16` |
| Kyivstar PJSC (AS15895) | 3 | 0.0% | 1 | 1 | `188.163.0.0/16` |
| Cyberzone S.A. (AS209854) | 3 | 0.0% | 2 | 2 | `45.95.0.0/16`, `193.56.0.0/16` |
| Glesys Sweden AB (AS42708) | 3 | 0.0% | 2 | 2 | `85.203.0.0/16`, `194.14.0.0/16` |
| Windstream Communications LLC (AS7029) | 3 | 0.0% | 3 | 3 | `208.52.0.0/16`, `64.84.0.0/16`, `91.124.0.0/16` |
| Uzbektelekom Joint Stock Company (AS8193) | 3 | 0.0% | 2 | 2 | `213.230.0.0/16`, `84.54.0.0/16` |
| JSC Ukrtelecom (AS6849) | 3 | 0.0% | 2 | 2 | `46.201.0.0/16`, `37.55.0.0/16` |
| trafficforce, UAB (AS133944) | 3 | 0.0% | 2 | 2 | `45.141.0.0/16`, `43.245.0.0/16` |
| web2objects GmbH (AS204646) | 3 | 0.0% | 2 | 3 | `45.150.0.0/16`, `45.159.0.0/16` |
| Surwitel Comunicaciones, S.l. (AS215927) | 3 | 0.0% | 1 | 2 | `5.252.0.0/16` |
| INEA sp. z o.o. (AS13110) | 3 | 0.0% | 1 | 1 | `77.65.0.0/16` |
| Shock Hosting LLC (AS395092) | 3 | 0.0% | 1 | 3 | `82.26.0.0/16` |
| Server Galactic Private Limited (AS150423) | 3 | 0.0% | 1 | 3 | `87.82.0.0/16` |
| JSC Selectel (AS49505) | 3 | 0.0% | 1 | 1 | `91.206.0.0/16` |
| SOCIETE NATIONALE DES TELECOMMUNICATIONS (Tunisie Telecom) (AS327934) | 2 | 0.0% | 1 | 1 | `102.152.0.0/16` |
| Lexistar Alliance Ltd. (AS329225) | 2 | 0.0% | 1 | 1 | `102.212.0.0/16` |
| Chittagong multi channel limited, (AS137029) | 2 | 0.0% | 1 | 1 | `103.102.0.0/16` |
| Antaranga Dot Com Ltd (AS132298) | 2 | 0.0% | 2 | 2 | `103.133.0.0/16`, `103.135.0.0/16` |
| Smart Online (AS139813) | 2 | 0.0% | 1 | 1 | `103.145.0.0/16` |
| Varendra IT (AS151391) | 2 | 0.0% | 1 | 1 | `103.150.0.0/16` |
| UNIVISION LLC (AS17882) | 2 | 0.0% | 1 | 1 | `103.212.0.0/16` |
| HZ Hosting Ltd (AS202015) | 2 | 0.0% | 1 | 1 | `103.228.0.0/16` |
| Comilla Online (AS133443) | 2 | 0.0% | 1 | 1 | `103.229.0.0/16` |
| Sky Broadband Pvt. Ltd (AS136908) | 2 | 0.0% | 1 | 1 | `103.96.0.0/16` |
| Oy Crea Nova Hosting Solution Ltd (AS51765) | 2 | 0.0% | 1 | 2 | `103.99.0.0/16` |
| Google LLC (AS36040) | 2 | 0.0% | 1 | 1 | `136.22.0.0/16` |
| Google Fiber Inc. (AS16591) | 2 | 0.0% | 2 | 2 | `136.38.0.0/16`, `136.53.0.0/16` |
| Connect Northwest Internet Services, LLC (AS10557) | 2 | 0.0% | 1 | 1 | `142.252.0.0/16` |
| Giganet Comunicacoes Multimidia Ltda (AS263487) | 2 | 0.0% | 1 | 1 | `143.255.0.0/16` |
| Breezeline (AS11776) | 2 | 0.0% | 2 | 2 | `146.168.0.0/16`, `23.245.0.0/16` |
| Sia Nano IT (AS43513) | 2 | 0.0% | 1 | 2 | `150.107.0.0/16` |
| Wind Tre S.p.A. (AS1267) | 2 | 0.0% | 1 | 1 | `151.56.0.0/16` |
| QuickPacket, LLC (AS46261) | 2 | 0.0% | 1 | 1 | `154.29.0.0/16` |
| ENEL S.p.A (AS202098) | 2 | 0.0% | 1 | 1 | `158.47.0.0/16` |
| Proton AG (AS208172) | 2 | 0.0% | 1 | 1 | `159.26.0.0/16` |
| BL Networks (AS399629) | 2 | 0.0% | 2 | 2 | `168.100.0.0/16`, `206.188.0.0/16` |
| Fusiora OU (AS214693) | 2 | 0.0% | 1 | 1 | `169.128.0.0/16` |
| Earthlink Telecommunications Equipment Trading & Services DMCC (AS199739) | 2 | 0.0% | 1 | 2 | `169.224.0.0/16` |
| Uniti Fiber Holdings Inc. (AS13760) | 2 | 0.0% | 1 | 1 | `170.249.0.0/16` |
| True Online (AS17552) | 2 | 0.0% | 1 | 1 | `171.96.0.0/16` |
| Code200, UAB (AS149428) | 2 | 0.0% | 1 | 2 | `172.102.0.0/16` |
| Rogers Communications Canada Inc. (AS812) | 2 | 0.0% | 1 | 1 | `173.32.0.0/16` |
| LLC Multiservice (AS52043) | 2 | 0.0% | 1 | 1 | `176.124.0.0/16` |
| Emirates Telecommunications Group Company (etisalat Group) Pjsc (AS5384) | 2 | 0.0% | 2 | 2 | `176.204.0.0/16`, `5.193.0.0/16` |
| EVEO S.A. (AS53107) | 2 | 0.0% | 1 | 1 | `177.136.0.0/16` |
| UFINET PANAMA S.A. (AS52468) | 2 | 0.0% | 2 | 2 | `177.234.0.0/16`, `190.60.0.0/16` |
| Natel Telecom Ltda. - ME (AS262468) | 2 | 0.0% | 1 | 1 | `177.53.0.0/16` |
| Space Exploration Technologies Corporation (AS14593) | 2 | 0.0% | 1 | 1 | `179.65.0.0/16` |
| Comfort XXI Century Ltd. (AS204144) | 2 | 0.0% | 1 | 1 | `185.112.0.0/16` |
| Energy Bridge Sarl (AS56902) | 2 | 0.0% | 1 | 1 | `185.128.0.0/16` |
| SERVICIOS DE TELECOMUNICACIONES SETEL S.A. (XTRIM EC) (AS14522) | 2 | 0.0% | 1 | 1 | `186.66.0.0/16` |
| Mega Cable, S.A. de C.V. (AS13999) | 2 | 0.0% | 2 | 2 | `187.244.0.0/16`, `201.165.0.0/16` |
| Keminet SHPK (AS197706) | 2 | 0.0% | 2 | 2 | `188.68.0.0/16`, `31.171.0.0/16` |
| UNINET (AS8151) | 2 | 0.0% | 1 | 1 | `189.179.0.0/16` |
| INTERNET CORDOBA S.A.S (AS270099) | 2 | 0.0% | 1 | 1 | `190.109.0.0/16` |
| COLOMBIA TELECOMUNICACIONES S.A. ESP BIC (AS3816) | 2 | 0.0% | 1 | 1 | `190.66.0.0/16` |
| web2objects GmbH (AS50495) | 2 | 0.0% | 2 | 2 | `194.113.0.0/16`, `45.151.0.0/16` |
| O.m.c. Computers & Communications Ltd (AS44709) | 2 | 0.0% | 2 | 2 | `194.36.0.0/16`, `79.108.0.0/16` |
| Naukowa I Akademicka Siec Komputerowa - Panstwowy Instytut Badawczy (AS8308) | 2 | 0.0% | 1 | 1 | `195.164.0.0/16` |
| Web Telecom Services (PTY) Ltd (AS328029) | 2 | 0.0% | 1 | 1 | `196.61.0.0/16` |
| 3S INF (AS37671) | 2 | 0.0% | 1 | 1 | `197.15.0.0/16` |
| BIA PADUA INTERNET E S.C.M. LTDA (AS262519) | 2 | 0.0% | 1 | 1 | `201.131.0.0/16` |
| Servers.com, Inc. (AS7979) | 2 | 0.0% | 1 | 2 | `23.109.0.0/16` |
| Link3 Technologies Ltd. (AS23688) | 2 | 0.0% | 1 | 1 | `27.147.0.0/16` |
| Spetsnet LLC (AS44019) | 2 | 0.0% | 1 | 1 | `31.128.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS44144) | 2 | 0.0% | 2 | 2 | `31.223.0.0/16`, `84.247.0.0/16` |
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
| Limestone Networks, Inc. (AS46475) | 2 | 0.0% | 1 | 2 | `77.83.0.0/16` |
| Lanet Network Ltd (AS49332) | 2 | 0.0% | 1 | 1 | `80.243.0.0/16` |
| IONOS SE (AS8560) | 2 | 0.0% | 1 | 1 | `82.223.0.0/16` |
| Virgin Media (AS5089) | 2 | 0.0% | 1 | 1 | `86.18.0.0/16` |
| Deutsche Telekom AG (AS3320) | 2 | 0.0% | 1 | 1 | `91.16.0.0/16` |
| ONYPHE SAS (AS213412) | 2 | 0.0% | 2 | 2 | `91.230.0.0/16`, `91.231.0.0/16` |
| Caspian Telecom LLC (AS201167) | 2 | 0.0% | 1 | 1 | `94.20.0.0/16` |
| PT Remala Abadi (AS38511) | 1 | 0.0% | 1 | 1 | `101.255.0.0/16` |
| Glide Student & Residential Limited (AS42689) | 1 | 0.0% | 1 | 1 | `103.104.0.0/16` |
| Kwikzo Telecomm Pvt Ltd (AS137114) | 1 | 0.0% | 1 | 1 | `103.111.0.0/16` |
| MD Firozur Rahman (AS137976) | 1 | 0.0% | 1 | 1 | `103.119.0.0/16` |
| Net Gate (Pvt) Ltd (AS142295) | 1 | 0.0% | 1 | 1 | `103.167.0.0/16` |
| KKD BROADBAND PRIVATE LIMITED (AS142527) | 1 | 0.0% | 1 | 1 | `103.171.0.0/16` |
| Elyzium Technologies Pvt. Ltd. (AS134319) | 1 | 0.0% | 1 | 1 | `103.194.0.0/16` |
| Adeo Datacenter ApS (AS202914) | 1 | 0.0% | 1 | 1 | `103.37.0.0/16` |
| trafficforce, UAB (AS202496) | 1 | 0.0% | 1 | 1 | `104.249.0.0/16` |
| LLC McLaut-Invest (AS25133) | 1 | 0.0% | 1 | 1 | `109.227.0.0/16` |
| Donbass Electronic Communications Ltd. (AS20590) | 1 | 0.0% | 1 | 1 | `109.254.0.0/16` |
| Binariang Berhad (AS9534) | 1 | 0.0% | 1 | 1 | `113.211.0.0/16` |
| PT. Simaya Jejaring Mandiri (AS38783) | 1 | 0.0% | 1 | 1 | `115.178.0.0/16` |
| DZCRD Networks Ltd (AS132817) | 1 | 0.0% | 1 | 1 | `119.42.0.0/16` |
| Fast Servers (Pty) Ltd (AS35830) | 1 | 0.0% | 1 | 1 | `130.49.0.0/16` |
| Globe Telecoms (AS4775) | 1 | 0.0% | 1 | 1 | `138.84.0.0/16` |
| HZ Hosting Ltd (AS59711) | 1 | 0.0% | 1 | 1 | `140.99.0.0/16` |
| N. DE CARVALHO SANTANA EIRELI (AS264050) | 1 | 0.0% | 1 | 1 | `143.137.0.0/16` |
| Tele2 SWIPnet (AS1257) | 1 | 0.0% | 1 | 1 | `150.241.0.0/16` |
| netcup GmbH (AS214996) | 1 | 0.0% | 1 | 1 | `152.53.0.0/16` |
| RouterHosting LLC (AS14956) | 1 | 0.0% | 1 | 1 | `153.75.0.0/16` |
| Hytron Network Services Limited (AS151407) | 1 | 0.0% | 1 | 1 | `154.88.0.0/16` |
| CONNECT 3 (AS138548) | 1 | 0.0% | 1 | 1 | `157.15.0.0/16` |
| TIME dotCom Berhad No. 14, Jalan Majistret U1/26 Hicom Glenmarie Industrial Park 40150 Shah A (AS9930) | 1 | 0.0% | 1 | 1 | `161.142.0.0/16` |
| ColoUp (AS19084) | 1 | 0.0% | 1 | 1 | `162.245.0.0/16` |
| HK Broadband Network Ltd. (AS10103) | 1 | 0.0% | 1 | 1 | `165.84.0.0/16` |
| LINKEAR SRL (AS263801) | 1 | 0.0% | 1 | 1 | `168.196.0.0/16` |
| 4G Telecom (AS327786) | 1 | 0.0% | 1 | 1 | `169.255.0.0/16` |
| Zkillu SAS (AS215599) | 1 | 0.0% | 1 | 1 | `169.40.0.0/16` |
| Ezee Fiber (AS35847) | 1 | 0.0% | 1 | 1 | `170.203.0.0/16` |
| PE Zinstein Hariton Vladimirovich (AS43936) | 1 | 0.0% | 1 | 1 | `176.101.0.0/16` |
| Limited Liability Company Radio Network (AS198820) | 1 | 0.0% | 1 | 1 | `176.118.0.0/16` |
| BTT TELECOMUNICACOES S.A. (AS28656) | 1 | 0.0% | 1 | 1 | `177.55.0.0/16` |
| Republican Unitary Telecommunication Enterprise Beltelecom (AS6697) | 1 | 0.0% | 1 | 1 | `178.120.0.0/16` |
| Mada Al-Arab General Services Company (AS51407) | 1 | 0.0% | 1 | 1 | `178.130.0.0/16` |
| PrJSC VF UKRAINE (AS21497) | 1 | 0.0% | 1 | 1 | `178.136.0.0/16` |
| Pombonet Telecomunicacoes e Informatica (AS262988) | 1 | 0.0% | 1 | 1 | `179.125.0.0/16` |
| FASTNET TELECOM (AS52711) | 1 | 0.0% | 1 | 1 | `179.96.0.0/16` |
| Telecel S.A. (AS23201) | 1 | 0.0% | 1 | 1 | `181.120.0.0/16` |
| Telefonica del Sur S.A. (AS14117) | 1 | 0.0% | 1 | 1 | `181.226.0.0/16` |
| Tarin General Trading and Setting Up Internet Device LTD (AS197882) | 1 | 0.0% | 1 | 1 | `185.184.0.0/16` |
| Bamboozle Web Services MEA FZ-LLC (AS200851) | 1 | 0.0% | 1 | 1 | `185.243.0.0/16` |
| BRASIL TECPAR AMIGO AVATO (AS262907) | 1 | 0.0% | 1 | 1 | `186.195.0.0/16` |
| CORPORACION NACIONAL DE TELECOMUNICACIONES - CNT EP (AS28006) | 1 | 0.0% | 1 | 1 | `186.46.0.0/16` |
| Hostinger Operations UAB (AS47583) | 1 | 0.0% | 1 | 1 | `187.124.0.0/16` |
| SIM INTERNET PROVEDORES DE INTERNET EIRELI. (AS28267) | 1 | 0.0% | 1 | 1 | `187.17.0.0/16` |
| Crelcom LLC (AS6789) | 1 | 0.0% | 1 | 1 | `188.114.0.0/16` |
| Three (AS206067) | 1 | 0.0% | 1 | 1 | `188.30.0.0/16` |
| BVNET S.A. (AS27833) | 1 | 0.0% | 1 | 1 | `190.1.0.0/16` |
| networksdelmanana.com (AS52485) | 1 | 0.0% | 1 | 1 | `190.123.0.0/16` |
| Manquehuenet (AS18822) | 1 | 0.0% | 1 | 1 | `190.215.0.0/16` |
| Telecom Argentina S.A. (AS7303) | 1 | 0.0% | 1 | 1 | `190.247.0.0/16` |
| Cincinnati Bell Telephone Company LLC (AS6181) | 1 | 0.0% | 1 | 1 | `192.24.0.0/16` |
| Performive LLC (AS46562) | 1 | 0.0% | 1 | 1 | `192.252.0.0/16` |
| Saudi Telecom Company JSC (AS25019) | 1 | 0.0% | 1 | 1 | `192.7.0.0/16` |
| Gigahost AS (AS56655) | 1 | 0.0% | 1 | 1 | `193.200.0.0/16` |
| GlobalConnect AB (AS12552) | 1 | 0.0% | 1 | 1 | `194.132.0.0/16` |
| LLC Eksintech (AS3255) | 1 | 0.0% | 1 | 1 | `194.44.0.0/16` |
| Scaleway SAS (AS12876) | 1 | 0.0% | 1 | 1 | `195.154.0.0/16` |
| Orion Network Limited (AS41564) | 1 | 0.0% | 1 | 1 | `196.196.0.0/16` |
| RAIN GROUP HOLDINGS (PTY) LTD (AS37105) | 1 | 0.0% | 1 | 1 | `197.184.0.0/16` |
| Airtel Congo S.A (AS37550) | 1 | 0.0% | 1 | 1 | `197.214.0.0/16` |
| A1 Srbija d.o.o. Beograd (AS44143) | 1 | 0.0% | 1 | 1 | `198.143.0.0/16` |
| The Shadowserver Foundation, Inc. (AS22168) | 1 | 0.0% | 1 | 1 | `199.165.0.0/16` |
| Leaseweb USA, Inc. (AS394380) | 1 | 0.0% | 1 | 1 | `199.180.0.0/16` |
| Digicel St.Lucia Ltd (AS395561) | 1 | 0.0% | 1 | 1 | `199.223.0.0/16` |
| Clouvider Limited (AS62240) | 1 | 0.0% | 1 | 1 | `200.162.0.0/16` |
| Poxley Provedor de Internet Ltda (AS61763) | 1 | 0.0% | 1 | 1 | `201.159.0.0/16` |
| ANGKOR DATA COMMUNICATION (AS38235) | 1 | 0.0% | 1 | 1 | `203.147.0.0/16` |
| Cogetel Online, Cambodia, ISP (AS23673) | 1 | 0.0% | 1 | 1 | `203.189.0.0/16` |
| Leaseweb Deutschland GmbH (AS28753) | 1 | 0.0% | 1 | 1 | `204.217.0.0/16` |
| Brightspeed (AS19901) | 1 | 0.0% | 1 | 1 | `208.161.0.0/16` |
| VIM TV LTD (AS199702) | 1 | 0.0% | 1 | 1 | `213.149.0.0/16` |
| Alexhost S.r.l. (AS200019) | 1 | 0.0% | 1 | 1 | `217.156.0.0/16` |
| CMPak Limited (AS138423) | 1 | 0.0% | 1 | 1 | `223.123.0.0/16` |
| Webhosting Holdings LLC (AS965) | 1 | 0.0% | 1 | 1 | `23.129.0.0/16` |
| Kazi Sazzad Hossain T/A Millennium Computers & Networking (AS134113) | 1 | 0.0% | 1 | 1 | `27.123.0.0/16` |
| Dhaka Fiber Net Limited (AS55492) | 1 | 0.0% | 1 | 1 | `27.131.0.0/16` |
| WorldLink Communications Pvt Ltd (AS17501) | 1 | 0.0% | 1 | 1 | `27.34.0.0/16` |
| Hathway IP Over Cable Internet (AS17488) | 1 | 0.0% | 1 | 1 | `27.4.0.0/16` |
| PT Telekomunikasi Indonesia (AS7713) | 1 | 0.0% | 1 | 1 | `36.69.0.0/16` |
| Leaseweb UK Limited (AS205544) | 1 | 0.0% | 1 | 1 | `37.44.0.0/16` |
| Aztelekom LLC (AS28787) | 1 | 0.0% | 1 | 1 | `37.61.0.0/16` |
| China Mobile communications corporation (AS56041) | 1 | 0.0% | 1 | 1 | `39.182.0.0/16` |
| Safaricom Limited (AS37061) | 1 | 0.0% | 1 | 1 | `41.139.0.0/16` |
| Vox Telecom Ltd (AS11845) | 1 | 0.0% | 1 | 1 | `41.193.0.0/16` |
| FPT Telecom Company (AS18403) | 1 | 0.0% | 1 | 1 | `42.114.0.0/16` |
| BIZNET NETWORKS (AS17451) | 1 | 0.0% | 1 | 1 | `45.126.0.0/16` |
| Pfcloud UG (haftungsbeschrankt) (AS51396) | 1 | 0.0% | 1 | 1 | `45.144.0.0/16` |
| High Speed For Internet Services L.L.C (AS216472) | 1 | 0.0% | 1 | 1 | `45.149.0.0/16` |
| DB3 SERVICOS DE TELECOMUNICACOES S.A (AS28598) | 1 | 0.0% | 1 | 1 | `45.179.0.0/16` |
| WELINK (AS135405) | 1 | 0.0% | 1 | 1 | `45.195.0.0/16` |
| M M da Silva (AS267324) | 1 | 0.0% | 1 | 1 | `45.233.0.0/16` |
| NARI EQUIPAMENTOS DE COMUNICACAO (AS268277) | 1 | 0.0% | 1 | 1 | `45.237.0.0/16` |
| Kappa Internet Services Private Limited (AS45433) | 1 | 0.0% | 1 | 1 | `45.250.0.0/16` |
| NetJoin Srl (AS64445) | 1 | 0.0% | 1 | 1 | `45.83.0.0/16` |
| Leaseweb USA, Inc. (AS30633) | 1 | 0.0% | 1 | 1 | `46.202.0.0/16` |
| ISP Alliance a.s. (AS47232) | 1 | 0.0% | 1 | 1 | `46.29.0.0/16` |
| Omani Qatari Telecommunication Company SAOC (AS50010) | 1 | 0.0% | 1 | 1 | `46.40.0.0/16` |
| Rostelecom (AS12389) | 1 | 0.0% | 1 | 1 | `5.139.0.0/16` |
| MTS PJSC (AS8359) | 1 | 0.0% | 1 | 1 | `5.144.0.0/16` |
| Saudi Telecom Company JSC (AS39891) | 1 | 0.0% | 1 | 1 | `51.235.0.0/16` |
| Companhia de Telecomunicacoes de Macau SARL (AS4609) | 1 | 0.0% | 1 | 1 | `60.246.0.0/16` |
| I.Q Online for Internet Services and Communications LLC (AS62419) | 1 | 0.0% | 1 | 1 | `62.201.0.0/16` |
| LREMC Technologies, L.L.C. (AS33574) | 1 | 0.0% | 1 | 1 | `64.255.0.0/16` |
| Horry Telephone Cooperative, Inc. (AS21565) | 1 | 0.0% | 1 | 1 | `66.153.0.0/16` |
| Shaw Communications (AS6327) | 1 | 0.0% | 1 | 1 | `68.146.0.0/16` |
| WideOpenWest Finance LLC (AS12083) | 1 | 0.0% | 1 | 1 | `69.73.0.0/16` |
| Charter Communications Inc (AS11427) | 1 | 0.0% | 1 | 1 | `72.181.0.0/16` |
| Columbus Telecommunications (Barbados) Limited (AS14813) | 1 | 0.0% | 1 | 1 | `72.51.0.0/16` |
| Hurricane Electric LLC (AS6939) | 1 | 0.0% | 1 | 1 | `74.82.0.0/16` |
| Charter Communications Inc (AS20001) | 1 | 0.0% | 1 | 1 | `76.94.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS133499) | 1 | 0.0% | 1 | 1 | `77.95.0.0/16` |
| Abissnet sh.a. (AS35047) | 1 | 0.0% | 1 | 1 | `80.91.0.0/16` |
| Etihad Salam Telecom CJSC (AS35753) | 1 | 0.0% | 1 | 1 | `82.167.0.0/16` |
| INCUBATEC GmbH - Srl (AS34081) | 1 | 0.0% | 1 | 1 | `84.33.0.0/16` |
| TTNET LLC (AS213670) | 1 | 0.0% | 1 | 1 | `85.132.0.0/16` |
| Aire Networks Del Mediterraneo Sl Unipersonal (AS29119) | 1 | 0.0% | 1 | 1 | `88.148.0.0/16` |
| Davydov Vladimir Dmitrievich (AS44533) | 1 | 0.0% | 1 | 1 | `89.251.0.0/16` |
| Charter Communications Inc (AS7843) | 1 | 0.0% | 1 | 1 | `9.236.0.0/16` |
| Nikita Sergienko (AS35381) | 1 | 0.0% | 1 | 1 | `91.207.0.0/16` |
| Global Technologies of Ukraine LLC (AS61163) | 1 | 0.0% | 1 | 1 | `91.236.0.0/16` |
| Performance-Net LLC (AS209221) | 1 | 0.0% | 1 | 1 | `91.247.0.0/16` |
| Kaspersky Lab Switzerland GmbH (AS200107) | 1 | 0.0% | 1 | 1 | `93.159.0.0/16` |
| JSC Ufanet (AS41704) | 1 | 0.0% | 1 | 1 | `94.41.0.0/16` |
| Global Network Management Inc (AS42065) | 1 | 0.0% | 1 | 1 | `95.161.0.0/16` |
| Awaser Oman LLC (AS204170) | 1 | 0.0% | 1 | 1 | `96.9.0.0/16` |
| Verizon Business (AS6167) | 1 | 0.0% | 1 | 1 | `97.237.0.0/16` |

## Non-bot fingerprints (top 15 by hits)

Same user-agent hash across many ranges usually means one operator or toolkit.

| User agent | Hits | IPs | /16s | Owners | Mode | Requests |
| --- | ---: | ---: | ---: | --- | --- | --- |
| `Chrome 49 / Windows NT 6.1` | 6,521 | 61 | 7 | AGOTOZ PTE. LTD. (AS9465), CHINANET Guangdong province netwo | direct fetch | favicon.ico |
| `Chrome 131 / Macintosh` | 2,629 | 21 | 20 | Google LLC (AS396982), HostRoyale Technologies Pvt Ltd (AS39 | direct fetch | env / secrets, config / framework dirs |
| `Chrome 131 / Linux` | 2,368 | 16 | 18 | Amazon.com, Inc. (AS16509), Google LLC (AS396982), Techoff S | direct fetch | env / secrets, config / framework dirs |
| `Chrome 131 / Windows NT 10` | 2,296 | 24 | 23 | Akamai Connected Cloud (AS63949), Alibaba (US) Technology Co | direct fetch | env / secrets, config / framework dirs |
| `Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb` | 1,942 | 11 | 11 | Alexhost S.r.l. (AS200019), Google LLC (AS396982), RCN (AS60 | direct fetch | env / secrets, config / framework dirs |
| `facebookexternalhit/1.1 (+http://www.facebook.com/` | 1,020 | 308 | 3 | Facebook, Inc. (AS32934) | direct fetch | robots.txt |
| `Chrome 114 / Android 12` | 928 | 7 | 7 | Google LLC (AS396982) | direct fetch | support, pricing, marketplace |
| `Chrome 147 / Windows NT 10` | 877 | 24 | 12 | Alibaba (US) Technology Co., Ltd. (AS45102), Clouvider Limit | link-follower | env / secrets |
| `Safari 13 / iPhone OS 13.2.3` | 781 | 331 | 37 | Shenzhen Tencent Computer Systems Company Limited (AS45090), | direct fetch | learn, integrations, tools |
| `Chrome 120 / Windows NT 10` | 686 | 24 | 28 | 1&1 Versatel GmbH (AS8881), Amazon.com, Inc. (AS14618), Evox | direct fetch | php shells / probes, wordpress |
| `Chrome 133 / Linux` | 669 | 3 | 2 | Tc Datacenter Limited (AS218785), Techoff Srv Limited (AS480 | direct fetch | version control / CI, config / framework dirs |
| `Chrome 133 / Macintosh` | 623 | 2 | 2 | Tc Datacenter Limited (AS218785), Techoff Srv Limited (AS480 | direct fetch | config / framework dirs, env / secrets |
| `Chrome 151 / Linux` | 515 | 207 | 129 | Amazon.com, Inc. (AS14618) | direct fetch | favicon.ico |
| `Mozilla/5.0 (compatible; XML Sitemaps Generator; w` | 505 | 2 | 1 | Team Blue Carrier Limited (AS34282) | link-follower | careers, marketplace, help-centre |
| `Chrome 151 / Android 16` | 503 | 209 | 126 | Amazon.com, Inc. (AS14618) | direct fetch | favicon.ico |

## What the probes ask for

| Category | Requests |  |
| --- | ---: | --- |
| env / secrets | 1,515 | `████████████████████` |
| wordpress | 662 | `█████████` |
| config / framework dirs | 512 | `███████` |
| php shells / probes | 347 | `█████` |
| version control / CI | 254 | `███` |
| backups / db dumps | 98 | `█` |
| actuator / swagger | 88 | `█` |

Most requested paths: `wp-includes` (276), `.env` (207), `.git` (147), `xmlrpc.php` (96), `wp-admin` (86), `actuator` (84), `config` (81), `wp-login.php` (79), `app` (72), `wp-content` (72), `core` (64), `.env.production` (63)

## Notes

- Totals use each group's own hit counter; per-IP counters in the logs are rolling-window values and undercount heavy hitters.
- Owners come from the MaxMind GeoLite2-ASN database (majority ASN of the IPs seen in each /16).
- Bot IPs were checked against the vendors' published range files. Bots without a file are unchecked.
- User agents can be spoofed; vendor tokens are only trustworthy when the IP range matches the vendor.
