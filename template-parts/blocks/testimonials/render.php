<?php
$subtitle = get_field('testimonials_subtitle');
$title = get_field('testimonials_title');
$button = get_field('testimonials_button');
$list = get_field('testimonials_list');
?>
<section class="testimonials-section">
  <div class="testimonials-2x2grid">
    <div class="testimonials-meta" data-aos="fade-right">
      <?php if ($subtitle): ?>
        <div class="testimonials-subtitle"><span></span><?php echo esc_html($subtitle); ?></div>
      <?php endif; ?>
      <?php if ($title): ?>
        <h2 class="testimonials-title h2"><?php echo esc_html($title); ?></h2>
      <?php endif; ?>
      <!--
      <?php if ($button): ?>
        <a href="<?php echo esc_url($button['url']); ?>" class="btn btn-primary testimonials-button"
           <?php if ($button['target']) echo 'target="'.esc_attr($button['target']).'"'; ?>>
          <?php echo esc_html($button['title']); ?> &rarr;
        </a>
      <?php endif; ?>
      -->
    </div>

    <?php if (!empty($list)) : ?>
      <?php foreach ($list as $i => $item) : ?>
        <div class="testimonial-card" data-aos="fade-up" data-aos-delay="<?php echo $i * 80; ?>">
          <div class="testimonial-card-head">
            <?php if (!empty($item['logo'])): ?>
              <img src="<?php echo esc_url($item['logo']['url']); ?>" alt="" class="testimonial-logo" loading="lazy">
            <?php endif; ?>
            <span class="testimonial-company"><?php echo esc_html($item['company']); ?></span>
          </div>
          <div class="testimonial-quote-title">
            "<?php echo esc_html($item['quote_title']); ?>"
          </div>
          <div class="testimonial-quote-text">
            <?php echo esc_html($item['quote_text']); ?>
          </div>
          <div class="testimonial-person">
            <?php if (!empty($item['person_image'])): ?>
              <img src="<?php echo esc_url($item['person_image']['url']); ?>" alt="" class="testimonial-person-img" loading="lazy">
            <?php endif; ?>
            <div class="testimonial-person-meta">
              <div class="testimonial-person-name"><?php echo esc_html($item['person_name']); ?></div>
              <div class="testimonial-person-role"><?php echo esc_html($item['person_role']); ?></div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>
