---
name: analytics-setup
description: Site analytics — self-hosted first-party PHP pixel replaced GoatCounter; open follow-ups
metadata: 
  node_type: memory
  type: project
  originSessionId: 7d2d4896-901f-493b-a1be-d14da939b7bb
---

**Canonical source:** this is the origin of the reusable counter now kept at `GitHub/pens3/hit-counter/` (files + porting checklist). Also deployed to `mixxape` (mixxape.cloudriver.org). Copy from pens3 for the next site.

GoatCounter showed ~zero hits because its `gc.zgo.at` beacon is on tracker blocklists and was blocked client-side (503) — confirmed by browser network trace. Replaced (2026-06-06) with a self-hosted **first-party PHP pixel**: `static/hit.php` (logs to `static/_private/hits.log`, flat file, daily-salted visitor hash, no raw IP) + `static/stats.php` (basic-auth dashboard). GoatCounter left commented in `header.html`/`header-home.html`. Live and confirmed working (GIF served, stats behind login, log returns 403).

Host is **IONOS** (`/www/htdocs/w00e8ff9/`), was stuck on **PHP 5.x** — so the PHP is written 5.3-compatible (no `??`/arrow-fn/short-array, `define()` not `const`, `hash_equals` polyfill).

**Open follow-ups (user revisiting ~2026-06-13):** (1) check the real visitor counts after a week of data; (2) bump host PHP to 8.x in the IONOS panel (security; analytics already works either way); (3) optional "skip my own visits" toggle. Deploy stays no-`--delete` rsync (`push.sh`) so `hits.log` survives; user sweeps stale pages manually via FileZilla rather than risk `--delete` on live.

**Why:** captures the diagnosis + the non-obvious host/PHP constraint so it isn't re-derived next session.
**How to apply:** when the user returns to analytics, start from stats.php counts and the PHP-bump item.
