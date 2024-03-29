<?php
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu {

	private $centered;
	private $break_point;
	private $displayed;
	private $current_item;
	private $dropdown_menu_alignment_values = array(
		'dropdown-menu-start',
		'dropdown-menu-end',
		'dropdown-menu-sm-start',
		'dropdown-menu-sm-end',
		'dropdown-menu-md-start',
		'dropdown-menu-md-end',
		'dropdown-menu-lg-start',
		'dropdown-menu-lg-end',
		'dropdown-menu-xl-start',
		'dropdown-menu-xl-end',
		'dropdown-menu-xxl-start',
		'dropdown-menu-xxl-end',
	);

	public function __construct( $centered = false ) {
		$this->centered = $centered;
	}

	function start_lvl( &$output, $depth = 0, $args = null ) {
		$dropdown_menu_class[] = '';
		foreach ( $this->current_item->classes as $class ) {
			if ( in_array( $class, $this->dropdown_menu_alignment_values ) ) {
				$dropdown_menu_class[] = $class;
			}
		}
		$indent  = str_repeat( "\t", $depth );
		$submenu = ( $depth > 0 ) ? ' sub-menu' : '';
		$output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr( implode( ' ', $dropdown_menu_class ) ) . " depth_$depth\">\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		if ( $this->centered ) {
			if ( ! isset( $this->break_point ) ) {
				$menu_elements      = wp_get_nav_menu_items( $args->menu );
				$top_level_elements = 0;

				foreach ( $menu_elements as $el ) {
					if ( $el->menu_item_parent === '0' ) {
						++$top_level_elements;
					}
				}
				$this->break_point = ceil( $top_level_elements / 2 );
			}
			if ( $depth === 0 && $this->break_point == $this->displayed ) {
				$output .= '<li class="menu-item menu-item-logo">' . $this->inject_logo() . '</li>';
			}
		}

		$this->current_item = $item;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$li_attributes = '';
		$class_names   = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$classes[] = ( $args->depth > 1 && $args->walker->has_children ) ? 'dropdown' : '';
		$classes[] = 'nav-item';
		$classes[] = 'nav-item-' . $item->ID;
		if ( $depth && $args->depth > 1 && $args->walker->has_children ) {
			$classes[] = 'dropdown-menu dropdown-menu-end';
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

		$active_class   = ( $item->current || $item->current_item_ancestor || in_array( 'current_page_parent', $item->classes, true ) || in_array( 'current-post-ancestor', $item->classes, true ) ) ? 'active' : '';
		$nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
		$attributes    .= ( $args->depth > 1 && $args->walker->has_children ) ? ' class="' . $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="' . $nav_link_class . $active_class . '"';

		$item_output  = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		if ( $item->menu_item_parent === '0' ) {
			++$this->displayed;
		}
	}

	private function inject_logo() {
		ob_start();
		get_template_part( 'template-parts/header/part', 'logo' );
		$logo = ob_get_contents();
		ob_end_clean();
		return $logo;
	}
}
// register a new menu
