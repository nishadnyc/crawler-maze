# Crawler trap traffic report

_Built from 571 log files. Window: 2026-11-22 03:45 to 2026-11-23 10:54 UTC (31.2 h)._

| Metric | Value |
| --- | ---: |
| Logged hits | 108,864 |
| Bot-labelled hits | 92,501 (85.0%) |
| Distinct IPs | 1,481 |
| /16 ranges | 469 |
| Hostnames seen | 248 |
| Ban entries | 479 |
| Requests logged during bans | 152,137 |
| Form submissions (honeypot) | 2 |

## Traffic mix

| Source | Hits | Share |  |
| --- | ---: | ---: | --- |
| ClaudeBot | 49,173 | 45.2% | `████████████████████` |
| OAI-SearchBot | 40,060 | 36.8% | `████████████████` |
| non-bot user agents | 16,363 | 15.0% | `███████` |
| GPTBot | 3,258 | 3.0% | `█` |
| Claude-User | 9 | 0.0% | `█` |
| ChatGPT-User | 1 | 0.0% | `█` |

## Daily totals (3 of 3 days)

Day = the date in the log filename (server-local day), newest first.

| Day | Hits | ClaudeBot | OAI-SearchBot | GPTBot | other bots | non-bot | IPs | During bans |
| --- | ---: | ---: | ---: | ---: | ---: | ---: | ---: | ---: |
| 2026-11-23 | 21,132 | 7,576 | 11,312 | 937 | 0 | 1,307 | 599 | 37,201 |
| 2026-11-22 | 86,226 | 41,191 | 28,355 | 2,282 | 10 | 14,388 | 1,189 | 106,354 |
| 2026-11-21 | 1,506 | 406 | 393 | 39 | 0 | 668 | 322 | 8,582 |

## Named crawlers

### ClaudeBot

- **Owner:** Anthropic
- **Hits:** 49,173 (45.2%) from 1 IP(s) in 1 /16 range(s)
- **/24 ranges (IPs):** `216.73.216.0/24` (1)
- **Vendor range check:** all 1 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 7,148 (14.5%); sitemap.xml: 5,924
- **Requests per IP:** 49,173.0 average
- **Bans:** 11; 2,161 further requests logged while banned
- **Top sections:** tutorials 7,507, robots.txt 7,148, developers 6,238, sitemap.xml 5,924, docs 4,476, api 2,750
- **User agent:** `Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; ClaudeBot/1.0; +claudebot@anthropic.com)`

### OAI-SearchBot

- **Owner:** OpenAI (Microsoft Azure)
- **Hits:** 40,060 (36.8%) from 257 IP(s) in 2 /16 range(s)
- **/24 ranges (IPs):** `74.7.230.0/24` (52), `74.7.244.0/24` (52), `74.7.228.0/24` (51), `74.7.241.0/24` (51), `74.7.175.0/24` (50), `51.8.102.0/24` (1)
- **Vendor range check:** all 257 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 0.0% followed maze links, 100.0% direct fetches
- **robots.txt requests:** 40,060 (100.0%); sitemap.xml: 0
- **Requests per IP:** 155.9 average
- **Bans:** 610; 3,104 further requests logged while banned
- **Top sections:** robots.txt 40,060
- **User agent:** `Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36; c`

### GPTBot

- **Owner:** OpenAI (Microsoft Azure)
- **Hits:** 3,258 (3.0%) from 242 IP(s) in 3 /16 range(s)
- **/24 ranges (IPs):** `74.7.227.0/24` (90), `74.7.241.0/24` (43), `74.7.242.0/24` (41), `74.7.243.0/24` (37), `132.196.86.0/24` (18), `172.182.207.0/24` (8), `172.182.202.0/24` (5)
- **Vendor range check:** all 242 IPs are inside the vendor's published ranges
- **Link-follow vs direct:** 99.1% followed maze links, 0.9% direct fetches
- **robots.txt requests:** 0 (0.0%); sitemap.xml: 27
- **Requests per IP:** 13.5 average
- **Bans:** 141; 146,643 further requests logged while banned
- **Top sections:** comparison 114, platform 108, support 108, services 105, marketplace 103, resources 103
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
| Anthropic | 49,182 | 45.2% | 2 | 5 | `216.73.0.0/16`, `160.79.0.0/16` |
| OpenAI (Microsoft Azure) | 43,319 | 39.8% | 5 | 500 | `74.7.0.0/16`, `132.196.0.0/16`, `172.182.0.0/16`, `20.125.0.0/16` |
| China-region cloud (guess) | 6,593 | 6.1% | 9 | 23 | `152.32.0.0/16`, `156.225.0.0/16`, `154.51.0.0/16`, `106.75.0.0/16` |
| Unidentified | 3,925 | 3.6% | 205 | 510 | `195.178.0.0/16`, `85.92.0.0/16`, `216.167.0.0/16`, `87.81.0.0/16` |
| Google Cloud | 3,534 | 3.2% | 30 | 38 | `34.96.0.0/16`, `34.154.0.0/16`, `34.21.0.0/16`, `34.83.0.0/16` |
| AWS | 604 | 0.6% | 128 | 157 | `18.217.0.0/16`, `3.238.0.0/16`, `32.197.0.0/16`, `44.204.0.0/16` |
| Meta | 384 | 0.4% | 3 | 85 | `173.252.0.0/16`, `57.141.0.0/16`, `69.171.0.0/16` |
| Microsoft Azure | 361 | 0.3% | 7 | 7 | `20.219.0.0/16`, `20.214.0.0/16`, `20.28.0.0/16`, `9.234.0.0/16` |
| Tencent Cloud | 296 | 0.3% | 32 | 82 | `43.106.0.0/16`, `43.157.0.0/16`, `43.165.0.0/16`, `43.166.0.0/16` |
| GitHub | 209 | 0.2% | 1 | 11 | `140.82.0.0/16` |
| ColoCrossing (budget VPS) | 203 | 0.2% | 5 | 6 | `23.94.0.0/16`, `23.95.0.0/16`, `107.172.0.0/16`, `107.174.0.0/16` |
| DigitalOcean | 79 | 0.1% | 14 | 19 | `143.198.0.0/16`, `178.128.0.0/16`, `146.190.0.0/16`, `137.184.0.0/16` |
| Alibaba Cloud | 64 | 0.1% | 7 | 9 | `8.218.0.0/16`, `47.84.0.0/16`, `47.236.0.0/16`, `47.108.0.0/16` |
| Akamai/Linode | 44 | 0.0% | 9 | 12 | `96.126.0.0/16`, `172.236.0.0/16`, `45.79.0.0/16`, `172.104.0.0/16` |
| M247 (VPN/proxy hosting) | 30 | 0.0% | 2 | 5 | `146.70.0.0/16`, `31.209.0.0/16` |
| Oracle Cloud | 20 | 0.0% | 2 | 2 | `141.148.0.0/16`, `129.213.0.0/16` |
| Hetzner | 9 | 0.0% | 5 | 5 | `116.202.0.0/16`, `159.69.0.0/16`, `162.55.0.0/16`, `168.119.0.0/16` |
| Scanner-hosting ISPs | 8 | 0.0% | 3 | 5 | `94.102.0.0/16`, `89.248.0.0/16`, `93.174.0.0/16` |

## Non-bot fingerprints (top 15 by hits)

Same user-agent hash across many ranges usually means one operator or toolkit.

| User agent | Hits | IPs | /16s | Owners | Mode | Requests |
| --- | ---: | ---: | ---: | --- | --- | --- |
| `Chrome 49 / Windows NT 6.1` | 6,521 | 61 | 7 | China-region cloud (guess) | direct fetch | favicon.ico |
| `Chrome 131 / Windows NT 10` | 1,393 | 10 | 10 | AWS, DigitalOcean, Google Cloud, Unidentified | direct fetch | env / secrets, config / framework dirs |
| `Chrome 114 / Android 12` | 926 | 5 | 5 | Google Cloud, Unidentified | direct fetch | support, pricing, marketplace |
| `Chrome 147 / Windows NT 10` | 794 | 22 | 9 | Alibaba Cloud, China-region cloud (guess), Unidentified | link-follower | api, favicon.ico |
| `Chrome 131 / Macintosh` | 755 | 5 | 5 | Google Cloud | direct fetch | env / secrets, config / framework dirs |
| `Chrome 131 / Linux` | 722 | 3 | 3 | AWS, Google Cloud | direct fetch | env / secrets, config / framework dirs |
| `Mozilla/5.0 (compatible; XML Sitemaps Generator; w` | 505 | 2 | 1 | Unidentified | link-follower | careers, marketplace, help-centre |
| `Chrome 157 / Windows NT 10` | 392 | 8 | 4 | ColoCrossing (budget VPS), Unidentified | link-follower | help-centre, webinars, company |
| `Chrome 133 / Linux` | 385 | 1 | 1 | Unidentified | direct fetch | config / framework dirs, env / secrets |
| `Chrome 120 / Windows NT 10` | 367 | 18 | 18 | AWS, Akamai/Linode, Google Cloud, Microsoft Azure, Unidentif | direct fetch | wordpress, php shells / probes |
| `facebookexternalhit/1.1 (+http://www.facebook.com/` | 329 | 143 | 3 | Meta, Unidentified | direct fetch | robots.txt |
| `Chrome 133 / Windows NT 10` | 287 | 3 | 3 | AWS, Unidentified | direct fetch | config / framework dirs, env / secrets |
| `Chrome 133 / Macintosh` | 269 | 2 | 2 | Unidentified | direct fetch | config / framework dirs, env / secrets |
| `GitHub-Hookshot/3754261` | 224 | 97 | 2 | GitHub, Microsoft Azure | direct fetch | webhooks |
| `Safari 13 / iPhone OS 13.2.3` | 204 | 160 | 31 | Tencent Cloud, Unidentified | direct fetch | newsroom, integrations, tutorials |

## What the probes ask for

| Category | Requests |  |
| --- | ---: | --- |
| env / secrets | 507 | `████████████████████` |
| config / framework dirs | 212 | `████████` |
| wordpress | 208 | `████████` |
| php shells / probes | 142 | `██████` |
| version control / CI | 64 | `███` |
| backups / db dumps | 57 | `██` |
| actuator / swagger | 48 | `██` |

Most requested paths: `wp-content` (63), `wp-includes` (63), `actuator` (48), `.git` (39), `.env` (39), `config` (39), `app` (37), `wp-login.php` (26), `wp-admin` (25), `.env.production` (20), `core` (20), `.env.txt` (19)

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
