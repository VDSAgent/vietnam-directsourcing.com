<?php
/**
 * 301 redirects for consolidated articles.
 *
 * When thin articles are merged into one stronger article, the old URLs 301 to the new one.
 * The map is the option `vds_redirect_map` (old post ID => new post ID), so a future
 * consolidation is an option update, not a code change. A redirect only starts once the
 * NEW post is published (safe to set in advance for a scheduled replacement); when it
 * publishes, the old URLs are purged from LiteSpeed. Formerly WPCode snippet 4301.
 */

function vds_consolidated_redirect() {
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
}
add_action( 'template_redirect', 'vds_consolidated_redirect', 1 );

function vds_consolidated_purge( $new, $old, $post ) {
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
}
add_action( 'transition_post_status', 'vds_consolidated_purge', 10, 3 );
