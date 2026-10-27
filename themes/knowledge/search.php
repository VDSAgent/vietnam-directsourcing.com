<?php
/**
 * The template for displaying search results pages
 */
get_header(); ?>

<section class="breadcrumbs-area pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="breadcrumb-title">Search Results for: "<?php echo get_search_query(); ?>"</h2>
            </div>
        </div>
    </div>
</section>

<section class="blog-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php if ( have_posts() ) : ?>
                    <p><?php echo number_format_i18n( $wp_query->found_posts ); ?> results found for "<?php echo get_search_query(); ?>"</p>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item mb-40 pb-40'); ?> style="border-bottom:1px solid #eee;">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="entry-meta" style="color:#999;font-size:13px;margin-bottom:10px;">
                                <?php echo get_the_date(); ?> &bull; <?php echo get_post_type(); ?>
                            </div>
                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="tp-btn mt-15" style="display:inline-block;padding:8px 20px;background:#e84c3d;color:#fff;border-radius:4px;text-decoration:none;">Read More</a>
                        </article>
                    <?php endwhile; ?>

                    <div class="pagination mt-30">
                        <?php the_posts_pagination( array(
                            'prev_text' => '&laquo; Previous',
                            'next_text' => 'Next &raquo;',
                        ) ); ?>
                    </div>

                <?php else : ?>
                    <div class="no-results">
                        <h3>No results found</h3>
                        <p>Sorry, no content matched your search for "<?php echo get_search_query(); ?>". Please try a different search term.</p>
                        <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="display:flex;gap:10px;margin-top:20px;max-width:400px;">
                            <input type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="Try another search..." style="flex:1;padding:10px;border:1px solid #ddd;border-radius:4px;">
                            <button type="submit" style="padding:10px 20px;background:#e84c3d;color:#fff;border:none;border-radius:4px;cursor:pointer;">Search</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>