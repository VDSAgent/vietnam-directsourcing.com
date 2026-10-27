<?php
/**
 * Company page: "Tech-Enabled Transparency" (formerly WPCode snippet 4004).
 */

// image (path under uploads/), label
$vds_eco = array(
	array( '2026/10/Odoo-Inventory.png', 'Inventory' ),
	array( '2026/10/Odoo-Manufacturing.png', 'Manufacturing' ),
	array( '2026/10/Odoo-Purchase.png', 'Purchase' ),
	array( '2026/10/Odoo-Quality.png', 'Quality' ),
);
$vds_uploads = 'https://vietnam-directsourcing.com/wp-content/uploads/';
?>
<section class="vds-eco pt-120 pb-110 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">
	<div class="container">
		<div class="row justify-content-center"><div class="col-xl-8"><div class="section-title text-center mb-70">
			<h2 class="mb-20">Tech-Enabled Transparency</h2>
			<p>We run an integrated tech stack — including Odoo ERP — to give you real-time visibility into supplier vetting, factory audits, quality inspections, and shipment status. You see where your production actually stands, not just what we report back.</p>
		</div></div></div>
		<div class="vds-eco-grid">
			<?php foreach ( $vds_eco as list( $image, $label ) ) : ?>
				<div class="vds-member"><div class="photo"><img src="<?php echo esc_url( $vds_uploads . $image ); ?>" alt="<?php echo esc_attr( $label ); ?>" loading="lazy" /></div><div class="body"><h3><?php echo esc_html( $label ); ?></h3></div></div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
