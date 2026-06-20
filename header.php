<?php
/**
 * Header template
 *
 * @package starter-ai
 * @since 1.0.0
 */

?><!doctype html>
<html <?php language_attributes(); ?> data-theme="light">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#2563eb" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#020617" media="(prefers-color-scheme: dark)">
    <meta name="color-scheme" content="light dark">
    <link rel="icon" type="image/svg+xml" href="<?php echo esc_url(STARTER_AI_URI . '/assets/images/favicon.svg'); ?>">
    <link rel="apple-touch-icon" href="<?php echo esc_url(STARTER_AI_URI . '/assets/images/favicon.svg'); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary">
    <?php esc_html_e('Skip to content', 'starter-ai'); ?>
</a>

<header id="masthead" class="site-header" role="banner" itemscope itemtype="https://schema.org/WPHeader">
    <div class="container">
        <div class="header-inner">

            <!-- Site Branding -->
            <div class="site-branding" itemscope itemtype="https://schema.org/Organization">
                <?php if (has_custom_logo()) : ?>
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <div class="site-logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="zuhal-logo-link">
                            <img src="<?php echo esc_url(STARTER_AI_URI . '/assets/images/logo-zuhal.svg'); ?>"
                                 alt="<?php bloginfo('name'); ?>"
                                 class="zuhal-logo zuhal-logo-light"
                                 width="200" height="44" loading="eager">
                            <img src="<?php echo esc_url(STARTER_AI_URI . '/assets/images/logo-zuhal-dark.svg'); ?>"
                                 alt="<?php bloginfo('name'); ?>"
                                 class="zuhal-logo zuhal-logo-dark"
                                 width="200" height="44" loading="eager">
                        </a>
                    </div>
                <?php endif; ?>

                <div class="site-identity">
                    <?php if (is_front_page() && is_home()) : ?>
                        <h1 class="site-title" itemprop="name">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" itemprop="url">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                    <?php else : ?>
                        <p class="site-title" itemprop="name">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" itemprop="url">
                                <?php bloginfo('name'); ?>
                            </a>
                        </p>
                    <?php endif; ?>

                    <?php
                    $description = get_bloginfo('description', 'display');
                    if ($description || is_customize_preview()) :
                    ?>
                        <p class="site-description" itemprop="description">
                            <?php echo esc_html($description); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Primary Navigation -->
            <nav id="site-navigation" class="main-navigation" role="navigation"
                 aria-label="<?php esc_attr_e('Primary Navigation', 'starter-ai'); ?>"
                 itemscope itemtype="https://schema.org/SiteNavigationElement">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"
                        aria-label="<?php esc_attr_e('Toggle navigation menu', 'starter-ai'); ?>">
                    <span class="hamburger">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </span>
                    <span class="menu-toggle-text"><?php esc_html_e('Menu', 'starter-ai'); ?></span>
                </button>

                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'primary-menu-list',
                    'container'      => false,
                    'fallback_cb'    => false,
                    'depth'          => 3,
                ]);
                ?>
            </nav>

            <!-- Header Actions -->
            <div class="header-actions">
                <!-- Search Toggle -->
                <button class="search-toggle" aria-label="<?php esc_attr_e('Toggle search', 'starter-ai'); ?>"
                        aria-expanded="false" aria-controls="header-search">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>

                <!-- Dark Mode Toggle -->
                <button class="dark-mode-toggle" aria-label="<?php esc_attr_e('Toggle dark mode', 'starter-ai'); ?>">
                    <svg class="icon-sun" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <circle cx="12" cy="12" r="5"></circle>
                        <line x1="12" y1="1" x2="12" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="23"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="1" y1="12" x2="3" y2="12"></line>
                        <line x1="21" y1="12" x2="23" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                    <svg class="icon-moon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Search Overlay -->
    <div id="header-search" class="search-overlay" role="search" aria-hidden="true" inert>
        <div class="container">
            <?php get_search_form(); ?>
        </div>
    </div>
</header>

<!-- Mobile Navigation Overlay -->
<div class="mobile-nav-overlay" aria-hidden="true" inert>
    <div class="mobile-nav-inner">
        <button class="mobile-nav-close" aria-label="<?php esc_attr_e('Close menu', 'starter-ai'); ?>">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" aria-hidden="true">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        <?php
        wp_nav_menu([
            'theme_location' => 'mobile',
            'menu_class'     => 'mobile-menu-list',
            'container'      => false,
            'fallback_cb'    => function () {
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class'     => 'mobile-menu-list',
                    'container'      => false,
                    'fallback_cb'    => false,
                ]);
            },
        ]);
        ?>
    </div>
</div>

<div id="content" class="site-content">
