[![Docker build & smoke test](https://github.com/nishadnyc/crawler-maze/actions/workflows/docker.yml/badge.svg)](https://github.com/nishadnyc/crawler-maze/actions/workflows/docker.yml)
[![GitHub Pages](https://img.shields.io/badge/GitHub%20Pages-live-brightgreen)](https://nishadnyc.github.io/crawler-maze/)
[![Docker](https://img.shields.io/badge/Docker-supported-2496ED?logo=docker&logoColor=white)](https://github.com/nishadnyc/crawler-maze/blob/main/DOCKER.md)
[![Open Source](https://img.shields.io/badge/Open%20Source-MIT-green?logo=opensourceinitiative&logoColor=white)](https://github.com/nishadnyc/crawler-maze/blob/main/LICENSE)

<!-- STATS:START -->
## One day in the maze

*What the logs say · Sunday, November 22, 2026 · counted from the maze's own logs.*

**63,529** crawler hits served · **1,464** unique IPs · **318** subnet log files

| Crawler | Requests | IPs | What it was after |
| --- | ---: | --- | --- |
| ClaudeBot | 32,189 | `216.73.216.60` | Tutorials, Developer pages, robots.txt |
| GPTBot | 1,514 | `74.7.0.0/16`, `132.196.0.0/16`, `172.182.0.0/16` | Newsroom, Marketplace, Platform |
| OAI-SearchBot | 18,912 | `51.8.0.0/16`, `74.7.0.0/16` | robots.txt |
| facebookexternalhit | 202 | `69.171.0.0/16`, `173.252.0.0/16` | robots.txt |
| Fake old-Chrome scanner fleet | 4,114 | `45.249.0.0/16`, `103.218.0.0/16`, `106.75.0.0/16`, `123.58.0.0/16`, `152.32.0.0/16`, `154.51.0.0/16`, `156.225.0.0/16` | favicon.ico |
| Credential hunters | 3,342 | `20.28.0.0/16`, `20.219.0.0/16`, `34.21.0.0/16`, `34.47.0.0/16`, `34.92.0.0/16`, `34.96.0.0/16`, `34.154.0.0/16`, `35.189.0.0/16`, `45.138.0.0/16`, `45.148.0.0/16`, `45.156.0.0/16`, `81.171.0.0/16`, `85.11.0.0/16`, `87.81.0.0/16`, `91.148.0.0/16`, `94.26.0.0/16`, `96.126.0.0/16`, `103.150.0.0/16`, `104.29.0.0/16`, `129.213.0.0/16`, `153.75.0.0/16`, `165.232.0.0/16`, `195.178.0.0/16`, `203.25.0.0/16` | Probing for /.env, firebase keys and similar files that don't exist here |
| API hammerer (fake Chrome 147) | 794 | `8.218.0.0/16`, `23.148.0.0/16`, `70.39.0.0/16`, `85.203.0.0/16`, `137.220.0.0/16`, `154.44.0.0/16`, `165.154.0.0/16`, `216.36.0.0/16`, `216.167.0.0/16` | API docs — 792 of its 794 hits went straight to /api, in two short bursts |
| XML Sitemaps Generator | 505 | `85.92.0.0/16` | Careers, Marketplace, Help centre |
| meta-webindexer | 60 | `57.141.0.0/16` | Pricing, Resources, Status |
| Claude-User | 9 | `160.79.0.0/16` | robots.txt |

**What they were looking for:** robots.txt **23,175** · Tutorials **4,890** · Developer pages **4,577** · API docs **3,590** · sitemap.xml **3,224** · Docs **3,066**

**Patterns:** GPTBot mostly bounced off bans — 63,296 banned hits against 1,513 served. OAI-SearchBot did the opposite of digging: every one of its 18,912 hits was a robots.txt check, swept through a single subnet range from 257 different IPs. And ClaudeBot's 31,943 hits came from exactly one IP, all day.

Honeypot login form: **0 submissions** — nobody took that bait.

*Every one of those hits was a page that doesn't exist, for a company that doesn't exist. They kept reading anyway.*
<!-- STATS:END -->

# Crawler Maze — a maze for AI crawlers

## The idea

The web is crawled constantly by AI bots — ClaudeBot, GPTBot and friends —
that fetch pages, store what they find, and follow links at enormous scale.
Most sites respond one of two ways: let the bots in, or try to keep them
out. This project does neither. **It feeds them.**

Any subdomain of a wildcard domain that has no real site answers with a
complete, plausible-looking hosting company: readable articles, plans and
pricing, documentation, FAQs, testimonials — the works. Every page links
onward to more pages and more subdomains. There is no last page. A crawler
that wanders in finds what looks like a gold mine and just keeps digging.

Each subdomain is one self-consistent fake company. Its identity is seeded
from the subdomain itself, so the same address always shows the same
company — same brand, same prices, same people. But the network as a whole
is infinite: every new subdomain is another company, another site to
crawl, and no crawler ever finishes.

The point is an experiment, built for fun: watch how crawlers behave when
the web fights back with fiction instead of walls — how deep they dig, how
long they stay, and what they swallow without ever stepping back to notice
the pattern. The heaviest crawlers are logged per subnet and eventually
rate-limited, and a hidden login form catches the bots that try to
sign up.

It's not a product. Nothing is sold, there are no real customers — just a
maze, and the bots are the visitors it was built for.

## What's in the repo

- `public_html/index.php` — the whole maze: one self-contained PHP file
  that generates every page, with a small `.htaccess` beside it that
  routes every path to it.
- Logs are written at runtime into a `logs/` folder beside the script —
  one file per subnet per day, recording who visited and what they did.
- This README lives next to `public_html/`, never inside it, so the maze
  itself is never web-served.
