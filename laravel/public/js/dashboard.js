(function ($) {
    "use strict";
  
    $(window).on('load', function () {
      $('.preloader').fadeOut(1000); 
    });
  
    $('.custom-link').click(function () {
      const el = $(this).attr('href');
      const elWrapped = $(el);
      const headerHeight = $('.navbar').height() + 10;
  
      scrollToDiv(elWrapped, headerHeight);
      return false;
  
      function scrollToDiv(element, navHeight) {
        const offset = element.offset();
        const offsetTop = offset.top;
        const totalScroll = offsetTop - navHeight;
  
        $('body, html').animate({
          scrollTop: totalScroll
        }, 300);
      }
    });
  })(window.jQuery);

window.addEventListener('pageshow', function (event) {
          if (event.persisted) {
          window.location.reload();
          }
      });
  

