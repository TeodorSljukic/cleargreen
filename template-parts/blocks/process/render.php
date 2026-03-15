<?php
$subtitle = get_field('process_subtitle');
$title = get_field('process_title');
$button = get_field('process_button');
$steps = get_field('process_steps');
?>

<section id="process" class="process-section">
  <div class="container">
    <div class="process-head" data-aos="fade-up">
      <?php if ($subtitle): ?>
        <div class="process-subtitle"><span></span><?php echo esc_html($subtitle); ?></div>
      <?php endif; ?>
      <div class="process-head-flex">
        <?php if ($title): ?>
          <h2 class="process-title h2"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        <?php if ($button): ?>
          <a href="<?php echo esc_url($button['url']); ?>" class="btn btn-primary"
            <?php if ($button['target']) echo 'target="'.esc_attr($button['target']).'"'; ?>>
            <?php echo esc_html($button['title']); ?> &rarr;
          </a>
        <?php endif; ?>
      </div>
    </div>
    <?php if ($steps): ?>
      <div class="process-steps">
        <?php foreach ($steps as $i => $item): ?>
          <div class="process-step" data-aos="fade-up" data-aos-delay="<?php echo $i * 60; ?>">
            <div class="process-step-number"
                style="color: <?php echo esc_attr($item['step_color']); ?>;">
              <?php echo esc_html($item['step_number']); ?>
            </div>
            <div>
              <div class="process-step-title"><?php echo esc_html($item['step_title']); ?></div>
              <div class="process-step-desc"><?php echo esc_html($item['step_desc']); ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
