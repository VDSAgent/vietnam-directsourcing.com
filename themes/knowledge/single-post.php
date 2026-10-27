<?php
/*
// Template Name: Single Post Template
*/
get_header();
$author_id = $post->post_author;
$avatar_url = get_avatar_url( $author_id );


?>
<!--page-title-area start-->
        <section class="page-title-area page-title-blog-details grey-bg pt-220 pb-100 pt-lg-200  pt-md-160  pt-xs-160 pb-xs-90">
            <img class="page-shape shape_01 blog-shape-3 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-11.png" alt="Page Shape">
            <img class="page-shape shape_04 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/orange-1.svg" alt="Page Shape">
            <img class="page-shape shape_05 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="Page Shape">
            <img class="page-shape shape_06 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/berry-1.svg" alt="Page Shape">
            <img class="page-shape-02 shape_08 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-a.svg" alt="Page Shape">
            <img class="page-shape blog-shape-4 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-12.png" alt="">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="page-title-wrapper text-center">
							<!--
                            <img class="blog-author-img" src="<?php echo $avatar_url;?>" alt="Author Img">
                            <h6 class="fw-medium text-uppercase mb-10"><?php echo get_the_author_meta( 'nicename', $author_id ); ?></h6>
-->
                            <h1 class="h1 page-title mb-25"><?php echo get_the_title();?></h1>
                            <div class="blog-meta mb-25">
                                <a href="javascript:void(0)" class="meta-links"><?php echo get_the_date('F j, Y'); ?></a>
                                <a href="javascript:void(0)" class="meta-links"> - <?php echo do_shortcode('[post-views]'); ?> Views - </a>
                                <?php $comments_number = get_comments_number(); ?>
                                <a href="javascript:void(0)" class="meta-links"><?php echo $comments_number; ?> Comment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--page-title-area end-->
        <!--comic-blog start-->
        <section class="comic-blog position-relative pt-120 pb-120 pt-lg-80 pb-lg-80 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">
            <div class="container">
                <div class="row">
					<div class="col-xl-2 col-lg-2"></div>
                    <div class="col-xl-8 col-lg-8">
						

						
                        <?php the_content(); ?>
						
						<div class="podcast-container">
							<h3>Learn more about this topic on our podcast!</h3>
							<p>
								Want to dive deeper into this subject? Check out our latest podcast on this subject on <a href="https://creators.spotify.com/pod/show/vietnam-direct-sourcing">Spotify</a>, where we explore this topic and so much more! Whether you're on the go or relaxing at home, tune in for insights, tips, and discussions that bring our blog topics to life.
							</p>
							
							<?php 
							$youtube_link = get_field('youtube_link');
							if($youtube_link) { ?>
								<a target="_blank" href="<?php echo esc_attr(get_field('youtube_link')); ?>" class="podcast-video"><img class="podcast-logo" src="https://vietnam-directsourcing.com/wp-content/uploads/2024/11/new-youtube-logo.svg"></a>
							<?php } ?>							
							<?php 
							$postcast_link = get_field('postcast_link');
							if($postcast_link) { ?>
								<a target="_blank" href="<?php echo esc_attr(get_field('postcast_link')); ?>" class="podcast-video"><img class="podcast-logo" src="https://vietnam-directsourcing.com/wp-content/uploads/2024/11/spotify-logo.svg"></a>
							<?php } ?>
							<?php 
							$medium_link = get_field('medium_link');
							if($medium_link) { ?>
								<a target="_blank" href="<?php echo esc_attr(get_field('medium_link')); ?>" class="podcast-video"><img style="padding-top: 2px;padding-bottom: 4px;" class="podcast-logo" src="https://vietnam-directsourcing.com/wp-content/uploads/2024/11/Medium-Wordmark-Black.png"></a>
							<?php } ?>							
							
							

							
							
							
						</div>
						
						
                        <div class="row px-0 align-items-center share-links mt-65 mb-40">
                            <div class="col-lg-6 col-md-6">
                                <div class="tag_cloud mb-25">
                                    <?php 
                                    $post_tags = get_the_tags();
                                    if ( ! empty( $post_tags ) ) {
                                        foreach ( $post_tags as $tag ) {
                                            echo '<a class="tag" href="' . esc_attr( get_tag_link( $tag->term_id ) ) . '">' . __( $tag->name ) . '</a>';
                                        }
                                    }

                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 text-start text-md-end ms-auto">
                                <div class="social_share mb-25">
                                    <?php echo do_shortcode('[addtoany]')?>
                                    <!-- <a href="blog-details.html">Share the post<span><i class="fal fa-share-alt"></i></span></a> -->
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center post-nav mb-60">
                            <div class="col-md-6 post-left">
                                <?php
                                $prev_post = get_previous_post();
                                if ( ! empty( $prev_post ) ): ?>
                                    <a href="<?php echo get_permalink( $prev_post->ID ); ?>">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon/left-arrow.svg" alt="Left Arrow">
                                    </a>
                                    <h4 class="nav-heding mt-2"><?php echo apply_filters( 'the_title', $prev_post->post_title ); ?></h4>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 post-right">
                                <?php
                                $next_post = get_next_post();
                                if ( ! empty( $next_post ) ): ?>
                                    <a href="<?php echo get_permalink( $next_post->ID ); ?>">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon/right-arrow.svg" alt="Right Arrow">
                                    </a>
                                    <h4 class="nav-heding mt-2"><?php echo apply_filters( 'the_title', $next_post->post_title ); ?></h4>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php 
                            $comments_args = array(
                                'class_container' => 'comment-form-area mb-30',
                                'class_form' => 'contact-form-1 comment-form mt-40',
                                'class_submit' => 'theme_btn border-0 mt-25',
                                'label_submit' => __( 'Leave a comment', 'textdomain' ),
                                'title_reply' => __( 'Leave a comment', 'textdomain' ),
                                'comment_notes_before' => '',
                                'title_reply_before' => '<h2 class="mb-15">',
                                'title_reply_after' => '</h2><p>Your email address will not be published. Required fields are marked *</p>',
                                'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" />%4$s</button>',
                                'submit_field' => '<div class="col-lg-12"><div class="form-submit">%1$s %2$s</div></div>',
                            );
                            if (comments_open() || get_comments_number()) :                               
                                comment_form($comments_args);
                            endif;
                        ?>
						
                    </div>
					<div class="col-xl-2 col-lg-2"></div>
					<!--
                   <div class="col-xl-3 col-lg-4">
                        <div class="single-widget-area sticky-top">
                            <?php if (is_active_sidebar('single-post-sidebar')) : ?>
                                <?php dynamic_sidebar('single-post-sidebar'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
					-->
                </div><!--/.row-->
            </div><!--/.container-->
        </section>
        <!--comic-blog end-->
<?php
get_footer();