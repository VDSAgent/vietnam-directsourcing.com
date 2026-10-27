/**
 * VDS - FAQ page: drop the stale hardcoded FAQPage schema   [v1, 9 Oct 2026]
 *
 * The parent theme (functions.php, vds_faq_page_schema) prints a hardcoded 13-question
 * FAQPage block that is out of date ("I can source...", eight categories). The correct
 * 21-question block is generated from ACF by snippet 3924. Two FAQPage blocks on one
 * page is invalid for Google's rich-result rules, so unhook the theme one on the 'wp'
 * action (after functions.php has loaded, before wp_head). Theme file is not edited.
 * Reversible: toggle this snippet Inactive.
 */

add_action( 'wp', function () {
	if ( has_action( 'wp_head', 'vds_faq_page_schema' ) ) {
		remove_action( 'wp_head', 'vds_faq_page_schema' );
	}
} );
