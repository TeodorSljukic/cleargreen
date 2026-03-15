<?php
$subtitle   = get_field('why_subtitle');
$title      = get_field('why_title');
$desc       = get_field('why_description');
$checklist  = get_field('why_checklist');
$image      = get_field('why_image');
$button     = get_field('why_button');
?>

<section class="why-section">
  <div class="container">
  <div class="why-wrap">
    <div class="why-content">
      <?php if ($subtitle): ?>
        <div class="why-subtitle" data-aos="fade-right"><?php /* left/right po želji */ ?>
          <span></span><?php echo esc_html($subtitle); ?>
        </div>
      <?php endif; ?>
      <?php if ($title): ?>
        <h2 class="why-title" data-aos="fade-right" data-aos-delay="100">
          <?php echo esc_html($title); ?>
        </h2>
      <?php endif; ?>
      <?php if ($desc): ?>
        <div class="why-desc" data-aos="fade-right" data-aos-delay="180">
          <?php echo wp_kses_post($desc); ?>
        </div>
      <?php endif; ?>
      <?php if ($checklist): ?>
        <ul class="why-list" data-aos="fade-right" data-aos-delay="260">
          <?php foreach ($checklist as $i => $item): ?>
            <li data-aos="fade-up" data-aos-delay="<?php echo 300+($i*60); ?>">
              <span class="why-list-icon">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                  <circle cx="16" cy="16" r="16" fill="#bcd642"/>
                  <path d="M10 17.5l4 4 8-8" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
              <span><?php echo esc_html($item['item_text']); ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <div class="hero-btn-why" data-aos="fade-right" data-aos-delay="320">
        <?php if ($button): ?>
          <a href="<?php echo esc_url($button['url']); ?>"
            class="btn btn-primary"
            <?php if ($button['target']) echo 'target="'.esc_attr($button['target']).'"'; ?>>
            <?php echo esc_html($button['title']); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
    <div class="why-img-side" data-aos="fade-left">
      <div class="why-img-frame">
        <!-- <div class="why-img-bg-rotate" data-aos="zoom-in" data-aos-delay="130">
          <img src="http://asenvirocon.local/wp-content/uploads/2025/06/6064f88ad4cd405e6dbc5dd3_bg-home-v3-advantage-marketing-template.jpg" alt="">
        </div> -->
        <img src="<?php echo esc_url($image['url']); ?>" alt="" class="why-img" loading="lazy" data-aos="fade-left" data-aos-delay="210">
      </div>
    </div>
  </div>
  </div>
</section>
