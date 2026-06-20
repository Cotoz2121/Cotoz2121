<?php
/**
 * Template part for displaying posts in archive/index views
 *
 * @package starter-ai
 * @since 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>
         itemscope itemtype="https://schema.org/Article">

    <?php if (has_post_thumbnail()) : ?>
    <a href="<?php the_permalink(); ?>" class="card-thumbnail" aria-hidden="true" tabindex="-1">
        <?php the_post_thumbnail('starter-ai-card', [
            'loading'  => 'lazy',
            'itemprop' => 'image',
        ]); ?>
    </a>
    <?php endif; ?>

    <div class="card-content">
        <?php
        $categories = get_the_category();
        if (! empty($categories)) :
        ?>
        <div class="card-categories">
            <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"
               class="category-badge" rel="category tag">
                <?php echo esc_html($categories[0]->name); ?>
            </a>
        </div>
        <?php endif; ?>

        <h2 class="card-title" itemprop="headline">
            <a href="<?php the_permalink(); ?>" itemprop="url" rel="bookmark">
                <?php the_title(); ?>
            </a>
        </h2>

        <p class="card-excerpt" itemprop="description">
            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
        </p>

        <div class="card-meta">
            <span class="meta-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                <?php echo get_avatar(get_the_author_meta('ID'), 24); ?>
                <span itemprop="name"><?php the_author(); ?></span>
            </span>
            <time class="meta-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"
                  itemprop="datePublished">
                <?php echo get_the_date(); ?>
            </time>
            <span class="meta-reading-time">
                <?php
                /* translators: %d: reading time in minutes */
                printf(esc_html__('%d min', 'starter-ai'), starter_ai_reading_time());
                ?>
            </span>
        </div>
    </div>
</article>
