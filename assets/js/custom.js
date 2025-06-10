jQuery(document).ready(function($) {
    // Owl Carousel Init
    $('.owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        margin: 10,
        nav: true
    });

    // Swiper Init
    const swiper = new Swiper('.swiper-container', {
        loop: true,
        autoplay: {
            delay: 3000,
        },
        pagination: {
            el: '.swiper-pagination',
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    $('.testimonial-carousel').owlCarousel({
        loop: true,
    margin: 20,
    nav: true,
    dots: true,
    autoplay: true,
    autoplayTimeout: 5000,
    responsive: {
        0: { items: 1 },
        768: { items: 1 },
        1024: { items: 2 }
    },
    navText: ["<span class='nav-btn prev-slide'>&#10094;</span>", "<span class='nav-btn next-slide'>&#10095;</span>"]
    });

});


jQuery(document).ready(function($) {
    var owl = $('.hero-slider');
  
    owl.owlCarousel({
      items: 1,
      loop: true,
      autoplay: true,
      utoplayTimeout: 8000, // Slow down autoplay to 8 seconds
        smartSpeed: 1200, // Transition speed (in ms) for each slide
        autoplaySpeed: 1200, // Speed for autoplay transition
      nav: true,
      navText: [
        '<span class="owl-prev-icon"><i class="fas fa-chevron-left"></i></span>',
        '<span class="owl-next-icon"><i class="fas fa-chevron-right"></i></span>'
      ],
      dots: true,
      animateOut: 'fadeOut',
      animateIn: 'fadeIn'
    });
  
//     // Trigger text animations on each slide
//     owl.on('changed.owl.carousel', function(event) {
//       var currentItem = event.item.index;
//       var currentSlide = $(event.target).find('.owl-item').eq(currentItem);
  
//       // Clear any previous animation classes
//       currentSlide.find('.hero-content h1, .hero-content p, .hero-content a')
//         .removeClass('animate__animated animate__fadeInDown animate__fadeInUp');
  
//       // Trigger reflow to reset animations
//       void currentSlide.find('.hero-content')[0].offsetWidth;
  
//       // Add animation classes
//       currentSlide.find('h1').addClass('animate__animated animate__fadeInDown');
//       currentSlide.find('p').addClass('animate__animated animate__fadeInUp');
//       currentSlide.find('a').addClass('animate__animated animate__fadeInUp');
//     });
  
//     // Run animation on first slide load
//     var firstSlide = $('.hero-slider .owl-item.active');
//     firstSlide.find('h1').addClass('animate__animated animate__fadeInDown');
//     firstSlide.find('p').addClass('animate__animated animate__fadeInUp');
//     firstSlide.find('a').addClass('animate__animated animate__fadeInUp');
//   });
  

// function animateSlide(slide) {
//     var $content = slide.find('.hero-content');

//     // Remove existing animations
//     $content.find('h1, p, a').each(function() {
//         var el = $(this);
//         el.removeClass(function(index, className) {
//             return (className.match(/(^|\s)animate__\S+/g) || []).join(' ');
//         });
//     });

//     // Trigger reflow
//     void $content[0].offsetWidth;

//     // Add animations back
//     $content.find('h1').addClass('animate__animated animate__fadeInDown animate__delay-1s');
//     $content.find('p').addClass('animate__animated animate__fadeInUp animate__delay-2s');
//     $content.find('a').addClass('animate__animated animate__fadeInUp animate__delay-3s');
// }

// // Animate first slide
// setTimeout(function() {
//     var firstSlide = $('.hero-slider .owl-item.active').not('.cloned');
//     animateSlide(firstSlide);
// }, 100);

// // Animate on slide change
// owl.on('changed.owl.carousel', function(event) {
//     var currentIndex = event.item.index;
//     var currentSlide = $(event.target).find('.owl-item').eq(currentIndex).not('.cloned');

//     setTimeout(function() {
//         animateSlide(currentSlide);
//     }, 100);
// });
function animateSlide(slide) {
    var $content = slide.find('.hero-content');

    // Remove existing animations
    $content.find('h1, p, a').each(function() {
        var el = $(this);
        el.removeClass(function(index, className) {
            return (className.match(/(^|\s)animate__\S+/g) || []).join(' ');
        });
    });

    // Trigger reflow
    void $content[0].offsetWidth;

    // Add animations back
    $content.find('h1').addClass('animate__animated animate__fadeInDown animate__delay-1s');
    $content.find('p').addClass('animate__animated animate__fadeInUp animate__delay-2s');
    $content.find('a').addClass('animate__animated animate__fadeInUp animate__delay-3s');
}

// Animate first slide
setTimeout(function() {
    var firstSlide = $('.hero-slider .owl-item.active').not('.cloned');
    animateSlide(firstSlide);
}, 100);

// Animate on slide change
owl.on('changed.owl.carousel', function(event) {
    var currentIndex = event.item.index;
    var currentSlide = $(event.target).find('.owl-item').eq(currentIndex).not('.cloned');

    setTimeout(function() {
        animateSlide(currentSlide);
    }, 100);
});
});


jQuery(document).ready(function($) {
    // Initialize Datepickers
    $('#checkin-date, #checkout-date').datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 0, // Prevent past dates
    });

    // Handle form submission (you can modify this based on your back-end needs)
    $('#booking-form').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
        
        // Collect form data
        var location = $('#location').val();
        var checkin = $('#checkin-date').val();
        var checkout = $('#checkout-date').val();
        var rooms = $('#rooms').val();
        var guests = $('#guests').val();

        // Add basic validation (optional)
        if (location && checkin && checkout && rooms && guests) {
            alert('Form submitted successfully!');
            // Here you can make an AJAX request or redirect the user to a new page with form data.
        } else {
            alert('Please fill in all fields!');
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
  // Select all dropdown toggles in the navbar
  var dropdownToggles = document.querySelectorAll('.dropdown-toggle');

  dropdownToggles.forEach(function(toggle) {
    toggle.addEventListener('click', function(e) {
      if (window.innerWidth < 992) { // Bootstrap's lg breakpoint
        e.preventDefault(); // Prevent default link click
        var submenu = toggle.nextElementSibling;
        if (submenu) {
          if (submenu.classList.contains('show')) {
            submenu.classList.remove('show');
          } else {
            submenu.classList.add('show');
          }
        }
      }
    });
  });
});
