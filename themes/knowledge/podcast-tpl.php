<?php
/*
// Template Name: Podcast Template
*/

get_header();
?>

<!--page-title-area start-->
        <section class="page-title-area sky-blue-bg pt-280 pb-180 pt-lg-200 pt-md-160 pb-md-120 pt-xs-160 pb-xs-90">
            <img class="page-shape blog-shape-1 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-11.png" alt="Page Shape">
            <img class="page-shape shape_04 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/orange-1.svg" alt="Page Shape">
            <img class="page-shape shape_05 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="Page Shape">
            <img class="page-shape shape_06 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/berry-1.svg" alt="Page Shape">
            <img class="page-shape shape_07 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/truck.svg" alt="Page Shape">
            <img class="page-shape-02 shape_08 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-a.svg" alt="Page Shape">
            <img class="page-shape shape_09 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/nav-box.svg" alt="Page Shape">
			<img class="page-shape transport img-one" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/plane.svg" alt="">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="page-title-wrapper text-center">
                            <h1 class="h1 page-title">Conversations About Sourcing From Vietnam</h1>
                            <h4 class="styled-text theme-color mb-30">Conversations that Drive Sourcing Success</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--page-title-area end-->

<!--why-chose-us start-->
<?php 


$heading_small_wcu = get_field('podcast_sub_title');
$title_section_wcu = get_field('podcast_title');

$hide_podcast_section = get_field('hide_podcast_section');        
if(empty( $hide_podcast_section ) || $hide_podcast_section[0] !=='yes') { ?>
<section class="why-chose-us shape-style position-relative">
        <div class="container pt-110">
            <div class="row align-items-center">

                <div class="col-xl-12 col-lg-12">
					<?php 
					$args_loop = [						
						'post_type' => 'podcast',
						'posts_per_page' => '10',
						'order'             => 'DESC', 
						'orderby'           => 'date',
						'paged' => 1,
					]
					?>
					<div class="ajax_container" data-args="<?php echo esc_html(json_encode($args_loop))?>">

					<div class="blog_lists">
				<?php 
						$query = new WP_Query( $args_loop);
						
						    if ( $query->have_posts() ) :
								while ( $query->have_posts() ) : $query->the_post(); 	
								get_template_part('loop/podcast');
							
								endwhile;
								?>
								</div>
					<?php 
					if($query->max_num_pages > 1):
					?>
					<div class="readmore">
						<a href="" class="theme_btn black-btn"><span>Load More</span></a>  
					</div>
					<?php endif?>
								<?php 
							endif;
						wp_reset_postdata();
						?>
						
						</div>
						<!--/ end repeater for podcast -->
                </div>
            </div><!--/.row-->
            
            
        </div><!--/.container-->
	
	<!--
		<div class="form-pricing container" style="margin-top: 30px; max-width: 1580px">
			<div data-tf-live="01JA9C12XPMNESHQZ0MSFC2AJE"></div>
			<script src="//embed.typeform.com/next/embed.js"></script>
		</div>
    -->
</section>
<?php } ?>

<style>
	.podcast-section iframe {
		width: 100%;
		height: 272px;
		padding: 20px 0;
	}
	.podcast-section ul {
		list-style: none;
	}
</style>

<?php
get_footer();

