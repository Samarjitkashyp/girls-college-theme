</main><!-- #site-content -->

<!-- Footer -->
<!-- <footer class="site-footer bg-dark text-white py-4 mt-5">
    <div class="container text-center">
        <p class="mb-0">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
    </div>

</footer> -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const scrollTopBtn = document.getElementById("scrollTopBtn");

    // Show/hide button on scroll
    window.addEventListener("scroll", function () {
        if (window.scrollY > 300) {
            scrollTopBtn.style.display = "block";
        } else {
            scrollTopBtn.style.display = "none";
        }
    });

    // Scroll to top
    scrollTopBtn.addEventListener("click", function () {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
});
</script>


<footer class="site-footer bg-dark text-white">
    <div class="footer-container">
        <!-- About -->
        <div class="footer-card">
            <h4 class="foo-title">About AOCN</h4>
            <p>The Assam Oil College of Nursing and Assam Oil School of Nursing is located next to the IOCL (AOD) Hospital in Digboi.</p>
        </div>

        <!-- Opening Hours -->
        <div class="footer-card">
            <h4 class="foo-title">Opening Hours</h4>
            <p>Call us at 03751-269695 during normal hours:</p>
            <ul>
                <li>Mon - Fri: 8AM - 4:30PM</li>
                <li>Saturday: 8AM - 1PM</li>
                <li>Sunday: Closed</li>
            </ul>
        </div>

        <!-- Links -->
        <div class="footer-card">
            <h4 class="foo-title">Quick Links</h4>
            <div class="footer-menu">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Course</a></li>
                    <li><a href="#">Admission</a></li>
                </ul>
                <ul>
                    <li><a href="#">Gallery</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Alumni</a></li>
                </ul>
            </div>
        </div>

        <!-- Newsletter -->
        <div class="footer-card">
            <h4 class="foo-title">Newsletter</h4>
            <p>Subscribe to our newsletter for updates.</p>
            <form class="footer-form">
                <input type="email" placeholder="Your email" required>
                <button type="submit">Subscribe</button>
            </form>

            <!-- Social Icons -->
            <div class="footer-social">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> AOCN Dibrugarh. All Rights Reserved.</p>
        <button id="scrollTopBtn" aria-label="Scroll to top">&#8679;</button>
    </div>
</footer>


<?php wp_footer(); ?>
</body>
</html>
