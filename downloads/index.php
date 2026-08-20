<?php
require_once __DIR__ . '/../private/mail.php';

$apex_res_error = null;
$apex_res_done = isset($_GET['submitted']) && $_GET['submitted'] === '1';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = apex_str(isset($_POST['email']) ? $_POST['email'] : '', 200);
    if (!apex_honeypot_ok('website')) {
        // Bot: pretend nothing happened, store nothing, reveal nothing.
        header('Location: ./');
        exit;
    }
    if (!apex_valid_email($email)) {
        $apex_res_error = 'Please enter a valid email address.';
    } elseif (!apex_rate_limit_ok('newsletter', 5, 600)) {
        $apex_res_error = 'Too many attempts. Please try again in a few minutes.';
    } else {
        apex_newsletter_store($email, 'downloads-page');
        apex_send_mail(array(
            'subject'  => 'New resource download subscriber',
            'formType' => 'newsletter',
            'fields'   => array('Email' => $email, 'Source' => 'downloads-page'),
        ));
        header('Location: ./?submitted=1');
        exit;
    }
}
$seo_title = 'Free Downloads — Budget Planner & Local SEO Checklist | Apex Marketings';
$seo_desc = 'Free downloadable guides from Apex Marketings: the 2026 Digital Marketing Budget Planner and the Local SEO Checklist for Pakistani businesses. Practical, honest, no fluff.';
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <?php include_once('../include/head1.php'); ?>
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
  <div class="cs-page_heading cs-style1 cs-center text-center cs-bg" style="height: 300px; background-color: #111;">
    <div class="container">
      <div class="cs-page_heading_in">
        <h1 class="cs-page_title cs-font_50 cs-white_color">Free Marketing Downloads</h1>
      </div>
    </div>
  </div>
  <!-- End Hero -->

  <div class="cs-height_100 cs-height_lg_60"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <p style="font-size:17px;line-height:1.7;color:#bbb;text-align:center;">Two practical guides, written the way we work — real numbers where we have them, honest timelines, no fluff. Enter your email once and both downloads unlock. We'll also send our occasional newsletter (unsubscribe anytime, no spam).</p>
        <div class="cs-height_40 cs-height_lg_30"></div>

        <div class="row">
          <div class="col-md-6 mb-4">
            <div style="padding:28px;background:#1a1a1a;border:1px solid #333;border-radius:12px;height:100%;">
              <h3 style="font-size:20px;margin:0 0 10px;">Digital Marketing Budget Planner 2026</h3>
              <p style="font-size:15px;color:#bbb;margin:0 0 12px;">Work backwards from your revenue goal to a budget you can defend: customer-value math, management fee vs ad spend explained, allocation by business type, and a 30-minute monthly review routine.</p>
              <?php if ($apex_res_done): ?>
              <a href="files/apex-marketings-budget-planner-2026.pdf" download style="display:inline-block;padding:10px 22px;background:#111;color:#fff;border-radius:8px;text-decoration:none;font-weight:600;">Download PDF</a>
              <?php else: ?>
              <p style="font-size:13px;color:#999;margin:0;">Unlocks after you subscribe below.</p>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div style="padding:28px;background:#1a1a1a;border:1px solid #333;border-radius:12px;height:100%;">
              <h3 style="font-size:20px;margin:0 0 10px;">Local SEO Checklist for Pakistani Businesses</h3>
              <p style="font-size:15px;color:#bbb;margin:0 0 12px;">The exact checklist we run: Google Business Profile setup, NAP consistency, earning real reviews, local schema, and link building — with honest timelines for each stage.</p>
              <?php if ($apex_res_done): ?>
              <a href="files/apex-marketings-local-seo-checklist-2026.pdf" download style="display:inline-block;padding:10px 22px;background:#111;color:#fff;border-radius:8px;text-decoration:none;font-weight:600;">Download PDF</a>
              <?php else: ?>
              <p style="font-size:13px;color:#999;margin:0;">Unlocks after you subscribe below.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="cs-height_30 cs-height_lg_20"></div>

        <?php if ($apex_res_done): ?>
        <div role="status" style="background:#e8f5e9;border:1px solid #c8e6c9;color:#1b5e20;padding:14px 18px;border-radius:8px;text-align:center;">
          <strong>You're in.</strong> Both downloads are unlocked above. If a file doesn't open, email us at info@apexmarketings.com and we'll send it directly.
        </div>
        <?php else: ?>
        <div style="max-width:480px;margin:0 auto;text-align:center;">
          <?php if ($apex_res_error): ?>
          <div role="alert" style="background:#fdecea;border:1px solid #f5c6cb;color:#721c24;padding:12px 16px;border-radius:6px;margin-bottom:20px;">
            <?php echo htmlspecialchars($apex_res_error, ENT_QUOTES, 'UTF-8'); ?>
          </div>
          <?php endif; ?>
          <form method="post" action="./" class="cs-newsletter_form">
            <input type="text" name="website" autocomplete="off" tabindex="-1" aria-hidden="true" style="position:absolute;left:-9999px;">
            <input type="email" name="email" class="cs-newsletter_input" placeholder="you@company.com" required aria-label="Email address to unlock downloads">
            <button class="cs-newsletter_btn" type="submit"><span>Unlock Downloads</span></button>
          </form>
        </div>
        <?php endif; ?>

        <div class="cs-height_50 cs-height_lg_30"></div>
        <p style="font-size:14px;color:#888;text-align:center;">Prefer to talk instead? <a href="../contact/" style="color:rgb(20,120,190);text-decoration:underline;">Book a free 30-minute consultation</a> or <a href="../quote/" style="color:rgb(20,120,190);text-decoration:underline;">request a quote</a>.</p>
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
  <script src="../assets/js/main.js?v=20260706-repair1"></script>
</body>

</html>
