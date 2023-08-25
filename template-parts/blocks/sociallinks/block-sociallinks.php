<?php
/**
 * Block Name: Social Links
 */

// Create id attribute for specific styling.
$block_id = 'sociallinks-' . $block['id'];
$classes  = array( 'sociallinks' );

/**
 * Custom classes added in admin.
 */
if ( ! empty( $block['className'] ) ) {
	$classes[] = $block['className'];
}

$links = '';
if ( function_exists( 'wo_social_accounts_shortcode' ) ) {
	$links = wo_social_accounts_shortcode( get_field( 'align' ) );
}
if ( $links ) : ?>
	<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" id="<?php echo esc_attr( $block_id ); ?>">
		<?php echo $links; ?> 
	</div>
	<?php
endif;
