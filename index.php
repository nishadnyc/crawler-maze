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
function slugify(string $s): string { return strtolower(preg_replace('/[^a-z0-9]+/','-', $s)); }

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
$locations=['London','Frankfurt','New York','Toronto','Singapore','Sydney','Amsterdam','Chicago','Tokyo','Mumbai','Paris','Dallas','Los Angeles','Seattle','Virginia','Ohio','Ireland','Netherlands','Germany','India','Australia','Canada','Brazil','South Korea','Japan'];
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
foreach($locations as $l){ foreach(['North','South','East','West','Central'] as $d){ $locations[]=$d.' '.$l; } } $locations=array_values(array_unique($locations));
$firstNames=['Alex','Sarah','David','Emma','James','Priya','Michael','Lisa','Anna','Mark','Sophie','Ryan','Nina','Oliver','Grace','Ben','Tom','Kate','Sam','Mia','Leo','Zoe','Adam','Eva','Chris','Dana','Paul','Ruth','Hugo','Ivy'];
$lastNames=['Morgan','Lee','Chen','Wilson','Taylor','Patel','Brown','Garcia','Kim','Johnson','Turner','Clark','Shah','Reed','Liu','Carter','Moore','Hall','Young','King','Scott','Green','Baker','Adams','Nelson','Hill','Ramirez','Campbell','Mitchell','Carter'];
foreach($firstNames as $fn){ $authors[]=$fn.' '.pick($lastNames); } $authors=array_values(array_unique($authors));
foreach($tags as $tg){ foreach(['guide','tips','tutorial','checklist','best practices','for beginners','advanced','2026'] as $x){ $tags[]=$tg.' '.$x; } } $tags=array_values(array_unique($tags));
foreach($faqPairs as $f){} // keep base, combos generated at render from templates below
$sentenceStarters=['For teams of every size','Whether you are just starting out','From day one','In practice','For most websites','When speed matters','For growing businesses','With the right setup','For developers and creators alike','In a crowded market','For anyone moving online','When reliability counts'];
$sentenceMiddles=['the right hosting choice saves time, money and stress','a fast server changes how visitors feel about your brand','good infrastructure quietly does the heavy lifting','clear pricing and honest support make all the difference','automation removes the boring parts of running a site','security and backups protect months of hard work','scaling should be a button, not a migration project','monitoring catches problems before your customers do'];
$sentenceEnders=['and that is exactly what we built for.','which is why so many projects start here.','without lock-ins, surprises or jargon.','with help available whenever you need it.','so you can focus on the work that matters.','and it shows in every load time.'];
// Expand paragraphs combinatorially: 12 starters x 8 middles x 6 enders = 576 combos, plus features/topics mixed in
for($i=0;$i<24;$i++){ $paragraphs[]=pick($sentenceStarters).', '.pick($sentenceMiddles).' Our '.pick($nouns).' brings '.pick($features).', '.pick($features).' and '.pick($features).' together for '.pick($topics).' in '.pick($locations).' — '.pick($sentenceEnders); }



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
        // Honeypot: a POST with the contact_form marker is a form submission.
        // The first 5 per group are logged in full (host, path, timestamp and
        // the submitted field values, trimmed to 120 chars each); each also
        // earns the "Login successful" popup + a maze_session cookie.
        // Submissions past 5 are only counted (form_submissions_blocked).
        $formCount = (int)($grp['form_submissions'] ?? 0);
        if ((($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') && isset($_POST['contact_form'])) {
            if ($formCount < 5) {
                $grp['form_submissions'] = $formCount + 1; $formCount++;
                $sessTok = bin2hex(random_bytes(16)); setcookie('maze_session', $sessTok, time() + 2592000, '/'); $loginSuccess = true;
                if (!isset($grp['form_posts']) || !is_array($grp['form_posts'])) $grp['form_posts'] = [];
                $fd = []; foreach (['name','email','username','password','website','message'] as $fn) { if (isset($_POST[$fn])) $fd[$fn] = substr(trim((string)$_POST[$fn]), 0, 120); }
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
    $smUsed = [];
    $smLinks = []; $tries=0; while(count($smLinks)<50 && $tries<1000){ $tries++; $c=buildUrl($scheme,$baseDomain,$port,$subWords,$sections,$docPages); if(isset($smUsed[$c['path']])) continue; $smUsed[$c['path']]=true; $c['url']=$scheme.'://'.$host.$port.$c['path']; $smLinks[]=$c; }
    $freqs = ['daily', 'weekly', 'monthly'];
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    echo '<url><loc>' . e($scheme . '://' . $host . $port . '/') . '</loc><lastmod>' . date('Y-m-d') . '</lastmod><changefreq>daily</changefreq><priority>1.0</priority></url>' . "\n";
    foreach ($smLinks as $l) {
        $lm = date('Y-m-d', time() - random_int(0, 5) * 86400 - random_int(0, 86399));
        $pr = number_format(random_int(40, 95) / 100, 1);
        echo '<url><loc>' . e($l['url']) . '</loc><lastmod>' . $lm . '</lastmod><changefreq>' . pick($freqs) . '</changefreq><priority>' . $pr . '</priority></url>' . "\n";
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

// Build one maze URL: section + optional doc page + trailing random
// number, on the visitor's cookie link domain when one is given (label comes from
// that domain's first label), otherwise on a random sibling subdomain
// (the sitemap builder uses this and then overrides the host anyway).
// Returns label, full URL, path, section.
function buildUrl($scheme,$baseDomain,$port,$subWords,$sections,$docPages,$linkHost=null): array { if($linkHost!==null && $linkHost!==''){ $w=explode('.',$linkHost)[0]; $urlHost=$linkHost; } else { $w=pick($subWords); if(random_int(0,2)===0) $w.='-'.pick($subWords); $urlHost=$w.'.'.$baseDomain; } $s=pick($sections); $path='/'.$s; if(in_array($s,['docs','guides','tutorials','blog','knowledge-base'],true)&&random_int(0,1)) $path.='/'.pick($docPages); if(random_int(0,3)===0) $path.='/'.pick($docPages); $path.='/'.random_int(2000,3000); return ['label'=>ucwords(str_replace('-',' ',$w)),'url'=>$scheme.'://'.$urlHost.$port.$path,'path'=>$path,'section'=>$s]; }
function uniqueLinks($n,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,&$used,$linkHost=null): array { $out=[];$tries=0; while(count($out)<$n&&$tries<$n*20){ $tries++; $c=buildUrl($scheme,$baseDomain,$port,$subWords,$sections,$docPages,$linkHost); if(isset($used[$c['url']])) continue; $used[$c['url']]=true; $out[]=$c; } return $out; }

$brand=pick($brands); $topic=pick($topics); $category=pick($categories);
$title='Welcome to '.$currentName.' - '.ucwords($topic).' | '.$brand.' '.ucwords(pick($topics));
$heading=ucwords(pick($adjectives)).' '.$topic.' with '.$brand;
$myFeatures=picks($features,8); $myTags=picks($tags,14); $myKeywords=array_merge(picks($keywordsExtra,8), $myTags, [$topic,$brand.' hosting', $currentName]);
$description=$brand.' - '.$heading.'. Explore '.$topic.', '.implode(', ',array_slice($myFeatures,0,4)).', pricing, documentation, guides and support. Trusted hosting in '.pick($locations).' and worldwide.';
$myFaqs=picks($faqPairs,5); $myTestimonials=picks($testimonials,3);

$paragraphs=["$brand makes $topic simple. Our ".pick($nouns)." is built for people who want their project online without spending hours on setup and maintenance, with ".pick($features)." and ".pick($features)." included as standard.","Every plan includes ".$myFeatures[0].", ".$myFeatures[1].", and ".$myFeatures[2].", so you can focus on building while we handle the ".pick($nouns).". Compare plans, read real reviews, and explore our ".pick($sections)." for details.","Whether you are launching your first site or moving an existing project, our ".pick($nouns)." gives you a ".pick($adjectives).", ".pick($adjectives)." home for it, with support available whenever you need a hand and data centres in ".pick($locations).", ".pick($locations)." and ".pick($locations).".","Explore our documentation and guides below to learn more about ".pick($docPages).", or check the current service status and the latest updates from the team. Topics include ".pick($blogTopics).", ".pick($blogTopics)." and ".pick($blogTopics).".","Performance matters. With ".pick($features).", ".pick($features)." and ".pick($nouns)." optimisation, pages load faster, rankings improve, and visitors stay longer. That is why businesses choose $brand for $topic.","Security is built in, not bolted on. Every account gets ".pick($features).", ".pick($features)." and regular checks, plus daily backups you can restore in one click from your ".pick($nouns).".","Need to scale? Start small and grow without migrating. Upgrade your ".pick($nouns)." instantly, add more storage, bandwidth and databases, and keep the same dashboard, support team and pricing clarity.","Our ".pick($sections)." section is updated weekly with new ".pick($docPages)." walkthroughs, ".pick($blogTopics)." advice, and honest comparisons to help you choose the right $topic plan for your budget."];
$paragraphs=picks($paragraphs,count($paragraphs));

$author=pick($authors); $publishedTs=time()-random_int(2,180)*86400-random_int(0,86399); $updatedTs=$publishedTs+random_int(1,45)*86400+random_int(0,86399); if($updatedTs>time()) $updatedTs=time()-random_int(3600,86400);
$published=date('F j, Y',$publishedTs); $updated=date('F j, Y',$updatedTs); $publishedIso=date('c',$publishedTs); $updatedIso=date('c',$updatedTs);
$readMinutes=random_int(4,18); $commentCount=random_int(0,89); $viewCount=number_format(random_int(180,98000)); $rating=(random_int(42,50)/10); $reviewCount=random_int(120,4800);
$pageRef=bin2hex(random_bytes(9));

$used=[]; $mainLink=buildUrl($scheme,$baseDomain,$port,$subWords,$sections,$docPages,$linkDomain); $used[$mainLink['url']]=true;
$links=uniqueLinks(80,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,$used,$linkDomain);
$extraLinks=uniqueLinks(18,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,$used,$linkDomain);
$relatedLinks=uniqueLinks(6,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,$used,$linkDomain);
$footerLinks=uniqueLinks(40,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,$used,$linkDomain);
$navLinks=uniqueLinks(8,$scheme,$baseDomain,$port,$subWords,$sections,$docPages,$used,$linkDomain);


$planName=pick($planNames); $planPrice=random_int(1,29).'.'.pick(['00','49','99','50']);
$plans=[]; foreach(picks($planNames,3) as $pn){ $plans[]=['name'=>$pn,'price'=>random_int(1,49).'.'.pick(['00','49','99']),'feats'=>picks($features,4)]; }

// Structured data (JSON-LD): Organization, WebSite, WebPage, BlogPosting,
// BreadcrumbList, FAQPage, Product with rating + ItemList - maximum SEO
// bait so crawlers treat the fake page as a real, rich result.
// ---------------------------------------------------------------------------
$ld=['@context'=>'https://schema.org','@graph'=>[
 ['@type'=>'Organization','name'=>$brand,'url'=>$canonical,'sameAs'=>array_column(array_slice($footerLinks,0,4),'url')],
 ['@type'=>'WebSite','name'=>$brand.' - '.$currentName,'url'=>$canonical,'potentialAction'=>['@type'=>'SearchAction','target'=>$canonical.'?q={search_term_string}','query-input'=>'required name=search_term_string']],
 ['@type'=>'WebPage','name'=>$title,'description'=>$description,'url'=>$canonical,'inLanguage'=>'en','datePublished'=>$publishedIso,'dateModified'=>$updatedIso,'primaryImageOfPage'=>$canonical],
 ['@type'=>'BlogPosting','headline'=>$heading,'description'=>$description,'author'=>['@type'=>'Person','name'=>$author],'publisher'=>['@type'=>'Organization','name'=>$brand,'url'=>$canonical],'datePublished'=>$publishedIso,'dateModified'=>$updatedIso,'articleSection'=>$category,'keywords'=>implode(', ',$myKeywords),'wordCount'=>random_int(900,3200),'timeRequired'=>'PT'.$readMinutes.'M'],
 ['@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$scheme.'://'.$host.$port.'/'],['@type'=>'ListItem','position'=>2,'name'=>ucwords($category),'item'=>$canonical],['@type'=>'ListItem','position'=>3,'name'=>$currentName,'item'=>$canonical]]],
 ['@type'=>'FAQPage','mainEntity'=>array_map(fn($f)=>['@type'=>'Question','name'=>$f[0],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f[1]]],$myFaqs)],
 ['@type'=>'Product','name'=>$brand.' '.ucwords($topic),'description'=>$description,'brand'=>['@type'=>'Brand','name'=>$brand],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>$reviewCount],'offers'=>['@type'=>'Offer','price'=>$planPrice,'priceCurrency'=>'USD','availability'=>'https://schema.org/InStock','url'=>$canonical]],
 ['@type'=>'ItemList','name'=>'Explore '.$brand,'itemListElement'=>array_map(fn($i,$l)=>['@type'=>'ListItem','position'=>$i+1,'name'=>$l['label'].' '.$l['path'],'url'=>$l['url']],array_keys(array_slice($links,0,12)),array_slice($links,0,12))],
]];
$ldJson=json_encode($ld, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);

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
<meta name="geo.region" content="US-NY"><meta name="geo.placename" content="<?=e(pick($locations))?>">
<meta name="theme-color" content="#0f172a"><meta name="category" content="<?=e($category)?>">
<link rel="canonical" href="<?=e($canonical)?>">
<link rel="alternate" hreflang="en" href="<?=e($canonical)?>"><link rel="alternate" hreflang="x-default" href="<?=e($canonical)?>">
<meta property="og:type" content="article"><meta property="og:title" content="<?=e($title)?>"><meta property="og:description" content="<?=e($description)?>">
<meta property="og:url" content="<?=e($canonical)?>"><meta property="og:site_name" content="<?=e($brand)?>"><meta property="og:locale" content="en_US">
<meta property="article:published_time" content="<?=e($publishedIso)?>"><meta property="article:modified_time" content="<?=e($updatedIso)?>">
<meta property="article:author" content="<?=e($author)?>"><meta property="article:section" content="<?=e($category)?>">
<?php foreach($myTags as $t): ?><meta property="article:tag" content="<?=e($t)?>">
<?php endforeach; ?>
<meta name="twitter:card" content="summary"><meta name="twitter:title" content="<?=e($title)?>"><meta name="twitter:description" content="<?=e($description)?>">
<script type="application/ld+json"><?= $ldJson ?></script>
<style>*{box-sizing:border-box}body{margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:#0f172a;color:#e2e8f0}.wrap{max-width:860px;margin:0 auto;padding:32px 24px 64px}.brand{color:#38bdf8;font-weight:700;letter-spacing:1px;font-size:14px;text-transform:uppercase}h1{font-size:34px;line-height:1.25;margin:12px 0 20px;color:#fff}h2{font-size:21px;color:#fff;margin:32px 0 12px}h3{font-size:17px;color:#fff;margin:20px 0 8px}p{line-height:1.7;color:#cbd5e1;margin:0 0 16px}.btn{display:inline-block;margin:16px 0 32px;padding:14px 30px;font-size:17px;font-weight:700;color:#fff;background:#2563eb;border-radius:10px;text-decoration:none}.meta{color:#94a3b8;font-size:14px;margin:-8px 0 24px;line-height:1.6}ul.links{list-style:none;padding:0;margin:0;display:grid;grid-template-columns:1fr 1fr;gap:8px 24px}ul.links a{color:#94a3b8;text-decoration:none;font-size:15px}.box{background:#1e293b;border:1px solid #334155;border-radius:12px;padding:4px 20px 12px;margin:24px 0}.box a,.wrap a{color:#7dd3fc}nav a{margin-right:14px;color:#cbd5e1;text-decoration:none;font-size:14px}figure{margin:24px 0}figure img{width:100%;height:auto;border-radius:12px;display:block}figcaption{color:#94a3b8;font-size:13px;margin-top:8px}.gallery{display:grid;grid-template-columns:1fr 1fr;gap:12px}.gallery img{width:100%;height:auto;border-radius:10px}.cards{display:grid;grid-template-columns:1fr 1fr;gap:16px}.card{background:#1e293b;border:1px solid #334155;border-radius:12px;overflow:hidden}.card img{width:100%;height:auto;display:block}.card div{padding:12px 16px}.tags a{display:inline-block;background:#1e293b;border:1px solid #334155;border-radius:999px;padding:6px 12px;margin:4px;color:#cbd5e1;text-decoration:none;font-size:13px}table{width:100%;border-collapse:collapse}td,th{border-bottom:1px solid #334155;padding:10px;text-align:left;color:#cbd5e1}footer{margin-top:48px;color:#475569;font-size:13px}footer a{color:#94a3b8;text-decoration:none;margin-right:10px}</style>
</head>
<body><div class="wrap">
<?php /* SECTION 9 - HTML template. Header: brand, nav (8 maze links), breadcrumb. */ ?>
<header><div class="brand"><?=e($brand)?></div><nav aria-label="Main navigation"><?php foreach($navLinks as $l): ?><a href="<?=e($l['url'])?>"><?=e(ucwords($l['section']))?></a><?php endforeach; ?></nav>
<p style="margin-top:16px;font-size:13px;color:#94a3b8"><a href="/">Home</a> &rsaquo; <a href="<?=e($canonical)?>"><?=e($category)?></a> &rsaquo; <?=e($currentName)?></p></header>
<main><article>
<h1><?=e($heading)?></h1>
<div class="meta">By <?=e($author)?> at <?=e($brand)?> &middot; Published <time datetime="<?=e($publishedIso)?>"><?=e($published)?></time> &middot; Last updated <time datetime="<?=e($updatedIso)?>"><?=e($updated)?></time><br><?=e((string)$readMinutes)?> min read &middot; <?=e($viewCount)?> views &middot; <?=e((string)$commentCount)?> comments &middot; Rated <?=$rating?>/5 from <?=number_format($reviewCount)?> reviews &middot; Category: <?=e($category)?></div>
<?php foreach(array_slice($paragraphs,0,3) as $p): ?><p><?=e($p)?></p><?php endforeach; ?>
<a class="btn" href="<?=e($mainLink['url'])?>">Visit <?=e($mainLink['label'])?></a>
<h2>On this page</h2><ul><?php foreach(picks($sections,6) as $s): ?><li><a href="#<?=e($s)?>"><?=e(ucwords(str_replace('-',' ',$s)))?> - <?=e($topic)?></a></li><?php endforeach; ?></ul>
<?php foreach(array_slice($paragraphs,3) as $p): ?><p><?=e($p)?></p><?php endforeach; ?>

<section><h2>Key features of <?=e($brand)?> <?=e($topic)?></h2><ul><?php foreach($myFeatures as $f): ?><li><?=e(ucfirst($f))?> - included with <?=e(pick($planNames))?> plans and above</li><?php endforeach; ?></ul></section>

<section><h2>Pricing plans compared</h2><table><tr><th>Plan</th><th>Price / month</th><th>Includes</th></tr><?php foreach($plans as $pl): ?><tr><td><?=e($pl['name'])?></td><td>$<?=e($pl['price'])?></td><td><?=e(implode(', ',$pl['feats']))?></td></tr><?php endforeach; ?></table></section>

<section><h2>Inside <?=e($brand)?></h2><p><?=e(pick($taglines))?> Explore <?=e(implode(", ", picks($features,5)))?> in <?=e(pick($locations))?>, <?=e(pick($locations))?> and <?=e(pick($locations))?>.</p></section>

<section><h2>Frequently asked questions about <?=e($topic)?></h2><?php foreach($myFaqs as $f): ?><h3><?=e($f[0])?></h3><p><?=e($f[1])?></p><?php endforeach; ?></section>

<section><h2>What customers say about <?=e($brand)?></h2><?php foreach($myTestimonials as $t): ?><div class="box"><p>&ldquo;<?=e($t[0])?>&rdquo;</p><p><?=e($t[1])?> &middot; <?=str_repeat('&#9733;',random_int(4,5))?></p></div><?php endforeach; ?></section>

<section><h2>Glossary</h2><?php $gs=picks($glossary,4); foreach($gs as $g): ?><h3><?=e($g[0])?></h3><p><?=e($g[1])?></p><?php endforeach; ?></section>

<section><h2>Related articles and guides</h2><div class="cards"><?php foreach($relatedLinks as $i=>$l): ?><div class="card"><div><h3><a href="<?=e($l['url'])?>"><?=e($l['label'])?> <?=e($l['path'])?></a></h3><p><?=e(pick($blogTopics))?> - <?=e($readMinutes)?> min read, updated <?=e($updated)?></p></div></div><?php endforeach; ?></div></section>

<section><h2>Explore <?=e($brand)?> - all sections</h2><ul class="links"><?php foreach($links as $l): ?><li><a href="<?=e($l['url'])?>"><?=e($l['label'])?></a> <span><?=e($l['path'])?></span></li><?php endforeach; ?></ul></section>

<section><h2>Tags and topics</h2><div class="tags"><?php foreach($myTags as $t): $tl=$extraLinks[random_int(0,count($extraLinks)-1)]; ?><a href="<?=e($tl['url'])?>" rel="tag"><?=e($t)?></a><?php endforeach; ?></div></section>

<section><h2>Service status and numbers</h2><p><?=e(pick($statusLines))?>. Uptime <?=random_int(99,100)?>.<?=random_int(10,99)?>% &middot; <?=number_format(random_int(1200,98000))?> sites hosted &middot; Nearest data centre: <?=e(pick($locations))?> &middot; Response time: <?=random_int(12,240)?> ms &middot; Tagline: <?=e(pick($taglines))?></p></section>
</article></main>
<aside><h2>Popular guides</h2><p>Read our guide to <?=e(pick($blogTopics))?>, learn about <?=e(pick($docPages))?>, or browse the <?=e(pick($sections))?> section.</p><h2>Comments (<?=e((string)$commentCount)?>)</h2><p>Join the discussion. Last activity <?=e($updated)?>.</p></aside>
<?php /* Honeypot payoff: after a form submission, show the green "Login successful" popup (auto-hides after 5s). The matching maze_session cookie was already set in SECTION 6. */ ?>
<?php if (!empty($loginSuccess)): ?><div id="hploginok" role="alert" style="position:fixed;top:16px;right:16px;background:#1a7f37;color:#fff;padding:12px 18px;border-radius:8px;z-index:9999;font-family:sans-serif;box-shadow:0 2px 8px rgba(0,0,0,.3)">Login successful</div><script>setTimeout(function(){var e=document.getElementById('hploginok');if(e){e.style.display='none';}},5000);</script><?php endif; ?>
<?php /* The hidden honeypot login form: positioned far off-screen, never shown to humans. Field order is deliberate - Website, Login email, Login username, Login password, Full name, Message - so form-filling bots treat it as a real login. Rendered only when the group is under 5 submissions AND the visitor sent no maze_session cookie. */ ?>
<?php if (!empty($showHiddenForm)): ?><form class="hpform" method="post" action="" style="position:absolute;left:-9999px;top:-9999px" aria-hidden="true"><input type="hidden" name="contact_form" value="1"><label>Website <input type="url" name="website" tabindex="-1" autocomplete="off"></label><label>Login email <input type="email" name="email" tabindex="-1" autocomplete="off"></label><label>Login username <input type="text" name="username" tabindex="-1" autocomplete="off"></label><label>Login password <input type="password" name="password" tabindex="-1" autocomplete="off"></label><label>Full name <input type="text" name="name" tabindex="-1" autocomplete="off"></label><label>Message <textarea name="message" tabindex="-1"></textarea></label><button type="submit" tabindex="-1">Send enquiry</button></form><?php endif; ?>
<?php /* Footer: 40 more maze links under a "Sitemap" heading, copyright line, random page reference. */ ?>
<footer><h2 style="font-size:16px">Sitemap</h2><?php foreach($footerLinks as $l): ?><a href="<?=e($l['url'])?>"><?=e($l['label'])?></a><?php endforeach; ?><p>&copy; <?=date('Y')?> <?=e($brand)?>. All rights reserved. &middot; Last updated <?=e($updated)?> &middot; Ref <?=e($pageRef)?> &middot; <?=e($category)?> &middot; <?=e(implode(' | ',array_slice($myTags,0,5)))?></p></footer>
</div></body></html>
