# Crawler trap traffic report

_Built from 589 log files. Window: 2026-11-22 03:45 to 2026-11-23 12:51 UTC (33.1 h)._

| Metric | Value |
| --- | ---: |
| Logged hits | 115,577 |
| Bot-labelled hits | 98,905 (85.6%) |
| Distinct IPs | 1,511 |
| /16 ranges | 478 |
| Hostnames seen | 255 |
| Ban entries | 511 |
| Requests logged during bans | 165,599 |
| Form submissions (honeypot) | 2 |

## Traffic mix

| Source | Hits | Share |  |
| --- | ---: | ---: | --- |
| ClaudeBot | 51,496 | 44.6% | `████████████████████` |
| OAI-SearchBot | 43,823 | 37.9% | `█████████████████` |
| non-bot user agents | 16,672 | 14.4% | `██████` |
| GPTBot | 3,575 | 3.1% | `█` |
| Claude-User | 9 | 0.0% | `█` |
| Twitterbot | 1 | 0.0% | `█` |
| ChatGPT-User | 1 | 0.0% | `█` |

## Daily totals (3 of 3 days)

Day = the date in the log filename (server-local day), newest first.

| Day | Hits | ClaudeBot | OAI-SearchBot | GPTBot | other bots | non-bot | IPs | During bans |
| --- | ---: | ---: | ---: | ---: | ---: | ---: | ---: | ---: |
| 2026-11-23 | 27,845 | 9,899 | 15,075 | 1,254 | 1 | 1,616 | 628 | 50,663 |
| 2026-11-22 | 86,226 | 41,191 | 28,355 | 2,282 | 10 | 14,388 | 1,189 | 106,354 |
| 2026-11-21 | 1,506 | 406 | 393 | 39 | 0 | 668 | 322 | 8,582 |

## Requests received (served plus logged during bans)

`Served` is the maze's normal hit counter. `During bans` counts requests that arrived while the source was banned and were tarpitted. Together they show how hard each source really pushes.

| Source | Served | During bans | Received | Share | % of requests banned |  |
| --- | ---: | ---: | ---: | ---: | ---: | --- |
| GPTBot | 3,575 | 159,829 | 163,404 | 58.1% | 97.8% | `████████████████████` |
| ClaudeBot | 51,496 | 2,161 | 53,657 | 19.1% | 4.0% | `███████` |
| OAI-SearchBot | 43,823 | 3,380 | 47,203 | 16.8% | 7.2% | `██████` |
| non-bot | 16,672 | 229 | 16,901 | 6.0% | 1.4% | `██` |
| Claude-User | 9 | 0 | 9 | 0.0% | 0.0% | `█` |
| Twitterbot | 1 | 0 | 1 | 0.0% | 0.0% | `█` |
| ChatGPT-User | 1 | 0 | 1 | 0.0% | 0.0% | `█` |

## Crawler behaviour

**Pace and IP use.** Single-use IPs were seen for under a minute. Requests per minute are averaged over each bot's own active window.

| Bot | Served req/min | Incl. banned req/min | IPs | Single-use IPs | Median IP lifetime (h) | Longest (h) |
| --- | ---: | ---: | ---: | ---: | ---: | ---: |
| ClaudeBot | 25.9 | 27.0 | 1 | 0 | 33.1 | 33.1 |
| OAI-SearchBot | 22.3 | 24.0 | 257 | 1 | 32.7 | 32.7 |
| GPTBot | 1.8 | 82.4 | 245 | 83 | 3.0 | 32.7 |

**IP churn per day.** Active IPs, with brand-new IPs in brackets. A bot that keeps finding new IPs has a pool larger than what has been seen.

| Day | ClaudeBot | OAI-SearchBot | GPTBot |
| --- | ---: | ---: | ---: |
| 2026-11-21 | 1 (+1) | 203 (+203) | 34 (+34) |
| 2026-11-22 | 1 (+0) | 257 (+54) | 172 (+152) |
| 2026-11-23 | 1 (+0) | 256 (+0) | 153 (+59) |

**Bans.** A median gap equal to the ban length means the source is re-banned the moment each ban expires.

| Bot | Bans | By kind | Median gap between bans (s) | Busiest hour (UTC) | Ban length |
| --- | ---: | --- | ---: | ---: | --- |
| OAI-SearchBot | 367 | ip 364, agent 2, subnet 1 | 3623 | 04:00 | 10 min |
| GPTBot | 131 | ip 126, group 2, subnet 2, agent 1 | 600 | 04:00 | 10 min |
| ClaudeBot | 7 | agent 2, ip 2, subnet 2, group 1 | 31166 | 04:00 | 10 min |
| non-bot | 6 | agent 2, ip 2, subnet 2 | 1895 | 04:00 | 10 min |

**Section focus.** Evenness runs from 0 (one section only) to 1 (perfectly even). robots.txt, sitemap.xml and favicon.ico are excluded.

| Bot | Content requests | Sections | Top-4 share | Evenness | Top sections |
| --- | ---: | ---: | ---: | ---: | --- |
| ClaudeBot | 36,728 | 35 | 59.4% | 0.72 | tutorials 7,867, developers 6,478, docs 4,709, api 2,750 |
| GPTBot | 3,539 | 36 | 13.5% | 0.99 | comparison 124, resources 119, support 118, services 117 |

## Named crawlers

### ClaudeBot

- **Owner:** Amazon.com, Inc. (AS16509)
- **Hits:** 51,496 (44.6%) from 1 IP(s) in 1 /16 range(s)
- **/24 ranges (IPs):** `216.73.216.0/24` (1)
- **Vendor range check:** all 1 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 7,599 (14.8%); sitemap.xml: 6,210
- **Requests per IP:** 51,496.0 average
- **Bans:** 11; 2,161 further requests logged while banned
- **Top sections:** tutorials 7,867, robots.txt 7,599, developers 6,478, sitemap.xml 6,210, docs 4,709, api 2,750
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; ClaudeBot/1.0; +claudebot@anthropic.com)`

### OAI-SearchBot

- **Owner:** Microsoft Corporation (AS8075)
- **Hits:** 43,823 (37.9%) from 257 IP(s) in 2 /16 range(s)
- **/24 ranges (IPs):** `74.7.230.0/24` (52), `74.7.244.0/24` (52), `74.7.228.0/24` (51), `74.7.241.0/24` (51), `74.7.175.0/24` (50), `51.8.102.0/24` (1)
- **Vendor range check:** all 257 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 43,823 (100.0%); sitemap.xml: 0
- **Requests per IP:** 170.5 average
- **Bans:** 667; 3,380 further requests logged while banned
- **Top sections:** robots.txt 43,823
- **User agent:** `Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36; c`

### GPTBot

- **Owner:** Microsoft Corporation (AS8075)
- **Hits:** 3,575 (3.1%) from 245 IP(s) in 3 /16 range(s)
- **/24 ranges (IPs):** `74.7.227.0/24` (88), `74.7.241.0/24` (45), `74.7.242.0/24` (42), `74.7.243.0/24` (37), `132.196.86.0/24` (19), `172.182.202.0/24` (10), `172.182.207.0/24` (4)
- **Vendor range check:** all 245 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 99.1% followed maze links, 0.9% direct fetches
- **robots.txt requests:** 0 (0.0%); sitemap.xml: 31
- **Requests per IP:** 14.6 average
- **Bans:** 152; 159,829 further requests logged while banned
- **Top sections:** comparison 124, resources 119, support 118, services 117, case-studies 116, platform 115
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.4; +https://openai.com/gptbot)`

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

### Twitterbot

- **Owner:** T-Mobile USA, Inc. (AS21928)
- **Hits:** 1 (0.0%) from 0 IP(s) in 1 /16 range(s)
- **/24 ranges (IPs):** 
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 0 (0.0%); sitemap.xml: 0
- **User agent:** `Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_1) AppleWebKit/601.2.4 (KHTML, like Gecko) Version/9.0.1 Safari/601.2.4 fac`

### ChatGPT-User

- **Owner:** Microsoft Corporation (AS8075)
- **Hits:** 1 (0.0%) from 1 IP(s) in 1 /16 range(s)
- **/24 ranges (IPs):** `20.125.144.0/24` (1)
- **Vendor range check:** all 1 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 0 (0.0%); sitemap.xml: 0
- **Requests per IP:** 1.0 average
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko); compatible; ChatGPT-User/1.0; +https://openai.com/bot`

## Hits by network owner

| Owner | Hits | Share | /16s | IPs | Top ranges |
| --- | ---: | ---: | ---: | ---: | --- |
| Amazon.com, Inc. (AS16509) | 51,712 | 44.7% | 17 | 17 | `216.73.0.0/16`, `18.217.0.0/16`, `16.145.0.0/16`, `16.147.0.0/16` |
| Microsoft Corporation (AS8075) | 47,761 | 41.3% | 11 | 511 | `74.7.0.0/16`, `20.219.0.0/16`, `20.214.0.0/16`, `20.28.0.0/16` |
| UCLOUD INFORMATION TECHNOLOGY (HK) LIMITED (AS135377) | 4,693 | 4.1% | 5 | 9 | `152.32.0.0/16`, `154.51.0.0/16`, `45.249.0.0/16`, `103.218.0.0/16` |
| Google LLC (AS396982) | 3,854 | 3.3% | 43 | 57 | `34.96.0.0/16`, `34.154.0.0/16`, `34.21.0.0/16`, `34.83.0.0/16` |
| AGOTOZ PTE. LTD. (AS9465) | 1,393 | 1.2% | 1 | 7 | `156.225.0.0/16` |
| Techoff Srv Limited (AS48090) | 1,077 | 0.9% | 2 | 4 | `195.178.0.0/16`, `45.148.0.0/16` |
| Team Blue Carrier Limited (AS34282) | 507 | 0.4% | 1 | 2 | `85.92.0.0/16` |
| Facebook, Inc. (AS32934) | 477 | 0.4% | 4 | 91 | `173.252.0.0/16`, `57.141.0.0/16`, `69.171.0.0/16`, `69.63.0.0/16` |
| CHINANET Guangdong province network (AS58466) | 435 | 0.4% | 1 | 5 | `106.75.0.0/16` |
| NTT America, Inc. (AS2914) | 432 | 0.4% | 1 | 10 | `216.167.0.0/16` |
| Amazon.com, Inc. (AS14618) | 398 | 0.3% | 117 | 145 | `3.238.0.0/16`, `32.197.0.0/16`, `44.204.0.0/16`, `3.235.0.0/16` |
| Tencent Building, Kejizhongyi Avenue (AS132203) | 220 | 0.2% | 31 | 77 | `43.157.0.0/16`, `43.165.0.0/16`, `43.166.0.0/16`, `43.130.0.0/16` |
| GitHub, Inc. (AS36459) | 214 | 0.2% | 1 | 16 | `140.82.0.0/16` |
| Nexeon Technologies, Inc. (AS20278) | 198 | 0.2% | 2 | 2 | `23.94.0.0/16`, `23.95.0.0/16` |
| Fastly, Inc. (AS394192) | 196 | 0.2% | 1 | 183 | `87.81.0.0/16` |
| Alibaba (US) Technology Co., Ltd. (AS45102) | 190 | 0.2% | 7 | 20 | `43.106.0.0/16`, `8.218.0.0/16`, `47.84.0.0/16`, `43.98.0.0/16` |
| WholeSale Internet, Inc. (AS32097) | 188 | 0.2% | 1 | 1 | `23.128.0.0/16` |
| Cloudflare, Inc. (AS13335) | 183 | 0.2% | 2 | 21 | `104.29.0.0/16`, `104.28.0.0/16` |
| GTT Communications Inc. (AS3257) | 180 | 0.2% | 2 | 5 | `70.39.0.0/16`, `216.36.0.0/16` |
| Tc Datacenter Limited (AS218785) | 123 | 0.1% | 1 | 2 | `45.138.0.0/16` |
| DigitalOcean, LLC (AS14061) | 99 | 0.1% | 23 | 29 | `143.198.0.0/16`, `178.128.0.0/16`, `146.190.0.0/16`, `137.184.0.0/16` |
| Eweka Internet Services B.V. (AS34343) | 85 | 0.1% | 2 | 2 | `81.171.0.0/16`, `91.148.0.0/16` |
| Censys, Inc. (AS398324) | 83 | 0.1% | 1 | 12 | `66.132.0.0/16` |
| T-Mobile USA, Inc. (AS21928) | 70 | 0.1% | 1 | 3 | `172.56.0.0/16` |
| Datacamp Limited (AS212238) | 65 | 0.1% | 7 | 22 | `205.188.0.0/16`, `169.150.0.0/16`, `149.102.0.0/16`, `187.40.0.0/16` |
| 1337 Services GmbH (AS210558) | 47 | 0.0% | 1 | 2 | `45.94.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS207990) | 43 | 0.0% | 7 | 19 | `83.229.0.0/16`, `217.194.0.0/16`, `213.255.0.0/16`, `203.166.0.0/16` |
| The Constant Company, LLC (AS20473) | 41 | 0.0% | 4 | 4 | `137.220.0.0/16`, `192.248.0.0/16`, `45.63.0.0/16`, `216.238.0.0/16` |
| Cablevision Systems Corp. (AS6128) | 37 | 0.0% | 1 | 1 | `69.115.0.0/16` |
| NetLab Global (AS979) | 36 | 0.0% | 1 | 1 | `154.44.0.0/16` |
| Scloud Pte Ltd (AS142002) | 36 | 0.0% | 1 | 1 | `165.154.0.0/16` |
| FiberPower LLC (AS214483) | 36 | 0.0% | 1 | 1 | `23.148.0.0/16` |
| M247 Europe SRL (AS9009) | 34 | 0.0% | 4 | 11 | `146.70.0.0/16`, `104.253.0.0/16`, `109.174.0.0/16`, `135.136.0.0/16` |
| Akamai Connected Cloud (AS63949) | 29 | 0.0% | 10 | 14 | `172.236.0.0/16`, `45.79.0.0/16`, `172.104.0.0/16`, `172.239.0.0/16` |
| TechTies Inc. (AS197170) | 25 | 0.0% | 4 | 5 | `94.26.0.0/16`, `85.11.0.0/16`, `91.92.0.0/16`, `45.156.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS203020) | 23 | 0.0% | 3 | 8 | `45.92.0.0/16`, `31.209.0.0/16`, `155.94.0.0/16` |
| Evoxt Sdn. Bhd. (AS149440) | 22 | 0.0% | 1 | 1 | `96.126.0.0/16` |
| Oracle Corporation (AS31898) | 20 | 0.0% | 2 | 2 | `141.148.0.0/16`, `129.213.0.0/16` |
| Hetzner Online GmbH (AS24940) | 17 | 0.0% | 8 | 9 | `91.98.0.0/16`, `116.202.0.0/16`, `159.69.0.0/16`, `162.55.0.0/16` |
| Driftnet Ltd (AS211298) | 14 | 0.0% | 3 | 8 | `87.236.0.0/16`, `195.96.0.0/16`, `185.247.0.0/16` |
| Web2Objects LLC (AS62874) | 12 | 0.0% | 3 | 5 | `142.147.0.0/16`, `104.238.0.0/16`, `45.56.0.0/16` |
| LogicWeb Inc. (AS64286) | 12 | 0.0% | 3 | 3 | `149.57.0.0/16`, `154.6.0.0/16`, `173.239.0.0/16` |
| OVH SAS (AS16276) | 11 | 0.0% | 4 | 4 | `135.125.0.0/16`, `149.56.0.0/16`, `54.38.0.0/16`, `152.228.0.0/16` |
| Korea Telecom (AS4766) | 11 | 0.0% | 2 | 2 | `59.14.0.0/16`, `211.230.0.0/16` |
| Hangzhou Alibaba Advertising Co.,Ltd. (AS37963) | 9 | 0.0% | 4 | 4 | `120.55.0.0/16`, `47.108.0.0/16`, `47.96.0.0/16`, `8.148.0.0/16` |
| Dedik Services Limited (AS209413) | 9 | 0.0% | 1 | 1 | `176.65.0.0/16` |
| British Telecommunications Limited (AS2856) | 8 | 0.0% | 1 | 2 | `31.121.0.0/16` |
| IP Volume inc (AS202425) | 8 | 0.0% | 3 | 5 | `94.102.0.0/16`, `89.248.0.0/16`, `93.174.0.0/16` |
| HostPapa (AS36352) | 7 | 0.0% | 5 | 6 | `107.172.0.0/16`, `107.174.0.0/16`, `107.173.0.0/16`, `172.245.0.0/16` |
| Chinanet (AS4134) | 7 | 0.0% | 4 | 5 | `49.87.0.0/16`, `123.160.0.0/16`, `120.39.0.0/16`, `58.59.0.0/16` |
| Leaseweb Canada Inc. (AS32613) | 6 | 0.0% | 1 | 5 | `192.175.0.0/16` |
| CHINA UNICOM China169 Backbone (AS4837) | 5 | 0.0% | 2 | 2 | `113.224.0.0/16`, `113.232.0.0/16` |
| IT7 Networks Inc (AS25820) | 5 | 0.0% | 2 | 3 | `98.142.0.0/16`, `144.34.0.0/16` |
| Hydra Communications Ltd (AS25369) | 5 | 0.0% | 3 | 5 | `200.138.0.0/16`, `64.205.0.0/16`, `77.67.0.0/16` |
| Level 3 Parent, LLC (AS3356) | 5 | 0.0% | 1 | 3 | `205.169.0.0/16` |
| Psychz Networks (AS40676) | 5 | 0.0% | 2 | 3 | `23.27.0.0/16`, `205.236.0.0/16` |
| Latitude.sh (AS396356) | 4 | 0.0% | 3 | 4 | `81.168.0.0/16`, `104.239.0.0/16`, `216.173.0.0/16` |
| RCN (AS6079) | 4 | 0.0% | 3 | 3 | `216.133.0.0/16`, `108.171.0.0/16`, `170.124.0.0/16` |
| SAKURA Internet Inc. (AS7684) | 4 | 0.0% | 1 | 1 | `133.242.0.0/16` |
| Leaseweb USA, Inc. (AS395954) | 4 | 0.0% | 2 | 3 | `152.163.0.0/16`, `212.42.0.0/16` |
| F.n.s. Holdings Limited (AS206092) | 4 | 0.0% | 1 | 4 | `45.86.0.0/16` |
| VeriSign Infrastructure & Operations (AS11840) | 4 | 0.0% | 1 | 1 | `72.13.0.0/16` |
| Modat B.V. (AS209334) | 4 | 0.0% | 1 | 3 | `85.217.0.0/16` |
| WS Telecom Inc (AS213541) | 4 | 0.0% | 1 | 1 | `85.28.0.0/16` |
| EGIHosting (AS18779) | 3 | 0.0% | 2 | 3 | `104.165.0.0/16`, `172.120.0.0/16` |
| Philippine Long Distance Telephone Company (AS9299) | 3 | 0.0% | 1 | 1 | `119.93.0.0/16` |
| Kamatera, Inc. (AS396948) | 3 | 0.0% | 1 | 1 | `147.185.0.0/16` |
| China Telecom (AS138169) | 3 | 0.0% | 1 | 1 | `171.111.0.0/16` |
| Unidentified | 3 | 0.0% | 2 | 2 | `172.18.0.0/16`, `unknown` |
| Cox Communications Inc. (AS22773) | 3 | 0.0% | 2 | 3 | `90.96.0.0/16`, `184.181.0.0/16` |
| LINZ STROM GAS WAERME GmbH fuer Energiedienstleistungen und Telekommunikation (AS35369) | 3 | 0.0% | 1 | 2 | `185.242.0.0/16` |
| GSL Networks Pty LTD (AS137409) | 3 | 0.0% | 2 | 3 | `203.25.0.0/16`, `217.145.0.0/16` |
| Comcast Cable Communications, LLC (AS7922) | 3 | 0.0% | 2 | 2 | `48.46.0.0/16`, `48.45.0.0/16` |
| INEA sp. z o.o. (AS13110) | 3 | 0.0% | 1 | 1 | `77.65.0.0/16` |
| Server Galactic Private Limited (AS150423) | 3 | 0.0% | 2 | 3 | `82.108.0.0/16`, `87.82.0.0/16` |
| Turk Telekom (AS9121) | 3 | 0.0% | 1 | 1 | `95.3.0.0/16` |
| Varendra IT (AS151391) | 2 | 0.0% | 1 | 1 | `103.150.0.0/16` |
| Getechbrothers, MB (AS202044) | 2 | 0.0% | 1 | 1 | `104.233.0.0/16` |
| Shenzhen Tencent Computer Systems Company Limited (AS45090) | 2 | 0.0% | 2 | 2 | `119.91.0.0/16`, `49.233.0.0/16` |
| Datacamp Limited (AS60068) | 2 | 0.0% | 1 | 1 | `138.199.0.0/16` |
| Comcast Cable Communications, LLC (AS33659) | 2 | 0.0% | 2 | 2 | `138.226.0.0/16`, `170.100.0.0/16` |
| Connect Northwest Internet Services, LLC (AS10557) | 2 | 0.0% | 1 | 1 | `142.252.0.0/16` |
| Cogent Communications, LLC (AS174) | 2 | 0.0% | 2 | 2 | `149.100.0.0/16`, `38.132.0.0/16` |
| MEVSPACE sp. z o.o. (AS201814) | 2 | 0.0% | 1 | 1 | `149.50.0.0/16` |
| Proton AG (AS208172) | 2 | 0.0% | 1 | 1 | `159.26.0.0/16` |
| Uniti Fiber Holdings Inc. (AS13760) | 2 | 0.0% | 1 | 1 | `170.249.0.0/16` |
| True Online (AS17552) | 2 | 0.0% | 1 | 1 | `171.96.0.0/16` |
| Tier.Net Technologies LLC (AS397423) | 2 | 0.0% | 2 | 2 | `173.0.0.0/16`, `198.37.0.0/16` |
| Charter Communications Inc (AS11426) | 2 | 0.0% | 2 | 2 | `175.29.0.0/16`, `94.103.0.0/16` |
| Space Exploration Technologies Corporation (AS14593) | 2 | 0.0% | 1 | 1 | `179.65.0.0/16` |
| SERVICIOS DE TELECOMUNICACIONES SETEL S.A. (XTRIM EC) (AS14522) | 2 | 0.0% | 1 | 1 | `186.66.0.0/16` |
| B2 Net Solutions Inc. (AS55286) | 2 | 0.0% | 2 | 2 | `192.198.0.0/16`, `209.127.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS39486) | 2 | 0.0% | 2 | 2 | `193.42.0.0/16`, `194.116.0.0/16` |
| Link3 Technologies Ltd. (AS23688) | 2 | 0.0% | 1 | 1 | `27.147.0.0/16` |
| GRUPO PANAGLOBAL 15 S.A (AS264617) | 2 | 0.0% | 1 | 1 | `45.39.0.0/16` |
| Netlen Internet Hizmetleri Ltd. Sti. (AS44620) | 2 | 0.0% | 1 | 1 | `45.74.0.0/16` |
| Verizon Business (AS701) | 2 | 0.0% | 1 | 1 | `65.206.0.0/16` |
| CariNet, Inc. (AS10439) | 2 | 0.0% | 1 | 1 | `71.6.0.0/16` |
| Cablevision Lightpath LLC (AS54004) | 2 | 0.0% | 1 | 2 | `74.48.0.0/16` |
| kabelplus GmbH (AS8339) | 2 | 0.0% | 1 | 1 | `81.217.0.0/16` |
| Wave Broadband (AS11404) | 2 | 0.0% | 1 | 1 | `82.22.0.0/16` |
| IONOS SE (AS8560) | 2 | 0.0% | 1 | 1 | `82.223.0.0/16` |
| Glesys Sweden AB (AS42708) | 2 | 0.0% | 1 | 1 | `85.203.0.0/16` |
| Internetport Sweden AB (AS49770) | 2 | 0.0% | 1 | 1 | `92.112.0.0/16` |
| Microsoft Azure | 1 | 0.0% | 1 | 1 | `10.234.0.0/16` |
| PT Remala Abadi (AS38511) | 1 | 0.0% | 1 | 1 | `101.255.0.0/16` |
| Latitude.sh LTDA (AS262287) | 1 | 0.0% | 1 | 1 | `104.252.0.0/16` |
| Leaseweb USA, Inc. (AS27411) | 1 | 0.0% | 1 | 1 | `142.111.0.0/16` |
| RouterHosting LLC (AS14956) | 1 | 0.0% | 1 | 1 | `153.75.0.0/16` |
| ColoUp (AS19084) | 1 | 0.0% | 1 | 1 | `162.245.0.0/16` |
| HK Broadband Network Ltd. (AS10103) | 1 | 0.0% | 1 | 1 | `165.84.0.0/16` |
| Code200, UAB (AS149428) | 1 | 0.0% | 1 | 1 | `172.102.0.0/16` |
| SYN LTD (AS50077) | 1 | 0.0% | 1 | 1 | `185.135.0.0/16` |
| Tarin General Trading and Setting Up Internet Device LTD (AS197882) | 1 | 0.0% | 1 | 1 | `185.184.0.0/16` |
| Bamboozle Web Services MEA FZ-LLC (AS200851) | 1 | 0.0% | 1 | 1 | `185.243.0.0/16` |
| Internet Resources Management SRL (AS48955) | 1 | 0.0% | 1 | 1 | `188.214.0.0/16` |
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
| Leaseweb Deutschland GmbH (AS28753) | 1 | 0.0% | 1 | 1 | `31.59.0.0/16` |
| China Mobile communications corporation (AS56041) | 1 | 0.0% | 1 | 1 | `39.182.0.0/16` |
| DB3 SERVICOS DE TELECOMUNICACOES S.A (AS28598) | 1 | 0.0% | 1 | 1 | `45.179.0.0/16` |
| Hurricane Electric LLC (AS6939) | 1 | 0.0% | 1 | 1 | `74.82.0.0/16` |
| AT&T Enterprises, LLC (AS7018) | 1 | 0.0% | 1 | 1 | `76.200.0.0/16` |
| O.m.c. Computers & Communications Ltd (AS44709) | 1 | 0.0% | 1 | 1 | `79.108.0.0/16` |
| LeaseWeb Netherlands B.V. (AS60781) | 1 | 0.0% | 1 | 1 | `82.192.0.0/16` |
| EN Technologies Pte Ltd (AS133210) | 1 | 0.0% | 1 | 1 | `82.21.0.0/16` |
| Cyberneticos Hosting SL (AS198968) | 1 | 0.0% | 1 | 1 | `82.26.0.0/16` |
| AltusHost B.V. (AS51430) | 1 | 0.0% | 1 | 1 | `82.27.0.0/16` |
| WebWorld (AS30900) | 1 | 0.0% | 1 | 1 | `82.29.0.0/16` |
| UAB Bite Lietuva (AS210906) | 1 | 0.0% | 1 | 1 | `86.38.0.0/16` |
| Leaseweb USA, Inc. (AS19148) | 1 | 0.0% | 1 | 1 | `89.249.0.0/16` |

## Non-bot fingerprints (top 15 by hits)

Same user-agent hash across many ranges usually means one operator or toolkit.

| User agent | Hits | IPs | /16s | Owners | Mode | Requests |
| --- | ---: | ---: | ---: | --- | --- | --- |
| `Chrome 49 / Windows NT 6.1` | 6,521 | 61 | 7 | AGOTOZ PTE. LTD. (AS9465), CHINANET Guangdong province netwo | direct fetch | favicon.ico |
| `Chrome 131 / Windows NT 10` | 1,427 | 11 | 10 | Amazon.com, Inc. (AS14618), DigitalOcean, LLC (AS14061), Goo | direct fetch | env / secrets, config / framework dirs |
| `Chrome 114 / Android 12` | 926 | 5 | 5 | Google LLC (AS396982) | direct fetch | support, pricing, marketplace |
| `Chrome 147 / Windows NT 10` | 794 | 22 | 9 | Alibaba (US) Technology Co., Ltd. (AS45102), FiberPower LLC  | link-follower | api, favicon.ico |
| `Chrome 131 / Macintosh` | 774 | 6 | 6 | Google LLC (AS396982), Techoff Srv Limited (AS48090) | direct fetch | env / secrets, config / framework dirs |
| `Chrome 131 / Linux` | 747 | 4 | 4 | Amazon.com, Inc. (AS16509), Google LLC (AS396982), Techoff S | direct fetch | env / secrets, config / framework dirs |
| `Mozilla/5.0 (compatible; XML Sitemaps Generator; w` | 505 | 2 | 1 | Team Blue Carrier Limited (AS34282) | link-follower | careers, marketplace, help-centre |
| `facebookexternalhit/1.1 (+http://www.facebook.com/` | 417 | 149 | 3 | Facebook, Inc. (AS32934) | direct fetch | robots.txt |
| `Chrome 157 / Windows NT 10` | 392 | 8 | 4 | Leaseweb Canada Inc. (AS32613), Nexeon Technologies, Inc. (A | link-follower | help-centre, webinars, company |
| `Chrome 133 / Linux` | 385 | 1 | 1 | Techoff Srv Limited (AS48090) | direct fetch | config / framework dirs, env / secrets |
| `Chrome 120 / Windows NT 10` | 367 | 18 | 18 | Amazon.com, Inc. (AS14618), Evoxt Sdn. Bhd. (AS149440), Goog | direct fetch | wordpress, php shells / probes |
| `Chrome 133 / Windows NT 10` | 287 | 3 | 3 | Amazon.com, Inc. (AS14618), Tc Datacenter Limited (AS218785) | direct fetch | config / framework dirs, env / secrets |
| `Chrome 133 / Macintosh` | 270 | 2 | 2 | Tc Datacenter Limited (AS218785), Techoff Srv Limited (AS480 | direct fetch | config / framework dirs, env / secrets |
| `GitHub-Hookshot/3754261` | 231 | 100 | 2 | GitHub, Inc. (AS36459), Microsoft Corporation (AS8075) | direct fetch | webhooks |
| `Safari 13 / iPhone OS 13.2.3` | 219 | 168 | 32 | Shenzhen Tencent Computer Systems Company Limited (AS45090), | direct fetch | integrations, newsroom, tutorials |

## What the probes ask for

| Category | Requests |  |
| --- | ---: | --- |
| env / secrets | 549 | `████████████████████` |
| wordpress | 230 | `████████` |
| config / framework dirs | 218 | `████████` |
| php shells / probes | 151 | `██████` |
| version control / CI | 69 | `███` |
| backups / db dumps | 57 | `██` |
| actuator / swagger | 48 | `██` |

Most requested paths: `wp-includes` (79), `wp-content` (63), `actuator` (48), `.git` (44), `.env` (42), `config` (39), `app` (37), `wp-login.php` (26), `wp-admin` (25), `.env.txt` (22), `.env.backup` (21), `.env.save` (21)

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
