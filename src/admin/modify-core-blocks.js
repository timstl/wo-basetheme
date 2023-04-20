/**
 * Remove squared button
 */
/*wp.domReady(function() {
	wp.blocks.unregisterBlockStyle("core/button", "squared");
});*/

/**
 * Add list style.
 */
/*wp.blocks.registerBlockStyle("core/list", {
	name: "checkmarks",
	label: "Checkmarks"
});*/

/**
 * Unregister / Register separator styles example.
 */
wp.domReady(function () {
	//wp.blocks.unregisterBlockStyle("core/separator", "dots");
	wp.blocks.unregisterBlockStyle("core/separator", "wide");

	wp.blocks.registerBlockStyle("core/columns", {
		name: "reverse-on-mobile",
		label: "Reverse on Mobile",
	});

	wp.blocks.registerBlockStyle("core/group", {
		name: "flex-row",
		label: "Row + Mobile Stack",
	});

	wp.blocks.registerBlockStyle("core/button", {
		name: "alt",
		label: "Alternate Color",
	});

	wp.blocks.registerBlockStyle("core/list", {
		name: "listgroup",
		label: "List Group",
	});
});
