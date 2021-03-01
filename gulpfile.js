//----------------------------------------------------------------------
//  mode
//----------------------------------------------------------------------
"use strict";

//----------------------------------------------------------------------
//  変数宣言
//----------------------------------------------------------------------
const gulp = require("gulp");
const { series, parallel } = require("gulp");
const del = require("del");
const browserSync = require("browser-sync");
const autoprefixer = require("autoprefixer");
const loadPlugins = require("gulp-load-plugins");
const $ = loadPlugins(); //  postcss,purgecss,imagemin,plumber,sass,sass-glob,connect-php,notify,rename,clean-css,uglify

const paths = {
	build: "./build",
};

//  release
const release = {
	src: paths.build + "/**",
	dest: "../release",
};

//  clean
const clean = {
	src: [paths.build + "/**", "!" + paths.build],
};

//  copy
const copy = {
	src: [
		"./**",
		"!" + paths.build + "/**",
		"!./node_modules/**",
		"!./scss/**",
		"!./.gitignore",
		"!./gulpfile.js",
		"!./package-lock.json",
		"!./package.json",
	],
	dest: paths.build,
};

//  minify
const minify = {
  content: ["./*.php", "./includes/*.php", "./js/**/*.js"],

	css: {
		src: "./css/styles.css",
		dest: paths.build + "/css",
	},

	fontawesome: {
		src: "./vender/fontawesome/css/*.css",
		dest: paths.build + "/vender/fontawesome/css",
	},

	swiper: {
		src: "./vender/swiper/css/*.css",
		dest: paths.build + "/vender/swiper/css",
	},

	tailwind: {
		src: "./vender/tailwind/css/*.css",
		dest: paths.build + "/vender/tailwind/css",
	},

	js: {
		src: "./js/**",
		dest: paths.build + "/js",
	},

	image: {
		src: "./image/**/*.{png,jpg,JPG,gif,svg}",
		dest: paths.build + "/image",
	},
};


//  watch
const watchSrc = ["./**", "!" + paths.build + "/**", "!./css/**"];

//  build
const build = {
	sass: {
		src: "./scss/**/*.scss",
		dest: `./css/`,
	},
};

//  browser-sync
const bs = {
	files: "./**/*.php",
	proxy: 10010,
};

//----------------------------------------------------------------------
//  task処理
//----------------------------------------------------------------------
//  release
gulp.task("release", function (done) {
	gulp.src(release.src).pipe(gulp.dest(release.dest));
	done();
});

//  clean
gulp.task("clean", function (done) {
	del(clean.src);
	done();
});

//  copy
gulp.task("copy", function (done) {
	gulp.src(copy.src).pipe(gulp.dest(copy.dest));
	done();
});

//  minify
gulp.task("minify", function (done) {
	gulp
		.src(minify.css.src)
		.pipe($.plumber())
		.pipe($.purgecss({ content: minify.content }))
		.pipe($.cleanCss())
		.pipe(gulp.dest(minify.css.dest));

	gulp
		.src(minify.fontawesome.src)
		.pipe($.plumber())
		.pipe($.purgecss({ content: minify.content }))
		.pipe($.cleanCss())
		.pipe(gulp.dest(minify.fontawesome.dest));

	gulp
		.src(minify.swiper.src)
		.pipe($.plumber())
		.pipe($.purgecss({ content: minify.content }))
		.pipe($.cleanCss())
		.pipe(gulp.dest(minify.swiper.dest));

	gulp
		.src(minify.tailwind.src)
		.pipe($.plumber())
		.pipe(
			$.purgecss({
				content: minify.content,
				defaultExtractor: (content) => content.match(/[\w-/:]+(?<!:)/g) || [],
			})
		)
		.pipe($.cleanCss())
		.pipe(gulp.dest(minify.tailwind.dest));

	gulp.src(minify.js.src).pipe($.plumber()).pipe($.uglify()).pipe(gulp.dest(minify.js.dest));

	gulp.src(minify.image.src).pipe($.imagemin()).pipe(gulp.dest(minify.image.dest));
	done();
});

//  build
gulp.task("build", function (done) {
	gulp
		.src(build.sass.src)
		.pipe($.plumber({ errorHandler: $.notify.onError("Error: <%= error.message %>") }))
		.pipe($.sassGlob())
		.pipe($.sass())
		.pipe(
			$.postcss([
				autoprefixer({
					cascade: false,
				}),
			])
		)
		.pipe(gulp.dest(build.sass.dest));
	done();
});

//  browser-sync
gulp.task("browser-sync", function (done) {
	browserSync.init({
		notify: false,
		files: [bs.files],
		proxy: `http://localhost:${bs.proxy}/`,
		open: "external",
	});
	done();
});

gulp.task("bs-reload", function (done) {
	browserSync.reload();
	done();
});

//----------------------------------------------------------------------
//  watch処理
//----------------------------------------------------------------------
//  watch
gulp.task("dev:watch", function (done) {
	gulp.watch(watchSrc, gulp.series(parallel("build"), "bs-reload"));
});

//----------------------------------------------------------------------
//  default処理
//----------------------------------------------------------------------
gulp.task("start", gulp.series("clean", "copy"));

gulp.task("release", gulp.series("release"));

gulp.task("dev:default", gulp.series(parallel("browser-sync", "build"), "bs-reload", "dev:watch"));

gulp.task("pro:default", gulp.series(parallel("build"), "minify"));

/************************************************************************/
/*  END OF FILE                                       									*/
/************************************************************************/
