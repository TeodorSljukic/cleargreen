<?php
/*
Template Name: Gatekeeper (Titan-style)
*/

// Use custom header variant: header-gatekeeper.php (Gatekeeper header)
get_header('gatekeeper');
?>

<main class="titan-gatekeeper">
    <div class="content">
        <section class="main">
            <div class="wrapper">
                <div class="heading" id="heading">
                    <h1><?php echo wp_kses_post(bcms_get('bcms_gk2_hero_title', 'Digitalizujte<br>upravljanje<br>posjetiocima sa<br><span class="text-accent">GateKeeper</span>')); ?></h1>
                    <h5><?php echo wp_kses_post(bcms_get('bcms_gk2_hero_desc', 'Napredna <span class="text-accent-light">SaaS aplikacija</span> za kontrolu pristupa, identifikaciju posjetilaca i automatizaciju procesa upravljanja posjetama u vašoj instituciji')); ?></h5>

                </div>
            </div>
        </section>

        <!-- Video modal -->
        <div class="titan-modal" id="popupModal" aria-hidden="true">
            <div class="titan-modal__backdrop" data-close="1"></div>
            <div class="titan-modal__dialog" role="dialog" aria-modal="true" aria-label="Video">
                <button class="titan-modal__close" type="button" aria-label="Close video" data-close="1">&times;</button>
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

        <section class="mail-feature">
            <div class="heading">
                <h3><?php echo wp_kses_post(bcms_get('bcms_gk2_proc_title', 'Digitalizujte upravljanje posjetiocima u <span class="text-accent-light">5 koraka</span>')); ?></h3>
                <h5><?php echo wp_kses_post(bcms_get('bcms_gk2_proc_subtitle', '<span class="text-accent-light">GateKeeper</span> vodi vas kroz kompletan proces - od konfiguracije do analitike posjeta.')); ?></h5>
            </div>

            <?php
            $proc_steps = bcms_arr('bcms_gk2_proc_steps');
            if (empty($proc_steps)) {
                $proc_steps = [
                    [
                        'title' => 'Konfiguracija <span class="text-accent-light">organizacije</span>',
                        'desc'  => '<p>Postavljanje sektora, odjeljenja, radnih mjesta i zaposlenih predstavlja <span class="text-accent-light">osnovu sistema</span>. Administrator kreira strukturu institucije, definiše uloge korisnika i pravila pristupa.</p>',
                    ],
                    [
                        'title' => 'Najave i <span class="text-accent-light">zakazivanje posjeta</span>',
                        'desc'  => '<p>Zaposleni najavljuju posjetioce, rezervišu sastanke i zajedničke prostorije. Sistem omogućava <span class="text-accent-light">jednostavno planiranje</span> i upravljanje posjetama.</p>',
                    ],
                    [
                        'title' => 'Identifikacija posjetioca na <span class="text-accent-light">ulazu</span>',
                        'desc'  => '<p>Portir skenira dokument i sistem <span class="text-accent-light">automatski kreira</span> zapis posjete. Koristi se <span class="text-accent-light">Regula Forensics</span> tehnologija za verifikaciju dokumenata.</p>',
                    ],
                    [
                        'title' => '<span class="text-accent-light">Evidencija pristupa</span>',
                        'desc'  => '<p>Ulazak i izlazak posjetioca bilježe se u <span class="text-accent-light">realnom vremenu</span>, uz audit trag. Sistem automatski bilježi sve aktivnosti.</p>',
                    ],
                    [
                        'title' => '<span class="text-accent-light">Analitika posjeta</span> i izvještaji',
                        'desc'  => '<p>Institucija dobija <span class="text-accent-light">detaljne uvide</span> i statistike za optimizaciju rada. Sistem generiše različite izvještaje i analitiku.</p>',
                    ],
                ];
            }

            $step_images = [
                get_stylesheet_directory_uri() . '/assets/images/gate/Project Proposal(6).png',
                get_stylesheet_directory_uri() . '/assets/images/gate/Project Proposal(7).png',
                get_stylesheet_directory_uri() . '/assets/images/gate/Project Proposal(8).png',
                get_stylesheet_directory_uri() . '/assets/images/gate/Project Proposal(10).png',
                get_stylesheet_directory_uri() . '/assets/images/gate/Project Proposal(11).png',
            ];

            // Extra image for step 3 (index 2)
            $step3_extra_image = get_stylesheet_directory_uri() . '/assets/images/gate/Project Proposal(9).png';

            foreach ($proc_steps as $i => $step) :
                $num = $i + 1;
                $img = isset($step_images[$i]) ? $step_images[$i] : '';
            ?>
            <div class="block">
                <div class="wrapper">
                    <div class="text">
                        <div class="step-number"><?php echo esc_html($num); ?></div>
                        <h4><?php echo wp_kses_post($step['title']); ?></h4>
                        <?php echo wp_kses_post($step['desc']); ?>
                    </div>
                    <div class="image">
                        <?php if ($img) : ?>
                        <a href="<?php echo esc_url($img); ?>" class="image-popup" data-lightbox="gatekeeper-images">
                            <img loading="lazy" src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr(wp_strip_all_tags($step['title'])); ?>"<?php echo ($i === 2) ? ' style="margin-bottom: 12px;"' : ''; ?>>
                        </a>
                        <?php endif; ?>
                        <?php if ($i === 2) : ?>
                        <a href="<?php echo esc_url($step3_extra_image); ?>" class="image-popup" data-lightbox="gatekeeper-images">
                            <img loading="lazy" src="<?php echo esc_url($step3_extra_image); ?>" alt="<?php echo esc_attr(wp_strip_all_tags($step['title'])); ?>">
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </section>


        <section class="testimonial-grid">
            <h3><?php echo esc_html(bcms_get('bcms_gkt_test_title', 'Šta naši klijenti kažu')); ?></h3>
            <div class="testimonial-slider-wrapper">
                <div class="swiper testimonial-swiper">
                    <div class="swiper-wrapper">
                <?php
                $test_cards = bcms_arr('bcms_gkt_test_cards');
                if (empty($test_cards)) {
                    $test_cards = [
                        [
                            'quote'   => '"GateKeeper nam je donio standardizovan i dokaziv protokol upravljanja posjetama, uz jasan audit trag ulazaka i izlazaka. Posebno je vrijedno što je proces identifikacije pouzdan, brz i usklađen sa internim bezbjednosnim procedurama."',
                            'company' => 'CKB Banka',
                            'logo'    => get_stylesheet_directory_uri() . '/assets/images/logo/CKBbanka_logo.png',
                        ],
                        [
                            'quote'   => '"U okruženju sa velikim protokom posjetilaca, GateKeeper je značajno smanjio operativni rizik na ulazu i ubrzao rad recepcije. Sistem je jednostavan za korišćenje, a kontrola pristupa je transparentna i mjerljiva."',
                            'company' => 'Telemach',
                            'logo'    => get_stylesheet_directory_uri() . '/assets/images/logo/telemach-crna-gora-feature.jpg',
                        ],
                        [
                            'quote'   => '"Za institucije gdje su bezbjednost i usklađenost ključni, GateKeeper obezbjeđuje jasne evidencije i kontrolisan pristup bez nepotrebne administracije. Proces je standardizovan, a podaci su dostupni za interne provjere i revizije."',
                            'company' => 'Agencija za ljekove – CINMED',
                            'logo'    => get_stylesheet_directory_uri() . '/assets/images/logo/1.png',
                        ],
                        [
                            'quote'   => '"GateKeeper je unaprijedio kontrolu posjetilaca kroz real-time evidenciju i pregledan sistem upravljanja pristupom. Rješenje je praktično, brzo se uklapa u postojeće procedure i smanjuje prostor za propuste na ulazu."',
                            'company' => 'SAT-TRAKT',
                            'logo'    => get_stylesheet_directory_uri() . '/assets/images/logo/satrakt logo.jpg',
                        ],
                        [
                            'quote'   => '"GateKeeper je dobar primjer kako se fizička bezbjednost i informacione procedure mogu povezati u jedinstven tok. Audit trag, korisnička prava i analitika posjeta daju nivo kontrole koji je potreban u ozbiljnim sistemima."',
                            'company' => 'medIT group',
                            'logo'    => get_stylesheet_directory_uri() . '/assets/images/logo/Untitled.png',
                        ],
                    ];
                }

                foreach ($test_cards as $card) :
                ?>
                <div class="swiper-slide">
                    <div class="block">
                    <p><?php echo esc_html($card['quote']); ?></p>
                    <div class="d-flex align-items-start">
                        <img class="author-img" loading="lazy" src="<?php echo esc_url($card['logo']); ?>" alt="<?php echo esc_attr($card['company']); ?>">
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

        <section class="learn_more">
            <div class="wrapper">
                <h2>Webhosts / Website builders looking to offer Titan to your customers?</h2>
                <h5>Titan deeply integrates into your control panels.</h5>
                <div class="cta-container">
                    <a href="https://titan.email/partners" target="_blank" rel="noopener noreferrer">See how Titan works with partners</a>
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
                        $faq_items = [
                            [
                                'q' => 'Da li je GateKeeper usklađen sa GDPR i domaćim Zakonom o zaštiti ličnih podataka?',
                                'a' => 'Da. GateKeeper je razvijen u skladu sa GDPR regulativom i domaćim Zakonom o zaštiti ličnih podataka, uz strogo kontrolisan pristup podacima.',
                            ],
                            [
                                'q' => 'Da li GateKeeper čuva skenirane dokumente ili biometrijske podatke?',
                                'a' => 'Ne. GateKeeper ne zadržava biometrijske podatke niti trajno skladišti skenirane dokumente van sistema institucije, osim ako to nije definisano internim pravilima i važećim propisima.',
                            ],
                            [
                                'q' => 'Kako funkcioniše verifikacija identiteta (Regula Forensics)?',
                                'a' => 'GateKeeper koristi Regula Forensics tehnologiju za pouzdano očitavanje i provjeru identiteta posjetilaca tokom registracije na ulazu.',
                            ],
                            [
                                'q' => 'Da li GateKeeper podržava ISO/IEC 27001 zahtjeve?',
                                'a' => 'Da. Sistem obezbjeđuje audit trag i dokazive evidencije fizičkog pristupa, što direktno pomaže organizacijama koje uvode ili posjeduju ISO/IEC 27001.',
                            ],
                            [
                                'q' => 'Koliko traje implementacija i šta je potrebno sa naše strane?',
                                'a' => 'Implementacija je brza i podrazumijeva konfiguraciju prema strukturi institucije (sektori, zaposleni i pravila pristupa), uz inicijalno podešavanje i kratku obuku po potrebi.',
                            ],
                        ];
                    }

                    foreach ($faq_items as $idx => $faq) :
                        $collapse_id = 'collapseQuery' . ($idx + 1);
                    ?>
                    <div class="faq-card">
                        <button class="faq-acordion-btn" type="button" data-target="#<?php echo esc_attr($collapse_id); ?>" aria-expanded="false" aria-controls="<?php echo esc_attr($collapse_id); ?>">
                            <?php echo esc_html($faq['q']); ?>
                        </button>
                        <div class="collapse" id="<?php echo esc_attr($collapse_id); ?>" hidden>
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
