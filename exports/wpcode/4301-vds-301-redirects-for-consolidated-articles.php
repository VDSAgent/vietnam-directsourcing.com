/**
 * VDS - 301 redirects for consolidated articles   [v1, 26 Oct 2026]
 *
 * When several thin articles are merged into one stronger article (see the Article Playbook),
 * the old URLs must 301 to the new one. The map lives in the option `vds_redirect_map`
 * (old post ID => new post ID), so a future consolidation is a one-line option update, not a code edit.
 * A redirect only starts once the NEW post is published, so it is safe to set the map in advance
 * for a scheduled replacement. When a replacement publishes, the old URLs are purged from LiteSpeed.
 * Reversible: toggle this snippet Inactive, or delete an entry from the option.
 */

add_action( 'template_redirect', function () {
	if ( is_admin() || is_preview() || ! is_singular( 'post' ) ) {
		return;
	}
	$map = get_option( 'vds_redirect_map', array() );
	if ( ! is_array( $map ) || ! $map ) {
		return;
	}
	$id = get_queried_object_id();
	if ( ! $id || empty( $map[ $id ] ) ) {
		return;
	}
	$to = (int) $map[ $id ];
	if ( 'publish' !== get_post_status( $to ) ) {
		return;
	}
	$url = get_permalink( $to );
	if ( $url ) {
		wp_safe_redirect( $url, 301 );
		exit;
	}
}, 1 );

add_action( 'transition_post_status', function ( $new, $old, $post ) {
	if ( 'publish' !== $new || 'publish' === $old ) {
		return;
	}
	$map = get_option( 'vds_redirect_map', array() );
	if ( ! is_array( $map ) ) {
		return;
	}
	foreach ( $map as $from => $to ) {
		if ( (int) $to === (int) $post->ID ) {
			do_action( 'litespeed_purge_post', (int) $from );
		}
	}
}, 10, 3 );
