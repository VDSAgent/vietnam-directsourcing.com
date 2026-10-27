<?php
/**
 * Closing banner: "Let's talk about what you're sourcing" with a "Book a 30-minute call"
 * button, linking to the contact page (Odoo booking). Used by the page templates and
 * single articles (inc/vds-articles.php). Styles: "CTA banner" in assets/css/vds.css.
 *
 * $args (optional):
 *   section_class  spacing classes for the section
 *   shapes         false to omit the decorative shapes; 'home' for the homepage set
 */

$vds_shapes    = $args['shapes'] ?? 'default';
$vds_section   = $args['section_class'] ?? 'pt-100 pb-120 pt-md-60 pb-md-30 pt-xs-60';
$vds_theme_img = get_stylesheet_directory_uri() . '/assets/img/';
?>
<section class="call-to-action <?php echo esc_attr( $vds_section ); ?>">
	<?php if ( 'home' === $vds_shapes ) : ?>
		<img class="cta-shape cta-one cta-service2 d-none d-md-inline-block" src="<?php echo esc_url( $vds_theme_img . 'cta/cta-eclip-1.svg' ); ?>" alt="" aria-hidden="true">
		<img class="cta-shape cta-two cta-inner-shape" src="<?php echo esc_url( $vds_theme_img . 'shape/box-2.svg' ); ?>" alt="" aria-hidden="true">
	<?php elseif ( $vds_shapes ) : ?>
		<img class="cta-shape cta-service1 d-none d-md-inline-block" src="<?php echo esc_url( $vds_theme_img . 'cta/cta-eclip-1.svg' ); ?>" alt="" aria-hidden="true">
		<img class="cta-shape cta-two" src="<?php echo esc_url( $vds_theme_img . 'shape/box-2.svg' ); ?>" alt="" aria-hidden="true">
	<?php endif; ?>
	<div class="container">
		<div class="cta-border">
			<a href="<?php echo esc_url( home_url( '/contact-for-sourcing/' ) ); ?>">
				<div class="cta-title">
					<h2>Let's talk about what you're sourcing</h2>
				</div>
				<span class="cta-button">Book a 30-minute call</span>
			</a>
		</div>
	</div>
</section>
