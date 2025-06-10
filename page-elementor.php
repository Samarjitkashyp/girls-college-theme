<?php
/**
 * Template Name: Elementor Full Width
 */

get_header();
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main">
    <?php
    while ( have_posts() ) :
      the_post();
      the_content(); // This is where Elementor content will render
    endwhile;
    ?>
  </main>
</div>

<?php get_footer(); ?>
