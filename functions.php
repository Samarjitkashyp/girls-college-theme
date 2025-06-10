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

// Register ACF Fields for Video Gallery
function register_video_gallery_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_video_gallery',
            'title' => 'Video Gallery Fields',
            'fields' => array(
                array(
                    'key' => 'field_video_type',
                    'label' => 'Video Type',
                    'name' => 'video_type',
                    'type' => 'select',
                    'choices' => array(
                        'youtube' => 'YouTube',
                        'facebook' => 'Facebook',
                        'upload' => 'Upload Video'
                    ),
                    'required' => 1,
                    'return_format' => 'value'
                ),
                array(
                    'key' => 'field_youtube_link',
                    'label' => 'YouTube Link',
                    'name' => 'youtube_link',
                    'type' => 'url',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_video_type',
                                'operator' => '==',
                                'value' => 'youtube'
                            )
                        )
                    )
                ),
                array(
                    'key' => 'field_facebook_link',
                    'label' => 'Facebook Link',
                    'name' => 'facebook_link',
                    'type' => 'url',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_video_type',
                                'operator' => '==',
                                'value' => 'facebook'
                            )
                        )
                    )
                ),
                array(
                    'key' => 'field_upload_video',
                    'label' => 'Upload Video',
                    'name' => 'upload_video',
                    'type' => 'file',
                    'return_format' => 'url',
                    'mime_types' => 'mp4,webm',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_video_type',
                                'operator' => '==',
                                'value' => 'upload'
                            )
                        )
                    )
                ),
                array(
                    'key' => 'field_social_sharing',
                    'label' => 'Enable Social Sharing',
                    'name' => 'social_sharing',
                    'type' => 'true_false',
                    'ui' => 1,
                    'default_value' => 1
                ),
                array(
                    'key' => 'field_enable_comments',
                    'label' => 'Enable Comments',
                    'name' => 'enable_comments',
                    'type' => 'true_false',
                    'ui' => 1,
                    'default_value' => 1
                )
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'add-video-gallery'
                    )
                )
            )
        ));
    }
}
add_action('acf/init', 'register_video_gallery_fields');

// Function to increment video views
function increment_video_views() {
    if (is_singular('add-video-gallery')) {
        $post_id = get_the_ID();
        $views = get_post_meta($post_id, 'video_views', true);
        $views = $views ? $views + 1 : 1;
        update_post_meta($post_id, 'video_views', $views);
    }
}
add_action('wp_head', 'increment_video_views');


