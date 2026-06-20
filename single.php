<?php
/**
 * Single post template
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

            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>
                     itemscope itemtype="https://schema.org/Article">

                <header class="entry-header">
                    <!-- Categories -->
                    <?php
                    $categories = get_the_category();
                    if (! empty($categories)) :
                    ?>
                    <div class="entry-categories">
                        <?php foreach ($categories as $cat) : ?>
                            <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
                               class="category-badge" rel="category tag">
                                <?php echo esc_html($cat->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>

                    <div class="entry-meta">
                        <!-- Author -->
                        <span class="meta-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                            <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
                               itemprop="url">
                                <span itemprop="name"><?php the_author(); ?></span>
                            </a>
                        </span>

                        <!-- Date -->
                        <time class="meta-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"
                              itemprop="datePublished">
                            <?php echo get_the_date(); ?>
                        </time>

                        <meta itemprop="dateModified" content="<?php echo esc_attr(get_the_modified_date('c')); ?>">

                        <!-- Reading Time -->
                        <span class="meta-reading-time">
                            <?php
                            $reading_time = starter_ai_reading_time();
                            /* translators: %d: estimated reading time in minutes */
                            printf(esc_html__('%d min read', 'starter-ai'), $reading_time);
                            ?>
                        </span>

                        <!-- Comments Count -->
                        <?php if (comments_open()) : ?>
                        <span class="meta-comments">
                            <?php comments_number(
                                esc_html__('No comments', 'starter-ai'),
                                esc_html__('1 comment', 'starter-ai'),
                                /* translators: %s: number of comments */
                                esc_html__('% comments', 'starter-ai')
                            ); ?>
                        </span>
                        <?php endif; ?>
                    </div>
                </header>

                <!-- Featured Image -->
                <?php if (has_post_thumbnail()) : ?>
                <div class="entry-thumbnail" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                    <?php the_post_thumbnail('starter-ai-featured', [
                        'itemprop' => 'url',
                        'loading'  => 'eager',
                        'fetchpriority' => 'high',
                    ]); ?>
                    <meta itemprop="width" content="1200">
                    <meta itemprop="height" content="630">
                </div>
                <?php endif; ?>

                <!-- Article Content -->
                <div class="entry-content" itemprop="articleBody">
                    <?php
                    the_content();

                    wp_link_pages([
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'starter-ai'),
                        'after'  => '</div>',
                    ]);
                    ?>
                </div>

                <!-- Tags -->
                <?php
                $tags = get_the_tags();
                if (! empty($tags)) :
                ?>
                <footer class="entry-footer">
                    <div class="entry-tags" itemprop="keywords">
                        <span class="tags-label"><?php esc_html_e('Tags:', 'starter-ai'); ?></span>
                        <?php foreach ($tags as $tag) : ?>
                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"
                               class="tag-badge" rel="tag">
                                #<?php echo esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </footer>
                <?php endif; ?>

                <!-- Share Buttons -->
                <div class="entry-share">
                    <span class="share-label"><?php esc_html_e('Share:', 'starter-ai'); ?></span>
                    <?php $share_urls = starter_ai_share_urls(); ?>
                    <div class="share-buttons">
                        <a href="<?php echo esc_url($share_urls['twitter']); ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="share-btn share-twitter"
                           aria-label="<?php esc_attr_e('Share on Twitter', 'starter-ai'); ?>">
                            Twitter
                        </a>
                        <a href="<?php echo esc_url($share_urls['facebook']); ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="share-btn share-facebook"
                           aria-label="<?php esc_attr_e('Share on Facebook', 'starter-ai'); ?>">
                            Facebook
                        </a>
                        <a href="<?php echo esc_url($share_urls['linkedin']); ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="share-btn share-linkedin"
                           aria-label="<?php esc_attr_e('Share on LinkedIn', 'starter-ai'); ?>">
                            LinkedIn
                        </a>
                        <a href="<?php echo esc_url($share_urls['whatsapp']); ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="share-btn share-whatsapp"
                           aria-label="<?php esc_attr_e('Share on WhatsApp', 'starter-ai'); ?>">
                            WhatsApp
                        </a>
                        <a href="<?php echo esc_url($share_urls['telegram']); ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="share-btn share-telegram"
                           aria-label="<?php esc_attr_e('Share on Telegram', 'starter-ai'); ?>">
                            Telegram
                        </a>
                    </div>
                </div>

                <!-- Author Bio -->
                <div class="author-bio" itemprop="author" itemscope itemtype="https://schema.org/Person">
                    <div class="author-avatar">
                        <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                    </div>
                    <div class="author-info">
                        <h3 class="author-name" itemprop="name">
                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
                               itemprop="url">
                                <?php the_author(); ?>
                            </a>
                        </h3>
                        <?php if (get_the_author_meta('description')) : ?>
                            <p class="author-description" itemprop="description">
                                <?php echo esc_html(get_the_author_meta('description')); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

            </article>

            <!-- Post Navigation -->
            <?php starter_ai_post_navigation(); ?>

            <!-- Related Posts -->
            <?php
            $related_args = [
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'post__not_in'   => [get_the_ID()],
                'orderby'        => 'date',
                'order'          => 'DESC',
                'no_found_rows'  => true,
            ];

            if (! empty($categories)) {
                $related_args['category__in'] = wp_list_pluck($categories, 'term_id');
            }

            $related_query = new WP_Query($related_args);

            if ($related_query->have_posts()) :
            ?>
            <section class="related-posts">
                <h2 class="related-title"><?php esc_html_e('Related Posts', 'starter-ai'); ?></h2>
                <div class="related-grid">
                    <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                        <article class="related-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="related-thumbnail">
                                    <?php the_post_thumbnail('starter-ai-card', ['loading' => 'lazy']); ?>
                                </a>
                            <?php endif; ?>
                            <div class="related-content">
                                <h3 class="related-card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                    <?php echo get_the_date(); ?>
                                </time>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            </section>
            <?php
            wp_reset_postdata();
            endif;
            ?>

            <!-- Comments -->
            <?php if (comments_open() || get_comments_number()) : ?>
                <?php comments_template(); ?>
            <?php endif; ?>

        <?php endwhile; ?>

    </div>
</main>

<?php
get_sidebar();
get_footer();
