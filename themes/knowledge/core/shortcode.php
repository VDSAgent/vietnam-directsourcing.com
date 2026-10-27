<?php
add_filter('widget_text', 'do_shortcode');
add_shortcode( 'shownewpost', 'shownewpost_shortcode_knowledgetheme' );
function shownewpost_shortcode_knowledgetheme( $atts, $content = null ) {
	$args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 1        
    );
    $loop = new WP_Query($args);
	ob_start();
	if ($loop -> have_posts()) :
		echo '<div><ul>';
			while ($loop -> have_posts()) : $loop -> the_post();
			?>
				<li>
				<p><a href="<?php echo get_permalink();?>"><?php echo get_the_title();;?></a></p>
				<p><?php  echo abc_substr(get_the_excerpt(),85);?></p>
				</li>
			<?php
			endwhile;
		echo '</ul>
		<p class="visitblog"><a href="'.get_permalink().'"> > Read more</a></p>
		</div>';
    endif;
	return ob_get_clean();
}
add_shortcode( 'showservices', 'showservices_shortcode_knowledgetheme' );
function showservices_shortcode_knowledgetheme() {
	$args = array(
        'post_type' => 'our-services',
        'post_status' => 'publish',
        'posts_per_page' => 6     
    );
    $loop = new WP_Query($args);
	ob_start();
	if ($loop -> have_posts()) :
			while ($loop -> have_posts()) : $loop -> the_post();
			$post_id = get_the_ID(); 
			$icon = get_field('icon_services');
			$exceprt = get_field('short_descriptions');
			?>
				<div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="c-services-box">
                        <div class="c-services c-service2 text-center wow fadeInUp2 animated mb-30" data-wow-delay="0.1s">
                            <div class="c-services__icon">
                                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" />
                            </div>
                            <h3 class="service-title mb-25 mt-35"><?= get_the_title();?></h3>
                            <p class="mb-35"><?= $exceprt;?></p>
                            <a class="arrow-icon" href="#<?php echo $post_id;?>" data-id="<?php echo get_the_ID(); ?>">Discover More <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon/right-arrow.svg" alt=""></a>
                        </div>
                    </div>
                </div>
			<?php
			endwhile;
    endif;
	return ob_get_clean();
}
add_shortcode( 'show_Services_Home', 'showservices_shortcode_home' );
function showservices_shortcode_home() {
	$args = array(
        'post_type' => 'our-services',
        'post_status' => 'publish',
        'posts_per_page' => 6,
		// 'order' => 'ASC',    
    );
    $loop = new WP_Query($args);
	ob_start();
	if ($loop -> have_posts()) :
		$count = 1;
			while ($loop -> have_posts()) : $loop -> the_post();
			$post_id = get_the_ID(); 
			$icon = get_field('icon_services_home');
			$exceprt = get_field('short_descriptions');
			?>				
				<div class="col-lg-4 col-md-6">
					<div class="c-services <?php echo ($count == 2) ? "active" : ""; ?> text-center wow fadeInUp2  mb-30 animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp2;">
						<div class="c-services__icon mb-65">
							<img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
						</div>
						<h3 class="service-title mb-25"><?php echo get_the_title();?></h3>
						<p class="mb-35"><?php echo $exceprt;?></p>
<!-- 						<a class="arrow-icon" href="<?php echo get_site_url(null,'services');?>/#<?php echo $post_id; ?>">Discover More <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon/right-arrow.svg" alt=""></a> -->
						<a class="arrow-icon" href="https://vietnam-directsourcing.com/solutions/#<?php echo $post_id; ?>">Discover More <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon/right-arrow.svg" alt=""></a>
						
					</div>
				</div>
			<?php
			$count++;
			endwhile;
			wp_reset_postdata();
    endif;
	return ob_get_clean();
}


add_shortcode( 'show_single_service', 'show_single_service' );

function show_single_service() {

	$args = array(
        'post_type' => 'our-services',
        'post_status' => 'publish',
        'posts_per_page' => 6,
		// 'order' => 'ASC',    
    );
    $loop = new WP_Query($args);

	ob_start();

	if ($loop->have_posts()) {
		?>
			<section class="value-added-services position-relative pt-120 pb-45 pt-lg-80">
					<img class="value-shape vshape-1 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-a.svg" alt="Dot Shape">
					<img class="value-shape vshape-2 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-baby-1.svg" alt="Line Shape">
		<?php
		while ($loop->have_posts()) {
			$loop->the_post();

			$post_id = get_the_ID();          
            
			$image_value_services = get_field('image_value_services');
			$title_value_services = get_field('title_value_services');
			$description_value_services = get_field('description_value_services');
			$add_list_value = get_field('add_list_value');


			?>
				<div id="<?php echo $post_id ?>" class="pb-45 item-services">
					<div class="container">
						<div class="row align-items-center">
							<div class="col-xl-5 col-lg-6 col-md-6">
								<div class="value-added-img mb-30">                            
									<img class="w-100" src="<?= esc_url($image_value_services['url']);?>" alt="<?= esc_attr($image_value_services['alt']);?>">
								</div>
							</div>
							<div class="col-xl-7 col-lg-6 col-md-6">
								<div class="value-added-content mb-30">
									<div class="section-title section-title2">
										<h2 class="mb-35"><?php echo get_the_title(); ?></h2>
										<?php echo $description_value_services;?>
									</div>
									<?php echo $add_list_value; ?>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				
			<?php
		}
		?>
			</section>
		<?php
		wp_reset_postdata();
	}

	return ob_get_clean();
}

?>