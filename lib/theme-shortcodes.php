<?php
/**
 * This file contains theme-specific shortcodes.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Basetheme
 * @since 1.0
 * @version 2.7
 */
if ( ! function_exists( 'bt_social_accounts_shortcode' ) ) {
	/**
	 * Social links shortcode
	 */
	function bt_social_accounts_shortcode( $pid = 'options' ) {
		$html = '';
		if ( function_exists( 'have_rows' ) && have_rows( 'social_accounts', $pid ) ) {
			$html .= '<ul class="social">';
			while ( have_rows( 'social_accounts', $pid ) ) {
					the_row();
				$html .= '<li>';
				$html .= '	<a href="' . get_sub_field( 'url' ) . '" aria-label="' . get_sub_field( 'accessibility_text' ) . '" target="_blank" rel="noopener noreferrer">' . get_sub_field( 'icon' );
				if ( get_sub_field( 'title' ) ) {
					$html .= '<span>' . get_sub_field( 'title' ) . '</span>';
				}
				$html .= '</a>';
				$html .= '</li>';
			}
			$html .= '</ul>';
		}

		return $html;
	}
	
	add_shortcode( 'sociallinks', 'bt_social_accounts_shortcode' );
}
