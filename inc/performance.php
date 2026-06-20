<?php
/**
 * Performance Optimization
 *
 * Resource hints, lazy loading, critical CSS, Core Web Vitals,
 * Google Fonts async, CSS/JS optimization.
 *
 * @package starter-ai
 * @since 1.1.0
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Add DNS prefetch for common third-party services.
 */
function starter_ai_dns_prefetch(): void
{
    $domains = [
        '//fonts.googleapis.com',
        '//fonts.gstatic.com',
        '//www.google-analytics.com',
        '//www.googletagmanager.com',
    ];

    foreach ($domains as $domain) {
        echo '<link rel="dns-prefetch" href="' . esc_url($domain) . '">' . "\n";
    }
}
add_action('wp_head', 'starter_ai_dns_prefetch', 0);

/**
 * Add preload / preconnect hints for critical resources.
 */
function starter_ai_preload_resources(): void
{
    // Preconnect to Google Fonts
    echo '<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";

    // Preload main CSS
    echo '<link rel="preload" href="' . esc_url(STARTER_AI_URI . '/assets/css/main.css') . '" as="style">' . "\n";

    // Preload logo
    echo '<link rel="preload" href="' . esc_url(STARTER_AI_URI . '/assets/images/logo-zuhal.svg') . '" as="image" type="image/svg+xml">' . "\n";
}
add_action('wp_head', 'starter_ai_preload_resources', 1);

/**
 * Load Google Fonts asynchronously for non-blocking render.
 */
function starter_ai_async_google_fonts(string $tag, string $handle): string
{
    if ($handle !== 'starter-ai-fonts') {
        return $tag;
    }

    // Make Google Fonts non-render-blocking
    $tag = str_replace(
        "rel='stylesheet'",
        "rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\"",
        $tag
    );

    // Add noscript fallback
    $href = preg_match('/href=[\'"]([^\'"]+)[\'"]/', $tag, $m) ? $m[1] : '';
    if ($href) {
        $tag .= '<noscript><link rel="stylesheet" href="' . esc_url($href) . '"></noscript>' . "\n";
    }

    return $tag;
}
add_filter('style_loader_tag', 'starter_ai_async_google_fonts', 10, 2);

/**
 * Inline critical CSS for above-the-fold content.
 */
function starter_ai_critical_css(): void
{
    ?>
    <style id="zuhal-critical-css">
    /* Critical CSS - Above the fold rendering */
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
    html{scroll-behavior:smooth;-webkit-font-smoothing:antialiased}
    body{font-family:'Inter',system-ui,-apple-system,sans-serif;line-height:1.625;overflow-x:hidden}
    .site-header{position:sticky;top:0;z-index:200;backdrop-filter:blur(12px);background:rgba(255,255,255,.9);border-bottom:1px solid #e2e8f0}
    .container{max-width:1200px;margin:0 auto;padding:0 1rem}
    .header-inner{display:flex;align-items:center;justify-content:space-between;min-height:72px}
    .site-logo img{height:44px;width:auto}
    .zuhal-logo-link{display:inline-flex}
    .zuhal-logo-dark{display:none}
    [data-theme="dark"] .zuhal-logo-light{display:none}
    [data-theme="dark"] .zuhal-logo-dark{display:block}
    .skip-link{position:absolute;top:-100%;z-index:700;background:#2563eb;color:#fff;padding:.5rem 1rem}
    .skip-link:focus{top:0}
    .hero-section{padding:4rem 0 5rem;background:linear-gradient(135deg,#fff,#f8fafc,#f5f3ff)}
    .hero-title{font-size:clamp(2.5rem,1.8rem+3.5vw,3.75rem);font-weight:800;line-height:1.1}
    h1,h2,h3,h4,h5,h6{font-weight:700;line-height:1.25}
    a{color:#2563eb;text-decoration:none}
    img{max-width:100%;height:auto;display:block}
    @media(max-width:1023px){.primary-menu-list{display:none}.menu-toggle{display:flex}}
    .menu-toggle{display:none;align-items:center;border:none;background:none;cursor:pointer}
    </style>
    <?php
}
add_action('wp_head', 'starter_ai_critical_css', 2);

/**
 * Add loading="lazy" and decoding="async" to images.
 */
function starter_ai_lazy_load_images(string $content): string
{
    if (is_admin() || is_feed()) {
        return $content;
    }

    // Add decoding="async" to images that don't have it
    $content = preg_replace(
        '/<img((?!.*decoding)[^>]*)>/i',
        '<img$1 decoding="async">',
        $content
    );

    return $content;
}
add_filter('the_content', 'starter_ai_lazy_load_images', 99);

/**
 * Defer non-critical JavaScript.
 */
function starter_ai_defer_scripts(string $tag, string $handle): string
{
    $no_defer = ['jquery', 'jquery-core', 'comment-reply'];

    if (in_array($handle, $no_defer, true)) {
        return $tag;
    }

    if (is_admin()) {
        return $tag;
    }

    if (str_contains($tag, 'defer') || str_contains($tag, 'async') || str_contains($tag, 'type="module"')) {
        return $tag;
    }

    return str_replace(' src', ' defer src', $tag);
}
add_filter('script_loader_tag', 'starter_ai_defer_scripts', 15, 2);

/**
 * Remove unnecessary WordPress head items for performance.
 */
function starter_ai_cleanup_head(): void
{
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('template_redirect', 'rest_output_link_header', 11);
}
add_action('after_setup_theme', 'starter_ai_cleanup_head');

/**
 * Disable emojis for performance.
 */
function starter_ai_disable_emojis(): void
{
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'starter_ai_disable_emojis');

/**
 * Remove emoji DNS prefetch.
 */
function starter_ai_remove_emoji_dns_prefetch(array $urls, string $relation_type): array
{
    if ($relation_type === 'dns-prefetch') {
        $urls = array_filter($urls, function ($url) {
            if (is_array($url)) {
                return ! str_contains($url['href'] ?? '', 'wp.org');
            }
            return ! str_contains($url, 'wp.org');
        });
    }

    return $urls;
}
add_filter('wp_resource_hints', 'starter_ai_remove_emoji_dns_prefetch', 10, 2);

/**
 * Add fetchpriority to LCP image.
 */
function starter_ai_lcp_image_priority(array $attr, WP_Post $attachment, string $size): array
{
    if (is_singular() && in_the_loop() && $size === 'starter-ai-featured') {
        $attr['fetchpriority'] = 'high';
        $attr['loading'] = 'eager';
    }

    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'starter_ai_lcp_image_priority', 10, 3);

/**
 * Disable jQuery migrate for faster loading.
 */
function starter_ai_remove_jquery_migrate(WP_Scripts $scripts): void
{
    if (is_admin()) {
        return;
    }

    $jquery = $scripts->registered['jquery'] ?? null;
    if ($jquery && ! empty($jquery->deps)) {
        $jquery->deps = array_diff($jquery->deps, ['jquery-migrate']);
    }
}
add_action('wp_default_scripts', 'starter_ai_remove_jquery_migrate');

/**
 * Add content-visibility for below-the-fold sections.
 */
function starter_ai_content_visibility_css(): void
{
    ?>
    <style id="zuhal-content-visibility">
    .categories-section,
    .cta-section,
    .site-footer,
    .related-posts,
    .comments-area {
        content-visibility: auto;
        contain-intrinsic-size: auto 500px;
    }
    </style>
    <?php
}
add_action('wp_head', 'starter_ai_content_visibility_css', 99);

/**
 * Limit post revisions for database performance.
 */
if (! defined('WP_POST_REVISIONS')) {
    define('WP_POST_REVISIONS', 5);
}

/**
 * Optimize WP_Query for speed.
 */
function starter_ai_optimize_queries(WP_Query $query): void
{
    if (is_admin() || ! $query->is_main_query()) {
        return;
    }

    // Disable SQL_CALC_FOUND_ROWS for better performance when pagination is not needed
    if ($query->is_singular()) {
        $query->set('no_found_rows', true);
    }
}
add_action('pre_get_posts', 'starter_ai_optimize_queries');
