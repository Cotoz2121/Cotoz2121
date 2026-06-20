<?php
/**
 * starter AI Theme - Functions and Definitions
 *
 * @package starter-ai
 * @since 1.0.0
 * @requires PHP 8.2
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

/** Theme version */
define('STARTER_AI_VERSION', '1.1.0');

/** Theme directory path */
define('STARTER_AI_DIR', get_template_directory());

/** Theme directory URI */
define('STARTER_AI_URI', get_template_directory_uri());

/**
 * Theme setup - registers support for WordPress features.
 */
function starter_ai_setup(): void
{
    load_theme_textdomain('starter-ai', STARTER_AI_DIR . '/languages');

    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
        'navigation-widgets',
    ]);
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 250,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('custom-background', [
        'default-color' => 'ffffff',
    ]);
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');

    add_image_size('starter-ai-featured', 1200, 630, true);
    add_image_size('starter-ai-card', 600, 400, true);
    add_image_size('starter-ai-thumbnail', 150, 150, true);

    register_nav_menus([
        'primary'  => esc_html__('Primary Menu', 'starter-ai'),
        'footer'   => esc_html__('Footer Menu', 'starter-ai'),
        'mobile'   => esc_html__('Mobile Menu', 'starter-ai'),
        'social'   => esc_html__('Social Links', 'starter-ai'),
    ]);

    add_theme_support('custom-header', [
        'default-image' => '',
        'width'         => 1920,
        'height'        => 600,
        'flex-width'    => true,
        'flex-height'   => true,
        'header-text'   => true,
    ]);
}
add_action('after_setup_theme', 'starter_ai_setup');

/**
 * Set content width for embeds.
 */
function starter_ai_content_width(): void
{
    $GLOBALS['content_width'] = apply_filters('starter_ai_content_width', 1200);
}
add_action('after_setup_theme', 'starter_ai_content_width', 0);

/**
 * Register widget areas.
 */
function starter_ai_widgets_init(): void
{
    $widget_areas = [
        'sidebar-1'  => esc_html__('Primary Sidebar', 'starter-ai'),
        'footer-1'   => esc_html__('Footer Column 1', 'starter-ai'),
        'footer-2'   => esc_html__('Footer Column 2', 'starter-ai'),
        'footer-3'   => esc_html__('Footer Column 3', 'starter-ai'),
        'footer-4'   => esc_html__('Footer Column 4', 'starter-ai'),
    ];

    foreach ($widget_areas as $id => $name) {
        register_sidebar([
            'name'          => $name,
            'id'            => $id,
            'description'   => sprintf(
                /* translators: %s: widget area name */
                esc_html__('Add widgets here for %s.', 'starter-ai'),
                $name
            ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ]);
    }
}
add_action('widgets_init', 'starter_ai_widgets_init');

/**
 * Enqueue styles and scripts.
 */
function starter_ai_scripts(): void
{
    // Google Fonts - Async loading for speed
    wp_enqueue_style(
        'starter-ai-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Noto+Sans+Arabic:wght@400;600;700&display=swap',
        [],
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'starter-ai-main',
        STARTER_AI_URI . '/assets/css/main.css',
        [],
        STARTER_AI_VERSION
    );

    // Combined component styles (loaded conditionally for speed)
    $critical_components = ['header', 'navigation', 'forms'];
    foreach ($critical_components as $component) {
        wp_enqueue_style(
            "starter-ai-{$component}",
            STARTER_AI_URI . "/assets/css/components/{$component}.css",
            ['starter-ai-main'],
            STARTER_AI_VERSION
        );
    }

    // Non-critical components loaded conditionally
    if (is_front_page()) {
        wp_enqueue_style('starter-ai-hero', STARTER_AI_URI . '/assets/css/components/hero.css', ['starter-ai-main'], STARTER_AI_VERSION);
    }
    wp_enqueue_style('starter-ai-footer', STARTER_AI_URI . '/assets/css/components/footer.css', ['starter-ai-main'], STARTER_AI_VERSION);
    wp_enqueue_style('starter-ai-cards', STARTER_AI_URI . '/assets/css/components/cards.css', ['starter-ai-main'], STARTER_AI_VERSION);

    // Responsive stylesheet
    wp_enqueue_style(
        'starter-ai-responsive',
        STARTER_AI_URI . '/assets/css/responsive.css',
        ['starter-ai-main'],
        STARTER_AI_VERSION
    );

    // RTL support
    if (is_rtl()) {
        wp_enqueue_style(
            'starter-ai-rtl',
            STARTER_AI_URI . '/assets/css/rtl.css',
            ['starter-ai-main'],
            STARTER_AI_VERSION
        );
    }

    // Theme stylesheet
    wp_enqueue_style(
        'starter-ai-style',
        get_stylesheet_uri(),
        ['starter-ai-main'],
        STARTER_AI_VERSION
    );

    // Main JavaScript (ES module)
    wp_enqueue_script(
        'starter-ai-app',
        STARTER_AI_URI . '/assets/js/app.js',
        [],
        STARTER_AI_VERSION,
        ['in_footer' => true, 'strategy' => 'defer']
    );



    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Localize script data
    wp_localize_script('starter-ai-app', 'starterAiData', [
        'ajaxUrl'   => admin_url('admin-ajax.php'),
        'nonce'     => wp_create_nonce('starter_ai_nonce'),
        'siteUrl'   => home_url('/'),
        'restUrl'   => rest_url(),
        'themeUrl'  => STARTER_AI_URI,
        'isRtl'     => is_rtl(),
        'i18n'      => [
            'searchPlaceholder' => esc_html__('Search...', 'starter-ai'),
            'menuToggle'        => esc_html__('Menu', 'starter-ai'),
            'darkMode'          => esc_html__('Dark Mode', 'starter-ai'),
            'lightMode'         => esc_html__('Light Mode', 'starter-ai'),
            'loading'           => esc_html__('Loading...', 'starter-ai'),
            'noResults'         => esc_html__('No results found.', 'starter-ai'),
            'readMore'          => esc_html__('Read More', 'starter-ai'),
            'backToTop'         => esc_html__('Back to Top', 'starter-ai'),
        ],
    ]);
}
add_action('wp_enqueue_scripts', 'starter_ai_scripts');

/**
 * Add module type to specific scripts for ES module support.
 */
function starter_ai_script_type_attribute(string $tag, string $handle): string
{
    $module_scripts = [
        'starter-ai-app',
        'starter-ai-navigation',
    ];

    if (in_array($handle, $module_scripts, true)) {
        $tag = str_replace(' src', ' type="module" src', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'starter_ai_script_type_attribute', 10, 2);

/**
 * Add preconnect for external resources.
 */
function starter_ai_resource_hints(array $urls, string $relation_type): array
{
    if ($relation_type === 'preconnect') {
        $urls[] = [
            'href' => 'https://fonts.googleapis.com',
            'crossorigin' => '',
        ];
        $urls[] = [
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        ];
    }

    return $urls;
}
add_filter('wp_resource_hints', 'starter_ai_resource_hints', 10, 2);

/**
 * Add custom classes to the body tag.
 */
function starter_ai_body_classes(array $classes): array
{
    if (! is_singular()) {
        $classes[] = 'hfeed';
    }

    if (is_singular() && ! is_front_page()) {
        $classes[] = 'has-sidebar';
    }

    $classes[] = 'starter-ai-theme';

    return $classes;
}
add_filter('body_class', 'starter_ai_body_classes');

/**
 * Excerpt length customization.
 */
function starter_ai_excerpt_length(int $length): int
{
    return 25;
}
add_filter('excerpt_length', 'starter_ai_excerpt_length');

/**
 * Excerpt more link.
 */
function starter_ai_excerpt_more(string $more): string
{
    return '&hellip;';
}
add_filter('excerpt_more', 'starter_ai_excerpt_more');

/**
 * Estimate reading time for a post.
 */
function starter_ai_reading_time(int $post_id = 0): int
{
    $post_id = $post_id ?: get_the_ID();
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(wp_strip_all_tags($content));
    return max(1, (int) ceil($word_count / 250));
}

/**
 * Get social sharing URLs.
 */
function starter_ai_share_urls(int $post_id = 0): array
{
    $post_id = $post_id ?: get_the_ID();
    $url = urlencode(get_permalink($post_id));
    $title = urlencode(get_the_title($post_id));

    return [
        'twitter'   => "https://twitter.com/intent/tweet?url={$url}&text={$title}",
        'facebook'  => "https://www.facebook.com/sharer/sharer.php?u={$url}",
        'linkedin'  => "https://www.linkedin.com/shareArticle?mini=true&url={$url}&title={$title}",
        'whatsapp'  => "https://wa.me/?text={$title}%20{$url}",
        'telegram'  => "https://t.me/share/url?url={$url}&text={$title}",
    ];
}

/**
 * Breadcrumb generation.
 */
function starter_ai_breadcrumbs(): void
{
    if (is_front_page()) {
        return;
    }

    $separator = '<span class="breadcrumb-separator" aria-hidden="true">/</span>';
    $home_text = esc_html__('Home', 'starter-ai');

    echo '<nav class="breadcrumbs" aria-label="' . esc_attr__('Breadcrumb', 'starter-ai') . '">';
    echo '<ol class="breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">';

    // Home
    echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
    echo '<a href="' . esc_url(home_url('/')) . '" itemprop="item"><span itemprop="name">' . $home_text . '</span></a>';
    echo '<meta itemprop="position" content="1">';
    echo '</li>';

    $position = 2;

    if (is_category() || is_single()) {
        $categories = get_the_category();
        if (! empty($categories)) {
            $cat = $categories[0];
            echo $separator;
            echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<a href="' . esc_url(get_category_link($cat->term_id)) . '" itemprop="item"><span itemprop="name">' . esc_html($cat->name) . '</span></a>';
            echo '<meta itemprop="position" content="' . $position . '">';
            echo '</li>';
            $position++;
        }
    }

    if (is_single() || is_page()) {
        echo $separator;
        echo '<li class="breadcrumb-item breadcrumb-current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html(get_the_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '">';
        echo '</li>';
    } elseif (is_category()) {
        echo $separator;
        echo '<li class="breadcrumb-item breadcrumb-current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html(single_cat_title('', false)) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '">';
        echo '</li>';
    } elseif (is_search()) {
        echo $separator;
        echo '<li class="breadcrumb-item breadcrumb-current">';
        /* translators: %s: search query */
        echo '<span aria-current="page">' . sprintf(esc_html__('Search: %s', 'starter-ai'), get_search_query()) . '</span>';
        echo '</li>';
    } elseif (is_tag()) {
        echo $separator;
        echo '<li class="breadcrumb-item breadcrumb-current">';
        echo '<span aria-current="page">' . esc_html(single_tag_title('', false)) . '</span>';
        echo '</li>';
    } elseif (is_archive()) {
        echo $separator;
        echo '<li class="breadcrumb-item breadcrumb-current">';
        echo '<span aria-current="page">' . esc_html(get_the_archive_title()) . '</span>';
        echo '</li>';
    }

    echo '</ol>';
    echo '</nav>';
}

/**
 * Pagination with accessible markup.
 */
function starter_ai_pagination(): void
{
    $args = [
        'prev_text' => '<span aria-hidden="true">&larr;</span> ' . esc_html__('Previous', 'starter-ai'),
        'next_text' => esc_html__('Next', 'starter-ai') . ' <span aria-hidden="true">&rarr;</span>',
        'type'      => 'list',
        'mid_size'  => 2,
    ];

    echo '<nav class="pagination-nav" aria-label="' . esc_attr__('Posts navigation', 'starter-ai') . '">';
    the_posts_pagination($args);
    echo '</nav>';
}

/**
 * Post navigation for single posts.
 */
function starter_ai_post_navigation(): void
{
    the_post_navigation([
        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous Post', 'starter-ai') . '</span><span class="nav-title">%title</span>',
        'next_text' => '<span class="nav-subtitle">' . esc_html__('Next Post', 'starter-ai') . '</span><span class="nav-title">%title</span>',
    ]);
}

// Include theme modules
$theme_includes = [
    '/inc/seo.php',
    '/inc/schema.php',
    '/inc/customizer.php',
    '/inc/ai-features.php',
    '/inc/performance.php',
    '/inc/widgets.php',
];

foreach ($theme_includes as $file) {
    $filepath = STARTER_AI_DIR . $file;
    if (file_exists($filepath)) {
        require_once $filepath;
    }
}
