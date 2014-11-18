// Load plugins
var gulp = require('gulp'),
  plugins = require('gulp-load-plugins')({ camelize: true }),
  sass = require('gulp-ruby-sass'),
  clean = require('gulp-clean'),
  newer = require('gulp-newer'),
  livereload = require('gulp-livereload'),
  plumber = require('gulp-plumber'),
  autoprefixer = require('gulp-autoprefixer'),
  notify = require("gulp-notify");


// Styles
gulp.task('styles', function () {
  return gulp.src('assets/scss/*.scss')
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(sass({require: ['susy'], style: 'expanded', lineNumbers: true, 'sourcemap=none': true }))
    .pipe(autoprefixer('last 2 versions', 'ie 8', 'ios 6'))
    .pipe(gulp.dest('assets/build/css'))
    .pipe(plugins.minifyCss({ keepSpecialComments: 1 }))
    .pipe(gulp.dest('assets/build/css'))
    .pipe(livereload(8888))
    .pipe(notify({ message: 'Styles task complete' }));
});

// Concact & Minimize JS
gulp.task('js', function () {
  return gulp.src([
    'assets/js/vendor/fastclick.js',
    'assets/js/scripts.js'
  ])
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(plugins.jshint('.jshintrc'))
    .pipe(plugins.jshint.reporter('default'))
    .pipe(plugins.concat('global.js'))
    .pipe(gulp.dest('assets/js'))
    .pipe(plugins.rename({ suffix: '.min' }))
    .pipe(plugins.uglify())
    .pipe(livereload(8888))
    .pipe(gulp.dest('assets/build/js'))
    .pipe(notify({ message: 'JS task complete' }));
});

// Modernizr
gulp.task('modernizr', function () {
  return gulp.src('assets/js/vendor/modernizr.js')
    .pipe(plugins.uglify())
    .pipe(plugins.rename({ suffix: '.min' }))
    .pipe(gulp.dest('assets/build/js'))
    .pipe(notify({ message: 'Modernizr task complete' }));
});

// Images
gulp.task('images', function () {
  return gulp.src('assets/images/*')
    .pipe(newer('assets/build/images'))
    .pipe(plugins.imagemin({ optimizationLevel: 2, progressive: true, interlaced: true }))
    .pipe(gulp.dest('assets/build/images'))
    .pipe(notify({ message: 'Images minified' }));
});

// Clean out Build Folder
gulp.task('clean', function () {
  return gulp.src(['assets/build'], {read: false})
    .pipe(clean());
});

// Watch
gulp.task('watch', function () {

  // Watch .scss files
  gulp.watch('assets/scss/**/*.scss', ['styles']);

  // Watch .js files
  gulp.watch('assets/js/**/*.js', ['js']);

  // Watch image files
  gulp.watch('assets/images/**/*', ['images']);

});

// Default task
gulp.task('default', ['watch']);
gulp.task('build', ['styles', 'modernizr', 'js', 'images', 'watch']);