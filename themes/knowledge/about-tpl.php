<?php
/*
// Template Name: About Us Template
*/
get_header();

$heading_small_banner_about = get_field('heading_small_banner_about');
$heading_big_banner_about = get_field('heading_big_banner_about');
$hide_banner = get_field('hide_banner');
if(empty( $hide_banner ) || $hide_banner[0] !=='yes') { ?>
<section class="page-title-area sky-blue-bg pt-280 pb-130 pt-lg-200 pt-md-160 pb-md-120 pt-xs-160 pb-xs-90">
<img aria-hidden="true" class="page-shape shape_01 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-11.png" alt="">
<img aria-hidden="true" class="page-shape shape_04 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/orange-1.svg" alt="">
<img aria-hidden="true" class="page-shape shape_05 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="">
<img aria-hidden="true" class="page-shape shape_06 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/berry-1.svg" alt="">
<img aria-hidden="true" class="page-shape shape_07 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/truck.svg" alt="">
<img aria-hidden="true" class="page-shape shape_08 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-a.svg" alt="">
<img aria-hidden="true" class="page-shape shape_09 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/nav-box.svg" alt="">
<div class="container">
<div class="row justify-content-center">
<div class="col-xl-8">
<div class="page-title-wrapper text-center">
<h1 class="h1 page-title"><?php echo $heading_big_banner_about; ?></h1>
<h4 class="styled-text theme-color mb-30"><?php echo $heading_small_banner_about; ?></h4>
</div>
</div>
</div>
</div>
</section>
<?php }

// Company page sections, top to bottom (formerly WPCode snippets 4196 and 4004,
// which appended them in the footer and re-ordered the page with CSS).
get_template_part( 'template-parts/company/hero' );
get_template_part( 'template-parts/company/regions' );
get_template_part( 'template-parts/company/team' );
get_template_part( 'template-parts/company/how-we-work' );
get_template_part( 'template-parts/company/ecosystem' );
get_template_part( 'template-parts/cta' );

get_footer();
