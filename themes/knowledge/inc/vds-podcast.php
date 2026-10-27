<?php
/**
 * Podcast: /podcast/ list (pagination, search box, topic pills) and single episode pages
 * (players, related article, transcript).
 *
 * Formerly WPCode snippets 4232 (players part), 4233, 4234, 4235. Schema is in vds-schema.php.
 */

const VDS_PODCAST_PER_PAGE = 10;

/** The ?ps= search term on /podcast/, or ''. */
function vds_podcast_search_term() {
	return isset( $_GET['ps'] ) ? trim( sanitize_text_field( wp_unslash( $_GET['ps'] ) ) ) : '';
}

/** Number of /page/N/ pages on /podcast/. */
function vds_podcast_max_page() {
	return (int) ceil( wp_count_posts( 'podcast' )->publish / VDS_PODCAST_PER_PAGE );
}

/** True on the /podcast/ list when it should show the pager and Load More (not on search views). */
function vds_podcast_is_paged_list() {
	return is_page_template( 'podcast-tpl.php' ) && vds_podcast_search_term() === '';
}

/**
 * The episode query in podcast-tpl.php (not the main query): /page/N/ paging, or the
 * ?ps= search (up to 100 matches on one page).
 */
function vds_podcast_list_query( $q ) {
	if ( is_admin() || $q->is_main_query() || ! is_page_template( 'podcast-tpl.php' ) || $q->get( 'post_type' ) !== 'podcast' ) {
		return;
	}
	$term = vds_podcast_search_term();
	if ( $term !== '' ) {
		$q->set( 's', $term );
		$q->set( 'posts_per_page', 100 );
		$q->set( 'paged', 1 );
		return;
	}
	if ( (int) $q->get( 'posts_per_page' ) !== VDS_PODCAST_PER_PAGE ) {
		return;
	}
	$paged = (int) get_query_var( 'paged' );
	if ( $paged > 1 ) {
		$q->set( 'paged', $paged );
	}
}
add_action( 'pre_get_posts', 'vds_podcast_list_query', 5 );

/** Search views are noindex; /page/N/ is self-canonical; search views canonical to /podcast/. */
function vds_podcast_robots( $robots ) {
	return ( is_page_template( 'podcast-tpl.php' ) && vds_podcast_search_term() !== '' ) ? 'noindex, follow' : $robots;
}
add_filter( 'wpseo_robots', 'vds_podcast_robots' );

function vds_podcast_canonical( $canonical ) {
	if ( ! is_page_template( 'podcast-tpl.php' ) ) {
		return $canonical;
	}
	if ( vds_podcast_search_term() !== '' ) {
		return get_permalink();
	}
	$p = (int) get_query_var( 'paged' );
	return $p > 1 ? trailingslashit( get_permalink() ) . 'page/' . $p . '/' : $canonical;
}
add_filter( 'wpseo_canonical', 'vds_podcast_canonical', 20 );

/** Out-of-range page numbers go back to the first page. */
function vds_podcast_paged_redirect() {
	if ( ! is_page_template( 'podcast-tpl.php' ) ) {
		return;
	}
	$p = (int) get_query_var( 'paged' );
	if ( $p > 1 && $p > vds_podcast_max_page() ) {
		wp_safe_redirect( get_permalink(), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'vds_podcast_paged_redirect' );

/** Crawlable numbered page links under the episode list (not on search views). */
function vds_podcast_pager() {
	if ( vds_podcast_is_paged_list() ) {
		vds_pager( vds_podcast_max_page(), 'Podcast pages' );
	}
}
add_action( 'get_footer', 'vds_podcast_pager' );

/** Search box and topic pills, printed once before the first episode. */
function vds_podcast_search_ui() {
	static $done = false;
	if ( $done || ! is_page_template( 'podcast-tpl.php' ) ) {
		return;
	}
	$done  = true;
	$term  = vds_podcast_search_term();
	$base  = trailingslashit( get_permalink() );
	$pills = array(
		'Quality'          => 'quality',
		'Logistics'        => 'logistics',
		'Trade agreements' => 'trade agreement',
		'Certification'    => 'certification',
		'Australia'        => 'Australia',
		'Packaging'        => 'packaging',
		'Textiles'         => 'textile',
		'Furniture'        => 'furniture',
		'Electronics'      => 'electronic',
		'Customs'          => 'customs',
	);
	echo '<div class="vds-podcast-filter">';
	echo '<form role="search" method="get" action="' . esc_url( $base ) . '">';
	echo '<input type="search" name="ps" value="' . esc_attr( $term ) . '" placeholder="Search episodes" aria-label="Search episodes"> ';
	echo '<button type="submit">Search</button>';
	echo '</form><div class="vds-pills">';
	foreach ( $pills as $label => $kw ) {
		$on = ( strcasecmp( $term, $kw ) === 0 );
		echo '<a href="' . esc_url( add_query_arg( 'ps', rawurlencode( $kw ), $base ) ) . '"' . ( $on ? ' class="is-active" aria-current="true"' : '' ) . '>' . esc_html( $label ) . '</a>';
	}
	echo '</div>';
	if ( $term !== '' ) {
		echo '<p class="vds-podcast-filter__status">Showing episodes matching <strong>' . esc_html( $term ) . '</strong> &middot; <a href="' . esc_url( $base ) . '">Show all episodes</a></p>';
	}
	echo '</div>';
}
add_action( 'get_template_part_loop/podcast', 'vds_podcast_search_ui' );

/** Zero search results: the loop never runs, so show the box with a message before the footer. */
function vds_podcast_no_results() {
	if ( ! is_page_template( 'podcast-tpl.php' ) || vds_podcast_search_term() === '' || did_action( 'get_template_part_loop/podcast' ) ) {
		return;
	}
	echo '<div class="container vds-podcast-empty"><p>No episodes found for <strong>' . esc_html( vds_podcast_search_term() ) . '</strong>.</p>';
	vds_podcast_search_ui();
	echo '</div>';
}
add_action( 'get_footer', 'vds_podcast_no_results', 5 );

/**
 * Single episode pages: YouTube and Spotify players, then a link to the matching article
 * (or to the newer guide its article was merged into, see vds_redirect_map).
 */
function vds_podcast_episode_players( $content ) {
	if ( ! is_singular( 'podcast' ) || ! in_the_loop() || ! is_main_query() || ! function_exists( 'get_field' ) ) {
		return $content;
	}
	$id  = get_the_ID();
	$out = '<p class="vds-ep-disclosure">AI-generated audio, produced by Vietnam Direct Sourcing from our article on this topic.</p>';
	foreach ( (array) get_field( 'youtube_links', $id ) as $row ) {
		if ( ! empty( $row['yt_iframe'] ) ) {
			$out .= '<div class="vds-ep-player vds-ep-youtube">' . $row['yt_iframe'] . '</div>';
		}
	}
	foreach ( (array) get_field( 'podcast_links', $id ) as $row ) {
		if ( ! empty( $row['iframe'] ) ) {
			$out .= '<div class="vds-ep-player vds-ep-spotify">' . $row['iframe'] . '</div>';
		}
	}

	// Podcast page ID => its original article (Ep 10, 17, 20, 25, 28). Once the article is
	// merged into a newer guide that is live, link to the guide instead.
	$merged = array( 2801 => 472, 2809 => 2683, 2812 => 2697, 3129 => 2759, 3384 => 2842 );
	$map    = (array) get_option( 'vds_redirect_map', array() );
	$new_id = ( isset( $merged[ $id ] ) && isset( $map[ $merged[ $id ] ] ) ) ? (int) $map[ $merged[ $id ] ] : 0;
	if ( $new_id && 'publish' === get_post_status( $new_id ) ) {
		return $content . $out . '<p class="vds-ep-article"><strong>Updated guide:</strong> <a href="' . esc_url( get_permalink( $new_id ) ) . '">' . esc_html( get_the_title( $new_id ) ) . '</a></p>';
	}

	// Otherwise the article with the same title as the episode (minus "Episode N –").
	$title = trim( preg_replace( '/^Episode\s*\d+\s*[\x{2013}\x{2014}-]\s*/u', '', get_the_title( $id ) ) );
	if ( $title !== '' ) {
		$q = new WP_Query( array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 20, 's' => $title, 'no_found_rows' => true ) );
		foreach ( $q->posts as $p ) {
			if ( html_entity_decode( get_the_title( $p ), ENT_QUOTES ) === html_entity_decode( $title, ENT_QUOTES ) ) {
				$out .= '<p class="vds-ep-article"><strong>Read the article:</strong> <a href="' . esc_url( get_permalink( $p ) ) . '">' . esc_html( get_the_title( $p ) ) . '</a></p>';
				break;
			}
		}
	}
	return $content . $out;
}
add_filter( 'the_content', 'vds_podcast_episode_players', 20 );

/** ACF field for the episode transcript (plain text; "## " starts a subheading). */
function vds_podcast_transcript_field() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	acf_add_local_field_group( array(
		'key'      => 'group_vds_transcript',
		'title'    => 'Episode transcript',
		'fields'   => array(
			array(
				'key'          => 'field_vds_transcript',
				'label'        => 'Transcript',
				'name'         => 'vds_transcript',
				'type'         => 'textarea',
				'rows'         => 20,
				'new_lines'    => '',
				'instructions' => 'Plain text. Start a line with "## " for a subheading. Separate paragraphs with a blank line.',
			),
		),
		'location' => array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'podcast' ) ) ),
		'position' => 'normal',
	) );
}
add_action( 'acf/init', 'vds_podcast_transcript_field' );

/** Single episode pages: the transcript, collapsed under "Read the full transcript". */
function vds_podcast_transcript( $content ) {
	if ( ! is_singular( 'podcast' ) || ! in_the_loop() || ! is_main_query() || ! function_exists( 'get_field' ) ) {
		return $content;
	}
	$raw = trim( (string) get_field( 'vds_transcript', get_the_ID(), false ) );
	if ( $raw === '' ) {
		return $content;
	}
	$html = '';
	foreach ( preg_split( '/\R{2,}/', $raw ) as $block ) {
		$block = trim( $block );
		if ( $block === '' ) {
			continue;
		}
		$html .= strpos( $block, '## ' ) === 0
			? '<h3>' . esc_html( substr( $block, 3 ) ) . '</h3>'
			: '<p>' . esc_html( $block ) . '</p>';
	}
	return $content
		. '<details class="vds-transcript"><summary>Read the full transcript</summary>'
		. '<p class="vds-transcript__note"><em>This episode is AI-generated audio. The transcript has been lightly edited for readability.</em></p>'
		. $html . '</details>';
}
add_filter( 'the_content', 'vds_podcast_transcript', 25 );

/**
 * Episode number of an article (articles and episodes pair 1:1). The post meta
 * 'vds_episode' wins; the map covers the articles published before that meta existed
 * (formerly EP_MAP in WPCode snippet 4070).
 */
function vds_article_episode( $post_id ) {
	$meta = (int) get_post_meta( $post_id, 'vds_episode', true );
	if ( $meta ) {
		return $meta;
	}
	static $map = array(
		970 => 1, 478 => 2, 683 => 3, 987 => 4, 1004 => 5, 1025 => 6, 1052 => 7, 1366 => 8, 1731 => 9,
		472 => 10, 1879 => 11, 1044 => 12, 2100 => 13, 2096 => 14, 2672 => 15, 2677 => 16, 2683 => 17,
		2687 => 18, 2691 => 19, 2697 => 20, 2737 => 21, 2745 => 22, 2751 => 23, 2755 => 24, 2759 => 25,
		2763 => 26, 2837 => 27, 2842 => 28, 2848 => 29, 2853 => 30, 2858 => 31, 3177 => 32, 3185 => 33,
		3192 => 34, 3208 => 35, 3219 => 36, 3236 => 37, 3242 => 38, 3258 => 39, 3266 => 40, 3290 => 41,
		3314 => 42, 3329 => 43, 3341 => 44, 3354 => 45, 3372 => 46, 3720 => 47, 3721 => 48, 3722 => 49,
		3905 => 50, 3912 => 51, 4027 => 52, 4036 => 53, 4038 => 54, 4140 => 55, 4158 => 56, 4184 => 57,
		4287 => 58, 4293 => 59, 4298 => 60,
	);
	return $map[ $post_id ] ?? 0;
}

/** Link from an article to its episode on the /podcast/ page, or '' when it has none. */
function vds_article_episode_url( $post_id ) {
	$ep = vds_article_episode( $post_id );
	return $ep ? home_url( '/podcast/#episode-' . $ep ) : '';
}
