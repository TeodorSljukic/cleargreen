<?php
/*
Template Name: Gatekeeper (Titan-style)
*/

// Use custom header variant: header-gatekeeper.php (Gatekeeper header)
get_header('gatekeeper');
?>

<main class="titan-gatekeeper">
    <div class="content">
        <section class="main" id="home">
            <div class="wrapper">
                <div class="heading" id="heading">
                    <h1>
                        <span class="line-1"><?php echo esc_html(bcms_get('bcms_gkt_hero_line1', 'Digitalizujte portirnicu.')); ?></span>
                        <span class="line-2"><?php echo esc_html(bcms_get('bcms_gkt_hero_line2', 'Osigurajte instituciju.')); ?></span>
                    </h1>
                    <div class="hero-separator"></div>
                    <h5><?php echo wp_kses_post(bcms_get('bcms_gkt_hero_desc', 'Zamijenite manuelne sveske i softvere sa naprednom platformom za provjeru identiteta zasnovanu na Regula Forensics tehnologiji.<br>Usklađeno sa GDPR i ISO 27001 standardima.')); ?></h5>
                    <div class="hero-cta">
                        <a href="<?php echo esc_url(bcms_get('bcms_gkt_hero_cta_url', '#references')); ?>" class="titan-cta"><?php echo esc_html(bcms_get('bcms_gkt_hero_cta_text', 'Zakaži demo uživo')); ?></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="brand-area" id="references">
            <div class="wrapper">
                <h3><?php echo esc_html(bcms_get('bcms_gkt_brand_title', 'Povjerenje institucija i organizacija')); ?></h3>
                <p><?php echo esc_html(bcms_get('bcms_gkt_brand_desc', 'GateKeeper se koristi u okruženjima sa povećanim bezbjednosnim i regulatornim zahtjevima.')); ?></p>
                <div class="swiper brand-swiper">
                    <div class="swiper-wrapper">
                        <?php
                        $swiper_logos = cleargreen_render_swiper_logos('titan');
                        if (!empty($swiper_logos)) {
                            echo $swiper_logos;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Video modal -->
        <div class="titan-modal" id="popupModal" aria-hidden="true">
            <div class="titan-modal__backdrop" data-close="1"></div>
            <div class="titan-modal__dialog" role="dialog" aria-modal="true" aria-label="Video">
                <button class="titan-modal__close" type="button" aria-label="Close video" data-close="1">×</button>
                <div class="titan-modal__body">
                    <iframe
                        id="titanVideoFrame"
                        title="Titan video"
                        width="100%"
                        height="100%"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <section class="mail-feature" id="process">
            <div class="heading">
                <h3><?php echo wp_kses_post(bcms_get('bcms_gkt_proc_title', 'Digitalizujte upravljanje posjetiocima u <span class="text-accent-light">5 koraka</span>')); ?></h3>
                <h5><?php echo wp_kses_post(bcms_get('bcms_gkt_proc_subtitle', '<span class="text-accent-light">GateKeeper</span> vodi vas kroz kompletan proces - od konfiguracije do analitike posjeta.')); ?></h5>
            </div>

            <?php
            $proc_steps = bcms_arr('bcms_gkt_proc_steps');
            if (empty($proc_steps)) {
                $proc_steps = array(
                    array(
                        'title' => 'Konfiguracija <span class="text-accent-light">organizacije</span>',
                        'items' => "Postavite digitalnu strukturu sektora, radnih mjesta i uloga unutar institucije.\nDefinišite precizna pravila pristupa i nivoe korisničkih prava za portire i zaposlene.\nCentralizujte upravljanje zajedničkim resursima i salama za sastanke.",
                    ),
                    array(
                        'title' => 'Najave i <span class="text-accent-light">zakazivanje posjeta</span>',
                        'items' => "Najavite posjetioce unaprijed kroz centralni kalendar i smanjite gužve na ulazu.\nOmogućite portiru jasan pregled dnevnih dolazaka bez potrebe za telefonskim provjerama.\nPovećajte transparentnost zauzetosti sala i efikasnost korišćenja prostorija.",
                    ),
                    array(
                        'title' => 'Identifikacija posjetioca na <span class="text-accent-light">ulazu</span>',
                        'items' => "Verifikujte dokumente tabletom za 10 sekundi\nPrepoznajte preko 200 tipova dokumenata iz cijelog svijeta u svega par sekundi.\nGarantujte privatnost – očitavanje podataka se vrši bez čuvanja slika dokumenata i biometrije.",
                    ),
                    array(
                        'title' => '<span class="text-accent-light">Evidencija pristupa</span>',
                        'items' => "Pratite ulaske i izlaske u realnom vremenu uz neoboriv digitalni audit trag.\nZnajte u svakom trenutku ko se nalazi u objektu i kod kojeg zaposlenog.\nObezbijedite dokaziv protokol za potrebe revizije i ISO/IEC 27001 standarda.",
                    ),
                    array(
                        'title' => '<span class="text-accent-light">Analitika posjeta</span> i izvještaji',
                        'items' => "Dobijte detaljan uvid u opterećenost sektora i statistiku posjeta po danima.\nOptimizujte resurse i rad portirnice na osnovu stvarnih podataka o protoku ljudi.\nIzvezite precizne izvještaje za dalju obradu, arhiviranje ili BI integraciju.",
                    ),
                );
            }

            $proc_images = array(
                'Gatekeeper 1..png',
                'Gatekeeper-2.png',
                'Gatekeeper-3.png',
                'Gatekeeper-4.png',
                'Gatekeeper-5.png',
            );

            foreach ($proc_steps as $i => $step) :
                $img_file = isset($proc_images[$i]) ? $proc_images[$i] : '';
                $img_url  = $img_file ? get_stylesheet_directory_uri() . '/assets/images/gate/' . $img_file : '';
                $items    = array_filter(array_map('trim', explode("\n", $step['items'])));
            ?>
            <div class="block">
                <div class="wrapper">
                    <div class="text">
                        <h4><?php echo wp_kses_post($step['title']); ?></h4>
                        <ul>
                            <?php foreach ($items as $item) : ?>
                                <li><?php echo esc_html($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php if ($img_url) : ?>
                    <div class="image">
                        <a href="<?php echo esc_url($img_url); ?>" class="image-popup" data-lightbox="gatekeeper-images">
                            <img loading="lazy" src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr(wp_strip_all_tags($step['title'])); ?>">
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </section>

        <!-- Verifikacija dokumenta sekcija -->
        <section class="verification-section">
            <div class="wrapper">
                <div class="verification-grid">
                    <!-- Naslov -->
                    <div class="verification-title">
                        <h2><?php echo wp_kses_post(bcms_get('bcms_gkt_verif_title', 'Verifikacija dokumenta kojoj <span style="color: #bcd642">svijet vjeruje</span>')); ?></h2>
                    </div>

                    <?php
                    $verif_items = bcms_arr('bcms_gkt_verif_items');
                    if (empty($verif_items)) {
                        $verif_items = array(
                            array(
                                'title' => 'Univerzalna prepoznatljivost',
                                'desc'  => 'Gatekeeper koristi <span class="text-highlight">Regula Forensics</span> tehnologiju za za najstrože provjere dokumenata.',
                            ),
                            array(
                                'title' => '100% usklađenost i privatnost',
                                'desc'  => 'Potpuna zaštita podataka u skladu sa <span class="text-highlight">GDPR</span> standardima i domaćim Zakonom o zaštiti ličnih podataka, kao <span class="text-highlight">ISO/IEC 27001</span> standardom.',
                            ),
                            array(
                                'title' => 'Globalni standard sigurnosti',
                                'desc'  => 'Tehnologija kojoj vjeruje <span class="text-highlight">USA</span> i <span class="text-highlight">MUP Crne Gore</span> na graničnim prelazima, kao i mnoge države i globalne korporacije.',
                            ),
                        );
                    }

                    $verif_images = array(
                        'Regula-forensic-science-systems-2.webp',
                        '0806-header.webp',
                        'IMG_3238.webp',
                    );
                    $verif_alts = array('Regula', 'USA ID', 'EU Compliance');
                    $verif_classes = array('regula-block', 'usa-block', 'eu-block');

                    foreach ($verif_items as $vi => $vitem) :
                        $v_img   = isset($verif_images[$vi]) ? get_stylesheet_directory_uri() . '/assets/images/gate/' . $verif_images[$vi] : '';
                        $v_alt   = isset($verif_alts[$vi]) ? $verif_alts[$vi] : '';
                        $v_class = isset($verif_classes[$vi]) ? $verif_classes[$vi] : '';
                    ?>
                    <div class="verification-item <?php echo esc_attr($v_class); ?>">
                        <?php if ($v_img) : ?>
                        <img src="<?php echo esc_url($v_img); ?>" alt="<?php echo esc_attr($v_alt); ?>" loading="lazy">
                        <?php endif; ?>
                        <div class="text">
                            <h6><?php echo esc_html($vitem['title']); ?></h6>
                            <p><?php echo wp_kses_post($vitem['desc']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="testimonial-grid" id="testimonials">
            <h3><?php echo esc_html(bcms_get('bcms_gkt_test_title', 'Šta naši klijenti kažu')); ?></h3>
            <div class="testimonial-slider-wrapper">
                <div class="swiper testimonial-swiper">
                    <div class="swiper-wrapper">
                <?php
                $test_cards = bcms_arr('bcms_gkt_test_cards');
                if (empty($test_cards)) {
                    $test_cards = array(
                        array(
                            'quote'   => '"GateKeeper nam je donio standardizovan i dokaziv protokol upravljanja posjetama, uz jasan audit trag ulazaka i izlazaka. Posebno je vrijedno što je proces identifikacije pouzdan, brz i usklađen sa internim bezbjednosnim procedurama."',
                            'company' => 'CKB Banka',
                            'logo'    => 'assets/images/logo/CKBbanka_logo.png',
                        ),
                        array(
                            'quote'   => '"U okruženju sa velikim protokom posjetilaca, GateKeeper je značajno smanjio operativni rizik na ulazu i ubrzao rad recepcije. Sistem je jednostavan za korišćenje, a kontrola pristupa je transparentna i mjerljiva."',
                            'company' => 'Telemach',
                            'logo'    => 'assets/images/logo/telemach-crna-gora-feature.jpg',
                        ),
                        array(
                            'quote'   => '"Za institucije gdje su bezbjednost i usklađenost ključni, GateKeeper obezbjeđuje jasne evidencije i kontrolisan pristup bez nepotrebne administracije. Proces je standardizovan, a podaci su dostupni za interne provjere i revizije."',
                            'company' => 'Agencija za ljekove – CINMED',
                            'logo'    => 'assets/images/logo/1.png',
                        ),
                        array(
                            'quote'   => '"GateKeeper je unaprijedio kontrolu posjetilaca kroz real-time evidenciju i pregledan sistem upravljanja pristupom. Rješenje je praktično, brzo se uklapa u postojeće procedure i smanjuje prostor za propuste na ulazu."',
                            'company' => 'SAT-TRAKT',
                            'logo'    => 'assets/images/logo/satrakt logo.jpg',
                        ),
                        array(
                            'quote'   => '"GateKeeper je dobar primjer kako se fizička bezbjednost i informacione procedure mogu povezati u jedinstven tok. Audit trag, korisnička prava i analitika posjeta daju nivo kontrole koji je potreban u ozbiljnim sistemima."',
                            'company' => 'medIT group',
                            'logo'    => 'assets/images/logo/Untitled.png',
                        ),
                    );
                }

                foreach ($test_cards as $card) :
                    $logo_url = get_stylesheet_directory_uri() . '/' . ltrim($card['logo'], '/');
                ?>
                <div class="swiper-slide">
                    <div class="block">
                    <p><?php echo esc_html($card['quote']); ?></p>
                    <div class="d-flex align-items-start">
                        <img class="author-img" loading="lazy" src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($card['company']); ?>">
                        <span>
                            <span class="d-flex g-2 align-items-center mb-2">
                                <span class="d-flex g-2 align-items-center">
                                    <img class="rating-star" loading="lazy" src="https://titan.email/wp-content/themes/titan/img/testimonial/star.svg" alt="">
                                    <img class="rating-star" loading="lazy" src="https://titan.email/wp-content/themes/titan/img/testimonial/star.svg" alt="">
                                    <img class="rating-star" loading="lazy" src="https://titan.email/wp-content/themes/titan/img/testimonial/star.svg" alt="">
                                    <img class="rating-star" loading="lazy" src="https://titan.email/wp-content/themes/titan/img/testimonial/star.svg" alt="">
                                    <img class="rating-star" loading="lazy" src="https://titan.email/wp-content/themes/titan/img/testimonial/star.svg" alt="">
                                </span>
                                <span class="rating-number">5/5</span>
                            </span>
                            <span style="text-transform:uppercase; font-weight: 700; letter-spacing: 1.5px;"><?php echo esc_html($card['company']); ?></span>
                        </span>
                    </div>
                    </div>
                </div>
                <?php endforeach; ?>
                    </div>
                    <!-- Navigation buttons -->
                    <div class="swiper-button-next testimonial-next"></div>
                    <div class="swiper-button-prev testimonial-prev"></div>
                    <!-- Pagination -->
                    <div class="swiper-pagination testimonial-pagination"></div>
                </div>
            </div>
        </section>

        <section class="faq">
            <div class="wrapper">
                <h3 class="text-center"><?php echo esc_html(bcms_get('bcms_gkt_faq_title', 'Često postavljana pitanja')); ?></h3>
                <div class="faq-accordion">
                    <?php
                    $faq_items = bcms_arr('bcms_gkt_faq_items');
                    if (empty($faq_items)) {
                        $faq_items = array(
                            array(
                                'q' => 'Da li je GateKeeper usklađen sa GDPR i domaćim Zakonom o zaštiti ličnih podataka?',
                                'a' => 'Da. GateKeeper je razvijen u skladu sa GDPR regulativom i domaćim Zakonom o zaštiti ličnih podataka, uz strogo kontrolisan pristup podacima.',
                            ),
                            array(
                                'q' => 'Da li GateKeeper čuva skenirane dokumente ili biometrijske podatke?',
                                'a' => 'Ne. GateKeeper ne zadržava biometrijske podatke niti trajno skladišti skenirane dokumente van sistema institucije, osim ako to nije definisano internim pravilima i važećim propisima.',
                            ),
                            array(
                                'q' => 'Kako funkcioniše verifikacija identiteta (Regula Forensics)?',
                                'a' => 'GateKeeper koristi Regula Forensics tehnologiju za pouzdano očitavanje i provjeru identiteta posjetilaca tokom registracije na ulazu.',
                            ),
                            array(
                                'q' => 'Da li GateKeeper podržava ISO/IEC 27001 zahtjeve?',
                                'a' => 'Da. Sistem obezbjeđuje audit trag i dokazive evidencije fizičkog pristupa, što direktno pomaže organizacijama koje uvode ili posjeduju ISO/IEC 27001.',
                            ),
                            array(
                                'q' => 'Koliko traje implementacija i šta je potrebno sa naše strane?',
                                'a' => 'Implementacija je brza i podrazumijeva konfiguraciju prema strukturi institucije (sektori, zaposleni i pravila pristupa), uz inicijalno podešavanje i kratku obuku po potrebi.',
                            ),
                        );
                    }

                    foreach ($faq_items as $fi => $faq) :
                        $faq_index = $fi + 1;
                    ?>
                    <div class="faq-card">
                        <button class="faq-acordion-btn" type="button" data-target="#collapseQuery<?php echo $faq_index; ?>" aria-expanded="false" aria-controls="collapseQuery<?php echo $faq_index; ?>">
                            <?php echo esc_html($faq['q']); ?>
                        </button>
                        <div class="collapse" id="collapseQuery<?php echo $faq_index; ?>" hidden>
                            <div class="card card-body">
                                <?php echo esc_html($faq['a']); ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

    </div>
</main>

<?php get_footer('gatekeeper'); ?>
