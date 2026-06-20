<?php
/**
 * AI Integration & Google Smart Features
 *
 * Structured data for Google AI Overviews, Speakable content,
 * FAQ schema, HowTo schema, and NLP-optimized markup.
 *
 * @package starter-ai
 * @since 1.0.0
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Add Speakable schema for Google Assistant and voice search.
 */
function starter_ai_speakable_schema(): void
{
    if (! is_singular()) {
        return;
    }

    $post = get_queried_object();
    if (! $post instanceof WP_Post) {
        return;
    }

    $schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'WebPage',
        'name'     => get_the_title($post),
        'url'      => get_permalink($post),
        'speakable' => [
            '@type'       => 'SpeakableSpecification',
            'cssSelector' => [
                '.entry-title',
                '.entry-content p:first-of-type',
                '.entry-content h2',
            ],
        ],
    ];

    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo "\n</script>\n";
}
add_action('wp_head', 'starter_ai_speakable_schema', 15);

/**
 * Auto-detect FAQ blocks and generate FAQPage schema.
 */
function starter_ai_faq_schema_from_content(string $content): string
{
    if (! is_singular()) {
        return $content;
    }

    // Detect FAQ patterns: <h3>Question?</h3> followed by <p>Answer</p>
    $faq_pattern = '/<h[23][^>]*>\s*(.+?\?)\s*<\/h[23]>\s*<p[^>]*>\s*(.+?)\s*<\/p>/is';

    if (preg_match_all($faq_pattern, $content, $matches, PREG_SET_ORDER) && count($matches) >= 2) {
        $faq_items = [];
        foreach ($matches as $match) {
            $faq_items[] = [
                '@type'          => 'Question',
                'name'           => wp_strip_all_tags($match[1]),
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => wp_strip_all_tags($match[2]),
                ],
            ];
        }

        $schema = [
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => $faq_items,
        ];

        $json_ld = '<script type="application/ld+json">' . "\n";
        $json_ld .= wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $json_ld .= "\n</script>\n";

        $content .= $json_ld;
    }

    return $content;
}
add_filter('the_content', 'starter_ai_faq_schema_from_content', 20);

/**
 * Add NLP-friendly content attributes for AI readability.
 */
function starter_ai_content_nlp_attributes(string $content): string
{
    if (! is_singular()) {
        return $content;
    }

    // Wrap key content sections with semantic attributes
    $content = preg_replace(
        '/<h2([^>]*)>/i',
        '<h2$1 data-ai-section="heading">',
        $content
    );

    $content = preg_replace(
        '/<h3([^>]*)>/i',
        '<h3$1 data-ai-section="subheading">',
        $content
    );

    // Add data attributes to lists for structured extraction
    $content = preg_replace(
        '/<(ul|ol)([^>]*)>/i',
        '<$1$2 data-ai-content="list">',
        $content
    );

    return $content;
}
add_filter('the_content', 'starter_ai_content_nlp_attributes', 15);

/**
 * Add JSON-LD for Google Discover and AI Overviews optimization.
 */
function starter_ai_discover_optimization(): void
{
    if (! is_singular('post')) {
        return;
    }

    $post = get_queried_object();
    if (! $post instanceof WP_Post) {
        return;
    }

    // Ensure high-quality image metadata for Google Discover
    if (has_post_thumbnail($post)) {
        $image_id = get_post_thumbnail_id($post);
        $image_meta = wp_get_attachment_metadata($image_id);

        if ($image_meta && isset($image_meta['width']) && $image_meta['width'] >= 1200) {
            echo '<meta name="robots" content="max-image-preview:large">' . "\n";
        }
    }
}
add_action('wp_head', 'starter_ai_discover_optimization', 3);

/**
 * Add structured data for key entities to help AI understand content.
 */
function starter_ai_entity_markup(string $content): string
{
    if (! is_singular()) {
        return $content;
    }

    // Wrap email addresses with schema markup
    $content = preg_replace(
        '/\b([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})\b/',
        '<a href="mailto:$1" itemprop="email">$1</a>',
        $content
    );

    return $content;
}
add_filter('the_content', 'starter_ai_entity_markup', 25);

/**
 * Output structured data for site navigation (SiteNavigationElement).
 */
function starter_ai_navigation_schema(): void
{
    if (! is_front_page()) {
        return;
    }

    $menu_locations = get_nav_menu_locations();
    if (empty($menu_locations['primary'])) {
        return;
    }

    $menu_items = wp_get_nav_menu_items($menu_locations['primary']);
    if (empty($menu_items)) {
        return;
    }

    $nav_elements = [];
    foreach ($menu_items as $item) {
        if ((int) $item->menu_item_parent === 0) {
            $nav_elements[] = [
                '@type' => 'SiteNavigationElement',
                'name'  => $item->title,
                'url'   => $item->url,
            ];
        }
    }

    if (! empty($nav_elements)) {
        $schema = [
            '@context'        => 'https://schema.org',
            '@type'           => 'ItemList',
            'itemListElement' => $nav_elements,
        ];

        echo '<script type="application/ld+json">' . "\n";
        echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo "\n</script>\n";
    }
}
add_action('wp_head', 'starter_ai_navigation_schema', 12);

/**
 * Add semantic HTML5 attributes for AI crawlers.
 */
function starter_ai_semantic_attributes(): void
{
    echo '<!-- AI & Semantic Web Optimization -->' . "\n";
    echo '<meta name="ai-content-type" content="' . esc_attr(starter_ai_get_content_type()) . '">' . "\n";
}
add_action('wp_head', 'starter_ai_semantic_attributes', 2);

/**
 * Determine content type for AI classification.
 */
function starter_ai_get_content_type(): string
{
    if (is_front_page()) {
        return 'homepage';
    }
    if (is_single()) {
        return 'article';
    }
    if (is_page()) {
        return 'page';
    }
    if (is_category() || is_tag()) {
        return 'taxonomy';
    }
    if (is_archive()) {
        return 'archive';
    }
    if (is_search()) {
        return 'search-results';
    }
    return 'general';
}
