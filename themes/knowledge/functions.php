<?php
/* Theme Options */
require_once dirname( __FILE__ ) . '/core/options.php';
require_once dirname( __FILE__ ) . '/core/shortcode.php';
require_once dirname( __FILE__ ) . '/core/function_option.php';
require_once dirname( __FILE__ ) . '/core/postype.php';
/* Vietnam Direct Sourcing (formerly WPCode snippets; see each file's header) */
require_once __DIR__ . '/inc/vds-security.php';
require_once __DIR__ . '/inc/vds-schema.php';
require_once __DIR__ . '/inc/vds-page-copy.php';
require_once __DIR__ . '/inc/vds-articles.php';
require_once __DIR__ . '/inc/vds-podcast.php';
require_once __DIR__ . '/inc/vds-redirects.php';
require_once __DIR__ . '/inc/vds-comments.php';
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
 * Front-end styles and scripts. Versions follow each file's modification time, so a
 * deploy busts the LiteSpeed and CDN caches.
 */
function knowledgetheme_scripts() {
	$uri = get_template_directory_uri();
	$dir = get_template_directory();
	$ver = static function ( $file ) use ( $dir ) {
		return file_exists( $dir . $file ) ? filemtime( $dir . $file ) : null;
	};

	// Brand fonts: Saira Extra Condensed + Poppins (loaded by main.css); Montserrat
	// SemiBold only for the logo wordmark, subset to its own letters.
	wp_enqueue_style( 'vds-logo-font', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@600&text=' . rawurlencode( 'Vietnam Direct Sourcing' ) . '&display=swap', array(), null );

	$styles = array(
		'style-custom-bootstrap.min' => '/assets/css/bootstrap.min.css',
		'style-custom-owl'           => '/assets/css/owl.carousel.min.css',
		'style-custom-animate'       => '/assets/css/animate.css',
		'style-custom-magnific'      => '/assets/css/magnific-popup.css',
		'style-custom-all'           => '/assets/css/all.min.css',
		'style-custom-metisMenu'     => '/assets/css/metisMenu.css',
		'style-custom-nice'          => '/assets/css/nice-select.css',
		'style-custom-spacing'       => '/assets/css/spacing.css',
		'style-custom-main'          => '/assets/css/main.css',
		'style-t'                    => '/style-t.css',
		'custom'                     => '/custom.css',
		'vds'                        => '/assets/css/vds.css',
	);
	foreach ( $styles as $handle => $file ) {
		wp_enqueue_style( $handle, $uri . $file, array(), $ver( $file ) );
	}

	// jQuery plugins run on WordPress's own jQuery (the theme used to load jQuery 1.12.4
	// over it, which has known XSS vulnerabilities).
	$scripts = array(
		'custom-js-modernizr'                 => array( '/assets/js/vendor/modernizr-3.5.0.min.js', array() ),
		'custom-js-popper-min'                => array( '/assets/js/popper.min.js', array() ),
		'custom-js-bootstrap.min'             => array( '/assets/js/bootstrap.min.js', array( 'custom-js-popper-min' ) ),
		'custom-js-owl.carousel-min'          => array( '/assets/js/owl.carousel.min.js', array( 'jquery' ) ),
		'custom-js-isotope.pkgd-min'          => array( '/assets/js/isotope.pkgd.min.js', array( 'jquery' ) ),
		'custom-js-metisMenu.min'             => array( '/assets/js/metisMenu.min.js', array( 'jquery' ) ),
		'custom-js-jquery.nice-select'        => array( '/assets/js/jquery.nice-select.js', array( 'jquery' ) ),
		'custom-js-wow.min'                   => array( '/assets/js/wow.min.js', array() ),
		'custom-js-waypoints.min'             => array( '/assets/js/waypoints.min.js', array( 'jquery' ) ),
		'custom-js-jquery.counterup.min'      => array( '/assets/js/jquery.counterup.min.js', array( 'jquery', 'custom-js-waypoints.min' ) ),
		'custom-js-imagesloaded.pkgd.min'     => array( '/assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ) ),
		'custom-js-jquery.magnific-popup.min' => array( '/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ) ),
		'custom-js-main'                      => array( '/assets/js/main.js', array( 'jquery' ) ),
	);
	foreach ( $scripts as $handle => list( $file, $deps ) ) {
		wp_enqueue_script( $handle, $uri . $file, $deps, $ver( $file ) );
	}
	// main.js (podcast Load More) posts to admin-ajax.php via the global ajaxurl.
	wp_add_inline_script( 'custom-js-main', 'var ajaxurl = ' . wp_json_encode( admin_url( 'admin-ajax.php' ) ) . ';', 'before' );

	wp_enqueue_script( 'vds', $uri . '/assets/js/vds.js', array(), $ver( '/assets/js/vds.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'knowledgetheme_scripts' );

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
  </div>
</div>
<?php
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
        'taxonomy'           => ( is_array( $atts ) && isset( $atts['cat'] ) ) ? $atts['cat'] : null
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
