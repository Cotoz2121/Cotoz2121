<?php
/**
 * Front page template - Homepage
 *
 * @package starter-ai
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main content-area front-page" role="main">

    <!-- Hero Section -->
    <?php if (get_theme_mod('starter_ai_hero_enabled', true)) : ?>
    <section class="hero-section" aria-labelledby="hero-title">
        <div class="container">
            <div class="hero-content">
                <h1 id="hero-title" class="hero-title">
                    <?php
                    $hero_title = get_theme_mod('starter_ai_hero_title', 'زحل - Zuhal');
                    echo esc_html($hero_title);
                    ?>
                </h1>
                <p class="hero-subtitle">
                    <?php
                    $hero_subtitle = get_theme_mod(
                        'starter_ai_hero_subtitle',
                        esc_html__('منصتك المتطورة للمحتوى الذكي - Your Smart Content Platform', 'starter-ai')
                    );
                    echo esc_html($hero_subtitle);
                    ?>
                </p>
                <div class="hero-actions">
                    <?php
                    $cta_text = get_theme_mod('starter_ai_cta_text', esc_html__('Get Started', 'starter-ai'));
                    $cta_url = get_theme_mod('starter_ai_cta_url', '#featured-posts');
                    ?>
                    <a href="<?php echo esc_url($cta_url); ?>" class="btn btn-primary btn-lg">
                        <?php echo esc_html($cta_text); ?>
                    </a>
                    <?php
                    $cta2_text = get_theme_mod('starter_ai_cta2_text', esc_html__('Learn More', 'starter-ai'));
                    $cta2_url = get_theme_mod('starter_ai_cta2_url', '#about');
                    ?>
                    <a href="<?php echo esc_url($cta2_url); ?>" class="btn btn-secondary btn-lg">
                        <?php echo esc_html($cta2_text); ?>
                    </a>
                </div>
            </div>
            <div class="hero-visual">
                <?php if (has_custom_header()) : ?>
                    <?php the_custom_header_markup(); ?>
                <?php else : ?>
                    <div class="hero-pattern" aria-hidden="true">
                        <svg viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="heroGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:var(--color-primary);stop-opacity:0.2" />
                                    <stop offset="100%" style="stop-color:var(--color-secondary);stop-opacity:0.1" />
                                </linearGradient>
                                <linearGradient id="saturnGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#2563eb;stop-opacity:0.4" />
                                    <stop offset="100%" style="stop-color:#7c3aed;stop-opacity:0.3" />
                                </linearGradient>
                            </defs>
                            <rect width="400" height="400" fill="url(#heroGrad)" rx="20"/>
                            <!-- Saturn planet -->
                            <circle cx="200" cy="180" r="60" fill="url(#saturnGrad)"/>
                            <ellipse cx="200" cy="180" rx="110" ry="25" fill="none" stroke="var(--color-secondary)" stroke-width="3" opacity="0.3" transform="rotate(-18, 200, 180)"/>
                            <circle cx="185" cy="165" r="15" fill="rgba(255,255,255,0.15)"/>
                            <!-- Orbiting dots -->
                            <circle cx="80" cy="100" r="4" fill="var(--color-primary)" opacity="0.2"/>
                            <circle cx="320" cy="80" r="3" fill="var(--color-secondary)" opacity="0.15"/>
                            <circle cx="100" cy="300" r="5" fill="var(--color-accent)" opacity="0.1"/>
                            <circle cx="300" cy="320" r="3.5" fill="var(--color-primary)" opacity="0.12"/>
                            <!-- Arabic text -->
                            <text x="200" y="300" font-family="'Noto Sans Arabic', Arial" font-size="28" fill="var(--color-primary)" text-anchor="middle" opacity="0.15" font-weight="700">زحل</text>
                        </svg>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Featured Posts Section -->
    <section id="featured-posts" class="featured-section" aria-labelledby="featured-heading">
        <div class="container">
            <header class="section-header">
                <h2 id="featured-heading" class="section-title">
                    <?php esc_html_e('Latest Articles', 'starter-ai'); ?>
                </h2>
                <p class="section-subtitle">
                    <?php esc_html_e('Stay up to date with the latest insights and stories', 'starter-ai'); ?>
                </p>
            </header>

            <?php
            $featured_query = new WP_Query([
                'posts_per_page'      => 6,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => false,
                'no_found_rows'       => true,
            ]);

            if ($featured_query->have_posts()) :
            ?>
            <div class="featured-grid">
                <?php
                $counter = 0;
                while ($featured_query->have_posts()) : $featured_query->the_post();
                    $counter++;
                    $card_class = $counter === 1 ? 'featured-card featured-card-large' : 'featured-card';
                ?>
                <article class="<?php echo esc_attr($card_class); ?>" itemscope itemtype="https://schema.org/Article">
                    <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>" class="card-thumbnail" aria-label="<?php the_title_attribute(); ?>">
                        <?php
                        $img_size = $counter === 1 ? 'starter-ai-featured' : 'starter-ai-card';
                        $img_attrs = [
                            'loading'  => $counter === 1 ? 'eager' : 'lazy',
                            'itemprop' => 'image',
                            'sizes'    => $counter === 1
                                ? '(max-width: 600px) 100vw, (max-width: 1024px) 50vw, 768px'
                                : '(max-width: 640px) 100vw, (max-width: 1024px) 50vw, 384px',
                        ];
                        if ($counter === 1) {
                            $img_attrs['fetchpriority'] = 'high';
                        }
                        the_post_thumbnail($img_size, $img_attrs);
                        ?>
                    </a>
                    <?php endif; ?>

                    <div class="card-content">
                        <?php
                        $categories = get_the_category();
                        if (! empty($categories)) :
                        ?>
                        <span class="card-category">
                            <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">
                                <?php echo esc_html($categories[0]->name); ?>
                            </a>
                        </span>
                        <?php endif; ?>

                        <h3 class="card-title" itemprop="headline">
                            <a href="<?php the_permalink(); ?>" itemprop="url">
                                <?php the_title(); ?>
                            </a>
                        </h3>

                        <?php if ($counter === 1) : ?>
                        <p class="card-excerpt" itemprop="description">
                            <?php echo wp_trim_words(get_the_excerpt(), 30); ?>
                        </p>
                        <?php endif; ?>

                        <div class="card-meta">
                            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" itemprop="datePublished">
                                <?php echo get_the_date(); ?>
                            </time>
                            <span class="card-reading-time">
                                <?php
                                /* translators: %d: reading time in minutes */
                                printf(esc_html__('%d min', 'starter-ai'), starter_ai_reading_time());
                                ?>
                            </span>
                        </div>
                    </div>
                </article>
                <?php endwhile; ?>
            </div>

            <div class="section-footer text-center">
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"
                   class="btn btn-secondary">
                    <?php esc_html_e('View All Posts', 'starter-ai'); ?>
                </a>
            </div>

            <?php
            wp_reset_postdata();
            endif;
            ?>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories-section" aria-labelledby="categories-heading">
        <div class="container">
            <header class="section-header">
                <h2 id="categories-heading" class="section-title">
                    <?php esc_html_e('Browse by Category', 'starter-ai'); ?>
                </h2>
            </header>

            <?php
            $categories = get_categories([
                'orderby'    => 'count',
                'order'      => 'DESC',
                'hide_empty' => true,
                'number'     => 8,
            ]);

            if (! empty($categories)) :
            ?>
            <div class="categories-grid">
                <?php foreach ($categories as $category) : ?>
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
                   class="category-card">
                    <h3 class="category-name"><?php echo esc_html($category->name); ?></h3>
                    <span class="category-count">
                        <?php
                        /* translators: %d: number of posts */
                        printf(esc_html(_n('%d post', '%d posts', $category->count, 'starter-ai')), $category->count);
                        ?>
                    </span>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Newsletter / CTA Section -->
    <section id="about" class="cta-section" aria-labelledby="cta-heading">
        <div class="container">
            <div class="cta-content text-center">
                <h2 id="cta-heading" class="cta-title">
                    <?php
                    $cta_section_title = get_theme_mod(
                        'starter_ai_newsletter_title',
                        esc_html__('Stay Connected', 'starter-ai')
                    );
                    echo esc_html($cta_section_title);
                    ?>
                </h2>
                <p class="cta-text">
                    <?php
                    $cta_section_text = get_theme_mod(
                        'starter_ai_newsletter_text',
                        esc_html__('Subscribe to our newsletter and never miss an update.', 'starter-ai')
                    );
                    echo esc_html($cta_section_text);
                    ?>
                </p>

                <?php
                $newsletter_url = get_theme_mod('starter_ai_newsletter_url', '');
                if ($newsletter_url) :
                ?>
                <a href="<?php echo esc_url($newsletter_url); ?>" class="btn btn-primary btn-lg"
                   target="_blank" rel="noopener noreferrer">
                    <?php esc_html_e('Subscribe Now', 'starter-ai'); ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
