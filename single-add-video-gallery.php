<?php
/**
 * Single Video Gallery Template
 * 
 * @package YourThemeName
 */
get_header();
?>

<section class="single-video-wrapper py-5">
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
            <article id="video-<?php the_ID(); ?>" <?php post_class('video-content'); ?>>
                <header class="video-header mb-4">
                    <h1 class="video-title"><?php the_title(); ?></h1>
                    <div class="video-meta">
                        <span class="posted-on">
                            <?php echo esc_html__('Posted on', 'your-textdomain') . ' ' . get_the_date(); ?>
                        </span>
                    </div>
                </header>

                <?php
                // Debug information
                echo "<!-- Debug Info: -->";
                echo "<!-- Post ID: " . get_the_ID() . " -->";
                
                // Get video details
                $video_type_raw = get_field('video_type');
                $video_type = !empty($video_type_raw) ? strtolower(str_replace(' ', '_', $video_type_raw)) : '';
                
                echo "<!-- Video Type: " . esc_html($video_type) . " -->";
                
                $youtube_link = get_field('youtube_link');
                $facebook_link = get_field('facebook_link');
                $upload_video = get_field('upload_video');
                
                echo "<!-- YouTube Link: " . esc_html($youtube_link) . " -->";
                echo "<!-- Facebook Link: " . esc_html($facebook_link) . " -->";
                echo "<!-- Upload Video: " . esc_html($upload_video) . " -->";
                
                $social_sharing = get_field('social_sharing');
                $enable_comments = get_field('enable_comments');
                
                // View counter logic
                $views = absint(get_post_meta(get_the_ID(), 'video_views', true));
                // Only increment views if not logged in or not an admin
                if (!is_user_logged_in() || !current_user_can('manage_options')) {
                    $views++;
                    update_post_meta(get_the_ID(), 'video_views', $views);
                }
                ?>

                <div class="video-player-container mb-4">
                    <?php if ($video_type === 'youtube' && $youtube_link): ?>
                        <?php
                        // Improved YouTube ID extraction with better security
                        $youtube_id = '';
                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', esc_url($youtube_link), $matches)) {
                            $youtube_id = sanitize_text_field($matches[1]);
                        }
                        ?>
                        
                        <?php if ($youtube_id): ?>
                            <div class="ratio ratio-16x9">
                                <iframe 
                                    src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_id); ?>?rel=0&modestbranding=1&playsinline=1" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    allowfullscreen
                                    loading="lazy"
                                    title="<?php echo esc_attr(get_the_title()); ?>"
                                    aria-label="<?php echo esc_attr(sprintf(__('YouTube video: %s', 'your-textdomain'), get_the_title())); ?>"
                                ></iframe>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning">
                                <?php esc_html_e('Invalid YouTube URL provided.', 'your-textdomain'); ?>
                            </div>
                        <?php endif; ?>

                    <?php elseif ($video_type === 'facebook' && $facebook_link): ?>
                        <div class="ratio ratio-16x9">
                            <div class="fb-video" 
                                data-href="<?php echo esc_url($facebook_link); ?>" 
                                data-width="500" 
                                data-allowfullscreen="true"
                                data-show-text="false">
                            </div>
                        </div>

                    <?php elseif ($video_type === 'upload' && $upload_video): ?>
                        <div class="ratio ratio-16x9">
                            <video controls playsinline preload="metadata">
                                <source src="<?php echo esc_url($upload_video); ?>" type="video/mp4">
                                <?php esc_html_e('Your browser does not support the video tag.', 'your-textdomain'); ?>
                            </video>
                        </div>
                        
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <?php esc_html_e('Video not available. Please check the video configuration.', 'your-textdomain'); ?>
                            <?php if (current_user_can('edit_post', get_the_ID())): ?>
                                <br><small>
                                    <a href="<?php echo get_edit_post_link(); ?>">Edit this video</a> to configure the video source.
                                </small>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="video-content mb-4">
                    <?php 
                    the_content();
                    
                    // Add page links for paginated content
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'your-textdomain'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <div class="video-stats d-flex justify-content-between align-items-center mb-4">
                    <div class="video-views d-flex align-items-center">
                        <span class="stat-icon me-2"><i class="fas fa-eye"></i></span>
                        <span class="stat-value me-1"><?php echo number_format($views); ?></span>
                        <span class="stat-label"><?php esc_html_e('views', 'your-textdomain'); ?></span>
                    </div>
                    
                    <div class="video-date">
                        <small class="text-muted">
                            <i class="fas fa-calendar-alt me-1"></i>
                            <?php echo get_the_date(); ?>
                        </small>
                    </div>
                    
                    <?php if (function_exists('the_views')) : ?>
                        <div class="video-likes">
                            <?php the_views(); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($social_sharing): ?>
                    <div class="video-social-share mb-4">
                        <h3 class="share-title h5 mb-3"><?php esc_html_e('Share this video', 'your-textdomain'); ?></h3>
                        <div class="share-buttons d-flex flex-wrap gap-2" role="group" aria-label="<?php esc_attr_e('Social sharing options', 'your-textdomain'); ?>">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink()); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="btn btn-sm btn-outline-primary"
                               aria-label="<?php esc_attr_e('Share on Facebook', 'your-textdomain'); ?>">
                                <i class="fab fa-facebook-f me-1" aria-hidden="true"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="btn btn-sm btn-outline-info">
                                <i class="fab fa-twitter me-1"></i> Twitter
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fab fa-linkedin-in me-1"></i> LinkedIn
                            </a>
                            <a href="whatsapp://send?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>" 
                               target="_blank"
                               class="btn btn-sm btn-outline-success d-sm-none">
                                <i class="fab fa-whatsapp me-1"></i> WhatsApp
                            </a>
                            <button type="button" 
                                    class="btn btn-sm btn-outline-secondary"
                                    onclick="copyToClipboard('<?php echo esc_js(get_permalink()); ?>')">
                                <i class="fas fa-link me-1"></i> Copy Link
                            </button>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Related Videos Section -->
                <?php
                // Cache key for related videos
                $cache_key = 'related_videos_' . get_the_ID();
                $related_videos = wp_cache_get($cache_key);

                if (false === $related_videos) {
                    $related_args = array(
                        'post_type' => 'add-video-gallery',
                        'posts_per_page' => 3,
                        'post__not_in' => array(get_the_ID()),
                        'orderby' => 'rand',
                        'meta_query' => array(
                            'relation' => 'OR',
                            array(
                                'key' => 'youtube_url',
                                'value' => '',
                                'compare' => '!='
                            ),
                            array(
                                'key' => 'self_hosted_video',
                                'value' => '',
                                'compare' => '!='
                            )
                        ),
                        'no_found_rows' => true, // Optimize query
                        'update_post_meta_cache' => false, // Don't cache post meta
                        'update_post_term_cache' => false, // Don't cache terms
                    );
                    
                    $related_videos = new WP_Query($related_args);
                    wp_cache_set($cache_key, $related_videos, '', 3600); // Cache for 1 hour
                }
                
                if ($related_videos->have_posts()): ?>
                    <div class="related-videos mb-4">
                        <h3 class="h5 mb-3"><?php esc_html_e('Related Videos', 'your-textdomain'); ?></h3>
                        <div class="row">
                            <?php while ($related_videos->have_posts()): $related_videos->the_post(); ?>
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100">
                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none" aria-label="<?php echo esc_attr(sprintf(__('View video: %s', 'your-textdomain'), get_the_title())); ?>">
                                            <?php if (has_post_thumbnail()): ?>
                                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>" 
                                                     class="card-img-top" 
                                                     alt="<?php echo esc_attr(get_the_title()); ?>"
                                                     loading="lazy"
                                                     width="300"
                                                     height="150"
                                                     style="height: 150px; object-fit: cover;">
                                            <?php endif; ?>
                                            <div class="card-body">
                                                <h6 class="card-title"><?php echo esc_html(get_the_title()); ?></h6>
                                                <small class="text-muted"><?php echo esc_html(get_the_date()); ?></small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>

                <?php if ($enable_comments): ?>
                    <div class="video-comments mt-5">
                        <h3 class="comments-title h4 mb-4"><?php esc_html_e('Comments', 'your-textdomain'); ?></h3>
                        <?php 
                        // Load comments template
                        if (comments_open() || get_comments_number()) {
                            comments_template();
                        } else {
                            echo '<p class="text-muted">' . esc_html__('Comments are closed for this video.', 'your-textdomain') . '</p>';
                        }
                        ?>
                    </div>
                <?php endif; ?>
            </article>

        <?php endwhile; else: ?>
            <div class="alert alert-info text-center">
                <h4><?php esc_html_e('Video Not Found', 'your-textdomain'); ?></h4>
                <p><?php esc_html_e('Sorry, the requested video could not be found.', 'your-textdomain'); ?></p>
                <a href="<?php echo get_post_type_archive_link('add-video-gallery'); ?>" class="btn btn-primary">
                    <?php esc_html_e('View All Videos', 'your-textdomain'); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
function copyToClipboard(text) {
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(() => {
            const successMessage = document.createElement('div');
            successMessage.className = 'copy-success-message';
            successMessage.setAttribute('role', 'alert');
            successMessage.setAttribute('aria-live', 'polite');
            successMessage.style.cssText = 'position: fixed; bottom: 20px; right: 20px; background: #28a745; color: white; padding: 10px 20px; border-radius: 4px; z-index: 1000;';
            successMessage.textContent = 'Link copied to clipboard!';
            document.body.appendChild(successMessage);
            setTimeout(() => successMessage.remove(), 2000);
        });
    } else {
        fallbackCopyToClipboard(text);
    }
}

function fallbackCopyToClipboard(text) {
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.position = 'fixed';
    textArea.style.left = '-999999px';
    textArea.style.top = '-999999px';
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        document.execCommand('copy');
        const successMessage = document.createElement('div');
        successMessage.className = 'copy-success-message';
        successMessage.setAttribute('role', 'alert');
        successMessage.setAttribute('aria-live', 'polite');
        successMessage.style.cssText = 'position: fixed; bottom: 20px; right: 20px; background: #28a745; color: white; padding: 10px 20px; border-radius: 4px; z-index: 1000;';
        successMessage.textContent = 'Link copied to clipboard!';
        document.body.appendChild(successMessage);
        setTimeout(() => successMessage.remove(), 2000);
    } catch (err) {
        console.error('Fallback: Could not copy text: ', err);
    }
    
    document.body.removeChild(textArea);
}
</script>

<style>
.video-player-container {
    position: relative;
    background: #000;
    border-radius: 8px;
    overflow: hidden;
}

.video-stats {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid #007bff;
}

.share-buttons .btn {
    min-width: 120px;
}

.related-videos .card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.related-videos .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

@media (max-width: 768px) {
    .video-stats {
        flex-direction: column;
        gap: 10px;
    }
    
    .share-buttons {
        justify-content: center;
    }
    
    .share-buttons .btn {
        min-width: auto;
        flex: 1;
    }
}
</style>

<?php get_footer(); ?>