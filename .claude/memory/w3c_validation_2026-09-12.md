---
name: w3c_validation_2026-09-12
description: First W3C validation pass on hugo-ce - three template bugs found and fixed, live site validates clean
metadata:
  type: project
---

First W3C (Nu) validation pass on the rendered site, 2026-09-12. Three bugs, all in
`themes/ce_normal`, all now fixed and verified clean on the live site.

| # | Bug | Where | Scope |
|---|---|---|---|
| 1 | `<noscript><img>` inside `<head>` | `partials/header.html`, `partials/header-home.html` | every page, 6 errors each |
| 2 | `<p>` wrapping `.Summary`, which already emits its own `<p>` | `_default/list.html` | `/projects/`, 19 errors |
| 3 | `<hr>` as a direct child of `<ul>` | `_default/list.html` (news + about loops) | `/news/` and `/de/news/`, 19 each |

**Why bug 1 was so destructive:** a `<noscript>` in `<head>` may only contain `<link>`,
`<style>` and `<meta>`. The analytics pixel's `<img>` aborted head parsing, so the parser
implicitly opened `<body>` early and `<title>`, `</noscript>`, `</head>` and the real
`<body>` all became errors. One line, six errors, on every page of the site. The pixel now
sits just after `<body>` with a comment explaining why it must stay there.

**Bug 2:** Hugo's `.Summary` returns block HTML including a `<p>`, so wrapping it produced
`<p><p>...</p></p>`. No CSS depended on the wrapper (`main.css` only has `.preview-item`,
`.preview-item .date`, `.preview-item img`).

**Bug 3:** `<ul>` may only have `<li>` children. The `<hr>` moved inside the `<li>`;
visually identical because `.news-list li` has margin but no padding.

**How to apply:**
- Validating one URL proves nothing about the rest. The online validator checks a single
  page, and its "Suppressing further errors from this subtree" means one early error can
  mask later ones. Check one page per template branch: home, `/projects/`, `/news/`,
  a project single, a news single, `/about/`, `/imprint/`, `404`.
- **Validate the minified output.** `push.sh` runs `hugo --gc --minify`; plain `hugo` does
  not minify, and the minifier can drop optional end tags.
- **Do not loop the online validator over all 135 pages.** That got rate-limited on the
  first attempt here. Either sample one page per template, or run it locally:
  `curl -sL -o vnu.jar https://github.com/validator/validator/releases/latest/download/vnu.jar`
  then `java -jar vnu.jar --errors-only --skip-non-html public/`. Java is already installed.
- Remaining non-errors, deliberately not fixed: "trailing slash on void elements" (cosmetic)
  and "Article lacks heading" on section pages. See [[queued-autonomous-work]].
