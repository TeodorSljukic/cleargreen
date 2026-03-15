<?php
$mission_subtitle = get_field('mission_subtitle');
$mission_title = get_field('mission_title');
$mission_desc = get_field('mission_desc');
$mission_img1 = get_field('mission_img1');
$mission_img2 = get_field('mission_img2');
?>
<section class="mission-section">
  <div class="mission-container">
    <div class="mission-left">
      <?php if ($mission_subtitle): ?>
        <div class="mission-subtitle"><span></span><?php echo esc_html($mission_subtitle); ?></div>
      <?php endif; ?>
      <?php if ($mission_title): ?>
        <h2 class="mission-title"><?php echo esc_html($mission_title); ?></h2>
      <?php endif; ?>
      <?php if ($mission_desc): ?>
        <div class="mission-desc"><?php echo wp_kses_post($mission_desc); ?></div>
      <?php endif; ?>
    </div>
    <div class="mission-right">
      <div class="mission-img-group">
        <?php if ($mission_img1): ?>
          <img src="<?php echo esc_url($mission_img1['url']); ?>" alt="" class="mission-img mission-img1">
        <?php endif; ?>
        <?php if ($mission_img2): ?>
          <img src="<?php echo esc_url($mission_img2['url']); ?>" alt="" class="mission-img mission-img2">
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
