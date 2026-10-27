<?php
/*
// Template Name: Podcast Template
*/

get_header();
?>

<!--page-title-area start-->
        <section class="page-title-area sky-blue-bg pt-280 pb-180 pt-lg-200 pt-md-160 pb-md-120 pt-xs-160 pb-xs-90">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="page-title-wrapper text-center">
                            <h1 class="h1 page-title">Sourcing From Vietnam: The VDS Podcast</h1>
                            <h4 class="styled-text theme-color mb-30">Short episodes on real sourcing questions, every Tuesday</h4>
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
					if ( $query->max_num_pages > 1 && vds_podcast_is_paged_list() && (int) get_query_var( 'paged' ) < 2 ) :
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
	
</section>
<?php } ?>


<?php
get_footer();

