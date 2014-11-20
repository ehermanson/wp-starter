var basePaths = {
  src: 'assets/',
  dest: 'assets/build/'
};

var paths = {
  images: {
    src: basePaths.src + 'images/',
    dest: basePaths.dest + 'images/'
  },
  scripts: {
    src: basePaths.src + 'js/',
    dest: basePaths.dest + 'js/'
  },
  styles: {
    src: basePaths.src + 'scss/',
    dest: basePaths.dest + 'css/'
  }
};

var styleSrc = paths.styles.src;
var styleDest = paths.styles.dest;

var jsSrc = paths.scripts.src;
var jsDest = paths.scripts.dest;

var imgSrc = paths.images.src;
var imgDest = paths.images.dest;


// Load plugins
var gulp = require('gulp'),
  plugins = require('gulp-load-plugins')({ camelize: true }),
  sass = require('gulp-ruby-sass'),
  clean = require('gulp-clean'),
  newer = require('gulp-newer'),
  uglify = require('gulp-uglify'),
  livereload = require('gulp-livereload'),
  plumber = require('gulp-plumber'),
  autoprefixer = require('gulp-autoprefixer'),
  notify = require("gulp-notify");


// Styles
gulp.task('styles', function () {
  return gulp.src(styleSrc + '*.scss')

    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(sass({require: ['susy'], style: 'expanded', lineNumbers: true, 'sourcemap=none': true }))
    .pipe(autoprefixer('last 2 versions', 'ie 8', 'ios 6'))
    .pipe(gulp.dest(styleDest))
    .pipe(plugins.minifyCss({ keepSpecialComments: 1 }))
    .pipe(gulp.dest(styleDest))
    .pipe(livereload(8888))
    .pipe(notify({ message: 'Styles task complete' }));

});

// Concact & Minimize JS
gulp.task('js', function () {
  return gulp.src([
    jsSrc + 'vendor/fastclick.js',
    jsSrc + 'site.js'
  ])
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(plugins.jshint('.jshintrc'))
    .pipe(plugins.jshint.reporter('default'))
    .pipe(plugins.concat('global.js'))
    .pipe(gulp.dest(jsSrc))
    .pipe(plugins.rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(livereload(8888))
    .pipe(gulp.dest(jsDest))
    .pipe(notify({ message: 'JS task complete' }));
});

// Modernizr
gulp.task('modernizr', function () {
  return gulp.src(jsSrc + 'vendor/modernizr.js')
    .pipe(uglify())
    .pipe(plugins.rename({ suffix: '.min' }))
    .pipe(gulp.dest(jsDest))
    .pipe(notify({ message: 'Modernizr task complete' }));
});

// Images
gulp.task('images', function () {
  return gulp.src(imgSrc + '*/**')
    .pipe(newer(imgDest))
    .pipe(plugins.imagemin({ optimizationLevel: 2, progressive: true, interlaced: true }))
    .pipe(gulp.dest(imgDest))
    .pipe(notify({ message: 'Images minified' }));
});

// Clean out Build Folder
gulp.task('clean', function () {
  return gulp.src([basePaths.dest], {read: false})
    .pipe(clean());
});

// Watch
gulp.task('watch', function () {

  // Watch .scss files
  gulp.watch(styleSrc +'**/*.scss', ['styles']);

  // Watch .js files
  gulp.watch(jsSrc +'**/*.js', ['js']);

  // Watch image files
  gulp.watch(imgSrc + '**/*', ['images']);

});

// Default task
gulp.task('default', ['watch']);
gulp.task('build', ['styles', 'modernizr', 'js', 'images', 'watch']);