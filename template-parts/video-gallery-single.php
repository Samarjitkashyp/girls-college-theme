<section id="page-content">
    <div class="subpage-content-wrapper">
        <?php
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
        ?>

        <section class="video-wrapper">
    <div class="container">
        <h2 class="video-title"><?php the_title(); ?></h2>

        <?php
        $video_type = get_field('video_type');
        $youtube_url = get_field('youtube_url');
        $self_video = get_field('self_hosted_video');

        // Count views
        $views = get_post_meta(get_the_ID(), 'video_views', true);
        $views = $views ? $views + 1 : 1;
        update_post_meta(get_the_ID(), 'video_views', $views);
        ?>

        <div class="video-player">
            <?php if ($video_type == 'youtube' && $youtube_url): ?>
                <iframe width="100%" height="500" src="<?php echo esc_url($youtube_url); ?>" frameborder="0" allowfullscreen></iframe>
            <?php elseif ($self_video): ?>
                <video controls width="100%" height="auto">
                    <source src="<?php echo esc_url($self_video['url']); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            <?php endif; ?>
        </div>

        <p class="video-views">Views: <?php echo $views; ?></p>

        <?php if ($video_type == 'self_hosted' && get_field('social_sharing')): ?>
            <div class="video-share">
                <p>Share this video:</p>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank">Facebook</a> |
                <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank">Twitter</a>
            </div>
        <?php endif; ?>

        <?php if ($video_type == 'self_hosted' && get_field('enable_comments')): ?>
            <div class="video-comments">
                <?php comments_template(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
    </div>
</section>