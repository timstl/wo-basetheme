<?php
/**
 * This file contains theme setup such as sidebars, widgets, enqueing, etc.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage wo
 * @since 1.0
 * @version 2.7
 */

/**
 * Set the content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 960;
}

if ( ! function_exists( 'wo_setup_acf' ) ) {
	/**
	 * Require WO_ACF class, setup options page and hooks.
	 */
	function wo_setup_acf() {
		/**
		 * ACF Fields for theme.
		 * Create Site Settings options page + some hooks for outputting ACF fields.
		 * Does NOT include block functionality (see theme-acfblocks.php).
		 */
		require_once get_template_directory() . '/lib/class-wo-acf.php';
		WO_ACF::create_acf_pages();
		WO_ACF::hooks();
	}

	add_action( 'after_setup_theme', 'wo_setup_acf' );
}

if ( ! function_exists( 'wo_setup' ) ) {
	/**
	 * Setup scripts, sidebars, menus, etc.
	 */
	function wo_setup() {
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );

		global $content_width;
		set_post_thumbnail_size( $content_width, 9999, false );
		// add_image_size( 'another-image-size', '250', '250', true );

		/**
		 * Text domain
		 */
		// load_theme_textdomain( 'wo', get_template_directory() . '/languages' );

		/**
		 * Bootstrap Nav Walker
		 */
		require_once get_template_directory() . '/lib/class-wp-bootstrap-navwalker.php';

		/**
		 * Register a main, utility and footer nav.
		 * Consider disabling utility navigation if not in use.
		 */
		register_nav_menus(
			array(
				'site-header-main-nav'    => esc_attr__( 'Main Navigation', 'wo' ),
				'site-header-utility-nav' => esc_attr__( 'Utility Navigation', 'wo' ),
				'site-footer-main-nav'    => esc_attr__( 'Footer Navigation', 'wo' ),
				'site-footer-utility-nav' => esc_attr__( 'Footer Utility Navigation', 'wo' ),
			)
		);
	}

	add_action( 'after_setup_theme', 'wo_setup' );
}

if ( ! function_exists( 'wo_widgets_init' ) ) {
	/**
	 *  Register widgetized areas.
	 *
	 * Disabled by default but left here in case needed.
	 */
	function wo_widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_attr__( 'Blog Sidebar Widget Area', 'wo' ),
				'id'            => 'blog-sidebar-widget-area',
				'description'   => esc_attr__( 'The blog widget area', 'wo' ),
				'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
				'after_widget'  => '</li>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_attr__( 'Page Sidebar Widget Area', 'wo' ),
				'id'            => 'page-sidebar-widget-area',
				'description'   => esc_attr__( 'The page widget area', 'wo' ),
				'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
				'after_widget'  => '</li>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);
	}

	// add_action( 'widgets_init', 'wo_widgets_init' );
}

if ( ! function_exists( 'wo_load_blocks' ) ) {
	function wo_register_blocks() {
		// register_block_type(get_template_directory() . '/template-parts/blocks/accordion');
		// register_block_type(get_template_directory() . '/template-parts/blocks/alert');
		register_block_type( get_template_directory() . '/template-parts/blocks/sociallinks' );
	}
	add_action( 'init', 'wo_register_blocks' );
}

if ( ! function_exists( 'wo_fonts' ) ) {
	/**
	 * Enqueue fonts by adding URLs to the $fonts array.
	 * Use a single function because these will load in the admin and front-end.
	 * Call this function from your enqueue functions.
	 */
	function wo_fonts() {
		/**
		 * An array of URLs.
		 */
		$fonts = array(
			// 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,600,600i&display=swap',
		);

		if ( ! empty( $fonts ) ) {
			$i = 1;
			foreach ( $fonts as $url ) {
				wp_enqueue_style( 'wo-fonts-' . $i, $url, array(), '1.0' );
				++$i;
			}
		}
	}
}

if ( ! function_exists( 'wo_enqueue' ) ) {
	/**
	 * Enqueue scripts and styles.
	 */
	function wo_enqueue() {

		/**
		 * Enqueue fonts. Add wp_enqueue_style lines above.
		 */
		wo_fonts();

		wp_enqueue_style( 'wo-base-style', get_template_directory_uri() . '/dist/css/style.css', array(), '1.0' );

		/**
		 * Enqueue comment-reply script if needed.
		 */
		// if ( is_singular() && get_option( 'thread_comments' ) ) {
		// wp_enqueue_script( 'comment-reply' );
		// }

		/**
		 * Enqueue scripts in footer.
		 */
		wp_enqueue_script( 'jquery' );
		// wp_enqueue_script( 'jquery-migrate' );

		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/dist/js/bootstrap.bundle.min.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'wo-scripts', get_template_directory_uri() . '/dist/js/theme.js', array( 'jquery', 'bootstrap' ), '1.0', true );

		// wp_localize_script( 'wo-scripts', 'wo_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}

	add_action( 'wp_enqueue_scripts', 'wo_enqueue' );
}

if ( ! function_exists( 'wo_enqueue_block_editor_assets' ) ) {
	/**
	 * Enqueue scripts and styles in admin.
	 */
	function wo_enqueue_block_editor_assets() {
		// Enqueue fonts.
		wo_fonts();
		wp_enqueue_style( 'wo-editor-styles', get_template_directory_uri() . '/dist/css/editor-styles.css', null, '1.0' );

		wp_enqueue_script( 'wo-modify-core-blocks', get_template_directory_uri() . '/src/admin/modify-core-blocks.js', array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ), '1.0' );
	}

	add_action( 'enqueue_block_editor_assets', 'wo_enqueue_block_editor_assets' );
}

if ( ! function_exists( 'wo_override_mp6_tinymce_styles' ) ) {
	/**
	 * Add custom styles to ACF wysiwyg editor.
	 */
	function wo_override_mp6_tinymce_styles( $mce_init ) {

		// make sure we don't override other custom <code>content_css</code> files
		$content_css = get_template_directory_uri() . '/dist/css/editor-styles.css';
		if ( isset( $mce_init['content_css'] ) ) {
			$content_css .= ',' . $mce_init['content_css'];
		}

		$mce_init['content_css'] = $content_css;

		return $mce_init;
	}
	// add_filter( 'tiny_mce_before_init', 'wo_override_mp6_tinymce_styles' );
}

if ( ! function_exists( 'wo_yoasttobottom' ) ) {
	/**
	 *  Move Yoast to bottom
	 */
	function wo_yoasttobottom() {
		return 'low';
	}

	add_filter( 'wpseo_metabox_prio', 'wo_yoasttobottom' );
}

if ( ! function_exists( 'wo_custom_body_class' ) ) {
	/**
	 * AAppend class to body if one added to the admin.
	 *
	 * @param array $classes Classes passed into hook.
	 */
	function wo_custom_body_class( $classes ) {
		global $post;
		if ( ! isset( $post->ID ) ) {
			return $classes;
		}
		if ( function_exists( 'get_field' ) ) {
			$page_class = get_field( 'page_class', $post->ID );
			if ( $page_class ) {
				$classes[] = esc_attr( $page_class );
			}
		}
		return $classes;
	}

	add_filter( 'body_class', 'wo_custom_body_class' );
}

if ( ! function_exists( 'wo_custom_oembed_filter' ) ) {
	/**
	 * Responsive Embed filter. Assumes 16:9
	 *
	 * @param string $html HTML passed into filter.
	 */
	function wo_custom_oembed_filter( $html ) {
		return '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
	}

	// add_filter( 'embed_oembed_html', 'wo_custom_oembed_filter', 10, 4 );
}

/**
 * Add 'Manage Patterns' menu item under Appearance.
 */
add_action(
	'admin_menu',
	function() {
		add_submenu_page( 'themes.php', 'Patterns', 'Manage Patterns', 'edit_posts', 'edit.php?post_type=wp_block' );
	}
);
