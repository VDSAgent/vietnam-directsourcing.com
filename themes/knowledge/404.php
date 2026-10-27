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
			<!--
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'knowledgetheme' ); ?></p>-->

				<?php //get_search_form(); ?>
				<p>The page you a looking for cannot be found, please use the navigation above.</p>
				</br>
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