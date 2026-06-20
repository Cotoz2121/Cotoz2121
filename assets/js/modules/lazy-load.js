/**
 * Lazy Load Module - IntersectionObserver-based lazy loading
 * ES2024+
 *
 * @package starter-ai
 */

/**
 * @param {AbortSignal} signal
 */
export function initLazyLoad(signal) {
    // Lazy load images with data-src
    const lazyImages = document.querySelectorAll('img[data-src]');

    if (lazyImages.length === 0) return;

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(
            (entries) => {
                for (const entry of entries) {
                    if (!entry.isIntersecting) continue;

                    const img = /** @type {HTMLImageElement} */ (entry.target);
                    const src = img.dataset.src;
                    const srcset = img.dataset.srcset;

                    if (src) {
                        img.src = src;
                        img.removeAttribute('data-src');
                    }

                    if (srcset) {
                        img.srcset = srcset;
                        img.removeAttribute('data-srcset');
                    }

                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            },
            {
                rootMargin: '200px 0px',
                threshold: 0.01,
            }
        );

        for (const img of lazyImages) {
            observer.observe(img);
        }

        // Cleanup on abort
        signal?.addEventListener('abort', () => {
            observer.disconnect();
        });
    } else {
        // Fallback for browsers without IntersectionObserver
        for (const img of lazyImages) {
            const imgEl = /** @type {HTMLImageElement} */ (img);
            if (imgEl.dataset.src) {
                imgEl.src = imgEl.dataset.src;
            }
            if (imgEl.dataset.srcset) {
                imgEl.srcset = imgEl.dataset.srcset;
            }
        }
    }

    // Animate elements on scroll
    const animateElements = document.querySelectorAll('[data-animate]');
    if (animateElements.length > 0 && 'IntersectionObserver' in window) {
        const animateObserver = new IntersectionObserver(
            (entries) => {
                for (const entry of entries) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                        animateObserver.unobserve(entry.target);
                    }
                }
            },
            {
                rootMargin: '0px 0px -50px 0px',
                threshold: 0.1,
            }
        );

        for (const el of animateElements) {
            animateObserver.observe(el);
        }

        signal?.addEventListener('abort', () => {
            animateObserver.disconnect();
        });
    }
}
