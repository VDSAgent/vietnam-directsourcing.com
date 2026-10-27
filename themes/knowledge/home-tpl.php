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
    <img aria-hidden="true" class="slider-shape sshape-1 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-11.png" alt="">
    <img aria-hidden="true" class="slider-shape sshape-2 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/orange-1.svg" alt="">
    <img aria-hidden="true" class="slider-shape sshape-3 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="">
    <img aria-hidden="true" class="slider-shape sshape-4 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/berry-1.svg" alt="">
    <img aria-hidden="true" class="slider-shape sshape-5 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/truck.svg" alt="">
    <img aria-hidden="true" class="slider-shape sshape-6 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-a.svg" alt="">
    <img aria-hidden="true" class="slider-shape sshape-9 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/nav-box.svg" alt="">
    <img aria-hidden="true" class="slider-shape transport img-one" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider/plane.svg" alt="">
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
<!--slider-area end--><!-- VDS intro section start --><section class='vds-intro-area vds-intro-grid pt-100 pb-60 pt-md-60 pb-md-40 pt-xs-60 pb-xs-40'><div class='container'><div class='row justify-content-center'><div class='col-xl-10 col-lg-11'><div class='section-title text-center mb-25'><h2>Your Trusted Sourcing Partner in Vietnam</h2></div><p class='vds-intro-lead'>We help international buyers find, vet and manage factories across Vietnam.<br>No middlemen, no retainer.</p><ul class='vds-cat-grid'><li><svg viewBox="0 0 64 64" width="72" height="72" aria-hidden="true" focusable="false"><g fill="none" stroke="#16243D" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><rect x="14" y="8" width="9" height="50" rx="3"/><path d="M14 22h9M14 36h9M14 49h9"/><rect x="31" y="20" width="9" height="38" rx="3"/><path d="M31 33h9M31 46h9"/></g><path d="M43 24c1-8 7-13 15-13 0 8-6 14-15 13z" fill="#E3A23A" stroke="#E3A23A" stroke-width="1.5" stroke-linejoin="round"/><path d="M43 24l8-6" fill="none" stroke="#fff" stroke-width="1.4" stroke-linecap="round"/></svg><strong>Bamboo &amp; Wood</strong><span>Furniture, homewares</span></li><li><svg viewBox="0 0 64 64" width="72" height="72" aria-hidden="true" focusable="false"><g fill="none" stroke="#16243D" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M13 22h38l4 33H9z"/><path d="M23 22v-4a9 9 0 0 1 18 0v4"/></g><path d="M23 47c0-9 6-13 18-13 0 9-7 15-18 13z" fill="#E3A23A" stroke="#E3A23A" stroke-width="1.5" stroke-linejoin="round"/><path d="M23 47l9-8" fill="none" stroke="#fff" stroke-width="1.4" stroke-linecap="round"/></svg><strong>Biodegradable Plastic &amp; Paper</strong><span>Eco packaging, tableware</span></li><li><svg viewBox="0 0 64 64" width="72" height="72" aria-hidden="true" focusable="false"><rect x="19.5" y="26" width="18" height="12" fill="#E3A23A" opacity=".9"/><g fill="none" stroke="#16243D" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><rect x="8" y="14" width="48" height="38" rx="3"/><path d="M8 26h48M8 39h48M30 14v12M19 26v13M41 26v13M30 39v13"/></g></svg><strong>Construction Materials</strong><span>Tiles, stone, fixtures</span></li><li><svg viewBox="0 0 64 64" width="72" height="72" aria-hidden="true" focusable="false"><g fill="none" stroke="#16243D" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="46" height="46" rx="11"/></g><path d="M32 19v26M19 32h26" fill="none" stroke="#E3A23A" stroke-width="6" stroke-linecap="round"/></svg><strong>Health Care</strong><span>Medical supplies</span></li><li><svg viewBox="0 0 64 64" width="72" height="72" aria-hidden="true" focusable="false"><g fill="none" stroke="#16243D" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M22 9L7 17l6 12 7-3v29h24V26l7 3 6-12-15-8c-2 5-6 8-10 8s-8-3-10-8z"/></g><path d="M26 47c0-7 4-11 12-11 0 7-5 12-12 11z" fill="#E3A23A" stroke="#E3A23A" stroke-width="1.5" stroke-linejoin="round"/></svg><strong>Organic Textiles</strong><span>Organic fabric, apparel</span></li><li><svg viewBox="0 0 64 64" width="72" height="72" aria-hidden="true" focusable="false"><g fill="none" stroke="#16243D" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M8 54l9-24h37l-7 24z"/><path d="M13 42h37M28 30l-3 24M41 30l-2 24"/></g><g fill="none" stroke="#E3A23A" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="47" cy="15" r="6"/><path d="M47 3v3M47 24v3M35 15h3M56 15h3M38.5 6.5l2 2M55.5 6.5l-2 2"/></g></svg><strong>Renewable Energy</strong><span>Solar racking, components</span></li><li><svg viewBox="0 0 64 64" width="72" height="72" aria-hidden="true" focusable="false"><g fill="none" stroke="#16243D" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M13 12h38v9h-14v22h14v9H13v-9h14V21H13z"/></g><circle cx="22" cy="16.5" r="1.8" fill="#E3A23A"/><circle cx="42" cy="16.5" r="1.8" fill="#E3A23A"/><circle cx="22" cy="47.5" r="1.8" fill="#E3A23A"/><circle cx="42" cy="47.5" r="1.8" fill="#E3A23A"/></svg><strong>Steel &amp; Metal</strong><span>Fabrication, structural</span></li><li><svg viewBox="0 0 64 64" width="72" height="72" aria-hidden="true" focusable="false"><g fill="none" stroke="#16243D" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><rect x="17" y="17" width="30" height="30" rx="4"/><path d="M25 9v8M32 9v8M39 9v8M25 47v8M32 47v8M39 47v8M9 25h8M9 32h8M9 39h8M47 25h8M47 32h8M47 39h8"/></g><rect x="26" y="26" width="12" height="12" rx="2" fill="none" stroke="#E3A23A" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/></svg><strong>Electronic Components</strong><span>PCBs, assemblies</span></li><li><svg viewBox="0 0 64 64" width="72" height="72" aria-hidden="true" focusable="false"><g fill="none" stroke="#16243D" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M13 9h9v8l5 7v31H8V24l5-7z" transform="translate(2 0)"/><path d="M15 15h9" /></g><g fill="none" stroke="#E3A23A" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><rect x="38" y="33" width="19" height="22" rx="2"/><path d="M38 41h19"/></g></svg><strong>FMCG &amp; Consumer Goods</strong><span>Food, personal care</span></li></ul><p class='vds-intro-caption'>Local team in Hanoi, Da Nang and Ho Chi Minh City. Original factory pricing, no hidden fees.</p></div></div></div></section><!-- VDS intro section end -->

<!--manage-area start-->
<?php
$hide_manage = get_field('hide_manage');
if(empty($hide_manage) || $hide_manage[0] !== 'yes') { ?>
<section class="manage-area shape-style pt-120 pb-120 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">
    <img aria-hidden="true" class="manage-shape mshape-1 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-baby-1.svg" alt="">
    <img aria-hidden="true" class="manage-shape mshape-2 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/box-1.svg" alt="">
    <img aria-hidden="true" class="manage-shape mshape-3 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-3.svg" alt="">
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
                <img aria-hidden="true" class="manage-shape mshape-4 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/berry-1.svg" alt="">
                <img aria-hidden="true" class="manage-shape mshape-5 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-a.svg" alt="">
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
        <img aria-hidden="true" class="chose-shape cshape-3 d-none d-xl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-a.svg" alt="">
        <img aria-hidden="true" class="chose-shape cshape-4 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/chose/big-truck.svg" alt="">
        <img aria-hidden="true" class="chose-shape cshape-5 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/chose/big-truck.svg" alt="">
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
                        <img aria-hidden="true" class="chose-shape cshape-1" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/orange-3.svg" alt="">
                        <img aria-hidden="true" class="chose-shape cshape-2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-b.svg" alt="">
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
<img aria-hidden="true" class="team-shape tmshape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="">
<img aria-hidden="true" class="team-shape tmshape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/round-line-b.svg" alt="">
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
            <img aria-hidden="true" class="team-shape tmshape-1" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="">
            <img aria-hidden="true" class="team-shape tmshape-2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/border-line-1.svg" alt="">
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
            <img aria-hidden="true" class="team-shape tmshape-1" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="">
            <img aria-hidden="true" class="team-shape tmshape-2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/border-line-1.svg" alt="">
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
<?php
get_template_part( 'template-parts/cta', null, array(
	'image'         => home_url( '/wp-content/uploads/2024/12/Report-Image.png' ),
	'shapes'        => 'home',
	'text_cols'     => 7,
	'section_class' => 'pt-100 pb-120 pt-md-60 pb-lg-80 pb-md-30 pt-xs-60 pb-xs-30',
) );
?>
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