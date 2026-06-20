<?php
/**
 * Footer template
 *
 * @package starter-ai
 * @since 1.0.0
 */

?>
</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo" itemscope itemtype="https://schema.org/WPFooter">
    <div class="container">

        <!-- Footer Widgets -->
        <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) : ?>
        <div class="footer-widgets">
            <div class="footer-widgets-grid">
                <?php for ($i = 1; $i <= 4; $i++) : ?>
                    <?php if (is_active_sidebar("footer-{$i}")) : ?>
                        <div class="footer-widget-area footer-col-<?php echo $i; ?>">
                            <?php dynamic_sidebar("footer-{$i}"); ?>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Footer Navigation -->
        <?php if (has_nav_menu('footer')) : ?>
        <nav class="footer-navigation" aria-label="<?php esc_attr_e('Footer Navigation', 'starter-ai'); ?>">
            <?php
            wp_nav_menu([
                'theme_location' => 'footer',
                'menu_class'     => 'footer-menu-list',
                'container'      => false,
                'depth'          => 1,
            ]);
            ?>
        </nav>
        <?php endif; ?>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="footer-bottom-inner">
                <!-- Copyright -->
                <div class="footer-copyright">
                    <p>
                        &copy; <?php echo esc_html(wp_date('Y')); ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php bloginfo('name'); ?>
                        </a>.
                        <?php esc_html_e('All rights reserved.', 'starter-ai'); ?>
                        | <span class="footer-brand">zuhalpost.com</span>
                    </p>
                </div>

                <!-- Social Links -->
                <?php if (has_nav_menu('social')) : ?>
                <nav class="footer-social" aria-label="<?php esc_attr_e('Social Links', 'starter-ai'); ?>">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'social',
                        'menu_class'     => 'social-menu-list',
                        'container'      => false,
                        'depth'          => 1,
                        'link_before'    => '<span class="sr-only">',
                        'link_after'     => '</span>',
                    ]);
                    ?>
                </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Back to Top -->
    <button class="back-to-top" aria-label="<?php esc_attr_e('Back to top', 'starter-ai'); ?>" hidden>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <polyline points="18 15 12 9 6 15"></polyline>
        </svg>
    </button>
</footer>

<?php wp_footer(); ?>

</body>
</html>
