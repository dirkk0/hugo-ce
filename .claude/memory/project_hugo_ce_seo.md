---
name: project_hugo_ce_seo
description: "Curious Electric website (hugo-ce) — SEO/freshness initiative, deploy structure, and theme quirks"
metadata: 
  node_type: memory
  type: project
  originSessionId: 9d65512d-e732-41f1-b4aa-6720d814f359
---

Dirk's studio site `~/Documents/GitHub/hugo-ce` (Hugo, theme `ce_normal`). Ongoing initiative: refresh stale content + improve SEO. As of 2026-06 newest news was Feb 2025.

**Deploy structure (non-obvious) — full runbook now in repo `DEPLOY.md` (authoritative; read it first).** Live site served at a versioned subpath, currently `https://curious-electric.com/w/v1/` (`/w/v0/` = archived previous site). Root `index.php` (server-only, not in repo) is a **302** redirect to the current subpath — Dirk edits it manually to switch versions (302 NOT 301: 301 is cached ~forever and silently breaks version switches; this bit us). `baseurl` in config.yaml is the absolute subpath URL — one value drives all canonical/OG/hreflang/sitemap/hook URLs. `push.sh` runs `hugo --gc --minify --cleanDestinationDir` (uses config baseurl; prunes stale output) → rsyncs `public/` → `upload/` → server subpath. `index.php` must be BOM-free with `<?php` as the first bytes (else "headers already sent"; copying from a terminal can add leading whitespace). **`public/` is NOT tracked in git** — gitignored along with `upload/`, `resources/`, `.hugo_build.lock` (untracked 2026-06; git is NOT the deploy path). **Workflow implication:** a `hugo` build no longer dirties git (public is ignored), so after verifying a build there's nothing to restore/clean; to delete a build use `rm -rf public`, NOT `git checkout/clean` (those won't touch ignored files). Dirk does his own commits.

**Done (SEO track):** added `themes/ce_normal/layouts/partials/head-seo.html` (meta description, canonical, OG, Twitter cards, favicons, JSON-LD Organization/CreativeWork). JSON-LD inside `<script>` needs `| jsonify | safeJS` or Go html/template double-encodes it. Wired into both `header.html` and `header-home.html`. Set absolute baseurl, title "Curious Electric", added `static/robots.txt`.

**Caveats:** robots.txt only effective at domain root (next to index.php), not `/w/v1/robots.txt`. Theme `ce_normal` references `font.css`/`main-home.css` that only ship in `ce_pico` (Dirk copied them over 2026-06; HTML/CSS positioning to be reassessed later).

**Image path gotcha:** `canonifyURLs` is OFF, so relative refs resolve literally against the page URL. In **frontmatter** use `image: ../img/FILE.png` (one `../` — correct for the one-level-deep list page at `/w/v2/projects/` or `/w/v2/news/`, and head-seo OG uses `path.Base` anyway). In **post body** markdown use `![](../../img/FILE.png)` (two `../` — detail pages are two levels deep, e.g. `/w/v2/news/slug/`). Old news posts wrongly used `](../img/` in bodies → 404 on live; projects correctly used `../../img/`. **Resolved properly** by adding an image render hook `themes/ce_normal/layouts/_default/_markup/render-image.html` that rewrites every local content image to a baseURL-absolute `/img/<basename>` URL (preserving the `#small`/`#verysmall` fragment that `img[src$="#small"]` CSS sizes on). The news list (`_default/list.html`, `if .Page.Title "News"`) inlines each post's full `.Content`, so relative paths broke there at a different depth than the detail page — the hook makes depth irrelevant. With the hook, the `../` vs `../../` distinction in markdown image bodies no longer matters (basename is extracted); all content images must stay flat in `static/img/`.

**Same fix for internal links:** added `_markup/render-link.html` so root-relative links (`/projects/…`, `/about/…`) get the `/w/v2/` baseURL prefix at any depth (the news list inlines content, so plain relative links broke there). **`relURL`/`absURL` gotcha (bit twice):** they only add the baseURL subpath when the path has **no leading slash** — `relURL "/projects/x"` → `/projects/x` (unchanged), but `relURL "projects/x"` → `/w/v2/projects/x`. So both hooks strip/avoid the leading slash. The `/about/` contact CTA was broken by this (root-relative → bounced to home); replaced with `mailto:info@curious-electric.com` instead (no contact form exists). Projects list `_index.md` had a duplicate `# Projects` heading (template already renders the title `<h1>`) — removed, added a richer intro + `description`.

**Next:** Track A — turn safe idea-repos into news posts (NOT toucan1, see [[project_toucan_nda]]). Strong candidates: `oberheim-matrix1000-editor`, `diff3d`. Repos stay private; news markets the capability.

**German translations:** the site is multilingual (en/de). All 13 project entries + 17 news entries now have German `.de.md` versions, created `draft: true` (won't publish until Dirk flips them) — done as an autonomous batch 2026-06. Voice-heavy core pages (homepage, About) were intentionally NOT translated — Dirk owns that German brand voice. Fixed the leftover French `help: Aide` → `Hilfe` in the de nav config. To review: `hugo server -D` shows German under `/de/`. Pattern for new translations: sibling `X.de.md`, translate `title`/`description`, keep `date`/`image`/`tags`, `draft: true`, "KI" in prose but keep `AI` tag.

**Status (end of 2026-06 session):** Bilingual site essentially complete & live.
- Content: Oberheim Matrix-1000 + Village + mixxape have news+project entries; Matrix & Village carry the `AI` tag + Claude credit (seed for a future AI-services offer page grouping AI-tagged posts). `diff3d` held `draft: true` in BOTH languages by design.
- German: nearly all `.de.md` flipped to `draft: false` (live), except `diff3d.de`. German nav complete (Start/Projekte/Neues/About). About consolidated to single `_index.md` (+ `_index.de.md` from the old `.bak`); the old `services/team/misc.md` split files were removed.
- i18n: UI chrome via `i18n/en.toml`+`de.toml`; German avoids both *Sie* and *Du* per Dirk's preference.
- Language switch: `partials/lang-switch.html` in nav (muted styling), deep-links page↔page when a translation is published, else falls back to that language's home.
- SEO: hreflang alternates added to `head-seo.html` (reciprocal en/de + x-default→en, gated on `.IsTranslated`).
- Templates: `_default/list.html` section branches gate on `.Section` (NOT `.Title`) so localized section titles work; project preview `<img>` uses `printf "img/%s" (path.Base .Params.image) | relURL`.
- Tag casing normalized (JavaScript, IoT, …); `/tags/` overview + per-tag pages cleaned (debug text removed, footer + "← All tags" back-link added).
- Remaining nice-to-haves: refresh older 2022 project blurbs to current voice (autonomous-queue candidate); translate the voice-heavy homepage + About prose (Dirk owns that voice).
