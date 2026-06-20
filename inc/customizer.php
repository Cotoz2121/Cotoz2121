<?php
/**
 * Theme Customizer Settings
 *
 * @package starter-ai
 * @since 1.0.0
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Register customizer settings and controls.
 */
function starter_ai_customize_register(WP_Customize_Manager $wp_customize): void
{
    // Enable selective refresh for site title and description
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', [
            'selector'        => '.site-title a',
            'render_callback' => fn () => bloginfo('name'),
        ]);
        $wp_customize->selective_refresh->add_partial('blogdescription', [
            'selector'        => '.site-description',
            'render_callback' => fn () => bloginfo('description'),
        ]);
    }

    // =====================================================
    // Hero Section
    // =====================================================
    $wp_customize->add_section('starter_ai_hero', [
        'title'    => esc_html__('Hero Section', 'starter-ai'),
        'priority' => 30,
    ]);

    // Hero Section Toggle
    $wp_customize->add_setting('starter_ai_hero_enabled', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('starter_ai_hero_enabled', [
        'label'   => esc_html__('Enable Hero Section', 'starter-ai'),
        'section' => 'starter_ai_hero',
        'type'    => 'checkbox',
    ]);

    $hero_settings = [
        'starter_ai_hero_title' => [
            'label'   => esc_html__('Hero Title', 'starter-ai'),
            'default' => 'زحل - Zuhal',
            'type'    => 'text',
        ],
        'starter_ai_hero_subtitle' => [
            'label'   => esc_html__('Hero Subtitle', 'starter-ai'),
            'default' => 'منصتك المتطورة للمحتوى الذكي - Your Smart Content Platform',
            'type'    => 'textarea',
        ],
        'starter_ai_cta_text' => [
            'label'   => esc_html__('CTA Button Text', 'starter-ai'),
            'default' => esc_html__('Get Started', 'starter-ai'),
            'type'    => 'text',
        ],
        'starter_ai_cta_url' => [
            'label'   => esc_html__('CTA Button URL', 'starter-ai'),
            'default' => '#featured-posts',
            'type'    => 'url',
        ],
        'starter_ai_cta2_text' => [
            'label'   => esc_html__('Secondary CTA Text', 'starter-ai'),
            'default' => esc_html__('Learn More', 'starter-ai'),
            'type'    => 'text',
        ],
        'starter_ai_cta2_url' => [
            'label'   => esc_html__('Secondary CTA URL', 'starter-ai'),
            'default' => '#about',
            'type'    => 'url',
        ],
    ];

    foreach ($hero_settings as $id => $config) {
        $wp_customize->add_setting($id, [
            'default'           => $config['default'],
            'sanitize_callback' => $config['type'] === 'url' ? 'esc_url_raw' : 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);

        $control_class = match ($config['type']) {
            'textarea' => WP_Customize_Control::class,
            'url'      => WP_Customize_Control::class,
            default    => WP_Customize_Control::class,
        };

        $control_args = [
            'label'   => $config['label'],
            'section' => 'starter_ai_hero',
            'type'    => $config['type'],
        ];

        $wp_customize->add_control($id, $control_args);
    }

    // =====================================================
    // Color Settings
    // =====================================================
    $wp_customize->add_section('starter_ai_colors', [
        'title'    => esc_html__('Theme Colors', 'starter-ai'),
        'priority' => 35,
    ]);

    $color_settings = [
        'starter_ai_primary_color' => [
            'label'   => esc_html__('Primary Color', 'starter-ai'),
            'default' => '#2563eb',
        ],
        'starter_ai_secondary_color' => [
            'label'   => esc_html__('Secondary Color', 'starter-ai'),
            'default' => '#7c3aed',
        ],
        'starter_ai_accent_color' => [
            'label'   => esc_html__('Accent Color', 'starter-ai'),
            'default' => '#06b6d4',
        ],
    ];

    foreach ($color_settings as $id => $config) {
        $wp_customize->add_setting($id, [
            'default'           => $config['default'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ]);

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $id, [
            'label'   => $config['label'],
            'section' => 'starter_ai_colors',
        ]));
    }

    // =====================================================
    // Social Media Links
    // =====================================================
    $wp_customize->add_section('starter_ai_social', [
        'title'       => esc_html__('Social Media', 'starter-ai'),
        'priority'    => 40,
    ]);

    $social_platforms = [
        'facebook'  => 'Facebook',
        'twitter'   => 'Twitter / X',
        'instagram' => 'Instagram',
        'linkedin'  => 'LinkedIn',
        'youtube'   => 'YouTube',
        'github'    => 'GitHub',
        'tiktok'    => 'TikTok',
    ];

    foreach ($social_platforms as $key => $label) {
        $setting_id = "starter_ai_social_{$key}";

        $wp_customize->add_setting($setting_id, [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);

        $wp_customize->add_control($setting_id, [
            'label'   => $label . ' URL',
            'section' => 'starter_ai_social',
            'type'    => 'url',
        ]);
    }

    // Twitter handle
    $wp_customize->add_setting('starter_ai_twitter_handle', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('starter_ai_twitter_handle', [
        'label'       => esc_html__('Twitter Handle (for Twitter Cards)', 'starter-ai'),
        'description' => esc_html__('Without @ symbol', 'starter-ai'),
        'section'     => 'starter_ai_social',
        'type'        => 'text',
    ]);

    // =====================================================
    // SEO Settings
    // =====================================================
    $wp_customize->add_section('starter_ai_seo', [
        'title'    => esc_html__('SEO Settings', 'starter-ai'),
        'priority' => 45,
    ]);

    // Google Analytics / Tag Manager
    $wp_customize->add_setting('starter_ai_gtag_id', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('starter_ai_gtag_id', [
        'label'       => esc_html__('Google Analytics ID', 'starter-ai'),
        'description' => esc_html__('e.g., G-XXXXXXXXXX or GTM-XXXXXXX', 'starter-ai'),
        'section'     => 'starter_ai_seo',
        'type'        => 'text',
    ]);

    // Google Site Verification
    $wp_customize->add_setting('starter_ai_google_verification', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('starter_ai_google_verification', [
        'label'       => esc_html__('Google Site Verification', 'starter-ai'),
        'description' => esc_html__('Content value from the verification meta tag', 'starter-ai'),
        'section'     => 'starter_ai_seo',
        'type'        => 'text',
    ]);

    // =====================================================
    // Newsletter Section
    // =====================================================
    $wp_customize->add_section('starter_ai_newsletter', [
        'title'    => esc_html__('Newsletter Section', 'starter-ai'),
        'priority' => 50,
    ]);

    $newsletter_settings = [
        'starter_ai_newsletter_title' => [
            'label'   => esc_html__('Newsletter Title', 'starter-ai'),
            'default' => esc_html__('Stay Connected', 'starter-ai'),
        ],
        'starter_ai_newsletter_text' => [
            'label'   => esc_html__('Newsletter Description', 'starter-ai'),
            'default' => esc_html__('Subscribe to our newsletter and never miss an update.', 'starter-ai'),
        ],
        'starter_ai_newsletter_url' => [
            'label'   => esc_html__('Newsletter Subscribe URL', 'starter-ai'),
            'default' => '',
        ],
    ];

    foreach ($newsletter_settings as $id => $config) {
        $sanitize = str_contains($id, 'url') ? 'esc_url_raw' : 'sanitize_text_field';

        $wp_customize->add_setting($id, [
            'default'           => $config['default'],
            'sanitize_callback' => $sanitize,
        ]);

        $wp_customize->add_control($id, [
            'label'   => $config['label'],
            'section' => 'starter_ai_newsletter',
            'type'    => str_contains($id, 'url') ? 'url' : 'text',
        ]);
    }

    // =====================================================
    // Contact Information
    // =====================================================
    $wp_customize->add_section('starter_ai_contact', [
        'title'    => esc_html__('Contact Information', 'starter-ai'),
        'priority' => 55,
    ]);

    $contact_fields = [
        'starter_ai_contact_email' => [
            'label' => esc_html__('Contact Email', 'starter-ai'),
            'type'  => 'email',
        ],
        'starter_ai_contact_phone' => [
            'label' => esc_html__('Phone Number', 'starter-ai'),
            'type'  => 'text',
        ],
        'starter_ai_contact_address' => [
            'label' => esc_html__('Address', 'starter-ai'),
            'type'  => 'textarea',
        ],
    ];

    foreach ($contact_fields as $id => $config) {
        $wp_customize->add_setting($id, [
            'default'           => '',
            'sanitize_callback' => $config['type'] === 'email' ? 'sanitize_email' : 'sanitize_text_field',
        ]);

        $wp_customize->add_control($id, [
            'label'   => $config['label'],
            'section' => 'starter_ai_contact',
            'type'    => $config['type'],
        ]);
    }
}
add_action('customize_register', 'starter_ai_customize_register');

/**
 * Output custom CSS from customizer settings.
 */
function starter_ai_customizer_css(): void
{
    $primary   = get_theme_mod('starter_ai_primary_color', '#2563eb');
    $secondary = get_theme_mod('starter_ai_secondary_color', '#7c3aed');
    $accent    = get_theme_mod('starter_ai_accent_color', '#06b6d4');

    $css = ":root {
        --color-primary: {$primary};
        --color-secondary: {$secondary};
        --color-accent: {$accent};
    }";

    wp_add_inline_style('starter-ai-style', $css);
}
add_action('wp_enqueue_scripts', 'starter_ai_customizer_css', 20);

/**
 * Output Google Analytics / Tag Manager script.
 */
function starter_ai_google_analytics(): void
{
    $gtag_id = get_theme_mod('starter_ai_gtag_id', '');
    if (empty($gtag_id)) {
        return;
    }

    if (str_starts_with($gtag_id, 'GTM-')) {
        // Google Tag Manager
        echo "<!-- Google Tag Manager -->\n";
        echo "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':";
        echo "new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],";
        echo "j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=";
        echo "'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);";
        echo "})(window,document,'script','dataLayer','" . esc_js($gtag_id) . "');</script>\n";
    } else {
        // Google Analytics 4
        echo '<script async src="https://www.googletagmanager.com/gtag/js?id=' . esc_attr($gtag_id) . '"></script>' . "\n";
        echo "<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}";
        echo "gtag('js',new Date());gtag('config','" . esc_js($gtag_id) . "');</script>\n";
    }
}
add_action('wp_head', 'starter_ai_google_analytics', 0);

/**
 * Output Google Site Verification meta tag.
 */
function starter_ai_google_verification(): void
{
    $verification = get_theme_mod('starter_ai_google_verification', '');
    if ($verification) {
        echo '<meta name="google-site-verification" content="' . esc_attr($verification) . '">' . "\n";
    }
}
add_action('wp_head', 'starter_ai_google_verification', 0);

/**
 * Customizer preview JavaScript.
 */
function starter_ai_customize_preview_js(): void
{
    wp_enqueue_script(
        'starter-ai-customizer-preview',
        STARTER_AI_URI . '/assets/js/customizer-preview.js',
        ['customize-preview'],
        STARTER_AI_VERSION,
        true
    );
}
add_action('customize_preview_init', 'starter_ai_customize_preview_js');
