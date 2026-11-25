# Crawler trap traffic report

_Built from 1272 log files. Window: 2026-11-22 03:45 to 2026-11-25 05:29 UTC (73.7 h)._

| Metric | Value |
| --- | ---: |
| Logged hits | 245,770 |
| Bot-labelled hits | 218,657 (89.0%) |
| Distinct IPs | 2,307 |
| /16 ranges | 860 |
| Hostnames seen | 353 |
| Ban entries | 811 |
| Requests logged during bans | 463,994 |
| Form submissions (honeypot) | 2 |

## Traffic mix

| Source | Hits | Share |  |
| --- | ---: | ---: | --- |
| OAI-SearchBot | 103,059 | 41.9% | `████████████████████` |
| ClaudeBot | 95,737 | 39.0% | `███████████████████` |
| non-bot user agents | 27,113 | 11.0% | `█████` |
| GPTBot | 19,702 | 8.0% | `████` |
| l9scan | 128 | 0.1% | `█` |
| Googlebot | 16 | 0.0% | `█` |
| Claude-User | 9 | 0.0% | `█` |
| Applebot | 4 | 0.0% | `█` |
| ChatGPT-User | 2 | 0.0% | `█` |

## Daily totals (5 of 5 days)

Day = the date in the log filename (server-local day), newest first.

| Day | Hits | OAI-SearchBot | ClaudeBot | GPTBot | other bots | non-bot | IPs | During bans |
| --- | ---: | ---: | ---: | ---: | ---: | ---: | ---: | ---: |
| 2026-11-25 | 2,297 | 1,608 | 259 | 394 | 0 | 36 | 466 | 2,438 |
| 2026-11-24 | 60,065 | 27,437 | 14,924 | 13,275 | 13 | 4,416 | 983 | 160,593 |
| 2026-11-23 | 95,676 | 45,266 | 38,957 | 3,712 | 136 | 7,605 | 974 | 186,027 |
| 2026-11-22 | 86,226 | 28,355 | 41,191 | 2,282 | 10 | 14,388 | 1,189 | 106,354 |
| 2026-11-21 | 1,506 | 393 | 406 | 39 | 0 | 668 | 322 | 8,582 |

## Requests received (served plus logged during bans)

`Served` is the maze's normal hit counter. `During bans` counts requests that arrived while the source was banned and were tarpitted. Together they show how hard each source really pushes.

| Source | Served | During bans | Received | Share | % of requests banned |  |
| --- | ---: | ---: | ---: | ---: | ---: | --- |
| GPTBot | 19,702 | 416,013 | 435,715 | 61.4% | 95.5% | `████████████████████` |
| OAI-SearchBot | 103,059 | 32,700 | 135,759 | 19.1% | 24.1% | `██████` |
| ClaudeBot | 95,737 | 15,052 | 110,789 | 15.6% | 13.6% | `█████` |
| non-bot | 27,113 | 229 | 27,342 | 3.9% | 0.8% | `█` |
| l9scan | 128 | 0 | 128 | 0.0% | 0.0% | `█` |
| Googlebot | 16 | 0 | 16 | 0.0% | 0.0% | `█` |
| Claude-User | 9 | 0 | 9 | 0.0% | 0.0% | `█` |
| Applebot | 4 | 0 | 4 | 0.0% | 0.0% | `█` |
| ChatGPT-User | 2 | 0 | 2 | 0.0% | 0.0% | `█` |

## Crawler behaviour

**Pace and IP use.** Single-use IPs were seen for under a minute. Requests per minute are averaged over each bot's own active window.

| Bot | Served req/min | Incl. banned req/min | IPs | Single-use IPs | Median IP lifetime (h) | Longest (h) |
| --- | ---: | ---: | ---: | ---: | ---: | ---: |
| OAI-SearchBot | 23.4 | 30.8 | 258 | 1 | 73.2 | 73.5 |
| ClaudeBot | 21.6 | 25.0 | 5 | 2 | 18.2 | 73.7 |
| GPTBot | 4.5 | 98.5 | 322 | 61 | 48.0 | 73.5 |
| l9scan | 2.5 | 2.5 | 4 | 4 | 0.0 | 0.0 |

**IP churn per day.** Active IPs, with brand-new IPs in brackets. A bot that keeps finding new IPs has a pool larger than what has been seen.

| Day | OAI-SearchBot | ClaudeBot | GPTBot | l9scan |
| --- | ---: | ---: | ---: | ---: |
| 2026-11-21 | 203 (+203) | 1 (+1) | 34 (+34) | - |
| 2026-11-22 | 257 (+54) | 1 (+0) | 172 (+152) | - |
| 2026-11-23 | 257 (+0) | 2 (+1) | 149 (+54) | 4 (+4) |
| 2026-11-24 | 255 (+1) | 5 (+3) | 270 (+76) | - |
| 2026-11-25 | 237 (+0) | 2 (+0) | 194 (+6) | - |

**Bans.** A median gap equal to the ban length means the source is re-banned the moment each ban expires.

| Bot | Bans | By kind | Median gap between bans (s) | Busiest hour (UTC) | Ban length |
| --- | ---: | --- | ---: | ---: | --- |
| OAI-SearchBot | 538 | ip 535, agent 2, subnet 1 | 3624 | 04:00 | 10 min |
| GPTBot | 252 | ip 243, group 4, subnet 4, agent 1 | 601 | 04:00 | 10 min |
| ClaudeBot | 15 | ip 6, subnet 4, group 3, agent 2 | 3938 | 04:00 | 10 min |
| non-bot | 6 | agent 2, ip 2, subnet 2 | 1895 | 04:00 | 10 min |

**Section focus.** Evenness runs from 0 (one section only) to 1 (perfectly even). robots.txt, sitemap.xml and favicon.ico are excluded.

| Bot | Content requests | Sections | Top-4 share | Evenness | Top sections |
| --- | ---: | ---: | ---: | ---: | --- |
| ClaudeBot | 77,348 | 37 | 46.0% | 0.82 | tutorials 12,143, developers 9,968, docs 7,743, learn 5,727 |
| GPTBot | 17,193 | 37 | 61.5% | 0.61 | learn 9,859, comparison 250, pricing 233, services 232 |
| l9scan | 112 | 25 | 25.0% | 0.98 | api 12, graphql 8, console 4, server 4 |

**Topic focus.** Counts come from /learn/<group>/<topic> page requests; evenness runs from 0 (one topic only) to 1 (perfectly even). Older logs have no topic data, so this grows as new logs arrive. 12 of these counts come from the one-time backfill of old logs' last paths (marked topics_backfilled in the logs).

| Bot | Topic requests | Topics | Top-4 share | Evenness | Top topics |
| --- | ---: | ---: | ---: | ---: | --- |
| ClaudeBot | 5,731 | 18 | 72.3% | 0.68 | python-programming 2,498, javascript 714, debugging-code 626, game-development 308 |
| GPTBot | 9,868 | 100 | 4.8% | 1.00 | leadership 122, graphic-design 118, ai-marketing 117, machine-learning 115 |

**Topic groups.** Requests by topic group, across all visitors.

| Group | Requests | Share | Top bots |
| --- | ---: | ---: | --- |
| programming-and-software | 6,219 | 39.2% | ClaudeBot 5,229, GPTBot 970 |
| data-and-analytics | 1,376 | 8.7% | GPTBot 992, ClaudeBot 368 |
| cloud-security-and-it | 1,264 | 8.0% | GPTBot 1,037, ClaudeBot 134 |
| life-home-and-hobbies | 1,018 | 6.4% | GPTBot 999, non-bot 19 |
| business-marketing-and-finance | 1,015 | 6.4% | GPTBot 995, non-bot 20 |
| ai-and-machine-learning | 1,013 | 6.4% | GPTBot 987, non-bot 26 |
| career-and-professional-skills | 1,000 | 6.3% | GPTBot 984, non-bot 16 |
| school-science-and-knowledge | 990 | 6.2% | GPTBot 971, non-bot 19 |
| health-fitness-and-wellness | 989 | 6.2% | GPTBot 976, non-bot 13 |
| creative-design-and-media | 972 | 6.1% | GPTBot 957, non-bot 15 |

**robots.txt violations.** Requests that ignored a Disallow: crawling while banned (a banned visitor's robots.txt says Disallow: / for the ban duration), or fetching /admin/, /cart/ or /api/, which the public robots.txt disallows. The /robots.txt fetch itself never counts. Older logs have no violation data, so this grows as new logs arrive.

| Bot | Violations | Share | Banned requests |
| --- | ---: | ---: | ---: |
| GPTBot | 128,871 | 100.0% | 416,013 |
| non-bot | 9 | 0.0% | 0 |
| non-bot | 8 | 0.0% | 7 |
| non-bot | 3 | 0.0% | 0 |
| non-bot | 1 | 0.0% | 0 |
| non-bot | 1 | 0.0% | 0 |
| non-bot | 1 | 0.0% | 0 |
| non-bot | 1 | 0.0% | 0 |
| non-bot | 1 | 0.0% | 0 |
| non-bot | 1 | 0.0% | 0 |
| non-bot | 1 | 0.0% | 0 |

## Hits by domain

Per-host counting covers 197,618 of 245,770 served hits (80.4%). Older logs have no hostname data, so this grows as new logs arrive.

**By base domain** (last two labels, so a few multi-part suffixes may group oddly)

| Domain | Hostnames | Served | During bans | Top bots (served) |
| --- | ---: | ---: | ---: | --- |
| `nishad.top` | 862 | 194,002 | 303,943 | ClaudeBot 82,670, OAI-SearchBot 77,876, non-bot 26,587 |
| `chickenkiller.com` | 1 | 3,062 | 93 | ClaudeBot 2,968, non-bot 94 |
| `mooo.com` | 1 | 319 | 8 | ClaudeBot 240, non-bot 78, GPTBot 1 |
| `twilightparadox.com` | 1 | 235 | 53 | non-bot 182, ClaudeBot 52, GPTBot 1 |

**Busiest hostnames**

| Hostname | Served | During bans | Top bots (served) |
| --- | ---: | ---: | --- |
| `news.nishad.top` | 187,719 | 301,640 | ClaudeBot 80,554, OAI-SearchBot 77,751, non-bot 22,897 |
| `cleo.chickenkiller.com` | 3,062 | 93 | ClaudeBot 2,968, non-bot 94 |
| `database-zone.nishad.top` | 846 | 31 | ClaudeBot 846 |
| `voicebridge.lab.nishad.top` | 369 | 0 | non-bot 369 |
| `metube.nishad.top` | 343 | 0 | non-bot 343 |
| `firefox.nishad.top` | 341 | 0 | non-bot 341 |
| `appdev.nishad.top` | 340 | 0 | non-bot 340 |
| `apptest.nishad.top` | 340 | 0 | non-bot 340 |
| `kamka.mooo.com` | 319 | 8 | ClaudeBot 240, non-bot 78, GPTBot 1 |
| `recorded.twilightparadox.com` | 235 | 53 | non-bot 182, ClaudeBot 52, GPTBot 1 |
| `app-test.nishad.top` | 169 | 0 | non-bot 169 |
| `database-zone-updates.nishad.top` | 164 | 1 | ClaudeBot 164 |
| `oc.vps.nishad.top` | 161 | 0 | non-bot 161 |
| `news.app.nishad.top` | 136 | 0 | non-bot 135, Googlebot 1 |
| `secure-lab-manage-port.nishad.top` | 0 | 124 |  |

## Named crawlers

### OAI-SearchBot

- **Owner:** Microsoft Corporation (AS8075)
- **Hits:** 103,059 (41.9%) from 258 IP(s) in 2 /16 range(s)
- **/24 ranges (IPs):** `74.7.230.0/24` (52), `74.7.244.0/24` (52), `74.7.228.0/24` (51), `74.7.241.0/24` (51), `74.7.175.0/24` (50), `51.8.102.0/24` (2)
- **Vendor range check:** all 258 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 103,059 (100.0%); sitemap.xml: 0
- **Requests per IP:** 399.5 average
- **Bans:** 1,200; 32,700 further requests logged while banned
- **Top sections:** robots.txt 103,059
- **User agent:** `Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36; c`

### ClaudeBot

- **Owner:** Amazon.com, Inc. (AS16509), Google LLC (AS396982)
- **Hits:** 95,737 (39.0%) from 5 IP(s) in 2 /16 range(s)
- **/24 ranges (IPs):** `216.73.216.0/24` (3), `34.162.191.0/24` (1), `34.162.27.0/24` (1)
- **Vendor range check:** all 5 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 10,007 (10.5%); sitemap.xml: 7,350
- **Requests per IP:** 19,147.4 average
- **Bans:** 76; 15,052 further requests logged while banned
- **Top sections:** tutorials 12,143, robots.txt 10,007, developers 9,968, docs 7,743, sitemap.xml 7,350, learn 5,727
- **Top topics:** python-programming 2,498, javascript 714, debugging-code 626, game-development 308, git-and-version-control 287, data-visualization 264
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; ClaudeBot/1.0; +claudebot@anthropic.com)`

### GPTBot

- **Owner:** Cloudflare, Inc. (AS13335), Fastly, Inc. (AS394192), Microsoft Corporation (AS8075)
- **Hits:** 19,702 (8.0%) from 322 IP(s) in 5 /16 range(s)
- **/24 ranges (IPs):** `74.7.227.0/24` (113), `74.7.242.0/24` (52), `74.7.241.0/24` (51), `74.7.243.0/24` (51), `132.196.86.0/24` (28), `172.182.202.0/24` (15), `172.182.207.0/24` (9), `87.81.224.0/24` (2), +1 more
- **Vendor range check:** 319/322 IPs inside published ranges; **not listed:** `104.29.196.211`, `87.81.224.107`, `87.81.224.64`
- **Link-follow vs direct:** 87.1% followed maze links, 12.9% direct fetches
- **robots.txt requests:** 1 (0.0%); sitemap.xml: 2,362
- **Requests per IP:** 61.2 average
- **Bans:** 323; 416,013 further requests logged while banned
- **robots.txt violations:** 128,871 requests that ignored a Disallow (crawling while banned under Disallow: /, or fetching /admin/, /cart/ or /api/)
- **Top sections:** learn 9,859, sitemap.xml 2,362, comparison 250, pricing 233, services 232, knowledge-base 231
- **Top topics:** leadership 122, graphic-design 118, ai-marketing 117, machine-learning 115, python-programming 115, health-and-symptoms 114
- **User agent:** `Mozilla/5.0 (compatible; GPTBot/1.2)`

### l9scan

- **Owner:** DigitalOcean, LLC (AS14061)
- **Hits:** 128 (0.1%) from 4 IP(s) in 4 /16 range(s)
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
| Microsoft Corporation (AS8075) | 123,390 | 50.2% | 13 | 590 | `74.7.0.0/16`, `20.219.0.0/16`, `172.182.0.0/16`, `132.196.0.0/16` |
| Amazon.com, Inc. (AS16509) | 96,001 | 39.1% | 32 | 35 | `216.73.0.0/16`, `18.217.0.0/16`, `184.32.0.0/16`, `34.209.0.0/16` |
| Google LLC (AS396982) | 8,914 | 3.6% | 91 | 125 | `34.154.0.0/16`, `34.96.0.0/16`, `34.79.0.0/16`, `34.62.0.0/16` |
| UCLOUD INFORMATION TECHNOLOGY (HK) LIMITED (AS135377) | 4,618 | 1.9% | 5 | 10 | `152.32.0.0/16`, `154.51.0.0/16`, `103.218.0.0/16`, `123.58.0.0/16` |
| Techoff Srv Limited (AS48090) | 1,421 | 0.6% | 2 | 6 | `195.178.0.0/16`, `45.148.0.0/16` |
| AGOTOZ PTE. LTD. (AS9465) | 1,393 | 0.6% | 1 | 7 | `156.225.0.0/16` |
| Facebook, Inc. (AS32934) | 919 | 0.4% | 4 | 102 | `173.252.0.0/16`, `57.141.0.0/16`, `69.171.0.0/16`, `69.63.0.0/16` |
| Tencent Building, Kejizhongyi Avenue (AS132203) | 910 | 0.4% | 34 | 136 | `43.157.0.0/16`, `43.166.0.0/16`, `43.130.0.0/16`, `43.135.0.0/16` |
| Amazon.com, Inc. (AS14618) | 615 | 0.3% | 151 | 232 | `3.238.0.0/16`, `3.235.0.0/16`, `32.197.0.0/16`, `44.204.0.0/16` |
| Alibaba (US) Technology Co., Ltd. (AS45102) | 605 | 0.2% | 10 | 33 | `43.106.0.0/16`, `8.218.0.0/16`, `43.98.0.0/16`, `47.84.0.0/16` |
| OVH SAS (AS16276) | 520 | 0.2% | 23 | 30 | `158.69.0.0/16`, `51.79.0.0/16`, `57.131.0.0/16`, `139.99.0.0/16` |
| Team Blue Carrier Limited (AS34282) | 507 | 0.2% | 1 | 2 | `85.92.0.0/16` |
| CHINANET Guangdong province network (AS58466) | 435 | 0.2% | 1 | 5 | `106.75.0.0/16` |
| NTT America, Inc. (AS2914) | 432 | 0.2% | 1 | 10 | `216.167.0.0/16` |
| DigitalOcean, LLC (AS14061) | 405 | 0.2% | 40 | 63 | `68.183.0.0/16`, `178.128.0.0/16`, `146.190.0.0/16`, `138.68.0.0/16` |
| Tc Datacenter Limited (AS218785) | 323 | 0.1% | 1 | 3 | `45.138.0.0/16` |
| GitHub, Inc. (AS36459) | 284 | 0.1% | 1 | 12 | `140.82.0.0/16` |
| M247 Europe SRL (AS9009) | 279 | 0.1% | 9 | 27 | `146.70.0.0/16`, `103.4.0.0/16`, `104.253.0.0/16`, `104.239.0.0/16` |
| Cloudflare, Inc. (AS13335) | 242 | 0.1% | 2 | 23 | `104.29.0.0/16`, `104.28.0.0/16` |
| Nexeon Technologies, Inc. (AS20278) | 199 | 0.1% | 2 | 3 | `23.94.0.0/16`, `23.95.0.0/16` |
| Fastly, Inc. (AS394192) | 199 | 0.1% | 1 | 186 | `87.81.0.0/16` |
| WholeSale Internet, Inc. (AS32097) | 188 | 0.1% | 1 | 1 | `23.128.0.0/16` |
| GTT Communications Inc. (AS3257) | 180 | 0.1% | 2 | 5 | `70.39.0.0/16`, `216.36.0.0/16` |
| VPS Dedicated LLC (AS197769) | 177 | 0.1% | 1 | 2 | `102.220.0.0/16` |
| Cablevision Systems Corp. (AS6128) | 176 | 0.1% | 2 | 2 | `69.115.0.0/16`, `67.87.0.0/16` |
| Eweka Internet Services B.V. (AS34343) | 171 | 0.1% | 2 | 4 | `81.171.0.0/16`, `91.148.0.0/16` |
| 1337 Services GmbH (AS210558) | 165 | 0.1% | 2 | 2 | `45.94.0.0/16`, `185.19.0.0/16` |
| CustodianDC Limited (AS50300) | 154 | 0.1% | 1 | 3 | `5.102.0.0/16` |
| Censys, Inc. (AS398324) | 137 | 0.1% | 1 | 6 | `66.132.0.0/16` |
| Datacamp Limited (AS212238) | 115 | 0.0% | 20 | 50 | `205.188.0.0/16`, `169.150.0.0/16`, `64.137.0.0/16`, `84.233.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS203020) | 114 | 0.0% | 11 | 22 | `45.92.0.0/16`, `31.209.0.0/16`, `155.94.0.0/16`, `209.242.0.0/16` |
| CtrlS (AS18229) | 113 | 0.0% | 1 | 2 | `45.249.0.0/16` |
| Colocation America Corporation (AS47007) | 102 | 0.0% | 2 | 3 | `173.46.0.0/16`, `171.22.0.0/16` |
| Akamai Connected Cloud (AS63949) | 72 | 0.0% | 14 | 26 | `172.236.0.0/16`, `45.79.0.0/16`, `66.228.0.0/16`, `172.239.0.0/16` |
| T-Mobile USA, Inc. (AS21928) | 69 | 0.0% | 3 | 5 | `172.56.0.0/16`, `172.58.0.0/16`, `172.59.0.0/16` |
| Virtual Systems LLC (AS6698) | 64 | 0.0% | 2 | 2 | `91.218.0.0/16`, `85.137.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS207990) | 52 | 0.0% | 9 | 24 | `83.229.0.0/16`, `217.194.0.0/16`, `188.212.0.0/16`, `213.255.0.0/16` |
| TechTies Inc. (AS197170) | 47 | 0.0% | 4 | 6 | `85.11.0.0/16`, `91.92.0.0/16`, `94.26.0.0/16`, `45.156.0.0/16` |
| The Constant Company, LLC (AS20473) | 43 | 0.0% | 6 | 6 | `137.220.0.0/16`, `192.248.0.0/16`, `45.63.0.0/16`, `216.238.0.0/16` |
| Oracle Corporation (AS31898) | 38 | 0.0% | 3 | 3 | `129.213.0.0/16`, `141.148.0.0/16`, `129.121.0.0/16` |
| Driftnet Ltd (AS211298) | 37 | 0.0% | 3 | 16 | `195.96.0.0/16`, `87.236.0.0/16`, `185.247.0.0/16` |
| Hetzner Online GmbH (AS24940) | 36 | 0.0% | 11 | 14 | `88.198.0.0/16`, `91.98.0.0/16`, `116.202.0.0/16`, `157.90.0.0/16` |
| NetLab Global (AS979) | 36 | 0.0% | 1 | 1 | `154.44.0.0/16` |
| FiberPower LLC (AS214483) | 36 | 0.0% | 1 | 1 | `23.148.0.0/16` |
| Evoxt Sdn. Bhd. (AS149440) | 28 | 0.0% | 1 | 1 | `96.126.0.0/16` |
| Unidentified | 25 | 0.0% | 2 | 2 | `172.18.0.0/16`, `unknown` |
| Dedik Services Limited (AS209413) | 24 | 0.0% | 1 | 1 | `176.65.0.0/16` |
| Leaseweb Canada Inc. (AS32613) | 24 | 0.0% | 1 | 15 | `192.175.0.0/16` |
| LogicWeb Inc. (AS64286) | 23 | 0.0% | 5 | 9 | `149.57.0.0/16`, `64.64.0.0/16`, `154.6.0.0/16`, `173.239.0.0/16` |
| IP Volume inc (AS202425) | 22 | 0.0% | 5 | 9 | `94.102.0.0/16`, `185.242.0.0/16`, `89.248.0.0/16`, `93.174.0.0/16` |
| EGIHosting (AS18779) | 21 | 0.0% | 5 | 14 | `23.27.0.0/16`, `166.88.0.0/16`, `104.165.0.0/16`, `172.120.0.0/16` |
| HostPapa (AS36352) | 19 | 0.0% | 10 | 15 | `107.175.0.0/16`, `107.173.0.0/16`, `107.172.0.0/16`, `107.174.0.0/16` |
| Web2Objects LLC (AS62874) | 18 | 0.0% | 3 | 7 | `142.147.0.0/16`, `104.238.0.0/16`, `45.56.0.0/16` |
| GRUPO PANAGLOBAL 15 S.A (AS264617) | 17 | 0.0% | 4 | 7 | `191.101.0.0/16`, `45.39.0.0/16`, `170.231.0.0/16`, `185.191.0.0/16` |
| B2 Net Solutions Inc. (AS55286) | 16 | 0.0% | 9 | 11 | `38.154.0.0/16`, `209.127.0.0/16`, `192.198.0.0/16`, `152.232.0.0/16` |
| Comcast Cable Communications, LLC (AS7922) | 16 | 0.0% | 9 | 10 | `48.46.0.0/16`, `48.44.0.0/16`, `68.60.0.0/16`, `73.137.0.0/16` |
| Shock Hosting LLC (AS395092) | 16 | 0.0% | 2 | 6 | `82.23.0.0/16`, `82.27.0.0/16` |
| Modat B.V. (AS209334) | 15 | 0.0% | 1 | 8 | `85.217.0.0/16` |
| Hydra Communications Ltd (AS25369) | 14 | 0.0% | 6 | 13 | `2.57.0.0/16`, `200.138.0.0/16`, `154.16.0.0/16`, `5.252.0.0/16` |
| Tier.Net Technologies LLC (AS397423) | 13 | 0.0% | 4 | 7 | `198.37.0.0/16`, `31.59.0.0/16`, `173.0.0.0/16`, `45.59.0.0/16` |
| Verizon Business (AS701) | 12 | 0.0% | 6 | 6 | `100.17.0.0/16`, `108.39.0.0/16`, `65.206.0.0/16`, `71.111.0.0/16` |
| Hangzhou Alibaba Advertising Co.,Ltd. (AS37963) | 11 | 0.0% | 5 | 5 | `120.55.0.0/16`, `47.108.0.0/16`, `47.96.0.0/16`, `8.137.0.0/16` |
| Korea Telecom (AS4766) | 11 | 0.0% | 2 | 2 | `59.14.0.0/16`, `211.230.0.0/16` |
| AT&T Enterprises, LLC (AS7018) | 10 | 0.0% | 8 | 8 | `104.56.0.0/16`, `99.63.0.0/16`, `172.1.0.0/16`, `209.37.0.0/16` |
| Charter Communications Inc (AS11426) | 10 | 0.0% | 4 | 7 | `108.59.0.0/16`, `175.29.0.0/16`, `62.72.0.0/16`, `94.103.0.0/16` |
| Latitude.sh (AS396356) | 10 | 0.0% | 4 | 8 | `81.168.0.0/16`, `185.48.0.0/16`, `216.173.0.0/16`, `43.229.0.0/16` |
| Blatant (AS403005) | 10 | 0.0% | 1 | 1 | `64.89.0.0/16` |
| Yanoor Islam Khan (AS213186) | 10 | 0.0% | 1 | 1 | `98.142.0.0/16` |
| British Telecommunications Limited (AS2856) | 9 | 0.0% | 2 | 3 | `31.121.0.0/16`, `151.245.0.0/16` |
| HostRoyale LLC (AS46516) | 8 | 0.0% | 3 | 6 | `45.41.0.0/16`, `45.61.0.0/16`, `104.232.0.0/16` |
| Latitude.sh LTDA (AS262287) | 8 | 0.0% | 3 | 7 | `104.252.0.0/16`, `91.123.0.0/16`, `85.198.0.0/16` |
| CHINA UNICOM China169 Backbone (AS4837) | 8 | 0.0% | 2 | 3 | `113.224.0.0/16`, `113.232.0.0/16` |
| Chinanet (AS4134) | 8 | 0.0% | 5 | 6 | `49.87.0.0/16`, `123.160.0.0/16`, `120.39.0.0/16`, `183.36.0.0/16` |
| Comcast Cable Communications, LLC (AS33659) | 8 | 0.0% | 2 | 4 | `138.226.0.0/16`, `170.100.0.0/16` |
| Charter Communications LLC (AS20115) | 8 | 0.0% | 4 | 7 | `198.138.0.0/16`, `162.218.0.0/16`, `199.58.0.0/16`, `74.112.0.0/16` |
| Cox Communications Inc. (AS22773) | 8 | 0.0% | 3 | 7 | `90.96.0.0/16`, `68.231.0.0/16`, `184.181.0.0/16` |
| Turk Telekom (AS9121) | 8 | 0.0% | 2 | 2 | `212.156.0.0/16`, `95.3.0.0/16` |
| WebWorld (AS30900) | 7 | 0.0% | 3 | 3 | `82.24.0.0/16`, `82.25.0.0/16`, `82.29.0.0/16` |
| Colocation America Corporation (AS21769) | 6 | 0.0% | 4 | 4 | `184.174.0.0/16`, `67.227.0.0/16`, `104.224.0.0/16`, `173.211.0.0/16` |
| SYN LTD (AS64080) | 6 | 0.0% | 4 | 5 | `107.181.0.0/16`, `45.43.0.0/16`, `155.254.0.0/16`, `198.105.0.0/16` |
| Ace Data Centers, Inc. (AS11798) | 6 | 0.0% | 4 | 5 | `142.111.0.0/16`, `185.216.0.0/16`, `23.26.0.0/16`, `50.114.0.0/16` |
| MEVSPACE sp. z o.o. (AS201814) | 6 | 0.0% | 1 | 1 | `149.50.0.0/16` |
| Leaseweb USA, Inc. (AS395954) | 6 | 0.0% | 3 | 5 | `152.163.0.0/16`, `212.42.0.0/16`, `208.70.0.0/16` |
| ASLINE LIMITED (AS137951) | 6 | 0.0% | 1 | 1 | `168.76.0.0/16` |
| F.n.s. Holdings Limited (AS206092) | 6 | 0.0% | 2 | 5 | `45.86.0.0/16`, `185.238.0.0/16` |
| AIS Fibre (AS133481) | 6 | 0.0% | 1 | 2 | `27.130.0.0/16` |
| SONDATECH S.A.S. (AS263812) | 5 | 0.0% | 1 | 1 | `108.165.0.0/16` |
| Cogent Communications, LLC (AS174) | 5 | 0.0% | 5 | 5 | `149.100.0.0/16`, `151.241.0.0/16`, `154.21.0.0/16`, `154.9.0.0/16` |
| Global Transit Systems LLC (AS213954) | 5 | 0.0% | 1 | 3 | `185.201.0.0/16` |
| Leaseweb Deutschland GmbH (AS28753) | 5 | 0.0% | 2 | 4 | `82.22.0.0/16`, `204.217.0.0/16` |
| Level 3 Parent, LLC (AS3356) | 5 | 0.0% | 1 | 3 | `205.169.0.0/16` |
| ASN for TIANJIN Provincial Net of CT (AS17638) | 5 | 0.0% | 2 | 3 | `221.239.0.0/16`, `221.238.0.0/16` |
| Charter Communications Inc (AS10796) | 5 | 0.0% | 3 | 3 | `24.33.0.0/16`, `76.35.0.0/16`, `76.39.0.0/16` |
| AltusHost B.V. (AS51430) | 5 | 0.0% | 2 | 4 | `82.26.0.0/16`, `37.46.0.0/16` |
| Netlen Internet Hizmetleri Ltd. Sti. (AS44620) | 5 | 0.0% | 1 | 1 | `45.74.0.0/16` |
| Cablevision Lightpath LLC (AS54004) | 5 | 0.0% | 1 | 4 | `74.48.0.0/16` |
| FDCservers.net (AS30058) | 5 | 0.0% | 1 | 3 | `82.108.0.0/16` |
| 1&1 Versatel GmbH (AS8881) | 5 | 0.0% | 3 | 3 | `89.245.0.0/16`, `89.247.0.0/16`, `89.246.0.0/16` |
| RCN (AS6079) | 4 | 0.0% | 3 | 3 | `216.133.0.0/16`, `108.171.0.0/16`, `170.124.0.0/16` |
| Shenzhen Tencent Computer Systems Company Limited (AS45090) | 4 | 0.0% | 3 | 3 | `49.233.0.0/16`, `119.91.0.0/16`, `42.193.0.0/16` |
| GLOBAL COMMUNICATION NETWORK LIMITED (AS152179) | 4 | 0.0% | 2 | 2 | `13.143.0.0/16`, `31.77.0.0/16` |
| SAKURA Internet Inc. (AS7684) | 4 | 0.0% | 1 | 1 | `133.242.0.0/16` |
| Leaseweb USA, Inc. (AS27411) | 4 | 0.0% | 1 | 1 | `136.0.0.0/16` |
| Apple Inc. (AS714) | 4 | 0.0% | 1 | 1 | `17.166.0.0/16` |
| Blix Solutions AS (AS50304) | 4 | 0.0% | 2 | 3 | `172.102.0.0/16`, `181.214.0.0/16` |
| Vodafone GmbH (AS3209) | 4 | 0.0% | 2 | 2 | `178.27.0.0/16`, `92.208.0.0/16` |
| SYN LTD (AS50077) | 4 | 0.0% | 1 | 4 | `185.135.0.0/16` |
| LeaseWeb Netherlands B.V. (AS60781) | 4 | 0.0% | 2 | 2 | `193.25.0.0/16`, `82.192.0.0/16` |
| Hype Enterprises (AS13332) | 4 | 0.0% | 2 | 3 | `206.206.0.0/16`, `216.74.0.0/16` |
| HIVELOCITY, Inc. (AS29802) | 4 | 0.0% | 2 | 2 | `92.113.0.0/16`, `45.91.0.0/16` |
| Charter Communications Inc (AS12271) | 4 | 0.0% | 2 | 2 | `47.230.0.0/16`, `98.15.0.0/16` |
| Server Galactic Private Limited (AS150423) | 4 | 0.0% | 2 | 4 | `62.105.0.0/16`, `87.82.0.0/16` |
| VeriSign Infrastructure & Operations (AS11840) | 4 | 0.0% | 1 | 1 | `72.13.0.0/16` |
| kabelplus GmbH (AS8339) | 4 | 0.0% | 1 | 1 | `81.217.0.0/16` |
| WS Telecom Inc (AS213541) | 4 | 0.0% | 1 | 1 | `85.28.0.0/16` |
| Internet Resources Management SRL (AS48955) | 4 | 0.0% | 2 | 2 | `89.40.0.0/16`, `91.211.0.0/16` |
| Getechbrothers, MB (AS202044) | 3 | 0.0% | 2 | 2 | `104.233.0.0/16`, `104.143.0.0/16` |
| Interserver, Inc (AS19318) | 3 | 0.0% | 1 | 1 | `107.148.0.0/16` |
| Zenlayer Inc (AS21859) | 3 | 0.0% | 1 | 2 | `109.105.0.0/16` |
| Philippine Long Distance Telephone Company (AS9299) | 3 | 0.0% | 1 | 1 | `119.93.0.0/16` |
| Datacamp Limited (AS60068) | 3 | 0.0% | 2 | 2 | `138.199.0.0/16`, `185.152.0.0/16` |
| IT7 Networks Inc (AS25820) | 3 | 0.0% | 1 | 1 | `144.34.0.0/16` |
| Internet Vikings International AB (AS51747) | 3 | 0.0% | 3 | 3 | `151.248.0.0/16`, `192.36.0.0/16`, `193.182.0.0/16` |
| Contabo GmbH (AS51167) | 3 | 0.0% | 2 | 3 | `157.173.0.0/16`, `161.97.0.0/16` |
| China Telecom (AS138169) | 3 | 0.0% | 1 | 1 | `171.111.0.0/16` |
| UNIFIQUE TELECOMUNICACOES S/A (AS28343) | 3 | 0.0% | 1 | 1 | `186.232.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS39486) | 3 | 0.0% | 2 | 3 | `194.116.0.0/16`, `193.42.0.0/16` |
| Cyberzone S.A. (AS209854) | 3 | 0.0% | 2 | 2 | `45.95.0.0/16`, `193.56.0.0/16` |
| Glesys Sweden AB (AS42708) | 3 | 0.0% | 2 | 2 | `85.203.0.0/16`, `194.14.0.0/16` |
| GSL Networks Pty LTD (AS137409) | 3 | 0.0% | 2 | 3 | `203.25.0.0/16`, `217.145.0.0/16` |
| Windstream Communications LLC (AS7029) | 3 | 0.0% | 3 | 3 | `208.52.0.0/16`, `64.84.0.0/16`, `91.124.0.0/16` |
| UAB Bite Lietuva (AS210906) | 3 | 0.0% | 3 | 3 | `217.69.0.0/16`, `86.38.0.0/16`, `89.116.0.0/16` |
| trafficforce, UAB (AS133944) | 3 | 0.0% | 2 | 2 | `45.141.0.0/16`, `43.245.0.0/16` |
| web2objects GmbH (AS50495) | 3 | 0.0% | 2 | 3 | `77.83.0.0/16`, `45.151.0.0/16` |
| INEA sp. z o.o. (AS13110) | 3 | 0.0% | 1 | 1 | `77.65.0.0/16` |
| JSC Selectel (AS49505) | 3 | 0.0% | 1 | 1 | `91.206.0.0/16` |
| Varendra IT (AS151391) | 2 | 0.0% | 1 | 1 | `103.150.0.0/16` |
| HZ Hosting Ltd (AS202015) | 2 | 0.0% | 1 | 1 | `103.228.0.0/16` |
| Hosting Ukraine LTD (AS200525) | 2 | 0.0% | 1 | 1 | `104.250.0.0/16` |
| Google LLC (AS36040) | 2 | 0.0% | 1 | 1 | `136.22.0.0/16` |
| Connect Northwest Internet Services, LLC (AS10557) | 2 | 0.0% | 1 | 1 | `142.252.0.0/16` |
| Heart Internet limited (AS20738) | 2 | 0.0% | 1 | 1 | `146.103.0.0/16` |
| QuickPacket, LLC (AS46261) | 2 | 0.0% | 1 | 1 | `154.29.0.0/16` |
| Proton AG (AS208172) | 2 | 0.0% | 1 | 1 | `159.26.0.0/16` |
| BL Networks (AS399629) | 2 | 0.0% | 2 | 2 | `168.100.0.0/16`, `206.188.0.0/16` |
| Fusiora OU (AS214693) | 2 | 0.0% | 1 | 1 | `169.128.0.0/16` |
| Uniti Fiber Holdings Inc. (AS13760) | 2 | 0.0% | 1 | 1 | `170.249.0.0/16` |
| True Online (AS17552) | 2 | 0.0% | 1 | 1 | `171.96.0.0/16` |
| EVEO S.A. (AS53107) | 2 | 0.0% | 1 | 1 | `177.136.0.0/16` |
| Space Exploration Technologies Corporation (AS14593) | 2 | 0.0% | 1 | 1 | `179.65.0.0/16` |
| SERVICIOS DE TELECOMUNICACIONES SETEL S.A. (XTRIM EC) (AS14522) | 2 | 0.0% | 1 | 1 | `186.66.0.0/16` |
| Keminet SHPK (AS197706) | 2 | 0.0% | 2 | 2 | `188.68.0.0/16`, `31.171.0.0/16` |
| O.m.c. Computers & Communications Ltd (AS44709) | 2 | 0.0% | 2 | 2 | `194.36.0.0/16`, `79.108.0.0/16` |
| Naukowa I Akademicka Siec Komputerowa - Panstwowy Instytut Badawczy (AS8308) | 2 | 0.0% | 1 | 1 | `195.164.0.0/16` |
| Psychz Networks (AS40676) | 2 | 0.0% | 1 | 1 | `205.236.0.0/16` |
| Servers.com, Inc. (AS7979) | 2 | 0.0% | 1 | 2 | `23.109.0.0/16` |
| Link3 Technologies Ltd. (AS23688) | 2 | 0.0% | 1 | 1 | `27.147.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS44144) | 2 | 0.0% | 2 | 2 | `31.223.0.0/16`, `84.247.0.0/16` |
| Cgi Global Limited (AS56971) | 2 | 0.0% | 1 | 1 | `31.57.0.0/16` |
| Sino Worldwide Trading Limited (AS211443) | 2 | 0.0% | 1 | 1 | `46.151.0.0/16` |
| CariNet, Inc. (AS10439) | 2 | 0.0% | 1 | 1 | `71.6.0.0/16` |
| University of Illinois (AS40387) | 2 | 0.0% | 1 | 1 | `72.36.0.0/16` |
| EN Technologies Pte Ltd (AS133210) | 2 | 0.0% | 1 | 2 | `82.21.0.0/16` |
| IONOS SE (AS8560) | 2 | 0.0% | 1 | 1 | `82.223.0.0/16` |
| Virgin Media (AS5089) | 2 | 0.0% | 1 | 1 | `86.18.0.0/16` |
| Leaseweb USA, Inc. (AS19148) | 2 | 0.0% | 1 | 2 | `89.249.0.0/16` |
| Deutsche Telekom AG (AS3320) | 2 | 0.0% | 1 | 1 | `91.16.0.0/16` |
| ONYPHE SAS (AS213412) | 2 | 0.0% | 2 | 2 | `91.230.0.0/16`, `91.231.0.0/16` |
| Microsoft Azure | 1 | 0.0% | 1 | 1 | `10.234.0.0/16` |
| PT Remala Abadi (AS38511) | 1 | 0.0% | 1 | 1 | `101.255.0.0/16` |
| Lexistar Alliance Ltd. (AS329225) | 1 | 0.0% | 1 | 1 | `102.212.0.0/16` |
| Glide Student & Residential Limited (AS42689) | 1 | 0.0% | 1 | 1 | `103.104.0.0/16` |
| Elyzium Technologies Pvt. Ltd. (AS134319) | 1 | 0.0% | 1 | 1 | `103.194.0.0/16` |
| Adeo Datacenter ApS (AS202914) | 1 | 0.0% | 1 | 1 | `103.37.0.0/16` |
| Oy Crea Nova Hosting Solution Ltd (AS51765) | 1 | 0.0% | 1 | 1 | `103.99.0.0/16` |
| Donbass Electronic Communications Ltd. (AS20590) | 1 | 0.0% | 1 | 1 | `109.254.0.0/16` |
| PT. Simaya Jejaring Mandiri (AS38783) | 1 | 0.0% | 1 | 1 | `115.178.0.0/16` |
| DZCRD Networks Ltd (AS132817) | 1 | 0.0% | 1 | 1 | `119.42.0.0/16` |
| Google Fiber Inc. (AS16591) | 1 | 0.0% | 1 | 1 | `136.38.0.0/16` |
| N. DE CARVALHO SANTANA EIRELI (AS264050) | 1 | 0.0% | 1 | 1 | `143.137.0.0/16` |
| Breezeline (AS11776) | 1 | 0.0% | 1 | 1 | `146.168.0.0/16` |
| Sia Nano IT (AS43513) | 1 | 0.0% | 1 | 1 | `150.107.0.0/16` |
| netcup GmbH (AS214996) | 1 | 0.0% | 1 | 1 | `152.53.0.0/16` |
| RouterHosting LLC (AS14956) | 1 | 0.0% | 1 | 1 | `153.75.0.0/16` |
| Hytron Network Services Limited (AS151407) | 1 | 0.0% | 1 | 1 | `154.88.0.0/16` |
| ColoUp (AS19084) | 1 | 0.0% | 1 | 1 | `162.245.0.0/16` |
| HK Broadband Network Ltd. (AS10103) | 1 | 0.0% | 1 | 1 | `165.84.0.0/16` |
| 4G Telecom (AS327786) | 1 | 0.0% | 1 | 1 | `169.255.0.0/16` |
| Alex Largman (AS59651) | 1 | 0.0% | 1 | 1 | `170.168.0.0/16` |
| Ezee Fiber (AS35847) | 1 | 0.0% | 1 | 1 | `170.203.0.0/16` |
| PE Zinstein Hariton Vladimirovich (AS43936) | 1 | 0.0% | 1 | 1 | `176.101.0.0/16` |
| Republican Unitary Telecommunication Enterprise Beltelecom (AS6697) | 1 | 0.0% | 1 | 1 | `178.120.0.0/16` |
| Tarin General Trading and Setting Up Internet Device LTD (AS197882) | 1 | 0.0% | 1 | 1 | `185.184.0.0/16` |
| UAB code200 (AS209709) | 1 | 0.0% | 1 | 1 | `185.210.0.0/16` |
| Bamboozle Web Services MEA FZ-LLC (AS200851) | 1 | 0.0% | 1 | 1 | `185.243.0.0/16` |
| CORPORACION NACIONAL DE TELECOMUNICACIONES - CNT EP (AS28006) | 1 | 0.0% | 1 | 1 | `186.46.0.0/16` |
| UAB code200 (AS203061) | 1 | 0.0% | 1 | 1 | `189.81.0.0/16` |
| networksdelmanana.com (AS52485) | 1 | 0.0% | 1 | 1 | `190.123.0.0/16` |
| Performive LLC (AS46562) | 1 | 0.0% | 1 | 1 | `192.252.0.0/16` |
| GlobalConnect AB (AS12552) | 1 | 0.0% | 1 | 1 | `194.132.0.0/16` |
| Scaleway SAS (AS12876) | 1 | 0.0% | 1 | 1 | `195.154.0.0/16` |
| The Shadowserver Foundation, Inc. (AS22168) | 1 | 0.0% | 1 | 1 | `199.165.0.0/16` |
| Poxley Provedor de Internet Ltda (AS61763) | 1 | 0.0% | 1 | 1 | `201.159.0.0/16` |
| ANGKOR DATA COMMUNICATION (AS38235) | 1 | 0.0% | 1 | 1 | `203.147.0.0/16` |
| Cogetel Online, Cambodia, ISP (AS23673) | 1 | 0.0% | 1 | 1 | `203.189.0.0/16` |
| Palestine Telecommunications Company (PALTEL) (AS12975) | 1 | 0.0% | 1 | 1 | `212.14.0.0/16` |
| VIM TV LTD (AS199702) | 1 | 0.0% | 1 | 1 | `213.149.0.0/16` |
| Alexhost S.r.l. (AS200019) | 1 | 0.0% | 1 | 1 | `217.156.0.0/16` |
| Webhosting Holdings LLC (AS965) | 1 | 0.0% | 1 | 1 | `23.129.0.0/16` |
| Kazi Sazzad Hossain T/A Millennium Computers & Networking (AS134113) | 1 | 0.0% | 1 | 1 | `27.123.0.0/16` |
| Dhaka Fiber Net Limited (AS55492) | 1 | 0.0% | 1 | 1 | `27.131.0.0/16` |
| China Mobile communications corporation (AS56041) | 1 | 0.0% | 1 | 1 | `39.182.0.0/16` |
| web2objects GmbH (AS204646) | 1 | 0.0% | 1 | 1 | `45.150.0.0/16` |
| DB3 SERVICOS DE TELECOMUNICACOES S.A (AS28598) | 1 | 0.0% | 1 | 1 | `45.179.0.0/16` |
| Kappa Internet Services Private Limited (AS45433) | 1 | 0.0% | 1 | 1 | `45.250.0.0/16` |
| Leaseweb USA, Inc. (AS30633) | 1 | 0.0% | 1 | 1 | `46.202.0.0/16` |
| ISP Alliance a.s. (AS47232) | 1 | 0.0% | 1 | 1 | `46.29.0.0/16` |
| Reliance Jio Infocomm Limited (AS55836) | 1 | 0.0% | 1 | 1 | `49.37.0.0/16` |
| LREMC Technologies, L.L.C. (AS33574) | 1 | 0.0% | 1 | 1 | `64.255.0.0/16` |
| Horry Telephone Cooperative, Inc. (AS21565) | 1 | 0.0% | 1 | 1 | `66.153.0.0/16` |
| WideOpenWest Finance LLC (AS12083) | 1 | 0.0% | 1 | 1 | `69.73.0.0/16` |
| Hurricane Electric LLC (AS6939) | 1 | 0.0% | 1 | 1 | `74.82.0.0/16` |
| Charter Communications Inc (AS20001) | 1 | 0.0% | 1 | 1 | `76.94.0.0/16` |
| Abissnet sh.a. (AS35047) | 1 | 0.0% | 1 | 1 | `80.91.0.0/16` |
| Charter Communications Inc (AS7843) | 1 | 0.0% | 1 | 1 | `9.236.0.0/16` |
| Kaspersky Lab Switzerland GmbH (AS200107) | 1 | 0.0% | 1 | 1 | `93.159.0.0/16` |

## Non-bot fingerprints (top 15 by hits)

Same user-agent hash across many ranges usually means one operator or toolkit.

| User agent | Hits | IPs | /16s | Owners | Mode | Requests |
| --- | ---: | ---: | ---: | --- | --- | --- |
| `Chrome 49 / Windows NT 6.1` | 6,521 | 61 | 7 | AGOTOZ PTE. LTD. (AS9465), CHINANET Guangdong province netwo | direct fetch | favicon.ico |
| `Chrome 131 / Macintosh` | 2,408 | 18 | 16 | Colocation America Corporation (AS47007), Google LLC (AS3969 | direct fetch | env / secrets, config / framework dirs |
| `Chrome 131 / Linux` | 2,188 | 13 | 14 | Amazon.com, Inc. (AS16509), Google LLC (AS396982), Tencent B | direct fetch | env / secrets, config / framework dirs |
| `Chrome 131 / Windows NT 10` | 1,882 | 20 | 19 | Akamai Connected Cloud (AS63949), Alibaba (US) Technology Co | direct fetch | env / secrets, config / framework dirs |
| `Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb` | 1,839 | 9 | 9 | Alexhost S.r.l. (AS200019), Google LLC (AS396982), RCN (AS60 | direct fetch | env / secrets, config / framework dirs |
| `Chrome 114 / Android 12` | 926 | 5 | 5 | Google LLC (AS396982) | direct fetch | support, pricing, marketplace |
| `Chrome 147 / Windows NT 10` | 876 | 23 | 11 | Alibaba (US) Technology Co., Ltd. (AS45102), F.n.s. Holdings | link-follower | env / secrets |
| `facebookexternalhit/1.1 (+http://www.facebook.com/` | 859 | 273 | 3 | Facebook, Inc. (AS32934) | direct fetch | robots.txt |
| `Safari 13 / iPhone OS 13.2.3` | 636 | 295 | 36 | Shenzhen Tencent Computer Systems Company Limited (AS45090), | direct fetch | learn, integrations, tools |
| `Chrome 120 / Windows NT 10` | 624 | 22 | 22 | 1&1 Versatel GmbH (AS8881), Amazon.com, Inc. (AS14618), Evox | direct fetch | php shells / probes, wordpress |
| `Chrome 133 / Linux` | 576 | 3 | 2 | Tc Datacenter Limited (AS218785), Techoff Srv Limited (AS480 | direct fetch | version control / CI, config / framework dirs |
| `Mozilla/5.0 (compatible; XML Sitemaps Generator; w` | 505 | 2 | 1 | Team Blue Carrier Limited (AS34282) | link-follower | careers, marketplace, help-centre |
| `Chrome 133 / Macintosh` | 491 | 2 | 2 | Tc Datacenter Limited (AS218785), Techoff Srv Limited (AS480 | direct fetch | config / framework dirs, env / secrets |
| `Chrome 157 / Windows NT 10` | 410 | 18 | 4 | Leaseweb Canada Inc. (AS32613), Nexeon Technologies, Inc. (A | link-follower | help-centre, webinars, company |
| `Chrome 133 / Windows NT 10` | 391 | 4 | 4 | Amazon.com, Inc. (AS14618), Google LLC (AS396982), Tc Datace | direct fetch | config / framework dirs, env / secrets |

## What the probes ask for

| Category | Requests |  |
| --- | ---: | --- |
| env / secrets | 1,263 | `████████████████████` |
| wordpress | 474 | `████████` |
| config / framework dirs | 400 | `██████` |
| php shells / probes | 285 | `█████` |
| version control / CI | 192 | `███` |
| backups / db dumps | 87 | `█` |
| actuator / swagger | 55 | `█` |

Most requested paths: `wp-includes` (276), `.env` (184), `.git` (104), `wp-content` (72), `config` (62), `app` (57), `actuator` (55), `.env.production` (52), `core` (50), `.env.local` (46), `.svn` (42), `.env.backup` (41)

## Honeypot form submissions

| Group | Submissions | Ranges |
| --- | ---: | --- |
| `ua:b8dd7635412b` | 1 | `87.81.0.0/16` |
| `ua:7ba3360bfef8` | 1 | `87.81.0.0/16` |

## Notes

- Totals use each group's own hit counter; per-IP counters in the logs are rolling-window values and undercount heavy hitters.
- Owners come from the MaxMind GeoLite2-ASN database (majority ASN of the IPs seen in each /16).
- Bot IPs were checked against the vendors' published range files. Bots without a file are unchecked.
- User agents can be spoofed; vendor tokens are only trustworthy when the IP range matches the vendor.
