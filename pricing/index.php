<?php
$seo_title = "Digital Marketing Pricing: Published Rates | Apex Marketings";
$seo_desc = "Transparent digital marketing pricing by Apex Marketings. Live currency switching across USD, PKR, AED, and GBP for SEO, Google Ads, Meta Ads, and e-commerce retainers.";
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <?php include_once('../include/head1.php'); ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@graph": [
      {
        "@type": "BreadcrumbList",
        "itemListElement": [
          {"@type": "ListItem", "position": 1, "name": "Home", "item": "https://apexmarketings.com/"},
          {"@type": "ListItem", "position": 2, "name": "Pricing", "item": "https://apexmarketings.com/pricing/"}
        ]
      },
      {
        "@type": "OfferCatalog",
        "name": "Apex Marketings Transparent Service Pricing",
        "url": "https://apexmarketings.com/pricing/",
        "itemListElement": [
          {"@type": "Offer", "name": "SEO & Organic Growth Retainer", "price": "800", "priceCurrency": "USD"},
          {"@type": "Offer", "name": "Google Ads PPC Management", "price": "600", "priceCurrency": "USD"},
          {"@type": "Offer", "name": "Meta Ads (FB & IG) Management", "price": "600", "priceCurrency": "USD"},
          {"@type": "Offer", "name": "Social Media Content & Growth", "price": "500", "priceCurrency": "USD"},
          {"@type": "Offer", "name": "E-Commerce Growth Retainer", "price": "2500", "priceCurrency": "USD"},
          {"@type": "Offer", "name": "Full-Service Multi-Channel Retainer", "price": "2000", "priceCurrency": "USD"}
        ]
      },
      {
        "@type": "FAQPage",
        "mainEntity": [
          {
            "@type": "Question",
            "name": "Why does Apex Marketings publish transparent pricing?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Most agencies conceal rates to maximize markups during sales negotiations. We publish baseline starting figures across USD, PKR, AED, and GBP so businesses can plan budgets realistically before engaging in a discovery call."
            }
          },
          {
            "@type": "Question",
            "name": "Are digital marketing retainers negotiable?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Yes, for long-term 6 or 12-month commitments and repeat clients, we offer 10% to 15% rate optimizations. We maintain firm standards against unsustainably discounted rates to ensure senior strategists manage your accounts."
            }
          },
          {
            "@type": "Question",
            "name": "Which currencies and payment channels do you accept?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "We accept USD, GBP, EUR, AED, and PKR. International payments are processed via Wise Business, direct SWIFT wire, or Stripe Atlas corporate card invoicing. Pakistani clients can pay directly via local bank transfer."
            }
          },
          {
            "@type": "Question",
            "name": "Who owns our ad accounts and tracking data?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "You retain 100% ownership of your Meta Business Manager, Google Ads accounts, Google Analytics properties, and Tag Manager containers. We operate strictly as partner managers with administrative delegation."
            }
          }
        ]
      }
    ]
  }
  </script>
  <style>
    .currency-selector-bar {
      display: inline-flex;
      background: #1e1e1e;
      border: 1px solid #333;
      border-radius: 40px;
      padding: 4px;
      margin-bottom: 35px;
    }
    .curr-btn {
      background: transparent;
      border: none;
      color: #999;
      font-weight: 600;
      font-size: 14px;
      padding: 8px 20px;
      border-radius: 30px;
      cursor: pointer;
      transition: all 0.25s ease;
    }
    .curr-btn.active {
      background: #1478be;
      color: #fff;
      box-shadow: 0 2px 10px rgba(20,120,190,0.4);
    }
    .pricing-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 24px;
      margin: 40px 0;
    }
    .price-card {
      background: #161616;
      border: 1px solid #282828;
      border-radius: 12px;
      padding: 28px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      transition: transform 0.2s, border-color 0.2s;
    }
    .price-card:hover {
      transform: translateY(-4px);
      border-color: #1478be;
    }
    .price-card.featured {
      border-color: #e6ad02;
      background: linear-gradient(180deg, rgba(230,173,2,0.06), #161616);
      position: relative;
    }
    .badge-feat {
      position: absolute;
      top: -12px;
      right: 20px;
      background: #e6ad02;
      color: #000;
      font-size: 11px;
      font-weight: 700;
      padding: 3px 10px;
      border-radius: 12px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    .price-amount {
      font-size: 34px;
      font-weight: 700;
      color: #fff;
      margin: 12px 0 6px;
    }
    .price-period {
      font-size: 13px;
      color: #888;
    }
    .feature-list {
      list-style: none;
      padding-left: 0;
      margin: 20px 0;
      font-size: 14px;
      color: #ccc;
      line-height: 1.8;
    }
    .feature-list li::before {
      content: "✓ ";
      color: #4ade80;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="cs-preloader cs-center">
    <div class="cs-preloader_in">
      <img src="../assets/img/icons/apexlogo.svg" alt="Apex Marketings logo preloader" class="cs-preloader_img" width="400" height="400" decoding="async" loading="eager" />
    </div>
  </div>
  <?php include_once('../include/header1.php'); ?>

  <div class="cs-page_heading cs-style1 cs-center text-center cs-bg" style="height: 320px; background-color: #111;">
    <div class="container">
      <div class="cs-page_heading_in">
        <h1 class="cs-page_title cs-font_50 cs-white_color">Transparent Marketing Pricing</h1>
        <p class="cs-white_color" style="opacity:0.8;max-width:680px;margin:12px auto 0;font-size:16px;">
          Starting Rates Across Real Retainer Models. No Hidden Fees, No Hostage Accounts.
        </p>
        <ol class="breadcrumb" style="background:transparent;justify-content:center;color:rgba(255,255,255,0.7);font-size:14px;margin-top:14px;">
          <a href="../">Home</a> <span style="opacity:0.5;margin:0 8px;">/</span> 
          <span aria-current="page">Pricing</span>
        </ol>
      </div>
    </div>
  </div>

  <section class="cs-spacing">
    <div class="container" style="padding-top: 60px; padding-bottom: 60px;">
      <div class="row">
        <div class="col-lg-12 text-center">
          
          <!-- Dynamic Currency Switcher -->
          <div class="currency-selector-wrap">
            <span style="display:block;font-size:13px;color:#aaa;margin-bottom:10px;text-transform:uppercase;letter-spacing:1px;">Select Currency</span>
            <div class="currency-selector-bar">
              <button class="curr-btn active" data-currency="USD">USD ($)</button>
              <button class="curr-btn" data-currency="PKR">PKR (Rs)</button>
              <button class="curr-btn" data-currency="AED">AED (AED)</button>
              <button class="curr-btn" data-currency="GBP">GBP (£)</button>
            </div>
          </div>

        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          
          <!-- Interactive Pricing Cards -->
          <div class="pricing-grid">
            
            <!-- Card 1: SEO -->
            <div class="price-card">
              <div>
                <h3 class="cs-font_22 cs-white_color" style="margin-top:0;">SEO &amp; Local Visibility</h3>
                <p style="font-size:13px;color:#aaa;margin:0;">Technical audit, on-page optimization, and high-intent commercial rank acquisition.</p>
                <div class="price-amount" data-usd="800" data-pkr="220000" data-aed="2950" data-gbp="650">$800</div>
                <div class="price-period">per month (starting retainer)</div>
                <ul class="feature-list">
                  <li>Technical SEO &amp; Core Web Vitals audit</li>
                  <li>Keyword intent mapping &amp; competitor gap analysis</li>
                  <li>On-page schema markup deployment</li>
                  <li>Monthly high-authority editorial backlink outreach</li>
                  <li>Weekly Looker Studio KPI performance dashboard</li>
                </ul>
              </div>
              <a href="../quote/?service=seo" class="cs-btn cs-style1" style="background:#1e1e1e;border:1px solid #444;color:#fff;text-align:center;padding:12px;border-radius:6px;text-decoration:none;display:block;">Get Scoped SEO Quote</a>
            </div>

            <!-- Card 2: Google Ads -->
            <div class="price-card">
              <div>
                <h3 class="cs-font_22 cs-white_color" style="margin-top:0;">Google Ads PPC</h3>
                <p style="font-size:13px;color:#aaa;margin:0;">High-intent Search, Performance Max, and Shopping campaigns that maximize ROAS.</p>
                <div class="price-amount" data-usd="600" data-pkr="170000" data-aed="2200" data-gbp="490">$600</div>
                <div class="price-period">per month + your ad spend</div>
                <ul class="feature-list">
                  <li>Full negative keyword filtering architecture</li>
                  <li>Performance Max &amp; Shopping feed optimization</li>
                  <li>Advanced server-side conversion tracking</li>
                  <li>Landing page A/B headline &amp; CTA testing</li>
                  <li>Bi-weekly strategy calls &amp; budget scaling</li>
                </ul>
              </div>
              <a href="../quote/?service=google-ads" class="cs-btn cs-style1" style="background:#1e1e1e;border:1px solid #444;color:#fff;text-align:center;padding:12px;border-radius:6px;text-decoration:none;display:block;">Get Scoped PPC Quote</a>
            </div>

            <!-- Card 3: Meta Ads -->
            <div class="price-card featured">
              <span class="badge-feat">High Demand</span>
              <div>
                <h3 class="cs-font_22 cs-white_color" style="margin-top:0;">Meta Ads (FB &amp; IG)</h3>
                <p style="font-size:13px;color:#aaa;margin:0;">Full-funnel creative testing and audience scaling for D2C brands and service leads.</p>
                <div class="price-amount" data-usd="600" data-pkr="170000" data-aed="2200" data-gbp="490">$600</div>
                <div class="price-period">per month + your ad spend</div>
                <ul class="feature-list">
                  <li>15–20 creative hook tests monthly (video, static, UGC)</li>
                  <li>Advantage+ audience and catalog feed optimization</li>
                  <li>CAPI (Conversions API) server-side integration</li>
                  <li>Full retention &amp; abandoned cart remarketing</li>
                  <li>Targeting 3.5x to 5.0x verified ROAS</li>
                </ul>
              </div>
              <a href="../quote/?service=meta-ads" class="cs-btn cs-style1" style="background:#e6ad02;color:#000;font-weight:700;text-align:center;padding:12px;border-radius:6px;text-decoration:none;display:block;">Scale Meta Ads</a>
            </div>

            <!-- Card 4: Full-Service -->
            <div class="price-card">
              <div>
                <h3 class="cs-font_22 cs-white_color" style="margin-top:0;">Full-Service Growth</h3>
                <p style="font-size:13px;color:#aaa;margin:0;">Multi-channel growth retainer uniting SEO, Google Ads, Meta Ads, and CRO.</p>
                <div class="price-amount" data-usd="2000" data-pkr="560000" data-aed="7350" data-gbp="1600">$2,000</div>
                <div class="price-period">per month (multi-channel retainer)</div>
                <ul class="feature-list">
                  <li>Omnichannel marketing strategy (Search + Paid Social)</li>
                  <li>Dedicated senior growth director on your account</li>
                  <li>Conversion rate optimization &amp; landing page engineering</li>
                  <li>Automated WhatsApp / Email retention flows</li>
                  <li>Live Slack channel &amp; weekly performance sprint</li>
                </ul>
              </div>
              <a href="../quote/?service=full-service" class="cs-btn cs-style1" style="background:#1478be;color:#fff;text-align:center;padding:12px;border-radius:6px;text-decoration:none;display:block;">Book Retainer Consultation</a>
            </div>

          </div>

        </div>
      </div>

      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <article style="font-size:16px;line-height:1.8;color:#ddd;margin-top:40px;">
            
            <h2 class="cs-font_36 mb-4 cs-white_color">What Is Included in Every Apex Marketings Retainer</h2>
            <ul style="line-height:1.8;padding-left:20px;margin:20px 0;">
              <li style="margin-bottom:10px;"><strong>Free 30-minute discovery call</strong> to understand your commercial margins and customer lifetime value.</li>
              <li style="margin-bottom:10px;"><strong>Comprehensive initial audit:</strong> Full review of tracking pixels, Google Tag Manager, ad creative fatigue, and crawl health.</li>
              <li style="margin-bottom:10px;"><strong>Named Senior Strategist:</strong> Direct collaboration with experienced specialists, not junior account coordinators.</li>
              <li style="margin-bottom:10px;"><strong>Weekly sprint reports &amp; bi-weekly video calls:</strong> Full accountability with transparent KPI benchmarks.</li>
              <li style="margin-bottom:10px;"><strong>100% Account Ownership:</strong> You retain ownership of all ad accounts, analytics properties, creative files, and data.</li>
              <li style="margin-bottom:10px;"><strong>Flexible exit terms:</strong> 30-day cancellation notice after initial onboarding period — we earn your business each month.</li>
            </ul>

            <h2 class="cs-font_36 mb-4 mt-5 cs-white_color">Engagement Models</h2>
            <div class="row" style="margin:25px 0;">
              <div class="col-md-4 mb-3">
                <div style="background:#161616;padding:20px;border-radius:8px;border:1px solid #282828;">
                  <h3 class="cs-font_18 cs-white_color" style="margin-top:0;">Monthly Retainer</h3>
                  <p style="font-size:14px;color:#aaa;line-height:1.6;margin:0;">
                    Predictable monthly fee for ongoing campaigns, continuous creative testing, and technical search visibility. Best for businesses seeking consistent scale.
                  </p>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div style="background:#161616;padding:20px;border-radius:8px;border:1px solid #282828;">
                  <h3 class="cs-font_18 cs-white_color" style="margin-top:0;">Fixed-Bid Sprint</h3>
                  <p style="font-size:14px;color:#aaa;line-height:1.6;margin:0;">
                    Clearly defined single deliverables such as comprehensive SEO audits, high-converting landing page builds, or tracking infrastructure overhauls.
                  </p>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div style="background:#161616;padding:20px;border-radius:8px;border:1px solid #282828;">
                  <h3 class="cs-font_18 cs-white_color" style="margin-top:0;">Hybrid Performance</h3>
                  <p style="font-size:14px;color:#aaa;line-height:1.6;margin:0;">
                    Lower baseline retainer combined with a performance bonus based on verified incremental ROAS or qualified lead thresholds.
                  </p>
                </div>
              </div>
            </div>

            <h2 class="cs-font_36 mb-4 mt-5 cs-white_color">Frequently Asked Questions</h2>
            <div style="margin-top:24px;">
              <h3 class="cs-font_22 mb-2 cs-white_color">Why does Apex Marketings publish transparent pricing?</h3>
              <p>
                Most agencies conceal rates to maximize markups during sales negotiations. We publish baseline starting figures across USD, PKR, AED, and GBP so businesses can plan budgets realistically before engaging in a discovery call.
              </p>

              <h3 class="cs-font_22 mb-2 cs-white_color">Are digital marketing retainers negotiable?</h3>
              <p>
                Yes, for long-term 6 or 12-month commitments and repeat clients, we offer 10% to 15% rate optimizations. We maintain firm standards against unsustainably discounted rates to ensure senior strategists manage your accounts.
              </p>

              <h3 class="cs-font_22 mb-2 cs-white_color">Which currencies and payment channels do you accept?</h3>
              <p>
                We accept USD, GBP, EUR, AED, and PKR. International payments are processed via Wise Business, direct SWIFT wire, or Stripe Atlas corporate card invoicing. Pakistani clients can pay directly via local bank transfer.
              </p>

              <h3 class="cs-font_22 mb-2 cs-white_color">Who owns our ad accounts and tracking data?</h3>
              <p>
                You retain 100% ownership of your Meta Business Manager, Google Ads accounts, Google Analytics properties, and Tag Manager containers. We operate strictly as partner managers with administrative delegation.
              </p>
            </div>

            <div style="margin-top:60px;padding:30px;background:#151515;border-radius:12px;border:1px solid #262626;text-align:center;">
              <h3 class="cs-font_28 cs-white_color" style="margin-top:0;margin-bottom:12px;">Get an Exact Quote for Your Business</h3>
              <p style="max-width:600px;margin:0 auto 20px;color:#aaa;">
                Every business has unique CAC targets and growth goals. Schedule a free 30-minute discovery call to receive a transparent, scoped proposal within 24 hours.
              </p>
              <a href="../contact/" class="cs-btn cs-style1" style="background:#1478be;color:#fff;padding:12px 30px;border-radius:6px;text-decoration:none;display:inline-block;margin-right:12px;">Book Discovery Call</a>
              <a href="../quote/" class="cs-btn cs-style1" style="background:transparent;border:1px solid #444;color:#fff;padding:12px 30px;border-radius:6px;text-decoration:none;display:inline-block;">Request Scoped Quote</a>
            </div>

          </article>
        </div>
      </div>
    </div>
  </section>

  <!-- Currency Switcher JavaScript with Locale Auto-Detection & GA4 Event Tracking -->
  <script>
  (function() {
    var currencySymbols = {
      USD: '$',
      PKR: 'Rs ',
      AED: 'AED ',
      GBP: '£'
    };

    function detectLocaleCurrency() {
      try {
        var tz = (Intl && Intl.DateTimeFormat) ? Intl.DateTimeFormat().resolvedOptions().timeZone : '';
        if (/Karachi|Asia\/Karachi/i.test(tz)) return 'PKR';
        if (/Dubai|Asia\/Dubai|Gulf/i.test(tz)) return 'AED';
        if (/London|Europe\/London/i.test(tz)) return 'GBP';
      } catch(e) {}
      return 'USD';
    }

    function setCurrency(curr, isUserInitiated) {
      var symbol = currencySymbols[curr] || '$';
      document.querySelectorAll('.curr-btn').forEach(function(btn) {
        if (btn.getAttribute('data-currency') === curr) {
          btn.classList.add('active');
        } else {
          btn.classList.remove('active');
        }
      });

      document.querySelectorAll('.price-amount').forEach(function(el) {
        var attr = 'data-' + curr.toLowerCase();
        var val = el.getAttribute(attr);
        if (val) {
          var num = parseInt(val, 10);
          if (curr === 'PKR') {
            if (num >= 100000) {
              var lakhs = (num / 100000).toFixed(1).replace(/\.0$/, '');
              el.textContent = 'Rs ' + lakhs + ' Lakh';
            } else {
              el.textContent = 'Rs ' + num.toLocaleString();
            }
          } else {
            el.textContent = symbol + num.toLocaleString();
          }
        }
      });

      try {
        localStorage.setItem('apex_preferred_currency', curr);
      } catch(e) {}

      if (isUserInitiated && typeof gtag === 'function') {
        gtag('event', 'pricing_toggle_used', {
          currency: curr,
          page_location: window.location.href
        });
      }
    }

    // Initialize currency
    var savedCurr = null;
    try {
      savedCurr = localStorage.getItem('apex_preferred_currency');
    } catch(e) {}
    var initialCurr = savedCurr || detectLocaleCurrency();
    setCurrency(initialCurr, false);

    // Bind click events
    document.querySelectorAll('.curr-btn').forEach(function(btn) {
      btn.addEventListener('click', function() {
        var c = this.getAttribute('data-currency');
        setCurrency(c, true);
      });
    });
  })();
  </script>

  <?php include_once('../include/footer1.php'); ?>
  <script src="../assets/js/plugins/jquery-3.6.0.min.js"></script>
  <script src="../assets/js/main.js?v=20260820-aurora1"></script>
</body>
</html>