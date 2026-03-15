<?php
/**
 * Footer variant for Gatekeeper templates with contact information.
*/
?>

    </div><!-- /#smooth-content -->
</div><!-- /#smooth-wrapper -->

<footer class="titan-gatekeeper-footer">
    <div class="footer-wrapper">
        <div class="footer-top">
            <h2 class="footer-title">Kontaktirajte nas</h2>
            <p class="footer-description">Spremni smo da kroz demo prezentaciju uživo prikažemo kako se GateKeeper može primijeniti u vašoj organizaciji.</p>
        </div>
        
        <div class="footer-contacts">
            <div class="contact-box">
                <h3>Stefan Planić</h3>
                <p class="contact-title">CEO</p>
                <div class="contact-info">
                    <a href="mailto:stefan.planic@cleargreen.me" class="contact-link">
                        <i class="ph ph-envelope"></i>
                        stefan.planic@cleargreen.me
                    </a>
                    <a href="tel:+38268090161" class="contact-link">
                        <i class="ph ph-phone"></i>
                        +382 68 090 161
                    </a>
                </div>
            </div>
            
            <div class="contact-box">
                <h3>Tamara Knežević</h3>
                <p class="contact-title">BDM</p>
                <div class="contact-info">
                    <a href="mailto:tamara@cleargreen.me" class="contact-link">
                        <i class="ph ph-envelope"></i>
                        tamara@cleargreen.me
                    </a>
                    <a href="tel:+38269533510" class="contact-link">
                        <i class="ph ph-phone"></i>
                        +382 69 533 510
                    </a>
                </div>
            </div>
        </div>
        
        <div class="footer-logos">
            <div class="footer-logo-item">
                <p class="footer-logo-text">Zvanični smo partner kompanije Regula</p>
                <a href="https://www.regulaforensics.com" target="_blank" rel="noopener" class="footer-logo-link">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo/Regula-logo.svg" alt="Regula" class="footer-logo-img">
                </a>
            </div>
            <div class="footer-logo-item">
                <p class="footer-logo-text">Član smo Asocijacije menadžera za bezbjednost Crne Gore</p>
                <a href="#" target="_blank" rel="noopener" class="footer-logo-link">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo/asocijacija menadzera.png" alt="Asocijacija Menadžera Bezbednosti Crne Gore" class="footer-logo-img">
                </a>
            </div>
        </div>
        
        <div class="footer-bottom">
            <a href="https://www.cleargreen.me" target="_blank" rel="noopener noreferrer" class="footer-link">
                <i class="ph ph-globe"></i>
                www.cleargreen.me
            </a>
            <p class="footer-copy">&copy; <?php echo date('Y'); ?> Clear Green. Sva prava zadržana.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
