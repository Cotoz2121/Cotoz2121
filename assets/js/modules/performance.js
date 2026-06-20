/**
 * Performance Module - Core Web Vitals monitoring and optimization
 * ES2024+
 *
 * @package starter-ai
 */

/**
 * @param {AbortSignal} signal
 */
export function initPerformance(signal) {
    // Report Core Web Vitals
    reportWebVitals();

    // Prefetch links on hover
    initLinkPrefetch(signal);
}

/**
 * Report Core Web Vitals using PerformanceObserver.
 */
function reportWebVitals() {
    if (!('PerformanceObserver' in window)) return;

    // Largest Contentful Paint (LCP)
    try {
        const lcpObserver = new PerformanceObserver((list) => {
            const entries = list.getEntries();
            const lastEntry = entries.at(-1);
            if (lastEntry) {
                const lcp = lastEntry.startTime;
                if (lcp > 2500) {
                    console.warn(`[starter-ai] LCP: ${Math.round(lcp)}ms (above 2.5s threshold)`);
                }
            }
        });
        lcpObserver.observe({ type: 'largest-contentful-paint', buffered: true });
    } catch {
        // LCP not supported
    }

    // First Input Delay (FID) / Interaction to Next Paint (INP)
    try {
        const fidObserver = new PerformanceObserver((list) => {
            for (const entry of list.getEntries()) {
                const delay = entry.processingStart - entry.startTime;
                if (delay > 100) {
                    console.warn(`[starter-ai] Input delay: ${Math.round(delay)}ms`);
                }
            }
        });
        fidObserver.observe({ type: 'first-input', buffered: true });
    } catch {
        // FID not supported
    }

    // Cumulative Layout Shift (CLS)
    try {
        let clsValue = 0;
        const clsObserver = new PerformanceObserver((list) => {
            for (const entry of list.getEntries()) {
                if (!entry.hadRecentInput) {
                    clsValue += entry.value;
                }
            }
            if (clsValue > 0.1) {
                console.warn(`[starter-ai] CLS: ${clsValue.toFixed(4)} (above 0.1 threshold)`);
            }
        });
        clsObserver.observe({ type: 'layout-shift', buffered: true });
    } catch {
        // CLS not supported
    }
}

/**
 * Prefetch links on hover for faster navigation.
 * @param {AbortSignal} signal
 */
function initLinkPrefetch(signal) {
    const prefetched = new Set();

    const prefetch = (url) => {
        if (prefetched.has(url)) return;
        if (url.startsWith('#') || url.startsWith('mailto:') || url.startsWith('tel:')) return;

        try {
            const urlObj = new URL(url, window.location.origin);
            if (urlObj.origin !== window.location.origin) return;

            prefetched.add(url);

            const link = document.createElement('link');
            link.rel = 'prefetch';
            link.href = url;
            link.as = 'document';
            document.head.appendChild(link);
        } catch {
            // Invalid URL
        }
    };

    document.addEventListener('pointerenter', (e) => {
        const link = /** @type {HTMLElement} */ (e.target).closest('a[href]');
        if (link instanceof HTMLAnchorElement) {
            prefetch(link.href);
        }
    }, { passive: true, capture: true, signal });
}
