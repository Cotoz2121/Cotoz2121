<?php
/**
 * Comments template
 *
 * @package starter-ai
 * @since 1.0.0
 */

if (post_password_required()) {
    return;
}
?>

<section id="comments" class="comments-area" aria-label="<?php esc_attr_e('Comments', 'starter-ai'); ?>">

    <?php if (have_comments()) : ?>

        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            printf(
                /* translators: 1: number of comments, 2: post title */
                esc_html(_nx(
                    '%1$s Comment on &ldquo;%2$s&rdquo;',
                    '%1$s Comments on &ldquo;%2$s&rdquo;',
                    $comment_count,
                    'comments title',
                    'starter-ai'
                )),
                number_format_i18n($comment_count),
                get_the_title()
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments([
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 48,
            ]);
            ?>
        </ol>

        <?php
        the_comments_navigation([
            'prev_text' => esc_html__('Older Comments', 'starter-ai'),
            'next_text' => esc_html__('Newer Comments', 'starter-ai'),
        ]);
        ?>

    <?php endif; ?>

    <?php if (! comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'starter-ai'); ?></p>
    <?php endif; ?>

    <?php
    comment_form([
        'title_reply'         => esc_html__('Leave a Comment', 'starter-ai'),
        'title_reply_before'  => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'   => '</h3>',
        'class_form'          => 'comment-form',
        'class_submit'        => 'btn btn-primary',
        'submit_button'       => '<button type="submit" name="%1$s" id="%2$s" class="%3$s">%4$s</button>',
    ]);
    ?>

</section>
