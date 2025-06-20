(function ($) {
    "use strict";

    // preloader
    $(window).on('load', function () {
      $('.preloader').fadeOut(1000);
    });

    // scroll
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

  // sticky navbar
  window.addEventListener('scroll', function () {
    const wrapper = document.querySelector('.sticky-wrapper');
    if (window.scrollY > 50) {
      wrapper.classList.add('is-sticky');
    } else {
      wrapper.classList.remove('is-sticky');
    }
  });

