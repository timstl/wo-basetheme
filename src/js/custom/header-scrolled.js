(function ($) {
	$.fn.scrollclass = function (options) {
		const opts = $.extend({}, $.fn.scrollclass.defaults, options);
		const $this = this;
		let state2 = false;

		$(document)
			.scroll(function () {
				if (false === state2 && $(this).scrollTop() > opts.pos) {
					state2 = true;
					$this.addClass(opts.class);
				} else if ($(this).scrollTop() < opts.pos) {
					state2 = false;
					$this.removeClass(opts.class);
				}
			})
			.trigger('scroll');
	};

	// default options
	$.fn.scrollclass.defaults = {
		class: 'scrolled',
		pos: 50,
	};
})(jQuery);

/**
 * Use scrollclass plugin on #site-header if it exists.
 */
jQuery(document).ready(function ($) {
	const $header = $('#site-header');
	if (0 < $header.length) {
		$header.scrollclass({
			pos: 5,
		});
	}
});
