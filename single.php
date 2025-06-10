<?php
get_header(); // Always include this at the top

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        the_content(); // Elementor replaces this
    endwhile;
endif;

get_footer(); // Always include this at the bottom

