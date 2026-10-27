<?php
/*
// Template Name: Team Template
*/
get_header();
?>
<!--slider-area start-->
        <section class="page-title-area sky-blue-bg pt-280 pb-180 pt-lg-200 pt-md-160 pb-md-120 pt-xs-160 pb-xs-90">
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
            <img class="team-shape2 tmshape-1" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/img/shape/round-line-a.svg" alt="">
            <img class="team-shape2 tmshape-2" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/img/shape/border-line-1.svg" alt="">
            <div class="container">
            	 <?php echo do_shortcode('[team_carousel]'); ?>
            </div><!--/.container-->
        </section>
        <!--copic-team end-->
<?php
get_footer();