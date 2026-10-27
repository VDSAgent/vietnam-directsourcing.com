<?php
/*
// Template Name: Contact Template
*/
/* 
<img class="page-shape shape_05 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="Page Shape">  
 <img class="page-shape shape_04 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/orange-1.svg" alt="Page Shape">
 <img class="page-shape shape_06 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/berry-1.svg" alt="Page Shape">
 <img class="page-shape shape_09 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/nav-box.svg" alt="Page Shape">
 */

get_header();
?>
 <!--page-title-area start-->
 <?php 
        $hide_banner = get_field('hide_banner');        
         if(empty( $hide_banner ) || $hide_banner[0] !=='yes') { ?>
        <section class="page-title-area sky-blue-bg pt-280 pb-180 pt-lg-200 pt-md-160 pb-md-120 pt-xs-160 pb-xs-90">
            <img class="page-shape contact-shape-1 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-11.png" alt="Page Shape">
           
            
            
            <img class="page-shape shape_07 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/truck.svg" alt="Page Shape">
			<img class="page-shape transport img-one" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/plane.svg" alt="">
            
            
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
        <!--copic-contact start-->
        <?php 
        $hide_info = get_field('hide_info');        
         if(empty( $hide_info ) || $hide_info[0] !=='yes') { ?>
        <section class="copic-contact position-relative pb-80 pt-lg-8 pb-lg-60 pb-md-60 pt-md-60 pt-xs-60 pb-xs-60">
            <img class="contact-shape contact-one d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/big-box-1.svg" alt="Contact Shape">
            <img class="contact-shape contact-two d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/big-box-1.svg" alt="Contact Shape">
            <div class="container  contact-container">
                <div class="row reverse-mb">
                    <div class="col-md-12">
                        <div class="contact-info">
                           <div class="info-box  pr-lg-0 pr-md-0 pr-xs-0">
                               <!-- <h5 class="fw-medium fs-20 mb-3 text-uppercase">Contact us</h5>
                               <p class="mb-35">1763 Pancaster Court boarbazar, NY 12601</p>
                               <h5 class="fw-medium fs-20 text-uppercase">Want to say hello?</h5>
                               <p><a href="mail-to:inussk@gmail.com">inussk@gmail.com</a></p>
                               <p  class="mb-35"><a href="#">+88 01682648101</a></p>
                               <p>Client work with us</p>
                               <h3 class="contact-title fw-medium mb-4">Over <span class="theme-color">5,000+</span>  Client all over the world.</h3> -->
                               <?php echo get_field("description_infor_left"); ?>
                               <!-- <img src="<?php //echo get_stylesheet_directory_uri(); ?>/assets/img/contact/current-loc-1.svg" alt="Current Loc"> -->
                           </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12" style="margin-top: -30px">
<!--                         <?php 
                        $bg_form = get_field('ctf_form');
                        if( !$bg_form) {
                            $bg_form = get_stylesheet_directory_uri().'/assets/img/contact/map-bg-1.png';
                        }
                        ?>

                        <div class="contact-wrapper" data-bg-src="<?php echo $bg_form ?>">
                            <div class="contact-wrapper-inner pl-25 pr-35 mb-30 pr-xs-0 pl-xs-0">
                            <div class="section-title text-md-start mb-80">
                                <h6 class="mb-30">Contact us</h6>
                                <h2>Lets Create Something Great Together!</h2>

                                <?php echo get_field("description_infor_right"); ?>
                            </div>
                            <?php echo do_shortcode('[gravityform id="2" title="false" ajax="true"]');?>
                        </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        <!--copic-contact end-->
        <!--shipping-discount start-->
        <?php 
        $hide_faq = get_field('hide_faq');        
         if(empty( $hide_faq ) || $hide_faq[0] !=='yes') { ?>
        <section class="grey-bg-soft3 faq-area-2 position-relative fix pt-105 pb-90 pt-lg-80 pb-lg-50 pt-md-60 pb-md-30 pt-xs-60 pb-xs-30">
            <img class="shipping-shape sshape-1 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/eclip-1.svg" alt="">
            <img class="faq-shape sshape-2 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-5.svg" alt="">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="section-title section-title2 mb-40">
                            <h2><?php echo get_field("title_faq"); ?></h2>
                        </div>
                        <div class="faq-que-list mb-30">
                            <div class="accordion" id="accordionExample">

                                <?php 
                                    if(have_rows("list_questions")) {
                                        $count = 1;
                                        while(have_rows("list_questions")) {
                                            the_row();

                                            $get_title_question = get_sub_field("title_question");
                                            $get_des_question = get_sub_field("description_question");

                                            ?>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button <?php echo ($count == 1) ? "" : "collapsed"; ?> " type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $count; ?>" aria-expanded="true" aria-controls="collapse<?php echo $count; ?>">
                                                            <?php echo $get_title_question; ?>
                                                        </button>
                                                    </h2>
                                                    <div id="collapse<?php echo $count; ?>" class="accordion-collapse collapse <?php echo ($count == 1) ? "show" : ""; ?>" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <p><?php echo $get_des_question; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php

                                            $count++;
                                        }
                                    }
                                ?>

                                <!-- <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                       Are you Global?
                                    </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                         <p>There is no license fee or monthly subscriptions for signing up or access. Optimise charges transaction fees and commission on shipments. For carriers, access is 100% free of charge.</p>
                                    </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Can you provide after hours and weekends emergency?
                                    </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>There is no license fee or monthly subscriptions for signing up or access. Optimise charges transaction fees and commission on shipments. For carriers, access is 100% free of charge.</p>
                                    </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        What if we have a new customer in Tanzania?
                                    </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>There is no license fee or monthly subscriptions for signing up or access. Optimise charges transaction fees and commission on shipments. For carriers, access is 100% free of charge.</p>
                                    </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                   <div class="col-lg-6">
                       <div class="faq-img-box text-center mb-30">
                            <?php 
                                $image = get_field('image_faq');
                                if( !empty( $image ) ) {
                                    ?>
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                    <?php
                                }
                            ?>
                            
                       </div>
                   </div>
                </div><!--/.row-->
            </div><!--/.container-->
        </section>
        <?php } ?>
        <!--shipping-discount end-->

<?php
get_footer();