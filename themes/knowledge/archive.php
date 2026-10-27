<?php
/**
 * The main template file
 */

get_header(); ?>
  <div class="images-bg pt-280  pt-lg-200 pt-md-160  pt-xs-160 ">
      <!-- <div class="detail">
  				<img src="<?php //echo site_url();?>/wp-content/uploads/2016/05/top_News_1.png" class="images-background" />
      </div> -->
      <div class="title-custom-page">
        <div class="container">
          <div class="row">
            <div class="detail-title-page">
              <h1 class="title-page">
                <?php echo $current_category = single_cat_title("", false); ?>
              </h1>
            </div>
          </div>
        </div>
      </div>
  </div>
<?php
if(!is_home()){
?>
<div class="custom-breadcrumbs category-custom-no-bg">
  <div class="container">
    <div class="row">
        <?php
          custom_breadcrumbs();
        ?>
    </div>
  </div>
</div>
<?php
}
?>
<div class="container theme-showcase pt-40" role="main">
  <div class="row">
    <div class="content-blog-padding-left">
      <ul class="show-all-post-casestudy col-md-10 col-sm-10 col-xs-12">
      <?php while ( have_posts() ) : the_post(); ?>
            <li class="colum-full-blogs">
              <div class="img-holder col-md-6 col-sm-6 col-xs-12">
                <a href="<?php echo get_permalink();?>" class="images_shortcode_services">
                  <?php if( has_post_thumbnail( get_the_ID() ) ) { ?>                          
                    <?php echo get_the_post_thumbnail( get_the_ID(), 'detail' ); ?>                          
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
                  echo abc_substr(get_the_excerpt(),220);
                ?></p>
                <a class="more" href="<?php the_permalink(); ?>"><?php _e( 'Read more >', 'knowledge' ); ?></a>                            
              </div>
          </li>    
      <?php endwhile; ?>
      </ul>
      <div class="sidebar-blog col-xs-12 col-sm-2 col-md-2">
       <?php if ( is_active_sidebar( 'sidebar-blog' ) ) : ?>
          <ul id="sidebar-detail">
            <?php dynamic_sidebar( 'sidebar-blog' ); ?>
          </ul>
        <?php endif; ?>
    </div>
    </div>
  </div>
</div>
<?php
get_footer();
?>