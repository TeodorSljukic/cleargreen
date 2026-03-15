<!DOCTYPE html>
<html lang="en" class="home-three crm-page">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Gatekeeper">
    <meta name="keywords" content="Gatekeeper">
    <meta name="robots" content="INDEX,FOLLOW">

    <?php wp_head(); ?>
</head>
<body <?php body_class('home-three crm-page'); ?>>
<?php wp_body_open(); ?>

<!--==================== Overlay Start ====================-->
<div class="overlay"></div>
<!--==================== Overlay End ====================-->

<!--==================== Sidebar Overlay End ====================-->
<div class="side-overlay"></div>
<!--==================== Sidebar Overlay End ====================-->

<!-- Custom Toast Message start -->
<div id="toast-container"></div>
<!-- Custom Toast Message End -->

<!-- ==================== Scroll to Top End Here ==================== -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<!-- ==================== Scroll to Top End Here ==================== -->

<!-- Custom Cursor Start -->
<div class="cursor"></div>
<span class="dot"></span>
<!-- Custom Cursor End -->

<!-- ==================== Mobile Menu Start Here ==================== -->
<div class="mobile-menu d-lg-none d-block scroll-sm position-fixed tw-w-300-px tw-h-screen overflow-y-auto tw-p-6 tw-z-999 tw--translate-x-full tw-pb-68 ">
        <button type="button"
            class="close-button position-absolute tw-end-0 top-0 tw-me-2 tw-mt-2 tw-w-605 tw-h-605 rounded-circle d-flex justify-content-center align-items-center">
        <i class="ph ph-x"></i>
    </button>

    <div class="mobile-menu__inner">
        <a href="#home" class="mobile-menu__logo">
            <?php
            // Proveri koji template se koristi i učitaj odgovarajući logo
            $is_titan_mobile = function_exists('asenvirocon_is_page_template_slug') && asenvirocon_is_page_template_slug('gatekeeper-titan.php');
            $mobile_gatekeeper_logo_id = $is_titan_mobile ? get_theme_mod('gatekeeper_titan_logo') : get_theme_mod('gatekeeper_logo');
            
            if ($mobile_gatekeeper_logo_id) {
                $mobile_gatekeeper_logo_url = wp_get_attachment_image_url($mobile_gatekeeper_logo_id, 'full');
            } else {
                // Fallback na novi Gatekeeper logo ako nije postavljen u Customizeru
                $mobile_gatekeeper_logo_url = get_stylesheet_directory_uri() . '/assets/images/logo/Gatekeeper logo novi.png';
            }
            ?>
            <img src="<?php echo esc_url($mobile_gatekeeper_logo_url); ?>" alt="Logo">
        </a>
        <div class="mobile-menu__menu">
            <ul class="nav-menu d-lg-flex align-items-center nav-menu--mobile d-block tw-mt-8">
                <li class="nav-menu__item">
                    <a href="#home" class="nav-menu__link hover--translate-y-1 tw-pe-5 text-heading tw-py-9 fw-semibold w-100">Naslovna</a>
                </li>
                <li class="nav-menu__item">
                    <a href="#references" class="nav-menu__link hover--translate-y-1 tw-pe-5 text-heading tw-py-9 fw-semibold w-100">Povjerenje</a>
                </li>
                <li class="nav-menu__item">
                    <a href="#process" class="nav-menu__link hover--translate-y-1 tw-pe-5 text-heading tw-py-9 fw-semibold w-100">Kako radi</a>
                </li>
                <li class="nav-menu__item">
                    <a href="#regula" class="nav-menu__link hover--translate-y-1 tw-pe-5 text-heading tw-py-9 fw-semibold w-100">Regula</a>
                </li>
                <li class="nav-menu__item">
                    <a href="#testimonials" class="nav-menu__link hover--translate-y-1 tw-pe-5 text-heading tw-py-9 fw-semibold w-100">Šta su rekli</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- ==================== Mobile Menu End Here ==================== -->

<div id="smooth-wrapper">
    <!-- ==================== Header Three Start Here ==================== -->
    <header class="header py-0 top-0 tw-start-0 tw-end-0 w-100 tw-z-99 tw-mt-8 position-absolute">
        <div class="container">
            <div class="header-three__inner py-2 py-lg-0 tw-lg-ps-12 ps-4 tw-pe-705 bg-white-06 transition-all tw-rounded-lg common-shadow-eleven">
                <nav class="d-flex align-items-center justify-content-between position-relative">
                    <!-- Logo Start -->
                    <div class="logo">
                        <a href="#home" class="link hover--translate-y-1 active--translate-y-scale-9">
                            <?php
                            // Proveri koji template se koristi i učitaj odgovarajući logo
                            $is_titan = function_exists('asenvirocon_is_page_template_slug') && asenvirocon_is_page_template_slug('gatekeeper-titan.php');
                            $gatekeeper_logo_id = $is_titan ? get_theme_mod('gatekeeper_titan_logo') : get_theme_mod('gatekeeper_logo');
                            
                            if ($gatekeeper_logo_id) {
                                $gatekeeper_logo_url = wp_get_attachment_image_url($gatekeeper_logo_id, 'full');
                            } else {
                                // Fallback na bijeli logo za normalni header
                                $gatekeeper_logo_url = get_stylesheet_directory_uri() . '/assets/images/logo/viber_image_2026-01-26_00-48-16-760.png';
                            }
                            // Logo za sticky header
                            $sticky_logo_url = get_stylesheet_directory_uri() . '/assets/images/logo/Gatekeeper logo novi.png';
                            ?>
                            <img src="<?php echo esc_url($gatekeeper_logo_url); ?>" 
                                 data-sticky-logo="<?php echo esc_url($sticky_logo_url); ?>" 
                                 data-normal-logo="<?php echo esc_url($gatekeeper_logo_url); ?>"
                                 alt="Logo" 
                                 class="max-w-200-px header-logo">
                        </a>
                    </div>
                    <!-- Logo End  -->

                    <!-- Menu Start  -->
                    <div class="header-menu d-lg-block d-none">
                        <ul class="nav-menu d-lg-flex align-items-center tw-gap-7">
                            <li class="nav-menu__item">
                                <a href="#home" class="nav-menu__link hover--translate-y-1 tw-pe-5 text-heading tw-py-9 fw-semibold w-100">Naslovna</a>
                            </li>
                            <li class="nav-menu__item">
                                <a href="#references" class="nav-menu__link hover--translate-y-1 tw-pe-5 text-heading tw-py-9 fw-semibold w-100">Povjerenje</a>
                            </li>
                            <li class="nav-menu__item">
                                <a href="#process" class="nav-menu__link hover--translate-y-1 tw-pe-5 text-heading tw-py-9 fw-semibold w-100">Kako radi</a>
                            </li>
                            <li class="nav-menu__item">
                                <a href="#regula" class="nav-menu__link hover--translate-y-1 tw-pe-5 text-heading tw-py-9 fw-semibold w-100">Regula</a>
                            </li>
                            <li class="nav-menu__item">
                                <a href="#testimonials" class="nav-menu__link hover--translate-y-1 tw-pe-5 text-heading tw-py-9 fw-semibold w-100">Šta su rekli</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Menu End  -->

                    <!-- Header Right start -->
                    <div class="d-flex align-items-center tw-gap-6">
                        <a href="#contact"
                            class="hover--translate-y-1 active--translate-y-scale-9 btn btn-main-two hover-style-two button--stroke d-lg-flex d-none align-items-center justify-content-center tw-gap-5 group active--translate-y-2 px-xl-4 px-3 tw-rounded-md tw-py-405 fw-bold"
                            data-block="button">
                            <span class="button__flair"></span>
                            <div class="d-flex align-items-center tw-gap-2 z-1">
                                <span class="button__label">Kontakt</span>
                                <span class="icon z-1"><i class="ph-fill ph-envelope"></i></span>
                            </div>
                        </a>
                        <button type="button" class="toggle-mobileMenu leading-none d-lg-none hamburger-white tw-text-9">
                            <i class="ph ph-list"></i>
                        </button>
                    </div>
                    <!-- Header Right End  -->
                </nav>
            </div>
        </div>
    </header>
    <!-- ==================== Header Three End Here ==================== -->

    <div id="smooth-content">

