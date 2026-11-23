# Crawler trap traffic report

_Built from 365 log files. Window: 2026-11-22 03:45 to 2026-11-23 01:49 UTC (22.1 h)._

| Metric | Value |
| --- | ---: |
| Logged hits | 74,800 |
| Bot-labelled hits | 61,547 (82.3%) |
| Distinct IPs | 1,166 |
| /16 ranges | 340 |
| Hostnames seen | 157 |
| Ban entries | 292 |
| Requests logged during bans | 92,778 |
| Form submissions (honeypot) | 2 |

## Traffic mix

| Source | Hits | Share |  |
| --- | ---: | ---: | --- |
| ClaudeBot | 36,588 | 48.9% | `████████████████████` |
| OAI-SearchBot | 23,074 | 30.8% | `█████████████` |
| non-bot user agents | 13,253 | 17.7% | `███████` |
| GPTBot | 1,875 | 2.5% | `█` |
| Claude-User | 9 | 0.0% | `█` |
| ChatGPT-User | 1 | 0.0% | `█` |

## Named crawlers

### ClaudeBot

- **Owner:** Anthropic
- **Hits:** 36,588 (48.9%) from 1 IP(s) in 1 /16 range(s)
- **/24 ranges (IPs):** `216.73.216.0/24` (1)
- **Vendor range check:** all 1 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 4,845 (13.2%); sitemap.xml: 3,764
- **Requests per IP:** 36,588.0 average
- **Bans:** 11; 2,161 further requests logged while banned
- **Top sections:** tutorials 5,570, developers 4,977, robots.txt 4,845, sitemap.xml 3,764, docs 3,388, api 2,750
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; ClaudeBot/1.0; +claudebot@anthropic.com)`

### OAI-SearchBot

- **Owner:** OpenAI (Microsoft Azure)
- **Hits:** 23,074 (30.8%) from 257 IP(s) in 2 /16 range(s)
- **/24 ranges (IPs):** `74.7.230.0/24` (52), `74.7.244.0/24` (52), `74.7.228.0/24` (51), `74.7.241.0/24` (51), `74.7.175.0/24` (50), `51.8.102.0/24` (1)
- **Vendor range check:** all 257 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 23,074 (100.0%); sitemap.xml: 0
- **Requests per IP:** 89.8 average
- **Bans:** 358; 1,700 further requests logged while banned
- **Top sections:** robots.txt 23,074
- **User agent:** `Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36; c`

### GPTBot

- **Owner:** OpenAI (Microsoft Azure)
- **Hits:** 1,875 (2.5%) from 174 IP(s) in 3 /16 range(s)
- **/24 ranges (IPs):** `74.7.227.0/24` (67), `74.7.242.0/24` (30), `74.7.243.0/24` (27), `74.7.241.0/24` (26), `132.196.86.0/24` (12), `172.182.202.0/24` (6), `172.182.207.0/24` (6)
- **Vendor range check:** all 174 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 99.3% followed maze links, 0.7% direct fetches
- **robots.txt requests:** 0 (0.0%); sitemap.xml: 12
- **Requests per IP:** 10.8 average
- **Bans:** 83; 88,688 further requests logged while banned
- **Top sections:** newsroom 64, marketplace 63, services 62, platform 60, features 60, comparison 59
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
| Anthropic | 36,597 | 48.9% | 2 | 5 | `216.73.0.0/16`, `160.79.0.0/16` |
| OpenAI (Microsoft Azure) | 24,950 | 33.4% | 5 | 432 | `74.7.0.0/16`, `132.196.0.0/16`, `172.182.0.0/16`, `20.125.0.0/16` |
| China-region cloud (guess) | 5,609 | 7.5% | 9 | 56 | `152.32.0.0/16`, `156.225.0.0/16`, `154.51.0.0/16`, `106.75.0.0/16` |
| Google Cloud | 3,197 | 4.3% | 24 | 26 | `34.96.0.0/16`, `34.154.0.0/16`, `34.21.0.0/16`, `35.230.0.0/16` |
| Unidentified | 2,774 | 3.7% | 124 | 378 | `195.178.0.0/16`, `85.92.0.0/16`, `216.167.0.0/16`, `87.81.0.0/16` |
| AWS | 453 | 0.6% | 93 | 109 | `18.217.0.0/16`, `44.200.0.0/16`, `3.238.0.0/16`, `35.175.0.0/16` |
| Meta | 262 | 0.4% | 3 | 36 | `173.252.0.0/16`, `57.141.0.0/16`, `69.171.0.0/16` |
| Microsoft Azure | 220 | 0.3% | 7 | 9 | `20.219.0.0/16`, `20.214.0.0/16`, `20.28.0.0/16`, `9.234.0.0/16` |
| GitHub | 204 | 0.3% | 1 | 15 | `140.82.0.0/16` |
| ColoCrossing (budget VPS) | 203 | 0.3% | 5 | 6 | `23.94.0.0/16`, `23.95.0.0/16`, `107.172.0.0/16`, `107.174.0.0/16` |
| Tencent Cloud | 147 | 0.2% | 29 | 47 | `43.157.0.0/16`, `43.165.0.0/16`, `43.166.0.0/16`, `43.106.0.0/16` |
| DigitalOcean | 58 | 0.1% | 14 | 17 | `143.198.0.0/16`, `137.184.0.0/16`, `178.128.0.0/16`, `146.190.0.0/16` |
| Alibaba Cloud | 42 | 0.1% | 5 | 5 | `8.218.0.0/16`, `47.108.0.0/16`, `47.96.0.0/16`, `47.254.0.0/16` |
| Akamai/Linode | 32 | 0.0% | 9 | 11 | `96.126.0.0/16`, `172.236.0.0/16`, `172.104.0.0/16`, `45.79.0.0/16` |
| M247 (VPN/proxy hosting) | 27 | 0.0% | 2 | 4 | `146.70.0.0/16`, `31.209.0.0/16` |
| Oracle Cloud | 14 | 0.0% | 2 | 2 | `141.148.0.0/16`, `129.213.0.0/16` |
| Hetzner | 7 | 0.0% | 4 | 4 | `116.202.0.0/16`, `159.69.0.0/16`, `168.119.0.0/16`, `188.245.0.0/16` |
| Scanner-hosting ISPs | 4 | 0.0% | 2 | 4 | `89.248.0.0/16`, `93.174.0.0/16` |

## Non-bot fingerprints (top 15 by hits)

Same user-agent hash across many ranges usually means one operator or toolkit.

| User agent | Hits | IPs | /16s | Owners | Mode | Requests |
| --- | ---: | ---: | ---: | --- | --- | --- |
| `Chrome 49 / Windows NT 6.1` | 5,537 | 61 | 7 | China-region cloud (guess) | direct fetch | favicon.ico |
| `Chrome 131 / Windows NT 10` | 1,387 | 10 | 10 | AWS, DigitalOcean, Google Cloud, Unidentified | direct fetch | env / secrets, config / framework dirs |
| `Chrome 147 / Windows NT 10` | 794 | 22 | 9 | Alibaba Cloud, China-region cloud (guess), Unidentified | link-follower | api, favicon.ico |
| `Chrome 131 / Macintosh` | 755 | 5 | 5 | Google Cloud | direct fetch | env / secrets, config / framework dirs |
| `Chrome 131 / Linux` | 722 | 3 | 3 | AWS, Google Cloud | direct fetch | env / secrets, config / framework dirs |
| `Mozilla/5.0 (compatible; XML Sitemaps Generator; w` | 505 | 2 | 1 | Unidentified | link-follower | careers, marketplace, help-centre |
| `Chrome 157 / Windows NT 10` | 392 | 8 | 4 | ColoCrossing (budget VPS), Unidentified | link-follower | help-centre, webinars, company |
| `Chrome 114 / Android 12` | 307 | 2 | 2 | Google Cloud, Unidentified | direct fetch | about, changelog, affiliates |
| `GitHub-Hookshot/3754261` | 218 | 97 | 2 | GitHub, Microsoft Azure | direct fetch | webhooks |
| `Chrome 120 / Windows NT 10` | 213 | 14 | 14 | AWS, Akamai/Linode, Microsoft Azure | direct fetch | wordpress, php shells / probes |
| `Chrome 133 / Linux` | 207 | 2 | 2 | Unidentified | direct fetch | version control / CI, config / framework dirs |
| `facebookexternalhit/1.1 (+http://www.facebook.com/` | 202 | 76 | 2 | Meta | direct fetch | robots.txt |
| `Chrome 133 / Windows NT 10` | 171 | 3 | 3 | AWS, Unidentified | direct fetch | config / framework dirs, env / secrets |
| `Chrome 133 / Macintosh` | 161 | 1 | 1 | Unidentified | direct fetch | config / framework dirs, env / secrets |
| `curl/8.5.0` | 154 | 65 | 2 | Unidentified | direct fetch | backups / db dumps, wordpress |

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
