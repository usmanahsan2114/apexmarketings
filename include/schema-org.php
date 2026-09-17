<?php /* Apex Marketings — shared ProfessionalService + WebSite JSON-LD (single source of truth).
   Included by include/head_shared.php via __DIR__, so it is depth-independent (all URLs
   absolute). Conforms to Gemini DeepSearch technical SEO audit & entity disambiguation. */ ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "ProfessionalService",
      "@id": "https://apexmarketings.com/#agency",
      "name": "Apex Marketings",
      "alternateName": ["Apex Marketing","Apex Marketings Agency"],
      "url": "https://apexmarketings.com/",
      "logo": {
        "@type": "ImageObject",
        "@id": "https://apexmarketings.com/#logo",
        "url": "https://apexmarketings.com/assets/img/icons/apexlogo.svg",
        "contentUrl": "https://apexmarketings.com/assets/img/icons/apexlogo.svg",
        "caption": "Apex Marketings",
        "inLanguage": "en-US"
      },
      "image": "https://apexmarketings.com/assets/img/home/hero_bg_2.webp",
      "description": "Full-funnel digital marketing, performance advertising, SEO, and e-commerce growth.",
      "telephone": "+923392012739",
      "email": "info@apexmarketings.com",
      "priceRange": "$$$",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Office no 426, Haider Plaza, Range Road, Afshan Colony",
        "addressLocality": "Rawalpindi",
        "addressRegion": "Punjab",
        "postalCode": "46000",
        "addressCountry": "PK"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "33.5973",
        "longitude": "73.0479"
      },
      "director": {
        "@type": "Person",
        "@id": "https://apexmarketings.com/#usman-ahsan",
        "name": "Usman Ahsan Pervez",
        "jobTitle": "Director",
        "sameAs": "https://www.linkedin.com/in/usmanahsanpervez/"
      },
      "founder": {
        "@type": "Person",
        "@id": "https://www.apexitsolutions.co/#hamza-khan",
        "name": "Hamza Khan",
        "jobTitle": "Co-Founder"
      },
      "areaServed": [
        {"@type": "Country", "name": "Pakistan"},
        {"@type": "Country", "name": "United States"},
        {"@type": "Country", "name": "United Kingdom"},
        {"@type": "Country", "name": "United Arab Emirates"},
        {"@type": "Country", "name": "Saudi Arabia"},
        {"@type": "Country", "name": "Canada"},
        {"@type": "City", "name": "Rawalpindi"},
        {"@type": "City", "name": "Islamabad"},
        {"@type": "City", "name": "Lahore"},
        {"@type": "City", "name": "Karachi"}
      ],
      "knowsAbout": [
        "Search Engine Optimization","Local SEO","Pay-Per-Click Advertising","Google Ads","Meta Ads",
        "Social Media Marketing","Content Marketing","Lead Generation","Conversion Rate Optimization",
        "Marketing Automation","E-Commerce Marketing","Performance Marketing","Digital Marketing Strategy"
      ],
      "openingHoursSpecification": [{
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"],
        "opens": "10:00",
        "closes": "19:00"
      }],
      "contactPoint": [
        {"@type": "ContactPoint", "telephone": "+92-339-2012739", "contactType": "sales", "areaServed": ["PK","US","GB","AE","SA","CA"], "availableLanguage": ["en","ur"]},
        {"@type": "ContactPoint", "telephone": "+92-309-5273505", "contactType": "customer support", "areaServed": ["PK","US","GB","AE","SA","CA"], "availableLanguage": ["en","ur"]}
      ],
      "sameAs": [
        "https://www.facebook.com/profile.php?id=100093508323539",
        "https://www.linkedin.com/company/apex-marketings",
        "https://www.instagram.com/apexmarketings/"
      ],
      "relatedLink": ["https://www.apexitsolutions.co/"]
    },
    {
      "@type": "WebSite",
      "@id": "https://apexmarketings.com/#website",
      "url": "https://apexmarketings.com/",
      "name": "Apex Marketings",
      "publisher": {
        "@id": "https://apexmarketings.com/#agency"
      },
      "inLanguage": "en-US",
      "potentialAction": {
        "@type": "SearchAction",
        "target": {"@type": "EntryPoint", "urlTemplate": "https://apexmarketings.com/search/?s={search_term_string}"},
        "query-input": "required name=search_term_string"
      }
    }
  ]
}
</script>
