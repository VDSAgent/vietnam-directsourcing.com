<?php
/*
// Template Name: Blog Template
*/
get_header();
?>
<!--page-title-area start-->
        <section class="page-title-area sky-blue-bg pt-280 pb-180 pt-lg-200 pt-md-160 pb-md-120 pt-xs-160 pb-xs-90">
            <img aria-hidden="true" class="page-shape blog-shape-1 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-11.png" alt="">
            <img aria-hidden="true" class="page-shape shape_04 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/orange-1.svg" alt="">
            <img aria-hidden="true" class="page-shape shape_05 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="">
            <img aria-hidden="true" class="page-shape shape_06 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/berry-1.svg" alt="">
            <img aria-hidden="true" class="page-shape shape_07 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/truck.svg" alt="">
            <img aria-hidden="true" class="page-shape-02 shape_08 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-a.svg" alt="">
            <img aria-hidden="true" class="page-shape shape_09 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/nav-box.svg" alt="">
			<img aria-hidden="true" class="page-shape transport img-one" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/plane.svg" alt="">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="page-title-wrapper text-center">
<!-- 							<h5 class="h1 page-title"><?php echo get_field('page_title'); ?></h5>
                            <h4 class="styled-text theme-color mb-30"><?php echo get_the_title(); ?></h4> -->
                            <h1 class="h1 page-title">Expert Advice and Fresh Perspectives</h1>
                            <h4 class="styled-text theme-color mb-30">Latest News, Tips, and Ideas</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--page-title-area end-->
        <!--comic-blog start-->
		<!--
        <section class="comic-blog position-relative pt-120 pb-90 pt-lg-80 pb-lg-50 pt-md-60 pb-md-30 pt-xs-60 pb-xs-30">
            <img aria-hidden="true" class="blog-shape blog-gd-shape bshape-3 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-c.svg" alt="">
            <div class="container">
                <?php //echo do_shortcode('[post_feed loadmore="true"]'); ?>                   
            </div>
        </section>
		-->
        <!--comic-blog end-->
        <section class="comic-blog position-relative pt-120 pb-90 pt-lg-80 pb-lg-50 pt-md-60 pb-md-30 pt-xs-60 pb-xs-30">
            <img aria-hidden="true" class="blog-shape blog-gd-shape bshape-3 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-c.svg" alt="">
            <div class="container">
				<div id="posts-container" class="row blog_feed">
					<?php
					$query = new WP_Query(array(
						'post_type' => 'post',
						'posts_per_page' => 9,
					));

					$total_pages = $query->max_num_pages;

					if ($query->have_posts()) {
						while ($query->have_posts()) {
							$query->the_post();
							if ( function_exists('get_field') ) {
								$image = get_field('featured_image');
								if ( $image ) {
									$img_link = '<a href="' . get_permalink() . '"><img src="' . esc_url( $image['url'] ) . '" alt="' . esc_attr( $image['alt'] ) . '"></a>';
								} else {
									$img_link = "";
								}
							}
							echo '<div class="col-lg-4 col-md-6">
									   <div class="comic-blogs-wrapper mb-30">
											<div class="comic-blogs-thumb">'. $img_link . '</div>
											<div class="blogs-content">
												<div class="blog-meta mb-25">
													<!--
												   <span class="meta-btn">
													Business growth                        
													</span>
													-->
												</div>
												<div class="blog-meta-date mb-15">' . get_the_date() . '</div>
												<h3 class="blog-title">
													<a href="' . get_permalink() . '">' . get_the_title() . '</a>
												</h3>
										   </div>
										</div>
									</div>';
						}
					}
					$total_pages = $query->max_num_pages;
					wp_reset_postdata();
					?>
				</div>
				<?php if ( (int) get_query_var( 'paged' ) < 2 ) : ?>
				<div class="row">
					<div class="col-12">
						<div class="blog-more text-center mb-30">
							<a href="#" id="load-more" data-page="1" data-total-pages="<?php echo $total_pages; ?>" class="theme_btn theme_btn_border">Load More Articles</a>
						</div>
					</div>
				</div>
				<?php endif; ?>
            </div>
        </section>


<?php
get_footer();