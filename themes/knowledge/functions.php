<?php
/* Theme Options */
require_once dirname( __FILE__ ) . '/core/options.php';
require_once dirname( __FILE__ ) . '/core/shortcode.php';
require_once dirname( __FILE__ ) . '/core/function_option.php';
require_once dirname( __FILE__ ) . '/core/postype.php';
//add_filter('show_admin_bar', '__return_false');
add_filter( 'sewn/seo/add_keywords', '__return_true' );
function ajaxurl(){
    ?>
    <script type="text/javascript">
        var ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>" ;
    </script>
    <?php
}
add_action('wp_head','ajaxurl');
/*
 * Register three Knowledge Theme widget areas.
 *
 * @since Knowledge Theme 1.0
 */
if(function_exists('acf_add_options_page')){
  acf_add_options_page();
  acf_add_options_sub_page('Infor Form Footer');
}
function knowledgetheme_widgets_init() {
    
    register_sidebar( array(
        'name'          => __( 'Single Post Sidebar', 'knowledgetheme' ),
        'id'            => 'single-post-sidebar',
        'description'   => __( 'Single post sidebar that appears on the right.', 'knowledgetheme' ),
        'before_widget' => '<div id="%1$s" class="widget mb-30">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title mb-20">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Single Case Sidebar', 'knowledgetheme' ),
        'id'            => 'single-case-sidebar',
        'description'   => __( 'Single case sidebar that appears on the right.', 'knowledgetheme' ),
        'before_widget' => '<div id="%1$s" class="widget mb-30">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title mb-20">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Content Sidebar', 'knowledgetheme' ),
        'id'            => 'sidebar-2',
        'description'   => __( 'Additional sidebar that appears on the right.', 'knowledgetheme' ),
        'before_widget' => '<div id="%1$s" class="footer__widget mb-30">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title mb-30">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Column One', 'knowledgetheme' ),
        'id'            => 'sidebar-one',
        'description'   => __( '', 'knowledgetheme' ),
        'before_widget' => '<div id="%1$s" class="footer__widget mb-30">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title mb-30">',
        'after_title'   => '</h4>',
    ));
    register_sidebar( array(
        'name'          => __( 'Footer Column Two', 'knowledgetheme' ),
        'id'            => 'sidebar-two',
        'description'   => __( '', 'knowledgetheme' ),
        'before_widget' => '<div id="%1$s" class="footer__widget mb-30 pl-40 pl-md-0 pl-xs-0">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title mb-30">',
        'after_title'   => '</h4>',
    ));
    register_sidebar( array(
        'name'          => __( 'Footer Column Three', 'knowledgetheme' ),
        'id'            => 'sidebar-three',
        'description'   => __( '', 'knowledgetheme' ),
        'before_widget' => '<div id="%1$s" class="footer__widget mb-25">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title mb-30">',
        'after_title'   => '</h4>',
    ));
    register_sidebar( array(
        'name'          => __( 'Footer Column Four', 'knowledgetheme' ),
        'id'            => 'sidebar-four',
        'description'   => __( '', 'knowledgetheme' ),
        'before_widget' => '<div id="%1$s" class="footer__widget mb-30">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title mb-30">',
        'after_title'   => '</h4>',
    ));
  register_sidebar( array(
    'name'          => __( 'Footer Column five', 'knowledgetheme' ),
    'id'            => 'sidebar-five',
    'description'   => __( '', 'knowledgetheme' ),
    'before_widget' => '<div id="%1$s" class="footer__widget mb-30">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title mb-30">',
    'after_title'   => '</h4>',
  ));
    register_sidebar( array(
    'name'          => __( 'Sidebar Blog', 'knowledgetheme' ),
    'id'            => 'sidebar-blog',
    'description'   => __( '', 'knowledgetheme' ),
    'before_widget' => '<div id="%1$s" class="footer__widget mb-30">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title mb-30">',
    'after_title'   => '</h4>',
  ));
  register_sidebar( array(
    'name'          => __( 'Trust Index ', 'knowledgetheme' ),
    'id'            => 'trust-index',
    'description'   => __( '', 'knowledgetheme' ),
    'before_widget' => '<div id="%1$s" class="footer__widget mb-30">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title mb-30">',
    'after_title'   => '</h4>',
  ));
  register_sidebar( array(
    'name'          => __( 'Trust Mark Footer', 'knowledgetheme' ),
    'id'            => 'trust-index-footer',
    'description'   => __( '', 'knowledgetheme' ),
    'before_widget' => '<div id="%1$s" class="footer__widget mb-30">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title mb-30">',
    'after_title'   => '</h4>',
  ));
  register_sidebar( array(
    'name'          => __( 'Trust Mark Quote Page', 'knowledgetheme' ),
    'id'            => 'trust-index-quote',
    'description'   => __( '', 'knowledgetheme' ),
    'before_widget' => '<div id="%1$s" class="footer__widget mb-30">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title mb-30">',
    'after_title'   => '</h4>',
  ));
  register_sidebar( array(
    'name'          => __( 'Trust Mark Bottom Page', 'knowledgetheme' ),
    'id'            => 'trust-index-bottom',
    'description'   => __( '', 'knowledgetheme' ),
    'before_widget' => '<div id="%1$s" class="footer__widget mb-30">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title mb-30">',
    'after_title'   => '</h4>',
  ));
}
add_action( 'widgets_init', 'knowledgetheme_widgets_init' );
/**
 * Enqueue scripts and styles for the front end.
 */
function knowledgetheme_scripts() {

    $custom_ver = filemtime(get_template_directory() . '/custom.css');

    wp_enqueue_style( 'style-custom-bootstrap.min', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style( 'style-custom-owl', get_stylesheet_directory_uri() . '/assets/css/owl.carousel.min.css');
    wp_enqueue_style( 'style-custom-animate', get_stylesheet_directory_uri() . '/assets/css/animate.css');
    wp_enqueue_style( 'style-custom-magnific', get_stylesheet_directory_uri() . '/assets/css/magnific-popup.css');
    wp_enqueue_style( 'style-custom-all', get_stylesheet_directory_uri() . '/assets/css/all.min.css');
    wp_enqueue_style( 'style-custom-font', get_stylesheet_directory_uri() . '/assets/css/font.css');
    wp_enqueue_style( 'style-custom-metisMenu', get_stylesheet_directory_uri() . '/assets/css/metisMenu.css');
    wp_enqueue_style( 'style-custom-nice', get_stylesheet_directory_uri() . '/assets/css/nice-select.css');
    wp_enqueue_style( 'style-custom-spacing', get_stylesheet_directory_uri() . '/assets/css/spacing.css');
    wp_enqueue_style( 'style-custom-main', get_stylesheet_directory_uri() . '/assets/css/main.css');
    wp_enqueue_style( 'style-t', get_template_directory_uri() . '/style-t.css', array(), '1.0' );
    wp_enqueue_style( 'custom', get_template_directory_uri() . '/custom.css', array(), $custom_ver, false );

    wp_enqueue_script( 'custom-js-modernizr', get_stylesheet_directory_uri() . '/assets/js/vendor/modernizr-3.5.0.min.js'); 
    wp_enqueue_script( 'custom-js-jquery-1.12.4-min', get_stylesheet_directory_uri() . '/assets/js/vendor/jquery-1.12.4.min.js'); 
    wp_enqueue_script( 'custom-js-popper-min', get_stylesheet_directory_uri() . '/assets/js/popper.min.js');  
    wp_enqueue_script( 'custom-js-bootstrap.min', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js');  
    wp_enqueue_script( 'custom-js-owl.carousel-min', get_stylesheet_directory_uri() . '/assets/js/owl.carousel.min.js');  
    wp_enqueue_script( 'custom-js-isotope.pkgd-min', get_stylesheet_directory_uri() . '/assets/js/isotope.pkgd.min.js');  
    wp_enqueue_script( 'custom-js-metisMenu.min', get_stylesheet_directory_uri() . '/assets/js/metisMenu.min.js');  
    wp_enqueue_script( 'custom-js-jquery.nice-select', get_stylesheet_directory_uri() . '/assets/js/jquery.nice-select.js');  
    wp_enqueue_script( 'custom-js-wow.min', get_stylesheet_directory_uri() . '/assets/js/wow.min.js');  
    wp_enqueue_script( 'custom-js-jquery.counterup.min', get_stylesheet_directory_uri() . '/assets/js/jquery.counterup.min.js');  
    wp_enqueue_script( 'custom-js-waypoints.min', get_stylesheet_directory_uri() . '/assets/js/waypoints.min.js');  
    wp_enqueue_script( 'custom-js-imagesloaded.pkgd.min', get_stylesheet_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js');   
    wp_enqueue_script( 'custom-js-jquery.magnific-popup.min', get_stylesheet_directory_uri() . '/assets/js/jquery.magnific-popup.min.js');  
    wp_enqueue_script( 'custom-js-main', get_stylesheet_directory_uri() . '/assets/js/main.js');  
        
/*    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array(), '1.0' );
    wp_enqueue_style( 'responsive', get_template_directory_uri() . '/responsive.css', array(), '1.0' );
    wp_enqueue_style( 'bootstrap-min-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6' );     
    wp_enqueue_style( 'font-awesome.min.css', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '3.3.6' );
    wp_enqueue_style( 'lightbox.min.css', get_template_directory_uri() . '/css/lightbox.min.css', array(), '3.3.6' );
    wp_enqueue_style( 'style-main', get_template_directory_uri() . '/css/style.css', array(), '1.0' );
    wp_enqueue_style( 'style-bxslider', get_template_directory_uri() . '/css/jquery.bxslider.css');  
    wp_enqueue_script( 'jquery-min', get_template_directory_uri() . '/js/jquery-1.11.2.min.js', array( 'jquery' ), '1.11.2', false );
    wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.6', true );      
    wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '3.3.6', true ); */    


}

function case_feed_func($attr){  

    $atts = shortcode_atts(array(
        'post_type' => '',
        'number_post' => ''
    ), $attr);
    
    $post_type = (!empty($atts['post_type'])) ? $atts['post_type'] : 'case';
    $number_post = (!empty($atts['number_post'])) ? $atts['number_post'] : 3;

    $query = new WP_Query( array(
        'post_type' => $post_type,
        'posts_per_page' => $number_post,
        'order'             => 'DESC', 
        'orderby'           => 'date'
    ) );

    ob_start();

    if ( $query->have_posts() ) :
        echo '<div class="row">';
        while ( $query->have_posts() ) : $query->the_post(); 
        ?>
        <div class="col-lg-4 col-md-6">
           <div class="single-case mb-70">
               <div class="single-case__thumb">
                   <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'w-100') ); ?>
               </div>
               <div class="single-case__content">
                   <h3 class="case-title">
                        <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <?php 
                    $sub_title = get_field('sub_title'); 
                    if ($sub_title) {
                        echo '<p class="mb-25">' . esc_html($sub_title) . '</p>'; 
                    }
               
                    $description = get_field('description'); 
                    if ($description) {
                        echo '<p>' . esc_html($description) . '</p>'; 
                    }
                    ?>
                    <a class="plus-icon" href="<?php echo get_permalink(); ?>">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon/add.svg" alt="">
                    </a>
               </div>
           </div>
        </div>    
        <?php                           
        endwhile;    
        echo '</div>';                                       
    endif;

    wp_reset_postdata();
    $myvariable = ob_get_clean();
    return $myvariable;
}

add_shortcode('case_feed', 'case_feed_func');

function team_carousel_func($attr){  
    $atts = shortcode_atts(array(
        'post_type' => 'team',
        'number_post' => ''
    ), $attr);
    ob_start();  
    $post_type = (!empty($atts['post_type'])) ? $atts['post_type'] : 'team';
    $number_post = (!empty($atts['number_post'])) ? $atts['number_post'] : 6;

    $query = new WP_Query( array(
        'post_type' => $post_type,
        'posts_per_page' => $number_post,
        'order'             => 'DESC', 
        'orderby'           => 'date'
    ) );
    if ( $query->have_posts() ) :
        echo '<div class="team-active owl-carousel">';
        while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="item">
               <div class="team-wrapper white-bg pos-rel">
                   <div class="team-thumb">
                       <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('alt' => 'team memeber') ); ?>
                   </div>
                  <div class="team-content text-center">
                      <h4 class="sect-title"><?php the_title(); ?></h4>
                      <?php 
                            $position = get_field('position'); 
                            if ($position) {
                                echo '<p>' . esc_html($position) . '</p>'; 
                            }
                        ?>             

                        <?php if (have_rows('social')): ?>
                        <div class="social-links mt-20">
                            <?php 
                                while (have_rows('social')): the_row(); 
                                    $class_icon = get_sub_field('class_icon_');
                                    $link = get_sub_field('link');                           
                                    if ($link) { ?>
                                        <a href="<?php echo esc_html($link); ?>"><i class="<?php echo esc_html($class_icon); ?>"></i></a>                              
                                    <?php
                                    }                      
                                endwhile; ?>
                        </div>    
                        <?php endif; ?>   
                  </div>
               </div>
            </div>   
     <?php                           
        endwhile;    
        echo "</div>";                                       
    endif;

    wp_reset_postdata();
    $myvariable = ob_get_clean();
    return $myvariable;
}
add_shortcode('team_carousel', 'team_carousel_func');

function testimonial_carousel_func($attr){  
    $atts = shortcode_atts(array(
        'post_type' => 'testimonial', // Set the post type for testimonials
        'number_post' => '' // Number of testimonials to display
    ), $attr);
    ob_start();  
    $post_type = (!empty($atts['post_type'])) ? $atts['post_type'] : 'testimonial';
    $number_post = (!empty($atts['number_post'])) ? $atts['number_post'] : 6;

    $query = new WP_Query( array(
        'post_type' => $post_type,
        'posts_per_page' => $number_post,
        'order' => 'DESC', 
        'orderby' => 'date'
    ) );

    if ( $query->have_posts() ) :
        echo '<div class="team-active owl-carousel">';
        while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="item">
               <div class="testimonial-wrapper white-bg pos-rel">
                   <div class="testimonial-thumb">
                       <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('alt' => 'testimonial image') ); ?>
                   </div>
                   <div class="testimonial-content text-center">
                       <p class="testimonial-text"><?php echo esc_html(get_the_content()); ?></p> <!-- Testimonial content -->
                       <h4 class="testimonial-author"><?php the_title(); ?></h4> <!-- Testimonial author/title -->
                       <?php 
                           $position = get_field('position'); // Fetch position custom field for testimonial
                           if ($position) {
                               echo '<span class="testimonial-position">' . esc_html($position) . '</span>'; 
                           }
                       ?>  
                   </div>
               </div>
            </div>   
     <?php                           
        endwhile;    
        echo "</div>";                                       
    endif;

    wp_reset_postdata();
    $myvariable = ob_get_clean();
    return $myvariable;
}
add_shortcode('testimonial_carousel', 'testimonial_carousel_func');


// Custom class for <li> elements
function custom_nav_menu_css_class($classes, $item, $args, $depth) {
    $classes = array(); // Reset classes
    $classes[] = 'nav-item dropdown'; // Add your custom class for <li>

    return $classes;
}
add_filter('nav_menu_css_class', 'custom_nav_menu_css_class', 10, 4);

// Custom class for <a> elements
function custom_nav_menu_link_attributes($atts, $item, $args, $depth) {
    $atts['class'] = 'nav-link dropdown-toggle'; // Add your custom class for <a>

    return $atts;
}
add_filter('nav_menu_link_attributes', 'custom_nav_menu_link_attributes', 10, 4);


add_action( 'wp_enqueue_scripts', 'knowledgetheme_scripts' );
function wo_script() {
  wp_register_script( 'jquery-bxslider-min', get_stylesheet_directory_uri() . '/js/jquery.bxslider.min.js',array(), '1.0.0', true ); 
    wp_enqueue_script( 'jquery-bxslider-min' );
}
add_action( 'wp_enqueue_scripts', 'wo_script' );
function removeDemoModeLink() {
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) ); 
    }
}
add_action('init', 'removeDemoModeLink');
function knowledgetheme_theme_setup() {
    add_theme_support( 'automatic-feed-links' );    
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'post-formats', array(
        'image',
        'video',
        'gallery',
        'quote',
        'link'
    ) );
    register_nav_menu( 'primary-menu', __('Main Menu', 'knowledgetheme') );
    register_nav_menu( 'second-menu', __('Footer Menu', 'knowledgetheme') );
}
add_action( 'init', 'knowledgetheme_theme_setup' );
function abc_substr($str, $length, $minword = 3){
    $sub = '';
    $len = 0;
    foreach (explode(' ', $str) as $word)
    {
        $part = (($sub != '') ? ' ' : '') . $word;
        $sub .= $part;
        $len += strlen($part);
        if (strlen($word) > $minword && strlen($sub) >= $length)
        {
          break;
        }
    }
    return $sub . (($len < strlen($str)) ? '...' : '');
}

function shortcode_team_about() {
  ob_start ();
    $random_query = new WP_Query(array(
      'post_type' => 'team',
      'posts_per_page' => 3,
      'post_status' => 'publish',
      'order' => 'date'
    ));
    if ( $random_query->have_posts() ) :
        echo '<ul class="team_about">';
            while ( $random_query->have_posts() ) : $random_query->the_post();?>
                <li class="team_about_detail">
                    <div class="images-team-about">
                        <a href="<?php the_permalink(); ?>">
                        <?php if( has_post_thumbnail( get_the_ID() ) ) { ?>
                            <?php echo get_the_post_thumbnail( get_the_ID(), 'full' );
                          }
                        ?>
                        </a>
                    </div>
                    <div class="title-team-about">
                        <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
                    </div>
                </li>
            <?php endwhile;
        echo '</ul>';
    endif;
    $team_about = ob_get_contents();
    ob_end_clean();
    return $team_about;
    die(1);
}
add_shortcode( 'shortcode_show_team_about', 'shortcode_team_about' );
add_action( 'vc_before_init', 'team_about' );
function team_about() {
    vc_map( array(
      "name" => __( "Team About Show", "starbeach" ),
      "base" => "shortcode_show_team_about",
      "class" => "",
      "category" => __( "Content", "starbeach"),
      "params" => array(
                    ),
     "description" => "Team About Show",
    ));
}
/*
function more_client_ajax(){
    $key = $_POST["key"];
    var_dump($key);?>
      <script type="text/javascript">
          $("ul.shortcode-client li").filter(function() {
                    return $(this).children('ul.shortcode-client li a').eq(0).text().substring(0, 1).toLowerCase() != '<?php echo $key;?>';
                }).hide();
      </script>
    <?php
    $client_ajax = ob_get_contents();
    ob_end_clean();
    echo $client_ajax;
    die();
}
add_action('wp_ajax_nopriv_more_client_ajax', 'more_client_ajax');
add_action('wp_ajax_more_client_ajax', 'more_client_ajax');
function shortcode_media_page() {
    ob_start ();
    $random_query = new WP_Query(array(
            'post_type' =>'services',
            'posts_per_page' => -1,
            'orderby' => date
    ));
    if ( $random_query->have_posts() ) :
          echo '<div class="class-width-large">';
                 while ( $random_query->have_posts() ) :
                    $random_query->the_post();?>
                        <div class="col-md-4 col-sm-4 col-xs-12 services-box">
                            <div class="custom-hover-services">
                              <a class="images_shortcode_services" href="<?php the_permalink(); ?>">
                                  <?php if( has_post_thumbnail( get_the_ID() ) ) { ?>
                                  <?php echo get_the_post_thumbnail( get_the_ID(), 'detail' ); ?>
                              <?php }
                                else{?>
                                  <img src="<?php echo get_site_url();?>/wp-content/uploads/2016/04/book.jpg" class="attachment-detail size-detail wp-post-image" alt="img">
                                <?php }
                              ?>
                              </a>
                                <div class="text_title">
                                    <a href="<?php the_permalink(); ?>" class="title_services"><?php echo get_the_title();?></a>
                                </div>
                            </div>
                        </div>
            <?php endwhile;
          echo "</div>";
          echo '<div class="class-width-small botder-bottom-services">';
            echo '<hr>';
          echo '</div>';
    endif;
   $services = ob_get_contents();
   ob_end_clean();
   return $services;
   die(1);
}
add_shortcode( 'shortcode_show_services', 'shortcode_media_page' );
add_action( 'vc_before_init', 'services' );
function services() {
    vc_map( array(
      "name" => __( "Media Services Show", "starbeach" ),
      "base" => "shortcode_show_services",
      "class" => "",
      "category" => __( "Content", "starbeach"),
      "params" => array(
                    ),
     "description" => "Media Services Show",
    ));
}
function more_book_reviews_ajax(){
    $offset = $_POST["offset"];
    $number_post=$_POST["number_post"];
    $ppp = $_POST["ppp"];
    $args = array(
        'post_type' => 'bookreviews',
        'post_status' => 'publish',
        'posts_per_page' => $ppp,
        'offset' => $offset
    );
    $loop = new WP_Query($args);
    ob_start ();
    if ($loop -> have_posts()) : 
    while ($loop -> have_posts()) : $loop -> the_post();
    ?>
        <li class="colum-full-blogs">
            <div class="img-holder col-md-6 col-sm-6 col-xs-12">
              <a href="<?php echo get_permalink();?>" class="images_shortcode_services">
                <?php if( has_post_thumbnail( get_the_ID() ) ) { ?>                          
                      <?php //echo get_the_post_thumbnail( get_the_ID(), 'detail' );
                      $image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                      $image_path = wp_upload_dir();                    
                      $img_name = basename($image_src[0]);                   
                      $file = ABSPATH.'wp-content/uploads/book_review/'.$img_name ;
                      if(!file_exists ( $file )){
                        $image_url = wp_get_image_editor( $image_path['path'].'/'.$img_name  );
                        //var_dump($image_path['path']);                                      
                        if ( ! is_wp_error( $image_url ) ) {
                          $image_url->resize( 460, 320, true );                       
                          $image_url->save( $file );
                          $img_cl = home_url()."/wp-content/uploads/book_review/". $img_name;                       
                        }
                        else 
                        {
                          $img_cl = home_url()."/wp-content/uploads/book_review/". $img_name;;
                        }
                      }
                      else
                      {
                        $img_cl = home_url()."/wp-content/uploads/book_review/". $img_name;
                      }
                       ?>                          
                       <img width="460" height="320" src="<?php echo $img_cl;?>" class="attachment-detail size-detail wp-post-image" alt="img">
                    <?php }
                  else{?>
                    <img width="399" height="277" src="<?php echo get_site_url();?>/wp-content/uploads/2016/04/images1.png" class="attachment-detail size-detail wp-post-image" alt="img">
                  <?php }
                ?>
              </a>
            </div>
            <div class="news-holder col-xs-12 col-sm-6 col-md-6">
                <h2>
                  <a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a>
                  <time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date(); ?></time>
                </h2>
                <p><?php //$texts=get_the_excerpt();
                    echo abc_substr(get_the_excerpt(),250);
                ?></p>
                <a class="more" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'bishopstrow' ); ?></a>
            </div>
        </li>
    <?php
    endwhile;
    endif;
    $total_post_current=$offset+$ppp;
        if($total_post_current >=$number_post){?>
            <script type="text/javascript">
                jQuery("#book_review").hide();
            </script>
        <?php
        }else{
            ?>
            <script type="text/javascript">
                jQuery("#book_review").show();
            </script>
            <?php
        }
       wp_reset_postdata();
       $response4 = ob_get_contents();
       ob_end_clean();
       echo $response4;
       die();
}
add_action('wp_ajax_nopriv_more_book_reviews_ajax', 'more_book_reviews_ajax');
add_action('wp_ajax_more_book_reviews_ajax', 'more_book_reviews_ajax');
*/
function custom_breadcrumbs(){
  /* === OPTIONS === */
  $text['home']     = 'Home'; // text for the 'Home' link
  $text['category'] = '"%s"'; // text for a category page
  $text['tax']    = '"%s"'; // text for a taxonomy page
  $text['search']   = 'Search Results for "%s" Query'; // text for a search results page
  $text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
  $text['author']   = '%s'; // text for an author page
  $text['404']      = 'Error 404'; // text for the 404 page
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter   = ' &raquo; '; // delimiter between crumbs
  $before      = '<span class="current">'; // tag before the current crumb
  $after       = '</span>'; // tag after the current crumb
  /* === END OF OPTIONS === */
  global $post;
  $homeLink = get_bloginfo('url') . '/';
  $linkBefore = '<span typeof="v:Breadcrumb">';
  $linkAfter = '</span>';
  $linkAttr = ' rel="v:url" property="v:title"';
  $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
  if (is_home() || is_front_page()) {
    if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';
  } else {
    echo '<div id="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf($link, $homeLink, $text['home']) . $delimiter;
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) {
        $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
        $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
        $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
        echo $cats;
      }
      echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
    } elseif( is_tax() ){
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) {
        $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
        $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
        $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
        echo $cats;
      }
      echo $before . sprintf($text['tax'], single_cat_title('', false)) . $after;
    }elseif ( is_search() ) {
      echo $before . sprintf($text['search'], get_search_query()) . $after;
    } elseif ( is_day() ) {
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
      echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
      echo $before . get_the_time('d') . $after;
    } elseif ( is_month() ) {
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
      echo $before . get_the_time('F') . $after;
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
        if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, $delimiter);
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
        $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
        $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      $cats = get_category_parents($cat, TRUE, $delimiter);
      $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
      $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
      echo $cats;
      printf($link, get_permalink($parent), $parent->post_title);
      if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo $delimiter;
      }
      if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
    } elseif ( is_tag() ) {
      echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
    } elseif ( is_author() ) {
      global $author;
      $userdata = get_userdata($author);
      echo $before . sprintf($text['author'], $userdata->display_name) . $after;
    } elseif ( is_404() ) {
      echo $before . $text['404'] . $after;
    }
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
    echo '</div>';
  }
}
function custom_social(){
?>
<div class="main-share-social">
  <div class="a2a_kit a2a_kit_size_32 a2a_floating_style a2a_vertical_style social-details">
      <a class="a2a_button_facebook"></a>
      <a class="a2a_button_linkedin"></a>
      <a class="a2a_button_twitter"></a>
      <!--<a class="a2a_dd" href="https://www.addtoany.com/share"></a>-->
  </div>
</div>
<?php
}

add_filter( 'gform_submit_button', 'add_custom_css_classes', 10, 2 );
function add_custom_css_classes( $button, $form ) {
    $dom = new DOMDocument();
    $dom->loadHTML( '<?xml encoding="utf-8" ?>' . $button );
    $input = $dom->getElementsByTagName( 'input' )->item(0);
    $classes = $input->getAttribute( 'class' );
    $classes .= " theme_btn rounded-1";
    $input->setAttribute( 'class', $classes );
    return $dom->saveHtml( $input );
}

add_filter( 'comment_form_fields', 'mo_comment_fields_custom_order' );
function mo_comment_fields_custom_order( $fields ) {
    $comment_field = sprintf(
        '<div class="col-lg-12"><div class="comment-form-comment form-group mb-35">%s %s</div></div>',
        sprintf(
            '<label for="comment">%s%s</label>',
            _x( 'Your Comment*', 'noun' ),
            $required_indicator
        ),
        '<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525"' . $required_attribute . '></textarea>'
    );
    $author_field = sprintf(
        '<div class="col-lg-6 col-md-6"><div class="comment-form-author form-group mb-35">%s %s</div></div>',
        sprintf(
            '<label for="author">%s%s</label>',
            __( 'Your Name*' ),
            ( $req ? $required_indicator : '' )
        ),
        sprintf(
            '<input id="author" name="author" type="text" value="%s" size="30" maxlength="245" autocomplete="name"%s />',
            esc_attr( $commenter['comment_author'] ),
            ( $req ? $required_attribute : '' )
        )
    );
    $email_field = sprintf(
        '<div class="col-lg-6 col-md-6"><div class="comment-form-email form-group mb-35">%s %s</div></div>',
        sprintf(
            '<label for="email">%s%s</label>',
            __( 'Your Email*' ),
            ( $req ? $required_indicator : '' )
        ),
        sprintf(
            '<input id="email" name="email" %s value="%s" size="30" maxlength="100" aria-describedby="email-notes" autocomplete="email"%s />',
            ( $html5 ? 'type="email"' : 'type="text"' ),
            esc_attr( $commenter['comment_author_email'] ),
            ( $req ? $required_attribute : '' )
        )
    );
    $url_field = $fields['url'];
    $cookies_field = sprintf(
        '<div class="col-lg-12"><div class="comment-form-cookies-consent form-check">%s %s</div></div>',
        sprintf(
            '<input id="wp-comment-cookies-consent" class="form-check-input" name="wp-comment-cookies-consent" type="checkbox" value="yes"%s />',
            $consent
        ),
        sprintf(
            '<label class="form-check-label" for="wp-comment-cookies-consent">%s</label>',
            __( 'Save my name, email, and website in this browser for the next time I comment.' )
        )
    );
    unset( $fields['comment'] );
    unset( $fields['author'] );
    unset( $fields['email'] );
    unset( $fields['url'] );
    unset( $fields['cookies'] );
    // the order of fields is the order below, change it as needed:
    $fields['author'] = $author_field;
    $fields['email'] = $email_field;
    $fields['comment'] = $comment_field;
    $fields['cookies'] = $cookies_field;
    // done ordering, now return the fields:
    return $fields;
}

// add_filter( 'comment_form_logged_in', 'mo_comment_form_custom_logged_in', 10, 3 );

// function mo_comment_form_custom_logged_in( $args_logged_in, $commenter, $user_identity ) {

//     return $args_logged_in;

// }

add_action('comment_form_top', 'comment_form_top_custom');

function comment_form_top_custom() {

    echo '<div class="row">';

}

add_action('comment_form', 'comment_form_custom');

function comment_form_custom() {

    echo '</div>';

}

function categories_with_count_shortcode($atts) {

    $args = array(
        'show_option_all'    => '',
        'orderby'            => 'name',
        'order'              => 'ASC',
        'show_count'         => 0,
        'hide_empty'         => 1,
        'use_desc_for_title' => 1,
        'child_of'           => 0,
        'feed'               => '',
        'title_li'           => '',
        'feed_type'          => '',
        'feed_image'         => '',
        'exclude'            => '',
        'exclude_tree'       => '',
        'include'            => '',
        'hierarchical'       => 1,
        'echo'               => 1,
        'taxonomy'           => $atts['cat']
    );

    $categories = get_categories( $args );

    ob_start();

    echo '<div class="widget_categories">';

        echo '<ul class="list-style-none">';

            foreach( $categories as $category ) {

                echo '<li>';
                    echo '<a href="' . get_category_link($category->term_id) . '">';
                        echo $category->name;
                        echo '<span>' . $category->category_count . '</span>';
                    echo '</a>';
                echo '</li>';

            }

        echo '</ul>';

    echo '</div>';

    return ob_get_clean();

}

add_shortcode('categories_with_count', 'categories_with_count_shortcode');

add_filter( 'wp_kses_allowed_html', 'acf_add_allowed_iframe_tag', 10, 2 );
function acf_add_allowed_iframe_tag( $tags, $context ) {
    if ( $context === 'acf' ) {
        $tags['iframe'] = array(
            'src'             => true,
            'height'          => true,
            'width'           => true,
            'frameborder'     => true,
            'allowfullscreen' => true,
        );
    }

    return $tags;
}
require_once __DIR__ . '/webbox/wb_wp_ajaxs.php';



// Enqueue JavaScript for the Load More functionality
function enqueue_load_more_scripts() {
    wp_enqueue_script('load-more-posts', get_template_directory_uri() . '/js/load-more-posts.js', array('jquery'), null, true);

    // Pass variables to the JavaScript file
    wp_localize_script('load-more-posts', 'loadMoreParams', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'postsPerPage' => 9,
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_load_more_scripts');

// AJAX handler for loading more posts
function load_more_posts_new() {
	
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $posts_per_page = isset($_POST['postsPerPage']) ? intval($_POST['postsPerPage']) : 9;

    $query = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
    ));

    if ($query->have_posts()) {
        while ($query->have_posts()) {
			
            $query->the_post();
            //echo '<div class="post-item">';
            //echo '<h2>' . get_the_title() . '</h2>';
            //echo '<div>' . get_the_excerpt() . '</div>';
            //echo '</div>';
            //
                          
			if ( function_exists('get_field') ) {
				$image = get_field('featured_image');
				if ( $image ) {
					$img_link = '<a href="' . get_permalink() . '"><img src="' . esc_url( $image['url'] ) . '" alt="' . esc_attr( $image['alt'] ) . '"></a>';
				} else {
					$img_link = "";
				}
			}
			echo '<div class="col-lg-4 col-md-6">
				   <div class="comic-blogs-wrapper mb-30">
						<div class="comic-blogs-thumb">'. $img_link . '</div>
						<div class="blogs-content">
							<div class="blog-meta mb-25">
								<!--
							   <span class="meta-btn">
								Business growth                        
								</span>
								-->
							</div>
							<div class="blog-meta-date mb-15">' . get_the_date() . '</div>
							<h3 class="blog-title">
								<a href="' . get_permalink() . '">' . get_the_title() . '</a>
							</h3>
					   </div>
					</div>
				</div>';
			
			
        }
    } else {
        echo 'no more posts';
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_load_more_posts_new', 'load_more_posts_new');
add_action('wp_ajax_nopriv_load_more_posts_new', 'load_more_posts_new');

// Fix broken search form in header nav
function fix_nav_search_form() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var searchArea = document.querySelector('.search-area');
        if (searchArea) {
            var inputGroup = searchArea.querySelector('.input-group');
            if (inputGroup && !inputGroup.querySelector('input[name="s"]')) {
                var searchInput = inputGroup.querySelector('input[type="text"]');
                var searchIcon = inputGroup.querySelector('img');
                var iconSrc = searchIcon ? searchIcon.src : '';
                
                var form = document.createElement('form');
                form.setAttribute('role', 'search');
                form.setAttribute('method', 'get');
                form.setAttribute('action', '<?php echo esc_url(home_url("/")); ?>');
                form.className = 'input-group';
                form.style.cssText = 'flex-wrap:nowrap;';
                
                var input = document.createElement('input');
                input.type = 'search';
                input.name = 's';
                input.placeholder = 'Search here.....';
                input.style.cssText = 'flex:1;border:1px solid #ddd;padding:6px 12px;border-radius:4px 0 0 4px;outline:none;font-size:14px;';
                
                var btn = document.createElement('button');
                btn.type = 'submit';
                btn.className = 'input-group-text';
                btn.style.cssText = 'background:transparent;border:1px solid #ddd;border-left:none;padding:6px 12px;cursor:pointer;border-radius:0 4px 4px 0;';
                if (iconSrc) {
                    var img = document.createElement('img');
                    img.src = iconSrc;
                    img.alt = 'search';
                    img.style.cssText = 'width:16px;height:16px;';
                    btn.appendChild(img);
                }
                
                form.appendChild(input);
                form.appendChild(btn);
                inputGroup.parentNode.replaceChild(form, inputGroup);
            }
        }
    });
    </script>
    <?php
}
add_action('wp_footer', 'fix_nav_search_form');

/* VDS: add areaServed to Organization schema (no physical address) */
add_filter('wpseo_schema_organization', function($data){ $data['areaServed'] = array(array('@type'=>'Country','name'=>'Vietnam'), 'Worldwide'); return $data; });
