# Deploying the Curious Electric site

Hugo site, deployed by **rsync** to a versioned subpath on the web host.
Git is **not** the deploy path — the GitHub repo is source only.

## Where things live

- **Live site:** `https://curious-electric.com/w/v1/` (a versioned subpath, e.g. `/w/v1/`, `/w/v2/`, …).
- **Domain root** (`/index.php`): a tiny PHP **302** redirect to the current live subpath. This file lives on the server only (not in this repo).
- **Older versions** stay on the server as rollbacks (`/w/v0/` = previous site). To roll back, just point `index.php` at the older folder.
- **`baseURL`** in `config.yaml` must be the **absolute** URL including the subpath, e.g. `https://curious-electric.com/w/v1/`. Everything else (canonical, OpenGraph, hreflang, sitemap, the image/link render hooks) derives from it, so this one value controls all generated URLs.

## Normal deploy

```sh
./push.sh
```

That runs `hugo --gc --minify --cleanDestinationDir`, mirrors `public/ → upload/`, then rsyncs `upload/` to `$CONF_PATH/w/v1/` on the server (`$CONF_PATH` comes from `../config.secret`).

- `--cleanDestinationDir` prunes stale pages from `public/` so removed/renamed content doesn't linger on the server.
- `public/`, `upload/`, `resources/` are **gitignored** — they're build output, regenerated every deploy. Don't commit them.

## Rolling a new version (e.g. v1 → v2)

The root redirect is a **302**, so a new subpath takes effect immediately for everyone — no cache stickiness.

1. **`config.yaml`** — set `baseurl` to the new subpath: `https://curious-electric.com/w/v2/`.
2. **`push.sh`** — change the final rsync target to the new folder: `$CONF_PATH/w/v2/`.
3. **`static/robots.txt`** — update the `Sitemap:` line to `…/w/v2/sitemap.xml`.
4. **`./push.sh`** — deploys to `/w/v2/`.
5. **Verify** `https://curious-electric.com/w/v2/`: canonical points to `/w/v2/`, internal links work, looks right.
6. **Root `index.php`** — point the 302 at the new folder (see below).
7. Keep the previous folder (`/w/v1/`) as a rollback; delete really old ones when comfortable.
8. **Domain-root `robots.txt`** (the manual copy next to `index.php`) — update its `Sitemap:` line too. `robots.txt` is only honored at the domain root, never at `/w/v#/robots.txt`.

### The root `index.php` redirect

```php
<?php
header("HTTP/1.1 302 Found");
header("Location: https://curious-electric.com/w/v1/");
exit;
```

## Gotchas (these bit us — don't repeat)

- **302, never 301.** A `301 Moved Permanently` is cached by browsers ~forever, so changing the target later silently strips for already-visited browsers. `302 Found` is not cached.
- **`index.php` must be BOM-free** with `<?php` as the very first bytes (no leading blank line/space), or PHP throws "headers already sent" and the redirect never fires. Save as *UTF-8 without BOM*; omit the closing `?>`. (Copying code out of a terminal can introduce leading whitespace — watch for it.)
- **`baseURL` is absolute incl. subpath.** Hugo's `relURL`/`absURL` only prepend the subpath when the path has *no* leading slash — that's why the render hooks (`_markup/render-image.html`, `render-link.html`) strip the leading `/`. Content authors can use normal `/projects/…` links and `../img/…` images; the hooks make them resolve under the current subpath at any depth.
- **Content images must stay flat in `static/img/`** — the image render hook resolves them by basename.
- **Don't just rename a server folder to "promote" a build.** The HTML is baked with whatever `baseURL` it was built under, so a renamed folder has wrong internal links. Always redeploy after changing `baseURL`.

## Analytics

Active: **GoatCounter** (`curious-electric.goatcounter.com`), cookieless, no domain verification needed.
SimpleAnalytics is commented out in the header partials (revivable). The privacy statement lives on the imprint page (EN + DE).
