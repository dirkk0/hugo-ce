---
name: queued-autonomous-work
description: Work Dirk approved for hugo-ce but wants run while he is away — run only when he signals he is stepping out
metadata:
  type: project
---

Queue of **agreed-autonomous** jobs for `hugo-ce`. Per Dirk's standing preference these are NOT
run inline while he is watching — hold them until he signals he is stepping away (or offers to
run them in the background).

## 1. Alt-text pass on project content images — DONE 2026-08-19

Write descriptive `alt` text for the content images in `content/projects/`, **both languages**.
Currently `![](../../img/x.png#small)` — empty alt — in 10 projects × 2 files = 20 files:
`accretia, alvirah, filmstro, flight13, frank, gramofon, holowaa, klangkiste, kmu, standby`.
Already fine (leave alone): `village`, `oberheim-matrix1000`, `mixxape`, `pepper`.

**Completed the same day**, while Dirk was heading out: all 20 files now carry descriptive alt
text written from looking at each image in `static/img/`, German in the German files. The only
`alt=""` left in the rendered pages is the 1×1 analytics pixel, which is correct (decorative).

Notes from the run:
- Alt text must be **written per image from what the image actually shows** — open each file in
  `static/img/` and look; do not paraphrase the project title.
- German files get German alt text, not a copy of the English.
- Preview thumbnails in `_default/list.html` already have alt (from the 2026-07-15 SEO review);
  this pass is only about images inside the content bodies.
- Verify with `hugo --buildDrafts` afterwards; Dirk does his own commits — leave it in the tree.

## 2. `<article>` with no heading on section pages - QUEUED 2026-09-12

`_default/list.html` wraps `{{ .Content }}` in `<article>`, but on section pages that content
is empty, so the W3C validator reports "Article lacks heading. Consider using h2-h6 elements
to add identifying headings to all articles." An accessibility hint, not a validity error.

Fix direction: either drop the `<article>` when `.Content` is empty, or give it a heading.
The `<h1>` on line 9 already sits outside the `<article>`, so the simplest fix is a
conditional wrapper: only emit `<article>` when there is content.

## 3. Trailing slash on void elements - QUEUED 2026-09-12

Several pages emit `<meta ... />` / `<link ... />` style markup. The validator flags each as
info: "Trailing slash on void elements has no effect and interacts badly with unquoted
attribute values." Purely cosmetic, zero functional impact. Low value, do it only if touching
those partials anyway.

## 4. `push.sh` does not prune the server - QUEUED 2026-09-12

`push.sh` does `rsync -r --delete --checksum public/ upload/` (local mirror, pruned) but the
final `rsync -avztP -e "ssh" upload/ $CONF_PATH/w/v1/` has **no `--delete`**. So renamed or
removed pages are cleaned locally and then linger on the server indefinitely.

- The diff3d -> TTL rename (2026-08-19) may have left orphaned pages live. Check before fixing.
- `DEPLOY.md` currently overstates this: it says `--cleanDestinationDir` stops stale pages
  lingering on the server. It only cleans `public/`. That sentence needs correcting too.
- Adding `--delete` to the remote rsync is the obvious fix, but it is destructive against a
  live server and the target is a shared path. **Confirm with Dirk before adding it** - this
  queue item is to investigate and report, not to add `--delete` unattended.

## Related consistency drift found 2026-08-19 (NOT queued — Dirk has not approved these)

- Closing-link sections vary: `Project Page:` / `Project page:` / `More information:` / inline
  sentence, and `<hr>` before that block in only 6 of 14 projects.
- `alvirah` uses a full timestamp (`2022-06-08T11:00:00+02:00`) where every other project uses a
  plain date.
- Older 2022-era project blurbs still awaiting a voice refresh (long-standing open item).
