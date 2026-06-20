<?php
/**
 * Custom Widgets
 *
 * @package starter-ai
 * @since 1.0.0
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Recent Posts with Thumbnails widget.
 */
class Starter_AI_Recent_Posts_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'starter_ai_recent_posts',
            esc_html__('starter AI: Recent Posts', 'starter-ai'),
            ['description' => esc_html__('Displays recent posts with thumbnails.', 'starter-ai')]
        );
    }

    public function widget($args, $instance): void
    {
        $title = ! empty($instance['title'])
            ? apply_filters('widget_title', $instance['title'])
            : esc_html__('Recent Posts', 'starter-ai');
        $count = ! empty($instance['count']) ? absint($instance['count']) : 5;

        echo $args['before_widget'];
        echo $args['before_title'] . esc_html($title) . $args['after_title'];

        $query = new WP_Query([
            'posts_per_page' => $count,
            'post_status'    => 'publish',
        ]);

        if ($query->have_posts()) {
            echo '<ul class="widget-recent-posts-list">';
            while ($query->have_posts()) {
                $query->the_post();
                echo '<li class="widget-recent-post-item">';
                if (has_post_thumbnail()) {
                    echo '<a href="' . esc_url(get_permalink()) . '" class="widget-post-thumb">';
                    the_post_thumbnail('starter-ai-thumbnail', ['loading' => 'lazy']);
                    echo '</a>';
                }
                echo '<div class="widget-post-info">';
                echo '<a href="' . esc_url(get_permalink()) . '" class="widget-post-title">' . esc_html(get_the_title()) . '</a>';
                echo '<time datetime="' . esc_attr(get_the_date('c')) . '">' . esc_html(get_the_date()) . '</time>';
                echo '</div>';
                echo '</li>';
            }
            echo '</ul>';
            wp_reset_postdata();
        }

        echo $args['after_widget'];
    }

    public function form($instance): void
    {
        $title = $instance['title'] ?? esc_html__('Recent Posts', 'starter-ai');
        $count = $instance['count'] ?? 5;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_html_e('Title:', 'starter-ai'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                   type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('count')); ?>">
                <?php esc_html_e('Number of posts:', 'starter-ai'); ?>
            </label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('count')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('count')); ?>"
                   type="number" step="1" min="1" max="10"
                   value="<?php echo absint($count); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance): array
    {
        return [
            'title' => sanitize_text_field($new_instance['title'] ?? ''),
            'count' => absint($new_instance['count'] ?? 5),
        ];
    }
}

/**
 * Author Bio widget.
 */
class Starter_AI_Author_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'starter_ai_author',
            esc_html__('starter AI: Author Bio', 'starter-ai'),
            ['description' => esc_html__('Displays author information with avatar.', 'starter-ai')]
        );
    }

    public function widget($args, $instance): void
    {
        $title = ! empty($instance['title'])
            ? apply_filters('widget_title', $instance['title'])
            : esc_html__('About the Author', 'starter-ai');

        echo $args['before_widget'];
        echo $args['before_title'] . esc_html($title) . $args['after_title'];

        if (is_singular()) {
            $author_id = get_the_author_meta('ID');
            echo '<div class="widget-author-bio">';
            echo '<div class="widget-author-avatar">' . get_avatar($author_id, 80) . '</div>';
            echo '<h4 class="widget-author-name">';
            echo '<a href="' . esc_url(get_author_posts_url($author_id)) . '">' . esc_html(get_the_author()) . '</a>';
            echo '</h4>';
            $bio = get_the_author_meta('description');
            if ($bio) {
                echo '<p class="widget-author-desc">' . esc_html($bio) . '</p>';
            }
            echo '</div>';
        }

        echo $args['after_widget'];
    }

    public function form($instance): void
    {
        $title = $instance['title'] ?? esc_html__('About the Author', 'starter-ai');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_html_e('Title:', 'starter-ai'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                   type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance): array
    {
        return [
            'title' => sanitize_text_field($new_instance['title'] ?? ''),
        ];
    }
}

/**
 * Register custom widgets.
 */
function starter_ai_register_widgets(): void
{
    register_widget(Starter_AI_Recent_Posts_Widget::class);
    register_widget(Starter_AI_Author_Widget::class);
}
add_action('widgets_init', 'starter_ai_register_widgets');
