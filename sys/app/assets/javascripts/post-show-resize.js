$(function(){
  var img = $('.post-show .post-image-container img');
  var topMargin = img.offset().top + 15;
  var bottomMargin = $('.share-post').outerHeight();
  var w = $(window);
  var minWidth = 768;
  var minHeight = 15;
  
  w.on('resize', function() {
    resizeImage();
  });
  
  function resizeImage() {
    if (w.width() > minWidth) {
      var imgSize = 'auto';
    } else {
      var windowSize = w.height();
      var imgSize = windowSize - (bottomMargin + topMargin);
      if (imgSize < minHeight) {
        imgSize = minHeight;
      }
    }
    img.css('max-height', imgSize);
  }
  
  resizeImage();
});
