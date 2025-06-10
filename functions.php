<?php
/**
 * Theme Functions
 * @package aocndigboi
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define theme version constant
define( 'AOCN_DIGBOI_THEME_VERSION', wp_get_theme()->get( 'Version' ) );

// === Include Core Theme Files ===

// Theme Setup
require_once get_template_directory() . '/inc/theme-setup.php';

// Enqueue Scripts and Styles
require_once get_template_directory() . '/inc/enqueue.php';

// Custom Mobile Menu
require_once get_template_directory() . '/inc/custom-mobile-menu.php';

// Bootstrap 5 Nav Walker
require_once get_template_directory() . '/inc/class-bootstrap-5-navwalker.php';

// Testimonial Carosual
function aocndigboi_owl_init_script() {
    ?>
    <script>
        jQuery(document).ready(function($) {
            $('.testimonial-carousel').owlCarousel({
                items: 2,
                loop: true,
                margin: 30,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplaySpeed: 1000,
                smartSpeed: 700,
                navText: [
                '<span class="owl-prev-icon">&#8249;</span>',
                '<span class="owl-next-icon">&#8250;</span>'
                ],
                responsive:{
                0:{ items:1 },
                768:{ items:1 },
                992:{ items:3 }
                }
            });
        });
    </script>
    <?php
}
add_action( 'wp_footer', 'aocndigboi_owl_init_script');

// Register Custom Post Type for Video Gallery
// Make sure this is in your functions.php
function register_video_gallery_post_type() {
    register_post_type('add-video-gallery', array(
        'labels' => array(
            'name' => __('Video Gallery'),
            'singular_name' => __('Video'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'video-gallery'),
        'supports' => array('title', 'thumbnail', 'editor', 'comments'),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-video-alt3',
    ));
}
add_action('init', 'register_video_gallery_post_type');


