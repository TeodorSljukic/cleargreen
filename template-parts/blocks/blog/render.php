<?php
$subtitle = get_field('blog_subtitle');
$title = get_field('blog_title');
$button = get_field('blog_button');

// WP loop: poslednja 2 posta
$args = [
    'post_type'      => 'post',
    'posts_per_page' => 2,
];
$query = new WP_Query($args);

// Kategorije i njihove boje po slug-u:
$category_colors = [
    'seo'     => '#ff3951',
    'growth'  => '#7c4dff',
    // Dodaj još ako treba
];
?>
<section class="blog-section">
    <div class="blog-header-row" data-aos="fade-up">
      <div class="blog-header-meta">
        <div class="blog-subtitle"><span></span>Blog & News</div>
        <h2 class="blog-title h2">Browse our articles<br>on marketing and growth</h2>
      </div>
      <a href="#" class="btn btn-ghost">Browse Articles</a>
    </div>
  <div class="blog-cards-row">
    <?php
    $blog_query = new WP_Query([
      'post_type' => 'post',
      'posts_per_page' => 2,
      'ignore_sticky_posts' => 1,
    ]);
    $delay = 0;
    while ($blog_query->have_posts()): $blog_query->the_post();
      $cat = get_the_category();
      $badge_name = $cat ? $cat[0]->name : '';
      $badge_color = '#ff3951';
      if ($cat) {
        if ($cat[0]->slug === 'growth') $badge_color = '#7c4dff';
      }
    ?>
      <a href="<?php the_permalink(); ?>" class="blog-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
        <div class="blog-card-image-wrap">
          <?php if (has_post_thumbnail()): ?>
            <img src="<?php the_post_thumbnail_url('large'); ?>" class="blog-card-image" alt="<?php the_title_attribute(); ?>">
          <?php else: ?>
            <img src="https://via.placeholder.com/600x400?text=No+Image" class="blog-card-image" alt="">
          <?php endif; ?>
          <?php if ($badge_name): ?>
            <span class="blog-card-cat" style="background:<?php echo esc_attr($badge_color); ?>">
              <?php echo esc_html($badge_name); ?>
            </span>
          <?php endif; ?>
        </div>
        <div class="blog-card-title"><?php the_title(); ?></div>
        <div class="blog-card-excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 18)); ?></div>
      </a>
    <?php $delay += 90; endwhile; wp_reset_postdata(); ?>
  </div>
</section>
