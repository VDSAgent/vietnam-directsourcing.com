<?php
get_header(); ?>
<?php
global $tp_options;
$images_bg=get_field('images_bg',get_the_ID ());
$title_page=get_field('title_page',get_the_ID ());
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
        <img src="<?php echo esc_url( site_url() );?>/wp-content/uploads/2016/05/imageabouts.png" class="images-background" />
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

<?php 
  echo '</div>';
?>
<div class="content-single-custom">
  <div class="custom-breadcrumbs">
    <div class="container">
      <div class="row">
          <?php
            custom_breadcrumbs();
          ?>
      </div>
    </div>
  </div>
  <div class="container" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="row">
        <div class="top-single-post">
          <div class="col-md-2 col-sm-2 col-xs-12 pre-post">
           <?php previous_post_link('%link', '<< PREVIOUS'); ?><?php next_post_link('%link', 'NEXT >>'); ?>
            <a class="back-pages-blogs" href="<?php echo esc_url( site_url('/news') );?>">&laquo; BACK TO NEWS PAGE</a>
          </div>
          <div class="col-md-8 col-sm-8 col-xs-12 title-post-signle">
              <h2 class="title-singler-post"><?php echo get_the_title();?></h2>
              <?php //the_date('d/m/Y', '<p>', '</p>'); ?>
          </div>
        </div>
      	<div class="class-width-single">
          <div class="col-md-12 col-sm-12 col-xs-12 single-post">
            <?php
              if ( has_post_thumbnail() ) {
                echo '<div class="featured-image-custom">';
                  the_post_thumbnail( 'full' );
                echo '</div>';
              }
            ?>
          		<?php the_content(); ?>
              <div class="share-single">
                <h3 class="title-share">Share</h3>
                <ul class="detail-share-single">
                  <li class="share_twitter">
                    <a class="twitter" href="#" target="_blank" onclick="window.open('http://twitter.com/share?text=<?php echo get_the_title();?> -&url=<?php the_permalink();?>', 'twitterShare', 'width=626,height=436'); return false;">
                      <i class="fa fa-twitter"></i>
                    </a>
                  </li>
                  <li class="share_facebook">
                    <a class="facebook" href="#" target="_blank" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>/&t=<?php echo get_the_title();?>', 'facebookShare'); return false;">
                      <i class="fa fa-facebook-square"></i>
                    </a>
                  </li>
                </ul>
              </div>
        	</div>
          <div class="container main-share-social summary">
            <?php
              custom_social();
            ?>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>
<?php
get_footer();
?>