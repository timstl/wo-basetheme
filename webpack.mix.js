const mix = require("laravel-mix");

mix
	.sourceMaps(false, "source-map")
	.webpackConfig({ devtool: "source-map" })
	.js("src/js/**/*.js", "dist/js/theme.js")
	//.js("template-parts/blocks/**/*.js", "dist/js/blocks/")
	.sass("src/scss/style.scss", "dist/css/")
	.sass("src/scss/editor-styles.scss", "dist/css/")
	.options({
		processCssUrls: false,
	})
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
