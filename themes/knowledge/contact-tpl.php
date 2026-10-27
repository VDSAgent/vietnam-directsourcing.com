<?php
/*
// Template Name: Contact Template
*/
get_header();
?>
 <!--page-title-area start-->
 <?php 
        $hide_banner = get_field('hide_banner');        
         if(empty( $hide_banner ) || $hide_banner[0] !=='yes') { ?>
        <section class="page-title-area sky-blue-bg pt-280 pb-180 pt-lg-200 pt-md-160 pb-md-120 pt-xs-160 pb-xs-90">
           
            
            
            
            
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="page-title-wrapper text-center">
							<h1 class="h1 page-title"><?php echo get_field("title_contact"); ?></h1>
                            <h4 class="styled-text theme-color mb-30"><?php echo get_field("sub_title_contact"); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        <!--page-title-area end-->
        <?php vds_render_page_copy(); // booking first, then addresses and social links ?>
        <!--copic-contact start-->
        <?php 
        $hide_info = get_field('hide_info');        
         if(empty( $hide_info ) || $hide_info[0] !=='yes') { ?>
        <section class="copic-contact position-relative pb-80 pt-lg-8 pb-lg-60 pb-md-60 pt-md-60 pt-xs-60 pb-xs-60">
            <img aria-hidden="true" class="contact-shape contact-one d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/big-box-1.svg" alt="">
            <img aria-hidden="true" class="contact-shape contact-two d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/big-box-1.svg" alt="">
            <div class="container  contact-container">
                <div class="row reverse-mb">
                    <div class="col-md-12">
                        <div class="contact-info">
                           <div class="info-box  pr-lg-0 pr-md-0 pr-xs-0">
                               <?php echo get_field("description_infor_left"); ?>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        <!--copic-contact end-->

<?php
get_footer();