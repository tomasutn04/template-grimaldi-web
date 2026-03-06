/**
 * GRIMALDI i18n ENGINE
 * 
 * Lightweight internationalization system using JSON translation files.
 * - Detects language from URL param (?lang=xx), localStorage, or defaults to 'es'
 * - Fetches JSON translation files from /src/i18n/
 * - Replaces DOM elements with [data-i18n] attributes
 * - Updates <html lang>, meta tags, and document title
 */

const GrimaldiI18n = (function () {
    'use strict';

    const SUPPORTED_LANGS = ['es', 'en', 'it', 'pt'];
    const DEFAULT_LANG = 'es';
    const STORAGE_KEY = 'grimaldi_lang';

    let currentLang = DEFAULT_LANG;
    let translations = {};
    let basePath = '';

    /**
     * Detect the base path for i18n files relative to the current page
     */
    function detectBasePath() {
        const scripts = document.querySelectorAll('script[src*="i18n.js"]');
        if (scripts.length > 0) {
            const src = scripts[0].getAttribute('src');
            basePath = src.replace(/js\/i18n\.js$/, '');
        } else {
            // Fallback: try to detect from page location
            const path = window.location.pathname;
            if (path.includes('/public/')) {
                basePath = '../';
            } else {
                basePath = './src/';
            }
        }
    }

    /**
     * Detect the user's preferred language
     */
    function detectLanguage() {
        // 1. URL parameter takes priority
        const urlParams = new URLSearchParams(window.location.search);
        const urlLang = urlParams.get('lang');
        if (urlLang && SUPPORTED_LANGS.includes(urlLang)) {
            return urlLang;
        }

        // 2. Check localStorage
        const storedLang = localStorage.getItem(STORAGE_KEY);
        if (storedLang && SUPPORTED_LANGS.includes(storedLang)) {
            return storedLang;
        }

        // 3. Browser language
        const browserLang = navigator.language.split('-')[0];
        if (SUPPORTED_LANGS.includes(browserLang)) {
            return browserLang;
        }

        return DEFAULT_LANG;
    }

    /**
     * Fetch translation JSON file
     */
    async function loadTranslations(lang) {
        try {
            const response = await fetch(`${basePath}i18n/${lang}.json`);
            if (!response.ok) throw new Error(`HTTP ${response.status}`);
            return await response.json();
        } catch (error) {
            console.warn(`[i18n] Failed to load ${lang}.json, falling back to ${DEFAULT_LANG}`);
            if (lang !== DEFAULT_LANG) {
                const fallback = await fetch(`${basePath}i18n/${DEFAULT_LANG}.json`);
                return await fallback.json();
            }
            return {};
        }
    }

    /**
     * Get a nested value from an object using dot notation
     * e.g., getNestedValue(obj, 'hero.title') -> obj.hero.title
     */
    function getNestedValue(obj, path) {
        return path.split('.').reduce((current, key) => {
            return current && current[key] !== undefined ? current[key] : null;
        }, obj);
    }

    /**
     * Apply translations to all DOM elements with [data-i18n]
     */
    function applyTranslations() {
        // Text content
        document.querySelectorAll('[data-i18n]').forEach(el => {
            const key = el.getAttribute('data-i18n');
            const value = getNestedValue(translations, key);
            if (value) {
                // Check if value contains HTML (for FAQ answers with links)
                if (value.includes('<')) {
                    el.innerHTML = value;
                } else {
                    el.textContent = value;
                }
            }
        });

        // Placeholder attributes
        document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
            const key = el.getAttribute('data-i18n-placeholder');
            const value = getNestedValue(translations, key);
            if (value) el.setAttribute('placeholder', value);
        });

        // Title attributes (for accessibility)
        document.querySelectorAll('[data-i18n-title]').forEach(el => {
            const key = el.getAttribute('data-i18n-title');
            const value = getNestedValue(translations, key);
            if (value) el.setAttribute('title', value);
        });

        // Alt attributes for images
        document.querySelectorAll('[data-i18n-alt]').forEach(el => {
            const key = el.getAttribute('data-i18n-alt');
            const value = getNestedValue(translations, key);
            if (value) el.setAttribute('alt', value);
        });

        // Update HTML lang attribute
        document.documentElement.setAttribute('lang', currentLang);

        // Update meta tags
        updateMetaTags();

        // Update language selector active state
        updateLangSelector();
    }

    /**
     * Update document title and meta tags
     */
    function updateMetaTags() {
        const meta = translations.meta || {};

        if (meta.title) {
            document.title = meta.title;
        }

        // Meta description
        let metaDesc = document.querySelector('meta[name="description"]');
        if (metaDesc && meta.description) {
            metaDesc.setAttribute('content', meta.description);
        }

        // OpenGraph
        let ogTitle = document.querySelector('meta[property="og:title"]');
        if (ogTitle && meta.og_title) {
            ogTitle.setAttribute('content', meta.og_title);
        }

        let ogDesc = document.querySelector('meta[property="og:description"]');
        if (ogDesc && meta.og_description) {
            ogDesc.setAttribute('content', meta.og_description);
        }
    }

    /**
     * Update language selector button states
     */
    function updateLangSelector() {
        document.querySelectorAll('.lang-selector button').forEach(btn => {
            const lang = btn.getAttribute('data-lang');
            btn.classList.toggle('active', lang === currentLang);
        });
    }

    /**
     * Switch to a different language
     */
    async function setLanguage(lang) {
        if (!SUPPORTED_LANGS.includes(lang)) return;

        currentLang = lang;
        localStorage.setItem(STORAGE_KEY, lang);
        translations = await loadTranslations(lang);
        applyTranslations();

        // Update URL without reload
        const url = new URL(window.location);
        if (lang === DEFAULT_LANG) {
            url.searchParams.delete('lang');
        } else {
            url.searchParams.set('lang', lang);
        }
        window.history.replaceState({}, '', url);
    }

    /**
     * Initialize the i18n system
     */
    async function init() {
        detectBasePath();
        currentLang = detectLanguage();
        translations = await loadTranslations(currentLang);
        applyTranslations();

        // Bind language selector buttons
        document.querySelectorAll('[data-lang]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                setLanguage(btn.getAttribute('data-lang'));
            });
        });
    }

    // Public API
    return {
        init,
        setLanguage,
        getCurrentLang: () => currentLang,
        t: (key) => getNestedValue(translations, key) || key,
        SUPPORTED_LANGS
    };
})();
