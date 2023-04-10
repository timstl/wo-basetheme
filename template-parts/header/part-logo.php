<?php if ( function_exists( 'get_field' ) && get_field( 'logo', 'options' ) ) : ?>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_bloginfo( 'name', 'display' ); ?>" rel="Home" class="logo-set" aria-label="<?php echo get_bloginfo( 'name', 'display' ); ?> logo">
	<span class="logo"><?php echo wo_load_svg_from_media( get_field( 'logo', 'options' )['url'] ); ?></span>
</a>
<?php endif; ?>