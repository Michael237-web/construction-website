    <!-- ============================================
         FOOTER
         ============================================ -->
    <footer>
        <!-- Top CTA Strip -->
        <div class="footer-cta">
            <div class="footer-cta-inner">
                <div>
                    <h3><?php echo t('footer_cta_title'); ?></h3>
                    <p><?php echo t('footer_cta_sub'); ?></p>
                </div>
                <a href="contact.php" class="btn-primary">
                    <i class="fas fa-paper-plane"></i> <?php echo t('footer_cta_btn'); ?>
                </a>
            </div>
        </div>

        <!-- Main Footer Content -->
        <div class="footer-main">
            <div class="footer-container">

                <!-- Column 1: Brand -->
                <div class="footer-col footer-col-brand">
                    <a href="index.php" class="footer-logo-link">
                        <img src="cfooterlogo.png" alt="Global Contractors" class="footer-logo-img">
                    </a>
                    <p class="footer-about">
                        <?php echo t('footer_about_text'); ?>
                    </p>
                    <div class="footer-social">
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="footer-col">
                    <h3><?php echo t('quick_links'); ?></h3>
                    <ul class="footer-links">
                        <li><a href="index.php"><i class="fas fa-chevron-right"></i> <?php echo t('home'); ?></a></li>
                        <li><a href="company.php"><i class="fas fa-chevron-right"></i> <?php echo t('company'); ?></a></li>
                        <li><a href="services.php"><i class="fas fa-chevron-right"></i> <?php echo t('services'); ?></a></li>
                        <li><a href="portfolio.php"><i class="fas fa-chevron-right"></i> <?php echo t('portfolio'); ?></a></li>
                        <li><a href="resources.php"><i class="fas fa-chevron-right"></i> <?php echo t('resources'); ?></a></li>
                    </ul>
                </div>

                <!-- Column 3: Our Services -->
                <div class="footer-col">
                    <h3><?php echo t('footer_services_title'); ?></h3>
                    <ul class="footer-links">
                        <li><a href="services.php"><i class="fas fa-chevron-right"></i> <?php echo t('footer_service_1'); ?></a></li>
                        <li><a href="services.php"><i class="fas fa-chevron-right"></i> <?php echo t('footer_service_2'); ?></a></li>
                        <li><a href="services.php"><i class="fas fa-chevron-right"></i> <?php echo t('footer_service_3'); ?></a></li>
                        <li><a href="services.php"><i class="fas fa-chevron-right"></i> <?php echo t('footer_service_4'); ?></a></li>
                        <li><a href="services.php"><i class="fas fa-chevron-right"></i> <?php echo t('footer_service_5'); ?></a></li>
                    </ul>
                </div>

                <!-- Column 4: Contact Info -->
                <div class="footer-col">
                    <h3><?php echo t('contact_us'); ?></h3>
                    <ul class="footer-contact">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Upper Hill, Nairobi<br>Kenya</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>info@constractors.com</span>
                        </li>
                        <li>
                            <i class="fas fa-phone-alt"></i>
                            <span>+254 746674121</span>
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            <span><?php echo t('footer_hours'); ?></span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <!-- Bottom Copyright Bar -->
        <div class="footer-bottom">
            <div class="footer-bottom-inner">
                <p>&copy; <?php echo date("Y"); ?> Global Contractors. <?php echo t('footer_all_rights'); ?></p>
                <ul class="footer-legal">
                    <li><a href="privacy.php"><?php echo t('footer_privacy'); ?></a></li>
                    <li><a href="terms.php"><?php echo t('footer_terms'); ?></a></li>
                    
                </ul>
            </div>
        </div>
    </footer>

    <!-- Floating Support Button -->
    <a href="contact.php" class="support-btn">
        <i class="fas fa-headset"></i> <?php echo t('expert_support'); ?>
    </a>

    <!-- Main Script -->
    <script src="script.js"></script>
</body>
</html>