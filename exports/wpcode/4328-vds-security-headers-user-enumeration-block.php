/**
 * VDS - Security headers + user-enumeration block   [v1, 26 Oct 2026]
 *
 * 1) Sends HSTS (1 year, no subdomains, no preload), nosniff, same-origin framing, referrer and permissions
 *    policies on every PHP-served response, and removes the X-Powered-By header.
 * 2) Hides the REST users list (/wp-json/wp/v2/users, ?rest_route=...) from visitors. Logged-in users are unaffected.
 * 3) Sends visitors who request ?author=N or an /author/ archive to the Articles page, so login names are not exposed.
 * Roll back: set this snippet to Inactive in WPCode, then purge LiteSpeed cache and clear the Hostinger CDN.
 */
if ( ! headers_sent() ) {
	header( 'Strict-Transport-Security: max-age=31536000' );
	header( 'X-Content-Type-Options: nosniff' );
	header( 'X-Frame-Options: SAMEORIGIN' );
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );
	header( 'Permissions-Policy: camera=(), microphone=(), geolocation=(), payment=(), usb=()' );
	header_remove( 'X-Powered-By' );
}

add_filter(
	'rest_endpoints',
	function ( $endpoints ) {
		if ( ! is_user_logged_in() ) {
			unset( $endpoints['/wp/v2/users'], $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
		}
		return $endpoints;
	}
);

add_action(
	'template_redirect',
	function () {
		if ( is_author() && ! is_user_logged_in() ) {
			wp_safe_redirect( home_url( '/vietnam-sourcing-articles/' ), 301 );
			exit;
		}
	},
	0
);
