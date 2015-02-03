var gulp = require("gulp");
var newer = require("gulp-newer");
var notify = require("gulp-notify");
var imagemin = require("gulp-imagemin");
var size = require('gulp-size');
var config = require('../config').images;

gulp.task('images', function () {
  return gulp.src(config.src)
    .pipe(newer(config.dest))
    .pipe(imagemin({ optimizationLevel: 2, progressive: true, interlaced: true }))
    .pipe(gulp.dest(config.dest))
    .pipe(size({ showFiles: true }))
    .pipe(notify({ title: 'Gulp Success!', message: 'Images minified' }));
});