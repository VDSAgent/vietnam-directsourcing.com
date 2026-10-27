<?php
/**
 * Comments are off site-wide (Rod, 28 Oct 2026: every comment was spam).
 *
 * Closed for posting (wp-comments-post.php refuses), existing comments hidden and counted
 * as zero, so no template, feed or schema shows them; the admin screens go too.
 * Replaces the never-activated WPCode draft 3832.
 */

add_filter( 'comments_open', '__return_false', 20 );
add_filter( 'pings_open', '__return_false', 20 );
add_filter( 'comments_array', '__return_empty_array', 20 );
add_filter( 'get_comments_number', '__return_zero', 20 );

/** Admin: no comment support on any post type, no Comments screen or dashboard box. */
function vds_comments_admin() {
	global $pagenow;
	if ( 'edit-comments.php' === $pagenow ) {
		wp_safe_redirect( admin_url() );
		exit;
	}
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	foreach ( get_post_types() as $post_type ) {
		if ( post_type_supports( $post_type, 'comments' ) ) {
			remove_post_type_support( $post_type, 'comments' );
			remove_post_type_support( $post_type, 'trackbacks' );
		}
	}
}
add_action( 'admin_init', 'vds_comments_admin' );

function vds_comments_admin_menu() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'vds_comments_admin_menu' );

function vds_comments_admin_bar() {
	remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
}
add_action( 'init', 'vds_comments_admin_bar' );
