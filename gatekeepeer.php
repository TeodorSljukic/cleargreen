<?php
/*
Template Name: Gatekeeper
*/

// Koristi custom header za Gatekeeper
if (file_exists(get_stylesheet_directory() . '/header-gatekeeper.php')) {
    include(get_stylesheet_directory() . '/header-gatekeeper.php');
} else {
    get_header();
}
?>

    <!-- Header + overlays + mobile menu + wrappers are now in header-gatekeeper.php -->

            <!-- ============================== Banner Three Section start ========================== -->
            <section id="home" class="banner-three gradient-bg-five position-relative z-1 overflow-hidden">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/shapes/cloud-sky.png" alt="Cloud Shape"
                    class="position-absolute top-50 tw-end-0 left-right-scale-animation d-sm-block d-none z-n1">

                <div class="container">
                    <div class="row gy-5">
                        <div class="col-lg-6">
                            <div class="banner-three-content max-w-570-px">
                                <h1 class="splitTextStyleOne text-white text-capitalize tw-leading-none">
                                    <?php echo wp_kses_post(bcms_get('bcms_gko_hero_title', 'Digitalizujte upravljanje
                                    <span
                                        class="text-gradient-teal font-dm-serif fst-italic fw-normal">posjetiocima</span>
                                    sa GateKeeper')); ?>
                                </h1>
                                <p class="splitTextStyleOne text-white tw-text-lg tw-mt-8">
                                    <?php echo wp_kses_post(bcms_get('bcms_gko_hero_desc', 'Napredna <span class="text-yellow">SaaS aplikacija</span> za kontrolu pristupa, identifikaciju posjetilaca i automatizaciju procesa upravljanja posjetama u vašoj instituciji')); ?>
                                </p>

                                <div class="d-flex align-items-center tw-gap-7 tw-mt-11" data-aos="fade-up"
                                    data-aos-anchor-placement="top-bottom" data-aos-duration="800">
                                    <a href="javascript:void(0)"
                                        class="hover--translate-y-1 active--translate-y-scale-9 btn btn-main hover-style-one button--stroke align-items-center justify-content-center tw-gap-5 group active--translate-y-2 tw-px-13 tw-rounded-md tw-py-6 fw-bold"
                                        data-block="button">
                                        <span class="button__flair"></span>
                                        <div class="d-flex align-items-center tw-gap-2 z-1">
                                            <span class="button__label"><?php echo esc_html(bcms_get('bcms_gko_hero_btn_text', 'Kontaktirajte nas')); ?></span>
                                            <span class="icon z-1">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/download-cloud-icon.png" alt="Icon">
                                            </span>
                                        </div>
                                    </a>
                                </div>

                                <div class="d-flex align-items-center tw-gap-7 tw-mt-10">
                                    <div class="d-flex align-items-center tw-gap-205" data-aos="fade-up"
                                        data-aos-anchor-placement="top-bottom" data-aos-duration="700">
                                        <span
                                            class="tw-w-7 tw-h-7 bg-white-08 rounded-circle d-flex justify-content-center align-items-center tw-text-sm text-white">
                                            <i class="ph-bold ph-check"></i>
                                        </span>
                                        <span class="text-white"><?php echo esc_html(bcms_get('bcms_gko_hero_check1', 'GDPR usklađeno')); ?></span>
                                    </div>
                                    <div class="d-flex align-items-center tw-gap-205" data-aos="fade-up"
                                        data-aos-anchor-placement="top-bottom" data-aos-duration="800">
                                        <span
                                            class="tw-w-7 tw-h-7 bg-white-08 rounded-circle d-flex justify-content-center align-items-center tw-text-sm text-white">
                                            <i class="ph-bold ph-check"></i>
                                        </span>
                                        <span class="text-white"><?php echo esc_html(bcms_get('bcms_gko_hero_check2', 'Sigurno i pouzdano')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="banner-three-thumb position-lg-absolute tw-end-0 bottom-0 max-w-58-percent">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/thumbs/banner-three-img.png" alt="Thumb" data-aos="fade-left"
                                    data-aos-duration="700">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ============================== Banner Three Section End ========================== -->

            <!-- ========================== UVOD Section Start ========================= -->
            <section id="uvod" class="introduction-section py-120 position-relative">
                <div class="container">
                    <div class="row align-items-center gy-5">
                        <div class="col-lg-6">
                            <div class="introduction-image-wrapper" data-aos="fade-right" data-aos-duration="700">
                                <div class="introduction-image-placeholder">
                                    <?php 
                                    $intro_image = get_stylesheet_directory_uri() . '/assets/images/thumbs/gatekeeper-intro.png';
                                    if (file_exists(get_stylesheet_directory() . '/assets/images/thumbs/gatekeeper-intro.png')): ?>
                                        <img src="<?php echo esc_url($intro_image); ?>" alt="GateKeeper Introduction" class="img-fluid rounded-lg">
                                    <?php else: ?>
                                        <div class="image-placeholder-content">
                                            <i class="ph ph-image" style="font-size: 64px; color: #ccc;"></i>
                                            <p class="mt-3 text-neutral-400">Slika će biti dodata ovde</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="introduction-content" data-aos="fade-left" data-aos-duration="700">
                                <div class="section-badge mb-4">
                                    <span class="badge-text"><?php echo esc_html(bcms_get('bcms_gko_intro_badge', 'O GateKeeper-u')); ?></span>
                                </div>
                                <h2 class="introduction-title mb-4">
                                    <?php echo wp_kses_post(bcms_get('bcms_gko_intro_title', 'Napredna <span class="text-gradient-teal">SaaS aplikacija</span> za upravljanje posjetiocima')); ?>
                                </h2>
                                <div class="introduction-text">
                                    <p class="text-neutral-500 fw-medium mb-4">
                                        <?php echo wp_kses_post(bcms_get('bcms_gko_intro_p1', '<strong>GateKeeper</strong> je napredna <strong>SaaS aplikacija</strong> razvijena za digitalizaciju i standardizaciju upravljanja posjetiocima u institucijama.')); ?>
                                    </p>
                                    <p class="text-neutral-500 fw-medium mb-4">
                                        <?php echo wp_kses_post(bcms_get('bcms_gko_intro_p2', 'U saradnji sa <strong>Regula Forensics</strong>, globalnim liderom u oblasti forenzičke opreme i softvera za verifikaciju dokumenata, <strong>GateKeeper garantuje</strong> preciznu identifikaciju i sigurnosne provjere posjetilaca.')); ?>
                                    </p>
                                    <p class="text-neutral-500 fw-medium mb-4">
                                        <?php echo wp_kses_post(bcms_get('bcms_gko_intro_p3', 'Sistem omogućava jednostavno i sigurno <strong>praćenje ulazaka i izlazaka</strong>, centralizovano <strong>zakazivanje</strong> sastanaka i kompletnu <strong>evidenciju</strong> svih posjetilaca u realnom vremenu.')); ?>
                                    </p>
                                    <p class="text-neutral-500 fw-medium mb-4">
                                        <?php echo wp_kses_post(bcms_get('bcms_gko_intro_p4', 'Aplikacija <strong>zamjenjuje manuelne</strong> procese na recepciji, smanjuje administrativno opterećenje zaposlenih i osigurava veću transparentnost unutar objekta.')); ?>
                                    </p>
                                    <p class="text-neutral-500 fw-medium mb-4">
                                        <?php echo wp_kses_post(bcms_get('bcms_gko_intro_p5', 'GateKeeper radi na principu minimalnih podataka i u potpunosti je usklađen sa <strong>Zakonom o zaštiti ličnih podataka</strong>, dizajniran da podrži organizacije sa visokim sigurnosnim zahtjevima.')); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ========================== UVOD Section End ========================= -->

            <!-- ============================ U upotrebi kod sekcija =========================== -->
            <section class="clients-section py-120">
                <div class="container">
                    <!-- U upotrebi kod sekcija - Logoi kompanija -->
                    <div class="clients-section-header text-center mb-5">
                        <div class="section-badge mb-3">
                            <span class="badge-text"><?php echo esc_html(bcms_get('bcms_gko_clients_badge', 'Naši klijenti')); ?></span>
                        </div>
                        <h2 class="clients-section-title">
                            <?php echo esc_html(bcms_get('bcms_gko_clients_title', 'U upotrebi kod')); ?>
                        </h2>
                    </div>
                    <div class="clients-slider-wrapper">
                        <div class="clients-slider swiper">
                            <div class="swiper-wrapper">
                                <?php
                                $swiper_logos = cleargreen_render_swiper_logos('gatekeeper');
                                if (!empty($swiper_logos)) {
                                    echo $swiper_logos;
                                } else {
                                    // Fallback na stare logotipe ako nisu postavljeni u Customizeru
                                ?>
                                <div class="swiper-slide d-flex align-items-center justify-content-center"
                                    data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="600">
                                    <div class="client-logo-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo/CKBbanka_logo.png" alt="CKB Banka" class="client-logo-img">
                                    </div>
                                </div>
                                <div class="swiper-slide d-flex align-items-center justify-content-center"
                                    data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="700">
                                    <div class="client-logo-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo/Adriatic-banka-logo.png" alt="Adriatic banka" class="client-logo-img">
                                    </div>
                                </div>
                                <div class="swiper-slide d-flex align-items-center justify-content-center"
                                    data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800">
                                    <div class="client-logo-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo/telemach-crna-gora-feature.jpg" alt="Telemach" class="client-logo-img">
                                    </div>
                                </div>
                                <div class="swiper-slide d-flex align-items-center justify-content-center"
                                    data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="600">
                                    <div class="client-logo-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo/1.png" alt="Logo" class="client-logo-img">
                                    </div>
                                </div>
                                <div class="swiper-slide d-flex align-items-center justify-content-center"
                                    data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="700">
                                    <div class="client-logo-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo/petsrus_logo.jpg" alt="PetsRus" class="client-logo-img">
                                    </div>
                                </div>
                                <div class="swiper-slide d-flex align-items-center justify-content-center"
                                    data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800">
                                    <div class="client-logo-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo/satrakt logo.jpg" alt="Satrakt" class="client-logo-img">
                                    </div>
                                </div>
                                <div class="swiper-slide d-flex align-items-center justify-content-center"
                                    data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="600">
                                    <div class="client-logo-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo/Untitled.png" alt="Logo" class="client-logo-img">
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ============================ U upotrebi kod sekcija end =========================== -->

            <!-- PREDNOSTI Section -->
            <section id="prednosti" class="gatekeeper-section py-120 bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="gatekeeper-section-title mb-5">
                                <span><?php echo esc_html(bcms_get('bcms_gko_benef_section', 'PREDNOSTI')); ?></span>
                                <span class="title-line"></span>
                            </h2>
                            <div class="gatekeeper-content">
                                <p><?php echo esc_html(bcms_get('bcms_gko_benef_desc', 'GateKeeper je namijenjen institucijama koje imaju povećan protok posjetilaca i potrebu za sigurnom identifikacijom i jasnim evidencijama.')); ?></p>
                                <h3 class="mt-5 mb-4 fw-bold"><?php echo esc_html(bcms_get('bcms_gko_benef_subtitle', 'Benefiti koje organizacije ostvaruju:')); ?></h3>
                                <div class="benefits-grid">
                                    <?php
                                    $benef_items = bcms_arr('bcms_gko_benef_items');
                                    if (!empty($benef_items)) :
                                        foreach ($benef_items as $item) : ?>
                                    <div class="benefit-card">
                                        <div class="benefit-icon">
                                            <i class="<?php echo esc_attr($item['icon']); ?>"></i>
                                        </div>
                                        <div class="benefit-card-content">
                                            <h4 class="fw-bold"><?php echo esc_html($item['title']); ?></h4>
                                            <p><?php echo esc_html($item['desc']); ?></p>
                                        </div>
                                    </div>
                                        <?php endforeach;
                                    else : ?>
                                    <div class="benefit-card">
                                        <div class="benefit-icon">
                                            <i class="ph ph-shield-check"></i>
                                        </div>
                                        <div class="benefit-card-content">
                                            <h4 class="fw-bold">Povećana sigurnost</h4>
                                            <p>Automatska evidencija ulazaka i izlazaka, smanjen rizik od neovlašćenog pristupa.</p>
                                        </div>
                                    </div>
                                    <div class="benefit-card">
                                        <div class="benefit-icon">
                                            <i class="ph ph-desktop"></i>
                                        </div>
                                        <div class="benefit-card-content">
                                            <h4 class="fw-bold">Digitalna portirnica/recepcija</h4>
                                            <p>Bez ručnog zapisivanje u dnevnike, jasan pregled posjetilaca, brži i precizniji rad.</p>
                                        </div>
                                    </div>
                                    <div class="benefit-card">
                                        <div class="benefit-icon">
                                            <i class="ph ph-chart-line-up"></i>
                                        </div>
                                        <div class="benefit-card-content">
                                            <h4 class="fw-bold">Pametne analitike</h4>
                                            <p>Uvid u istorijat posjeta, opterećenost sektora i zaposlenih, zauzetost sala za sastanke itd.</p>
                                        </div>
                                    </div>
                                    <div class="benefit-card">
                                        <div class="benefit-icon">
                                            <i class="ph ph-calendar-check"></i>
                                        </div>
                                        <div class="benefit-card-content">
                                            <h4 class="fw-bold">Bolja interna organizacija</h4>
                                            <p>Kalendar sastanaka, obavještenja i pregled dolazaka u realnom vremenu.</p>
                                        </div>
                                    </div>
                                    <div class="benefit-card">
                                        <div class="benefit-icon">
                                            <i class="ph ph-scales"></i>
                                        </div>
                                        <div class="benefit-card-content">
                                            <h4 class="fw-bold">Zakonska usklađenost i bezbijednost podataka</h4>
                                            <p>U potpunosti usklađen sa GDPR regulativom i domaćim Zakonom o zaštiti ličnih podataka.</p>
                                        </div>
                                    </div>
                                    <div class="benefit-card">
                                        <div class="benefit-icon">
                                            <i class="ph ph-gear"></i>
                                        </div>
                                        <div class="benefit-card-content">
                                            <h4 class="fw-bold">Implementacija u roku od 2 do 3 dana</h4>
                                            <p>Intuitivan interfejs koji zahtijeva minimalno obuke za osoblje.</p>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <p class="mt-5"><?php echo esc_html(bcms_get('bcms_gko_benef_footer1', 'Posebno je koristan za banke, državne institucije, opštine, mikrofinansijske organizacije, zdravstvene ustanove i sve organizacije koje i dalje ručno zapisuju podatke u dnevnik.')); ?></p>
                                <p><?php echo esc_html(bcms_get('bcms_gko_benef_footer2', 'GateKeeper značajno olakšava organizacijama koje uvode ili posjeduju ISO/IEC 27001 kroz digitalnu kontrolu fizičkog pristupa, audit trag i jasno definisana korisnička prava.')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Decorative separator after PREDNOSTI -->
            <div class="section-separator">
                <div class="separator-line"></div>
            </div>

            <!-- O NAMA Section -->
            <section id="o-nama" class="about-section-modern py-120">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="gatekeeper-section-title mb-5">
                                <span><?php echo esc_html(bcms_get('bcms_gko_about_section', 'O NAMA')); ?></span>
                                <span class="title-line"></span>
                            </h2>
                            
                            <!-- ClearGreen Card -->
                            <div class="about-company-card mb-5">
                                <div class="about-card-header">
                                    <div class="about-card-icon">
                                        <i class="ph ph-buildings"></i>
                                    </div>
                                    <div class="about-card-title-wrapper">
                                        <h3 class="about-card-title"><?php echo esc_html(bcms_get('bcms_gko_about_cg_title', 'ClearGreen')); ?></h3>
                                        <p class="about-card-subtitle"><?php echo esc_html(bcms_get('bcms_gko_about_cg_sub', 'Specijalizovana kompanija za digitalna rješenja')); ?></p>
                                    </div>
                                </div>
                                <p class="about-card-text"><?php echo esc_html(bcms_get('bcms_gko_about_cg_desc', 'ClearGreen je kompanija specijalizovana za razvoj naprednih rješenja u oblastima digitalne identifikacije, kontrole pristupa i automatizacije poslovnih procesa.')); ?></p>
                            </div>

                            <!-- Solutions Grid -->
                            <div class="about-solutions-section mb-5">
                                <h3 class="about-solutions-title">Naša rješenja uključuju:</h3>
                                <div class="solutions-grid-modern">
                                    <?php
                                    $solutions = bcms_arr('bcms_gko_about_solutions');
                                    if (!empty($solutions)) :
                                        foreach ($solutions as $sol) : ?>
                                    <div class="solution-card-modern">
                                        <div class="solution-icon-modern">
                                            <i class="<?php echo esc_attr($sol['icon']); ?>"></i>
                                        </div>
                                        <h4 class="solution-name"><?php echo esc_html($sol['name']); ?></h4>
                                        <p class="solution-desc"><?php echo esc_html($sol['desc']); ?></p>
                                    </div>
                                        <?php endforeach;
                                    else : ?>
                                    <div class="solution-card-modern">
                                        <div class="solution-icon-modern">
                                            <i class="ph ph-shield-check"></i>
                                        </div>
                                        <h4 class="solution-name">GateKeeper</h4>
                                        <p class="solution-desc">Platforma za digitalnu evidenciju posjetilaca i kontrolu pristupa.</p>
                                    </div>
                                    <div class="solution-card-modern">
                                        <div class="solution-icon-modern">
                                            <i class="ph ph-bank"></i>
                                        </div>
                                        <h4 class="solution-name">BASIC</h4>
                                        <p class="solution-desc">Rješenje za onboarding, spriječavanje lažnih identiteta i fraud pokušaja za banke.</p>
                                    </div>
                                    <div class="solution-card-modern">
                                        <div class="solution-icon-modern">
                                            <i class="ph ph-device-mobile"></i>
                                        </div>
                                        <h4 class="solution-name">SIMPLEX</h4>
                                        <p class="solution-desc">Sistem za sigurnu aktivaciju SIM/eSIM kartica sa provjerom identiteta.</p>
                                    </div>
                                    <div class="solution-card-modern">
                                        <div class="solution-icon-modern">
                                            <i class="ph ph-chart-line-up"></i>
                                        </div>
                                        <h4 class="solution-name">Alter One</h4>
                                        <p class="solution-desc">Sveobuhvatan softver za mikrofinansijske institucije (krediti, klijenti, izvještaji).</p>
                                    </div>
                                    <div class="solution-card-modern">
                                        <div class="solution-icon-modern">
                                            <i class="ph ph-file-text"></i>
                                        </div>
                                        <h4 class="solution-name">DMS</h4>
                                        <p class="solution-desc">Document Management System - procesno orijentisan alat za upravljanje dokumentima.</p>
                                    </div>
                                    <div class="solution-card-modern">
                                        <div class="solution-icon-modern">
                                            <i class="ph ph-gear"></i>
                                        </div>
                                        <h4 class="solution-name">Specijalizovana rješenja</h4>
                                        <p class="solution-desc">Softverska rješenja za automatizaciju procesa.</p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="about-association-badge">
                                    <i class="ph ph-award"></i>
                                    <span><?php echo esc_html(bcms_get('bcms_gko_about_assoc', 'Član Asocijacije menadžera za bezbjednost')); ?></span>
                                </div>
                            </div>

                            <!-- Regula Partner Card -->
                            <div class="about-company-card about-company-card-regula">
                                <div class="about-card-header">
                                    <div class="about-card-icon about-card-icon-regula">
                                        <i class="ph ph-fingerprint"></i>
                                    </div>
                                    <div class="about-card-title-wrapper">
                                        <h3 class="about-card-title"><?php echo esc_html(bcms_get('bcms_gko_regula_title', 'Regula Forensics')); ?></h3>
                                        <p class="about-card-subtitle"><?php echo esc_html(bcms_get('bcms_gko_regula_sub', 'forensic science systems')); ?></p>
                                    </div>
                                </div>
                                <p class="about-card-text"><?php echo esc_html(bcms_get('bcms_gko_regula_desc', 'ClearGreen je zvanični partner Regula Forensics, globalnog lidera u forenzičkoj verifikaciji dokumenata, čije tehnologije integrišemo u više naših rješenja za digitalnu identifikaciju i kontrolu pristupa.')); ?></p>
                                
                                <div class="about-regula-details">
                                    <?php
                                    $regula_info = bcms_arr('bcms_gko_regula_info');
                                    if (!empty($regula_info)) :
                                        foreach ($regula_info as $info) : ?>
                                    <div class="regula-info-card">
                                        <div class="regula-info-icon">
                                            <i class="ph ph-globe-hemisphere-west"></i>
                                        </div>
                                        <div class="regula-info-content">
                                            <h4 class="regula-info-title"><?php echo esc_html($info['title']); ?></h4>
                                            <p class="regula-info-text"><?php echo esc_html($info['text']); ?></p>
                                        </div>
                                    </div>
                                        <?php endforeach;
                                    else : ?>
                                    <div class="regula-info-card regula-partners">
                                        <div class="regula-info-icon">
                                            <i class="ph ph-globe-hemisphere-west"></i>
                                        </div>
                                        <div class="regula-info-content">
                                            <h4 class="regula-info-title">Saradnja sa</h4>
                                            <p class="regula-info-text">USA, Interpol, Europol, vladine agencije i banke</p>
                                        </div>
                                    </div>
                                    <div class="regula-info-card regula-usage">
                                        <div class="regula-info-icon">
                                            <i class="ph ph-buildings"></i>
                                        </div>
                                        <div class="regula-info-content">
                                            <h4 class="regula-info-title">U Crnoj Gori</h4>
                                            <p class="regula-info-text">Ministarstvo unutrašnjih poslova koristi Regula tehnologiju za kontrolu i validaciju dokumenata na graničnim prelazima.</p>
                                        </div>
                                    </div>
                                    <div class="regula-info-card regula-capabilities">
                                        <div class="regula-info-icon">
                                            <i class="ph ph-shield-check"></i>
                                        </div>
                                        <div class="regula-info-content">
                                            <h4 class="regula-info-title">Sistem prepoznaje i verifikuje</h4>
                                            <p class="regula-info-text">200+ tipova dokumenata iz više od 250 zemalja, uključujući lične karte, pasoše, vozačke dozvole, diplomatske dozvole, trajne i privremene boravišne dozvole, privremene radne dozvole, dozvole za oružje, policijske iskaznice.</p>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- PROCES RADA Section -->
            <section id="proces-rada" class="gatekeeper-section py-120 bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="gatekeeper-section-title mb-5">
                                <span><?php echo esc_html(bcms_get('bcms_gko_proc_section', 'PROCES RADA')); ?></span>
                                <span class="title-line"></span>
                            </h2>
                            <div class="gatekeeper-content">
                                <p><?php echo esc_html(bcms_get('bcms_gko_proc_desc1', 'GateKeeper digitalizuje kompletan tok upravljanja posjetama - od organizacione pripreme, preko najava i provjere identiteta, do evidencije pristupa i napredne analitike.')); ?></p>
                                <p><?php echo esc_html(bcms_get('bcms_gko_proc_desc2', 'Sistem eliminiše ručne evidencije, ubrzava rad portira i obezbjeđuje pouzdanu provjeru identiteta u svakom koraku.')); ?></p>
                                <h3 class="mt-5 mb-4 fw-bold"><?php echo wp_kses_post(bcms_get('bcms_gko_proc_subtitle', 'Kako funkcioniše <strong>GateKeeper</strong> u 5 koraka:')); ?></h3>
                                <div class="process-slider-wrapper">
                                    <div class="process-slider swiper">
                                        <div class="swiper-wrapper">
                                            <?php
                                            $proc_steps = bcms_arr('bcms_gko_proc_steps');
                                            if (!empty($proc_steps)) :
                                                foreach ($proc_steps as $i => $step) :
                                                    $num = $i + 1;
                                                    $onclick = ($num === 1) ? 'showProcessDetail' : 'openProcessModal';
                                            ?>
                                            <div class="swiper-slide">
                                                <div class="process-step-card" data-step="<?php echo esc_attr($num); ?>" onclick="<?php echo esc_attr($onclick); ?>(<?php echo esc_attr($num); ?>)">
                                                    <div class="process-step-number"><?php echo esc_html($num); ?></div>
                                                    <h4 class="process-step-title"><?php echo esc_html($step['title']); ?></h4>
                                                    <p class="process-step-text"><?php echo esc_html($step['short']); ?></p>
                                                </div>
                                            </div>
                                            <?php endforeach;
                                            else : ?>
                                            <div class="swiper-slide">
                                                <div class="process-step-card" data-step="1" onclick="showProcessDetail(1)">
                                                    <div class="process-step-number">1</div>
                                                    <h4 class="process-step-title">Konfiguracija organizacije</h4>
                                                    <p class="process-step-text">Postavljanje sektora, radnih mjesta, zaposlenih i pravila pristupa.</p>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="process-step-card" data-step="2" onclick="openProcessModal(2)">
                                                    <div class="process-step-number">2</div>
                                                    <h4 class="process-step-title">Najave i zakazivanje posjeta</h4>
                                                    <p class="process-step-text">Zaposleni najavljuju posjetioce, rezervišu sastanke i zajedničke prostorije.</p>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="process-step-card" data-step="3" onclick="openProcessModal(3)">
                                                    <div class="process-step-number">3</div>
                                                    <h4 class="process-step-title">Identifikacija posjetioca na ulazu</h4>
                                                    <p class="process-step-text">Portir skenira dokument i sistem automatski kreira zapis posjete.</p>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="process-step-card" data-step="4" onclick="openProcessModal(4)">
                                                    <div class="process-step-number">4</div>
                                                    <h4 class="process-step-title">Evidencija pristupa</h4>
                                                    <p class="process-step-text">Ulazak i izlazak posjetioca bilježe se u realnom vremenu, uz audit trag.</p>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="process-step-card" data-step="5" onclick="openProcessModal(5)">
                                                    <div class="process-step-number">5</div>
                                                    <h4 class="process-step-title">Analitika posjeta i izvještaji</h4>
                                                    <p class="process-step-text">Institucija dobija detaljne uvide i statistike za optimizaciju rada.</p>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Process Steps Details Section -->
            <section id="process-details" class="gatekeeper-section py-120">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Process Steps Navigation -->
                            <div class="process-steps-nav">
                                <?php
                                $proc_steps_nav = bcms_arr('bcms_gko_proc_steps');
                                if (!empty($proc_steps_nav)) :
                                    foreach ($proc_steps_nav as $i => $step) :
                                        $num = $i + 1;
                                        $active = ($num === 1) ? ' active' : '';
                                ?>
                                <button class="process-nav-btn<?php echo $active; ?>" data-step="<?php echo esc_attr($num); ?>" onclick="showProcessDetail(<?php echo esc_attr($num); ?>)">
                                    <span class="process-nav-number"><?php echo esc_html($num); ?></span>
                                    <span class="process-nav-label"><?php echo esc_html($step['nav']); ?></span>
                                </button>
                                <?php endforeach;
                                else : ?>
                                <button class="process-nav-btn active" data-step="1" onclick="showProcessDetail(1)">
                                    <span class="process-nav-number">1</span>
                                    <span class="process-nav-label">Konfiguracija</span>
                                </button>
                                <button class="process-nav-btn" data-step="2" onclick="showProcessDetail(2)">
                                    <span class="process-nav-number">2</span>
                                    <span class="process-nav-label">Najave</span>
                                </button>
                                <button class="process-nav-btn" data-step="3" onclick="showProcessDetail(3)">
                                    <span class="process-nav-number">3</span>
                                    <span class="process-nav-label">Identifikacija</span>
                                </button>
                                <button class="process-nav-btn" data-step="4" onclick="showProcessDetail(4)">
                                    <span class="process-nav-number">4</span>
                                    <span class="process-nav-label">Evidencija</span>
                                </button>
                                <button class="process-nav-btn" data-step="5" onclick="showProcessDetail(5)">
                                    <span class="process-nav-number">5</span>
                                    <span class="process-nav-label">Analitika</span>
                                </button>
                                <?php endif; ?>
                            </div>

                            <?php
                            $proc_steps_detail = bcms_arr('bcms_gko_proc_steps');
                            if (!empty($proc_steps_detail)) :
                                foreach ($proc_steps_detail as $i => $step) :
                                    $num = $i + 1;
                                    $display = ($num === 1) ? 'block' : 'none';
                            ?>
                            <!-- Process Step <?php echo $num; ?> Detail -->
                            <div id="process-detail-<?php echo esc_attr($num); ?>" class="process-detail-item" style="display: <?php echo $display; ?>;">
                                <div class="process-detail-content">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <div class="process-detail-image">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/gate/Project Proposal(<?php echo esc_attr($num + 5); ?>).png" alt="<?php echo esc_attr($step['title']); ?>" class="img-fluid">
                                                <?php if ($num === 3) : ?>
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/gate/Project Proposal(9).png" alt="<?php echo esc_attr($step['title']); ?>" class="img-fluid">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="process-detail-text">
                                                <div class="process-detail-number"><?php echo esc_html($num); ?></div>
                                                <h3 class="process-detail-title"><?php echo esc_html($step['title']); ?></h3>
                                                <div class="process-detail-description">
                                                    <p><?php echo esc_html($step['detail']); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;
                            else : ?>
                            <!-- Process Step 1 Detail -->
                            <div id="process-detail-1" class="process-detail-item" style="display: block;">
                                <div class="process-detail-content">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <div class="process-detail-image">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/gate/Project Proposal(6).png" alt="Konfiguracija organizacije" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="process-detail-text">
                                                <div class="process-detail-number">1</div>
                                                <h3 class="process-detail-title">Konfiguracija organizacije</h3>
                                                <div class="process-detail-description">
                                                    <p>Postavljanje sektora, odjeljenja, radnih mjesta i zaposlenih predstavlja osnovu sistema. Administrator kreira strukturu institucije, definiše uloge korisnika i pravila pristupa.</p>
                                                    <p>GateKeeper podržava i zajedničke kancelarije/sale za sastanke, koje se mogu rezervisati tokom planiranja posjeta.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Process Step 2 Detail -->
                            <div id="process-detail-2" class="process-detail-item" style="display: none;">
                                <div class="process-detail-content">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <div class="process-detail-image">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/gate/Project Proposal(7).png" alt="Najave i zakazivanje posjeta" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="process-detail-text">
                                                <div class="process-detail-number">2</div>
                                                <h3 class="process-detail-title">Najave i zakazivanje posjeta</h3>
                                                <div class="process-detail-description">
                                                    <p>Zaposleni najavljuju posjetioce, rezervišu sastanke i zajedničke prostorije. Sistem omogućava jednostavno planiranje i upravljanje posjetama.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Process Step 3 Detail -->
                            <div id="process-detail-3" class="process-detail-item" style="display: none;">
                                <div class="process-detail-content">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <div class="process-detail-image">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/gate/Project Proposal(8).png" alt="Identifikacija posjetioca" class="img-fluid" style="margin-bottom: 20px;">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/gate/Project Proposal(9).png" alt="Identifikacija posjetioca" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="process-detail-text">
                                                <div class="process-detail-number">3</div>
                                                <h3 class="process-detail-title">Identifikacija posjetioca na ulazu</h3>
                                                <div class="process-detail-description">
                                                    <p>Portir skenira dokument i sistem automatski kreira zapis posjete. Koristi se Regula Forensics tehnologija za verifikaciju dokumenata.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Process Step 4 Detail -->
                            <div id="process-detail-4" class="process-detail-item" style="display: none;">
                                <div class="process-detail-content">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <div class="process-detail-image">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/gate/Project Proposal(10).png" alt="Evidencija pristupa" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="process-detail-text">
                                                <div class="process-detail-number">4</div>
                                                <h3 class="process-detail-title">Evidencija pristupa</h3>
                                                <div class="process-detail-description">
                                                    <p>Ulazak i izlazak posjetioca bilježe se u realnom vremenu, uz audit trag. Sistem automatski bilježi sve aktivnosti.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Process Step 5 Detail -->
                            <div id="process-detail-5" class="process-detail-item" style="display: none;">
                                <div class="process-detail-content">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <div class="process-detail-image">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/gate/Project Proposal(11).png" alt="Analitika posjeta" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="process-detail-text">
                                                <div class="process-detail-number">5</div>
                                                <h3 class="process-detail-title">Analitika posjeta i izvještaji</h3>
                                                <div class="process-detail-description">
                                                    <p>Institucija dobija detaljne uvide i statistike za optimizaciju rada. Sistem generiše različite izvještaje i analitiku.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- IMPLEMENTACIJA Section -->
            <section id="implementacija" class="gatekeeper-section py-120 position-relative overflow-hidden">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="implementation-section-header text-center mb-5">
                                <div class="section-badge mb-3">
                                    <span class="badge-text"><?php echo esc_html(bcms_get('bcms_gko_impl_badge', 'IMPLEMENTACIJA')); ?></span>
                                </div>
                                <h2 class="implementation-section-title">
                                    <?php echo esc_html(bcms_get('bcms_gko_impl_title', 'Brza i efikasna implementacija')); ?>
                                </h2>
                            </div>
                            
                            <div class="implementation-content-wrapper">
                                <div class="implementation-wrapper">
                                    <div class="row gy-4">
                                    <?php
                                    $impl_cards = bcms_arr('bcms_gko_impl_cards');
                                    if (!empty($impl_cards)) :
                                        foreach ($impl_cards as $card) : ?>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="implementation-card">
                                            <div class="implementation-icon">
                                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            <h4 class="implementation-title"><?php echo esc_html($card['title']); ?></h4>
                                            <p class="implementation-text"><?php echo wp_kses_post($card['text']); ?></p>
                                        </div>
                                    </div>
                                        <?php endforeach;
                                    else : ?>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="implementation-card">
                                            <div class="implementation-icon">
                                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            <h4 class="implementation-title">Brza implementacija</h4>
                                            <p class="implementation-text">Implementacija sistema po lokaciji traje <strong>2 do 3 radna dana</strong>, u zavisnosti od specifičnih zahtjeva i infrastrukture klijenta.</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="implementation-card">
                                            <div class="implementation-icon">
                                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            <h4 class="implementation-title">Jednostavna upotreba</h4>
                                            <p class="implementation-text">Aplikacija je jednostavna za korišćenje i isporučuje se sa detaljnim uputstvima.</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="implementation-card">
                                            <div class="implementation-icon">
                                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            <h4 class="implementation-title">Obuke za zaposlene</h4>
                                            <p class="implementation-text"><strong>Po potrebi</strong>, naš tim organizuje i periodične obuke za zaposlene.</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="implementation-card">
                                            <div class="implementation-icon">
                                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M18 8A6 6 0 0 0 6 8C6 11 3 13 3 16H21C21 13 18 11 18 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M13.73 21C13.5542 21.3031 13.3019 21.5547 12.9982 21.7295C12.6946 21.9044 12.3504 21.9965 12 21.9965C11.6496 21.9965 11.3054 21.9044 11.0018 21.7295C10.6982 21.5547 10.4458 21.3031 10.27 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            <h4 class="implementation-title">Tehnička podrška</h4>
                                            <p class="implementation-text">Naš tim obezbjeđuje <strong>stalnu tehničku podršku</strong>, a sve prijavljene nepravilnosti rješavaju se u najkraćem roku.</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="implementation-card">
                                            <div class="implementation-icon">
                                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            <h4 class="implementation-title">Kontinuirano unapređenje</h4>
                                            <p class="implementation-text">GateKeeper se <strong>kontinuirano unapređuje</strong>, dodaju se nove funkcionalnosti, sigurnosna poboljšanja i optimizacije.</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="implementation-card">
                                            <div class="implementation-icon">
                                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M12 5L19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            <h4 class="implementation-title">Najnovija verzija</h4>
                                            <p class="implementation-text">Klijent uvijek ima pristup <strong>najnovijoj verziji sistema</strong>, bez dodatnih troškova instalacije ili nadogradnje.</p>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ========================== Footer Three Section Start ========================= -->
            <section id="contact" class="footer-three bg-pink-more-light bg-pink-more-light">
                <div class="py-120">
                    <div class="container">
                        <div class="row gy-5">
                            <div class="col-lg-12 text-center" data-aos="fade-up" data-aos-duration="600">
                                <h2 class="footer-title text-white mb-5 fw-bold" style="font-size: 36px; line-height: 1.4;">
                                    <?php echo esc_html(bcms_get('bcms_gko_footer_title', 'Spremni smo da kroz demo prezentaciju uživo prikažemo kako se GateKeeper može primijeniti u vašoj organizaciji.')); ?>
                                </h2>

                                <div class="row justify-content-center mt-5">
                                    <?php
                                    $footer_contacts = bcms_arr('bcms_gko_footer_contacts');
                                    if (!empty($footer_contacts)) :
                                        $aos_dur = 700;
                                        foreach ($footer_contacts as $contact) : ?>
                                    <div class="col-lg-6 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="<?php echo esc_attr($aos_dur); ?>">
                                        <div class="contact-person">
                                            <h4 class="text-white fw-bold mb-3"><?php echo esc_html($contact['name']); ?></h4>
                                            <p class="text-white mb-2"><?php echo esc_html($contact['role']); ?></p>
                                            <p class="text-white mb-2">
                                                <i class="ph ph-envelope" style="font-size: 18px;"></i>
                                                <a href="mailto:<?php echo esc_attr($contact['email']); ?>" class="text-white"><?php echo esc_html($contact['email']); ?></a>
                                            </p>
                                            <p class="text-white">
                                                <i class="ph ph-phone" style="font-size: 18px;"></i>
                                                <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $contact['phone'])); ?>" class="text-white"><?php echo esc_html($contact['phone']); ?></a>
                                            </p>
                                        </div>
                                    </div>
                                        <?php $aos_dur += 100;
                                        endforeach;
                                    else : ?>
                                    <div class="col-lg-6 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="700">
                                        <div class="contact-person">
                                            <h4 class="text-white fw-bold mb-3">Stefan Planić</h4>
                                            <p class="text-white mb-2">CEO</p>
                                            <p class="text-white mb-2">
                                                <i class="ph ph-envelope" style="font-size: 18px;"></i>
                                                <a href="mailto:stefan.planic@cleargreen.me" class="text-white">stefan.planic@cleargreen.me</a>
                                            </p>
                                            <p class="text-white">
                                                <i class="ph ph-phone" style="font-size: 18px;"></i>
                                                <a href="tel:+38268090161" class="text-white">+382 68 090 161</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="800">
                                        <div class="contact-person">
                                            <h4 class="text-white fw-bold mb-3">Tamara Knežević</h4>
                                            <p class="text-white mb-2">BDM</p>
                                            <p class="text-white mb-2">
                                                <i class="ph ph-envelope" style="font-size: 18px;"></i>
                                                <a href="mailto:tamara@cleargreen.me" class="text-white">tamara@cleargreen.me</a>
                                            </p>
                                            <p class="text-white">
                                                <i class="ph ph-phone" style="font-size: 18px;"></i>
                                                <a href="tel:+38267005590" class="text-white">+382 67 00 5590</a>
                                            </p>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="mt-5" data-aos="fade-up" data-aos-duration="900">
                                    <a href="https://www.cleargreen.me" target="_blank" class="footer-website-link text-white">
                                        <i class="ph ph-globe"></i>
                                        www.cleargreen.me
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Bottom -->
                <div class="container">
                    <!-- bottom Footer -->
                    <div class="footer-bottom">
                        <div class="container container-two">
                            <div class="footer-bottom-content">
                                <p class="footer-powered-text">Powered by</p>
                                <div class="footer-logos-wrapper">
                                    <a href="https://www.cleargreen.me" target="_blank" class="footer-logo">
                                        <img src="/wp-content/uploads/2025/10/1ebaefb9-42d2-44b8-8fa2-7602928a068b.png" alt="ClearGreen Logo">
                                    </a>
                                    <span class="footer-ampersand">&</span>
                                    <span class="footer-regula">Regula</span>
                                </div>
                                <p class="footer-copyright">
                                    <?php echo wp_kses_post(bcms_get('bcms_gko_footer_copyright', '&copy; 2025 ClearGreen. Sva prava zadržana.')); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer Bottom End -->
            </section>
            <!-- ========================== Footer Three Section End ========================= -->

        </div>
    </div>

    <!-- Jquery js -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery-3.7.1.min.js"></script>
    <!-- phosphor Js -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/phosphor-icon.js"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/boostrap.bundle.min.js"></script>

    <!-- GSAP js -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/gsap.min.js"></script>
    <!-- Scroll Trigger -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/ScrollTrigger.min.js"></script>
    <!-- ScrollSmoother -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/ScrollSmoother.min.js"></script>
    <!-- SplitText -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/SplitText.min.js"></script>
    <!-- custom GSAP -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/custom-gsap.js"></script>

    <!-- aos Js -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/aos.js"></script>
    <!-- counter up Js -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/counterup.min.js"></script>
    <!-- swiper Js -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/swiper-bundle.min.js"></script>
    <!-- Marquee js -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.marquee.min.js"></script>
    <!-- magnific js -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/magnific-popup.min.js"></script>

    <!-- main js -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/main.js"></script>

    <!-- Clients Slider Initialization -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Swiper !== 'undefined') {
                var clientsSlider = new Swiper(".clients-slider", {
                    autoplay: {
                        delay: 2000,
                        disableOnInteraction: false,
                    },
                    autoplay: true,
                    speed: 1500,
                    grabCursor: true,
                    loop: true,
                    slidesPerView: 5,
                    spaceBetween: 40,
                    breakpoints: {
                        300: {
                            slidesPerView: 1,
                            spaceBetween: 15,
                        },
                        575: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 25,
                        },
                        992: {
                            slidesPerView: 5,
                            spaceBetween: 30,
                        },
                        1200: {
                            slidesPerView: 5,
                            spaceBetween: 40,
                        },
                    },
                });

                // Process Steps Slider
                var processSlider = new Swiper(".process-slider", {
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    autoplay: true,
                    speed: 1500,
                    grabCursor: true,
                    loop: true,
                    centeredSlides: false,
                    slidesPerView: 2.3,
                    spaceBetween: 40,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                        dynamicBullets: true,
                    },
                    breakpoints: {
                        300: {
                            slidesPerView: 1.2,
                            spaceBetween: 20,
                        },
                        768: {
                            slidesPerView: 1.8,
                            spaceBetween: 25,
                        },
                        992: {
                            slidesPerView: 2.3,
                            spaceBetween: 40,
                        },
                        1200: {
                            slidesPerView: 2.5,
                            spaceBetween: 50,
                        },
                    },
                });

                // Process Detail Functions
                window.showProcessDetail = function(step) {
                    // Get the process details section
                    var processDetailsSection = document.getElementById('process-details');
                    if (!processDetailsSection) return;
                    
                    // Get current scroll position
                    var currentScroll = window.pageYOffset || document.documentElement.scrollTop;
                    var sectionTop = processDetailsSection.offsetTop;
                    
                    // Hide all details first
                    var allDetails = document.querySelectorAll('.process-detail-item');
                    allDetails.forEach(function(detail) {
                        detail.style.display = 'none';
                    });
                    
                    // Remove active class from all nav buttons and cards
                    var allNavBtns = document.querySelectorAll('.process-nav-btn');
                    allNavBtns.forEach(function(btn) {
                        btn.classList.remove('active');
                    });
                    
                    var allCards = document.querySelectorAll('.process-step-card');
                    allCards.forEach(function(card) {
                        card.classList.remove('active');
                    });
                    
                    // Show selected detail
                    var detail = document.getElementById('process-detail-' + step);
                    if (detail) {
                        detail.style.display = 'block';
                        // Add active class to clicked nav button
                        var clickedNavBtn = document.querySelector('.process-nav-btn[data-step="' + step + '"]');
                        if (clickedNavBtn) {
                            clickedNavBtn.classList.add('active');
                        }
                        // Add active class to clicked card
                        var clickedCard = document.querySelector('.process-step-card[data-step="' + step + '"]');
                        if (clickedCard) {
                            clickedCard.classList.add('active');
                        }
                        
                        // Only scroll if we're not already in the section
                        if (currentScroll < sectionTop - 100 || currentScroll > sectionTop + 500) {
                            setTimeout(function() {
                                var targetPosition = sectionTop - 100;
                                window.scrollTo({
                                    top: targetPosition,
                                    behavior: 'smooth'
                                });
                            }, 50);
                        }
                    }
                };
            }
        });
    </script>

</body>


</html>
