<?php
/**
 * Search box for articles (Articles page and search results). Search is scoped to
 * articles in inc/vds-articles.php.
 */
?>
<form class="vds-article-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="Search articles" aria-label="Search articles">
	<button type="submit">Search</button>
</form>
