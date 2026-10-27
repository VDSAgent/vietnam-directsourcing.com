<?php
/**
 * "Let's talk about what you're sourcing" banner, linking to the contact page.
 *
 * Shared by the page templates and single articles (inc/vds-articles.php).
 *
 * $args (all optional):
 *   image          URL of the right-hand illustration; defaults to the ACF option
 *                  'image_section_action'; false for no image
 *   image_height   height attribute for the illustration, default 270 (0 = none)
 *   text_cols      Bootstrap columns for the heading (6 or 7), default 6
 *   section_class  spacing classes for the section
 *   shapes         false to omit the decorative shapes; 'home' for the homepage set
 */

$vds_image = $args['image'] ?? null;
if ( null === $vds_image ) {
	$vds_option = function_exists( 'get_field' ) ? get_field( 'image_section_action', 'option' ) : null;
	$vds_image  = is_array( $vds_option ) ? $vds_option['url'] : false;
}
$vds_height    = (int) ( $args['image_height'] ?? 270 );
$vds_text_cols = (int) ( $args['text_cols'] ?? 6 );
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
				<div class="row align-items-center">
					<div class="col-lg-<?php echo $vds_text_cols; ?> col-md-<?php echo $vds_text_cols; ?>">
						<div class="cta-title text-center text-md-start mb-30">
							<h2>Let's talk about what you're sourcing</h2>
						</div>
					</div>
					<?php if ( $vds_image ) : ?>
						<div class="col-lg-<?php echo 12 - $vds_text_cols; ?> col-md-<?php echo 12 - $vds_text_cols; ?>">
							<div class="chat-manager text-center text-lg-end mb-30">
								<img src="<?php echo esc_url( $vds_image ); ?>" alt=""<?php echo $vds_height ? ' height="' . $vds_height . '"' : ''; ?>>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</a>
		</div>
	</div>
</section>
