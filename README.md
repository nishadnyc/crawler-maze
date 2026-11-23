# Crawler trap traffic report

_Built from 629 log files. Window: 2026-11-22 03:45 to 2026-11-23 13:49 UTC (34.1 h)._

| Metric | Value |
| --- | ---: |
| Logged hits | 119,590 |
| Bot-labelled hits | 102,146 (85.4%) |
| Distinct IPs | 1,557 |
| /16 ranges | 506 |
| Hostnames seen | 258 |
| Ban entries | 528 |
| Requests logged during bans | 172,236 |
| Form submissions (honeypot) | 2 |

## Traffic mix

| Source | Hits | Share |  |
| --- | ---: | ---: | --- |
| ClaudeBot | 52,603 | 44.0% | `████████████████████` |
| OAI-SearchBot | 45,705 | 38.2% | `█████████████████` |
| non-bot user agents | 17,444 | 14.6% | `███████` |
| GPTBot | 3,731 | 3.1% | `█` |
| l9scan | 96 | 0.1% | `█` |
| Claude-User | 9 | 0.0% | `█` |
| Twitterbot | 1 | 0.0% | `█` |
| ChatGPT-User | 1 | 0.0% | `█` |

## Daily totals (3 of 3 days)

Day = the date in the log filename (server-local day), newest first.

| Day | Hits | ClaudeBot | OAI-SearchBot | GPTBot | other bots | non-bot | IPs | During bans |
| --- | ---: | ---: | ---: | ---: | ---: | ---: | ---: | ---: |
| 2026-11-23 | 31,858 | 11,006 | 16,957 | 1,410 | 97 | 2,388 | 691 | 57,300 |
| 2026-11-22 | 86,226 | 41,191 | 28,355 | 2,282 | 10 | 14,388 | 1,189 | 106,354 |
| 2026-11-21 | 1,506 | 406 | 393 | 39 | 0 | 668 | 322 | 8,582 |

## Requests received (served plus logged during bans)

`Served` is the maze's normal hit counter. `During bans` counts requests that arrived while the source was banned and were tarpitted. Together they show how hard each source really pushes.

| Source | Served | During bans | Received | Share | % of requests banned |  |
| --- | ---: | ---: | ---: | ---: | ---: | --- |
| GPTBot | 3,731 | 166,338 | 170,069 | 58.3% | 97.8% | `████████████████████` |
| ClaudeBot | 52,603 | 2,161 | 54,764 | 18.8% | 3.9% | `██████` |
| OAI-SearchBot | 45,705 | 3,508 | 49,213 | 16.9% | 7.1% | `██████` |
| non-bot | 17,444 | 229 | 17,673 | 6.1% | 1.3% | `██` |
| l9scan | 96 | 0 | 96 | 0.0% | 0.0% | `█` |
| Claude-User | 9 | 0 | 9 | 0.0% | 0.0% | `█` |
| Twitterbot | 1 | 0 | 1 | 0.0% | 0.0% | `█` |
| ChatGPT-User | 1 | 0 | 1 | 0.0% | 0.0% | `█` |

## Crawler behaviour

**Pace and IP use.** Single-use IPs were seen for under a minute. Requests per minute are averaged over each bot's own active window.

| Bot | Served req/min | Incl. banned req/min | IPs | Single-use IPs | Median IP lifetime (h) | Longest (h) |
| --- | ---: | ---: | ---: | ---: | ---: | ---: |
| ClaudeBot | 25.7 | 26.8 | 3 | 2 | 0.0 | 34.1 |
| OAI-SearchBot | 22.6 | 24.3 | 257 | 1 | 33.7 | 33.7 |
| GPTBot | 1.8 | 83.4 | 241 | 77 | 3.0 | 33.7 |
| l9scan | 2.5 | 2.5 | 3 | 3 | 0.0 | 0.0 |

**IP churn per day.** Active IPs, with brand-new IPs in brackets. A bot that keeps finding new IPs has a pool larger than what has been seen.

| Day | ClaudeBot | OAI-SearchBot | GPTBot | l9scan |
| --- | ---: | ---: | ---: | ---: |
| 2026-11-21 | 1 (+1) | 203 (+203) | 34 (+34) | - |
| 2026-11-22 | 1 (+0) | 257 (+54) | 172 (+152) | - |
| 2026-11-23 | 3 (+2) | 256 (+0) | 157 (+55) | 3 (+3) |

**Bans.** A median gap equal to the ban length means the source is re-banned the moment each ban expires.

| Bot | Bans | By kind | Median gap between bans (s) | Busiest hour (UTC) | Ban length |
| --- | ---: | --- | ---: | ---: | --- |
| OAI-SearchBot | 379 | ip 376, agent 2, subnet 1 | 3622 | 04:00 | 10 min |
| GPTBot | 136 | ip 131, group 2, subnet 2, agent 1 | 600 | 04:00 | 10 min |
| ClaudeBot | 7 | agent 2, ip 2, subnet 2, group 1 | 31166 | 04:00 | 10 min |
| non-bot | 6 | agent 2, ip 2, subnet 2 | 1895 | 04:00 | 10 min |

**Section focus.** Evenness runs from 0 (one section only) to 1 (perfectly even). robots.txt, sitemap.xml and favicon.ico are excluded.

| Bot | Content requests | Sections | Top-4 share | Evenness | Top sections |
| --- | ---: | ---: | ---: | ---: | --- |
| ClaudeBot | 37,449 | 35 | 59.3% | 0.72 | tutorials 8,052, developers 6,585, docs 4,813, api 2,750 |
| GPTBot | 3,693 | 36 | 13.4% | 0.99 | comparison 128, resources 122, services 122, partners 122 |

## Named crawlers

### ClaudeBot

- **Owner:** Amazon.com, Inc. (AS16509)
- **Hits:** 52,603 (44.0%) from 3 IP(s) in 1 /16 range(s)
- **/24 ranges (IPs):** `216.73.216.0/24` (3)
- **Vendor range check:** all 3 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 7,794 (14.8%); sitemap.xml: 6,390
- **Requests per IP:** 17,534.3 average
- **Bans:** 11; 2,161 further requests logged while banned
- **Top sections:** tutorials 8,052, robots.txt 7,794, developers 6,585, sitemap.xml 6,390, docs 4,813, api 2,750
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; ClaudeBot/1.0; +claudebot@anthropic.com)`

### OAI-SearchBot

- **Owner:** Microsoft Corporation (AS8075)
- **Hits:** 45,705 (38.2%) from 257 IP(s) in 2 /16 range(s)
- **/24 ranges (IPs):** `74.7.230.0/24` (52), `74.7.244.0/24` (52), `74.7.228.0/24` (51), `74.7.241.0/24` (51), `74.7.175.0/24` (50), `51.8.102.0/24` (1)
- **Vendor range check:** all 257 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 45,705 (100.0%); sitemap.xml: 0
- **Requests per IP:** 177.8 average
- **Bans:** 696; 3,508 further requests logged while banned
- **Top sections:** robots.txt 45,705
- **User agent:** `Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36; c`

### GPTBot

- **Owner:** Microsoft Corporation (AS8075)
- **Hits:** 3,731 (3.1%) from 241 IP(s) in 3 /16 range(s)
- **/24 ranges (IPs):** `74.7.227.0/24` (88), `74.7.242.0/24` (43), `74.7.241.0/24` (40), `74.7.243.0/24` (39), `132.196.86.0/24` (17), `172.182.202.0/24` (9), `172.182.207.0/24` (5)
- **Vendor range check:** all 241 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 99.1% followed maze links, 0.9% direct fetches
- **robots.txt requests:** 0 (0.0%); sitemap.xml: 33
- **Requests per IP:** 15.5 average
- **Bans:** 158; 166,338 further requests logged while banned
- **Top sections:** comparison 128, resources 122, services 122, partners 122, case-studies 121, platform 120
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.4; +https://openai.com/gptbot)`

### l9scan

- **Owner:** DigitalOcean, LLC (AS14061)
- **Hits:** 96 (0.1%) from 3 IP(s) in 3 /16 range(s)
- **/24 ranges (IPs):** `138.68.86.0/24` (1), `142.93.129.0/24` (1), `206.189.19.0/24` (1)
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 0 (0.0%); sitemap.xml: 0
- **Requests per IP:** 32.0 average
- **Top sections:** api 9, graphql 6, console 3, server 3, server-status 3, about 3
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
| Amazon.com, Inc. (AS16509) | 52,819 | 44.2% | 17 | 19 | `216.73.0.0/16`, `18.217.0.0/16`, `16.145.0.0/16`, `16.147.0.0/16` |
| Microsoft Corporation (AS8075) | 49,800 | 41.6% | 11 | 506 | `74.7.0.0/16`, `20.219.0.0/16`, `20.214.0.0/16`, `20.28.0.0/16` |
| UCLOUD INFORMATION TECHNOLOGY (HK) LIMITED (AS135377) | 4,693 | 3.9% | 5 | 9 | `152.32.0.0/16`, `154.51.0.0/16`, `45.249.0.0/16`, `103.218.0.0/16` |
| Google LLC (AS396982) | 3,866 | 3.2% | 44 | 59 | `34.96.0.0/16`, `34.154.0.0/16`, `34.21.0.0/16`, `34.83.0.0/16` |
| AGOTOZ PTE. LTD. (AS9465) | 1,393 | 1.2% | 1 | 7 | `156.225.0.0/16` |
| Techoff Srv Limited (AS48090) | 1,076 | 0.9% | 2 | 5 | `195.178.0.0/16`, `45.148.0.0/16` |
| Facebook, Inc. (AS32934) | 592 | 0.5% | 4 | 95 | `173.252.0.0/16`, `57.141.0.0/16`, `69.171.0.0/16`, `69.63.0.0/16` |
| Team Blue Carrier Limited (AS34282) | 507 | 0.4% | 1 | 2 | `85.92.0.0/16` |
| CHINANET Guangdong province network (AS58466) | 435 | 0.4% | 1 | 5 | `106.75.0.0/16` |
| NTT America, Inc. (AS2914) | 432 | 0.4% | 1 | 10 | `216.167.0.0/16` |
| Amazon.com, Inc. (AS14618) | 403 | 0.3% | 118 | 146 | `3.238.0.0/16`, `32.197.0.0/16`, `44.204.0.0/16`, `3.235.0.0/16` |
| Alibaba (US) Technology Co., Ltd. (AS45102) | 398 | 0.3% | 7 | 24 | `8.218.0.0/16`, `43.106.0.0/16`, `43.98.0.0/16`, `47.84.0.0/16` |
| Tencent Building, Kejizhongyi Avenue (AS132203) | 225 | 0.2% | 31 | 77 | `43.157.0.0/16`, `43.165.0.0/16`, `43.166.0.0/16`, `43.130.0.0/16` |
| OVH SAS (AS16276) | 215 | 0.2% | 6 | 6 | `158.69.0.0/16`, `135.125.0.0/16`, `57.129.0.0/16`, `149.56.0.0/16` |
| GitHub, Inc. (AS36459) | 215 | 0.2% | 1 | 16 | `140.82.0.0/16` |
| Nexeon Technologies, Inc. (AS20278) | 198 | 0.2% | 2 | 2 | `23.94.0.0/16`, `23.95.0.0/16` |
| Fastly, Inc. (AS394192) | 196 | 0.2% | 1 | 183 | `87.81.0.0/16` |
| DigitalOcean, LLC (AS14061) | 195 | 0.2% | 27 | 34 | `138.68.0.0/16`, `142.93.0.0/16`, `206.189.0.0/16`, `143.198.0.0/16` |
| Cloudflare, Inc. (AS13335) | 194 | 0.2% | 2 | 21 | `104.29.0.0/16`, `104.28.0.0/16` |
| WholeSale Internet, Inc. (AS32097) | 188 | 0.2% | 1 | 1 | `23.128.0.0/16` |
| GTT Communications Inc. (AS3257) | 180 | 0.2% | 2 | 5 | `70.39.0.0/16`, `216.36.0.0/16` |
| Eweka Internet Services B.V. (AS34343) | 142 | 0.1% | 2 | 3 | `81.171.0.0/16`, `91.148.0.0/16` |
| M247 Europe SRL (AS9009) | 134 | 0.1% | 6 | 16 | `103.4.0.0/16`, `146.70.0.0/16`, `103.196.0.0/16`, `104.253.0.0/16` |
| Tc Datacenter Limited (AS218785) | 123 | 0.1% | 1 | 2 | `45.138.0.0/16` |
| Censys, Inc. (AS398324) | 83 | 0.1% | 1 | 12 | `66.132.0.0/16` |
| T-Mobile USA, Inc. (AS21928) | 70 | 0.1% | 1 | 3 | `172.56.0.0/16` |
| Datacamp Limited (AS212238) | 68 | 0.1% | 10 | 25 | `205.188.0.0/16`, `169.150.0.0/16`, `149.102.0.0/16`, `187.40.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS207990) | 49 | 0.0% | 9 | 22 | `83.229.0.0/16`, `217.194.0.0/16`, `188.212.0.0/16`, `213.255.0.0/16` |
| 1337 Services GmbH (AS210558) | 47 | 0.0% | 1 | 2 | `45.94.0.0/16` |
| Cablevision Systems Corp. (AS6128) | 47 | 0.0% | 1 | 1 | `69.115.0.0/16` |
| The Constant Company, LLC (AS20473) | 41 | 0.0% | 4 | 4 | `137.220.0.0/16`, `192.248.0.0/16`, `45.63.0.0/16`, `216.238.0.0/16` |
| NetLab Global (AS979) | 36 | 0.0% | 1 | 1 | `154.44.0.0/16` |
| Scloud Pte Ltd (AS142002) | 36 | 0.0% | 1 | 1 | `165.154.0.0/16` |
| FiberPower LLC (AS214483) | 36 | 0.0% | 1 | 1 | `23.148.0.0/16` |
| Akamai Connected Cloud (AS63949) | 30 | 0.0% | 10 | 15 | `172.236.0.0/16`, `45.79.0.0/16`, `172.239.0.0/16`, `172.104.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS203020) | 25 | 0.0% | 4 | 9 | `45.92.0.0/16`, `31.209.0.0/16`, `103.93.0.0/16`, `155.94.0.0/16` |
| TechTies Inc. (AS197170) | 25 | 0.0% | 4 | 5 | `94.26.0.0/16`, `85.11.0.0/16`, `91.92.0.0/16`, `45.156.0.0/16` |
| Hetzner Online GmbH (AS24940) | 22 | 0.0% | 9 | 10 | `88.198.0.0/16`, `91.98.0.0/16`, `116.202.0.0/16`, `159.69.0.0/16` |
| Evoxt Sdn. Bhd. (AS149440) | 22 | 0.0% | 1 | 1 | `96.126.0.0/16` |
| Oracle Corporation (AS31898) | 20 | 0.0% | 2 | 2 | `141.148.0.0/16`, `129.213.0.0/16` |
| Driftnet Ltd (AS211298) | 14 | 0.0% | 3 | 8 | `87.236.0.0/16`, `195.96.0.0/16`, `185.247.0.0/16` |
| Web2Objects LLC (AS62874) | 12 | 0.0% | 3 | 5 | `142.147.0.0/16`, `104.238.0.0/16`, `45.56.0.0/16` |
| LogicWeb Inc. (AS64286) | 12 | 0.0% | 3 | 3 | `149.57.0.0/16`, `154.6.0.0/16`, `173.239.0.0/16` |
| Dedik Services Limited (AS209413) | 12 | 0.0% | 1 | 1 | `176.65.0.0/16` |
| IP Volume inc (AS202425) | 11 | 0.0% | 4 | 7 | `94.102.0.0/16`, `185.242.0.0/16`, `89.248.0.0/16`, `93.174.0.0/16` |
| Level 3 Parent, LLC (AS3356) | 11 | 0.0% | 3 | 7 | `205.169.0.0/16`, `45.39.0.0/16`, `92.112.0.0/16` |
| Korea Telecom (AS4766) | 11 | 0.0% | 2 | 2 | `59.14.0.0/16`, `211.230.0.0/16` |
| Hangzhou Alibaba Advertising Co.,Ltd. (AS37963) | 9 | 0.0% | 4 | 4 | `120.55.0.0/16`, `47.108.0.0/16`, `47.96.0.0/16`, `8.148.0.0/16` |
| EGIHosting (AS18779) | 8 | 0.0% | 3 | 6 | `23.27.0.0/16`, `104.165.0.0/16`, `172.120.0.0/16` |
| British Telecommunications Limited (AS2856) | 8 | 0.0% | 1 | 2 | `31.121.0.0/16` |
| HostPapa (AS36352) | 7 | 0.0% | 5 | 6 | `107.172.0.0/16`, `107.174.0.0/16`, `107.173.0.0/16`, `172.245.0.0/16` |
| Chinanet (AS4134) | 7 | 0.0% | 4 | 5 | `49.87.0.0/16`, `123.160.0.0/16`, `120.39.0.0/16`, `58.59.0.0/16` |
| CHINA UNICOM China169 Backbone (AS4837) | 6 | 0.0% | 2 | 2 | `113.224.0.0/16`, `113.232.0.0/16` |
| Leaseweb Canada Inc. (AS32613) | 6 | 0.0% | 1 | 5 | `192.175.0.0/16` |
| Hydra Communications Ltd (AS25369) | 5 | 0.0% | 3 | 5 | `200.138.0.0/16`, `64.205.0.0/16`, `77.67.0.0/16` |
| Latitude.sh (AS396356) | 4 | 0.0% | 3 | 4 | `81.168.0.0/16`, `104.239.0.0/16`, `216.173.0.0/16` |
| RCN (AS6079) | 4 | 0.0% | 3 | 3 | `216.133.0.0/16`, `108.171.0.0/16`, `170.124.0.0/16` |
| SAKURA Internet Inc. (AS7684) | 4 | 0.0% | 1 | 1 | `133.242.0.0/16` |
| Leaseweb USA, Inc. (AS395954) | 4 | 0.0% | 2 | 3 | `152.163.0.0/16`, `212.42.0.0/16` |
| F.n.s. Holdings Limited (AS206092) | 4 | 0.0% | 1 | 4 | `45.86.0.0/16` |
| VeriSign Infrastructure & Operations (AS11840) | 4 | 0.0% | 1 | 1 | `72.13.0.0/16` |
| Modat B.V. (AS209334) | 4 | 0.0% | 1 | 3 | `85.217.0.0/16` |
| WS Telecom Inc (AS213541) | 4 | 0.0% | 1 | 1 | `85.28.0.0/16` |
| Yanoor Islam Khan (AS213186) | 4 | 0.0% | 1 | 1 | `98.142.0.0/16` |
| Philippine Long Distance Telephone Company (AS9299) | 3 | 0.0% | 1 | 1 | `119.93.0.0/16` |
| Kamatera, Inc. (AS396948) | 3 | 0.0% | 1 | 1 | `147.185.0.0/16` |
| MEVSPACE sp. z o.o. (AS201814) | 3 | 0.0% | 1 | 1 | `149.50.0.0/16` |
| China Telecom (AS138169) | 3 | 0.0% | 1 | 1 | `171.111.0.0/16` |
| Unidentified | 3 | 0.0% | 2 | 2 | `172.18.0.0/16`, `unknown` |
| Cox Communications Inc. (AS22773) | 3 | 0.0% | 2 | 3 | `90.96.0.0/16`, `184.181.0.0/16` |
| Internet Resources Management SRL (AS48955) | 3 | 0.0% | 1 | 2 | `188.214.0.0/16` |
| GSL Networks Pty LTD (AS137409) | 3 | 0.0% | 2 | 3 | `203.25.0.0/16`, `217.145.0.0/16` |
| Comcast Cable Communications, LLC (AS7922) | 3 | 0.0% | 2 | 2 | `48.46.0.0/16`, `48.45.0.0/16` |
| INEA sp. z o.o. (AS13110) | 3 | 0.0% | 1 | 1 | `77.65.0.0/16` |
| Server Galactic Private Limited (AS150423) | 3 | 0.0% | 2 | 3 | `82.108.0.0/16`, `87.82.0.0/16` |
| Turk Telekom (AS9121) | 3 | 0.0% | 1 | 1 | `95.3.0.0/16` |
| Varendra IT (AS151391) | 2 | 0.0% | 1 | 1 | `103.150.0.0/16` |
| Getechbrothers, MB (AS202044) | 2 | 0.0% | 1 | 1 | `104.233.0.0/16` |
| Latitude.sh LTDA (AS262287) | 2 | 0.0% | 1 | 2 | `104.252.0.0/16` |
| Shenzhen Tencent Computer Systems Company Limited (AS45090) | 2 | 0.0% | 2 | 2 | `119.91.0.0/16`, `49.233.0.0/16` |
| Datacamp Limited (AS60068) | 2 | 0.0% | 1 | 1 | `138.199.0.0/16` |
| Comcast Cable Communications, LLC (AS33659) | 2 | 0.0% | 2 | 2 | `138.226.0.0/16`, `170.100.0.0/16` |
| Connect Northwest Internet Services, LLC (AS10557) | 2 | 0.0% | 1 | 1 | `142.252.0.0/16` |
| Cogent Communications, LLC (AS174) | 2 | 0.0% | 2 | 2 | `149.100.0.0/16`, `38.132.0.0/16` |
| Proton AG (AS208172) | 2 | 0.0% | 1 | 1 | `159.26.0.0/16` |
| BL Networks (AS399629) | 2 | 0.0% | 2 | 2 | `168.100.0.0/16`, `206.188.0.0/16` |
| Uniti Fiber Holdings Inc. (AS13760) | 2 | 0.0% | 1 | 1 | `170.249.0.0/16` |
| True Online (AS17552) | 2 | 0.0% | 1 | 1 | `171.96.0.0/16` |
| Tier.Net Technologies LLC (AS397423) | 2 | 0.0% | 2 | 2 | `173.0.0.0/16`, `198.37.0.0/16` |
| Charter Communications Inc (AS11426) | 2 | 0.0% | 2 | 2 | `175.29.0.0/16`, `94.103.0.0/16` |
| EVEO S.A. (AS53107) | 2 | 0.0% | 1 | 1 | `177.136.0.0/16` |
| Space Exploration Technologies Corporation (AS14593) | 2 | 0.0% | 1 | 1 | `179.65.0.0/16` |
| SERVICIOS DE TELECOMUNICACIONES SETEL S.A. (XTRIM EC) (AS14522) | 2 | 0.0% | 1 | 1 | `186.66.0.0/16` |
| B2 Net Solutions Inc. (AS55286) | 2 | 0.0% | 2 | 2 | `192.198.0.0/16`, `209.127.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS39486) | 2 | 0.0% | 2 | 2 | `193.42.0.0/16`, `194.116.0.0/16` |
| Psychz Networks (AS40676) | 2 | 0.0% | 1 | 1 | `205.236.0.0/16` |
| Link3 Technologies Ltd. (AS23688) | 2 | 0.0% | 1 | 1 | `27.147.0.0/16` |
| HostRoyale Technologies Pvt Ltd (AS204287) | 2 | 0.0% | 1 | 1 | `45.41.0.0/16` |
| Netlen Internet Hizmetleri Ltd. Sti. (AS44620) | 2 | 0.0% | 1 | 1 | `45.74.0.0/16` |
| Verizon Business (AS701) | 2 | 0.0% | 1 | 1 | `65.206.0.0/16` |
| CariNet, Inc. (AS10439) | 2 | 0.0% | 1 | 1 | `71.6.0.0/16` |
| Cablevision Lightpath LLC (AS54004) | 2 | 0.0% | 1 | 2 | `74.48.0.0/16` |
| kabelplus GmbH (AS8339) | 2 | 0.0% | 1 | 1 | `81.217.0.0/16` |
| LeaseWeb Netherlands B.V. (AS60781) | 2 | 0.0% | 1 | 1 | `82.192.0.0/16` |
| Wave Broadband (AS11404) | 2 | 0.0% | 1 | 1 | `82.22.0.0/16` |
| IONOS SE (AS8560) | 2 | 0.0% | 1 | 1 | `82.223.0.0/16` |
| Glesys Sweden AB (AS42708) | 2 | 0.0% | 1 | 1 | `85.203.0.0/16` |
| Virtual Systems LLC (AS6698) | 2 | 0.0% | 1 | 1 | `91.218.0.0/16` |
| Microsoft Azure | 1 | 0.0% | 1 | 1 | `10.234.0.0/16` |
| PT Remala Abadi (AS38511) | 1 | 0.0% | 1 | 1 | `101.255.0.0/16` |
| VPS Dedicated LLC (AS197769) | 1 | 0.0% | 1 | 1 | `102.220.0.0/16` |
| Leaseweb USA, Inc. (AS27411) | 1 | 0.0% | 1 | 1 | `142.111.0.0/16` |
| IT7 Networks Inc (AS25820) | 1 | 0.0% | 1 | 1 | `144.34.0.0/16` |
| RouterHosting LLC (AS14956) | 1 | 0.0% | 1 | 1 | `153.75.0.0/16` |
| Contabo GmbH (AS51167) | 1 | 0.0% | 1 | 1 | `157.173.0.0/16` |
| ColoUp (AS19084) | 1 | 0.0% | 1 | 1 | `162.245.0.0/16` |
| HK Broadband Network Ltd. (AS10103) | 1 | 0.0% | 1 | 1 | `165.84.0.0/16` |
| Code200, UAB (AS149428) | 1 | 0.0% | 1 | 1 | `172.102.0.0/16` |
| SYN LTD (AS50077) | 1 | 0.0% | 1 | 1 | `185.135.0.0/16` |
| Tarin General Trading and Setting Up Internet Device LTD (AS197882) | 1 | 0.0% | 1 | 1 | `185.184.0.0/16` |
| Bamboozle Web Services MEA FZ-LLC (AS200851) | 1 | 0.0% | 1 | 1 | `185.243.0.0/16` |
| UAB code200 (AS203061) | 1 | 0.0% | 1 | 1 | `189.81.0.0/16` |
| networksdelmanana.com (AS52485) | 1 | 0.0% | 1 | 1 | `190.123.0.0/16` |
| Performive LLC (AS46562) | 1 | 0.0% | 1 | 1 | `192.252.0.0/16` |
| Cyberzone S.A. (AS209854) | 1 | 0.0% | 1 | 1 | `193.56.0.0/16` |
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
| Hurricane Electric LLC (AS6939) | 1 | 0.0% | 1 | 1 | `74.82.0.0/16` |
| AT&T Enterprises, LLC (AS7018) | 1 | 0.0% | 1 | 1 | `76.200.0.0/16` |
| O.m.c. Computers & Communications Ltd (AS44709) | 1 | 0.0% | 1 | 1 | `79.108.0.0/16` |
| EN Technologies Pte Ltd (AS133210) | 1 | 0.0% | 1 | 1 | `82.21.0.0/16` |
| Rogers Communications Canada Inc. (AS812) | 1 | 0.0% | 1 | 1 | `82.23.0.0/16` |
| HGC Global Communications Limited (AS9304) | 1 | 0.0% | 1 | 1 | `82.26.0.0/16` |
| AltusHost B.V. (AS51430) | 1 | 0.0% | 1 | 1 | `82.27.0.0/16` |
| WebWorld (AS30900) | 1 | 0.0% | 1 | 1 | `82.29.0.0/16` |
| UAB Bite Lietuva (AS210906) | 1 | 0.0% | 1 | 1 | `86.38.0.0/16` |
| Leaseweb USA, Inc. (AS19148) | 1 | 0.0% | 1 | 1 | `89.249.0.0/16` |

## Non-bot fingerprints (top 15 by hits)

Same user-agent hash across many ranges usually means one operator or toolkit.

| User agent | Hits | IPs | /16s | Owners | Mode | Requests |
| --- | ---: | ---: | ---: | --- | --- | --- |
| `Chrome 49 / Windows NT 6.1` | 6,521 | 61 | 7 | AGOTOZ PTE. LTD. (AS9465), CHINANET Guangdong province netwo | direct fetch | favicon.ico |
| `Chrome 131 / Windows NT 10` | 1,690 | 14 | 13 | Akamai Connected Cloud (AS63949), Alibaba (US) Technology Co | direct fetch | env / secrets, config / framework dirs |
| `Chrome 114 / Android 12` | 926 | 5 | 5 | Google LLC (AS396982) | direct fetch | support, pricing, marketplace |
| `Chrome 147 / Windows NT 10` | 794 | 22 | 9 | Alibaba (US) Technology Co., Ltd. (AS45102), FiberPower LLC  | link-follower | api, favicon.ico |
| `Chrome 131 / Macintosh` | 776 | 8 | 7 | Google LLC (AS396982), M247 Europe SRL (AS9009), Techoff Srv | direct fetch | env / secrets, config / framework dirs |
| `Chrome 131 / Linux` | 747 | 4 | 4 | Amazon.com, Inc. (AS16509), Google LLC (AS396982), Techoff S | direct fetch | env / secrets, config / framework dirs |
| `facebookexternalhit/1.1 (+http://www.facebook.com/` | 532 | 154 | 3 | Facebook, Inc. (AS32934) | direct fetch | robots.txt |
| `Mozilla/5.0 (compatible; XML Sitemaps Generator; w` | 505 | 2 | 1 | Team Blue Carrier Limited (AS34282) | link-follower | careers, marketplace, help-centre |
| `Chrome 157 / Windows NT 10` | 392 | 8 | 4 | Leaseweb Canada Inc. (AS32613), Nexeon Technologies, Inc. (A | link-follower | help-centre, webinars, company |
| `Chrome 133 / Linux` | 385 | 1 | 1 | Techoff Srv Limited (AS48090) | direct fetch | config / framework dirs, env / secrets |
| `Chrome 120 / Windows NT 10` | 369 | 18 | 18 | Amazon.com, Inc. (AS14618), Evoxt Sdn. Bhd. (AS149440), Goog | direct fetch | wordpress, php shells / probes |
| `Chrome 133 / Windows NT 10` | 287 | 3 | 3 | Amazon.com, Inc. (AS14618), Tc Datacenter Limited (AS218785) | direct fetch | config / framework dirs, env / secrets |
| `Chrome 133 / Macintosh` | 270 | 2 | 2 | Tc Datacenter Limited (AS218785), Techoff Srv Limited (AS480 | direct fetch | config / framework dirs, env / secrets |
| `GitHub-Hookshot/3754261` | 233 | 101 | 2 | GitHub, Inc. (AS36459), Microsoft Corporation (AS8075) | direct fetch | webhooks |
| `Safari 13 / iPhone OS 13.2.3` | 224 | 171 | 32 | Shenzhen Tencent Computer Systems Company Limited (AS45090), | direct fetch | integrations, newsroom, help-centre |

## What the probes ask for

| Category | Requests |  |
| --- | ---: | --- |
| env / secrets | 587 | `████████████████████` |
| wordpress | 235 | `████████` |
| config / framework dirs | 229 | `████████` |
| php shells / probes | 155 | `█████` |
| version control / CI | 75 | `███` |
| backups / db dumps | 69 | `██` |
| actuator / swagger | 50 | `██` |

Most requested paths: `wp-includes` (79), `wp-content` (63), `actuator` (50), `.git` (48), `.env` (45), `config` (40), `app` (38), `wp-admin` (27), `wp-login.php` (25), `.env.production` (23), `core` (23), `.env.backup` (22)

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
