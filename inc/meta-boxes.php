<?php
/**
 * ClearGreen CMS — Custom meta boxes for ALL page templates.
 * Pure WordPress, zero plugins. Prefix: bcms_
 */

// ─── Defaults.json loader (cached per request) ───
function bcms_defaults($key = null) {
    static $defaults = null;
    if ($defaults === null) {
        $file = get_stylesheet_directory() . '/defaults.json';
        if (file_exists($file)) {
            $json = file_get_contents($file);
            $defaults = json_decode($json, true);
            if (!is_array($defaults)) $defaults = [];
        } else {
            $defaults = [];
        }
    }
    if ($key === null) return $defaults;
    return array_key_exists($key, $defaults) ? $defaults[$key] : null;
}

// ─── Helpers ───
function bcms_get($key, $default = '', $post_id = null) {
    if (!$post_id) $post_id = get_the_ID();
    if (!$post_id) {
        $json_default = bcms_defaults($key);
        return ($json_default !== null) ? $json_default : $default;
    }
    $v = get_post_meta($post_id, $key, true);
    if ($v !== '' && $v !== false) return $v;
    $json_default = bcms_defaults($key);
    return ($json_default !== null) ? $json_default : $default;
}
function bcms_arr($key, $post_id = null) {
    if (!$post_id) $post_id = get_the_ID();
    if (!$post_id) {
        $json_default = bcms_defaults($key);
        return is_array($json_default) ? $json_default : [];
    }
    $v = get_post_meta($post_id, $key, true);
    if (is_array($v) && !empty($v)) return $v;
    $json_default = bcms_defaults($key);
    return is_array($json_default) ? $json_default : [];
}

// ─── Field renderers ───
function bcms_f_text($key, $pid, $label, $ph = '') {
    $v = get_post_meta($pid, $key, true);
    if ($v === '' || $v === false) {
        $d = bcms_defaults($key);
        if ($d !== null) $v = $d;
    }
    echo '<div class="bcms-f"><label>' . esc_html($label) . '</label>';
    echo '<input type="text" name="' . esc_attr($key) . '" value="' . esc_attr($v) . '" placeholder="' . esc_attr($ph) . '"></div>';
}
function bcms_f_area($key, $pid, $label, $ph = '') {
    $v = get_post_meta($pid, $key, true);
    if ($v === '' || $v === false) {
        $d = bcms_defaults($key);
        if ($d !== null) $v = $d;
    }
    echo '<div class="bcms-f"><label>' . esc_html($label) . '</label>';
    echo '<textarea name="' . esc_attr($key) . '" placeholder="' . esc_attr($ph) . '">' . esc_textarea($v) . '</textarea></div>';
}
function bcms_f_img($key, $pid, $label) {
    $id = get_post_meta($pid, $key, true);
    if (($id === '' || $id === false)) {
        $d = bcms_defaults($key);
        if ($d !== null) $id = $d;
    }
    $url = $id ? wp_get_attachment_image_url($id, 'thumbnail') : '';
    echo '<div class="bcms-f bcms-img-f"><label>' . esc_html($label) . '</label><div class="bcms-img-w">';
    echo '<input type="hidden" class="bcms-img-id" name="' . esc_attr($key) . '" value="' . esc_attr($id) . '">';
    echo '<button type="button" class="button bcms-pick">Izaberi</button>';
    echo '<button type="button" class="button bcms-unpick" style="' . ($id ? '' : 'display:none') . '">Ukloni</button>';
    if ($url) echo '<img class="bcms-img-p" src="' . esc_url($url) . '">';
    echo '</div></div>';
}
function bcms_repeater_start($key, $pid) {
    $items = get_post_meta($pid, $key, true);
    if (!is_array($items) || empty($items)) {
        $d = bcms_defaults($key);
        $items = is_array($d) ? $d : [];
    }
    echo '<div class="bcms-rep" data-key="' . esc_attr($key) . '"><div class="bcms-rep-items">';
    return $items;
}
function bcms_repeater_end($key, $label = '+ Dodaj') {
    echo '</div><script type="text/html" class="bcms-rep-tmpl">';
}
function bcms_repeater_close($label = '+ Dodaj') {
    echo '</script><button type="button" class="button bcms-add-btn bcms-add-row">' . esc_html($label) . '</button></div>';
}

// ─── Admin CSS & JS ───
add_action('admin_enqueue_scripts', function($hook) {
    if (!in_array($hook, ['post.php', 'post-new.php'])) return;
    if (get_post_type() !== 'page') return;
    wp_enqueue_media();
    wp_add_inline_style('wp-admin', '
        .bcms-f{margin-bottom:16px}.bcms-f label{display:block;font-weight:600;margin-bottom:4px;font-size:13px}
        .bcms-f input[type=text],.bcms-f input[type=url],.bcms-f textarea{width:100%;padding:8px}
        .bcms-f textarea{min-height:80px}
        .bcms-rep-item{background:#f9f9f9;border:1px solid #ddd;border-radius:6px;padding:14px;margin-bottom:12px;position:relative}
        .bcms-rep-item .bcms-rm{position:absolute;top:8px;right:8px;color:#b32d2e;cursor:pointer;background:none;border:none;font-size:18px}
        .bcms-add-btn{margin-top:8px}
        .bcms-img-p{max-width:120px;height:auto;display:block;margin-top:6px;border-radius:6px}
        .bcms-img-w{display:flex;align-items:center;gap:12px;margin-top:6px}
    ');
    wp_add_inline_script('jquery-core', '
    jQuery(function($){
        $(document).on("click",".bcms-add-row",function(e){
            e.preventDefault();
            var $w=$(this).closest(".bcms-rep"),$t=$w.find(".bcms-rep-tmpl");
            var h=$t.html().replace(/__i__/g,Date.now());
            $w.find(".bcms-rep-items").append("<div class=\"bcms-rep-item\">"+h+"</div>");
        });
        $(document).on("click",".bcms-rm",function(e){e.preventDefault();$(this).closest(".bcms-rep-item").remove();});
        $(document).on("click",".bcms-pick",function(e){
            e.preventDefault();var $b=$(this),$w=$b.closest(".bcms-img-f");
            var fr=wp.media({title:"Izaberi sliku",multiple:false,library:{type:"image"}});
            fr.on("select",function(){
                var a=fr.state().get("selection").first().toJSON();
                $w.find(".bcms-img-id").val(a.id);
                var s=a.sizes&&a.sizes.thumbnail?a.sizes.thumbnail.url:a.url;
                $w.find(".bcms-img-p").remove();
                $w.find(".bcms-img-w").append("<img class=\"bcms-img-p\" src=\""+s+"\">");
                $w.find(".bcms-unpick").show();
            });fr.open();
        });
        $(document).on("click",".bcms-unpick",function(e){
            e.preventDefault();var $w=$(this).closest(".bcms-img-f");
            $w.find(".bcms-img-id").val("");$w.find(".bcms-img-p").remove();$(this).hide();
        });
    });
    ');
});

// ─── Register meta boxes ───
add_action('add_meta_boxes', function() {
    global $post;
    if (!$post || $post->post_type !== 'page') return;

    $tpl = get_post_meta($post->ID, '_wp_page_template', true);
    $is_front = ($post->ID === (int) get_option('page_on_front'));

    // FRONT PAGE
    if ($is_front) {
        $fp = [
            'bcms_fp_hero'    => 'Front Page — Hero',
            'bcms_fp_about'   => 'Front Page — O nama',
            'bcms_fp_why'     => 'Front Page — Zašto mi',
            'bcms_fp_svc'     => 'Front Page — Usluge',
            'bcms_fp_cta'     => 'Front Page — CTA Banner',
            'bcms_fp_proc'    => 'Front Page — Proces',
            'bcms_fp_test'    => 'Front Page — Testimonijali',
            'bcms_fp_contact' => 'Front Page — Kontakt',
        ];
        foreach ($fp as $id => $title) {
            add_meta_box($id, $title, $id . '_render', 'page', 'normal', 'high');
        }
    }

    // GATEKEEPER TITAN
    if ($tpl === 'gatekeeper-titan.php') {
        $gkt = [
            'bcms_gkt_hero'    => 'GK Titan — Hero',
            'bcms_gkt_brand'   => 'GK Titan — Partneri',
            'bcms_gkt_process' => 'GK Titan — Proces (5 koraka)',
            'bcms_gkt_verif'   => 'GK Titan — Verifikacija',
            'bcms_gkt_test'    => 'GK Titan — Testimonijali',
            'bcms_gkt_faq'     => 'GK Titan — FAQ',
        ];
        foreach ($gkt as $id => $title) {
            add_meta_box($id, $title, $id . '_render', 'page', 'normal', 'high');
        }
    }

    // GATEKEEPER (old)
    if ($tpl === 'gatekeepeer.php') {
        $gko = [
            'bcms_gko_hero'   => 'GK — Hero / Banner',
            'bcms_gko_intro'  => 'GK — Uvod (O GateKeeper-u)',
            'bcms_gko_benef'  => 'GK — Prednosti',
            'bcms_gko_about'  => 'GK — O nama / Regula',
            'bcms_gko_proc'   => 'GK — Proces rada',
            'bcms_gko_impl'   => 'GK — Implementacija',
            'bcms_gko_footer' => 'GK — Kontakt / Footer',
        ];
        foreach ($gko as $id => $title) {
            add_meta_box($id, $title, $id . '_render', 'page', 'normal', 'high');
        }
    }

    // GATEKEEPER (simple/duplicate titan)
    if ($tpl === 'gatekeeper.php') {
        $gk2 = [
            'bcms_gk2_hero'    => 'GK Simple — Hero',
            'bcms_gk2_process' => 'GK Simple — Proces',
            'bcms_gk2_test'    => 'GK Simple — Testimonijali',
            'bcms_gk2_faq'     => 'GK Simple — FAQ',
        ];
        foreach ($gk2 as $id => $title) {
            add_meta_box($id, $title, $id . '_render', 'page', 'normal', 'high');
        }
    }

    // BLOG PAGE
    if ($tpl === 'template-parts/blocks/blog-page/render.php') {
        add_meta_box('bcms_blog', 'Blog — Header', 'bcms_blog_render', 'page', 'normal', 'high');
    }
});


/* ================================================================
   FRONT PAGE RENDER CALLBACKS
   ================================================================ */

function bcms_fp_hero_render($post) {
    wp_nonce_field('bcms_save', 'bcms_nonce');
    $id = $post->ID;
    bcms_f_text('bcms_fp_hero_tag', $id, 'Tag', 'ClearGreen Solutions');
    bcms_f_area('bcms_fp_hero_title', $id, 'Naslov (HTML: br, span)', 'Povjerenje počinje...');
    bcms_f_area('bcms_fp_hero_desc', $id, 'Podnaslov');
    echo '<hr>';
    bcms_f_text('bcms_fp_hero_btn1_text', $id, 'Dugme 1 tekst', 'Kontaktirajte nas');
    bcms_f_text('bcms_fp_hero_btn1_url', $id, 'Dugme 1 link', '#kontakt');
    bcms_f_text('bcms_fp_hero_btn2_text', $id, 'Dugme 2 tekst');
    bcms_f_text('bcms_fp_hero_btn2_url', $id, 'Dugme 2 link');
    echo '<hr><p><strong>Statistike</strong></p>';
    $stats = bcms_repeater_start('bcms_fp_hero_stats', $id);
    foreach ($stats as $i => $s) {
        echo '<div class="bcms-rep-item"><button type="button" class="bcms-rm">&times;</button>';
        echo '<div class="bcms-f"><label>Broj</label><input type="text" name="bcms_fp_hero_stats[' . $i . '][number]" value="' . esc_attr($s['number'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Label</label><input type="text" name="bcms_fp_hero_stats[' . $i . '][label]" value="' . esc_attr($s['label'] ?? '') . '"></div></div>';
    }
    bcms_repeater_end('bcms_fp_hero_stats');
    echo '<button type="button" class="bcms-rm">&times;</button>';
    echo '<div class="bcms-f"><label>Broj</label><input type="text" name="bcms_fp_hero_stats[__i__][number]"></div>';
    echo '<div class="bcms-f"><label>Label</label><input type="text" name="bcms_fp_hero_stats[__i__][label]"></div>';
    bcms_repeater_close('+ Dodaj statistiku');
}

function bcms_fp_about_render($post) {
    $id = $post->ID;
    bcms_f_text('bcms_fp_about_tag', $id, 'Tag', 'O nama');
    bcms_f_area('bcms_fp_about_title', $id, 'Naslov (HTML)');
    bcms_f_area('bcms_fp_about_p1', $id, 'Paragraf 1');
    bcms_f_area('bcms_fp_about_p2', $id, 'Paragraf 2');
    bcms_f_area('bcms_fp_about_p3', $id, 'Paragraf 3');
    bcms_f_text('bcms_fp_about_btn_text', $id, 'Dugme tekst');
    bcms_f_text('bcms_fp_about_btn_url', $id, 'Dugme link');
    echo '<hr>';
    bcms_f_img('bcms_fp_about_image', $id, 'Slika');
    bcms_f_text('bcms_fp_about_badge_num', $id, 'Badge broj', '5+');
    bcms_f_text('bcms_fp_about_badge_txt', $id, 'Badge tekst', 'Godina iskustva');
}

function bcms_fp_why_render($post) {
    $id = $post->ID;
    bcms_f_text('bcms_fp_why_tag', $id, 'Tag');
    bcms_f_area('bcms_fp_why_title', $id, 'Naslov (HTML)');
    bcms_f_area('bcms_fp_why_desc', $id, 'Opis');
    echo '<hr><p><strong>Kartice sektora</strong></p>';
    $cards = bcms_repeater_start('bcms_fp_why_cards', $id);
    foreach ($cards as $i => $c) {
        echo '<div class="bcms-rep-item"><button type="button" class="bcms-rm">&times;</button>';
        echo '<div class="bcms-f"><label>Ikona (FA klasa)</label><input type="text" name="bcms_fp_why_cards[' . $i . '][icon]" value="' . esc_attr($c['icon'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Naslov</label><input type="text" name="bcms_fp_why_cards[' . $i . '][title]" value="' . esc_attr($c['title'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Opis</label><textarea name="bcms_fp_why_cards[' . $i . '][desc]">' . esc_textarea($c['desc'] ?? '') . '</textarea></div>';
        echo '<div class="bcms-f"><label>Tagovi (zarezom)</label><input type="text" name="bcms_fp_why_cards[' . $i . '][tags]" value="' . esc_attr($c['tags'] ?? '') . '"></div></div>';
    }
    bcms_repeater_end('bcms_fp_why_cards');
    echo '<button type="button" class="bcms-rm">&times;</button>';
    echo '<div class="bcms-f"><label>Ikona</label><input type="text" name="bcms_fp_why_cards[__i__][icon]" placeholder="fas fa-university"></div>';
    echo '<div class="bcms-f"><label>Naslov</label><input type="text" name="bcms_fp_why_cards[__i__][title]"></div>';
    echo '<div class="bcms-f"><label>Opis</label><textarea name="bcms_fp_why_cards[__i__][desc]"></textarea></div>';
    echo '<div class="bcms-f"><label>Tagovi</label><input type="text" name="bcms_fp_why_cards[__i__][tags]"></div>';
    bcms_repeater_close('+ Dodaj karticu');
    echo '<hr>';
    bcms_f_text('bcms_fp_why_bottom', $id, 'Tekst ispod kartica');
    bcms_f_text('bcms_fp_why_btn_text', $id, 'Dugme tekst');
    bcms_f_text('bcms_fp_why_btn_url', $id, 'Dugme link');
}

function bcms_fp_svc_render($post) {
    $id = $post->ID;
    bcms_f_text('bcms_fp_svc_tag', $id, 'Tag');
    bcms_f_area('bcms_fp_svc_title', $id, 'Naslov (HTML)');
    echo '<hr><p><strong>Usluge / proizvodi</strong></p>';
    $items = bcms_repeater_start('bcms_fp_svc_items', $id);
    foreach ($items as $i => $s) {
        $f = !empty($s['featured']) ? 'checked' : '';
        echo '<div class="bcms-rep-item"><button type="button" class="bcms-rm">&times;</button>';
        echo '<div class="bcms-f"><label>Naziv</label><input type="text" name="bcms_fp_svc_items[' . $i . '][name]" value="' . esc_attr($s['name'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Opis</label><textarea name="bcms_fp_svc_items[' . $i . '][desc]">' . esc_textarea($s['desc'] ?? '') . '</textarea></div>';
        echo '<div class="bcms-f"><label>Za koga</label><input type="text" name="bcms_fp_svc_items[' . $i . '][for_whom]" value="' . esc_attr($s['for_whom'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Link</label><input type="text" name="bcms_fp_svc_items[' . $i . '][link]" value="' . esc_attr($s['link'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label><input type="checkbox" name="bcms_fp_svc_items[' . $i . '][featured]" value="1" ' . $f . '> Featured</label></div></div>';
    }
    bcms_repeater_end('bcms_fp_svc_items');
    echo '<button type="button" class="bcms-rm">&times;</button>';
    echo '<div class="bcms-f"><label>Naziv</label><input type="text" name="bcms_fp_svc_items[__i__][name]"></div>';
    echo '<div class="bcms-f"><label>Opis</label><textarea name="bcms_fp_svc_items[__i__][desc]"></textarea></div>';
    echo '<div class="bcms-f"><label>Za koga</label><input type="text" name="bcms_fp_svc_items[__i__][for_whom]"></div>';
    echo '<div class="bcms-f"><label>Link</label><input type="text" name="bcms_fp_svc_items[__i__][link]"></div>';
    echo '<div class="bcms-f"><label><input type="checkbox" name="bcms_fp_svc_items[__i__][featured]" value="1"> Featured</label></div>';
    bcms_repeater_close('+ Dodaj uslugu');
    echo '<hr>';
    bcms_f_text('bcms_fp_svc_btn_text', $id, 'Dugme tekst');
    bcms_f_text('bcms_fp_svc_btn_url', $id, 'Dugme link');
}

function bcms_fp_cta_render($post) {
    $id = $post->ID;
    bcms_f_area('bcms_fp_cta_title', $id, 'Naslov (HTML)');
    bcms_f_text('bcms_fp_cta_btn_text', $id, 'Dugme tekst');
    bcms_f_text('bcms_fp_cta_btn_url', $id, 'Dugme link');
}

function bcms_fp_proc_render($post) {
    $id = $post->ID;
    bcms_f_text('bcms_fp_proc_tag', $id, 'Tag');
    bcms_f_area('bcms_fp_proc_title', $id, 'Naslov (HTML)');
    bcms_f_text('bcms_fp_proc_btn_text', $id, 'Dugme tekst');
    bcms_f_text('bcms_fp_proc_btn_url', $id, 'Dugme link');
    echo '<hr><p><strong>Koraci</strong></p>';
    $steps = bcms_repeater_start('bcms_fp_proc_steps', $id);
    foreach ($steps as $i => $s) {
        echo '<div class="bcms-rep-item"><button type="button" class="bcms-rm">&times;</button>';
        echo '<div class="bcms-f"><label>Broj</label><input type="text" name="bcms_fp_proc_steps[' . $i . '][number]" value="' . esc_attr($s['number'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Naslov</label><input type="text" name="bcms_fp_proc_steps[' . $i . '][title]" value="' . esc_attr($s['title'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Opis</label><textarea name="bcms_fp_proc_steps[' . $i . '][desc]">' . esc_textarea($s['desc'] ?? '') . '</textarea></div></div>';
    }
    bcms_repeater_end('bcms_fp_proc_steps');
    echo '<button type="button" class="bcms-rm">&times;</button>';
    echo '<div class="bcms-f"><label>Broj</label><input type="text" name="bcms_fp_proc_steps[__i__][number]"></div>';
    echo '<div class="bcms-f"><label>Naslov</label><input type="text" name="bcms_fp_proc_steps[__i__][title]"></div>';
    echo '<div class="bcms-f"><label>Opis</label><textarea name="bcms_fp_proc_steps[__i__][desc]"></textarea></div>';
    bcms_repeater_close('+ Dodaj korak');
}

function bcms_fp_test_render($post) {
    $id = $post->ID;
    bcms_f_text('bcms_fp_test_tag', $id, 'Tag');
    bcms_f_area('bcms_fp_test_title', $id, 'Naslov (HTML)');
    echo '<hr><p><strong>Partneri (traka)</strong></p>';
    $partners = bcms_repeater_start('bcms_fp_test_partners', $id);
    foreach ($partners as $i => $p) {
        echo '<div class="bcms-rep-item"><button type="button" class="bcms-rm">&times;</button>';
        echo '<div class="bcms-f"><label>Ime</label><input type="text" name="bcms_fp_test_partners[' . $i . '][name]" value="' . esc_attr($p['name'] ?? '') . '"></div></div>';
    }
    bcms_repeater_end('bcms_fp_test_partners');
    echo '<button type="button" class="bcms-rm">&times;</button>';
    echo '<div class="bcms-f"><label>Ime</label><input type="text" name="bcms_fp_test_partners[__i__][name]"></div>';
    bcms_repeater_close('+ Dodaj partnera');
    echo '<hr><p><strong>Testimonijal kartice</strong></p>';
    $cards = bcms_repeater_start('bcms_fp_test_cards', $id);
    foreach ($cards as $i => $c) {
        $lid = $c['logo'] ?? '';
        $lurl = $lid ? wp_get_attachment_image_url($lid, 'thumbnail') : '';
        echo '<div class="bcms-rep-item"><button type="button" class="bcms-rm">&times;</button>';
        echo '<div class="bcms-f"><label>Citat</label><textarea name="bcms_fp_test_cards[' . $i . '][quote]">' . esc_textarea($c['quote'] ?? '') . '</textarea></div>';
        echo '<div class="bcms-f"><label>Kompanija</label><input type="text" name="bcms_fp_test_cards[' . $i . '][company]" value="' . esc_attr($c['company'] ?? '') . '"></div>';
        echo '<div class="bcms-f bcms-img-f"><label>Logo</label><div class="bcms-img-w">';
        echo '<input type="hidden" class="bcms-img-id" name="bcms_fp_test_cards[' . $i . '][logo]" value="' . esc_attr($lid) . '">';
        echo '<button type="button" class="button bcms-pick">Izaberi</button>';
        echo '<button type="button" class="button bcms-unpick" style="' . ($lid ? '' : 'display:none') . '">Ukloni</button>';
        if ($lurl) echo '<img class="bcms-img-p" src="' . esc_url($lurl) . '">';
        echo '</div></div></div>';
    }
    bcms_repeater_end('bcms_fp_test_cards');
    echo '<button type="button" class="bcms-rm">&times;</button>';
    echo '<div class="bcms-f"><label>Citat</label><textarea name="bcms_fp_test_cards[__i__][quote]"></textarea></div>';
    echo '<div class="bcms-f"><label>Kompanija</label><input type="text" name="bcms_fp_test_cards[__i__][company]"></div>';
    echo '<div class="bcms-f bcms-img-f"><label>Logo</label><div class="bcms-img-w">';
    echo '<input type="hidden" class="bcms-img-id" name="bcms_fp_test_cards[__i__][logo]" value="">';
    echo '<button type="button" class="button bcms-pick">Izaberi</button>';
    echo '<button type="button" class="button bcms-unpick" style="display:none">Ukloni</button></div></div>';
    bcms_repeater_close('+ Dodaj testimonijal');
}

function bcms_fp_contact_render($post) {
    $id = $post->ID;
    bcms_f_text('bcms_fp_contact_tag', $id, 'Tag');
    bcms_f_area('bcms_fp_contact_title', $id, 'Naslov (HTML)');
    bcms_f_area('bcms_fp_contact_desc', $id, 'Opis');
    bcms_f_text('bcms_fp_contact_email', $id, 'Email');
    bcms_f_text('bcms_fp_contact_phone', $id, 'Telefon (prikaz)');
    bcms_f_text('bcms_fp_contact_phone_raw', $id, 'Telefon (tel: link)');
    echo '<hr>';
    bcms_f_text('bcms_fp_contact_form_title', $id, 'Naslov forme');
    bcms_f_text('bcms_fp_contact_form_sub', $id, 'Podnaslov forme');
}


/* ================================================================
   GATEKEEPER TITAN RENDER CALLBACKS
   ================================================================ */

function bcms_gkt_hero_render($post) {
    wp_nonce_field('bcms_save', 'bcms_nonce');
    $id = $post->ID;
    bcms_f_text('bcms_gkt_hero_line1', $id, 'Naslov — linija 1', 'Digitalizujte portirnicu.');
    bcms_f_text('bcms_gkt_hero_line2', $id, 'Naslov — linija 2', 'Osigurajte instituciju.');
    bcms_f_area('bcms_gkt_hero_desc', $id, 'Podnaslov');
    bcms_f_text('bcms_gkt_hero_cta_text', $id, 'CTA tekst', 'Zakaži demo uživo');
    bcms_f_text('bcms_gkt_hero_cta_url', $id, 'CTA link', '#references');
}

function bcms_gkt_brand_render($post) {
    $id = $post->ID;
    bcms_f_text('bcms_gkt_brand_title', $id, 'Naslov', 'Povjerenje institucija i organizacija');
    bcms_f_area('bcms_gkt_brand_desc', $id, 'Opis');
}

function bcms_gkt_process_render($post) {
    $id = $post->ID;
    bcms_f_area('bcms_gkt_proc_title', $id, 'Naslov sekcije (HTML)');
    bcms_f_area('bcms_gkt_proc_subtitle', $id, 'Podnaslov');
    echo '<hr><p><strong>Koraci (5)</strong></p>';
    $steps = bcms_repeater_start('bcms_gkt_proc_steps', $id);
    foreach ($steps as $i => $s) {
        echo '<div class="bcms-rep-item"><button type="button" class="bcms-rm">&times;</button>';
        echo '<div class="bcms-f"><label>Naslov koraka (HTML)</label><input type="text" name="bcms_gkt_proc_steps[' . $i . '][title]" value="' . esc_attr($s['title'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Stavke liste (svaka u novom redu)</label><textarea name="bcms_gkt_proc_steps[' . $i . '][items]">' . esc_textarea($s['items'] ?? '') . '</textarea></div></div>';
    }
    bcms_repeater_end('bcms_gkt_proc_steps');
    echo '<button type="button" class="bcms-rm">&times;</button>';
    echo '<div class="bcms-f"><label>Naslov koraka</label><input type="text" name="bcms_gkt_proc_steps[__i__][title]"></div>';
    echo '<div class="bcms-f"><label>Stavke liste</label><textarea name="bcms_gkt_proc_steps[__i__][items]"></textarea></div>';
    bcms_repeater_close('+ Dodaj korak');
}

function bcms_gkt_verif_render($post) {
    $id = $post->ID;
    bcms_f_area('bcms_gkt_verif_title', $id, 'Naslov (HTML)');
    echo '<hr><p><strong>Verifikacijske kartice (3)</strong></p>';
    $items = bcms_repeater_start('bcms_gkt_verif_items', $id);
    foreach ($items as $i => $v) {
        echo '<div class="bcms-rep-item"><button type="button" class="bcms-rm">&times;</button>';
        echo '<div class="bcms-f"><label>Podnaslov (h6)</label><input type="text" name="bcms_gkt_verif_items[' . $i . '][title]" value="' . esc_attr($v['title'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Opis (HTML)</label><textarea name="bcms_gkt_verif_items[' . $i . '][desc]">' . esc_textarea($v['desc'] ?? '') . '</textarea></div></div>';
    }
    bcms_repeater_end('bcms_gkt_verif_items');
    echo '<button type="button" class="bcms-rm">&times;</button>';
    echo '<div class="bcms-f"><label>Podnaslov</label><input type="text" name="bcms_gkt_verif_items[__i__][title]"></div>';
    echo '<div class="bcms-f"><label>Opis</label><textarea name="bcms_gkt_verif_items[__i__][desc]"></textarea></div>';
    bcms_repeater_close('+ Dodaj karticu');
}

function bcms_gkt_test_render($post) {
    $id = $post->ID;
    bcms_f_text('bcms_gkt_test_title', $id, 'Naslov', 'Šta naši klijenti kažu');
    echo '<hr><p><strong>Testimonijali</strong></p>';
    $cards = bcms_repeater_start('bcms_gkt_test_cards', $id);
    foreach ($cards as $i => $c) {
        echo '<div class="bcms-rep-item"><button type="button" class="bcms-rm">&times;</button>';
        echo '<div class="bcms-f"><label>Citat</label><textarea name="bcms_gkt_test_cards[' . $i . '][quote]">' . esc_textarea($c['quote'] ?? '') . '</textarea></div>';
        echo '<div class="bcms-f"><label>Kompanija</label><input type="text" name="bcms_gkt_test_cards[' . $i . '][company]" value="' . esc_attr($c['company'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Logo putanja (relativna)</label><input type="text" name="bcms_gkt_test_cards[' . $i . '][logo]" value="' . esc_attr($c['logo'] ?? '') . '"></div></div>';
    }
    bcms_repeater_end('bcms_gkt_test_cards');
    echo '<button type="button" class="bcms-rm">&times;</button>';
    echo '<div class="bcms-f"><label>Citat</label><textarea name="bcms_gkt_test_cards[__i__][quote]"></textarea></div>';
    echo '<div class="bcms-f"><label>Kompanija</label><input type="text" name="bcms_gkt_test_cards[__i__][company]"></div>';
    echo '<div class="bcms-f"><label>Logo putanja</label><input type="text" name="bcms_gkt_test_cards[__i__][logo]"></div>';
    bcms_repeater_close('+ Dodaj testimonijal');
}

function bcms_gkt_faq_render($post) {
    $id = $post->ID;
    bcms_f_text('bcms_gkt_faq_title', $id, 'Naslov', 'Često postavljana pitanja');
    echo '<hr>';
    $faqs = bcms_repeater_start('bcms_gkt_faq_items', $id);
    foreach ($faqs as $i => $f) {
        echo '<div class="bcms-rep-item"><button type="button" class="bcms-rm">&times;</button>';
        echo '<div class="bcms-f"><label>Pitanje</label><input type="text" name="bcms_gkt_faq_items[' . $i . '][q]" value="' . esc_attr($f['q'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Odgovor</label><textarea name="bcms_gkt_faq_items[' . $i . '][a]">' . esc_textarea($f['a'] ?? '') . '</textarea></div></div>';
    }
    bcms_repeater_end('bcms_gkt_faq_items');
    echo '<button type="button" class="bcms-rm">&times;</button>';
    echo '<div class="bcms-f"><label>Pitanje</label><input type="text" name="bcms_gkt_faq_items[__i__][q]"></div>';
    echo '<div class="bcms-f"><label>Odgovor</label><textarea name="bcms_gkt_faq_items[__i__][a]"></textarea></div>';
    bcms_repeater_close('+ Dodaj FAQ');
}


/* ================================================================
   GATEKEEPER OLD (gatekeepeer.php) RENDER CALLBACKS
   ================================================================ */

function bcms_gko_hero_render($post) {
    wp_nonce_field('bcms_save', 'bcms_nonce');
    $id = $post->ID;
    bcms_f_area('bcms_gko_hero_title', $id, 'Naslov (HTML)', 'Digitalizujte upravljanje posjetiocima sa GateKeeper');
    bcms_f_area('bcms_gko_hero_desc', $id, 'Podnaslov');
    bcms_f_text('bcms_gko_hero_btn_text', $id, 'CTA tekst', 'Kontaktirajte nas');
    bcms_f_text('bcms_gko_hero_check1', $id, 'Check 1', 'GDPR usklađeno');
    bcms_f_text('bcms_gko_hero_check2', $id, 'Check 2', 'Sigurno i pouzdano');
}

function bcms_gko_intro_render($post) {
    $id = $post->ID;
    bcms_f_text('bcms_gko_intro_badge', $id, 'Badge', 'O GateKeeper-u');
    bcms_f_area('bcms_gko_intro_title', $id, 'Naslov (HTML)');
    bcms_f_area('bcms_gko_intro_p1', $id, 'Paragraf 1');
    bcms_f_area('bcms_gko_intro_p2', $id, 'Paragraf 2');
    bcms_f_area('bcms_gko_intro_p3', $id, 'Paragraf 3');
    bcms_f_area('bcms_gko_intro_p4', $id, 'Paragraf 4');
    bcms_f_area('bcms_gko_intro_p5', $id, 'Paragraf 5');
    echo '<hr>';
    bcms_f_text('bcms_gko_clients_badge', $id, 'Klijenti badge', 'Naši klijenti');
    bcms_f_text('bcms_gko_clients_title', $id, 'Klijenti naslov', 'U upotrebi kod');
}

function bcms_gko_benef_render($post) {
    $id = $post->ID;
    bcms_f_text('bcms_gko_benef_section', $id, 'Sekcija naslov', 'PREDNOSTI');
    bcms_f_area('bcms_gko_benef_desc', $id, 'Opis');
    bcms_f_text('bcms_gko_benef_subtitle', $id, 'Podnaslov', 'Benefiti koje organizacije ostvaruju:');
    echo '<hr><p><strong>Benefit kartice</strong></p>';
    $items = bcms_repeater_start('bcms_gko_benef_items', $id);
    foreach ($items as $i => $b) {
        echo '<div class="bcms-rep-item"><button type="button" class="bcms-rm">&times;</button>';
        echo '<div class="bcms-f"><label>Ikona (ph klasa)</label><input type="text" name="bcms_gko_benef_items[' . $i . '][icon]" value="' . esc_attr($b['icon'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Naslov</label><input type="text" name="bcms_gko_benef_items[' . $i . '][title]" value="' . esc_attr($b['title'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Opis</label><textarea name="bcms_gko_benef_items[' . $i . '][desc]">' . esc_textarea($b['desc'] ?? '') . '</textarea></div></div>';
    }
    bcms_repeater_end('bcms_gko_benef_items');
    echo '<button type="button" class="bcms-rm">&times;</button>';
    echo '<div class="bcms-f"><label>Ikona</label><input type="text" name="bcms_gko_benef_items[__i__][icon]" placeholder="ph ph-shield-check"></div>';
    echo '<div class="bcms-f"><label>Naslov</label><input type="text" name="bcms_gko_benef_items[__i__][title]"></div>';
    echo '<div class="bcms-f"><label>Opis</label><textarea name="bcms_gko_benef_items[__i__][desc]"></textarea></div>';
    bcms_repeater_close('+ Dodaj benefit');
    echo '<hr>';
    bcms_f_area('bcms_gko_benef_footer1', $id, 'Tekst ispod 1');
    bcms_f_area('bcms_gko_benef_footer2', $id, 'Tekst ispod 2');
}

function bcms_gko_about_render($post) {
    $id = $post->ID;
    bcms_f_text('bcms_gko_about_section', $id, 'Sekcija naslov', 'O NAMA');
    bcms_f_text('bcms_gko_about_cg_title', $id, 'ClearGreen naslov', 'ClearGreen');
    bcms_f_text('bcms_gko_about_cg_sub', $id, 'ClearGreen podnaslov');
    bcms_f_area('bcms_gko_about_cg_desc', $id, 'ClearGreen opis');
    echo '<hr><p><strong>Rješenja</strong></p>';
    $sols = bcms_repeater_start('bcms_gko_about_solutions', $id);
    foreach ($sols as $i => $s) {
        echo '<div class="bcms-rep-item"><button type="button" class="bcms-rm">&times;</button>';
        echo '<div class="bcms-f"><label>Ikona (ph klasa)</label><input type="text" name="bcms_gko_about_solutions[' . $i . '][icon]" value="' . esc_attr($s['icon'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Naziv</label><input type="text" name="bcms_gko_about_solutions[' . $i . '][name]" value="' . esc_attr($s['name'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Opis</label><input type="text" name="bcms_gko_about_solutions[' . $i . '][desc]" value="' . esc_attr($s['desc'] ?? '') . '"></div></div>';
    }
    bcms_repeater_end('bcms_gko_about_solutions');
    echo '<button type="button" class="bcms-rm">&times;</button>';
    echo '<div class="bcms-f"><label>Ikona</label><input type="text" name="bcms_gko_about_solutions[__i__][icon]"></div>';
    echo '<div class="bcms-f"><label>Naziv</label><input type="text" name="bcms_gko_about_solutions[__i__][name]"></div>';
    echo '<div class="bcms-f"><label>Opis</label><input type="text" name="bcms_gko_about_solutions[__i__][desc]"></div>';
    bcms_repeater_close('+ Dodaj rješenje');
    echo '<hr>';
    bcms_f_text('bcms_gko_about_assoc', $id, 'Asocijacija tekst');
    echo '<hr><p><strong>Regula Forensics</strong></p>';
    bcms_f_text('bcms_gko_regula_title', $id, 'Regula naslov', 'Regula Forensics');
    bcms_f_text('bcms_gko_regula_sub', $id, 'Regula podnaslov');
    bcms_f_area('bcms_gko_regula_desc', $id, 'Regula opis');
    $regula = bcms_repeater_start('bcms_gko_regula_info', $id);
    foreach ($regula as $i => $r) {
        echo '<div class="bcms-rep-item"><button type="button" class="bcms-rm">&times;</button>';
        echo '<div class="bcms-f"><label>Naslov</label><input type="text" name="bcms_gko_regula_info[' . $i . '][title]" value="' . esc_attr($r['title'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Tekst</label><textarea name="bcms_gko_regula_info[' . $i . '][text]">' . esc_textarea($r['text'] ?? '') . '</textarea></div></div>';
    }
    bcms_repeater_end('bcms_gko_regula_info');
    echo '<button type="button" class="bcms-rm">&times;</button>';
    echo '<div class="bcms-f"><label>Naslov</label><input type="text" name="bcms_gko_regula_info[__i__][title]"></div>';
    echo '<div class="bcms-f"><label>Tekst</label><textarea name="bcms_gko_regula_info[__i__][text]"></textarea></div>';
    bcms_repeater_close('+ Dodaj info');
}

function bcms_gko_proc_render($post) {
    $id = $post->ID;
    bcms_f_text('bcms_gko_proc_section', $id, 'Sekcija naslov', 'PROCES RADA');
    bcms_f_area('bcms_gko_proc_desc1', $id, 'Opis paragraf 1');
    bcms_f_area('bcms_gko_proc_desc2', $id, 'Opis paragraf 2');
    bcms_f_area('bcms_gko_proc_subtitle', $id, 'Podnaslov koraka');
    echo '<hr><p><strong>Koraci</strong></p>';
    $steps = bcms_repeater_start('bcms_gko_proc_steps', $id);
    foreach ($steps as $i => $s) {
        echo '<div class="bcms-rep-item"><button type="button" class="bcms-rm">&times;</button>';
        echo '<div class="bcms-f"><label>Naslov</label><input type="text" name="bcms_gko_proc_steps[' . $i . '][title]" value="' . esc_attr($s['title'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Tekst kratki</label><input type="text" name="bcms_gko_proc_steps[' . $i . '][short]" value="' . esc_attr($s['short'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Tekst detaljni</label><textarea name="bcms_gko_proc_steps[' . $i . '][detail]">' . esc_textarea($s['detail'] ?? '') . '</textarea></div>';
        echo '<div class="bcms-f"><label>Nav label</label><input type="text" name="bcms_gko_proc_steps[' . $i . '][nav]" value="' . esc_attr($s['nav'] ?? '') . '"></div></div>';
    }
    bcms_repeater_end('bcms_gko_proc_steps');
    echo '<button type="button" class="bcms-rm">&times;</button>';
    echo '<div class="bcms-f"><label>Naslov</label><input type="text" name="bcms_gko_proc_steps[__i__][title]"></div>';
    echo '<div class="bcms-f"><label>Tekst kratki</label><input type="text" name="bcms_gko_proc_steps[__i__][short]"></div>';
    echo '<div class="bcms-f"><label>Tekst detaljni</label><textarea name="bcms_gko_proc_steps[__i__][detail]"></textarea></div>';
    echo '<div class="bcms-f"><label>Nav label</label><input type="text" name="bcms_gko_proc_steps[__i__][nav]"></div>';
    bcms_repeater_close('+ Dodaj korak');
}

function bcms_gko_impl_render($post) {
    $id = $post->ID;
    bcms_f_text('bcms_gko_impl_badge', $id, 'Badge', 'IMPLEMENTACIJA');
    bcms_f_text('bcms_gko_impl_title', $id, 'Naslov', 'Brza i efikasna implementacija');
    echo '<hr><p><strong>Kartice</strong></p>';
    $cards = bcms_repeater_start('bcms_gko_impl_cards', $id);
    foreach ($cards as $i => $c) {
        echo '<div class="bcms-rep-item"><button type="button" class="bcms-rm">&times;</button>';
        echo '<div class="bcms-f"><label>Naslov</label><input type="text" name="bcms_gko_impl_cards[' . $i . '][title]" value="' . esc_attr($c['title'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Tekst (HTML)</label><textarea name="bcms_gko_impl_cards[' . $i . '][text]">' . esc_textarea($c['text'] ?? '') . '</textarea></div></div>';
    }
    bcms_repeater_end('bcms_gko_impl_cards');
    echo '<button type="button" class="bcms-rm">&times;</button>';
    echo '<div class="bcms-f"><label>Naslov</label><input type="text" name="bcms_gko_impl_cards[__i__][title]"></div>';
    echo '<div class="bcms-f"><label>Tekst</label><textarea name="bcms_gko_impl_cards[__i__][text]"></textarea></div>';
    bcms_repeater_close('+ Dodaj karticu');
}

function bcms_gko_footer_render($post) {
    $id = $post->ID;
    bcms_f_area('bcms_gko_footer_title', $id, 'Naslov');
    echo '<hr><p><strong>Kontakt osobe</strong></p>';
    $contacts = bcms_repeater_start('bcms_gko_footer_contacts', $id);
    foreach ($contacts as $i => $c) {
        echo '<div class="bcms-rep-item"><button type="button" class="bcms-rm">&times;</button>';
        echo '<div class="bcms-f"><label>Ime</label><input type="text" name="bcms_gko_footer_contacts[' . $i . '][name]" value="' . esc_attr($c['name'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Pozicija</label><input type="text" name="bcms_gko_footer_contacts[' . $i . '][role]" value="' . esc_attr($c['role'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Email</label><input type="text" name="bcms_gko_footer_contacts[' . $i . '][email]" value="' . esc_attr($c['email'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Telefon</label><input type="text" name="bcms_gko_footer_contacts[' . $i . '][phone]" value="' . esc_attr($c['phone'] ?? '') . '"></div></div>';
    }
    bcms_repeater_end('bcms_gko_footer_contacts');
    echo '<button type="button" class="bcms-rm">&times;</button>';
    echo '<div class="bcms-f"><label>Ime</label><input type="text" name="bcms_gko_footer_contacts[__i__][name]"></div>';
    echo '<div class="bcms-f"><label>Pozicija</label><input type="text" name="bcms_gko_footer_contacts[__i__][role]"></div>';
    echo '<div class="bcms-f"><label>Email</label><input type="text" name="bcms_gko_footer_contacts[__i__][email]"></div>';
    echo '<div class="bcms-f"><label>Telefon</label><input type="text" name="bcms_gko_footer_contacts[__i__][phone]"></div>';
    bcms_repeater_close('+ Dodaj osobu');
    echo '<hr>';
    bcms_f_text('bcms_gko_footer_copyright', $id, 'Copyright');
}


/* ================================================================
   GATEKEEPER SIMPLE (gatekeeper.php) RENDER CALLBACKS
   ================================================================ */

function bcms_gk2_hero_render($post) {
    wp_nonce_field('bcms_save', 'bcms_nonce');
    $id = $post->ID;
    bcms_f_area('bcms_gk2_hero_title', $id, 'Naslov (HTML)');
    bcms_f_area('bcms_gk2_hero_desc', $id, 'Podnaslov');
}

function bcms_gk2_process_render($post) {
    $id = $post->ID;
    bcms_f_area('bcms_gk2_proc_title', $id, 'Naslov sekcije (HTML)');
    bcms_f_area('bcms_gk2_proc_subtitle', $id, 'Podnaslov');
    echo '<hr><p><strong>Koraci</strong></p>';
    $steps = bcms_repeater_start('bcms_gk2_proc_steps', $id);
    foreach ($steps as $i => $s) {
        echo '<div class="bcms-rep-item"><button type="button" class="bcms-rm">&times;</button>';
        echo '<div class="bcms-f"><label>Naslov (HTML)</label><input type="text" name="bcms_gk2_proc_steps[' . $i . '][title]" value="' . esc_attr($s['title'] ?? '') . '"></div>';
        echo '<div class="bcms-f"><label>Tekst (HTML)</label><textarea name="bcms_gk2_proc_steps[' . $i . '][desc]">' . esc_textarea($s['desc'] ?? '') . '</textarea></div></div>';
    }
    bcms_repeater_end('bcms_gk2_proc_steps');
    echo '<button type="button" class="bcms-rm">&times;</button>';
    echo '<div class="bcms-f"><label>Naslov</label><input type="text" name="bcms_gk2_proc_steps[__i__][title]"></div>';
    echo '<div class="bcms-f"><label>Tekst</label><textarea name="bcms_gk2_proc_steps[__i__][desc]"></textarea></div>';
    bcms_repeater_close('+ Dodaj korak');
}

function bcms_gk2_test_render($post) {
    bcms_gkt_test_render($post); // Reuse titan testimonials (same structure)
}

function bcms_gk2_faq_render($post) {
    bcms_gkt_faq_render($post); // Reuse titan FAQ
}


/* ================================================================
   BLOG PAGE RENDER
   ================================================================ */

function bcms_blog_render($post) {
    wp_nonce_field('bcms_save', 'bcms_nonce');
    $id = $post->ID;
    bcms_f_text('bcms_blog_subtitle', $id, 'Podnaslov', 'Blog & News');
    bcms_f_text('bcms_blog_title', $id, 'Naslov', 'Articles on growth & marketing');
    bcms_f_area('bcms_blog_desc', $id, 'Opis');
}


/* ================================================================
   SAVE HANDLER
   ================================================================ */

add_action('save_post', function($post_id) {
    if (!isset($_POST['bcms_nonce']) || !wp_verify_nonce($_POST['bcms_nonce'], 'bcms_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // HTML-safe keys (allows br, span, em, strong)
    $html_keys = [
        'bcms_fp_hero_title', 'bcms_fp_about_title', 'bcms_fp_about_badge_txt', 'bcms_fp_why_title',
        'bcms_fp_svc_title', 'bcms_fp_cta_title', 'bcms_fp_proc_title', 'bcms_fp_test_title',
        'bcms_fp_contact_title',
        'bcms_gkt_proc_title', 'bcms_gkt_proc_subtitle', 'bcms_gkt_verif_title',
        'bcms_gko_hero_title', 'bcms_gko_hero_desc', 'bcms_gko_intro_title',
        'bcms_gko_intro_p1', 'bcms_gko_intro_p2', 'bcms_gko_intro_p3', 'bcms_gko_intro_p4', 'bcms_gko_intro_p5',
        'bcms_gko_proc_subtitle', 'bcms_gko_footer_copyright',
        'bcms_gk2_hero_title', 'bcms_gk2_hero_desc', 'bcms_gk2_proc_title', 'bcms_gk2_proc_subtitle',
    ];

    // Array/repeater keys
    $arr_keys = [
        'bcms_fp_hero_stats', 'bcms_fp_why_cards', 'bcms_fp_svc_items',
        'bcms_fp_proc_steps', 'bcms_fp_test_partners', 'bcms_fp_test_cards',
        'bcms_gkt_proc_steps', 'bcms_gkt_verif_items', 'bcms_gkt_test_cards', 'bcms_gkt_faq_items',
        'bcms_gko_benef_items', 'bcms_gko_about_solutions', 'bcms_gko_regula_info',
        'bcms_gko_proc_steps', 'bcms_gko_impl_cards', 'bcms_gko_footer_contacts',
        'bcms_gk2_proc_steps',
    ];

    // Save all bcms_ text fields from POST
    foreach ($_POST as $key => $val) {
        if (strpos($key, 'bcms_') !== 0) continue;
        if (in_array($key, $arr_keys)) continue; // handled below
        if (is_array($val)) continue;

        if (in_array($key, $html_keys)) {
            $clean = wp_kses($val, ['br' => [], 'span' => ['class' => [], 'style' => []], 'em' => [], 'strong' => []]);
        } else {
            $clean = sanitize_text_field($val);
        }
        update_post_meta($post_id, $key, $clean);
    }

    // Save array fields
    foreach ($arr_keys as $key) {
        if (isset($_POST[$key]) && is_array($_POST[$key])) {
            $clean = [];
            foreach ($_POST[$key] as $item) {
                if (!is_array($item)) continue;
                $row = [];
                foreach ($item as $k => $v) {
                    $row[sanitize_key($k)] = wp_kses_post($v);
                }
                $clean[] = $row;
            }
            update_post_meta($post_id, $key, $clean);
        } elseif (isset($_POST['bcms_nonce'])) {
            // Only delete if we're on the right page (nonce present)
            // Don't delete if the key just wasn't in this template's form
        }
    }
});


/* ================================================================
   ONE-TIME SEED — populate all templates with hardcoded content
   ================================================================ */

add_action('admin_init', function() {
    // ─── FRONT PAGE SEED ───
    $fid = (int) get_option('page_on_front');
    if ($fid && !get_post_meta($fid, '_bcms_fp_seeded', true)) {
        // Migrate from old fp_ prefix if exists
        $old = get_post_meta($fid, '_fp_fields_seeded', true);

        $fp_data = [
            'bcms_fp_hero_tag' => 'ClearGreen Solutions',
            'bcms_fp_hero_title' => 'Povjerenje počinje<br><span class="text-acc">provjerenim</span> identitetom.',
            'bcms_fp_hero_desc' => 'Digitalna identifikacija, kontrola pristupa i automatizacija poslovanja — za sektore gdje greška košta reputacije.',
            'bcms_fp_hero_btn1_text' => 'Kontaktirajte nas',
            'bcms_fp_hero_btn1_url' => '#kontakt',
            'bcms_fp_hero_btn2_text' => 'Pogledajte naša rješenja',
            'bcms_fp_hero_btn2_url' => '#usluge',
            'bcms_fp_about_tag' => 'O nama',
            'bcms_fp_about_title' => 'Clear<span class="text-acc">Green</span>',
            'bcms_fp_about_p1' => 'Razvili smo platformu koja povezuje provjeru identiteta, kontrolu pristupa i digitalizaciju procesa. Radimo za banke, telekome i javne institucije — sektore gdje greška košta reputacije.',
            'bcms_fp_about_p2' => 'Naša rješenja su SaaS i mogu biti on-prem ili cloud hostovana, u skladu s vašim sigurnosnim politikama.',
            'bcms_fp_about_p3' => 'Vizija nam je da budemo partner svakoj organizaciji koja želi raditi pametnije, isporučiti više i učiniti svoje procese otpornima na greške.',
            'bcms_fp_about_btn_text' => 'Kontaktirajte nas',
            'bcms_fp_about_btn_url' => '#kontakt',
            'bcms_fp_about_badge_num' => '5+',
            'bcms_fp_about_badge_txt' => 'Godina<br>iskustva',
            'bcms_fp_why_tag' => 'Zašto sarađivati sa nama?',
            'bcms_fp_why_title' => 'Radimo u sektorima gdje greška košta <span class="text-acc">reputacije.</span>',
            'bcms_fp_why_desc' => 'ClearGreen rješenja su aktivna u bankama, institucijama, zdravstvu i logistici — svuda gdje tačnost, sigurnost i usklađenost nisu opcija nego obaveza.',
            'bcms_fp_why_bottom' => 'Nije vaš sektor na listi? Vjerovatno smo ga već riješili.',
            'bcms_fp_why_btn_text' => 'Kontaktirajte nas',
            'bcms_fp_why_btn_url' => '#kontakt',
            'bcms_fp_svc_tag' => 'Naše usluge',
            'bcms_fp_svc_title' => 'Nudimo rješenja koja omogućavaju vašem poslovanju da <span class="text-acc">radi pametnije.</span>',
            'bcms_fp_svc_btn_text' => 'Stupite u kontakt',
            'bcms_fp_svc_btn_url' => '#kontakt',
            'bcms_fp_cta_title' => 'Spremni da svoj projekat pretvorite u <em>stvarnost?</em>',
            'bcms_fp_cta_btn_text' => 'Kontaktirajte nas',
            'bcms_fp_cta_btn_url' => '#kontakt',
            'bcms_fp_proc_tag' => 'Naš proces – jednostavan i pouzdan',
            'bcms_fp_proc_title' => 'Postavljamo prilagođeni pilot u roku od <span class="text-acc">24h.</span>',
            'bcms_fp_proc_btn_text' => 'Kontaktirajte nas',
            'bcms_fp_proc_btn_url' => '#kontakt',
            'bcms_fp_test_tag' => 'Partneri',
            'bcms_fp_test_title' => 'Šta kažu <span class="text-acc">o nama</span>',
            'bcms_fp_contact_tag' => 'Kontakt',
            'bcms_fp_contact_title' => 'Spremni da svoj projekat pretvorite u <span class="text-acc">stvarnost?</span>',
            'bcms_fp_contact_desc' => 'Hajde da razgovaramo o tome kako vam možemo pomoći. Odgovaramo u roku od 24 sata.',
            'bcms_fp_contact_email' => 'stefan.planic@cleargreen.me',
            'bcms_fp_contact_phone' => '+382 (0) 68 090 161',
            'bcms_fp_contact_phone_raw' => '+38268090161',
            'bcms_fp_contact_form_title' => 'Pošaljite nam poruku',
            'bcms_fp_contact_form_sub' => 'Odgovaramo u roku od 24 sata.',
        ];
        foreach ($fp_data as $k => $v) { update_post_meta($fid, $k, $v); }

        // Arrays
        update_post_meta($fid, 'bcms_fp_hero_stats', [
            ['number'=>'50+','label'=>'Klijenata'],['number'=>'99.9%','label'=>'Uptime'],
            ['number'=>'24h','label'=>'Pilot setup'],['number'=>'5+','label'=>'Godina'],
        ]);
        update_post_meta($fid, 'bcms_fp_why_cards', [
            ['icon'=>'bank.png','title'=>'Banke i finansije','desc'=>'Identifikacija klijenata na šalteru — pouzdana, brza i usklađena sa regulatornim zahtjevima.','tags'=>'BASIC, Alter One'],
            ['icon'=>'fas fa-landmark','title'=>'Javne institucije','desc'=>'Kontrola pristupa i digitalna evidencija posjetilaca sa punim audit tragom.','tags'=>'GateKeeper, DMS'],
            ['icon'=>'fas fa-satellite-dish','title'=>'Telekomunikacije','desc'=>'SIM i eSIM aktivacija jedino sa verifikovanim identitetom u core sistemu operatera.','tags'=>'SIMPLEX'],
            ['icon'=>'fas fa-truck','title'=>'Logistika i javna preduzeća','desc'=>'Svako vozilo, svaka ruta i svaki litar goriva — vidljivi i mjerljivi u realnom vremenu.','tags'=>'GreenFleet'],
            ['icon'=>'fas fa-parking','title'=>'Gradovi i parking servisi','desc'=>'Mobilno plaćanje, digitalne dozvole i automatski izvještaji bez papirne administracije.','tags'=>'Smart Parking'],
            ['icon'=>'fas fa-heartbeat','title'=>'Zdravstvo','desc'=>'Digitalni karton, e-posjete i podaci zaštićeni blockchain tehnologijom — dostupni uvijek.','tags'=>'e-Zdravstvo'],
        ]);
        update_post_meta($fid, 'bcms_fp_svc_items', [
            ['name'=>'GateKeeper','desc'=>'Digitalna portirnica. Kontrola pristupa i evidencija posjetilaca zasnovana na Regula Forensics tehnologiji — GDPR i ISO 27001 usklađena.','for_whom'=>'Banke · Institucije · Telekomi · Korporacije','link'=>'https://cleargreen.me/gate-keeper/','featured'=>'1'],
            ['name'=>'BASIC','desc'=>'Verifikacija identiteta klijenata na šalteru — MRZ, NFC i OCR čitanje dokumenta za 10 sekundi.','for_whom'=>'Banke · Mikrokrediti · Javne institucije','link'=>'','featured'=>''],
            ['name'=>'SIMPLEX','desc'=>'SIM i eSIM aktivacija isključivo sa potvrđenim identitetom u core sistemu operatera.','for_whom'=>'Telekomunikacijski operateri','link'=>'','featured'=>''],
            ['name'=>'DMS — Document Management','desc'=>'Skenirajte, arhivirajte i pretražujte dokumentaciju na jednom mjestu. Revizijski čist, sigurno dijeljenje.','for_whom'=>'Svi sektori','link'=>'','featured'=>''],
            ['name'=>'Alter One — Fintech','desc'=>'Automatizacija kreditnih procesa, portoflio upravljanje i regulatorni izvještaji za mikrofinansijske institucije.','for_whom'=>'Mikrokrediti · Finansije','link'=>'','featured'=>''],
            ['name'=>'GreenFleet — GPS & Flota','desc'=>'Praćenje vozila u realnom vremenu, CAN analiza, potrošnja goriva i optimizacija ruta.','for_whom'=>'Logistika · Distribucija · Javna preduzeća','link'=>'','featured'=>''],
            ['name'=>'Smart Parking','desc'=>'Mobilno plaćanje parkinga, digitalne dozvole i analitika za operatere i gradove.','for_whom'=>'Gradovi · Parking servisi · Turizam','link'=>'','featured'=>''],
            ['name'=>'e-Zdravstvo','desc'=>'Digitalni karton pacijenta, e-posjete i blockchain zaštita medicinskih podataka.','for_whom'=>'Zdravstvene ustanove','link'=>'','featured'=>''],
            ['name'=>'CRM & poslovni softver','desc'=>'CRM po mjeri — praćenje prodaje, klijenata i poslovnih procesa u jednom sistemu.','for_whom'=>'Preduzeća svih sektora','link'=>'','featured'=>''],
        ]);
        update_post_meta($fid, 'bcms_fp_proc_steps', [
            ['number'=>'1','title'=>'Razumijemo procese, dizajniramo rješenje','desc'=>'Brzo mapiramo gdje nastaju rizici: identitet, pristup, dokumenti i operacije. Na toj osnovi sklapamo ciljnu arhitekturu prilagođenu vašim potrebama.'],
            ['number'=>'2','title'=>'Pilot u realnim uslovima','desc'=>'U roku od 24 sata postavljamo prilagođeni pilot u vašem okruženju i povezujemo ga sa core sistemima. Testiranje na stvarnim procesima — odmah.'],
            ['number'=>'3','title'=>'Implementacija i podrška','desc'=>'Glatka tranzicija, obuka zaposlenih i tehnička dokumentacija. Nakon pokretanja, ostajemo vaš partner za sve nadogradnje i podršku.'],
        ]);
        update_post_meta($fid, 'bcms_fp_test_partners', [
            ['name'=>'Adriatic Bank'],['name'=>'Alter Modus'],['name'=>'CKB Banka'],
            ['name'=>'Telemach'],['name'=>'B-ONE'],['name'=>'CINMED'],
            ['name'=>'SAT-TRAKT'],['name'=>'Permar Plus'],['name'=>'2AI4ME'],
        ]);
        update_post_meta($fid, 'bcms_fp_test_cards', [
            ['quote'=>'Saradnja sa Cleargreen timom značajno je unaprijedila digitalne procese u mikrofinansijama.','company'=>'Alter Modus','logo'=>''],
            ['quote'=>'Cleargreen je implementirao softver za identifikaciju u naših devet poslovnica — proces je sigurniji i efikasniji.','company'=>'Adriatic Bank','logo'=>''],
            ['quote'=>'Instalacijom Cleargreen GateKeeper sistema značajno smo unaprijedili kontrolu pristupa i sigurnost u poslovnoj zgradi.','company'=>'CKB Banka','logo'=>''],
            ['quote'=>'U okruženju sa velikim protokom posjetilaca, GateKeeper je značajno smanjio operativni rizik na ulazu i ubrzao rad recepcije.','company'=>'Telemach','logo'=>''],
            ['quote'=>'Zajedno sa Cleargreen-om razvijamo napredne informaciono-komunikacione sisteme za klijente širom regiona.','company'=>'B-ONE','logo'=>''],
            ['quote'=>'Naše AI inovacije, uz Cleargreen-ovu ekspertizu, donose praktične alate za poslovnu transformaciju.','company'=>'CINMED','logo'=>''],
        ]);
        update_post_meta($fid, '_bcms_fp_seeded', '1');
    }

    // ─── GATEKEEPER TITAN SEED ───
    // Find pages using gatekeeper-titan.php template
    $titan_pages = get_posts(['post_type'=>'page','meta_key'=>'_wp_page_template','meta_value'=>'gatekeeper-titan.php','posts_per_page'=>-1,'fields'=>'ids']);
    foreach ($titan_pages as $pid) {
        if (get_post_meta($pid, '_bcms_gkt_seeded', true)) continue;
        update_post_meta($pid, 'bcms_gkt_hero_line1', 'Digitalizujte portirnicu.');
        update_post_meta($pid, 'bcms_gkt_hero_line2', 'Osigurajte instituciju.');
        update_post_meta($pid, 'bcms_gkt_hero_desc', 'Zamijenite manuelne sveske i softvere sa naprednom platformom za provjeru identiteta zasnovanu na Regula Forensics tehnologiji. Usklađeno sa GDPR i ISO 27001 standardima.');
        update_post_meta($pid, 'bcms_gkt_hero_cta_text', 'Zakaži demo uživo');
        update_post_meta($pid, 'bcms_gkt_hero_cta_url', '#references');
        update_post_meta($pid, 'bcms_gkt_brand_title', 'Povjerenje institucija i organizacija');
        update_post_meta($pid, 'bcms_gkt_brand_desc', 'GateKeeper se koristi u okruženjima sa povećanim bezbjednosnim i regulatornim zahtjevima.');
        update_post_meta($pid, 'bcms_gkt_proc_title', 'Digitalizujte upravljanje posjetiocima u <span class="text-accent-light">5 koraka</span>');
        update_post_meta($pid, 'bcms_gkt_proc_subtitle', '<span class="text-accent-light">GateKeeper</span> vodi vas kroz kompletan proces - od konfiguracije do analitike posjeta.');
        update_post_meta($pid, 'bcms_gkt_proc_steps', [
            ['title'=>'Konfiguracija <span class="text-accent-light">organizacije</span>','items'=>"Postavite digitalnu strukturu sektora, radnih mjesta i uloga unutar institucije.\nDefinišite precizna pravila pristupa i nivoe korisničkih prava za portire i zaposlene.\nCentralizujte upravljanje zajedničkim resursima i salama za sastanke."],
            ['title'=>'Najave i <span class="text-accent-light">zakazivanje posjeta</span>','items'=>"Najavite posjetioce unaprijed kroz centralni kalendar i smanjite gužve na ulazu.\nOmogućite portiru jasan pregled dnevnih dolazaka bez potrebe za telefonskim provjerama.\nPovećajte transparentnost zauzetosti sala i efikasnost korišćenja prostorija."],
            ['title'=>'Identifikacija posjetioca na <span class="text-accent-light">ulazu</span>','items'=>"Verifikujte dokumente tabletom za 10 sekundi\nPrepoznajte preko 200 tipova dokumenata iz cijelog svijeta u svega par sekundi.\nGarantujte privatnost – očitavanje podataka se vrši bez čuvanja slika dokumenata i biometrije."],
            ['title'=>'<span class="text-accent-light">Evidencija pristupa</span>','items'=>"Pratite ulaske i izlaske u realnom vremenu uz neoboriv digitalni audit trag.\nZnajte u svakom trenutku ko se nalazi u objektu i kod kojeg zaposlenog.\nObezbijedite dokaziv protokol za potrebe revizije i ISO/IEC 27001 standarda."],
            ['title'=>'<span class="text-accent-light">Analitika posjeta</span> i izvještaji','items'=>"Dobijte detaljan uvid u opterećenost sektora i statistiku posjeta po danima.\nOptimizujte resurse i rad portirnice na osnovu stvarnih podataka o protoku ljudi.\nIzvezite precizne izvještaje za dalju obradu, arhiviranje ili BI integraciju."],
        ]);
        update_post_meta($pid, 'bcms_gkt_verif_title', 'Verifikacija dokumenta kojoj <span style="color: #bcd642">svijet vjeruje</span>');
        update_post_meta($pid, 'bcms_gkt_verif_items', [
            ['title'=>'Univerzalna prepoznatljivost','desc'=>'Gatekeeper koristi <span class="text-highlight">Regula Forensics</span> tehnologiju za za najstrože provjere dokumenata.'],
            ['title'=>'100% usklađenost i privatnost','desc'=>'Potpuna zaštita podataka u skladu sa <span class="text-highlight">GDPR</span> standardima i domaćim Zakonom o zaštiti ličnih podataka, kao <span class="text-highlight">ISO/IEC 27001</span> standardom.'],
            ['title'=>'Globalni standard sigurnosti','desc'=>'Tehnologija kojoj vjeruje <span class="text-highlight">USA</span> i <span class="text-highlight">MUP Crne Gore</span> na graničnim prelazima, kao i mnoge države i globalne korporacije.'],
        ]);
        update_post_meta($pid, 'bcms_gkt_test_title', 'Šta naši klijenti kažu');
        update_post_meta($pid, 'bcms_gkt_test_cards', [
            ['quote'=>'GateKeeper nam je donio standardizovan i dokaziv protokol upravljanja posjetama, uz jasan audit trag ulazaka i izlazaka. Posebno je vrijedno što je proces identifikacije pouzdan, brz i usklađen sa internim bezbjednosnim procedurama.','company'=>'CKB Banka','logo'=>'logo/CKBbanka_logo.png'],
            ['quote'=>'U okruženju sa velikim protokom posjetilaca, GateKeeper je značajno smanjio operativni rizik na ulazu i ubrzao rad recepcije. Sistem je jednostavan za korišćenje, a kontrola pristupa je transparentna i mjerljiva.','company'=>'Telemach','logo'=>'logo/telemach-crna-gora-feature.jpg'],
            ['quote'=>'Za institucije gdje su bezbjednost i usklađenost ključni, GateKeeper obezbjeđuje jasne evidencije i kontrolisan pristup bez nepotrebne administracije. Proces je standardizovan, a podaci su dostupni za interne provjere i revizije.','company'=>'Agencija za ljekove – CINMED','logo'=>'logo/1.png'],
            ['quote'=>'GateKeeper je unaprijedio kontrolu posjetilaca kroz real-time evidenciju i pregledan sistem upravljanja pristupom. Rješenje je praktično, brzo se uklapa u postojeće procedure i smanjuje prostor za propuste na ulazu.','company'=>'SAT-TRAKT','logo'=>'logo/satrakt logo.jpg'],
            ['quote'=>'GateKeeper je dobar primjer kako se fizička bezbjednost i informacione procedure mogu povezati u jedinstven tok. Audit trag, korisnička prava i analitika posjeta daju nivo kontrole koji je potreban u ozbiljnim sistemima.','company'=>'medIT group','logo'=>'logo/Untitled.png'],
        ]);
        update_post_meta($pid, 'bcms_gkt_faq_title', 'Često postavljana pitanja');
        update_post_meta($pid, 'bcms_gkt_faq_items', [
            ['q'=>'Da li je GateKeeper usklađen sa GDPR i domaćim Zakonom o zaštiti ličnih podataka?','a'=>'Da. GateKeeper je razvijen u skladu sa GDPR regulativom i domaćim Zakonom o zaštiti ličnih podataka, uz strogo kontrolisan pristup podacima.'],
            ['q'=>'Da li GateKeeper čuva skenirane dokumente ili biometrijske podatke?','a'=>'Ne. GateKeeper ne zadržava biometrijske podatke niti trajno skladišti skenirane dokumente van sistema institucije, osim ako to nije definisano internim pravilima i važećim propisima.'],
            ['q'=>'Kako funkcioniše verifikacija identiteta (Regula Forensics)?','a'=>'GateKeeper koristi Regula Forensics tehnologiju za pouzdano očitavanje i provjeru identiteta posjetilaca tokom registracije na ulazu.'],
            ['q'=>'Da li GateKeeper podržava ISO/IEC 27001 zahtjeve?','a'=>'Da. Sistem obezbjeđuje audit trag i dokazive evidencije fizičkog pristupa, što direktno pomaže organizacijama koje uvode ili posjeduju ISO/IEC 27001.'],
            ['q'=>'Koliko traje implementacija i šta je potrebno sa naše strane?','a'=>'Implementacija je brza i podrazumijeva konfiguraciju prema strukturi institucije (sektori, zaposleni i pravila pristupa), uz inicijalno podešavanje i kratku obuku po potrebi.'],
        ]);
        update_post_meta($pid, '_bcms_gkt_seeded', '1');
    }

    // ─── GATEKEEPER OLD SEED ───
    $gko_pages = get_posts(['post_type'=>'page','meta_key'=>'_wp_page_template','meta_value'=>'gatekeepeer.php','posts_per_page'=>-1,'fields'=>'ids']);
    foreach ($gko_pages as $pid) {
        if (get_post_meta($pid, '_bcms_gko_seeded', true)) continue;
        update_post_meta($pid, 'bcms_gko_hero_title', 'Digitalizujte upravljanje <span class="text-gradient-teal font-dm-serif fst-italic fw-normal">posjetiocima</span> sa GateKeeper');
        update_post_meta($pid, 'bcms_gko_hero_desc', 'Napredna <span class="text-yellow">SaaS aplikacija</span> za kontrolu pristupa, identifikaciju posjetilaca i automatizaciju procesa upravljanja posjetama u vašoj instituciji');
        update_post_meta($pid, 'bcms_gko_hero_btn_text', 'Kontaktirajte nas');
        update_post_meta($pid, 'bcms_gko_hero_check1', 'GDPR usklađeno');
        update_post_meta($pid, 'bcms_gko_hero_check2', 'Sigurno i pouzdano');
        update_post_meta($pid, 'bcms_gko_intro_badge', 'O GateKeeper-u');
        update_post_meta($pid, 'bcms_gko_intro_title', 'Napredna <span class="text-gradient-teal">SaaS aplikacija</span> za upravljanje posjetiocima');
        update_post_meta($pid, 'bcms_gko_intro_p1', '<strong>GateKeeper</strong> je napredna <strong>SaaS aplikacija</strong> razvijena za digitalizaciju i standardizaciju upravljanja posjetiocima u institucijama.');
        update_post_meta($pid, 'bcms_gko_intro_p2', 'U saradnji sa <strong>Regula Forensics</strong>, globalnim liderom u oblasti forenzičke opreme i softvera za verifikaciju dokumenata, <strong>GateKeeper garantuje</strong> preciznu identifikaciju i sigurnosne provjere posjetilaca.');
        update_post_meta($pid, 'bcms_gko_intro_p3', 'Sistem omogućava jednostavno i sigurno <strong>praćenje ulazaka i izlazaka</strong>, centralizovano <strong>zakazivanje</strong> sastanaka i kompletnu <strong>evidenciju</strong> svih posjetilaca u realnom vremenu.');
        update_post_meta($pid, 'bcms_gko_intro_p4', 'Aplikacija <strong>zamjenjuje manuelne</strong> procese na recepciji, smanjuje administrativno opterećenje zaposlenih i osigurava veću transparentnost unutar objekta.');
        update_post_meta($pid, 'bcms_gko_intro_p5', 'GateKeeper radi na principu minimalnih podataka i u potpunosti je usklađen sa <strong>Zakonom o zaštiti ličnih podataka</strong>, dizajniran da podrži organizacije sa visokim sigurnosnim zahtjevima.');
        update_post_meta($pid, 'bcms_gko_clients_badge', 'Naši klijenti');
        update_post_meta($pid, 'bcms_gko_clients_title', 'U upotrebi kod');
        update_post_meta($pid, 'bcms_gko_benef_section', 'PREDNOSTI');
        update_post_meta($pid, 'bcms_gko_benef_desc', 'GateKeeper je namijenjen institucijama koje imaju povećan protok posjetilaca i potrebu za sigurnom identifikacijom i jasnim evidencijama.');
        update_post_meta($pid, 'bcms_gko_benef_subtitle', 'Benefiti koje organizacije ostvaruju:');
        update_post_meta($pid, 'bcms_gko_benef_items', [
            ['icon'=>'ph ph-shield-check','title'=>'Povećana sigurnost','desc'=>'Automatska evidencija ulazaka i izlazaka, smanjen rizik od neovlašćenog pristupa.'],
            ['icon'=>'ph ph-desktop','title'=>'Digitalna portirnica/recepcija','desc'=>'Bez ručnog zapisivanje u dnevnike, jasan pregled posjetilaca, brži i precizniji rad.'],
            ['icon'=>'ph ph-chart-line-up','title'=>'Pametne analitike','desc'=>'Uvid u istorijat posjeta, opterećenost sektora i zaposlenih, zauzetost sala za sastanke itd.'],
            ['icon'=>'ph ph-calendar-check','title'=>'Bolja interna organizacija','desc'=>'Kalendar sastanaka, obavještenja i pregled dolazaka u realnom vremenu.'],
            ['icon'=>'ph ph-scales','title'=>'Zakonska usklađenost i bezbijednost podataka','desc'=>'U potpunosti usklađen sa GDPR regulativom i domaćim Zakonom o zaštiti ličnih podataka.'],
            ['icon'=>'ph ph-gear','title'=>'Implementacija u roku od 2 do 3 dana','desc'=>'Intuitivan interfejs koji zahtijeva minimalno obuke za osoblje.'],
        ]);
        update_post_meta($pid, 'bcms_gko_benef_footer1', 'Posebno je koristan za banke, državne institucije, opštine, mikrofinansijske organizacije, zdravstvene ustanove i sve organizacije koje i dalje ručno zapisuju podatke u dnevnik.');
        update_post_meta($pid, 'bcms_gko_benef_footer2', 'GateKeeper značajno olakšava organizacijama koje uvode ili posjeduju ISO/IEC 27001 kroz digitalnu kontrolu fizičkog pristupa, audit trag i jasno definisana korisnička prava.');
        update_post_meta($pid, 'bcms_gko_about_section', 'O NAMA');
        update_post_meta($pid, 'bcms_gko_about_cg_title', 'ClearGreen');
        update_post_meta($pid, 'bcms_gko_about_cg_sub', 'Specijalizovana kompanija za digitalna rješenja');
        update_post_meta($pid, 'bcms_gko_about_cg_desc', 'ClearGreen je kompanija specijalizovana za razvoj naprednih rješenja u oblastima digitalne identifikacije, kontrole pristupa i automatizacije poslovnih procesa.');
        update_post_meta($pid, 'bcms_gko_about_solutions', [
            ['icon'=>'ph ph-shield-check','name'=>'GateKeeper','desc'=>'Platforma za digitalnu evidenciju posjetilaca i kontrolu pristupa.'],
            ['icon'=>'ph ph-bank','name'=>'BASIC','desc'=>'Rješenje za onboarding, spriječavanje lažnih identiteta i fraud pokušaja za banke.'],
            ['icon'=>'ph ph-device-mobile','name'=>'SIMPLEX','desc'=>'Sistem za sigurnu aktivaciju SIM/eSIM kartica sa provjerom identiteta.'],
            ['icon'=>'ph ph-chart-line-up','name'=>'Alter One','desc'=>'Sveobuhvatan softver za mikrofinansijske institucije (krediti, klijenti, izvještaji).'],
            ['icon'=>'ph ph-file-text','name'=>'DMS','desc'=>'Document Management System - procesno orijentisan alat za upravljanje dokumentima.'],
            ['icon'=>'ph ph-gear','name'=>'Specijalizovana rješenja','desc'=>'Softverska rješenja za automatizaciju procesa.'],
        ]);
        update_post_meta($pid, 'bcms_gko_about_assoc', 'Član Asocijacije menadžera za bezbjednost');
        update_post_meta($pid, 'bcms_gko_regula_title', 'Regula Forensics');
        update_post_meta($pid, 'bcms_gko_regula_sub', 'forensic science systems');
        update_post_meta($pid, 'bcms_gko_regula_desc', 'ClearGreen je zvanični partner Regula Forensics, globalnog lidera u forenzičkoj verifikaciji dokumenata, čije tehnologije integrišemo u više naših rješenja za digitalnu identifikaciju i kontrolu pristupa.');
        update_post_meta($pid, 'bcms_gko_regula_info', [
            ['title'=>'Saradnja sa','text'=>'USA, Interpol, Europol, vladine agencije i banke'],
            ['title'=>'U Crnoj Gori','text'=>'Ministarstvo unutrašnjih poslova koristi Regula tehnologiju za kontrolu i validaciju dokumenata na graničnim prelazima.'],
            ['title'=>'Sistem prepoznaje i verifikuje','text'=>'200+ tipova dokumenata iz više od 250 zemalja, uključujući lične karte, pasoše, vozačke dozvole, diplomatske dozvole, trajne i privremene boravišne dozvole, privremene radne dozvole, dozvole za oružje, policijske iskaznice.'],
        ]);
        update_post_meta($pid, 'bcms_gko_proc_section', 'PROCES RADA');
        update_post_meta($pid, 'bcms_gko_proc_desc1', 'GateKeeper digitalizuje kompletan tok upravljanja posjetama - od organizacione pripreme, preko najava i provjere identiteta, do evidencije pristupa i napredne analitike.');
        update_post_meta($pid, 'bcms_gko_proc_desc2', 'Sistem eliminiše ručne evidencije, ubrzava rad portira i obezbjeđuje pouzdanu provjeru identiteta u svakom koraku.');
        update_post_meta($pid, 'bcms_gko_proc_subtitle', 'Kako funkcioniše <strong>GateKeeper</strong> u 5 koraka:');
        update_post_meta($pid, 'bcms_gko_proc_steps', [
            ['title'=>'Konfiguracija organizacije','short'=>'Postavljanje sektora, radnih mjesta, zaposlenih i pravila pristupa.','detail'=>'Postavljanje sektora, odjeljenja, radnih mjesta i zaposlenih predstavlja osnovu sistema. Administrator kreira strukturu institucije, definiše uloge korisnika i pravila pristupa. GateKeeper podržava i zajedničke kancelarije/sale za sastanke, koje se mogu rezervisati tokom planiranja posjeta.','nav'=>'Konfiguracija'],
            ['title'=>'Najave i zakazivanje posjeta','short'=>'Zaposleni najavljuju posjetioce, rezervišu sastanke i zajedničke prostorije.','detail'=>'Zaposleni najavljuju posjetioce, rezervišu sastanke i zajedničke prostorije. Sistem omogućava jednostavno planiranje i upravljanje posjetama.','nav'=>'Najave'],
            ['title'=>'Identifikacija posjetioca na ulazu','short'=>'Portir skenira dokument i sistem automatski kreira zapis posjete.','detail'=>'Portir skenira dokument i sistem automatski kreira zapis posjete. Koristi se Regula Forensics tehnologija za verifikaciju dokumenata.','nav'=>'Identifikacija'],
            ['title'=>'Evidencija pristupa','short'=>'Ulazak i izlazak posjetioca bilježe se u realnom vremenu, uz audit trag.','detail'=>'Ulazak i izlazak posjetioca bilježe se u realnom vremenu, uz audit trag. Sistem automatski bilježi sve aktivnosti.','nav'=>'Evidencija'],
            ['title'=>'Analitika posjeta i izvještaji','short'=>'Institucija dobija detaljne uvide i statistike za optimizaciju rada.','detail'=>'Institucija dobija detaljne uvide i statistike za optimizaciju rada. Sistem generiše različite izvještaje i analitiku.','nav'=>'Analitika'],
        ]);
        update_post_meta($pid, 'bcms_gko_impl_badge', 'IMPLEMENTACIJA');
        update_post_meta($pid, 'bcms_gko_impl_title', 'Brza i efikasna implementacija');
        update_post_meta($pid, 'bcms_gko_impl_cards', [
            ['title'=>'Brza implementacija','text'=>'Implementacija sistema po lokaciji traje <strong>2 do 3 radna dana</strong>, u zavisnosti od specifičnih zahtjeva i infrastrukture klijenta.'],
            ['title'=>'Jednostavna upotreba','text'=>'Aplikacija je jednostavna za korišćenje i isporučuje se sa detaljnim uputstvima.'],
            ['title'=>'Obuke za zaposlene','text'=>'<strong>Po potrebi</strong>, naš tim organizuje i periodične obuke za zaposlene.'],
            ['title'=>'Tehnička podrška','text'=>'Naš tim obezbjeđuje <strong>stalnu tehničku podršku</strong>, a sve prijavljene nepravilnosti rješavaju se u najkraćem roku.'],
            ['title'=>'Kontinuirano unapređenje','text'=>'GateKeeper se <strong>kontinuirano unapređuje</strong>, dodaju se nove funkcionalnosti, sigurnosna poboljšanja i optimizacije.'],
            ['title'=>'Najnovija verzija','text'=>'Klijent uvijek ima pristup <strong>najnovijoj verziji sistema</strong>, bez dodatnih troškova instalacije ili nadogradnje.'],
        ]);
        update_post_meta($pid, 'bcms_gko_footer_title', 'Spremni smo da kroz demo prezentaciju uživo prikažemo kako se GateKeeper može primijeniti u vašoj organizaciji.');
        update_post_meta($pid, 'bcms_gko_footer_contacts', [
            ['name'=>'Stefan Planić','role'=>'CEO','email'=>'stefan.planic@cleargreen.me','phone'=>'+382 68 090 161'],
            ['name'=>'Tamara Knežević','role'=>'BDM','email'=>'tamara@cleargreen.me','phone'=>'+382 67 00 5590'],
        ]);
        update_post_meta($pid, 'bcms_gko_footer_copyright', '© 2025 ClearGreen. Sva prava zadržana.');
        update_post_meta($pid, '_bcms_gko_seeded', '1');
    }
});

// ─── "Sačuvaj kao default" meta box ───
add_action('add_meta_boxes', function() {
    global $post;
    if (!$post || $post->post_type !== 'page') return;
    if (!current_user_can('manage_options')) return;

    $is_front = ($post->ID === (int) get_option('page_on_front'));
    $tpl = get_post_meta($post->ID, '_wp_page_template', true);
    $has_bcms = $is_front || in_array($tpl, ['gatekeeper-titan.php', 'gatekeepeer.php', 'gatekeeper.php']);

    if ($has_bcms) {
        add_meta_box('bcms_export_defaults', 'CMS Defaults', 'bcms_export_defaults_render', 'page', 'side', 'high');
    }
}, 20);

function bcms_export_defaults_render($post) {
    $nonce = wp_create_nonce('bcms_save_defaults');
    $file = get_stylesheet_directory() . '/defaults.json';
    $exists = file_exists($file);
    $time = $exists ? date('d.m.Y H:i', filemtime($file)) : '';
    echo '<p>Eksportuj sve CMS vrijednosti u <code>defaults.json</code> unutar teme.</p>';
    if ($exists) {
        echo '<p style="color:#666;font-size:12px;">Zadnji export: ' . esc_html($time) . '</p>';
    }
    echo '<button type="button" class="button button-primary" id="bcms-save-defaults" ';
    echo 'data-post-id="' . esc_attr($post->ID) . '" data-nonce="' . esc_attr($nonce) . '">';
    echo 'Sačuvaj kao default</button>';
    echo '<div id="bcms-defaults-status" style="margin-top:8px"></div>';
    echo '<script>jQuery(function($){';
    echo '$("#bcms-save-defaults").on("click",function(e){';
    echo 'e.preventDefault();var $b=$(this),$s=$("#bcms-defaults-status");';
    echo '$b.prop("disabled",true).text("Čuvam...");';
    echo '$.post(ajaxurl,{action:"bcms_save_defaults",post_id:$b.data("post-id"),nonce:$b.data("nonce")},function(r){';
    echo '$b.prop("disabled",false).text("Sačuvaj kao default");';
    echo 'if(r.success){$s.html(\'<span style="color:green">&#10003; \'+r.data.message+\'</span>\');}';
    echo 'else{$s.html(\'<span style="color:red">&#10007; \'+(r.data||"Greška")+\'</span>\');}';
    echo '}).fail(function(){$b.prop("disabled",false).text("Sačuvaj kao default");';
    echo '$s.html(\'<span style="color:red">&#10007; Request failed</span>\');});});});';
    echo '</script>';
}

// ─── AJAX: Export post_meta to defaults.json ───
add_action('wp_ajax_bcms_save_defaults', function() {
    if (!current_user_can('manage_options')) {
        wp_send_json_error('Nemate dozvolu.', 403);
    }
    check_ajax_referer('bcms_save_defaults', 'nonce');

    $post_id = intval($_POST['post_id'] ?? 0);
    if (!$post_id) wp_send_json_error('Nema post ID.');

    $all_meta = get_post_meta($post_id);
    $defaults = [];

    foreach ($all_meta as $key => $values) {
        if (strpos($key, 'bcms_') !== 0) continue;
        if (strpos($key, '_bcms_') === 0) continue;
        $val = maybe_unserialize($values[0]);
        $defaults[$key] = $val;
    }

    $file = get_stylesheet_directory() . '/defaults.json';

    // Merge sa postojećim (čuva ključeve drugih šablona)
    if (file_exists($file)) {
        $existing = json_decode(file_get_contents($file), true);
        if (is_array($existing)) {
            $defaults = array_merge($existing, $defaults);
        }
    }

    $defaults['_version'] = 1;
    $defaults['_exported_at'] = current_time('c');

    $json = json_encode($defaults, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $written = file_put_contents($file, $json);

    if ($written === false) {
        wp_send_json_error('Ne mogu upisati defaults.json — provjerite permisije.');
    }

    wp_send_json_success([
        'message' => 'Sačuvano! (' . count($defaults) . ' ključeva)',
        'file' => $file,
    ]);
});
