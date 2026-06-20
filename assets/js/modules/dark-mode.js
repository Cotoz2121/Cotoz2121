/**
 * Dark Mode Module
 * System preference detection + manual toggle with localStorage persistence
 *
 * @package starter-ai
 */

const STORAGE_KEY = 'starter-ai-theme';

/**
 * @param {AbortSignal} signal
 */
export function initDarkMode(signal) {
    const toggle = document.querySelector('.dark-mode-toggle');
    const html = document.documentElement;

    const getStoredTheme = () => localStorage.getItem(STORAGE_KEY);

    const getSystemTheme = () =>
        window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';

    const setTheme = (theme) => {
        html.setAttribute('data-theme', theme);
        localStorage.setItem(STORAGE_KEY, theme);

        // Update all meta theme-color tags
        const metaThemeColors = document.querySelectorAll('meta[name="theme-color"]');
        for (const meta of metaThemeColors) {
            meta.content = theme === 'dark' ? '#020617' : '#2563eb';
        }
    };

    // Initialize theme
    const storedTheme = getStoredTheme();
    const initialTheme = storedTheme ?? getSystemTheme();
    setTheme(initialTheme);

    // Toggle button
    toggle?.addEventListener('click', () => {
        const current = html.getAttribute('data-theme');
        const next = current === 'dark' ? 'light' : 'dark';
        setTheme(next);
    }, { signal });

    // Listen for system theme changes
    const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
    mediaQuery.addEventListener('change', (e) => {
        if (!getStoredTheme()) {
            setTheme(e.matches ? 'dark' : 'light');
        }
    }, { signal });
}
