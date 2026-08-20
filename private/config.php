<?php
/**
 * LIVE SMTP configuration — Apex Marketings (Hostinger).
 * This file is git-ignored and blocked from web access by private/.htaccess.
 * Never copy these values into any other file.
 */
return array(
    // --- SMTP transport (Titan Email via Hostinger) ---
    'SMTP_HOST'       => 'smtp.titan.email',
    'SMTP_PORT'       => 465,
    'SMTP_USERNAME'   => 'no-reply@apexmarketings.com',
    'SMTP_PASSWORD'   => 'Versatile@2114',
    'SMTP_ENCRYPTION' => 'ssl',

    // --- Sender identity ---
    'MAIL_FROM'       => 'no-reply@apexmarketings.com',
    'MAIL_FROM_NAME'  => 'Apex Marketings Website',

    // --- Recipients ---
    'APEX_MARKETINGS_RECIPIENT' => 'info@apexmarketings.com',

    // --- Optional autoresponder (set to true to enable) ---
    'AUTORESPONDER_ENABLED' => true,
    'AUTORESPONDER_SUBJECT' => 'We received your message — Apex Marketings',
    'AUTORESPONDER_BODY'    => "Thank you for contacting Apex Marketings.\n\nWe received your message and usually reply within one business day.\n\n— Apex Marketings\nhttps://apexmarketings.com/",
);
