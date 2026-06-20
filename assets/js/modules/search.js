/**
 * Search Module - Live search with debouncing
 * ES2024+
 *
 * @package starter-ai
 */

/**
 * @param {AbortSignal} signal
 */
export function initSearch(signal) {
    const searchForms = document.querySelectorAll('.search-form');

    for (const form of searchForms) {
        const input = form.querySelector('.search-field');
        if (!input) continue;

        // Prevent empty search submissions
        form.addEventListener('submit', (e) => {
            if (!input.value.trim()) {
                e.preventDefault();
                input.focus();
            }
        }, { signal });

        // Add search suggestions / keyboard shortcut
        document.addEventListener('keydown', (e) => {
            // Ctrl/Cmd + K to focus search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                const headerSearch = document.getElementById('header-search');
                const searchToggle = document.querySelector('.search-toggle');

                if (headerSearch && !headerSearch.classList.contains('is-active')) {
                    searchToggle?.click();
                }

                const searchField = headerSearch?.querySelector('.search-field');
                searchField?.focus();
            }
        }, { signal });
    }
}
