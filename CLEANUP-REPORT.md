# CLEANUP REPORT: theme `knowledge`, branch `cleanup/themes-2026-10`

Baseline `e367117` (the live theme, 27 Oct 2026) → branch head. How to deploy: `HANDOFF.md`.

**Scope.** The brief (CLAUDE.md) asked for cleanup with identical markup. On 27 Oct Rod widened it: "one clean code base, no 2 code bases and lots of patches". He also asked for the brand review decisions in the theme files: US spelling, prices shown, byline, no header CTA. So the markup does change, deliberately, and every change is listed here. URLs, Yoast titles, descriptions, canonicals and robots are untouched.

## 1. Before and after

| | Baseline | Now |
|---|---|---|
| Code that shapes the pages | theme + 29 active WPCode snippets + 448 lines of Additional CSS | theme only (`inc/vds-*.php`, `template-parts/`, `assets/css/vds.css` 381 lines, `assets/js/vds.js`) |
| Theme PHP | 44 files, 10,571 lines (`functions.php` 1,636) | 43 files, 4,219 lines (`functions.php` 514) |
| Templates | home 456, about 480, services 513, contact 192, header 155 lines | home 129, about 34, services 316, contact 53, header 81 |
| Inline `style=""` attributes | 214 | 4 (vendor templates) |
| Public (logged-out) AJAX endpoints | 5, two of them unvalidated mailers or query pass-throughs | 2, both with whitelisted, clamped input |
| jQuery | theme's 1.12.4 (known XSS CVEs) loaded over WordPress's 3.7.1 | WordPress's own only |
| PHP 8.3 | 0 compile errors; runtime: ~8 warnings per article view, 1 fatal shortcode | 0 errors, 0 runtime warnings in the smoke render |
| Theme files on the server to delete | – | 17 + 5 stray files + 2 orphan theme folders (HANDOFF §8) |

## 2. Changes

Risk: **none** (verified here, no behaviour change a visitor can see) or **live test** (correct in the harness, needs a check on staging).

### Security

| Commit | Change | Why | Risk |
|---|---|---|---|
| `11207fb` | Podcast Load More (`wb_load_blog`): query rebuilt from a whitelist (podcast, published, integer paging, date ASC/DESC); `extract($_REQUEST)` gone | Anyone could list draft/private posts of any type and steer `get_template_part()` | live test |
| `44bd97b` | `assets/mail.php` removed | Vendor demo mailer: any POST emailed the theme author's Gmail | none (+ server delete) |
| `9e71960` | Removed `more_post_ajax`, `load_more_posts` + `[post_feed]`, `[vds_solutions]` + its unauthenticated mail endpoint | Unused (no caller, or rendered on none of the 129 URLs); TypeErrors on bad input | none if the pre-deploy gate is clean |
| `74c644e` | Commented-out markup removed; one block printed the author's login slug on all 58 articles | Defeated the REST-users / author-archive block | none |
| `c9bdf4c` | Solutions form: recipient contactus@ → **enquiries@**; an expired nonce no longer drops the inquiry silently (it tags the subject instead); honeypot field; `wp_unslash` | B3 from the plan: LiteSpeed serves the page longer than a nonce lives, so inquiries were silently lost | live test (send one) |
| `fe813ae` | Security headers and user-enumeration block (4328) now in `inc/vds-security.php` | One code base | live test (headers) |

### Consolidation (snippets and Additional CSS into the theme)

| Commit | Change | Risk |
|---|---|---|
| `4213693` | Company page built in template order (title, hero band, regions, team, how we work, ecosystem, CTA). The old page used snippets that appended sections in the footer, CSS flex `order`, four `display:none` sections still served to crawlers, and a regex strip | live test |
| `fe813ae` | PHP snippets → `inc/vds-schema.php`, `vds-page-copy.php`, `vds-articles.php`, `vds-podcast.php`, `vds-redirects.php`, `vds-security.php`. Closures become named functions with the same hooks and priorities. The CTA banner (5 copies, one with a broken `//contact-for-sourcing//` link) becomes `template-parts/cta.php` | live test |
| `52c863a` | Output-buffer rewrite snippets (4214, 4215, 4226, 4231, 4233, 4312) applied in the templates themselves | live test |
| `37bc24e` | Core jQuery; every asset versioned by `filemtime` (deploys bust LiteSpeed/CDN); `ajaxurl` via `wp_add_inline_script`; bxslider and `font.css` no longer loaded | live test (menus, carousels, popups, counters) |
| `52ba5e1` | Inline SVG logo (brand guidelines v1.2; white over the hero, navy when sticky; it was white-on-white). `<head>` cleaned. Preloader removed: it stuck inner pages behind a spinner for logged-out visitors | live test |
| `2991aa6` | Hero subtitles use Saira Extra Condensed instead of the off-brand script font (124 KB no longer downloaded) | visible, brand |
| `d7e3d37` | `vds.css` replaces the Additional CSS, inline `<style>` and snippet CSS; `vds.js` replaces inline/snippet JS. Removed markup that never rendered: 89 hidden decorative images; homepage podcast, why-choose-us, team, technology and suppliers sections; contact Calendly and FAQ blocks; three hidden Solutions sections | live test |
| `e0287d4` | Three theme functions renamed so they can't collide with snippets 4234/4236 during the switch ("Cannot redeclare") | none |
| `619d5d6` | Solutions template: 136 inline styles → classes. Only the declarations that take effect are kept: the site-wide `!important` type scale overrides the rest. Modal gets dialog semantics; labels are tied to inputs | none: screenshots identical (§8) |

### Dead code

| Commit | Change | Risk |
|---|---|---|
| `f604f0c` | TGM plugin activation (admin nag offering the bundled ACF Pro/WPBakery zips, 115 KB) | none |
| `fb990e4` | `vds_faq_page_schema` (stale hardcoded FAQPage). Snippet 4228, which unhooked it, becomes a no-op; the FAQ schema is built from the ACF repeater | none |
| `ba12d20` | Commented-out functions, `[case_feed]`, `[testimonial_carousel]`, `[shortcode_show_team_about]` + `vc_map`, Gravity Forms and "sewn" filters for plugins that aren't installed, the `fix_nav_search_form` no-op, `case-tpl.php`, `getaquote-tpl.php`, 3 empty files | none if the gate is clean |
| `2c150b9`, `1089172`, `6008538` | Files never loaded: `inc/override-parent.php`, `inc/theme-functions.php`, `core/footer-media.php`, `template-parts/content*.php`, `content.php`, `single-case.php` (ThemeForest demo case study for a post type that isn't registered) | none |

### Fixes and PHP 8.3

| Commit | Change | Risk |
|---|---|---|
| `f93479a` | Homepage video section left its container open, so it leaked into the following sections; episode pages had `<h2>…</h1>` | none |
| `edd1a1e` | Comment form: 6 undefined variables (~8 warnings per article view) now take WordPress's own values; `[categories_with_count]` with no attributes was a fatal TypeError; Redux footer reads null-safe; 46 URLs wrapped in `esc_url()` (identical output for normal URLs); footer legal line "© 2026 Vietnam Direct Sourcing LLC · Da Nang, Vietnam" | none |

### Copy and brand (Rod's decisions, 26–27 Oct)

| Commit | Change |
|---|---|
| `20289aa` | "No middlemen, no retainer required"; "risk-free" removed (startups and independent retailers kept); Solutions prices shown (Supplier Identification US$250, Supplier Evaluation US$750, Factory Tours US$200/day incl. interpretation); "Verified" → "Checked" contact details; unverifiable claims dropped ("leading" QA firm, "proprietary" database); brand colours; homepage service cards link to anchors that exist; hidden legacy "BOOK A CALL" header button removed (no header CTA) |
| `725f74b` | One byline on every article from the theme; AI-audio disclosure on episode pages; podcast page "Sourcing From Vietnam: The VDS Podcast / Short episodes on real sourcing questions, every Tuesday"; homepage stats boxes Mist with a Signal Gold rule |
| `74c644e` | 404 page: "The page you a looking for" → "you are looking for" |
| `dabf81b` | Comments off site-wide (Rod, 28 Oct: all spam): `inc/vds-comments.php` closes and hides them, removes the admin Comments screens; comment form and count removed from articles and episodes; `comments.php` and the comment-form customisation removed. Risk: none (articles lose the form and the "0 Comment" link) |
| `eae6a53` | Team roles: Thao "Central Sourcing Specialist", Telly and Tam "North Sourcing Specialist", Cassie and Kim "South Sourcing Specialist" |

### Staging fixes (found by Rod's local session, 28 Oct; already on staging and in the live deploy)

| File | Change | Why | Risk |
|---|---|---|---|
| `core/function_option.php` | Logo SVG `viewBox` 0 0 336 56 → 0 0 360 56, `width` 336 → 360 | The wordmark renders 350 px wide in Montserrat 600 and was clipped ("Vietnam Direct Sourcin") | none (verified on staging) |

## 3. Where each snippet went (all 29 active snippets + Additional CSS)

| Snippet | Now in the theme |
|---|---|
| 3833 Organization schema (founder, founding date, LocalBusiness) | `inc/vds-schema.php` `vds_schema_organization` |
| 3924 FAQPage schema from ACF | `inc/vds-schema.php` `vds_schema_faq` |
| 3996 page copy for templates without `the_content()` | `inc/vds-page-copy.php` `vds_render_page_copy` (home and contact print it in place) |
| 4004 Company regions, team, ecosystem | `about-tpl.php` + `template-parts/company/` |
| 4035 home team slider fallback (CSS) | obsolete: the homepage team section never rendered and is gone |
| 4050 point CTAs at the contact page (JS) | `template-parts/cta.php` links there; the header button is removed |
| 4065 article closing CTA + search scope | `inc/vds-articles.php` `vds_article_closing`, `vds_search_articles_only` |
| 4066 articles search box (JS) | `template-parts/article-search.php` (server-side) |
| 4069 podcast episode anchors (JS) | `loop/podcast.php` `id="episode-N"` + `vds.js` `podcastEpisodeHash` |
| 4070 article → episode links (JS, EP_MAP) | `single-post.php` + `vds_article_episode_url()`: post meta `vds_episode`, old map as fallback |
| 4076 articles auto-load on scroll | `js/load-more-posts.js` |
| 4077 Load More: published only | `load_more_posts_new` (`post_status` publish, clamped) |
| 4096 sticky header fix | `vds.js` `stickyHeader` |
| 4113 Solutions: book a call after an inquiry | `vds.js` `bookingAfterInquiry` |
| 4196 Company hero band | `template-parts/company/hero.php` |
| 4214 decorative shapes `alt=""` `aria-hidden` | in the templates |
| 4215 remove header search | `header.php` |
| 4226 Solutions + sitewide polish | logo alt, CTA part, `vds_schema_service`, solutions link in `vds_article_closing`, `data-vds-inquiry` buttons |
| 4228 drop stale FAQ schema | the function it unhooked is removed |
| 4231 articles `/page/N/` | `inc/vds-articles.php` |
| 4232 episode pages: players, schema | `inc/vds-podcast.php` `vds_podcast_episode_players`, `inc/vds-schema.php` `vds_schema_podcast` |
| 4233 podcast `/page/N/` | `inc/vds-podcast.php` |
| 4234 podcast search + topic pills | `inc/vds-podcast.php` `vds_podcast_search_ui` |
| 4235 transcript field + display | `inc/vds-podcast.php` `vds_podcast_transcript_field`, `vds_podcast_transcript` |
| 4236 Contact page SEO | `inc/vds-schema.php` `vds_schema_contact_webpage`, `vds_contact_og_type`, opening hours |
| 4301 301s for consolidated articles | `inc/vds-redirects.php` |
| 4312 homepage intro + 9 tiles | `template-parts/home/intro.php` |
| 4328 security headers, user enumeration | `inc/vds-security.php` |
| 4331 remove the outdated hidden team section | `about-tpl.php` doesn't print it |
| Additional CSS (post 644) | `assets/css/vds.css` |

Draft 3832 (disable comments) was never active; `inc/vds-comments.php` now does that job. Draft 3831 stays as it is.

## 4. Inventory diff

`inventory-before.txt` → `inventory-after.txt`; the names-only diff is `inventory-diff.txt` (from `tools/inventory.php`).

| Section | Before → after | What changed |
|---|---|---|
| Template headers | 14 → 11 | `case-tpl.php`, `getaquote-tpl.php`, `single-case.php` removed (no page uses them) |
| Functions | 166 → 70 | TGM classes and dead code out; 39 `vds_*` functions in (the snippets and comments-off) |
| Hooks | 69 → 55 | TGM, removed endpoints, comment-form hooks out; snippet and comments-off hooks in, with their priorities |
| Shortcodes | 11 → 6 | `post_feed`, `case_feed`, `testimonial_carousel`, `shortcode_show_team_about`, `vds_solutions` removed |
| Asset calls | 31 → 7 | Same handles, registered from one array; added `vds`, `vds-logo-font`; dropped `custom-js-jquery-1.12.4-min`, `jquery-bxslider-min`, `style-custom-font` |

Removed entries the inventory had flagged FROZEN (all intentional):
- **`vds_faq_page_schema` and its `wp_head` hook.** Removed on purpose; snippet 4228 becomes a harmless no-op.
- **`post_content`: a false positive.** The word appears in snippets only as `$post->post_content`. The theme function `post_content()` served `[post_feed]` and went with it.
- **ACF reads `description`, `position`, `hide_team`, `hide_team_section`, `image_section_action`: false positives.** In `exports/` these names appear only as array keys, an ACF group setting, and comments in snippet 4035 and the Additional CSS. The theme reads came from sections that never rendered and went with them.

New FROZEN entries (`field_66e58d8dceaa5`, `podcast_links`, `youtube_links`, `vds_transcript`, `is_page_template( 'blog-tpl.php' / 'podcast-tpl.php' )`) are the same names, now read by the theme code that replaced the snippets. They are character-identical.

## 5. Deliberately left alone

- **Vendor code.** Vendor JS/CSS in `assets/` (not reformatted), Redux (`core/options.php`), and `core/postype.php`. The `case-taxanomy` taxonomy is attached to `podcast` and stays.
- **Widget areas.** All sidebar registrations stay, because widgets may be assigned to them. `sidebar.php` is empty on purpose.
- **Shortcodes still registered:** `team_carousel`, `categories_with_count`, `showservices`, `show_Services_Home`, `show_single_service`, `shownewpost`. Their output appears on none of the crawled pages, but database content may use them. Remove them after a database search.
- **The site-wide `!important` type scale** (`main h2/h3/p` in `vds.css`). It is what visitors see today, and Rod prefers the current layout (28 Oct).
- **Vendor markup:** `loop/podcast.php` nests `the_content()` inside `<p class="sect-title">`. Browsers auto-close it, and changing it would shift spacing.
- **The `/viet-nam/` Elementor page** (database), plus WPBakery and Elementor themselves (plugins).
- **Google Fonts.** The Poppins/Saira `@import` in `main.css` was already there. Added: a Montserrat subset for the logo letters only. Removed: two unused Google Fonts links (Lato, Source Sans Pro).

## 6. Unused asset candidates (not deleted, CLAUDE.md §4.6)

195 of 286 non-PHP files are referenced nowhere in the theme, in `exports/`, or on the crawled pages. Post or Elementor content might still reference them, so search the database before removing any.

- **Vendor demo images:** `assets/img/{blog,case,team,testimonial,about,chose,faq,shipping,slider,services,icon}/`, 21 unused shapes, 9 line files.
- **Old libraries:** `assets/js/vendor/jquery-1.12.4.min.js`, `jquery-3.5.1.min.js`, `jquery-3.6.0.min.js`, `js/jquery-1.11.2.min.js`, `js/custom.js`, `js/bootstrap.js`, `js/jquery.bxslider.min.js`, `css/` (Font Awesome 4, lightbox, bxslider), `assets/js/min/`, `assets/js/plugins.js`, `assets/js/jquery.scrollUp.min.js`.
- **Leftovers:** `assets/scss/` (30 source files), `assets/fonts/demo.html` and `flaticon.html` (public vendor demo pages), `assets/css/font.css`, `animate.min.css`, `responsive.css` (both copies), `images/` (old social icons, spinners), `assets/images/knowledge-header-image*.jpg`.

## 7. Needs the database or the live server (HANDOFF)

- Pre-deploy gate (§4): removed shortcodes, deleted templates, the snippet states, function names.
- The switch (§6): snippets off and Additional CSS emptied at the same time as the theme files.
- Server deletions (§8), including the licensed plugin zips that are publicly downloadable.
- Database copy changes (§9): the Company title "No Fees", the homepage H1, the verification wording, "Southeast Asia", subtitles without "!", the FAQ retainer answer, the Discussion setting and the spam comments.
- Live tests (§7): LiteSpeed JS delay and UCSS against the inquiry and booking modals; an inquiry reaching enquiries@.

## 8. Verification done here

- **`php -l` (PHP 8.3.6)** on every PHP file: 0 errors.
- **PHPCS with PHPCompatibilityWP 2.1.8 and PHPCompatibility 10.0.0-alpha2**, `testVersion 8.3-`: 0 errors, 1 warning (`sidebar.php` is empty on purpose; the baseline had 4 such warnings).
- **Smoke render:** a stub WordPress renders 22 cases with fixture data: every page template, an article, an episode, search, 404, archive, and both AJAX endpoints. Result: 0 PHP errors, warnings or notices, and balanced tags. The podcast AJAX case reports tag issues only because its HTML is JSON-escaped (`<\/div>`).
- **Inquiry handler, simulated POSTs:** a real inquiry with a stale nonce sends (tagged) and redirects. A missing or filled honeypot sends nothing.
- **Solutions style refactor:** full-page screenshots before and after in Chromium, at 1366 and 390 px wide, of the page, the open modal and the thank-you state. They are identical apart from 1–3 anti-aliased pixels.
- **Live checks, 27 Oct:**
  - computed styles on the Solutions page, which showed the type scale overrides
  - one FAQPage and one ContactPage schema today (the smoke test expects the same)
  - `/viet-nam/` has no inline navy sections (the dark-section rule doesn't touch it)
  - `/get-a-quote/` already 301s to `/quote/`
- **Not possible here:** real WordPress, the database, or LiteSpeed. Those checks are in HANDOFF §4–§7.

## 9. Proposals (not done)

- **Replace the `!important` type scale** with a plain type system. It is a broad visual change, so test it page by page.
- **Rebuild `/viet-nam/` as a theme template and remove Elementor.** Elementor's CSS loads on every page for that one page.
- **Remove WPBakery.** No page uses `[vc_]` content.
- **Remove the six remaining vendor shortcodes and the unused assets (§6)** after a database search.
- **Give the ~40 podcast episodes their own meta descriptions** (HANDOFF §9 #12).
