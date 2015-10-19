// require prefix
//= require jquery-1.10.2.min
//= require bootstrap
//= require jquery.cookie
// require jquery.fancybox-1.3.4
//= require_tree .

$(function(){
var cookieName = 'cookie-notice';
var container  = $('#cookie-footer-notice');
var btn = container.find('.cookie-hide');
if ($.cookie(cookieName)) {
  container.hide();
} else {
  btn.on('click', function() {
    $.cookie(cookieName, 1);
    container.hide();
    return false;
  });
}
});
