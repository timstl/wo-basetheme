<?php get_template_part( 'template-parts/header/navigation/part', 'navigation_utility' ); ?>
<div id="site-header-logonav" class="site-header-logonav--<?php echo wo_should_center_nav_logo() ? 'centered' : 'standard'; ?>">
	<div class="container-full">
		<div id="site-header-logonav-container">
			<?php get_template_part( 'template-parts/header/part', 'logo' ); ?>
			<?php get_template_part( 'template-parts/header/navigation/part', 'navigation_main' ); ?>
		</div>
	</div>
</div>
