(function ($) {
    "use strict";
  
    // PRE LOADER
    $(window).on('load', function () {
      $('.preloader').fadeOut(1000); // set duration in brackets    
    });
  
    // CUSTOM LINK SCROLL
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
  
  // NAVBAR STICKY ON SCROLL
  window.addEventListener('scroll', function () {
    const wrapper = document.querySelector('.sticky-wrapper');
    if (window.scrollY > 50) {
      wrapper.classList.add('is-sticky');
    } else {
      wrapper.classList.remove('is-sticky');
    }
  });


  // Breeds section
  fetch("{{ asset('breeds.json') }}")  // Adjust the path to the JSON file if needed
  .then(response => response.json())
  .then(data => {
      const breedSelect = document.getElementById("breed");
      data.forEach(breed => {
          const option = document.createElement("option");
          option.value = breed;  // Use the breed as the option value
          option.textContent = breed;  // Display breed name in dropdown
          breedSelect.appendChild(option);
      });
  });
