setTimeout(function() {
    $('.error').fadeOut('fast');
}, 5000); 

setTimeout(function() {
    $('.success').fadeOut('fast');
}, 5000); 

function initMessageClosers() {
  $('.close').click(function() {
    $(this).parent().slideUp();
  });
}