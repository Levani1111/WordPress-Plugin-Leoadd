// Load Gulp...of course
var gulp = require("gulp");

// CSS related plugins
var sass = require("gulp-sass")(require("sass"));
var autoprefixer = require("gulp-autoprefixer");
var minifycss = require("gulp-uglifycss");

// JS related plugins
var browserify = require("browserify");
var source = require("vinyl-source-stream");
var buffer = require("vinyl-buffer");
var gulpif = require("gulp-if");
var babelify = require("babelify");
var uglify = require("gulp-uglify");
var sourcemaps = require("gulp-sourcemaps");
var stripDebug = require("gulp-strip-debug");

// Utility plugins
var rename = require("gulp-rename");
var notify = require("gulp-notify");
var plumber = require("gulp-plumber");
var options = require("gulp-options");

// Browers related plugins
var browserSync = require("browser-sync").create();
var reload = browserSync.reload;

// Project related variables
var projectURL = "https://test.dev";

var styleSRC = "./src/scss/style.scss";
var styleForm = "src/scss/form.scss";
var styleSlider = "src/scss/slider.scss";
var styleAuth = "src/scss/auth.scss";
var styleURL = "./assets/";
var mapURL = "./";

var jsSRC = "./src/js/";
var jsAdmin = "script.js";
var jsForm = "form.js";
var jsSlider = "slider.js";
var jsAuth = "auth.js";
var jsFiles = [jsAdmin, jsForm, jsSlider, jsAuth];
var jsURL = "./assets/";

var styleWatch = "./src/scss/**/*.scss";
var jsWatch = "./src/js/**/*.js";
var phpWatch = "./**/*.php";

// Tasks
gulp.task("browser-sync", function () {
  browserSync.init({
    proxy: projectURL,
    https: {
      key: "/Users/leoaddd/.valet/Certificates/test.dev.key",
      cert: "/Users/leoaddd/.valet/Certificates/test.dev.crt",
    },
    injectChanges: true,
    open: false,
  });
});

// Styles task
gulp.task("styles", function () {
  return gulp
    .src([styleSRC, styleForm, styleSlider, styleAuth])
    .pipe(sourcemaps.init())
    .pipe(
      sass({
        errLogToConsole: true,
        outputStyle: "compressed",
      }).on("error", sass.logError)
    )
    .pipe(autoprefixer())
    .pipe(sourcemaps.write(mapURL))
    .pipe(gulp.dest(styleURL))
    .pipe(browserSync.stream());
});

gulp.task("js", function () {
  jsFiles.map(function (entry) {
    return browserify({ entries: [jsSRC + entry] })
      .transform(babelify, { presets: ["@babel/preset-env"] })
      .bundle()
      .pipe(source(entry))
      .pipe(buffer())
      .pipe(gulpif(options.has("production"), stripDebug()))
      .pipe(sourcemaps.init({ loadMaps: true }))
      .pipe(uglify())
      .pipe(sourcemaps.write("."))
      .pipe(gulp.dest(jsURL))
      .pipe(browserSync.stream());
  });
});

gulp.task(
  "default",
  gulp.series("styles", "js", function (done) {
    gulp
      .src(jsURL + "script.min.js")
      .pipe(notify({ message: "Assets Compiled!" }));
    done();
  })
);

gulp.task("watch", function () {
  gulp.watch(phpWatch, reload);
  gulp.watch(styleWatch, gulp.series("styles"));
  gulp.watch(jsWatch, gulp.series("js", reload));
  gulp
    .src(jsURL + "script.min.js")
    .pipe(notify({ message: "Gulp is Watching, Happy Coding!" }));
});

gulp.task("default", gulp.parallel("watch", "browser-sync"));
