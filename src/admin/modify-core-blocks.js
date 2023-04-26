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
		label: "Primary Color",
	});

	wp.blocks.registerBlockStyle("core/button", {
		name: "link",
		label: "Button Link",
	});

	/*wp.blocks.registerBlockStyle("core/list", {
		name: "listgroup",
		label: "List Group",
	});*/
});
