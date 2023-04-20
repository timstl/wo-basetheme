<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage wo
 * @since 1.0
 * @version 2.7
 */

get_header(); ?>
    <?php if (have_posts()) : ?>
        <?php if (is_home() && ! is_front_page()) : ?>
            <header>
                <h1 class="page-title visually-hidden visually-hidden-focusable"><?php single_post_title(); ?></h1>
            </header>
        <?php endif; ?>

        <?php
        // Start the loop.
        while (have_posts()) :
            the_post();

            /*
             * Include the Post-Format-specific template for the content.
             * If you want to override this in a child theme, then include a file
             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
             */
            get_template_part('template-parts/content', get_post_format());

            // End the loop.
        endwhile;

        // Previous/next page navigation.
        the_posts_pagination(
            array(
                'prev_text'          => esc_attr__('Previous page', 'wo'),
                'next_text'          => esc_attr__('Next page', 'wo'),
                'before_page_number' => '<span class="meta-nav visually-hidden visually-hidden-focusable">' . esc_attr__('Page', 'wo') . ' </span>',
            )
        );

        // If no content, include the "No posts found" template.
    else :
        get_template_part('template-parts/content', 'none');
    endif;

    get_sidebar();
    ?>
<?php get_footer(); ?>
