# Crawler trap traffic report

_Built from 459 log files. Window: 2026-11-22 03:45 to 2026-11-23 03:12 UTC (23.5 h)._

| Metric | Value |
| --- | ---: |
| Logged hits | 82,605 |
| Bot-labelled hits | 67,787 (82.1%) |
| Distinct IPs | 1,272 |
| /16 ranges | 434 |
| Hostnames seen | 228 |
| Ban entries | 309 |
| Requests logged during bans | 102,352 |
| Form submissions (honeypot) | 2 |

## Traffic mix

| Source | Hits | Share |  |
| --- | ---: | ---: | --- |
| ClaudeBot | 38,758 | 46.9% | `████████████████████` |
| OAI-SearchBot | 26,868 | 32.5% | `██████████████` |
| non-bot user agents | 14,818 | 17.9% | `████████` |
| GPTBot | 2,151 | 2.6% | `█` |
| Claude-User | 9 | 0.0% | `█` |
| ChatGPT-User | 1 | 0.0% | `█` |

## Named crawlers

### ClaudeBot

- **Owner:** Anthropic
- **Hits:** 38,758 (46.9%) from 1 IP(s) in 1 /16 range(s)
- **/24 ranges (IPs):** `216.73.216.0/24` (1)
- **Vendor range check:** all 1 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 5,228 (13.5%); sitemap.xml: 4,098
- **Requests per IP:** 38,758.0 average
- **Bans:** 11; 2,161 further requests logged while banned
- **Top sections:** tutorials 5,905, robots.txt 5,228, developers 5,208, sitemap.xml 4,098, docs 3,577, api 2,750
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; ClaudeBot/1.0; +claudebot@anthropic.com)`

### OAI-SearchBot

- **Owner:** OpenAI (Microsoft Azure)
- **Hits:** 26,868 (32.5%) from 257 IP(s) in 2 /16 range(s)
- **/24 ranges (IPs):** `74.7.230.0/24` (52), `74.7.244.0/24` (52), `74.7.228.0/24` (51), `74.7.241.0/24` (51), `74.7.175.0/24` (50), `51.8.102.0/24` (1)
- **Vendor range check:** all 257 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 26,868 (100.0%); sitemap.xml: 0
- **Requests per IP:** 104.5 average
- **Bans:** 414; 1,924 further requests logged while banned
- **Top sections:** robots.txt 26,868
- **User agent:** `Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36; c`

### GPTBot

- **Owner:** OpenAI (Microsoft Azure)
- **Hits:** 2,151 (2.6%) from 176 IP(s) in 3 /16 range(s)
- **/24 ranges (IPs):** `74.7.227.0/24` (66), `74.7.242.0/24` (31), `74.7.241.0/24` (30), `74.7.243.0/24` (26), `132.196.86.0/24` (11), `172.182.207.0/24` (7), `172.182.202.0/24` (5)
- **Vendor range check:** all 176 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 99.3% followed maze links, 0.7% direct fetches
- **robots.txt requests:** 0 (0.0%); sitemap.xml: 13
- **Requests per IP:** 12.2 average
- **Bans:** 94; 98,038 further requests logged while banned
- **Top sections:** marketplace 71, newsroom 71, services 70, comparison 70, features 69, developers 68
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.4; +https://openai.com/gptbot)`

### Claude-User

- **Owner:** Anthropic
- **Hits:** 9 (0.0%) from 4 IP(s) in 1 /16 range(s)
- **/24 ranges (IPs):** `160.79.106.0/24` (4)
- **Vendor range check:** 0/4 IPs inside published ranges; **not listed:** `160.79.106.128`, `160.79.106.137`, `160.79.106.138`, `160.79.106.139`
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 4 (44.4%); sitemap.xml: 0
- **Requests per IP:** 2.2 average
- **Top sections:** robots.txt 4
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; Claude-User/1.0; +claude-user@anthropic.com)`

### ChatGPT-User

- **Owner:** OpenAI (Microsoft Azure)
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
| Anthropic | 38,767 | 46.9% | 2 | 5 | `216.73.0.0/16`, `160.79.0.0/16` |
| OpenAI (Microsoft Azure) | 29,020 | 35.1% | 5 | 434 | `74.7.0.0/16`, `132.196.0.0/16`, `172.182.0.0/16`, `20.125.0.0/16` |
| China-region cloud (guess) | 6,581 | 8.0% | 9 | 23 | `152.32.0.0/16`, `156.225.0.0/16`, `154.51.0.0/16`, `106.75.0.0/16` |
| Google Cloud | 3,293 | 4.0% | 26 | 28 | `34.96.0.0/16`, `34.154.0.0/16`, `34.21.0.0/16`, `35.230.0.0/16` |
| Unidentified | 3,116 | 3.8% | 183 | 471 | `195.178.0.0/16`, `85.92.0.0/16`, `216.167.0.0/16`, `87.81.0.0/16` |
| AWS | 580 | 0.7% | 126 | 151 | `18.217.0.0/16`, `3.238.0.0/16`, `32.197.0.0/16`, `3.235.0.0/16` |
| Meta | 262 | 0.3% | 3 | 36 | `173.252.0.0/16`, `57.141.0.0/16`, `69.171.0.0/16` |
| Microsoft Azure | 221 | 0.3% | 7 | 7 | `20.219.0.0/16`, `20.214.0.0/16`, `20.28.0.0/16`, `9.234.0.0/16` |
| GitHub | 205 | 0.2% | 1 | 16 | `140.82.0.0/16` |
| ColoCrossing (budget VPS) | 203 | 0.2% | 5 | 6 | `23.94.0.0/16`, `23.95.0.0/16`, `107.172.0.0/16`, `107.174.0.0/16` |
| Tencent Cloud | 167 | 0.2% | 29 | 48 | `43.157.0.0/16`, `43.106.0.0/16`, `43.165.0.0/16`, `43.166.0.0/16` |
| DigitalOcean | 58 | 0.1% | 14 | 17 | `143.198.0.0/16`, `137.184.0.0/16`, `178.128.0.0/16`, `146.190.0.0/16` |
| Alibaba Cloud | 42 | 0.1% | 5 | 5 | `8.218.0.0/16`, `47.108.0.0/16`, `47.96.0.0/16`, `47.254.0.0/16` |
| Akamai/Linode | 34 | 0.0% | 9 | 11 | `96.126.0.0/16`, `172.236.0.0/16`, `172.104.0.0/16`, `45.79.0.0/16` |
| M247 (VPN/proxy hosting) | 27 | 0.0% | 2 | 4 | `146.70.0.0/16`, `31.209.0.0/16` |
| Oracle Cloud | 18 | 0.0% | 2 | 2 | `141.148.0.0/16`, `129.213.0.0/16` |
| Hetzner | 7 | 0.0% | 4 | 4 | `116.202.0.0/16`, `159.69.0.0/16`, `168.119.0.0/16`, `188.245.0.0/16` |
| Scanner-hosting ISPs | 4 | 0.0% | 2 | 4 | `89.248.0.0/16`, `93.174.0.0/16` |

## Non-bot fingerprints (top 15 by hits)

Same user-agent hash across many ranges usually means one operator or toolkit.

| User agent | Hits | IPs | /16s | Owners | Mode | Requests |
| --- | ---: | ---: | ---: | --- | --- | --- |
| `Chrome 49 / Windows NT 6.1` | 6,509 | 61 | 7 | China-region cloud (guess) | direct fetch | favicon.ico |
| `Chrome 131 / Windows NT 10` | 1,387 | 10 | 10 | AWS, DigitalOcean, Google Cloud, Unidentified | direct fetch | env / secrets, config / framework dirs |
| `Chrome 147 / Windows NT 10` | 794 | 22 | 9 | Alibaba Cloud, China-region cloud (guess), Unidentified | link-follower | api, favicon.ico |
| `Chrome 131 / Macintosh` | 755 | 5 | 5 | Google Cloud | direct fetch | env / secrets, config / framework dirs |
| `Chrome 131 / Linux` | 722 | 3 | 3 | AWS, Google Cloud | direct fetch | env / secrets, config / framework dirs |
| `Chrome 114 / Android 12` | 546 | 3 | 3 | Google Cloud, Unidentified | direct fetch | calculator, marketplace, pricing |
| `Mozilla/5.0 (compatible; XML Sitemaps Generator; w` | 505 | 2 | 1 | Unidentified | link-follower | careers, marketplace, help-centre |
| `Chrome 157 / Windows NT 10` | 392 | 8 | 4 | ColoCrossing (budget VPS), Unidentified | link-follower | help-centre, webinars, company |
| `GitHub-Hookshot/3754261` | 220 | 97 | 2 | GitHub, Microsoft Azure | direct fetch | webhooks |
| `Chrome 120 / Windows NT 10` | 220 | 17 | 17 | AWS, Akamai/Linode, Microsoft Azure, Unidentified | direct fetch | wordpress, php shells / probes |
| `Chrome 133 / Linux` | 207 | 2 | 2 | Unidentified | direct fetch | version control / CI, config / framework dirs |
| `facebookexternalhit/1.1 (+http://www.facebook.com/` | 202 | 76 | 2 | Meta | direct fetch | robots.txt |
| `Chrome 133 / Windows NT 10` | 171 | 3 | 3 | AWS, Unidentified | direct fetch | config / framework dirs, env / secrets |
| `Chrome 151 / Linux` | 162 | 75 | 59 | AWS, Unidentified | direct fetch | favicon.ico |
| `Chrome 133 / Macintosh` | 162 | 2 | 2 | Unidentified | direct fetch | config / framework dirs, env / secrets |

## What the probes ask for

| Category | Requests |  |
| --- | ---: | --- |
| env / secrets | 462 | `████████████████████` |
| config / framework dirs | 164 | `███████` |
| wordpress | 137 | `██████` |
| php shells / probes | 80 | `███` |
| version control / CI | 70 | `███` |
| backups / db dumps | 44 | `██` |
| actuator / swagger | 30 | `█` |

Most requested paths: `wp-includes` (47), `.git` (34), `.env` (33), `wp-content` (33), `actuator` (30), `app` (28), `config` (27), `wp-login.php` (21), `core` (20), `.env.production` (17), `.env.txt` (17), `wp-admin` (17)

## Honeypot form submissions

| Group | Submissions | Ranges |
| --- | ---: | --- |
| `ua:b8dd7635412b` | 1 | `87.81.0.0/16` |
| `ua:7ba3360bfef8` | 1 | `87.81.0.0/16` |

## Notes

- Totals use each group's own hit counter; per-IP counters in the logs are rolling-window values and undercount heavy hitters.
- Owner names come from a built-in prefix table (`OWNERS_2` in `scripts/generator.py`), not live WHOIS. Pass `--asn-db` for real ASN data.
- Bot IPs were checked against the vendors' published range files. Bots without a file are unchecked.
- User agents can be spoofed; vendor tokens are only trustworthy when the IP range matches the vendor.
