<?php
/*
// Template Name: Get A Quote Template
*/
get_header();
?>
<!--page-title-area start-->
        <section class="page-title-area sky-blue-bg pt-280 pb-180 pt-lg-200 pt-md-160 pb-md-120 pt-xs-160 pb-xs-90">
            <img class="page-shape shape_01 blog-shape-1 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-11.png" alt="Page Shape">
            <img class="page-shape shape_04 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/orange-1.svg" alt="Page Shape">
            <img class="page-shape shape_05 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="Page Shape">
            <img class="page-shape shape_06 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/berry-1.svg" alt="Page Shape">
            <img class="page-shape shape_07 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/truck.svg" alt="Page Shape">
            <img class="page-shape-02 shape_08 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-a.svg" alt="Page Shape">
            <img class="page-shape shape_09 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/nav-box.svg" alt="Page Shape">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="page-title-wrapper text-center">
                            <h4 class="styled-text theme-color mb-30"><?php echo get_the_title(); ?></h4>
                            <h1 class="h1 page-title"><?php echo get_field('page_title'); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--page-title-area end-->
       <div class="request-quote-area pt-120 pb-120 pt-lg-80 pb-lg-80 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">
           <div class="container">
               <div class="quote-info-wrapper">
                    <?php echo do_shortcode('[gravityform id="3" title="false" ajax="true"]'); ?>
               </div>
           </div>
       </div>
<?php
get_footer();