<?php

function custom_mobile_submenu_script() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Select all dropdown toggles inside navbar
      var dropdownToggles = document.querySelectorAll('.navbar .dropdown-toggle');

      dropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
          if (window.innerWidth < 992) { // Bootstrap lg breakpoint
            e.preventDefault();
            var submenu = toggle.nextElementSibling;

            if (submenu) {
              if (submenu.classList.contains('show')) {
                submenu.classList.remove('show');
              } else {
                // Close other open submenus at same level
                var parentMenu = toggle.closest('.dropdown-menu');
                if(parentMenu) {
                  var openSubs = parentMenu.querySelectorAll('.dropdown-menu.show');
                  openSubs.forEach(function(openSub) {
                    openSub.classList.remove('show');
                  });
                }
                submenu.classList.add('show');
              }
            }
          }
        });
      });
    });
    </script>
    <?php
}
add_action('wp_footer', 'custom_mobile_submenu_script');
