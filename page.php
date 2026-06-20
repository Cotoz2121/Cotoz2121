<?php
/**
 * Page template
 *
 * @package starter-ai
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main content-area" role="main">
    <div class="container">

        <?php starter_ai_breadcrumbs(); ?>

        <?php while (have_posts()) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('single-page'); ?>
                     itemscope itemtype="https://schema.org/WebPage">

                <header class="entry-header">
                    <h1 class="entry-title page-title" itemprop="name headline">
                        <?php the_title(); ?>
                    </h1>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                <div class="entry-thumbnail">
                    <?php the_post_thumbnail('starter-ai-featured', [
                        'loading'       => 'eager',
                        'fetchpriority' => 'high',
                    ]); ?>
                </div>
                <?php endif; ?>

                <div class="entry-content" itemprop="mainContentOfPage">
                    <?php
                    the_content();

                    wp_link_pages([
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'starter-ai'),
                        'after'  => '</div>',
                    ]);
                    ?>
                </div>

                <?php if (comments_open() || get_comments_number()) : ?>
                    <?php comments_template(); ?>
                <?php endif; ?>

            </article>

        <?php endwhile; ?>

    </div>
</main>

<?php
get_sidebar();
get_footer();
