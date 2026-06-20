<?php
/**
 * Template part for displaying search results
 *
 * @package starter-ai
 * @since 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>

    <div class="search-result-content">
        <header class="entry-header">
            <span class="search-result-type">
                <?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name); ?>
            </span>
            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark">
                    <?php the_title(); ?>
                </a>
            </h2>
        </header>

        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div>

        <div class="entry-meta">
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                <?php echo get_the_date(); ?>
            </time>
            <?php if (get_post_type() === 'post') : ?>
                <span class="meta-author"><?php the_author(); ?></span>
            <?php endif; ?>
        </div>
    </div>

    <?php if (has_post_thumbnail()) : ?>
    <div class="search-result-thumbnail">
        <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
            <?php the_post_thumbnail('starter-ai-thumbnail', ['loading' => 'lazy']); ?>
        </a>
    </div>
    <?php endif; ?>

</article>
