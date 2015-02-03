var gulp = require('gulp');
var config = require('../config');

gulp.task('watch', function () {
  gulp.watch(config.base.src + 'scss/**/*.scss', ['css']);
  gulp.watch(config.base.src + 'js/**/*.js', ['scripts']);
  gulp.watch(config.base.src + 'images/**/*', ['images']);
});