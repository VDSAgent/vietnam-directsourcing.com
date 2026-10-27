/**
 * VDS - Hide decorative theme shapes from screen readers   [v1, 9 Oct 2026]
 *
 * The knowledge theme hard-codes decorative <img> shapes (page-shape, page-shape-02,
 * cta-shape, fot-shape, slider-shape, manage-shape, contact-shape ...) with alt text
 * such as "Page Shape" / "Cta Shape" / "Dot Shape", which screen readers announce.
 * This filters the final front-end HTML and, on every <img> carrying a "*-shape" class,
 * adds aria-hidden="true" and empties the alt. Content images are untouched.
 * Runs on LiteSpeed's page buffer (outermost, so nothing upstream can swallow it)
 * and on WP core's template output buffer as a fallback; applying twice is harmless.
 * Theme files are not edited. Reversible: toggle this snippet Inactive.
 */

if ( ! function_exists( 'vds_hide_decorative_shapes' ) ) {
	function vds_hide_decorative_shapes( $html ) {

		if ( is_admin() || ! is_string( $html ) || false === stripos( $html, 'shape' ) ) {
			return $html;
		}

		return preg_replace_callback( '#<img\b[^>]*>#i', function ( $m ) {
			$tag = $m[0];

			if ( ! preg_match( '#\bclass\s*=\s*(["\'])(.*?)\1#i', $tag, $c ) ) {
				return $tag;
			}
			// A class token ending in "-shape" or "-shape-NN" marks a theme decoration.
			if ( ! preg_match( '#(?:^|\s)[a-z0-9]+(?:-[a-z0-9]+)*-shape(?:-\d+)?(?:\s|$)#i', $c[2] ) ) {
				return $tag;
			}
			if ( stripos( $tag, 'aria-hidden' ) === false ) {
				$tag = preg_replace( '#^<img\b#i', '<img aria-hidden="true"', $tag );
			}
			if ( preg_match( '#\salt\s*=#i', $tag ) ) {
				$tag = preg_replace( '#(\salt\s*=\s*)(["\']).*?\2#i', '$1""', $tag, 1 );
			} else {
				$tag = preg_replace( '#^<img\b#i', '<img alt=""', $tag );
			}
			return $tag;
		}, $html );
	}
}

add_filter( 'litespeed_buffer_before', 'vds_hide_decorative_shapes' );
add_filter( 'wp_template_enhancement_output_buffer', 'vds_hide_decorative_shapes' );
