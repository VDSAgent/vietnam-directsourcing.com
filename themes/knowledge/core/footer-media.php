
<?php
/*
global $tp_options;	
    $random_query = new WP_Query(array(
            'post_type' =>'services',
            'posts_per_page' => 3,
            'orderby' => date
    ));
    if ( $random_query->have_posts() ) :
    	echo '<div class="shortcode-footer">';
	    	echo '<div class="class-width-large">';
	            echo "<div class='content-box-services custom-show-services'>";
	    			echo '<div class="class-width-medium">';
	    				echo "<div class='text-shortcode-media'>";
	            			echo '<h2 class="title_shortcode">';
	            				echo $tp_options['title-media-services-shortcode'];
	            			echo '</h2>';
	            			echo '<p class="subtitle_shortcode">';
	            				echo nl2br($tp_options['subtitle-media-services-shortcode']);
	            			echo '</p>';
	            		echo "</div>";
	    			echo "</div>";
		                while ( $random_query->have_posts() ) :
		                        $random_query->the_post();?>
		                            <div class="col-md-4 col-sm-4 col-xs-12 services-box">
		                                <div class="custom-hover-services">
		                                	<a class="images_shortcode_services" href="<?php the_permalink(); ?>">
		                                    	<?php if( has_post_thumbnail( get_the_ID() ) ) { ?>
						                              <?php echo get_the_post_thumbnail( get_the_ID(), 'detail' ); ?>
						                          <?php }
						                            else{?>
						                              <img src="<?php echo get_site_url();?>/wp-content/uploads/2016/04/book.jpg" class="attachment-detail size-detail wp-post-image" alt="img">
						                            <?php }
						                          ?>
						                    </a>
		                                    <div class="text_title">
		                                        <a href="<?php the_permalink(); ?>" class="title_services"><?php echo get_the_title();?></a>
		                                    </div>
		                                </div>
		                            </div>
		                <?php endwhile;
	            echo "</div>";
	        echo "</div>";
	    echo "</div>";
    endif;
    */
?>

<div class="footer-widget">
	<div class="container">
		<div class="row">
			<?php if ( is_active_sidebar( 'sidebar-one' ) ) : ?>
				<div class="tweet-widget col-xs-12 col-sm-4 col-md-4">
					<?php dynamic_sidebar( 'sidebar-one' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'sidebar-two' ) ) : ?>
				<div class="gallery-widget col-xs-12 col-sm-4 col-md-4">
					<?php dynamic_sidebar( 'sidebar-two' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'sidebar-three' ) ) : ?>
				<div class="lastnews-widget col-xs-12 col-sm-4 col-md-4">
					<?php dynamic_sidebar( 'sidebar-three' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<footer>
	<div class="container">
		<?php
			back_to_top_knowledgetheme();
			logo_footer_knowledgetheme();
		?>
		<?php if( has_nav_menu( 'primary-menu' ) ): ?>
			<div class="row">
				<div class="menu-footer col-xs-12 col-sm-12 col-md-12">
					<?php
						wp_nav_menu( array(
							'container' => false,
							'theme_location' => 'second-menu',
							'menu_class'     => 'nav navbar-nav',
							)
						);
					?>
				</div>
			</div>
		<?php endif; ?>
		<?php
			footer_social_knowledgetheme();
		?>
		<?php
			footer_infor_knowledgetheme()
		?>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>