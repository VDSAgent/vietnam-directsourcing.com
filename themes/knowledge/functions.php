<?php
/* Plugin Activation */
require_once dirname( __FILE__ ) . '/core/class-tgm-plugin-activation.php';
require_once dirname( __FILE__ ) . '/core/plugins.php';
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

function post_content() {

    ?>
    <div class="col-lg-4 col-md-6">
       <div class="comic-blogs-wrapper mb-30">
            <div class="comic-blogs-thumb">
               <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'w-100') ); ?>
				<?php if ( function_exists('get_field') ) {
						$image = get_field('featured_image');
						if ( $image ) {
							echo '<a href="' . get_permalink() . '"><img src="' . esc_url( $image['url'] ) . '" alt="' . esc_attr( $image['alt'] ) . '"></a>';
						}
					}
					?>
            </div>
            <div class="blogs-content">
                <div class="blog-meta mb-25">
					<!--
                   <span class="meta-btn">
                    <?php $categories = get_the_category(); 
                        if (!empty($categories)) {
                            echo esc_html($categories[0]->name); 
                        }
                    ?>                        
                    </span>
                    -->
                </div>
                <div class="blog-meta-date mb-15"><?php echo get_the_date(); ?></div>
                <h3 class="blog-title">
                    <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
           </div>
        </div>
    </div>
    <?php
}

function post_feed_func($attr){  

    $atts = shortcode_atts(array(
        'post_type' => '',
        'loadmore' => '',
        'number_post' => ''
    ), $attr);

    $post_type = (!empty($atts['post_type'])) ? $atts['post_type'] : 'post';
    $number_post = (!empty($atts['number_post'])) ? $atts['number_post'] : 10;
    $loadmore = (!empty($atts['loadmore'])) ? $atts['loadmore'] : 'false';

    $query = new WP_Query( array(
        'post_type' => $post_type,
        'posts_per_page' => $number_post,
        'order'             => 'DESC', 
        'orderby'           => 'date',
        'paged' => 1,
    ) );

    $total_pages = $query->max_num_pages;

    ob_start();  

    if ( $query->have_posts() ) :
        echo '<div class="row blog_feed">';
        while ( $query->have_posts() ) : $query->the_post(); 
            echo post_content();
        endwhile;  
        if ($total_pages > 1 && $loadmore == 'true'): ?>
            <div class="row">
                <div class="col-12">
                    <div class="blog-more text-center mb-30">
                        <a href="#" id="load-more-posts" data-page="1" data-total-pages="<?php echo $total_pages; ?>" class="theme_btn theme_btn_border">Load More Articles</a>
                    </div>
                </div>
            </div>
        <?php endif;
        echo '</div>';                                       
    endif;

    wp_reset_postdata();
    $myvariable = ob_get_clean();
    return $myvariable;
}

add_shortcode('post_feed', 'post_feed_func');

function load_more_posts_ajax_handler() {

    $paged = $_POST['page'] + 1;

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 9,
        'paged' => $paged,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); 

            echo post_content();

        endwhile;
    endif;

    wp_reset_postdata();

    die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts_ajax_handler');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts_ajax_handler');

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

function more_post_ajax(){
    $offset = $_POST["offset"];
    $number_post=$_POST["number_post"];
    $ppp = $_POST["ppp"];
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $number_post,
        'offset' => $offset
    );
    $loop = new WP_Query($args);
    ob_start ();
    if ($loop->have_posts()) : 
        while ($loop->have_posts()) : $loop->the_post();
    ?>
        <li class="colum-full-blogs">
            <div class="img-holder col-md-6 col-sm-6 col-xs-12">
              <a href="<?php echo get_permalink();?>" class="images_shortcode_services">
                <?php if( has_post_thumbnail( get_the_ID() ) ) { ?>
                    <?php echo get_the_post_thumbnail( get_the_ID(), 'detail' ); ?>
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
                jQuery("#more_posts").hide();
            </script>
        <?php
        }else{
            ?>
            <script type="text/javascript">
                jQuery("#more_posts").show();
            </script>
            <?php
        }
    wp_reset_postdata();
    $response4 = ob_get_contents();
    ob_end_clean();
    echo $response4;
    die();
}
add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');
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

/**
 * FAQPage JSON-LD Schema for /vietnam-sourcing-faqs/
 * Added for Google rich results eligibility
 */
function vds_faq_page_schema() {
    if ( ! is_page( 'vietnam-sourcing-faqs' ) ) {
        return;
    }
    $faqs = array(
        array(
            'q' => 'What types of products can I source from Vietnam?',
            'a' => 'We can source a wide range of physical products, including agricultural products, apparel and textiles, construction materials, furniture and home goods, handicrafts and gifts, packaging materials, paper products, plastic products, renewable energy products, steel and metal products, wood and bamboo products, and more.',
        ),
        array(
            'q' => 'What if I\'m just exploring the idea of importing from Vietnam - do you offer market research services?',
            'a' => 'If you\'re exploring the possibility of importing from Vietnam, we can conduct global sourcing market research customized to your needs. Our sourcing research solution includes evaluating potential markets, analyzing local industry conditions, identifying prospective suppliers, and providing insights into the regulatory environment – helping you make informed export decisions.',
        ),
        array(
            'q' => 'What if I have an existing product and I just need information on suitable Vietnam sources?',
            'a' => 'Opt for our Supplier Identification service, our team will find suitable suppliers, conducting pre-qualification screening, and receiving a list of Vietnam-based suppliers tailored to your specific needs.',
        ),
        array(
            'q' => 'What if I want a custom-made or new product that needs to be sourced?',
            'a' => 'Choose our Supplier Evaluation service, offering a comprehensive approach that includes identifying suppliers through multiple platforms, conducting pre-qualification checks, gathering pro-forma quotes, building a prospective contact list, obtaining custom samples, and facilitating initial introductions and online introductions.',
        ),
        array(
            'q' => 'What if I want a complete global sourcing solution?',
            'a' => 'Select our End-to-End Sourcing solution for full coverage of your global sourcing needs, incorporating everything offered in the Supplier Evaluation solution including supplier identification, pre-qualification, pro forma quotes, and custom sample procurement. We also manage on-site supplier inspections during production to guarantee compliance with your specifications. To ensure the product gets to you on time, we assist with logistics, including packaging, tracking, and insurance for a smooth delivery process.',
        ),
        array(
            'q' => 'What if I want to see the factories personally and establish a longer-term relationship with them?',
            'a' => 'Our Factory Tour service offers an in-depth exploration of Vietnam\'s manufacturing landscape. Tours are customized to match your global sourcing needs, with factories verified for their capability to produce your specific items. We can also obtain quotes in advance, enabling a more productive visit.',
        ),
        array(
            'q' => 'What if I want a 3rd party to guarantee that my sourcing needs meet exact specifications and comply with specific certifications and standards?',
            'a' => 'For products requiring advanced certifications or eco-friendly standards, we have you covered. We complement our on-site inspections by collaborating with an international 3rd party Quality Assurance firm for audits, compliance verifications, product inspections, and testing.',
        ),
        array(
            'q' => 'Can you help with price negotiations and contract management?',
            'a' => 'Yes, we can assist with price negotiations and contract management to secure the best terms for your business. We charge a flat rate or pay-as-you-go with no commission, and you\'ll receive original quotes without added fees, along with full contact details of all factories and suppliers.',
        ),
        array(
            'q' => 'How do you ensure my products are delivered on time from Vietnam?',
            'a' => 'We have partnered with an international supply chain logistics platform that coordinates global logistics from factory to customer door. Supply chain logistics options include air freight, ocean shipping, less-than-container consolidation, customs brokerage, trucking, and more.',
        ),
        array(
            'q' => 'What is the typical lead time for sourcing products from Vietnam?',
            'a' => 'Lead times vary depending on the product or service, but we strive to provide accurate timelines and keep you informed throughout the process.',
        ),
        array(
            'q' => 'How do you handle communication and language barriers with Vietnamese suppliers?',
            'a' => 'Our team includes native English speakers and bilingual Vietnamese team members, skilled in collaborating with international clients and local suppliers for clear communication and seamless transactions.',
        ),
        array(
            'q' => 'Can you help with compliance and regulatory requirements?',
            'a' => 'Yes, we work with an international logistics partner that handles customs brokerage, compliance, and regulatory requirements to ensure your products meet all import and export standards.',
        ),
        array(
            'q' => 'What makes Vietnam a great global sourcing destination?',
            'a' => 'Vietnam is Asia\'s emerging manufacturing powerhouse and the 2nd largest exporter in Southeast Asia. In 2024 alone, exports grew by 15.4%. Vietnam offers competitive labour costs, a skilled workforce, strong government support for manufacturing, and a growing range of product capabilities across many industries.',
        ),
    );

    $entities = array();
    foreach ( $faqs as $faq ) {
        $entities[] = array(
            '@type'          => 'Question',
            'name'           => $faq['q'],
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text'  => $faq['a'],
            ),
        );
    }

    $schema = array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $entities,
    );

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'vds_faq_page_schema' );

/* ============================================================
   VDS Solutions Page – Service Rows, Modal Form, CSS
   ============================================================ */
/* Inject Solutions page CSS into <head> on the solutions page */
function vds_solutions_css() {
    if ( ! is_page( 'global-sourcing-solutions' ) ) return;
    ?>
    <style id="vds-solutions-css">
    .vds-solutions-wrap{max-width:1180px;margin:0 auto;padding:30px 20px 10px;font-family:inherit;}
    .vds-intro{text-align:center;margin-bottom:50px;}
    .vds-intro .vds-eyebrow{display:block;letter-spacing:2px;text-transform:uppercase;font-weight:700;font-size:13px;color:#C79A3A;margin-bottom:10px;}
    .vds-intro h2{font-size:34px;margin:0 0 14px;color:#13123A;}
    .vds-intro p{max-width:760px;margin:0 auto;color:#555;font-size:17px;line-height:1.6;}
    /* Pipeline steps – wraps, never squeezed */
    .vds-pipeline{display:flex;flex-wrap:wrap;justify-content:center;gap:12px;margin:0 auto 60px;}
    .vds-step{background:#F5EFE3;color:#13123A;border-radius:8px;padding:12px 20px;font-weight:700;font-size:14px;white-space:nowrap;}
    .vds-step.vds-step-active{background:#C79A3A;color:#fff;}
    /* Vertical alternating rows */
    .vds-row{display:flex;align-items:center;gap:48px;margin-bottom:64px;}
    .vds-row .vds-media{flex:0 0 45%;max-width:45%;}
    .vds-row .vds-media img{width:100%;height:auto;border-radius:14px;display:block;box-shadow:0 18px 40px rgba(19,18,58,.12);}
    .vds-row .vds-body{flex:1;}
    .vds-row.vds-reverse{flex-direction:row-reverse;}
    .vds-step-tag{display:inline-block;letter-spacing:1.5px;text-transform:uppercase;font-weight:700;font-size:12px;color:#C79A3A;margin-bottom:8px;}
    .vds-row h3{font-size:27px;margin:0 0 8px;color:#13123A;}
    .vds-row .vds-sub{font-style:italic;color:#C79A3A;font-size:16px;margin:0 0 16px;}
    .vds-row .vds-desc{color:#555;font-size:16px;line-height:1.65;margin:0 0 18px;}
    .vds-deliverables{list-style:none;padding:0;margin:0 0 22px;}
    .vds-deliverables li{position:relative;padding-left:28px;margin-bottom:9px;color:#333;font-size:15px;}
    .vds-deliverables li:before{content:"\2713";position:absolute;left:0;top:0;color:#C79A3A;font-weight:700;}
    .vds-cta-btn{display:inline-block;background:#13123A;color:#fff;border:none;border-radius:8px;padding:15px 30px;font-weight:700;font-size:15px;cursor:pointer;text-decoration:none;transition:background .2s;}
    .vds-cta-btn:hover{background:#26245f;color:#fff;}
    .vds-row.vds-premium .vds-cta-btn{background:#C79A3A;}
    .vds-row.vds-premium .vds-cta-btn:hover{background:#b3862c;}
    .vds-row.vds-premium{background:#FBF7EE;border:1px solid #ecdcb8;border-radius:16px;padding:34px;margin-bottom:64px;}
    /* Field services section */
    .vds-field-services{background:#13123A;color:#fff;padding:64px 0;margin-top:30px;}
    .vds-field-inner{max-width:1180px;margin:0 auto;padding:0 20px;}
    .vds-field-services .vds-field-head{text-align:center;margin-bottom:46px;}
    .vds-field-services .vds-eyebrow{color:#C79A3A;}
    .vds-field-services h2{color:#fff;font-size:32px;margin:6px 0 0;}
    .vds-field-grid{display:flex;flex-wrap:wrap;gap:30px;}
    .vds-field-card{flex:1 1 460px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.12);border-radius:14px;overflow:hidden;display:flex;flex-direction:column;}
    .vds-field-card img{width:100%;height:230px;object-fit:cover;display:block;}
    .vds-field-card .vds-fc-body{padding:28px;display:flex;flex-direction:column;flex:1;}
    .vds-field-card h3{color:#fff;font-size:23px;margin:0 0 8px;}
    .vds-field-card .vds-sub{color:#C79A3A;font-style:italic;margin:0 0 14px;}
    .vds-field-card .vds-desc{color:#cfcfe0;font-size:15px;line-height:1.6;margin:0 0 16px;}
    .vds-field-card .vds-deliverables li{color:#e6e6f0;}
    .vds-field-card .vds-cta-btn{background:#C79A3A;margin-top:auto;text-align:center;}
    .vds-field-card .vds-cta-btn:hover{background:#b3862c;}
    /* Modal */
    .vds-modal-overlay{position:fixed;inset:0;background:rgba(10,10,30,.6);display:none;align-items:center;justify-content:center;z-index:99999;padding:20px;}
    .vds-modal-overlay.vds-open{display:flex;}
    .vds-modal{background:#fff;border-radius:14px;max-width:520px;width:100%;padding:34px;position:relative;max-height:90vh;overflow:auto;}
    .vds-modal .vds-eyebrow{color:#C79A3A;letter-spacing:1.5px;text-transform:uppercase;font-size:12px;font-weight:700;}
    .vds-modal h3{color:#13123A;font-size:26px;margin:6px 0 22px;}
    .vds-modal label{display:block;font-weight:600;color:#333;margin:0 0 6px;font-size:14px;}
    .vds-modal input,.vds-modal textarea{width:100%;border:1px solid #d8d8e0;border-radius:8px;padding:13px 14px;margin-bottom:18px;font-size:15px;font-family:inherit;}
    .vds-modal textarea{min-height:96px;resize:vertical;}
    .vds-modal .vds-cta-btn{width:100%;text-align:center;}
    .vds-modal-close{position:absolute;top:16px;right:18px;background:none;border:none;font-size:24px;line-height:1;color:#999;cursor:pointer;}
    .vds-modal-msg{margin-top:14px;font-size:14px;}
    .vds-modal-msg.success{color:#1a8c4a;}
    .vds-modal-msg.error{color:#c0392b;}
    /* ---------- Mobile ---------- */
    @media(max-width:860px){
      .vds-row,.vds-row.vds-reverse{flex-direction:column;gap:22px;margin-bottom:46px;}
      .vds-row .vds-media,.vds-row .vds-body{max-width:100%;flex:1 1 100%;}
      .vds-row.vds-premium{padding:24px;}
      .vds-intro h2{font-size:27px;}
      .vds-row h3{font-size:23px;}
      .vds-step{font-size:13px;padding:10px 16px;}
    }
    </style>
    <?php
}
add_action( 'wp_head', 'vds_solutions_css' );


/* ---- Handle modal form submission via AJAX ---- */
function vds_solutions_form_submit() {
    $name    = isset($_POST['vds_name'])    ? sanitize_text_field($_POST['vds_name'])    : '';
    $email   = isset($_POST['vds_email'])   ? sanitize_email($_POST['vds_email'])         : '';
    $service = isset($_POST['vds_service']) ? sanitize_text_field($_POST['vds_service'])  : '';
    $message = isset($_POST['vds_message']) ? sanitize_textarea_field($_POST['vds_message']) : '';
    if ( empty($name) || empty($email) ) {
        wp_send_json_error('Please provide your name and a valid email address.');
    }
    $to      = 'contact@vietnam-directsourcing.com';
    $subject = 'New Solutions Enquiry: ' . ( $service ? $service : 'General' );
    $body    = "New enquiry from the Solutions page:\n\n";
    $body   .= "Service: " . $service . "\n";
    $body   .= "Name: "    . $name . "\n";
    $body   .= "Email: "   . $email . "\n\n";
    $body   .= "Message:\n" . $message . "\n";
    $headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );
    $sent = wp_mail( $to, $subject, $body, $headers );
    if ( $sent ) {
        wp_send_json_success('Thank you! Your enquiry has been sent. We will be in touch shortly.');
    } else {
        wp_send_json_error('Sorry, something went wrong sending your enquiry. Please email us directly at contact@vietnam-directsourcing.com.');
    }
}
add_action( 'wp_ajax_vds_solutions_form',        'vds_solutions_form_submit' );
add_action( 'wp_ajax_nopriv_vds_solutions_form', 'vds_solutions_form_submit' );


/* ---- [vds_solutions] shortcode: vertical service rows + field services + modal ---- */
function vds_solutions_shortcode() {
    $ajax  = admin_url('admin-ajax.php');
    $ident = 'https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Supplier-Identification.png';
    $eval  = 'https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Supplier-Inspection.png';
    $prod  = 'https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Production-Management.png';
    $e2e   = 'https://vietnam-directsourcing.com/wp-content/uploads/2026/06/End-to-end.png';
    $tours = 'https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Factory-Tours.png';
    $qa    = 'https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Quality-Assurance-3.png';
    ob_start();
    ?>
    <div class="vds-solutions-wrap">

      <div class="vds-intro">
        <span class="vds-eyebrow">The Core Sourcing Pipeline</span>
        <h2>Vietnam Sourcing Solutions</h2>
        <p>A structured four-step journey from finding the right supplier through to final delivery &mdash; choose the level of support that fits your project.</p>
      </div>

      <div class="vds-pipeline">
        <div class="vds-step vds-step-active">Step 01: Identification</div>
        <div class="vds-step">Step 02: Evaluation</div>
        <div class="vds-step">Step 03: Production Mgmt</div>
        <div class="vds-step">Step 04: End-to-End</div>
      </div>

      <!-- Row 1: Supplier Identification -->
      <div class="vds-row">
        <div class="vds-media"><img src="<?php echo esc_url($ident); ?>" alt="Supplier Identification in Vietnam"></div>
        <div class="vds-body">
          <span class="vds-step-tag">Step 01</span>
          <h3>Supplier Identification</h3>
          <p class="vds-sub">Fast track your search for standard, ready-to-export products.</p>
          <p class="vds-desc">Designed for buyers seeking existing Vietnamese products with minimal to no customization. Powered by our proprietary sourcing database, we match your exact product specifications and target pricing with vetted, export-ready manufacturers.</p>
          <ul class="vds-deliverables">
            <li>Verified Factory Contact Details</li>
            <li>Export Product &amp; Capability Lists</li>
            <li>International Quality Certifications</li>
            <li>Initial Factory Price Sheets</li>
          </ul>
          <button type="button" class="vds-cta-btn" onclick="vdsOpenModal('Request Supplier Identification List','Supplier Identification')">Request Supplier Identification List</button>
        </div>
      </div>

      <!-- Row 2: Supplier Evaluation (reversed) -->
      <div class="vds-row vds-reverse">
        <div class="vds-media"><img src="<?php echo esc_url($eval); ?>" alt="Supplier Evaluation and pre-qualification"></div>
        <div class="vds-body">
          <span class="vds-step-tag">Step 02</span>
          <h3>Supplier Evaluation</h3>
          <p class="vds-sub">Pre-qualify partners for custom manufacturing and OEM projects.</p>
          <p class="vds-desc">If your product requires custom tooling, specialized materials, or prototyping, we go deeper. We physically pre-qualify factories, manage the initial RFQ process to secure pro-forma quotes, coordinate sample production, and facilitate direct video introductions.</p>
          <ul class="vds-deliverables">
            <li>Comprehensive Supplier Audit Reports</li>
            <li>Pro-Forma Quotes &amp; Cost Breakdowns</li>
            <li>Custom Sample Production Management</li>
            <li>Direct Introduction &amp; Meeting Setup</li>
          </ul>
          <button type="button" class="vds-cta-btn" onclick="vdsOpenModal('Inquire About Supplier Evaluation','Supplier Evaluation')">Inquire About Supplier Evaluation</button>
        </div>
      </div>

      <!-- Row 3: Production Management -->
      <div class="vds-row">
        <div class="vds-media"><img src="<?php echo esc_url($prod); ?>" alt="On-site production management in Vietnam"></div>
        <div class="vds-body">
          <span class="vds-step-tag">Step 03</span>
          <h3>Production Management</h3>
          <p class="vds-sub">Protect your investment from the factory floor to the shipping container.</p>
          <p class="vds-desc">Bridge the gap between a signed contract and a finished shipment. We provide local, on-site production oversight in Vietnam to ensure raw material lead times are met, engineering blueprints are strictly followed, and manufacturing bottlenecks are cleared before they cause delays.</p>
          <ul class="vds-deliverables">
            <li>Milestone Tracking &amp; Progress Reports</li>
            <li>On-the-Floor Production Monitoring</li>
            <li>Timeline Slip Remediation</li>
            <li>Post-Production Handoff Coordination</li>
          </ul>
          <button type="button" class="vds-cta-btn" onclick="vdsOpenModal('Get Production Management Support','Production Management')">Get Production Management Support</button>
        </div>
      </div>

      <!-- Row 4: End-to-End (premium, reversed) -->
      <div class="vds-row vds-reverse vds-premium">
        <div class="vds-media"><img src="<?php echo esc_url($e2e); ?>" alt="End-to-end sourcing solution in Vietnam"></div>
        <div class="vds-body">
          <span class="vds-step-tag">Step 04 &mdash; Premium</span>
          <h3>End-to-End Solution</h3>
          <p class="vds-sub">Complete operational peace of mind from blueprint to final delivery.</p>
          <p class="vds-desc">Our most comprehensive turnkey solution. We act as your dedicated, boots-on-the-ground supply chain team in Vietnam &mdash; integrating identification, strict contract negotiations, and production oversight all the way through to final logistics scheduling.</p>
          <ul class="vds-deliverables">
            <li>Full-Scale Supply Chain Management</li>
            <li>Sourcing &amp; Price Negotiations</li>
            <li>Integrated Logistics &amp; Freight Scheduling</li>
            <li>Dedicated Account Manager in Vietnam</li>
          </ul>
          <button type="button" class="vds-cta-btn" onclick="vdsOpenModal('Apply for End-to-End Sourcing','End-to-End Solution')">Apply for End-to-End Sourcing</button>
        </div>
      </div>

    </div>
    <?php
    return ob_get_clean() . vds_solutions_field_services_and_modal();
}


/* ---- Field services section + modal markup + JS ---- */
function vds_solutions_field_services_and_modal() {
    $ajax  = admin_url('admin-ajax.php');
    $tours = 'https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Factory-Tours.png';
    $qa    = 'https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Quality-Assurance-3.png';
    ob_start();
    ?>
    <div class="vds-field-services">
      <div class="vds-field-inner">
        <div class="vds-field-head">
          <span class="vds-eyebrow">On-the-Ground Execution</span>
          <h2>Standalone Field Services</h2>
        </div>
        <div class="vds-field-grid">

          <div class="vds-field-card">
            <img src="<?php echo esc_url($tours); ?>" alt="Tailored factory tours in Vietnam">
            <div class="vds-fc-body">
              <h3>Tailored Factory Tours</h3>
              <p class="vds-sub">Inspect facilities, build relationships, and negotiate face-to-face.</p>
              <p class="vds-desc">Establish long-term strategic relationships by walking the factory floors yourself. We build custom, highly-efficient itineraries tailored to your specific industry. Our bilingual industrial guides accompany you to handle cultural nuances, logistics, and real-time translation during hard business negotiations.</p>
              <ul class="vds-deliverables">
                <li>Customized Multi-Factory Itineraries</li>
                <li>Bilingual Technical Translators</li>
                <li>Pre-Verified Production Suitability</li>
                <li>Local Transportation &amp; Logistics Handling</li>
              </ul>
              <button type="button" class="vds-cta-btn" onclick="vdsOpenModal('Book a Tailored Factory Tour','Factory Tours')">Book a Tailored Factory Tour</button>
            </div>
          </div>

          <div class="vds-field-card">
            <img src="<?php echo esc_url($qa); ?>" alt="Rigorous quality assurance inspections">
            <div class="vds-fc-body">
              <h3>Rigorous Quality Assurance</h3>
              <p class="vds-sub">International compliance standards verified independently on-site.</p>
              <p class="vds-desc">Do not leave quality to chance. Partnered with a leading international third-party Quality Assurance firm, we conduct objective, strict audits right at the factory machines. From raw material verification to final container loading inspections, we ensure your goods meet precise technical blueprints.</p>
              <ul class="vds-deliverables">
                <li>Independent Pre-Shipment Inspections</li>
                <li>ISO / Social Compliance Factory Audits</li>
                <li>Lab Testing &amp; Certification Procedures</li>
                <li>Defect Sorting &amp; Corrective Action Plans</li>
              </ul>
              <button type="button" class="vds-cta-btn" onclick="vdsOpenModal('Schedule a Quality Inspection','Quality Assurance')">Schedule a Quality Inspection</button>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="vds-modal-overlay" id="vdsModalOverlay">
      <div class="vds-modal">
        <button type="button" class="vds-modal-close" onclick="vdsCloseModal()">&times;</button>
        <span class="vds-eyebrow">Vietnam Direct Sourcing</span>
        <h3 id="vdsModalTitle">Request a Consultation</h3>
        <form id="vdsModalForm">
          <input type="hidden" name="action" value="vds_solutions_form">
          <input type="hidden" name="vds_service" id="vdsServiceField" value="">
          <label>Full Name *</label>
          <input type="text" name="vds_name" placeholder="Your name" required>
          <label>Email Address *</label>
          <input type="email" name="vds_email" placeholder="you@company.com" required>
          <label>Product / Brief Description</label>
          <textarea name="vds_message" placeholder="Tell us about the product you want to source, your target volume, or any specific requirements..."></textarea>
          <button type="submit" class="vds-cta-btn" id="vdsSubmitBtn">Send Enquiry</button>
          <div class="vds-modal-msg" id="vdsModalMsg"></div>
        </form>
      </div>
    </div>

    <script>
    function vdsOpenModal(title, service){
        document.getElementById('vdsModalTitle').textContent = title;
        document.getElementById('vdsServiceField').value = service;
        document.getElementById('vdsModalMsg').textContent = '';
        document.getElementById('vdsModalMsg').className = 'vds-modal-msg';
        var f = document.getElementById('vdsModalForm'); if(f) f.style.display = '';
        document.getElementById('vdsModalOverlay').classList.add('vds-open');
    }
    function vdsCloseModal(){ document.getElementById('vdsModalOverlay').classList.remove('vds-open'); }
    document.getElementById('vdsModalOverlay').addEventListener('click', function(e){ if(e.target === this) vdsCloseModal(); });
    document.getElementById('vdsModalForm').addEventListener('submit', function(e){
        e.preventDefault();
        var form = this;
        var btn = document.getElementById('vdsSubmitBtn');
        var msg = document.getElementById('vdsModalMsg');
        btn.textContent = 'Sending...'; btn.disabled = true;
        var data = new FormData(form);
        fetch('<?php echo esc_url($ajax); ?>', { method:'POST', body:data })
          .then(function(r){ return r.json(); })
          .then(function(data){
              if(data.success){
                  msg.textContent = data.data;
                  msg.className = 'vds-modal-msg success';
                  form.style.display = 'none';
              } else {
                  msg.textContent = data.data || 'Something went wrong.';
                  msg.className = 'vds-modal-msg error';
                  btn.textContent = 'Send Enquiry'; btn.disabled = false;
              }
          })
          .catch(function(){
              document.getElementById('vdsModalMsg').textContent = 'Network error. Please email contact@vietnam-directsourcing.com.';
              document.getElementById('vdsModalMsg').className = 'vds-modal-msg error';
              btn.textContent = 'Send Enquiry'; btn.disabled = false;
          });
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode( 'vds_solutions', 'vds_solutions_shortcode' );


/* VDS: add areaServed to Organization schema (no physical address) */
add_filter('wpseo_schema_organization', function($data){ $data['areaServed'] = array(array('@type'=>'Country','name'=>'Vietnam'), 'Worldwide'); return $data; });
