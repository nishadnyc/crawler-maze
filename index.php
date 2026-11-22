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
if (empty($_COOKIE['maze_visit'])) {
    // The group IS the first-seen subnet - no bot name in the cookie:
    // names are unreliable, the first-seen group is the identity.
    $groupTag = preg_replace('/[^A-Za-z0-9_.-]/', '_', $probeSubnet);
    setcookie('maze_visit', $groupTag . '__' . bin2hex(random_bytes(8)), time() + 2592000, '/');
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
function pick(array $a): string { return $a[random_int(0, count($a)-1)]; }
function picks(array $a, int $n): array { $o=[];$c=$a; for($i=0;$i<$n&&$c;$i++){ $k=random_int(0,count($c)-1); $o[]=$c[$k]; array_splice($c,$k,1);} return $o; }
function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
function slugify(string $s): string { return preg_replace('/[^a-z0-9]+/','-', strtolower($s)); }
// Collapse consecutive duplicate words (case-insensitive): "Zone Zone" ->
// "Zone", "Help Centre Centre" -> "Help Centre", "flexible, flexible" ->
// "flexible,". Doubled words are a classic generator smell (audit B2).
function dedupeWords(string $s): string { do { $prev=$s; $s=preg_replace('/\b(\w+)([\s,]+)\1\b/i', '$1', $s); } while ($s !== $prev); return $s; }

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
$taglines=['Hosting so fast, your visitors will think you hired a wizard','Uptime so good, our status page is getting bored','Servers in more places than you have socks','We reboot less than you do','Now with 100% fewer hamsters powering the servers','Your site, but awake at 3am so you do not have to be','Built for builders, loved by businesses everywhere','The hosting platform teams switch to and stay with'];
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
$statusLines=['All systems operational','No incidents reported today','All services green across all regions','Running smoothly with normal response times'];
$subWords=['support','docs','portal','status','cloud','panel','api','help','blog','secure','account','billing','dashboard','community','developer','resources','guides','updates','service','hosting','server','website','domain','email','backup','security','network','storage','database','monitor','deploy','launch','build','create','manage','control','hub','centre','zone','lab','works','studio'];
$authors=['Alex Morgan','Sarah Lee','David Chen','Emma Wilson','James Taylor','Priya Patel','Michael Brown','Lisa Garcia','Anna Kim','Mark Johnson','Sophie Turner','Ryan Clark','Nina Shah','Oliver Reed','Grace Liu','Ben Carter'];
$categories=['Hosting Guides','Cloud Technology','Web Development','Website Security','Performance','Business Growth','Tutorials','News & Updates','Case Studies','Product Updates'];
$tags=['cloud hosting','web hosting','VPS','WordPress','SSL','CDN','performance','security','backups','domains','email hosting','SEO','website speed','server management','deployment','databases','caching','uptime','scaling','migration'];
$glossary=[['Uptime','The percentage of time a server stays online and reachable.'],['CDN','A network of edge servers that delivers content closer to visitors.'],['SSL Certificate','Encrypts traffic between a browser and a server with HTTPS.'],['NVMe','Very fast storage that dramatically reduces load times.'],['Staging','A private copy of your site for testing changes safely.'],['DNS','The system that translates domain names to server addresses.']];
$keywordsExtra=['best web hosting','cheap cloud hosting','fast WordPress hosting','reliable VPS hosting','secure website hosting','hosting with free SSL','hosting with CDN','managed cloud servers','scalable hosting plans','hosting for small business','hosting for developers','hosting for ecommerce'];

// ---------------------------------------------------------------------------
// SECTION 3 - Pool expansion
// The base lists are cross-multiplied (prefixes x suffixes, adjectives x
// nouns, sections x page types, topics x year/audience suffixes, ...) so
// each pool ends up with hundreds to thousands of entries. Combined with
// random picks at render time, two identical pages are practically
// impossible - which is the whole point of the maze.
// ---------------------------------------------------------------------------
// --- Expanded combinatorial pools: hundreds to thousands per category ---
$brandPre=['Cloud','Nexa','Orbit','Prime','Vertex','Host','Panel','Sky','Nova','Aero','Blue','Core','Data','Echo','Flux','Grid','Hyper','Ion','Jet','Kite','Lumen','Metro','Nimbus','Onyx','Pixel','Quantum','Rapid','Solar','Titan','Ultra','Vivid','Wave','Xenon','Zenith','Alpha','Beta','Swift','Bright','Clear','Smart','True','Next','Pro','Max'];
$brandSuf=['Host','Cloud','Panel','Stack','Nest','Sphere','Works','Serve','Peak','Haven','Lab','Hub','Base','Forge','Link','Path','Port','Gate','Zone','Core'];
foreach($brandPre as $bp){ foreach(picks($brandSuf,3) as $bs){ $brands[]=$bp.$bs; } } $brands=array_values(array_unique($brands));
$topicPre=['cloud','website','server','app','database','email','domain','WordPress','VPS','dedicated','shared','managed','secure','fast','scalable','enterprise','developer','ecommerce','business','startup'];
$topicSuf=['hosting','management','infrastructure','deployment','automation','monitoring','security','storage','delivery','solutions','platform','services','tools','migration','optimization','backups'];
foreach($topicPre as $tp){ foreach(picks($topicSuf,4) as $ts){ $topics[]=$tp.' '.$ts; } } $topics=array_values(array_unique($topics));
foreach($adjectives as $a){ foreach($nouns as $n){ $features[]=$a.' '.$n.' management'; $features[]=$a.' '.$n.' protection'; } } $features=array_values(array_unique($features));
foreach($sections as $s){ foreach(['guide','hub','centre','portal','lab','index','overview'] as $x){ $docPages[]=$s.'-'.$x; } } $docPages=array_values(array_unique($docPages));
foreach($blogTopics as $b){ foreach(['in 2024','in 2025','in 2026','for beginners','for businesses','step by step','explained simply','with examples','like a pro','on a budget'] as $x){ $blogTopics[]=$b.' '.$x; } } $blogTopics=array_values(array_unique($blogTopics));
foreach($subWords as $w){ foreach(['hub','lab','zone','base','port','works','online','central','direct','plus'] as $x){ if(random_int(0,3)===0) $subWords[]=$w.'-'.$x; } } $subWords=array_values(array_unique($subWords));
$firstNames=['Alex','Sarah','David','Emma','James','Priya','Michael','Lisa','Anna','Mark','Sophie','Ryan','Nina','Oliver','Grace','Ben','Tom','Kate','Sam','Mia','Leo','Zoe','Adam','Eva','Chris','Dana','Paul','Ruth','Hugo','Ivy'];
$lastNames=['Morgan','Lee','Chen','Wilson','Taylor','Patel','Brown','Garcia','Kim','Johnson','Turner','Clark','Shah','Reed','Liu','Carter','Moore','Hall','Young','King','Scott','Green','Baker','Adams','Nelson','Hill','Ramirez','Campbell','Mitchell','Carter'];
foreach($firstNames as $fn){ $authors[]=$fn.' '.pick($lastNames); } $authors=array_values(array_unique($authors));
foreach($tags as $tg){ foreach(['guide','tips','tutorial','checklist','best practices','for beginners','advanced','2026'] as $x){ $tags[]=$tg.' '.$x; } } $tags=array_values(array_unique($tags));
foreach($faqPairs as $f){} // keep base, combos generated at render from templates below
$sentenceStarters=['For teams of every size','Whether you are just starting out','From day one','In practice','For most websites','When speed matters','For growing businesses','With the right setup','For developers and creators alike','In a crowded market','For anyone moving online','When reliability counts'];
$sentenceMiddles=['the right hosting choice saves time, money and stress','a fast server changes how visitors feel about your brand','good infrastructure quietly does the heavy lifting','clear pricing and honest support make all the difference','automation removes the boring parts of running a site','security and backups protect months of hard work','scaling should be a button, not a migration project','monitoring catches problems before your customers do'];
$sentenceEnders=['and that is exactly what we built for.','which is why so many projects start here.','without lock-ins, surprises or jargon.','with help available whenever you need it.','so you can focus on the work that matters.','and it shows in every load time.'];
// Expand paragraphs combinatorially: 12 starters x 8 middles x 6 enders = 576 combos, plus features/topics mixed in
for($i=0;$i<24;$i++){ $paragraphs[]=pick($sentenceStarters).', '.pick($sentenceMiddles).' Our '.pick($nouns).' brings '.implode(', ', picks($features,3)).' together for '.pick($topics).' in '.pick($locations).' — '.pick($sentenceEnders); }



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
if (!empty($_COOKIE['maze_visit'])) {
    $cp = explode('__', (string)$_COOKIE['maze_visit']);
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
if (!empty($_COOKIE['maze_session'])) $showHiddenForm = false;
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
                $sessTok = bin2hex(random_bytes(16)); setcookie('maze_session', $sessTok, time() + 2592000, '/'); $loginSuccess = true;
                if (!isset($grp['form_posts']) || !is_array($grp['form_posts'])) $grp['form_posts'] = [];
                $fd = []; foreach (['email','username','password'] as $fn) { if (isset($_POST[$fn])) $fd[$fn] = substr(trim((string)$_POST[$fn]), 0, 120); }
                $grp['form_posts'][] = ['ts' => $nowTs, 'host' => $host, 'path' => substr($requestPath, 0, 120), 'data' => $fd];
            } else { $grp['form_submissions_blocked'] = (int)($grp['form_submissions_blocked'] ?? 0) + 1; }
        }
        $showHiddenForm = ($formCount < 5) && empty($_COOKIE['maze_session']);
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
    echo base64_decode('AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAQAQAAAAAAAAAAAAAAAAAAAAAAAD4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/+L04//i9OP/4vTj/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA==');
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
$mazePathOk = ($requestPath === '/' || $requestPath === '/robots.txt' || str_ends_with($requestPath, 'sitemap.xml'));
if ($probePath) $mazePathOk = false;
if (!$mazePathOk) {
    $pseg = explode('/', trim($requestPath, '/'));
    if (count($pseg) === 3 && in_array($pseg[0], $sections, true)
        && preg_match('/^[a-z0-9]+(-[a-z0-9]+)*$/', $pseg[1])
        && preg_match('/^\d{4}$/', $pseg[2]) && (int)$pseg[2] >= 2000 && (int)$pseg[2] <= 3000) $mazePathOk = true;
}
if (!$mazePathOk) {
    http_response_code(404);
    header('Content-Type: text/html; charset=UTF-8');
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>404 Not Found - ' . e($currentName) . '</title></head><body style="font-family:system-ui,sans-serif;margin:64px auto;max-width:640px;padding:0 24px"><h1>404 Not Found</h1><p>The page you requested could not be found. It may have been moved or deleted.</p><p><a href="/">Return to the homepage</a></p></body></html>';
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
    echo "User-agent: *\nAllow: /\n\n";
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
    // <2000-3000>) - buildUrl itself uses random_int and cannot be
    // seeded. lastmod dates spread over the same wide 2-900 day range
    // as page dates instead of all landing within the last 5 days.
    mt_srand(crc32($host . '|' . $todayStr));
    $smPick = function (array $a) { return $a[mt_rand(0, count($a) - 1)]; };
    $smUsed = []; $smLinks = []; $tries = 0;
    while (count($smLinks) < 50 && $tries < 1000) {
        $tries++;
        $spath = '/' . $smPick($sections) . '/' . trim(slugify(titleWords($smPick($docPages))), '-') . '/' . mt_rand(2000, 3000);
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
$rawLinkCookie = (string)($_COOKIE['maze_link'] ?? '');
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
    setcookie('maze_link', $linkDomain . '__' . $nowTs, $linkCookieOpts);
} elseif ($nowTs - $cookieLinkTs >= 5) {
    // This visitor's 5 seconds are up: generate ONE new random
    // subdomain (same word style buildUrl() uses for siblings),
    // update ONLY this visitor's cookie to it + a fresh timestamp,
    // and point all their links at it for the next 5 seconds.
    $w = pick($subWords); if (random_int(0, 2) === 0) $w .= '-' . pick($subWords);
    $linkDomain = $w . '.' . $baseDomain;
    setcookie('maze_link', $linkDomain . '__' . $nowTs, $linkCookieOpts);
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
function buildUrl($scheme,$baseDomain,$port,$subWords,$sections,$docPages,$linkHost=null): array { if($linkHost!==null && $linkHost!==''){ $w=explode('.',$linkHost)[0]; $urlHost=$linkHost; } else { $w=pick($subWords); if(random_int(0,2)===0) $w.='-'.pick($subWords); $urlHost=$w.'.'.$baseDomain; } $s=pick($sections); $slug=trim(slugify(titleWords(pick($docPages))),'-'); if($slug==='') $slug=$s; $path='/'.$s.'/'.$slug.'/'.random_int(2000,3000); $pt=pathTitle($path); $label=titleWords($w); if($pt!=='') $label.=' '.$pt; $label=dedupeWords($label); return ['label'=>$label,'url'=>$scheme.'://'.$urlHost.$port.$path,'path'=>$path,'section'=>$s]; }
// De-duplicates by URL (via $used, shared across lists) AND by label
// within the returned list, so every visible title in one list is
// distinct even though the trailing path number is not part of it.
function uniqueLinks($n,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,&$used,$linkHost=null): array { $out=[];$tries=0;$labels=[]; while(count($out)<$n&&$tries<$n*40){ $tries++; $c=buildUrl($scheme,$baseDomain,$port,$subWords,$sections,$docPages,$linkHost); if(isset($used[$c['url']])||isset($labels[$c['label']])) continue; $used[$c['url']]=true; $labels[$c['label']]=true; $out[]=$c; } return $out; }

$brand=pick($brands); $topic=pick($topics); $category=pick($categories);
$title=$brand.' - '.ucwords($topic);
$heading=ucwords(pick($adjectives)).' '.$topic.' with '.$brand;
$myFeatures=picks($features,8); $myTags=picks($tags,14); $myKeywords=array_merge(picks($keywordsExtra,8), $myTags, [$topic,$brand.' hosting', $currentName]);
$description=dedupeWords($brand.' - '.$heading.'. Explore '.$topic.', '.implode(', ',array_slice($myFeatures,0,4)).', pricing, documentation, guides and support. Trusted hosting in '.pick($locations).' and worldwide.');
$myFaqs=picks($faqPairs,5); $myTestimonials=picks($testimonials,3); $myGlossary=picks($glossary,4);

$featA=picks($features,2); $featB=picks($features,2); $featC=picks($features,2); $adjA=picks($adjectives,2); $locA=picks($locations,3); $topicA=picks($blogTopics,3);
$paragraphs=["$brand makes $topic simple. Our ".pick($nouns)." is built for people who want their project online without spending hours on setup and maintenance, with ".$featA[0]." and ".$featA[1]." included as standard.","Every plan includes ".$myFeatures[0].", ".$myFeatures[1].", and ".$myFeatures[2].", so you can focus on building while we handle the ".pick($nouns).". Compare plans, read real reviews, and explore our ".pick($sections)." for details.","Whether you are launching your first site or moving an existing project, our ".pick($nouns)." gives you a ".$adjA[0].", ".$adjA[1]." home for it, with support available whenever you need a hand and data centres in ".$locA[0].", ".$locA[1]." and ".$locA[2].".","Explore our documentation and guides below to learn more about ".pick($docPages).", or check the current service status and the latest updates from the team. Topics include ".$topicA[0].", ".$topicA[1]." and ".$topicA[2].".","Performance matters. With ".$featB[0].", ".$featB[1]." and ".pick($nouns)." optimisation, pages load faster, rankings improve, and visitors stay longer. That is why businesses choose $brand for $topic.","Security is built in, not bolted on. Every account gets ".$featC[0].", ".$featC[1]." and regular checks, plus daily backups you can restore in one click from your ".pick($nouns).".","Need to scale? Start small and grow without migrating. Upgrade your ".pick($nouns)." instantly, add more storage, bandwidth and databases, and keep the same dashboard, support team and pricing clarity.","Our ".pick($sections)." section is updated weekly with new ".pick($docPages)." walkthroughs, ".pick($blogTopics)." advice, and honest comparisons to help you choose the right $topic plan for your budget."];
$paragraphs=picks($paragraphs,count($paragraphs));
$paragraphs=array_map('dedupeWords',$paragraphs);

$author=pick($authors); $pubAge=random_int(2,900)*86400+random_int(0,86399); $publishedTs=$nowTs-$pubAge; $updatedTs=$publishedTs+random_int(3600,max(7200,$pubAge-3600)); if($updatedTs>$nowTs) $updatedTs=$nowTs;
$published=date('F j, Y',$publishedTs); $updated=date('F j, Y',$updatedTs); $publishedIso=date('c',$publishedTs); $updatedIso=date('c',$updatedTs);
$readMinutes=random_int(4,18); $commentCount=random_int(0,89); $viewCount=number_format(random_int(180,98000)); $rating=(random_int(38,50)/10); $reviewCount=random_int(120,4800);
// Footer Ref is derived from host+path, so the same URL shows the same
// Ref on every load (audit B10) instead of re-rolling per request.
$pageRef=substr(md5($host.'|'.$requestPath),0,18);

$used=[]; $mainLink=buildUrl($scheme,$baseDomain,$port,$subWords,$sections,$docPages,$linkDomain); $used[$mainLink['url']]=true;
$links=uniqueLinks(80,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,$used,$linkDomain);
// EXPLORE LABEL PREFIXES (Nishad 2026-11-22): buildUrl() derives each
// label from the link's HOST, and every Explore link sits on the one
// cookie/link domain - so all 80 labels opened with the SAME two
// words (host create-base.* gave "Create Base Features", "Create
// Base Reviews", ...). The URL behaviour does NOT change: Explore
// hrefs stay on the visitor's cookie link domain exactly as before.
// Only the visible label prefix is replaced, per link, with a fresh
// random name drawn the same way buildUrl() picks random subdomain
// words (a $subWords pick, sometimes hyphen-joined to a second one),
// de-duplicated across the section and never equal to the old fixed
// prefix - e.g. "Vivid Nest Features", "Cloud Works Reviews". The
// path-derived part of the label is kept as-is. Scoped to the
// Explore list ($links) ONLY: footer Sitemap labels, the hash
// copyright link and all other lists keep their existing rules.
$exploreOldPrefix=titleWords(explode('.',$linkDomain)[0]); $explorePrefixes=[];
foreach($links as &$exploreLink){ $explorePt=pathTitle($exploreLink['path']); $explorePrefix=''; $exploreTries=0; while($exploreTries<200){ $exploreTries++; $exploreW=pick($subWords); if(random_int(0,2)===0) $exploreW.='-'.pick($subWords); $exploreCand=titleWords($exploreW); if($exploreCand===$exploreOldPrefix || isset($explorePrefixes[$exploreCand])) continue; $explorePrefix=$exploreCand; break; } if($explorePrefix==='') $explorePrefix=titleWords(pick($subWords)).' '.random_int(2000,3000); $explorePrefixes[$explorePrefix]=true; $exploreLink['label']=dedupeWords($explorePrefix.($explorePt!==''?' '.$explorePt:'')); }
unset($exploreLink);
$extraLinks=uniqueLinks(18,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,$used,$linkDomain);
$relatedLinks=uniqueLinks(6,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,$used,$linkDomain);
// RELATED LABEL PREFIXES (Nishad 2026-11-22): same fix as the Explore
// list above, scoped to the "Related articles and guides" cards
// ($relatedLinks) ONLY. buildUrl() derives each label from the link's
// HOST, and every Related link sits on the one cookie/link domain -
// so all 6 card labels opened with the SAME two words (the cookie
// domain's name). The URL behaviour does NOT change: Related hrefs
// stay on the visitor's cookie link domain exactly as before. Only
// the visible label prefix is replaced, per link, with a fresh
// random name drawn the same way buildUrl() picks random subdomain
// words (a $subWords pick, sometimes hyphen-joined to a second one),
// de-duplicated across the 6 cards and never equal to the old fixed
// prefix. The path-derived part of the label is kept as-is.
$relatedOldPrefix=titleWords(explode('.',$linkDomain)[0]); $relatedPrefixes=[];
foreach($relatedLinks as &$relatedLink){ $relatedPt=pathTitle($relatedLink['path']); $relatedPrefix=''; $relatedTries=0; while($relatedTries<200){ $relatedTries++; $relatedW=pick($subWords); if(random_int(0,2)===0) $relatedW.='-'.pick($subWords); $relatedCand=titleWords($relatedW); if($relatedCand===$relatedOldPrefix || isset($relatedPrefixes[$relatedCand])) continue; $relatedPrefix=$relatedCand; break; } if($relatedPrefix==='') $relatedPrefix=titleWords(pick($subWords)).' '.random_int(2000,3000); $relatedPrefixes[$relatedPrefix]=true; $relatedLink['label']=dedupeWords($relatedPrefix.($relatedPt!==''?' '.$relatedPt:'')); }
unset($relatedLink);
$footerLinks=uniqueLinks(40,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,$used,$linkDomain);
$navLinks=uniqueLinks(8,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,$used,$linkDomain);

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
function makeHashLabel(): string { $len=random_int(6,7); $hyphPos=(random_int(0,1)===0)?random_int(2,$len-3):-1; $chars='abcdefghijklmnopqrstuvwxyz0123456789'; $out=''; $hasLetter=false; $hasDigit=false; for($i=0;$i<$len;$i++){ if($i===$hyphPos){ $out.='-'; continue; } $ch=$chars[random_int(0,strlen($chars)-1)]; if(ctype_alpha($ch)) $hasLetter=true; else $hasDigit=true; $out.=$ch; } if(!$hasLetter||!$hasDigit){ return makeHashLabel(); } return $out; }
$hashLink=null; $hashTries=0;
while($hashLink===null && $hashTries<100){ $hashTries++; $hashHost=makeHashLabel().'.'.$baseDomain; if($hashHost===$linkDomain || $hashHost===$host || isset($footerHosts[$hashHost])) continue; $hc=buildUrl($scheme,$baseDomain,$port,$subWords,$sections,$docPages,$hashHost); if(isset($used[$hc['url']])) continue; $used[$hc['url']]=true; $hashLink=$hc; }
if($hashLink===null){ $hashLink=['url'=>$canonical,'label'=>$brand,'path'=>$requestPath,'section'=>'']; }


$planName=pick($planNames);
$plans=[]; $ladderCents=random_int(199,999); foreach(picks($planNames,3) as $pn){ $plans[]=['name'=>$pn,'price'=>number_format($ladderCents/100,2),'feats'=>picks($features,4)]; $ladderCents+=random_int(200,1500); }
$planPrice=$plans[0]['price'];
$includedPlan=$plans[1]['name'];

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
 ['@type'=>'WebPage','name'=>$title,'description'=>$description,'url'=>$canonical,'inLanguage'=>'en','datePublished'=>$publishedIso,'dateModified'=>$updatedIso],
];
// Homepage is a website, not an article: only non-home pages get the
// BlogPosting node in their structured data.
if(!$isHome) $ldGraph[]=['@type'=>'BlogPosting','headline'=>$heading,'description'=>$description,'author'=>['@type'=>'Person','name'=>$author],'publisher'=>['@type'=>'Organization','name'=>$brand,'url'=>$canonical],'datePublished'=>$publishedIso,'dateModified'=>$updatedIso,'articleSection'=>$category,'keywords'=>implode(', ',$myKeywords),'wordCount'=>$wordCount,'timeRequired'=>'PT'.$readMinutes.'M'];
$ld=['@context'=>'https://schema.org','@graph'=>array_merge($ldGraph,[
 ['@type'=>'FAQPage','mainEntity'=>array_map(fn($f)=>['@type'=>'Question','name'=>$f[0],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f[1]]],$myFaqs)],
 ['@type'=>'Product','name'=>$brand.' '.ucwords($topic),'description'=>$description,'brand'=>['@type'=>'Brand','name'=>$brand],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>$reviewCount],'offers'=>['@type'=>'Offer','price'=>$planPrice,'priceCurrency'=>'USD','availability'=>'https://schema.org/InStock','url'=>$canonical]],
 ['@type'=>'ItemList','name'=>'Explore '.$brand,'itemListElement'=>array_map(fn($i,$l)=>['@type'=>'ListItem','position'=>$i+1,'name'=>$l['label'],'url'=>$l['url']],array_keys(array_slice($links,0,12)),array_slice($links,0,12))],
])];
$ldJson=json_encode($ld, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
$geoPlace=$geoPlaces[random_int(0,count($geoPlaces)-1)];
// Accent colour varies per page from a small palette so the inline
// <style> block is not byte-identical across pages/brands (audit A4).
$accent=pick(['#38bdf8','#34d399','#fbbf24','#f472b6','#a78bfa','#fb923c']);

// Response headers: never cache (every load must be a fresh page) and a
// Link header pointing at the canonical URL.
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0'); header('Pragma: no-cache'); header('Expires: 0'); header('Content-Type: text/html; charset=UTF-8');
header('Link: <'.$canonical.'>; rel="canonical"');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?=e($title)?></title>
<meta name="description" content="<?=e($description)?>">
<meta name="keywords" content="<?=e(implode(', ',$myKeywords))?>">
<meta name="author" content="<?=e($author)?>"><meta name="publisher" content="<?=e($brand)?>">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="googlebot" content="index, follow"><meta name="bingbot" content="index, follow">
<meta name="rating" content="general"><meta name="revisit-after" content="1 days"><meta name="language" content="English">
<meta name="geo.region" content="<?=e($geoPlace['region'])?>"><meta name="geo.placename" content="<?=e($geoPlace['name'])?>">
<meta name="theme-color" content="#0f172a"><meta name="category" content="<?=e($category)?>">
<link rel="canonical" href="<?=e($canonical)?>">
<link rel="alternate" hreflang="en" href="<?=e($canonical)?>"><link rel="alternate" hreflang="x-default" href="<?=e($canonical)?>">
<meta property="og:type" content="<?=$isHome?'website':'article'?>"><meta property="og:title" content="<?=e($title)?>"><meta property="og:description" content="<?=e($description)?>">
<meta property="og:url" content="<?=e($canonical)?>"><meta property="og:site_name" content="<?=e($brand)?>"><meta property="og:locale" content="en_US">
<?php if(!$isHome): ?><meta property="article:published_time" content="<?=e($publishedIso)?>"><meta property="article:modified_time" content="<?=e($updatedIso)?>">
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
<p style="margin-top:16px;font-size:13px;color:#94a3b8"><a href="/">Home</a> &rsaquo; <a href="<?=e($canonical)?>"><?=e($category)?></a> &rsaquo; <?=e($currentName)?></p></header>
<main><?php if(!$isHome): ?><article>
<h1><?=e($heading)?></h1>
<div class="meta">By <?=e($author)?> at <?=e($brand)?> &middot; Published <time datetime="<?=e($publishedIso)?>"><?=e($published)?></time> &middot; Last updated <time datetime="<?=e($updatedIso)?>"><?=e($updated)?></time><br><?=e((string)$readMinutes)?> min read &middot; <?=e($viewCount)?> views &middot; Rated <?=$rating?>/5 from <?=number_format($reviewCount)?> reviews &middot; Category: <?=e($category)?></div>
<?php else: ?>
<h1><?=e($heading)?></h1>
<?php endif; ?>
<?php foreach(array_slice($paragraphs,0,3) as $p): ?><p><?=e($p)?></p><?php endforeach; ?>
<a class="btn" href="<?=e($mainLink['url'])?>">Visit <?=e($mainLink['label'])?></a>
<h2>On this page</h2><ul><?php foreach([['features','Key features'],['pricing','Pricing plans'],['faq','Frequently asked questions'],['testimonials','What customers say'],['glossary','Glossary'],['status','Service status']] as $otp): ?><li><a href="#<?=e($otp[0])?>"><?=e($otp[1])?> - <?=e($topic)?></a></li><?php endforeach; ?></ul>
<?php foreach(array_slice($paragraphs,3) as $p): ?><p><?=e($p)?></p><?php endforeach; ?>

<section id="features"><h2>Key features of <?=e($brand)?> <?=e($topic)?></h2><ul><?php foreach($myFeatures as $f): ?><li><?=e(ucfirst($f))?> - included with <?=e($includedPlan)?> plans and above</li><?php endforeach; ?></ul></section>

<section id="pricing"><h2>Pricing plans compared</h2><table><tr><th>Plan</th><th>Price / month</th><th>Includes</th></tr><?php foreach($plans as $pl): ?><tr><td><?=e($pl['name'])?></td><td>$<?=e($pl['price'])?></td><td><?=e(implode(', ',$pl['feats']))?></td></tr><?php endforeach; ?></table></section>

<section><h2>Inside <?=e($brand)?></h2><p><?=e(pick($taglines))?> Explore <?=e(implode(", ", picks($features,5)))?> in <?=e(implode(", ", picks($locations,3)))?>.</p></section>

<section id="faq"><h2>Frequently asked questions about <?=e($topic)?></h2><?php foreach($myFaqs as $f): ?><h3><?=e($f[0])?></h3><p><?=e($f[1])?></p><?php endforeach; ?></section>

<section id="testimonials"><h2>What customers say about <?=e($brand)?></h2><?php foreach($myTestimonials as $t): ?><div class="box"><p>&ldquo;<?=e($t[0])?>&rdquo;</p><p><?=e($t[1])?> &middot; <?=str_repeat('&#9733;',random_int(4,5))?></p></div><?php endforeach; ?></section>

<section id="glossary"><h2>Glossary</h2><?php foreach($myGlossary as $g): ?><h3><?=e($g[0])?></h3><p><?=e($g[1])?></p><?php endforeach; ?></section>

<section><h2>Related articles and guides</h2><div class="cards"><?php foreach($relatedLinks as $i=>$l): ?><div class="card"><div><h3><a href="<?=e($l['url'])?>"><?=e($l['label'])?></a></h3><p><?=e(pick($blogTopics))?> - <?=e($readMinutes)?> min read, updated <?=e($updated)?></p></div></div><?php endforeach; ?></div></section>

<section><h2>Explore <?=e($brand)?> - all sections</h2><ul class="links"><?php foreach($links as $l): ?><li><a href="<?=e($l['url'])?>"><?=e($l['label'])?></a></li><?php endforeach; ?></ul></section>

<section><h2>Tags and topics</h2><div class="tags"><?php foreach($myTags as $t): $tl=$extraLinks[random_int(0,count($extraLinks)-1)]; ?><a href="<?=e($tl['url'])?>" rel="tag"><?=e($t)?></a><?php endforeach; ?></div></section>

<section id="status"><h2>Service status and numbers</h2><p><?=e(pick($statusLines))?>. Uptime 98.<?=random_int(10,99)?>% &middot; <?=number_format(random_int(1200,98000))?> sites hosted &middot; Nearest data centre: <?=e(pick($locations))?> &middot; Response time: <?=random_int(12,240)?> ms &middot; Tagline: <?=e(pick($taglines))?></p></section>
<?php if(!$isHome): ?></article><?php endif; ?></main>
<aside><h2>Popular guides</h2><p>Read our guide to <?=e(pick($blogTopics))?>, learn about <?=e(pick($docPages))?>, or browse the <?=e(pick($sections))?> section.</p><h2>Comments (<?=e((string)$commentCount)?>)</h2><p>Join the discussion. Last activity <?=e($updated)?>.</p></aside>
<?php /* Honeypot payoff: after a form submission, show the green "Login successful" popup (auto-hides after 5s). The matching maze_session cookie was already set in SECTION 6. */ ?>
<?php if (!empty($loginSuccess)): ?><div id="hploginok" role="alert" style="position:fixed;top:16px;right:16px;background:#1a7f37;color:#fff;padding:12px 18px;border-radius:8px;z-index:9999;font-family:sans-serif;box-shadow:0 2px 8px rgba(0,0,0,.3)">Login successful</div><script>setTimeout(function(){var e=document.getElementById('hploginok');if(e){e.style.display='none';}},5000);</script><?php endif; ?>
<?php /* The hidden honeypot login form: positioned far off-screen, never shown to humans. Fields are ONLY Login email, Login username and Login password - exactly what a login form asks for (the old version also carried Website / Full name / Message fields, which no login form has - audit B8). Rendered only when the group is under 5 submissions AND the visitor sent no maze_session cookie. */ ?>
<?php if (!empty($showHiddenForm)): ?><form class="hpform" method="post" action="" style="position:absolute;left:-9999px;top:-9999px" aria-hidden="true"><input type="hidden" name="login_form" value="1"><label>Login email <input type="email" name="email" tabindex="-1" autocomplete="email"></label><label>Login username <input type="text" name="username" tabindex="-1" autocomplete="username"></label><label>Login password <input type="password" name="password" tabindex="-1" autocomplete="current-password"></label><button type="submit" tabindex="-1">Log in</button></form><?php endif; ?>
<?php /* Footer: 40 maze links under a "Sitemap" heading, each on its OWN random subdomain (see $footerSitemapLinks above), copyright line, random page reference. */ ?>
<footer><h2 style="font-size:16px">Sitemap</h2><?php foreach($footerSitemapLinks as $l): ?><a href="<?=e($l['url'])?>"><?=e($l['label'])?></a><?php endforeach; ?><p>&copy; <?=date('Y')?> <a href="<?=e($hashLink['url'])?>"><?=e($brand)?></a>. All rights reserved. &middot; Last updated <?=e($updated)?> &middot; Ref <?=e($pageRef)?> &middot; <?=e($category)?> &middot; <?=e(implode(' | ',array_slice($myTags,0,5)))?></p></footer>
</div></body></html>
