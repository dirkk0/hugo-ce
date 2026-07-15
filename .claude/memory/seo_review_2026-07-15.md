---
name: seo-review-2026-07-15
description: Findings and decisions from an SEO review of the rendered site on 2026-07-15
metadata:
  type: project
---

Ran an SEO review of the rendered site (prompted by a session that started with fixing a `/w/v1/w/v1/...` menu-link path-duplication bug). Findings, ranked by impact, and what the user decided for each:

1. **Versioned-subpath deploy + 302 root redirect** (see `DEPLOY.md`) means the bare domain never accumulates SEO authority, and rolling `v1 → v2` has no redirect from old indexed URLs to new ones — each version bump risks resetting accumulated SEO equity. **Decision: leave as-is** until the user does a full site overhaul. Not a bug, a deliberate deferral.
2. **Duplicate/cannibalizing content** between `/news/` (which inlines every post's full `.Content`, see `themes/ce_normal/layouts/_default/list.html`) and each post's own permalink page. Self-referencing canonicals limit the damage but multiple URLs still target the same keywords. **Decision: undecided, user wants to think about it.**
3. Missing `alt` text on project preview thumbnails — **fixed** in `list.html` (alt now pulled from project title).
4. No `width`/`height` on images (Core Web Vitals/CLS risk) — **fixed** using Hugo's `images.Config` (path must be prefixed `static/`, e.g. `images.Config "static/img/foo.png"`; it hard-errors — not a soft nil — on SVG/missing files, so guard by extension before calling it) in both `render-image.html` and `list.html`. Also added `loading="lazy"` to content and preview images.
5. Thin taxonomy/tag pages included in sitemap (e.g. `/tags/ai/`) — low value if a tag has few posts. **Decision: user will "beef up" tag pages soon-ish** (unclear yet whether that means more content per tag or noindex-ing thin ones — ask when it comes up).

**Why this matters:** items 1, 2, 5 are open backlog the user has explicitly acknowledged but not resolved — worth surfacing again if a future conversation touches deploy strategy, `/news/` templates, or taxonomy/tag pages, rather than re-discovering or re-pitching them from scratch.
