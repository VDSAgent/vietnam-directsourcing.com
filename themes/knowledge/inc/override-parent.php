<?php
/**
 * Override parent functions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Knowledge
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * Overwriting parent theme custom header
 */
function busyness_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'busyness_custom_header_args', array(
		'default-image'          => get_stylesheet_directory_uri() . '/assets/images/knowledge-header-image.jpg',
		'default-text-color'     => 'fff',
		'width'                  => 1920,
		'height'                 => 960,
		'flex-height'            => true,
		'wp-head-callback'       => 'busyness_header_style',
	) ) );

	register_default_headers( array(
		'default-image' => array(
			'url'           => get_stylesheet_directory_uri() . '/assets/images/knowledge-header-image.jpg',
			'thumbnail_url' => get_stylesheet_directory_uri() . '/assets/images/knowledge-header-image-thumbnail.jpg',
			'description'   => esc_html__( 'Default Header Image', 'knowledge' ),
		),
		'busyness-default-image' => array(
			'url'           => '%s/assets/images/header-image.jpg',
			'thumbnail_url' => '%s/assets/images/header-image-thumbnail.jpg',
			'description'   => esc_html__( 'Busyness Default Header Image', 'knowledge' ),
		),
	) );
}

if ( ! function_exists( 'busyness_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function busyness_posted_on() {
	// Finally, let's write all of this to the page.
	echo '<span class="posted-on">' . knowledge_time_link() . '</span>';
}
endif;


if ( ! function_exists( 'busyness_single_categories' ) ) :
	/**
	 * Prints HTML with meta information for the categories,
	 */
	function busyness_single_categories() {
		$options = busyness_get_theme_options();
		// Hide category for single.
		if ( 'post' === get_post_type() ) {
			if ( ! $options['single_post_hide_category'] ) :
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'knowledge' ) );
				if ( $categories_list && busyness_categorized_blog() ) {
					echo '<span class="cat-links"><span class="categories-label">' . esc_html__( 'Categories: ', 'knowledge' ) . '</span>' . $categories_list . '</span>';
				}
			endif;
		}

	}
endif;


if ( ! function_exists( 'busyness_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the tags and comments.
	 */
	function busyness_entry_footer() {
		$options = busyness_get_theme_options();

		echo '<footer class="entry-footer">';

			if ( ! $options['single_post_hide_author'] ) :
	       		knowledge_posted_by();
	       	endif;

	       	knowledge_single_tags();

			busyness_single_categories();

			knowledge_edit_link();

		echo '</footer><!-- .entry-footer -->';
	}
endif;

if ( ! function_exists( 'busyness_render_blog_section' ) ) :
  /**
   * Start blog section
   *
   * @return string blog content
   * @since Busyness 1.0.0
   *
   */
   function busyness_render_blog_section( $content_details = array() ) {
        $options = busyness_get_theme_options();

        $blog_content_type  = $options['blog_content_type'];

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="blog" class="relative page-section">
                <div class="wrapper">
                    <div class="section-header">
                        <?php if ( ! empty($options['blog_title']) ): ?>
                            <h2 class="section-title">
                                <?php echo esc_html( $options['blog_title'] ) ; ?>
                            </h2>
                        <?php endif ?>
                    </div><!-- .section-header -->

                    <div class="section-content section-wrapper posts-wrapper col3">
                    	<div class="blog-post-wrapper">
	                        <?php foreach ( $content_details as $content ):
	                            $image = ! empty( $content['image'] ) ? $content['image'] : '';
	                        ?>
	                            <article class="hentry">
	                                <div class="blog-wrapper">
	                                	<?php
	                                	if ( ! empty( $content['image'] ) ) {
	                                	?>
	                                		<div class="featured-image">
		                                        <a href="<?php echo esc_url( $content['url'] ) ; ?>">
		                                            <img src="<?php echo esc_url( $image ) ; ?>">
		                                        </a>

		                                        <?php
		                                        if ( $blog_content_type == 'category' && ( ! $options['hide_date'] ) ) {
		                                        ?>
			                                        <div class="entry-meta">
			                                            <?php
			                                            busyness_posted_on( $content['id'] );
			                                            knowledge_posted_by( $content['id'] );
			                                            ?>
			                                        </div><!-- .entry-meta -->
			                                    <?php
			                                	} ?>

	                                    	</div><!-- .featured-image -->
	                                	<?php
	                                	} ?>

	                                    <div class="entry-container">
	                                        <header class="entry-header">
	                                            <h2 class="entry-title">
	                                                <a href="<?php echo esc_url( $content['url'] ) ; ?>">
	                                                    <?php echo esc_html( $content['title'] ) ; ?>
	                                                </a>
	                                            </h2>
	                                            <?php
			                                	if ( empty( $content['image'] ) ) {
			                                	?>
		                                            <div class="entry-meta">
			                                            <span class="posted-on">
			                                                <span class="screen-reader-text"><?php esc_html_e('Posted on','knowledge') ?></span>
			                                                <?php busyness_posted_on( $content['id'] ) ; ?>
			                                            </span><!-- .posted-on -->
			                                        </div><!-- .entry-meta -->
			                                    <?php
			                                	} ?>
	                                        </header>

	                                        <div class="entry-content">
	                                            <p>
	                                                <?php echo esc_html( $content['excerpt'] ) ; ?>
	                                            </p>
	                                        </div><!-- .entry-content -->

	                                        <?php
	                                        if ( $blog_content_type == 'category' ) {
	                                        ?>
	                                        	<footer class="entry-footer">
	                                        		<span class="cat-links"><span class="categories-label"><?php esc_html_e( 'Categories: ', 'knowledge' ); ?>
		                                            	<?php the_category(', ', '', $content['id'] ) ; ?>
		                                             </span><!-- .cat-links -->
	                                            	<?php knowledge_edit_link(); ?>
	                                       	 	</footer><!-- .entry-footer -->
	                                        <?php
	                                        } ?>

	                                    </div>
	                                </div>
	                            </article>
	                        <?php endforeach ?>
	                  	</div><!-- .blog-post-wrapper -->
                    </div><!-- .section-content -->
                </div><!-- .wrapper -->
            </div>
    <?php }
endif;

if ( ! function_exists( 'busyness_render_slider_section' ) ) :
  /**
   * Start slider section
   *
   * @return string slider content
   * @since Busyness 1.0.0
   *
   */
   function busyness_render_slider_section( $content_details = array() ) {
        $options = busyness_get_theme_options();


        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="featured-slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 1000, "dots": true, "arrows":false, "autoplay": <?php echo $options['slider_autoplay_enable'] == 'true' ? 'true' : 'false' ; ?>, "draggable": true, "fade": true }'>
            <?php foreach ( $content_details as $content ) : ?>
                <article style="background-image:url('<?php echo esc_url( $content['image'] ); ?>');">
                    <div class="overlay"></div>
                    <div class="wrapper">
                        <div class="featured-content-wrapper">
                            <header class="entry-header">
                                <h2 class="entry-title"><?php echo esc_html( $content['title'] ); ?></h2>
                            </header>

                            <div class="entry-content">
                                <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                            </div><!-- .entry-content-->

                            <?php if ( ! empty( $options['slider_btn_label'] ) ): ?>
                                <div class="read-more">
                                    <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn btn-fill slider-btn">
                                        <span class="screen-reader-text"><?php echo esc_html( $content['title'] ); ?></span>
                                        <?php echo esc_html( $options['slider_btn_label'] ); ?>
                                    </a>
                                </div><!-- .read-more -->
                            <?php endif ?>

                        </div><!-- .featured-content-wrapper -->
                    </div><!-- .wrapper -->
                </article>
            <?php endforeach; ?>
        </div><!-- #featured-slider -->
    <?php }
endif;

if ( ! function_exists( 'busyness_footer_site_info' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Busyness 1.0.0
	 *
	 */
	function busyness_footer_site_info() {
		$theme_data = wp_get_theme();
		$options = busyness_get_theme_options();

		// Copyright content.
		$copyright_text = $options['copyright_text'];
		$copyright_text = apply_filters( 'busyness_filter_copyright_text', $copyright_text );
		if ( ! empty( $copyright_text ) ) {
			$copyright_text = wp_kses_data( $copyright_text );
			$copyright_text = busyness_apply_theme_shortcode( $copyright_text );
		}

		// Powered by content.
		$powered_by_text = sprintf( esc_html__( 'Knowledge by %s', 'knowledge' ), '<a target="_blank" rel="designer" href="https://wenthemes.com/">' . esc_html__( 'WEN Themes', 'knowledge' ) . '</a>' );

		if ( $options['footer_social_menu'] == true ) {
			$classes = "site-info col2";
		} else {
			$classes = "site-info col1";
		}
		?>
		<div class="<?php echo $classes; ?>">
            <div class="wrapper">
            	<?php if ( ! empty( $options['footer_image'] ) ) : ?>
	            	<span class="footer-image"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $options['footer_image'] ); ?>" alt="<?php bloginfo( 'name' ); ?>"></a></span>
	            <?php endif; ?>

				<?php if ( ! empty( $copyright_text ) ) : ?>
	                <div class="copyright">
	                	<?php echo $copyright_text; ?>
	            	</div>
	            <?php endif; ?>
	            <?php if ( ! empty( $powered_by_text ) ) : ?>
	            	<div class="desined">
						<?php echo $powered_by_text; ?>
					</div>
				<?php endif; ?>

            	<?php if ( $options['footer_social_menu'] == true): ?>
            		<div class="social-icons">
	            	<?php
	            		wp_nav_menu( $defaults = array(
							'theme_location' => 'social',
							'container'      => false,
							'menu_class'     => 'menu',
							'echo'           => true,
							'fallback_cb'    => false,
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>',
	            		) );
	            	 ?>
	            	</div>
            	<?php endif ?>

            </div><!-- .wrapper -->
        </div><!-- .site-info -->

		<?php
	}
endif;
