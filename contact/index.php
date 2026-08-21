<?php
require_once __DIR__ . '/../private/mail.php';
apex_session_boot(); // must run before any output so the CSRF token persists

$apex_contact_error = null;
$apex_old = array('name' => '', 'email' => '', 'company' => '', 'phone' => '', 'message' => '');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $apex_old['name'] = apex_str(isset($_POST['name']) ? $_POST['name'] : '', 120);
    $apex_old['email'] = apex_str(isset($_POST['email']) ? $_POST['email'] : '', 200);
    $apex_old['company'] = apex_str(isset($_POST['company']) ? $_POST['company'] : '', 160);
    $apex_old['phone'] = apex_str(isset($_POST['phone']) ? $_POST['phone'] : '', 30);
    $apex_old['message'] = apex_text(isset($_POST['message']) ? $_POST['message'] : '', 5000);

    if (!apex_honeypot_ok('website')) {
        // Bot: pretend success without sending or storing anything.
        header('Location: ../thank-you/?type=contact');
        exit;
    } elseif (!apex_csrf_check(isset($_POST['_token']) ? $_POST['_token'] : null)) {
        $apex_contact_error = 'Your session expired. Please review your message and send it again.';
    } elseif ($apex_old['name'] === '' || !apex_valid_email($apex_old['email']) || strlen($apex_old['message']) < 10) {
        $apex_contact_error = 'Please enter your name, a valid email, and a message of at least 10 characters.';
    } elseif ($apex_old['phone'] !== '' && !apex_valid_phone($apex_old['phone'])) {
        $apex_contact_error = 'Please enter a valid phone number.';
    } elseif (!apex_rate_limit_ok('contact', 5, 600)) {
        $apex_contact_error = 'Too many messages from your connection. Please wait a few minutes and try again, or email info@apexmarketings.com.';
    } else {
        $result = apex_send_mail(array(
            'subject'      => 'Apex Marketings contact form: ' . $apex_old['name'],
            'formType'     => 'contact',
            'replyToEmail' => $apex_old['email'],
            'replyToName'  => $apex_old['name'],
            'autorespond'  => true,
            'fields'       => array(
                'Name'    => $apex_old['name'],
                'Email'   => $apex_old['email'],
                'Company' => $apex_old['company'],
                'Phone'   => $apex_old['phone'],
                'Message' => $apex_old['message'],
            ),
        ));
        if ($result['ok']) {
            header('Location: ../thank-you/?type=contact');
            exit;
        }
        $apex_contact_error = 'Your message could not be sent right now. Please email info@apexmarketings.com or use WhatsApp +92 339 2012739.';
    }
}
$seo_title = "Contact Apex Marketings – Let's Grow Your Brand";
$seo_desc = 'Ready to grow your business? Contact Apex Marketings for expert digital marketing, SEO, and e-commerce solutions.';
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <?php include_once('../include/head1.php'); ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "@id": "https://apexmarketings.com/contact/#breadcrumb",
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
          "name": "Contact",
          "item": "https://apexmarketings.com/contact/"
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
        <h1 class="cs-page_title cs-font_50 cs-white_color">Contact Us</h1>
        <h4 class="cs-hero_title wow fadeInRight" data-wow-duration="0.8s" data-wow-delay="0.2s">
          We Run <span class="cs-accent_color">Ads</span> That <span class="cs-accent_color">Convert</span>
        </h4>
      </div>
    </div>
  </div>
  <!-- End Hero -->
  <div class="cs-height_150 cs-height_lg_80"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="cs-section_heading cs-style1">
          <h3 class="cs-section_subtitle">Get in Touch</h3>
          <h2 class="cs-section_title">Do you have a project <br>in your mind?</h2>
          <p style="margin-top: 15px; font-size: 15px; color: #555; font-weight: 500;">
            <span style="color:#25D366;">✔</span> No commitment required &nbsp;&nbsp;|&nbsp;&nbsp; <span style="color:#25D366;">⚡</span> We reply within 24 hours
          </p>
          <div style="display:flex;align-items:center;gap:8px;margin-top:20px;background:#f9f9f9;padding:10px 16px;border-radius:8px;display:inline-flex;">
            <span style="color:#e6ad02;font-size:18px;letter-spacing:2px;">★★★★★</span>
            <span style="font-size:14px;color:#ddd;font-weight:600;">4.9/5 Average Rating from 50+ Global Clients</span>
          </div>
        </div>
        <div class="cs-height_55 cs-height_lg_30"></div>
        <ul class="cs-contact_info cs-style1 cs-mp0">
          <h4>Pakistan</h4>
          <li>
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M17 12.5C15.75 12.5 14.55 12.3 13.43 11.93C13.08 11.82 12.69 11.9 12.41 12.17L10.21 14.37C7.38 12.93 5.06 10.62 3.62 7.79L5.82 5.58C6.1 5.31 6.18 4.92 6.07 4.57C5.7 3.45 5.5 2.25 5.5 1C5.5 0.45 5.05 0 4.5 0H1C0.45 0 0 0.45 0 1C0 10.39 7.61 18 17 18C17.55 18 18 17.55 18 17V13.5C18 12.95 17.55 12.5 17 12.5ZM9 0V10L12 7H18V0H9Z"
                fill="#e6ad02"></path>
            </svg>
          <li><a href="tel:+923392012739">+92 339 2012739</a></li>
          </li>
          <li>
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M17 12.5C15.75 12.5 14.55 12.3 13.43 11.93C13.08 11.82 12.69 11.9 12.41 12.17L10.21 14.37C7.38 12.93 5.06 10.62 3.62 7.79L5.82 5.58C6.1 5.31 6.18 4.92 6.07 4.57C5.7 3.45 5.5 2.25 5.5 1C5.5 0.45 5.05 0 4.5 0H1C0.45 0 0 0.45 0 1C0 10.39 7.61 18 17 18C17.55 18 18 17.55 18 17V13.5C18 12.95 17.55 12.5 17 12.5ZM9 0V10L12 7H18V0H9Z"
                fill="#e6ad02"></path>
            </svg>
          <li><a href="tel:+923095273505">+92 309 5273505</a></li>
          </li>
          <li>
            <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M20 6.98V16C20 17.1 19.1 18 18 18H2C0.9 18 0 17.1 0 16V4C0 2.9 0.9 2 2 2H12.1C12.04 2.32 12 2.66 12 3C12 4.48 12.65 5.79 13.67 6.71L10 9L2 4V6L10 11L15.3 7.68C15.84 7.88 16.4 8 17 8C18.13 8 19.16 7.61 20 6.98ZM14 3C14 4.66 15.34 6 17 6C18.66 6 20 4.66 20 3C20 1.34 18.66 0 17 0C15.34 0 14 1.34 14 3Z"
                fill="#e6ad02"></path>
            </svg>
            <span><a href="mailto:info@apexmarketings.com">info@apexmarketings.com</a></span>
          </li>
          <li>
            <svg width="14" height="20" viewBox="0 0 14 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0C3.13 0 0 3.13 0 7C0 12.25 7 20 7 20C7 20 14 12.25 14 7C14 3.13 10.87 0 7 0ZM7 9.5C5.62 9.5 4.5 8.38 4.5 7C4.5 5.62 5.62 4.5 7 4.5C8.38 4.5 9.5 5.62 9.5 7C9.5 8.38 8.38 9.5 7 9.5Z"
                fill="#e6ad02"></path>
            </svg>
            <span>Office no 426, Haider plaza, Range Rd, Afshan Colony, Rawalpindi, Pakistan</span>
          </li>
        </ul>

      </div>
      <div class="col-lg-6">
        <?php if ($apex_contact_error): ?>
        <div role="alert" style="background:#fdecea;border:1px solid #f5c6cb;color:#721c24;padding:12px 16px;border-radius:6px;margin-bottom:20px;">
          <?php echo htmlspecialchars($apex_contact_error, ENT_QUOTES, 'UTF-8'); ?>
        </div>
        <?php endif; ?>
        <form id="am-contact-form" action="./" method="post" class="row">
          <input type="text" name="website" autocomplete="off" tabindex="-1" aria-hidden="true" style="position:absolute;left:-9999px;">
          <?php echo apex_csrf_field(); ?>
          <div class="col-sm-6">
            <label class="cs-primary_color" for="am-contact-name">Name*</label>
            <input type="text" class="cs-form_field" id="am-contact-name" name="name" required autocomplete="name" value="<?php echo htmlspecialchars($apex_old['name'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          <div class="col-sm-6">
            <label class="cs-primary_color" for="am-contact-email">Email*</label>
            <input type="email" class="cs-form_field" id="am-contact-email" name="email" required autocomplete="email" value="<?php echo htmlspecialchars($apex_old['email'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          <div class="col-sm-6">
            <label class="cs-primary_color" for="am-contact-company">Company</label>
            <input type="text" class="cs-form_field" id="am-contact-company" name="company" autocomplete="organization" value="<?php echo htmlspecialchars($apex_old['company'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          <div class="col-sm-6">
            <label class="cs-primary_color" for="am-contact-phone">Phone</label>
            <input type="tel" class="cs-form_field" id="am-contact-phone" name="phone" autocomplete="tel" value="<?php echo htmlspecialchars($apex_old['phone'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="cs-height_20 cs-height_lg_20"></div>
          </div>
          <div class="col-lg-12">
            <label class="cs-primary_color" for="am-contact-message">Project Details*</label>
            <textarea cols="30" rows="7" class="cs-form_field" id="am-contact-message" name="message" required minlength="10"><?php echo htmlspecialchars($apex_old['message'], ENT_QUOTES, 'UTF-8'); ?></textarea>
            <div class="cs-height_25 cs-height_lg_25"></div>
          </div>
          <div class="col-lg-12">
            <button class="cs-btn cs-style1" type="submit">
              <span>Send Message</span>
              <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M25.5303 6.53033C25.8232 6.23744 25.8232 5.76256 25.5303 5.46967L20.7574 0.696699C20.4645 0.403806 19.9896 0.403806 19.6967 0.696699C19.4038 0.989593 19.4038 1.46447 19.6967 1.75736L23.9393 6L19.6967 10.2426C19.4038 10.5355 19.4038 11.0104 19.6967 11.3033C19.9896 11.5962 20.4645 11.5962 20.7574 11.3033L25.5303 6.53033ZM0 6.75H25V5.25H0V6.75Z"
                  fill="currentColor" />
              </svg>
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
  <!-- Start Footer -->
  <?php include_once('../include/footer1.php'); ?>
  <!-- End Footer -->

  <span class="cs-scrollup">
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0 10L1.7625 11.7625L8.75 4.7875V20H11.25V4.7875L18.225 11.775L20 10L10 0L0 10Z" fill="currentColor" />
    </svg>
  </span>

  <!-- Start Video Popup -->
  <div class="cs-video_popup">
    <div class="cs-video_popup_overlay"></div>
    <div class="cs-video_popup_content">
      <div class="cs-video_popup_layer"></div>
      <div class="cs-video_popup_container">
        <div class="cs-video_popup_align">
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="about:blank"></iframe>
          </div>
        </div>
        <div class="cs-video_popup_close"></div>
      </div>
    </div>
  </div>
  <!-- End Video Popup -->

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