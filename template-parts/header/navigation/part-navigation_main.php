<?php
$main_nav = wp_nav_menu(
    array(
        'echo'            => false,
        'theme_location'  => 'site-header-main-nav',
        'depth'           => 2,
        'container'       => 'nav',
        'container_class' => 'nav-container',
        'container_id'    => 'site-header-main-nav-container',
        'menu_class'      => 'nav navbar-nav',
        'fallback_cb'     => null,
        'walker'          => new bootstrap_5_wp_nav_menu_walker(wo_should_center_nav_logo()),
    )
);
?>
<div class="navbar navbar-expand-lg" role="navigation" id="site-header-navbar-container">
    <div id="site-header-nav-menus" class="collapse navbar-collapse">
        <?php echo $main_nav; ?>
    </div>
</div>
<?php get_template_part('template-parts/header/navigation/part', 'navigation_toggler');
