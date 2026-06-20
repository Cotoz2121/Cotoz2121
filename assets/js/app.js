/**
 * starter AI Theme - Main Application Entry Point
 * ES2024+ Module
 *
 * @package starter-ai
 * @since 1.0.0
 */

import { initNavigation } from './modules/navigation.js';
import { initDarkMode } from './modules/dark-mode.js';
import { initSearch } from './modules/search.js';
import { initLazyLoad } from './modules/lazy-load.js';
import { initPerformance } from './modules/performance.js';

class StarterAIApp {
    /** @type {AbortController} */
    #controller = new AbortController();

    /** @type {Map<string, Function>} */
    #modules = new Map();

    constructor() {
        this.#registerModules();
        this.#init();
    }

    #registerModules() {
        this.#modules.set('navigation', initNavigation);
        this.#modules.set('darkMode', initDarkMode);
        this.#modules.set('search', initSearch);
        this.#modules.set('lazyLoad', initLazyLoad);
        this.#modules.set('performance', initPerformance);
    }

    #init() {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.#bootstrap(), {
                signal: this.#controller.signal,
            });
        } else {
            this.#bootstrap();
        }
    }

    #bootstrap() {
        for (const [name, initFn] of this.#modules) {
            try {
                initFn(this.#controller.signal);
            } catch (error) {
                console.error(`[starter-ai] Module "${name}" failed:`, error);
            }
        }

        this.#initBackToTop();
        this.#initHeaderScroll();
    }

    #initBackToTop() {
        const btn = document.querySelector('.back-to-top');
        if (!btn) return;

        const toggleVisibility = () => {
            const shouldShow = window.scrollY > 400;
            btn.hidden = !shouldShow;
        };

        window.addEventListener('scroll', toggleVisibility, {
            passive: true,
            signal: this.#controller.signal,
        });

        btn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }, { signal: this.#controller.signal });

        toggleVisibility();
    }

    #initHeaderScroll() {
        const header = document.getElementById('masthead');
        if (!header) return;

        let lastScrollY = 0;
        const threshold = 10;

        const onScroll = () => {
            const currentScrollY = window.scrollY;

            header.classList.toggle('scrolled', currentScrollY > threshold);

            lastScrollY = currentScrollY;
        };

        window.addEventListener('scroll', onScroll, {
            passive: true,
            signal: this.#controller.signal,
        });
    }

    destroy() {
        this.#controller.abort();
    }
}

// Initialize app
const app = new StarterAIApp();

export default app;
