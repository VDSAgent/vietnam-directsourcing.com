<?php
/**
 * Company page: "The Local Experts" team grid (formerly WPCode snippet 4004).
 */

// name, role, region key, region label, photo (path under uploads/)
$vds_team = array(
	array( 'Rod', 'Sourcing Manager', 'all', 'Nationwide', '2026/09/vds_team_rod.png' ),
	array( 'Minh', 'Technology Specialist', 'all', 'Nationwide', '2026/09/vds-team-minh.jpg' ),
	array( 'Tho', 'Logistics Specialist', 'all', 'Nationwide', '2026/09/vds-team-tho.jpg' ),
	array( 'Thao', 'Sourcing Specialist', 'central', 'Central', '2026/09/vds-team-hien.jpg' ),
	array( 'Telly', 'North Sourcing Specialist', 'north', 'North', '2026/09/vds-team-telly.jpg' ),
	array( 'Tam', 'North Sourcing Specialist', 'north', 'North', '2026/09/vds_team_tham.png' ),
	array( 'Cassie', 'South Sourcing Specialist', 'south', 'South', '2026/09/vds-team-cassie.jpg' ),
	array( 'Kim', 'South Sourcing Specialist', 'south', 'South', '2026/09/vds-team-kim.png' ),
);
$vds_linkedin = array( 'Rod' => 'https://www.linkedin.com/in/roddouglassmith/' );
$vds_uploads  = 'https://vietnam-directsourcing.com/wp-content/uploads/';
?>
<section class="vds-team sky-blue-bg round-background pt-120 pb-110 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">
	<div class="container">
		<div class="row justify-content-center"><div class="col-xl-8"><div class="section-title text-center mb-70">
			<h2 class="mb-20">The Local Experts Managing Your Supply Chain</h2>
			<p>Sourcing specialists in each region, supported by logistics and technology. Every one of them is a direct employee &mdash; there is no agent layer between you and the factory.</p>
		</div></div></div>
		<div class="vds-team-grid">
			<?php foreach ( $vds_team as list( $name, $role, $key, $label, $photo ) ) : ?>
				<div class="vds-member">
					<div class="photo"><img src="<?php echo esc_url( $vds_uploads . $photo ); ?>" alt="<?php echo esc_attr( $name . ', ' . $role ); ?> at Vietnam Direct Sourcing" loading="lazy" /></div>
					<div class="body">
						<span class="pill pill-<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></span>
						<h3><?php echo esc_html( $name ); ?></h3>
						<p class="role"><?php echo esc_html( $role ); ?></p>
						<?php if ( isset( $vds_linkedin[ $name ] ) ) : ?>
							<a class="vds-linkedin" href="<?php echo esc_url( $vds_linkedin[ $name ] ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $name ); ?> on LinkedIn"><svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.03-3.04-1.85-3.04-1.85 0-2.14 1.45-2.14 2.94v5.67H9.35V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.45v6.29zM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12zM7.12 20.45H3.56V9h3.56v11.45z"/></svg></a>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
