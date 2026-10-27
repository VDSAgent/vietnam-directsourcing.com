/**
 * VDS - Remove leftover header search markup   [v1, 9 Oct 2026]
 *
 * The knowledge theme prints a header search box (<li><div class="search-area">) that
 * is already hidden by Additional CSS. Its icon uses alt="icon-not-found" and it adds a
 * pointless focusable link/form for keyboard and screen-reader users. This strips that
 * <li> from the final front-end HTML. Theme files are not edited, and the theme's own
 * JS safely does nothing when the element is absent.
 * Reversible: toggle this snippet Inactive.
 */

if ( ! function_exists( 'vds_remove_header_search' ) ) {
	function vds_remove_header_search( $html ) {

		if ( is_admin() || ! is_string( $html ) || false === strpos( $html, 'search-area' ) ) {
			return $html;
		}

		$out = preg_replace( '#<li>\s*<div class="search-area">.*?</div>\s*</li>#s', '', $html, 1 );

		// Only accept the result if the regex ran cleanly.
		return ( is_string( $out ) && '' !== $out ) ? $out : $html;
	}
}

add_filter( 'litespeed_buffer_before', 'vds_remove_header_search' );
add_filter( 'wp_template_enhancement_output_buffer', 'vds_remove_header_search' );
