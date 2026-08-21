<?php
$apex_ty_type = isset($_GET['type']) ? preg_replace('/[^a-z\-]/', '', strtolower((string) $_GET['type'])) : 'contact';
$apex_ty_copy = array(
    'contact' => array(
        'title' => 'Thanks — your message is in',
        'lede'  => 'Your message reached Apex Marketings. A strategist reviews every inquiry and you will usually hear back within one business day.',
    ),
    'quote' => array(
        'title' => 'Thanks — your quote request is in',
        'lede'  => 'Your brief reached Apex Marketings. We will review your goals and budget, then reply with a starting-from estimate and a free 30-minute discovery call — usually within 24 hours.',
    ),
    'newsletter' => array(
        'title' => 'You are subscribed',
        'lede'  => 'Thanks for subscribing. You will receive occasional, practical growth marketing tips — no spam, unsubscribe anytime by replying.',
    ),
);
if (!isset($apex_ty_copy[$apex_ty_type])) {
    $apex_ty_type = 'contact';
}
$apex_ty = $apex_ty_copy[$apex_ty_type];
$seo_title = 'Thank You | Apex Marketings';
$seo_desc = 'Your submission reached Apex Marketings. Here is what happens next.';
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <meta name="robots" content="noindex, follow">
  <?php include_once('../include/head1.php'); ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "@id": "https://apexmarketings.com/thank-you/#breadcrumb",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Home",
          "item": "https://apexmarketings.com/"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "Thank You",
          "item": "https://apexmarketings.com/thank-you/"
        }
      ]
    }
    </script>
</head>

<body>
  <div class="cs-preloader cs-center">
    <div class="cs-preloader_in">
      <img src="../assets/img/icons/apexlogo.svg" alt="Apex Marketings logo preloader" class="cs-preloader_img" width="400" height="400" decoding="async" loading="eager" />
    </div>
  </div>
  <!-- Start Header Section -->
  <?php include_once('../include/header1.php'); ?>
  <!-- End Header Section -->

  <!-- Start Hero -->
  <div class="cs-page_heading cs-style1 cs-center text-center cs-bg" data-src="../assets/img/contact/back.webp">
    <div class="container">
      <div class="cs-page_heading_in">
        <h1 class="cs-page_title cs-font_50 cs-white_color"><?php echo htmlspecialchars($apex_ty['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
      </div>
    </div>
  </div>
  <!-- End Hero -->

  <div class="cs-height_100 cs-height_lg_60"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <p style="font-size:18px;line-height:1.7;color:#bbb;"><?php echo htmlspecialchars($apex_ty['lede'], ENT_QUOTES, 'UTF-8'); ?></p>
        <div class="cs-height_40 cs-height_lg_30"></div>
        <h2 class="cs-font_30">While you wait</h2>
        <div class="cs-height_25 cs-height_lg_20"></div>
        <p style="font-size:16px;line-height:1.8;">
          <a href="../case-studies/" style="text-decoration:underline;">Browse case studies</a> ·
          <a href="../services/" style="text-decoration:underline;">Explore services</a> ·
          <a href="../pricing/" style="text-decoration:underline;">See pricing</a> ·
          <a href="../process/" style="text-decoration:underline;">How we work</a>
        </p>
        <div class="cs-height_40 cs-height_lg_30"></div>
        <a href="https://wa.me/923392012739?text=Hi%20Apex%20Marketings%2C%20I%20just%20submitted%20a%20form%20on%20your%20website." target="_blank" rel="noopener" class="cs-btn cs-style1"><span>Chat on WhatsApp</span></a>
      </div>
    </div>
  </div>
  <div class="cs-height_150 cs-height_lg_80"></div>

  <!-- Start Footer -->
  <?php include_once('../include/footer1.php'); ?>
  <!-- End Footer -->

  <span class="cs-scrollup">
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0 10L1.7625 11.7625L8.75 4.7875V20H11.25V4.7875L18.225 11.775L20 10L10 0L0 10Z" fill="currentColor" />
    </svg>
  </span>

  <!-- Script -->
  <script src="../assets/js/plugins/jquery-3.6.0.min.js"></script>
  <script src="../assets/js/plugins/isotope.pkg.min.js"></script>
  <script src="../assets/js/plugins/jquery.slick.min.js"></script>
  <script src="../assets/js/plugins/jquery.counter.min.js"></script>
  <script src="../assets/js/plugins/lightgallery.min.js"></script>
  <script src="../assets/js/plugins/wow.min.js"></script>
  <script src="../assets/js/plugins/gsap.min.js"></script>
  <script src="../assets/js/main.js?v=20260820-aurora1"></script>
</body>

</html>
