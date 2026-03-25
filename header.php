<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
  <div class="container header-inner">
    <div class="site-branding">
      <?php
$is_gatekeeper_brand = function_exists('asenvirocon_is_page_template_slug')
  && (asenvirocon_is_page_template_slug('gatekeepeer.php') || asenvirocon_is_page_template_slug('gatekeeper-titan.php'));

if ($is_gatekeeper_brand):
  // Proveri da li postoji logo u Customizeru
  $gatekeeper_logo_id = '';
  if (asenvirocon_is_page_template_slug('gatekeeper-titan.php')) {
    $gatekeeper_logo_id = get_theme_mod('gatekeeper_titan_logo');
  }
  else {
    $gatekeeper_logo_id = get_theme_mod('gatekeeper_logo');
  }

  if ($gatekeeper_logo_id) {
    $gatekeeper_logo_url = wp_get_attachment_image_url($gatekeeper_logo_id, 'full');
  }
  else {
    // Fallback na novi Gatekeeper logo ako nije postavljen u Customizeru
    $gatekeeper_logo_url = get_stylesheet_directory_uri() . '/assets/images/logo/viber_image_2026-01-26_00-48-16-760.png';
  }
?>
        <a class="custom-logo-link" href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="Gatekeeper">
          <img src="<?php echo esc_url($gatekeeper_logo_url); ?>" class="custom-logo" alt="Gatekeeper logo">
        </a>
      <?php
elseif (has_custom_logo()): ?>
        <?php the_custom_logo(); ?>
      <?php
else: ?>
        <span class="site-title"><?php bloginfo('name'); ?></span>
      <?php
endif; ?>
    </div>
    <button class="hamburger" aria-label="Open menu" aria-controls="site-menu" aria-expanded="false">
      <span></span>
      <span></span>
      <span></span>
    </button>
    <nav class="main-nav" aria-label="Main Menu">
      <ul class="menu-list">
        <li><a href="<?php echo esc_url(home_url('/#hero')); ?>">Početna</a></li>
        <li><a href="<?php echo esc_url(home_url('/#o-nama')); ?>">O nama</a></li>
        <li class="menu-item-has-children">
          <a href="<?php echo esc_url(home_url('/#usluge')); ?>">Usluge</a>
          <ul>
            <li><a href="<?php echo esc_url(home_url('/gate-keeper/')); ?>">GateKeeper</a></li>
          </ul>
        </li>
        <li><a href="<?php echo esc_url(home_url('/#proces')); ?>">Proces</a></li>
        <li><a href="<?php echo esc_url(home_url('/#kontakt')); ?>">Kontakt</a></li>
      </ul>
    </nav>
    <a href="#contact" class="btn btn-primary header-cta">Get in Touch →</a>
  </div>

  <!-- Fullscreen Mobile Overlay Menu -->
  <div class="mobile-overlay-menu" id="mobileMenu">
    <div class="mobile-overlay-header">
      <div class="mobile-overlay-logo">
        <?php if (!empty($is_gatekeeper_brand) && $is_gatekeeper_brand):
  // Proveri da li postoji logo u Customizeru
  $mobile_gatekeeper_logo_id = '';
  if (asenvirocon_is_page_template_slug('gatekeeper-titan.php')) {
    $mobile_gatekeeper_logo_id = get_theme_mod('gatekeeper_titan_logo');
  }
  else {
    $mobile_gatekeeper_logo_id = get_theme_mod('gatekeeper_logo');
  }

  if ($mobile_gatekeeper_logo_id) {
    $mobile_gatekeeper_logo_url = wp_get_attachment_image_url($mobile_gatekeeper_logo_id, 'full');
  }
  else {
    // Fallback na novi Gatekeeper logo ako nije postavljen u Customizeru
    $mobile_gatekeeper_logo_url = get_stylesheet_directory_uri() . '/assets/images/logo/viber_image_2026-01-26_00-48-16-760.png';
  }
?>
          <a class="custom-logo-link" href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="Gatekeeper">
            <img src="<?php echo esc_url($mobile_gatekeeper_logo_url); ?>" class="custom-logo" alt="Gatekeeper logo">
          </a>
        <?php
elseif (has_custom_logo()):
  the_custom_logo();
else: ?>
          <span class="site-title"><?php bloginfo('name'); ?></span>
        <?php
endif; ?>
      </div>
    </div>
    <nav class="mobile-overlay-nav">
      <ul class="mobile-menu-list">
        <li><a href="<?php echo esc_url(home_url('/#hero')); ?>">Početna</a></li>
        <li><a href="<?php echo esc_url(home_url('/#o-nama')); ?>">O nama</a></li>
        <li class="menu-item-has-children">
          <a href="<?php echo esc_url(home_url('/#usluge')); ?>">Usluge</a>
          <ul>
            <li><a href="<?php echo esc_url(home_url('/gate-keeper/')); ?>">GateKeeper</a></li>
          </ul>
        </li>
        <li><a href="<?php echo esc_url(home_url('/#proces')); ?>">Proces</a></li>
        <li><a href="<?php echo esc_url(home_url('/#kontakt')); ?>">Kontakt</a></li>
      </ul>
    </nav>
  </div>
</header>

