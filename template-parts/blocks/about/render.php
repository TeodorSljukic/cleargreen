<?php
$images   = get_field('about_images');
$subtitle = get_field('about_subtitle');
$title    = get_field('about_title');
$desc     = get_field('about_description'); // WYSIWYG polje!
$button   = get_field('about_button');      // Link polje
?>

<section id="about" class="about-section">
  <div class="container">
    <div class="about-wrap">
      <!-- Pozadinska blur slika -->
      <div class="about-images-holder" data-aos="fade-right">
        <div class="about-images-bg"
            style="background-image:url('http://asenvirocon.local/wp-content/uploads/2025/06/6064f941a593915ca183858d_bg-home-v3-about-marketing-template-p-1080.jpeg')"></div>
        <?php if ($images && count($images) >= 3): ?>
          <div class="about-images">
            <div class="about-img-main" data-aos="fade-up" data-aos-delay="120">
              <img src="<?php echo esc_url($images[0]['image']['url']); ?>" alt="" class="about-img">
            </div>
            <div class="about-img-col">
              <div class="about-img-mini" data-aos="fade-up" data-aos-delay="210">
                <img src="<?php echo esc_url($images[1]['image']['url']); ?>" alt="" class="about-img">
              </div>
              <div class="about-img-mini" data-aos="fade-up" data-aos-delay="340">
                <img src="<?php echo esc_url($images[2]['image']['url']); ?>" alt="" class="about-img">
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
      <div class="about-content">
        <?php if ($subtitle): ?>
          <div class="about-subtitle" data-aos="fade-left" data-aos-delay="80"><span></span><?php echo esc_html($subtitle); ?></div>
        <?php endif; ?>
        <?php if ($title): ?>
          <h2 class="about-title" data-aos="fade-left" data-aos-delay="170"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        <?php if ($desc): ?>
          <div class="about-paragraphs" data-aos="fade-left" data-aos-delay="260">
            <?php echo wp_kses_post($desc); ?>
          </div>
        <?php endif; ?>
        <div class="hero-btn-abt" data-aos="fade-left" data-aos-delay="330">
          <?php if ($button): ?>
              <a href="<?php echo esc_url($button['url']); ?>"
              class="btn btn-primary"
              <?php if ($button['target']) echo 'target="'.esc_attr($button['target']).'"'; ?>>
              <?php echo esc_html($button['title']); ?>
              </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
