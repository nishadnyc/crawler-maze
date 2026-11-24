# Crawler trap traffic report

_Built from 741 log files. Window: 2026-11-22 03:45 to 2026-11-24 00:31 UTC (44.8 h)._

| Metric | Value |
| --- | ---: |
| Logged hits | 163,007 |
| Bot-labelled hits | 142,292 (87.3%) |
| Distinct IPs | 1,656 |
| /16 ranges | 584 |
| Hostnames seen | 265 |
| Ban entries | 635 |
| Requests logged during bans | 264,304 |
| Form submissions (honeypot) | 2 |

## Traffic mix

| Source | Hits | Share |  |
| --- | ---: | ---: | --- |
| ClaudeBot | 72,294 | 44.4% | `████████████████████` |
| OAI-SearchBot | 64,576 | 39.6% | `██████████████████` |
| non-bot user agents | 20,715 | 12.7% | `██████` |
| GPTBot | 5,277 | 3.2% | `█` |
| l9scan | 128 | 0.1% | `█` |
| Claude-User | 9 | 0.0% | `█` |
| Applebot | 4 | 0.0% | `█` |
| ChatGPT-User | 3 | 0.0% | `█` |
| Googlebot | 1 | 0.0% | `█` |

## Daily totals (3 of 3 days)

Day = the date in the log filename (server-local day), newest first.

| Day | Hits | ClaudeBot | OAI-SearchBot | GPTBot | other bots | non-bot | IPs | During bans |
| --- | ---: | ---: | ---: | ---: | ---: | ---: | ---: | ---: |
| 2026-11-23 | 75,275 | 30,697 | 35,828 | 2,956 | 135 | 5,659 | 820 | 149,368 |
| 2026-11-22 | 86,226 | 41,191 | 28,355 | 2,282 | 10 | 14,388 | 1,189 | 106,354 |
| 2026-11-21 | 1,506 | 406 | 393 | 39 | 0 | 668 | 322 | 8,582 |

## Requests received (served plus logged during bans)

`Served` is the maze's normal hit counter. `During bans` counts requests that arrived while the source was banned and were tarpitted. Together they show how hard each source really pushes.

| Source | Served | During bans | Received | Share | % of requests banned |  |
| --- | ---: | ---: | ---: | ---: | ---: | --- |
| GPTBot | 5,277 | 239,532 | 244,809 | 57.3% | 97.8% | `████████████████████` |
| ClaudeBot | 72,294 | 10,730 | 83,024 | 19.4% | 12.9% | `███████` |
| OAI-SearchBot | 64,576 | 13,813 | 78,389 | 18.3% | 17.6% | `██████` |
| non-bot | 20,715 | 229 | 20,944 | 4.9% | 1.1% | `██` |
| l9scan | 128 | 0 | 128 | 0.0% | 0.0% | `█` |
| Claude-User | 9 | 0 | 9 | 0.0% | 0.0% | `█` |
| Applebot | 4 | 0 | 4 | 0.0% | 0.0% | `█` |
| ChatGPT-User | 3 | 0 | 3 | 0.0% | 0.0% | `█` |
| Googlebot | 1 | 0 | 1 | 0.0% | 0.0% | `█` |

## Crawler behaviour

**Pace and IP use.** Single-use IPs were seen for under a minute. Requests per minute are averaged over each bot's own active window.

| Bot | Served req/min | Incl. banned req/min | IPs | Single-use IPs | Median IP lifetime (h) | Longest (h) |
| --- | ---: | ---: | ---: | ---: | ---: | ---: |
| ClaudeBot | 27.0 | 31.0 | 3 | 0 | 10.3 | 44.7 |
| OAI-SearchBot | 24.4 | 29.6 | 257 | 0 | 43.8 | 43.8 |
| GPTBot | 2.0 | 91.1 | 254 | 93 | 3.0 | 43.8 |
| l9scan | 2.5 | 2.5 | 4 | 4 | 0.0 | 0.0 |

**IP churn per day.** Active IPs, with brand-new IPs in brackets. A bot that keeps finding new IPs has a pool larger than what has been seen.

| Day | ClaudeBot | OAI-SearchBot | GPTBot | l9scan |
| --- | ---: | ---: | ---: | ---: |
| 2026-11-21 | 1 (+1) | 203 (+203) | 34 (+34) | - |
| 2026-11-22 | 1 (+0) | 257 (+54) | 172 (+152) | - |
| 2026-11-23 | 3 (+2) | 257 (+0) | 176 (+68) | 4 (+4) |

**Bans.** A median gap equal to the ban length means the source is re-banned the moment each ban expires.

| Bot | Bans | By kind | Median gap between bans (s) | Busiest hour (UTC) | Ban length |
| --- | ---: | --- | ---: | ---: | --- |
| OAI-SearchBot | 441 | ip 438, agent 2, subnet 1 | 3623 | 23:00 | 10 min |
| GPTBot | 177 | ip 172, group 2, subnet 2, agent 1 | 601 | 23:00 | 10 min |
| ClaudeBot | 11 | ip 4, subnet 3, agent 2, group 2 | 31320 | 00:00 | 10 min |
| non-bot | 6 | agent 2, ip 2, subnet 2 | 1895 | 04:00 | 10 min |

**Section focus.** Evenness runs from 0 (one section only) to 1 (perfectly even). robots.txt, sitemap.xml and favicon.ico are excluded.

| Bot | Content requests | Sections | Top-4 share | Evenness | Top sections |
| --- | ---: | ---: | ---: | ---: | --- |
| ClaudeBot | 56,160 | 36 | 49.9% | 0.79 | tutorials 10,017, developers 8,259, docs 6,308, features 3,457 |
| GPTBot | 5,217 | 36 | 13.2% | 0.99 | comparison 180, case-studies 170, partners 170, platform 167 |
| l9scan | 112 | 25 | 25.0% | 0.98 | api 12, graphql 8, console 4, server 4 |

## Named crawlers

### ClaudeBot

- **Owner:** Amazon.com, Inc. (AS16509)
- **Hits:** 72,294 (44.4%) from 3 IP(s) in 1 /16 range(s)
- **/24 ranges (IPs):** `216.73.216.0/24` (3)
- **Vendor range check:** all 3 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 8,393 (11.6%); sitemap.xml: 6,740
- **Requests per IP:** 24,098.0 average
- **Bans:** 56; 10,730 further requests logged while banned
- **Top sections:** tutorials 10,017, robots.txt 8,393, developers 8,259, sitemap.xml 6,740, docs 6,308, features 3,457
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; ClaudeBot/1.0; +claudebot@anthropic.com)`

### OAI-SearchBot

- **Owner:** Microsoft Corporation (AS8075)
- **Hits:** 64,576 (39.6%) from 257 IP(s) in 2 /16 range(s)
- **/24 ranges (IPs):** `74.7.230.0/24` (52), `74.7.244.0/24` (52), `74.7.228.0/24` (51), `74.7.241.0/24` (51), `74.7.175.0/24` (50), `51.8.102.0/24` (1)
- **Vendor range check:** all 257 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 64,576 (100.0%); sitemap.xml: 0
- **Requests per IP:** 251.3 average
- **Bans:** 968; 13,813 further requests logged while banned
- **Top sections:** robots.txt 64,576
- **User agent:** `Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36; c`

### GPTBot

- **Owner:** Microsoft Corporation (AS8075)
- **Hits:** 5,277 (3.2%) from 254 IP(s) in 3 /16 range(s)
- **/24 ranges (IPs):** `74.7.227.0/24` (88), `74.7.241.0/24` (44), `74.7.242.0/24` (43), `74.7.243.0/24` (40), `132.196.86.0/24` (19), `172.182.202.0/24` (10), `172.182.207.0/24` (10)
- **Vendor range check:** all 254 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 98.9% followed maze links, 1.1% direct fetches
- **robots.txt requests:** 0 (0.0%); sitemap.xml: 55
- **Requests per IP:** 20.8 average
- **Bans:** 226; 239,532 further requests logged while banned
- **Top sections:** comparison 180, case-studies 170, partners 170, platform 167, marketplace 166, knowledge-base 165
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.4; +https://openai.com/gptbot)`

### l9scan

- **Owner:** DigitalOcean, LLC (AS14061)
- **Hits:** 128 (0.1%) from 4 IP(s) in 4 /16 range(s)
- **/24 ranges (IPs):** `138.68.86.0/24` (1), `142.93.129.0/24` (1), `206.189.19.0/24` (1), `68.183.180.0/24` (1)
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 0 (0.0%); sitemap.xml: 0
- **Requests per IP:** 32.0 average
- **Top sections:** api 12, graphql 8, console 4, server 4, server-status 4, about 4
- **User agent:** `Mozilla/5.0 (l9scan/2.0.4363e28383e2331323e2932313; +https://leakix.net)`

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
- **Hits:** 3 (0.0%) from 2 IP(s) in 2 /16 range(s)
- **/24 ranges (IPs):** `104.28.193.0/24` (1), `20.125.144.0/24` (1)
- **Vendor range check:** 1/2 IPs inside published ranges; **not listed:** `104.28.193.185`
- **Link-follow vs direct:** 66.7% followed maze links, 33.3% direct fetches
- **robots.txt requests:** 0 (0.0%); sitemap.xml: 0
- **Requests per IP:** 1.5 average
- **Top sections:** .git 1, .env.local 1
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko); compatible; ChatGPT-User/1.0; +https://openai.com/bot`

### Googlebot

- **Owner:** Cloudflare, Inc. (AS13335)
- **Hits:** 1 (0.0%) from 0 IP(s) in 1 /16 range(s)
- **/24 ranges (IPs):** 
- **Link-follow vs direct:** 100.0% followed maze links, 0.0% direct fetches
- **robots.txt requests:** 0 (0.0%); sitemap.xml: 0
- **Top sections:** .env.dist 1
- **User agent:** `Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)`

## Hits by network owner

| Owner | Hits | Share | /16s | IPs | Top ranges |
| --- | ---: | ---: | ---: | ---: | --- |
| Amazon.com, Inc. (AS16509) | 72,532 | 44.5% | 25 | 27 | `216.73.0.0/16`, `18.217.0.0/16`, `16.145.0.0/16`, `16.147.0.0/16` |
| Microsoft Corporation (AS8075) | 70,278 | 43.1% | 12 | 520 | `74.7.0.0/16`, `20.219.0.0/16`, `20.28.0.0/16`, `132.196.0.0/16` |
| Google LLC (AS396982) | 5,278 | 3.2% | 55 | 73 | `34.96.0.0/16`, `34.21.0.0/16`, `34.154.0.0/16`, `34.83.0.0/16` |
| UCLOUD INFORMATION TECHNOLOGY (HK) LIMITED (AS135377) | 4,730 | 2.9% | 6 | 11 | `152.32.0.0/16`, `154.51.0.0/16`, `45.249.0.0/16`, `103.218.0.0/16` |
| AGOTOZ PTE. LTD. (AS9465) | 1,393 | 0.9% | 1 | 7 | `156.225.0.0/16` |
| Techoff Srv Limited (AS48090) | 1,119 | 0.7% | 2 | 5 | `195.178.0.0/16`, `45.148.0.0/16` |
| Alibaba (US) Technology Co., Ltd. (AS45102) | 602 | 0.4% | 8 | 30 | `43.106.0.0/16`, `8.218.0.0/16`, `43.98.0.0/16`, `47.84.0.0/16` |
| Facebook, Inc. (AS32934) | 596 | 0.4% | 4 | 41 | `173.252.0.0/16`, `57.141.0.0/16`, `69.171.0.0/16`, `69.63.0.0/16` |
| Team Blue Carrier Limited (AS34282) | 507 | 0.3% | 1 | 2 | `85.92.0.0/16` |
| OVH SAS (AS16276) | 438 | 0.3% | 18 | 22 | `158.69.0.0/16`, `139.99.0.0/16`, `148.113.0.0/16`, `51.83.0.0/16` |
| CHINANET Guangdong province network (AS58466) | 435 | 0.3% | 1 | 5 | `106.75.0.0/16` |
| NTT America, Inc. (AS2914) | 432 | 0.3% | 1 | 10 | `216.167.0.0/16` |
| Amazon.com, Inc. (AS14618) | 425 | 0.3% | 121 | 151 | `3.238.0.0/16`, `32.197.0.0/16`, `44.204.0.0/16`, `3.235.0.0/16` |
| Tencent Building, Kejizhongyi Avenue (AS132203) | 363 | 0.2% | 33 | 91 | `43.157.0.0/16`, `43.166.0.0/16`, `43.130.0.0/16`, `43.153.0.0/16` |
| DigitalOcean, LLC (AS14061) | 362 | 0.2% | 30 | 38 | `167.172.0.0/16`, `188.166.0.0/16`, `68.183.0.0/16`, `138.68.0.0/16` |
| Cloudflare, Inc. (AS13335) | 230 | 0.1% | 2 | 22 | `104.29.0.0/16`, `104.28.0.0/16` |
| M247 Europe SRL (AS9009) | 227 | 0.1% | 7 | 19 | `103.4.0.0/16`, `146.70.0.0/16`, `103.196.0.0/16`, `104.253.0.0/16` |
| GitHub, Inc. (AS36459) | 222 | 0.1% | 1 | 15 | `140.82.0.0/16` |
| Cablevision Systems Corp. (AS6128) | 205 | 0.1% | 1 | 1 | `69.115.0.0/16` |
| Nexeon Technologies, Inc. (AS20278) | 198 | 0.1% | 2 | 2 | `23.94.0.0/16`, `23.95.0.0/16` |
| Fastly, Inc. (AS394192) | 196 | 0.1% | 1 | 183 | `87.81.0.0/16` |
| WholeSale Internet, Inc. (AS32097) | 188 | 0.1% | 1 | 1 | `23.128.0.0/16` |
| GTT Communications Inc. (AS3257) | 180 | 0.1% | 2 | 5 | `70.39.0.0/16`, `216.36.0.0/16` |
| VPS Dedicated LLC (AS197769) | 177 | 0.1% | 1 | 2 | `102.220.0.0/16` |
| Eweka Internet Services B.V. (AS34343) | 171 | 0.1% | 2 | 4 | `81.171.0.0/16`, `91.148.0.0/16` |
| CustodianDC Limited (AS50300) | 154 | 0.1% | 1 | 3 | `5.102.0.0/16` |
| Tc Datacenter Limited (AS218785) | 115 | 0.1% | 1 | 2 | `45.138.0.0/16` |
| Censys, Inc. (AS398324) | 115 | 0.1% | 1 | 16 | `66.132.0.0/16` |
| Colocation America Corporation (AS47007) | 101 | 0.1% | 2 | 2 | `173.46.0.0/16`, `171.22.0.0/16` |
| Datacamp Limited (AS212238) | 77 | 0.0% | 13 | 27 | `205.188.0.0/16`, `169.150.0.0/16`, `156.146.0.0/16`, `149.102.0.0/16` |
| 1337 Services GmbH (AS210558) | 67 | 0.0% | 1 | 1 | `45.94.0.0/16` |
| T-Mobile USA, Inc. (AS21928) | 64 | 0.0% | 1 | 2 | `172.56.0.0/16` |
| Virtual Systems LLC (AS6698) | 64 | 0.0% | 2 | 2 | `91.218.0.0/16`, `85.137.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS207990) | 51 | 0.0% | 9 | 23 | `83.229.0.0/16`, `217.194.0.0/16`, `188.212.0.0/16`, `213.255.0.0/16` |
| The Constant Company, LLC (AS20473) | 42 | 0.0% | 5 | 5 | `137.220.0.0/16`, `192.248.0.0/16`, `45.63.0.0/16`, `216.238.0.0/16` |
| Akamai Connected Cloud (AS63949) | 41 | 0.0% | 11 | 18 | `172.236.0.0/16`, `45.79.0.0/16`, `172.104.0.0/16`, `172.239.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS203020) | 39 | 0.0% | 5 | 15 | `45.92.0.0/16`, `31.209.0.0/16`, `155.94.0.0/16`, `103.93.0.0/16` |
| TechTies Inc. (AS197170) | 39 | 0.0% | 4 | 6 | `85.11.0.0/16`, `94.26.0.0/16`, `91.92.0.0/16`, `45.156.0.0/16` |
| NetLab Global (AS979) | 36 | 0.0% | 1 | 1 | `154.44.0.0/16` |
| FiberPower LLC (AS214483) | 36 | 0.0% | 1 | 1 | `23.148.0.0/16` |
| Hetzner Online GmbH (AS24940) | 30 | 0.0% | 10 | 11 | `88.198.0.0/16`, `91.98.0.0/16`, `116.202.0.0/16`, `157.90.0.0/16` |
| Leaseweb Canada Inc. (AS32613) | 24 | 0.0% | 1 | 15 | `192.175.0.0/16` |
| Evoxt Sdn. Bhd. (AS149440) | 22 | 0.0% | 1 | 1 | `96.126.0.0/16` |
| Oracle Corporation (AS31898) | 20 | 0.0% | 2 | 2 | `141.148.0.0/16`, `129.213.0.0/16` |
| Dedik Services Limited (AS209413) | 17 | 0.0% | 1 | 1 | `176.65.0.0/16` |
| Driftnet Ltd (AS211298) | 16 | 0.0% | 3 | 9 | `87.236.0.0/16`, `195.96.0.0/16`, `185.247.0.0/16` |
| IP Volume inc (AS202425) | 15 | 0.0% | 5 | 8 | `185.242.0.0/16`, `89.248.0.0/16`, `94.102.0.0/16`, `93.174.0.0/16` |
| Web2Objects LLC (AS62874) | 13 | 0.0% | 3 | 5 | `142.147.0.0/16`, `104.238.0.0/16`, `45.56.0.0/16` |
| LogicWeb Inc. (AS64286) | 12 | 0.0% | 3 | 3 | `149.57.0.0/16`, `154.6.0.0/16`, `173.239.0.0/16` |
| Hangzhou Alibaba Advertising Co.,Ltd. (AS37963) | 11 | 0.0% | 5 | 5 | `120.55.0.0/16`, `47.108.0.0/16`, `47.96.0.0/16`, `8.137.0.0/16` |
| Level 3 Parent, LLC (AS3356) | 11 | 0.0% | 3 | 7 | `205.169.0.0/16`, `45.39.0.0/16`, `92.112.0.0/16` |
| Korea Telecom (AS4766) | 11 | 0.0% | 2 | 2 | `59.14.0.0/16`, `211.230.0.0/16` |
| EGIHosting (AS18779) | 10 | 0.0% | 3 | 7 | `23.27.0.0/16`, `104.165.0.0/16`, `172.120.0.0/16` |
| Blatant (AS403005) | 10 | 0.0% | 1 | 1 | `64.89.0.0/16` |
| CHINA UNICOM China169 Backbone (AS4837) | 8 | 0.0% | 2 | 3 | `113.224.0.0/16`, `113.232.0.0/16` |
| British Telecommunications Limited (AS2856) | 8 | 0.0% | 1 | 2 | `31.121.0.0/16` |
| HostPapa (AS36352) | 7 | 0.0% | 5 | 6 | `107.172.0.0/16`, `107.174.0.0/16`, `107.173.0.0/16`, `172.245.0.0/16` |
| Chinanet (AS4134) | 7 | 0.0% | 4 | 5 | `49.87.0.0/16`, `123.160.0.0/16`, `120.39.0.0/16`, `58.59.0.0/16` |
| Latitude.sh (AS396356) | 6 | 0.0% | 3 | 5 | `104.239.0.0/16`, `81.168.0.0/16`, `216.173.0.0/16` |
| ASLINE LIMITED (AS137951) | 6 | 0.0% | 1 | 1 | `168.76.0.0/16` |
| F.n.s. Holdings Limited (AS206092) | 6 | 0.0% | 2 | 5 | `45.86.0.0/16`, `185.238.0.0/16` |
| Modat B.V. (AS209334) | 6 | 0.0% | 1 | 4 | `85.217.0.0/16` |
| MEVSPACE sp. z o.o. (AS201814) | 5 | 0.0% | 1 | 1 | `149.50.0.0/16` |
| Hydra Communications Ltd (AS25369) | 5 | 0.0% | 3 | 5 | `200.138.0.0/16`, `64.205.0.0/16`, `77.67.0.0/16` |
| Yanoor Islam Khan (AS213186) | 5 | 0.0% | 1 | 1 | `98.142.0.0/16` |
| RCN (AS6079) | 4 | 0.0% | 3 | 3 | `216.133.0.0/16`, `108.171.0.0/16`, `170.124.0.0/16` |
| SAKURA Internet Inc. (AS7684) | 4 | 0.0% | 1 | 1 | `133.242.0.0/16` |
| Leaseweb USA, Inc. (AS395954) | 4 | 0.0% | 2 | 3 | `152.163.0.0/16`, `212.42.0.0/16` |
| Apple Inc. (AS714) | 4 | 0.0% | 1 | 1 | `17.166.0.0/16` |
| GRUPO PANAGLOBAL 15 S.A (AS264617) | 4 | 0.0% | 2 | 2 | `170.231.0.0/16`, `185.191.0.0/16` |
| VeriSign Infrastructure & Operations (AS11840) | 4 | 0.0% | 1 | 1 | `72.13.0.0/16` |
| kabelplus GmbH (AS8339) | 4 | 0.0% | 1 | 1 | `81.217.0.0/16` |
| Server Galactic Private Limited (AS150423) | 4 | 0.0% | 2 | 4 | `82.108.0.0/16`, `87.82.0.0/16` |
| WS Telecom Inc (AS213541) | 4 | 0.0% | 1 | 1 | `85.28.0.0/16` |
| Zenlayer Inc (AS21859) | 3 | 0.0% | 1 | 2 | `109.105.0.0/16` |
| Philippine Long Distance Telephone Company (AS9299) | 3 | 0.0% | 1 | 1 | `119.93.0.0/16` |
| Datacamp Limited (AS60068) | 3 | 0.0% | 2 | 2 | `138.199.0.0/16`, `185.152.0.0/16` |
| IT7 Networks Inc (AS25820) | 3 | 0.0% | 1 | 1 | `144.34.0.0/16` |
| Cogent Communications, LLC (AS174) | 3 | 0.0% | 3 | 3 | `149.100.0.0/16`, `151.241.0.0/16`, `38.132.0.0/16` |
| Contabo GmbH (AS51167) | 3 | 0.0% | 2 | 3 | `157.173.0.0/16`, `161.97.0.0/16` |
| China Telecom (AS138169) | 3 | 0.0% | 1 | 1 | `171.111.0.0/16` |
| Unidentified | 3 | 0.0% | 2 | 2 | `172.18.0.0/16`, `unknown` |
| Cox Communications Inc. (AS22773) | 3 | 0.0% | 2 | 3 | `90.96.0.0/16`, `184.181.0.0/16` |
| B2 Net Solutions Inc. (AS55286) | 3 | 0.0% | 3 | 3 | `192.198.0.0/16`, `209.127.0.0/16`, `23.229.0.0/16` |
| Cyberzone S.A. (AS209854) | 3 | 0.0% | 2 | 2 | `45.95.0.0/16`, `193.56.0.0/16` |
| GSL Networks Pty LTD (AS137409) | 3 | 0.0% | 2 | 3 | `203.25.0.0/16`, `217.145.0.0/16` |
| AltusHost B.V. (AS51430) | 3 | 0.0% | 2 | 2 | `37.46.0.0/16`, `82.27.0.0/16` |
| Comcast Cable Communications, LLC (AS7922) | 3 | 0.0% | 2 | 2 | `48.46.0.0/16`, `48.45.0.0/16` |
| INEA sp. z o.o. (AS13110) | 3 | 0.0% | 1 | 1 | `77.65.0.0/16` |
| JSC Selectel (AS49505) | 3 | 0.0% | 1 | 1 | `91.206.0.0/16` |
| Turk Telekom (AS9121) | 3 | 0.0% | 1 | 1 | `95.3.0.0/16` |
| Varendra IT (AS151391) | 2 | 0.0% | 1 | 1 | `103.150.0.0/16` |
| HZ Hosting Ltd (AS202015) | 2 | 0.0% | 1 | 1 | `103.228.0.0/16` |
| Getechbrothers, MB (AS202044) | 2 | 0.0% | 1 | 1 | `104.233.0.0/16` |
| Latitude.sh LTDA (AS262287) | 2 | 0.0% | 1 | 2 | `104.252.0.0/16` |
| Shenzhen Tencent Computer Systems Company Limited (AS45090) | 2 | 0.0% | 2 | 2 | `119.91.0.0/16`, `49.233.0.0/16` |
| Comcast Cable Communications, LLC (AS33659) | 2 | 0.0% | 2 | 2 | `138.226.0.0/16`, `170.100.0.0/16` |
| Connect Northwest Internet Services, LLC (AS10557) | 2 | 0.0% | 1 | 1 | `142.252.0.0/16` |
| RouterHosting LLC (AS14956) | 2 | 0.0% | 2 | 2 | `153.75.0.0/16`, `45.61.0.0/16` |
| Proton AG (AS208172) | 2 | 0.0% | 1 | 1 | `159.26.0.0/16` |
| BL Networks (AS399629) | 2 | 0.0% | 2 | 2 | `168.100.0.0/16`, `206.188.0.0/16` |
| Fusiora OU (AS214693) | 2 | 0.0% | 1 | 1 | `169.128.0.0/16` |
| Uniti Fiber Holdings Inc. (AS13760) | 2 | 0.0% | 1 | 1 | `170.249.0.0/16` |
| True Online (AS17552) | 2 | 0.0% | 1 | 1 | `171.96.0.0/16` |
| Tier.Net Technologies LLC (AS397423) | 2 | 0.0% | 2 | 2 | `173.0.0.0/16`, `198.37.0.0/16` |
| Charter Communications Inc (AS11426) | 2 | 0.0% | 2 | 2 | `175.29.0.0/16`, `94.103.0.0/16` |
| EVEO S.A. (AS53107) | 2 | 0.0% | 1 | 1 | `177.136.0.0/16` |
| Space Exploration Technologies Corporation (AS14593) | 2 | 0.0% | 1 | 1 | `179.65.0.0/16` |
| SERVICIOS DE TELECOMUNICACIONES SETEL S.A. (XTRIM EC) (AS14522) | 2 | 0.0% | 1 | 1 | `186.66.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS39486) | 2 | 0.0% | 2 | 2 | `193.42.0.0/16`, `194.116.0.0/16` |
| O.m.c. Computers & Communications Ltd (AS44709) | 2 | 0.0% | 2 | 2 | `194.36.0.0/16`, `79.108.0.0/16` |
| Naukowa I Akademicka Siec Komputerowa - Panstwowy Instytut Badawczy (AS8308) | 2 | 0.0% | 1 | 1 | `195.164.0.0/16` |
| Psychz Networks (AS40676) | 2 | 0.0% | 1 | 1 | `205.236.0.0/16` |
| AIS Fibre (AS133481) | 2 | 0.0% | 1 | 2 | `27.130.0.0/16` |
| Link3 Technologies Ltd. (AS23688) | 2 | 0.0% | 1 | 1 | `27.147.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS204287) | 2 | 0.0% | 1 | 1 | `45.41.0.0/16` |
| Netlen Internet Hizmetleri Ltd. Sti. (AS44620) | 2 | 0.0% | 1 | 1 | `45.74.0.0/16` |
| Verizon Business (AS701) | 2 | 0.0% | 1 | 1 | `65.206.0.0/16` |
| CariNet, Inc. (AS10439) | 2 | 0.0% | 1 | 1 | `71.6.0.0/16` |
| Cablevision Lightpath LLC (AS54004) | 2 | 0.0% | 1 | 2 | `74.48.0.0/16` |
| LeaseWeb Netherlands B.V. (AS60781) | 2 | 0.0% | 1 | 1 | `82.192.0.0/16` |
| Wave Broadband (AS11404) | 2 | 0.0% | 1 | 1 | `82.22.0.0/16` |
| IONOS SE (AS8560) | 2 | 0.0% | 1 | 1 | `82.223.0.0/16` |
| Glesys Sweden AB (AS42708) | 2 | 0.0% | 1 | 1 | `85.203.0.0/16` |
| Virgin Media (AS5089) | 2 | 0.0% | 1 | 1 | `86.18.0.0/16` |
| ONYPHE SAS (AS213412) | 2 | 0.0% | 2 | 2 | `91.230.0.0/16`, `91.231.0.0/16` |
| Microsoft Azure | 1 | 0.0% | 1 | 1 | `10.234.0.0/16` |
| PT Remala Abadi (AS38511) | 1 | 0.0% | 1 | 1 | `101.255.0.0/16` |
| Leaseweb USA, Inc. (AS27411) | 1 | 0.0% | 1 | 1 | `142.111.0.0/16` |
| ColoUp (AS19084) | 1 | 0.0% | 1 | 1 | `162.245.0.0/16` |
| HK Broadband Network Ltd. (AS10103) | 1 | 0.0% | 1 | 1 | `165.84.0.0/16` |
| Code200, UAB (AS149428) | 1 | 0.0% | 1 | 1 | `172.102.0.0/16` |
| Republican Unitary Telecommunication Enterprise Beltelecom (AS6697) | 1 | 0.0% | 1 | 1 | `178.120.0.0/16` |
| SYN LTD (AS50077) | 1 | 0.0% | 1 | 1 | `185.135.0.0/16` |
| Tarin General Trading and Setting Up Internet Device LTD (AS197882) | 1 | 0.0% | 1 | 1 | `185.184.0.0/16` |
| Bamboozle Web Services MEA FZ-LLC (AS200851) | 1 | 0.0% | 1 | 1 | `185.243.0.0/16` |
| UAB code200 (AS203061) | 1 | 0.0% | 1 | 1 | `189.81.0.0/16` |
| networksdelmanana.com (AS52485) | 1 | 0.0% | 1 | 1 | `190.123.0.0/16` |
| Performive LLC (AS46562) | 1 | 0.0% | 1 | 1 | `192.252.0.0/16` |
| The Shadowserver Foundation, Inc. (AS22168) | 1 | 0.0% | 1 | 1 | `199.165.0.0/16` |
| Cogetel Online, Cambodia, ISP (AS23673) | 1 | 0.0% | 1 | 1 | `203.189.0.0/16` |
| Hype Enterprises (AS13332) | 1 | 0.0% | 1 | 1 | `206.206.0.0/16` |
| Windstream Communications LLC (AS7029) | 1 | 0.0% | 1 | 1 | `208.52.0.0/16` |
| Alexhost S.r.l. (AS200019) | 1 | 0.0% | 1 | 1 | `217.156.0.0/16` |
| ASN for TIANJIN Provincial Net of CT (AS17638) | 1 | 0.0% | 1 | 1 | `221.239.0.0/16` |
| Servers.com, Inc. (AS7979) | 1 | 0.0% | 1 | 1 | `23.109.0.0/16` |
| Webhosting Holdings LLC (AS965) | 1 | 0.0% | 1 | 1 | `23.129.0.0/16` |
| Keminet SHPK (AS197706) | 1 | 0.0% | 1 | 1 | `31.171.0.0/16` |
| Leaseweb Deutschland GmbH (AS28753) | 1 | 0.0% | 1 | 1 | `31.59.0.0/16` |
| China Mobile communications corporation (AS56041) | 1 | 0.0% | 1 | 1 | `39.182.0.0/16` |
| DB3 SERVICOS DE TELECOMUNICACOES S.A (AS28598) | 1 | 0.0% | 1 | 1 | `45.179.0.0/16` |
| Sino Worldwide Trading Limited (AS211443) | 1 | 0.0% | 1 | 1 | `46.151.0.0/16` |
| Hurricane Electric LLC (AS6939) | 1 | 0.0% | 1 | 1 | `74.82.0.0/16` |
| AT&T Enterprises, LLC (AS7018) | 1 | 0.0% | 1 | 1 | `76.200.0.0/16` |
| EN Technologies Pte Ltd (AS133210) | 1 | 0.0% | 1 | 1 | `82.21.0.0/16` |
| Rogers Communications Canada Inc. (AS812) | 1 | 0.0% | 1 | 1 | `82.23.0.0/16` |
| HGC Global Communications Limited (AS9304) | 1 | 0.0% | 1 | 1 | `82.26.0.0/16` |
| WebWorld (AS30900) | 1 | 0.0% | 1 | 1 | `82.29.0.0/16` |
| UAB Bite Lietuva (AS210906) | 1 | 0.0% | 1 | 1 | `86.38.0.0/16` |
| Leaseweb USA, Inc. (AS19148) | 1 | 0.0% | 1 | 1 | `89.249.0.0/16` |

## Non-bot fingerprints (top 15 by hits)

Same user-agent hash across many ranges usually means one operator or toolkit.

| User agent | Hits | IPs | /16s | Owners | Mode | Requests |
| --- | ---: | ---: | ---: | --- | --- | --- |
| `Chrome 49 / Windows NT 6.1` | 6,521 | 61 | 7 | AGOTOZ PTE. LTD. (AS9465), CHINANET Guangdong province netwo | direct fetch | favicon.ico |
| `Chrome 131 / Windows NT 10` | 1,970 | 18 | 17 | Akamai Connected Cloud (AS63949), Alibaba (US) Technology Co | direct fetch | env / secrets, config / framework dirs |
| `Chrome 131 / Macintosh` | 1,686 | 12 | 10 | Colocation America Corporation (AS47007), Google LLC (AS3969 | direct fetch | env / secrets, config / framework dirs |
| `Chrome 131 / Linux` | 999 | 6 | 5 | Amazon.com, Inc. (AS16509), Google LLC (AS396982) | direct fetch | env / secrets, config / framework dirs |
| `Chrome 114 / Android 12` | 926 | 5 | 5 | Google LLC (AS396982) | direct fetch | support, pricing, marketplace |
| `Chrome 147 / Windows NT 10` | 796 | 23 | 10 | Alibaba (US) Technology Co., Ltd. (AS45102), F.n.s. Holdings | link-follower | api, favicon.ico |
| `facebookexternalhit/1.1 (+http://www.facebook.com/` | 537 | 156 | 4 | Cablevision Systems Corp. (AS6128), Facebook, Inc. (AS32934) | direct fetch | robots.txt |
| `Mozilla/5.0 (compatible; XML Sitemaps Generator; w` | 505 | 2 | 1 | Team Blue Carrier Limited (AS34282) | link-follower | careers, marketplace, help-centre |
| `Chrome 133 / Linux` | 498 | 2 | 2 | Tc Datacenter Limited (AS218785), Techoff Srv Limited (AS480 | direct fetch | config / framework dirs, env / secrets |
| `Chrome 120 / Windows NT 10` | 422 | 18 | 18 | Amazon.com, Inc. (AS14618), Evoxt Sdn. Bhd. (AS149440), HK B | direct fetch | wordpress, php shells / probes |
| `Chrome 157 / Windows NT 10` | 410 | 18 | 4 | Leaseweb Canada Inc. (AS32613), Nexeon Technologies, Inc. (A | link-follower | help-centre, webinars, company |
| `Safari 13 / iPhone OS 13.2.3` | 363 | 236 | 34 | Shenzhen Tencent Computer Systems Company Limited (AS45090), | direct fetch | integrations, blog, help-centre |
| `fasthttp` | 321 | 56 | 5 | Alibaba (US) Technology Co., Ltd. (AS45102) | direct fetch | robots.txt, sitemap.xml, favicon.ico |
| `Chrome 124 / Windows NT 10` | 305 | 4 | 4 | EVEO S.A. (AS53107), Microsoft Corporation (AS8075), OVH SAS | direct fetch | backups / db dumps |
| `Chrome 133 / Windows NT 10` | 297 | 4 | 4 | Amazon.com, Inc. (AS14618), Google LLC (AS396982), Tc Datace | direct fetch | config / framework dirs, env / secrets |

## What the probes ask for

| Category | Requests |  |
| --- | ---: | --- |
| env / secrets | 812 | `████████████████████` |
| config / framework dirs | 312 | `████████` |
| wordpress | 245 | `██████` |
| php shells / probes | 171 | `████` |
| version control / CI | 114 | `███` |
| backups / db dumps | 80 | `██` |
| actuator / swagger | 51 | `█` |

Most requested paths: `.env` (122), `wp-includes` (95), `.git` (82), `wp-content` (63), `config` (53), `app` (52), `actuator` (51), `core` (35), `.env.production` (33), `assets` (30), `.env.backup` (28), `wp-admin` (28)

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
