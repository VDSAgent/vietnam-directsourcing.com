<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<div class="container page-not-found" role="main">
	<div class="row">
		<div class="class-width-small">

			<header>
				<h2 class="page-title-not-found">404</h2>
			</header>

			<div class="page-content">
				<p>The page you are looking for cannot be found. Please use the navigation above.</p>
				<br>
				<div class="sub">
				  <p><a href="<?php echo esc_url( home_url() );?>">Back To Home</a></p>
				</div>
			</div><!-- .page-content -->

		</div><!-- #content -->
	</div><!-- #primary -->
</div>
<?php
get_footer();
?>