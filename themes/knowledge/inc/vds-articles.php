<?php
/**
 * Articles: Load More on /vietnam-sourcing-articles/, crawlable /page/N/ pagination,
 * the closing CTA and solutions link on single articles, and search scoped to articles.
 *
 * Formerly functions.php (Load More) and WPCode snippets 4065, 4077, 4226 (part 2), 4231.
 */

const VDS_ARTICLES_PER_PAGE = 9;

/** Byline printed at the end of every article (one place to change the wording). */
const VDS_ARTICLE_BYLINE = 'Researched and edited by Rod Smith, Sourcing Manager, Vietnam Direct Sourcing';

/** Load More script for the Articles page grid (blog-tpl.php). */
function enqueue_load_more_scripts() {
	wp_enqueue_script( 'load-more-posts', get_template_directory_uri() . '/js/load-more-posts.js', array( 'jquery' ), null, true );
	wp_localize_script( 'load-more-posts', 'loadMoreParams', array(
		'ajaxUrl'      => admin_url( 'admin-ajax.php' ),
		'postsPerPage' => VDS_ARTICLES_PER_PAGE,
	) );
}
add_action( 'wp_enqueue_scripts', 'enqueue_load_more_scripts' );

/**
 * AJAX: the next page of article cards. Published posts only, so the pages stay in step
 * with the grid's initial (published-only) query.
 */
function load_more_posts_new() {
	$paged          = isset( $_POST['paged'] ) ? max( 1, intval( $_POST['paged'] ) ) : 1;
	$posts_per_page = isset( $_POST['postsPerPage'] ) ? min( 50, max( 1, intval( $_POST['postsPerPage'] ) ) ) : VDS_ARTICLES_PER_PAGE;

	$query = new WP_Query( array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => $posts_per_page,
		'paged'          => $paged,
	) );

	if ( ! $query->have_posts() ) {
		echo 'no more posts';
		wp_die();
	}

	while ( $query->have_posts() ) {
		$query->the_post();
		$image    = function_exists( 'get_field' ) ? get_field( 'featured_image' ) : null;
		$img_link = $image ? '<a href="' . get_permalink() . '"><img src="' . esc_url( $image['url'] ) . '" alt="' . esc_attr( $image['alt'] ) . '"></a>' : '';
		echo '<div class="col-lg-4 col-md-6">'
			. '<div class="comic-blogs-wrapper mb-30">'
			. '<div class="comic-blogs-thumb">' . $img_link . '</div>'
			. '<div class="blogs-content">'
			. '<div class="blog-meta mb-25"></div>'
			. '<div class="blog-meta-date mb-15">' . get_the_date() . '</div>'
			. '<h3 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>'
			. '</div></div></div>';
	}
	wp_reset_postdata();
	wp_die();
}
add_action( 'wp_ajax_load_more_posts_new', 'load_more_posts_new' );
add_action( 'wp_ajax_nopriv_load_more_posts_new', 'load_more_posts_new' );

/** Number of /page/N/ pages on the Articles page. */
function vds_articles_max_page() {
	return (int) ceil( wp_count_posts( 'post' )->publish / VDS_ARTICLES_PER_PAGE );
}

/** Pass /page/N/ to the grid query in blog-tpl.php (it is not the main query). */
function vds_articles_paged_query( $q ) {
	if ( is_admin() || $q->is_main_query() || ! is_page_template( 'blog-tpl.php' ) ) {
		return;
	}
	if ( $q->get( 'post_type' ) !== 'post' || (int) $q->get( 'posts_per_page' ) !== VDS_ARTICLES_PER_PAGE || $q->get( 'paged' ) ) {
		return;
	}
	$paged = (int) get_query_var( 'paged' );
	if ( $paged > 1 ) {
		$q->set( 'paged', $paged );
	}
}
add_action( 'pre_get_posts', 'vds_articles_paged_query' );

/** Self-referencing canonical on /page/N/ (Yoast). */
function vds_articles_paged_canonical( $canonical ) {
	if ( is_page_template( 'blog-tpl.php' ) ) {
		$p = (int) get_query_var( 'paged' );
		if ( $p > 1 ) {
			return trailingslashit( get_permalink() ) . 'page/' . $p . '/';
		}
	}
	return $canonical;
}
add_filter( 'wpseo_canonical', 'vds_articles_paged_canonical' );

/** Out-of-range page numbers go back to the first page. */
function vds_articles_paged_redirect() {
	if ( ! is_page_template( 'blog-tpl.php' ) ) {
		return;
	}
	$p = (int) get_query_var( 'paged' );
	if ( $p > 1 && $p > vds_articles_max_page() ) {
		wp_safe_redirect( get_permalink(), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'vds_articles_paged_redirect' );

/** Crawlable numbered page links under the grid. */
function vds_articles_pager() {
	if ( ! is_page_template( 'blog-tpl.php' ) ) {
		return;
	}
	vds_pager( vds_articles_max_page(), 'Article pages' );
}
add_action( 'get_footer', 'vds_articles_pager' );

/**
 * Numbered pager for a page template that lists posts (Articles, Podcast).
 *
 * @param int    $max   Number of pages.
 * @param string $label aria-label for the nav.
 */
function vds_pager( $max, $label ) {
	if ( $max < 2 ) {
		return;
	}
	$cur  = max( 1, (int) get_query_var( 'paged' ) );
	$base = trailingslashit( get_permalink() );
	echo '<nav class="vds-pager" aria-label="' . esc_attr( $label ) . '">';
	for ( $i = 1; $i <= $max; $i++ ) {
		if ( $i === $cur ) {
			echo '<span aria-current="page">' . $i . '</span>';
		} else {
			echo '<a href="' . esc_url( 1 === $i ? $base : $base . 'page/' . $i . '/' ) . '">' . $i . '</a>';
		}
	}
	echo '</nav>';
}

/** Single articles end with the byline, a link to the Solutions page, then the contact CTA. */
function vds_article_closing( $content ) {
	static $done = false;
	if ( is_admin() || $done || ! is_singular( 'post' ) || ! is_main_query() ) {
		return $content;
	}
	$done = true;

	$byline = '<p class="vds-byline">' . esc_html( VDS_ARTICLE_BYLINE ) . '</p>';
	$link   = '<p class="vds-solutions-link"><strong>Not sure where to start?</strong> See how our <a href="'
		. esc_url( home_url( '/global-sourcing-solutions/' ) )
		. '">Vietnam sourcing solutions</a> work, from supplier identification to quality assurance.</p>';

	ob_start();
	get_template_part( 'template-parts/cta', null, array(
		'shapes'        => false,
		'section_class' => 'pt-100 pb-120 pt-md-60 pb-lg-80 pb-md-30 pt-xs-60 pb-xs-30',
	) );

	return $content . $byline . $link . ob_get_clean();
}
add_filter( 'the_content', 'vds_article_closing', 20 );

/** Front-end search returns articles only (pages, including the gated /quote/, never appear). */
function vds_search_articles_only( $q ) {
	if ( ! is_admin() && $q->is_main_query() && $q->is_search() ) {
		$q->set( 'post_type', 'post' );
	}
}
add_action( 'pre_get_posts', 'vds_search_articles_only' );
