# Crawler trap traffic report

_Built from 2099 log files. Window: 2026-11-22 03:45 to 2026-11-26 09:18 UTC (101.6 h)._

| Metric | Value |
| --- | ---: |
| Logged hits | 316,680 |
| Bot-labelled hits | 285,269 (90.1%) |
| Distinct IPs | 3,292 |
| /16 ranges | 1,204 |
| Hostnames seen | 441 |
| Ban entries | 913 |
| Requests logged during bans | 733,005 |

## Traffic mix

| Source | Hits | Share |  |
| --- | ---: | ---: | --- |
| OAI-SearchBot | 139,601 | 44.1% | `████████████████████` |
| ClaudeBot | 111,309 | 35.1% | `████████████████` |
| GPTBot | 34,200 | 10.8% | `█████` |
| non-bot user agents | 31,411 | 9.9% | `█████` |
| l9scan | 128 | 0.0% | `█` |
| Googlebot | 16 | 0.0% | `█` |
| Claude-User | 9 | 0.0% | `█` |
| Applebot | 4 | 0.0% | `█` |
| ChatGPT-User | 2 | 0.0% | `█` |

## Daily totals (6 of 6 days)

Day = the date in the log filename (server-local day), newest first.

| Day | Hits | OAI-SearchBot | ClaudeBot | GPTBot | other bots | non-bot | IPs | During bans |
| --- | ---: | ---: | ---: | ---: | ---: | ---: | ---: | ---: |
| 2026-11-26 | 11,640 | 5,809 | 2,959 | 2,267 | 0 | 605 | 863 | 45,830 |
| 2026-11-25 | 61,567 | 32,341 | 12,872 | 12,625 | 0 | 3,729 | 1,285 | 225,619 |
| 2026-11-24 | 60,065 | 27,437 | 14,924 | 13,275 | 13 | 4,416 | 983 | 160,593 |
| 2026-11-23 | 95,676 | 45,266 | 38,957 | 3,712 | 136 | 7,605 | 974 | 186,027 |
| 2026-11-22 | 86,226 | 28,355 | 41,191 | 2,282 | 10 | 14,388 | 1,189 | 106,354 |
| 2026-11-21 | 1,506 | 393 | 406 | 39 | 0 | 668 | 322 | 8,582 |

## Requests received (served plus logged during bans)

`Served` is the maze's normal hit counter. `During bans` counts requests that arrived while the source was banned and were tarpitted. Together they show how hard each source really pushes.

| Source | Served | During bans | Received | Share | % of requests banned |  |
| --- | ---: | ---: | ---: | ---: | ---: | --- |
| GPTBot | 34,200 | 554,340 | 588,540 | 56.1% | 94.2% | `████████████████████` |
| OAI-SearchBot | 139,601 | 163,384 | 302,985 | 28.9% | 53.9% | `██████████` |
| ClaudeBot | 111,309 | 15,052 | 126,361 | 12.0% | 11.9% | `████` |
| non-bot | 31,411 | 229 | 31,640 | 3.0% | 0.7% | `█` |
| l9scan | 128 | 0 | 128 | 0.0% | 0.0% | `█` |
| Googlebot | 16 | 0 | 16 | 0.0% | 0.0% | `█` |
| Claude-User | 9 | 0 | 9 | 0.0% | 0.0% | `█` |
| Applebot | 4 | 0 | 4 | 0.0% | 0.0% | `█` |
| ChatGPT-User | 2 | 0 | 2 | 0.0% | 0.0% | `█` |

## Crawler behaviour

**Pace and IP use.** Single-use IPs were seen for under a minute. Requests per minute are averaged over each bot's own active window.

| Bot | Served req/min | Incl. banned req/min | IPs | Single-use IPs | Median IP lifetime (h) | Longest (h) |
| --- | ---: | ---: | ---: | ---: | ---: | ---: |
| OAI-SearchBot | 23.0 | 49.8 | 260 | 3 | 99.8 | 101.3 |
| ClaudeBot | 18.3 | 20.7 | 7 | 3 | 21.7 | 101.6 |
| GPTBot | 5.6 | 96.6 | 373 | 89 | 53.8 | 100.8 |
| l9scan | 2.5 | 2.5 | 4 | 4 | 0.0 | 0.0 |

**IP churn per day.** Active IPs, with brand-new IPs in brackets. A bot that keeps finding new IPs has a pool larger than what has been seen.

| Day | OAI-SearchBot | ClaudeBot | GPTBot | l9scan |
| --- | ---: | ---: | ---: | ---: |
| 2026-11-21 | 203 (+203) | 1 (+1) | 34 (+34) | - |
| 2026-11-22 | 257 (+54) | 1 (+0) | 172 (+152) | - |
| 2026-11-23 | 257 (+0) | 2 (+1) | 149 (+54) | 4 (+4) |
| 2026-11-24 | 255 (+1) | 5 (+3) | 270 (+76) | - |
| 2026-11-25 | 255 (+1) | 6 (+2) | 269 (+23) | - |
| 2026-11-26 | 255 (+1) | 3 (+0) | 301 (+34) | - |

**Bans.** A median gap equal to the ban length means the source is re-banned the moment each ban expires.

| Bot | Bans | By kind | Median gap between bans (s) | Busiest hour (UTC) | Ban length |
| --- | ---: | --- | ---: | ---: | --- |
| OAI-SearchBot | 584 | ip 579, agent 2, subnet 2, group 1 | 3623 | 04:00 | 10 min |
| GPTBot | 308 | ip 299, group 4, subnet 4, agent 1 | 601 | 04:00 | 10 min |
| ClaudeBot | 15 | ip 6, subnet 4, group 3, agent 2 | 3938 | 04:00 | 10 min |
| non-bot | 6 | agent 2, ip 2, subnet 2 | 1895 | 04:00 | 10 min |

**Section focus.** Evenness runs from 0 (one section only) to 1 (perfectly even). robots.txt, sitemap.xml and favicon.ico are excluded.

| Bot | Content requests | Sections | Top-4 share | Evenness | Top sections |
| --- | ---: | ---: | ---: | ---: | --- |
| ClaudeBot | 89,205 | 38 | 51.0% | 0.79 | learn 15,157, tutorials 12,319, developers 10,118, docs 7,874 |
| GPTBot | 27,823 | 37 | 72.8% | 0.47 | learn 19,457, comparison 273, knowledge-base 271, services 265 |
| l9scan | 112 | 25 | 25.0% | 0.98 | api 12, graphql 8, console 4, server 4 |

**Topic focus.** Counts come from /learn/<group>/<topic> page requests; evenness runs from 0 (one topic only) to 1 (perfectly even). Older logs have no topic data, so this grows as new logs arrive. 12 of these counts come from the one-time backfill of old logs' last paths (marked topics_backfilled in the logs).

| Bot | Topic requests | Topics | Top-4 share | Evenness | Top topics |
| --- | ---: | ---: | ---: | ---: | --- |
| ClaudeBot | 15,161 | 21 | 66.1% | 0.72 | python-programming 4,703, debugging-code 2,189, javascript 2,186, no-code-low-code 951 |
| GPTBot | 19,466 | 100 | 4.7% | 1.00 | machine-learning 231, ai-marketing 230, programming-languages 227, wordpress-care 226 |

## Crawl funnel

Requests at each step of the discovery path; the percentage is the share of the previous step that reached this one. Homepage hits are served requests with no section recorded (overwhelmingly the root path). The steps are request volumes, not sessions: a bot can fetch the sitemap without asking for robots.txt, or walk section pages without visiting the homepage, so a later step can exceed the one before it. Clicked and direct are shares of all served hits. The steps are section-based counts: the /learn/ step is the learn section count, counted separately from the topic-request counter behind Topic focus, so the two figures need not match.

| Bot | robots.txt | sitemap.xml | Homepage | Section pages | /learn/ pages | Clicked | Direct |
| --- | ---: | ---: | ---: | ---: | ---: | ---: | ---: |
| OAI-SearchBot | 139,601 | 0 (0.0%) | 0 (0%) | 0 (0%) | 0 (0%) | 0 (0.0%) | 139,601 (100.0%) |
| ClaudeBot | 12,864 | 8,173 (63.5%) | 1,067 (13.1%) | 74,048 (6939.8%) | 15,157 (20.5%) | 0 (0.0%) | 111,309 (100.0%) |
| GPTBot | 1 | 6,224 (622400.0%) | 19 (0.3%) | 8,366 (44031.6%) | 19,457 (232.6%) | 27,613 (80.7%) | 6,587 (19.3%) |
| l9scan | 0 | 0 (0%) | 16 (0%) | 112 (700.0%) | 0 (0.0%) | 0 (0.0%) | 128 (100.0%) |

**Topic groups.** Requests by topic group, across all visitors.

| Group | Requests | Share | Top bots |
| --- | ---: | ---: | --- |
| programming-and-software | 15,380 | 43.8% | ClaudeBot 13,432, GPTBot 1,902 |
| data-and-analytics | 3,156 | 9.0% | GPTBot 1,950, ClaudeBot 1,171 |
| cloud-security-and-it | 2,701 | 7.7% | GPTBot 2,026, ClaudeBot 557 |
| ai-and-machine-learning | 2,038 | 5.8% | GPTBot 1,994, non-bot 44 |
| school-science-and-knowledge | 1,996 | 5.7% | GPTBot 1,955, non-bot 40 |
| business-marketing-and-finance | 1,995 | 5.7% | GPTBot 1,957, non-bot 38 |
| health-fitness-and-wellness | 1,987 | 5.7% | GPTBot 1,951, non-bot 36 |
| career-and-professional-skills | 1,970 | 5.6% | GPTBot 1,937, non-bot 33 |
| creative-design-and-media | 1,938 | 5.5% | GPTBot 1,904, non-bot 34 |
| life-home-and-hobbies | 1,928 | 5.5% | GPTBot 1,890, non-bot 38 |

**robots.txt violations.** Requests that ignored a Disallow: crawling while banned (a banned visitor's robots.txt says Disallow: / for the ban duration), or fetching /admin/, /cart/ or /api/, which the public robots.txt disallows. The /robots.txt fetch itself never counts. Older logs have no violation data, so this grows as new logs arrive.

| Bot | Violations | Share | Banned requests |
| --- | ---: | ---: | ---: |
| GPTBot | 267,198 | 100.0% | 554,340 |
| non-bot | 17 | 0.0% | 0 |
| non-bot | 16 | 0.0% | 0 |
| non-bot | 15 | 0.0% | 0 |
| non-bot | 13 | 0.0% | 7 |
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
| non-bot | 1 | 0.0% | 0 |

## Hits by domain

Per-host counting covers 211,745 of 316,680 served hits (66.9%). Older logs have no hostname data, so this grows as new logs arrive.

**By base domain** (last two labels, so a few multi-part suffixes may group oddly)

| Domain | Hostnames | Served | During bans | Top bots (served) |
| --- | ---: | ---: | ---: | --- |
| `nishad.top` | 1291 | 200,666 | 307,124 | ClaudeBot 85,610, OAI-SearchBot 77,937, non-bot 29,808 |
| `chickenkiller.com` | 2 | 6,413 | 93 | ClaudeBot 6,200, non-bot 213 |
| `twilightparadox.com` | 1 | 3,898 | 53 | ClaudeBot 3,266, non-bot 631, GPTBot 1 |
| `mooo.com` | 1 | 760 | 8 | non-bot 499, ClaudeBot 240, GPTBot 21 |
| `0.1` | 1 | 5 | 0 | non-bot 5 |
| `my.to` | 1 | 2 | 0 | non-bot 2 |
| `crabdance.com` | 1 | 1 | 0 | non-bot 1 |

**Busiest hostnames**

| Hostname | Served | During bans | Top bots (served) |
| --- | ---: | ---: | --- |
| `news.nishad.top` | 187,730 | 301,640 | ClaudeBot 80,554, OAI-SearchBot 77,751, non-bot 22,908 |
| `cleo.chickenkiller.com` | 6,412 | 93 | ClaudeBot 6,200, non-bot 212 |
| `recorded.twilightparadox.com` | 3,898 | 53 | ClaudeBot 3,266, non-bot 631, GPTBot 1 |
| `database-zone.nishad.top` | 1,682 | 31 | ClaudeBot 1,681, non-bot 1 |
| `support-base.nishad.top` | 803 | 0 | ClaudeBot 803 |
| `kamka.mooo.com` | 760 | 8 | non-bot 499, ClaudeBot 240, GPTBot 21 |
| `appdev.nishad.top` | 422 | 0 | non-bot 422 |
| `metube.nishad.top` | 396 | 0 | non-bot 396 |
| `voicebridge.lab.nishad.top` | 372 | 0 | non-bot 372 |
| `firefox.nishad.top` | 345 | 0 | non-bot 345 |
| `apptest.nishad.top` | 343 | 0 | non-bot 343 |
| `hosting.nishad.top` | 52 | 237 | ClaudeBot 48, non-bot 2, GPTBot 2 |
| `io.nishad.top` | 266 | 0 | non-bot 266 |
| `updates-central.nishad.top` | 19 | 247 | non-bot 12, ClaudeBot 7 |
| `news.app.nishad.top` | 241 | 0 | non-bot 240, Googlebot 1 |

## Named crawlers

### OAI-SearchBot

- **Owner:** Microsoft Corporation (AS8075)
- **Hits:** 139,601 (44.1%) from 260 IP(s) in 2 /16 range(s)
- **/24 ranges (IPs):** `74.7.230.0/24` (52), `74.7.244.0/24` (52), `74.7.228.0/24` (51), `74.7.241.0/24` (51), `74.7.175.0/24` (50), `51.8.102.0/24` (4)
- **Vendor range check:** all 260 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 139,601 (100.0%); sitemap.xml: 0
- **Requests per IP:** 536.9 average
- **Bans:** 1,246; 163,384 further requests logged while banned
- **Top sections:** robots.txt 139,601
- **User agent:** `Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36; c`

### ClaudeBot

- **Owner:** Amazon.com, Inc. (AS16509), Google LLC (AS396982)
- **Hits:** 111,309 (35.1%) from 7 IP(s) in 4 /16 range(s)
- **/24 ranges (IPs):** `216.73.216.0/24` (3), `34.152.124.0/24` (1), `34.162.191.0/24` (1), `34.162.27.0/24` (1), `34.186.252.0/24` (1)
- **Vendor range check:** all 7 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 12,864 (11.6%); sitemap.xml: 8,173
- **Requests per IP:** 15,901.3 average
- **Bans:** 76; 15,052 further requests logged while banned
- **Top sections:** learn 15,157, robots.txt 12,864, tutorials 12,319, developers 10,118, sitemap.xml 8,173, docs 7,874
- **Top topics:** python-programming 4,703, debugging-code 2,189, javascript 2,186, no-code-low-code 951, game-development 734, programming-languages 660
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; ClaudeBot/1.0; +claudebot@anthropic.com)`

### GPTBot

- **Owner:** Cloudflare, Inc. (AS13335), Fastly, Inc. (AS394192), Microsoft Corporation (AS8075)
- **Hits:** 34,200 (10.8%) from 373 IP(s) in 5 /16 range(s)
- **/24 ranges (IPs):** `74.7.227.0/24` (114), `74.7.241.0/24` (53), `132.196.86.0/24` (52), `74.7.242.0/24` (52), `74.7.243.0/24` (51), `172.182.202.0/24` (24), `172.182.207.0/24` (24), `87.81.224.0/24` (2), +1 more
- **Vendor range check:** 370/373 IPs inside published ranges; **not listed:** `104.29.196.211`, `87.81.224.107`, `87.81.224.64`
- **Link-follow vs direct:** 80.7% followed maze links, 19.3% direct fetches
- **robots.txt requests:** 1 (0.0%); sitemap.xml: 6,224
- **Requests per IP:** 91.7 average
- **Bans:** 388; 554,340 further requests logged while banned
- **robots.txt violations:** 267,198 requests that ignored a Disallow (crawling while banned under Disallow: /, or fetching /admin/, /cart/ or /api/)
- **Top sections:** learn 19,457, sitemap.xml 6,224, comparison 273, knowledge-base 271, services 265, community 264
- **Top topics:** machine-learning 231, ai-marketing 230, programming-languages 227, wordpress-care 226, cybersecurity 222, graphic-design 222
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
| Microsoft Corporation (AS8075) | 174,556 | 55.1% | 13 | 642 | `74.7.0.0/16`, `20.219.0.0/16`, `132.196.0.0/16`, `172.182.0.0/16` |
| Amazon.com, Inc. (AS16509) | 111,679 | 35.3% | 43 | 48 | `216.73.0.0/16`, `18.217.0.0/16`, `13.52.0.0/16`, `184.32.0.0/16` |
| Google LLC (AS396982) | 9,318 | 2.9% | 111 | 158 | `34.154.0.0/16`, `34.96.0.0/16`, `34.79.0.0/16`, `34.62.0.0/16` |
| UCLOUD INFORMATION TECHNOLOGY (HK) LIMITED (AS135377) | 4,618 | 1.5% | 5 | 10 | `152.32.0.0/16`, `154.51.0.0/16`, `103.218.0.0/16`, `123.58.0.0/16` |
| Tencent Building, Kejizhongyi Avenue (AS132203) | 1,801 | 0.6% | 34 | 181 | `43.157.0.0/16`, `43.166.0.0/16`, `43.153.0.0/16`, `43.133.0.0/16` |
| Techoff Srv Limited (AS48090) | 1,777 | 0.6% | 3 | 9 | `195.178.0.0/16`, `45.148.0.0/16`, `93.123.0.0/16` |
| Amazon.com, Inc. (AS14618) | 1,454 | 0.5% | 200 | 482 | `3.235.0.0/16`, `3.238.0.0/16`, `100.54.0.0/16`, `184.195.0.0/16` |
| AGOTOZ PTE. LTD. (AS9465) | 1,393 | 0.4% | 1 | 7 | `156.225.0.0/16` |
| Facebook, Inc. (AS32934) | 1,142 | 0.4% | 4 | 133 | `173.252.0.0/16`, `69.63.0.0/16`, `69.171.0.0/16`, `57.141.0.0/16` |
| Alibaba (US) Technology Co., Ltd. (AS45102) | 618 | 0.2% | 11 | 36 | `43.106.0.0/16`, `8.218.0.0/16`, `47.84.0.0/16`, `43.98.0.0/16` |
| OVH SAS (AS16276) | 521 | 0.2% | 24 | 31 | `158.69.0.0/16`, `51.79.0.0/16`, `57.131.0.0/16`, `139.99.0.0/16` |
| Team Blue Carrier Limited (AS34282) | 507 | 0.2% | 1 | 2 | `85.92.0.0/16` |
| DigitalOcean, LLC (AS14061) | 474 | 0.1% | 44 | 84 | `146.190.0.0/16`, `68.183.0.0/16`, `178.128.0.0/16`, `138.68.0.0/16` |
| CHINANET Guangdong province network (AS58466) | 435 | 0.1% | 1 | 5 | `106.75.0.0/16` |
| NTT America, Inc. (AS2914) | 432 | 0.1% | 1 | 10 | `216.167.0.0/16` |
| Tc Datacenter Limited (AS218785) | 426 | 0.1% | 2 | 4 | `45.138.0.0/16`, `185.218.0.0/16` |
| M247 Europe SRL (AS9009) | 328 | 0.1% | 13 | 48 | `146.70.0.0/16`, `103.4.0.0/16`, `104.253.0.0/16`, `104.239.0.0/16` |
| GitHub, Inc. (AS36459) | 313 | 0.1% | 1 | 13 | `140.82.0.0/16` |
| Cloudflare, Inc. (AS13335) | 242 | 0.1% | 2 | 23 | `104.29.0.0/16`, `104.28.0.0/16` |
| Fastly, Inc. (AS394192) | 229 | 0.1% | 1 | 213 | `87.81.0.0/16` |
| Nexeon Technologies, Inc. (AS20278) | 199 | 0.1% | 2 | 3 | `23.94.0.0/16`, `23.95.0.0/16` |
| BestDC Limited (AS216014) | 190 | 0.1% | 1 | 1 | `193.47.0.0/16` |
| WholeSale Internet, Inc. (AS32097) | 188 | 0.1% | 1 | 1 | `23.128.0.0/16` |
| Cablevision Systems Corp. (AS6128) | 188 | 0.1% | 3 | 4 | `69.115.0.0/16`, `67.87.0.0/16`, `69.121.0.0/16` |
| GTT Communications Inc. (AS3257) | 180 | 0.1% | 2 | 5 | `70.39.0.0/16`, `216.36.0.0/16` |
| VPS Dedicated LLC (AS197769) | 177 | 0.1% | 1 | 2 | `102.220.0.0/16` |
| Eweka Internet Services B.V. (AS34343) | 171 | 0.1% | 2 | 4 | `81.171.0.0/16`, `91.148.0.0/16` |
| 1337 Services GmbH (AS210558) | 165 | 0.1% | 2 | 2 | `45.94.0.0/16`, `185.19.0.0/16` |
| CustodianDC Limited (AS50300) | 154 | 0.0% | 1 | 3 | `5.102.0.0/16` |
| Datacamp Limited (AS212238) | 153 | 0.0% | 22 | 70 | `205.188.0.0/16`, `64.137.0.0/16`, `169.150.0.0/16`, `104.165.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS203020) | 139 | 0.0% | 14 | 34 | `45.92.0.0/16`, `31.209.0.0/16`, `155.94.0.0/16`, `109.196.0.0/16` |
| Censys, Inc. (AS398324) | 137 | 0.0% | 1 | 6 | `66.132.0.0/16` |
| CtrlS (AS18229) | 113 | 0.0% | 1 | 2 | `45.249.0.0/16` |
| Colocation America Corporation (AS47007) | 100 | 0.0% | 1 | 1 | `173.46.0.0/16` |
| Akamai Connected Cloud (AS63949) | 96 | 0.0% | 15 | 36 | `172.236.0.0/16`, `45.79.0.0/16`, `66.228.0.0/16`, `172.239.0.0/16` |
| T-Mobile USA, Inc. (AS21928) | 75 | 0.0% | 3 | 9 | `172.56.0.0/16`, `172.59.0.0/16`, `172.58.0.0/16` |
| TechTies Inc. (AS197170) | 69 | 0.0% | 4 | 7 | `85.11.0.0/16`, `91.92.0.0/16`, `45.156.0.0/16`, `94.26.0.0/16` |
| Virtual Systems LLC (AS6698) | 64 | 0.0% | 2 | 2 | `91.218.0.0/16`, `85.137.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS207990) | 61 | 0.0% | 12 | 30 | `83.229.0.0/16`, `217.194.0.0/16`, `213.255.0.0/16`, `188.212.0.0/16` |
| Hetzner Online GmbH (AS24940) | 46 | 0.0% | 12 | 16 | `88.198.0.0/16`, `116.202.0.0/16`, `91.98.0.0/16`, `204.168.0.0/16` |
| Hangzhou Alibaba Advertising Co.,Ltd. (AS37963) | 46 | 0.0% | 7 | 8 | `8.163.0.0/16`, `8.148.0.0/16`, `120.55.0.0/16`, `47.108.0.0/16` |
| Driftnet Ltd (AS211298) | 44 | 0.0% | 3 | 21 | `195.96.0.0/16`, `87.236.0.0/16`, `185.247.0.0/16` |
| The Constant Company, LLC (AS20473) | 43 | 0.0% | 6 | 6 | `137.220.0.0/16`, `192.248.0.0/16`, `45.63.0.0/16`, `216.238.0.0/16` |
| Web2Objects LLC (AS62874) | 41 | 0.0% | 3 | 16 | `142.147.0.0/16`, `104.238.0.0/16`, `45.56.0.0/16` |
| Unidentified | 41 | 0.0% | 2 | 2 | `172.18.0.0/16`, `unknown` |
| Oracle Corporation (AS31898) | 40 | 0.0% | 3 | 3 | `129.213.0.0/16`, `141.148.0.0/16`, `129.121.0.0/16` |
| LogicWeb Inc. (AS64286) | 40 | 0.0% | 6 | 21 | `149.57.0.0/16`, `154.6.0.0/16`, `64.64.0.0/16`, `98.159.0.0/16` |
| Dedik Services Limited (AS209413) | 39 | 0.0% | 1 | 1 | `176.65.0.0/16` |
| B2 Net Solutions Inc. (AS55286) | 38 | 0.0% | 10 | 25 | `38.154.0.0/16`, `152.232.0.0/16`, `209.127.0.0/16`, `192.241.0.0/16` |
| HostPapa (AS36352) | 37 | 0.0% | 11 | 25 | `107.173.0.0/16`, `107.172.0.0/16`, `107.175.0.0/16`, `192.227.0.0/16` |
| NetLab Global (AS979) | 37 | 0.0% | 2 | 2 | `154.44.0.0/16`, `64.81.0.0/16` |
| Comcast Cable Communications, LLC (AS7922) | 37 | 0.0% | 25 | 29 | `48.46.0.0/16`, `48.44.0.0/16`, `48.45.0.0/16`, `68.60.0.0/16` |
| EGIHosting (AS18779) | 36 | 0.0% | 7 | 23 | `23.27.0.0/16`, `172.120.0.0/16`, `166.88.0.0/16`, `205.164.0.0/16` |
| FiberPower LLC (AS214483) | 36 | 0.0% | 1 | 1 | `23.148.0.0/16` |
| IP Volume inc (AS202425) | 28 | 0.0% | 6 | 11 | `185.242.0.0/16`, `94.102.0.0/16`, `89.248.0.0/16`, `93.174.0.0/16` |
| Evoxt Sdn. Bhd. (AS149440) | 28 | 0.0% | 1 | 1 | `96.126.0.0/16` |
| Charter Communications LLC (AS20115) | 25 | 0.0% | 8 | 14 | `198.138.0.0/16`, `199.58.0.0/16`, `74.112.0.0/16`, `162.218.0.0/16` |
| Leaseweb Canada Inc. (AS32613) | 25 | 0.0% | 2 | 16 | `192.175.0.0/16`, `64.188.0.0/16` |
| Latitude.sh LTDA (AS262287) | 23 | 0.0% | 4 | 14 | `92.112.0.0/16`, `104.252.0.0/16`, `91.123.0.0/16`, `85.198.0.0/16` |
| Hype Enterprises (AS13332) | 22 | 0.0% | 5 | 13 | `206.206.0.0/16`, `67.227.0.0/16`, `184.174.0.0/16`, `174.140.0.0/16` |
| Latitude.sh (AS396356) | 21 | 0.0% | 4 | 14 | `81.168.0.0/16`, `185.48.0.0/16`, `216.173.0.0/16`, `43.229.0.0/16` |
| Tier.Net Technologies LLC (AS397423) | 20 | 0.0% | 5 | 10 | `146.103.0.0/16`, `198.37.0.0/16`, `31.58.0.0/16`, `173.0.0.0/16` |
| Hydra Communications Ltd (AS25369) | 19 | 0.0% | 5 | 16 | `2.57.0.0/16`, `154.16.0.0/16`, `200.138.0.0/16`, `77.67.0.0/16` |
| Modat B.V. (AS209334) | 19 | 0.0% | 1 | 8 | `85.217.0.0/16` |
| SYN LTD (AS64080) | 18 | 0.0% | 5 | 11 | `45.43.0.0/16`, `107.181.0.0/16`, `155.254.0.0/16`, `198.105.0.0/16` |
| AT&T Enterprises, LLC (AS7018) | 17 | 0.0% | 15 | 15 | `104.56.0.0/16`, `99.63.0.0/16`, `107.206.0.0/16`, `108.79.0.0/16` |
| HostRoyale LLC (AS46516) | 16 | 0.0% | 3 | 10 | `45.41.0.0/16`, `45.61.0.0/16`, `104.232.0.0/16` |
| Charter Communications Inc (AS11426) | 16 | 0.0% | 5 | 9 | `175.29.0.0/16`, `108.59.0.0/16`, `62.72.0.0/16`, `94.103.0.0/16` |
| Cyberneticos Hosting SL (AS198968) | 16 | 0.0% | 1 | 3 | `82.23.0.0/16` |
| Verizon Business (AS701) | 15 | 0.0% | 9 | 9 | `100.17.0.0/16`, `108.39.0.0/16`, `65.206.0.0/16`, `71.111.0.0/16` |
| HZ Hosting Ltd (AS202015) | 15 | 0.0% | 2 | 8 | `45.39.0.0/16`, `103.228.0.0/16` |
| GRUPO PANAGLOBAL 15 S.A (AS264617) | 15 | 0.0% | 3 | 4 | `191.101.0.0/16`, `170.231.0.0/16`, `185.191.0.0/16` |
| Alex Largman (AS59651) | 14 | 0.0% | 2 | 7 | `170.168.0.0/16`, `122.8.0.0/16` |
| Cox Communications Inc. (AS22773) | 14 | 0.0% | 6 | 10 | `90.96.0.0/16`, `68.231.0.0/16`, `184.181.0.0/16`, `68.102.0.0/16` |
| WebWorld (AS30900) | 14 | 0.0% | 3 | 8 | `82.25.0.0/16`, `82.24.0.0/16`, `82.29.0.0/16` |
| Comcast Cable Communications, LLC (AS33659) | 13 | 0.0% | 3 | 8 | `138.226.0.0/16`, `170.100.0.0/16`, `45.58.0.0/16` |
| CHINA UNICOM China169 Backbone (AS4837) | 12 | 0.0% | 5 | 7 | `113.224.0.0/16`, `113.232.0.0/16`, `153.0.0.0/16`, `124.90.0.0/16` |
| Chinanet (AS4134) | 12 | 0.0% | 7 | 8 | `171.217.0.0/16`, `49.87.0.0/16`, `123.160.0.0/16`, `120.39.0.0/16` |
| Ace Data Centers, Inc. (AS11798) | 11 | 0.0% | 3 | 8 | `23.26.0.0/16`, `142.111.0.0/16`, `185.216.0.0/16` |
| UAB code200 (AS203061) | 11 | 0.0% | 1 | 8 | `189.81.0.0/16` |
| Korea Telecom (AS4766) | 11 | 0.0% | 2 | 2 | `59.14.0.0/16`, `211.230.0.0/16` |
| Turk Telekom (AS9121) | 11 | 0.0% | 2 | 2 | `212.156.0.0/16`, `95.3.0.0/16` |
| Yanoor Islam Khan (AS213186) | 11 | 0.0% | 1 | 1 | `98.142.0.0/16` |
| SONDATECH S.A.S. (AS263812) | 10 | 0.0% | 2 | 4 | `108.165.0.0/16`, `50.114.0.0/16` |
| GLOBAL COMMUNICATION NETWORK LIMITED (AS152179) | 10 | 0.0% | 2 | 3 | `13.143.0.0/16`, `31.77.0.0/16` |
| British Telecommunications Limited (AS2856) | 10 | 0.0% | 2 | 4 | `31.121.0.0/16`, `151.245.0.0/16` |
| HIVELOCITY, Inc. (AS29802) | 10 | 0.0% | 3 | 5 | `92.113.0.0/16`, `185.101.0.0/16`, `45.91.0.0/16` |
| SYN LTD (AS50077) | 10 | 0.0% | 1 | 7 | `185.135.0.0/16` |
| Internet Resources Management SRL (AS48955) | 10 | 0.0% | 5 | 7 | `188.214.0.0/16`, `89.40.0.0/16`, `193.176.0.0/16`, `193.239.0.0/16` |
| Blatant (AS403005) | 10 | 0.0% | 1 | 1 | `64.89.0.0/16` |
| Server Galactic Private Limited (AS150423) | 10 | 0.0% | 2 | 8 | `82.108.0.0/16`, `87.82.0.0/16` |
| Psychz Networks (AS40676) | 9 | 0.0% | 2 | 4 | `136.0.0.0/16`, `205.236.0.0/16` |
| Cogent Communications, LLC (AS174) | 9 | 0.0% | 6 | 8 | `154.21.0.0/16`, `154.9.0.0/16`, `149.100.0.0/16`, `151.241.0.0/16` |
| Scaleway SAS (AS12876) | 9 | 0.0% | 3 | 5 | `151.115.0.0/16`, `51.158.0.0/16`, `195.154.0.0/16` |
| Limestone Networks, Inc. (AS46475) | 9 | 0.0% | 3 | 5 | `178.20.0.0/16`, `194.99.0.0/16`, `77.83.0.0/16` |
| Global Transit Systems LLC (AS213954) | 9 | 0.0% | 2 | 5 | `185.201.0.0/16`, `185.168.0.0/16` |
| Leaseweb UK Limited (AS205544) | 9 | 0.0% | 2 | 5 | `31.59.0.0/16`, `37.44.0.0/16` |
| Microsoft Azure | 8 | 0.0% | 2 | 4 | `10.0.0.0/16`, `10.234.0.0/16` |
| Hosting Ukraine LTD (AS200525) | 8 | 0.0% | 1 | 2 | `104.250.0.0/16` |
| Leaseweb USA, Inc. (AS395954) | 8 | 0.0% | 3 | 7 | `152.163.0.0/16`, `208.70.0.0/16`, `212.42.0.0/16` |
| Leaseweb Deutschland GmbH (AS28753) | 8 | 0.0% | 2 | 6 | `82.22.0.0/16`, `204.217.0.0/16` |
| Level 3 Parent, LLC (AS3356) | 8 | 0.0% | 1 | 6 | `205.169.0.0/16` |
| Getechbrothers, MB (AS202044) | 7 | 0.0% | 2 | 3 | `104.233.0.0/16`, `104.143.0.0/16` |
| Blix Solutions AS (AS50304) | 7 | 0.0% | 3 | 5 | `181.214.0.0/16`, `172.102.0.0/16`, `193.138.0.0/16` |
| Palestine Telecommunications Company (PALTEL) (AS12975) | 6 | 0.0% | 4 | 4 | `103.239.0.0/16`, `150.253.0.0/16`, `188.161.0.0/16`, `212.14.0.0/16` |
| Zenlayer Inc (AS21859) | 6 | 0.0% | 1 | 4 | `109.105.0.0/16` |
| Shenzhen Tencent Computer Systems Company Limited (AS45090) | 6 | 0.0% | 5 | 5 | `49.233.0.0/16`, `119.91.0.0/16`, `192.144.0.0/16`, `42.193.0.0/16` |
| LeaseWeb Netherlands B.V. (AS60781) | 6 | 0.0% | 4 | 4 | `193.25.0.0/16`, `82.192.0.0/16`, `140.233.0.0/16`, `148.135.0.0/16` |
| MEVSPACE sp. z o.o. (AS201814) | 6 | 0.0% | 1 | 1 | `149.50.0.0/16` |
| Reliance Jio Infocomm Limited (AS55836) | 6 | 0.0% | 4 | 5 | `152.59.0.0/16`, `152.58.0.0/16`, `49.37.0.0/16`, `49.43.0.0/16` |
| ASLINE LIMITED (AS137951) | 6 | 0.0% | 1 | 1 | `168.76.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS39486) | 6 | 0.0% | 3 | 6 | `171.22.0.0/16`, `194.116.0.0/16`, `193.42.0.0/16` |
| Charter Communications Inc (AS10796) | 6 | 0.0% | 4 | 4 | `24.33.0.0/16`, `76.35.0.0/16`, `173.91.0.0/16`, `76.39.0.0/16` |
| UAB code200 (AS209709) | 6 | 0.0% | 1 | 5 | `185.210.0.0/16` |
| F.n.s. Holdings Limited (AS206092) | 6 | 0.0% | 2 | 5 | `45.86.0.0/16`, `185.238.0.0/16` |
| AIS Fibre (AS133481) | 6 | 0.0% | 1 | 2 | `27.130.0.0/16` |
| Netlen Internet Hizmetleri Ltd. Sti. (AS44620) | 6 | 0.0% | 1 | 1 | `45.74.0.0/16` |
| Cablevision Lightpath LLC (AS54004) | 6 | 0.0% | 1 | 5 | `74.48.0.0/16` |
| Colocation America Corporation (AS21769) | 5 | 0.0% | 4 | 5 | `104.224.0.0/16`, `173.211.0.0/16`, `45.127.0.0/16`, `66.78.0.0/16` |
| RCN (AS6079) | 5 | 0.0% | 3 | 4 | `108.171.0.0/16`, `216.133.0.0/16`, `170.124.0.0/16` |
| Windstream Communications LLC (AS7029) | 5 | 0.0% | 4 | 5 | `91.124.0.0/16`, `109.72.0.0/16`, `208.52.0.0/16`, `64.84.0.0/16` |
| GSL Networks Pty LTD (AS137409) | 5 | 0.0% | 4 | 5 | `203.25.0.0/16`, `147.90.0.0/16`, `217.145.0.0/16`, `69.33.0.0/16` |
| TOTAL PLAY TELECOMUNICACIONES, S.A.P.I. DE C.V. (AS17072) | 5 | 0.0% | 3 | 3 | `187.189.0.0/16`, `187.188.0.0/16`, `189.203.0.0/16` |
| ASN for TIANJIN Provincial Net of CT (AS17638) | 5 | 0.0% | 2 | 3 | `221.239.0.0/16`, `221.238.0.0/16` |
| 1&1 Versatel GmbH (AS8881) | 5 | 0.0% | 3 | 3 | `89.245.0.0/16`, `89.247.0.0/16`, `89.246.0.0/16` |
| Cyber Internet Services (Pvt) Ltd. (AS9541) | 4 | 0.0% | 3 | 3 | `101.53.0.0/16`, `43.242.0.0/16`, `72.255.0.0/16` |
| Philippine Long Distance Telephone Company (AS9299) | 4 | 0.0% | 2 | 2 | `119.93.0.0/16`, `112.209.0.0/16` |
| TM TECHNOLOGY SERVICES SDN. BHD. (AS4788) | 4 | 0.0% | 4 | 4 | `115.135.0.0/16`, `180.75.0.0/16`, `202.188.0.0/16`, `218.111.0.0/16` |
| SAKURA Internet Inc. (AS7684) | 4 | 0.0% | 1 | 1 | `133.242.0.0/16` |
| Datacamp Limited (AS60068) | 4 | 0.0% | 2 | 2 | `138.199.0.0/16`, `185.152.0.0/16` |
| QuickPacket, LLC (AS46261) | 4 | 0.0% | 1 | 2 | `154.29.0.0/16` |
| Apple Inc. (AS714) | 4 | 0.0% | 1 | 1 | `17.166.0.0/16` |
| Vodafone GmbH (AS3209) | 4 | 0.0% | 2 | 2 | `178.27.0.0/16`, `92.208.0.0/16` |
| Telefonica de Argentina (AS22927) | 4 | 0.0% | 3 | 3 | `201.177.0.0/16`, `181.20.0.0/16`, `186.128.0.0/16` |
| UAB Bite Lietuva (AS210906) | 4 | 0.0% | 3 | 4 | `217.69.0.0/16`, `86.38.0.0/16`, `89.116.0.0/16` |
| Heart Internet limited (AS20738) | 4 | 0.0% | 1 | 2 | `45.38.0.0/16` |
| Charter Communications Inc (AS12271) | 4 | 0.0% | 2 | 2 | `47.230.0.0/16`, `98.15.0.0/16` |
| VeriSign Infrastructure & Operations (AS11840) | 4 | 0.0% | 1 | 1 | `72.13.0.0/16` |
| kabelplus GmbH (AS8339) | 4 | 0.0% | 1 | 1 | `81.217.0.0/16` |
| EN Technologies Pte Ltd (AS133210) | 4 | 0.0% | 1 | 3 | `82.21.0.0/16` |
| HGC Global Communications Limited (AS9304) | 4 | 0.0% | 1 | 4 | `82.26.0.0/16` |
| WS Telecom Inc (AS213541) | 4 | 0.0% | 1 | 1 | `85.28.0.0/16` |
| Office National des Postes et Telecommunications ONPT (Maroc Telecom) / IAM (AS36903) | 3 | 0.0% | 3 | 3 | `105.156.0.0/16`, `196.89.0.0/16`, `41.141.0.0/16` |
| Bharti Airtel Ltd., Telemedia Services (AS24560) | 3 | 0.0% | 3 | 3 | `106.219.0.0/16`, `122.161.0.0/16`, `122.176.0.0/16` |
| Interserver, Inc (AS19318) | 3 | 0.0% | 1 | 1 | `107.148.0.0/16` |
| IT7 Networks Inc (AS25820) | 3 | 0.0% | 1 | 1 | `144.34.0.0/16` |
| Internet Vikings International AB (AS51747) | 3 | 0.0% | 3 | 3 | `151.248.0.0/16`, `192.36.0.0/16`, `193.182.0.0/16` |
| Contabo GmbH (AS51167) | 3 | 0.0% | 2 | 3 | `157.173.0.0/16`, `161.97.0.0/16` |
| China Telecom (AS138169) | 3 | 0.0% | 1 | 1 | `171.111.0.0/16` |
| UNIFIQUE TELECOMUNICACOES S/A (AS28343) | 3 | 0.0% | 1 | 1 | `186.232.0.0/16` |
| Kyivstar PJSC (AS15895) | 3 | 0.0% | 1 | 1 | `188.163.0.0/16` |
| Keminet SHPK (AS197706) | 3 | 0.0% | 2 | 3 | `188.68.0.0/16`, `31.171.0.0/16` |
| Realcloud OU (AS206804) | 3 | 0.0% | 1 | 1 | `192.159.0.0/16` |
| Cyberzone S.A. (AS209854) | 3 | 0.0% | 2 | 2 | `45.95.0.0/16`, `193.56.0.0/16` |
| web2objects GmbH (AS50495) | 3 | 0.0% | 3 | 3 | `194.113.0.0/16`, `194.39.0.0/16`, `45.151.0.0/16` |
| Glesys Sweden AB (AS42708) | 3 | 0.0% | 2 | 2 | `85.203.0.0/16`, `194.14.0.0/16` |
| Uzbektelekom Joint Stock Company (AS8193) | 3 | 0.0% | 2 | 2 | `213.230.0.0/16`, `84.54.0.0/16` |
| JSC Ukrtelecom (AS6849) | 3 | 0.0% | 2 | 2 | `46.201.0.0/16`, `37.55.0.0/16` |
| trafficforce, UAB (AS133944) | 3 | 0.0% | 2 | 2 | `45.141.0.0/16`, `43.245.0.0/16` |
| Surwitel Comunicaciones, S.l. (AS215927) | 3 | 0.0% | 1 | 2 | `5.252.0.0/16` |
| INEA sp. z o.o. (AS13110) | 3 | 0.0% | 1 | 1 | `77.65.0.0/16` |
| Shock Hosting LLC (AS395092) | 3 | 0.0% | 1 | 2 | `82.27.0.0/16` |
| JSC Selectel (AS49505) | 3 | 0.0% | 1 | 1 | `91.206.0.0/16` |
| SOCIETE NATIONALE DES TELECOMMUNICATIONS (Tunisie Telecom) (AS327934) | 2 | 0.0% | 1 | 1 | `102.152.0.0/16` |
| Lexistar Alliance Ltd. (AS329225) | 2 | 0.0% | 1 | 1 | `102.212.0.0/16` |
| Chittagong multi channel limited, (AS137029) | 2 | 0.0% | 1 | 1 | `103.102.0.0/16` |
| Antaranga Dot Com Ltd (AS132298) | 2 | 0.0% | 2 | 2 | `103.133.0.0/16`, `103.135.0.0/16` |
| Smart Online (AS139813) | 2 | 0.0% | 1 | 1 | `103.145.0.0/16` |
| Varendra IT (AS151391) | 2 | 0.0% | 1 | 1 | `103.150.0.0/16` |
| UNIVISION LLC (AS17882) | 2 | 0.0% | 1 | 1 | `103.212.0.0/16` |
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
| ENEL S.p.A (AS202098) | 2 | 0.0% | 1 | 1 | `158.47.0.0/16` |
| Proton AG (AS208172) | 2 | 0.0% | 1 | 1 | `159.26.0.0/16` |
| BL Networks (AS399629) | 2 | 0.0% | 2 | 2 | `168.100.0.0/16`, `206.188.0.0/16` |
| Fusiora OU (AS214693) | 2 | 0.0% | 1 | 1 | `169.128.0.0/16` |
| Earthlink Telecommunications Equipment Trading & Services DMCC (AS199739) | 2 | 0.0% | 1 | 2 | `169.224.0.0/16` |
| Zkillu SAS (AS215599) | 2 | 0.0% | 1 | 1 | `169.40.0.0/16` |
| Uniti Fiber Holdings Inc. (AS13760) | 2 | 0.0% | 1 | 1 | `170.249.0.0/16` |
| True Online (AS17552) | 2 | 0.0% | 1 | 1 | `171.96.0.0/16` |
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
| UNINET (AS8151) | 2 | 0.0% | 1 | 1 | `189.179.0.0/16` |
| INTERNET CORDOBA S.A.S (AS270099) | 2 | 0.0% | 1 | 1 | `190.109.0.0/16` |
| COLOMBIA TELECOMUNICACIONES S.A. ESP BIC (AS3816) | 2 | 0.0% | 1 | 1 | `190.66.0.0/16` |
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
| AltusHost B.V. (AS51430) | 2 | 0.0% | 1 | 1 | `37.46.0.0/16` |
| ONETECH SERVICOS DE COMUNICACAO E MULTIMIDIA LTDA (AS269501) | 2 | 0.0% | 1 | 1 | `38.43.0.0/16` |
| GALAXY ENTERTAINMENT DE VENEZUELA, S.C.A. (AS263806) | 2 | 0.0% | 1 | 1 | `38.74.0.0/16` |
| web2objects GmbH (AS204646) | 2 | 0.0% | 1 | 2 | `45.150.0.0/16` |
| Doornet sa de cv (AS28433) | 2 | 0.0% | 1 | 1 | `45.174.0.0/16` |
| Sino Worldwide Trading Limited (AS211443) | 2 | 0.0% | 1 | 1 | `46.151.0.0/16` |
| Leaseweb USA, Inc. (AS30633) | 2 | 0.0% | 1 | 2 | `46.202.0.0/16` |
| Super Cell Network For Internet Services Ltd (AS201749) | 2 | 0.0% | 1 | 1 | `5.175.0.0/16` |
| Joint stock company For (AS48642) | 2 | 0.0% | 1 | 1 | `5.199.0.0/16` |
| Digicel Jamaica (AS40786) | 2 | 0.0% | 1 | 1 | `63.143.0.0/16` |
| CariNet, Inc. (AS10439) | 2 | 0.0% | 1 | 1 | `71.6.0.0/16` |
| University of Illinois (AS40387) | 2 | 0.0% | 1 | 1 | `72.36.0.0/16` |
| Lanet Network Ltd (AS49332) | 2 | 0.0% | 1 | 1 | `80.243.0.0/16` |
| IONOS SE (AS8560) | 2 | 0.0% | 1 | 1 | `82.223.0.0/16` |
| INCUBATEC GmbH - Srl (AS34081) | 2 | 0.0% | 1 | 1 | `84.33.0.0/16` |
| Virgin Media (AS5089) | 2 | 0.0% | 1 | 1 | `86.18.0.0/16` |
| Leaseweb USA, Inc. (AS19148) | 2 | 0.0% | 1 | 2 | `89.249.0.0/16` |
| Deutsche Telekom AG (AS3320) | 2 | 0.0% | 1 | 1 | `91.16.0.0/16` |
| ONYPHE SAS (AS213412) | 2 | 0.0% | 2 | 2 | `91.230.0.0/16`, `91.231.0.0/16` |
| Caspian Telecom LLC (AS201167) | 2 | 0.0% | 1 | 1 | `94.20.0.0/16` |
| Verizon Business (AS6167) | 2 | 0.0% | 2 | 2 | `97.237.0.0/16`, `97.244.0.0/16` |
| PT Remala Abadi (AS38511) | 1 | 0.0% | 1 | 1 | `101.255.0.0/16` |
| Glide Student & Residential Limited (AS42689) | 1 | 0.0% | 1 | 1 | `103.104.0.0/16` |
| Kwikzo Telecomm Pvt Ltd (AS137114) | 1 | 0.0% | 1 | 1 | `103.111.0.0/16` |
| MD Firozur Rahman (AS137976) | 1 | 0.0% | 1 | 1 | `103.119.0.0/16` |
| Net Gate (Pvt) Ltd (AS142295) | 1 | 0.0% | 1 | 1 | `103.167.0.0/16` |
| KKD BROADBAND PRIVATE LIMITED (AS142527) | 1 | 0.0% | 1 | 1 | `103.171.0.0/16` |
| Elyzium Technologies Pvt. Ltd. (AS134319) | 1 | 0.0% | 1 | 1 | `103.194.0.0/16` |
| Adeo Datacenter ApS (AS202914) | 1 | 0.0% | 1 | 1 | `103.37.0.0/16` |
| eTOP sp. z o.o. (AS20853) | 1 | 0.0% | 1 | 1 | `104.222.0.0/16` |
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
| LINKEAR SRL (AS263801) | 1 | 0.0% | 1 | 1 | `168.196.0.0/16` |
| 4G Telecom (AS327786) | 1 | 0.0% | 1 | 1 | `169.255.0.0/16` |
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
| 31173 Services AB (AS39351) | 1 | 0.0% | 1 | 1 | `185.213.0.0/16` |
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
| Aztelekom LLC (AS28787) | 1 | 0.0% | 1 | 1 | `37.61.0.0/16` |
| Tech Futures Interactive Inc. (AS394256) | 1 | 0.0% | 1 | 1 | `38.240.0.0/16` |
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

## Non-bot fingerprints (top 15 by hits)

Same user-agent hash across many ranges usually means one operator or toolkit.

| User agent | Hits | IPs | /16s | Owners | Mode | Requests |
| --- | ---: | ---: | ---: | --- | --- | --- |
| `Chrome 49 / Windows NT 6.1` | 6,521 | 61 | 7 | AGOTOZ PTE. LTD. (AS9465), CHINANET Guangdong province netwo | direct fetch | favicon.ico |
| `Chrome 131 / Macintosh` | 2,629 | 21 | 20 | Google LLC (AS396982), HostRoyale Technologies Pvt Ltd (AS39 | direct fetch | env / secrets, config / framework dirs |
| `Chrome 131 / Linux` | 2,368 | 16 | 18 | Amazon.com, Inc. (AS16509), Google LLC (AS396982), Techoff S | direct fetch | env / secrets, config / framework dirs |
| `Chrome 131 / Windows NT 10` | 2,364 | 25 | 24 | Akamai Connected Cloud (AS63949), Alibaba (US) Technology Co | direct fetch | env / secrets, config / framework dirs |
| `Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb` | 1,945 | 10 | 11 | Alexhost S.r.l. (AS200019), Google LLC (AS396982), RCN (AS60 | direct fetch | env / secrets, config / framework dirs |
| `facebookexternalhit/1.1 (+http://www.facebook.com/` | 1,082 | 320 | 3 | Facebook, Inc. (AS32934) | direct fetch | robots.txt |
| `Chrome 114 / Android 12` | 928 | 7 | 7 | Google LLC (AS396982) | direct fetch | support, pricing, marketplace |
| `Safari 13 / iPhone OS 13.2.3` | 881 | 350 | 38 | Shenzhen Tencent Computer Systems Company Limited (AS45090), | direct fetch | learn, integrations, tools |
| `Chrome 147 / Windows NT 10` | 877 | 24 | 12 | Alibaba (US) Technology Co., Ltd. (AS45102), Clouvider Limit | link-follower | env / secrets |
| `Chrome 120 / Windows NT 10` | 745 | 24 | 28 | 1&1 Versatel GmbH (AS8881), Amazon.com, Inc. (AS14618), Evox | direct fetch | php shells / probes, wordpress |
| `Chrome 133 / Linux` | 669 | 3 | 2 | Tc Datacenter Limited (AS218785), Techoff Srv Limited (AS480 | direct fetch | version control / CI, config / framework dirs |
| `Chrome 151 / Linux` | 641 | 264 | 144 | Amazon.com, Inc. (AS14618) | direct fetch | favicon.ico |
| `Chrome 133 / Macintosh` | 623 | 2 | 2 | Tc Datacenter Limited (AS218785), Techoff Srv Limited (AS480 | direct fetch | config / framework dirs, env / secrets |
| `Chrome 151 / Android 16` | 622 | 263 | 143 | Amazon.com, Inc. (AS14618) | direct fetch | favicon.ico |
| `Safari 17 / iPhone OS 17.2` | 519 | 431 | 181 | Ace Data Centers, Inc. (AS11798), Adeo Datacenter ApS (AS202 | direct fetch | favicon.ico |

## What the probes ask for

| Category | Requests |  |
| --- | ---: | --- |
| env / secrets | 1,544 | `████████████████████` |
| wordpress | 678 | `█████████` |
| config / framework dirs | 529 | `███████` |
| php shells / probes | 381 | `█████` |
| version control / CI | 265 | `███` |
| backups / db dumps | 98 | `█` |
| actuator / swagger | 93 | `█` |

Most requested paths: `wp-includes` (276), `.env` (212), `.git` (158), `xmlrpc.php` (97), `wp-admin` (90), `actuator` (88), `wp-login.php` (84), `config` (82), `app` (73), `wp-content` (72), `core` (67), `.env.production` (65)

## Notes

- Totals use each group's own hit counter; per-IP counters in the logs are rolling-window values and undercount heavy hitters.
- Owners come from the MaxMind GeoLite2-ASN database (majority ASN of the IPs seen in each /16).
- Bot IPs were checked against the vendors' published range files. Bots without a file are unchecked.
- User agents can be spoofed; vendor tokens are only trustworthy when the IP range matches the vendor.
