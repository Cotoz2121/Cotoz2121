<?php
/**
 * Template part for displaying "no content found" message
 *
 * @package starter-ai
 * @since 1.0.0
 */

?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e('Nothing Found', 'starter-ai'); ?></h1>
    </header>

    <div class="page-content">
        <?php if (is_home() && current_user_can('publish_posts')) : ?>

            <p>
                <?php
                printf(
                    /* translators: %s: link to create a new post */
                    wp_kses(
                        __('Ready to publish your first post? <a href="%s">Get started here</a>.', 'starter-ai'),
                        ['a' => ['href' => []]]
                    ),
                    esc_url(admin_url('post-new.php'))
                );
                ?>
            </p>

        <?php elseif (is_search()) : ?>

            <p><?php esc_html_e('Sorry, no results matched your search. Please try again with different keywords.', 'starter-ai'); ?></p>
            <?php get_search_form(); ?>

        <?php else : ?>

            <p><?php esc_html_e('It seems we can\'t find what you\'re looking for. Try searching.', 'starter-ai'); ?></p>
            <?php get_search_form(); ?>

        <?php endif; ?>
    </div>
</section>
