var idxScroll;

(function() {
var loaded = false;
idxScroll = function() {
  if (loaded) {
    return;
  }
  loaded = true;
  
  var postPreviewTpl =
    '<div class="post-preview">' +
      '<h3 class="post-title"><a href="post.showUrl">post.title</a></h3>' +
      '<div class="post-image-container"><a href="post.showUrl"><img src="post.imageUrl"></a></div>' +
    '</div>';
  var nextPage = 1;
  var postsUrl = '<?= Rails::application()->routes()->pathFor('base') ?>/posts/get_images';
  var canLoadMore = true;
  var busy = false;
  
  initScrollLoad = function() {
    var minHeightPercentage = 80;
    var ww = $(window);
    var dd = $(document);
    
    var scrollCb = function() {
      if (!canLoadMore) {
        ww.unbind('scroll', scrollCb);
        return;
      }
      
      var s = ww.scrollTop(),
          d = dd.height(),
          c = ww.height();
          scrollPercent = (s / (d-c)) * 100;
      
      if (scrollPercent >= minHeightPercentage) {
        // console.log('Load posts');
        getPosts();
      }
    };
    
    ww.on('scroll', scrollCb);
  }
  
  initScrollLoad();
  
  getPosts = function() {
    if (busy) {
      return;
    }
    busy = true;
    
    $.get(postsUrl + '?page=' + nextPage.toString(), function(posts) {
      busy = false;
      nextPage++;
      
      if (!posts.length) {
        canLoadMore = false;
        return;
      }
      
      posts.forEach(function(post) {
        var html =
          postPreviewTpl
            .replace(/post\.showUrl/g, post.showUrl)
            .replace('post.imageUrl', post.imageUrl)
            .replace('post.title', post.title)
        // console.log(html, post)
        $('.posts-list').append(html);
      });
    });
  }
}
})();
