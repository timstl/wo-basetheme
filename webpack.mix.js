const mix = require("laravel-mix");

mix
	.js("src/**/*.js", "dist/js/theme.js")
	.sass("src/scss/style.scss", "dist/css/")
	.sass("src/scss/editor-styles.scss", "dist/css/")
	.browserSync({
		proxy: "http://localhost",
		port: 3000,
		open: false,
		files: [
			"**/*.php",
			"img/**/*.{png,jpg,gif}",
			"dist/js/*.js",
			"dist/css/*.css",
		],
	});
