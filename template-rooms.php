<?php
/**
 * Template Name: Rooms Page
 */
get_header(); ?>

<h1>This is the Rooms Page Template</h1>

<section class="rooms-archive">
    <div class="container">
        <h1>Rooms</h1>

        <div class="rooms-list">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
            <div class="room-item">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="room-image">
                        <?php the_post_thumbnail('medium'); ?>
                    </div>
                <?php endif; ?>

                <div class="room-details">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php echo wp_trim_words( get_the_content(), 20 ); ?></p>

                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">View Room</a>
                </div>
            </div>

            <?php endwhile; else : ?>
                <p><?php esc_html_e( 'Sorry, no rooms available.' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
