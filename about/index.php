<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <?php
  $seo_title = 'About Apex Marketings – Digital Marketing Experts';
  $seo_desc = 'Meet the Apex Marketings team and discover how our digital marketing experts drive brand growth with SEO, social media, and innovative strategies.';
  ?>
  <?php include_once('../include/head1.php'); ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "@id": "https://apexmarketings.com/about/#breadcrumb",
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
          "name": "About",
          "item": "https://apexmarketings.com/about/"
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
  <div class="cs-page_heading cs-style1 cs-center text-center cs-bg" data-src="../assets/img/about/about_hero_bg.webp">
    <div class="container">
      <div class="cs-page_heading_in">
        <h1 class="cs-page_title cs-font_50 cs-white_color">About Us</h1>
        <h2 class="cs-hero_title wow fadeInRight" data-wow-duration="0.8s" data-wow-delay="0.2s">
          We Build <span class="cs-accent_color">Brands</span> That <span class="cs-accent_color">Grow</span> Online
        </h2>
      </div>
    </div>
  </div>
  <!-- End Hero -->
  <div class="cs-height_150 cs-height_lg_80"></div>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-xl-5 col-lg-7">
          <div class="cs-section_heading cs-style1">
            <h3 class="cs-section_subtitle">About Apex</h3>
            <h2 class="cs-section_title"> Trusted Partner For Digital Growth </h2>
            <div class="cs-height_30 cs-height_lg_20"></div>
            <p class="cs-m0">At <a href="https://apexmarketings.com/" style="color: #e6ad02;"> Apex Marketings </a>, we help brands build measurable digital growth through SEO, paid media, social strategy, and e-commerce marketing. Our team focuses on clear planning, transparent reporting, and campaigns that connect visibility with qualified leads and revenue.</p>
            <div class="cs-height_30 cs-height_lg_30"></div>
            <div class="cs-separator cs-accent_bg"></div>
            <div class="cs-height_15 cs-height_lg_40"></div>
            <a href="../contact/" class="cs-text_btn">
              <span>Apply For Meeting</span>
              <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M25.5307 6.53033C25.8236 6.23744 25.8236 5.76256 25.5307 5.46967L20.7577 0.696699C20.4648 0.403806 19.99 0.403806 19.6971 0.696699C19.4042 0.989593 19.4042 1.46447 19.6971 1.75736L23.9397 6L19.6971 10.2426C19.4042 10.5355 19.4042 11.0104 19.6971 11.3033C19.99 11.5962 20.4648 11.5962 20.7577 11.3033L25.5307 6.53033ZM0.000366211 6.75H25.0004V5.25H0.000366211V6.75Z"
                  fill="currentColor" />
              </svg>
            </a>
            <div class="cs-height_25 cs-height_lg_0"></div>
          </div>
        </div>
        <div class="col-lg-5 offset-xl-2">
          <img loading="lazy" decoding="async" width="536" height="450" src="../assets/img/about/about_img_1.webp" alt="Apex Marketings digital campaign strategy and growth team" class="w-100 cs-radius_15">
          <div class="cs-height_25 cs-height_lg_25"></div>
        </div>
        <div class="col-lg-7">
          <img loading="lazy" decoding="async" width="760" height="450" src="../assets/img/about/about_img_2.webp" alt="Performance marketing analytics, ROAS tracking, and revenue growth metrics" class="w-100 cs-radius_15">
          <div class="cs-height_25 cs-height_lg_25"></div>
        </div>
        <div class="col-lg-5">
          <img loading="lazy" decoding="async" width="536" height="450" src="../assets/img/about/about_img_3.webp" alt="Creative brand identity and social media design strategists" class="w-100 cs-radius_15">
          <div class="cs-height_25 cs-height_lg_25"></div>
        </div>
      </div>
    </div>
  </section>
  <style>
    /* Scope animations to the "About Apex" section */
    section .cs-section_heading {
      position: relative;
      overflow: hidden;
    }

    /* Section Title Animation */
    .cs-section_heading h2 {
      display: inline-block;
      position: relative;
      transition: transform 0.5s ease, color 0.5s ease;
    }

    .cs-section_heading h2:hover {
      transform: scale(1.05);
      transform: translateX(10px);
    }

    .cs-section_heading h2::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 3px;
      background-color: currentColor;
      transition: width 0.5s ease;
    }

    .cs-section_heading h2:hover::after {
      width: 100%;
    }

    /* Section Subtitle Animation */
    .cs-section_heading h3 {
      position: relative;
      overflow: hidden;
    }

    .cs-section_heading h3::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 50%;
      width: 0;
      height: 2px;
      background-color: currentColor;
      transition: width 0.4s ease, left 0.4s ease;
    }

    .cs-section_heading h3:hover::after {
      width: 100%;
      left: 0;
    }

    /* Paragraph Animation */
    .cs-section_heading p {
      position: relative;
      opacity: 0.9;
      transition: transform 0.5s ease, opacity 0.5s ease;
    }

    .cs-section_heading p:hover {
      transform: translateX(10px);
      opacity: 1;
    }

    /* Separator Animation */
    .cs-section_heading .cs-separator {
      position: relative;
      overflow: hidden;
      transition: width 0.5s ease, background-color 0.5s ease;
    }

    .cs-section_heading .cs-separator:hover {
      width: 120%;
    }

    /* Images Animation */
    section img {
      display: block;
      border-radius: 15px;
      transition: transform 0.5s ease, box-shadow 0.5s ease;
    }

    section img:hover {
      transform: scale(1.1);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    /* Image Reveal Effect */
    section img::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.1);
      opacity: 0;
      transition: opacity 0.4s ease;
    }

    section img:hover::after {
      opacity: 1;
    }

    /* Smooth transition for spacing elements */
    section .cs-height_30,
    section .cs-height_25 {
      transition: height 0.3s ease;
    }

    section:hover .cs-height_30 {
      height: 40px;
    }

    section:hover .cs-height_25 {
      height: 35px;
    }
  </style>
  <div class="cs-height_75 cs-height_lg_55"></div>
  <!-- Start Icon Box -->
  <div class="container">
    <div class="cs-section_heading cs-style1 text-center">
      <h3 class="cs-section_subtitle">Our Working</h3>
      <h2 class="cs-section_title">3 Steps We Follow</h2>
    </div>
    <div class="cs-height_90 cs-height_lg_45"></div>
    <div class="row">
      <div class="col-lg-4">
        <div class="cs-iconbox cs-style2 text-center">
          <div class="cs-iconbox_icon">
            <i class="bx bx-search-alt-2" style="font-size: 58px; color: #e6ad02;"></i>
          </div>
          <h3 class="cs-iconbox_title">Research & <br> Strategize</h3>
          <div class="cs-iconbox_subtitle">We dig deep, research trends, and craft a game plan that'll make your brand
            pop.</div>
        </div>
        <div class="cs-height_30 cs-height_lg_35"></div>
      </div>

      <div class="col-lg-4">
        <div class="cs-iconbox cs-style2 text-center">
          <div class="cs-iconbox_icon">
            <i class="bx bx-cog" style="font-size: 58px; color: #e6ad02;"></i>
          </div>
          <h3 class="cs-iconbox_title">Execute with <br> Precision</h3>
          <div class="cs-iconbox_subtitle">From SEO to social media, we put the plan into action, optimizing every move.
          </div>
        </div>
        <div class="cs-height_30 cs-height_lg_35"></div>
      </div>

      <div class="col-lg-4">
        <div class="cs-iconbox cs-style2 text-center">
          <div class="cs-iconbox_icon">
            <i class="bx bx-bar-chart-alt-2" style="font-size: 58px; color: #e6ad02;"></i>
          </div>
          <h3 class="cs-iconbox_title">Analyze & <br> Optimize</h3>
          <div class="cs-iconbox_subtitle">We track results, tweak strategies, and keep pushing to level up your brand.
          </div>
        </div>
        <div class="cs-height_30 cs-height_lg_35"></div>
      </div>
    </div>

  </div>
  <style>
    /* Scope animations to the Icon Box section */
    .container .cs-iconbox {
      position: relative;
      transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .container .cs-iconbox:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    /* Icon Animation */
    .container .cs-iconbox_icon {
      display: inline-block;
      position: relative;
      transition: transform 0.4s ease, color 0.4s ease;
    }

    .container .cs-iconbox_icon:hover {
      transform: scale(1.2) rotate(10deg);
    }

    .container .cs-iconbox_icon::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 100%;
      height: 100%;
      background: radial-gradient(rgba(230, 173, 2, 0.2), transparent);
      border-radius: 50%;
      transform: translate(-50%, -50%) scale(0);
      opacity: 0;
      z-index: -1;
      transition: transform 0.5s ease, opacity 0.5s ease;
    }

    .container .cs-iconbox_icon:hover::before {
      transform: translate(-50%, -50%) scale(1.5);
      opacity: 1;
    }

    /* Title Animation */
    .container .cs-iconbox_title {
      position: relative;
      transition: transform 0.4s ease, color 0.4s ease;
    }

    .container .cs-iconbox_title:hover {
      transform: translateY(-5px);
      color: inherit;
    }

    .container .cs-iconbox_title::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 50%;
      width: 0;
      height: 2px;
      background: currentColor;
      transition: width 0.4s ease, left 0.4s ease;
    }

    .container .cs-iconbox_title:hover::after {
      width: 100%;
      left: 0;
    }

    /* Subtitle Animation */
    .container .cs-iconbox_subtitle {
      position: relative;
      transition: opacity 0.4s ease, transform 0.4s ease;
    }

    .container .cs-iconbox:hover .cs-iconbox_subtitle {
      transform: translateY(-5px);
      opacity: 1;
    }

    /* Smooth Spacing Transition */
    .container .cs-height_30,
    .container .cs-height_lg_35 {
      transition: height 0.3s ease;
    }

    .container:hover .cs-height_30 {
      height: 40px;
    }

    .container:hover .cs-height_lg_35 {
      height: 45px;
    }
  </style>
  <!-- End Icon Box -->
  <div class="cs-height_150 cs-height_lg_80"></div>
  <!-- Start Why Choose -->
  <section>
    <div class="container">
      <div class="row">
        <div class="col-xl-5 col-lg-6">
          <div class="cs-image_layer cs-style1">
            <div class="cs-image_layer_in">
              <img loading="lazy" decoding="async" width="636" height="636" src="../assets/img/about/about_img_4.jpg" alt="Illustration" class="w-100 cs-radius_15">
            </div>
          </div>
          <div class="cs-height_0 cs-height_lg_40"></div>
        </div>
        <div class="col-xl-5 offset-xl-1 col-lg-6">
          <div class="cs-section_heading cs-style1">
            <h2 class="cs-section_title">MEET OUR DIRECTOR</h2>
            <div class="cs-height_30 cs-height_lg_20"></div>
            <p class="cs-m0">
              Usman Ahsan Pervez, Director of <a href="https://apexmarketings.com/" style="color: #e6ad02;"> Apex Marketings </a>, brings expertise in project management, IT solutions, and
              digital marketing. Holding a Bachelor's in Electrical Engineering and 5+ years of experience, he has
              successfully led 20+ international projects with quality and timely delivery.
              <br><br>
              His exceptional leadership fosters client trust and effective meetings. By managing teams and delivering
              innovative solutions, Usman has been instrumental in establishing <a href="https://apexmarketings.com/" style="color: #e6ad02;"> Apex Marketings </a> as a reliable global
              partner, driving growth in the competitive digital marketing landscape.
            </p>
            <div class="cs-height_30 cs-height_lg_30"></div>
            <div class="cs-separator cs-accent_bg"></div>
            <div class="cs-height_25 cs-height_lg_0"></div>
            <a href="https://usmanahsan.site/" class="cs-text_btn">
              <span>View More</span>
              <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M25.5307 6.53033C25.8236 6.23744 25.8236 5.76256 25.5307 5.46967L20.7577 0.696699C20.4648 0.403806 19.99 0.403806 19.6971 0.696699C19.4042 0.989593 19.4042 1.46447 19.6971 1.75736L23.9397 6L19.6971 10.2426C19.4042 10.5355 19.4042 11.0104 19.6971 11.3033C19.99 11.5962 20.4648 11.5962 20.7577 11.3033L25.5307 6.53033ZM0.000366211 6.75H25.0004V5.25H0.000366211V6.75Z"
                  fill="currentColor" />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Why Choose -->
  <div class="cs-height_145 cs-height_lg_80"></div>
  <!-- Start Team Section -->
  <section>
    <div class="container">
      <div class="cs-slider cs-style2 cs-gap-24">
        <div class="cs-slider_heading cs-style1">
          <div class="cs-section_heading cs-style1">
            <h3 class="cs-section_subtitle">Our Team</h3>
            <h2 class="cs-section_title">Awesome team <br>members </h2>
          </div>
          <div class="cs-slider_arrows cs-style1 cs-primary_color">
            <div class="cs-left_arrow cs-center">
              <svg width="26" height="13" viewBox="0 0 26 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M0.469791 5.96967C0.176899 6.26256 0.176899 6.73744 0.469791 7.03033L5.24276 11.8033C5.53566 12.0962 6.01053 12.0962 6.30342 11.8033C6.59632 11.5104 6.59632 11.0355 6.30342 10.7426L2.06078 6.5L6.30342 2.25736C6.59632 1.96447 6.59632 1.48959 6.30342 1.1967C6.01053 0.903806 5.53566 0.903806 5.24276 1.1967L0.469791 5.96967ZM26.0001 5.75L1.00012 5.75V7.25L26.0001 7.25V5.75Z"
                  fill="currentColor" />
              </svg>
            </div>
            <div class="cs-right_arrow cs-center">
              <svg width="26" height="13" viewBox="0 0 26 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M25.5305 7.03033C25.8233 6.73744 25.8233 6.26256 25.5305 5.96967L20.7575 1.1967C20.4646 0.903806 19.9897 0.903806 19.6968 1.1967C19.4039 1.48959 19.4039 1.96447 19.6968 2.25736L23.9395 6.5L19.6968 10.7426C19.4039 11.0355 19.4039 11.5104 19.6968 11.8033C19.9897 12.0962 20.4646 12.0962 20.7575 11.8033L25.5305 7.03033ZM0.00012207 7.25H25.0001V5.75H0.00012207V7.25Z"
                  fill="currentColor" />
              </svg>
            </div>
          </div>
        </div>
        <div class="cs-height_85 cs-height_lg_45"></div>
        <div class="cs-slider_container" data-autoplay="0" data-loop="1" data-speed="600" data-center="0"
          data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="4"
          data-add-slides="4">
          <div class="cs-slider_wrapper">
            <div class="cs-slide">
              <div class="cs-team cs-style1">
                <div class="cs-member_thumb">
                  <div class="black-filter">
                    <img loading="lazy" decoding="async" width="312" height="360" src="../assets/img/about/team/hamza.webp" alt="Hamza">
                  </div>
                  <div class="cs-member_overlay"></div>
                </div>
                <div class="cs-member_info">
                  <h4 class="cs-member_name">Hamza Khan</h4>
                  <div class="cs-member_designation">Marketing Head</div>
                </div>
                <div class="cs-member_social cs-primary_color">
                  <a href="https://www.linkedin.com/in/hamzakhan-apex/" target="_blank">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M5.39756 18.333H1.9422V7.20581H5.39756V18.333ZM3.66802 5.68795C2.56311 5.68795 1.6669 4.77277 1.6669 3.66786C1.6669 3.13714 1.87773 2.62814 2.25301 2.25286C2.6283 1.87758 3.13729 1.66675 3.66802 1.66675C4.19875 1.66675 4.70774 1.87758 5.08302 2.25286C5.4583 2.62814 5.66913 3.13714 5.66913 3.66786C5.66913 4.77277 4.77256 5.68795 3.66802 5.68795ZM18.3298 18.333H14.8819V12.9164C14.8819 11.6255 14.8559 9.96995 13.0854 9.96995C11.2889 9.96995 11.0136 11.3725 11.0136 12.8234V18.333H7.56199V7.20581H10.876V8.72367H10.9243C11.3857 7.84941 12.5125 6.92679 14.1937 6.92679C17.6907 6.92679 18.3336 9.22962 18.3336 12.2207V18.333H18.3298Z"
                        fill="currentColor" />
                    </svg>
                  </a>

                </div>
              </div>
            </div>
            <!-- .cs-slide 
            <div class="cs-slide">
              <div class="cs-team cs-style1">
                <div class="cs-member_thumb">
                  <img loading="lazy" decoding="async" width="312" height="360" src="../assets/img/about/team/usman.webp" alt="Usman">
                  <div class="cs-member_overlay"></div>
                </div>
                <div class="cs-member_info">
                  <h2 class="cs-member_name">Usman Ahsan</h2>
                  <div class="cs-member_designation">Development Head</div>
                </div>
                <div class="cs-member_social cs-primary_color">
                  <a>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M5.39756 18.333H1.9422V7.20581H5.39756V18.333ZM3.66802 5.68795C2.56311 5.68795 1.6669 4.77277 1.6669 3.66786C1.6669 3.13714 1.87773 2.62814 2.25301 2.25286C2.6283 1.87758 3.13729 1.66675 3.66802 1.66675C4.19875 1.66675 4.70774 1.87758 5.08302 2.25286C5.4583 2.62814 5.66913 3.13714 5.66913 3.66786C5.66913 4.77277 4.77256 5.68795 3.66802 5.68795ZM18.3298 18.333H14.8819V12.9164C14.8819 11.6255 14.8559 9.96995 13.0854 9.96995C11.2889 9.96995 11.0136 11.3725 11.0136 12.8234V18.333H7.56199V7.20581H10.876V8.72367H10.9243C11.3857 7.84941 12.5125 6.92679 14.1937 6.92679C17.6907 6.92679 18.3336 9.22962 18.3336 12.2207V18.333H18.3298Z"
                        fill="currentColor" />
                    </svg>
                  </a>
                  <a>
                    <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M15.6204 3.60521C15.631 3.75325 15.631 3.90133 15.631 4.04938C15.631 8.56502 12.194 13.7681 5.91227 13.7681C3.97697 13.7681 2.17918 13.2076 0.666901 12.2347C0.941869 12.2664 1.20623 12.277 1.49177 12.277C3.08862 12.277 4.55861 11.7377 5.73248 10.8176C4.23078 10.7859 2.97231 9.80236 2.53872 8.44871C2.75024 8.48042 2.96173 8.50158 3.18384 8.50158C3.49051 8.50158 3.79722 8.45926 4.08273 8.38527C2.51759 8.06798 1.34369 6.69321 1.34369 5.03288V4.99059C1.79842 5.2444 2.32723 5.40303 2.88768 5.42416C1.96762 4.81078 1.36485 3.76383 1.36485 2.57939C1.36485 1.94488 1.53403 1.36324 1.83015 0.855618C3.51164 2.92838 6.03915 4.282 8.87331 4.43008C8.82045 4.17627 8.78871 3.91191 8.78871 3.64752C8.78871 1.76509 10.3116 0.231689 12.2045 0.231689C13.188 0.231689 14.0764 0.644126 14.7003 1.31037C15.4723 1.16232 16.2126 0.876777 16.8683 0.485499C16.6144 1.27867 16.0751 1.94491 15.3666 2.3679C16.054 2.2939 16.7202 2.10351 17.3336 1.83915C16.8683 2.51594 16.2867 3.11871 15.6204 3.60521V3.60521Z"
                        fill="currentColor" />
                    </svg>
                  </a>
                  <a>
                    <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M16.9853 1.97421C16.7936 1.25247 16.2289 0.684051 15.5118 0.491149C14.212 0.140625 9.00023 0.140625 9.00023 0.140625C9.00023 0.140625 3.78845 0.140625 2.48868 0.491149C1.7716 0.684081 1.20685 1.25247 1.01517 1.97421C0.666901 3.28241 0.666901 6.01183 0.666901 6.01183C0.666901 6.01183 0.666901 8.74126 1.01517 10.0495C1.20685 10.7712 1.7716 11.3159 2.48868 11.5088C3.78845 11.8594 9.00023 11.8594 9.00023 11.8594C9.00023 11.8594 14.212 11.8594 15.5118 11.5088C16.2289 11.3159 16.7936 10.7712 16.9853 10.0495C17.3336 8.74126 17.3336 6.01183 17.3336 6.01183C17.3336 6.01183 17.3336 3.28241 16.9853 1.97421ZM7.29568 8.48995V3.53372L11.6517 6.01189L7.29568 8.48995Z"
                        fill="currentColor" />
                    </svg>
                  </a>
                  <a>
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M4.16839 11.1987C4.16839 12.1623 3.38119 12.9495 2.41764 12.9495C1.4541 12.9495 0.666901 12.1623 0.666901 11.1987C0.666901 10.2352 1.4541 9.448 2.41764 9.448H4.16839V11.1987ZM5.05083 11.1987C5.05083 10.2352 5.83803 9.448 6.80157 9.448C7.76511 9.448 8.55232 10.2352 8.55232 11.1987V15.5827C8.55232 16.5462 7.76511 17.3334 6.80157 17.3334C5.83803 17.3334 5.05083 16.5462 5.05083 15.5827V11.1987ZM6.80157 4.16824C5.83803 4.16824 5.05083 3.38103 5.05083 2.41749C5.05083 1.45395 5.83803 0.666748 6.80157 0.666748C7.76511 0.666748 8.55232 1.45395 8.55232 2.41749V4.16824H6.80157ZM6.80157 5.05068C7.76511 5.05068 8.55232 5.83788 8.55232 6.80142C8.55232 7.76496 7.76511 8.55217 6.80157 8.55217H2.41764C1.4541 8.55217 0.666901 7.76496 0.666901 6.80142C0.666901 5.83788 1.4541 5.05068 2.41764 5.05068H6.80157ZM13.8321 6.80142C13.8321 5.83788 14.6193 5.05068 15.5828 5.05068C16.5464 5.05068 17.3336 5.83788 17.3336 6.80142C17.3336 7.76496 16.5464 8.55217 15.5828 8.55217H13.8321V6.80142ZM12.9496 6.80142C12.9496 7.76496 12.1624 8.55217 11.1989 8.55217C10.2354 8.55217 9.44815 7.76496 9.44815 6.80142V2.41749C9.44815 1.45395 10.2354 0.666748 11.1989 0.666748C12.1624 0.666748 12.9496 1.45395 12.9496 2.41749V6.80142ZM11.1989 13.8319C12.1624 13.8319 12.9496 14.6191 12.9496 15.5827C12.9496 16.5462 12.1624 17.3334 11.1989 17.3334C10.2354 17.3334 9.44815 16.5462 9.44815 15.5827V13.8319H11.1989ZM11.1989 12.9495C10.2354 12.9495 9.44815 12.1623 9.44815 11.1987C9.44815 10.2352 10.2354 9.448 11.1989 9.448H15.5828C16.5464 9.448 17.3336 10.2352 17.3336 11.1987C17.3336 12.1623 16.5464 12.9495 15.5828 12.9495H11.1989Z"
                        fill="currentColor" />
                    </svg>
                  </a>
                </div>
              </div>
            </div>-->
            <!-- .cs-slide -->
            <div class="cs-slide">
              <div class="cs-team cs-style1">
                <div class="cs-member_thumb">
                  <div class="black-filter">
                    <img loading="lazy" decoding="async" width="312" height="360" src="../assets/img/about/team/sohaib.webp" alt="Sohaib">
                  </div>
                  <div class="cs-member_overlay"></div>
                </div>
                <div class="cs-member_info">
                  <h4 class="cs-member_name">Sohaib Aftab</h4>
                  <div class="cs-member_designation">Project Manager</div>
                </div>
                <div class="cs-member_social cs-primary_color">
                  <a href="https://www.linkedin.com/in/sohaib-aftab-86aa5bb7/" target="_blank">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M5.39756 18.333H1.9422V7.20581H5.39756V18.333ZM3.66802 5.68795C2.56311 5.68795 1.6669 4.77277 1.6669 3.66786C1.6669 3.13714 1.87773 2.62814 2.25301 2.25286C2.6283 1.87758 3.13729 1.66675 3.66802 1.66675C4.19875 1.66675 4.70774 1.87758 5.08302 2.25286C5.4583 2.62814 5.66913 3.13714 5.66913 3.66786C5.66913 4.77277 4.77256 5.68795 3.66802 5.68795ZM18.3298 18.333H14.8819V12.9164C14.8819 11.6255 14.8559 9.96995 13.0854 9.96995C11.2889 9.96995 11.0136 11.3725 11.0136 12.8234V18.333H7.56199V7.20581H10.876V8.72367H10.9243C11.3857 7.84941 12.5125 6.92679 14.1937 6.92679C17.6907 6.92679 18.3336 9.22962 18.3336 12.2207V18.333H18.3298Z"
                        fill="currentColor" />
                    </svg>
                  </a>
                </div>
              </div>
            </div>
            <!-- .cs-slide -->
            <div class="cs-slide">
              <div class="cs-team cs-style1">
                <div class="cs-member_thumb">
                  <div class="black-filter">
                    <img loading="lazy" decoding="async" width="312" height="360" src="../assets/img/about/team/ahmed.webp" alt="Ahmed">
                  </div>
                  <div class="cs-member_overlay"></div>
                </div>
                <div class="cs-member_info">
                  <h4 class="cs-member_name">Ahmed Ehtesam</h4>
                  <div class="cs-member_designation">Development Head</div>
                </div>
                <div class="cs-member_social cs-primary_color">
                </div>
              </div>
            </div>
            <!-- .cs-slide -->
            <div class="cs-slide">
              <div class="cs-team cs-style1">
                <div class="cs-member_thumb">
                  <div class="black-filter">
                    <img loading="lazy" decoding="async" width="312" height="360" src="../assets/img/about/team/salman.webp" alt="Salman">
                  </div>
                  <div class="cs-member_overlay"></div>
                </div>
                <div class="cs-member_info">
                  <h4 class="cs-member_name">Salman Saeed</h4>
                  <div class="cs-member_designation">CG Generalist</div>
                </div>
                <div class="cs-member_social cs-primary_color">
                  <a href="https://www.linkedin.com/in/salman-saeed-6956a01a3/" target="_blank">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M5.39756 18.333H1.9422V7.20581H5.39756V18.333ZM3.66802 5.68795C2.56311 5.68795 1.6669 4.77277 1.6669 3.66786C1.6669 3.13714 1.87773 2.62814 2.25301 2.25286C2.6283 1.87758 3.13729 1.66675 3.66802 1.66675C4.19875 1.66675 4.70774 1.87758 5.08302 2.25286C5.4583 2.62814 5.66913 3.13714 5.66913 3.66786C5.66913 4.77277 4.77256 5.68795 3.66802 5.68795ZM18.3298 18.333H14.8819V12.9164C14.8819 11.6255 14.8559 9.96995 13.0854 9.96995C11.2889 9.96995 11.0136 11.3725 11.0136 12.8234V18.333H7.56199V7.20581H10.876V8.72367H10.9243C11.3857 7.84941 12.5125 6.92679 14.1937 6.92679C17.6907 6.92679 18.3336 9.22962 18.3336 12.2207V18.333H18.3298Z"
                        fill="currentColor" />
                    </svg>
                  </a>

                  <a href="https://www.artstation.com/salmansaeed2" target="_blank">
                    <svg width="20" height="20" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                      <path d="M50 0L100 100H0L50 0ZM50 35L30 75H70L50 35Z" fill="currentColor" />
                    </svg>
                  </a>

                </div>
              </div>
            </div>
            <!-- .cs-slide -->
          </div>
        </div>
        <!-- .cs-slider_container -->
        <div class="cs-pagination cs-style1 cs-hidden_desktop"></div>
      </div>
      <!-- .cs-slider -->
    </div>
  </section>
  <style>

  </style>
  <!-- End Team Section -->
  <div class="cs-height_150 cs-height_lg_80"></div>
  <!-- Start CTA -->
  <section>
    <div class="container">
      <div class="cs-cta cs-style1 cs-bg text-center cs-shape_wrap_1 cs-position_1"
        data-src="../assets/img/footer/cta_bg.webp">
        <div class="cs-shape_1"></div>
        <div class="cs-shape_1"></div>
        <div class="cs-shape_1"></div>
        <div class="cs-cta_in">
          <h2 class="cs-cta_title cs-semi_bold cs-m0">Let's Discuss & Make <br>Something <i>Cool</i> Together </h2>
          <div class="cs-height_70 cs-height_lg_30"></div>
          <a href="../contact/" class="cs-text_btn">
            <span>Apply For Meeting</span>
            <svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M25.5307 6.53033C25.8236 6.23744 25.8236 5.76256 25.5307 5.46967L20.7577 0.696699C20.4648 0.403806 19.99 0.403806 19.6971 0.696699C19.4042 0.989593 19.4042 1.46447 19.6971 1.75736L23.9397 6L19.6971 10.2426C19.4042 10.5355 19.4042 11.0104 19.6971 11.3033C19.99 11.5962 20.4648 11.5962 20.7577 11.3033L25.5307 6.53033ZM0.000366211 6.75H25.0004V5.25H0.000366211V6.75Z"
                fill="currentColor" />
            </svg>
          </a>
        </div>
      </div>
    </div>
  </section>
  <style>
    /* Scope animations specifically to the CTA section */
    .cs-cta {
      position: relative;
      overflow: hidden;
      transition: transform 0.5s ease, box-shadow 0.5s ease;
    }

    .cs-cta:hover {
      transform: scale(1.02);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    /* Background shape hover effect */
    .cs-cta .cs-shape_1 {
      position: absolute;
      transition: transform 0.8s ease, opacity 0.8s ease;
      opacity: 0.8;
    }

    .cs-cta:hover .cs-shape_1:nth-child(1) {
      transform: translateY(-10px) translateX(-10px) scale(1.1);
    }

    .cs-cta:hover .cs-shape_1:nth-child(2) {
      transform: translateY(10px) translateX(10px) scale(1.2);
    }

    .cs-cta:hover .cs-shape_1:nth-child(3) {
      transform: translateY(-20px) translateX(20px) scale(1.3);
    }

    /* Title hover animation */
    .cs-cta .cs-cta_title {
      transition: transform 0.4s ease, opacity 0.4s ease, text-shadow 0.4s ease;
      transform: translateY(0);
      text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
    }

    .cs-cta:hover .cs-cta_title {
      transform: translateY(-5px);
      opacity: 1;
      text-shadow: 0 0 15px rgba(255, 255, 255, 0.8);
    }

    /* Button hover animation */
    .cs-cta .cs-text_btn {
      display: inline-block;
      position: relative;
      overflow: hidden;
      transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .cs-cta .cs-text_btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.2);
      transition: left 0.4s ease;
      z-index: 1;
    }

    .cs-cta .cs-text_btn:hover::before {
      left: 0;
    }

    .cs-cta .cs-text_btn span,
    .cs-cta .cs-text_btn svg {
      position: relative;
      z-index: 2;
      transition: transform 0.4s ease;
    }

    .cs-cta .cs-text_btn:hover span {
      transform: translateX(5px);
    }

    .cs-cta .cs-text_btn:hover svg {
      transform: translateX(10px);
    }

    /* SVG arrow hover animation */
    .cs-cta .cs-text_btn svg {
      transition: transform 0.4s ease;
    }

    .cs-cta .cs-text_btn:hover svg {
      transform: translateX(5px);
    }
  </style>
  <!-- End CTA -->
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
