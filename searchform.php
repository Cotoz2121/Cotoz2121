<?php
/**
 * Custom search form
 *
 * @package starter-ai
 * @since 1.0.0
 */

$unique_id = wp_unique_id('search-form-');
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="<?php echo esc_attr($unique_id); ?>" class="sr-only">
        <?php esc_html_e('Search for:', 'starter-ai'); ?>
    </label>
    <div class="search-input-wrapper">
        <input type="search"
               id="<?php echo esc_attr($unique_id); ?>"
               class="search-field"
               placeholder="<?php esc_attr_e('Search...', 'starter-ai'); ?>"
               value="<?php echo get_search_query(); ?>"
               name="s"
               autocomplete="off"
               required>
        <button type="submit" class="search-submit" aria-label="<?php esc_attr_e('Search', 'starter-ai'); ?>">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
        </button>
    </div>
</form>
