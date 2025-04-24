
  (function ($) {
  
  "use strict";

    // PRE LOADER
    $(window).load(function(){
      $('.preloader').fadeOut(1000); // set duration in brackets    
    });

    // CUSTOM LINK
    $('.custom-link').click(function(){
    var el = $(this).attr('href');
    var elWrapped = $(el);
    var header_height = $('.navbar').height() + 10;

    scrollToDiv(elWrapped,header_height);
    return false;

    function scrollToDiv(element,navheight){
      var offset = element.offset();
      var offsetTop = offset.top;
      var totalScroll = offsetTop-navheight;

      $('body,html').animate({
      scrollTop: totalScroll
      }, 300);
  }
});
    
  })(window.jQuery);

//sticky nav
  window.addEventListener('scroll', function () {
    const wrapper = document.querySelector('.sticky-wrapper');
    if (window.scrollY > 50) {
      wrapper.classList.add('is-sticky');
    } else {
      wrapper.classList.remove('is-sticky');
    }
  });

// dashboard

// confirm delete project
function confirmDelete(projectId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This project will be deleted permanently.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`delete-form-${projectId}`).submit();
        }
    });
}

// refresh when back to dashboard
window.addEventListener('pageshow', function(event) {
    if (event.persisted) {
        window.location.reload();
    }
});

// old password confirmation
let typingTimer;
const delay = 600;
const input = document.getElementById('old_password');
const icon = document.getElementById('password-status-icon');

input.addEventListener('input', () => {
    clearTimeout(typingTimer);
    icon.innerHTML = `<div class="spinner-border spinner-border-sm text-secondary" role="status"></div>`;

    typingTimer = setTimeout(() => {
        checkOldPassword(input.value);
    }, delay);
});

function checkOldPassword(password) {
    fetch('{{ route('check.password') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.match) {
            icon.innerHTML = `<i class="bi bi-check-circle-fill text-success"></i>`;
        } else {
            icon.innerHTML = `<i class="bi bi-x-circle-fill text-danger"></i>`;
        }
    })
    .catch(() => {
        icon.innerHTML = `<i class="bi bi-exclamation-circle-fill text-warning"></i>`;
    });
}

// check re entered password confirmation
    let matchTimer;

    function checkPasswordMatch() {
        const newPassword = document.querySelector('input[name="new_password"]').value;
        const confirmation = document.getElementById('new_password_confirmation').value;
        const loading = document.getElementById('match-loading');
        const success = document.getElementById('match-success');
        const error = document.getElementById('match-error');
        const icon = document.getElementById('match-icon');

        // Show spinner
        icon.style.display = 'block';
        loading.style.display = 'inline-block';
        success.style.display = 'none';
        error.style.display = 'none';

        clearTimeout(matchTimer);
        matchTimer = setTimeout(() => {
            loading.style.display = 'none';
            if (confirmation === '') {
                icon.style.display = 'none';
            } else if (newPassword === confirmation) {
                success.style.display = 'inline-block';
                error.style.display = 'none';
            } else {
                success.style.display = 'none';
                error.style.display = 'inline-block';
            }
        }, 500);
    }

// show password 

function togglePassword(inputId, btn) {
    const input = document.getElementById(inputId);
    if (input.type === "password") {
        input.type = "text";
        btn.textContent = "Hide";
    } else {
        input.type = "password";
        btn.textContent = "Show";
    }
}


