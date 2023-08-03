<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section, wrapper, logo, and main navigation.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Basetheme
 * @since 1.0
 * @version 2.7
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
/**
 * Output "Custom Scripts (after body tag)" from the admin Site Settings.
 */
get_template_part( 'template-parts/header/part', 'bodyscripts' );
?>
<div id="wrapper">
	<a href="#site-main" class="visually-hidden visually-hidden-focusable"><?php esc_attr_e( 'Skip to main content', 'wo' ); ?></a>
	<?php get_template_part( 'template-parts/header/part', 'alert' ); ?>
	<header id="site-header">
		<?php get_template_part( 'template-parts/header/part', 'logo_navigation' ); ?>
	</header>
	<main id="site-main">
