# VDS website theme cleanup: brief for the cloud session

You are cleaning up the code of the WordPress theme behind https://vietnam-directsourcing.com (owner: Rod; public title "Sourcing Manager"). Rod wants precise, targeted, reviewable changes and concise reports. WordPress runs on Hostinger (PHP 8.3.36, LiteSpeed cache + Hostinger CDN). You cannot run WordPress here: you only have the files. Nothing you do deploys; Rod's local session tests and deploys.

## 0. Step 0: unpack the baseline (do this first)
Rod can only upload a few files through the GitHub web page, so the code arrives as one archive: `vds-theme-baseline-2026-10-27.zip` at the repository root. Before anything else: unzip it at the repository root keeping the paths (it creates `themes/`, `exports/` and `.gitignore`; use `python3 -m zipfile -e` or `unzip`), commit the result as `baseline: unmodified copy of the live theme, 27 Oct 2026`, then delete the zip in a second commit. All later diffs are measured against that baseline commit.

## 1. What is in this repository
- `themes/knowledge/`: the ACTIVE theme (ThemeForest "Knowledge Theme" 10.2.2). It is NOT pristine: VDS changes were made directly in it between 2024 and Oct 2026 (functions.php is 77 KB; templates home, services, contact, about, faq, team, podcast, blog and footer/header were edited). Vendor code and VDS code are mixed.
- `salient-child` is NOT in this repo. It is an ORPHAN on the live server (it declares parent `salient`, which is not installed, and it is not active; 21 MB of fonts). Propose deleting it in the report.
- This is a CODE-ONLY SUBSET of the theme. Left out on purpose to stay small: icon-font binaries and font SVGs (eot, ttf, woff, woff2), source maps, the two licensed plugin zips, the theme preview image, and the stray scripts listed below. Missing here does NOT mean unused or deleted: every one of them still exists on the live server. Never remove a reference to a file just because it is absent from this repo, and never plan a change that deletes files on the server; deployment copies changed code files only.
- `exports/`: READ-ONLY reference of VDS code that lives in the WordPress DATABASE, not in the theme: 31 WPCode snippets (`exports/wpcode/`, index in `_index.json`), the Additional CSS, the active plugin list, the page to template map (`page-templates.txt`) and the 301 redirect map. Never edit these. They exist so you can see what depends on the theme.

## 2. Goal and scope
Make the theme code clean, consistent and PHP 8.3 safe WITHOUT changing behaviour or the HTML the pages produce. Pure cleanup; no new features, no redesign.
- VDS code (anything marked VDS, `vds_*`, `vds-*`, or in templates edited since 2024): clean freely, extract, comment, de-duplicate.
- Vendor code: remove dead code and unused files, fix PHP 8.3 deprecations and real bugs. Do NOT mass-reformat vendor files (huge diffs, hard to review, hard to merge with a future theme update).

## 3. FROZEN names: grep before you touch anything
Outside code depends on theme names and exact markup. Before you rename, remove or move ANY function, hook, filter, shortcode, template filename, template header, ACF field, option name, script/style handle, CSS class or ID, grep `exports/` (including `page-templates.txt`). If it appears there, it is FROZEN: keep it character-identical.
Known dependencies (not complete, the grep rule is the rule):
- Template filenames are stored in the database per page: `home-tpl.php`, `about-tpl.php`, `contact-tpl.php`, `faq-tpl.php`, `services-tpl.php`, `team-tpl.php`, `blog-tpl.php`, `podcast-tpl.php`, `privacy-policy-template.php`. Six of them never call `the_content()`: body copy is printed by snippet 3996. Keep that structure.
- Snippets rewrite theme HTML by exact string match: 4312 (`vds-intro-area` section in the home template), 4215 (`search-area` list item in the header), 4214 (`*-shape` decorative images), 4226, 4331 (`copic-team` section), 4196, 4004 (about template sections). The markup in header, footer, home, about, services must stay character-identical in those regions.
- `vds_faq_page_schema` (hooked to `wp_head` in functions.php) is unhooked by snippet 4228 by name. The single correct FAQPage schema comes from snippet 3924. Keep the function name and hook as they are, or remove the function and say so (4228 then becomes a harmless no-op).
- ACF fields read by snippets: `youtube_links`, `podcast_links`, `vds_transcript`, the FAQ repeater `field_66e58d8dceaa5` (names/keys must not change).
- Snippets 4035 and 4050 say the theme edits are the "real" fix: they are fallbacks. Do not remove anything in the theme on the assumption a snippet covers it.

## 4. Known problems to fix (found 27 Oct 2026)
1. SECURITY: stray one-off scripts in the theme root that load `wp-load.php` and can write to the database without any login: `el_apply_v2.php`, `el_v3.php`, `upload_test.php`, `find_video.php`. Also `footer.php.bak-20260712`. Delete them (they are already excluded from this repo; confirm none is required or referenced by name).
2. `functions.php`: extract the VDS blocks (FAQ schema, Solutions page CSS + modal form, and the others) into `inc/vds-*.php`, required from `functions.php`; move inline `<style>`/`<script>` into files under `assets/` enqueued with the SAME handle names and a `filemtime` version. Keep hook names, priorities and output order.
3. PHP 8.3: fix deprecations (dynamic properties, null passed to string functions, `${var}` interpolation, removed functions such as `utf8_encode`, implicit nullable parameters). Run PHP_CodeSniffer with PHPCompatibilityWP (testVersion 8.3-) over the theme.
4. Security review: output escaping (`esc_html`, `esc_attr`, `esc_url`, `wp_kses_post`), nonces and capability checks on any form handler or AJAX action (the Solutions modal form), direct use of `$_GET`/`$_POST`/`$_REQUEST`, file includes, `wp_remote_*` calls. Fix only where behaviour stays the same; otherwise list it.
5. Dead code: unused functions, commented-out blocks, duplicate CSS rules, unused templates. Verify by grep across `themes/` AND `exports/`.
6. Assets (`assets/`, images, fonts): DO NOT delete. Post and Elementor content in the database may reference them by path and you cannot see the database. List unused candidates in the report instead.

## 5. Verification (you cannot run WordPress)
- `php -l` on every PHP file with PHP 8.3; PHPCS compatibility run; no new warnings.
- Write a script that builds an INVENTORY before and after: all `function` names, `add_action`/`add_filter` hooks with priorities, `add_shortcode`, `wp_enqueue_*` handles, `register_*` calls, ACF field names, template headers. Commit `inventory-before.txt`, `inventory-after.txt` and the diff. The diff must contain only changes you list in the report.
- One concern per commit, small commits, clear messages, so Rod can revert any of them.

## 6. Hard rules
- No secrets: do not add keys, tokens or passwords; do not ask for credentials or server access. There is none here by design.
- No new dependencies, build steps (npm), CDNs or external services. Plain PHP, CSS, JS.
- Do not touch `wp-config.php` or `.htaccess` (not in this repo). Do not add the bundled premium plugin zips back (`themes/knowledge/plugin/*.zip` are licensed ACF Pro and WPBakery and are excluded).
- Work on branch `cleanup/themes-2026-10`. No force pushes. No merging.
- Work in phases and STOP after each for Rod's review: Phase 0 = inventory + a written plan (no edits). Phase 1 = deletions + security items. Phase 2 = functions.php extraction. Phase 3 = PHP 8.3 + escaping fixes. Phase 4 = dead code + `CLEANUP-REPORT.md`.

## 7. Deliverable
Pull request with `CLEANUP-REPORT.md`: every change with the reason and a risk rating (none / needs live test), items deliberately left alone, items that need a database check, and the before/after inventory diff. Concise.

## 8. Not your job
Deploying, testing on the live site, WordPress plugins, the database snippets, content, SEO. After your PR, Rod's local session tests on a copy, runs the before/after regression snapshots and deploys. Proposals that would change markup (for example moving a snippet's logic into a template) go in the report as proposals only.

## 9. Addendum, 27 Oct 2026: scope change (Rod)
Rod widened the scope after Phase 0: "one clean code base, no 2 code bases and lots of patches". The 29 active WPCode snippets and the Additional CSS are now folded into the theme, and the brand review copy decisions are applied in theme files. Sections 2, 3 (markup must stay character-identical for the snippets) and 8 (proposals only) are superseded for this branch: the snippets are retired at go-live instead of being kept as fallbacks. `HANDOFF.md` is the deploy procedure, `CLEANUP-REPORT.md` the change list. For future work: VDS code goes in the theme (`inc/vds-*.php`, `assets/css/vds.css`, `assets/js/vds.js`), not in new snippets or Additional CSS. Never update the theme from ThemeForest.
