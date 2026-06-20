<?php
/**
 * Search results template
 *
 * @package starter-ai
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main content-area" role="main">
    <div class="container">

        <?php starter_ai_breadcrumbs(); ?>

        <header class="search-header">
            <h1 class="search-title">
                <?php
                /* translators: %s: search query */
                printf(esc_html__('Search Results for: %s', 'starter-ai'), '<span>' . get_search_query() . '</span>');
                ?>
            </h1>

            <div class="search-form-wrapper">
                <?php get_search_form(); ?>
            </div>
        </header>

        <?php if (have_posts()) : ?>

            <p class="search-results-count">
                <?php
                /* translators: %d: number of results */
                printf(
                    esc_html(_n('%d result found', '%d results found', (int) $wp_query->found_posts, 'starter-ai')),
                    (int) $wp_query->found_posts
                );
                ?>
            </p>

            <div class="search-results-list">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/content', 'search'); ?>
                <?php endwhile; ?>
            </div>

            <?php starter_ai_pagination(); ?>

        <?php else : ?>

            <?php get_template_part('template-parts/content', 'none'); ?>

        <?php endif; ?>

    </div>
</main>

<?php
get_sidebar();
get_footer();
