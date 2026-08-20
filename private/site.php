<?php
/**
 * Site identity defaults for Apex Marketings.
 * These are PUBLIC facts (already shown on the website) — no secrets here.
 * Anything in private/config.php overrides these values.
 */
return array(
    'SITE_BRAND'        => 'Apex Marketings',
    'SITE_DOMAIN'       => 'https://apexmarketings.com',
    // Default recipient if APEX_MARKETINGS_RECIPIENT is not configured. This
    // address is already published on the public contact page, so not a secret.
    'DEFAULT_RECIPIENT' => 'info@apexmarketings.com',
    'RECIPIENT_KEY'     => 'APEX_MARKETINGS_RECIPIENT',
    'DEFAULT_FROM'      => 'no-reply@apexmarketings.com',
);
