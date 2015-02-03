var gulp = require('gulp');
var plumber = require('gulp-plumber');
var sourcemaps = require('gulp-sourcemaps');
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var uglify = require("gulp-uglify");
var rename  = require('gulp-rename');
var size = require('gulp-size');
var notify = require("gulp-notify");
var config = require('../config').scripts;

gulp.task('scripts', function () {
  return gulp.src(config.src)
    .pipe(plumber())
    .pipe(sourcemaps.init())
      .pipe(jshint('.jshintrc'))
      .pipe(jshint.reporter('default'))
      .pipe(concat('global.js', {newLine: ';'}))
      .pipe(uglify())
      .pipe(rename({ suffix: '.min' }))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(config.dest))
    .pipe(size({ showFiles: true, title: 'File Size:' }))
    .pipe(notify({ title: 'Gulp Success!', message: 'Scripts task complete' }));
});