<?php
// ── Stats viewer for the first-party page-view log ─────────────────────
// Password-protected (HTTP Basic auth). Set STATS_PASS below before deploy.
// Reads _private/hits.log and shows total page views, a per-day chart, top
// pages and top referring domains. No database, no external dependencies.
// Page views only: the log holds nothing about visitors, so there is no
// unique-visitor figure. See the privacy note at the top of zaehler.php.
// Written for PHP 5.3+ (no PHP 7 syntax). See README.md for the checklist.

// ── config — CHANGE THESE PER SITE ─────────────────────────────────────
define('LOG_FILE',   __DIR__ . '/_private/hits.log');
define('STATS_USER', 'admin');
define('OWN_HOST',   'curious-electric.com');             // referrers from this domain or its subdomains are dropped
define('DAYS',       30);

// ── secret ─────────────────────────────────────────────────────────────
// STATS_PASS lives in _private/secrets.php, which is gitignored and
// .htaccess-denied, so the password is never committed. See
// _private/secrets.php.example. If the file is absent the constant stays
// blank and the lock below refuses access: a missing secrets file must fail
// closed, never fall through to an unprotected dashboard.
$ce_secrets = __DIR__ . '/_private/secrets.php';
if (is_readable($ce_secrets)) { require_once $ce_secrets; }
if (!defined('STATS_PASS')) { define('STATS_PASS', ''); }

// constant-time compare polyfill (hash_equals is PHP 5.6+)
if (!function_exists('hash_equals')) {
    function hash_equals($a, $b) {
        if (!is_string($a) || !is_string($b) || strlen($a) !== strlen($b)) { return false; }
        $r = 0;
        for ($i = 0, $n = strlen($a); $i < $n; $i++) { $r |= ord($a[$i]) ^ ord($b[$i]); }
        return $r === 0;
    }
}

// ── auth ────────────────────────────────────────────────────────────────
if (STATS_PASS === '') {
    header('HTTP/1.1 503 Service Unavailable');
    exit('stats.php is locked: set STATS_PASS in _private/secrets.php '
       . '(copy _private/secrets.php.example).');
}
$u = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '';
$p = isset($_SERVER['PHP_AUTH_PW'])   ? $_SERVER['PHP_AUTH_PW']   : '';
if (!hash_equals(STATS_USER, $u) || !hash_equals(STATS_PASS, $p)) {
    header('WWW-Authenticate: Basic realm="site stats"');
    header('HTTP/1.1 401 Unauthorized');
    exit('Auth required.');
}

// ── read + aggregate ─────────────────────────────────────────────────────
$totalHits   = 0;
$perDay      = array();   // day  => hits
$pages       = array();   // path => hits
$refs        = array();   // domain => hits

if (is_file(LOG_FILE) && ($fh = fopen(LOG_FILE, 'r'))) {
    while (($l = fgets($fh)) !== false) {
        // time \t path \t referring domain. Any further column, as in lines
        // written before 2026-09-13, is ignored.
        $parts = explode("\t", rtrim($l, "\n"));
        if (count($parts) < 3) { continue; }
        list($ts, $path, $ref) = $parts;
        $day = substr($ts, 0, 10);

        $totalHits++;
        $perDay[$day] = (isset($perDay[$day]) ? $perDay[$day] : 0) + 1;
        $pages[$path] = (isset($pages[$path]) ? $pages[$path] : 0) + 1;

        // An unmigrated line may still hold a full URL; reduce it the same way.
        $host = parse_url($ref, PHP_URL_HOST);
        if (!is_string($host) || $host === '') { $host = $ref; }
        $host = strtolower($host);

        // Our own domain is internal navigation, not a referral. Compared as a
        // domain, not a substring, so "folgend.es.example.org" still counts.
        $own = strtolower(OWN_HOST);
        $internal = ($host === $own)
                 || (substr($host, -strlen($own) - 1) === '.' . $own);
        if ($host !== '' && !$internal) {
            $refs[$host] = (isset($refs[$host]) ? $refs[$host] : 0) + 1;
        }
    }
    fclose($fh);
}
arsort($pages);
arsort($refs);

// build the last-N-days series (zero-filled)
$series = array();
for ($i = DAYS - 1; $i >= 0; $i--) {
    $d = gmdate('Y-m-d', time() - $i * 86400);
    $series[$d] = array(
        'hits' => isset($perDay[$d]) ? $perDay[$d] : 0,
    );
}
$maxDay = 1;
foreach ($series as $v) { if ($v['hits'] > $maxDay) { $maxDay = $v['hits']; } }

function h($s) { return htmlspecialchars((string) $s, ENT_QUOTES); }
?>
<!doctype html>
<html><head><meta charset="utf-8"><meta name="robots" content="noindex">
<title>stats</title>
<style>
 body{font:14px/1.55 ui-monospace,Menlo,monospace;max-width:760px;margin:2rem auto;padding:0 1rem;color:#222}
 h1{font-size:1.2rem} h2{font-size:1rem;margin-top:2rem;border-bottom:1px solid #ddd;padding-bottom:.3rem}
 .big{font-size:1.7rem;font-weight:bold} .muted{color:#888}
 .row{display:flex;gap:2.5rem;margin-top:.5rem}
 table{border-collapse:collapse;width:100%} td{padding:.15rem .4rem;vertical-align:top}
 td.n{text-align:right;white-space:nowrap;color:#555;width:4rem}
 .bar{display:inline-block;height:.7em;background:#3a7;vertical-align:middle;border-radius:2px}
</style></head><body>
<h1>stats</h1>
<div class="row">
  <div><div class="big"><?php echo number_format($totalHits); ?></div><div class="muted">pageviews</div></div>
</div>

<h2>last <?php echo DAYS; ?> days</h2>
<table>
<?php foreach ($series as $d => $v): $w = (int) round($v['hits'] / $maxDay * 300); ?>
 <tr><td class="muted"><?php echo h($d); ?></td>
     <td><span class="bar" style="width:<?php echo $w; ?>px"></span>
         <?php echo $v['hits']; ?></td></tr>
<?php endforeach; ?>
</table>

<h2>top pages</h2>
<table>
<?php foreach (array_slice($pages, 0, 25, true) as $path => $n): ?>
 <tr><td class="n"><?php echo number_format($n); ?></td><td><?php echo h($path); ?></td></tr>
<?php endforeach; ?>
</table>

<h2>top referrers</h2>
<table>
<?php if (!$refs): ?><tr><td class="muted">none yet</td></tr><?php endif; ?>
<?php foreach (array_slice($refs, 0, 25, true) as $r => $n): ?>
 <tr><td class="n"><?php echo number_format($n); ?></td><td><?php echo h($r); ?></td></tr>
<?php endforeach; ?>
</table>

<h2>this browser</h2>
<p id="nostats-state" class="muted">checking…</p>
<p><button type="button" id="nostats-toggle" hidden></button></p>
<?php /* Self-exclusion state for whoever is reading the dashboard. The flag is
         localStorage on the site's own origin, so only the browser knows it and
         only the browser can show it. Worth surfacing here: an opted-out browser
         that forgot it opted out looks exactly like a broken pixel, and that is
         an expensive hour to spend twice. */ ?>
<script>
(function () {
  var KEY = 'ce-nostats';
  var state = document.getElementById('nostats-state');
  var btn = document.getElementById('nostats-toggle');
  function read() { try { return !!localStorage.getItem(KEY); } catch (e) { return null; } }
  function render() {
    var off = read();
    if (off === null) {
      state.textContent = 'Cannot read site storage here, so this browser is being counted.';
      return;
    }
    state.textContent = off
      ? 'Not counted. This browser is excluded from the numbers above.'
      : 'Counted. Your visits are included in the numbers above.';
    btn.textContent = off ? 'Start counting this browser' : 'Stop counting this browser';
    btn.hidden = false;
  }
  btn.addEventListener('click', function () {
    try { read() ? localStorage.removeItem(KEY) : localStorage.setItem(KEY, '1'); } catch (e) {}
    render();
  });
  render();
})();
</script>

<p class="muted">first-party pixel · no cookies · page views only, nothing about visitors stored</p>
</body></html>
