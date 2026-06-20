<?php
/**
 * Block Patterns Registration
 *
 * @package starter-ai
 * @since 1.2.0
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

function starter_ai_register_pattern_categories(): void
{
    $categories = [
        'zuhal-journalism' => [
            'label'       => esc_html__('Journalism / News', 'starter-ai'),
            'description' => esc_html__('Patterns for news and journalism websites', 'starter-ai'),
        ],
        'zuhal-arts' => [
            'label'       => esc_html__('Arts & Culture', 'starter-ai'),
            'description' => esc_html__('Patterns for arts, culture, and entertainment', 'starter-ai'),
        ],
        'zuhal-sports' => [
            'label'       => esc_html__('Sports', 'starter-ai'),
            'description' => esc_html__('Patterns for sports content', 'starter-ai'),
        ],
        'zuhal-economy' => [
            'label'       => esc_html__('Economy & Business', 'starter-ai'),
            'description' => esc_html__('Patterns for economy and business content', 'starter-ai'),
        ],
        'zuhal-marketplace' => [
            'label'       => esc_html__('Buy & Sell / Marketplace', 'starter-ai'),
            'description' => esc_html__('Patterns for marketplace and classified content', 'starter-ai'),
        ],
    ];

    foreach ($categories as $slug => $args) {
        register_block_pattern_category($slug, $args);
    }
}
add_action('init', 'starter_ai_register_pattern_categories');

function starter_ai_register_patterns(): void
{
    $patterns_dir = STARTER_AI_DIR . '/patterns';
    if (! is_dir($patterns_dir)) {
        return;
    }

    $pattern_files = glob($patterns_dir . '/*.php');
    if (empty($pattern_files)) {
        return;
    }

    foreach ($pattern_files as $file) {
        $pattern_data = require $file;
        if (is_array($pattern_data) && isset($pattern_data['slug'], $pattern_data['content'])) {
            register_block_pattern('zuhal/' . $pattern_data['slug'], [
                'title'       => $pattern_data['title'] ?? $pattern_data['slug'],
                'description' => $pattern_data['description'] ?? '',
                'categories'  => $pattern_data['categories'] ?? [],
                'content'     => $pattern_data['content'],
                'keywords'    => $pattern_data['keywords'] ?? [],
            ]);
        }
    }
}
add_action('init', 'starter_ai_register_patterns');
