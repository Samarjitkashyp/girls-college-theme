<!-- Header -->
<?php get_header(); ?>

<!-- Homepage Hero Slider -->
<div id="main-hero-slider-wrapper">
  <?php echo do_shortcode('[smartslider3 slider="2"]');?>
</div>

<!-- Hero Services Section -->
<div id="services-hero-wrapper">
    <div class="services-inner card">
        <h4>Trending Courses</h4>
        <p>Your chance to be a trending expert in Medical industries and make … </p>
        <button class="card-btn"><a href="#">Know More</a></button>
    </div>
    <div class="services-inner card">
        <h4>Awards & Accolads</h4>
        <p>Your chance to be a trending expert in Medical industries and make … </p>
        <button class="card-btn"><a href="#">Know More</a></button>
    </div>
    <div class="services-inner card">
        <h4>Certification</h4>
        <p>AOCN Approved by Govt.of Assam.To Serve Best Academic Service. Our basic goal…</p>
        <button class="card-btn"><a href="#">Know More</a></button>
    </div>
    <div class="services-inner card">
        <h4>Notification</h4>

        <!-- Show Notification Category as a Marquee -->
        <div class="vertical-marquee">
            <ul class="category-post-list-item">
                <?php
                // Get the latest posts from the "notification" category
                $notification_posts = new WP_Query(array(
                    'category_name'  => 'notification', // slug of the category
                    'posts_per_page' => 5,
                    'post_status'    => 'publish',
                ));

                if ($notification_posts->have_posts()) :
                    $post_count = 0;

                    // First loop – show "New" icon only on first post
                    while ($notification_posts->have_posts()) : $notification_posts->the_post();
                        $post_count++;
                        $excerpt = get_the_excerpt();
                        $date = get_the_date('M d, Y'); // Customize format if needed
                        ?>
                        <li>
                            <a href="<?php the_permalink(); ?>">
                                <h4>
                                    <?php the_title(); ?>
                                    <?php if ($post_count === 1): ?>
                                        <span>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/new.gif" alt="New">
                                        </span>
                                    <?php endif; ?>
                                </h4>
                                <?php if (!empty($excerpt)): ?>
                                    <p><?php echo wp_trim_words($excerpt, 3, '...'); ?></p>
                                <?php endif; ?>
                                <small><?php echo esc_html($date); ?></small>
                            </a>
                        </li>
                    <?php endwhile;

                    // Duplicate posts for marquee seamless effect (no "New" icon here)
                    $notification_posts->rewind_posts();
                    while ($notification_posts->have_posts()) : $notification_posts->the_post();
                        $excerpt = get_the_excerpt();
                        $date = get_the_date('M d, Y');
                        ?>
                        <li>
                            <a href="<?php the_permalink(); ?>">
                                <h4><?php the_title(); ?></h4>
                                <?php if (!empty($excerpt)): ?>
                                    <p><?php echo wp_trim_words($excerpt, 3, '...'); ?></p>
                                <?php endif; ?>
                                <small><?php echo esc_html($date); ?></small>
                            </a>
                        </li>
                    <?php endwhile;

                    wp_reset_postdata();
                else : ?>
                    <li><h4>No notifications found.</h4></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<!-- Hero Main Section Start -->
<div id="hero-main-wrapper">
    <div class="hero-img-container">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pldege-2.webp" alt="hero img" class="hero-img">
    </div>
    <div class="hero-content-container">
        <h3 class="hero-main-title">Welcome to Assam Oil College & School of Nursing</h3>
        <p class="hero-main-text">Assam Oil College of Nursing (AOCN) was established with the name of Assam Oil School of Nursing (AOSN), in Digboi on 4th June, 1986 with the sole objective of providing professional training to unemployed girls in the field of nursing which is in very high demand to the society. This institution is recognized by the Indian Nursing Council (INC) a statutory body under the Government of India ..</p>
        <button class="card-btn">Read More</button>
    </div>
</div>

<?php //echo do_shortcode('[testimonial_section]'); ?>
<?php get_template_part( 'template-parts/testimonial' ); ?>

<!-- Footer -->
<?php get_footer(); ?>