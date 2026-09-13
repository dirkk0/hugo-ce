---
name: analytics-setup
description: Site analytics: self-hosted page-view counter (zaehler.php), page views only, nothing about visitors stored
metadata:
  node_type: memory
  type: project
  originSessionId: 7d2d4896-901f-493b-a1be-d14da939b7bb
---

Self-hosted first-party counter. `static/zaehler.php` logs time, path and referring domain to `static/_private/hits.log`; `static/stats.php` is the basic-auth dashboard, password in gitignored `static/_private/secrets.php`. **Page views only since 2026-09-13**: no IP, no browser string, no hash, no salt. Same code as `hugos2/folgend.es`, where it was reworked.

Replaced GoatCounter (2026-06-06), whose `gc.zgo.at` beacon was blocked as a 3rd-party tracker. First-party alone does not escape blockers, though: their lists match URL patterns, and the original name `hit.php` was blocked same-origin. Hence `zaehler.php`. `static/hit.php` is now a stub that requires zaehler.php, so the deploy overwrites the old hashing file on the server; remove it once cached pages have aged out.

Host is **ALL-INKL** (kasserver.com), not IONOS as previously noted. PHP 7.4, 8.2, 8.3 and 8.4 CLIs exist on the host, so lint there with `php -l` before deploying. The code stays PHP 5.3-compatible regardless.

`GitHub/pens3/hit-counter/` and the `mixxape` deployment still carry the OLD hashing counter. Copy from here or folgend.es, not from pens3.

Deploy stays no-`--delete` rsync so `hits.log` survives; `push.sh` pulls a log copy into gitignored `backups/` before uploading.

**Why:** the host and PHP facts and the blocked-by-filename finding are non-obvious, and this note had the host and PHP version wrong before.
**How to apply:** start from these facts when touching analytics. Once `_private/log-format-v2` exists on the server, the one-time migration block in zaehler.php can be deleted.
