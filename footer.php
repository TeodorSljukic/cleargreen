<footer class="footer-main">
  <div class="footer-top" style="display:flex; flex-wrap:wrap; justify-content:space-between; gap:40px; width:90%; margin:0 auto;">
    <div class="footer-brand">
      <div class="footer-logo">
        <?php if (has_custom_logo()) : ?>
          <?php the_custom_logo(); ?>
        <?php else : ?>
          <span class="footer-brandname"><?php bloginfo('name'); ?></span>
        <?php endif; ?>
      </div>
      <p class="footer-desc" style="margin-top:12px; font-size:.88rem;">Digitalna identifikacija. Kontrola pristupa. Automatizacija.</p>
    </div>
    <nav class="footer-nav" style="display:flex; gap:24px; flex-wrap:wrap; align-items:center;">
      <a href="#" style="color:rgba(255,255,255,.6); text-decoration:none; font-size:.88rem; font-weight:500;">Početna</a>
      <a href="#o-nama" style="color:rgba(255,255,255,.6); text-decoration:none; font-size:.88rem; font-weight:500;">O nama</a>
      <a href="#usluge" style="color:rgba(255,255,255,.6); text-decoration:none; font-size:.88rem; font-weight:500;">Usluge</a>
      <a href="https://cleargreen.me/gate-keeper/" style="color:rgba(255,255,255,.6); text-decoration:none; font-size:.88rem; font-weight:500;">GateKeeper</a>
      <a href="#proces" style="color:rgba(255,255,255,.6); text-decoration:none; font-size:.88rem; font-weight:500;">Proces</a>
      <a href="#kontakt" style="color:rgba(255,255,255,.6); text-decoration:none; font-size:.88rem; font-weight:500;">Kontakt</a>
    </nav>
    <div class="footer-contact-info" style="font-size:.88rem; color:rgba(255,255,255,.5);">
      <div>stefan.planic@cleargreen.me</div>
      <div>+382 (0) 68 090 161</div>
    </div>
  </div>
  <hr class="footer-sep">
  <div class="footer-bottom">
    <div class="footer-copyright">
      &copy; <?php echo date('Y'); ?> Clear Green d.o.o. Sva prava zadržana.
    </div>
    <div class="footer-social">
      <a href="/" class="footer-social-icon" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
      <a href="/" class="footer-social-icon" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
    </div>
  </div>
</footer>

<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 850,
    easing: 'ease-out-cubic',
    once: true
  });
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-PC9ZCE9HHE"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-PC9ZCE9HHE');
</script>

<?php wp_footer(); ?> 

</body>
</html>
