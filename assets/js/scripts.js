jQuery(document).ready(function($) {

  // ================
  // ENABLE FASTCLICK
  // ================

  function FastClick() {
    //Polyfill to remove click delays on browsers with touch UIs.
    if (window.addEventListener) {
     window.addEventListener('load', function() {
      new FastClick(document.body);
     }, false);
    }
  }
});