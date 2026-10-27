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
