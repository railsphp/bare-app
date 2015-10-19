var PostNav;

(function() {
  var started     = false;
  var apiUrl      = '/kimg_design/posts/index.json?offset_id=%offset%&dir=%dir%';
  var cachedPosts = [];
  var currentPost;
  var canLoadNext = true;
  var canLoadPrev = true;
  var initedNext  = false;
  var initedPrev  = false;
  // Preload posts within this range.
  var loadThreshold = 1;
  // Posts that we expect to receive from server.
  var expectedPostCount = 5;
  
  PostNav = function(post) {
    if (started) {
      return;
    }
    started = true;
    
    cachedPosts.push(post);
    currentPost = post;
    
    var loadNextBtn = $('.arrow-box-next a');
    var loadPrevBtn = $('.arrow-box-prev a');
    
    loadNextBtn.on('click', function(ev) {
      ev.preventDefault();
      showNext();
    });
    loadPrevBtn.on('click', function(ev) {
      ev.preventDefault();
      showPrev();
    });
    
    
    function showNext() {
      if (!initedNext && !initedPrev) {
        fetchNext(currentPost.id, function(posts) {
          currentPost = posts.shift();
          createView(currentPost);
          initedNext = true;
        });
      } else {
        var nextIndex = cachedPosts.indexOf(currentPost) - 1;
        var nextPost  = cachedPosts[nextIndex];
        if (!nextPost) {
          return;
        }
        
        currentPost = nextPost;
        
        if (canLoadNext && nextIndex - loadThreshold <= 0) {
          fetchNext(cachedPosts[0].id, function(posts) {
            posts.forEach(function(post) {
              loadImage(post.imageUrl);
            });
          })
        }
        
        createView(currentPost);
      }
    }
    
    function fetchNext(postId, callback) {
      if (!canLoadNext) {
        return;
      }
      
      var url = apiUrl
        .replace('%offset%', postId)
        .replace('%dir%', 'next');
      
      $.get(url, function(resp) {
        if (!resp.length) {
          canLoadNext = false;
          return;
        } else if (resp.length < expectedPostCount) {
          canLoadNext = false;
        }
        
        resp.forEach(function(post) {
          cachedPosts.unshift(post);
        });
        
        
        callback(resp);
      });
    }
    
    
    
    function showPrev() {
      if (!initedPrev && !initedNext) {
        fetchPrev(currentPost.id, function(posts) {
          currentPost = posts.shift();
          createView(currentPost);
          initedPrev = true;
        });
      } else {
        var nextIndex = cachedPosts.indexOf(currentPost) + 1;
        var prevPost  = cachedPosts[nextIndex];
        
        if (!prevPost) {
          return;
        }
        
        currentPost = prevPost;
        
        if (canLoadPrev && nextIndex + loadThreshold >= cachedPosts.length) {
          fetchPrev(cachedPosts[cachedPosts.length - 1].id, function(posts) {
            posts.forEach(function(post) {
              loadImage(post.imageUrl);
            });
          })
        }
        
        createView(currentPost);
      }
    }
    
    function fetchPrev(postId, callback) {
      if (!canLoadPrev) {
        return;
      }
      
      var url = apiUrl
        .replace('%offset%', postId)
        .replace('%dir%', 'prev');
      
      $.get(url, function(resp) {
        if (!resp.length) {
          canLoadPrev = false;
          return;
        } else if (resp.length < expectedPostCount) {
          canLoadPrev = false;
        }
        
        resp.reverse().forEach(function(post) {
          cachedPosts.push(post);
        });
        
        callback(resp);
      });
    }
    
    function loadImage(imageUrl) {
      var img = new Image();
      img.src = imageUrl;
    }
    
    function createView(post) {
      $('#idddd').html(post.id);
      $('.post-title').html(post.title);
      $('.post-image').attr('src', post.imageUrl);
    }
  }
})();
