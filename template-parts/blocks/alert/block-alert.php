<?php
/**
 * Block Name: Alert
 */

// Create id attribute for specific styling.
$block_id = 'alert-' . $block['id'];
$classes  = array( 'alert', 'alert-block', get_field( 'alert_style' ), 'text-' . get_field( 'text_align' ) );

/**
 * Custom classes added in admin.
 */
if ( ! empty( $block['className'] ) ) {
	$classes[] = $block['className'];
}
?>
<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" id="<?php echo esc_attr( $block_id ); ?>" role="alert">
	<?php the_field( 'message' ); ?>
</div>
