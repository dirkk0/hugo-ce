<?php
// ── First-party page-view counter ──────────────────────────────────────
// Logs one tab-separated line per page view to a flat file, returns a 1x1 GIF.
// Serving it first-party from your own domain avoids the blocking that kills
// 3rd-party beacons (GoatCounter's gc.zgo.at, SimpleAnalytics, etc.).
//
// But first-party is NOT sufficient on its own, and the FILENAME matters:
// blocker lists (EasyPrivacy et al.) match URL patterns, not just hostnames.
// This file was called hit.php until 2026-09-09, and in that form a
// blocker-equipped browser logged nothing at all while Safari logged fine.
// Hence the neutral German name. If you rename it again, stay away from the
// English tracker vocabulary: hit, pixel, track, count, stat, log, beacon.
//
// Privacy: nothing about the visitor is stored. Each line is the time, the
// page path and the DOMAIN of the referring site. No IP address, no browser
// string, no hash of either. It counts page views, not people. Telling two
// views by one person apart without a cookie means deriving something from
// the IP, and that one feature is what dragged in a secret salt, pseudonymous
// IDs and a deletion schedule. Dropped on 2026-09-13 for exactly that reason.
//
// Written for PHP 5.3+ (no PHP 7 syntax) so it runs on old shared hosts too.
// See README.md for the per-site porting checklist.

// ── config — CHANGE THESE PER SITE ─────────────────────────────────────
define('LOG_FILE',  __DIR__ . '/_private/hits.log'); // outside the published path, .htaccess-blocked
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

// Reduce a referrer to its domain. A full URL can carry anything (a search
// query, a token, a webmail path); the domain is all the dashboard shows and
// all that is worth keeping. A value that is already a bare domain, as in a
// line this function processed before, comes back unchanged, which is what
// makes the migration below safe to repeat.
function ce_ref_host($ref) {
    $ref = trim((string) $ref);
    if ($ref === '') { return ''; }
    $host = parse_url($ref, PHP_URL_HOST);
    if (!is_string($host) || $host === '') {
        if (!preg_match('/^([a-z0-9-]+\.)*[a-z0-9-]+(:[0-9]+)?$/i', $ref)) { return ''; }
        $host = preg_replace('/:[0-9]+$/', '', $ref);
    }
    return strtolower($host);
}

// ── one-time migration of the existing log ─────────────────────────────
// Until 2026-09-13 every line had a fourth column, a hash of IP, browser
// string, date and a salt, and kept the full referrer URL. This rewrites the
// log into the new three-column shape so the old lines stop being personal
// data too, not just the new ones.
//
// It holds flock on the log itself, the same lock the append below takes, so
// no hit can land half-way through the rewrite. The marker is written only
// after a complete rewrite, and the transform is idempotent, so an
// interrupted or repeated run converges on the same result.
//
// Once _private/log-format-v2 exists on the server this block has done its
// job: delete it, and the marker, whenever convenient.
define('MIGRATED_MARK', dirname(LOG_FILE) . '/log-format-v2');

function ce_migrate_log() {
    if (is_file(MIGRATED_MARK) || !is_file(LOG_FILE)) { return; }
    $fh = @fopen(LOG_FILE, 'c+');
    if (!$fh) { return; }
    if (!flock($fh, LOCK_EX)) { fclose($fh); return; }

    $in = stream_get_contents($fh);
    $ok = false;
    if ($in !== false) {
        $out = '';
        foreach (explode("\n", $in) as $l) {
            if ($l === '') { continue; }
            $parts = explode("\t", $l);
            if (count($parts) >= 3) {
                $out .= $parts[0] . "\t" . $parts[1] . "\t" . ce_ref_host($parts[2]) . "\n";
            } else {
                $out .= $l . "\n";   // malformed; stats.php skips it, keep as found
            }
        }
        rewind($fh);
        $ok = ftruncate($fh, 0) && fwrite($fh, $out) === strlen($out) && fflush($fh);
    }
    flock($fh, LOCK_UN);
    fclose($fh);
    if ($ok) { @file_put_contents(MIGRATED_MARK, gmdate('c') . "\n"); }
}

try {
    ce_migrate_log();

    // The browser string is only glanced at to skip crawlers. It is never
    // stored, and nothing is derived from it.
    $ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $isBot = SKIP_BOTS && preg_match(
        '/bot|crawl|spider|slurp|bing|google|facebook|preview|monitor|curl|wget|python|headless|lighthouse|pingdom|uptime|fetch/i',
        $ua
    );

    if (!$isBot) {
        // Path only: cut any query string or fragment a crafted request adds.
        $path = ce_clean(isset($_GET['p']) ? $_GET['p'] : '/');
        $path = preg_replace('/[?#].*$/', '', $path);
        if ($path === '') { $path = '/'; }

        // The inline beacon sends document.referrer; the <noscript> fallback
        // sends none, so the HTTP Referer header stands in for it.
        if (isset($_GET['r']))                   { $ref = $_GET['r']; }
        elseif (isset($_SERVER['HTTP_REFERER'])) { $ref = $_SERVER['HTTP_REFERER']; }
        else                                     { $ref = ''; }
        $ref = ce_ref_host(ce_clean($ref));

        $line = gmdate('Y-m-d H:i:s') . "\t" . $path . "\t" . $ref . "\n";

        $dir = dirname(LOG_FILE);
        if (!is_dir($dir)) { @mkdir($dir, 0755, true); }
        @file_put_contents(LOG_FILE, $line, FILE_APPEND | LOCK_EX);
    }
} catch (Exception $e) {
    // analytics must never break a pageview — swallow everything
}

ce_pixel();
