<?php
/**
 * SEO - Meta Tags, Open Graph, Twitter Cards
 *
 * @package starter-ai
 * @since 1.0.0
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Output SEO meta tags in the head.
 */
function starter_ai_seo_meta_tags(): void
{
    starter_ai_output_meta_description();
    starter_ai_output_robots_meta();
    starter_ai_output_canonical_url();
    starter_ai_output_open_graph();
    starter_ai_output_twitter_cards();
}
add_action('wp_head', 'starter_ai_seo_meta_tags', 1);

/**
 * Meta description tag.
 */
function starter_ai_output_meta_description(): void
{
    $description = starter_ai_get_meta_description();
    if ($description) {
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    }
}

/**
 * Get meta description based on current context.
 */
function starter_ai_get_meta_description(): string
{
    if (is_front_page() || is_home()) {
        $site_description = get_bloginfo('description');
        if ($site_description) {
            return sanitize_text_field($site_description);
        }
        $site_name = get_bloginfo('name');
        return sanitize_text_field($site_name ?: '');
    }

    if (is_singular()) {
        $post = get_queried_object();
        if ($post instanceof WP_Post) {
            $excerpt = $post->post_excerpt ?: wp_trim_words(
                wp_strip_all_tags($post->post_content),
                30,
                '...'
            );
            return sanitize_text_field($excerpt);
        }
    }

    if (is_category() || is_tag() || is_tax()) {
        $term = get_queried_object();
        if ($term instanceof WP_Term && ! empty($term->description)) {
            return sanitize_text_field(wp_trim_words($term->description, 30));
        }
        if ($term instanceof WP_Term) {
            return sanitize_text_field($term->name . ' - ' . get_bloginfo('name'));
        }
    }

    if (is_author()) {
        $author = get_queried_object();
        if ($author instanceof WP_User) {
            $bio = get_the_author_meta('description', $author->ID);
            if ($bio) {
                return sanitize_text_field(wp_trim_words($bio, 30));
            }
        }
    }

    $site_description = get_bloginfo('description');
    return $site_description ? sanitize_text_field($site_description) : sanitize_text_field(get_bloginfo('name'));
}

/**
 * Robots meta tag.
 */
function starter_ai_output_robots_meta(): void
{
    $robots = [];

    if (is_search() || is_404()) {
        $robots[] = 'noindex';
        $robots[] = 'follow';
    }

    if (is_paged()) {
        $robots[] = 'noindex';
        $robots[] = 'follow';
    }

    if (! empty($robots)) {
        echo '<meta name="robots" content="' . esc_attr(implode(', ', $robots)) . '">' . "\n";
    }

    echo '<meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">' . "\n";
}

/**
 * Canonical URL.
 */
function starter_ai_output_canonical_url(): void
{
    $canonical = '';

    if (is_singular()) {
        $canonical = get_permalink();
    } elseif (is_home()) {
        $canonical = get_post_type_archive_link('post') ?: home_url('/');
    } elseif (is_category() || is_tag() || is_tax()) {
        $term = get_queried_object();
        if ($term instanceof WP_Term) {
            $canonical = get_term_link($term);
        }
    } elseif (is_author()) {
        $author = get_queried_object();
        if ($author instanceof WP_User) {
            $canonical = get_author_posts_url($author->ID);
        }
    } elseif (is_front_page()) {
        $canonical = home_url('/');
    }

    if ($canonical && ! is_wp_error($canonical)) {
        echo '<link rel="canonical" href="' . esc_url($canonical) . '">' . "\n";
    }
}

/**
 * Open Graph meta tags.
 */
function starter_ai_output_open_graph(): void
{
    $og = starter_ai_get_open_graph_data();

    echo "\n<!-- Open Graph / Facebook -->\n";
    foreach ($og as $property => $content) {
        if (! empty($content)) {
            echo '<meta property="' . esc_attr($property) . '" content="' . esc_attr($content) . '">' . "\n";
        }
    }
}

/**
 * Build Open Graph data array.
 */
function starter_ai_get_open_graph_data(): array
{
    $og = [
        'og:site_name' => get_bloginfo('name'),
        'og:locale'    => get_locale(),
    ];

    if (is_singular()) {
        $post = get_queried_object();
        if ($post instanceof WP_Post) {
            $og['og:type']        = is_single() ? 'article' : 'website';
            $og['og:title']       = get_the_title($post);
            $og['og:description'] = starter_ai_get_meta_description();
            $og['og:url']         = get_permalink($post);

            if (has_post_thumbnail($post)) {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($post), 'starter-ai-featured');
                if ($image) {
                    $og['og:image']        = $image[0];
                    $og['og:image:width']  = (string) $image[1];
                    $og['og:image:height'] = (string) $image[2];
                    $og['og:image:type']   = get_post_mime_type(get_post_thumbnail_id($post));
                }
            }

            if (is_single()) {
                $og['article:published_time'] = get_the_date('c', $post);
                $og['article:modified_time']  = get_the_modified_date('c', $post);
                $og['article:author']         = get_author_posts_url((int) $post->post_author);

                $categories = get_the_category($post->ID);
                if (! empty($categories)) {
                    $og['article:section'] = $categories[0]->name;
                }

                $tags = get_the_tags($post->ID);
                if (! empty($tags)) {
                    $og['article:tag'] = implode(', ', wp_list_pluck($tags, 'name'));
                }
            }
        }
    } else {
        $og['og:type']        = 'website';
        $og['og:title']       = wp_get_document_title();
        $og['og:description'] = starter_ai_get_meta_description();
        $og['og:url']         = home_url(add_query_arg([]));
    }

    return $og;
}

/**
 * Twitter Card meta tags.
 */
function starter_ai_output_twitter_cards(): void
{
    echo "\n<!-- Twitter Card -->\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";

    $twitter_handle = get_theme_mod('starter_ai_twitter_handle', '');
    if ($twitter_handle) {
        echo '<meta name="twitter:site" content="@' . esc_attr(ltrim($twitter_handle, '@')) . '">' . "\n";
        echo '<meta name="twitter:creator" content="@' . esc_attr(ltrim($twitter_handle, '@')) . '">' . "\n";
    }

    if (is_singular()) {
        $post = get_queried_object();
        if ($post instanceof WP_Post) {
            echo '<meta name="twitter:title" content="' . esc_attr(get_the_title($post)) . '">' . "\n";
            echo '<meta name="twitter:description" content="' . esc_attr(starter_ai_get_meta_description()) . '">' . "\n";

            if (has_post_thumbnail($post)) {
                $image = wp_get_attachment_image_url(get_post_thumbnail_id($post), 'starter-ai-featured');
                if ($image) {
                    echo '<meta name="twitter:image" content="' . esc_url($image) . '">' . "\n";
                    echo '<meta name="twitter:image:alt" content="' . esc_attr(get_the_title($post)) . '">' . "\n";
                }
            }
        }
    } else {
        echo '<meta name="twitter:title" content="' . esc_attr(wp_get_document_title()) . '">' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr(starter_ai_get_meta_description()) . '">' . "\n";
    }
}

/**
 * Add JSON-LD structured data for WebSite with SearchAction (Google Sitelinks Search Box).
 */
function starter_ai_website_schema(): void
{
    $schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'WebSite',
        'name'     => get_bloginfo('name'),
        'url'      => home_url('/'),
        'potentialAction' => [
            '@type'       => 'SearchAction',
            'target'      => [
                '@type'        => 'EntryPoint',
                'urlTemplate'  => home_url('/?s={search_term_string}'),
            ],
            'query-input' => 'required name=search_term_string',
        ],
    ];

    $description = get_bloginfo('description');
    if ($description) {
        $schema['description'] = $description;
    }

    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo "\n</script>\n";
}
add_action('wp_head', 'starter_ai_website_schema', 5);
