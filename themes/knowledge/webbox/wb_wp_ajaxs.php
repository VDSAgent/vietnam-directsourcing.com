<?php
/**
 * Public AJAX loader behind the /podcast/ "Load More" button (assets/js/main.js).
 *
 * Visitors may only page through published podcast episodes: the query is
 * rebuilt from a whitelist instead of passing the request data to WP_Query.
 */
class wb_wp_ajaxs
{
    public function __construct()
    {
        add_action( 'wp_ajax_wb_load_blog', [ $this, 'calback_wb_load_blog' ] );
        add_action( 'wp_ajax_nopriv_wb_load_blog', [ $this, 'calback_wb_load_blog' ] );
    }

    public function calback_wb_load_blog()
    {
        $data = isset( $_POST['data'] ) && is_array( $_POST['data'] ) ? wp_unslash( $_POST['data'] ) : null;
        if ( ! $data ) {
            wp_die();
        }

        // Same keys podcast-tpl.php puts in data-args; 'paged' is the page already shown.
        $args = [
            'post_type'      => 'podcast',
            'post_status'    => 'publish',
            'posts_per_page' => min( 50, max( 1, absint( $data['posts_per_page'] ?? 10 ) ) ),
            'order'          => ( isset( $data['order'] ) && strtoupper( (string) $data['order'] ) === 'ASC' ) ? 'ASC' : 'DESC',
            'orderby'        => 'date',
            'paged'          => max( 1, absint( $data['paged'] ?? 1 ) ) + 1,
        ];

        $loop = new WP_Query( $args );
        ob_start();
        if ( $loop->have_posts() ) {
            while ( $loop->have_posts() ) {
                $loop->the_post();
                get_template_part( 'loop/podcast', 'null' );
            }
            wp_reset_postdata();
        } else {
            ?>
            <div class="no-posts align-center">
                <?php esc_html_e( 'No post found.' ); ?>
            </div>
            <?php
        }

        wp_send_json( [
            'items' => ob_get_clean(),
            'more'  => $loop->max_num_pages > $args['paged'],
            'args'  => $args,
        ] );
    }
}
new wb_wp_ajaxs();
