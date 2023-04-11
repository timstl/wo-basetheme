<?php
$utility_nav = wp_nav_menu(
    array(
        'echo'            => false,
        'theme_location'  => 'site-header-utility-nav',
        'depth'           => 1,
        'container'       => 'nav',
        'container_class' => 'nav-container',
        'container_id'    => null,
        'menu_class'      => 'nav navbar-nav',
        'fallback_cb'     => null,
        'walker'          => new bootstrap_5_wp_nav_menu_walker(),
    )
);

if ($utility_nav) : ?>
<div id="site-header-utility-nav-container">
<div class="container-full">
    <?php echo $utility_nav; ?>
    <?php //get_template_part('template-parts/part', 'socialaccounts'); ?>
</div>
</div>
<?php endif; ?>
