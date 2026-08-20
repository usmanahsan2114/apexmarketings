# TASK: Publish the Pak Gusu case study + blog on the Apex Marketings site

You are working in the **Apex Marketings** website at `C:\xampp\htdocs\apexmarketings` (custom PHP,
`cs-` theme: per‑folder `index.php`, shared `include/` header/footer, a `blogs/` system, a
`case-studies/` section using `include/mockup_case_study.php`; live domain **apexmarketings.com**,
no `www`). Build two pages from ready, fact‑checked content and register them. **Do not invent
numbers or claims** — everything is in the content files.

## Inputs already in this repo (read these first)
- **Case‑study content:** `_apex-pakgusu-content/case-study.md`
  (title, slug, meta, hero stat line, section HTML bodies, pull quote, CTA, screenshot slots)
- **Blog content:** `_apex-pakgusu-content/blog.md` (same structure)
- **Social pack (reference only):** `_apex-pakgusu-content/social-pack.md`
- **Result charts (already staged):** `assets/img/pakgusu-results/` →
  `organic_growth.png`, `rankings.png`, `impressions.png`, `stats_strip.png`, `social_hero.png`, `social_square.png`
- **Real website mockups (already here):** `assets/img/portfolio/mockups/pakgusu-com/`

## STEP 0 — Learn the conventions (mirror them exactly)
Open and match:
- Template blog post: `blogs/b2b-seo-industrial-exporter-gcc-case-study/index.php` and
  `blogs/international-seo-guide-2026/index.php` — they set `$seo_title`/`$seo_desc` at the top, then
  `include_once('../../include/head2.php')` (which builds title/canonical/og from those vars), then
  `BlogPosting`+`BreadcrumbList` JSON‑LD, `headernew2.php`, the article in the `cs-` classes, and
  `footer2.php`. **This theme uses `cs-` classes — reuse whatever the template post uses; don't invent classes.**
- `blogs/index.php` — posts are registered in the **`$apex_posts` array** (slug/cat/date/title/desc);
  add a new entry (newest first).
- `blogs/feed.xml` (RSS `<item>`), `sitemap.xml`, and `sitemap.html` (hand‑maintained list) — register the new URL in all three.
- Case‑study system: `case-studies/pakgusu-com/index.php` + `include/mockup_case_study.php`. A `pakgusu-com` case study already exists.

## STEP 1 — Build the BLOG post
Create `blogs/zero-to-page-one-gcc-2-month-b2b-seo-playbook/index.php` (slug from `blog.md`), mirroring
the template. Use the title / meta / sections from `_apex-pakgusu-content/blog.md` verbatim. Add
`BlogPosting`+`BreadcrumbList` JSON‑LD (publisher **Apex Marketings**, current date). Featured/og image:
`assets/img/portfolio/mockups/pakgusu-com/hero-mockup-1200x630.webp`. **Embed the charts inline** where
the copy cites numbers — `<img src="../../assets/img/pakgusu-results/organic_growth.png">` after the
results, `rankings.png` near the rankings, `impressions.png` where relevant. Then register: add to the
`$apex_posts` array in `blogs/index.php`, an `<item>` to `blogs/feed.xml`, and the URL to `sitemap.xml`
+ `sitemap.html`.

## STEP 2 — Build the rich CASE STUDY
Use `_apex-pakgusu-content/case-study.md` (title *"From Zero to Page 1 in the GCC…"*, slug
`pakgusu-gcc-seo-aeo-case-study`). Best approach: **enhance the existing**
`case-studies/pakgusu-com/index.php` — keep its mockup gallery + "Visit live website" link, and **add a
full results write‑up below it**: the hero stat line as a bold results band (or embed `stats_strip.png`),
then each `## section` from the MD with the relevant **charts embedded** (`organic_growth.png`,
`rankings.png`, `impressions.png`). (Or create a new dedicated `case-studies/<slug>/` page — either is
fine; make the case study the rich, chart‑driven one, not a thin duplicate.)

## STEP 3 — Screenshot slots (leave clean placeholders)
Both `.md` files end with **screenshot slots** — where the *owner* pastes real GA4/GSC dashboard
captures. Add a captioned placeholder box for each (`[ Paste screenshot: … ]`). Do not fabricate dashboards.

## Rules
- **Use only the content in the `.md` files** — every metric is verified. No new numbers, no invented
  quotes, no "guaranteed" claims, no pricing. Keep the honest "clicks lag rankings / two months in" caveats.
- Describe Pak Gusu exactly as written (Lahore cleanroom manufacturer, GUSU technical partner, "designed
  to meet ISO 14644 & EU‑GMP", validation‑ready, no Gulf office/certs).
- Match the site's `cs-` design and includes — pages must look native.

## Verify before finishing
- [ ] Blog renders via `head2.php`/`headernew2.php`/`footer2.php`; valid `BlogPosting`+`BreadcrumbList`; in `$apex_posts` + `feed.xml` + `sitemap.xml` + `sitemap.html`.
- [ ] Case study shows the results write‑up + charts; existing mockups + live link intact.
- [ ] All chart `<img>` paths resolve (`assets/img/pakgusu-results/…`); mockup paths resolve.
- [ ] Screenshot placeholders present and labelled.
- [ ] No fabricated numbers/quotes/prices; honesty caveats kept.
- [ ] Every internal link resolves; pages match `cs-` style.

When done, summarize the new file paths, the changes to `$apex_posts`/`feed.xml`/`sitemap.*`, and the
screenshot placeholders the owner still needs to fill. (`social-pack.md` is LinkedIn/IG/X copy — not a
page; leave it for the owner.)
