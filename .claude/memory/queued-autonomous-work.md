---
name: queued-autonomous-work
description: Work Dirk approved for hugo-ce but wants run while he is away — run only when he signals he is stepping out
metadata:
  type: project
---

Queue of **agreed-autonomous** jobs for `hugo-ce`. Per Dirk's standing preference these are NOT
run inline while he is watching — hold them until he signals he is stepping away (or offers to
run them in the background).

## 1. Alt-text pass on project content images (queued 2026-08-19)

Write descriptive `alt` text for the content images in `content/projects/`, **both languages**.
Currently `![](../../img/x.png#small)` — empty alt — in 10 projects × 2 files = 20 files:
`accretia, alvirah, filmstro, flight13, frank, gramofon, holowaa, klangkiste, kmu, standby`.
Already fine (leave alone): `village`, `oberheim-matrix1000`, `mixxape`, `pepper`.

Notes for whoever runs it:
- Alt text must be **written per image from what the image actually shows** — open each file in
  `static/img/` and look; do not paraphrase the project title.
- German files get German alt text, not a copy of the English.
- Preview thumbnails in `_default/list.html` already have alt (from the 2026-07-15 SEO review);
  this pass is only about images inside the content bodies.
- Verify with `hugo --buildDrafts` afterwards; Dirk does his own commits — leave it in the tree.

## Related consistency drift found 2026-08-19 (NOT queued — Dirk has not approved these)

- Closing-link sections vary: `Project Page:` / `Project page:` / `More information:` / inline
  sentence, and `<hr>` before that block in only 6 of 14 projects.
- `alvirah` uses a full timestamp (`2022-06-08T11:00:00+02:00`) where every other project uses a
  plain date.
- Older 2022-era project blurbs still awaiting a voice refresh (long-standing open item).
