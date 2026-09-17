# Standard Operating Procedure (SOP): Agency Backlink Governance & Client Footer Link Remediation

## Executive Summary
This document establishes the mandatory agency standard for outbound backlink governance, client website footer attribution, and demo subdomain crawl controls for **Apex Marketings** (`https://apexmarketings.com/`) and **Apex IT Solutions** (`https://www.apexitsolutions.co/`).

Following the technical SEO audit, Google's Spam Brain and Link Spam guidelines strictly flag un-natural, repetitive sitewide anchor footprints (such as repetitive "Designed and Developed by..." footer links across dozens or hundreds of client pages). To protect both agency domains and client domains from algorithmic link depreciation and manual penalties, all web development and digital marketing deliverables must adhere to the following protocols.

---

## 1. Client Footer Link Remediation Standards

### 1.1 The Golden Rule: Mandatory `rel="nofollow"`
Any credit link pointing from a client website back to `apexmarketings.com` or `apexitsolutions.co` **MUST** include `rel="nofollow"` (or `rel="nofollow noopener"` when opening in a new tab).

```html
<!-- Correct Implementation: Apex Marketings -->
<div class="client-footer-credits">
  <p>&copy; 2026 Client Name. Digital marketing &amp; SEO by 
    <a href="https://apexmarketings.com/" rel="nofollow noopener" target="_blank">Apex Marketings</a>.
  </p>
</div>

<!-- Correct Implementation: Apex IT Solutions -->
<div class="client-footer-credits">
  <p>&copy; 2026 Client Name. Website engineered by 
    <a href="https://www.apexitsolutions.co/" rel="nofollow noopener" target="_blank">Apex IT Solutions</a>.
  </p>
</div>
```

### 1.2 Anchor Text Restrictions
- **Allowed Anchor Text**: Exact entity brand names only:
  - `"Apex Marketings"`
  - `"Apex IT Solutions"`
- **Prohibited Anchor Text**: Never use commercial, keyword-stuffed anchor phrases, such as:
  - *`"Best SEO Agency Pakistan"`*
  - *`"Performance Marketing Firm"`*
  - *`"Custom Software Development Services"`*

### 1.3 Alternative Preferred Pattern: Unlinked Entity Mentions
For high-volume e-commerce or large-catalogue sites (1,000+ indexed URLs), unlinked text mentions are preferred over hyperlinked footers:
```html
<p class="footer-copy">&copy; 2026 Client Name. Managed and delivered by Apex Marketings & Apex IT Solutions.</p>
```
Search engines recognize co-citation and brand mentions via natural language processing (NLP) without creating risk of link scheme manipulation.

---

## 2. Immediate Client Audit & Remediation Actions

The technical delivery team must execute footer attribute audits on the following client properties:

| Client Domain | Primary Technology | Required Remediation | Verification Method |
| :--- | :--- | :--- | :--- |
| `pakgusu.com` | WordPress / Custom PHP | Add `rel="nofollow noopener"` to footer theme credits in `footer.php`. | Inspect element in DevTools; verify `rel="nofollow"`. |
| `familyandfellowsfoundation.org` | WordPress / CMS | Inspect footer widget / global template; update agency link with `rel="nofollow"`. | View page source on homepage and inner pages. |
| `678ridjunk.com` | Custom Web App | Ensure footer copyright attribution uses `rel="nofollow"`. | Search Console Links report audit. |
| Future Deliverables | All Staging/Production | Mandatory QA checklist item before DNS cutover and client sign-off. | Pre-launch SEO checklist. |

---

## 3. Implementation Code Snippets by Tech Stack

### WordPress (`footer.php` or Theme Options)
```php
<?php
// wp-content/themes/client-theme/footer.php
?>
<div class="site-credit">
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Marketing &amp; SEO by 
        <a href="https://apexmarketings.com/" target="_blank" rel="nofollow noopener">Apex Marketings</a>
    </p>
</div>
```

### Shopify (`sections/footer.liquid`)
```liquid
<div class="footer__copyright caption">
  <small class="copyright__content">&copy; {{ 'now' | date: "%Y" }}, {{ shop.name | link_to: routes.root_url }}</small>
  <small class="copyright__agency">Marketing managed by <a href="https://apexmarketings.com/" target="_blank" rel="nofollow noopener">Apex Marketings</a></small>
</div>
```

### Next.js / React JSX
```jsx
export function FooterCredits() {
  return (
    <p className="text-sm text-neutral-400">
      &copy; {new Date().getFullYear()} Client Corp. Digital marketing managed by{' '}
      <a 
        href="https://apexmarketings.com/" 
        target="_blank" 
        rel="nofollow noopener"
        className="hover:underline"
      >
        Apex Marketings
      </a>
    </p>
  );
}
```

---

## 4. Subdomain & Demo Environment Crawl Directives

To prevent staging builds, sandbox software, and demonstration portals (e.g. `cloverly.apexitsolutions.co`, `cloverlyhr.apexitsolutions.co`) from indexation or authority fragmentation:

### 4.1 Robots.txt on Demo Subdomains
```txt
User-agent: *
Disallow: /
```

### 4.2 HTTP Header Directive (`.htaccess` or NGINX)
```apache
# Apache .htaccess on demo environments
<IfModule mod_headers.c>
    Header set X-Robots-Tag "noindex, nofollow, noarchive"
</IfModule>
```

### 4.3 HTML Meta Tag
```html
<meta name="robots" content="noindex, nofollow">
```

---

## 5. Google Search Console Disavow Protocol

If Google Search Console alerts ever indicate unnatural inbound links or if an audit detects toxic scrapers copying client footer footprints, submit a disavow file using the official tool:
- Search Console Disavow Tool: `https://search.google.com/search-console/disavow-links`
- Format:
```txt
# Disavow file for apexmarketings.com
# Updated: 2026
# Scraper and unnatural duplicate networks
domain:suspicious-scraper-domain.com
domain:unauthorized-mirror-site.net
```

---
*Maintained by the Apex IT Solutions & Apex Marketings Technical Governance Committee.*
