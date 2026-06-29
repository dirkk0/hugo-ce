<?php
// ── Stats viewer for the first-party pixel log ─────────────────────────
// Password-protected (HTTP Basic auth). Set STATS_PASS below before deploy.
// Reads static/_private/hits.log and shows totals, a per-day chart,
// top pages and top referrers. No database, no external dependencies.
// Written for PHP 5.3+ (no PHP 7 syntax) so it runs on the current host.

// ── config ─────────────────────────────────────────────────────────────
define('LOG_FILE',   __DIR__ . '/_private/hits.log');
define('STATS_USER', 'admin');
define('STATS_PASS', 'V>JQ2V_SJI');           // <-- SET THIS. Blank = locked out.
define('OWN_HOST',   'curious-electric.com');  // referrers containing this are dropped
define('DAYS',       30);

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
    exit('stats.php is locked: set STATS_PASS at the top of this file.');
}
$u = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '';
$p = isset($_SERVER['PHP_AUTH_PW'])   ? $_SERVER['PHP_AUTH_PW']   : '';
if (!hash_equals(STATS_USER, $u) || !hash_equals(STATS_PASS, $p)) {
    header('WWW-Authenticate: Basic realm="curious-electric stats"');
    header('HTTP/1.1 401 Unauthorized');
    exit('Auth required.');
}

// ── read + aggregate ─────────────────────────────────────────────────────
$totalHits   = 0;
$visitorsAll = array();
$perDay      = array();   // day  => hits
$perDayVis   = array();   // day  => array(visitor => true)
$pages       = array();   // path => hits
$refs        = array();   // host => hits

if (is_file(LOG_FILE) && ($fh = fopen(LOG_FILE, 'r'))) {
    while (($l = fgets($fh)) !== false) {
        $parts = explode("\t", rtrim($l, "\n"));
        if (count($parts) < 4) { continue; }
        list($ts, $path, $ref, $vis) = $parts;
        $day = substr($ts, 0, 10);

        $totalHits++;
        $visitorsAll[$vis]     = true;
        $perDay[$day]          = (isset($perDay[$day]) ? $perDay[$day] : 0) + 1;
        $perDayVis[$day][$vis] = true;
        $pages[$path]          = (isset($pages[$path]) ? $pages[$path] : 0) + 1;

        if ($ref !== '' && stripos($ref, OWN_HOST) === false) {
            $host = parse_url($ref, PHP_URL_HOST);
            if (!$host) { $host = $ref; }
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
        'vis'  => isset($perDayVis[$d]) ? count($perDayVis[$d]) : 0,
    );
}
$maxDay = 1;
foreach ($series as $v) { if ($v['hits'] > $maxDay) { $maxDay = $v['hits']; } }

function h($s) { return htmlspecialchars((string) $s, ENT_QUOTES); }
?>
<!doctype html>
<html><head><meta charset="utf-8"><meta name="robots" content="noindex">
<title>stats · curious-electric</title>
<style>
 body{font:14px/1.55 ui-monospace,Menlo,monospace;max-width:760px;margin:2rem auto;padding:0 1rem;color:#222}
 h1{font-size:1.2rem} h2{font-size:1rem;margin-top:2rem;border-bottom:1px solid #ddd;padding-bottom:.3rem}
 .big{font-size:1.7rem;font-weight:bold} .muted{color:#888}
 .row{display:flex;gap:2.5rem;margin-top:.5rem}
 table{border-collapse:collapse;width:100%} td{padding:.15rem .4rem;vertical-align:top}
 td.n{text-align:right;white-space:nowrap;color:#555;width:4rem}
 .bar{display:inline-block;height:.7em;background:#3a7;vertical-align:middle;border-radius:2px}
</style></head><body>
<h1>curious-electric · stats</h1>
<div class="row">
  <div><div class="big"><?php echo number_format($totalHits); ?></div><div class="muted">pageviews</div></div>
  <div><div class="big"><?php echo number_format(count($visitorsAll)); ?></div><div class="muted">unique visitors</div></div>
</div>

<h2>last <?php echo DAYS; ?> days</h2>
<table>
<?php foreach ($series as $d => $v): $w = (int) round($v['hits'] / $maxDay * 300); ?>
 <tr><td class="muted"><?php echo h($d); ?></td>
     <td><span class="bar" style="width:<?php echo $w; ?>px"></span>
         <?php echo $v['hits']; ?> <span class="muted">(<?php echo $v['vis']; ?> uniq)</span></td></tr>
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

<p class="muted">first-party pixel · no cookies · IPs hashed daily, never stored raw</p>
</body></html>
