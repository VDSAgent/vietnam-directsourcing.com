#!/usr/bin/env bash
# Post-switch smoke test for branch cleanup/themes-2026-10 (read-only, curl only).
# Usage: bash smoke-test.sh [https://vietnam-directsourcing.com]
# Run right after the switch and the cache purge. Every line should say PASS.

BASE="${1:-https://vietnam-directsourcing.com}"
UA="Mozilla/5.0 (VDS smoke test)"
FAIL=0
TMP="$(mktemp -d)"

get() { curl -s -A "$UA" -o "$TMP/$1.html" -D "$TMP/$1.hdr" -w '%{http_code}' "$BASE$2"; }
pass() { echo "PASS  $1"; }
fail() { echo "FAIL  $1"; FAIL=$((FAIL + 1)); }
has() { grep -q -- "$3" "$TMP/$1.html" && pass "$2" || fail "$2"; }
hasnt() { grep -q -- "$3" "$TMP/$1.html" && fail "$2" || pass "$2"; }
count() { local n; n=$(grep -o -- "$3" "$TMP/$1.html" | wc -l); [ "$n" -eq "$4" ] && pass "$2 ($n)" || fail "$2 (found $n, want $4)"; }

declare -A PAGES=(
	[home]=/
	[company]=/vietnam-sourcing-company/
	[solutions]=/global-sourcing-solutions/
	[contact]=/contact-for-sourcing/
	[faq]=/vietnam-sourcing-faqs/
	[articles]=/vietnam-sourcing-articles/
	[articles2]=/vietnam-sourcing-articles/page/2/
	[podcast]=/podcast/
	[podcast2]=/podcast/page/2/
	[article]=/aanzfta-duty-free-with-vietnam/
	[episode]=/Podcast/aanzfta-duty-free-with-vietnam/
	[vietnam]=/viet-nam/
	[privacy]=/privacy-policy/
)
for k in "${!PAGES[@]}"; do
	code=$(get "$k" "${PAGES[$k]}")
	[ "$code" = "200" ] && pass "$k ${PAGES[$k]} -> 200" || fail "$k ${PAGES[$k]} -> $code"
done

# One code base: theme assets in, old patches out.
for k in home solutions article; do
	has "$k" "$k loads assets/css/vds.css" 'assets/css/vds.css'
	has "$k" "$k loads assets/js/vds.js" 'assets/js/vds.js'
	hasnt "$k" "$k has no Additional CSS block (wp-custom-css)" 'id="wp-custom-css"'
	hasnt "$k" "$k has no preloader" 'id="preloader"'
	hasnt "$k" "$k has no jQuery 1.12.4" 'jquery-1.12.4'
done
has home "inline SVG logo" 'class="vds-logo"'
count home "homepage intro section once" 'class=.vds-intro-area' 1
count article "one CTA banner on an article" 'class="call-to-action' 1
count article "one byline" 'class="vds-byline"' 1
hasnt article "no author slug in the page" 'blog-author-img'
count faq "one FAQPage schema" '"FAQPage"' 1
count contact "one ContactPage schema" '"ContactPage"' 1
has solutions "inquiry modal with honeypot" 'name="vds_hp"'
has solutions "prices shown" 'US\$750'
has podcast "podcast H1" 'Sourcing From Vietnam: The VDS Podcast'
has episode "episode AI disclosure" 'vds-ep-disclosure'
has articles2 "articles page 2 self-canonical" 'rel="canonical" href="[^"]*/vietnam-sourcing-articles/page/2/"'

# Security headers and user enumeration.
for h in 'strict-transport-security' 'x-content-type-options' 'x-frame-options' 'referrer-policy'; do
	grep -qi "^$h:" "$TMP/home.hdr" && pass "header $h" || fail "header $h"
done
code=$(curl -s -A "$UA" -o /dev/null -w '%{http_code}' "$BASE/wp-json/wp/v2/users")
[ "$code" != "200" ] && pass "REST users endpoint blocked ($code)" || fail "REST users endpoint answers 200"
code=$(curl -s -A "$UA" -o /dev/null -w '%{http_code}' "$BASE/?author=1")
[ "$code" != "200" ] && pass "author archive blocked ($code)" || fail "author archive answers 200"

# Never request the stray scripts (el_apply_v2.php, el_v3.php, upload_test.php,
# find_video.php) or assets/mail.php over HTTP: if they are still there, any request
# runs them and they write to the database or send mail. Check them with ls over SSH.

rm -rf "$TMP"
echo
[ "$FAIL" -eq 0 ] && echo "All checks passed." || { echo "$FAIL check(s) failed."; exit 1; }
