<?php /* Apex Marketings — shared <head>. Included by head.php (root, $p=''),
   head1.php ($p='../'), head2.php ($p='../../'). $p prefixes depth-relative asset
   paths so there is ONE head to maintain. $seo_title/$seo_desc are set by each page
   BEFORE its head include. Entity JSON-LD lives in schema-org.php. */
if (!isset($p)) { $p = ''; }
$asset_version = '20260820-aurora1';
?>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="author" content="Apex Marketings">
<meta http-equiv="content-language" content="en-US">
<meta name="geo.region" content="PK-PB">
<meta name="geo.placename" content="Rawalpindi, Pakistan">
<meta name="geo.position" content="33.5973;73.0479">
<meta name="ICBM" content="33.5973, 73.0479">
<link rel="preconnect" href="https://www.googletagmanager.com" crossorigin>
<link rel="dns-prefetch" href="https://www.googletagmanager.com">
<link rel="dns-prefetch" href="https://www.google-analytics.com">
<?php
$current_url = "https://apexmarketings.com" . preg_replace('~(index\.php)?([?#].*)?$~', '', $_SERVER['REQUEST_URI']);
$current_url = strtok($current_url, '?');
$page_title = isset($seo_title) ? $seo_title : "Apex Marketings – Digital Marketing Agency";
$page_desc = isset($seo_desc) ? $seo_desc : "Grow your business with Apex Marketings. We specialize in e-commerce, SEO, social media, and PPC.";
?>
<title><?php echo htmlspecialchars($page_title); ?></title>
<meta name="description" content="<?php echo htmlspecialchars($page_desc); ?>">
<meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>">
<meta property="og:description" content="<?php echo htmlspecialchars($page_desc); ?>">
<meta property="og:url" content="<?php echo htmlspecialchars($current_url); ?>">
<meta property="og:image" content="https://apexmarketings.com/assets/img/home/hero_bg_2.webp">
<meta property="og:type" content="website">
<meta property="og:locale" content="en_US">
<meta property="og:site_name" content="Apex Marketings">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo htmlspecialchars($page_title); ?>">
<meta name="twitter:description" content="<?php echo htmlspecialchars($page_desc); ?>">
<meta name="twitter:image" content="https://apexmarketings.com/assets/img/home/hero_bg_2.webp">
<link rel="canonical" href="<?php echo htmlspecialchars($current_url); ?>">
<link rel="alternate" hreflang="en" href="<?php echo htmlspecialchars($current_url); ?>" />
<link rel="alternate" hreflang="x-default" href="<?php echo htmlspecialchars($current_url); ?>" />
<!-- Google tag (gtag.js) — GA4, loaded sitewide -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-NFX6VELY63"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-NFX6VELY63');
</script>
<?php include __DIR__ . '/schema-org.php'; ?>
<link rel="alternate" type="application/rss+xml" title="Apex Marketings Blog" href="https://apexmarketings.com/blogs/feed.xml">
<style>.apex-skip-link{position:absolute;left:0;top:0;z-index:100000;background:#e6ad02;color:#000;padding:12px 20px;font-weight:600;border-radius:0 0 8px 0;text-decoration:none;transform:translateX(-110%);transition:transform .2s ease;}.apex-skip-link:focus{transform:translateX(0);}</style>
<!-- Favicon Icon -->
<link rel="icon" href="<?php echo $p; ?>assets/img/favicon.png">
<!-- Stylesheets -->
<link rel="stylesheet" href="<?php echo $p; ?>assets/css/plugins/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $p; ?>assets/css/plugins/fontawesome.min.css">
<link rel="stylesheet" href="<?php echo $p; ?>assets/css/plugins/slick.css">
<link rel="stylesheet" href="<?php echo $p; ?>assets/css/plugins/lightgallery.min.css">
<link rel="stylesheet" href="<?php echo $p; ?>assets/css/plugins/animate.css">
<link rel="stylesheet" href="<?php echo $p; ?>assets/css/style.css?v=<?php echo rawurlencode($asset_version); ?>">
<link rel="stylesheet" href="<?php echo $p; ?>assets/css/motion-system.css?v=<?php echo rawurlencode($asset_version); ?>">
<link rel="stylesheet" href="<?php echo $p; ?>assets/css/plugins/boxicons.min.css">
<link rel="stylesheet" href="<?php echo $p; ?>assets/css/apex-aurora.css?v=<?php echo rawurlencode($asset_version); ?>">

<!-- WebVitals real-user monitoring (uses GA4) -->
<script src="<?php echo $p; ?>assets/js/web-vitals.js" defer></script>
<script src="<?php echo $p; ?>assets/js/interaction-system.js" defer></script>
<script src="<?php echo $p; ?>assets/js/apex-aurora.js?v=<?php echo rawurlencode($asset_version); ?>" defer></script>
<script type="module" src="<?php echo $p; ?>assets/js/webgl-showpiece.js"></script>

<style>
/* Accessibility: visible focus + reduced motion (site-wide) */
a:focus-visible,button:focus-visible,input:focus-visible,select:focus-visible,textarea:focus-visible{outline:3px solid #e6ad02 !important;outline-offset:2px;}
@media (prefers-reduced-motion: reduce){
  *,*::before,*::after{animation-duration:0.01ms !important;animation-iteration-count:1 !important;transition-duration:0.01ms !important;scroll-behavior:auto !important;}
  .cs-preloader{display:none !important;}
}
</style>

<!-- GA4 engagement events: WhatsApp / phone / email clicks, lead thank-you views -->
<script>
document.addEventListener('click', function (e) {
  var a = e.target && e.target.closest ? e.target.closest('a') : null;
  if (!a || typeof gtag !== 'function') return;
  var h = a.getAttribute('href') || '';
  if (h.indexOf('wa.me') > -1 || h.indexOf('whatsapp.com') > -1) { gtag('event', 'whatsapp_click', { link_url: h }); }
  else if (h.indexOf('tel:') === 0) { gtag('event', 'phone_click', { link_url: h }); }
  else if (h.indexOf('mailto:') === 0) { gtag('event', 'email_click', { link_url: h }); }
}, true);
if (location.pathname.indexOf('/thank-you/') > -1 && typeof gtag === 'function') {
  gtag('event', 'generate_lead', { form_type: (new URLSearchParams(location.search)).get('type') || 'contact' });
}
</script>

<style>/* a11y contrast + link distinguishability (audit) */
.cs-portfolio.cs-style1 .cs-portfolio_title,.cs-slider.cs-style3 .cs-portfolio.cs-style1 .cs-portfolio_title{color:#1a1a1a !important;}
.cs-portfolio.cs-style1 .cs-portfolio_subtitle,.cs-slider.cs-style3 .cs-portfolio.cs-style1 .cs-portfolio_subtitle{color:#3a2f00 !important;}
.cs-testimonial_text a{color:#7db9e8 !important;text-decoration:underline;}
article a,.cs-post_text a{text-decoration:underline;}
</style>
