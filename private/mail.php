<?php
/**
 * Apex form mail helper.
 *
 * Shared, framework-free helper used by every form handler on the site:
 *   - SMTP delivery via PHPMailer (vendored in private/lib/phpmailer/),
 *     with PHP mail() fallback when SMTP is not configured yet
 *   - server-side validation helpers
 *   - honeypot, CSRF token, and file-based IP rate limiting
 *   - header-injection-safe input cleaning
 *   - branded plain-text + HTML email rendering
 *   - lead journaling to private/storage/ so no lead is lost if delivery fails
 *
 * No secrets live in this file. Credentials belong in private/config.php
 * (see config.example.php), which is .gitignore'd and blocked by .htaccess.
 */

if (!defined('APEX_MAIL_LOADED')) {
    define('APEX_MAIL_LOADED', 1);

    /** Absolute path to the private/ directory. */
    function apex_private_dir()
    {
        return __DIR__;
    }

    /** Merged config: site defaults <- config.php <- environment variables. */
    function apex_mail_config()
    {
        static $config = null;
        if ($config !== null) {
            return $config;
        }
        $defaults = array(
            'SMTP_HOST' => '', 'SMTP_PORT' => 587, 'SMTP_USERNAME' => '',
            'SMTP_PASSWORD' => '', 'SMTP_ENCRYPTION' => 'tls',
            'MAIL_FROM' => '', 'MAIL_FROM_NAME' => '',
            'AUTORESPONDER_ENABLED' => false,
            'AUTORESPONDER_SUBJECT' => '', 'AUTORESPONDER_BODY' => '',
        );
        $site = is_file(__DIR__ . '/site.php') ? include __DIR__ . '/site.php' : array();
        $local = is_file(__DIR__ . '/config.php') ? include __DIR__ . '/config.php' : array();
        if (!is_array($site)) { $site = array(); }
        if (!is_array($local)) { $local = array(); }
        $config = array_merge($defaults, $site, $local);
        // Environment variables fill any key still empty.
        foreach ($config as $key => $value) {
            if (($value === '' || $value === null) && getenv($key) !== false && getenv($key) !== '') {
                $config[$key] = getenv($key);
            }
        }
        // Resolve the lead recipient: configured key, else env, else public default.
        $rcptKey = isset($config['RECIPIENT_KEY']) ? $config['RECIPIENT_KEY'] : 'APEX_RECIPIENT';
        $rcpt = '';
        if (!empty($local[$rcptKey])) {
            $rcpt = $local[$rcptKey];
        } elseif (getenv($rcptKey)) {
            $rcpt = getenv($rcptKey);
        } elseif (!empty($config['DEFAULT_RECIPIENT'])) {
            $rcpt = $config['DEFAULT_RECIPIENT'];
        }
        $config['RECIPIENT'] = $rcpt;
        if (empty($config['MAIL_FROM']) && !empty($config['DEFAULT_FROM'])) {
            $config['MAIL_FROM'] = $config['DEFAULT_FROM'];
        }
        if (empty($config['MAIL_FROM_NAME']) && !empty($config['SITE_BRAND'])) {
            $config['MAIL_FROM_NAME'] = $config['SITE_BRAND'] . ' Website';
        }
        return $config;
    }

    /** Start a session only when needed and only if headers are not sent. */
    function apex_session_boot()
    {
        if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
            session_start();
        }
    }

    /** Per-session CSRF token (created on first use). */
    function apex_csrf_token()
    {
        apex_session_boot();
        if (empty($_SESSION['apex_csrf'])) {
            $_SESSION['apex_csrf'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['apex_csrf'];
    }

    /** Hidden input markup for forms. */
    function apex_csrf_field()
    {
        return '<input type="hidden" name="_token" value="'
            . htmlspecialchars(apex_csrf_token(), ENT_QUOTES, 'UTF-8') . '">';
    }

    /** Validate the posted CSRF token. */
    function apex_csrf_check($posted)
    {
        apex_session_boot();
        return is_string($posted) && !empty($_SESSION['apex_csrf'])
            && hash_equals($_SESSION['apex_csrf'], $posted);
    }

    /** True when the honeypot field is untouched (i.e. probably human). */
    function apex_honeypot_ok($field = 'website')
    {
        return trim(isset($_POST[$field]) ? (string) $_POST[$field] : '') === '';
    }

    /**
     * File-based rate limit per client IP. Fails OPEN (returns true) on any
     * storage error so a broken filesystem never blocks a real lead.
     */
    function apex_rate_limit_ok($bucket, $max = 5, $windowSeconds = 600)
    {
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown';
        $dir = apex_private_dir() . '/storage';
        if (!is_dir($dir) && !@mkdir($dir, 0775, true)) {
            return true;
        }
        $file = $dir . '/rl_' . sha1($bucket . '|' . $ip) . '.json';
        $now = time();
        $stamps = array();
        if (is_file($file)) {
            $raw = @file_get_contents($file);
            $decoded = $raw ? json_decode($raw, true) : null;
            if (is_array($decoded)) {
                foreach ($decoded as $t) {
                    if (is_int($t) && $t > $now - $windowSeconds) {
                        $stamps[] = $t;
                    }
                }
            }
        }
        if (count($stamps) >= $max) {
            return false;
        }
        $stamps[] = $now;
        @file_put_contents($file, json_encode($stamps), LOCK_EX);
        return true;
    }

    /** Single-line value: trim, drop control chars (kills header injection), cap length. */
    function apex_str($value, $max = 500)
    {
        $value = is_string($value) ? $value : '';
        $value = preg_replace('/[\r\n\t\0\x0B]+/', ' ', $value);
        $value = trim($value);
        if (function_exists('mb_substr')) {
            return mb_substr($value, 0, $max, 'UTF-8');
        }
        return substr($value, 0, $max);
    }

    /** Multi-line value: keep newlines, drop other control chars, cap length. */
    function apex_text($value, $max = 5000)
    {
        $value = is_string($value) ? $value : '';
        $value = str_replace(array("\r\n", "\r"), "\n", $value);
        $value = preg_replace('/[^\P{C}\n]+/u', '', $value);
        $value = trim($value);
        if (function_exists('mb_substr')) {
            return mb_substr($value, 0, $max, 'UTF-8');
        }
        return substr($value, 0, $max);
    }

    function apex_valid_email($email)
    {
        return is_string($email) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /** Lenient phone check: digits, spaces, + ( ) - , 7..20 digits total. */
    function apex_valid_phone($phone)
    {
        if (!is_string($phone) || $phone === '') {
            return false;
        }
        if (!preg_match('/^[0-9+()\-\s.]{7,25}$/', $phone)) {
            return false;
        }
        $digits = preg_replace('/\D/', '', $phone);
        return strlen($digits) >= 7 && strlen($digits) <= 20;
    }

    /** Branded HTML email for a labelled field list. All values are escaped. */
    function apex_email_html($title, array $fields)
    {
        $config = apex_mail_config();
        $brand = isset($config['SITE_BRAND']) ? $config['SITE_BRAND'] : 'Apex';
        $rows = '';
        foreach ($fields as $label => $value) {
            if ($value === '' || $value === null) {
                continue;
            }
            $rows .= '<tr>'
                . '<td style="padding:8px 12px;border:1px solid #e3e3e3;background:#f7f7f7;font-weight:bold;white-space:nowrap;vertical-align:top;">'
                . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</td>'
                . '<td style="padding:8px 12px;border:1px solid #e3e3e3;vertical-align:top;">'
                . nl2br(htmlspecialchars($value, ENT_QUOTES, 'UTF-8')) . '</td>'
                . '</tr>';
        }
        return '<!DOCTYPE html><html><body style="margin:0;padding:24px;background:#f1f1f1;font-family:Arial,Helvetica,sans-serif;color:#222;">'
            . '<div style="max-width:640px;margin:0 auto;background:#ffffff;border-radius:8px;overflow:hidden;border:1px solid #e3e3e3;">'
            . '<div style="background:#101010;color:#ffffff;padding:18px 24px;font-size:18px;font-weight:bold;">'
            . htmlspecialchars($brand, ENT_QUOTES, 'UTF-8') . '</div>'
            . '<div style="padding:24px;">'
            . '<h2 style="margin:0 0 16px;font-size:17px;">' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h2>'
            . '<table cellpadding="0" cellspacing="0" style="border-collapse:collapse;width:100%;font-size:14px;">' . $rows . '</table>'
            . '<p style="margin:18px 0 0;font-size:12px;color:#888;">Sent automatically by the website form handler. Reply to this email to answer the sender.</p>'
            . '</div></div></body></html>';
    }

    /** Plain-text body for a labelled field list. */
    function apex_email_text($title, array $fields)
    {
        $lines = array($title, str_repeat('-', 40));
        foreach ($fields as $label => $value) {
            if ($value === '' || $value === null) {
                continue;
            }
            if (strpos((string) $value, "\n") !== false) {
                $lines[] = $label . ':';
                $lines[] = $value;
            } else {
                $lines[] = $label . ': ' . $value;
            }
        }
        return implode("\n", $lines) . "\n";
    }

    /**
     * Journal every submission to private/storage/ as a delivery safety net.
     * Never throws; returns true on success.
     */
    function apex_lead_log($formType, array $fields, $delivered)
    {
        $dir = apex_private_dir() . '/storage';
        if (!is_dir($dir) && !@mkdir($dir, 0775, true)) {
            return false;
        }
        $entry = array(
            'time'      => date('c'),
            'form'      => $formType,
            'delivered' => (bool) $delivered,
            'ip'        => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '',
            'fields'    => $fields,
        );
        $file = $dir . '/leads-' . date('Ym') . '.jsonl';
        return (bool) @file_put_contents($file, json_encode($entry) . "\n", FILE_APPEND | LOCK_EX);
    }

    /**
     * Send a form email.
     *
     * $opts:
     *   'subject'      string  required
     *   'fields'       array   label => value, rendered as text + HTML
     *   'formType'     string  used for logging and X-Apex-Form header
     *   'replyToEmail' string  visitor email (Reply-To only, never From)
     *   'replyToName'  string
     *   'to'           string  optional recipient override
     *   'autorespond'  bool    send autoresponder if globally enabled
     *
     * @return array('ok' => bool, 'error' => string|null, 'transport' => string)
     */
    function apex_send_mail(array $opts)
    {
        $config = apex_mail_config();
        $subject = apex_str(isset($opts['subject']) ? $opts['subject'] : 'Website form submission', 180);
        $fields = isset($opts['fields']) && is_array($opts['fields']) ? $opts['fields'] : array();
        $formType = apex_str(isset($opts['formType']) ? $opts['formType'] : 'form', 60);
        $replyToEmail = isset($opts['replyToEmail']) ? apex_str($opts['replyToEmail'], 200) : '';
        $replyToName = isset($opts['replyToName']) ? apex_str($opts['replyToName'], 120) : '';
        $to = !empty($opts['to']) ? apex_str($opts['to'], 200) : $config['RECIPIENT'];

        if (!apex_valid_email($to)) {
            apex_lead_log($formType, $fields, false);
            return array('ok' => false, 'error' => 'Recipient not configured.', 'transport' => 'none');
        }

        $text = apex_email_text($subject, $fields);
        $html = apex_email_html($subject, $fields);

        require_once __DIR__ . '/lib/phpmailer/Exception.php';
        require_once __DIR__ . '/lib/phpmailer/PHPMailer.php';
        require_once __DIR__ . '/lib/phpmailer/SMTP.php';

        $mailer = new \PHPMailer\PHPMailer\PHPMailer(true);
        $transport = 'mail';
        try {
            if (!empty($config['SMTP_HOST'])) {
                $mailer->isSMTP();
                $mailer->Host = $config['SMTP_HOST'];
                $mailer->Port = (int) $config['SMTP_PORT'];
                $mailer->SMTPAuth = $config['SMTP_USERNAME'] !== '';
                $mailer->Username = $config['SMTP_USERNAME'];
                $mailer->Password = $config['SMTP_PASSWORD'];
                $enc = strtolower((string) $config['SMTP_ENCRYPTION']);
                if ($enc === 'ssl' || (int) $config['SMTP_PORT'] === 465) {
                    $mailer->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
                } elseif ($enc === 'tls') {
                    $mailer->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                }
                $mailer->Timeout = 15;
                $transport = 'smtp';
            } else {
                $mailer->isMail();
            }
            $mailer->CharSet = 'UTF-8';
            $mailer->setFrom($config['MAIL_FROM'], $config['MAIL_FROM_NAME']);
            $mailer->addAddress($to);
            if (apex_valid_email($replyToEmail)) {
                $mailer->addReplyTo($replyToEmail, $replyToName !== '' ? $replyToName : $replyToEmail);
            }
            $mailer->Subject = $subject;
            $mailer->isHTML(true);
            $mailer->Body = $html;
            $mailer->AltBody = $text;
            $mailer->addCustomHeader('X-Apex-Form', $formType);
            $sent = $mailer->send();
            apex_lead_log($formType, $fields, $sent);
            if ($sent && !empty($opts['autorespond'])) {
                apex_send_autoresponder($replyToEmail, $replyToName);
            }
            return array('ok' => (bool) $sent, 'error' => $sent ? null : $mailer->ErrorInfo, 'transport' => $transport);
        } catch (\Exception $e) {
            apex_lead_log($formType, $fields, false);
            return array('ok' => false, 'error' => $e->getMessage(), 'transport' => $transport);
        }
    }

    /** Autoresponder — only fires when AUTORESPONDER_ENABLED is true in config.php. */
    function apex_send_autoresponder($toEmail, $toName = '')
    {
        $config = apex_mail_config();
        if (empty($config['AUTORESPONDER_ENABLED']) || !apex_valid_email($toEmail)) {
            return false;
        }
        try {
            $mailer = new \PHPMailer\PHPMailer\PHPMailer(true);
            if (!empty($config['SMTP_HOST'])) {
                $mailer->isSMTP();
                $mailer->Host = $config['SMTP_HOST'];
                $mailer->Port = (int) $config['SMTP_PORT'];
                $mailer->SMTPAuth = $config['SMTP_USERNAME'] !== '';
                $mailer->Username = $config['SMTP_USERNAME'];
                $mailer->Password = $config['SMTP_PASSWORD'];
                $enc = strtolower((string) $config['SMTP_ENCRYPTION']);
                $mailer->SMTPSecure = ($enc === 'ssl' || (int) $config['SMTP_PORT'] === 465)
                    ? \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS
                    : \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                $mailer->Timeout = 15;
            } else {
                $mailer->isMail();
            }
            $mailer->CharSet = 'UTF-8';
            $mailer->setFrom($config['MAIL_FROM'], $config['MAIL_FROM_NAME']);
            $mailer->addAddress($toEmail, apex_str($toName, 120));
            $mailer->Subject = apex_str($config['AUTORESPONDER_SUBJECT'], 180);
            $mailer->Body = apex_text($config['AUTORESPONDER_BODY'], 4000);
            return $mailer->send();
        } catch (\Exception $e) {
            return false;
        }
    }

    /** Append a newsletter subscriber to private storage (deduplicated). */
    function apex_newsletter_store($email, $source = '')
    {
        $dir = apex_private_dir() . '/storage';
        if (!is_dir($dir) && !@mkdir($dir, 0775, true)) {
            return false;
        }
        $file = $dir . '/newsletter-subscribers.csv';
        $email = strtolower(apex_str($email, 200));
        if (!apex_valid_email($email)) {
            return false;
        }
        if (is_file($file)) {
            $existing = @file_get_contents($file);
            if ($existing !== false && stripos($existing, '"' . $email . '"') !== false) {
                return true; // already subscribed
            }
        }
        $row = '"' . $email . '","' . date('c') . '","' . str_replace('"', '', apex_str($source, 120)) . '"' . "\n";
        return (bool) @file_put_contents($file, $row, FILE_APPEND | LOCK_EX);
    }
}
