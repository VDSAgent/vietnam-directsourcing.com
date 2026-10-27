
<?php get_header();?>
<?php
global $tp_options;
$page_id_custom = get_option( 'page_for_posts' );
$images_bg=get_field('images_bg',$page_id_custom);
$title_page=get_field('title_page',$page_id_custom);
?>
<div class="images-bg">
    <?php
    if(!empty($images_bg)){
      ?>
      <div class="detail">
        <img src="<?php echo $images_bg; ?>" class="images-background" />
      </div>
    <?php
    }
    else{ ?>
      <div class="detail">
        <img src="<?php echo site_url();?>/wp-content/uploads/2016/05/imageabouts.png" class="images-background" />
      </div>
    <?php 
    }
    if(!empty($title_page)){
      $title_page=get_field('title_page');
    }
    else{
      $title_page=get_the_title();
    }
      ?>
      <div class="title-custom-page">
        <div class="container">
          <div class="row">
            <div class="detail-title-page">
              <h1 class="title-page">
                <?php
                  echo $title_page;
                ?>
              </h1>
            </div>
          </div>
        </div>
      </div>
  </div>

<div class="custom-top-content" style="padding-bottom: 50px; background:rgba(0, 0, 0, 0) url('<?php echo get_field('background_top_content',$page_id_custom);?>') no-repeat scroll 0 0 / cover">
  <div class="container">
    <div class="row">
        <?php
          custom_breadcrumbs();
        ?>
    </div>
  </div>
  <div class="container width-700-padding-right">
    <div class="row">
        <?php
          $title_content=get_field('title_content',$page_id_custom);
          $text_content=get_field('text_content',$page_id_custom);
        ?> 
        <h2 class="title-text-page">
          <?php
            echo $title_content;
          ?>
        </h2>
        <div class="text_content_pages">
          <?php
            echo $text_content;
          ?>
        </div>
    </div>
  </div>
</div>
<div class="container theme-showcase" role="main">
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
                  else{?>
                    <img width="399" height="277" src="<?php echo get_site_url();?>/wp-content/uploads/2016/05/DS_31.jpg" class="attachment-detail size-detail wp-post-image" alt="img">
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