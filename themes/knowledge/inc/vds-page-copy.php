<?php
/**
 * Page body copy on the six page templates that never call the_content()
 * (home, about, blog, contact, faq, team): printed as a theme section before the footer.
 * Styles: "Page copy" in assets/css/vds.css. Formerly WPCode snippet 3996.
 */

function vds_render_page_copy() {
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


	$out  = '<section class="vds-page-copy sky-blue-bg round-background'
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
}
add_action( 'get_footer', 'vds_render_page_copy' );
