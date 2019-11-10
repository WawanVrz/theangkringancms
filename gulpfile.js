// const elixir = require('laravel-elixir');

// require('laravel-elixir-vue-2');

// /*
//  |--------------------------------------------------------------------------
//  | Elixir Asset Management
//  |--------------------------------------------------------------------------
//  |
//  | Elixir provides a clean, fluent API for defining some basic Gulp tasks
//  | for your Laravel application. By default, we are compiling the Sass
//  | file for your application as well as publishing vendor resources.
//  |
//  */

// elixir((mix) => {
//     mix.sass('app.scss')
//        .webpack('app.js');
// });

var autoprefixer = require("gulp-autoprefixer"),
  cleanCSS = require("gulp-clean-css"),
  gulp = require("gulp"),
  sass = require("gulp-sass"),
  concat = require("gulp-concat"),
  rename = require("gulp-rename"),
  uglify = require("gulp-uglify");

// Set the browser that you want to support
const AUTOPREFIXER_BROWSERS = [
  "ie >= 10",
  "ie_mob >= 10",
  "ff >= 30",
  "chrome >= 34",
  "safari >= 7",
  "opera >= 23",
  "ios >= 7",
  "android >= 4.4",
  "bb >= 10"
];

var styles_input = './public/assets/frontend/src/sass/**/*.scss',
    styles_output = './public/assets/frontend/dist/css/';

// Gulp task to compile SASS, combine & minify CSS files
gulp.task("styles", function() {
  return gulp
    .src(styles_input)
    .pipe(
      sass({
        outputStyle: "expanded",
        precision: 10,
        includePaths: ["."],
        onError: console.error.bind(console, "Sass error:")
      })
    )
    .pipe(autoprefixer({ browsers: AUTOPREFIXER_BROWSERS }))
    .pipe(concat("apps.css"))
    .pipe(gulp.dest(styles_output))
    .pipe(rename("apps.min.css"))
    .pipe(cleanCSS({ compatibility: "ie8" }))
    .pipe(gulp.dest(styles_output));
});

// Gulp task to combine JS & minify CSS files
var js_input = './public/assets/frontend/src/js/',
    js_output = './public/assets/frontend/dist/js/';

gulp.task("scripts", function() {
  return gulp
    .src([
      "./node_modules/bootstrap/dist/js/bootstrap.min.js",
      js_input + "style.js",
    ])
    .pipe(concat("script.js"))
    .pipe(gulp.dest(js_output))
    .pipe(rename("script.min.js"))
    .pipe(uglify())
    .pipe(gulp.dest(js_output));
});

gulp.task("watch", function() {
  gulp.watch(styles_input, gulp.parallel(["styles"]));
  gulp.watch(
    [
      "./node_modules/bootstrap/dist/js/bootstrap.min.js",
      js_input + "style.js",
    ],
    gulp.parallel(["scripts"])
  );
});

gulp.task("default", gulp.series(["watch"]));
