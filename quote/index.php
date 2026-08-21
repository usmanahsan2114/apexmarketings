<?php
require_once __DIR__ . '/../private/mail.php';
apex_session_boot(); // must run before any output so the CSRF token persists

$apex_quote_error = null;
$apex_q_types = array('SEO services', 'Google Ads / PPC management', 'Meta Ads (Facebook + Instagram)', 'Social media management', 'E-commerce marketing', 'Lead generation campaign', 'Branding and positioning', 'Website development', 'Marketing automation', 'Full digital strategy', 'Not sure / other');
$apex_q_budgets = array('Under USD 500 / month', 'USD 500 - 1,500 / month', 'USD 1,500 - 5,000 / month', 'USD 5,000 - 15,000 / month', 'USD 15,000+ / month', 'One-time project budget (no monthly commit)', 'Need help estimating');
$apex_q_timelines = array('ASAP — within 2 weeks', '1 month', '2-3 months', '3-6 months', 'Flexible');
$apex_q_locations = array('Pakistan', 'United States', 'United Kingdom', 'UAE', 'Canada', 'Other');
$apex_old = array('project_type' => '', 'budget' => '', 'timeline' => '', 'location' => '', 'description' => '', 'name' => '', 'email' => '', 'company' => '', 'phone' => '');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $apex_old['project_type'] = apex_str(isset($_POST['project_type']) ? $_POST['project_type'] : '', 80);
    $apex_old['budget'] = apex_str(isset($_POST['budget']) ? $_POST['budget'] : '', 80);
    $apex_old['timeline'] = apex_str(isset($_POST['timeline']) ? $_POST['timeline'] : '', 80);
    $apex_old['location'] = apex_str(isset($_POST['location']) ? $_POST['location'] : '', 80);
    $apex_old['description'] = apex_text(isset($_POST['description']) ? $_POST['description'] : '', 8000);
    $apex_old['name'] = apex_str(isset($_POST['name']) ? $_POST['name'] : '', 120);
    $apex_old['email'] = apex_str(isset($_POST['email']) ? $_POST['email'] : '', 200);
    $apex_old['company'] = apex_str(isset($_POST['company']) ? $_POST['company'] : '', 160);
    $apex_old['phone'] = apex_str(isset($_POST['phone']) ? $_POST['phone'] : '', 30);

    if (!apex_honeypot_ok('website')) {
        // Bot: pretend success without sending or storing anything.
        header('Location: ../thank-you/?type=quote');
        exit;
    } elseif (!apex_csrf_check(isset($_POST['_token']) ? $_POST['_token'] : null)) {
        $apex_quote_error = 'Your session expired. Please review your answers and submit again.';
    } elseif (!in_array($apex_old['project_type'], $apex_q_types, true) || !in_array($apex_old['budget'], $apex_q_budgets, true) || !in_array($apex_old['timeline'], $apex_q_timelines, true) || !in_array($apex_old['location'], $apex_q_locations, true)) {
        $apex_quote_error = 'Please answer questions 1-4 using the options provided.';
    } elseif (strlen($apex_old['description']) < 20) {
        $apex_quote_error = 'Please tell us a little more about your business and goals (at least 20 characters).';
    } elseif ($apex_old['name'] === '' || !apex_valid_email($apex_old['email'])) {
        $apex_quote_error = 'Please enter your name and a valid email address.';
    } elseif ($apex_old['phone'] !== '' && !apex_valid_phone($apex_old['phone'])) {
        $apex_quote_error = 'Please enter a valid phone number, or leave the phone field empty.';
    } elseif (!apex_rate_limit_ok('quote', 5, 600)) {
        $apex_quote_error = 'Too many requests from your connection. Please wait a few minutes and try again, or email info@apexmarketings.com.';
    } else {
        $result = apex_send_mail(array(
            'subject'      => 'Quote request: ' . $apex_old['project_type'],
            'formType'     => 'quote',
            'replyToEmail' => $apex_old['email'],
            'replyToName'  => $apex_old['name'],
            'autorespond'  => true,
            'fields'       => array(
                'Project type'   => $apex_old['project_type'],
                'Monthly budget' => $apex_old['budget'],
                'Timeline'       => $apex_old['timeline'],
                'Location'       => $apex_old['location'],
                'Business/goals' => $apex_old['description'],
                'Name'           => $apex_old['name'],
                'Email'          => $apex_old['email'],
                'Company'        => $apex_old['company'],
                'Phone'          => $apex_old['phone'],
            ),
        ));
        if ($result['ok']) {
            header('Location: ../thank-you/?type=quote');
            exit;
        }
        $apex_quote_error = 'Your quote request could not be sent right now. Please email info@apexmarketings.com or use WhatsApp +92 339 2012739.';
    }
}

$seo_title = "Get a Quote | Apex Marketings — Free Estimate in 24 Hours";
$seo_desc = "Get a free digital marketing project quote from Apex Marketings. Answer 6 quick questions and receive a tailored estimate within 24 hours.";
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <?php include_once('../include/head1.php'); ?>
  <script type="application/ld+json">{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"Home","item":"https://apexmarketings.com/"},{"@type":"ListItem","position":2,"name":"Quote","item":"https://apexmarketings.com/quote/"}]}</script>
  <script type="application/ld+json">{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[{"@type":"Question","name":"Is there a minimum engagement size?","acceptedAnswer":{"@type":"Answer","text":"For one-off projects: USD 2,000 minimum. For monthly retainers: USD 800/month minimum. Below those, we typically refer to specialists we trust."}},{"@type":"Question","name":"Can I get a quote without a call?","acceptedAnswer":{"@type":"Answer","text":"Yes for one-off projects (we can quote from a written brief). For ongoing retainers, the discovery call is mandatory \u2014 we won't quote ongoing work without understanding your business."}},{"@type":"Question","name":"Do you sign NDAs before the call?","acceptedAnswer":{"@type":"Answer","text":"Yes, on request. Email info@apexmarketings.com and we'll send our standard mutual NDA or sign yours."}},{"@type":"Question","name":"What if my business doesn't fit your service mix?","acceptedAnswer":{"@type":"Answer","text":"We'll say so directly and refer you to someone better-suited. We don't take engagements outside our specialty."}}]}</script>
</head>
<body>
  <div class="cs-preloader cs-center">
    <div class="cs-preloader_in">
      <img src="../assets/img/icons/apexlogo.svg" alt="Apex Marketings logo preloader" class="cs-preloader_img" width="400" height="400" decoding="async" loading="eager" />
    </div>
  </div>
  <?php include_once('../include/header1.php'); ?>

  <div class="cs-page_heading cs-style1 cs-center text-center cs-bg" style="height: 300px; background-color: #111;">
    <div class="container">
      <div class="cs-page_heading_in">
        <h1 class="cs-page_title cs-font_50 cs-white_color">Get a Quote</h1>
        <ol class="breadcrumb" style="background:transparent;justify-content:center;color:rgba(255,255,255,0.7);font-size:14px;margin-top:14px;"><a href="../">Home</a> <span style="opacity:0.5;margin:0 8px;">/</span> <span aria-current="page">Quote</span></ol>
      </div>
    </div>
  </div>

  <section class="cs-spacing">
    <div class="container" style="padding-top: 60px; padding-bottom: 60px;">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <article style="font-size:16px;line-height:1.7;color:#ddd;">
            <div class="lead" style="font-size:19px;line-height:1.6;margin-bottom:32px;color:#bbb;">
              Six quick questions about your business. We'll respond within 24 hours with a starting-from estimate and a free 30-minute discovery call. All inquiries are confidential.
            </div>
            <style>article a {color:rgb(20,120,190);text-decoration:underline;} article h2 {margin-top:48px;} article h3 {margin-top:32px;}</style>
            <h2 class="cs-font_36 mb-4">Quick quote request</h2>
            <p style="font-size: 15px; color: #555; font-weight: 500; margin-bottom: 20px;">
              <span style="color:#25D366;">✔</span> No commitment required &nbsp;&nbsp;|&nbsp;&nbsp; <span style="color:#25D366;">⚡</span> We reply within 24 hours
            </p>
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:24px;background:#f9f9f9;padding:10px 16px;border-radius:8px;display:inline-flex;">
              <span style="color:#e6ad02;font-size:18px;letter-spacing:2px;">★★★★★</span>
              <span style="font-size:14px;color:#ddd;font-weight:600;">4.9/5 Average Rating from 50+ Global Clients</span>
            </div>
<?php if ($apex_quote_error): ?>
<div role="alert" style="background:#fdecea;border:1px solid #f5c6cb;color:#721c24;padding:12px 16px;border-radius:6px;max-width:760px;margin:0 auto 20px;">
  <?php echo htmlspecialchars($apex_quote_error, ENT_QUOTES, 'UTF-8'); ?>
</div>
<?php endif; ?>
<form action="./" method="post" id="apex-quote-form" style="background:transparent;padding:32px;border-radius:12px;border:1px solid #eee;max-width:760px;margin:0 auto;">
  <input type="text" name="website" autocomplete="off" tabindex="-1" aria-hidden="true" style="position:absolute;left:-9999px;">
  <?php echo apex_csrf_field(); ?>

  <div style="margin-bottom:20px;">
    <label style="display:block;font-weight:600;margin-bottom:8px;">1. What kind of project?</label>
    <select name="project_type" required style="width:100%;padding:12px;border:1px solid #ddd;border-radius:6px;font-size:15px;background:#1a1a1a;">
      <option value="">Choose…</option>
      <?php foreach ($apex_q_types as $apex_opt): ?>
      <option<?php echo $apex_opt === $apex_old['project_type'] ? ' selected' : ''; ?>><?php echo htmlspecialchars($apex_opt, ENT_QUOTES, 'UTF-8'); ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div style="margin-bottom:20px;">
    <label style="display:block;font-weight:600;margin-bottom:8px;">2. Approximate monthly marketing budget?</label>
    <select name="budget" required style="width:100%;padding:12px;border:1px solid #ddd;border-radius:6px;font-size:15px;background:#1a1a1a;">
      <option value="">Choose…</option>
      <?php foreach ($apex_q_budgets as $apex_opt): ?>
      <option<?php echo $apex_opt === $apex_old['budget'] ? ' selected' : ''; ?>><?php echo htmlspecialchars($apex_opt, ENT_QUOTES, 'UTF-8'); ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div style="margin-bottom:20px;">
    <label style="display:block;font-weight:600;margin-bottom:8px;">3. Timeline?</label>
    <select name="timeline" required style="width:100%;padding:12px;border:1px solid #ddd;border-radius:6px;font-size:15px;background:#1a1a1a;">
      <option value="">Choose…</option>
      <?php foreach ($apex_q_timelines as $apex_opt): ?>
      <option<?php echo $apex_opt === $apex_old['timeline'] ? ' selected' : ''; ?>><?php echo htmlspecialchars($apex_opt, ENT_QUOTES, 'UTF-8'); ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div style="margin-bottom:20px;">
    <label style="display:block;font-weight:600;margin-bottom:8px;">4. Where are you located?</label>
    <select name="location" required style="width:100%;padding:12px;border:1px solid #ddd;border-radius:6px;font-size:15px;background:#1a1a1a;">
      <option value="">Choose…</option>
      <?php foreach ($apex_q_locations as $apex_opt): ?>
      <option<?php echo $apex_opt === $apex_old['location'] ? ' selected' : ''; ?>><?php echo htmlspecialchars($apex_opt, ENT_QUOTES, 'UTF-8'); ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div style="margin-bottom:20px;">
    <label style="display:block;font-weight:600;margin-bottom:8px;">5. Tell us about your business and goals (2-4 sentences)</label>
    <textarea name="description" rows="4" required minlength="20" style="width:100%;padding:12px;border:1px solid #ddd;border-radius:6px;font-size:15px;font-family:inherit;background:#1a1a1a;" placeholder="What do you sell? Who is your customer? What growth result would make this engagement a win?"><?php echo htmlspecialchars($apex_old['description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
  </div>

  <div style="margin-bottom:24px;">
    <label style="display:block;font-weight:600;margin-bottom:8px;">6. Your contact info</label>
    <input type="text" name="name" required placeholder="Your name" aria-label="Your name" autocomplete="name" value="<?php echo htmlspecialchars($apex_old['name'], ENT_QUOTES, 'UTF-8'); ?>" style="width:100%;padding:12px;border:1px solid #ddd;border-radius:6px;font-size:15px;margin-bottom:10px;background:#1a1a1a;">
    <input type="email" name="email" required placeholder="Email" aria-label="Email" autocomplete="email" value="<?php echo htmlspecialchars($apex_old['email'], ENT_QUOTES, 'UTF-8'); ?>" style="width:100%;padding:12px;border:1px solid #ddd;border-radius:6px;font-size:15px;margin-bottom:10px;background:#1a1a1a;">
    <input type="text" name="company" placeholder="Company (optional)" aria-label="Company" autocomplete="organization" value="<?php echo htmlspecialchars($apex_old['company'], ENT_QUOTES, 'UTF-8'); ?>" style="width:100%;padding:12px;border:1px solid #ddd;border-radius:6px;font-size:15px;margin-bottom:10px;background:#1a1a1a;">
    <input type="tel" name="phone" placeholder="Phone (optional)" aria-label="Phone" autocomplete="tel" value="<?php echo htmlspecialchars($apex_old['phone'], ENT_QUOTES, 'UTF-8'); ?>" style="width:100%;padding:12px;border:1px solid #ddd;border-radius:6px;font-size:15px;background:#1a1a1a;">
  </div>

  <button type="submit" style="background:rgb(20,120,190);color:#fff;border:none;padding:14px 40px;border-radius:30px;font-size:16px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:8px;">
    Submit Quote Request
    <svg width="20" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M25.5307 6.53033C25.8236 6.23744 25.8236 5.76256 25.5307 5.46967L20.7577 0.696699C20.4648 0.403806 19.99 0.403806 19.6971 0.696699C19.4042 0.989593 19.4042 1.46447 19.6971 1.75736L23.9397 6L19.6971 10.2426C19.4042 10.5355 19.4042 11.0104 19.6971 11.3033C19.99 11.5962 20.4648 11.5962 20.7577 11.3033L25.5307 6.53033ZM0.000366211 6.75H25.0004V5.25H0.000366211V6.75Z" fill="white"/></svg>
  </button>
  <p style="margin-top:16px;font-size:13px;color:#888;">By submitting, you agree to our <a href="../privacy-policy/">Privacy Policy</a>. We will respond within 24 hours.</p>
</form>
</p>
              <h2 class="cs-font_36 mb-4">What happens after you submit</h2>
              <ul style="line-height:1.8;padding-left:20px;margin:20px 0;"><li style="margin-bottom:10px;"><strong>Within 24 hours:</strong> we acknowledge your request and confirm a discovery call time.</li><li style="margin-bottom:10px;"><strong>Within 48 hours:</strong> free 30-minute discovery call with a senior strategist.</li><li style="margin-bottom:10px;"><strong>Within 3-5 days:</strong> written starting-from estimate based on the call.</li><li style="margin-bottom:10px;"><strong>If we proceed:</strong> we run a paid 1-week Discovery Sprint to produce a detailed scope (USD 500-2,000).</li></ul>
              <h2 class="cs-font_36 mb-4">What we will not do</h2>
              <ul style="line-height:1.8;padding-left:20px;margin:20px 0;"><li style="margin-bottom:10px;">Send a 7-email drip sequence — one acknowledgment, one discovery call, that's it until you decide.</li><li style="margin-bottom:10px;">Pad an estimate based on perceived budget — we publish starting-from rates publicly for a reason.</li><li style="margin-bottom:10px;">Subcontract your campaigns to a third-party agency — all work is delivered by Apex Marketings.</li><li style="margin-bottom:10px;">Lock you in before you've seen a scope — Discovery is its own paid milestone you can walk away from.</li></ul>
            <h2 class="cs-font_36 mb-4 mt-5">Frequently Asked Questions</h2>
              <h3 class="cs-font_24 mt-4 mb-2">Is there a minimum engagement size?</h3><p>For one-off projects: USD 2,000 minimum. For monthly retainers: USD 800/month minimum. Below those, we typically refer to specialists we trust.</p>
              <h3 class="cs-font_24 mt-4 mb-2">Can I get a quote without a call?</h3><p>Yes for one-off projects (we can quote from a written brief). For ongoing retainers, the discovery call is mandatory — we won't quote ongoing work without understanding your business.</p>
              <h3 class="cs-font_24 mt-4 mb-2">Do you sign NDAs before the call?</h3><p>Yes, on request. Email info@apexmarketings.com and we'll send our standard mutual NDA or sign yours.</p>
              <h3 class="cs-font_24 mt-4 mb-2">What if my business doesn't fit your service mix?</h3><p>We'll say so directly and refer you to someone better-suited. We don't take engagements outside our specialty.</p>
            <div style="margin-top:60px;padding-top:30px;border-top:1px solid #eee;">
              <p><strong>Ready to talk?</strong> <a href="../contact/">Book a free 30-minute consultation</a> with Apex Marketings, or <a href="../quote/">request a project quote</a>.</p>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>
  
  <section class="cs-spacing" style="background:transparent;padding-top:60px;padding-bottom:60px;">
    <div class="container">
      <h2 class="cs-font_36 text-center mb-5">Related Resources</h2>
      <div class="row">
        <div class="col-md-4 mb-4">
          <a href="../pricing/" class="d-block aur-linkcard" style="padding:24px;background:#1a1a1a;border-radius:12px;border:1px solid #333;color:inherit;text-decoration:none;height:100%;transition:transform 0.2s,box-shadow 0.2s;">
            <h4 class="cs-font_20" style="margin:0 0 8px;font-weight:600;">Pricing</h4>
            <p style="margin:0;font-size:14px;opacity:0.75;">Starting-from rates for context</p>
          </a>
        </div>
        <div class="col-md-4 mb-4">
          <a href="../services/" class="d-block aur-linkcard" style="padding:24px;background:#1a1a1a;border-radius:12px;border:1px solid #333;color:inherit;text-decoration:none;height:100%;transition:transform 0.2s,box-shadow 0.2s;">
            <h4 class="cs-font_20" style="margin:0 0 8px;font-weight:600;">Services</h4>
            <p style="margin:0;font-size:14px;opacity:0.75;">What we offer</p>
          </a>
        </div>
        <div class="col-md-4 mb-4">
          <a href="../process/" class="d-block aur-linkcard" style="padding:24px;background:#1a1a1a;border-radius:12px;border:1px solid #333;color:inherit;text-decoration:none;height:100%;transition:transform 0.2s,box-shadow 0.2s;">
            <h4 class="cs-font_20" style="margin:0 0 8px;font-weight:600;">Process</h4>
            <p style="margin:0;font-size:14px;opacity:0.75;">How engagements run</p>
          </a>
        </div>
        <div class="col-md-4 mb-4">
          <a href="../trust/" class="d-block aur-linkcard" style="padding:24px;background:#1a1a1a;border-radius:12px;border:1px solid #333;color:inherit;text-decoration:none;height:100%;transition:transform 0.2s,box-shadow 0.2s;">
            <h4 class="cs-font_20" style="margin:0 0 8px;font-weight:600;">Trust & Security</h4>
            <p style="margin:0;font-size:14px;opacity:0.75;">NDAs and data handling</p>
          </a>
        </div>
        <div class="col-md-4 mb-4">
          <a href="../case-studies/" class="d-block aur-linkcard" style="padding:24px;background:#1a1a1a;border-radius:12px;border:1px solid #333;color:inherit;text-decoration:none;height:100%;transition:transform 0.2s,box-shadow 0.2s;">
            <h4 class="cs-font_20" style="margin:0 0 8px;font-weight:600;">Case Studies</h4>
            <p style="margin:0;font-size:14px;opacity:0.75;">Real work</p>
          </a>
        </div>
        <div class="col-md-4 mb-4">
          <a href="../contact/" class="d-block aur-linkcard" style="padding:24px;background:#1a1a1a;border-radius:12px;border:1px solid #333;color:inherit;text-decoration:none;height:100%;transition:transform 0.2s,box-shadow 0.2s;">
            <h4 class="cs-font_20" style="margin:0 0 8px;font-weight:600;">Contact</h4>
            <p style="margin:0;font-size:14px;opacity:0.75;">Or just email us</p>
          </a>
        </div>
      </div>
    </div>
  </section>

  <?php include_once('../include/footer1.php'); ?>

  <script src="../assets/js/plugins/jquery-3.6.0.min.js"></script>
  <script src="../assets/js/main.js?v=20260820-aurora1"></script>
</body>
</html>