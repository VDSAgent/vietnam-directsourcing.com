</main>
<!--footer-area start-->
    <footer class="footer-area sky-blue-bg-soft pos-rel pt-130 pt-md-100 pt-xs-100 fix">
        <img class="fot-shape f-shape1 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-5.svg" alt="Line Shape">
        <img class="fot-shape f-shape2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-shape-1.svg" alt="Dot Shape">
        <img class="fot-shape f-shape3 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-black-1.svg" alt="Dot Shape">
        <img class="fot-shape f-shape4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/orange-4.svg" alt="Dot Shape">
        <div class="container">
        	<div class="row borders-grey pb-30">
        			<div class="col-xl-3 col-lg-4 col-md-6  wow fadeInUp2 animated" data-wow-delay='.1s'>                     
                        	<?php if ( is_active_sidebar( 'sidebar-one' ) ) : ?>								
									<?php dynamic_sidebar( 'sidebar-one' ); ?>								
							<?php endif; ?>   
                            
                    </div>
                    <?php if ( is_active_sidebar( 'sidebar-two' ) ) : ?>	
                    <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp2 animated" data-wow-delay='.3s'>                       
                        								
									<?php dynamic_sidebar( 'sidebar-two' ); ?>								
							
                    </div>
                    <?php endif; ?> 
                    <?php if ( is_active_sidebar( 'sidebar-three' ) ) : ?>		
                    <div class="col-xl-3 col-lg-4 col-md-6  wow fadeInUp2 animated" data-wow-delay='.5s'>
                        							
									<?php dynamic_sidebar( 'sidebar-three' ); ?>								
							                      </div>
                                                  <?php endif; ?> 
                    <div class="col-xl-9 col-lg-6 col-md-6  wow fadeInUp2 animated" data-wow-delay='.7s'>
                        	<?php if ( is_active_sidebar( 'sidebar-four' ) ) : ?>								
									<?php dynamic_sidebar( 'sidebar-four' ); ?>								
							<?php endif; ?>  
                    </div>
            </div>        	
            <div class="copy-right-area pt-50">
                <?php
					footer_infor_knowledgetheme();
				?>
            </div>
        </div>
    </footer>
    <!--footer-area end-->

    <a id="scroll" class="scrollUp" href="#"><i class="far fa-arrow-up"></i></a>
<?php
//back_to_top_knowledgetheme();
?>
<?php wp_footer(); ?>
</body>
</html>