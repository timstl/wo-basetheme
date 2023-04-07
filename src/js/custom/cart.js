/**
 * WooCommerce cart count
 */
import Cookies from 'js-cookie';

jQuery(document).ready(function ($) {
	const $cartNav = $('#cart-nav');
	const $count = $cartNav.find('sup');

	const currentCount = Cookies.get('woo_cart_count');
	$count.text(currentCount);
	if (currentCount > 0) {
		$cartNav.show();
	}

	$.ajax({
		// eslint-disable-next-line no-undef
		url: bt_params.ajax_url,
		data: { action: 'bt_get_woocommerce_cart' },
		dataType: 'html',
	}).done(function (response) {
		if (!response || 0 === response || '0' === response) {
			$cartNav.hide();
			$count.text(0);
		} else if (response) {
			$count.text(response);
			$cartNav.show();
		}

		Cookies.set('woo_cart_count', response);
	});
});
