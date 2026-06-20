<?php
/**
 * Theme Admin Settings Page
 *
 * @package starter-ai
 * @since 1.2.0
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

function starter_ai_admin_menu(): void
{
    add_menu_page(
        __('Zuhal Theme Settings', 'starter-ai'),
        __('Zuhal Settings', 'starter-ai'),
        'manage_options',
        'zuhal-settings',
        'starter_ai_admin_page_render',
        'dashicons-admin-customizer',
        59
    );

    add_submenu_page(
        'zuhal-settings',
        __('General Settings', 'starter-ai'),
        __('General', 'starter-ai'),
        'manage_options',
        'zuhal-settings',
        'starter_ai_admin_page_render'
    );

    add_submenu_page(
        'zuhal-settings',
        __('Menu Settings', 'starter-ai'),
        __('Menus', 'starter-ai'),
        'manage_options',
        'zuhal-menus',
        'starter_ai_menus_page_render'
    );

    add_submenu_page(
        'zuhal-settings',
        __('Patterns', 'starter-ai'),
        __('Patterns', 'starter-ai'),
        'manage_options',
        'zuhal-patterns',
        'starter_ai_patterns_page_render'
    );
}
add_action('admin_menu', 'starter_ai_admin_menu');

function starter_ai_admin_settings_init(): void
{
    register_setting('zuhal_settings', 'zuhal_options', [
        'type'              => 'array',
        'sanitize_callback' => 'starter_ai_sanitize_options',
        'default'           => starter_ai_default_options(),
    ]);

    // General Section
    add_settings_section(
        'zuhal_general',
        __('General Settings', 'starter-ai'),
        fn () => printf('<p>%s</p>', esc_html__('Configure the main theme settings.', 'starter-ai')),
        'zuhal-settings'
    );

    add_settings_field(
        'hero_enabled',
        __('Enable Hero Section', 'starter-ai'),
        'starter_ai_field_checkbox',
        'zuhal-settings',
        'zuhal_general',
        ['field' => 'hero_enabled', 'description' => __('Show the hero section on the front page', 'starter-ai')]
    );

    add_settings_field(
        'top_bar_enabled',
        __('Enable Top Bar', 'starter-ai'),
        'starter_ai_field_checkbox',
        'zuhal-settings',
        'zuhal_general',
        ['field' => 'top_bar_enabled', 'description' => __('Show a top bar above the header with menu and info', 'starter-ai')]
    );

    add_settings_field(
        'sidebar_menu_enabled',
        __('Enable Sidebar Menu', 'starter-ai'),
        'starter_ai_field_checkbox',
        'zuhal-settings',
        'zuhal_general',
        ['field' => 'sidebar_menu_enabled', 'description' => __('Show navigation menu in sidebar', 'starter-ai')]
    );

    // Colors Section
    add_settings_section(
        'zuhal_colors',
        __('Color Settings', 'starter-ai'),
        fn () => printf('<p>%s</p>', esc_html__('Customize the theme colors.', 'starter-ai')),
        'zuhal-settings'
    );

    add_settings_field(
        'primary_color',
        __('Primary Color', 'starter-ai'),
        'starter_ai_field_color',
        'zuhal-settings',
        'zuhal_colors',
        ['field' => 'primary_color']
    );

    add_settings_field(
        'secondary_color',
        __('Secondary Color', 'starter-ai'),
        'starter_ai_field_color',
        'zuhal-settings',
        'zuhal_colors',
        ['field' => 'secondary_color']
    );

    // Social Section
    add_settings_section(
        'zuhal_social',
        __('Social Media', 'starter-ai'),
        fn () => printf('<p>%s</p>', esc_html__('Add your social media links.', 'starter-ai')),
        'zuhal-settings'
    );

    $socials = [
        'facebook'  => 'Facebook',
        'twitter'   => 'Twitter / X',
        'instagram' => 'Instagram',
        'youtube'   => 'YouTube',
        'tiktok'    => 'TikTok',
        'linkedin'  => 'LinkedIn',
    ];

    foreach ($socials as $key => $label) {
        add_settings_field(
            "social_{$key}",
            $label,
            'starter_ai_field_url',
            'zuhal-settings',
            'zuhal_social',
            ['field' => "social_{$key}"]
        );
    }
}
add_action('admin_init', 'starter_ai_admin_settings_init');

function starter_ai_default_options(): array
{
    return [
        'hero_enabled'         => true,
        'top_bar_enabled'      => true,
        'sidebar_menu_enabled' => true,
        'primary_color'        => '#2563eb',
        'secondary_color'      => '#7c3aed',
        'social_facebook'      => '',
        'social_twitter'       => '',
        'social_instagram'     => '',
        'social_youtube'       => '',
        'social_tiktok'        => '',
        'social_linkedin'      => '',
    ];
}

function starter_ai_sanitize_options(array $input): array
{
    $defaults = starter_ai_default_options();
    $output = [];

    foreach ($defaults as $key => $default) {
        if (str_starts_with($key, 'social_')) {
            $output[$key] = isset($input[$key]) ? esc_url_raw($input[$key]) : '';
        } elseif (str_contains($key, 'color')) {
            $output[$key] = isset($input[$key]) ? sanitize_hex_color($input[$key]) : $default;
        } elseif (str_contains($key, 'enabled')) {
            $output[$key] = ! empty($input[$key]);
        } else {
            $output[$key] = isset($input[$key]) ? sanitize_text_field($input[$key]) : $default;
        }
    }

    return $output;
}

function starter_ai_get_option(string $key, mixed $default = null): mixed
{
    $options = get_option('zuhal_options', starter_ai_default_options());
    return $options[$key] ?? $default ?? (starter_ai_default_options()[$key] ?? null);
}

function starter_ai_field_checkbox(array $args): void
{
    $value = starter_ai_get_option($args['field'], true);
    $desc = $args['description'] ?? '';
    printf(
        '<label><input type="checkbox" name="zuhal_options[%s]" value="1" %s> %s</label>',
        esc_attr($args['field']),
        checked($value, true, false),
        esc_html($desc)
    );
}

function starter_ai_field_color(array $args): void
{
    $value = starter_ai_get_option($args['field'], '#2563eb');
    printf(
        '<input type="color" name="zuhal_options[%s]" value="%s" class="regular-text">',
        esc_attr($args['field']),
        esc_attr($value)
    );
}

function starter_ai_field_url(array $args): void
{
    $value = starter_ai_get_option($args['field'], '');
    printf(
        '<input type="url" name="zuhal_options[%s]" value="%s" class="regular-text" placeholder="https://">',
        esc_attr($args['field']),
        esc_attr($value)
    );
}

function starter_ai_admin_page_render(): void
{
    if (! current_user_can('manage_options')) {
        return;
    }

    if (isset($_GET['settings-updated'])) {
        add_settings_error('zuhal_messages', 'zuhal_message', __('Settings saved.', 'starter-ai'), 'updated');
    }

    settings_errors('zuhal_messages');
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

        <div class="zuhal-admin-header" style="background: linear-gradient(135deg, #2563eb, #7c3aed); color: #fff; padding: 20px 30px; border-radius: 8px; margin: 20px 0;">
            <h2 style="color: #fff; margin: 0 0 5px;">Zuhal Theme - قالب زحل</h2>
            <p style="margin: 0; opacity: 0.9;"><?php esc_html_e('Configure your theme settings below. Changes here sync with the Customizer.', 'starter-ai'); ?></p>
        </div>

        <form action="options.php" method="post">
            <?php
            settings_fields('zuhal_settings');
            do_settings_sections('zuhal-settings');
            submit_button(__('Save Settings', 'starter-ai'));
            ?>
        </form>

        <hr>
        <h3><?php esc_html_e('Quick Links', 'starter-ai'); ?></h3>
        <p>
            <a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="button"><?php esc_html_e('Open Customizer', 'starter-ai'); ?></a>
            <a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>" class="button"><?php esc_html_e('Manage Menus', 'starter-ai'); ?></a>
            <a href="<?php echo esc_url(admin_url('widgets.php')); ?>" class="button"><?php esc_html_e('Manage Widgets', 'starter-ai'); ?></a>
        </p>
    </div>
    <?php
}

function starter_ai_menus_page_render(): void
{
    if (! current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Menu Locations - مواقع القوائم', 'starter-ai'); ?></h1>

        <div class="zuhal-admin-header" style="background: linear-gradient(135deg, #2563eb, #7c3aed); color: #fff; padding: 20px 30px; border-radius: 8px; margin: 20px 0;">
            <p style="margin: 0; color: #fff;"><?php esc_html_e('Your theme supports the following menu locations. Go to Appearance > Menus to create and assign menus.', 'starter-ai'); ?></p>
        </div>

        <table class="widefat" style="max-width: 800px;">
            <thead>
                <tr>
                    <th><?php esc_html_e('Location', 'starter-ai'); ?></th>
                    <th><?php esc_html_e('Description', 'starter-ai'); ?></th>
                    <th><?php esc_html_e('Assigned Menu', 'starter-ai'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $locations = get_registered_nav_menus();
                $assigned = get_nav_menu_locations();
                foreach ($locations as $slug => $name) :
                    $menu_id = $assigned[$slug] ?? 0;
                    $menu = $menu_id ? wp_get_nav_menu_object($menu_id) : null;
                ?>
                <tr>
                    <td><strong><?php echo esc_html($name); ?></strong><br><code><?php echo esc_html($slug); ?></code></td>
                    <td><?php echo esc_html(starter_ai_menu_description($slug)); ?></td>
                    <td>
                        <?php if ($menu) : ?>
                            <span style="color: #10b981; font-weight: 600;"><?php echo esc_html($menu->name); ?></span>
                        <?php else : ?>
                            <span style="color: #ef4444;"><?php esc_html_e('Not assigned', 'starter-ai'); ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p style="margin-top: 20px;">
            <a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>" class="button button-primary"><?php esc_html_e('Go to Menus', 'starter-ai'); ?></a>
        </p>
    </div>
    <?php
}

function starter_ai_menu_description(string $slug): string
{
    $descriptions = [
        'primary'  => __('Main navigation in the header. Supports 3 levels of dropdowns.', 'starter-ai'),
        'top_bar'  => __('Top bar above the header. Shows small links and info.', 'starter-ai'),
        'footer'   => __('Footer navigation with single-level links.', 'starter-ai'),
        'sidebar'  => __('Sidebar navigation menu. Displayed in the sidebar area.', 'starter-ai'),
        'mobile'   => __('Mobile overlay menu. Falls back to primary menu if not set.', 'starter-ai'),
        'social'   => __('Social media icon links in the footer.', 'starter-ai'),
    ];
    return $descriptions[$slug] ?? '';
}

function starter_ai_patterns_page_render(): void
{
    if (! current_user_can('manage_options')) {
        return;
    }

    $pattern_categories = [
        'zuhal-journalism'  => ['name' => __('Journalism / News - صحافة', 'starter-ai'), 'icon' => '📰', 'color' => '#dc2626'],
        'zuhal-arts'        => ['name' => __('Arts & Culture - فنون', 'starter-ai'), 'icon' => '🎨', 'color' => '#7c3aed'],
        'zuhal-sports'      => ['name' => __('Sports - رياضة', 'starter-ai'), 'icon' => '⚽', 'color' => '#059669'],
        'zuhal-economy'     => ['name' => __('Economy - اقتصاد', 'starter-ai'), 'icon' => '📊', 'color' => '#2563eb'],
        'zuhal-marketplace' => ['name' => __('Marketplace - بيع وشراء', 'starter-ai'), 'icon' => '🛒', 'color' => '#ea580c'],
    ];
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Theme Patterns - أنماط القالب', 'starter-ai'); ?></h1>

        <div class="zuhal-admin-header" style="background: linear-gradient(135deg, #2563eb, #7c3aed); color: #fff; padding: 20px 30px; border-radius: 8px; margin: 20px 0;">
            <p style="margin: 0; color: #fff;"><?php esc_html_e('Use these patterns when creating pages or posts. Go to the block editor, click + to add a block, then navigate to "Patterns" tab.', 'starter-ai'); ?></p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">
            <?php foreach ($pattern_categories as $slug => $cat) : ?>
            <div style="border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; text-align: center; border-top: 4px solid <?php echo esc_attr($cat['color']); ?>;">
                <div style="font-size: 40px; margin-bottom: 10px;"><?php echo $cat['icon']; ?></div>
                <h3 style="margin: 0 0 8px;"><?php echo esc_html($cat['name']); ?></h3>
                <p style="color: #6b7280; font-size: 13px;"><?php
                    $patterns = WP_Block_Patterns_Registry::get_instance()->get_all_registered();
                    $count = 0;
                    foreach ($patterns as $p) {
                        if (isset($p['categories']) && in_array($slug, $p['categories'], true)) {
                            $count++;
                        }
                    }
                    printf(esc_html(_n('%d pattern available', '%d patterns available', $count, 'starter-ai')), $count);
                ?></p>
            </div>
            <?php endforeach; ?>
        </div>

        <h3 style="margin-top: 30px;"><?php esc_html_e('How to use patterns:', 'starter-ai'); ?></h3>
        <ol style="max-width: 600px; line-height: 2;">
            <li><?php esc_html_e('Create a new page or post', 'starter-ai'); ?></li>
            <li><?php esc_html_e('Click the + button to add a block', 'starter-ai'); ?></li>
            <li><?php esc_html_e('Switch to the "Patterns" tab', 'starter-ai'); ?></li>
            <li><?php esc_html_e('Browse categories: Journalism, Arts, Sports, Economy, Marketplace', 'starter-ai'); ?></li>
            <li><?php esc_html_e('Click a pattern to insert it into your content', 'starter-ai'); ?></li>
            <li><?php esc_html_e('Customize the text, images, and colors as needed', 'starter-ai'); ?></li>
        </ol>
    </div>
    <?php
}

function starter_ai_admin_styles(): void
{
    $screen = get_current_screen();
    if (! $screen || ! str_contains($screen->id, 'zuhal')) {
        return;
    }

    echo '<style>
        .zuhal-admin-header h2 { font-size: 24px; }
        .form-table th { width: 200px; }
        .form-table input[type="color"] { height: 40px; width: 80px; padding: 2px; cursor: pointer; }
    </style>';
}
add_action('admin_head', 'starter_ai_admin_styles');
