<?php
/**
 * Read-only pre-deploy gate for branch cleanup/themes-2026-10.
 *
 * Run on the server (staging first, then live) BEFORE copying any theme file:
 *   wp eval-file predeploy-check.php /path/to/repo/themes/knowledge
 *
 * Writes nothing. Prints PASS/STOP lines; any STOP means: do not deploy, tell Rod.
 */

global $wpdb;

$new_theme = isset( $args[0] ) ? rtrim( $args[0], '/' ) : '';
$stop      = 0;
$say       = function ( $ok, $msg ) use ( &$stop ) {
	echo ( $ok ? 'PASS  ' : 'STOP  ' ) . $msg . PHP_EOL;
	if ( ! $ok ) {
		$stop++;
	}
};

// 1. Shortcodes the branch removes must not be used in content, post meta or widgets
//    (otherwise the raw [tag] would print on the page).
$removed = array( 'post_feed', 'vds_solutions', 'case_feed', 'testimonial_carousel', 'shortcode_show_team_about' );
foreach ( $removed as $tag ) {
	$like  = '%[' . $wpdb->esc_like( $tag ) . '%';
	$posts = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_type NOT IN ('revision','wpcode') AND post_status <> 'trash' AND post_content LIKE %s", $like ) );
	$meta  = $wpdb->get_col( $wpdb->prepare( "SELECT DISTINCT post_id FROM {$wpdb->postmeta} WHERE meta_value LIKE %s", $like ) );
	$opts  = $wpdb->get_col( $wpdb->prepare( "SELECT option_name FROM {$wpdb->options} WHERE option_value LIKE %s", $like ) );
	$hits  = array_merge( $posts, $meta, $opts );
	$say( ! $hits, "[$tag] not used" . ( $hits ? ' -> found in: ' . implode( ', ', array_slice( $hits, 0, 20 ) ) : '' ) );
}

// 2. Page templates the branch deletes must not be assigned to a page (WordPress would
//    fall back to page.php: not fatal, but the page would change).
$gone = $wpdb->get_results( "SELECT post_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key = '_wp_page_template' AND meta_value IN ('case-tpl.php','getaquote-tpl.php','single-case.php')" );
$say( ! $gone, 'no page uses case-tpl.php / getaquote-tpl.php / single-case.php' . ( $gone ? ' -> ' . wp_json_encode( $gone ) : '' ) );

// 3. Active WPCode snippets: exactly the 29 the theme now contains.
$expected = array( 3833, 3924, 3996, 4004, 4035, 4050, 4065, 4066, 4069, 4070, 4076, 4077, 4096, 4113, 4196, 4214, 4215, 4226, 4228, 4231, 4232, 4233, 4234, 4235, 4236, 4301, 4312, 4328, 4331 );
$active   = array_map( 'intval', $wpdb->get_col( "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'wpcode' AND post_status = 'publish'" ) );
sort( $active );
$extra   = array_diff( $active, $expected );
$missing = array_diff( $expected, $active );
$say( ! $extra, 'no active snippet outside the 29 folded into the theme' . ( $extra ? ' -> also active: ' . implode( ', ', $extra ) . ' (review before deactivating anything)' : '' ) );
if ( $missing ) {
	echo 'INFO  already inactive: ' . implode( ', ', $missing ) . PHP_EOL;
}

// 4. Snippets edited after the 27 Oct export may hold changes the theme does not have.
$changed = $wpdb->get_results( "SELECT ID, post_modified FROM {$wpdb->posts} WHERE post_type = 'wpcode' AND post_status = 'publish' AND post_modified > '2026-10-27 23:59:59'" );
$say( ! $changed, 'no active snippet modified after 27 Oct 2026' . ( $changed ? ' -> ' . wp_json_encode( $changed ) . ' (compare with exports/wpcode/ and port the change)' : '' ) );

// 5. No function name declared both by an active snippet and by the new theme
//    (PHP would stop with "Cannot redeclare" while both are live during the switch).
if ( $new_theme && is_dir( $new_theme ) ) {
	$theme_fns = array();
	$it        = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $new_theme, FilesystemIterator::SKIP_DOTS ) );
	foreach ( $it as $file ) {
		if ( substr( $file, -4 ) !== '.php' ) {
			continue;
		}
		$tokens = token_get_all( file_get_contents( $file ) );
		foreach ( $tokens as $i => $t ) {
			if ( is_array( $t ) && T_FUNCTION === $t[0] ) {
				for ( $j = $i + 1; isset( $tokens[ $j ] ); $j++ ) {
					if ( is_array( $tokens[ $j ] ) && T_STRING === $tokens[ $j ][0] ) {
						$theme_fns[ strtolower( $tokens[ $j ][1] ) ] = true;
						break;
					}
					if ( '(' === $tokens[ $j ] || '{' === $tokens[ $j ] ) {
						break;
					}
				}
			}
		}
	}
	$clash = array();
	foreach ( $wpdb->get_results( "SELECT ID, post_content FROM {$wpdb->posts} WHERE post_type = 'wpcode' AND post_status = 'publish'" ) as $s ) {
		if ( preg_match_all( '/\bfunction\s+([A-Za-z_][A-Za-z0-9_]*)\s*\(/', $s->post_content, $m ) ) {
			foreach ( $m[1] as $fn ) {
				if ( isset( $theme_fns[ strtolower( $fn ) ] ) ) {
					$clash[] = $s->ID . ':' . $fn;
				}
			}
		}
	}
	$say( ! $clash, 'no function name shared by an active snippet and the new theme (' . count( $theme_fns ) . ' theme functions checked)' . ( $clash ? ' -> ' . implode( ', ', $clash ) : '' ) );
} else {
	$say( false, 'pass the path of the new themes/knowledge folder as the first argument to run the function-name check' );
}

// 6. The Customizer's Additional CSS post that the switch empties.
$css_id = (int) get_theme_mod( 'custom_css_post_id' );
$say( 644 === $css_id, "Additional CSS is post 644 (found $css_id)" );

// 7. Things the new theme reads that must exist.
$say( (bool) get_post( 13 ) && (bool) get_post( 1296 ), 'Solutions (13) and FAQ (1296) pages exist' );
$say( function_exists( 'get_field' ), 'ACF is active' );

echo PHP_EOL . ( $stop ? "$stop STOP item(s): do not deploy, tell Rod." : 'All checks passed: safe to start the switch.' ) . PHP_EOL;
