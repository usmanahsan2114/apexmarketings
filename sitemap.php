<?php
/**
 * Self-healing Partitioned XML Sitemap & HTML Sitemap Generator.
 * Conforms to Google Search Console XML Sitemap Index Specifications.
 *
 * Partitions:
 *   /sitemap.xml           -> Sitemap Index linking sub-sitemaps
 *   /sitemap-pages.xml     -> Core corporate & marketing landing pages
 *   /sitemap-services.xml  -> Service offerings (only canonical 200 OK endpoints)
 *   /sitemap-locations.xml -> Geographic target pages
 *   /sitemap-posts.xml     -> Blogs, guides & technical case studies
 *   /sitemap.html          -> Human-navigable HTML sitemap
 */

$DOMAIN = 'https://apexmarketings.com';
$BRAND  = 'Apex Marketings';
$ROOT   = __DIR__;

$excludeDirs = array(
    // Subdomain / separate-app docroots that live inside public_html on the server.
    // They are NOT pages of this site (they canonicalise to their own hosts).
    'usman', 'devops', 'cloverly', 'cloverlyhr', 'inventory', 'hr', 'websites', 'apexit', 'apexmarketings',
    '_dev_archive', 'audit-output', 'include', 'private', 'css', 'js', 'img',
    'assets', 'scss', 'node_modules', '.git', '.codex', 'sitemap-html',
    'thank-you', 'subscribe', 'search',
    'contact/downloads',
    'case-studies/altrgroup-com', // 301 redirected
    'portfolio/e-commerce-store-performances', // 301 redirected
);

function apex_sm_excluded($rel, array $excludeDirs)
{
    $cleanRel = trim($rel, '/');
    if ($cleanRel !== '' && apex_sm_is_foreign_app(__DIR__ . '/' . $cleanRel)) {
        return true;
    }
    foreach ($excludeDirs as $e) {
        $cleanE = trim($e, '/');
        if ($cleanRel === $cleanE || strpos($cleanRel, $cleanE . '/') === 0) {
            return true;
        }
    }
    return false;
}

/**
 * A sub-directory that carries its own .htaccess / framework bootstrap is a
 * separate site (subdomain docroot, app, client microsite) - never list it.
 */
function apex_sm_is_foreign_app($absDir)
{
    static $cache = array();
    if (isset($cache[$absDir])) return $cache[$absDir];
    $foreign = false;
    if (basename($absDir) !== 'private') {
        foreach (array('.htaccess', 'artisan', 'wp-config.php', 'composer.json', 'package.json') as $marker) {
            if (is_file($absDir . '/' . $marker)) { $foreign = true; break; }
        }
    }
    return $cache[$absDir] = $foreign;
}

/** True when the page declares itself noindex (meta tag or $apex_robots). */
function apex_sm_is_noindex($file)
{
    $head = @file_get_contents($file, false, null, 0, 8000);
    if ($head === false) return false;
    return (bool) preg_match('/<meta\s+name=["\']robots["\']\s+content=["\'][^"\']*noindex|\$apex_robots\s*=\s*["\'][^"\']*noindex/i', $head);
}

/** Readable fallback label from a URL path, e.g. /case-studies/tyremart-site/ -> Tyremart.site */
function apex_sm_pretty($path)
{
    $seg = basename(trim($path, '/'));
    $seg = preg_replace('/-(com|co|pk|net|org|io|site|store)$/', '.$1', $seg);
    return ucfirst(str_replace('-', ' ', $seg));
}

/** Page title (from $seo_title or <title>) for the human sitemap. */
function apex_sm_title($file, $fallback)
{
    $head = @file_get_contents($file, false, null, 0, 12000);
    if ($head !== false && (preg_match('/\$seo_title\s*=\s*(["\'])(.+?)\1\s*;/', $head, $m) || preg_match('/<title>()([^<]+)<\/title>/i', $head, $m))) {
        $t = html_entity_decode(trim(preg_replace('/\s+/', ' ', $m[2])), ENT_QUOTES, 'UTF-8');
        $t = preg_replace('/\s*[|\x{2014}-]\s*(Apex IT Solutions|Apex Marketings)(\s+Glossary)?\s*$/u', '', $t);
        if ($t !== '' && strpos($t, '<?') === false && strpos($t, '$') === false) return $t;
    }
    return $fallback;
}

/**
 * Scan $scanRoot for index.php endpoints
 */
function apex_sm_pages($scanRoot, $urlBase, array $excludeDirs, $applyExclude)
{
    $urls = array();
    if (is_file($scanRoot . '/index.php')) {
        $urls[$urlBase . '/'] = filemtime($scanRoot . '/index.php');
    }
    if (is_dir($scanRoot)) {
        $iter = new RecursiveIteratorIterator(
            new RecursiveCallbackFilterIterator(
                new RecursiveDirectoryIterator($scanRoot, FilesystemIterator::SKIP_DOTS),
                function ($file, $key, $it) use ($scanRoot, $excludeDirs, $applyExclude) {
                    $rel = str_replace('\\', '/', substr($file->getPathname(), strlen($scanRoot) + 1));
                    if ($file->isDir()) {
                        return $applyExclude ? !apex_sm_excluded($rel, $excludeDirs) : true;
                    }
                    return $file->getFilename() === 'index.php';
                }
            )
        );
        foreach ($iter as $file) {
            $relDir = str_replace('\\', '/', substr($file->getPath(), strlen($scanRoot)));
            if ($relDir === '' || $relDir === false) {
                continue;
            }
            if ($applyExclude && apex_sm_excluded($relDir, $excludeDirs)) {
                continue;
            }
            if (apex_sm_is_noindex($file->getPathname())) {
                continue;
            }
            $urls[$urlBase . $relDir . '/'] = $file->getMTime();
        }
    }
    ksort($urls);
    return $urls;
}

function apex_sm_priority($path)
{
    if ($path === '/') return '1.0';
    $top = explode('/', trim($path, '/'))[0];
    switch ($top) {
        case 'services': return '0.9';
        case 'contact':
        case 'quote':
        case 'pricing': return '0.9';
        case 'about':
        case 'case-studies':
        case 'industries':
        case 'locations':
        case 'compare': return '0.8';
        case 'blogs':
        case 'portfolio':
        case 'process':
        case 'team':
        case 'trust':
        case 'resources': return '0.7';
        case 'glossary': return '0.6';
        case 'careers': return '0.5';
        case 'privacy-policy':
        case 'terms-conditions':
        case 'payment-and-refund-policy': return '0.3';
        default: return '0.6';
    }
}

function apex_sm_changefreq($path)
{
    if ($path === '/' || $path === '/blogs/' || $path === '/case-studies/') return 'weekly';
    return 'monthly';
}

function apex_sm_urlset_xml($urls, $DOMAIN)
{
    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
    foreach ($urls as $path => $mtime) {
        $xml .= '<url><loc>' . htmlspecialchars($DOMAIN . $path, ENT_XML1)
            . '</loc><lastmod>' . date('Y-m-d', $mtime)
            . '</lastmod><changefreq>' . apex_sm_changefreq($path)
            . '</changefreq><priority>' . apex_sm_priority($path)
            . "</priority></url>\n";
    }
    $xml .= "</urlset>\n";
    return $xml;
}

function apex_sm_index_xml($sitemaps, $DOMAIN)
{
    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    $xml .= "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
    foreach ($sitemaps as $file => $mtime) {
        $xml .= "  <sitemap>\n";
        $xml .= '    <loc>' . htmlspecialchars($DOMAIN . '/' . $file, ENT_XML1) . "</loc>\n";
        $xml .= '    <lastmod>' . date('Y-m-d', $mtime) . "</lastmod>\n";
        $xml .= "  </sitemap>\n";
    }
    $xml .= "</sitemapindex>\n";
    return $xml;
}

function apex_sm_html($urls, $DOMAIN, $BRAND)
{
    $groups = array();
    foreach ($urls as $path => $mtime) {
        $top = $path === '/' ? 'Main' : ucwords(str_replace('-', ' ', explode('/', trim($path, '/'))[0]));
        $groups[$top][] = $path;
    }
    ksort($groups);
    if (isset($groups['Main'])) {
        $main = $groups['Main'];
        unset($groups['Main']);
        $groups = array_merge(array('Main' => $main), $groups);
    }
    $html = "<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n<meta charset=\"utf-8\">\n"
        . "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n"
        . '<title>HTML Sitemap | ' . htmlspecialchars($BRAND) . "</title>\n"
        . '<meta name="description" content="Complete list of pages on ' . htmlspecialchars($BRAND) . '.">' . "\n"
        . '<link rel="canonical" href="' . htmlspecialchars($DOMAIN) . '/sitemap.html">' . "\n"
        . "<style>body{font-family:Arial,Helvetica,sans-serif;max-width:960px;margin:0 auto;padding:32px 20px;color:#222;line-height:1.6}h1{font-size:28px}h2{font-size:20px;margin-top:32px;border-bottom:1px solid #eee;padding-bottom:6px}ul{columns:2;column-gap:40px;padding-left:20px}@media(max-width:640px){ul{columns:1}}a{color:#0b62a4}a:focus-visible{outline:3px solid #0b62a4;outline-offset:2px}</style>\n"
        . "</head>\n<body>\n<main>\n<h1>" . htmlspecialchars($BRAND) . " — HTML Sitemap</h1>\n"
        . '<p><a href="/">&#8592; Back to homepage</a> &middot; ' . count($urls) . " pages</p>\n";
    foreach ($groups as $name => $paths) {
        $html .= '<h2>' . htmlspecialchars($name) . "</h2>\n<ul>\n";
        foreach ($paths as $p) {
            $label = $p === '/' ? 'Homepage' : apex_sm_title(__DIR__ . $p . 'index.php', apex_sm_pretty($p));
            $html .= '<li><a href="' . htmlspecialchars($p) . '">' . htmlspecialchars($label) . "</a></li>\n";
        }
        $html .= "</ul>\n";
    }
    $html .= "</main>\n</body>\n</html>\n";
    return $html;
}

// Gather all clean pages
$allUrls = apex_sm_pages($ROOT, '', $excludeDirs, true);

// Partition URLs by taxonomy
$partitionPages = array();
$partitionServices = array();
$partitionLocations = array();
$partitionPosts = array();

foreach ($allUrls as $path => $mtime) {
    if (strpos($path, '/services/') === 0) {
        $partitionServices[$path] = $mtime;
    } elseif (strpos($path, '/locations/') === 0) {
        $partitionLocations[$path] = $mtime;
    } elseif (strpos($path, '/blogs/') === 0 || strpos($path, '/case-studies/') === 0) {
        $partitionPosts[$path] = $mtime;
    } else {
        $partitionPages[$path] = $mtime;
    }
}

// Generate XML content
$now = time();
$xmlPages = apex_sm_urlset_xml($partitionPages, $DOMAIN);
$xmlServices = apex_sm_urlset_xml($partitionServices, $DOMAIN);
$xmlLocations = apex_sm_urlset_xml($partitionLocations, $DOMAIN);
$xmlPosts = apex_sm_urlset_xml($partitionPosts, $DOMAIN);

$sitemapIndexList = array(
    'sitemap-pages.xml' => $now,
    'sitemap-services.xml' => $now,
    'sitemap-locations.xml' => $now,
    'sitemap-posts.xml' => $now,
);
$xmlIndex = apex_sm_index_xml($sitemapIndexList, $DOMAIN);
$mainHtml = apex_sm_html($allUrls, $DOMAIN, $BRAND);

// Heal/write all static files to root
@file_put_contents($ROOT . '/sitemap.xml', $xmlIndex);
@file_put_contents($ROOT . '/sitemap-pages.xml', $xmlPages);
@file_put_contents($ROOT . '/sitemap-services.xml', $xmlServices);
@file_put_contents($ROOT . '/sitemap-locations.xml', $xmlLocations);
@file_put_contents($ROOT . '/sitemap-posts.xml', $xmlPosts);
@file_put_contents($ROOT . '/sitemap.html', $mainHtml);

// Handle request routing if called via web
$reqUri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';

if ($type === 'pages' || stripos($reqUri, 'sitemap-pages.xml') !== false) {
    header('Content-Type: application/xml; charset=UTF-8');
    echo $xmlPages;
    exit;
}
if ($type === 'services' || stripos($reqUri, 'sitemap-services.xml') !== false) {
    header('Content-Type: application/xml; charset=UTF-8');
    echo $xmlServices;
    exit;
}
if ($type === 'locations' || stripos($reqUri, 'sitemap-locations.xml') !== false) {
    header('Content-Type: application/xml; charset=UTF-8');
    echo $xmlLocations;
    exit;
}
if ($type === 'posts' || stripos($reqUri, 'sitemap-posts.xml') !== false) {
    header('Content-Type: application/xml; charset=UTF-8');
    echo $xmlPosts;
    exit;
}
if ((isset($_GET['format']) && $_GET['format'] === 'html') || stripos($reqUri, 'sitemap.html') !== false) {
    header('Content-Type: text/html; charset=UTF-8');
    echo $mainHtml;
    exit;
}

header('Content-Type: application/xml; charset=UTF-8');
echo $xmlIndex;
