# HANDOFF: deploy branch `cleanup/themes-2026-10`

For Rod's local Claude Code session (the one with SSH and WP-CLI). Written by the cloud session, 27 Oct 2026.
What changed and why: `CLEANUP-REPORT.md`. Baseline: commit `e367117` (the live theme on 27 Oct).

## 0. What this deploy is

Rod decided on 27 Oct to have **one clean code base**. Everything the 29 active WPCode snippets and the Customizer's Additional CSS did now lives in the theme (`inc/vds-*.php`, `template-parts/`, `assets/css/vds.css`, `assets/js/vds.js`). The go-live is therefore a **switch**: three things must happen within minutes of each other.
1. The new theme files go live.
2. The 29 snippets are deactivated.
3. The Additional CSS is emptied.

If the snippets or the CSS stay on after the theme is live, visitors get:
- duplicated sections and schema
- a doubled logo
- Company page sections re-ordered by old CSS

The theme changes no URL, Yoast title, meta description, canonical or robots setting. The copy edits in §9 are database changes, made separately.

## 1. Update your local CLAUDE.md first

Rod's decisions of 27 Oct replace these rules in your notes:

| Old rule in your notes | New rule |
|---|---|
| "Parent theme is knowledge: do NOT edit it; use child theme/snippets/Additional CSS" | The `knowledge` theme is VDS's own code base. Edit it in the repo `VDSAgent/vietnam-directsourcing.com`, then deploy the changed files. **Never update it from ThemeForest/Envato or the WordPress updater**: that would overwrite it. |
| "New custom PHP/JS goes in a WPCode snippet" | PHP goes in `inc/vds-*.php` (required from `functions.php`), CSS in `assets/css/vds.css`, JS in `assets/js/vds.js`. No new WPCode snippets and no Additional CSS. |
| "Article ends 'Source: Written by Rod Smith, Vietnam Direct Sourcing'" | The theme prints the byline on every article: `VDS_ARTICLE_BYLINE` in `inc/vds-articles.php`, which reads "Researched and edited by Rod Smith, Sourcing Manager, Vietnam Direct Sourcing". Don't put it in article bodies. Remove it from `publish_article.py` and the Article Playbook, and remove the 2 manual bylines (§9). |
| "add `4184:57` to EP_MAP in snippet 4070" | Article-to-episode links come from post meta: `wp post meta update <article_id> vds_episode <N>`. `podcast_entry.py` should set it. The old map is the fallback in `vds_article_episode()` (`inc/vds-podcast.php`). |
| Snippet IDs named in the notes (3833, 3996, 4004, 4065, 4070, 4096, 4312, 4328 …) | Retired after go-live. CLEANUP-REPORT §3 says which theme file holds each one. |
| (new) | The Solutions inquiry form now emails **enquiries@** (it emailed contactus@). |

## 2. Get the files

```
git clone -b cleanup/themes-2026-10 https://github.com/VDSAgent/vietnam-directsourcing.com.git vds-cleanup
```

The repo is a code-only subset: no fonts, images or plugin zips. Deploying means copying the files listed in `deploy/changed-files.txt` (45 paths, relative to the theme folder). **Never mirror the folder** (`rsync --delete` or similar): that would delete fonts and images on the server.

## 3. Backups (staging and live, before anything else)

```
# Database: mysqldump per your Safety routine (wp db export fails on this host)
#   -> ~/backups/pre-theme-switch-<date>.sql
tar czf ~/backups/knowledge-pre-switch-$(date +%F-%H%M).tgz -C <root>/wp-content/themes knowledge
wp post get 644 --field=post_content > ~/backups/additional-css-644-pre-switch.css
wp post list --post_type=wpcode --fields=ID,post_status,post_title --format=csv > ~/backups/wpcode-states-pre-switch.csv
```

## 4. Pre-deploy gate (read-only)

Put the repo where WP-CLI can read it, then run:

```
wp eval-file vds-cleanup/deploy/predeploy-check.php vds-cleanup/themes/knowledge
```

The script writes nothing. It checks that:
- the 5 shortcodes the branch removes appear nowhere in content, post meta or widgets
- no page uses a deleted template
- exactly the expected 29 snippets are active, and none was edited after 27 Oct
- no function name is declared by both an active snippet and the new theme (that would be a "Cannot redeclare" white screen)
- the Additional CSS is post 644
- ACF is active

**Any STOP line: don't deploy; tell Rod.**

## 5. Staging first

Use Hostinger staging (hPanel → WordPress → Staging) or a local copy. Run §3, §4, §6 and §7 there.

**Never use "push staging to live".** Staging is set to discourage search engines, and pushing it can carry that setting live. Going live means repeating §3, §4 and §6 on the live site.

## 6. The switch (about 5 minutes)

Do it on live between 1 pm and 7 pm Da Nang time, after Sydney closes and before the US East Coast opens.

**1. Copy the theme files**

```
rsync -av --files-from=vds-cleanup/deploy/changed-files.txt \
  vds-cleanup/themes/knowledge/ <ssh-host>:<root>/wp-content/themes/knowledge/
```

New folders: `inc/`, `template-parts/company/`, `template-parts/home/`.

**2. Deactivate the 29 snippets**

Do this straight after step 1. Until then the old snippets and the new theme both run, which duplicates output but cannot fatal (§4 checked for name clashes).

First confirm the method names in the installed WPCode version:

```
grep -rn "function deactivate\|function cache_all_loaded_snippets" <root>/wp-content/plugins/insert-headers-and-footers/includes/
```

Then:

```
wp eval 'foreach ( array( 3833,3924,3996,4004,4035,4050,4065,4066,4069,4070,4076,4077,4096,4113,4196,
  4214,4215,4226,4228,4231,4232,4233,4234,4235,4236,4301,4312,4328,4331 ) as $id ) {
  ( new WPCode_Snippet( $id ) )->deactivate(); }
  wpcode()->cache->cache_all_loaded_snippets();'
wp post list --post_type=wpcode --post_status=publish --field=ID    # must print nothing
```

If the methods differ, use WP admin instead: Code Snippets → tick the 29 → Bulk actions → Deactivate.

Deactivate only; don't delete them. Rollback needs them. Delete them after 2 stable weeks.

**3. Empty the Additional CSS**

```
wp post update 644 --post_content=''
```

**4. Purge the caches**

- Run `wp litespeed-purge all`.
- LiteSpeed Toolbox → Purge All, including CSS/JS (and UCSS/CCSS if they are on).
- Flush the Hostinger CDN.

**5. Run the smoke test**

```
bash vds-cleanup/deploy/smoke-test.sh
```

It should print PASS on every line. It uses curl only and never requests the stray scripts.

**Rollback** (any blocker, about 5 minutes):
1. Restore the theme tgz.
2. Re-activate the 29 with the same loop, using `->activate()`.
3. Restore the CSS: `wp post update 644 ~/backups/additional-css-644-pre-switch.css`.
4. Purge the caches.

## 7. Checks after the switch

Run these on staging, then on live. Check logged out, in a private window, on both phone and desktop.

- **Home:**
  - the logo is white over the hero and turns navy when the header sticks
  - no loading spinner
  - the intro shows its 9 tiles
  - the video plays
  - the CTA button goes to the contact page
- **Company:** the sections appear in this order: title, hero band, regions map, team, how we work, ecosystem, CTA.
- **Solutions:**
  - prices are visible
  - every "… →" button opens the inquiry modal **on the first tap**. LiteSpeed delays JS until the first interaction; if the first tap does nothing, add `assets/js/vds.js` to LiteSpeed → Page Optimization → JS Delayed Excludes.
  - a test inquiry reaches **enquiries@** (and Odoo CRM) with the subject "VDS Inquiry: …", and the page then shows the thank-you bar and the booking modal
  - if LiteSpeed UCSS is on: the booking modal is built by JS, so add `.vds-booking-modal` and `#vds-inquiry-modal` to the UCSS selector allowlist, or it will appear unstyled
- **Contact:** the page copy sits above the addresses, and the Odoo booking embed loads.
- **FAQ:** the accordion works, and the Rich Results Test shows one FAQ.
- **Articles:**
  - more cards load as you scroll
  - `/vietnam-sourcing-articles/page/2/` works
  - the search box works
  - an article ends with the byline, then the solutions link, then the CTA
  - its podcast box links to `/podcast/#episode-N`
- **Podcast:**
  - the new H1 shows
  - search works, and `/podcast/page/2/` works
  - an `#episode-N` link scrolls to that episode
  - an episode page shows the AI disclosure, the players and the transcript
- **Rich Results Test:**
  - home: Organization / LocalBusiness
  - Solutions: Service
  - Contact: ContactPage
  - an episode: PodcastEpisode
- **Regression snapshots:** compare against your `site_audit.py` baseline of 26 Oct.
  - Expected differences: only those listed in CLEANUP-REPORT §2 (podcast H1/subtitle, 404 text, removed hidden markup, byline, disclosure, the copy changes in theme files).
  - Titles, descriptions, canonicals and robots must not change.
- **Search Console:** request indexing for the home, Solutions, Company and Podcast pages.

## 8. Server deletions (after the switch is stable)

Move each item to `~/quarantine-2026-10-27/` first, and delete after 2 weeks. **Never open these in a browser or with curl**: the stray scripts write to the database on any request. Verify each removal with `ls`.

- In the theme root: `el_apply_v2.php`, `el_v3.php`, `upload_test.php`, `find_video.php`, `footer.php.bak-20260712`.
- Every path in `deploy/deleted-files.txt` (16 files, relative to the theme). `assets/mail.php` is among them: the vendor demo mailer that emails the theme author.
- `wp-content/themes/salient-child/`: an orphan child theme of a theme that isn't installed (21 MB).
- `wp-content/themes.1475/`: a leftover copy of the themes folder.
- `wp-content/themes/knowledge/plugin/*.zip`: the bundled ACF Pro and WPBakery installers. They are licensed, publicly downloadable, and nothing uses them now that TGM is gone. Keep a copy outside the web root.

Do **not** delete assets, images or fonts. CLEANUP-REPORT §6 lists the unused candidates; database content may reference them.

## 9. Database copy changes (after go-live, one at a time, backup first)

From the brand review and Rod's decisions of 26–27 Oct. US spelling throughout. These keep the SEO titles and URLs; #1 changes one word in a Yoast title.

| # | Page (ID) | Stored in | Before | After |
|---|---|---|---|---|
| 1 | Company (16) | Yoast title `_yoast_wpseo_title` | Vietnam Sourcing Company \| Direct Factory Access, No Fees | Vietnam Sourcing Company \| Direct Factory Access, No Commission |
| 2 | Home (11) | ACF `heading_small_banner_home` (the H1) | Global Sourcing Solutions from Vietnam | Vietnam Sourcing for Importers |
| 3 | Home (11) | ACF `heading_big_banner_home` | Your Sourcing Partner in Vietnam! | Named Factories, Real Numbers, Someone on the Ground |
| 4 | Home (11) | page content (the theme prints it) | …we build a shortlist from Vietnam’s 105,000+ factories, verify each one in person, and send you a supplier report covering capability, capacity, certifications and indicative pricing. | …we build a shortlist from Vietnam’s 105,000+ factories and send you a supplier report covering capability, capacity, certifications on record and indicative pricing. When you are ready to commit, Supplier Evaluation audits your shortlisted factories in person. |
| 5 | Home (11) | page content | There is no retainer and no commission on factory pricing | There is no retainer required and no commission on factory pricing |
| 6 | Home (11) | ACF `col_manage_left` (stats) | No. 2 / Exporter / In South East Asia · 17 % / Growth / In 2025 · 105,000 + / Factories / In Vietnam | No. 2 / Exporter / in Southeast Asia · 17% / Export growth / in 2025 · 105,000+ / Factories / in Vietnam. Link each to the footnoted source on `/viet-nam/`, but check the 17% figure is sourced there first. |
| 7 | Solutions (13) | ACF `heading_small_banner_services` | Set Fees and Pay-Per-Use Options! | Flat Fees, Pay-As-You-Go |
| 8 | Contact (21) | ACF `sub_title_contact` | Let’s talk about sourcing! | Let’s Talk About Sourcing |
| 9 | FAQ (1296) | ACF repeater `list_questions` (`field_66e58d8dceaa5`), retainer answer | Pay-as-you-go — no retainer, no commission. | Pay-as-you-go, with no retainer required and no commission. An optional monthly plan is available for clients shipping regularly. |
| 10 | Contact (21) | ACF `description_infor_left` | Đà Nẵng, Da Nang 550000 | Da Nang 550000, Vietnam |
| 11 | 2 articles | post content | manual "Source: Written by Rod Smith…" line | remove it (the theme prints the byline) |
| 12 | ~40 podcast episodes | Yoast meta description | identical to the paired article | write a distinct description (optional, later) |

The FAQ schema is generated from the repeater (`vds_schema_faq`), so #9 updates the schema as well. Also check the footer and contact social icons: alt text should name the network, and the Twitter bird should become the X mark if the icon comes from widget or ACF content.

## 10. Decisions for Rod (not blocking the deploy)

- **Comments:** 51 articles show a comment form (snippet 3832 "Completely Disable Comments" is a draft). Recommendation, no code needed: Settings → Discussion → off for new posts, then close comments on existing ones with `wp post list --post_type=post --format=ids | xargs -n50 wp post update --comment_status=closed`.
- **Team roles:** Telly, Tam, Cassie and Kim have no role on the Company page (`template-parts/company/team.php`). Rod to supply them.
- **Solutions eyebrows** ("STEP 01", "TIER A" …): they were designed as small gold labels but render as 16 px body text, because the site-wide type scale overrides them. Restoring the design is one CSS rule, and it is a visible change.
- **B3 measurement:** inquiries sent from a stale cached page now arrive with "(sent from an older cached page)" in the subject. Count them for a month. If they're common, consider a shorter LiteSpeed TTL for `/global-sourcing-solutions/`.
