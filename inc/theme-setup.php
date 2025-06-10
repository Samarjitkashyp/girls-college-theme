<?php
/**
 * Theme Setup
 * @package aocndigboi
 */

if ( ! function_exists( 'aocndigboi_theme_setup' ) ) {

    function aocndigboi_theme_setup() {
        // Make theme available for translation
        // load_theme_textdomain( 'hotel-booking-theme', get_template_directory() . '/languages' );

        // Add default RSS feed links to head
        // add_theme_support( 'automatic-feed-links' );

        // Let WordPress manage the document title
        add_theme_support( 'title-tag' );

        // Elementor Support
        add_theme_support('elementor');

        // Support for Featured Images
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'room-thumb', 600, 400, true ); // Custom image size

        // Register Navigation Menus
        register_nav_menus( array(
            'primary'   => __( 'Primary Menu', 'hotel-booking-theme' ),
            'footer'    => __( 'Footer Menu', 'hotel-booking-theme' ),
        ));

        // Enable HTML5 markup
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script'
        ));

        // Enable support for custom logo
        // add_theme_support( 'custom-logo' );
        add_theme_support( 'custom-logo', array(
            'height'      => 94,
            'width'       => 280,
            'flex-height' => true,
            'flex-width'  => true,
        ));

        // Enable support for Custom Background
        add_theme_support( 'custom-background', array(
            'default-color' => '#ffffff',
        ));

        // Editor Style (optional: load your own CSS inside block editor)
        // add_editor_style( 'assets/css/editor-style.css' );
    }

    add_action('wp_enqueue_scripts', function() {
    if ( function_exists('elementor_theme_do_location') && elementor_theme_do_location('single') ) {
        // Dequeue your theme-specific styles if needed
        // wp_dequeue_style('your-theme-style');
    }
    });

    // function include_testimonial_template() {
    // ob_start();
    // get_template_part('testimonial'); // looks for testimonial.php
    // return ob_get_clean();

    // }
    // add_shortcode('testimonial_section', 'include_testimonial_template');



}
add_action( 'after_setup_theme', 'aocndigboi_theme_setup' );
