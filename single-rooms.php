<?php
get_header(); ?>

<section class="room-detail">
    <div class="container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <div class="room-header">
            <h1><?php the_title(); ?></h1>
            <?php 
            // Get the ACF fields
            $room_price = get_field('room_price');
            $room_features = get_field('room_features');
            $room_image = get_field('room_image');
            ?>
        </div>

        <div class="room-content">
            <div class="room-image">
                <?php if ( $room_image ) : ?>
                    <img src="<?php echo esc_url($room_image['url']); ?>" alt="<?php echo esc_attr($room_image['alt']); ?>" />
                <?php endif; ?>
            </div>

            <div class="room-description">
                <?php the_content(); ?>
                <?php if ( $room_price ) : ?>
                    <p><strong>Price: </strong>$<?php echo esc_html($room_price); ?> per night</p>
                <?php endif; ?>

                <?php if ( $room_features ) : ?>
                    <h3>Features:</h3>
                    <ul>
                        <?php foreach ( $room_features as $feature ) : ?>
                            <li><?php echo esc_html($feature); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>

        <div class="room-booking">
            <a href="#" class="btn btn-primary">Book Now</a>
        </div>

        <?php endwhile; else : ?>
            <p><?php esc_html_e( 'Sorry, no rooms found.' ); ?></p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
