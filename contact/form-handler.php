<?php
/**
 * Retired endpoint.
 *
 * The old handler here used PHP mail() with a placeholder reCAPTCHA secret and
 * an unsanitized From header. It was replaced by server-side handlers inside
 * contact/index.php and quote/index.php (see private/mail.php).
 */
http_response_code(410);
header('Content-Type: text/plain; charset=utf-8');
echo 'This endpoint has been retired. Please use the contact form at /contact/.';
