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
