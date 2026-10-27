<?php
/*
// Template Name: Case Template
*/
get_header();
?>
<!--slider-area start-->
        <section class="page-title-area sky-blue-bg pt-280 pb-180 pt-lg-200 pt-md-160 pb-md-120 pt-xs-160 pb-xs-90">
            <img class="page-shape shape_01 d-none blog-shape-1 d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-11.png" alt="Page Shape">
            <img class="page-shape shape_04 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/orange-1.svg" alt="Page Shape">
            <img class="page-shape shape_05 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="Page Shape">
            <img class="page-shape shape_06 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/berry-1.svg" alt="Page Shape">
            <img class="page-shape shape_07 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/truck.svg" alt="Page Shape">
            <img class="page-shape-02 shape_08 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-a.svg" alt="Page Shape">
            <img class="page-shape shape_09 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/nav-box.svg" alt="Page Shape">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="page-title-wrapper text-center">
                            <h4 class="styled-text theme-color mb-30">Cases</h4>
                            <h1 class="h1 page-title">Our Logistics Case Studies</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--slider-area end-->
        <!--work-process start-->
        <section class="work-process position-relative pt-120 pb-90 pt-lg-80 pb-lg-60 pt-md-60 pb-md-30 pt-xs-60 pb-xs-30">
            <img class="work-shape pshape-2 case-1a d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/orange-5.svg" alt="">
            <img class="work-shape pshape-3 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/eclip-1.svg" alt="">
            <img class="work-shape pshape-4 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/box-2.svg" alt="">
            <div class="container">
                <div class="row align-items-center mb-140 mb-md-80 mb-xs-80">
                   <div class="col-xl-8 col-lg-8 col-md-7">
                        <div class="section-title section-title2 text-center text-md-start mb-30">
                            <h6 class="mb-30">Our Work Process</h6>
                            <h2>The way we work at a <span class="theme-color">opic</span> company Transport and Logistics</h2>
                        </div>
                   </div>
                   <div class="col-xl-4 col-lg-4 col-md-5">
                        <div class="logistics-box text-center mb-30">
                            <img class="float-bob-y" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/assets-box-1.svg" alt="">
                        </div>
                   </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6">
                       <div class="single-work mb-30">
                           <div class="single-work__icon mb-30">
                               <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon/budget.svg" alt="">
                           </div>
                           <h4 class="semi-title">Transparent Pricing</h4>
                       </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                       <div class="single-work sw-2 mb-30">
                           <div class="single-work__icon mb-30">
                               <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon/air-freight-2.svg" alt="">
                           </div>
                           <h4 class="semi-title">Fast Logistics</h4>
                       </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                       <div class="single-work sw-3 mb-30">
                           <div class="single-work__icon mb-30">
                               <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon/inventory.svg" alt="">
                           </div>
                           <h4 class="semi-title">Packaging & Distribution</h4>
                       </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                       <div class="single-work sw-4 mb-30">
                           <div class="single-work__icon mb-30">
                               <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon/truck-2.svg" alt="">
                           </div>
                           <h4 class="semi-title">Transportation Process</h4>
                       </div>
                    </div>
                </div><!--/.row-->
            </div><!--/.container-->
        </section>
        <!--work-process end-->
        <!--case-studies start-->
        <section class="sky-blue-bg-2 case-studies position-relative pt-120 pb-90 pt-lg-80 pb-lg-40 pt-md-60 pb-md-30 pt-xs-60 pb-xs-30">
            <img class="case-shape cashape-1 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/triangle.svg" alt="">
            <img class="case-shape case-one-a d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-a.svg" alt="">
            <img class="case-shape case-one-b" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-3.svg" alt="">
            <img class="case-shape cashape-4 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/box-2.svg" alt="">
            <div class="container">
           	 	<?php echo do_shortcode('[case_feed number_post="30"]'); ?>	
            </div><!--/.container-->
        </section>
        <!--case-studies end-->
        <!--shipping-discount start-->
        <section class="shipping-discount position-relative fix pt-155 pb-40 pt-lg-110 pt-md-60 pt-xs-60">
            <img class="shipping-shape sshape-1 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/box-2.svg" alt="">
            <img class="shipping-shape sshape-2 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/chose/big-truck.svg" alt="">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="section-title text-start mb-30">
                            <h2 class="mb-30">Shipping discounts</h2>
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