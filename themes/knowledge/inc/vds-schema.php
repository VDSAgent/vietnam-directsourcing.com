<?php
/**
 * Structured data (JSON-LD) on top of Yoast SEO's graph.
 *
 * Formerly WPCode snippets 3833, 3924, 4226 (part 3), 4232 (part 2), 4236 and the
 * areaServed filter in functions.php.
 */

/** Organization node: LocalBusiness with founder, address, area served and opening hours. */
function vds_schema_organization( $data ) {
	$data['foundingDate'] = '2024';
	$data['founder'] = array(
		'@type'    => 'Person',
		'name'     => 'Rod Smith',
		'jobTitle' => 'Sourcing Manager',
		'sameAs'   => array( 'https://www.linkedin.com/in/roddouglassmith/' ),
	);
	$data['@type'] = array( 'Organization', 'LocalBusiness' );
	$data['address'] = array(
		'@type'           => 'PostalAddress',
		'streetAddress'   => 'Suite 504, Level 3, 74 Bach Dang, Hai Chau 1, Hai Chau',
		'addressLocality' => 'Da Nang',
		'postalCode'      => '550000',
		'addressCountry'  => 'VN',
	);
	$data['areaServed'] = array( array( '@type' => 'Country', 'name' => 'Vietnam' ), 'Worldwide' );
	// Vietnam time. No phone number by design.
	$hours = array(
		array('@type' => 'OpeningHoursSpecification', 'dayOfWeek' => array('Monday', 'Tuesday', 'Wednesday', 'Thursday'), 'opens' => '08:00', 'closes' => '11:00'),
		array('@type' => 'OpeningHoursSpecification', 'dayOfWeek' => 'Friday', 'opens' => '08:00', 'closes' => '17:00'),
	);
	if ( empty( $data['openingHoursSpecification'] ) ) {
		$data['openingHoursSpecification'] = $hours;
	}
	return $data;
}
add_filter( 'wpseo_schema_organization', 'vds_schema_organization' );

/** The contact page is a ContactPage (keeps WebPage) and an og:type website. */
function vds_is_contact_page() {
	return is_page( 'contact-for-sourcing' );
}

function vds_schema_contact_webpage( $data ) {
	if ( vds_is_contact_page() ) {
		$data['@type'] = array( 'WebPage', 'ContactPage' );
	}
	return $data;
}
add_filter( 'wpseo_schema_webpage', 'vds_schema_contact_webpage' );

function vds_contact_og_type( $type ) {
	return vds_is_contact_page() ? 'website' : $type;
}
add_filter( 'wpseo_opengraph_type', 'vds_contact_og_type' );

/** FAQPage on the FAQ page (ID 1296), built from the ACF FAQ repeater. */
function vds_schema_faq() {
	if ( ! is_page(1296) ) return;
	if ( ! function_exists('get_field') ) return;
	$rows = get_field('field_66e58d8dceaa5', 1296);
	if ( empty($rows) || ! is_array($rows) ) return;
	$items = array();
	foreach ($rows as $row) {
		if ( ! is_array($row) ) continue;
		$vals = array_values($row);
		$q = isset($vals[0]) ? trim( wp_strip_all_tags($vals[0]) ) : '';
		$a = isset($vals[1]) ? trim( wp_strip_all_tags($vals[1]) ) : '';
		if ($q === '' || $a === '') continue;
		$items[] = array(
			'@type' => 'Question',
			'name'  => $q,
			'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $a ),
		);
	}
	if ( empty($items) ) return;
	$schema = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => $items,
	);
	echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
}
add_action( 'wp_head', 'vds_schema_faq', 20 );

/** Service + offer catalogue on the Solutions page (ID 13). No prices, so it cannot go stale. */
function vds_schema_service() {
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
}
add_action( 'wp_head', 'vds_schema_service', 30 );

/** PodcastEpisode on episode pages, PodcastSeries on the /podcast/ page. */
function vds_schema_podcast() {
	$series = array('@type' => 'PodcastSeries', 'name' => 'Vietnam Direct Sourcing Podcast', 'url' => home_url('/podcast/'),
		'publisher' => array('@type' => 'Organization', 'name' => 'Vietnam Direct Sourcing', 'url' => home_url('/')));
	$data = null;
	if (is_singular('podcast')) {
		$id    = get_queried_object_id();
		$desc  = wp_strip_all_tags(get_post_field('post_content', $id));
		$media = array();
		foreach ((array) (function_exists('get_field') ? get_field('youtube_links', $id) : array()) as $row) {
			if (!empty($row['link'])) {
			$vo = array('@type' => 'VideoObject', 'name' => get_the_title($id), 'contentUrl' => esc_url_raw($row['link']), 'uploadDate' => get_the_date('c', $id), 'description' => wp_trim_words($desc, 40));
			if (preg_match('~(?:youtu\.be/|/shorts/|[?&]v=|/embed/)([A-Za-z0-9_-]{11})~', $row['link'], $vm)) {
				$vo['thumbnailUrl'] = 'https://i.ytimg.com/vi/' . $vm[1] . '/hqdefault.jpg';
				$vo['embedUrl']     = 'https://www.youtube.com/embed/' . $vm[1];
			}
			$media[] = $vo; break;
		}
		}
		$data = array('@context' => 'https://schema.org', '@type' => 'PodcastEpisode', 'name' => get_the_title($id), 'url' => get_permalink($id),
			'description' => wp_trim_words($desc, 60), 'datePublished' => get_the_date('c', $id), 'partOfSeries' => $series);
		if ($media) $data['associatedMedia'] = $media[0];
	} elseif (is_page_template('podcast-tpl.php')) {
		$data = array_merge(array('@context' => 'https://schema.org'), $series, array('description' => 'Conversations about sourcing from Vietnam: manufacturers, trade agreements, quality control and procurement.'));
	}
	if ($data) echo '<script type="application/ld+json">' . wp_json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action( 'wp_head', 'vds_schema_podcast', 30 );
