<?php
/*
// Template Name: Single Post Template
*/
get_header();
?>
<!--page-title-area start-->
        <section class="page-title-area page-title-blog-details grey-bg pt-220 pb-100 pt-lg-200  pt-md-160  pt-xs-160 pb-xs-90">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="page-title-wrapper text-center">
	                            <h1 class="h1 page-title mb-25"><?php echo get_the_title();?></h1>
                            <div class="blog-meta mb-25">
                                <a href="javascript:void(0)" class="meta-links"><?php echo get_the_date('F j, Y'); ?></a>
                                <a href="javascript:void(0)" class="meta-links"> - <?php echo do_shortcode('[post-views]'); ?> Views</a>
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
							<h3>Listen to the episode</h3>
							<p>
								This topic is also a short episode of the VDS podcast, on YouTube and <a href="https://creators.spotify.com/pod/show/vietnam-direct-sourcing">Spotify</a>.
							</p>
							
							<?php
							// YouTube and Spotify buttons open the episode on /podcast/ when the article has one.
							$episode_url = vds_article_episode_url( get_the_ID() );
							$youtube_link = get_field('youtube_link');
							if($youtube_link) { ?>
								<a <?php echo $episode_url ? '' : 'target="_blank" '; ?>href="<?php echo esc_url( $episode_url ?: $youtube_link ); ?>" class="podcast-video"><img class="podcast-logo" src="https://vietnam-directsourcing.com/wp-content/uploads/2024/11/new-youtube-logo.svg"></a>
							<?php } ?>							
							<?php 
							$postcast_link = get_field('postcast_link');
							if($postcast_link) { ?>
								<a <?php echo $episode_url ? '' : 'target="_blank" '; ?>href="<?php echo esc_url( $episode_url ?: $postcast_link ); ?>" class="podcast-video"><img class="podcast-logo" src="https://vietnam-directsourcing.com/wp-content/uploads/2024/11/spotify-logo.svg"></a>
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
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center post-nav mb-60">
                            <div class="col-md-6 post-left">
                                <?php
                                $prev_post = get_previous_post();
                                if ( ! empty( $prev_post ) ): ?>
                                    <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
                                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/img/icon/left-arrow.svg" alt="Left Arrow">
                                    </a>
                                    <h4 class="nav-heding mt-2"><?php echo apply_filters( 'the_title', $prev_post->post_title ); ?></h4>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 post-right">
                                <?php
                                $next_post = get_next_post();
                                if ( ! empty( $next_post ) ): ?>
                                    <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
                                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/img/icon/right-arrow.svg" alt="Right Arrow">
                                    </a>
                                    <h4 class="nav-heding mt-2"><?php echo apply_filters( 'the_title', $next_post->post_title ); ?></h4>
                                <?php endif; ?>
                            </div>
                        </div>
						
                    </div>
					<div class="col-xl-2 col-lg-2"></div>
                </div><!--/.row-->
            </div><!--/.container-->
        </section>
        <!--comic-blog end-->
<?php
get_footer();