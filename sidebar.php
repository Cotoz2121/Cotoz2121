<?php
/**
 * Sidebar template
 *
 * @package starter-ai
 * @since 1.0.0
 */

$has_sidebar_menu = has_nav_menu('sidebar');
$has_widgets = is_active_sidebar('sidebar-1');

if (! $has_sidebar_menu && ! $has_widgets) {
    return;
}
?>

<aside id="secondary" class="widget-area sidebar" role="complementary"
       aria-label="<?php esc_attr_e('Sidebar', 'starter-ai'); ?>">

    <?php if ($has_sidebar_menu) : ?>
    <nav class="sidebar-navigation" aria-label="<?php esc_attr_e('Sidebar Navigation', 'starter-ai'); ?>">
        <h3 class="widget-title"><?php esc_html_e('Navigation', 'starter-ai'); ?></h3>
        <?php
        wp_nav_menu([
            'theme_location' => 'sidebar',
            'menu_class'     => 'sidebar-menu-list',
            'container'      => false,
            'depth'          => 2,
            'fallback_cb'    => false,
        ]);
        ?>
    </nav>
    <?php endif; ?>

    <?php if ($has_widgets) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php endif; ?>

</aside>
