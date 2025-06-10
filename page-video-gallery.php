<?php
/* Template Name: Video Gallery */
echo "<!-- Video Gallery Template Loaded -->";
get_header();
?>

<section class="video-wrapper py-5">
    <div class="container">

        <h2 class="video-title mb-3"><?php the_title(); ?></h2>

        <?php
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

            if ($video_query->have_posts()) : ?>
                <div class="row">
                    <?php while ($video_query->have_posts()) : $video_query->the_post();

                        $video_type_raw = get_field('video_type');
                        $video_type = strtolower(str_replace(' ', '_', $video_type_raw));

                        $youtube_link = get_field('youtube_link');
                        $facebook_link = get_field('facebook_link');
                        $upload_video = get_field('upload_video');
                        ?>

                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="video-embed">
                                    <?php if ($video_type == 'youtube' && $youtube_link) : ?>
                                        <iframe width="100%" height="215" src="<?php echo esc_url($youtube_link); ?>" frameborder="0" allowfullscreen></iframe>

                                    <?php elseif ($video_type == 'facebook' && $facebook_link) : ?>
                                        <div class="fb-video" data-href="<?php echo esc_url($facebook_link); ?>" data-width="500" data-allowfullscreen="true"></div>

                                    <?php elseif ($video_type == 'upload' && $upload_video) : ?>
                                        <video width="100%" height="215" controls>
                                            <source src="<?php echo esc_url($upload_video); ?>" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>

                                    <?php else : ?>
                                        <div class="alert alert-danger">Video source not available or unsupported type.</div>
                                    <?php endif; ?>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title"><?php the_title(); ?></h5>
                                </div>
                            </div>
                        </div>

                    <?php endwhile; ?>
                </div>

                <?php wp_reset_postdata(); ?>

            <?php else : ?>
                <p class="text-center">No videos found.</p>
            <?php endif;
        }
        ?>
    </div>
</section>

<?php get_footer(); ?>
