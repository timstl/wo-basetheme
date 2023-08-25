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
if ( ! function_exists( 'wo_social_accounts_shortcode' ) ) {

	function wo_social_accounts_shortcode( $align = 'left' ) {
		$pid     = 'options';
		$justify = '';

		if ( $align === 'center' ) {
			$justify = ' justify-content-' . $align;
		}

		$html = '';
		if ( function_exists( 'have_rows' ) && have_rows( 'social_accounts', $pid ) ) {
			$html .= '<ul class="social' . esc_attr( $justify ) . '">';
			while ( have_rows( 'social_accounts', $pid ) ) {
					the_row();
				$html .= '<li>';
				$html .= '	<a href="' . esc_url( get_sub_field( 'url' ) ) . '" aria-label="' . esc_attr( get_sub_field( 'accessibility_text' ) ) . '" target="_blank" rel="noopener noreferrer"><i class="' . esc_attr( get_sub_field( 'icon' ) ) . '"></i>';
				if ( get_sub_field( 'title' ) ) {
					$html .= '<span>' . esc_attr( get_sub_field( 'title' ) ) . '</span>';
				}
				$html .= '</a>';
				$html .= '</li>';
			}
			$html .= '</ul>';
		}

		return $html;
	}

	add_shortcode( 'sociallinks', 'wo_social_accounts_shortcode' );
}
