<?php
/**
 * 404 Not Found template
 *
 * @package starter-ai
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main content-area" role="main">
    <div class="container">

        <section class="error-404 not-found">
            <div class="error-content text-center">
                <div class="error-illustration">
                    <img src="<?php echo esc_url(STARTER_AI_URI . '/assets/images/404-illustration.svg'); ?>"
                         alt="<?php esc_attr_e('Page not found', 'starter-ai'); ?>"
                         width="400" height="267" loading="eager">
                </div>

                <div class="error-code">
                    <span class="error-number">404</span>
                </div>

                <header class="page-header">
                    <h1 class="page-title">
                        <?php esc_html_e('Page Not Found', 'starter-ai'); ?>
                    </h1>
                </header>

                <div class="page-content">
                    <p>
                        <?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'starter-ai'); ?>
                    </p>

                    <div class="error-actions">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                            <?php esc_html_e('Go to Homepage', 'starter-ai'); ?>
                        </a>
                    </div>

                    <div class="error-search">
                        <p><?php esc_html_e('Or try searching:', 'starter-ai'); ?></p>
                        <?php get_search_form(); ?>
                    </div>

                    <!-- Recent Posts -->
                    <div class="error-recent-posts">
                        <h2><?php esc_html_e('Recent Posts', 'starter-ai'); ?></h2>
                        <?php
                        $recent_posts = new WP_Query([
                            'posts_per_page' => 5,
                            'post_status'    => 'publish',
                        ]);

                        if ($recent_posts->have_posts()) :
                        ?>
                        <ul class="recent-posts-list">
                            <?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                        <?php echo get_the_date(); ?>
                                    </time>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                        <?php
                        wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </section>

    </div>
</main>

<?php
get_footer();
