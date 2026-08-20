<?php
require_once __DIR__ . '/../private/mail.php';

$apex_sub_error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = apex_str(isset($_POST['email']) ? $_POST['email'] : '', 200);
    if (!apex_honeypot_ok('website')) {
        // Bot: pretend success, store nothing.
        header('Location: ../thank-you/?type=newsletter');
        exit;
    }
    if (!apex_valid_email($email)) {
        $apex_sub_error = 'Please enter a valid email address.';
    } elseif (!apex_rate_limit_ok('newsletter', 5, 600)) {
        $apex_sub_error = 'Too many attempts. Please try again in a few minutes.';
    } else {
        $source = apex_str(isset($_POST['source']) ? $_POST['source'] : 'footer', 120);
        apex_newsletter_store($email, $source);
        apex_send_mail(array(
            'subject'  => 'New newsletter subscriber',
            'formType' => 'newsletter',
            'fields'   => array('Email' => $email, 'Source' => $source),
        ));
        header('Location: ../thank-you/?type=newsletter');
        exit;
    }
}
$seo_title = 'Subscribe to the Newsletter | Apex Marketings';
$seo_desc = 'Subscribe to occasional, practical growth marketing tips from Apex Marketings.';
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
      "@id": "https://apexmarketings.com/subscribe/#breadcrumb",
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
          "name": "Subscribe",
          "item": "https://apexmarketings.com/subscribe/"
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
        <h1 class="cs-page_title cs-font_50 cs-white_color">Subscribe to the newsletter</h1>
      </div>
    </div>
  </div>
  <!-- End Hero -->

  <div class="cs-height_100 cs-height_lg_60"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-6 offset-lg-3 text-center">
        <p style="font-size:17px;line-height:1.7;color:#bbb;">Occasional, practical notes on SEO, paid ads, and e-commerce growth. No spam.</p>
        <div class="cs-height_30 cs-height_lg_20"></div>
        <?php if ($apex_sub_error): ?>
        <div role="alert" style="background:#fdecea;border:1px solid #f5c6cb;color:#721c24;padding:12px 16px;border-radius:6px;margin-bottom:20px;">
          <?php echo htmlspecialchars($apex_sub_error, ENT_QUOTES, 'UTF-8'); ?>
        </div>
        <?php endif; ?>
        <form method="post" action="./" class="cs-newsletter_form" style="max-width:420px;margin:0 auto;">
          <input type="text" name="website" autocomplete="off" tabindex="-1" aria-hidden="true" style="position:absolute;left:-9999px;">
          <input type="hidden" name="source" value="subscribe-page">
          <input type="email" name="email" class="cs-newsletter_input" placeholder="you@company.com" required aria-label="Email address for newsletter">
          <button class="cs-newsletter_btn" type="submit"><span>Subscribe</span></button>
        </form>
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
  <script src="../assets/js/main.js?v=20260706-repair1"></script>
</body>

</html>
