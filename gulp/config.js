var paths = {
  src: 'assets/',
  dest: 'assets/build/'
};

// This object may be referenced by gulp tasks when config.js is required
module.exports = {

  base: {
    src: paths.src,
    dest: paths.dest
  },

  sass: {
    src: paths.src + 'scss/style.scss',
    dest: paths.dest + 'css/'
  },

  scripts: {
    src: [
      paths.src + 'js/vendor/fastclick.js',
      paths.src + 'js/site.js'
    ],
    dest: paths.dest + 'js/'
  },

  images: {
    src: paths.src + 'images/**/*',
    dest: paths.dest + 'images/'
  }
};