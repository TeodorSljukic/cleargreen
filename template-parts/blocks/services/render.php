<?php
$subtitle = get_field('services_subtitle');
$title = get_field('services_title');
$list = get_field('services_list');
?>

<section id="services" class="services-section">
  <div class="services-head" data-aos="fade-up">
    <?php if ($subtitle): ?>
      <div class="services-subtitle"><?php echo esc_html($subtitle); ?></div>
    <?php endif; ?>
    <?php if ($title): ?>
      <h2 class="services-title"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>
  </div>
  <?php if ($list): ?>
    <div class="services-grid">
      <?php foreach ($list as $item): ?>
        <div class="services-card" data-aos="fade-up">
          <div class="services-card-icon">
            <?php if (!empty($item['icon'])): ?>
              <img src="<?php echo esc_url($item['icon']['url']); ?>" alt="" loading="lazy">
            <?php endif; ?>
          </div>
          <div class="services-card-content">
            <h3 class="services-card-title"><?php echo esc_html($item['title']); ?></h3>
            <p class="services-card-desc"><?php echo esc_html($item['desc']); ?></p>
            <?php if (!empty($item['link'])): ?>
              <!-- <a href="<?php echo esc_url($item['link']['url']); ?>" class="services-card-link"
                 <?php if ($item['link']['target']) echo 'target="'.esc_attr($item['link']['target']).'"'; ?>>
                Learn More &rarr;
              </a> -->
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>
<div class="cta-float" data-aos="zoom-in" data-aos-delay="200">
  <div class="cta-float-bg"></div>
  <div class="cta-float-content">
    <div class="cta-float-text">
      <strong>Spremni da razvijete svoju kompaniju?<br>Kontaktirajte nas danas!</strong>
    </div>
    <a href="#kontakt" class="cta-float-btn">
      Stupite u kontakt &rarr;
    </a>
  </div>
</div>
