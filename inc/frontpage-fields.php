<?php
/**
 * Custom meta boxes for Front Page — pure WordPress, no plugins.
 * Fields appear only on the page set as "Static Front Page" in Settings → Reading.
 */

// ─── One-time seed: populate meta fields with existing hardcoded content ───
add_action('admin_init', function () {
    $front_id = (int) get_option('page_on_front');
    if (!$front_id) return;
    if (get_post_meta($front_id, '_fp_fields_seeded', true)) return; // already done

    // HERO
    update_post_meta($front_id, 'fp_hero_tag', 'ClearGreen Solutions');
    update_post_meta($front_id, 'fp_hero_title', 'Povjerenje počinje<br><span class="text-acc">provjerenim</span> identitetom.');
    update_post_meta($front_id, 'fp_hero_desc', 'Digitalna identifikacija, kontrola pristupa i automatizacija poslovanja — za sektore gdje greška košta reputacije.');
    update_post_meta($front_id, 'fp_hero_btn1_text', 'Kontaktirajte nas');
    update_post_meta($front_id, 'fp_hero_btn1_url', '#kontakt');
    update_post_meta($front_id, 'fp_hero_btn2_text', 'Pogledajte naša rješenja');
    update_post_meta($front_id, 'fp_hero_btn2_url', '#usluge');
    update_post_meta($front_id, 'fp_hero_stats', [
        ['number' => '50+', 'label' => 'Klijenata'],
        ['number' => '99.9%', 'label' => 'Uptime'],
        ['number' => '24h', 'label' => 'Pilot setup'],
        ['number' => '5+', 'label' => 'Godina'],
    ]);

    // ABOUT
    update_post_meta($front_id, 'fp_about_tag', 'O nama');
    update_post_meta($front_id, 'fp_about_title', 'Clear<span class="text-acc">Green</span>');
    update_post_meta($front_id, 'fp_about_p1', 'Razvili smo platformu koja povezuje provjeru identiteta, kontrolu pristupa i digitalizaciju procesa. Radimo za banke, telekome i javne institucije — sektore gdje greška košta reputacije.');
    update_post_meta($front_id, 'fp_about_p2', 'Naša rješenja su SaaS i mogu biti on-prem ili cloud hostovana, u skladu s vašim sigurnosnim politikama.');
    update_post_meta($front_id, 'fp_about_p3', 'Vizija nam je da budemo partner svakoj organizaciji koja želi raditi pametnije, isporučiti više i učiniti svoje procese otpornima na greške.');
    update_post_meta($front_id, 'fp_about_btn_text', 'Kontaktirajte nas');
    update_post_meta($front_id, 'fp_about_btn_url', '#kontakt');
    update_post_meta($front_id, 'fp_about_badge_number', '5+');
    update_post_meta($front_id, 'fp_about_badge_text', 'Godina<br>iskustva');

    // WHY US
    update_post_meta($front_id, 'fp_why_tag', 'Zašto sarađivati sa nama?');
    update_post_meta($front_id, 'fp_why_title', 'Radimo u sektorima gdje greška košta <span class="text-acc">reputacije.</span>');
    update_post_meta($front_id, 'fp_why_desc', 'ClearGreen rješenja su aktivna u bankama, institucijama, zdravstvu i logistici — svuda gdje tačnost, sigurnost i usklađenost nisu opcija nego obaveza.');
    update_post_meta($front_id, 'fp_why_cards', [
        ['icon' => 'bank.png', 'title' => 'Banke i finansije', 'desc' => 'Identifikacija klijenata na šalteru — pouzdana, brza i usklađena sa regulatornim zahtjevima.', 'tags' => 'BASIC, Alter One'],
        ['icon' => 'fas fa-landmark', 'title' => 'Javne institucije', 'desc' => 'Kontrola pristupa i digitalna evidencija posjetilaca sa punim audit tragom.', 'tags' => 'GateKeeper, DMS'],
        ['icon' => 'fas fa-satellite-dish', 'title' => 'Telekomunikacije', 'desc' => 'SIM i eSIM aktivacija jedino sa verifikovanim identitetom u core sistemu operatera.', 'tags' => 'SIMPLEX'],
        ['icon' => 'fas fa-truck', 'title' => 'Logistika i javna preduzeća', 'desc' => 'Svako vozilo, svaka ruta i svaki litar goriva — vidljivi i mjerljivi u realnom vremenu.', 'tags' => 'GreenFleet'],
        ['icon' => 'fas fa-parking', 'title' => 'Gradovi i parking servisi', 'desc' => 'Mobilno plaćanje, digitalne dozvole i automatski izvještaji bez papirne administracije.', 'tags' => 'Smart Parking'],
        ['icon' => 'fas fa-heartbeat', 'title' => 'Zdravstvo', 'desc' => 'Digitalni karton, e-posjete i podaci zaštićeni blockchain tehnologijom — dostupni uvijek.', 'tags' => 'e-Zdravstvo'],
    ]);
    update_post_meta($front_id, 'fp_why_bottom_text', 'Nije vaš sektor na listi? Vjerovatno smo ga već riješili.');
    update_post_meta($front_id, 'fp_why_btn_text', 'Kontaktirajte nas');
    update_post_meta($front_id, 'fp_why_btn_url', '#kontakt');

    // SERVICES
    update_post_meta($front_id, 'fp_svc_tag', 'Naše usluge');
    update_post_meta($front_id, 'fp_svc_title', 'Nudimo rješenja koja omogućavaju vašem poslovanju da <span class="text-acc">radi pametnije.</span>');
    update_post_meta($front_id, 'fp_svc_items', [
        ['name' => 'GateKeeper', 'desc' => 'Digitalna portirnica. Kontrola pristupa i evidencija posjetilaca zasnovana na Regula Forensics tehnologiji — GDPR i ISO 27001 usklađena.', 'for_whom' => 'Banke · Institucije · Telekomi · Korporacije', 'link' => 'https://cleargreen.me/gate-keeper/', 'featured' => '1'],
        ['name' => 'BASIC', 'desc' => 'Verifikacija identiteta klijenata na šalteru — MRZ, NFC i OCR čitanje dokumenta za 10 sekundi.', 'for_whom' => 'Banke · Mikrokrediti · Javne institucije', 'link' => '', 'featured' => ''],
        ['name' => 'SIMPLEX', 'desc' => 'SIM i eSIM aktivacija isključivo sa potvrđenim identitetom u core sistemu operatera.', 'for_whom' => 'Telekomunikacijski operateri', 'link' => '', 'featured' => ''],
        ['name' => 'DMS — Document Management', 'desc' => 'Skenirajte, arhivirajte i pretražujte dokumentaciju na jednom mjestu. Revizijski čist, sigurno dijeljenje.', 'for_whom' => 'Svi sektori', 'link' => '', 'featured' => ''],
        ['name' => 'Alter One — Fintech', 'desc' => 'Automatizacija kreditnih procesa, portoflio upravljanje i regulatorni izvještaji za mikrofinansijske institucije.', 'for_whom' => 'Mikrokrediti · Finansije', 'link' => '', 'featured' => ''],
        ['name' => 'GreenFleet — GPS & Flota', 'desc' => 'Praćenje vozila u realnom vremenu, CAN analiza, potrošnja goriva i optimizacija ruta.', 'for_whom' => 'Logistika · Distribucija · Javna preduzeća', 'link' => '', 'featured' => ''],
        ['name' => 'Smart Parking', 'desc' => 'Mobilno plaćanje parkinga, digitalne dozvole i analitika za operatere i gradove.', 'for_whom' => 'Gradovi · Parking servisi · Turizam', 'link' => '', 'featured' => ''],
        ['name' => 'e-Zdravstvo', 'desc' => 'Digitalni karton pacijenta, e-posjete i blockchain zaštita medicinskih podataka.', 'for_whom' => 'Zdravstvene ustanove', 'link' => '', 'featured' => ''],
        ['name' => 'CRM & poslovni softver', 'desc' => 'CRM po mjeri — praćenje prodaje, klijenata i poslovnih procesa u jednom sistemu.', 'for_whom' => 'Preduzeća svih sektora', 'link' => '', 'featured' => ''],
    ]);
    update_post_meta($front_id, 'fp_svc_btn_text', 'Stupite u kontakt');
    update_post_meta($front_id, 'fp_svc_btn_url', '#kontakt');

    // CTA BANNER
    update_post_meta($front_id, 'fp_cta_title', 'Spremni da svoj projekat pretvorite u <em>stvarnost?</em>');
    update_post_meta($front_id, 'fp_cta_btn_text', 'Kontaktirajte nas');
    update_post_meta($front_id, 'fp_cta_btn_url', '#kontakt');

    // PROCESS
    update_post_meta($front_id, 'fp_proc_tag', 'Naš proces – jednostavan i pouzdan');
    update_post_meta($front_id, 'fp_proc_title', 'Postavljamo prilagođeni pilot u roku od <span class="text-acc">24h.</span>');
    update_post_meta($front_id, 'fp_proc_btn_text', 'Kontaktirajte nas');
    update_post_meta($front_id, 'fp_proc_btn_url', '#kontakt');
    update_post_meta($front_id, 'fp_proc_steps', [
        ['number' => '1', 'title' => 'Razumijemo procese, dizajniramo rješenje', 'desc' => 'Brzo mapiramo gdje nastaju rizici: identitet, pristup, dokumenti i operacije. Na toj osnovi sklapamo ciljnu arhitekturu prilagođenu vašim potrebama.'],
        ['number' => '2', 'title' => 'Pilot u realnim uslovima', 'desc' => 'U roku od 24 sata postavljamo prilagođeni pilot u vašem okruženju i povezujemo ga sa core sistemima. Testiranje na stvarnim procesima — odmah.'],
        ['number' => '3', 'title' => 'Implementacija i podrška', 'desc' => 'Glatka tranzicija, obuka zaposlenih i tehnička dokumentacija. Nakon pokretanja, ostajemo vaš partner za sve nadogradnje i podršku.'],
    ]);

    // TESTIMONIALS
    update_post_meta($front_id, 'fp_test_tag', 'Partneri');
    update_post_meta($front_id, 'fp_test_title', 'Šta kažu <span class="text-acc">o nama</span>');
    update_post_meta($front_id, 'fp_test_partners', [
        ['name' => 'Adriatic Bank'], ['name' => 'Alter Modus'], ['name' => 'CKB Banka'],
        ['name' => 'Telemach'], ['name' => 'B-ONE'], ['name' => 'CINMED'],
        ['name' => 'SAT-TRAKT'], ['name' => 'Permar Plus'], ['name' => '2AI4ME'],
    ]);
    update_post_meta($front_id, 'fp_test_cards', [
        ['quote' => 'Saradnja sa Cleargreen timom značajno je unaprijedila digitalne procese u mikrofinansijama.', 'company' => 'Alter Modus', 'logo' => ''],
        ['quote' => 'Cleargreen je implementirao softver za identifikaciju u naših devet poslovnica — proces je sigurniji i efikasniji.', 'company' => 'Adriatic Bank', 'logo' => ''],
        ['quote' => 'Instalacijom Cleargreen GateKeeper sistema značajno smo unaprijedili kontrolu pristupa i sigurnost u poslovnoj zgradi.', 'company' => 'CKB Banka', 'logo' => ''],
        ['quote' => 'U okruženju sa velikim protokom posjetilaca, GateKeeper je značajno smanjio operativni rizik na ulazu i ubrzao rad recepcije.', 'company' => 'Telemach', 'logo' => ''],
        ['quote' => 'Zajedno sa Cleargreen-om razvijamo napredne informaciono-komunikacione sisteme za klijente širom regiona.', 'company' => 'B-ONE', 'logo' => ''],
        ['quote' => 'Naše AI inovacije, uz Cleargreen-ovu ekspertizu, donose praktične alate za poslovnu transformaciju.', 'company' => 'CINMED', 'logo' => ''],
    ]);

    // CONTACT
    update_post_meta($front_id, 'fp_contact_tag', 'Kontakt');
    update_post_meta($front_id, 'fp_contact_title', 'Spremni da svoj projekat pretvorite u <span class="text-acc">stvarnost?</span>');
    update_post_meta($front_id, 'fp_contact_desc', 'Hajde da razgovaramo o tome kako vam možemo pomoći. Odgovaramo u roku od 24 sata.');
    update_post_meta($front_id, 'fp_contact_email', 'stefan.planic@cleargreen.me');
    update_post_meta($front_id, 'fp_contact_phone', '+382 (0) 68 090 161');
    update_post_meta($front_id, 'fp_contact_phone_raw', '+38268090161');
    update_post_meta($front_id, 'fp_contact_form_title', 'Pošaljite nam poruku');
    update_post_meta($front_id, 'fp_contact_form_sub', 'Odgovaramo u roku od 24 sata.');

    // Mark as done — this seed runs only once
    update_post_meta($front_id, '_fp_fields_seeded', '1');
});

// ─── Register all meta boxes ───
add_action('add_meta_boxes', function () {
    $front_id = (int) get_option('page_on_front');
    if (!$front_id) return;

    $boxes = [
        'fp_hero'         => 'Front Page — Hero',
        'fp_about'        => 'Front Page — O nama',
        'fp_why'          => 'Front Page — Zašto mi',
        'fp_services'     => 'Front Page — Usluge',
        'fp_cta'          => 'Front Page — CTA Banner',
        'fp_process'      => 'Front Page — Proces',
        'fp_testimonials' => 'Front Page — Testimonijali',
        'fp_contact'      => 'Front Page — Kontakt',
    ];

    foreach ($boxes as $id => $title) {
        add_meta_box($id, $title, "fp_render_{$id}", 'page', 'normal', 'high');
    }
});

// Only show meta boxes on the front page
add_action('admin_head', function () {
    global $post;
    if (!$post) return;
    $front_id = (int) get_option('page_on_front');
    if ($post->ID !== $front_id) {
        $boxes = ['fp_hero','fp_about','fp_why','fp_services','fp_cta','fp_process','fp_testimonials','fp_contact'];
        foreach ($boxes as $id) {
            remove_meta_box($id, 'page', 'normal');
        }
    }
});

// ─── Admin styles & repeater JS ───
add_action('admin_enqueue_scripts', function ($hook) {
    if (!in_array($hook, ['post.php', 'post-new.php'])) return;
    global $post;
    if (!$post || $post->ID !== (int) get_option('page_on_front')) return;

    wp_enqueue_media();

    wp_add_inline_style('wp-admin', '
        .fp-field { margin-bottom:18px }
        .fp-field label { display:block; font-weight:600; margin-bottom:4px; font-size:13px }
        .fp-field input[type=text],
        .fp-field input[type=url],
        .fp-field textarea { width:100%; padding:8px }
        .fp-field textarea { min-height:80px }
        .fp-repeater-item { background:#f9f9f9; border:1px solid #ddd; border-radius:6px; padding:14px; margin-bottom:12px; position:relative }
        .fp-repeater-item .fp-remove { position:absolute; top:8px; right:8px; color:#b32d2e; cursor:pointer; background:none; border:none; font-size:18px }
        .fp-add-btn { margin-top:8px }
        .fp-img-preview { max-width:120px; height:auto; display:block; margin-top:6px; border-radius:6px }
        .fp-img-wrap { display:flex; align-items:center; gap:12px; margin-top:6px }
    ');

    wp_add_inline_script('jquery-core', '
    jQuery(function($){
        /* Add repeater item */
        $(document).on("click",".fp-add-row",function(e){
            e.preventDefault();
            var $wrap = $(this).closest(".fp-repeater");
            var $tmpl = $wrap.find(".fp-repeater-template");
            var html  = $tmpl.html().replace(/__i__/g, Date.now());
            $wrap.find(".fp-repeater-items").append("<div class=\"fp-repeater-item\">" + html + "</div>");
        });
        /* Remove repeater item */
        $(document).on("click",".fp-remove",function(e){
            e.preventDefault();
            $(this).closest(".fp-repeater-item").remove();
        });
        /* Image picker */
        $(document).on("click",".fp-pick-image",function(e){
            e.preventDefault();
            var $btn = $(this);
            var $wrap = $btn.closest(".fp-img-field");
            var frame = wp.media({ title:"Izaberi sliku", multiple:false, library:{type:"image"} });
            frame.on("select",function(){
                var att = frame.state().get("selection").first().toJSON();
                $wrap.find(".fp-img-id").val(att.id);
                var src = att.sizes && att.sizes.thumbnail ? att.sizes.thumbnail.url : att.url;
                $wrap.find(".fp-img-preview").remove();
                $wrap.find(".fp-img-wrap").append("<img class=\"fp-img-preview\" src=\""+src+"\">");
                $wrap.find(".fp-remove-image").show();
            });
            frame.open();
        });
        $(document).on("click",".fp-remove-image",function(e){
            e.preventDefault();
            var $wrap = $(this).closest(".fp-img-field");
            $wrap.find(".fp-img-id").val("");
            $wrap.find(".fp-img-preview").remove();
            $(this).hide();
        });
        /* Sortable repeater */
        $(".fp-repeater-items").sortable({ handle:".fp-repeater-item", cursor:"move" });
    });
    ');
});

// ─── Helper: text field ───
function fp_text($key, $post_id, $label, $placeholder = '') {
    $val = get_post_meta($post_id, $key, true);
    echo '<div class="fp-field">';
    echo '<label>' . esc_html($label) . '</label>';
    echo '<input type="text" name="' . esc_attr($key) . '" value="' . esc_attr($val) . '" placeholder="' . esc_attr($placeholder) . '">';
    echo '</div>';
}

// ─── Helper: textarea field ───
function fp_textarea($key, $post_id, $label, $placeholder = '') {
    $val = get_post_meta($post_id, $key, true);
    echo '<div class="fp-field">';
    echo '<label>' . esc_html($label) . '</label>';
    echo '<textarea name="' . esc_attr($key) . '" placeholder="' . esc_attr($placeholder) . '">' . esc_textarea($val) . '</textarea>';
    echo '</div>';
}

// ─── Helper: image field ───
function fp_image($key, $post_id, $label) {
    $img_id = get_post_meta($post_id, $key, true);
    $img_url = $img_id ? wp_get_attachment_image_url($img_id, 'thumbnail') : '';
    echo '<div class="fp-field fp-img-field">';
    echo '<label>' . esc_html($label) . '</label>';
    echo '<div class="fp-img-wrap">';
    echo '<input type="hidden" class="fp-img-id" name="' . esc_attr($key) . '" value="' . esc_attr($img_id) . '">';
    echo '<button type="button" class="button fp-pick-image">Izaberi sliku</button>';
    echo '<button type="button" class="button fp-remove-image" style="' . ($img_id ? '' : 'display:none') . '">Ukloni</button>';
    if ($img_url) {
        echo '<img class="fp-img-preview" src="' . esc_url($img_url) . '">';
    }
    echo '</div></div>';
}


/* ================================================================
   RENDER CALLBACKS
   ================================================================ */

// ─── HERO ───
function fp_render_fp_hero($post) {
    wp_nonce_field('fp_save', 'fp_nonce');
    $id = $post->ID;
    fp_text('fp_hero_tag', $id, 'Tag (mali tekst iznad naslova)', 'ClearGreen Solutions');
    fp_textarea('fp_hero_title', $id, 'Naslov (HTML dozvoljen: &lt;br&gt;, &lt;span class="text-acc"&gt;)', 'Povjerenje počinje<br><span class="text-acc">provjerenim</span> identitetom.');
    fp_textarea('fp_hero_desc', $id, 'Podnaslov / opis');
    echo '<hr>';
    fp_text('fp_hero_btn1_text', $id, 'Dugme 1 — tekst', 'Kontaktirajte nas');
    fp_text('fp_hero_btn1_url', $id, 'Dugme 1 — link', '#kontakt');
    fp_text('fp_hero_btn2_text', $id, 'Dugme 2 — tekst', 'Pogledajte naša rješenja');
    fp_text('fp_hero_btn2_url', $id, 'Dugme 2 — link', '#usluge');
    echo '<hr><p><strong>Statistike</strong></p>';

    $stats = get_post_meta($id, 'fp_hero_stats', true);
    if (!is_array($stats)) $stats = [];
    echo '<div class="fp-repeater">';
    echo '<div class="fp-repeater-items">';
    foreach ($stats as $i => $s) {
        echo '<div class="fp-repeater-item">';
        echo '<button type="button" class="fp-remove">&times;</button>';
        echo '<div class="fp-field"><label>Broj</label><input type="text" name="fp_hero_stats[' . $i . '][number]" value="' . esc_attr($s['number'] ?? '') . '"></div>';
        echo '<div class="fp-field"><label>Label</label><input type="text" name="fp_hero_stats[' . $i . '][label]" value="' . esc_attr($s['label'] ?? '') . '"></div>';
        echo '</div>';
    }
    echo '</div>';
    echo '<script type="text/html" class="fp-repeater-template">';
    echo '<button type="button" class="fp-remove">&times;</button>';
    echo '<div class="fp-field"><label>Broj</label><input type="text" name="fp_hero_stats[__i__][number]"></div>';
    echo '<div class="fp-field"><label>Label</label><input type="text" name="fp_hero_stats[__i__][label]"></div>';
    echo '</script>';
    echo '<button type="button" class="button fp-add-btn fp-add-row">+ Dodaj statistiku</button>';
    echo '</div>';
}

// ─── ABOUT ───
function fp_render_fp_about($post) {
    $id = $post->ID;
    fp_text('fp_about_tag', $id, 'Tag', 'O nama');
    fp_textarea('fp_about_title', $id, 'Naslov (HTML dozvoljen)', 'Clear<span class="text-acc">Green</span>');
    fp_textarea('fp_about_p1', $id, 'Paragraf 1');
    fp_textarea('fp_about_p2', $id, 'Paragraf 2');
    fp_textarea('fp_about_p3', $id, 'Paragraf 3');
    fp_text('fp_about_btn_text', $id, 'Dugme tekst', 'Kontaktirajte nas');
    fp_text('fp_about_btn_url', $id, 'Dugme link', '#kontakt');
    echo '<hr>';
    fp_image('fp_about_image', $id, 'Slika');
    fp_text('fp_about_badge_number', $id, 'Badge broj', '5+');
    fp_text('fp_about_badge_text', $id, 'Badge tekst', 'Godina iskustva');
}

// ─── WHY US ───
function fp_render_fp_why($post) {
    $id = $post->ID;
    fp_text('fp_why_tag', $id, 'Tag', 'Zašto sarađivati sa nama?');
    fp_textarea('fp_why_title', $id, 'Naslov (HTML dozvoljen)');
    fp_textarea('fp_why_desc', $id, 'Opis ispod naslova');
    echo '<hr><p><strong>Kartice sektora</strong></p>';

    $cards = get_post_meta($id, 'fp_why_cards', true);
    if (!is_array($cards)) $cards = [];
    echo '<div class="fp-repeater">';
    echo '<div class="fp-repeater-items">';
    foreach ($cards as $i => $c) {
        echo '<div class="fp-repeater-item">';
        echo '<button type="button" class="fp-remove">&times;</button>';
        echo '<div class="fp-field"><label>Font Awesome ikona klasa</label><input type="text" name="fp_why_cards[' . $i . '][icon]" value="' . esc_attr($c['icon'] ?? '') . '" placeholder="fas fa-university"></div>';
        echo '<div class="fp-field"><label>Naslov</label><input type="text" name="fp_why_cards[' . $i . '][title]" value="' . esc_attr($c['title'] ?? '') . '"></div>';
        echo '<div class="fp-field"><label>Opis</label><textarea name="fp_why_cards[' . $i . '][desc]">' . esc_textarea($c['desc'] ?? '') . '</textarea></div>';
        echo '<div class="fp-field"><label>Tagovi (razdvojeni zarezom)</label><input type="text" name="fp_why_cards[' . $i . '][tags]" value="' . esc_attr($c['tags'] ?? '') . '" placeholder="BASIC, Alter One"></div>';
        echo '</div>';
    }
    echo '</div>';
    echo '<script type="text/html" class="fp-repeater-template">';
    echo '<button type="button" class="fp-remove">&times;</button>';
    echo '<div class="fp-field"><label>Font Awesome ikona klasa</label><input type="text" name="fp_why_cards[__i__][icon]" placeholder="fas fa-university"></div>';
    echo '<div class="fp-field"><label>Naslov</label><input type="text" name="fp_why_cards[__i__][title]"></div>';
    echo '<div class="fp-field"><label>Opis</label><textarea name="fp_why_cards[__i__][desc]"></textarea></div>';
    echo '<div class="fp-field"><label>Tagovi (razdvojeni zarezom)</label><input type="text" name="fp_why_cards[__i__][tags]" placeholder="BASIC, Alter One"></div>';
    echo '</script>';
    echo '<button type="button" class="button fp-add-btn fp-add-row">+ Dodaj karticu</button>';
    echo '</div>';
    echo '<hr>';
    fp_text('fp_why_bottom_text', $id, 'Tekst ispod kartica', 'Nije vaš sektor na listi? Vjerovatno smo ga već riješili.');
    fp_text('fp_why_btn_text', $id, 'Dugme tekst', 'Kontaktirajte nas');
    fp_text('fp_why_btn_url', $id, 'Dugme link', '#kontakt');
}

// ─── SERVICES ───
function fp_render_fp_services($post) {
    $id = $post->ID;
    fp_text('fp_svc_tag', $id, 'Tag', 'Naše usluge');
    fp_textarea('fp_svc_title', $id, 'Naslov (HTML dozvoljen)');
    echo '<hr><p><strong>Usluge / proizvodi</strong></p>';

    $items = get_post_meta($id, 'fp_svc_items', true);
    if (!is_array($items)) $items = [];
    echo '<div class="fp-repeater">';
    echo '<div class="fp-repeater-items">';
    foreach ($items as $i => $s) {
        $feat = !empty($s['featured']) ? 'checked' : '';
        echo '<div class="fp-repeater-item">';
        echo '<button type="button" class="fp-remove">&times;</button>';
        echo '<div class="fp-field"><label>Naziv</label><input type="text" name="fp_svc_items[' . $i . '][name]" value="' . esc_attr($s['name'] ?? '') . '"></div>';
        echo '<div class="fp-field"><label>Opis</label><textarea name="fp_svc_items[' . $i . '][desc]">' . esc_textarea($s['desc'] ?? '') . '</textarea></div>';
        echo '<div class="fp-field"><label>Za koga</label><input type="text" name="fp_svc_items[' . $i . '][for_whom]" value="' . esc_attr($s['for_whom'] ?? '') . '"></div>';
        echo '<div class="fp-field"><label>Link (opciono)</label><input type="text" name="fp_svc_items[' . $i . '][link]" value="' . esc_attr($s['link'] ?? '') . '"></div>';
        echo '<div class="fp-field"><label><input type="checkbox" name="fp_svc_items[' . $i . '][featured]" value="1" ' . $feat . '> Featured (istaknuta)</label></div>';
        echo '</div>';
    }
    echo '</div>';
    echo '<script type="text/html" class="fp-repeater-template">';
    echo '<button type="button" class="fp-remove">&times;</button>';
    echo '<div class="fp-field"><label>Naziv</label><input type="text" name="fp_svc_items[__i__][name]"></div>';
    echo '<div class="fp-field"><label>Opis</label><textarea name="fp_svc_items[__i__][desc]"></textarea></div>';
    echo '<div class="fp-field"><label>Za koga</label><input type="text" name="fp_svc_items[__i__][for_whom]"></div>';
    echo '<div class="fp-field"><label>Link (opciono)</label><input type="text" name="fp_svc_items[__i__][link]"></div>';
    echo '<div class="fp-field"><label><input type="checkbox" name="fp_svc_items[__i__][featured]" value="1"> Featured (istaknuta)</label></div>';
    echo '</script>';
    echo '<button type="button" class="button fp-add-btn fp-add-row">+ Dodaj uslugu</button>';
    echo '</div>';
    echo '<hr>';
    fp_text('fp_svc_btn_text', $id, 'Dugme tekst', 'Stupite u kontakt');
    fp_text('fp_svc_btn_url', $id, 'Dugme link', '#kontakt');
}

// ─── CTA BANNER ───
function fp_render_fp_cta($post) {
    $id = $post->ID;
    fp_textarea('fp_cta_title', $id, 'Naslov (HTML dozvoljen)', 'Spremni da svoj projekat pretvorite u <em>stvarnost?</em>');
    fp_text('fp_cta_btn_text', $id, 'Dugme tekst', 'Kontaktirajte nas');
    fp_text('fp_cta_btn_url', $id, 'Dugme link', '#kontakt');
}

// ─── PROCESS ───
function fp_render_fp_process($post) {
    $id = $post->ID;
    fp_text('fp_proc_tag', $id, 'Tag', 'Naš proces – jednostavan i pouzdan');
    fp_textarea('fp_proc_title', $id, 'Naslov (HTML dozvoljen)');
    fp_text('fp_proc_btn_text', $id, 'Dugme tekst', 'Kontaktirajte nas');
    fp_text('fp_proc_btn_url', $id, 'Dugme link', '#kontakt');
    echo '<hr><p><strong>Koraci</strong></p>';

    $steps = get_post_meta($id, 'fp_proc_steps', true);
    if (!is_array($steps)) $steps = [];
    echo '<div class="fp-repeater">';
    echo '<div class="fp-repeater-items">';
    foreach ($steps as $i => $s) {
        echo '<div class="fp-repeater-item">';
        echo '<button type="button" class="fp-remove">&times;</button>';
        echo '<div class="fp-field"><label>Broj</label><input type="text" name="fp_proc_steps[' . $i . '][number]" value="' . esc_attr($s['number'] ?? '') . '"></div>';
        echo '<div class="fp-field"><label>Naslov</label><input type="text" name="fp_proc_steps[' . $i . '][title]" value="' . esc_attr($s['title'] ?? '') . '"></div>';
        echo '<div class="fp-field"><label>Opis</label><textarea name="fp_proc_steps[' . $i . '][desc]">' . esc_textarea($s['desc'] ?? '') . '</textarea></div>';
        echo '</div>';
    }
    echo '</div>';
    echo '<script type="text/html" class="fp-repeater-template">';
    echo '<button type="button" class="fp-remove">&times;</button>';
    echo '<div class="fp-field"><label>Broj</label><input type="text" name="fp_proc_steps[__i__][number]"></div>';
    echo '<div class="fp-field"><label>Naslov</label><input type="text" name="fp_proc_steps[__i__][title]"></div>';
    echo '<div class="fp-field"><label>Opis</label><textarea name="fp_proc_steps[__i__][desc]"></textarea></div>';
    echo '</script>';
    echo '<button type="button" class="button fp-add-btn fp-add-row">+ Dodaj korak</button>';
    echo '</div>';
}

// ─── TESTIMONIALS ───
function fp_render_fp_testimonials($post) {
    $id = $post->ID;
    fp_text('fp_test_tag', $id, 'Tag', 'Partneri');
    fp_textarea('fp_test_title', $id, 'Naslov (HTML dozvoljen)', 'Šta kažu <span class="text-acc">o nama</span>');

    echo '<hr><p><strong>Partner logotipi (traka)</strong></p>';
    $partners = get_post_meta($id, 'fp_test_partners', true);
    if (!is_array($partners)) $partners = [];
    echo '<div class="fp-repeater">';
    echo '<div class="fp-repeater-items">';
    foreach ($partners as $i => $p) {
        echo '<div class="fp-repeater-item">';
        echo '<button type="button" class="fp-remove">&times;</button>';
        echo '<div class="fp-field"><label>Ime partnera</label><input type="text" name="fp_test_partners[' . $i . '][name]" value="' . esc_attr($p['name'] ?? '') . '"></div>';
        echo '</div>';
    }
    echo '</div>';
    echo '<script type="text/html" class="fp-repeater-template">';
    echo '<button type="button" class="fp-remove">&times;</button>';
    echo '<div class="fp-field"><label>Ime partnera</label><input type="text" name="fp_test_partners[__i__][name]"></div>';
    echo '</script>';
    echo '<button type="button" class="button fp-add-btn fp-add-row">+ Dodaj partnera</button>';
    echo '</div>';

    echo '<hr><p><strong>Testimonijal kartice</strong></p>';
    $cards = get_post_meta($id, 'fp_test_cards', true);
    if (!is_array($cards)) $cards = [];
    echo '<div class="fp-repeater">';
    echo '<div class="fp-repeater-items">';
    foreach ($cards as $i => $c) {
        $logo_id  = $c['logo'] ?? '';
        $logo_url = $logo_id ? wp_get_attachment_image_url($logo_id, 'thumbnail') : '';
        echo '<div class="fp-repeater-item">';
        echo '<button type="button" class="fp-remove">&times;</button>';
        echo '<div class="fp-field"><label>Citat</label><textarea name="fp_test_cards[' . $i . '][quote]">' . esc_textarea($c['quote'] ?? '') . '</textarea></div>';
        echo '<div class="fp-field"><label>Kompanija</label><input type="text" name="fp_test_cards[' . $i . '][company]" value="' . esc_attr($c['company'] ?? '') . '"></div>';
        echo '<div class="fp-field fp-img-field"><label>Logo kompanije</label>';
        echo '<div class="fp-img-wrap">';
        echo '<input type="hidden" class="fp-img-id" name="fp_test_cards[' . $i . '][logo]" value="' . esc_attr($logo_id) . '">';
        echo '<button type="button" class="button fp-pick-image">Izaberi</button>';
        echo '<button type="button" class="button fp-remove-image" style="' . ($logo_id ? '' : 'display:none') . '">Ukloni</button>';
        if ($logo_url) echo '<img class="fp-img-preview" src="' . esc_url($logo_url) . '">';
        echo '</div></div>';
        echo '</div>';
    }
    echo '</div>';
    echo '<script type="text/html" class="fp-repeater-template">';
    echo '<button type="button" class="fp-remove">&times;</button>';
    echo '<div class="fp-field"><label>Citat</label><textarea name="fp_test_cards[__i__][quote]"></textarea></div>';
    echo '<div class="fp-field"><label>Kompanija</label><input type="text" name="fp_test_cards[__i__][company]"></div>';
    echo '<div class="fp-field fp-img-field"><label>Logo kompanije</label>';
    echo '<div class="fp-img-wrap">';
    echo '<input type="hidden" class="fp-img-id" name="fp_test_cards[__i__][logo]" value="">';
    echo '<button type="button" class="button fp-pick-image">Izaberi</button>';
    echo '<button type="button" class="button fp-remove-image" style="display:none">Ukloni</button>';
    echo '</div></div>';
    echo '</script>';
    echo '<button type="button" class="button fp-add-btn fp-add-row">+ Dodaj testimonijal</button>';
    echo '</div>';
}

// ─── CONTACT ───
function fp_render_fp_contact($post) {
    $id = $post->ID;
    fp_text('fp_contact_tag', $id, 'Tag', 'Kontakt');
    fp_textarea('fp_contact_title', $id, 'Naslov (HTML dozvoljen)');
    fp_textarea('fp_contact_desc', $id, 'Opis');
    fp_text('fp_contact_email', $id, 'Email', 'stefan.planic@cleargreen.me');
    fp_text('fp_contact_phone', $id, 'Telefon', '+382 (0) 68 090 161');
    fp_text('fp_contact_phone_raw', $id, 'Telefon (tel: link format)', '+38268090161');
    echo '<hr>';
    fp_text('fp_contact_form_title', $id, 'Naslov forme', 'Pošaljite nam poruku');
    fp_text('fp_contact_form_sub', $id, 'Podnaslov forme', 'Odgovaramo u roku od 24 sata.');
}


/* ================================================================
   SAVE
   ================================================================ */
add_action('save_post', function ($post_id) {
    if (!isset($_POST['fp_nonce']) || !wp_verify_nonce($_POST['fp_nonce'], 'fp_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Simple text/textarea fields
    $text_keys = [
        'fp_hero_tag', 'fp_hero_title', 'fp_hero_desc',
        'fp_hero_btn1_text', 'fp_hero_btn1_url', 'fp_hero_btn2_text', 'fp_hero_btn2_url',
        'fp_about_tag', 'fp_about_title', 'fp_about_p1', 'fp_about_p2', 'fp_about_p3',
        'fp_about_btn_text', 'fp_about_btn_url', 'fp_about_image',
        'fp_about_badge_number', 'fp_about_badge_text',
        'fp_why_tag', 'fp_why_title', 'fp_why_desc',
        'fp_why_bottom_text', 'fp_why_btn_text', 'fp_why_btn_url',
        'fp_svc_tag', 'fp_svc_title', 'fp_svc_btn_text', 'fp_svc_btn_url',
        'fp_cta_title', 'fp_cta_btn_text', 'fp_cta_btn_url',
        'fp_proc_tag', 'fp_proc_title', 'fp_proc_btn_text', 'fp_proc_btn_url',
        'fp_test_tag', 'fp_test_title',
        'fp_contact_tag', 'fp_contact_title', 'fp_contact_desc',
        'fp_contact_email', 'fp_contact_phone', 'fp_contact_phone_raw',
        'fp_contact_form_title', 'fp_contact_form_sub',
    ];

    // Fields that allow safe HTML
    $html_keys = [
        'fp_hero_title', 'fp_about_title', 'fp_why_title', 'fp_svc_title',
        'fp_cta_title', 'fp_proc_title', 'fp_test_title', 'fp_contact_title',
    ];

    foreach ($text_keys as $key) {
        if (isset($_POST[$key])) {
            $val = in_array($key, $html_keys)
                ? wp_kses($_POST[$key], [
                    'br'   => [], 'span' => ['class' => []], 'em' => [], 'strong' => [],
                  ])
                : sanitize_text_field($_POST[$key]);
            update_post_meta($post_id, $key, $val);
        }
    }

    // Array/repeater fields
    $array_keys = [
        'fp_hero_stats', 'fp_why_cards', 'fp_svc_items',
        'fp_proc_steps', 'fp_test_partners', 'fp_test_cards',
    ];

    foreach ($array_keys as $key) {
        if (isset($_POST[$key]) && is_array($_POST[$key])) {
            $clean = [];
            foreach ($_POST[$key] as $item) {
                if (!is_array($item)) continue;
                $row = [];
                foreach ($item as $k => $v) {
                    $row[sanitize_key($k)] = sanitize_text_field($v);
                }
                $clean[] = $row;
            }
            update_post_meta($post_id, $key, $clean);
        } else {
            delete_post_meta($post_id, $key);
        }
    }
});
