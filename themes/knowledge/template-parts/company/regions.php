<?php
/**
 * Company page: "Where We Source" map and regions (formerly WPCode snippet 4004).
 */

// Renewable energy is sourced in the South (Rod, 26 Oct 2026). Link to its guide once
// that article (Ep 60, post 4298) is published; plain text until then.
$vds_renewables = ( 'publish' === get_post_status( 4298 ) )
	? '<a href="/how-to-source-solar-renewable-energy-products-from-vietnam/">renewable energy products</a>'
	: 'renewable energy products';

// name, places, products (HTML), swatch key
$vds_regions = array(
	array( 'North', 'Hanoi, Bac Ninh and Hai Phong', '<a href="/how-to-find-electronic-component-manufacturers-in-vietnam/">Electronic components</a>, <a href="/how-to-find-steel-metal-fabrication-suppliers-in-vietnam/">steel and metal products</a>, and <a href="/how-to-source-construction-materials-from-vietnam/">construction materials</a>, from the industrial belt around Hanoi and the northern ports.', 'north' ),
	array( 'Central', 'Da Nang, Hue and the Central Highlands', '<a href="/organic-fabric-suppliers-vietnam-gots-oeko-tex/">Organic textiles</a>, handicrafts, and <a href="/sourcing-biodegradable-coffins-in-vietnam/">funeral and memorial products</a>, from the central coast inland to the highlands.', 'central' ),
	array( 'South', 'Ho Chi Minh City and the Mekong Delta', '<a href="/find-bamboo-suppliers-in-vietnam/">Bamboo and wood products</a>, <a href="/how-to-find-furniture-wood-manufacturers-in-vietnam/">furniture and home goods</a>, <a href="/how-to-find-biodegradable-compostable-packaging-manufacturers-in-vietnam/">biodegradable plastic and paper</a>, <a href="/healthcare-procurement-vietnam/">health and personal care</a>, ' . $vds_renewables . ', and <a href="/how-to-request-an-fmcg-quote-from-vietnam/">FMCG and consumer goods</a>, from the Binh Duong and Dong Nai manufacturing belt.', 'south' ),
);
?>
<section class="vds-regions pt-120 pb-110 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">
	<div class="container"><div class="row align-items-center">
		<div class="col-xl-4 col-lg-6 mb-40"><div class="vds-map"><?php echo file_get_contents( __DIR__ . '/vietnam-regions.svg' ); ?></div></div>
		<div class="col-xl-8 col-lg-6">
			<h2 class="mb-25">Where We Source: North, Central, and South</h2>
			<p class="vds-lede">Our specialists are based in Hanoi, Da Nang and Ho Chi Minh City. That means factory visits at short notice, quality checks carried out in person, and negotiation in Vietnamese &mdash; not a broker relaying messages from another country.</p>
			<?php foreach ( $vds_regions as $vds_region ) : ?>
				<div class="vds-region"><div class="swatch sw-<?php echo esc_attr( $vds_region[3] ); ?>"></div><div><h3><?php echo esc_html( $vds_region[0] ); ?></h3><p class="place"><?php echo esc_html( $vds_region[1] ); ?></p><p class="desc"><?php echo wp_kses_post( $vds_region[2] ); ?></p></div></div>
			<?php endforeach; ?>
		</div>
	</div></div>
</section>
