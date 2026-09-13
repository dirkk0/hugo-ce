<?php
// Old name of zaehler.php, before the 2026-09-09 rename. Pages cached from
// before then still request it, and the ORIGINAL file at this path wrote
// visitor hashes into the same log. push.sh has no remote --delete, so a
// deploy cannot remove that file; shipping this stub overwrites it instead,
// so old requests are counted the new way and nothing re-adds a hash.
// Delete this file, here and on the server, once nothing requests it.
require __DIR__ . '/zaehler.php';
