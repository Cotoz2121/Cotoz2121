/**
 * Navigation Module - Mobile menu, dropdowns, keyboard navigation
 * ES2024+
 *
 * @package starter-ai
 */

/**
 * @param {AbortSignal} signal
 */
export function initNavigation(signal) {
    const menuToggle = document.querySelector('.menu-toggle');
    const mobileOverlay = document.querySelector('.mobile-nav-overlay');
    const mobileClose = document.querySelector('.mobile-nav-close');
    const searchToggle = document.querySelector('.search-toggle');
    const searchOverlay = document.getElementById('header-search');

    // Mobile menu
    if (menuToggle && mobileOverlay) {
        const openMenu = () => {
            mobileOverlay.classList.add('is-active');
            mobileOverlay.setAttribute('aria-hidden', 'false');
            menuToggle.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';

            // Focus first link
            const firstLink = mobileOverlay.querySelector('a');
            firstLink?.focus();
        };

        const closeMenu = () => {
            mobileOverlay.classList.remove('is-active');
            mobileOverlay.setAttribute('aria-hidden', 'true');
            menuToggle.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
            menuToggle.focus();
        };

        menuToggle.addEventListener('click', openMenu, { signal });

        mobileClose?.addEventListener('click', closeMenu, { signal });

        // Close on overlay click
        mobileOverlay.addEventListener('click', (e) => {
            if (e.target === mobileOverlay) {
                closeMenu();
            }
        }, { signal });

        // Close on Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileOverlay.classList.contains('is-active')) {
                closeMenu();
            }
        }, { signal });

        // Focus trap
        mobileOverlay.addEventListener('keydown', (e) => {
            if (e.key !== 'Tab') return;

            const focusable = mobileOverlay.querySelectorAll(
                'a[href], button, input, textarea, select, [tabindex]:not([tabindex="-1"])'
            );
            const first = focusable[0];
            const last = focusable[focusable.length - 1];

            if (e.shiftKey && document.activeElement === first) {
                e.preventDefault();
                last?.focus();
            } else if (!e.shiftKey && document.activeElement === last) {
                e.preventDefault();
                first?.focus();
            }
        }, { signal });
    }

    // Search toggle
    if (searchToggle && searchOverlay) {
        searchToggle.addEventListener('click', () => {
            const isActive = searchOverlay.classList.toggle('is-active');
            searchOverlay.setAttribute('aria-hidden', String(!isActive));
            searchToggle.setAttribute('aria-expanded', String(isActive));

            if (isActive) {
                const input = searchOverlay.querySelector('.search-field');
                input?.focus();
            }
        }, { signal });

        // Close search on Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && searchOverlay.classList.contains('is-active')) {
                searchOverlay.classList.remove('is-active');
                searchOverlay.setAttribute('aria-hidden', 'true');
                searchToggle.setAttribute('aria-expanded', 'false');
                searchToggle.focus();
            }
        }, { signal });
    }

    // Keyboard navigation for dropdown menus
    const navItems = document.querySelectorAll('.primary-menu-list > li');
    for (const item of navItems) {
        const link = item.querySelector(':scope > a');
        const submenu = item.querySelector(':scope > .sub-menu');

        if (!link || !submenu) continue;

        link.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                const firstSubLink = submenu.querySelector('a');
                firstSubLink?.focus();
            }
        }, { signal });

        const subLinks = submenu.querySelectorAll('a');
        for (const [i, subLink] of subLinks.entries()) {
            subLink.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    subLinks[i + 1]?.focus();
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    if (i === 0) {
                        link.focus();
                    } else {
                        subLinks[i - 1]?.focus();
                    }
                } else if (e.key === 'Escape') {
                    link.focus();
                }
            }, { signal });
        }
    }

    // Close menus on resize to desktop
    const mediaQuery = window.matchMedia('(min-width: 1024px)');
    mediaQuery.addEventListener('change', (e) => {
        if (e.matches && mobileOverlay?.classList.contains('is-active')) {
            mobileOverlay.classList.remove('is-active');
            mobileOverlay.setAttribute('aria-hidden', 'true');
            menuToggle?.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }
    }, { signal });
}
