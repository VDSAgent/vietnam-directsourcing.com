<?php the_content(); ?>
<?php
/*
// Template Name: Services Single Template
*/
get_header();
$sub_title_services = get_field('sub_title_services');
$title_banner_services = get_field('title_banner_services');
$description_banner_services = get_field('description_banner_services');
$images_banner_services = get_field('images_banner_services');


$image_value_services = get_field('image_value_services');
$title_value_services = get_field('title_value_services');
$description_value_services = get_field('description_value_services');
$add_list_value = get_field('add_list_value');

$sub_title_solution = get_field('sub_title_solution');
$title_solution = get_field('title_solution');
$list_solution_services = get_field('list_solution_services');

$title_product_services = get_field('title_product_services');
$desciprtion_services_product = get_field('desciprtion_services_product');
$image_services_products = get_field('image_services_products');
$list_services_product = get_field('list_services_product');

$title_section_bottom = get_field('title_section_bottom','option');
$action_contact = get_field('action_contact','option');
$image_section_action = get_field('image_section_action','option');


?>
    


                                
    <section class="page-title-area page-title-area2 sky-blue-bg pt-230 pb-90 pt-lg-195 pt-md-160 pt-xs-160 ">
            <img class="page-shape shape_01 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-13.png" alt="Page Shape">
            <img class="page-shape shape_04 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/orange-1.svg" alt="Page Shape">
            <img class="page-shape shape_05 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="Page Shape">
            <img class="page-shape shape_06 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/berry-1.svg" alt="Page Shape">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-8 col-lg-7 col-md-6">
                        <div class="page-title-wrapper text-start">
                            <h4 class="styled-text theme-color mb-30"><?php echo $sub_title_services; ?></h4>
                            <h1 class="h1 page-title mb-35"><?php echo $title_banner_services; ?></h1>
                            <p class="fs-20"><?php echo $description_banner_services; ?></p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-6">
                        <div class="page-title-img-wrapper text-end">                         
                           <img class="breadcrumb-img" src="<?= esc_url($images_banner_services['url']);?>" alt="<?= esc_attr($images_banner_services['alt']);?>">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--slider-area end-->
        <!--value-added-services start-->
        <section class="value-added-services position-relative pt-120 pb-45 pt-lg-80">
            <img class="value-shape vshape-1 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-a.svg" alt="Dot Shape">
            <img class="value-shape vshape-2 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-baby-1.svg" alt="Line Shape">
             <div class="container">
                 <div class="row align-items-center">
                     <div class="col-xl-6 col-lg-6 col-md-6">
                         <div class="value-added-img mb-30">                            
                             <img class="w-100" src="<?= esc_url($image_value_services['url']);?>" alt="<?= esc_attr($image_value_services['alt']);?>">
                         </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6">
                         <div class="value-added-content mb-30">
                             <div class="section-title section-title2">
                                 <h2 class="mb-35"><?php echo $title_value_services; ?></h2>
                                 <?php echo $description_value_services;?>
                             </div>
                             <?php echo $add_list_value; ?>
                            
                         </div>
                     </div>
                 </div>
             </div>
        </section>
        <!--value-added-services end-->
        
        <!--air-freight-services start-->
        <section class="air-freight-services position-relative overflow-hidden pt-75 pb-45">
            <img class="air-shape shape_01 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-baby-1.svg" alt="Air Shape">
            <img class="air-shape shape_02 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-1.svg" alt="Air Shape">
             <div class="container">
                 <div class="row align-items-center">
                     <div class="col-xl-6 col-lg-6">
                         <div class="shipment-time-content pr-40">
                             <div class="section-title section-title2">
                                 <h2 class="mb-30"><?php echo $title_product_services; ?></h2>
                                 <?php echo $desciprtion_services_product; ?>
                             </div>
                             <div class="text-list-box mb-45">
                                <?php echo $list_services_product; ?>
                             </div>
                             <div class="shipment-time">
                                <?php 
                                    if(have_rows('shipment_time')) {
                                        $count = 1;
                                        while(have_rows('shipment_time')) {
                                            the_row();

                                            $expedited_title = get_sub_field('expedited_title');
                                            $expedited_time = get_sub_field('expedited_time');
                                            $expedited_description = get_sub_field('expedited_description');

                                            ?>
                                                <div class="box-one mb-30 <?php echo ($count === 2) ? 'box-2' : ''; ?>">
                                                    <h3 class="fw-semibold"><?php echo $expedited_title; ?></h3>
                                                    <h4 class="h2 box-title mb-0 lh-1"><?php echo $expedited_time; ?></h4>
                                                    <p><?php echo $expedited_description; ?></p>
                                                </div>
                                            <?php

                                            $count++;
                                        }
                                    }
                                ?>
                                
                             </div>
                         </div>
                     </div>
                     <div class="col-xl-6 col-lg-6">
                         <div class="shipment-content-img mb-30 pl-40">
                             
                            <img class="w-100" src="<?= esc_url($image_services_products['url']);?>" alt="<?= esc_attr($image_services_products['alt']);?>">

                             
                         </div>
                     </div>
                 </div>
             </div>
        </section>
        <!--air-freight-services end-->
        <!--call-to-action start-->
        <section class="call-to-action pt-100 pb-120 pt-md-60 pb-lg-80 pb-md-30 pt-xs-60 pb-xs-30">
            <img class="cta-shape cta-one cta-service2 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/cta/cta-eclip-1.svg" alt="Cta Shape">
            <img class="cta-shape cta-two cta-inner-shape" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/box-2.svg" alt="Cta Shape">
            <div class="container">
                <div class="cta-border">
                    <div class="row align-items-center">
                        <div class="col-lg-7 col-md-7">
                            <div class="cta-title text-center text-md-start mb-30">
                                <!-- <h2>Let's co-create the right digital Logistic solution for your business.</h2>
                                <a href="contact.html" class="theme_btn black-btn cta-btn">Let’s Discuss</a> -->
                                <h2><?= $title_section_bottom;?></h2>
                                <?php 
                                    if( $action_contact ): 
                                        $link_url = $action_contact['url'];
                                        $link_title = $action_contact['title'];
                                        $link_target = $action_contact['target'] ? $link['target'] : '_self';
                                    ?>
                                <?php endif; ?>
                                <a href="<?= $link_url;?>" class="theme_btn black-btn cta-btn"><?= $link_title;?></a>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5">
                            <div class="chat-manager text-center text-lg-end mb-30">
                                <img src="<?php echo esc_url($image_section_action['url']); ?>" height="270px" width="auto"">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--call-to-action end-->
<?php
get_footer();