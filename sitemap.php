<?php
/**
 * Self-healing sitemap generator (web-served).
 *
 * Normally the static sitemap.xml / sitemap.html are served directly by Apache.
 * If those static files are ever missing from the deployed root (e.g. a File
 * Manager upload skipped them), .htaccess routes /sitemap.xml and /sitemap.html
 * here and this script generates them live from the filesystem — so the sitemap
 * URL never 404s and never goes stale when new pages are added.
 *
 * It also writes the static files back (best effort) so the fast path heals
 * itself on the first request.
 */

$DOMAIN = 'https://apexmarketings.com';
$BRAND  = 'Apex Marketings';
$ROOT   = __DIR__;

$excludeDirs = array(
    '_dev_archive', 'audit-output', 'include', 'private', 'css', 'js', 'img',
    'assets', 'scss', 'node_modules', '.git', '.codex', 'sitemap-html',
    'thank-you', 'subscribe', 'search',
    'contact/downloads',
    'case-studies/altrgroup-com',
    'portfolio/e-commerce-store-performances',
);

function apex_sm_excluded($rel, array $excludeDirs)
{
    foreach ($excludeDirs as $e) {
        if ($rel === $e || strpos($rel, $e . '/') === 0) {
            return true;
        }
    }
    return false;
}

$urls = array();
if (is_file($ROOT . '/index.php')) {
    $urls['/'] = filemtime($ROOT . '/index.php');
}

$dirIter = new RecursiveIteratorIterator(
    new RecursiveCallbackFilterIterator(
        new RecursiveDirectoryIterator($ROOT, FilesystemIterator::SKIP_DOTS),
        function ($file, $key, $iter) use ($ROOT, $excludeDirs) {
            $rel = str_replace('\\', '/', substr($file->getPathname(), strlen($ROOT) + 1));
            if ($file->isDir()) {
                return !apex_sm_excluded($rel, $excludeDirs);
            }
            return $file->getFilename() === 'index.php';
        }
    )
);
foreach ($dirIter as $file) {
    $relDir = str_replace('\\', '/', substr($file->getPath(), strlen($ROOT)));
    if ($relDir === '' || $relDir === false) {
        continue;
    }
    $urls[$relDir . '/'] = $file->getMTime();
}
ksort($urls);

function apex_sm_priority($path)
{
    if ($path === '/') return '1.0';
    $top = explode('/', trim($path, '/'))[0];
    $depth = substr_count(trim($path, '/'), '/');
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

// ---- build sitemap.xml ----
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

// ---- build sitemap.html ----
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
        $label = $p === '/' ? 'Homepage' : trim($p, '/');
        $html .= '<li><a href="' . htmlspecialchars($p) . '">' . htmlspecialchars($label) . "</a></li>\n";
    }
    $html .= "</ul>\n";
}
$html .= "</main>\n</body>\n</html>\n";

// ---- heal the static files (best effort; ignore permission failures) ----
@file_put_contents($ROOT . '/sitemap.xml', $xml);
@file_put_contents($ROOT . '/sitemap.html', $html);

// ---- serve the requested format ----
$reqHtml = (isset($_GET['format']) && $_GET['format'] === 'html')
    || (stripos($_SERVER['REQUEST_URI'] ?? '', 'sitemap.html') !== false);
if ($reqHtml) {
    header('Content-Type: text/html; charset=UTF-8');
    echo $html;
} else {
    header('Content-Type: application/xml; charset=UTF-8');
    echo $xml;
}
