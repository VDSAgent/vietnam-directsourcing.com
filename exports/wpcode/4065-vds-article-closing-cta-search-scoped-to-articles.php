/**
 * VDS - two things:
 *  1. Append the closing CTA banner to single articles (posts have no such block in the theme).
 *  2. Restrict front-end search to posts, so pages (including the gated /quote/) never appear.
 */

add_filter( 'the_content', function ( $content ) {
    static $done = false;
    if ( is_admin() || $done || ! is_singular( 'post' ) || ! is_main_query() ) {
        return $content;
    }
    $done = true;

    $url = esc_url( home_url( '/contact-for-sourcing/' ) );

    $cta  = '<section class="call-to-action pt-100 pb-120 pt-md-60 pb-lg-80 pb-md-30 pt-xs-60 pb-xs-30">';
    $cta .= '<div class="container"><div class="cta-border">';
    $cta .= '<a href="' . $url . '">';
    $cta .= '<div class="row align-items-center"><div class="col-lg-7 col-md-7">';
    $cta .= '<div class="cta-title text-center text-md-start mb-30">';
    $cta .= '<h2>Let\'s talk about what you\'re sourcing</h2>';
    $cta .= '</div></div></div>';
    $cta .= '</a>';
    $cta .= '</div></div></section>';

    return $content . $cta;
}, 20 );

add_action( 'pre_get_posts', function ( $q ) {
    if ( ! is_admin() && $q->is_main_query() && $q->is_search() ) {
        $q->set( 'post_type', 'post' );
    }
} );