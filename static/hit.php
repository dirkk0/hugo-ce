<?php
// ── First-party pixel analytics for curious-electric.com ───────────────
// Logs one tab-separated line per pageview to a flat file, returns a 1x1 GIF.
// Because it is served first-party from your own domain (and is not a known
// tracker host), ad/tracker blockers leave it alone — unlike gc.zgo.at.
//
// Privacy: no raw IP or User-Agent is stored. The "visitor" column is a
// salted hash that rotates daily, so visits can be de-duplicated for a day
// but not tied back to a person — the same approach GoatCounter uses.
//
// Lives in static/ so Hugo copies it verbatim into the deploy at /w/v1/hit.php.
// Written for PHP 5.3+ (no PHP 7 syntax) so it runs on the current host.

// ── config ─────────────────────────────────────────────────────────────
define('LOG_FILE',  __DIR__ . '/_private/hits.log'); // outside the published path, .htaccess-blocked
define('SALT',      'A-t==?W+Lu');                   // makes the daily visitor hash unguessable
define('SKIP_BOTS', true);                           // drop obvious crawlers
define('MAX_FIELD', 300);                            // clamp field length

// ── always return the pixel, even if logging fails ─────────────────────
function ce_pixel() {
    header('Content-Type: image/gif');
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Pragma: no-cache');
    // 1x1 transparent GIF
    echo base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
}

// strip tabs/newlines/control chars so a crafted URL can't inject log lines
function ce_clean($s) {
    $s = (string) $s;
    $s = str_replace(array("\t", "\r", "\n"), ' ', $s);
    $s = preg_replace('/[\x00-\x1F\x7F]/', '', $s);
    return substr($s, 0, MAX_FIELD);
}

try {
    $ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $isBot = SKIP_BOTS && preg_match(
        '/bot|crawl|spider|slurp|bing|google|facebook|preview|monitor|curl|wget|python|headless|lighthouse|pingdom|uptime|fetch/i',
        $ua
    );

    if (!$isBot) {
        $path = ce_clean(isset($_GET['p']) ? $_GET['p'] : '/');
        if ($path === '') { $path = '/'; }

        // referrer comes from the inline beacon (document.referrer); the
        // <noscript> fallback sends none, which stats.php filters out anyway.
        if (isset($_GET['r']))                  { $ref = ce_clean($_GET['r']); }
        elseif (isset($_SERVER['HTTP_REFERER'])) { $ref = ce_clean($_SERVER['HTTP_REFERER']); }
        else                                     { $ref = ''; }

        $day = gmdate('Y-m-d');
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) { $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; }
        elseif (isset($_SERVER['REMOTE_ADDR']))      { $ip = $_SERVER['REMOTE_ADDR']; }
        else                                         { $ip = ''; }
        $ipParts = explode(',', $ip);
        $ip = trim($ipParts[0]);

        $visitor = substr(hash('sha256', $day . '|' . $ip . '|' . $ua . '|' . SALT), 0, 16);

        $line = gmdate('Y-m-d H:i:s') . "\t" . $path . "\t" . $ref . "\t" . $visitor . "\n";

        $dir = dirname(LOG_FILE);
        if (!is_dir($dir)) { @mkdir($dir, 0755, true); }
        @file_put_contents(LOG_FILE, $line, FILE_APPEND | LOCK_EX);
    }
} catch (Exception $e) {
    // analytics must never break a pageview — swallow everything
}

ce_pixel();
