var gulp = require('gulp');
var browserSync = require('browser-sync');

// gulp.task('browser-sync', function() {
//  browserSync({
//    server: {
//      baseDir: "./"
//    }
//  });
// });

// If using MAMP or something

gulp.task('browser-sync', function () {
  browserSync({
    proxy: "themes.dev"
  });
});