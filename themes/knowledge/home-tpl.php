<?php
/*
// Template Name: Home Template
*/
get_header();
$image_section_action = array('url' => home_url('/wp-content/uploads/2024/12/Report-Image.png'));
?>

<!--slider-area start-->
<?php
$hide_banner_home = get_field('hide_banner_home');
if(empty($hide_banner_home) || $hide_banner_home[0] !== 'yes') { ?>
<section class="slider-area pos-rel pt-240 pb-200 pt-lg-180 pt-md-160 pb-md-120 pt-xs-150 pb-xs-90">
    <img class="slider-shape sshape-1 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-11.png" alt="Page Shape">
    <img class="slider-shape sshape-2 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/orange-1.svg" alt="Page Shape">
    <img class="slider-shape sshape-3 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="Page Shape">
    <img class="slider-shape sshape-4 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/berry-1.svg" alt="Page Shape">
    <img class="slider-shape sshape-5 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/truck.svg" alt="Page Shape">
    <img class="slider-shape sshape-6 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-a.svg" alt="Page Shape">
    <img class="slider-shape sshape-9 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/nav-box.svg" alt="Page Shape">
    <img class="slider-shape transport img-one" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/plane.svg" alt="">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-8">
                <div class="slider-wrapper mb-50">
                    <h1 class="mb-25"><?php echo get_field('heading_small_banner_home'); ?></h1>
                    <h4 class="styled-text theme-color mb-30"><?php echo get_field('heading_big_banner_home'); ?></h4>
                    <?php
                    $action_home = get_field('action_home');
                    if($action_home) { ?>
                        <a href="<?php echo esc_url($action_home['url']); ?>" class="theme_btn"><?php echo esc_html($action_home['title']); ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<!--slider-area end--><!-- VDS intro section start --><section class='vds-intro-area pt-100 pb-50 pt-md-60 pb-md-20 pt-xs-60 pb-xs-20'><div class='container'><div class='row justify-content-center'><div class='col-xl-8 col-lg-10'><div class='section-title text-center mb-35'><h2>Your Trusted Sourcing Partner in Vietnam</h2></div><p>Vietnam Direct Sourcing is a full-service sourcing company that helps international buyers find, vet and manage manufacturers across Vietnam. From a single product sample to an entire supply chain, our local team handles supplier research, factory audits, quality control and logistics on your behalf &mdash; so you can source with confidence and without the middlemen. With boots on the ground in Hanoi, Da Nang and Ho Chi Minh City, we give you direct access to Vietnam&rsquo;s leading factories across bamboo and wood products, biodegradable plastic and paper, construction materials, health care products, organic textile products, renewable energy products, steel and metal products, and electronic components.</p><p>Whether you are moving production out of China, launching a new product line, or scaling an existing one, we make sourcing from Vietnam simple, transparent and low-risk. You get original factory pricing with no hidden fees, flexible pay-as-you-go services with no retainer, and a dedicated team that keeps you informed at every stage.</p></div></div></div></section><!-- VDS intro section end -->

<!--manage-area start-->
<?php
$hide_manage = get_field('hide_manage');
if(empty($hide_manage) || $hide_manage[0] !== 'yes') { ?>
<section class="manage-area shape-style pt-120 pb-120 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">
    <img class="manage-shape mshape-1 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-baby-1.svg" alt="">
    <img class="manage-shape mshape-2 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/box-1.svg" alt="">
    <img class="manage-shape mshape-3 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-3.svg" alt="">
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
            <div class="col-xl-8 col-lg-8">
                <?php echo get_field('col_manage_left'); ?>
                <img class="manage-shape mshape-4 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/berry-1.svg" alt="">
                <img class="manage-shape mshape-5 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-a.svg" alt="">
            </div>
            <div class="col-xl-4 col-lg-4">
                <?php echo get_field('col_manage_right'); ?>
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
<!--transport-area end--><!-- VDS why-choose section start --><section class='vds-why-area pt-90 pb-90 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60'><div class='container'><div class='row justify-content-center'><div class='col-xl-8 col-lg-10'><div class='section-title text-center mb-40'><h2>Why Buyers Choose Vietnam Direct Sourcing</h2></div><p><strong>25 years across Asia.</strong> Our team brings 25 years of sourcing experience across Asia, now focused on Vietnam, and operates with full transparency &mdash; no hidden fees and no commission on supplier pricing.</p><p><strong>Flexible and fair.</strong> Pay-as-you-go services with no retainer required, so you only pay for what you need.</p><p><strong>Genuinely local.</strong> Local sourcing specialists in Hanoi, Da Nang and Ho Chi Minh City give us national coverage across Vietnam&rsquo;s key manufacturing regions.</p><p><strong>Relationship-first.</strong> We take the time to understand your business, product requirements, target markets and budget, then match you with the most suitable factories and manage the process end to end.</p><p><strong>Built for every size.</strong> From independent retailers and startups to large-scale importers and global brands, we make sourcing from Vietnam simple, transparent and risk-free.</p></div></div></div></section><!-- VDS why-choose section end -->

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
                    <div class="embed-container" style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;max-width:100%;">
                    <iframe style="position:absolute;top:0;left:0;width:100%;height:100%;" src="https://www.youtube.com/embed/lOyaK9q8_iU?rel=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div><!--/.container-->
</section>
<?php } ?>
<!--slider-video end-->

<?php $hide_team_section = get_field('hide_team_section'); if(false) { // Team section hidden - removed ?>
<?php } ?>

<!-- Podcast Section -->
<?php
$hide_podcast = get_field('hide_podcast');
if(empty($hide_podcast) || $hide_podcast[0] !== 'yes') { ?>
<section class="podcast-area pt-100 pb-100 pt-md-60 pb-md-60">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-8 col-lg-8">
                <div class="podcast-wrapper mb-30">
                    <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/6Bcjg17uwEVN9Ht3TIsA35?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
							
							
                        </div>
						<a href="https://open.spotify.com/user/31idjwstdjg6gwvd6luqakebhzoy?si=eb68608420cf4012" target="_blank" class="theme_btn spotify-btn cta-btn">View on Spotify</a>
                    </div>

                </div>
            </div>
        </div><!--/.row-->
    </div><!--/.container-->
</section>
<?php } ?>


<!-- Podcast Section end -->



<!--why-chose-us start-->
<?php 
$hide_shyshouldyouchoose = get_field('hide_shyshouldyouchoose');        
if(empty($hide_shyshouldyouchoose) || $hide_shyshouldyouchoose[0] !== 'yes') { ?>
<section class="why-chose-us shape-style">
    <div class="grey-bg-soft why-chose-us-bg position-relative pt-115 pt-lg-40 pt-md-60 pt-xs-60 pb-100">
        <!-- Removed unnecessary elements potentially causing the unwanted box -->
        <!-- You can remove or comment out images or shapes causing the issue -->
        <!-- For example, remove these lines or adjust if necessary: -->
        <!--
        <img class="chose-shape cshape-3 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-a.svg" alt="">
        <img class="chose-shape cshape-4 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/chose/big-truck.svg" alt="">
        <img class="chose-shape cshape-5 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/chose/big-truck.svg" alt="">
        -->

        <!-- CSS Rule to Hide Box: -->
        <style>
            .unwanted-box { 
                display: none !important; 
            }
        </style>

        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-4 col-lg-6">
                    <div class="chose-img-wrapper mb-30">
                        <?php 
                        $imageWCU = get_field('image_wcu');
                        if(!empty($imageWCU)) { ?>
                            <img class="big-img" src="<?php echo esc_url($imageWCU['url']); ?>" alt="<?php echo esc_attr($imageWCU['alt']); ?>">
                        <?php } ?>
                        <img class="chose-shape cshape-1" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/orange-3.svg" alt="">
                        <img class="chose-shape cshape-2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-b.svg" alt="">
                    </div>
                </div>
                <div class="col-xl-8 col-lg-6">
                    <div class="chose-wrapper white-bg pt-110 pr-65 pb-55 pl-115 mb-30">
                        <div class="section-title pr-65">
                            <h6 class="mb-25"><?php echo get_field('heading_small_wcu'); ?></h6>
                            <h2><?php echo get_field('title_section_wcu'); ?></h2>
                        </div>
                        <div class="chose-box mb-10">
                            <ul class="single-box-list pr-45">
                                <?php 
                                if(have_rows('list_why_choose_us')) {
                                    while(have_rows('list_why_choose_us')) {
                                        the_row();
                                        $getIcon = get_sub_field('icon_item');
                                        $getTitle = get_sub_field('title_item'); ?>
                                        <li>
                                            <div class="single-box">
                                                <?php if(!empty($getIcon)) { ?>
                                                    <img src="<?php echo esc_url($getIcon['url']); ?>" alt="<?php echo esc_attr($getIcon['alt']); ?>">
                                                <?php } ?>
                                                <h4 class="ml-10"><?php echo $getTitle; ?></h4>
                                            </div>
                                        </li>
                                    <?php }
                                } ?>
                            </ul>
                            <p><?php echo get_field('description_why_choose_us_right'); ?></p>
                        </div>
                        <p><?php echo get_field('description_why_choose_us_bottom'); ?></p>
                        <?php 
                        $linkWCU = get_field('action_why_choose_us');
                        if($linkWCU) {
                            $link_url = $linkWCU['url'];
                            $link_title = $linkWCU['title']; ?>
                            <a href="<?php echo esc_url($link_url); ?>" class="theme_btn mt-40"><?php echo esc_html($link_title); ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div><!--/.row-->
        </div><!--/.container-->
    </div>
</section>
<?php } ?>

<?php
$hide_team = get_field('hide_team_section');
if(empty($hide_team) || $hide_team[0] !== 'yes') {
  $team_q = new WP_Query(['post_type'=>'team','post_status'=>'publish','posts_per_page'=>-1,'orderby'=>'date','order'=>'ASC']);
  if($team_q->have_posts()):
?>
<section class="copic-team position-relative pt-80 pb-120 pt-lg-70 pb-lg-70 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">
<img class="team-shape tmshape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="">
<img class="team-shape tmshape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/round-line-b.svg" alt="">
<div class="container">
<div class="section-title text-center mb-85">
            <h2 class="mb-30">Our Experienced Team<span class="bg-shape"></span></h2>
            <p class="sect-title">Seasoned sourcing professionals powered by cutting-edge technology - delivering cost-effective procurement solutions.</p>
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

<!--why-chose-us end-->


<!-- TECHNOLOGY SLIDER -->
<?php 
$hide_technology_section = get_field('hide_technology_section');        
if(empty($hide_technology_section) || $hide_technology_section[0] !== 'yes') { 
    ?>
        
        <!--copic-team start-->
        <section class="copic-team position-relative pt-140 pb-120 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60" style="background-color: <?php echo get_field('technology_background_color') ?>;">
            <img class="team-shape tmshape-1" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="">
            <img class="team-shape tmshape-2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/border-line-1.svg" alt="">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="copic-team-wrapper">
                            <div class="section-title text-center mb-85">
                                <?php echo get_field("technology_title"); ?>
                                <p class="sect-title"><?php echo get_field("technology_description"); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    // echo do_shortcode('[team_carousel]');   
                    $images_tes = get_field('technology_gallery');
                    if($images_tes) {
                        ?>
                            <div class="team-active owl-carousel-technology owl-carousel">
                                <?php 
                                    foreach( $images_tes as $image ) {
                                        ?>
                                            <div class="item">
                                                <div class="team-wrapper white-bg pos-rel">
                                                    <div class="team-thumb">
                                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    } 
                                
                                ?>

                            </div>
                        <?php
                    }            
                ?>
            </div><!--/.container-->
        </section>
        <!--copic-team end-->

    <?php
}

?>



<?php 
$hide_suppliers_section = array('yes'); // moved to Company page -- permanently hidden here
if(empty($hide_suppliers_section) || $hide_suppliers_section[0] !== 'yes') { 
    ?>
        
        <!--copic-team start-->
        <section class="copic-team position-relative pt-140 pb-120 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">
            <img class="team-shape tmshape-1" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="">
            <img class="team-shape tmshape-2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/border-line-1.svg" alt="">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="copic-team-wrapper">
                            <div class="section-title text-center mb-85">
                                <?php echo get_field("title_team"); ?>
                                <p class="sect-title"><?php echo get_field("description_team"); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    // echo do_shortcode('[team_carousel]');   
                    $images_tes = get_field('gallery_image');
                    if($images_tes) {
                        ?>
                            <div class="team-active owl-carousel">
                                <?php 
                                    foreach( $images_tes as $image ) {
                                        ?>
                                            <div class="item">
                                                <div class="team-wrapper white-bg pos-rel">
                                                    <div class="team-thumb">
                                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    } 
                                
                                ?>

                            </div>
                        <?php
                    }            
                ?>
            </div><!--/.container-->
        </section>
        <!--copic-team end-->

    <?php
}

?>

<!--call-to-action start-->
<section class="call-to-action pt-100 pb-120 pt-md-60 pb-lg-80 pb-md-30 pt-xs-60 pb-xs-30">
            <img class="cta-shape cta-one cta-service2 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/cta/cta-eclip-1.svg" alt="Cta Shape">
            <img class="cta-shape cta-two cta-inner-shape" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/box-2.svg" alt="Cta Shape">
            <a href="<?php echo esc_url( home_url( '/contact-for-sourcing/' ) ); ?>">
                <div class="cta-border">
                    <div class="row align-items-center">
                        <div class="col-lg-7 col-md-7">
                            <div class="cta-title text-center text-md-start mb-30">
                                <h2>Let's talk about what you're sourcing</h2>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5">
                            <div class="chat-manager text-center text-lg-end mb-30">
                                <img src="<?php echo esc_url($image_section_action['url']); ?>" height="270px" width="auto">
                            </div>
                        </div>
                    </div>
					</a>
                </div>
            </div>
        </section>
        <!--call-to-action end-->

<script>
	
 $(".owl-carousel-technology").owlCarousel({
                                items: 7,
                                itemsDesktop: [1400, 7],//1400:screen size, 3: number if items in the slide
                                itemsDesktopSmall: [1100, 7],
                                itemsTablet: [700, 4],
								 itemsMobile: [500, 2],
								 loop:true,
								 autoplayTimeout:2000,
	 								autoplaySpeed:4000,
								 autoplay:true	 
                              });	
	
</script>

<script>
setTimeout(function(){
  document.querySelectorAll('.preloader,#preloader,.page-preloader,[class*="preload"],[id*="preload"]').forEach(function(el){
    el.style.cssText="display:none!important;visibility:hidden!important;opacity:0!important";
  });
},2500);
window.addEventListener("load",function(){
  document.querySelectorAll('.preloader,#preloader,.page-preloader,[class*="preload"],[id*="preload"]').forEach(function(el){
    el.style.cssText="display:none!important;visibility:hidden!important;opacity:0!important";
  });
});
</script>
<?php
get_footer();