<?php
$bg = get_field('hero_bg');
$title = get_field('hero_title');
$desc = get_field('hero_description');
$logos = get_field('hero_logos');
$primary_button = get_field('hero_primary_button'); 
?>
<section class="hero-section">
  <div class="container">
  <div class="hero" style="background-image:url('<?php echo esc_url($bg['url'] ?? ''); ?>')">
    <div class="hero-inner">
      <div class="w-80">
        <?php if ($title): ?>
          <h1 class="hero-title font" data-aos="fade-up">
            <?php echo esc_html($title); ?>
          </h1>
        <?php endif; ?>
      </div>
      <div class="w-80">
        <?php if ($desc): ?>
          <p class="hero-desc" data-aos="fade-up" data-aos-delay="120">
            <?php echo esc_html($desc); ?>
          </p>
        <?php endif; ?>
      </div>
      <div class="hero-btns" data-aos="fade-up" data-aos-delay="250">
        <?php if ($primary_button): ?>
          <a href="<?php echo esc_url($primary_button['url']); ?>"
             class="btn btn-primary"
             <?php if ($primary_button['target']) echo 'target="'.esc_attr($primary_button['target']).'"'; ?>>
            <?php echo esc_html($primary_button['title']); ?>
          </a>
        <?php endif; ?>
      </div>
      <?php if ($logos): ?>
        <div class="hero-logos" data-aos="fade-up" data-aos-delay="350">
          <?php foreach ($logos as $i => $item): ?>
            <?php if (!empty($item['logo'])): ?>
              <img src="<?php echo esc_url($item['logo']['url']); ?>"
                   alt="logo"
                   class="hero-logo-img"
                   data-aos="fade-up"
                   data-aos-delay="<?php echo 350+($i*70); ?>"
                   loading="lazy">
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
  </div>
</section>
