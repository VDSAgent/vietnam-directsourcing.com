<?php
/**
 * Security headers and user-enumeration block. Formerly WPCode snippet 4328.
 *
 * 1) HSTS (1 year, no subdomains, no preload), nosniff, same-origin framing, referrer and
 *    permissions policies on every PHP-served response; X-Powered-By removed.
 * 2) The REST users list (/wp-json/wp/v2/users, ?rest_route=...) is hidden from visitors.
 * 3) ?author=N and /author/ archives send visitors to the Articles page, so login names
 *    are not exposed. Logged-in users are unaffected.
 */

function vds_security_headers() {
	if ( headers_sent() ) {
		return;
	}
	header( 'Strict-Transport-Security: max-age=31536000' );
	header( 'X-Content-Type-Options: nosniff' );
	header( 'X-Frame-Options: SAMEORIGIN' );
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );
	header( 'Permissions-Policy: camera=(), microphone=(), geolocation=(), payment=(), usb=()' );
	header_remove( 'X-Powered-By' );
}
add_action( 'after_setup_theme', 'vds_security_headers', 0 );

function vds_hide_rest_users( $endpoints ) {
	if ( ! is_user_logged_in() ) {
		unset( $endpoints['/wp/v2/users'], $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
	}
	return $endpoints;
}
add_filter( 'rest_endpoints', 'vds_hide_rest_users' );

function vds_block_author_archives() {
	if ( is_author() && ! is_user_logged_in() ) {
		wp_safe_redirect( home_url( '/vietnam-sourcing-articles/' ), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'vds_block_author_archives', 0 );
