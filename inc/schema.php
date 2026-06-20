<?php
/**
 * Schema.org JSON-LD Structured Data
 *
 * @package starter-ai
 * @since 1.0.0
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Output schema.org structured data based on current page.
 */
function starter_ai_schema_output(): void
{
    if (is_singular('post')) {
        starter_ai_article_schema();
    } elseif (is_page()) {
        starter_ai_webpage_schema();
    } elseif (is_front_page()) {
        starter_ai_organization_schema();
    } elseif (is_archive()) {
        starter_ai_collection_schema();
    } elseif (is_search()) {
        starter_ai_search_results_schema();
    }
}
add_action('wp_head', 'starter_ai_schema_output', 10);

/**
 * Article schema for single posts.
 */
function starter_ai_article_schema(): void
{
    $post = get_queried_object();
    if (! $post instanceof WP_Post) {
        return;
    }

    $schema = [
        '@context'         => 'https://schema.org',
        '@type'            => 'Article',
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id'   => get_permalink($post),
        ],
        'headline'         => get_the_title($post),
        'description'      => wp_trim_words(wp_strip_all_tags($post->post_content), 30),
        'datePublished'    => get_the_date('c', $post),
        'dateModified'     => get_the_modified_date('c', $post),
        'author'           => [
            '@type' => 'Person',
            'name'  => get_the_author_meta('display_name', (int) $post->post_author),
            'url'   => get_author_posts_url((int) $post->post_author),
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name'  => get_bloginfo('name'),
        ],
        'wordCount' => str_word_count(wp_strip_all_tags($post->post_content)),
    ];

    // Publisher logo
    $custom_logo_id = get_theme_mod('custom_logo');
    if ($custom_logo_id) {
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        if ($logo) {
            $schema['publisher']['logo'] = [
                '@type'  => 'ImageObject',
                'url'    => $logo[0],
                'width'  => $logo[1],
                'height' => $logo[2],
            ];
        }
    }

    // Featured image
    if (has_post_thumbnail($post)) {
        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post), 'starter-ai-featured');
        if ($image) {
            $schema['image'] = [
                '@type'  => 'ImageObject',
                'url'    => $image[0],
                'width'  => $image[1],
                'height' => $image[2],
            ];
        }
    }

    // Categories
    $categories = get_the_category($post->ID);
    if (! empty($categories)) {
        $schema['articleSection'] = $categories[0]->name;
    }

    // Tags as keywords
    $tags = get_the_tags($post->ID);
    if (! empty($tags)) {
        $schema['keywords'] = implode(', ', wp_list_pluck($tags, 'name'));
    }

    // Author bio
    $author_bio = get_the_author_meta('description', (int) $post->post_author);
    if ($author_bio) {
        $schema['author']['description'] = $author_bio;
    }

    // Author social profiles
    $author_url = get_the_author_meta('url', (int) $post->post_author);
    if ($author_url) {
        $schema['author']['sameAs'] = [$author_url];
    }

    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo "\n</script>\n";
}

/**
 * WebPage schema for static pages.
 */
function starter_ai_webpage_schema(): void
{
    $post = get_queried_object();
    if (! $post instanceof WP_Post) {
        return;
    }

    $schema = [
        '@context'      => 'https://schema.org',
        '@type'         => 'WebPage',
        'name'          => get_the_title($post),
        'url'           => get_permalink($post),
        'datePublished' => get_the_date('c', $post),
        'dateModified'  => get_the_modified_date('c', $post),
        'isPartOf'      => [
            '@type' => 'WebSite',
            'name'  => get_bloginfo('name'),
            'url'   => home_url('/'),
        ],
    ];

    $description = $post->post_excerpt ?: wp_trim_words(wp_strip_all_tags($post->post_content), 30);
    if ($description) {
        $schema['description'] = $description;
    }

    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo "\n</script>\n";
}

/**
 * Organization schema for homepage.
 */
function starter_ai_organization_schema(): void
{
    $schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'Organization',
        'name'     => get_bloginfo('name'),
        'url'      => home_url('/'),
    ];

    $description = get_bloginfo('description');
    if ($description) {
        $schema['description'] = $description;
    }

    // Logo
    $custom_logo_id = get_theme_mod('custom_logo');
    if ($custom_logo_id) {
        $logo = wp_get_attachment_image_url($custom_logo_id, 'full');
        if ($logo) {
            $schema['logo'] = $logo;
            $schema['image'] = $logo;
        }
    }

    // Social profiles from customizer
    $social_profiles = [];
    $social_keys = ['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'github'];
    foreach ($social_keys as $key) {
        $url = get_theme_mod("starter_ai_social_{$key}", '');
        if ($url) {
            $social_profiles[] = $url;
        }
    }
    if (! empty($social_profiles)) {
        $schema['sameAs'] = $social_profiles;
    }

    // Contact
    $email = get_theme_mod('starter_ai_contact_email', '');
    if ($email) {
        $schema['email'] = $email;
    }

    $phone = get_theme_mod('starter_ai_contact_phone', '');
    if ($phone) {
        $schema['telephone'] = $phone;
    }

    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo "\n</script>\n";
}

/**
 * CollectionPage schema for archive pages.
 */
function starter_ai_collection_schema(): void
{
    $schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'CollectionPage',
        'name'     => wp_get_document_title(),
        'url'      => home_url(add_query_arg([])),
    ];

    $term = get_queried_object();
    if ($term instanceof WP_Term && ! empty($term->description)) {
        $schema['description'] = sanitize_text_field($term->description);
    }

    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo "\n</script>\n";
}

/**
 * SearchResultsPage schema for search results.
 */
function starter_ai_search_results_schema(): void
{
    $schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'SearchResultsPage',
        'name'     => sprintf(
            /* translators: %s: search query */
            __('Search results for: %s', 'starter-ai'),
            get_search_query()
        ),
        'url' => home_url(add_query_arg([])),
    ];

    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo "\n</script>\n";
}

/**
 * Breadcrumb schema (output with the visual breadcrumbs).
 */
function starter_ai_breadcrumb_schema(): array
{
    $items = [];
    $position = 1;

    $items[] = [
        '@type'    => 'ListItem',
        'position' => $position,
        'name'     => __('Home', 'starter-ai'),
        'item'     => home_url('/'),
    ];

    if (is_singular()) {
        $post = get_queried_object();
        if ($post instanceof WP_Post) {
            $categories = get_the_category($post->ID);
            if (! empty($categories)) {
                $position++;
                $items[] = [
                    '@type'    => 'ListItem',
                    'position' => $position,
                    'name'     => $categories[0]->name,
                    'item'     => get_category_link($categories[0]->term_id),
                ];
            }

            $position++;
            $items[] = [
                '@type'    => 'ListItem',
                'position' => $position,
                'name'     => get_the_title($post),
                'item'     => get_permalink($post),
            ];
        }
    }

    return [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    ];
}
