var gulp = require('gulp');
var sass = require('gulp-ruby-sass');
var plumber = require('gulp-plumber');
var autoprefixer = require('gulp-autoprefixer');
var minCss = require('gulp-minify-css');
var browserSync = require('browser-sync');
var reload = browserSync.reload;
var size = require('gulp-size');
var notify = require('gulp-notify');
var config = require('../config').sass;

gulp.task('css', function () {
  return sass(config.src, { require: ['susy'], 'sourcemap=none': true })
    .pipe(plumber())
    .pipe(autoprefixer({ browsers: [ '> 5%', 'last 2 versions', 'ie 8', 'ios 6' ] }))
    .pipe(minCss({ keepSpecialComments: 1 }))
    .pipe(gulp.dest(config.dest))
    .pipe(reload({ stream: true }))
    .pipe(size({ showFiles: true, title: 'File Size:' }))
    .pipe(notify({ title: 'Gulp Success!', message: 'CSS task complete' }));
});