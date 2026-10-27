<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Knowledge
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'clear' ); ?>>

    <div class="entry-content">
        <?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'knowledge' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'knowledge' ),
				'after'  => '</div>',
			) );
		?>
    </div><!-- .entry-content -->

    <?php busyness_entry_footer(); ?>
</article><!-- #post-## -->
