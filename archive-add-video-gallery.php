<?php
/**
 * Archive template for Video Gallery
 */

get_header();
?>

<section class="video-gallery-archive py-5">
    <div class="container">
        <h1 class="page-title mb-4"><?php post_type_archive_title(); ?></h1>

        <?php
        // Debug information
        echo "<!-- Debug Info: -->";
        echo "<!-- Post Type Exists: " . (post_type_exists('add-video-gallery') ? 'Yes' : 'No') . " -->";
        
        if (have_posts()) :
            echo "<!-- Total Posts Found: " . $wp_query->found_posts . " -->";
            ?>
            <div class="row">
                <?php
                while (have_posts()) : the_post();
                    // Debug post information
                    echo "<!-- Processing Post ID: " . get_the_ID() . " -->";
                    
                    $video_type_raw = get_field('video_type');
                    $video_type = strtolower(str_replace(' ', '_', $video_type_raw));
                    
                    // Debug field values
                    echo "<!-- Video Type: " . esc_html($video_type) . " -->";
                    
                    $youtube_link = get_field('youtube_link');
                    $facebook_link = get_field('facebook_link');
                    $upload_video = get_field('upload_video');
                    
                    echo "<!-- YouTube Link: " . esc_html($youtube_link) . " -->";
                    echo "<!-- Facebook Link: " . esc_html($facebook_link) . " -->";
                    echo "<!-- Upload Video: " . esc_html($upload_video) . " -->";
                    ?>

                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="video-embed">
                                <?php if ($video_type == 'youtube' && $youtube_link) : ?>
                                    <?php
                                    // Convert various YouTube URL formats to embed URL
                                    $youtube_id = '';
                                    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $youtube_link, $matches)) {
                                        $youtube_id = $matches[1];
                                        $youtube_link = 'https://www.youtube.com/embed/' . $youtube_id . '?rel=0&modestbranding=1&playsinline=1';
                                    }
                                    ?>
                                    <div class="ratio ratio-16x9">
                                        <iframe 
                                            src="<?php echo esc_url($youtube_link); ?>" 
                                            frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                            allowfullscreen
                                            loading="lazy"
                                            title="<?php echo esc_attr(get_the_title()); ?>"
                                        ></iframe>
                                    </div>

                                <?php elseif ($video_type == 'facebook' && $facebook_link) : ?>
                                    <div class="ratio ratio-16x9">
                                        <div class="fb-video" 
                                            data-href="<?php echo esc_url($facebook_link); ?>" 
                                            data-width="500" 
                                            data-allowfullscreen="true"
                                            data-show-text="false">
                                        </div>
                                    </div>

                                <?php elseif ($video_type == 'upload' && $upload_video) : ?>
                                    <div class="ratio ratio-16x9">
                                        <video controls playsinline preload="metadata">
                                            <source src="<?php echo esc_url($upload_video); ?>" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>

                                <?php else : ?>
                                    <div class="alert alert-danger">
                                        <?php 
                                        if (!$video_type) {
                                            echo 'Video type not specified.';
                                        } elseif (!$youtube_link && !$facebook_link && !$upload_video) {
                                            echo 'No video source provided.';
                                        } else {
                                            echo 'Video source not available or unsupported type.';
                                        }
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title"><?php the_title(); ?></h5>
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary mt-2">View Details</a>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            </div>

            <?php
            // Pagination
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('Previous', 'your-textdomain'),
                'next_text' => __('Next', 'your-textdomain'),
            ));
            ?>

        <?php else : ?>
            <div class="alert alert-info">
                <?php esc_html_e('No videos found.', 'your-textdomain'); ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?> 