<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Knowledge
 */

$busyness_options = busyness_get_theme_options();
$busyness_class   = has_post_thumbnail() ? '' : 'no-post-thumbnail';
?>

<article class="hentry" id="post-<?php the_ID(); ?>" <?php post_class( $busyness_class ); ?>>
    <div class="blog-wrapper">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="featured-image">
                <a href="<?php the_permalink(); ?>">
                    <img src="<?php the_post_thumbnail_url( ); ?>" alt="post-image">
                </a>
                <?php
                if ( ! $busyness_options['hide_date'] ) :
                    echo '<div class="entry-meta">';
                    busyness_posted_on();
                    knowledge_posted_by();
                    echo '</div><!-- .entry-meta -->';
                endif;
                ?>
            </div><!-- .featured-image -->
        <?php endif; ?>

        <div class="entry-container">
            <header class="entry-header">
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php
                if ( ! $busyness_options['hide_date'] && $busyness_class == "no-post-thumbnail" ) :
                    echo '<div class="entry-meta">';
                    busyness_posted_on();
                    echo '</div><!-- .entry-meta -->';
                endif;
                ?>
            </header>

            <div class="entry-content">
                <?php the_excerpt(); ?>
            </div><!-- .entry-content -->

            <footer class="entry-footer">
                <?php
                knowledge_archive_categories();
                knowledge_edit_link();
                ?>
            </footer>

        </div><!-- .entry-container -->
    </div><!-- .post-item-wrapper -->
</article><!-- #post-## -->
