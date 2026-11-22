<?php
// COOKIE PROBE + GROUP TAG (2026-11-22, Nishad request): on a visitor's
// FIRST visit, give them a maze_visit cookie whose value carries their
// GROUP NAME - the agent key (bot:<name> for known crawlers, ua:<hash>
// otherwise) plus their /16 subnet - followed by a random token. Server
// stores nothing about the cookie. If the visitor later returns from a
// rotated IP but sends this cookie back, the group name inside it gives
// away which group they really belong to.
// (IP/UA/subnet/agent are computed again in SECTION 4 for the main flow;
// this early copy exists only so the cookie can be set at the very top.)
$probeIp = trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '')[0]);
if ($probeIp === '') $probeIp = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$probeUa = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 200);
if (filter_var($probeIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) { $pp = explode('.', $probeIp); $probeSubnet = $pp[0] . '.' . $pp[1] . '.0.0/16'; }
elseif (filter_var($probeIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) { $pp = explode(':', $probeIp); $probeSubnet = implode(':', array_slice($pp, 0, 3)) . '::/48'; }
else $probeSubnet = 'unknown';
$probeAgent = 'ua:' . substr(md5($probeUa), 0, 12);
foreach (['OAI-SearchBot','GPTBot','ChatGPT-User','ClaudeBot','Claude-User','anthropic-ai','Googlebot','Google-Extended','bingbot','PerplexityBot','CCBot','Bytespider','Applebot','Meta-ExternalAgent','Amazonbot','cohere-ai','Diffbot','ImagesiftBot','Omgilibot','FacebookBot','Twitterbot','LinkedInBot','SemrushBot','AhrefsBot','MJ12bot','DotBot','PetalBot','DataForSeoBot','Barkrowler','l9scan','LeakIX'] as $kb) { if (stripos($probeUa, $kb) !== false) { $probeAgent = 'bot:' . $kb; break; } }
if (empty($_COOKIE['_vid']) && empty($_COOKIE['maze_visit'])) {
    // The group IS the first-seen subnet - no bot name in the cookie:
    // names are unreliable, the first-seen group is the identity.
    // COOKIE RENAME (2026-11-22 cheap pass): maze_visit -> _vid. The old
    // name is still READ everywhere as a fallback so existing visitors
    // keep their group; only the new name is ever set.
    $groupTag = preg_replace('/[^A-Za-z0-9_.-]/', '_', $probeSubnet);
    setcookie('_vid', $groupTag . '__' . bin2hex(random_bytes(8)), time() + 2592000, '/');
}
/*
 * ============================================================================
 *  MAZE - wildcard fake-site generator (single file, no dependencies)
 * ============================================================================
 *  Served by the Soltris "PHP Maze" server for ANY subdomain of nishad.top
 *  that has no real site (wildcard). Every request generates a brand-new,
 *  never-repeating fake hosting-company page so crawlers keep wandering
 *  from link to link instead of finding anything real.
 *
 *  Companion documentation: MAZE-README.md (in the server volume root,
 *  next to public_html/ - deliberately NOT web-served).
 *
 *  HOW A REQUEST FLOWS THROUGH THIS FILE
 *    1. Helper functions + content pools (brands, topics, features, ...)
 *    2. Pool expansion - combinatorial mixing grows the pools to thousands
 *    3. Request context - scheme / host / path, visitor IP, subnet, agent
 *    4. Ban check - .maze-bans.json is checked first; banned = instant 429
 *    5. Daily per-subnet log - ONE read/modify/write of today's JSON file
 *       for the visitor's /16 subnet (counts, groups, honeypot posts)
 *    6. robots.txt / sitemap.xml - generated on the fly, same host only
 *    7. Page assembly - random brand/topic/links, JSON-LD, meta tags
 *    8. HTML template - the visible page + the hidden honeypot login form
 *
 *  MAINTENANCE RULES
 *    - PHP comments only in the HTML part too (wrapped in <?php /* * / ?>):
 *      HTML comments would be visible to crawlers in the page source.
 *    - Never add images or external assets - the page is text-only by design.
 *    - Anything that writes files must use flock(); many requests run at once.
 * ============================================================================
 */
// ---------------------------------------------------------------------------
// SECTION 1 - Small helper functions
//   pick()    one random element from a list
//   picks()   several random elements, no repeats
//   e()       HTML-escape a string before printing it into the page
//   slugify() lowercase a string and turn non-alphanumerics into dashes
// ---------------------------------------------------------------------------
function pick(array $a): string { return $a[mt_rand(0, count($a)-1)]; }
function picks(array $a, int $n): array { $o=[];$c=$a; for($i=0;$i<$n&&$c;$i++){ $k=mt_rand(0,count($c)-1); $o[]=$c[$k]; array_splice($c,$k,1);} return $o; }
// SEEDED RNG (2026-11-22): pick()/picks() run on mt_rand, and srand2()
// seeds that Mersenne Twister deterministically from a string. Page
// generation re-seeds in phases (pool build, host identity, page
// content) so the same host/URL always generates the same page with
// NO stored state anywhere - pure math from the host/path strings.
// Only content/presentation uses this; ban logic, log timestamps,
// cookie tokens and honeypot handling keep the crypto RNG / time().
function srand2(string $seed): void { mt_srand((int)(hexdec(substr(hash('sha256', $seed), 0, 8)) & 0x7fffffff)); }
function rint(int $min, int $max): int { return mt_rand($min, $max); }
function rshuffle(array $a): array { for($i=count($a)-1;$i>0;$i--){ $j=mt_rand(0,$i); $tmp=$a[$i]; $a[$i]=$a[$j]; $a[$j]=$tmp; } return $a; }
function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
function slugify(string $s): string { return preg_replace('/[^a-z0-9]+/','-', strtolower($s)); }
// Collapse consecutive duplicate words (case-insensitive): "Zone Zone" ->
// "Zone", "Help Centre Centre" -> "Help Centre", "flexible, flexible" ->
// "flexible,". Doubled words are a classic generator smell (audit B2).
function dedupeWords(string $s): string { do { $prev=$s; $s=preg_replace('/\b(\w+)([\s,]+)\1\b/i', '$1', $s); } while ($s !== $prev); return $s; }

// FAVICON PER HOST (audit B8): build a tiny 16x16 ICO on the fly - a
// two-tone glyph (square / diamond / disc) whose colours and shape are
// chosen by the caller from the host seed, so each host has its OWN
// favicon but always serves the same one. No stored file.
function mazeFaviconIco(array $bg, array $fg, int $shape): string {
    $size = 16; $xor = '';
    for ($row = $size - 1; $row >= 0; $row--) {           // BMP rows are bottom-up
        for ($col = 0; $col < $size; $col++) {
            $cx = $col - 7.5; $cy = $row - 7.5;
            if ($shape === 0) $in = ($col >= 4 && $col <= 11 && $row >= 4 && $row <= 11);
            elseif ($shape === 1) $in = (abs($cx) + abs($cy) <= 5.5);
            else $in = (($cx * $cx + $cy * $cy) <= 26);
            $c = $in ? $fg : $bg;
            $xor .= chr($c[2]) . chr($c[1]) . chr($c[0]) . chr(255);   // BGRA
        }
    }
    $mask = str_repeat("\0", $size * 4);                 // AND mask: 16 rows x 4 bytes
    $bmp = pack('V', 40) . pack('l', $size) . pack('l', $size * 2) . pack('v', 1) . pack('v', 32)
         . pack('V', 0) . pack('V', strlen($xor) + strlen($mask))
         . pack('V', 0) . pack('V', 0) . pack('V', 0) . pack('V', 0)
         . $xor . $mask;
    return pack('vvv', 0, 1, 1) . pack('CCCCvvVV', $size, $size, 0, 0, 1, 32, strlen($bmp), 22) . $bmp;
}

// ---------------------------------------------------------------------------
// SECTION 2 - Content pools (base lists)
// Every visible word on the page is drawn from these lists: brand names,
// topics, features, plan names, testimonials, FAQs, locations, authors,
// tags, glossary terms and the words used to build subdomain names.
// SECTION 3 below multiplies them combinatorially, so keep the base lists
// varied - variety here is what makes every generated page different.
// ---------------------------------------------------------------------------
$brands=['CloudPanel','NexaHost','OrbitCloud','PrimeStack','VertexPanel','CloudNest','HostSphere','PanelWorks','SkyStack','NovaServe','AeroHost','BluePeak','CoreNest','DataHaven','EchoStack','FluxHost','GridPanel','HyperNest','IonCloud','JetPanel','KiteHost','LumenStack','MetroCloud','NimbusPanel','OnyxHost','PixelNest','QuantumHost','RapidStack','SolarPanel','TitanCloud','UltraNest','VividHost','WaveStack','XenonCloud','YieldHost','ZenithPanel'];
$topics=['cloud hosting','server management','website hosting','developer tools','cloud infrastructure','hosting automation','app deployment','database hosting','WordPress hosting','VPS hosting','dedicated servers','shared hosting','reseller hosting','cloud storage','CDN delivery','email hosting','domain management','SSL security','website builder','ecommerce hosting','Node.js hosting','Python hosting','PHP hosting','Laravel hosting','Docker hosting','Kubernetes hosting','server monitoring','backup solutions','performance optimization','website security','load balancing','DNS management'];
$adjectives=['fast','reliable','secure','simple','modern','scalable','managed','automated','powerful','flexible','affordable','enterprise-grade','lightning-fast','rock-solid','user-friendly','cutting-edge','robust','efficient','seamless','intuitive'];
$nouns=['dashboard','control panel','cloud server','hosting plan','deployment','database','backup','monitoring','network','storage','cluster','instance','platform','environment','workspace','infrastructure','pipeline','repository','terminal','analytics'];
$features=['one-click installs','automatic backups','free SSL certificates','real-time monitoring','instant scaling','global data centres','daily snapshots','built-in caching','team access controls','uptime guarantees','DDoS protection','malware scanning','staging environments','Git integration','SSH access','SFTP access','cron jobs','PHP version selector','Node.js support','Python support','Redis caching','MySQL databases','PostgreSQL databases','free CDN','free domain','99.9% uptime SLA','24/7 expert support','instant activation','money-back guarantee','SSD storage','NVMe storage','unlimited bandwidth','free migrations','website builder','email accounts','spam protection','firewall protection','two-factor authentication','API access','webhook support'];
$sections=['features','pricing','docs','support','blog','guides','tutorials','status','community','changelog','resources','about','services','solutions','products','platform','company','careers','partners','affiliates','reviews','testimonials','case-studies','webinars','events','newsroom','knowledge-base','help-centre','developers','api','integrations','marketplace','templates','tools','calculator','comparison'];
$docPages=['getting-started','installation','configuration','best-practices','troubleshooting','api-reference','security-guide','migration','backups','performance-tips','ssl-setup','dns-settings','email-setup','database-setup','file-manager','ssh-access','ftp-guide','cron-jobs','php-settings','caching-guide','cdn-setup','staging-guide','deployment-guide','scaling-guide','monitoring-guide','billing-guide','domain-transfer','wordpress-guide','woocommerce-guide','laravel-guide'];
$blogTopics=['improving site speed','choosing the right plan','securing your server','backing up your data','scaling your application','understanding bandwidth','setting up SSL','monitoring uptime','optimizing databases','reducing bounce rate','choosing a domain name','migrating your website','WordPress speed tips','ecommerce best practices','SEO fundamentals','content delivery explained','cloud vs shared hosting','VPS buying guide','website security checklist','email deliverability tips'];
$taglines=['Fast, dependable hosting for sites that need to stay online','Clear pricing, honest support and servers that stay out of your way','Built for builders, loved by businesses everywhere','The hosting platform teams switch to and stay with','Everything you need to launch, run and grow a website','Dependable infrastructure with support from people who host sites themselves','Simple plans that scale as your traffic grows','Hosting set up properly, so you can get on with your work'];
$planNames=['Starter','Growth','Business','Pro','Turbo','Mega','Ultra','Cloud Nine','Launch','Scale','Enterprise','Creator','Developer','Agency'];
$testimonials=[['My site loaded before I finished clicking. I checked twice.','Dan, indie maker'],['Support answered at 2am. At 2am! I was not even awake properly.','Marta, shop owner'],['We migrated on a Friday and nothing broke. Nobody believed us either.','Tom, developer'],['Our old host sent us a farewell email. It was just a blank page.','Ana, blogger'],['Uptime is so boring now. Nothing ever goes down to complain about.','Chris, agency lead'],['I understood the dashboard on the first try. That never happens.','Jo, first-time founder'],['Page speed doubled overnight after the move.','Priya, ecommerce manager'],['The staging tool saved our launch. Twice in one week.','Leo, product lead']];
$faqPairs=[['How fast is the setup?','Most sites are live in under five minutes, which is quicker than making coffee properly.'],['Can I upgrade later?','Yes. Upgrading is instant and does not move your files or change your passwords.'],['Is there a free trial?','Yes, and no card is required to start your trial.'],['What happens if I break something?','Backups happen daily, so you can restore in one click.'],['Do you support my stack?','If it runs on a server, there is a very good chance we already host it.'],['Can I host multiple websites?','Yes, most plans let you add multiple sites, databases and email accounts.'],['Do you offer free SSL?','Every plan includes free SSL certificates with automatic renewal.'],['What is your uptime guarantee?','We guarantee 99.9% uptime backed by our service level agreement.'],['Can you migrate my site for free?','Yes, free migrations are included and usually completed within 24 hours.'],['Do you have a money-back guarantee?','Yes, a 30-day money-back guarantee on all new hosting plans.']];
// Fixed list of real datacenter CITIES only (audit B3): the old pool
// cross-multiplied direction prefixes x places and produced impossible
// geography like "South South Korea" and "West India". No prefixes, no
// countries/regions - just cities a host could plausibly run a DC in.
$locations=['New York','Chicago','Dallas','Los Angeles','Seattle','Toronto','London','Frankfurt','Amsterdam','Paris','Singapore','Tokyo','Sydney','Mumbai'];
// Geo meta pairs: placename and region code are picked TOGETHER from one
// entry so they can never disagree (old code said US-NY for Singapore).
$geoPlaces=[['name'=>'New York','region'=>'US-NY'],['name'=>'Chicago','region'=>'US-IL'],['name'=>'Dallas','region'=>'US-TX'],['name'=>'Los Angeles','region'=>'US-CA'],['name'=>'Seattle','region'=>'US-WA'],['name'=>'Toronto','region'=>'CA-ON'],['name'=>'London','region'=>'GB-LND'],['name'=>'Frankfurt','region'=>'DE-HE'],['name'=>'Amsterdam','region'=>'NL-NH'],['name'=>'Paris','region'=>'FR-75'],['name'=>'Singapore','region'=>'SG-01'],['name'=>'Tokyo','region'=>'JP-13'],['name'=>'Sydney','region'=>'AU-NSW'],['name'=>'Mumbai','region'=>'IN-MH']];
// Status wording must stay coherent with the ~98.x% uptime printed next
// to it (Claude review 2026-11-22): 98% uptime is ~6 days of downtime a
// year, so the status line must not claim perfection ("All systems
// operational" / "all services green") in the same breath.
$statusLines=['All core services running normally','No major incidents reported today','Services running normally across all regions','Running smoothly with normal response times'];
$subWords=['support','docs','portal','status','cloud','panel','api','help','blog','secure','account','billing','dashboard','community','developer','resources','guides','updates','service','hosting','server','website','domain','email','backup','security','network','storage','database','monitor','deploy','launch','build','create','manage','control','hub','centre','zone','lab','works','studio'];
$authors=['Alex Morgan','Sarah Lee','David Chen','Emma Wilson','James Taylor','Priya Patel','Michael Brown','Lisa Garcia','Anna Kim','Mark Johnson','Sophie Turner','Ryan Clark','Nina Shah','Oliver Reed','Grace Liu','Ben Carter'];
$categories=['Hosting Guides','Cloud Technology','Web Development','Website Security','Performance','Business Growth','Tutorials','News & Updates','Case Studies','Product Updates'];
$tags=['cloud hosting','web hosting','VPS','WordPress','SSL','CDN','performance','security','backups','domains','email hosting','SEO','website speed','server management','deployment','databases','caching','uptime','scaling','migration'];
$glossary=[['Uptime','The percentage of time a server stays online and reachable.'],['CDN','A network of edge servers that delivers content closer to visitors.'],['SSL Certificate','Encrypts traffic between a browser and a server with HTTPS.'],['NVMe','Very fast storage that dramatically reduces load times.'],['Staging','A private copy of your site for testing changes safely.'],['DNS','The system that translates domain names to server addresses.']];
// ---------------------------------------------------------------------------
// COHERENT CORPUS (2026-11-22 big rewrite): hand-written hosting copy that
// replaces the old cross-product generator. Features get a name + a concrete
// description; article titles and paragraphs are complete, meaningful texts
// about real hosting topics. {brand}, {city} and {topic} are substituted at
// render time. Pages stay infinite because the count comes from host x path
// seeds sampling this corpus, not from the corpus size.
// ---------------------------------------------------------------------------
$featureDetails=[
['NVMe storage','Solid-state NVMe drives cut page load times because the server spends less time waiting on disk reads, which matters most for database-driven sites.'],
['Automatic daily backups','A full copy of your files and databases is taken every day and kept for 30 days, so a bad update or an accidental deletion is a restore, not a rebuild.'],
['Free SSL certificates','Every domain on your account gets a Lets Encrypt certificate issued automatically and renewed before it expires, so visitors always see the padlock.'],
['Built-in page caching','Frequently requested pages are stored in memory and served without running PHP or touching the database, which keeps busy pages fast under load.'],
['Staging environments','Clone your live site to a private staging address, test changes there, and push them live only when they are ready.'],
['One-click installers','WordPress, WooCommerce and other popular applications install in a couple of clicks with sensible defaults already set.'],
['Malware scanning','Files are scanned daily against known malware signatures, and anything suspicious is quarantined and reported to you the same day.'],
['DDoS protection','Traffic filtering at the network edge absorbs common denial-of-service attacks before they reach your site.'],
['Git deployment','Push to your repository and the new code is deployed automatically, with the previous release kept for a one-click rollback.'],
['SSH and SFTP access','Full shell access for developers who prefer the command line, plus secure file transfer for everyone else.'],
['Cron job scheduling','Run scripts on a schedule you set - cleanup tasks, report generation, cache warming - without third-party services.'],
['PHP version selector','Choose the PHP version each site runs, from older releases for legacy code to the latest for new projects.'],
['Redis object caching','WordPress and other applications can store database query results in Redis, which noticeably speeds up logged-in and dynamic pages.'],
['MySQL and PostgreSQL','Create databases from the control panel, manage users and permissions, and import or export through phpMyAdmin.'],
['Free site migration','Our team moves your existing site, email and databases from your old host and checks everything before the switch.'],
['Uptime monitoring','Your site is checked every minute from several locations, and you are alerted if it stops responding.'],
['Two-factor authentication','Protect your hosting account login with an authenticator app, on top of your password.'],
['Team access controls','Invite colleagues with their own logins and limit each person to the sites and tools they actually need.'],
['Email hosting included','Create mailboxes on your own domain with spam filtering, webmail, and IMAP access for your mail app.'],
['Global data centres','Host your site close to your visitors, with locations across North America, Europe and Asia-Pacific.'],
['Instant scaling','Move to a larger plan in one click when traffic grows; files, settings and email carry over unchanged.'],
['Security patching','Server software and PHP security updates are applied for you, including emergency patches outside the normal schedule.'],
['Web application firewall','Common attack patterns against WordPress and other applications are blocked before the request reaches your code.'],
['Daily snapshots','Beyond backups, point-in-time snapshots let you roll the whole account back to how it looked yesterday morning.'],
['Free CDN','Static files are copied to edge servers worldwide, so a visitor in another continent still gets a fast first load.'],
['Spam protection','Incoming email is filtered for spam and phishing, and outbound sending is monitored so your domain keeps a clean reputation.'],
['Resource usage graphs','See CPU, memory and disk use per site, so you can tell whether slow pages need more resources or better code.'],
['Instant activation','Your account and first site are ready within minutes of signing up - no waiting for manual review.'],
['30-day money-back guarantee','If the service is not right for you, cancel within 30 days of signing up for a full refund of the hosting fee.'],
['24/7 expert support','Real hosting engineers answer tickets and live chat around the clock, including weekends and holidays.'],
];
$articleTitles=['How to speed up a slow WordPress site','Choosing the right hosting plan for a growing business','What to check before migrating your website','A practical guide to website backups','How SSL certificates work and why every site needs one','Caching explained: why your second page load is faster','How to set up a staging site before a big update','Reading your server resource graphs without guessing','What uptime monitoring actually tells you','Keeping WordPress plugins updated without breaking your site','How to move email to your own domain','When a shared plan stops being enough','Database optimisation for busy WooCommerce stores','How CDNs deliver your pages from closer to home','A checklist for launching a new website','Recovering a hacked site: first steps that matter','How PHP versions affect your site speed','Setting up cron jobs for routine maintenance','What to do when traffic suddenly spikes','Understanding bandwidth, visits and resource limits','How automatic security patching protects older sites','Testing a redesign on staging before anyone sees it','Why page speed affects search rankings and sales','Backing up before a sale, a launch or a redesign','How to choose a data centre location','Moving from another host without downtime','What a web application firewall blocks, in plain terms','Making a small business website load in under two seconds','How to spot a plugin that is slowing your site down','Preparing your store for a busy weekend','The difference between backups and snapshots','How DNS changes propagate when you move hosts','Securing the admin area of your website','What happens when you outgrow your plan','A calm guide to restoring a backup','How object caching helps logged-in users','Email deliverability: why messages land in spam','Monitoring a portfolio of client sites from one account','How to give a developer access without sharing your password','Planning capacity for a site that keeps growing'];
$corpusParas=[
'{brand} hosts websites for small businesses, shops and independent developers who need their sites to load quickly and stay online. Every plan runs on NVMe storage in {city} and other data centres, with page caching switched on by default.',
'Most people choose {brand} because moving is painless. The migration team copies your files, databases and email from your old host, checks the site on a temporary address, and only switches your domain over once everything works.',
'Backups run every night without you having to remember. If an update breaks something, you can restore the whole site - or just the database - to how it looked yesterday, last week, or up to 30 days ago.',
'Security is handled in layers. Certificates are issued and renewed automatically, server software is patched as updates are released, and a firewall filters out the automated attacks that probe every website, every day.',
'When your site gets busier, you do not have to move house. Plans scale in place: more processor time, more memory and more storage are added to the same account, and your site keeps its address, its email and its settings.',
'Support at {brand} is staffed by people who run hosting servers for a living. If you open a ticket at three in the morning, the person who answers can actually look at your server, not just read from a script.',
'A staging copy of your site is included because updates deserve a rehearsal. Clone the live site, try the new theme or plugin there, and push the change live only when you have seen it working.',
'Page speed is mostly a hosting problem before it is a design problem. Fast storage, a current PHP version and proper caching will do more for a slow site than deleting images ever will.',
'Your account shows resource use honestly. Graphs for processor, memory and disk make it obvious whether a slow page needs a bigger plan or whether one misbehaving plugin is eating the allowance.',
'Email on your own domain is part of the service, with spam filtering and proper authentication records set up for you, so invoices and order confirmations reach inboxes instead of junk folders.',
'{brand} monitors every hosted site every minute. If a site stops responding, engineers see the alert with the server data attached, which is why most incidents are fixed before customers notice them.',
'Developers get the tools they expect: SSH access, Git deployment, a choice of PHP versions, staging environments and scheduled tasks, all without filing a support ticket to have them enabled.',
'For online shops, the details that matter are unglamorous: a database that keeps up at checkout, backups you can actually restore, and a support team that understands a sale weekend is not the time for surprises.',
'Choosing where your site lives still matters. Hosting in or near {city} keeps load times low for local visitors, while the included CDN serves your images and files quickly to everyone further away.',
'There is no lock-in to escape later. Your domain, your files and your databases are yours, exports are available from the control panel, and leaving - though we would rather you stayed - is a normal feature, not a negotiation.',
'Small sites are not second-class here. The entry plan runs on the same platform as the largest one; it simply includes fewer resources, so a personal site gets the same caching, backups and security as a busy store.',
'Updates are where websites usually break, which is why {brand} takes a snapshot before major changes and keeps the previous version one click away. Trying something new should never risk the site you already have.',
'The control panel is deliberately plain. The things people do every week - add a domain, create an email address, restore a backup, check resource use - are each one or two clicks from the home screen.',
'If you manage sites for clients, team accounts let each client log in to their own site while you keep an overview of all of them, including who changed what and when.',
'Traffic spikes are a good problem handled badly by most hosts. Here, caching absorbs the surge, resource graphs show exactly what happened, and upgrading afterwards takes minutes rather than a migration.',
'Everything about {topic} comes back to the same basics: fast storage, enough memory, software that is kept up to date, and help from people who know the platform when something does go wrong.',
'We publish our service status openly, including the incidents we would rather forget. A host that hides downtime is asking you to trust it about everything else, too.',
'Getting started takes about five minutes: choose a plan, register or transfer a domain, and either install WordPress fresh or let the migration team bring your existing site across.',
'Questions before you buy are welcome. Tell support what you are running - the platform, the plugins, roughly how many visitors - and they will tell you plainly which plan fits, including if it is the cheapest one.',
];
$howtoSteps=['Log in to your control panel and open the site you want to work on.','Take a backup or snapshot first, so you can undo the change if the result is not what you expected.','Open the relevant settings page from the left-hand menu; most changes here apply immediately.','Make the change for one site first if you manage several, and check the result before repeating it elsewhere.','Clear the page cache from the caching page so you are looking at the new version, not a stored copy.','Load the site in a private browser window to see exactly what a first-time visitor sees.','Check the resource graphs after an hour of normal traffic to confirm the change helped.','If anything looks wrong, restore the snapshot from the backups page - it takes about a minute.','Turn on uptime alerts for the site so you hear about problems before your visitors report them.','Note what you changed in your own records; future you will be glad past you did.','For WordPress sites, update plugins one at a time and reload the site between each update.','Test your contact and checkout forms after any change - they fail quietly more often than pages do.','Check the site on a phone as well as a desktop; layout problems hide at smaller widths.','Review the change again after a week, when real visitor data has replaced first impressions.'];
// ---------------------------------------------------------------------------
// SLUG TOPICS (cold-review fix 2026-11-22): hand-written content keyed by the
// doc-page SLUG (the middle path segment). A page's primary content - title,
// headline, intro/body paragraphs and step-by-step steps - is derived FROM
// its slug, so /pricing/dns-settings really is about DNS and a /blog/ssl-setup
// article really is about SSL. Before this, topic and content were seeded
// independently and almost never matched, which all five cold reviewers
// flagged. {brand} and {city} are substituted in paras at render time.
// Each entry: name (display name), titles (article headlines for the topic),
// paras (topic paragraphs), steps (topic how-to steps).
// ---------------------------------------------------------------------------
$slugTopics=[
'getting-started'=>['name'=>'Getting Started','titles'=>['Getting started with your new hosting account','Your first hour on a new hosting account, step by step'],'paras'=>['Getting started is mostly about order: first connect your domain, then install your site or upload your files, then set up email and turn on SSL. Doing those four things in that order means every later step has something solid to build on.','The control panel home screen is your map. From there you can add a domain, open the file manager, create a database or a mailbox, and see how much storage and bandwidth your plan has used so far. Nothing on that screen can break your site by being looked at, so explore it before you change anything.','Before you announce your new site, take one manual backup from the backups page. That first snapshot is your clean starting point: whatever you experiment with afterwards, you can always return to the exact setup you began with at {brand}.'],'steps'=>['Log in to the control panel and confirm your domain is listed under your account.','Point your domain at {brand} using the nameservers or DNS records in your welcome email.','Install WordPress from the one-click installer, or upload your existing site files with the file manager.','Create your first mailbox under your own domain from the email page.','Turn on your free SSL certificate, then take a backup so your starting point is saved.']],
'installation'=>['name'=>'Installation','titles'=>['How to install WordPress and other apps in minutes','Installing your first application, step by step'],'paras'=>['The one-click installer handles the tedious parts of an installation for you: it copies the application files, creates the database and its user, writes the configuration file, and sets safe file permissions. What used to be a twenty-step manual job is finished in about a minute.','A manual installation is still possible whenever you want full control. Upload the application files to your site folder, create a database and user from the databases page, then run the installer in your browser and enter those database details when asked.','Whichever route you take, the first jobs after installing are the same: log in to the new admin area, change any default settings, delete the sample content, and run the built-in updates so you start on the current, patched version.'],'steps'=>['Open the one-click installer from your control panel and choose the application.','Pick the domain to install on and leave the directory blank to install at the root.','Set your admin username and a strong password - never use the default admin name.','Run the install and wait for the confirmation screen with your admin login link.','Log in to the new site, run all pending updates, and take a backup of the clean install.']],
'configuration'=>['name'=>'Configuration','titles'=>['Configuration settings that matter on a new site','How to configure your hosting account properly the first time'],'paras'=>['Good configuration is invisible when it is right: the correct PHP version for your application, caching switched on, error display turned off for visitors but logging turned on for you, and file permissions that let the site work without letting strangers write to it.','Most configuration lives in three places: the PHP settings page for version and limits, the caching page for page and object cache toggles, and your application admin area for its own options. Changing one setting at a time, and checking the site after each change, keeps cause and effect obvious.','Email configuration deserves care even if you change nothing else. When SPF, DKIM and DMARC records are set correctly, other mail servers trust messages from your domain, and far fewer of them land in spam folders.'],'steps'=>['Open the PHP settings page and select the PHP version your application recommends.','Set the memory limit and maximum upload size to the values your application needs.','Switch on page caching from the caching page.','Turn off error display for visitors and confirm error logging is on.','Check that SPF, DKIM and DMARC records exist for every domain that sends email.']],
'best-practices'=>['name'=>'Best Practices','titles'=>['Hosting best practices we recommend to every customer','Best practices for a fast, secure, well-kept website'],'paras'=>['The sites that stay fast and secure for years all follow the same handful of habits: software kept up to date, backups taken before changes rather than after disasters, staging used for anything risky, and as few plugins and extras installed as the site actually needs.','Access is a best practice too. Every person who works on the site should have their own login, with only the permissions their job needs, and two-factor authentication on the accounts that can change files, billing or DNS. Shared passwords are how small problems become big ones.','Finally, watch the resource graphs once in a while. A slow drift upwards in memory or storage use is normal for a growing site; a sudden spike is a message. Catching either early is what separates a planned upgrade from an emergency.'],'steps'=>['Turn on automatic updates for your application, themes and plugins where available.','Take a backup before every significant change, not just on a schedule.','Give every team member their own login and enable two-factor authentication.','Remove plugins, themes and tools the site does not use.','Check your resource graphs monthly and act on trends before they become limits.']],
'troubleshooting'=>['name'=>'Troubleshooting','titles'=>['Troubleshooting common website errors','What to check first when your site goes down'],'paras'=>['Most website errors announce their own cause if you look in the right order. Start with what changed last: a plugin update, a settings change, a new theme. The majority of sudden breakages trace back to the most recent change, and undoing that one thing fixes the site while you investigate calmly.','The error log is the second stop. A white screen or a 500 error looks identical from the outside, but the log names the file and line that failed, which turns guessing into a short list of suspects. Your control panel shows the log for each site.','If nothing changed and the site is still down, check the resource graphs. A site that has hit its memory or process limit fails in ways that look like bugs. The graphs show the limit being reached at the exact time the errors began.'],'steps'=>['Note the exact error and the time it started, then undo the most recent change.','Open the error log for the site and find the first error at that time.','Check the resource graphs for memory or process limits being hit.','Disable plugins one at a time, or switch to a default theme, to isolate the cause.','Restore the most recent good backup if the site must be back before the cause is found.']],
'api-reference'=>['name'=>'API Reference','titles'=>['API reference for managing your hosting account','Automating hosting tasks with the API'],'paras'=>['The API lets you do from a script anything you can do in the control panel: create and list sites, take and restore backups, add domains and mailboxes, and read resource usage. Each request is authenticated with a personal API token, which you can revoke at any time.','Tokens are scoped, so a script that only reads usage statistics never needs permission to delete anything. Create a separate token for each integration, name it after its job, and rotate tokens the way you would rotate passwords.','Requests are rate-limited to keep the platform responsive for everyone, and every response is JSON with a predictable shape: the requested data on success, or an error object with a code and a plain-language message when something is refused.'],'steps'=>['Create an API token from the API page of your control panel and copy it somewhere safe.','Send the token in the Authorization header of every request.','Call the sites endpoint to list your sites and confirm authentication works.','Use the backups endpoint to trigger a backup and poll its status until it completes.','Revoke any token you no longer use from the same page.']],
'security-guide'=>['name'=>'Security Guide','titles'=>['A practical security guide for your website','How to keep your site secure, step by step'],'paras'=>['Website security is mostly maintenance done on time. The automated attacks that probe your site every day are looking for known holes in old software, so keeping your application, themes and plugins updated closes the door they use most often. {brand} applies server and PHP security patches for you, but your application updates are yours.','The web application firewall watches requests as they arrive and blocks the patterns of common attacks - injection attempts, known exploit probes, brute-force login storms - before they reach your code. Malware scanning then checks your files daily, in case anything ever does get through.','Strong, unique passwords and two-factor authentication protect the doors that updates cannot: your hosting login, your site admin, and your email. Most account takeovers we see start with a password reused from somewhere else.'],'steps'=>['Update your application, themes and plugins, and delete anything unused.','Turn on two-factor authentication for your hosting and site admin logins.','Confirm the web application firewall and daily malware scanning are enabled.','Use a unique password for every login, stored in a password manager.','Restrict the admin area by enabling login alerts and limiting failed attempts.']],
'migration'=>['name'=>'Migration','titles'=>['Moving your website to a new host without downtime','How a migration works, from request to switch-over'],'paras'=>['A migration copies everything that makes your site yours: files, databases, email accounts and their messages. At {brand} the migration team does the copying, then puts the copied site on a temporary address so you can click through it and confirm it works before anything public changes.','The switch itself is a DNS change, and it is the only step visitors can notice - which is why it is done last, and quickly. Because the old and new copies run side by side during the changeover, visitors see one working site or the other, never a gap.','Email moves with the same care. Mailboxes are recreated on the new account and existing messages are synced across, so the morning after the switch your inbox looks the way it did the night before.'],'steps'=>['Request the migration from your control panel and provide your old host login.','Wait while files, databases and email are copied to your new account.','Review the copied site on its temporary address and report anything missing.','Approve the switch, and the team updates your DNS to point at the new account.','Keep the old hosting active for a few days as a safety net, then cancel it.']],
'backups'=>['name'=>'Backups','titles'=>['Backups explained: what is saved and how to restore it','How to restore a backup in minutes'],'paras'=>['Every night, {brand} backs up your files and databases, and keeps each copy for 30 days. A backup is a complete picture of your site at that moment - code, uploads, settings and content - so restoring one returns the site to exactly how it was, not approximately.','Restoring is deliberately simple: choose the date, choose whether to restore files, the database, or both, and confirm. Restoring just the database is the right move when a content change went wrong; restoring both is the fix for a broken update.','Snapshots are the manual sibling of backups. Take one right before a redesign, a sale or a big update, and you have a named, known-good point to return to - separate from the nightly cycle, and kept until you delete it.'],'steps'=>['Open the backups page and choose the date you want to return to.','Decide whether the problem is in files, the database, or both.','Start the restore for that scope and wait for the completion message.','Load the site and check the pages, forms and checkout that matter.','Take a fresh snapshot once the restored site is confirmed working.']],
'performance-tips'=>['name'=>'Performance Tips','titles'=>['Performance tips that actually speed up your site','How to make your pages load faster, in the order that matters'],'paras'=>['Page speed improvements have an order of impact. Caching comes first: a cached page skips PHP and the database entirely, which is why switching on page caching is usually the single biggest speed gain a site can make in one click.','Next is the weight of the page itself. Oversized images are the most common offender - a photo straight from a phone can be twenty times larger than the same image sized for the web. Compressing images and removing plugins the site does not need regularly beats hours of fine-tuning.','Only after caching and weight should you look at capacity. If the resource graphs show the site is genuinely out of memory or processor time at busy moments, a larger plan helps; if they do not, more capacity changes nothing and the graphs will tell you so honestly.'],'steps'=>['Switch on page caching, then test the site speed again before changing anything else.','Resize and compress the largest images, starting with the homepage.','Update PHP to the newest version your application supports.','Remove or replace plugins that the resource graphs show as heavy.','Enable the CDN so static files are served from close to each visitor.']],
'ssl-setup'=>['name'=>'SSL Setup','titles'=>['How to set up SSL and get the padlock on every page','SSL setup: certificates, HTTPS and fixing mixed content'],'paras'=>['SSL setup at {brand} starts automatically: every domain on your account is issued a free Lets Encrypt certificate, and renewals happen before expiry without you touching anything. Your job is the second half - making the site actually use HTTPS everywhere.','Forcing HTTPS means two changes: redirecting every http address to its https version, and making sure the site itself asks for secure addresses. In WordPress that is one setting for the site address; in a hand-built site it is a small redirect rule.','The warning visitors see after a correct setup is usually mixed content: the page is secure, but one image or script inside it is still loaded over http. The fix is always the same - find the insecure address in the page and update it to https.'],'steps'=>['Confirm your certificate is active on the SSL page of your control panel.','Turn on the force-HTTPS redirect for the domain.','Update your site address to the https version in your application settings.','Load the site and check for mixed-content warnings in the browser.','Fix any remaining http links to images, scripts or stylesheets.']],
'dns-settings'=>['name'=>'DNS Settings','titles'=>['DNS settings explained: A, CNAME, MX and TXT records','How to change DNS settings without breaking your site'],'paras'=>['DNS settings are the address book of your domain. An A record points the domain at a server, a CNAME points one name at another name, MX records tell the world where email for the domain is delivered, and TXT records carry proof and policy - ownership checks, SPF sender rules and DMARC settings.','Changes are not instant. When you edit a record, caches around the internet keep using the old answer until its time-to-live expires, which is why a DNS change can look done on your screen and not yet for a visitor elsewhere. Lowering the TTL a day before a planned change makes the change itself propagate faster.','The one rule that prevents most DNS accidents: change one record at a time, and never edit MX records casually. A wrong A record takes a website offline where people can see it; a wrong MX record silently loses email, which is worse.'],'steps'=>['Open the DNS page for your domain and note the current records before editing.','Change the A record to point at your hosting account IP address.','Leave MX records untouched unless you are moving email on purpose.','Add the TXT records for SPF, DKIM and DMARC exactly as your email page shows them.','Wait for propagation, then check the site and send yourself a test email.']],
'email-setup'=>['name'=>'Email Setup','titles'=>['Setting up email on your own domain','How to create mailboxes and connect your mail app'],'paras'=>['Email on your own domain starts with a mailbox: an address like you@yourbusiness.com, created from the email page of your control panel with its own password and storage quota. From that moment it can send and receive, through webmail immediately and through your mail app once you add the account there.','Connecting an app needs three details, all shown on the email page: the incoming IMAP server, the outgoing SMTP server, and the ports and encryption each one expects. Use IMAP rather than POP3 and your mail stays synced between phone, laptop and webmail.','Deliverability is the quiet half of email setup. With SPF, DKIM and DMARC records in place - {brand} adds them for mailboxes it hosts - receiving servers can verify that a message really came from you, which keeps invoices and order confirmations out of spam folders.'],'steps'=>['Create the mailbox and set a strong, unique password for it.','Log in to webmail once to confirm the mailbox works.','Add the account to your mail app using the IMAP and SMTP details shown.','Send a test message out and reply to one sent in.','Check that SPF, DKIM and DMARC records are present on the DNS page.']],
'database-setup'=>['name'=>'Database Setup','titles'=>['How to create and manage a database','Database setup for WordPress and other applications'],'paras'=>['Most websites store their content in a database, and setting one up takes three linked pieces: the database itself, a user, and that user permission to use the database. The databases page creates all three in one flow and shows you the details your application will ask for.','Your application connects with four values: the database name, the username, its password, and the host, which on {brand} is simply localhost. In WordPress those go in the wp-config file; most other applications ask for them during installation.','Day-to-day management happens in phpMyAdmin, linked from the same page: browsing tables, running an export for an extra local copy, or checking why a table has grown. Regular optimisation - removing old revisions and transient data - keeps a busy database responsive.'],'steps'=>['Open the databases page and create a new database with a clear name.','Create a database user with a strong generated password.','Grant that user all privileges on the new database.','Enter the database name, user, password and localhost host in your application.','Open phpMyAdmin once to confirm the application has created its tables.']],
'file-manager'=>['name'=>'File Manager','titles'=>['Using the file manager to upload and edit site files','File manager basics: uploads, permissions and safe edits'],'paras'=>['The file manager is a window into your site folder from the browser: upload and download files, create folders, rename, compress and extract archives, and make small text edits without any other software. For a quick fix - replacing an image, correcting a line in a configuration file - it is the fastest tool you have.','Permissions decide who can read and change each file. The defaults {brand} sets are the safe ones: folders at 755, files at 644. If a guide tells you to set 777 to make something work, treat that as a warning sign rather than a solution.','Edit with a safety net. Before changing any file that the site depends on, download a copy or take a snapshot; a one-line typo in a configuration file can take a site down, and the restore is only painless if the original still exists.'],'steps'=>['Open the file manager and navigate to your site public folder.','Download a copy of any file before you edit it.','Upload files or archives using the upload button, then extract archives in place.','Check permissions read 755 for folders and 644 for files after uploading.','Reload the site to confirm the change, and keep the downloaded original until you are sure.']],
'ssh-access'=>['name'=>'SSH Access','titles'=>['How to connect over SSH and use the command line','SSH access: keys, login and useful first commands'],'paras'=>['SSH gives you a command-line session on your hosting account: the same files the file manager shows, but with the speed of typed commands and tools like WP-CLI that can update, search or repair a WordPress site in one line.','The safe way in is with a key pair rather than a password. You keep the private key on your computer, add the public key to your account on the SSH page, and the server recognises your computer at login. Keys cannot be guessed or reused from a leaked password list.','Once connected, the everyday commands are few: move around with cd, list files with ls, check disk use with du, and use WP-CLI for WordPress work. Anything destructive deserves the same rule as the file manager - snapshot first.'],'steps'=>['Generate an SSH key pair on your computer if you do not have one.','Add the public key on the SSH page of your control panel.','Connect with ssh using your account username and server address.','Run ls in your site folder to confirm you are in the right place.','Take a snapshot before running any command that changes files in bulk.']],
'ftp-guide'=>['name'=>'FTP Guide','titles'=>['FTP guide: uploading files with an FTP client','How to connect with FTP and SFTP, and which to choose'],'paras'=>['FTP is the classic way to move files between your computer and your site, using a desktop client such as FileZilla. You connect with a hostname, username and password, then drag files between the two panes - local on the left, your site on the right.','Choose SFTP whenever the client offers it. Plain FTP sends your password unencrypted; SFTP runs the same file transfer inside an encrypted SSH connection, and at {brand} it uses the same login as your SSH access, on port 2022.','Most transfer problems are one of three things: the wrong folder (your site lives in its public folder, not the account root), a passive-mode setting that needs toggling, or permissions that need checking after a large upload. The client log at the bottom of the window names which one.'],'steps'=>['Install an FTP client and create a new site entry for your domain.','Choose SFTP as the protocol and enter port 2022.','Log in with your account username and password or key.','Navigate to the site public folder on the server side before uploading.','Upload your files, then check permissions are 644 for files and 755 for folders.']],
'cron-jobs'=>['name'=>'Cron Jobs','titles'=>['Cron jobs: running scripts on a schedule','How to set up a cron job in the control panel'],'paras'=>['A cron job runs a command or script automatically on a schedule you choose - every five minutes, every night at 2am, on Mondays. Sites use them for the chores that must happen whether anyone remembers or not: clearing caches, sending digest emails, importing feeds, pruning old data.','The control panel expresses schedules in plain choices - every hour, daily, weekly - with an advanced mode for the classic five-field cron expression when you need something exact like 15 3 * * 1-5. The command itself is usually a php call to a script inside your site folder.','Give every job somewhere to report. Direct its output to a log file or an email address, because a cron job that fails silently will fail for months. Checking the log after the first scheduled run is the step most people skip and later regret.'],'steps'=>['Open the cron jobs page and choose how often the job should run.','Enter the command, usually php followed by the full path to your script.','Send the output to a log file in your account so runs leave a record.','Save the job, then check the log after its first scheduled run.','Disable jobs you no longer need instead of leaving them running forever.']],
'php-settings'=>['name'=>'PHP Settings','titles'=>['PHP settings explained: version, memory and limits','How to change your PHP version and settings safely'],'paras'=>['PHP settings control the engine your site runs on. The version matters most: each new PHP release is faster and more secure than the last, and most speed problems on older sites shrink noticeably just by moving from an old version to a current one. At {brand} the version is chosen per site, so one site can upgrade without touching another.','The limits come next. Memory limit decides how much a single request may use, upload max size decides how large a file the site can accept, and max execution time decides how long a script may run. Raising a limit is right when a legitimate job needs it - a big import, a backup run - and pointless when a runaway plugin is the real cause.','Change PHP settings the careful way: one change, then reload the site and check the error log. A version jump can expose code that relied on removed behaviour, and finding that on a staging copy first is exactly what staging is for.'],'steps'=>['Open the PHP settings page for the site and note the current version.','Select the newest PHP version your application supports.','Set memory limit, upload size and execution time to what your tasks need.','Reload the site and check the error log for warnings or failures.','Repeat the same settings on staging first if the version jump is large.']],
'caching-guide'=>['name'=>'Caching Guide','titles'=>['Caching explained: page cache, object cache and CDN cache','How to set up caching so repeat visits are instant'],'paras'=>['Caching stores the finished version of a page so the next visitor gets the copy instead of making the server rebuild it. Page caching is the biggest layer: a cached page needs no PHP run and no database queries, which is why it transforms how a site copes with busy moments.','Object caching is the layer underneath, handled by Redis at {brand}. It remembers the results of database queries and expensive calculations, which matters most for logged-in visitors - shop customers, members, dashboards - whose pages cannot be page-cached.','The rule that keeps caching from becoming a nuisance is knowing when it clears. Publishing or editing content should purge that page from every cache layer automatically; if you ever see an old version of a page you just changed, purge the cache from the caching page and reload before assuming anything is broken.'],'steps'=>['Switch on page caching from the caching page of your control panel.','Enable Redis object caching if your application supports it.','Exclude checkout, cart and account pages from the page cache.','Purge the cache after publishing changes and reload to confirm.','Load the site twice - the second, cached load is the speed visitors get.']],
'cdn-setup'=>['name'=>'CDN Setup','titles'=>['How to set up a CDN for your website','CDN setup: pointing your site at the edge network'],'paras'=>['A CDN keeps copies of your static files - images, stylesheets, scripts - on servers around the world, so a visitor in another continent downloads them from a nearby city instead of from your hosting account in {city}. First visits from far away are where a CDN changes the experience most.','Setup at {brand} is mostly a switch: turn the CDN on for your domain and the platform handles the certificates and the routing. Sites with their DNS elsewhere add one CNAME record instead, pointing the www name at the CDN address shown on the CDN page.','After enabling it, verify rather than assume. Load your site and check the response headers for a cache hit from an edge location, and purge the CDN cache after design changes so the edge copies match the new files on your account.'],'steps'=>['Open the CDN page and enable the CDN for your domain.','If your DNS is elsewhere, add the CNAME record the page shows you.','Wait for the edge certificate to be issued, then load the site over https.','Check the response headers show a CDN cache hit on the second load.','Purge the CDN cache after publishing design or stylesheet changes.']],
'staging-guide'=>['name'=>'Staging Guide','titles'=>['How to use a staging site before a big update','Staging guide: clone, test, and push live safely'],'paras'=>['A staging site is a private copy of your live site at a temporary address, where updates, redesigns and experiments can break safely. The workflow never changes: clone the live site, do the work on the copy, check it properly, then push the finished copy live.','Staging earns its keep on the updates that look routine. A plugin update that conflicts with your theme, a PHP version jump, a new checkout flow - each takes minutes to test on staging and hours to unpick on a live shop with customers in it.','Keep staging private and temporary. It is password-protected and blocked from search engines by default, and once the work is live, refresh the staging copy from the new live site or delete it, so the next project starts from the current site rather than a museum piece.'],'steps'=>['Create the staging copy from the staging page of your control panel.','Log in to the staging address and confirm it matches the live site.','Apply your updates or changes on staging only.','Test the pages, forms and checkout that matter, on phone and desktop.','Push staging live, then reload the real site and check it again.']],
'deployment-guide'=>['name'=>'Deployment Guide','titles'=>['Deploying code with Git, step by step','Deployment guide: from repository to live site'],'paras'=>['Git deployment replaces uploading files by hand with a repeatable process: push your code to the repository connected to your site, and the platform checks it out into your site folder, runs your build steps if you have them, and keeps the previous release available for rollback.','The settings that make deployments boring - in the good way - are a clear document root, environment values kept out of the code in the deployment settings, and a short post-deploy checklist: clear the cache, run migrations if the release has them, load the homepage and one important inner page.','Rollback is part of the design, not an admission of failure. If the new release misbehaves, redeploying the previous one takes a click, and the time to discover that is during setup, not during an incident.'],'steps'=>['Connect your repository on the deployment page and choose the branch.','Set the document root and any environment values the app needs.','Push a small change and watch the first deployment complete.','Clear the site cache and run any database migrations the release includes.','Load the site and confirm the change, noting how rollback works before you need it.']],
'scaling-guide'=>['name'=>'Scaling Guide','titles'=>['Scaling your hosting as traffic grows','How to know when to scale, and what actually changes'],'paras'=>['Scaling starts with evidence, not vibes. The resource graphs show whether your site is bumping against its memory, processor or process limits, and when - a lunchtime spike pattern suggests a busy shop doing well, while a flat line at the limit all day suggests a plan that is simply too small.','Before buying capacity, spend the free wins: caching on, heavy plugins dealt with, images sized properly. A surprising number of sites that look like they need a bigger plan actually need one runaway process fixed. The graphs tell you which situation you are in.','When you do scale at {brand}, the plan changes in place: more processor, memory and storage on the same account, with the same files, email and addresses. There is no migration and no downtime window, which is how scaling should feel - a settings change, not a house move.'],'steps'=>['Read the resource graphs for the busiest recent week and note which limit is close.','Apply the free fixes first: caching, image sizes, heavy plugins.','Choose the next plan up if a limit is still being reached regularly.','Upgrade from the billing page - the change applies to the same account.','Watch the graphs for a week after upgrading to confirm the headroom.']],
'monitoring-guide'=>['name'=>'Monitoring Guide','titles'=>['Monitoring your site: uptime, resources and alerts','How to read your monitoring and resource graphs'],'paras'=>['Monitoring answers three questions continuously: is the site up, how hard is it working, and is that changing over time. {brand} checks every hosted site every minute from several locations, so a failure that only affects one region still shows up.','The resource graphs are the day-to-day half of monitoring. Processor and memory lines that spike with your marketing emails are healthy; a line that climbs every week regardless of traffic is a trend worth acting on while it is still cheap to fix.','Alerts close the loop. Set them for downtime first - you want to hear about an outage from the monitoring, not from a customer - and add storage warnings second, because a disk filling up is the most preventable outage there is.'],'steps'=>['Open the monitoring page and confirm uptime checks are on for your site.','Set a downtime alert to an email address you actually read.','Add a storage warning at 80 percent so a full disk never surprises you.','Review the resource graphs weekly and note any steady upward trend.','After any incident, check the monitoring timeline to see exactly when it began.']],
'billing-guide'=>['name'=>'Billing Guide','titles'=>['Billing guide: plans, renewals and invoices','How billing works: payments, renewals and refunds'],'paras'=>['Billing runs on a simple cycle: your plan renews on the same date each period, a reminder is sent before the charge, and every invoice is stored in your account for download. Keeping a current payment method on file is what keeps that cycle invisible.','Renewals are where accounts get into trouble they did not need. An expired card does not cancel anything immediately - there is a grace period, reminders, and plenty of warning - but a site eventually suspends if a renewal fails, which is why the billing email address should be one somebody reads.','Changing plans is handled by difference, not by starting over: upgrading charges the remaining period at the new rate, downgrading credits it, and the 30-day money-back guarantee applies to new hosting purchases if the service turns out not to fit.'],'steps'=>['Open the billing page and confirm your plan and next renewal date.','Check the payment method on file is current and set a backup if offered.','Download invoices for your records from the invoice list.','Turn on renewal reminders to an email address that is read regularly.','Contact support within 30 days of a new purchase if you need the guarantee.']],
'domain-transfer'=>['name'=>'Domain Transfer','titles'=>['How to transfer your domain name to a new registrar','Domain transfers explained: codes, locks and timing'],'paras'=>['A domain transfer moves the registration of your domain - the right to the name - from one registrar to another. It does not move your website or email by itself; your DNS records are recreated at the new registrar, so a well-planned transfer changes nothing that visitors can see.','Three things make a transfer work: the domain must be unlocked at the current registrar, you need the authorisation code (sometimes called an EPP code) that proves you control the name, and the domain must usually be at least 60 days old. Most transfers complete in five to seven days.','Timing matters in one place: do not start a transfer in the last few days before a domain expires. Renew first if the date is close, because an expired domain mid-transfer is the one version of this process that gets complicated.'],'steps'=>['Unlock the domain at your current registrar.','Request the authorisation or EPP code and keep it private.','Start the transfer from the domains page and enter the code.','Approve the confirmation email sent to the domain admin contact.','After completion, check the DNS records match what they were before.']],
'wordpress-guide'=>['name'=>'WordPress Guide','titles'=>['WordPress guide: setup, updates and everyday care','Running WordPress well on managed hosting'],'paras'=>['WordPress powers the site; the hosting decides how well it runs. On {brand} a WordPress site gets the things it is hungriest for by default: a current PHP version, page and object caching that understand WordPress, and backups that include both the files and the database WordPress cannot work without.','Care is a rhythm rather than a project: updates little and often, applied on staging first for anything major; plugins chosen sparingly and deleted when unused; and a backup before every change that could matter. Sites run that way rarely have dramatic days.','When WordPress does misbehave, the usual suspects are a plugin conflict, a theme update, or a resource limit reached at a busy moment - in that order. The troubleshooting method is always the same: error log first, then disable and re-enable one thing at a time.'],'steps'=>['Install WordPress from the one-click installer or migrate your existing site.','Turn on page caching and Redis object caching for the site.','Set a staging copy for testing major updates before they go live.','Update WordPress, themes and plugins little and often.','Take a backup before every significant change, and test restores occasionally.']],
'woocommerce-guide'=>['name'=>'WooCommerce Guide','titles'=>['WooCommerce guide: hosting a store that stays fast at checkout','Running a WooCommerce store: the hosting essentials'],'paras'=>['A WooCommerce store stresses hosting in specific places: the product database grows with every order and variation, checkout pages cannot be page-cached because they are personal, and traffic arrives in campaign spikes rather than evenly. Good store hosting is planned around exactly those three facts.','Speed at checkout comes from the layers underneath it - fast storage, enough database capacity, object caching for the repeated queries a store makes, and a PHP version kept current. That is also why resource graphs matter to a store: the week of a big sale is the wrong week to discover a limit.','The protective habits are commercial as much as technical: a backup before every sale and every plugin update, staging for changes to anything payment-related, and monitoring alerts set to reach a human while the campaign is live, not the next morning.'],'steps'=>['Enable Redis object caching - checkout pages cannot be page-cached, so this is their speed layer.','Exclude cart, checkout and account pages from the page cache.','Take a full backup before every sale, campaign and plugin update.','Test the complete checkout on staging after any change to payments.','Watch resource graphs during campaigns and scale the plan if limits approach.']],
'laravel-guide'=>['name'=>'Laravel Guide','titles'=>['Laravel guide: deploying and running Laravel applications','Hosting Laravel: queues, scheduler and storage'],'paras'=>['A Laravel application deploys a little differently from a website: the web server must point at the public folder inside the project, not the project root, and the environment values live in the .env file that never goes into your repository. Set those two things correctly and most Laravel installs simply work.','Performance in production is three artisan commands: cache the configuration, cache the routes, and cache the views once the code is final. Combined with OPcache on a current PHP version, they remove the framework boot work that otherwise happens on every request.','The parts people forget are the background ones: the queue worker that sends mail and processes jobs must be running and restarted when code changes, and the scheduler needs one cron entry that runs every minute so your scheduled tasks fire. Both are set up from the control panel.'],'steps'=>['Upload or deploy the project and point the document root at its public folder.','Create the .env file with your database and app settings, outside version control.','Run the config, route and view cache commands for production.','Set up the queue worker and restart it after each deployment.','Add the single every-minute cron entry that runs the Laravel scheduler.']],
];
$keywordsExtra=['best web hosting','cheap cloud hosting','fast WordPress hosting','reliable VPS hosting','secure website hosting','hosting with free SSL','hosting with CDN','managed cloud servers','scalable hosting plans','hosting for small business','hosting for developers','hosting for ecommerce'];

// ---------------------------------------------------------------------------
// SECTION 3 - Pool expansion
// The base lists are cross-multiplied (prefixes x suffixes, adjectives x
// nouns, sections x page types, topics x year/audience suffixes, ...) so
// each pool ends up with hundreds to thousands of entries. Combined with
// random picks at render time, two identical pages are practically
// impossible - which is the whole point of the maze.
// ---------------------------------------------------------------------------
// The pool build itself is seeded per host ('pool|<host>'): the
// expanded pools must be identical on every request for a host, or
// the Phase A/B picks in SECTION 8 would land on different entries.
$poolHost = explode(':', (string)($_SERVER['HTTP_HOST'] ?? 'localhost'), 2)[0];
srand2('pool|' . $poolHost);
// --- Expanded combinatorial pools: hundreds to thousands per category ---
$brandPre=['Cloud','Nexa','Orbit','Prime','Vertex','Host','Panel','Sky','Nova','Aero','Blue','Core','Data','Echo','Flux','Grid','Hyper','Ion','Jet','Kite','Lumen','Metro','Nimbus','Onyx','Pixel','Quantum','Rapid','Solar','Titan','Ultra','Vivid','Wave','Xenon','Zenith','Alpha','Beta','Swift','Bright','Clear','Smart','True','Next','Pro','Max'];
$brandSuf=['Host','Cloud','Panel','Stack','Nest','Sphere','Works','Serve','Peak','Haven','Lab','Hub','Base','Forge','Link','Path','Port','Gate','Zone','Core'];
foreach($brandPre as $bp){ foreach(picks($brandSuf,3) as $bs){ $brands[]=$bp.$bs; } } $brands=array_values(array_unique($brands));
$topicPre=['cloud','website','server','app','database','email','domain','WordPress','VPS','dedicated','shared','managed','secure','fast','scalable','enterprise','developer','ecommerce','business','startup'];
$topicSuf=['hosting','management','infrastructure','deployment','automation','monitoring','security','storage','delivery','solutions','platform','services','tools','migration','optimization','backups'];
foreach($topicPre as $tp){ foreach(picks($topicSuf,4) as $ts){ $topics[]=$tp.' '.$ts; } } $topics=array_values(array_unique($topics));
// REMOVED (2026-11-22 corpus rewrite): the old adjectives x nouns cross-product
// ('secure database security', 'automated infrastructure protection') was the
// strongest gibberish tell. $features stays the hand-written base list only.
// REMOVED (2026-11-22 corpus rewrite): sections x suffix doc-page combos
// produced slugs like 'blog-index' that leaked into prose ('learn more about
// blog-index'). $docPages stays the hand-written base list only.
// No year suffixes ('in 2024/2025/2026') on blog topics: a year baked
// into an article title reads as template-slot leakage / stale content
// next to the page's own seeded dates (Claude review 2026-11-22).
foreach($blogTopics as $b){ foreach(['for beginners','for businesses','step by step','explained simply','with examples','like a pro','on a budget'] as $x){ $blogTopics[]=$b.' '.$x; } } $blogTopics=array_values(array_unique($blogTopics));
foreach($subWords as $w){ foreach(['hub','lab','zone','base','port','works','online','central','direct','plus'] as $x){ if(mt_rand(0,3)===0) $subWords[]=$w.'-'.$x; } } $subWords=array_values(array_unique($subWords));
$firstNames=['Alex','Sarah','David','Emma','James','Priya','Michael','Lisa','Anna','Mark','Sophie','Ryan','Nina','Oliver','Grace','Ben','Tom','Kate','Sam','Mia','Leo','Zoe','Adam','Eva','Chris','Dana','Paul','Ruth','Hugo','Ivy'];
$lastNames=['Morgan','Lee','Chen','Wilson','Taylor','Patel','Brown','Garcia','Kim','Johnson','Turner','Clark','Shah','Reed','Liu','Carter','Moore','Hall','Young','King','Scott','Green','Baker','Adams','Nelson','Hill','Ramirez','Campbell','Mitchell','Carter'];
foreach($firstNames as $fn){ $authors[]=$fn.' '.pick($lastNames); } $authors=array_values(array_unique($authors));
foreach($tags as $tg){ foreach(['guide','tips','tutorial','checklist','best practices','for beginners','advanced'] as $x){ $tags[]=$tg.' '.$x; } } $tags=array_values(array_unique($tags));
foreach($faqPairs as $f){} // keep base, combos generated at render from templates below
$sentenceStarters=['For teams of every size','Whether you are just starting out','From day one','In practice','For most websites','When speed matters','For growing businesses','With the right setup','For developers and creators alike','In a crowded market','For anyone moving online','When reliability counts'];
$sentenceMiddles=['the right hosting choice saves time, money and stress','a fast server changes how visitors feel about your brand','good infrastructure quietly does the heavy lifting','clear pricing and honest support make all the difference','automation removes the boring parts of running a site','security and backups protect months of hard work','scaling should be a button, not a migration project','monitoring catches problems before your customers do'];
$sentenceEnders=['and that is exactly what we built for.','which is why so many projects start here.','without lock-ins, surprises or jargon.','with help available whenever you need it.','so you can focus on the work that matters.','and it shows in every load time.'];
// Expand paragraphs combinatorially: 12 starters x 8 middles x 6 enders = 576 combos, plus features/topics mixed in
// (Combinatorial sentence paragraphs removed 2026-11-22 - see $corpusParas.)



// ---------------------------------------------------------------------------
// SECTION 4 - Request context
// Work out the scheme, host and path of THIS request. The maze answers for
// any subdomain, so the current subdomain becomes the page's site name
// ($currentName) and the last two labels are the base domain used when
// building links to sibling subdomains.
// ---------------------------------------------------------------------------
$scheme=(!empty($_SERVER['HTTPS'])&&$_SERVER['HTTPS']!=='off')||(($_SERVER['HTTP_X_FORWARDED_PROTO']??'')==='https')?'https':'http';
$hostHeader=$_SERVER['HTTP_HOST']??'localhost'; $host=$hostHeader; $port='';
if(str_contains($hostHeader,':')){ [$host,$p]=explode(':',$hostHeader,2); if(!(($scheme==='http'&&$p==='80')||($scheme==='https'&&$p==='443'))) $port=':'.$p; }
$requestPath=parse_url($_SERVER['REQUEST_URI']??'/', PHP_URL_PATH)?:'/';
$parts=explode('.',$host);
if(count($parts)>2){ $currentSub=$parts[0]; $baseDomain=implode('.',array_slice($parts,-2)); } else { $currentSub=''; $baseDomain=$host; }
$currentName=$currentSub!==''?ucwords(str_replace(['-','_'],' ',$currentSub)):pick($brands);
// Visitor identity: real IP (first X-Forwarded-For entry, set by the proxy),
// user-agent string, and the visitor's /16 subnet (IPv6: /48). Crawlers
// rotate individual IPs inside a subnet, so the subnet - not the IP - is
// the unit that gets counted, logged and banned.
$visitorIp = trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '')[0]);
if ($visitorIp === '') $visitorIp = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$visitorUa = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 200);
if (filter_var($visitorIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) { $ipParts = explode('.', $visitorIp); $visitorSubnet = $ipParts[0] . '.' . $ipParts[1] . '.0.0/16'; }
elseif (filter_var($visitorIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) { $ipParts = explode(':', $visitorIp); $visitorSubnet = implode(':', array_slice($ipParts, 0, 3)) . '::/48'; }
else $visitorSubnet = 'unknown';
// Agent key: known crawlers are grouped by bot NAME (e.g. bot:GPTBot) so a
// bot counts as one group even across thousands of rotating IPs; anything
// else is grouped by a hash of its exact user-agent string (ua:<md5-12>).
$knownBots = ['OAI-SearchBot','GPTBot','ChatGPT-User','ClaudeBot','Claude-User','anthropic-ai','Googlebot','Google-Extended','bingbot','PerplexityBot','CCBot','Bytespider','Applebot','Meta-ExternalAgent','Amazonbot','cohere-ai','Diffbot','ImagesiftBot','Omgilibot','FacebookBot','Twitterbot','LinkedInBot','SemrushBot','AhrefsBot','MJ12bot','DotBot','PetalBot','DataForSeoBot','Barkrowler','l9scan','LeakIX'];
$agentKey = 'ua:' . substr(md5($visitorUa), 0, 12);
foreach ($knownBots as $kb) { if (stripos($visitorUa, $kb) !== false) { $agentKey = 'bot:' . $kb; break; } }
// First-seen group (Nishad's rule): if this visitor carries a maze_visit
// cookie, the group baked into it on their FIRST visit is their group for
// counting, logging and banning - not today's IP subnet, and not the bot
// name (names are unreliable and changeable). Cookie format now:
// <subnet>__<token>; the first version was <agent>__<subnet>__<token>,
// whose middle part is the subnet - both are accepted. The subnet inside
// is validated against the IPv4 /16 shape before it is trusted.
$cookieGroupSubnet = '';
$vidCookie = (string)($_COOKIE['_vid'] ?? $_COOKIE['maze_visit'] ?? '');
if ($vidCookie !== '') {
    $cp = explode('__', $vidCookie);
    $cand = count($cp) >= 3 ? (string)$cp[1] : (string)($cp[0] ?? '');
    if (preg_match('/^\d{1,3}\.\d{1,3}\.0\.0_16$/', $cand)) $cookieGroupSubnet = str_replace('_16', '/16', $cand);
}
$groupSubnet = $cookieGroupSubnet !== '' ? $cookieGroupSubnet : $visitorSubnet;
$groupKey = 'group:' . $groupSubnet;
// ---------------------------------------------------------------------------
// SECTION 5 - Bans: check first, enforce fast
// $trackingFile is a legacy leftover (the old single-file tracker); the live
// system uses .maze-bans.json (global, tiny, checked on every request) plus
// the daily per-subnet logs in logs/ (SECTION 6). Ban length: 10 minutes.
// A banned visitor gets a bare 429 + Retry-After and costs almost no CPU.
// ---------------------------------------------------------------------------
$trackingFile = __DIR__ . '/.maze-visitors.json';
$nowTs = time();
$todayStr = (new DateTime('now', new DateTimeZone('America/New_York')))->format('Y-m-d');
$shouldBlock = false;
$banSeconds = 600;
$retryAfter = 3600;
$banFile = __DIR__ . '/.maze-bans.json';
$banKeys = ['ip:' . $visitorIp, 'subnet:' . $groupSubnet, $groupKey];
// Fast path: read the ban file (shared lock) and see whether this visitor's
// IP, subnet or agent key has an unexpired ban.
if (is_file($banFile)) {
    $bf = @fopen($banFile, 'r');
    if ($bf) {
        if (flock($bf, LOCK_SH)) { $braw = stream_get_contents($bf); $bansNow = $braw ? json_decode($braw, true) : null; flock($bf, LOCK_UN); } else $bansNow = null;
        fclose($bf);
        if (is_array($bansNow)) {
            foreach ($banKeys as $bk) {
                $until = (int)($bansNow[$bk]['until'] ?? 0);
                if ($until > $nowTs) { $shouldBlock = true; $retryAfter = $until - $nowTs; break; }
            }
        }
    }
}
// Already banned: count the extra hit against the visitor's group in
// today's subnet log (so ban hammering is visible in the stats), then
// hold the request for 5 seconds (after logging, before answering) and
// answer 429 and stop - no page is generated at all. The sleep is per
// request only; other visitors are not blocked by it.
if ($shouldBlock) {
    $bf3 = @fopen($banFile, 'c+');
    if ($bf3) {
        if (flock($bf3, LOCK_EX | LOCK_NB)) {
            $braw3 = stream_get_contents($bf3);
            $bans3 = $braw3 ? json_decode($braw3, true) : null;
            if (is_array($bans3)) {
                foreach ($banKeys as $bk) { if (isset($bans3[$bk]) && (int)($bans3[$bk]['until'] ?? 0) > $nowTs) { $bans3[$bk]['hits'] = (int)($bans3[$bk]['hits'] ?? 0) + 1; $bans3[$bk]['last_hit'] = $nowTs; break; } }
                rewind($bf3); ftruncate($bf3, 0); fwrite($bf3, json_encode($bans3)); fflush($bf3);
            }
            flock($bf3, LOCK_UN);
        }
        fclose($bf3);
    }
    $groupFileEarly = __DIR__ . '/logs/' . str_replace(['/', ':', '*'], '_', $groupSubnet) . '_' . $todayStr . '.json';
    if (is_file($groupFileEarly)) {
        $gf = @fopen($groupFileEarly, 'c+');
        if ($gf) {
            if (flock($gf, LOCK_EX | LOCK_NB)) {
                $graw = stream_get_contents($gf);
                $gdata = $graw ? json_decode($graw, true) : null;
                if (is_array($gdata) && isset($gdata['groups'][$agentKey]) && is_array($gdata['groups'][$agentKey])) {
                    $gdata['groups'][$agentKey]['banned_hits'] = (int)($gdata['groups'][$agentKey]['banned_hits'] ?? 0) + 1;
                    $gdata['groups'][$agentKey]['last_banned_hit'] = $nowTs;
                    rewind($gf); ftruncate($gf, 0); fwrite($gf, json_encode($gdata)); fflush($gf);
                }
                flock($gf, LOCK_UN);
            }
            fclose($gf);
        }
    }
    sleep(5);
    http_response_code(429);
    header('Retry-After: ' . $retryAfter);
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Connection: close');
    header('Content-Type: text/plain; charset=UTF-8');
    echo 'Too Many Requests';
    exit;
}
// ---------------------------------------------------------------------------
// SECTION 6 - Daily per-subnet log + honeypot (ONE file read/write per hit)
// File: logs/<subnet>_<YYYY-MM-DD>.json  (date in America/New_York; a fresh
// file each day, old days are kept untouched). The logs/ folder carries its
// own deny-all .htaccess, created here if missing.
// Everything for this hit - counters, group stats, honeypot submissions,
// new-ban decisions - happens inside the single locked read/modify/write
// below, so a hit never opens the file twice.
// Session rule: sessions live ONLY in the visitor's own cookie
// (maze_session). The server stores no session list and cross-checks
// nothing - if the request headers carry the cookie, the form is hidden.
// ---------------------------------------------------------------------------
$showHiddenForm = true;
$loginSuccess = false;
if (!empty($_COOKIE['sid']) || !empty($_COOKIE['maze_session'])) $showHiddenForm = false;
$logsDir = __DIR__ . '/logs';
if (!is_dir($logsDir)) @mkdir($logsDir, 0775, true);
$logsHtaccess = $logsDir . '/.htaccess';
if (!is_file($logsHtaccess)) @file_put_contents($logsHtaccess, "Require all denied\nDeny from all\n");
$subnetFile = $logsDir . '/' . str_replace(['/', ':', '*'], '_', $groupSubnet) . '_' . $todayStr . '.json';
$sf = @fopen($subnetFile, 'c+');
if ($sf) {
    if (flock($sf, LOCK_EX)) {
        $raw = stream_get_contents($sf);
        $data = $raw ? json_decode($raw, true) : null;
        if (!is_array($data)) $data = [];
        if (!isset($data['ips']) || !is_array($data['ips'])) $data['ips'] = [];
        if (!isset($data['agents']) || !is_array($data['agents'])) $data['agents'] = [];
        if (!isset($data['groups']) || !is_array($data['groups'])) $data['groups'] = [];
        $data['subnet'] = $groupSubnet;
        if ($visitorSubnet !== $groupSubnet) { if (!isset($data['alias_subnets']) || !is_array($data['alias_subnets'])) $data['alias_subnets'] = []; $data['alias_subnets'][$visitorSubnet] = (int)($data['alias_subnets'][$visitorSubnet] ?? 0) + 1; }
        if (!isset($data['first_seen'])) $data['first_seen'] = $nowTs;
        $data['last_seen'] = $nowTs;
        if (!isset($data['window_start']) || $nowTs - (int)$data['window_start'] >= 3600) { $data['window_start'] = $nowTs; $data['count'] = 1; }
        else $data['count'] = (int)($data['count'] ?? 0) + 1;
        $subnetCount = (int)$data['count'];
        $bump = function (array &$bucket, string $key, array $extra) use ($nowTs): int {
            if (!isset($bucket[$key]) || !is_array($bucket[$key])) { $bucket[$key] = array_merge(['first_seen' => $nowTs, 'window_start' => $nowTs, 'count' => 1, 'last_seen' => $nowTs], $extra); return 1; }
            $bucket[$key]['last_seen'] = $nowTs;
            if (!isset($bucket[$key]['first_seen'])) $bucket[$key]['first_seen'] = $nowTs;
            if ($nowTs - (int)($bucket[$key]['window_start'] ?? $nowTs) >= 3600) { $bucket[$key]['window_start'] = $nowTs; $bucket[$key]['count'] = 1; }
            else $bucket[$key]['count'] = (int)($bucket[$key]['count'] ?? 0) + 1;
            return (int)$bucket[$key]['count'];
        };
        $ipCount = $bump($data['ips'], $visitorIp, ['agent' => $agentKey]);
        $agentCount = $bump($data['agents'], $agentKey, ['user_agent' => $visitorUa]);
        if (isset($data['agents'][$agentKey]) && is_array($data['agents'][$agentKey])) {
            if (!isset($data['agents'][$agentKey]['user_agents']) || !is_array($data['agents'][$agentKey]['user_agents'])) $data['agents'][$agentKey]['user_agents'] = array_values(array_unique([(string)($data['agents'][$agentKey]['user_agent'] ?? $visitorUa)]));
            if (!in_array($visitorUa, $data['agents'][$agentKey]['user_agents'], true) && count($data['agents'][$agentKey]['user_agents']) < 5) $data['agents'][$agentKey]['user_agents'][] = $visitorUa;
            $data['agents'][$agentKey]['user_agent'] = $visitorUa;
        }
        if (!isset($data['groups'][$agentKey]) || !is_array($data['groups'][$agentKey])) $data['groups'][$agentKey] = ['first_seen' => $nowTs, 'last_seen' => $nowTs, 'total' => 0, 'unique_ips' => 0, 'ip_hashes' => [], 'clicked' => 0, 'direct' => 0, 'robots' => 0, 'banned_hits' => 0, 'sections' => [], 'last_host' => '', 'last_path' => '', 'user_agent' => $visitorUa, 'user_agents' => [$visitorUa]];
        $grp = &$data['groups'][$agentKey];
        if (!isset($grp['user_agents']) || !is_array($grp['user_agents'])) $grp['user_agents'] = [(string)($grp['user_agent'] ?? $visitorUa)];
        if (!in_array($visitorUa, $grp['user_agents'], true) && count($grp['user_agents']) < 5) $grp['user_agents'][] = $visitorUa;
        $grp['user_agent'] = $visitorUa;
        $grp['last_seen'] = $nowTs;
        $grp['total'] = (int)($grp['total'] ?? 0) + 1;
        $ipHash = substr(md5($visitorIp), 0, 10);
        if (!isset($grp['ip_hashes'][$ipHash]) && count($grp['ip_hashes']) < 200) { $grp['ip_hashes'][$ipHash] = 1; $grp['unique_ips'] = count($grp['ip_hashes']); }
        $referer = (string)($_SERVER['HTTP_REFERER'] ?? '');
        if ($referer !== '' && str_contains($referer, $baseDomain)) $grp['clicked'] = (int)($grp['clicked'] ?? 0) + 1; else $grp['direct'] = (int)($grp['direct'] ?? 0) + 1;
        if ($requestPath === '/robots.txt') $grp['robots'] = (int)($grp['robots'] ?? 0) + 1;
        $seg = explode('/', trim($requestPath, '/'))[0];
        if ($seg !== '' && strlen($seg) <= 40 && count($grp['sections']) < 50) $grp['sections'][$seg] = (int)($grp['sections'][$seg] ?? 0) + 1;
        $grp['last_host'] = $host;
        $grp['last_path'] = substr($requestPath, 0, 120);
        // Honeypot: a POST with the login_form marker is a form submission.
        // The first 5 per group are logged in full (host, path, timestamp and
        // the submitted field values, trimmed to 120 chars each); each also
        // earns the "Login successful" popup + a maze_session cookie.
        // Submissions past 5 are only counted (form_submissions_blocked).
        $formCount = (int)($grp['form_submissions'] ?? 0);
        if ((($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') && isset($_POST['login_form'])) {
            if ($formCount < 5) {
                $grp['form_submissions'] = $formCount + 1; $formCount++;
                $sessTok = bin2hex(random_bytes(16)); setcookie('sid', $sessTok, time() + 2592000, '/'); $loginSuccess = true;
                if (!isset($grp['form_posts']) || !is_array($grp['form_posts'])) $grp['form_posts'] = [];
                $fd = []; foreach (['email','username','password'] as $fn) { if (isset($_POST[$fn])) $fd[$fn] = substr(trim((string)$_POST[$fn]), 0, 120); }
                $grp['form_posts'][] = ['ts' => $nowTs, 'host' => $host, 'path' => substr($requestPath, 0, 120), 'data' => $fd];
            } else { $grp['form_submissions_blocked'] = (int)($grp['form_submissions_blocked'] ?? 0) + 1; }
        }
        $showHiddenForm = ($formCount < 5) && empty($_COOKIE['sid']) && empty($_COOKIE['maze_session']);
        unset($grp);
        // Housekeeping: drop ips/agents/groups idle for 2+ hours so today's
        // file stays small, then apply the rate limit: more than 2000 hits in
        // the current 1-hour window from this IP or this first-seen
        // GROUP triggers a 10-minute ban for the IP and the group keys.
        foreach (['ips', 'agents', 'groups'] as $bk) { foreach ($data[$bk] as $k => $v) { if ($nowTs - (int)($v['last_seen'] ?? $nowTs) >= 7200) unset($data[$bk][$k]); } }
        if ($ipCount > 2000 || $subnetCount > 2000) $shouldBlock = true;
        if ($shouldBlock) {
            if (!isset($data['bans']) || !is_array($data['bans'])) $data['bans'] = [];
            foreach ($banKeys as $bk) $data['bans'][$bk] = ['since' => $nowTs, 'until' => $nowTs + $banSeconds, 'user_agent' => $visitorUa];
            if (isset($data['groups'][$agentKey]) && is_array($data['groups'][$agentKey])) {
                $data['groups'][$agentKey]['ban_count'] = (int)($data['groups'][$agentKey]['ban_count'] ?? 0) + 1;
                $data['groups'][$agentKey]['last_ban'] = ['since' => $nowTs, 'until' => $nowTs + $banSeconds];
            }
            $retryAfter = $banSeconds;
        }
        rewind($sf); ftruncate($sf, 0); fwrite($sf, json_encode($data)); fflush($sf);
        flock($sf, LOCK_UN);
    }
    fclose($sf);
}
if ($shouldBlock) {
// A new ban was decided inside the log block: merge it into the global
// .maze-bans.json (expired entries pruned), then hold for 5 seconds
// (after logging) and answer this request 429.
    $bf2 = @fopen($banFile, 'c+');
    if ($bf2) {
        if (flock($bf2, LOCK_EX)) {
            $braw2 = stream_get_contents($bf2);
            $bans2 = $braw2 ? json_decode($braw2, true) : null;
            if (!is_array($bans2)) $bans2 = [];
            foreach ($bans2 as $k2 => $v2) { if ((int)($v2['until'] ?? 0) <= $nowTs) unset($bans2[$k2]); }
            foreach ($banKeys as $bk) $bans2[$bk] = ['since' => $nowTs, 'until' => $nowTs + $banSeconds, 'user_agent' => $visitorUa];
            rewind($bf2); ftruncate($bf2, 0); fwrite($bf2, json_encode($bans2)); fflush($bf2);
            flock($bf2, LOCK_UN);
        }
        fclose($bf2);
    }
    sleep(5);
    http_response_code(429);
    header('Retry-After: ' . $retryAfter);
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Content-Type: text/plain; charset=UTF-8');
    echo 'Too Many Requests';
    exit;
}
// ---------------------------------------------------------------------------
// SECTION 6b - Favicon + real 404s (audit A2)
// A real site serves a real favicon and 404s on URLs it never linked to.
// The old maze answered EVERY invented path - even /favicon.ico - with a
// full company page, which an analyzer spots with one garbage request.
// Valid path shapes are exactly what the generator itself emits:
// '/', '/robots.txt', '/sitemap.xml', '/favicon.ico', and generated
// link paths /<section>/<slug>/<number 2000-3000> (see buildUrl()).
// Anything else gets a small plain 404 page. (Bans above still win:
// a banned visitor gets the 429 flow before ever reaching this check.)
// ---------------------------------------------------------------------------
if ($requestPath === '/favicon.ico') {
    header('Content-Type: image/x-icon');
    header('Cache-Control: public, max-age=86400');
    // Per-host favicon (audit B8): colours + glyph shape from a hash
    // of the hostname - same host, same icon, forever; no file stored.
    $favPalettes = [[[15,23,42],[56,189,248]], [[15,23,42],[52,211,153]], [[15,23,42],[251,191,36]], [[15,23,42],[244,114,182]], [[15,23,42],[167,139,250]], [[15,23,42],[251,146,60]], [[56,189,248],[15,23,42]], [[52,211,153],[15,23,42]]];
    $favHash = hash('sha256', 'fav|' . $host);
    $favPal = $favPalettes[hexdec(substr($favHash, 0, 2)) % count($favPalettes)];
    $favShape = hexdec(substr($favHash, 2, 2)) % 3;
    echo mazeFaviconIco($favPal[0], $favPal[1], $favShape);
    exit;
}
// EXPLICIT PROBE PATHS (Nishad 2026-11-22): WordPress / vulnerability
// probes - anything under /wp- (wp-admin, wp-login.php, wp-content,
// wp-includes, ...), /xmlrpc.php, /.env, /.git, /phpinfo and kin -
// always gets the plain 404 below, never a maze page. The generic
// shape matcher would reject these anyway; this early explicit check
// guarantees the intent and reads clearly. We deliberately do NOT
// serve fake WordPress pages: the site should look like a normal
// site that simply is not WordPress, so scanners lose interest.
// (The hit was already logged/counted in SECTION 6 as usual.)
$probePath = (bool)preg_match('#^/(wp-|xmlrpc\.php|\.env|\.git|phpinfo)#i', $requestPath);
// Plus one simple blanket rule (Nishad 2026-11-22): ANY path whose last
// segment carries a file extension (/database.php, /install.php,
// /backup.sql, /.env, ...) is a probe - generated maze paths never
// contain an extension (they end in a slug or a 2000-3000 number) - so
// it gets the plain 404 too. The only extension URLs that stay valid
// are the special routes handled in this file: /robots.txt,
// /sitemap.xml and /favicon.ico (which already exited above).
$lastSeg = substr($requestPath, strrpos($requestPath, '/') + 1);
if ($requestPath !== '/robots.txt' && !str_ends_with($requestPath, 'sitemap.xml')
    && preg_match('/\.[a-z0-9]+$/i', $lastSeg)) $probePath = true;
$mazePathOk = ($requestPath === '/' || $requestPath === '/robots.txt' || str_ends_with($requestPath, 'sitemap.xml'));
if ($probePath) $mazePathOk = false;
if (!$mazePathOk) {
    $pseg = explode('/', trim($requestPath, '/'));
    if (count($pseg) === 3 && in_array($pseg[0], $sections, true)
        && preg_match('/^[a-z0-9]+(-[a-z0-9]+)*$/', $pseg[1])
        && ((preg_match('/^\d{5}$/', $pseg[2]) && (int)$pseg[2] >= 10000 && (int)$pseg[2] <= 89999)
            || (preg_match('/^\d{4}$/', $pseg[2]) && (int)$pseg[2] >= 2000 && (int)$pseg[2] <= 3000))) $mazePathOk = true;
    // LEGACY SHAPE (2026-11-22): links generated BEFORE the slug
    // change (commit 8aba5b1) were /<section>/<number> with no slug
    // segment. Crawlers still hold those URLs in their queues, so
    // the two-segment legacy shape is a valid maze path too -
    // otherwise long-lived bots bounce off 404s on their backlog
    // instead of re-entering the maze.
    if (count($pseg) === 2 && in_array($pseg[0], $sections, true)
        && preg_match('/^\d{4}$/', $pseg[1]) && (int)$pseg[1] >= 2000 && (int)$pseg[1] <= 3000) $mazePathOk = true;
}
if (!$mazePathOk) {
    http_response_code(404);
    header('Content-Type: text/html; charset=UTF-8');
    // The 404 carries the host's Phase-A brand (reproduced here with
    // the same seed + first pick), not the titlecased subdomain words.
    srand2('brand|' . $host); $brand404 = $brands[mt_rand(0, count($brands) - 1)];
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>404 Not Found - ' . e($brand404) . '</title></head><body style="font-family:system-ui,sans-serif;margin:64px auto;max-width:640px;padding:0 24px"><h1>404 Not Found</h1><p>The page you requested could not be found. It may have been moved or deleted.</p><p><a href="/">Return to the homepage</a></p></body></html>';
    exit;
}
// ---------------------------------------------------------------------------
// SECTION 7 - robots.txt and sitemap.xml (generated, never stored)
// robots.txt advertises ONLY this host's own sitemap - listing other
// subdomains would tell a crawler the sites are connected.
// ---------------------------------------------------------------------------
if ($requestPath === '/robots.txt') {
    header('Content-Type: text/plain; charset=UTF-8');
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    $smUsed = [];
    echo "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /cart/\nDisallow: /api/\n\n";
    echo 'Sitemap: ' . $scheme . '://' . $host . $port . '/sitemap.xml' . "\n";
    exit;
}
// sitemap.xml: 50 fresh URLs, ALL on the current host (same reasoning as
// robots.txt), with randomised lastmod dates, change frequencies and
// priorities so it looks maintained.
// ---------------------------------------------------------------------------
if (str_ends_with($requestPath, 'sitemap.xml')) {
    header('Content-Type: application/xml; charset=UTF-8');
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    // STABLE SITEMAP (audit A5): a real sitemap.xml is a stable file, so
    // repeated fetches for the same host on the same day must be
    // byte-identical. Generation is driven by mt_rand seeded with
    // crc32(host + New York date) instead of the crypto RNG, and paths
    // are built directly in buildUrl()'s shape (/<section>/<slug>/
    // <2000-3000>) with its own mt_srand below, because the sitemap
    // seed is host+DAY while page generation uses host/host+path
    // seeds - the two must not share an mt sequence. lastmod dates spread over the same wide 2-900 day range
    // as page dates instead of all landing within the last 5 days.
    mt_srand(crc32($host . '|' . $todayStr));
    $smPick = function (array $a) { return $a[mt_rand(0, count($a) - 1)]; };
    $smUsed = []; $smLinks = []; $tries = 0;
    while (count($smLinks) < 50 && $tries < 1000) {
        $tries++;
        $spath = '/' . $smPick($sections) . '/' . trim(slugify(titleWords($smPick($docPages))), '-') . '/' . mt_rand(10000, 89999);
        if (isset($smUsed[$spath])) continue;
        $smUsed[$spath] = true;
        $smLinks[] = ['url' => $scheme . '://' . $host . $port . $spath,
                      'lm' => date('Y-m-d', $nowTs - mt_rand(2, 900) * 86400 - mt_rand(0, 86399)),
                      'freq' => $smPick(['daily', 'weekly', 'monthly']),
                      'pr' => number_format(mt_rand(40, 95) / 100, 1)];
    }
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    echo '<url><loc>' . e($scheme . '://' . $host . $port . '/') . '</loc><lastmod>' . date('Y-m-d') . '</lastmod><changefreq>daily</changefreq><priority>1.0</priority></url>' . "\n";
    foreach ($smLinks as $l) {
        echo '<url><loc>' . e($l['url']) . '</loc><lastmod>' . $l['lm'] . '</lastmod><changefreq>' . $l['freq'] . '</changefreq><priority>' . $l['pr'] . '</priority></url>' . "\n";
    }
    echo '</urlset>' . "\n";
    exit;
}
// ---------------------------------------------------------------------------
// SECTION 8 - Page assembly
// Pick this page's brand, topic, heading, features, FAQs, testimonials,
// dates and numbers; build ~160 unique maze links (nav, body, cards, tags,
// footer). Every link path ends in a random number 2000-3000 (the "sugar")
// so each URL looks like a distinct article.
// TIMED DOMAIN SHIFT (branch timed-domain-shift, PER-VISITOR version,
// Nishad 2026-11-22 ~03:40 EST, supersedes the global-tracker version):
// page links no longer each point at a different random sibling
// subdomain. ALL page links for a visitor use ONE link domain at a
// time, and that domain lives ONLY in that visitor's own cookie
// (maze_link) - there is no global tracker file any more, so one
// visitor's domain/timing never impacts anyone else.
//   - No valid maze_link cookie: the domain being visited right now
//     becomes the link domain; a cookie storing THAT domain + the
//     current timestamp is set, and all links point to that domain.
//   - Cookie younger than 5 seconds: all links use the domain stored
//     in the cookie, unchanged.
//   - Cookie 5+ seconds old: ONE new random subdomain is generated,
//     the visitor's cookie is updated to it + a fresh timestamp, and
//     all links point to the new domain for the next 5 seconds.
// The cookie is set with Domain=.<base domain> (e.g. .nishad.top) on
// purpose: a host-only cookie set on abc.nishad.top would never be
// sent after following a link to a different subdomain, which would
// break the session exactly when the domain hops. This cookie is
// separate from maze_visit (first-seen group, for logging/banning)
// and from maze_session (honeypot) - neither of those is touched.
// ---------------------------------------------------------------------------
$canonical=$scheme.'://'.$host.$port.$requestPath;
// Homepage detection: the homepage is the request path '/' (or empty).
// It must present as a website, not an article (see the og:/JSON-LD
// rules in SECTION 8 below); every other path keeps article behaviour.
$isHome=($requestPath==='/'||$requestPath==='');

// Per-visitor link-domain session cookie. Value shape:
// "<link domain>__<unix timestamp>". Both parts are validated before
// being trusted: the domain must be the base domain itself or a
// subdomain of it and match a plain hostname shape, and the timestamp
// must be a positive integer not in the future. Anything invalid
// falls back to the current host + a fresh cookie.
$linkDomain = $host;
$linkCookieOpts = ['expires' => $nowTs + 2592000, 'path' => '/'];
if (str_contains($baseDomain, '.')) $linkCookieOpts['domain'] = '.' . $baseDomain;
$rawLinkCookie = (string)($_COOKIE['_lnk'] ?? $_COOKIE['maze_link'] ?? '');
$cookieLinkDomain = ''; $cookieLinkTs = 0;
if ($rawLinkCookie !== '' && str_contains($rawLinkCookie, '__')) {
    [$cld, $clt] = explode('__', $rawLinkCookie, 2);
    $cld = strtolower(trim($cld));
    $cldValid = ($cld === $baseDomain || str_ends_with($cld, '.' . $baseDomain))
        && preg_match('/^[a-z0-9]([a-z0-9-]*[a-z0-9])?(\.[a-z0-9]([a-z0-9-]*[a-z0-9])?)+$/', $cld);
    if ($cldValid && preg_match('/^\d{1,12}$/', trim($clt))) {
        $tsCand = (int)trim($clt);
        if ($tsCand > 0 && $tsCand <= $nowTs) { $cookieLinkDomain = $cld; $cookieLinkTs = $tsCand; }
    }
}
if ($cookieLinkDomain === '') {
    // No (valid) session: the domain being visited right now is the
    // link domain, stored in a fresh cookie with the current time.
    $linkDomain = $host;
    setcookie('_lnk', $linkDomain . '__' . $nowTs, $linkCookieOpts);
} elseif ($nowTs - $cookieLinkTs >= 5) {
    // This visitor's 5 seconds are up: generate ONE new random
    // subdomain (same word style buildUrl() uses for siblings),
    // update ONLY this visitor's cookie to it + a fresh timestamp,
    // and point all their links at it for the next 5 seconds.
    $w = pick($subWords); if (random_int(0, 2) === 0) $w .= '-' . pick($subWords);
    $linkDomain = $w . '.' . $baseDomain;
    setcookie('_lnk', $linkDomain . '__' . $nowTs, $linkCookieOpts);
} else {
    // Inside this visitor's 5-second window: links stay on the
    // domain stored in their cookie; the cookie is left as-is.
    $linkDomain = $cookieLinkDomain;
}

// Build one maze URL: section + a slug segment + trailing random
// number, on the visitor's cookie link domain when one is given,
// otherwise on a random sibling subdomain (the sitemap.xml builder
// uses this and then overrides the host anyway).
// Returns label, full URL, path, section.
//
// LABEL IN THE PATH (Nishad 2026-11-22): every path now ALWAYS carries
// a descriptive slug segment - the title words that go into the
// label, slugified (lowercase, whitespace -> dashes) - followed by
// the random 2000-3000 number (numbers are normal in article URLs,
// so the number stays, as its own trailing segment). E.g. label
// "... Guides Getting Started" -> /guides/getting-started/2841.
// The slug is built from the pathTitle words, so the slug words are
// always a subset of the final label - including for Explore and
// Related links, whose host-derived label PREFIX is replaced with a
// random name after buildUrl() returns (that replacement never
// touches the pathTitle portion, so slug-in-label still holds).
//
// LINK TITLES (Nishad 2026-11-22 follow-up): the label is the host's
// first label titlecased PLUS a title built from the link's OWN path
// (all non-numeric segments, titlecased) - e.g. host ahhsh.* with path
// /solutions/2518 gives "Ahhsh Solutions", and /docs/docs-guide/
// resources-hub/2003 gives "Ahhsh Docs Docs Guide Resources Hub".
// Deriving the label from the host alone made every link on the
// cookie domain read identically ("Ahhsh Ahhsh Ahhsh ..."); the URL
// itself is unchanged - Explore/main links still stay on the
// visitor's cookie domain, only their visible titles now differ.
function titleWords($slug): string { return ucwords(str_replace('-',' ',(string)$slug)); }
function pathTitle($path): string { $parts=[]; foreach(explode('/',trim((string)$path,'/')) as $seg){ if($seg===''||is_numeric($seg)) continue; $parts[]=titleWords($seg); } return implode(' ',$parts); }
// REALISTIC LINK LABELS (cold-review fix 2026-11-22): a link's label is
// derived from its OWN destination slug topic - never from the host name
// and never from random prefix words. Article sections (blog/newsroom/
// resources) get one of the topic's article titles; other sections get a
// natural phrasing of the topic name ('DNS Settings', 'Guide to DNS
// Settings', 'DNS Settings Explained', ...). The old host-name + full-path
// title labels ('Create Base Docs Dns Settings') read as keyword salad,
// and the random-prefix patch loops that masked them are gone.
function slugTopicName(string $slug): string { $t=$GLOBALS['slugTopics'][$slug]??null; return ($t!==null && isset($t['name'])) ? $t['name'] : titleWords($slug); }
function topicLinkLabel(string $section, string $slug): string { $name=slugTopicName($slug); $t=$GLOBALS['slugTopics'][$slug]??null; if(in_array($section,['blog','newsroom','resources'],true) && $t!==null && !empty($t['titles'])){ $pool=array_merge($t['titles'],[$name.' Guide','Guide to '.$name]); } else { $pool=[$name,$name.' Guide','Guide to '.$name,$name.' Explained',$name.' Overview',$name.' Step by Step',$name.' Checklist','About '.$name]; } return dedupeWords($pool[mt_rand(0,count($pool)-1)]); }
function buildUrl($scheme,$baseDomain,$port,$subWords,$sections,$docPages,$linkHost=null): array { if($linkHost!==null && $linkHost!==''){ $w=explode('.',$linkHost)[0]; $urlHost=$linkHost; } else { $w=pick($subWords); if(mt_rand(0,2)===0) $w.='-'.pick($subWords); $urlHost=$w.'.'.$baseDomain; } $s=pick($sections); $slug=trim(slugify(titleWords(pick($docPages))),'-'); if($slug==='') $slug=$s; $basePath='/'.$s.'/'.$slug; $id=mt_rand(10000,89999); $idGuard=0; while(isset($GLOBALS['mazeUsedIds'][$id]) && $GLOBALS['mazeUsedIds'][$id]!==$basePath && $idGuard<400){ $id=mt_rand(10000,89999); $idGuard++; } $GLOBALS['mazeUsedIds'][$id]=$basePath; $path=$basePath.'/'.$id; $label=topicLinkLabel($s,$slug); return ['label'=>$label,'url'=>$scheme.'://'.$urlHost.$port.$path,'path'=>$path,'section'=>$s]; }
// De-duplicates by URL (via $used, shared across lists) AND by label
// within the returned list, so every visible title in one list is
// distinct even though the trailing path number is not part of it.
function uniqueLinks($n,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,&$used,$linkHost=null): array { $out=[];$tries=0;$labels=[]; while(count($out)<$n&&$tries<$n*40){ $tries++; $c=buildUrl($scheme,$baseDomain,$port,$subWords,$sections,$docPages,$linkHost); if(isset($used[$c['url']])||isset($labels[$c['label']])) continue; $used[$c['url']]=true; $labels[$c['label']]=true; $out[]=$c; } return $out; }

// ---------------------------------------------------------------------------
// SEEDED PER-HOST STABILITY (Nishad 2026-11-22): NO storage of any
// kind - every trait below is derived deterministically from a hash
// of the hostname (Phase A) or hostname+path (Phase B), computed on
// the fly with the seeded mt_rand. The same URL fetched twice
// returns the SAME company and the SAME page; a different host
// still gets a different company, and the maze stays infinite.
// Session/ban mechanics (cookies, honeypot tokens, log timestamps)
// deliberately do NOT use this seeded RNG - content/presentation
// only.
// Phase A - HOST IDENTITY (seed 'brand|<host>'): frozen before
// anything else consumes page randomness. The FIRST pick under
// this seed is the brand, so the 404 page (SECTION 6b) reproduces
// the same brand with the same seed. Host traits never change on
// any path or fetch: brand, topic, accent, geo, pricing ladder,
// uptime, sites hosted, response time, status line.
srand2('brand|'.$host);
$brand=pick($brands); $topic=pick($topics);
$accent=pick(['#38bdf8','#34d399','#fbbf24','#f472b6','#a78bfa','#fb923c']);
$geoPlace=$geoPlaces[mt_rand(0,count($geoPlaces)-1)];
// Plan ladder: prices ascend by tier (as before), and now the feature
// lists are CUMULATIVE slices of one shared pool (tier 1 gets the first
// 4, tier 2 the first 6, tier 3 all 8) with concrete per-tier specs
// (vCPU, RAM GB, SSD GB, bandwidth GB) ascending alongside - the old
// independent per-plan feature picks let a cheaper plan list features
// the pricier ones lacked, and no plan had any specs at all (Claude
// review 2026-11-22). JSON-LD price stays $plans[0] (cheapest tier).
$planFeatPool=picks(array_column($featureDetails,0),8); $planSpecTiers=[[1,1,10,100],[2,2,25,250],[4,4,50,500]];
// Plan NAMES follow tier order (cold-review fix 2026-11-22): the old
// picks($planNames,3) drew 3 names in random order, so some hosts sold
// "Enterprise" as the cheapest tier and "Starter" as the priciest.
// Now one name is drawn per tier band - entry band for the cheapest
// tier, top band for the most expensive - so the ladder reads in
// order on every host.
$planTierBands=[['Starter','Launch','Creator'],['Growth','Scale','Business','Developer'],['Pro','Turbo','Mega','Ultra','Agency','Enterprise','Cloud Nine']];
$tierNames=[]; foreach($planTierBands as $tb){ $tierNames[]=pick($tb); }
$plans=[]; $ladderCents=mt_rand(2,9)*100+(mt_rand(0,1)?99:0); foreach($tierNames as $pi=>$pn){ $plans[]=['name'=>$pn,'price'=>number_format($ladderCents/100,2),'feats'=>array_slice($planFeatPool,0,4+2*$pi),'specs'=>$planSpecTiers[$pi]]; $ladderCents+=mt_rand(2,12)*100+(mt_rand(0,1)?99:0); if(($ladderCents%100)!==99 && ($ladderCents%100)!==0) $ladderCents+= (99-($ladderCents%100)); }
$planPrice=$plans[0]['price'];
$planName=pick($planNames);
$uptimeStr=number_format(mt_rand(982,999)/10,1); $sitesHosted=number_format(mt_rand(1200,98000)); $responseMs=mt_rand(12,240);
// ONE location set per host (Claude review 2026-11-22): the geo meta
// city IS the headline data centre, joined by two more seeded cities;
// that same trio is the only datacentre list anywhere on the page, the
// description names the geo city, and the status section's "nearest
// data centre" is the geo city too. The old code rolled each of those
// independently, so one page could claim Chicago, New York and a
// Sydney/Chicago/Tokyo DC list all at once.
$dcOthers=picks(array_values(array_diff($locations,[$geoPlace['name']])),2); $dcCities=array_merge([$geoPlace['name']],$dcOthers);
$statusLine=pick($statusLines); $statusDc=$geoPlace['name']; $statusTagline=pick($taglines);
// HOST TESTIMONIALS + PRODUCT RATING (cold-review fix 2026-11-22):
// these are company-level facts, but they were picked under the
// Phase B page seed, so on one host the same quote appeared as
// "Tom King" on one page and "Tom Carter" on another, and the
// product rating/review count changed on every page - the #1 tell
// in five independent cold reviews. They are now drawn HERE, under
// the host seed: one testimonial set (quote + full name + role +
// star count) and one AggregateRating value per host, identical on
// every page of that host. The testimonial pool is first filtered
// to first names no page author can have, so the author-collision
// rule holds on every page without swapping testimonials per page
// (swapping was part of the drift). Surnames are appended here too.
$authorFirsts=array_map(fn($a)=>strtolower(explode(' ',$a)[0]),$authors);
$hostTestPool=array_values(array_filter($testimonials,fn($t)=>!in_array(strtolower(trim(explode(',',$t[1])[0])),$authorFirsts,true)));
$hostTestimonials=[];
foreach(picks($hostTestPool,3) as $ht){ $hp=explode(',',$ht[1],2); $hostTestimonials[]=[$ht[0], trim($hp[0]).' '.pick($lastNames).(isset($hp[1])?', '.trim($hp[1]):'')]; }
$hostTestStars=[]; foreach($hostTestimonials as $ht){ $hostTestStars[]=mt_rand(4,5); }
$rating=(mt_rand(38,50)/10); $reviewCount=mt_rand(120,4800);
// Phase B - PAGE CONTENT (seed 'page|<host>|<path>'): everything
// specific to this one URL is generated under this seed below, so
// a page is stable across fetches but differs across URLs.
srand2('page|'.$host.'|'.$requestPath);
// LAYOUTS (2026-11-22 big rewrite): the first path segment decides the page
// TYPE, and each type gets its own layout, section set and link density -
// a pricing page is no longer an "article" with views and ratings, a docs
// page reads as a how-to, and so on. Homepage keeps the rich layout.
$pageSection=explode('/', trim($requestPath,'/'))[0];
$layout='article';
if($isHome) $layout='home';
elseif(in_array($pageSection,['docs','tutorials','knowledge-base','help-centre','api','developers'],true)) $layout='docs';
elseif(in_array($pageSection,['blog','newsroom','resources'],true)) $layout='article';
elseif(in_array($pageSection,['pricing','products','platform','services','solutions','comparison','calculator'],true)) $layout='pricing';
elseif($pageSection==='status') $layout='status';
elseif(in_array($pageSection,['careers','about','company','partners'],true)) $layout='company';
elseif($pageSection==='guides') $layout='guide';
$category=pick($categories);
$title=$brand.' - '.ucwords($topic);
$heading=ucwords(pick($adjectives)).' '.$topic.' with '.$brand;
if(in_array($layout,['article','guide'],true)) $heading=pick($articleTitles);
// SLUG-TO-CONTENT MATCHING (cold-review fix 2026-11-22): if this URL
// carries a doc-page slug (/<section>/<slug>/<id>), the page's topic IS
// that slug. Title and headline are taken from the slug's own entry in
// $slugTopics, and the paragraphs/steps below are built topic-first.
// Legacy /<section>/<number> URLs and the homepage have no slug and
// keep the previous behaviour.
$pageSegs=explode('/', trim($requestPath,'/'));
$pageSlug=(count($pageSegs)>=3 && in_array($pageSegs[1], $docPages, true)) ? $pageSegs[1] : '';
$slugTopic=($pageSlug!=='' && isset($slugTopics[$pageSlug])) ? $slugTopics[$pageSlug] : null;
if($slugTopic!==null){
    if(in_array($layout,['article','guide'],true)){ $heading=pick($slugTopic['titles']); $title=$heading.' - '.$brand; }
    elseif($layout==='docs'){ $heading=$slugTopic['name']; $title=$slugTopic['name'].' - '.$brand.' Documentation'; }
    else { $heading=$slugTopic['name'].' - '.$brand; $title=$heading; }
}
$featDetailsSel=picks($featureDetails,8); $myFeatures=array_map(fn($fd)=>$fd[0], $featDetailsSel); $myTags=picks($tags,14);
// TAGS DERIVATION (page-structure fix 2026-11-22): the tags must describe
// THIS page, not just the generic pool - and the set must never be empty,
// because the template prints a "Tags and topics" heading over them (cold
// reviewers kept finding that heading with nothing under it). Page-specific
// tags (the slug's topic name, the section, the category, the host topic)
// are prepended to the seeded generic picks and the list is de-duplicated.
$pageTags=[];
if($slugTopic!==null) $pageTags[]=$slugTopic['name'];
if($pageSection!=='') $pageTags[]=titleWords($pageSection);
$pageTags[]=$category; $pageTags[]=ucwords($topic);
foreach($pageTags as $pt2){ if(!in_array($pt2,$myTags,true)) array_unshift($myTags,$pt2); }
$myTags=array_values(array_unique($myTags));
$myKeywords=array_merge(picks($keywordsExtra,8), $myTags, [$topic,$brand.' hosting', $brand]);
$description=dedupeWords($brand.' - '.$heading.'. Explore '.$topic.', '.implode(', ',array_slice($myFeatures,0,4)).', pricing, documentation, guides and support. Trusted hosting in '.$geoPlace['name'].' and worldwide.');
$myFaqs=picks($faqPairs,5); $myTestimonials=$hostTestimonials; $myGlossary=picks($glossary,4);

$featA=picks($features,2); $featB=picks($features,2); $featC=picks($features,2); $adjA=picks($adjectives,2); $locA=$dcCities; $topicA=picks($blogTopics,3);
$corpusSel=picks($corpusParas,6);
$paragraphs=[];
foreach($corpusSel as $cp2){ $paragraphs[]=str_replace(['{brand}','{city}','{topic}'],[$brand,$geoPlace['name'],$topic],$cp2); }
$mySteps=picks($howtoSteps,6);
// Topic-first body (see SLUG-TO-CONTENT MATCHING above): on a slug page
// the first two rendered paragraphs and one later paragraph come from
// the slug's own topic entry, and the step-by-step steps are the topic's
// own steps - so a docs page for ssl-setup gives SSL steps, not generic
// ones. The host's standard blocks (plans, FAQs, testimonials) still
// surround the topic content, as they do on real hosting sites.
if($slugTopic!==null){
    $topicParas=[];
    foreach(picks($slugTopic['paras'],3) as $tp2){ $topicParas[]=str_replace(['{brand}','{city}'],[$brand,$geoPlace['name']],$tp2); }
    $paragraphs=array_merge([$topicParas[0],$topicParas[1]], array_slice($paragraphs,0,2), [$topicParas[2]], array_slice($paragraphs,2,2));
    $mySteps=picks($slugTopic['steps'], min(5,count($slugTopic['steps'])));
}
$paragraphs=array_map('dedupeWords',$paragraphs);

$author=pick($authors); $pubAge=mt_rand(2,900)*86400+mt_rand(0,86399);
// Author vs testimonials (Claude review 2026-11-22): the page author
// must never double as a testimonial voice on the same page (Claude's
// sample had author "Leo" also giving a testimonial), and testimonial
// attributions get full names instead of first-name-only. Swap any
// colliding testimonial for an unused pool entry, then append a
// seeded last name to each first-name-only attribution.
$authorFirst=strtolower(explode(' ',$author)[0]);
// Testimonials need NO per-page fixups any more: the host-seeded set
// (Phase A) already carries full names, and its pool excludes every
// author first name, so the page author can never collide with a
// testimonial voice on any page of the host. The old per-page swap +
// surname-append loops that lived here were a direct cause of the
// cross-page name drift and are removed.
// Dates anchor to a FIXED point, not time(): a published date derived
// from $nowTs would drift by seconds on every fetch and break page
// stability even with a seeded offset.
$pageAnchorTs=strtotime('2026-11-01 00:00:00 UTC'); $publishedTs=$pageAnchorTs-$pubAge; $updatedTs=$publishedTs+mt_rand(3600,max(7200,$pubAge-3600)); if($updatedTs>$pageAnchorTs) $updatedTs=$pageAnchorTs;
$published=date('F j, Y',$publishedTs); $updated=date('F j, Y',$updatedTs); $publishedIso=date('c',$publishedTs); $updatedIso=date('c',$updatedTs);
$readMinutes=mt_rand(4,18); $commentCount=mt_rand(0,89); $viewCount=number_format(mt_rand(180,98000)); // $rating/$reviewCount are HOST traits now (Phase A) - the product rating must not re-roll per page.
// Footer Ref is derived from host+path, so the same URL shows the same
// Ref on every load (audit B10) instead of re-rolling per request.
$pageRef=substr(md5($host.'|'.$requestPath),0,18);

$used=[]; $mainLink=buildUrl($scheme,$baseDomain,$port,$subWords,$sections,$docPages,$linkDomain); $used[$mainLink['url']]=true;
$exploreCount=['home'=>80,'article'=>48,'guide'=>40,'docs'=>32,'pricing'=>24,'company'=>24,'status'=>16][$layout] ?? 40;
$links=uniqueLinks($exploreCount,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,$used,$linkDomain);
// Explore labels come straight from buildUrl() now (see REALISTIC LINK
// LABELS there): each label names its own destination's slug topic.
// The old random-prefix patch loop that masked the host-derived
// labels is removed - the labels themselves are realistic now.

$extraLinks=uniqueLinks($layout==='home'?18:10,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,$used,$linkDomain);
$relatedLinks=uniqueLinks(6,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,$used,$linkDomain);
// RELATED TOP-UP (page-structure fix 2026-11-22): uniqueLinks() can return
// fewer links than asked when label de-duplication runs dry, and the
// template prints a "Related articles and guides" heading over these
// cards - so guarantee a full set by topping up with direct builds
// (URL de-duplication against $used is still enforced).
$relTries=0;
while(count($relatedLinks)<6 && $relTries<60){ $relTries++; $rc=buildUrl($scheme,$baseDomain,$port,$subWords,$sections,$docPages,$linkDomain); if(isset($used[$rc['url']])) continue; $used[$rc['url']]=true; $relatedLinks[]=$rc; }
// RELATED CARD TITLES (cold-review fix 2026-11-22): a Related card's
// title is a plausible article title FOR ITS OWN destination slug
// (from that slug's $slugTopics titles), de-duplicated across the 6
// cards. Hrefs still stay on the visitor's cookie link domain.
$relatedLabelsUsed=[];
foreach($relatedLinks as &$relatedLink){ $rSegs=explode('/',trim($relatedLink['path'],'/')); $rSlug=$rSegs[1]??''; $rTitles=$slugTopics[$rSlug]['titles']??[]; if($rTitles){ $rCand=null; foreach(rshuffle($rTitles) as $rt2){ if(!isset($relatedLabelsUsed[$rt2])){ $rCand=$rt2; break; } } if($rCand===null) $rCand=topicLinkLabel($relatedLink['section'],$rSlug); if(!isset($relatedLabelsUsed[$rCand])){ $relatedLabelsUsed[$rCand]=true; $relatedLink['label']=$rCand; } } }

$footerLinks=uniqueLinks(40,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,$used,$linkDomain);
$navLinks=uniqueLinks(8,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,$used,$linkDomain);
// NAV DEDUPE (Claude review 2026-11-22): nav labels are just the link's
// section name, and uniqueLinks() only dedupes full URLs/labels, so
// the nav could show the same section twice ("Blog" twice in Claude's
// sample, "Features" twice in ours). Keep the first link per section.
$navSeen=[]; $navLinks=array_values(array_filter($navLinks,function($l) use (&$navSeen){ if(isset($navSeen[$l['section']])) return false; $navSeen[$l['section']]=true; return true; }));
// FOOTER LEGAL LINKS (Claude review 2026-11-22): real sites carry
// Privacy / Terms / Contact pages; the maze had none. Three generated
// maze links on the visitor's link domain, labels replaced with the
// legal names (hrefs keep the normal section/slug/number shape).
$legalLinks=uniqueLinks(3,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,$used,$linkDomain);
foreach(['Privacy Policy','Terms of Service','Contact Us'] as $li=>$lname){ if(isset($legalLinks[$li])) $legalLinks[$li]['label']=$lname; }

// Footer "Sitemap" links ONLY (Nishad 2026-11-22): these are the one
// exception to the per-visitor cookie domain above. Each footer sitemap
// link is built with NO link host, so buildUrl() gives it a fresh random
// sibling subdomain, and hosts are de-duplicated so all 40 are on
// DISTINCT subdomains. Purpose: a crawler that never returns the
// maze_link cookie (so its main links stay pinned to the visited
// domain) still hops to a new random subdomain for every sitemap
// link it follows.
// TITLE RULE (Nishad 2026-11-22 follow-up): the visible title is
// ONLY the first segment of that link's own subdomain, titlecased -
// e.g. resources-zone.nishad.top shows "Resources Zone", never the
// full domain. Titles stay distinct because the subdomains are
// de-duplicated (labels are de-duplicated too, as a belt-and-braces
// check - a repeated first segment is regenerated, not reused).
$footerSitemapLinks=[]; $footerHosts=[]; $footerLabels=[]; $footerTries=0;
while(count($footerSitemapLinks)<40 && $footerTries<800){ $footerTries++; $c=buildUrl($scheme,$baseDomain,$port,$subWords,$sections,$docPages,null); $fh=parse_url($c['url'],PHP_URL_HOST); if(!$fh || isset($footerHosts[$fh]) || isset($used[$c['url']])) continue; $flabel=dedupeWords(titleWords(explode('.',$fh)[0])); if(isset($footerLabels[$flabel])) continue; $footerHosts[$fh]=true; $footerLabels[$flabel]=true; $used[$c['url']]=true; $c['label']=$flabel; $footerSitemapLinks[]=$c; }

// HASH COPYRIGHT LINK (Nishad 2026-11-22): exactly ONE link on the
// whole page uses a fully generated "hash" subdomain instead of a
// dictionary word - the brand name in the footer copyright line.
// The hash label is 6-7 characters: lowercase letters + digits (at
// least one of each, so it can never collide with a dictionary-word
// subdomain), with an optional hyphen that may only appear in the
// middle - never as the first or last character. It is generated
// fresh on every render, so every page - and every follow-up visit
// to a hash host, which serves a fresh maze page - yields a brand
// new hash host: a never-ending trail even for crawlers that never
// return the maze_link cookie. Its path is a normal generated maze
// path (buildUrl). ALL other links keep their existing rules:
// page links follow the per-visitor maze_link cookie domain, and
// footer Sitemap links stay on dictionary-word subdomains.
function makeHashLabel(): string { $len=mt_rand(6,7); $hyphPos=(mt_rand(0,1)===0)?mt_rand(2,$len-3):-1; $chars='abcdefghijklmnopqrstuvwxyz0123456789'; $out=''; $hasLetter=false; $hasDigit=false; for($i=0;$i<$len;$i++){ if($i===$hyphPos){ $out.='-'; continue; } $ch=$chars[mt_rand(0,strlen($chars)-1)]; if(ctype_alpha($ch)) $hasLetter=true; else $hasDigit=true; $out.=$ch; } if(!$hasLetter||!$hasDigit){ return makeHashLabel(); } return $out; }
$hashLink=null; $hashTries=0;
while($hashLink===null && $hashTries<100){ $hashTries++; $hashHost=makeHashLabel().'.'.$baseDomain; if($hashHost===$linkDomain || $hashHost===$host || isset($footerHosts[$hashHost])) continue; $hc=buildUrl($scheme,$baseDomain,$port,$subWords,$sections,$docPages,$hashHost); if(isset($used[$hc['url']])) continue; $used[$hc['url']]=true; $hashLink=$hc; }
if($hashLink===null){ $hashLink=['url'=>$canonical,'label'=>$brand,'path'=>$requestPath,'section'=>'']; }


// (The pricing ladder itself is a host trait - see Phase A above.)
// Phase B extras consumed by the template, precomputed here so the
// template itself contains NO random calls at all: testimonial star
// counts, per-card related topics, tag -> extra-link indexes, the
// "Inside" section picks, the aside picks, and the seeded section
// order (stable per URL, varied across URLs - audit B2 noted the
// order had become fixed).
$myTestStars=$hostTestStars; // testimonial stars are part of the host testimonial set (Phase A), not per-page
$relatedTopics=[]; foreach($relatedLinks as $rl){ $relatedTopics[]=pick($blogTopics); }
$tagLinkIdx=[]; for($ti=0;$ti<count($myTags);$ti++){ $tagLinkIdx[]=mt_rand(0,count($extraLinks)-1); }
$insideTagline=$statusTagline; $insideFeatures=picks($features,5); $insideLocations=$dcCities; // tagline is a company fact: reuse the host-seeded one instead of re-rolling per page (same drift class)
$asideTopic=pick($blogTopics); $asideDoc=pick($docPages); $asideSection=pick($sections);
if($layout==='docs'||$layout==='guide') $sectionOrder=array_merge(['steps'],rshuffle(['features','faq','glossary','related','explore','tags','inside']));
elseif($layout==='pricing') $sectionOrder=['pricing','features','faq','testimonials','status','related','explore','tags'];
elseif($layout==='status') $sectionOrder=['statusboard','status','faq','related','explore','tags'];
elseif($layout==='company') $sectionOrder=['company','testimonials','inside','faq','related','explore','tags'];
elseif($layout==='article') $sectionOrder=rshuffle(['features','faq','testimonials','glossary','related','explore','tags','status','inside']);
else $sectionOrder=rshuffle(['features','pricing','inside','faq','testimonials','glossary','related','explore','tags','status']);
// VISIBLE SALES BLOCKS BY PAGE TYPE (page-structure fix 2026-11-22): the
// full sales wrapper (all 5 FAQs, the full testimonial set) belongs on
// home / pricing / company pages. Docs, article, guide and status pages
// get SUBSETS - the first entries of the same host-seeded sets, never
// re-rolled, so host consistency from Phase A is preserved - and the
// docs/status layouts already omit testimonials and the pricing table
// entirely via $sectionOrder above. Cold reviewers called the identical
// full wrapper on every page type the biggest remaining tell.
$visibleFaqs=$myFaqs; $visibleTestimonials=$myTestimonials;
if(in_array($layout,['article','guide','docs','status'],true)) $visibleFaqs=array_slice($myFaqs,0,3);
if(in_array($layout,['article','guide'],true)) $visibleTestimonials=array_slice($myTestimonials,0,1);
// NO EMPTY HEADINGS (page-structure fix 2026-11-22): drop any section
// whose content set is empty from this page's order entirely, so a
// heading can never render with nothing under it on any page type.
$sectionOrder=array_values(array_filter($sectionOrder,function($k) use ($relatedLinks,$myTags,$extraLinks,$visibleFaqs,$visibleTestimonials){ if($k==='related') return !empty($relatedLinks); if($k==='tags') return !empty($myTags) && !empty($extraLinks); if($k==='faq') return !empty($visibleFaqs); if($k==='testimonials') return !empty($visibleTestimonials); return true; }));

// wordCount counts the words actually rendered in the body (paragraphs,
// FAQs, testimonials, glossary) instead of a random 900-3200 (audit B11).
$bodyWords=implode(' ',$paragraphs).' '.$heading;
foreach($myFaqs as $f) $bodyWords.=' '.$f[0].' '.$f[1];
foreach($myTestimonials as $t) $bodyWords.=' '.$t[0].' '.$t[1];
foreach($myGlossary as $g) $bodyWords.=' '.$g[0].' '.$g[1];
foreach($myFeatures as $f) $bodyWords.=' '.$f;
$wordCount=str_word_count(strip_tags($bodyWords));

// Structured data (JSON-LD): Organization, WebSite, WebPage, BlogPosting (inner pages),
// FAQPage, Product with rating + ItemList - maximum SEO
// bait so crawlers treat the fake page as a real, rich result.
// ---------------------------------------------------------------------------
$ldGraph=[
 ['@type'=>'Organization','name'=>$brand,'url'=>$canonical],
 ['@type'=>'WebSite','name'=>$brand,'url'=>$canonical],
 $isHome ? ['@type'=>'WebPage','name'=>$title,'description'=>$description,'url'=>$canonical,'inLanguage'=>'en'] : ['@type'=>'WebPage','name'=>$title,'description'=>$description,'url'=>$canonical,'inLanguage'=>'en','datePublished'=>$publishedIso,'dateModified'=>$updatedIso],
];
// Homepage is a website, not an article: only non-home pages get the
// BlogPosting node in their structured data.
if(in_array($layout,['article','guide'],true)) $ldGraph[]=['@type'=>'BlogPosting','headline'=>$heading,'description'=>$description,'author'=>['@type'=>'Person','name'=>$author],'publisher'=>['@type'=>'Organization','name'=>$brand,'url'=>$canonical],'datePublished'=>$publishedIso,'dateModified'=>$updatedIso,'articleSection'=>$category,'keywords'=>implode(', ',$myKeywords),'wordCount'=>$wordCount,'timeRequired'=>'PT'.$readMinutes.'M'];
$ld=['@context'=>'https://schema.org','@graph'=>array_merge($ldGraph,[
 ['@type'=>'FAQPage','mainEntity'=>array_map(fn($f)=>['@type'=>'Question','name'=>$f[0],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f[1]]],$myFaqs)],
 ['@type'=>'Product','name'=>$brand.' '.ucwords($topic),'description'=>$description,'brand'=>['@type'=>'Brand','name'=>$brand],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>$reviewCount],'offers'=>['@type'=>'Offer','price'=>$planPrice,'priceCurrency'=>'USD','availability'=>'https://schema.org/InStock','url'=>$canonical]],
 ['@type'=>'ItemList','name'=>'Explore '.$brand,'itemListElement'=>array_map(fn($i,$l)=>['@type'=>'ListItem','position'=>$i+1,'name'=>$l['label'],'url'=>$l['url']],array_keys(array_slice($links,0,12)),array_slice($links,0,12))],
])];
$ldJson=json_encode($ld, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
// Geo place is a host trait - picked in Phase A above.
// Accent colour is a host trait - picked in Phase A above (audit A4).

// Response headers: never cache (every load must be a fresh page) and a
// Link header pointing at the canonical URL.
// CACHING (2026-11-22 cheap pass): page content is stable per URL (seeded),
// so the old no-store/Pragma/Expires anti-cache headers were a tell. The body
// is buffered and sent with an ETag + Last-Modified (the page's seeded updated
// timestamp) and a short private cache lifetime; a matching If-None-Match
// gets a bare 304. NOTE on the hash copyright link: it is generated from the
// seeded page RNG, so it is stable for a given URL - the ETag is honest.
ob_start();
header('Content-Type: text/html; charset=UTF-8');
header('Link: <'.$canonical.'>; rel="canonical"');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?=e($title)?></title>
<meta name="description" content="<?=e($description)?>">
<?php /* No meta keywords (keyword-stuffed, ignored by search engines) and no obsolete revisit-after meta - Claude review 2026-11-22. */ ?>
<meta name="author" content="<?=e($author)?>"><meta name="publisher" content="<?=e($brand)?>">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="googlebot" content="index, follow"><meta name="bingbot" content="index, follow">
<meta name="rating" content="general"><meta name="language" content="English">
<meta name="geo.region" content="<?=e($geoPlace['region'])?>"><meta name="geo.placename" content="<?=e($geoPlace['name'])?>">
<meta name="theme-color" content="#0f172a"><meta name="category" content="<?=e($category)?>">
<link rel="canonical" href="<?=e($canonical)?>">
<link rel="alternate" hreflang="en" href="<?=e($canonical)?>"><link rel="alternate" hreflang="x-default" href="<?=e($canonical)?>">
<meta property="og:type" content="<?=in_array($layout,['article','guide'],true)?'article':'website'?>"><meta property="og:title" content="<?=e($title)?>"><meta property="og:description" content="<?=e($description)?>">
<meta property="og:url" content="<?=e($canonical)?>"><meta property="og:site_name" content="<?=e($brand)?>"><meta property="og:locale" content="en_US">
<?php if(in_array($layout,['article','guide'],true)): ?><meta property="article:published_time" content="<?=e($publishedIso)?>"><meta property="article:modified_time" content="<?=e($updatedIso)?>">
<meta property="article:author" content="<?=e($author)?>"><meta property="article:section" content="<?=e($category)?>">
<?php foreach($myTags as $t): ?><meta property="article:tag" content="<?=e($t)?>">
<?php endforeach; ?><?php endif; ?>
<meta name="twitter:card" content="summary"><meta name="twitter:title" content="<?=e($title)?>"><meta name="twitter:description" content="<?=e($description)?>">
<script type="application/ld+json"><?= $ldJson ?></script>
<style>*{box-sizing:border-box}body{margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:#0f172a;color:#e2e8f0}.wrap{max-width:860px;margin:0 auto;padding:32px 24px 64px}.brand{color:<?=$accent?>;font-weight:700;letter-spacing:1px;font-size:14px;text-transform:uppercase}h1{font-size:34px;line-height:1.25;margin:12px 0 20px;color:#fff}h2{font-size:21px;color:#fff;margin:32px 0 12px}h3{font-size:17px;color:#fff;margin:20px 0 8px}p{line-height:1.7;color:#cbd5e1;margin:0 0 16px}.btn{display:inline-block;margin:16px 0 32px;padding:14px 30px;font-size:17px;font-weight:700;color:#fff;background:#2563eb;border-radius:10px;text-decoration:none}.meta{color:#94a3b8;font-size:14px;margin:-8px 0 24px;line-height:1.6}ul.links{list-style:none;padding:0;margin:0;display:grid;grid-template-columns:1fr 1fr;gap:8px 24px}ul.links a{color:#94a3b8;text-decoration:none;font-size:15px}.box{background:#1e293b;border:1px solid #334155;border-radius:12px;padding:4px 20px 12px;margin:24px 0}.box a,.wrap a{color:<?=$accent?>}nav a{margin-right:14px;color:#cbd5e1;text-decoration:none;font-size:14px}.cards{display:grid;grid-template-columns:1fr 1fr;gap:16px}.card{background:#1e293b;border:1px solid #334155;border-radius:12px;overflow:hidden}.card div{padding:12px 16px}.tags a{display:inline-block;background:#1e293b;border:1px solid #334155;border-radius:999px;padding:6px 12px;margin:4px;color:#cbd5e1;text-decoration:none;font-size:13px}table{width:100%;border-collapse:collapse}td,th{border-bottom:1px solid #334155;padding:10px;text-align:left;color:#cbd5e1}footer{margin-top:48px;color:#475569;font-size:13px}footer a{color:#94a3b8;text-decoration:none;margin-right:10px}</style>
</head>
<body><div class="wrap">
<?php /* SECTION 9 - HTML template. Header: brand, nav (8 maze links), breadcrumb. */ ?>
<header><div class="brand"><?=e($brand)?></div><nav aria-label="Main navigation"><?php foreach($navLinks as $l): ?><a href="<?=e($l['url'])?>"><?=e(ucwords($l['section']))?></a><?php endforeach; ?></nav>
<p style="margin-top:16px;font-size:13px;color:#94a3b8"><a href="/">Home</a> &rsaquo; <a href="<?=e($scheme.'://'.$host.$port.$mainLink['path'])?>"><?=e($category)?></a> &rsaquo; <?=e($brand)?></p></header>
<main><?php if(in_array($layout,['article','guide'],true)): ?><article>
<h1><?=e($heading)?></h1>
<div class="meta">By <?=e($author)?> at <?=e($brand)?> &middot; Published <time datetime="<?=e($publishedIso)?>"><?=e($published)?></time> &middot; Last updated <time datetime="<?=e($updatedIso)?>"><?=e($updated)?></time><br><?=e((string)$readMinutes)?> min read &middot; <?=e($viewCount)?> views &middot; Rated <?=$rating?>/5 from <?=number_format($reviewCount)?> reviews &middot; Category: <?=e($category)?></div>
<?php elseif($layout==='docs'): ?><article>
<h1><?=e($heading)?></h1>
<div class="meta"><?=e($brand)?> documentation &middot; Last updated <time datetime="<?=e($updatedIso)?>"><?=e($updated)?></time> &middot; <?=e((string)$readMinutes)?> min read</div>
<?php else: ?>
<h1><?=e($heading)?></h1>
<?php endif; ?>
<?php foreach(array_slice($paragraphs,0,3) as $p): ?><p><?=e($p)?></p><?php endforeach; ?>
<a class="btn" href="<?=e($mainLink['url'])?>">Start your free trial with <?=e($brand)?></a>
<h2>On this page</h2><ul><?php foreach(array_values(array_filter([['features','Key features'],['pricing','Pricing plans'],['faq','Frequently asked questions'],['testimonials','What customers say'],['glossary','Glossary'],['status','Service status'],['steps','Step by step'],['statusboard','Current service status'],['company','About us']], fn($o)=>in_array($o[0],$sectionOrder,true))) as $otp): ?><li><a href="#<?=e($otp[0])?>"><?=e($otp[1])?> - <?=e($topic)?></a></li><?php endforeach; ?></ul>
<?php foreach(array_slice($paragraphs,3) as $p): ?><p><?=e($p)?></p><?php endforeach; ?>

<?php foreach($sectionOrder as $secKey): ?>
<?php if($secKey==='features'): ?><section id="features"><h2>Key features of <?=e($brand)?> <?=e($topic)?></h2><ul><?php foreach($featDetailsSel as $fd): ?><li><strong><?=e($fd[0])?></strong> - <?=e($fd[1])?></li><?php endforeach; ?></ul></section>
<?php elseif($secKey==='pricing'): ?><section id="pricing"><h2>Pricing plans compared</h2><table><tr><th>Plan</th><th>Price / month</th><th>Specs</th><th>Includes</th></tr><?php foreach($plans as $pl): ?><tr><td><?=e($pl['name'])?></td><td>$<?=e($pl['price'])?></td><td><?=e($pl['specs'][0])?> vCPU &middot; <?=e($pl['specs'][1])?> GB RAM &middot; <?=e($pl['specs'][2])?> GB SSD storage &middot; <?=e($pl['specs'][3])?> GB bandwidth</td><td><?=e(implode(', ',$pl['feats']))?></td></tr><?php endforeach; ?></table></section>
<?php elseif($secKey==='inside'): ?><section><h2>Inside <?=e($brand)?></h2><p><?=e($insideTagline)?>.</p><p>Explore <?=e(implode(", ", $insideFeatures))?> across our data centres in <?=e(implode(", ", $insideLocations))?>.</p></section>
<?php elseif($secKey==='faq'): ?><section id="faq"><h2>Frequently asked questions about <?=e($topic)?></h2><?php foreach($visibleFaqs as $f): ?><h3><?=e($f[0])?></h3><p><?=e($f[1])?></p><?php endforeach; ?></section>
<?php elseif($secKey==='testimonials'): ?><section id="testimonials"><h2>What customers say about <?=e($brand)?></h2><?php foreach($visibleTestimonials as $ti2=>$t): ?><div class="box"><p>&ldquo;<?=e($t[0])?>&rdquo;</p><p><?=e($t[1])?> &middot; <?=str_repeat('&#9733;',$myTestStars[$ti2])?></p></div><?php endforeach; ?></section>
<?php elseif($secKey==='glossary'): ?><section id="glossary"><h2>Glossary</h2><?php foreach($myGlossary as $g): ?><h3><?=e($g[0])?></h3><p><?=e($g[1])?></p><?php endforeach; ?></section>
<?php elseif($secKey==='related' && !empty($relatedLinks)): ?><section><h2>Related articles and guides</h2><div class="cards"><?php foreach($relatedLinks as $i=>$l): ?><div class="card"><div><h3><a href="<?=e($l['url'])?>"><?=e($l['label'])?></a></h3><p><?=e($relatedTopics[$i])?> - <?php if(in_array($layout,['article','guide'],true)): ?><?=e($readMinutes)?> min read, <?php endif; ?>updated <?=e($updated)?></p></div></div><?php endforeach; ?></div></section>
<?php elseif($secKey==='explore'): ?><section><h2>Explore <?=e($brand)?> - all sections</h2><ul class="links"><?php foreach($links as $l): ?><li><a href="<?=e($l['url'])?>"><?=e($l['label'])?></a></li><?php endforeach; ?></ul></section>
<?php elseif($secKey==='tags' && !empty($myTags) && !empty($extraLinks)): ?><section><h2>Tags and topics</h2><div class="tags"><?php foreach($myTags as $ti=>$t): $tl=$extraLinks[$tagLinkIdx[$ti]]; ?><a href="<?=e($tl['url'])?>" rel="tag"><?=e($t)?></a><?php endforeach; ?></div></section>
<?php elseif($secKey==='steps'): ?><section id="steps"><h2>Step by step</h2><ol><?php foreach($mySteps as $st): ?><li><?=e($st)?></li><?php endforeach; ?></ol></section>
<?php elseif($secKey==='statusboard'): ?><section id="statusboard"><h2>Current service status</h2><table><tr><th>Service</th><th>Status</th></tr><tr><td>Web hosting (<?=e($dcCities[0])?>)</td><td><?=e($statusLine)?></td></tr><tr><td>Email delivery</td><td>Running normally</td></tr><tr><td>Control panel</td><td>Running normally</td></tr><tr><td>Backups</td><td>Completed on schedule</td></tr></table><p>90-day uptime: <?=e($uptimeStr)?>% &middot; Average response time: <?=e((string)$responseMs)?> ms</p></section>
<?php elseif($secKey==='company'): ?><section id="company"><h2>About <?=e($brand)?></h2><p><?=e($brand)?> provides <?=e($topic)?> from data centres in <?=e(implode(', ',$dcCities))?>. The team looks after <?=e($sitesHosted)?> sites, answers support around the clock, and publishes its service status openly - including the incidents it would rather forget.</p><p>Working here means working on the platform our customers use every day: hosting infrastructure, the control panel, and the support desk. Roles open from time to time in engineering, support and operations.</p></section>
<?php elseif($secKey==='status'): ?><section id="status"><h2>Service status and numbers</h2><p><?=e($statusLine)?>. Uptime <?=e($uptimeStr)?>% &middot; <?=e($sitesHosted)?> sites hosted &middot; Nearest data centre: <?=e($statusDc)?> &middot; Response time: <?=e((string)$responseMs)?> ms &middot; Tagline: <?=e($statusTagline)?></p></section>
<?php endif; ?>
<?php endforeach; ?>
<?php if(in_array($layout,['article','guide','docs'],true)): ?></article><?php endif; ?></main>
<aside><h2>Popular guides</h2><p>Read our guide to <?=e($asideTopic)?>, learn about <?=e($asideDoc)?>, or browse the <?=e($asideSection)?> section.</p><h2>Member login</h2><p>Log in to join the discussion. Last activity <?=e($updated)?>.</p></aside>
<?php /* Honeypot payoff: after a form submission, show the green "Login successful" popup (auto-hides after 5s). The matching maze_session cookie was already set in SECTION 6. */ ?>
<?php if (!empty($loginSuccess)): ?><div id="hploginok" role="alert" style="position:fixed;top:16px;right:16px;background:#1a7f37;color:#fff;padding:12px 18px;border-radius:8px;z-index:9999;font-family:sans-serif;box-shadow:0 2px 8px rgba(0,0,0,.3)">Login successful</div><script>setTimeout(function(){var e=document.getElementById('hploginok');if(e){e.style.display='none';}},5000);</script><?php endif; ?>
<?php /* The hidden honeypot login form: positioned far off-screen, never shown to humans. Fields are ONLY Login email, Login username and Login password - exactly what a login form asks for (the old version also carried Website / Full name / Message fields, which no login form has - audit B8). Rendered only when the group is under 5 submissions AND the visitor sent no maze_session cookie. */ ?>
<?php if (!empty($showHiddenForm)): ?><form class="hpform" method="post" action="" style="position:absolute;left:-9999px;top:-9999px" aria-hidden="true"><input type="hidden" name="login_form" value="1"><label>Login email <input type="email" name="email" tabindex="-1" autocomplete="email"></label><label>Login username <input type="text" name="username" tabindex="-1" autocomplete="username"></label><label>Login password <input type="password" name="password" tabindex="-1" autocomplete="current-password"></label><button type="submit" tabindex="-1">Log in</button></form><?php endif; ?>
<?php /* Footer: 40 maze links under a "Sitemap" heading, each on its OWN random subdomain (see $footerSitemapLinks above), copyright line, random page reference. */ ?>
<footer><h2 style="font-size:16px">Sitemap</h2><?php foreach($footerSitemapLinks as $l): ?><a href="<?=e($l['url'])?>"><?=e($l['label'])?></a><?php endforeach; ?><p><?php foreach($legalLinks as $ll): ?><a href="<?=e($ll['url'])?>"><?=e($ll['label'])?></a><?php endforeach; ?></p><p>&copy; <?=date('Y')?> <a href="<?=e($hashLink['url'])?>"><?=e($brand)?></a>. All rights reserved. &middot; Last updated <?=e($updated)?> &middot; Ref <?=e($pageRef)?> &middot; <?=e($category)?> &middot; <?=e(implode(' | ',array_slice($myTags,0,5)))?></p></footer>
</div></body></html>
<?php
// Send the buffered body with its validators (see CACHING note above).
$bodyOut=ob_get_clean();
$etag='"'.md5($bodyOut).'"';
header('ETag: '.$etag);
header('Last-Modified: '.gmdate('D, d M Y H:i:s', $updatedTs).' GMT');
header('Cache-Control: private, max-age=300');
$inm=trim((string)($_SERVER['HTTP_IF_NONE_MATCH'] ?? ''));
if($inm!=='' && ($inm===$etag || $inm==='*')){ http_response_code(304); exit; }
echo $bodyOut;
