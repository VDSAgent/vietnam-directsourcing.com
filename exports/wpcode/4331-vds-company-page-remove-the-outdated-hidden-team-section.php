/**
 * VDS - Company page: remove the outdated hidden team section   [v1, 26 Oct 2026]
 *
 * The theme's about template prints 'Our Experienced Team' (built from the 'team' posts) as <section class="copic-team">.
 * Snippet 4004 already hides it with CSS and shows the current team grid instead; Rod confirmed that grid is the correct
 * team (26 Oct 2026). This strips the old section from the final HTML on the Company page (ID 16) only, so outdated
 * names are not served to visitors or crawlers. Theme files are not edited. Reversible: toggle this snippet Inactive.
 */
if ( ! function_exists( 'vds_company_remove_legacy_team' ) ) {
	function vds_company_remove_legacy_team( $html ) {

		if ( is_admin() || ! is_string( $html ) || false === strpos( $html, 'copic-team' ) || 16 !== (int) get_queried_object_id() ) {
			return $html;
		}

		$out = preg_replace( '#<section class="copic-team[^"]*">.*?</section>#s', '', $html, 1 );

		// Only accept the result if the regex ran cleanly.
		return ( is_string( $out ) && '' !== $out ) ? $out : $html;
	}
}

add_filter( 'litespeed_buffer_before', 'vds_company_remove_legacy_team' );
add_filter( 'wp_template_enhancement_output_buffer', 'vds_company_remove_legacy_team' );
