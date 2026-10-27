/**
 * VDS - Render page copy on templates that drop the_content()   [v2, 9 Sep 2026]
 *
 * v2 renders the copy as a proper theme section instead of a bare wrapper:
 * theme section padding, sky-blue-bg + round-background alternation, the leading
 * h2 promoted to a centred .section-title, an 800px measure, and real paragraph
 * spacing (the theme sets p{margin-bottom:0}, which is why paragraphs ran together).
 * Reversible: toggle this snippet Inactive.
 */

add_action( 'get_footer', function () {

	// Never in the admin, and only on pages.
	if ( is_admin() || ! is_page() ) {
		return;
	}

	// Belt and braces: only ever print once per request.
	static $already_printed = false;
	if ( $already_printed ) {
		return;
	}

	// The six templates that don't call the_content().
	$templates = array(
		'home-tpl.php',
		'about-tpl.php',
		'blog-tpl.php',
		'contact-tpl.php',
		'faq-tpl.php',
		'team-tpl.php',
	);

	$page_id = get_queried_object_id();
	if ( ! $page_id ) {
		return;
	}

	if ( ! in_array( get_page_template_slug( $page_id ), $templates, true ) ) {
		return;
	}

	$content = get_post_field( 'post_content', $page_id );

	// Nothing to show if the page has no real copy.
	if ( '' === trim( wp_strip_all_tags( $content ) ) ) {
		return;
	}

	$already_printed = true;

	$html = apply_filters( 'the_content', $content );

	// If the copy opens with an h2, lift it out and use it as the section title.
	$title = '';
	if ( preg_match( '#^\s*<h2[^>]*>(.*?)</h2>#is', $html, $m ) ) {
		$title = $m[1];
		$html  = preg_replace( '#^\s*<h2[^>]*>.*?</h2>#is', '', $html, 1 );
	}

	$style = '<style>'
		. '.vds-page-copy .vds-copy-body p{margin-bottom:22px}'
		. '.vds-page-copy .vds-copy-body p:last-child{margin-bottom:0}'
		. '.vds-page-copy .vds-copy-body h2{font-size:30px;line-height:34px;margin:50px 0 16px}'
		. '.vds-page-copy .vds-copy-body h3{font-size:24px;line-height:28px;margin:38px 0 14px}'
		. '.vds-page-copy .vds-copy-body h4{font-size:20px;line-height:26px;margin:32px 0 12px}'
		. '.vds-page-copy .vds-copy-body>*:first-child{margin-top:0}'
		. '.vds-page-copy .vds-copy-body ul,.vds-page-copy .vds-copy-body ol{margin:0 0 22px 20px}'
		. '.vds-page-copy .vds-copy-body li{margin-bottom:8px}'
		. '.vds-page-copy .vds-copy-body img{height:auto;border-radius:8px}'
		. '@media(max-width:767px){.vds-page-copy .vds-copy-body h2{font-size:26px;line-height:30px;margin:36px 0 14px}}'
		. '</style>';

	$out  = $style;
	$out .= '<section class="vds-page-copy sky-blue-bg round-background'
		. ' pt-120 pb-110 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">';
	$out .= '<div class="container"><div class="row justify-content-center">';
	$out .= '<div class="col-xl-8 col-lg-10">';

	if ( '' !== $title ) {
		$out .= '<div class="section-title text-center mb-50">'
			. '<h2>' . wp_kses_post( $title ) . '</h2>'
			. '</div>';
	}

	$out .= '<div class="vds-copy-body">' . $html . '</div>';
	$out .= '</div></div></div></section>';

	echo $out;
} );