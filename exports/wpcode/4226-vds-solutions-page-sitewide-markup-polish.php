/**
 * VDS - Solutions page + sitewide markup polish   [v1, 9 Oct 2026]
 *
 *  1. Strip the theme's broken <img src=""> (CTA banner) and give the header/footer logo
 *     a real alt ("logo" -> "Vietnam Direct Sourcing"). Runs on the final page HTML.
 *  2. Add one contextual internal link to /global-sourcing-solutions/ above the closing
 *     CTA on every article (runs just before snippet 4065 appends the CTA, priority 20).
 *  3. Service structured data on the Solutions page (ID 13), linked to the Yoast
 *     Organization (#organization). No prices in the markup, so it can't go stale.
 * Theme files are not edited. Reversible: toggle this snippet Inactive.
 */

if ( ! function_exists( 'vds_markup_polish' ) ) {
	function vds_markup_polish( $html ) {
		if ( is_admin() || ! is_string( $html ) ) {
			return $html;
		}
		$out = preg_replace( '#<img\s+src=""[^>]*>#i', '', $html );
		if ( ! is_string( $out ) || '' === $out ) {
			return $html;
		}
		return str_replace( ' alt="logo"', ' alt="Vietnam Direct Sourcing"', $out );
	}
}
add_filter( 'litespeed_buffer_before', 'vds_markup_polish' );
add_filter( 'wp_template_enhancement_output_buffer', 'vds_markup_polish' );

add_filter( 'the_content', function ( $content ) {
	static $done = false;
	if ( is_admin() || $done || ! is_singular( 'post' ) || ! is_main_query() ) {
		return $content;
	}
	$done = true;
	$url  = esc_url( home_url( '/global-sourcing-solutions/' ) );
	$link = '<p class="vds-solutions-link" style="margin:2.5rem 0 0;"><strong>Not sure where to start?</strong> See how our <a href="' . $url . '">Vietnam sourcing solutions</a> work, from supplier identification to quality assurance.</p>';
	return $content . $link;
}, 19 );

add_action( 'wp_head', function () {
	if ( ! is_page( 13 ) ) {
		return;
	}
	$items = array(
		array( 'Supplier Identification', 'A matched list of vetted, export-ready Vietnamese manufacturers for products with little or no customization.' ),
		array( 'Supplier Evaluation', 'Factory pre-qualification, RFQ management, pro-forma quotes and sample coordination for custom and OEM projects.' ),
		array( 'Production Management', 'On-site production oversight in Vietnam, from signed contract to finished shipment.' ),
		array( 'End-to-End Sourcing', 'A turnkey sourcing team covering identification, negotiation, production oversight, logistics and delivery.' ),
		array( 'Per-Container Management', 'Ongoing production management for regular shippers at a fixed fee per container.' ),
		array( 'Sourcing Partner Retainer', 'A dedicated monthly resource for supplier development, renegotiation and compliance follow-up.' ),
		array( 'Tailored Factory Tours', 'Guided, bilingual visits to Vietnamese manufacturers arranged around your product.' ),
		array( 'Quality Assurance', 'Third-party style inspection of manufactured goods in Vietnam.' ),
	);
	$offers = array();
	foreach ( $items as $i ) {
		$offers[] = array(
			'@type'       => 'Offer',
			'itemOffered' => array(
				'@type'       => 'Service',
				'name'        => $i[0],
				'description' => $i[1],
			),
		);
	}
	$data = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'Service',
		'@id'             => home_url( '/global-sourcing-solutions/#service' ),
		'name'            => 'Vietnam Sourcing Solutions',
		'serviceType'     => 'Sourcing and procurement services',
		'description'     => 'Supplier identification, evaluation, production management, factory tours and quality assurance for international buyers sourcing from Vietnam.',
		'url'             => home_url( '/global-sourcing-solutions/' ),
		'provider'        => array( '@id' => home_url( '/#organization' ) ),
		'areaServed'      => array( '@type' => 'Country', 'name' => 'Vietnam' ),
		'hasOfferCatalog' => array(
			'@type'           => 'OfferCatalog',
			'name'            => 'Vietnam sourcing services',
			'itemListElement' => $offers,
		),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}, 30 );
