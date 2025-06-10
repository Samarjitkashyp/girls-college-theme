<?php
// Get the featured image or use a default fallback
$bg_image = get_the_post_thumbnail_url();
if (!$bg_image) {
    // You can place a default image inside your theme's /assets/images/ folder
    $bg_image = get_template_directory_uri() . '/assets/images/default-subpage.jpg';
}
?>

<section id="subpage-header" style="background-image: url('<?php echo esc_url($bg_image); ?>');">
    <div class="overlay"></div>
    <h2><?php the_title(); ?></h2>

    <div class="subpage-breadcurm">
        <span>
            <ul>
                <li><a href="<?php echo home_url(); ?>">Home</a></li>
                <li><?php the_title(); ?></li>
            </ul>
        </span>
    </div>
</section>
