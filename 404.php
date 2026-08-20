<?php http_response_code(404); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Page Not Found (404) | Apex Marketings</title>
  <meta name="robots" content="noindex, follow">
  <style>
    body { margin: 0; font-family: Arial, Helvetica, sans-serif; background: #0f0f0f; color: #f5f5f5; display: flex; min-height: 100vh; align-items: center; justify-content: center; }
    .wrap { max-width: 640px; padding: 48px 24px; text-align: center; }
    .code { font-size: 96px; font-weight: 800; color: #e6ad02; margin: 0; line-height: 1; }
    h1 { font-size: 26px; margin: 16px 0 8px; }
    p { color: #bbb; line-height: 1.7; }
    .links { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; margin-top: 28px; }
    .links a { color: #0f0f0f; background: #e6ad02; padding: 10px 18px; border-radius: 24px; text-decoration: none; font-weight: 600; font-size: 14px; }
    .links a.alt { background: transparent; color: #f5f5f5; border: 1px solid #555; }
    .links a:focus-visible { outline: 3px solid #e6ad02; outline-offset: 3px; }
  </style>
</head>
<body>
  <main class="wrap">
    <p class="code">404</p>
    <h1>That page does not exist</h1>
    <p>The link may be outdated or the address mistyped. Try the search page, or jump straight to what most visitors are looking for.</p>
    <nav class="links" aria-label="Helpful links">
      <a href="/">Homepage</a>
      <a class="alt" href="/services/">Services</a>
      <a class="alt" href="/case-studies/">Case Studies</a>
      <a class="alt" href="/pricing/">Pricing</a>
      <a class="alt" href="/search/">Search the site</a>
      <a class="alt" href="/contact/">Contact</a>
    </nav>
  </main>
</body>
</html>
