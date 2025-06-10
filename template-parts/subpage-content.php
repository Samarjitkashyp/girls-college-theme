<section id="page-content">
    <div class="subpage-content-wrapper">
        <?php
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
        ?>
    </div>
</section>