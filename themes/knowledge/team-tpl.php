<?php
/*
// Template Name: Team Template
*/
get_header();
?>
<!--slider-area start-->
        <section class="page-title-area sky-blue-bg pt-280 pb-180 pt-lg-200 pt-md-160 pb-md-120 pt-xs-160 pb-xs-90">
            <img class="page-shape blog-shape-1 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-11.png" alt="Page Shape">
            <img class="page-shape shape_04 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/orange-1.svg" alt="Page Shape">
            <img class="page-shape shape_05 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="Page Shape">
            <img class="page-shape shape_06 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/berry-1.svg" alt="Page Shape">
            <img class="page-shape shape_07 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/truck.svg" alt="Page Shape">
            <img class="page-shape shape_08 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-a.svg" alt="Page Shape">
            <img class="page-shape shape_09 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/nav-box.svg" alt="Page Shape">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="page-title-wrapper text-center">
                            <h4 class="styled-text theme-color mb-30">Team</h4>
                            <h1 class="h1 page-title">Meet Our Expert</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--slider-area end-->
        <!--copic-team start-->
        <section class="copic-team position-relative pt-120 pb-90 pt-lg-80 pb-lg-50 pt-md-60 pb-md-30 pt-xs-60 pb-xs-30">
            <img class="team-shape2 tmshape-1" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="">
            <img class="team-shape2 tmshape-2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/border-line-1.svg" alt="">
            <div class="container">
            	 <?php echo do_shortcode('[team_carousel]'); ?>
            </div><!--/.container-->
        </section>
        <!--copic-team end-->
        <!--shipping-discount start-->
        <section class="shipping-discount position-relative fix pt-160 pb-120 pt-lg-115 pb-lg-50 pt-md-60 pb-md-50 pt-xs-60 pb-xs-50">
            <img class="shipping-shape sshape-1 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/box-2.svg" alt="">
            <img class="shipping-shape sshape-2 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/chose/big-truck.svg" alt="">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="section-title text-start mb-30">
                            <h2 class="mb-30">Shipping discounts</span></h2>
                            <p class="sect-title mb-50">Shipping costs are the #1 reason for shopping cart abandonment. If you want to compete in the eCommerce space, you’re going to need to have the best shipping rates possible.</p>
                            <a href="<?php echo site_url().'/services/';?>" class="theme_btn theme_btn_border border_btn_red">See Our rates</a>
                        </div>
                    </div>
                   <div class="col-lg-6">
                       <div class="shipping-img-box text-center mb-30">
                           <img class="img-one d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shipping/black-sun.svg" alt="shipping img">
                           <div class="bi-cycle pos-rel">
                               <img class="img-two" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shipping/men-frame.svg" alt="shipping img">
                               <img class="img-three" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shipping/ring-1.svg" alt="shipping img">
                               <img class="img-four" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shipping/ring-2.svg" alt="shipping img">
                               <img class="img-five" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shipping/plater-1.svg" alt="shipping img">
                           </div>
                       </div>
                   </div>
                </div><!--/.row-->
            </div><!--/.container-->
        </section>
        <!--shipping-discount end-->
<?php
get_footer();