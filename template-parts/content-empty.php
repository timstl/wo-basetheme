<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage wo
 * @since 1.0
 * @version 2.7
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_content(); ?>
</article>
