/**
 * Customizer Live Preview
 *
 * @package starter-ai
 */

(function (wp) {
    const { customize } = wp;

    // Site title
    customize('blogname', (value) => {
        value.bind((to) => {
            const el = document.querySelector('.site-title a');
            if (el) el.textContent = to;
        });
    });

    // Site description
    customize('blogdescription', (value) => {
        value.bind((to) => {
            const el = document.querySelector('.site-description');
            if (el) el.textContent = to;
        });
    });

    // Hero title
    customize('starter_ai_hero_title', (value) => {
        value.bind((to) => {
            const el = document.querySelector('.hero-title');
            if (el) el.textContent = to;
        });
    });

    // Hero subtitle
    customize('starter_ai_hero_subtitle', (value) => {
        value.bind((to) => {
            const el = document.querySelector('.hero-subtitle');
            if (el) el.textContent = to;
        });
    });

    // Primary color
    customize('starter_ai_primary_color', (value) => {
        value.bind((to) => {
            document.documentElement.style.setProperty('--color-primary', to);
        });
    });

    // Secondary color
    customize('starter_ai_secondary_color', (value) => {
        value.bind((to) => {
            document.documentElement.style.setProperty('--color-secondary', to);
        });
    });

    // Accent color
    customize('starter_ai_accent_color', (value) => {
        value.bind((to) => {
            document.documentElement.style.setProperty('--color-accent', to);
        });
    });
})(window.wp);
