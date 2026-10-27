<?php
/*
// Template Name: About Us Template
*/
get_header();

$heading_small_banner_about = get_field('heading_small_banner_about');
$heading_big_banner_about = get_field('heading_big_banner_about');

$heading_small_wcu = get_field('heading_small_wcu');
$title_section_wcu = get_field('title_section_wcu');
$description_why_choose_us_right = get_field('description_why_choose_us_right');
$description_why_choose_us_bottom = get_field('description_why_choose_us_bottom');
$action_why_choose_us = get_field('action_why_choose_us');
$image_wcu = get_field('image_wcu');

$title_brand = get_field('title_brand');
$description_brand = get_field('description_brand');
$list_item_brand = get_field('list_item_brand');


$title_team = get_field('title_team');
$description_team = get_field('description_team');

$title_shipping_discount = get_field('title_shipping_discount');
$des_shipping_discount = get_field('des_shipping_discount');
$action_shipping_discount = get_field('action_shipping_discount');
$image_shipping_discount = get_field('image_shipping_discount');

?>
<!--slider-area start-->
<?php
$hide_banner = get_field('hide_banner');
if(empty( $hide_banner ) || $hide_banner[0] !=='yes') { ?>
<section class="page-title-area sky-blue-bg pt-280 pb-130 pt-lg-200 pt-md-160 pb-md-120 pt-xs-160 pb-xs-90">
<img class="page-shape shape_01 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-11.png" alt="Page Shape">
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
<h1 class="h1 page-title"><?php echo $heading_big_banner_about; ?></h1>
<h4 class="styled-text theme-color mb-30"><?php echo $heading_small_banner_about; ?></h4>
</div>
</div>
</div>
</div>
</section>
<?php } ?>
<!--slider-area end-->
<!--why-chose-us start-->
<?php
$hide_whyshouldyouchoose = get_field('hide_whyshouldyouchoose');
if(empty( $hide_whyshouldyouchoose ) || $hide_whyshouldyouchoose[0] !=='yes') { ?>
<section class="why-chose-us shape-style position-relative">
<div class="grey-bg-soft why-chose-us-bg position-relative pt-115 pt-lg-40 pt-md-60 pt-xs-60 pb-100">
<img class="chose-shape cshape-3 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-a.svg" alt="">
<img class="chose-shape cshape-4 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/chose/big-truck.svg" alt="">
<img class="chose-shape cshape-5 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/chose/big-truck.svg" alt="">
<div class="container">
<div class="row align-items-center">
<div class="col-xl-4 col-lg-6">
<div class="chose-img-wrapper mb-30">
<?php if( is_array($image_wcu) && isset($image_wcu['url']) ) { ?>
<img class="big-img" src="<?php echo esc_url($image_wcu['url']); ?>" alt="<?php echo esc_attr($image_wcu['alt']); ?>">
<?php } ?>
<img class="chose-shape cshape-1" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/orange-3.svg" alt="">
<img class="chose-shape cshape-2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-b.svg" alt="">
</div>
</div>
<div class="col-xl-8 col-lg-6">
<div class="chose-wrapper white-bg pt-110 pr-65 pb-55 pl-115 mb-30">
<div class="section-title pr-65">
<h6 class="mb-25"><?php echo $heading_small_wcu; ?></h6>
<h2><?php echo $title_section_wcu; ?></h2>
</div>
<div class="chose-box mb-10">
<ul class="single-box-list pr-45">
<?php if( have_rows('list_why_choose_us') ): ?>
<?php while( have_rows('list_why_choose_us') ): the_row();
$icon_item = get_sub_field('icon_item');
$title_item = get_sub_field('title_item');
?>
<li>
<div class="single-box">
<?php if( is_array($icon_item) && isset($icon_item['url']) ) { ?>
<img src="<?php echo esc_url($icon_item['url']); ?>" alt="<?php echo esc_attr($icon_item['alt']); ?>">
<?php } ?>
<h4 class="ml-25"><?php echo $title_item; ?></h4>
</div>
</li>
<?php endwhile; ?>
<?php endif; ?>
</ul>
<p><?php echo $description_why_choose_us_right; ?></p>
</div>
<p><?php echo $description_why_choose_us_bottom; ?></p>
<?php if( $action_why_choose_us ) {
$link_url_wcu = $action_why_choose_us['url'];
$link_title_wcu = $action_why_choose_us['title'];
?>
<a href="<?php echo esc_url($link_url_wcu); ?>" class="theme_btn mt-40"><?php echo esc_html($link_title_wcu); ?></a>
<?php } ?>
</div>
</div>
</div><!--/.row-->
</div><!--/.container-->
</div>
</section>
<?php } ?>
<!--why-chose-us end-->
<!--onestop-mangement start-->
<?php
$hide_oneplace = get_field('hide_oneplace');
if(empty( $hide_oneplace ) || $hide_oneplace[0] !=='yes') { ?>
<section class="onestop-management pt-120 pb-90 pt-lg-80 pb-lg-50 pt-md-60 pb-md-30 pt-xs-60 pb-xs-30">
<img class="manage-shape manage-1 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-baby-1.svg" alt="">
<img class="manage-shape manage-2 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/box-1.svg" alt="">
<img class="manage-shape manage-3 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-3.svg" alt="">
<div class="container">
<div class="row align-items-center">
<div class="col-lg-6">
<div class="section-title management-title pr-30">
<h2><?php echo $title_brand; ?></h2>
<p><?php echo $description_brand; ?></p>
</div>
</div>
<div class="col-lg-6 trusted-area pl-60">
<div class="row">
<div class="col-lg-6 col-md-8 col-12">
<div class="row-count-content">
<?php if( have_rows('list_item_brand_left') ):
$i = 0;
?>
<?php while( have_rows('list_item_brand_left') ): the_row();
$i++;
$class_brand = ($i == 1) ? 'one' : 'two';
$number_award = get_sub_field('number_award');
$title_award = get_sub_field('title_award');
$description_award = get_sub_field('description_award');
?>
<div class="row-count-<?php echo $class_brand; ?>">
<div class="counter-box cb-1 wow fadeInUp2 animated" data-wow-delay="0.1s">
<h2><span class="counter"><?php echo $number_award; ?></span><b>+</b></h2>
<h3><?php echo $title_award; ?></h3>
<p><?php echo $description_award; ?></p>
</div>
</div>
<?php endwhile; ?>
<?php endif; ?>
</div>
</div>
<div class="col-lg-6 col-md-4 col-sm-6 col-12">
<div class="counter-box cb-3 mt-140 wow fadeInUp2 animated" data-wow-delay="0.3s">
<?php if( have_rows('list_item_brand_right') ): ?>
<?php while( have_rows('list_item_brand_right') ): the_row();
$number_award_r = get_sub_field('number_award');
$title_award_r = get_sub_field('title_award');
$description_award_r = get_sub_field('description_award');
?>
<h2><span class="counter"><?php echo $number_award_r; ?></span><b>+</b></h2>
<h3><?php echo $title_award_r; ?></h3>
<p><?php echo $description_award_r; ?></p>
<?php endwhile; ?>
<?php endif; ?>
</div>
</div>
</div>
</div>
</div><!--/.row-->
</div><!--/.container-->
</section>
<?php } ?>
<!--onestop-mangement end-->
<!--left-right-content start-->
<?php
$hide_team = get_field('hide_team');
if(empty($hide_team) || $hide_team[0] !== 'yes') {
  $team_q = new WP_Query(['post_type'=>'team','post_status'=>'publish','posts_per_page'=>-1,'orderby'=>'date','order'=>'ASC']);
  if($team_q->have_posts()):
?>
<section class="copic-team position-relative pt-80 pb-120 pt-lg-70 pb-lg-70 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">
<img class="team-shape tmshape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="">
<img class="team-shape tmshape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/round-line-b.svg" alt="">
<div class="container">
<div class="section-title text-center mb-85">
<?php echo $title_team; ?>
<p class="sect-title"><?php echo $description_team; ?></p>
</div>
<div class="team-active owl-carousel">
<?php while($team_q->have_posts()): $team_q->the_post();
  $pos = get_field('position');
  $img = get_the_post_thumbnail_url(get_the_ID(),'full');
?>
<div class="item">
  <div style="text-align:center;border-radius:8px;overflow:hidden;background:#fff;box-shadow:0 2px 12px rgba(0,0,0,0.07);">
    <?php if($img): ?>
    <img src="<?php echo esc_url($img); ?>" alt="<?php the_title(); ?>" style="width:100%;display:block;aspect-ratio:1/1;object-fit:cover;object-position:center top;">
    <?php else: ?>
    <div style="height:200px;background:#eef1f5;display:flex;align-items:center;justify-content:center;">
      <svg width="70" height="70" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="40" cy="28" r="18" fill="#bcc8d4"/><ellipse cx="40" cy="70" rx="28" ry="18" fill="#bcc8d4"/></svg>
    </div>
    <?php endif; ?>
    <div style="padding:14px 12px 18px;">
      <h4 style="display:block !important;margin:0 0 4px;font-size:17px;font-weight:700;color:#18152c;"><?php the_title(); ?></h4>
      <?php if($pos): ?><p style="display:block !important;margin:0;color:#666;font-size:14px;"><?php echo esc_html($pos); ?></p><?php endif; ?>
    </div>
  </div>
</div>
<?php endwhile; wp_reset_postdata(); ?>
</div>
</div>
</section>
<?php endif; } ?>
<!--left-right-content end-->
<!--copic-team start-->
<?php
$hide_lr = get_field('hide_content_leftright');
if( empty($hide_lr) || $hide_lr[0] !== 'yes' ) { ?>
<section class="sky-blue-bg logistics-services round-background pt-120 pb-110 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section-title text-center mb-80">
                    <h2>What Sets Our Company Apart</h2>
                    <p class="sect-title">Experienced. Technology-driven. Cost-effective.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="c-services text-center wow fadeInUp2 mb-30" data-wow-delay="0.1s">
                    <div style="width:250px;margin:0 auto 20px;"><img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Localised-Expertise-3.png" alt="Localised Expertise" style="width:100%;height:auto;border-radius:8px;display:block;"></div>
                    <h3 class="service-title mb-25">Localised Expertise</h3>
                    <p class="mb-35">Boots on the ground across all regions of Vietnam.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="c-services text-center wow fadeInUp2 mb-30" data-wow-delay="0.2s">
                    <div style="width:250px;margin:0 auto 20px;"><img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Global-Leadership-3.png" alt="Global Leadership" style="width:100%;height:auto;border-radius:8px;display:block;"></div>
                    <h3 class="service-title mb-25">Global Leadership</h3>
                    <p class="mb-35">Led by a 25-year Asia-based sourcing veteran.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="c-services text-center wow fadeInUp2 mb-30" data-wow-delay="0.3s">
                    <div style="width:250px;margin:0 auto 20px;"><img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Customised-Solutions-3.png" alt="Customised Solutions" style="width:100%;height:auto;border-radius:8px;display:block;"></div>
                    <h3 class="service-title mb-25">Customised Solutions</h3>
                    <p class="mb-35">Sourcing strategies built around your product needs.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="c-services text-center wow fadeInUp2 mb-30" data-wow-delay="0.4s">
                    <div style="width:250px;margin:0 auto 20px;"><img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Cost-Effective-Solutions-3.png" alt="Cost-Effective Solutions" style="width:100%;height:auto;border-radius:8px;display:block;"></div>
                    <h3 class="service-title mb-25">Cost-Effective Solutions</h3>
                    <p class="mb-35">Factory-direct pricing with full cost transparency.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="c-services text-center wow fadeInUp2 mb-30" data-wow-delay="0.5s">
                    <div style="width:250px;margin:0 auto 20px;"><img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Technology-Driven-3.png" alt="Technology-Driven" style="width:100%;height:auto;border-radius:8px;display:block;"></div>
                    <h3 class="service-title mb-25">Technology-Driven</h3>
                    <p class="mb-35">Over 20 tools integrated across our tech stack.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="c-services text-center wow fadeInUp2 mb-30" data-wow-delay="0.6s">
                    <div style="width:250px;margin:0 auto 20px;"><img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Quality-Assurance-3.png" alt="Quality Assurance" style="width:100%;height:auto;border-radius:8px;display:block;"></div>
                    <h3 class="service-title mb-25">Quality Assurance</h3>
                    <p class="mb-35">Robust internal and independent 3rd-party standards.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<!--copic-team end-->
<!--technology-ecosystem start-->
<section class="pt-120 pb-110 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section-title text-center mb-80">
                    <h2><strong>Our Sourcing Software Ecosystem</strong></h2>
                    <p class="sect-title">We have integrated some of the best technology to help our team deliver innovative, high-value global product-sourcing solutions for our clients.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-40 text-center">
                <img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/07/apollo-io-logo.png" alt="Apollo.io logo" style="width:150px;max-width:100%;height:auto;display:block;margin:0 auto;">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-40 text-center">
                <img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/07/calendly-logo.png" alt="Calendly logo" style="width:150px;max-width:100%;height:auto;display:block;margin:0 auto;">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-40 text-center">
                <img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/07/claude-logo.png" alt="Claude logo" style="width:150px;max-width:100%;height:auto;display:block;margin:0 auto;">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-40 text-center">
                <img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/07/digitalocean-logo.png" alt="DigitalOcean logo" style="width:150px;max-width:100%;height:auto;display:block;margin:0 auto;">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-40 text-center">
                <img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/07/n8n-logo.png" alt="n8n logo" style="width:150px;max-width:100%;height:auto;display:block;margin:0 auto;">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-40 text-center">
                <img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/07/notebooklm-logo.png" alt="NotebookLM logo" style="width:150px;max-width:100%;height:auto;display:block;margin:0 auto;">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-40 text-center">
                <img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/07/odoo-logo.png" alt="Odoo logo" style="width:150px;max-width:100%;height:auto;display:block;margin:0 auto;">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-40 text-center">
                <img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/07/retell-ai-logo.png" alt="Retell AI logo" style="width:150px;max-width:100%;height:auto;display:block;margin:0 auto;">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-40 text-center">
                <img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/07/twilio-logo.png" alt="Twilio logo" style="width:150px;max-width:100%;height:auto;display:block;margin:0 auto;">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-40 text-center">
                <img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/07/typeform-logo.png" alt="Typeform logo" style="width:150px;max-width:100%;height:auto;display:block;margin:0 auto;">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-40 text-center">
                <img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/07/wordpress-logo.png" alt="WordPress logo" style="width:150px;max-width:100%;height:auto;display:block;margin:0 auto;">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-40 text-center">
                <img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/07/zoom-logo.png" alt="Zoom logo" style="width:150px;max-width:100%;height:auto;display:block;margin:0 auto;">
            </div>
        </div>
    </div>
</section>
<!--technology-ecosystem end-->
<!--experienced-suppliers start-->
<section class="sky-blue-bg round-background pt-120 pb-110 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60 vds-hidden-stock-images" style="display:none !important;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section-title text-center mb-80">
                    <h2 class="mb-30">Our Experienced <span class="bg-shape">Suppliers</span></h2>
                    <p class="sect-title">Vietnam excels in sourcing due to its cost-effectiveness, skilled labor force, strategic location, and strong manufacturing capabilities.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-30">
                <div style="border-radius:8px;overflow:hidden;">
                    <img src="https://vietnam-directsourcing.com/wp-content/uploads/2024/08/workers-at-e-cigarettes-battery-factory-guangdong-2023-11-27-05-03-46-utc.jpeg" alt="Workers on a Vietnamese electronics manufacturing line in a factory" style="width:100%;height:220px;object-fit:cover;display:block;">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-30">
                <div style="border-radius:8px;overflow:hidden;">
                    <img src="https://vietnam-directsourcing.com/wp-content/uploads/2024/08/chuttersnap-fN603qcEA7g-unsplash.jpg" alt="Stacked shipping containers at a cargo port in Vietnam" style="width:100%;height:220px;object-fit:cover;display:block;">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-30">
                <div style="border-radius:8px;overflow:hidden;">
                    <img src="https://vietnam-directsourcing.com/wp-content/uploads/2024/08/foreman-or-worker-work-at-factory-site-check-up-ma-2023-11-27-04-51-20-utc-1.jpg" alt="Factory foreman inspecting pipe on a production floor" style="width:100%;height:220px;object-fit:cover;display:block;">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-30">
                <div style="border-radius:8px;overflow:hidden;">
                    <img src="https://vietnam-directsourcing.com/wp-content/uploads/2024/08/woman-inspection-engineer-working-in-term-of-water-2023-11-27-05-05-59-utc.jpg" alt="Female inspection engineer conducting quality control review in factory" style="width:100%;height:220px;object-fit:cover;display:block;">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-30">
                <div style="border-radius:8px;overflow:hidden;">
                    <img src="https://vietnam-directsourcing.com/wp-content/uploads/2024/08/quality-control-qc-engineer-monitoring-and-check-2023-11-27-05-34-26-utc.jpg" alt="Quality control inspector reviewing products on a manufacturing floor in Vietnam" style="width:100%;height:220px;object-fit:cover;display:block;">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-30">
                <div style="border-radius:8px;overflow:hidden;">
                    <img src="https://vietnam-directsourcing.com/wp-content/uploads/2024/08/foreman-or-worker-work-at-factory-site-check-up-ma-2023-11-27-05-11-17-utc.jpg" alt="Factory foreman inspecting machinery on a production floor" style="width:100%;height:220px;object-fit:cover;display:block;">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-30">
                <div style="border-radius:8px;overflow:hidden;">
                    <img src="https://vietnam-directsourcing.com/wp-content/uploads/2024/08/4-men-warehouse-worker-open-doors-steel-40-feet-co-2023-11-27-04-50-00-utc.jpg" alt="Warehouse workers opening doors of a steel shipping container" style="width:100%;height:220px;object-fit:cover;display:block;">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-30">
                <div style="border-radius:8px;overflow:hidden;">
                    <img src="https://vietnam-directsourcing.com/wp-content/uploads/2024/08/a-female-diesel-engine-mechanic-in-a-blue-uniform-2023-11-27-05-09-50-utc.jpg" alt="Female mechanic in blue uniform working on a diesel engine" style="width:100%;height:220px;object-fit:cover;display:block;">
                </div>
            </div>
        </div>
    </div>
</section>
<!--experienced-suppliers end-->
<!--shipping-discount start-->
<?php
$hide_shipping = get_field('hide_shipping');
if(empty( $hide_shipping ) || $hide_shipping[0] !=='yes') { ?>
<section class="shipping-discount position-relative fix pt-75 pb-120 pb-lg-50 pt-md-60 pb-md-30 pt-xs-60 pb-xs-30">
<img class="shipping-shape sshape-1 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/box-2.svg" alt="">
<img class="shipping-shape sshape-2 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/chose/big-truck.svg" alt="">
<div class="container">
<div class="row align-items-center">
<div class="col-lg-6">
<div class="section-title text-start mb-30">
<h2 class="mb-30"><?php echo $title_shipping_discount; ?></h2>
<p class="sect-title mb-50"><?php echo $des_shipping_discount; ?></p>
<?php if( is_array($action_shipping_discount) && isset($action_shipping_discount['url']) ) {
$sd_url = $action_shipping_discount['url'];
$sd_title = $action_shipping_discount['title'];
?>
<a href="<?php echo esc_url($sd_url); ?>" class="theme_btn theme_btn_border border_btn_red"><?php echo esc_html($sd_title); ?></a>
<?php } ?>
</div>
</div>
<div class="col-lg-6">
<div class="shipping-img-box text-center mb-30">
<img class="img-one d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shipping/black-sun.svg" alt="black sun">
<div class="bi-cycle pos-rel">
<?php if( is_array($image_shipping_discount) && isset($image_shipping_discount['url']) ) { ?>
<img class="img-two" src="<?php echo esc_url($image_shipping_discount['url']); ?>" alt="<?php echo esc_attr($image_shipping_discount['alt']); ?>">
<?php } ?>
<img class="img-three" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shipping/ring-1.svg" alt="shipping img">
<img class="img-four" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shipping/ring-2.svg" alt="shipping img">
<img class="img-five" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shipping/plater-1.svg" alt="shipping img">
</div>
</div>
</div>
</div><!--/.row-->
</div><!--/.container-->
</section>
<?php } ?>
<!--shipping-discount end-->

<?php $image_section_action = get_field('image_section_action','option'); ?>
        <section class="call-to-action pt-100 pb-120 pt-md-60 pb-md-30 pt-xs-60">
            <img class="cta-shape cta-service1 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/cta/cta-eclip-1.svg" alt="Cta Shape">
            <img class="cta-shape cta-two" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/box-2.svg" alt="Cta Shape">
            <div class="container">
                <div class="cta-border">
                    <a href="https://vietnam-directsourcing.com//contact-for-sourcing//" style="display:block;text-decoration:none;color:inherit;cursor:pointer;">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="cta-title text-center text-md-start mb-30">
                                <h2>Let's talk about what you're sourcing</h2>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="chat-manager text-center text-lg-end mb-30">
                                <img src="<?php echo esc_url($image_section_action['url']); ?>" height="270px" width="auto">
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </section>

<?php
get_footer();