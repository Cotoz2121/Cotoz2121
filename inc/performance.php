<?php
/**
 * Performance Optimization
 *
 * Resource hints, lazy loading, critical CSS, Core Web Vitals.
 *
 * @package starter-ai
 * @since 1.0.0
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
 * Add preload hints for critical resources.
 */
function starter_ai_preload_resources(): void
{
    // Preload main CSS
    echo '<link rel="preload" href="' . esc_url(STARTER_AI_URI . '/assets/css/main.css') . '" as="style">' . "\n";

    // Preload hero font
    echo '<link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" as="style" crossorigin>' . "\n";
}
add_action('wp_head', 'starter_ai_preload_resources', 1);

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

    if (str_contains($tag, 'defer') || str_contains($tag, 'async')) {
        return $tag;
    }

    return str_replace(' src', ' defer src', $tag);
}
add_filter('script_loader_tag', 'starter_ai_defer_scripts', 10, 2);

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
 * Limit post revisions for database performance.
 */
if (! defined('WP_POST_REVISIONS')) {
    define('WP_POST_REVISIONS', 5);
}
