<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Basetheme
 * @since 1.0
 * @version 2.7
 */

get_header(); ?>
	<?php
	// Start the loop.
	while ( have_posts() ) :
		the_post();

		// Include the single post content template.
		get_template_part( 'template-parts/content', 'single' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}

		if ( is_singular( 'attachment' ) ) {
			// Parent post navigation.
			the_post_navigation(
				array(
					'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'basetheme' ),
				)
			);
		} elseif ( is_singular( 'post' ) ) {
			// Previous/next post navigation.
			the_post_navigation(
				array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_attr__( 'Next', 'basetheme' ) . '</span> ' .
					'<span class="screen-reader-text">' . esc_attr__( 'Next post:', 'basetheme' ) . '</span> ' .
					'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_attr__( 'Previous', 'basetheme' ) . '</span> ' .
					'<span class="screen-reader-text">' . esc_attr__( 'Previous post:', 'basetheme' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				)
			);
		}

		// End of the loop.
	endwhile;
	?>
	<?php get_sidebar(); ?>
<?php
get_footer();
