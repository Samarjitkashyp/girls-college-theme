<?php
/* Template Name: Video Gallery */
echo "<!-- Video Gallery Template Loaded -->";
get_header();
?>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Facebook SDK -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0"></script>

<section class="video-wrapper py-5">
    <div class="container">
        <div class="video-gallery-header text-center mb-5">
            <h2 class="video-title display-5 fw-bold mb-3"><?php the_title(); ?></h2>
            <p class="lead text-muted">Discover our latest video content</p>
        </div>

        <?php
        // Debug information
        echo "<!-- Debug Info: -->";
        echo "<!-- Post Type Exists: " . (post_type_exists('add-video-gallery') ? 'Yes' : 'No') . " -->";
        
        if (!post_type_exists('add-video-gallery')) {
            echo '<div class="alert alert-warning">Video Gallery is not available. Custom post type is missing.</div>';
        } else {
            $args = array(
                'post_type'      => 'add-video-gallery',
                'posts_per_page' => -1,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            );

            $video_query = new WP_Query($args);
            
            // Debug query information
            echo "<!-- Total Posts Found: " . $video_query->found_posts . " -->";
            echo "<!-- Have Posts: " . ($video_query->have_posts() ? 'Yes' : 'No') . " -->";
            
            if ($video_query->have_posts()) : ?>
                <div class="row g-4">
                    <?php while ($video_query->have_posts()) : $video_query->the_post();
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

                        // Initialize view counter if it doesn't exist
                        $views = get_post_meta(get_the_ID(), 'video_views', true);
                        if (empty($views)) {
                            $views = 0;
                            update_post_meta(get_the_ID(), 'video_views', $views);
                        }
                        
                        // Get formatted date
                        $publish_date = get_the_date('F j, Y');
                        
                        // Process YouTube URL
                        if ($video_type == 'youtube' && $youtube_link) {
                            // Convert various YouTube URL formats to embed URL
                            $youtube_id = '';
                            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $youtube_link, $matches)) {
                                $youtube_id = $matches[1];
                                $youtube_link = 'https://www.youtube.com/embed/' . $youtube_id . '?rel=0&modestbranding=1&playsinline=1';
                            }
                        }
                        ?>

                        <div class="col-md-4">
                            <div class="card video-card h-100">
                                <div class="video-thumbnail">
                                    <?php if ($video_type == 'youtube' && $youtube_link) : ?>
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
                                        <div class="play-button">
                                            <i class="fas fa-play"></i>
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
                                        <div class="play-button">
                                            <i class="fab fa-facebook"></i>
                                        </div>

                                    <?php elseif ($video_type == 'upload' && $upload_video) : ?>
                                        <div class="ratio ratio-16x9">
                                            <video controls playsinline preload="metadata">
                                                <source src="<?php echo esc_url($upload_video); ?>" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                        <div class="play-button">
                                            <i class="fas fa-play"></i>
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
                                    
                                    <!-- Meta Information -->
                                    <div class="video-stats d-flex justify-content-between align-items-center mb-3">
                                        <div class="video-views d-flex align-items-center">
                                            <span class="stat-icon me-2"><i class="fas fa-eye"></i></span>
                                            <span class="stat-value me-1"><?php echo number_format($views); ?></span>
                                            <span class="stat-label">views</span>
                                        </div>
                                        
                                        <div class="video-date">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar-alt me-1"></i>
                                                <?php echo esc_html($publish_date); ?>
                                            </small>
                                        </div>
                                    </div>

                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary w-100">
                                        Watch Video
                                        <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php endwhile; ?>
                </div>

                <?php wp_reset_postdata(); ?>

            <?php else : ?>
                <div class="no-videos text-center py-5">
                    <i class="fas fa-video fa-3x mb-3 text-muted"></i>
                    <p class="lead">No videos found.</p>
                </div>
            <?php endif;
        }
        ?>
    </div>
</section>

<style>
/* Modern Video Gallery Styles */
.video-gallery-header {
    margin-bottom: 3rem;
}

.video-gallery-header .lead {
    color: #6c757d;
    font-size: 1.2rem;
}

.video-card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.video-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.video-thumbnail {
    position: relative;
    overflow: hidden;
}

.video-thumbnail .ratio {
    margin: 0;
}

.play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60px;
    height: 60px;
    background: rgba(0,0,0,0.7);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.play-button i {
    color: #fff;
    font-size: 24px;
}

.video-card:hover .play-button {
    opacity: 1;
}

.card-body {
    padding: 1.5rem;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
    line-height: 1.4;
    color: #2c3e50;
}

.video-stats {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid #007bff;
}

.stat-icon {
    color: #007bff;
}

.stat-value {
    font-weight: 600;
    color: #2c3e50;
}

.stat-label {
    color: #6c757d;
}

.btn-primary {
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateX(5px);
}

.btn-primary i {
    transition: transform 0.3s ease;
}

.btn-primary:hover i {
    transform: translateX(3px);
}

.no-videos {
    padding: 4rem 0;
    text-align: center;
}

.no-videos i {
    color: #dee2e6;
    margin-bottom: 1rem;
}

.no-videos .lead {
    color: #6c757d;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .video-gallery-header {
        margin-bottom: 2rem;
    }
    
    .video-gallery-header .lead {
        font-size: 1rem;
    }
    
    .video-card {
        margin-bottom: 1.5rem;
    }
    
    .card-body {
        padding: 1.25rem;
    }
    
    .card-title {
        font-size: 1.1rem;
    }
    
    .video-stats {
        flex-direction: column;
        gap: 10px;
    }
}
</style>

<?php get_footer(); ?>
