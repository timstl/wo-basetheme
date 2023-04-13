<?php
/**
 * The template for displaying the footer
 *
 * Contains the footer content and footer navigation, copyright, and closing tags
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Basetheme
 * @since 1.0
 * @version 2.7
 */

?>
    </main>
    <footer role="contentinfo" id="site-footer">
        <div class="container">
            <?php
            $footer_nav = wp_nav_menu(
                array(
                    'echo'            => false,
                    'theme_location'  => 'site-footer-main-nav',
                    'depth'           => 1,
                    'container'       => 'nav',
                    'container_class' => 'nav-container',
                    'container_id'    => 'site-footer-main-nav-container',
                    'menu_class'      => 'nav',
                    'fallback_cb'     => null,
                    'walker'          => new bootstrap_5_wp_nav_menu_walker(false),
                )
            );
            $footer_nav_utility = wp_nav_menu(
                array(
                    'echo'            => false,
                    'theme_location'  => 'site-footer-utility-nav',
                    'depth'           => 1,
                    'container'       => 'nav',
                    'container_class' => 'nav-container',
                    'container_id'    => 'site-footer-utility-nav-container',
                    'menu_class'      => 'nav',
                    'fallback_cb'     => null,
                    'walker'          => new bootstrap_5_wp_nav_menu_walker(false),
                )
            );
            ?>
            <div class="row justify-content-between">
                <div class="col-24 col-md-12">
                    <?php if ($footer_nav) : ?>
                    <div role="navigation" id="site-footer-navbar-container">
                        <?php echo $footer_nav; ?>
                    </div>
                    <?php endif; ?>
                    <?php get_template_part('template-parts/footer/part', 'content'); ?>
                </div>
                <div class="col-24 col-md-12">
                    <?php get_template_part('template-parts/part', 'socialaccounts'); ?>
                    <?php get_template_part('template-parts/footer/part', 'content_b'); ?>
                </div>
            </div>                      
        </div>
        <div class="site-footer__sub">
            <div class="container">
                <div class="flexgroup">
                    <?php get_template_part('template-parts/footer/part', 'copyright'); ?>
                    <?php if ($footer_nav_utility) : ?>
                    <div role="navigation" id="site-footer-utility-navbar-container">
                        <?php echo $footer_nav_utility; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </footer>
<?php wp_footer(); ?>
</div>
</body>
</html>
