<?php
/**
 * Template for displaying search forms in Twenty Seventeen
 *
 * @package WordPress
 * @subpackage wo
 * @since 1.0
 * @version 2.7
 */

?>

<?php
/**
 * In case there is more than 1 search form on a page.
 */
$unique_id = esc_attr( uniqid( 'search-form-' ) );
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; ?>">
		<span class="visually-hidden visually-hidden-focusable"><?php esc_attr_e( 'Search for:', 'wo' ); ?></span>
	</label>
	<input type="search" id="<?php echo $unique_id; ?>" class="search-field form-control" placeholder="<?php esc_attr_e( 'Search &hellip;', 'wo' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
	<button type="submit" class="search-submit btn btn-primary"><?php esc_attr_e( 'Search', 'wo' ); ?></button>
</form>
