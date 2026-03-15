<?php

// Custom CMS meta boxes for all page templates (no plugins needed)
require_once get_stylesheet_directory() . '/inc/meta-boxes.php';

add_action('after_setup_theme', function() {
    register_nav_menus([
        'primary' => __( 'Glavni meni', 'text-domain' ),
    ]);
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1200, 800, true );
});

// Helper: robust check for page template slug (works inside hooks/filters too)
function asenvirocon_is_page_template_slug(string $slug): bool {
    if (function_exists('is_page_template') && is_page_template($slug)) {
        return true;
    }
    if (function_exists('get_page_template_slug') && get_page_template_slug() === $slug) {
        return true;
    }
    if (function_exists('is_page') && is_page()) {
        $id = function_exists('get_the_ID') ? get_the_ID() : 0;
        if ($id) {
            $template = get_post_meta($id, '_wp_page_template', true);
            if ($template === $slug) {
                return true;
            }
        }
    }
    return false;
}

add_action('init', 'tt3child_register_acf_blocks');
function tt3child_register_acf_blocks() {
    register_block_type( get_stylesheet_directory() . '/template-parts/blocks/hero/' );
    register_block_type( get_stylesheet_directory() . '/template-parts/blocks/about/' );
    register_block_type( get_stylesheet_directory() . '/template-parts/blocks/why-us/' );
    register_block_type( get_stylesheet_directory() . '/template-parts/blocks/services/' );
    register_block_type( get_stylesheet_directory() . '/template-parts/blocks/process/' );
    register_block_type( get_stylesheet_directory() . '/template-parts/blocks/testimonials/' );
    register_block_type( get_stylesheet_directory() . '/template-parts/blocks/blog/' );
    register_block_type( get_stylesheet_directory() . '/template-parts/blocks/contact/' );
    register_block_type( get_stylesheet_directory() . '/template-parts/blocks/about-hero/' );
    register_block_type( get_stylesheet_directory() . '/template-parts/blocks/mission/' );
    register_block_type( get_stylesheet_directory() . '/template-parts/blocks/team/' );
    register_block_type( get_stylesheet_directory() . '/template-parts/blocks/blog-page/' );
}

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style(
        'mojtema-style',
        get_stylesheet_uri(),
        [],
        filemtime( get_stylesheet_directory() . '/style.css' )
    );
});

// Dozvoli SVG upload u Media Library
add_filter('upload_mimes', function($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

// Omogući custom logo
add_theme_support('custom-logo', [
    'height'      => 60,
    'width'       => 220,
    'flex-height' => true,
    'flex-width'  => true,
]);

// Dodaj Customizer opcije za logotipe
add_action('customize_register', function($wp_customize) {
    // Sekcija za logotipe
    $wp_customize->add_section('theme_logos', [
        'title'    => __('Logotipi', 'cleargreen'),
        'priority' => 30,
    ]);

    // Gatekeeper logo
    $wp_customize->add_setting('gatekeeper_logo', [
        'default'           => '',
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'gatekeeper_logo', [
        'label'       => __('Gatekeeper Logo', 'cleargreen'),
        'description' => __('Logo koji se prikazuje na Gatekeeper template stranicama', 'cleargreen'),
        'section'     => 'theme_logos',
        'mime_type'   => 'image',
    ]));

    // Gatekeeper Titan logo
    $wp_customize->add_setting('gatekeeper_titan_logo', [
        'default'           => '',
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'gatekeeper_titan_logo', [
        'label'       => __('Gatekeeper Titan Logo', 'cleargreen'),
        'description' => __('Logo koji se prikazuje na Gatekeeper Titan template stranicama', 'cleargreen'),
        'section'     => 'theme_logos',
        'mime_type'   => 'image',
    ]));

    // Swiper logotipi - Gatekeeper template (multiple select)
    $wp_customize->add_setting('swiper_logos_gatekeeper', [
        'default'           => '',
        'sanitize_callback' => function($input) {
            if (empty($input)) {
                return '';
            }
            // Čuva kao JSON array sa image_id i alt
            $decoded = json_decode($input, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $input;
            }
            return '';
        },
    ]);

    // Custom kontrola sa Media Library modalom
    class Cleargreen_Swiper_Logos_Control extends WP_Customize_Control {
        public $type = 'swiper_logos';
        
        public function enqueue() {
            wp_enqueue_media();
        }
        
        public function render_content() {
            $current_value = $this->value();
            $logos = [];
            if (!empty($current_value)) {
                $logos = json_decode($current_value, true);
                if (!is_array($logos)) {
                    $logos = [];
                }
            }
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php if (!empty($this->description)) : ?>
                    <span class="description customize-control-description"><?php echo $this->description; ?></span>
                <?php endif; ?>
            </label>
            <div class="swiper-logos-control">
                <button type="button" class="button button-primary select-logos" data-control-id="<?php echo esc_attr($this->id); ?>">
                    <?php _e('Izaberi logotipe iz Media Library', 'cleargreen'); ?>
                </button>
                <div id="swiper-logos-<?php echo esc_attr($this->id); ?>" class="swiper-logos-list" style="margin-top: 15px;">
                    <?php if (!empty($logos)) : ?>
                        <?php foreach ($logos as $index => $logo) : 
                            if (!isset($logo['image_id'])) continue;
                            $image_id = absint($logo['image_id']);
                            $image_url = wp_get_attachment_image_url($image_id, 'thumbnail');
                            $image_title = get_the_title($image_id) ?: 'Slika #' . $image_id;
                            $alt_text = isset($logo['alt']) ? esc_attr($logo['alt']) : '';
                            if (!$image_url) continue;
                        ?>
                            <div class="swiper-logo-item" data-image-id="<?php echo $image_id; ?>">
                                <div class="logo-preview">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="" style="max-width: 60px; height: auto; display: block;">
                                </div>
                                <div class="logo-info">
                                    <strong><?php echo esc_html($image_title); ?></strong>
                                    <input type="text" class="swiper-logo-alt" placeholder="Alt tekst (opciono)" value="<?php echo $alt_text; ?>" style="width: 100%; margin-top: 5px;">
                                </div>
                                <button type="button" class="button remove-logo" style="margin-left: auto;">Ukloni</button>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="no-logos" style="color: #666; font-style: italic;">Nema izabranih logotipa. Klikni "Izaberi logotipe" da dodaš logotipe.</p>
                    <?php endif; ?>
                </div>
                <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>">
            </div>
            <script type="text/javascript">
            (function($) {
                wp.customize.bind('ready', function() {
                    var controlId = '<?php echo esc_js($this->id); ?>';
                    var controlSelector = '#swiper-logos-' + controlId;
                    var $hiddenInput = $(controlSelector).closest('.swiper-logos-control').find('input[type="hidden"]');
                    var frame;
                    
                    function updateHiddenInput() {
                        var logos = [];
                        $(controlSelector).find('.swiper-logo-item').each(function() {
                            var $item = $(this);
                            var imageId = $item.data('image-id');
                            var alt = $item.find('.swiper-logo-alt').val() || '';
                            if (imageId) {
                                logos.push({
                                    image_id: parseInt(imageId),
                                    alt: alt
                                });
                            }
                        });
                        $hiddenInput.val(JSON.stringify(logos)).trigger('change');
                        
                        // Prikaži/sakrij poruku ako nema logotipa
                        if (logos.length === 0) {
                            if ($(controlSelector).find('.no-logos').length === 0) {
                                $(controlSelector).append('<p class="no-logos" style="color: #666; font-style: italic;">Nema izabranih logotipa. Klikni "Izaberi logotipe" da dodaš logotipe.</p>');
                            }
                        } else {
                            $(controlSelector).find('.no-logos').remove();
                        }
                    }
                    
                    // Otvori Media Library modal
                    $(document).on('click', '.select-logos[data-control-id="' + controlId + '"]', function(e) {
                        e.preventDefault();
                        
                        if (frame) {
                            frame.open();
                            return;
                        }
                        
                        // Kreiraj Media Library frame sa multiple selection
                        frame = wp.media({
                            title: '<?php _e('Izaberi logotipe', 'cleargreen'); ?>',
                            button: {
                                text: '<?php _e('Dodaj izabrane logotipe', 'cleargreen'); ?>'
                            },
                            multiple: true,
                            library: {
                                type: 'image'
                            }
                        });
                        
                        // Kada se izaberu slike
                        frame.on('select', function() {
                            var selection = frame.state().get('selection');
                            var existingIds = [];
                            
                            // Uzmi postojeće ID-eve
                            $(controlSelector).find('.swiper-logo-item').each(function() {
                                existingIds.push(parseInt($(this).data('image-id')));
                            });
                            
                            selection.each(function(attachment) {
                                var attachmentId = attachment.id;
                                
                                // Preskoči ako već postoji
                                if (existingIds.indexOf(attachmentId) !== -1) {
                                    return;
                                }
                                
                                // Koristi thumbnail ako postoji, inače medium, inače full
                                var attachmentUrl = attachment.attributes.sizes && attachment.attributes.sizes.thumbnail ? 
                                    attachment.attributes.sizes.thumbnail.url : 
                                    (attachment.attributes.sizes && attachment.attributes.sizes.medium ? 
                                        attachment.attributes.sizes.medium.url : 
                                        attachment.attributes.url);
                                var attachmentTitle = attachment.attributes.title || attachment.attributes.filename || 'Slika #' + attachmentId;
                                
                                var html = '<div class="swiper-logo-item" data-image-id="' + attachmentId + '">';
                                html += '<div class="logo-preview">';
                                html += '<img src="' + attachmentUrl + '" alt="" style="max-width: 60px; height: auto; display: block;">';
                                html += '</div>';
                                html += '<div class="logo-info">';
                                html += '<strong>' + attachmentTitle + '</strong>';
                                html += '<input type="text" class="swiper-logo-alt" placeholder="Alt tekst (opciono)" value="" style="width: 100%; margin-top: 5px;">';
                                html += '</div>';
                                html += '<button type="button" class="button remove-logo" style="margin-left: auto;">Ukloni</button>';
                                html += '</div>';
                                
                                $(controlSelector).find('.no-logos').remove();
                                $(controlSelector).append(html);
                            });
                            
                            updateHiddenInput();
                        });
                        
                        frame.open();
                    });
                    
                    // Ukloni logo
                    $(document).on('click', controlSelector + ' .remove-logo', function(e) {
                        e.preventDefault();
                        $(this).closest('.swiper-logo-item').remove();
                        updateHiddenInput();
                    });
                    
                    // Ažuriraj alt tekst
                    $(document).on('change', controlSelector + ' .swiper-logo-alt', function() {
                        updateHiddenInput();
                    });
                });
            })(jQuery);
            </script>
            <style>
            .swiper-logos-control { margin-top: 10px; }
            .swiper-logo-item { 
                display: flex; 
                gap: 15px; 
                margin-bottom: 15px; 
                align-items: center;
                padding: 10px;
                background: #f9f9f9;
                border: 1px solid #ddd;
                border-radius: 4px;
            }
            .logo-preview {
                flex-shrink: 0;
            }
            .logo-info {
                flex: 1;
            }
            .logo-info strong {
                display: block;
                margin-bottom: 5px;
            }
            </style>
            <?php
        }
    }
    
    $wp_customize->add_control(new Cleargreen_Swiper_Logos_Control($wp_customize, 'swiper_logos_gatekeeper', [
        'label'       => __('Swiper Logotipi (Gatekeeper)', 'cleargreen'),
        'description' => __('Klikni "Izaberi logotipe iz Media Library" da otvoriš Media Library i izabereš više logotipa odjednom.', 'cleargreen'),
        'section'     => 'theme_logos',
    ]));

    // Swiper logotipi - Gatekeeper Titan template (multiple select)
    $wp_customize->add_setting('swiper_logos_titan', [
        'default'           => '',
        'sanitize_callback' => function($input) {
            if (empty($input)) {
                return '';
            }
            $decoded = json_decode($input, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $input;
            }
            return '';
        },
    ]);

    $wp_customize->add_control(new Cleargreen_Swiper_Logos_Control($wp_customize, 'swiper_logos_titan', [
        'label'       => __('Swiper Logotipi (Titan)', 'cleargreen'),
        'description' => __('Klikni "Izaberi logotipe iz Media Library" da otvoriš Media Library i izabereš više logotipa odjednom.', 'cleargreen'),
        'section'     => 'theme_logos',
    ]));
});

// Helper funkcija za renderovanje swiper logotipa
function cleargreen_render_swiper_logos($template_type = 'gatekeeper') {
    $setting_name = $template_type === 'titan' ? 'swiper_logos_titan' : 'swiper_logos_gatekeeper';
    $logos_json = get_theme_mod($setting_name, '');
    
    if (empty($logos_json)) {
        return '';
    }
    
    $logos = json_decode($logos_json, true);
    if (!is_array($logos) || empty($logos)) {
        return '';
    }
    
    $output = '';
    foreach ($logos as $logo) {
        if (!isset($logo['image_id']) || empty($logo['image_id'])) {
            continue;
        }
        
        $image_id = absint($logo['image_id']);
        $alt_text = isset($logo['alt']) ? esc_attr($logo['alt']) : '';
        $image_url = wp_get_attachment_image_url($image_id, 'full');
        
        if (!$image_url) {
            continue;
        }
        
        if ($template_type === 'titan') {
            $output .= '<div class="swiper-slide">';
            $output .= '<div class="logo-box">';
            $output .= '<img loading="lazy" src="' . esc_url($image_url) . '" alt="' . $alt_text . '">';
            $output .= '</div>';
            $output .= '</div>';
        } else {
            $output .= '<div class="swiper-slide d-flex align-items-center justify-content-center" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="600">';
            $output .= '<div class="client-logo-item">';
            $output .= '<img src="' . esc_url($image_url) . '" alt="' . $alt_text . '" class="client-logo-img">';
            $output .= '</div>';
            $output .= '</div>';
        }
    }
    
    return $output;
}

// Dodaj favicon za Gatekeeper template
add_action('wp_head', function() {
    if (asenvirocon_is_page_template_slug('gatekeepeer.php') || asenvirocon_is_page_template_slug('gatekeeper-titan.php')) {
        echo '<link rel="shortcut icon" href="' . esc_url(get_stylesheet_directory_uri() . '/assets/images/logo/favicon.png') . '">' . "\n";
    }
}, 1);

// Dodaj body klase za Gatekeeper template
add_filter('body_class', function($classes) {
    if (asenvirocon_is_page_template_slug('gatekeepeer.php')) {
        $classes[] = 'home-three';
        $classes[] = 'crm-page';
    }
    if (asenvirocon_is_page_template_slug('gatekeeper-titan.php')) {
        $classes[] = 'titan-gatekeeper-page';
    }
    return $classes;
});

// Dodaj HTML klase za Gatekeeper template
add_filter('language_attributes', function($output) {
    if (asenvirocon_is_page_template_slug('gatekeepeer.php') || asenvirocon_is_page_template_slug('gatekeeper-titan.php')) {
        // Zameni language_attributes sa klasama home-three crm-page
        return 'lang="en" class="home-three crm-page"';
    }
    return $output;
}, 10, 1);

add_action('wp_enqueue_scripts', function() {
    // Skip standard CSS for Titan template (it has its own CSS)
    if (asenvirocon_is_page_template_slug('gatekeeper-titan.php')) {
        return;
    }
    
    wp_enqueue_style(
        'asenvirocon-style',
        get_stylesheet_directory_uri() . '/assets/css/style.css',
        [],
        filemtime(get_stylesheet_directory() . '/assets/css/style.css')
    );
    wp_enqueue_style(
        'asenvirocon-footer',
        get_stylesheet_directory_uri() . '/assets/css/footer.css',
        [],
        filemtime(get_stylesheet_directory() . '/assets/css/footer.css')
    );
    wp_enqueue_style(
        'asenvirocon-header',
        get_stylesheet_directory_uri() . '/assets/css/header.css',
        [],
        filemtime(get_stylesheet_directory() . '/assets/css/header.css')
    );
    
    // Enqueue gatekeeper.css samo za Gatekeeper template
    $is_gatekeeper = false;
    if (is_page_template('gatekeepeer.php')) {
        $is_gatekeeper = true;
    } elseif (get_page_template_slug() === 'gatekeepeer.php') {
        $is_gatekeeper = true;
    } elseif (is_page()) {
        $template = get_post_meta(get_the_ID(), '_wp_page_template', true);
        if ($template === 'gatekeepeer.php') {
            $is_gatekeeper = true;
        }
    }
    
    if ($is_gatekeeper) {
        wp_enqueue_style(
            'asenvirocon-gatekeeper',
            get_stylesheet_directory_uri() . '/assets/css/gatekeeper.css',
            [],
            filemtime(get_stylesheet_directory() . '/assets/css/gatekeeper.css')
        );
    }
    
    // Enqueue tvoj JS fajl
    wp_enqueue_script(
        'asenvirocon-main',
        get_stylesheet_directory_uri() . '/assets/js/main.js',
        [],
        filemtime(get_stylesheet_directory() . '/assets/js/main.js'),
        true 
    );
});

// Enqueue CSS for Titan-style Gatekeeper landing
add_action('wp_enqueue_scripts', function() {
    if (!asenvirocon_is_page_template_slug('gatekeeper-titan.php')) {
        return;
    }

    // Deregister WordPress jQuery to use custom version
    wp_deregister_script('jquery');

    // CSS files - same order as regular Gatekeeper template for header compatibility
    if (file_exists(get_stylesheet_directory() . '/assets/css/satoshi.css')) {
        wp_enqueue_style(
            'gatekeeper-titan-satoshi',
            get_stylesheet_directory_uri() . '/assets/css/satoshi.css',
            [],
            filemtime(get_stylesheet_directory() . '/assets/css/satoshi.css')
        );
    }

    if (file_exists(get_stylesheet_directory() . '/assets/css/bootstrap.min.css')) {
        wp_enqueue_style(
            'gatekeeper-titan-bootstrap',
            get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css',
            ['gatekeeper-titan-satoshi'],
            filemtime(get_stylesheet_directory() . '/assets/css/bootstrap.min.css')
        );
    }

    // Main CSS needed for header-gatekeeper.php
    if (file_exists(get_stylesheet_directory() . '/assets/css/main.css')) {
        wp_enqueue_style(
            'gatekeeper-titan-main',
            get_stylesheet_directory_uri() . '/assets/css/main.css',
            ['gatekeeper-titan-bootstrap'],
            filemtime(get_stylesheet_directory() . '/assets/css/main.css')
        );
    }

    // Magnific Popup CSS for image lightbox
    if (file_exists(get_stylesheet_directory() . '/assets/css/magnific-popup.css')) {
        wp_enqueue_style(
            'gatekeeper-titan-magnific',
            get_stylesheet_directory_uri() . '/assets/css/magnific-popup.css',
            ['gatekeeper-titan-main'],
            filemtime(get_stylesheet_directory() . '/assets/css/magnific-popup.css')
        );
    }

    // Swiper CSS for testimonials slider
    if (file_exists(get_stylesheet_directory() . '/assets/css/swiper-bundle.min.css')) {
        wp_enqueue_style(
            'gatekeeper-titan-swiper',
            get_stylesheet_directory_uri() . '/assets/css/swiper-bundle.min.css',
            ['gatekeeper-titan-main'],
            filemtime(get_stylesheet_directory() . '/assets/css/swiper-bundle.min.css')
        );
    }

    // Titan-specific CSS (loads last to override)
    wp_enqueue_style(
        'gatekeeper-titan-css',
        get_stylesheet_directory_uri() . '/assets/css/gatekeeper-titan.css',
        ['gatekeeper-titan-main'],
        filemtime(get_stylesheet_directory() . '/assets/css/gatekeeper-titan.css')
    );

    // JS files for header functionality
    wp_enqueue_script(
        'gatekeeper-titan-jquery',
        get_stylesheet_directory_uri() . '/assets/js/jquery-3.7.1.min.js',
        [],
        filemtime(get_stylesheet_directory() . '/assets/js/jquery-3.7.1.min.js'),
        false
    );

    wp_enqueue_script(
        'gatekeeper-titan-phosphor',
        get_stylesheet_directory_uri() . '/assets/js/phosphor-icon.js',
        [],
        filemtime(get_stylesheet_directory() . '/assets/js/phosphor-icon.js'),
        false
    );

    wp_enqueue_script(
        'gatekeeper-titan-bootstrap-js',
        get_stylesheet_directory_uri() . '/assets/js/boostrap.bundle.min.js',
        ['gatekeeper-titan-jquery'],
        filemtime(get_stylesheet_directory() . '/assets/js/boostrap.bundle.min.js'),
        true
    );

    // Main JS for header interactions
    wp_enqueue_script(
        'gatekeeper-titan-main-js',
        get_stylesheet_directory_uri() . '/assets/js/main.js',
        ['gatekeeper-titan-jquery', 'gatekeeper-titan-bootstrap-js'],
        filemtime(get_stylesheet_directory() . '/assets/js/main.js'),
        true
    );

    // Magnific Popup JS for image lightbox
    if (file_exists(get_stylesheet_directory() . '/assets/js/magnific-popup.min.js')) {
        wp_enqueue_script(
            'gatekeeper-titan-magnific-js',
            get_stylesheet_directory_uri() . '/assets/js/magnific-popup.min.js',
            ['gatekeeper-titan-jquery'],
            filemtime(get_stylesheet_directory() . '/assets/js/magnific-popup.min.js'),
            true
        );
    }

    // Swiper JS for testimonials slider
    if (file_exists(get_stylesheet_directory() . '/assets/js/swiper-bundle.min.js')) {
        wp_enqueue_script(
            'gatekeeper-titan-swiper-js',
            get_stylesheet_directory_uri() . '/assets/js/swiper-bundle.min.js',
            [],
            filemtime(get_stylesheet_directory() . '/assets/js/swiper-bundle.min.js'),
            true
        );
    }

    // Titan-specific JS
    wp_enqueue_script(
        'gatekeeper-titan-js',
        get_stylesheet_directory_uri() . '/assets/js/gatekeeper-titan.js',
        ['gatekeeper-titan-main-js', 'gatekeeper-titan-magnific-js', 'gatekeeper-titan-swiper-js'],
        filemtime(get_stylesheet_directory() . '/assets/js/gatekeeper-titan.js'),
        true
    );
});

// Enqueue CSS i JS za Gatekeeper template
add_action('wp_enqueue_scripts', function() {
    // Proveri da li je Gatekeeper template - pojednostavljena provera
    $is_gatekeeper = false;
    
    // Provera na više načina
    if (is_page_template('gatekeepeer.php')) {
        $is_gatekeeper = true;
    } elseif (get_page_template_slug() === 'gatekeepeer.php') {
        $is_gatekeeper = true;
    } elseif (is_page()) {
        $template = get_post_meta(get_the_ID(), '_wp_page_template', true);
        if ($template === 'gatekeepeer.php') {
            $is_gatekeeper = true;
        }
    }
    
    if ($is_gatekeeper) {
        
        // CSS fajlovi za Gatekeeper - redosled je važan!
        wp_enqueue_style(
            'gatekeeper-satoshi',
            get_stylesheet_directory_uri() . '/assets/css/satoshi.css',
            [],
            filemtime(get_stylesheet_directory() . '/assets/css/satoshi.css')
        );
        wp_enqueue_style(
            'gatekeeper-bootstrap',
            get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css',
            ['gatekeeper-satoshi'],
            filemtime(get_stylesheet_directory() . '/assets/css/bootstrap.min.css')
        );
        wp_enqueue_style(
            'gatekeeper-aos',
            get_stylesheet_directory_uri() . '/assets/css/aos.css',
            ['gatekeeper-bootstrap'],
            filemtime(get_stylesheet_directory() . '/assets/css/aos.css')
        );
        wp_enqueue_style(
            'gatekeeper-swiper',
            get_stylesheet_directory_uri() . '/assets/css/swiper-bundle.min.css',
            ['gatekeeper-bootstrap'],
            filemtime(get_stylesheet_directory() . '/assets/css/swiper-bundle.min.css')
        );
        wp_enqueue_style(
            'gatekeeper-magnific',
            get_stylesheet_directory_uri() . '/assets/css/magnific-popup.css',
            ['gatekeeper-bootstrap'],
            filemtime(get_stylesheet_directory() . '/assets/css/magnific-popup.css')
        );
        wp_enqueue_style(
            'gatekeeper-main-css',
            get_stylesheet_directory_uri() . '/assets/css/main.css',
            ['gatekeeper-bootstrap', 'gatekeeper-satoshi', 'gatekeeper-aos', 'gatekeeper-swiper', 'gatekeeper-magnific'],
            filemtime(get_stylesheet_directory() . '/assets/css/main.css'),
            'all'
        );
        
        // Dodaj footer CSS ako postoji
        if (file_exists(get_stylesheet_directory() . '/assets/css/footer.css')) {
            wp_enqueue_style(
                'gatekeeper-footer-css',
                get_stylesheet_directory_uri() . '/assets/css/footer.css',
                ['gatekeeper-main-css'],
                filemtime(get_stylesheet_directory() . '/assets/css/footer.css')
            );
        }
        
        // JS fajlovi za Gatekeeper - redosled je važan!
        // Deregister WordPress jQuery i koristi custom
        wp_deregister_script('jquery');
        wp_enqueue_script(
            'gatekeeper-jquery',
            get_stylesheet_directory_uri() . '/assets/js/jquery-3.7.1.min.js',
            [],
            filemtime(get_stylesheet_directory() . '/assets/js/jquery-3.7.1.min.js'),
            false
        );
        wp_enqueue_script(
            'gatekeeper-phosphor',
            get_stylesheet_directory_uri() . '/assets/js/phosphor-icon.js',
            [],
            filemtime(get_stylesheet_directory() . '/assets/js/phosphor-icon.js'),
            false
        );
        wp_enqueue_script(
            'gatekeeper-bootstrap-js',
            get_stylesheet_directory_uri() . '/assets/js/boostrap.bundle.min.js',
            ['jquery', 'gatekeeper-jquery'],
            filemtime(get_stylesheet_directory() . '/assets/js/boostrap.bundle.min.js'),
            true
        );
        wp_enqueue_script(
            'gatekeeper-gsap',
            get_stylesheet_directory_uri() . '/assets/js/gsap.min.js',
            [],
            filemtime(get_stylesheet_directory() . '/assets/js/gsap.min.js'),
            false
        );
        wp_enqueue_script(
            'gatekeeper-scrolltrigger',
            get_stylesheet_directory_uri() . '/assets/js/ScrollTrigger.min.js',
            ['gatekeeper-gsap'],
            filemtime(get_stylesheet_directory() . '/assets/js/ScrollTrigger.min.js'),
            false
        );
        wp_enqueue_script(
            'gatekeeper-scrollsmoother',
            get_stylesheet_directory_uri() . '/assets/js/ScrollSmoother.min.js',
            ['gatekeeper-gsap'],
            filemtime(get_stylesheet_directory() . '/assets/js/ScrollSmoother.min.js'),
            false
        );
        wp_enqueue_script(
            'gatekeeper-splittext',
            get_stylesheet_directory_uri() . '/assets/js/SplitText.min.js',
            ['gatekeeper-gsap'],
            filemtime(get_stylesheet_directory() . '/assets/js/SplitText.min.js'),
            false
        );
        wp_enqueue_script(
            'gatekeeper-custom-gsap',
            get_stylesheet_directory_uri() . '/assets/js/custom-gsap.js',
            ['gatekeeper-gsap', 'gatekeeper-scrolltrigger', 'gatekeeper-scrollsmoother', 'gatekeeper-splittext'],
            filemtime(get_stylesheet_directory() . '/assets/js/custom-gsap.js'),
            true
        );
        wp_enqueue_script(
            'gatekeeper-aos',
            get_stylesheet_directory_uri() . '/assets/js/aos.js',
            [],
            filemtime(get_stylesheet_directory() . '/assets/js/aos.js'),
            true
        );
        wp_enqueue_script(
            'gatekeeper-counterup',
            get_stylesheet_directory_uri() . '/assets/js/counterup.min.js',
            ['jquery', 'gatekeeper-jquery'],
            filemtime(get_stylesheet_directory() . '/assets/js/counterup.min.js'),
            true
        );
        wp_enqueue_script(
            'gatekeeper-swiper',
            get_stylesheet_directory_uri() . '/assets/js/swiper-bundle.min.js',
            [],
            filemtime(get_stylesheet_directory() . '/assets/js/swiper-bundle.min.js'),
            true
        );
        wp_enqueue_script(
            'gatekeeper-marquee',
            get_stylesheet_directory_uri() . '/assets/js/jquery.marquee.min.js',
            ['jquery', 'gatekeeper-jquery'],
            filemtime(get_stylesheet_directory() . '/assets/js/jquery.marquee.min.js'),
            true
        );
        wp_enqueue_script(
            'gatekeeper-magnific',
            get_stylesheet_directory_uri() . '/assets/js/magnific-popup.min.js',
            ['jquery', 'gatekeeper-jquery'],
            filemtime(get_stylesheet_directory() . '/assets/js/magnific-popup.min.js'),
            true
        );
        wp_enqueue_script(
            'gatekeeper-main-js',
            get_stylesheet_directory_uri() . '/assets/js/main.js',
            ['jquery', 'gatekeeper-jquery', 'gatekeeper-bootstrap-js', 'gatekeeper-gsap', 'gatekeeper-custom-gsap', 'gatekeeper-aos', 'gatekeeper-swiper'],
            filemtime(get_stylesheet_directory() . '/assets/js/main.js'),
            true
        );
    }
});
