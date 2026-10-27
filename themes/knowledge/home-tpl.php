<?php
/*
// Template Name: Home Template
*/
get_header();
?>

<!--slider-area start-->
<?php
$hide_banner_home = get_field('hide_banner_home');
if(empty($hide_banner_home) || $hide_banner_home[0] !== 'yes') { ?>
<section class="slider-area pos-rel pt-240 pb-200 pt-lg-180 pt-md-160 pb-md-120 pt-xs-150 pb-xs-90">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-8">
                <div class="slider-wrapper mb-50">
                    <h1 class="mb-25"><?php echo get_field('heading_small_banner_home'); ?></h1>
                    <h4 class="styled-text theme-color mb-30"><?php echo get_field('heading_big_banner_home'); ?></h4>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php get_template_part( 'template-parts/home/intro' ); ?>

<!--manage-area start-->
<?php
$hide_manage = get_field('hide_manage');
if(empty($hide_manage) || $hide_manage[0] !== 'yes') { ?>
<section class="manage-area shape-style pt-120 pb-120 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="manage-title mb-55">
                    <h2><?php echo get_field('title_manage_home'); ?></h2>
                    <p class="sect-title"><?php echo get_field('description_manage'); ?></p>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12">
                <?php echo get_field('col_manage_left'); ?>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<!--manage-area end-->

<!--transport-area start-->
<?php
$hide_transport = get_field('hide_transport');
if(empty($hide_transport) || $hide_transport[0] !== 'yes') { ?>
<section class="transport-area pt-100 pb-100 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section-title text-center mb-60">
                    <?php echo get_field('title_section_multi_color'); ?>
                    <?php echo get_field('sub_title_logistic'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $services = [
                ['img' => 'Supplier-Identification.png', 'title' => 'Supplier Identification',    'desc' => 'Fast track your search for standard, ready-to-export products.',                      'link' => 'global-sourcing-solutions/#171', 'alt' => 'Supplier Identification with an image of a person staring at a warehouse full of pallets.'],
                ['img' => 'Supplier-Inspection.png',    'title' => 'Supplier Evaluation',        'desc' => 'Pre-qualify partners for custom manufacturing and OEM projects.',                     'link' => 'global-sourcing-solutions/#170', 'alt' => 'Supplier Inspection services on samples for customers in Vietnam'],
                ['img' => 'Production-Management.png',  'title' => 'Production Management',      'desc' => 'Protect your investment from the factory floor to the shipping container.',           'link' => 'global-sourcing-solutions/#169', 'alt' => 'Production Management with a worker operating a wood CNC machine on plywood.'],
                ['img' => 'End-to-end.png',             'title' => 'End-to-End Solution',        'desc' => 'Complete operational peace of mind from blueprint to final delivery.',                'link' => 'global-sourcing-solutions/#168', 'alt' => 'End to End Sourcing solutions from supplier inspection to logistics.'],
                ['img' => 'Factory-Tours.png',          'title' => 'Tailored Factory Tours',     'desc' => 'Inspect facilities, build relationships, and negotiate face-to-face.',               'link' => 'global-sourcing-solutions/#167', 'alt' => 'Factory visits for customers to a Vietnam factory.'],
                ['img' => 'Quality-Assurance.png',      'title' => 'Rigorous Quality Assurance', 'desc' => 'International compliance standards verified independently on-site.',                 'link' => 'global-sourcing-solutions/#166', 'alt' => 'Quality Testing of plywood as part of 3rd party quality assurance.'],
            ];
            foreach($services as $svc) { ?>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="transport-wrapper mb-30">
                    <div class="transport-img">
                        <img class="vds-info-image" src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/<?php echo $svc['img']; ?>" alt="<?php echo esc_attr($svc['alt']); ?>">
                    </div>
                    <div class="transport-content">
                        <h3><?php echo $svc['title']; ?></h3>
                        <p><?php echo $svc['desc']; ?></p>
                        <a href="<?php echo home_url($svc['link']); ?>" class="read-more">Discover More <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon/right-arrow.svg" alt=""></a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>

<?php get_template_part( 'template-parts/home/why' ); ?>

<!--slider-video start-->
<?php
$hide_slider_video = get_field('hide_slider_video');
if(empty($hide_slider_video) || $hide_slider_video[0] !== 'yes') { ?>
<section class="slider-video-area pt-100 pb-100 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6">
                <div class="slider-video-wrapper mb-30">
                    <div class="section-title mb-30">
                        <h2>Vietnam Sourcing Agent<span class="bg-shape"></span></h2>
                        <p class="sect-title"><?php echo get_field("description_home"); ?></p>
                    </div>
                    <br><br>
                    <div class="embed-container">
                    <iframe title="Vietnam Direct Sourcing on YouTube" src="https://www.youtube.com/embed/lOyaK9q8_iU?rel=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div><!--/.container-->
</section>
<?php } ?>
<!--slider-video end-->

<?php
vds_render_page_copy();
get_template_part( 'template-parts/cta', null, array(
	'shapes'        => 'home',
	'section_class' => 'pt-100 pb-120 pt-md-60 pb-lg-80 pb-md-30 pt-xs-60 pb-xs-30',
) );

get_footer();
