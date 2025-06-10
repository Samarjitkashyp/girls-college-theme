<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <header id="header-wrapper" class="site-header">
        <div id="top-header">
            <div class="top-left-item">
                <ul>
                    <li><i class="fa-solid fa-square-phone"></i><a href="#">+91-86388-94558</a></li>
                    <li><i class="fa-solid fa-envelope-circle-check"></i><a href="#">+91-86388-94558</a></li>
                </ul>
            </div>
            <div class="top-right-item">
                <ul>
                    <li><i class="fa-brands fa-square-facebook"></i><a href="#"></a></li>
                    <li><i class="fa-brands fa-square-instagram"></i><a href="#"></a></li>
                    <li><i class="fa-brands fa-linkedin"></i><a href="#"></a></li>
                </ul>
            </div>
        </div>

    <nav class="navbar navbar-expand-lg main-header">
            <div class="logo-container">
                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php 
                        // if ( has_custom_logo() ) {
                        //     the_custom_logo();
                        // } else {
                        //     bloginfo( 'name' );
                        // }
                        ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/main-logo.jpg" alt="Logo" class="main-logo">
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse me-5" id="main-menu">
                    <?php
                    wp_nav_menu( array(
                        'theme_location'  => 'primary',
                        'depth'           => 3,
                        'container'       => false,
                        'menu_class'      => 'navbar-nav ms-auto mb-2 mb-lg-0',
                        // 'fallback_cb'     => '__return_false',
                        'walker'          => new bootstrap_5_wp_nav_menu_walker(),
                    ) );
                    ?>

            </div>   

            <button class="alumni-btn"><a href="#">Alumni</a></button>
        </nav>
    </header>

<main id="site-content">
