<?php
/**
 * Main Theme functions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Knowledge
 */

if ( ! function_exists( 'knowledge_time_link' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function knowledge_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date( 'M j, Y' ),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	// Wrap the time string in a link, and preface it with 'Posted on'.
	return sprintf(
		/* translators: %s: post date */
		__( '<span class="date-label screen-reader-text">Posted on </span>%s', 'knowledge' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
}
endif;

if ( ! function_exists( 'knowledge_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function knowledge_posted_by() {

	// Get the author name; wrap it in a link.
	$byline = sprintf(
		/* translators: %s: post author */
		__( '<span class="author-label">By </span>%s', 'knowledge' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
	);

	// Finally, let's write all of this to the page.
	echo '<span class="byline"> ' . $byline . '</span>';
}
endif;

if ( ! function_exists( 'knowledge_edit_link' ) ) :
	/**
	 * Returns an accessibility-friendly link to edit a post or page.
	 *
	 * This also gives us a little context about what exactly we're editing
	 * (post or page?) so that users understand a bit more where they are in terms
	 * of the template hierarchy and their content. Helpful when/if the single-page
	 * layout with multiple posts/pages shown gets confusing.
	 */
	function knowledge_edit_link() {
		edit_post_link(
			sprintf(
				/* translators: %s: Post title. */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'knowledge' ),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;


if ( ! function_exists( 'knowledge_single_tags' ) ) :
	/**
	 * Prints HTML with meta information for the tags,
	 */
	function knowledge_single_tags() {
		$options = busyness_get_theme_options();
		// Hide tag text for single.
		if ( 'post' === get_post_type() ) {
			if ( ! $options['single_post_hide_tags'] ) :
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'knowledge' ) );

				if ( $tags_list ) {
					echo '<span class="tags-links"><span class="tags-label">' . esc_html__( 'Tags: ', 'knowledge' ) . '</span>' . $tags_list . '</span>';
				}
			endif;
		}
	}
endif;


if ( ! function_exists( 'knowledge_archive_categories' ) ) :
	/**
	 * Prints HTML with meta information for the categories,
	 */
	function knowledge_archive_categories() {
		$options = busyness_get_theme_options();
		// Hide category for single.
		if ( 'post' === get_post_type() ) {
			if ( ! $options['hide_category'] ) :
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'knowledge' ) );
				if ( $categories_list && busyness_categorized_blog() ) {
					echo '<span class="cat-links"><span class="categories-label">' . esc_html__( 'Categories: ', 'knowledge' ) . '</span>' . $categories_list . '</span>';
				}
			endif;
		}

	}
endif;
