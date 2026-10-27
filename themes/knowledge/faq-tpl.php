<?php
/*
// Template Name: FAQs Template
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
							<h1 class="h1 page-title"><?php echo get_field("title_faq"); ?></h1>
                            <h4 class="styled-text theme-color mb-30"><?php echo get_field("subtitle_faq_"); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        <!--page-title-area end-->
        
        <!--shipping-discount start-->
        <?php 
        $hide_faq = get_field('hide_faq');        
         if(empty( $hide_faq ) || $hide_faq[0] !=='yes') { ?>
        <section class="grey-bg-soft3 faq-area-2 position-relative fix pt-105 pb-90 pt-lg-80 pb-lg-50 pt-md-60 pb-md-30 pt-xs-60 pb-xs-30">
            <img aria-hidden="true" class="shipping-shape sshape-1 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/eclip-1.svg" alt="">
            <img aria-hidden="true" class="faq-shape sshape-2 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-5.svg" alt="">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        
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

                            </div>
                        </div>
                    </div>
                    
                   <div class="col-lg-12">
                       <div class="faq-img-box text-center mb-30">
                            <?php 
                                $heading_bottom = get_field('heading_bottom');
                                
                                if( !empty( $heading_bottom ) ) {
                                    ?>
                                        <h4><?php echo $heading_bottom; ?><h4>
                                    <?php
                                }
                                $content_bottom = get_field('content_bottom');
                                if( !empty( $content_bottom ) ) {
                                    ?>
                                        <div><?php echo $content_bottom; ?></div>
                                    <?php
                                }

                            ?>
                            
                       </div>
                   </div>
                </div><!--/.row-->
            </div><!--/.container-->
        </section>
				
				<br><br><br>
<?php get_template_part( 'template-parts/cta' ); ?>
				
				
        <?php } ?>
        <!--shipping-discount end-->

<?php
get_footer();