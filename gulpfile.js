// Load plugins
var gulp = require('gulp');
var requireDir = require('require-dir');
var dir = requireDir('./gulp/tasks');

gulp.task('default', ['browser-sync', 'watch']);