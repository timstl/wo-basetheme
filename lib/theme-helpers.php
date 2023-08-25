<?php
/**
 * This file contains generic support functions that are used by the theme or often used on sites.
 * These functions were not deemed appropriate for wo-helper-plugin for one reason or another.
 * They are unlikely to be changed or modified (much), so are separated from theme-functions.php.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage wo
 * @since 1.0
 * @version 2.7
 */

if ( ! function_exists( 'wo_log' ) ) {
	/**
	 * Logging function.
	 * In wp-config.php define the WP_DEBUG_LOG constant: define('WP_DEBUG_LOG', true);
	 *
	 * You can then use this function anywhere in your themes or plugin:
	 *
	 * wo_log("log message here");
	 *
	 * This will write to wp-content/debug.log.
	 * In terminal: tail -f debug.log
	 *
	 * @param string|int|object|array $log Debug info to log.
	 */
	function wo_log( $log ) {
		if ( true === WP_DEBUG ) {
			if ( is_array( $log ) || is_object( $log ) ) {
				error_log( print_r( $log, true ) );
			} else {
				error_log( $log );
			}
		}
	}
}

if ( ! function_exists( 'wo_load_image_or_svg' ) ) {
	/**
	 * Load an SVG or image from media uploads.
	 *
	 * @param array An image array from ACF or other media array.
	 *
	 * @return string  The SVG contents or an image tag.
	 */
	function wo_load_image_or_svg( $image ) {

		if ( isset( $image['url'] ) ) {
			$ext = strtolower( pathinfo( $image['url'], PATHINFO_EXTENSION ) );

			if ( $ext == 'svg' ) {
				return wo_load_svg_from_media( $image['url'] );
			}
		}

		if ( isset( $image['id'] ) ) {
			return wp_get_attachment_image( $image['id'] );
		}
	}
}

if ( ! function_exists( 'wo_load_svg_from_media' ) ) {
	/**
	 * Loads an SVG from media uploads.
	 *
	 * @param string $url Site URL.
	 *
	 * @return string  The SVG contents.
	 */
	function wo_load_svg_from_media( $url ) {
		$filepath = ABSPATH . str_replace( home_url(), '', $url );

		if ( file_exists( $filepath ) ) {
			return file_get_contents( $filepath );
		}

		return '';
	}
}

if ( ! function_exists( 'wo_load_svg' ) ) {
	/**
	 * Load an SVG from the theme directory
	 *
	 * @param string  $file File path appended to the template directory or url. Start path with /
	 * @param boolean $from_url Use a theme URL instead of directory.
	 */
	function wo_load_svg( $file = '', $from_url = false ) {
		if ( $from_url ) {
			$path = get_template_directory_uri();
		} else {
			$path = get_template_directory();
		}

		if ( ! $file || ( ! $from_url && ! file_exists( $path . $file ) ) ) {
			return '';
		}

		return file_get_contents( $path . $file );
	}
}

if ( ! function_exists( 'wo_classes' ) ) {
	/**
	 * Build conditional classes for an element.
	 * Checks if a value exists, and appends the key as a classname if it does.
	 * The intended use is with ACF True/False fields, but any function that returns a truthy/falsey result would work.
	 *
	 * Example usage:
	 *
	 * <div class="<?php wo_classes( 'someclass', array( 'someclass--classtwo' => get_field( 'field_name' ) ) ); ?>">
	 */
	function wo_classes( $classes = array(), $conditional_classes = array(), $echo = true ) {

		if ( ! is_array( $classes ) ) {
			$classes = array( $classes );
		}

		if ( is_array( $conditional_classes ) && ! empty( $conditional_classes ) ) {
			foreach ( $conditional_classes as $key => $value ) {
				if ( ! $value ) {
					continue;
				}
				$classes[] = $key;
			}
		}

		$classes = array_map( 'wp_strip_all_tags', $classes );

		if ( ! $echo ) {
			return implode( ' ', $classes );
		}

		echo esc_attr( implode( ' ', $classes ) );
	}
}

if ( ! function_exists( 'build_acf_link' ) ) {
	/**
	 * Build an achor link from an ACF link field (assumes array is passed).
	 *
	 * @param array        $link ACF link array.
	 * @param array|string $classes Array or string of classes to add to link.
	 * @param boolean      $echo Echo or return the link.
	 */
	function build_acf_link( $link = array(), $classes = array(), $echo = true ) {
		if ( ! $link || empty( $link ) ) {
			return false;
		}

		if ( $classes && ! is_array( $classes ) ) {
			$classes = array( $classes );
		}

		$target = '';
		if ( isset( $link['target'] ) && ! empty( $link['target'] ) ) {
			$target = ' target="' . esc_attr( $link['target'] ) . '"';

			if ( $link['target'] == '_blank' ) {
				$target .= ' rel="noopener noreferrer"';
			}
		}

		$class = '';
		if ( ! empty( $classes ) ) {
			$class = ' class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}

		$html = '<a href="' . esc_url( $link['url'] ) . '"' . $class . $target . '>' . esc_attr( $link['title'] ) . '</a>';

		if ( ! $echo ) {
			return $html;
		}

		echo $html;
	}
}

if ( ! function_exists( 'wo_should_center_nav_logo' ) ) {
	function wo_should_center_nav_logo() {
		if ( WO_HEADER_TYPE === 'centered' ) {
			return true;
		}

		if ( WO_HEADER_TYPE === 'centered_home' && is_front_page() ) {
			return true;
		}

		return false;
	}
}

if ( ! function_exists( 'wo_add_menu_item_classes' ) ) {
	function wo_add_menu_item_classes( $classes, $item, $args ) {
		if ( get_field( 'button', $item ) ) {
			$classes[] = 'has-btn';
			$classes[] = esc_attr( get_field( 'button', $item ) );
		}

		return $classes;
	}
	add_filter( 'nav_menu_css_class', 'wo_add_menu_item_classes', 10, 3 );
}

/**
 * Get a reusable block (pattern) and insert it into a template.
 * Useful when overriding plugin template files like WooCommerce or Tribe Events.
 */
function wo_get_reusable_block( $block ) {
	$query = new WP_Query(
		array(
			'post_type'      => 'wp_block',
			'title'          => $block,
			'post_status'    => 'published',
			'posts_per_page' => 1,
		)
	);

	if ( ! empty( $query->post ) ) {
		$reusable_block         = $query->post;
		$reusable_block_content = apply_filters( 'the_content', $reusable_block->post_content );
		return $reusable_block_content;
	} else {
		return '';
	}
}
