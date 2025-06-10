<?php
/* Template Name: Photo Gallery */
get_header(); 
?>


<?php get_template_part('template-parts/subpage-header'); ?>

<section id="page-content">
    <div class="subpage-content-wrapper">
        <?php
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
        ?>

        <div class="gallery-container">
        <?php
        $gallery_images = get_field('gallery_images');
        if ($gallery_images):
            foreach ($gallery_images as $image): ?>
                <a href="<?php echo esc_url($image['url']); ?>" data-lightbox="gallery" class="gallery-item">
                    <img src="<?php echo esc_url($image['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                </a>
            <?php endforeach;
        else:
            echo '<p style="text-align:center;">No gallery images found. Please upload via ACF.</p>';
        endif;
        ?>
    </div>
    </div>
</section>


<?php get_footer(); ?>
