<?php
$subtitle = get_field('about_subtitle');
$title = get_field('about_title');
$desc = get_field('about_desc');
$img_left = get_field('about_img_left');    // Glavna velika slika ispod teksta
$img_right_top = get_field('about_img_right_top');  // Prva desna slika
$img_right_bottom = get_field('about_img_right_bottom'); // Druga desna slika
?>
<section class="about-experts-section">
  <div class="about-experts-flex">
    <!-- Lijevi DIV: tekst + jedna velika slika -->
    <div class="about-experts-left">
      <?php if ($subtitle): ?>
        <div class="about-experts-subtitle"><span></span><?php echo esc_html($subtitle); ?></div>
      <?php endif; ?>
      <?php if ($title): ?>
        <h2 class="about-experts-title"><?php echo esc_html($title); ?></h2>
      <?php endif; ?>
      <?php if ($desc): ?>
        <div class="about-experts-desc"><?php echo esc_html($desc); ?></div>
      <?php endif; ?>
      <?php if ($img_left): ?>
        <div class="about-experts-img about-experts-img-left">
          <img src="<?php echo esc_url($img_left['url']); ?>" alt="">
        </div>
      <?php endif; ?>
    </div>
    <!-- Desni DIV: dvije slike -->
    <div class="about-experts-right">
      <?php if ($img_right_top): ?>
        <div class="about-experts-img about-experts-img-right about-experts-img-rt">
          <img src="<?php echo esc_url($img_right_top['url']); ?>" alt="">
        </div>
      <?php endif; ?>
      <?php if ($img_right_bottom): ?>
        <div class="about-experts-img about-experts-img-right about-experts-img-rb">
          <img src="<?php echo esc_url($img_right_bottom['url']); ?>" alt="">
        </div>
      <?php endif; ?>
    </div>
  </div>
  <div class="results-section">
  <div class="results-inner">
    <div class="results-title">Our results measured in numbers:</div>
    <div class="results-grid">
      <div class="results-card">
        <span class="results-value results-red">500<span>+</span></span>
        <div class="results-label">Happy Clients</div>
      </div>
      <div class="results-card">
        <span class="results-value results-purple">200m<span>+</span></span>
        <div class="results-label">Users Acquired</div>
      </div>
      <div class="results-card">
        <span class="results-value results-yellow">250<span>+</span></span>
        <div class="results-label">Team Members</div>
      </div>
      <div class="results-card">
        <span class="results-value results-blue">3,000<span>+</span></span>
        <div class="results-label">Projects Completed</div>
      </div>
    </div>
  </div>
</div>

</section>
