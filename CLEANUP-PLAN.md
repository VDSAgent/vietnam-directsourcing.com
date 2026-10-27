# VDS theme cleanup: Phase 0 plan (no code changes yet)

Branch `cleanup/themes-2026-10`. Baseline commit `e367117` (unmodified copy of the live theme, 27 Oct 2026).
Everything below is measured against that commit. **Stop point: nothing in Phase 1 starts until Rod answers section 5.**

## 1. Baseline

| Check | Result |
|---|---|
| Files | 331 in `themes/knowledge/`, 44 PHP; `functions.php` 1,636 lines |
| `php -l` (PHP 8.3.6) | 0 errors |
| PHPCS PHPCompatibilityWP 2.1.8 (PHPCompatibility 9.3.5), `testVersion 8.3-` | 0 errors, 4 warnings (empty files) |
| PHPCS PHPCompatibility 10.0.0-alpha2 (has the PHP 8.x sniffs; 9.3.5 stops at 7.4), `testVersion 8.3-` | 0 errors, same 4 warnings |
| Inventory (`tools/inventory.php` → `inventory-before.txt`) | 14 template headers, 166 functions, 69 hooks, 11 shortcodes, 31 asset calls, 27 register calls, 212 ACF reads; 39 entries FROZEN |

So the theme is already free of PHP 8.3 *compile-time* problems. "PHP 8.3 safe" work is about *runtime* warnings and TypeErrors that static tools cannot see (undefined variables, arithmetic on request input), listed in 2.3.

## 2. Findings

### 2.1 Security (Phase 1)

| ID | Where | Problem | Fix | Risk |
|---|---|---|---|---|
| S1 | `webbox/wb_wp_ajaxs.php:18-33` (public AJAX `wb_load_blog`, used by /podcast/ Load More: `assets/js/main.js:290`, `podcast-tpl.php:55`) | `extract($_REQUEST)` plus visitor-controlled `WP_Query` args. Anyone can list draft/private podcasts or any post type, ask for unlimited rows, and (via `extract`) set `$temp`, which goes to `get_template_part()` as a path. | Remove `extract`; rebuild args from a whitelist: `post_type` fixed to `podcast`, `post_status` `publish`, `paged`/`posts_per_page` integers (capped), `order` ASC/DESC, `orderby` `date`; `$temp` fixed to `loop/podcast`. Same JSON shape back (`items`, `more`, `args`). | needs live test (podcast Load More) |
| S2 | `assets/mail.php` | Vendor demo mailer, web-reachable (live URL answers 403 to GET, so the file is there). Any POST emails **mdsalim400@gmail.com** (the theme author's address). Referenced nowhere. | Remove (see decision D1 on how it leaves the server). | none |
| S3 | `functions.php:1388-1412` (public AJAX `vds_solutions_form`) and the `[vds_solutions]` block it serves, `1307-1632` | Unauthenticated mail endpoint with no nonce, honeypot or rate limit. The shortcode, modal and 70 lines of CSS it belongs to render on **none** of the 129 public URLs (crawl of 27 Oct); the live Solutions form is the nonce-protected one in `services-tpl.php`. Not referenced in `exports/` (the `vds-solutions-link` class in snippet 4226 is unrelated). | Remove the whole block (about 325 lines) once a database search confirms `[vds_solutions` is not in any post content (decision D2). | none if the search is clean |
| S4 | `functions.php:544-605` (public AJAX `more_post_ajax`) | Only caller is `js/custom.js`, which is not enqueued (enqueue commented out at `:197`). Takes `posts_per_page`/`offset` raw from the request; `$offset + $ppp` throws a TypeError (HTTP 500) on non-numeric input. | Unregister and remove. | none |
| S5 | `functions.php:287-313` (public AJAX `load_more_posts`) | `$_POST['page'] + 1` throws a TypeError on non-numeric input. Only reachable through `[post_feed loadmore="true"]`, commented out in `blog-tpl.php:36`. | `absint()` the input (keep the handler until the DB search in D2 also covers `[post_feed`). | none |
| S6 | `functions.php:1113-1171` (`load_more_posts_new`, FROZEN, used by the Articles page) | `postsPerPage` is unbounded (`-1` returns every post in one response). | Clamp to 1-50. Name, hook and output unchanged. | none |
| S7 | `functions.php:174` enqueues jQuery **1.12.4** (handle `custom-js-jquery-1.12.4-min`) | Overrides WordPress's jQuery 3.7.1 on every page (`window.jQuery.fn.jquery` is `1.12.4` on the live site). 1.12.4 has known XSS CVEs (2015-9251, 2019-11358, 2020-11022/11023). | Proposal only unless Rod says otherwise (decision D3): drop the handle and depend on core `jquery`. Changes script tags and runtime. | needs live test (carousels, menus, popups, counters) |
| S8 | Output escaping, ~500 `echo` of ACF fields, URLs and titles across templates | Mostly editor-controlled content, not visitor input. `esc_html()` on ACF fields that contain intentional HTML would break pages, and several snippets match theme HTML byte-for-byte. | Phase 3: escape only where output stays byte-identical (theme/asset URLs, permalinks via `esc_url`, numeric values); list every ACF output left as-is. | none for the in-scope part |

Checked and fine: `services-tpl.php:6-21` (nonce + `sanitize_*` + `wp_mail`), `vds_solutions_form_submit` sanitising (header injection not possible), `header.php` search value (`get_search_query()` is escaped). No `$_GET`/`$_POST` value is echoed unescaped. No `wp_remote_*` calls. The four stray root scripts and `footer.php.bak-20260712` are referenced nowhere in the theme or `exports/`.

### 2.2 Bugs found on the live site

| ID | Where | Problem | Fix | Risk |
|---|---|---|---|---|
| B1 | `assets/js/main.js:6-7` + `header.php:64-70` | **Inner pages stay behind the loading spinner for logged-out visitors** (verified in a browser on /global-sourcing-solutions/, /contact-for-sourcing/, /vietnam-sourcing-company/, /vietnam-sourcing-faqs/ and an article, on mobile; desktop on two of them). LiteSpeed delays `main.js` until the first tap/scroll, by which time `window` `load` has already fired, so `$(window).on("load")` never runs. Additional CSS hides it on `body.home` only. | Run the hide immediately when `document.readyState === 'complete'`, otherwise keep the `load` handler. Markup unchanged. (Rod may already have widened the Additional CSS rule to `#preloader`; this fixes it at the source.) | needs live test (decision D4) |
| B2 | `home-tpl.php:428-441` | Inline `$(".owl-carousel-technology").owlCarousel(...)` runs before jQuery exists (`$ is not a function` on every homepage load), so that carousel never initialises. | Wrap in `jQuery(function($){ ... })`. The carousel would then start autoplaying: a visible change. | needs live test (decision D4) |
| B3 | Services form nonce vs page cache (`services-tpl.php:6-8`) | The nonce is baked into LiteSpeed-cached HTML. Nonces expire after 12-24 h; LiteSpeed's default public TTL is a week (unless changed in its settings). On a stale cached page `wp_verify_nonce()` fails and the handler silently does nothing: **no email, no error**. | Not a theme-only fix (needs a markup or cache-setting change). Live check first: see section 6. | report only |

### 2.3 PHP 8 runtime issues (Phase 3)

| ID | Where | Problem | Fix |
|---|---|---|---|
| P1 | `functions.php:943-1005` `mo_comment_fields_custom_order` | Six undefined variables (`$required_indicator`, `$required_attribute`, `$req`, `$commenter`, `$html5`, `$consent`); `$commenter['comment_author']` on null. Comments are disabled site-wide by snippet 3832, so it rarely runs. | Initialise each to the value it evaluates to today (empty string / false / empty array), so output is byte-identical and the warnings go. |
| P2 | `functions.php:1031-1080` `categories_with_count_shortcode` | `[categories_with_count]` with no attributes is a **fatal** `TypeError` on PHP 8.3 (WordPress passes `''` as `$atts`; verified with `php -r`). With attributes but no `cat`, an "undefined array key" warning. | `is_array( $atts ) && isset( $atts['cat'] ) ? $atts['cat'] : null`: the same query as today wherever it works today. |
| P3 | `webbox/wb_wp_ajaxs.php:24` | `$args['paged'] + 1` on request input (TypeError on non-numeric). | Covered by S1. |
| P4 | Classes `wb_wp_ajaxs`, `knowledgetheme_options`, TGM 2.5.2 | Will be read for dynamic-property creation (deprecated since 8.2). | Declare properties where found. |

A PHP error/deprecation log from the live site (hPanel → Advanced → Error logs, or `wp-content/debug.log` if enabled) would turn P4 from a read-through into a checklist. Optional.

### 2.4 Dead code (Phase 4; verified by grep across `themes/` and `exports/`)

- `functions.php:651-804`: commented-out block (3 functions, 150 lines); `:188-197` commented-out enqueues; other commented fragments.
- `functions.php:932-941` `add_custom_css_classes`: Gravity Forms filter; Gravity Forms is not installed (`exports/active-plugins.txt`). It would also fatal on a `<button>` submit.
- `functions.php:707-718` `services()`: `vc_map` for shortcode `shortcode_show_services`, whose shortcode is inside the commented block. Maps a shortcode that does not exist.
- `functions.php:1174-1220` `fix_nav_search_form`: no-op. It only acts when the header search has no `input[name="s"]`; `header.php:113` has one (and snippet 4215 removes that markup anyway).
- `home-tpl.php:444-…` preloader timeout fallback: redundant once B1 is fixed.
- Empty files: `admin/themes.php`, `inc/post-type.php`, `inc/short-code-media.php` (not included anywhere). **`sidebar.php` stays**: it is empty on purpose; deleting it makes `get_sidebar()` (`search.php:55`) fall back to WordPress's theme-compat sidebar and print markup.
- Shortcodes `post_feed`, `case_feed`, `team_carousel`, `testimonial_carousel`, `shortcode_show_team_about`, `categories_with_count`: their output appears on none of the 129 public URLs. Removal only after the same database search as D2; otherwise listed.
- `css/` and `js/` (Bootstrap 3, jQuery 1.11.2, Font Awesome 4, lightbox, bxslider): only `js/jquery.bxslider.min.js` (`wo_script`, `:502-506`) and `js/load-more-posts.js` are still enqueued, and bxslider is initialised only in the unloaded `js/custom.js`. **Assets are listed, not deleted** (CLAUDE.md §4.6). `wo_script` itself can go in Phase 4 if Rod agrees it is unused (it removes one script tag).

### 2.5 Deliberately left alone

`core/class-tgm-plugin-activation.php` (vendor, 115 KB, admin-only; see D6), Redux options (`core/options.php`), vendor JS/CSS in `assets/`, all template markup in regions snippets match (header, footer, home, about, services), all FROZEN names, `.htaccess`, `wp-config.php`.

## 3. Phase plan (one concern per commit)

**Phase 1: deletions + security** (after section 5 answers)
1. S1 harden `wb_load_blog`.
2. S2 remove `assets/mail.php` (per D1).
3. S3 remove the `[vds_solutions]` block (if D2 is clean).
4. S4 remove `more_post_ajax`; S5 `absint`; S6 clamp.
5. B1/B2 if D4 = yes; S7 if D3 = yes.

**Phase 2: `functions.php` extraction**, keeping hook names, priorities and **registration order** (each `require` sits exactly where its block was, so `wp_head` output order is unchanged):
- `inc/vds-faq-schema.php`: `vds_faq_page_schema` (name + hook kept, or removed per D5).
- `inc/vds-load-more.php`: `enqueue_load_more_scripts`, `load_more_posts_new` (FROZEN; snippet 4077 keys on its action name). `post_content` (FROZEN), `post_feed_func` and `load_more_posts_ajax_handler` stay where they are: their origin (vendor or VDS) is unclear, and moving vendor code only inflates the diff.
- `inc/vds-schema.php`: the anonymous `wpseo_schema_organization` filter becomes a named function on the same hook and priority (so it can be unhooked later).
- `require_once 'webbox/mains.php'` → `__DIR__`-based path (no behaviour change; removes reliance on `include_path`).
- `assets/css/vds-solutions.css` only if D2 keeps that block (handle `vds-solutions`, which makes WordPress print the same `id="vds-solutions-css"`), enqueued with a `filemtime` version.
- Vendor parts of `functions.php` (widgets, shortcodes, breadcrumbs, comment form) stay in place: not reformatted.

**Phase 3: PHP 8.3 + escaping**: P1-P4, S8 (byte-identical escaping only), re-run both PHPCompatibility versions and `php -l`.

**Phase 4: dead code + report**: section 2.4 items, `inventory-after.txt` + diff, `CLEANUP-REPORT.md`, pull request.

After each phase: `php -l` on every file, both PHPCS runs, inventory diff limited to the listed changes, push, stop for review.

## 4. Things only Rod can do on the server (deployment copies changed files only)

Delete: `el_apply_v2.php`, `el_v3.php`, `upload_test.php`, `find_video.php`, `footer.php.bak-20260712` (theme root), the orphan `salient-child` theme, and `wp-content/themes.1475/` (leftover copy of the themes folder; its URL answers with a blank page). Plus `assets/mail.php` if D1 = delete. Take a backup first. **Do not open the four stray scripts in a browser**: they write to the database on request.

## 5. Decisions needed before Phase 1

- **D1** `assets/mail.php`: (a) delete in the repo and you delete it on the server, or (b) keep the file but replace its body with a 404 exit, so a normal deploy neutralises it. *Recommendation: (a), with (b) as a fallback if server deletes are awkward.*
- **D2** Run a dry-run search in **Better Search Replace** (already installed) on `wp_posts`, `wp_postmeta` for `[vds_solutions`, `[post_feed`, `[case_feed`, `[team_carousel`, `[testimonial_carousel`, `[shortcode_show_team_about`, `[categories_with_count`. Tell me which have hits.
- **D3** jQuery 1.12.4 (S7): in scope now (needs live test), or report-only?
- **D4** Visible bug fixes B1 (spinner) and B2 (homepage carousel): in scope, or report-only?
- **D5** `vds_faq_page_schema`: keep as is (zero risk; snippet 4228 unhooks it), or remove it (snippet 4228 becomes a harmless no-op)? *Recommendation: remove; it duplicates snippet 3924 and its answers are stale.*
- **D6** TGM plugin activation (admin nag offering the bundled ACF Pro/WPBakery zips): keep, or remove `core/class-tgm-plugin-activation.php` + `core/plugins.php`? *Recommendation: keep for now (vendor, admin-only).*

## 6. Live check for Rod (B3, 2 minutes)

In a private window, open https://vietnam-directsourcing.com/global-sourcing-solutions/, submit the inquiry form with a test message, and check that the email arrives and the page shows "Thank you!". Repeat the next day without purging the cache. If the second one silently does nothing, B3 is real and enquiries are being dropped.

## 7. Reproducing the checks

```
php tools/inventory.php > inventory-before.txt          # or --names-only for a move-only diff
find themes -name '*.php' -print0 | xargs -0 -n1 php -l
phpcs --standard=PHPCompatibilityWP --runtime-set testVersion 8.3- --extensions=php themes/knowledge
phpcs --standard=PHPCompatibility   --runtime-set testVersion 8.3- --extensions=php themes/knowledge   # with PHPCompatibility 10.0.0-alpha2
```
