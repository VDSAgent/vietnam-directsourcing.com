<?php
/**
 * Theme inventory for the VDS cleanup (CLAUDE.md section 5).
 *
 * Lists every function, hook, shortcode, script/style handle, register_* call,
 * ACF field name, template part, include and page-template header in the theme,
 * using PHP's own tokenizer so commented-out code is ignored. Each entry is
 * flagged FROZEN when its name appears anywhere in exports/ (code that lives in
 * the database and depends on the theme).
 *
 * Usage:  php tools/inventory.php [theme-dir] [exports-dir] > inventory-before.txt
 *         php tools/inventory.php --names-only ...   (omit file paths, for move-only diffs)
 */

$args       = array_values( array_filter( array_slice( $argv, 1 ), fn( $a ) => $a !== '--names-only' ) );
$names_only = in_array( '--names-only', $argv, true );
$root       = dirname( __DIR__ );
$theme_dir  = $args[0] ?? $root . '/themes';
$export_dir = $args[1] ?? $root . '/exports';

// Calls worth tracking, grouped by the inventory section they belong to.
$tracked = array(
	'hook'      => array( 'add_action', 'add_filter', 'remove_action', 'remove_filter', 'remove_all_actions', 'remove_all_filters' ),
	'shortcode' => array( 'add_shortcode', 'remove_shortcode' ),
	'asset'     => array( 'wp_enqueue_script', 'wp_enqueue_style', 'wp_register_script', 'wp_register_style', 'wp_dequeue_script', 'wp_dequeue_style', 'wp_deregister_script', 'wp_deregister_style', 'wp_localize_script', 'wp_add_inline_script', 'wp_add_inline_style' ),
	'register'  => array( 'register_post_type', 'register_taxonomy', 'register_sidebar', 'register_sidebars', 'register_nav_menu', 'register_nav_menus', 'register_widget', 'add_theme_support', 'remove_theme_support', 'add_image_size', 'acf_add_options_page', 'acf_add_options_sub_page', 'acf_add_local_field_group', 'vc_map' ),
	'acf'       => array( 'get_field', 'the_field', 'get_sub_field', 'the_sub_field', 'have_rows', 'get_field_object', 'update_field', 'get_fields' ),
	'template'  => array( 'get_template_part', 'locate_template', 'get_header', 'get_footer', 'get_sidebar', 'is_page_template' ),
);
$section_of = array();
foreach ( $tracked as $section => $fns ) {
	foreach ( $fns as $fn ) {
		$section_of[ strtolower( $fn ) ] = $section;
	}
}

$export_text = '';
if ( is_dir( $export_dir ) ) {
	$it = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $export_dir, FilesystemIterator::SKIP_DOTS ) );
	foreach ( $it as $f ) {
		$export_text .= "\n" . file_get_contents( $f->getPathname() );
	}
}

/**
 * True when a theme name is referenced by database code in exports/.
 *
 * $mode 'word'   : bare word (template filenames listed in page-templates.txt)
 *       'quoted' : as a quoted string ('handle', "field", [shortcode)
 *       'call'   : quoted, or called as name( -- for functions and callbacks
 */
function is_frozen( string $name, string $export_text, string $mode ): bool {
	$name = trim( $name, "'\" " );
	if ( $name === '' || strlen( $name ) < 3 || ! preg_match( '/^[\w.\-\/]+$/', $name ) ) {
		return false;
	}
	$q        = preg_quote( $name, '/' );
	$patterns = array(
		'word'   => '/(?<![\w\-])' . $q . '(?![\w\-])/',
		'quoted' => '/([\'"])' . $q . '\1|\[' . $q . '(?![\w\-])/',
		'call'   => '/([\'"])' . $q . '\1|(?<![\w>$:])' . $q . '\s*\(/',
	);
	return (bool) preg_match( $patterns[ $mode ], $export_text );
}

/** Source text of a token list, whitespace-normalised. */
function src( array $tokens ): string {
	$s = '';
	foreach ( $tokens as $t ) {
		$s .= is_array( $t ) ? $t[1] : $t;
	}
	return trim( preg_replace( '/\s+/', ' ', $s ) );
}

/** Split call arguments at top-level commas. */
function split_args( array $tokens ): array {
	$out   = array( array() );
	$depth = 0;
	foreach ( $tokens as $t ) {
		$c = is_array( $t ) ? $t[1] : $t;
		if ( in_array( $c, array( '(', '[', '{' ), true ) || ( is_array( $t ) && in_array( $t[0], array( T_CURLY_OPEN, T_DOLLAR_OPEN_CURLY_BRACES ), true ) ) ) {
			$depth++;
		} elseif ( in_array( $c, array( ')', ']', '}' ), true ) ) {
			$depth--;
		}
		if ( $c === ',' && $depth === 0 ) {
			$out[] = array();
			continue;
		}
		$out[ count( $out ) - 1 ][] = $t;
	}
	return array_map( 'src', $out );
}

$files = array();
$it    = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $theme_dir, FilesystemIterator::SKIP_DOTS ) );
foreach ( $it as $f ) {
	if ( strtolower( $f->getExtension() ) === 'php' ) {
		$files[] = $f->getPathname();
	}
}
sort( $files );

$rows = array();
foreach ( $files as $path ) {
	$rel  = ltrim( substr( $path, strlen( $theme_dir ) ), '/' );
	$code = file_get_contents( $path );

	// Page-template header, read the way WordPress's get_file_data() does.
	if ( preg_match( '/^(?:[ \t]*<\?php)?[ \t\/*#@]*Template Name:(.*)$/mi', substr( $code, 0, 8192 ), $m ) ) {
		$rows[] = array( 'template-header', basename( $rel ), trim( preg_replace( '/\s*(?:\*\/|\?>).*/', '', $m[1] ) ), $rel );
	}

	$tokens = array_values( array_filter( token_get_all( $code ), fn( $t ) => ! ( is_array( $t ) && in_array( $t[0], array( T_COMMENT, T_DOC_COMMENT ), true ) ) ) );
	$n      = count( $tokens );
	$class_stack = array(); // [ name, brace depth at which the class body opened ]
	$depth       = 0;

	for ( $i = 0; $i < $n; $i++ ) {
		$t = $tokens[ $i ];
		$c = is_array( $t ) ? $t[1] : $t;

		if ( $c === '{' || ( is_array( $t ) && in_array( $t[0], array( T_CURLY_OPEN, T_DOLLAR_OPEN_CURLY_BRACES ), true ) ) ) {
			$depth++;
			continue;
		}
		if ( $c === '}' ) {
			$depth--;
			if ( $class_stack && end( $class_stack )[1] === $depth + 1 ) {
				array_pop( $class_stack );
			}
			continue;
		}
		if ( ! is_array( $t ) ) {
			continue;
		}

		// Next meaningful token after $i.
		$next = function ( int $from ) use ( $tokens, $n ) {
			for ( $j = $from + 1; $j < $n; $j++ ) {
				if ( ! ( is_array( $tokens[ $j ] ) && $tokens[ $j ][0] === T_WHITESPACE ) ) {
					return $j;
				}
			}
			return $n;
		};

		if ( in_array( $t[0], array( T_CLASS, T_INTERFACE, T_TRAIT ), true ) ) {
			$j = $next( $i );
			if ( $j < $n && is_array( $tokens[ $j ] ) && $tokens[ $j ][0] === T_STRING ) {
				// The class body opens at the next '{'.
				for ( $k = $j; $k < $n && $tokens[ $k ] !== '{'; $k++ );
				$class_stack[] = array( $tokens[ $j ][1], $depth + 1 );
				$rows[]        = array( 'class', $tokens[ $j ][1], '', $rel );
			}
			continue;
		}

		if ( $t[0] === T_FUNCTION ) {
			$j = $next( $i );
			if ( $j < $n && $tokens[ $j ] === '&' ) {
				$j = $next( $j );
			}
			if ( $j < $n && is_array( $tokens[ $j ] ) && $tokens[ $j ][0] === T_STRING ) {
				$name   = $class_stack ? end( $class_stack )[0] . '::' . $tokens[ $j ][1] : $tokens[ $j ][1];
				$rows[] = array( 'function', $name, '', $rel );
			}
			continue;
		}

		if ( in_array( $t[0], array( T_REQUIRE, T_REQUIRE_ONCE, T_INCLUDE, T_INCLUDE_ONCE ), true ) ) {
			$expr = array();
			for ( $j = $i + 1; $j < $n && $tokens[ $j ] !== ';'; $j++ ) {
				$expr[] = $tokens[ $j ];
			}
			$rows[] = array( 'include', token_name( $t[0] ) === 'T_REQUIRE_ONCE' ? 'require_once' : strtolower( substr( token_name( $t[0] ), 2 ) ), src( $expr ), $rel );
			continue;
		}

		if ( $t[0] === T_STRING && isset( $section_of[ strtolower( $t[1] ) ] ) ) {
			// Skip method calls and declarations: ->get_field(), function get_field().
			$prev = null;
			for ( $j = $i - 1; $j >= 0; $j-- ) {
				if ( ! ( is_array( $tokens[ $j ] ) && $tokens[ $j ][0] === T_WHITESPACE ) ) {
					$prev = $tokens[ $j ];
					break;
				}
			}
			if ( is_array( $prev ) && in_array( $prev[0], array( T_OBJECT_OPERATOR, T_DOUBLE_COLON, T_FUNCTION, T_NULLSAFE_OBJECT_OPERATOR ), true ) ) {
				continue;
			}
			$j = $next( $i );
			if ( $j >= $n || $tokens[ $j ] !== '(' ) {
				continue;
			}
			$inner = array();
			$d     = 0;
			for ( $k = $j; $k < $n; $k++ ) {
				$tc = is_array( $tokens[ $k ] ) ? $tokens[ $k ][1] : $tokens[ $k ];
				if ( $tc === '(' ) {
					$d++;
					if ( $d === 1 ) {
						continue;
					}
				} elseif ( $tc === ')' ) {
					$d--;
					if ( $d === 0 ) {
						break;
					}
				}
				$inner[] = $tokens[ $k ];
			}
			$fn      = strtolower( $t[1] );
			$section = $section_of[ $fn ];
			$a       = split_args( $inner );
			switch ( $section ) {
				case 'hook':
					// name, callback, priority, accepted args (defaults made explicit).
					$detail = sprintf( '%s -> %s prio=%s args=%s', $a[0] ?? '', $a[1] ?? '', $a[2] ?? '10', $a[3] ?? '1' );
					$rows[] = array( 'hook', $fn, $detail, $rel );
					break;
				case 'shortcode':
					$rows[] = array( 'shortcode', $fn, implode( ' -> ', $a ), $rel );
					break;
				default:
					$rows[] = array( $section, $fn, implode( ', ', $a ), $rel );
			}
		}
	}
}

// Stable output: section order, then name, then detail, then file.
$order = array_flip( array( 'template-header', 'include', 'class', 'function', 'hook', 'shortcode', 'asset', 'register', 'acf', 'template' ) );
usort( $rows, fn( $x, $y ) => array( $order[ $x[0] ], $x[1], $x[2], $x[3] ) <=> array( $order[ $y[0] ], $y[1], $y[2], $y[3] ) );

echo "# Theme inventory: " . basename( $theme_dir ) . "/ (generated by tools/inventory.php)\n";
echo "# FROZEN = referenced by database code in exports/ (keep character-identical; grep exports/ before touching anything else too)\n";
$current = '';
foreach ( $rows as $r ) {
	list( $section, $name, $detail, $file ) = $r;
	if ( $section !== $current ) {
		echo "\n## {$section}\n";
		$current = $section;
	}
	// What database code could reference: template filenames, top-level function and
	// class names, hook callbacks, and the first quoted argument of other calls
	// (handle, field, shortcode tag, post type). Core hook names and class methods
	// cannot be renamed by the theme anyway, so they are not checked.
	$frozen = false;
	if ( $section === 'template-header' ) {
		$frozen = is_frozen( $name, $export_text, 'word' );
	} elseif ( $section === 'function' || $section === 'class' ) {
		$frozen = strpos( $name, '::' ) === false && is_frozen( $name, $export_text, 'call' );
	} elseif ( $section === 'hook' ) {
		$frozen = preg_match( "/-> (['\"])(\w+)\\1 prio/", $detail, $m ) && is_frozen( $m[2], $export_text, 'call' );
	} elseif ( preg_match( '/^\s*([\'"])(.*?)\1/', $detail, $m ) ) {
		$frozen = is_frozen( $m[2], $export_text, 'quoted' );
	}
	$line = $detail === '' ? $name : "{$name}  {$detail}";
	echo $line . ( $frozen ? '  FROZEN' : '' ) . ( $names_only ? '' : "  [{$file}]" ) . "\n";
}
