<?php
// Anchor for links such as /podcast/#episode-12 (from articles and Shorts descriptions).
$vds_episode_id = preg_match( '/Episode\s*(\d+)/i', get_the_title(), $vds_m ) ? 'episode-' . $vds_m[1] : '';
?>
<div<?php echo $vds_episode_id ? ' id="' . esc_attr( $vds_episode_id ) . '"' : ''; ?> class="chose-wrapper white-bg podcast">
	<div class="row justify-content-center">
		<div class="col-lg-12">
			<div class="section-title text-center mb-80">
				<h2 class="mb-30"><?php the_title(); ?></h2>
				<p class="sect-title"><?php the_content(); ?></p>
			</div>
		</div>
	</div>
	<div class="podcast-section">
		<div class="row">
			<div class="col-md-6 item-wrap">
				<?php
				if ( have_rows('youtube_links') ) :
					while ( have_rows('youtube_links') ) : the_row();
						$link = get_sub_field('link');
						$yt_iframe = get_sub_field('yt_iframe');
				?>
				<div class="item">
					<?php if ( $link ) { ?>
					<a href="<?php echo esc_url($link); ?>" target="_blank" class="youtube social">
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/youtube_logo.png" alt="YouTube">
					</a>
					<?php } ?>
					<?php if ( $yt_iframe ) { echo '<div class="youtube-iframe-wrapper">' . $yt_iframe . '</div>'; } ?>
				</div>
				<?php
					endwhile;
				endif;
				?>
			</div>
			<div class="col-md-6 item-wrap">
				<?php
				if ( have_rows('podcast_links') ) :
					while ( have_rows('podcast_links') ) : the_row();
						$link = get_sub_field('sp_link');
						$iframe = get_sub_field('iframe');
				?>
				<div class="item">
					<?php if ( $link ) { ?>
					<a target="_blank" href="<?php echo esc_url($link); ?>" class="spotify social">
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/spotify_logo.png" alt="Spotify">
					</a>
					<?php } ?>
					<?php if ( $iframe ) { echo '<div class="spotify-iframe-wrapper">' . $iframe . '</div>'; } ?>
				</div>
				<?php
					endwhile;
				endif;
				?>
			</div>
		</div>
	</div>
</div>