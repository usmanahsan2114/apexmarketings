<?php
$seo_title = "Search | Apex Marketings";
$seo_desc = "Search Apex Marketings: blog posts, services, case studies, locations, industries, and glossary terms.";
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta name="robots" content="noindex,follow">
  <?php include_once('../include/head1.php'); ?>
  <script type="application/ld+json">{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"Home","item":"https://apexmarketings.com/"},{"@type":"ListItem","position":2,"name":"Search","item":"https://apexmarketings.com/search/"}]}</script>
  <script type="application/ld+json">{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[{"@type":"Question","name":"How does this search work?","acceptedAnswer":{"@type":"Answer","text":"It's a client-side JavaScript search over an inline index. Your queries never leave your browser. Privacy by design \u2014 we never see what you searched for."}}]}</script>
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
        <h1 class="cs-page_title cs-font_50 cs-white_color">Search Apex Marketings</h1>
        <ol class="breadcrumb" style="background:transparent;justify-content:center;color:rgba(255,255,255,0.7);font-size:14px;margin-top:14px;"><a href="../">Home</a> <span style="opacity:0.5;margin:0 8px;">/</span> <span aria-current="page">Search</span></ol>
      </div>
    </div>
  </div>

  <section class="cs-spacing">
    <div class="container" style="padding-top: 60px; padding-bottom: 60px;">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <article style="font-size:16px;line-height:1.7;color:#ddd;">
            <div class="lead" style="font-size:19px;line-height:1.6;margin-bottom:32px;color:#bbb;">
              Type a query to search across blogs, services, case studies, location pages, industry pages, and the glossary. Powered by a client-side static index — fast, private. <noscript>JavaScript required for search; browse <a href="../resources/">Resources</a> instead.</noscript>
            </div>
            <style>article a {color:rgb(20,120,190);text-decoration:underline;} article h2 {margin-top:48px;} article h3 {margin-top:32px;}</style>
            <h2 class="cs-font_36 mb-4">Search</h2>
              <p><form id="amx-form" onsubmit="return amxDo(event);" style="max-width:640px;margin:0 auto 40px;"><input type="search" id="amx-q" placeholder="Type a query..." aria-label="Search Apex Marketings" autocomplete="off" autofocus style="width:100%;padding:14px 18px;border:1px solid #ddd;border-radius:30px;font-size:16px;"></form><div id="amx-out" style="margin-top:24px;"></div></p>
              <p><script>const AMX=[{u:"../blogs/digital-marketing-cost-pakistan-usa-uk-uae/",t:"Digital Marketing Cost 2026",c:"pricing cost usd gbp pkr"},{u:"../blogs/seo-vs-paid-ads-which-growth-channel/",t:"SEO vs Paid Ads",c:"channel decision"},{u:"../blogs/how-to-generate-qualified-leads-service-business-2026/",t:"Generating Qualified Leads",c:"lead generation service business"},{u:"../blogs/social-media-management-pricing-guide-small-businesses/",t:"Social Media Pricing Guide",c:"social pricing small business"},{u:"../blogs/ecommerce-marketing-strategy-traffic-repeat-customers/",t:"E-Commerce Marketing Strategy",c:"ecommerce shopify roas"},{u:"../blogs/google-ads-vs-meta-ads-which-platform-converts-better/",t:"Google Ads vs Meta Ads",c:"ppc paid ads comparison"},{u:"../blogs/high-converting-landing-page-paid-campaigns/",t:"High-Converting Landing Pages",c:"landing page cro paid"},{u:"../blogs/local-seo-pakistani-businesses/",t:"Local SEO Pakistan",c:"local seo pakistan gbp"},{u:"../blogs/instagram-growth-for-brands-2026/",t:"Instagram Growth 2026",c:"instagram reels social"},{u:"../blogs/digital-marketing-checklist-new-website/",t:"Marketing Checklist New Website",c:"checklist new website launch"},{u:"../services/",t:"Services Overview",c:"services"},{u:"../services/digital-marketing-strategy/",t:"Digital Marketing Strategy",c:"strategy"},{u:"../services/e-commerce-services/",t:"E-Commerce Services",c:"shopify ecommerce"},{u:"../services/website-development/",t:"Website Development",c:"web wordpress"},{u:"../services/performance-marketing/",t:"Performance Marketing",c:"paid ads roas"},{u:"../services/instagram-growth/",t:"Instagram Growth",c:"instagram social"},{u:"../services/lead-generation/",t:"Lead Generation",c:"leads service business"},{u:"../services/branding-consultation/",t:"Branding Consultation",c:"brand identity"},{u:"../services/social-media-management/",t:"Social Media Management",c:"social management"},{u:"../services/seo-services/",t:"SEO Services",c:"seo organic"},{u:"../services/google-ads-management/",t:"Google Ads Management",c:"google ads ppc"},{u:"../services/meta-ads-management/",t:"Meta Ads Management",c:"meta facebook instagram ads"},{u:"../services/marketing-automation/",t:"Marketing Automation",c:"automation email"},{u:"../industries/ecommerce/",t:"E-Commerce Industry",c:"ecommerce shopify"},{u:"../industries/real-estate/",t:"Real Estate Marketing",c:"real estate property"},{u:"../industries/healthcare/",t:"Healthcare Marketing",c:"healthcare clinics"},{u:"../industries/education/",t:"Education Marketing",c:"education student recruitment"},{u:"../industries/home-services/",t:"Home Services Marketing",c:"home services trades"},{u:"../industries/b2b-services/",t:"B2B Services Marketing",c:"b2b linkedin"},{u:"../industries/local-businesses/",t:"Local Business Marketing",c:"local gbp"},{u:"../locations/rawalpindi/",t:"Rawalpindi HQ",c:"rawalpindi pakistan office"},{u:"../locations/islamabad/",t:"Islamabad",c:"islamabad pakistan"},{u:"../locations/lahore/",t:"Lahore",c:"lahore pakistan"},{u:"../locations/karachi/",t:"Karachi",c:"karachi pakistan"},{u:"../locations/usa/",t:"USA",c:"usa united states"},{u:"../locations/uk/",t:"UK",c:"uk united kingdom"},{u:"../case-studies/",t:"Case Studies",c:"case studies"},{u:"../case-studies/678ridjunk/",t:"678 Rid Junk USA",c:"junk removal usa"},{u:"../case-studies/delivrex/",t:"Delivrex USA",c:"logistics usa"},{u:"../case-studies/szk/",t:"SZK UAE",c:"uae technical"},{u:"../case-studies/homesware/",t:"Homesware UK",c:"ecommerce uk"},{u:"../case-studies/altr/",t:"ALTR Pakistan",c:"wholesale pakistan"},{u:"../case-studies/atslco/",t:"ATSLCO KSA",c:"saudi technical"},{u:"../case-studies/fatima/",t:"Fatima Home Decor",c:"ecommerce pakistan luxury"},{u:"../glossary/",t:"Glossary",c:"glossary terms"},{u:"../glossary/seo/",t:"SEO",c:"seo definition"},{u:"../glossary/local-seo/",t:"Local SEO",c:"local seo"},{u:"../glossary/technical-seo/",t:"Technical SEO",c:"technical seo"},{u:"../glossary/ppc/",t:"PPC",c:"ppc paid"},{u:"../glossary/cpc/",t:"CPC",c:"cost per click"},{u:"../glossary/cpa/",t:"CPA",c:"cost per acquisition"},{u:"../glossary/roas/",t:"ROAS",c:"return on ad spend"},{u:"../glossary/ctr/",t:"CTR",c:"click through rate"},{u:"../glossary/conversion-rate-optimization/",t:"CRO",c:"conversion rate optimization"},{u:"../glossary/landing-page/",t:"Landing Page",c:"landing page"},{u:"../glossary/retargeting/",t:"Retargeting",c:"retargeting remarketing"},{u:"../glossary/lookalike-audience/",t:"Lookalike Audience",c:"lookalike meta"},{u:"../glossary/marketing-funnel/",t:"Marketing Funnel",c:"funnel awareness"},{u:"../glossary/lead-magnet/",t:"Lead Magnet",c:"lead magnet"},{u:"../glossary/utm-tracking/",t:"UTM Tracking",c:"utm parameters"},{u:"../pricing/",t:"Pricing",c:"pricing rates"},{u:"../process/",t:"Our Process",c:"process"},{u:"../trust/",t:"Trust & Security",c:"nda security compliance"},{u:"../team/",t:"Team",c:"team strategists"},{u:"../about/",t:"About",c:"about"},{u:"../contact/",t:"Contact",c:"contact"},{u:"../resources/",t:"Resources",c:"resources hub"},{u:"../quote/",t:"Get a Quote",c:"quote estimate"}];function amxDo(e){e&&e.preventDefault();const q=document.getElementById("amx-q").value.trim().toLowerCase();const out=document.getElementById("amx-out");if(!q){out.innerHTML="";return false}const r=AMX.map(i=>{const h=(i.t+" "+i.c).toLowerCase();let s=0;for(const t of q.split(/\s+/)){if(h.includes(t))s+=h.indexOf(t)===0?3:1;if(i.t.toLowerCase().includes(t))s+=2}return{i,s}}).filter(x=>x.s>0).sort((a,b)=>b.s-a.s).slice(0,20);if(r.length===0){out.innerHTML='<p style="color:#888;">No matches. Try a different query or see <a href="../resources/">Resources</a>.</p>';return false}out.innerHTML="<h2 style=\"font-size:20px;margin-bottom:16px;\">"+r.length+" result"+(r.length===1?"":"s")+"</h2>"+r.map(x=>"<div style=\"padding:14px 0;border-bottom:1px solid #eee;\"><h3 style=\"margin:0 0 4px;font-size:17px;\"><a href=\""+x.i.u+"\" style=\"color:rgb(20,120,190);text-decoration:none;\">"+x.i.t+"</a></h3><p style=\"margin:0;color:#888;font-size:13px;\">"+x.i.u+"</p></div>").join("");return false}document.addEventListener("DOMContentLoaded",function(){const i=document.getElementById("amx-q");if(i){i.addEventListener("input",amxDo);const p=new URLSearchParams(window.location.search).get("s");if(p){i.value=p;amxDo()}}});</script></p>
            <h2 class="cs-font_36 mb-4 mt-5">Frequently Asked Questions</h2>
              <h3 class="cs-font_24 mt-4 mb-2">How does this search work?</h3><p>It's a client-side JavaScript search over an inline index. Your queries never leave your browser. Privacy by design — we never see what you searched for.</p>
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
          <a href="../resources/" class="d-block aur-linkcard" style="padding:24px;background:#1a1a1a;border-radius:12px;border:1px solid #333;color:inherit;text-decoration:none;height:100%;transition:transform 0.2s,box-shadow 0.2s;">
            <h4 class="cs-font_20" style="margin:0 0 8px;font-weight:600;">Resources Hub</h4>
            <p style="margin:0;font-size:14px;opacity:0.75;">All content organized</p>
          </a>
        </div>
        <div class="col-md-4 mb-4">
          <a href="../blogs/" class="d-block aur-linkcard" style="padding:24px;background:#1a1a1a;border-radius:12px;border:1px solid #333;color:inherit;text-decoration:none;height:100%;transition:transform 0.2s,box-shadow 0.2s;">
            <h4 class="cs-font_20" style="margin:0 0 8px;font-weight:600;">Blog</h4>
            <p style="margin:0;font-size:14px;opacity:0.75;">Latest posts</p>
          </a>
        </div>
        <div class="col-md-4 mb-4">
          <a href="../glossary/" class="d-block aur-linkcard" style="padding:24px;background:#1a1a1a;border-radius:12px;border:1px solid #333;color:inherit;text-decoration:none;height:100%;transition:transform 0.2s,box-shadow 0.2s;">
            <h4 class="cs-font_20" style="margin:0 0 8px;font-weight:600;">Glossary</h4>
            <p style="margin:0;font-size:14px;opacity:0.75;">Marketing definitions</p>
          </a>
        </div>
        <div class="col-md-4 mb-4">
          <a href="../case-studies/" class="d-block aur-linkcard" style="padding:24px;background:#1a1a1a;border-radius:12px;border:1px solid #333;color:inherit;text-decoration:none;height:100%;transition:transform 0.2s,box-shadow 0.2s;">
            <h4 class="cs-font_20" style="margin:0 0 8px;font-weight:600;">Case Studies</h4>
            <p style="margin:0;font-size:14px;opacity:0.75;">Real client work</p>
          </a>
        </div>
        <div class="col-md-4 mb-4">
          <a href="../services/" class="d-block aur-linkcard" style="padding:24px;background:#1a1a1a;border-radius:12px;border:1px solid #333;color:inherit;text-decoration:none;height:100%;transition:transform 0.2s,box-shadow 0.2s;">
            <h4 class="cs-font_20" style="margin:0 0 8px;font-weight:600;">Services</h4>
            <p style="margin:0;font-size:14px;opacity:0.75;">What we offer</p>
          </a>
        </div>
        <div class="col-md-4 mb-4">
          <a href="../contact/" class="d-block aur-linkcard" style="padding:24px;background:#1a1a1a;border-radius:12px;border:1px solid #333;color:inherit;text-decoration:none;height:100%;transition:transform 0.2s,box-shadow 0.2s;">
            <h4 class="cs-font_20" style="margin:0 0 8px;font-weight:600;">Contact</h4>
            <p style="margin:0;font-size:14px;opacity:0.75;">Talk to a human</p>
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
