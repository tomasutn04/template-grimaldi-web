/**
 * GRIMALDI MAIN.JS
 * 
 * Global initialization script:
 * - Loads shared components (header/footer) via fetch
 * - Initializes i18n engine
 * - Mobile navigation toggle
 * - Lazy loading observer for images
 * - Scroll-based header shadow
 */

document.addEventListener('DOMContentLoaded', async function () {
    'use strict';

    // ═══════════════════════════════════
    //   1. LOAD SHARED COMPONENTS
    // ═══════════════════════════════════

    // Componentes de la UI ahora son inyectados vía PHP (Server-Side Rendering)
    // Se elimina la lógica de carga dinámica JS de "grimaldi-header" y "grimaldi-footer"

    // ═══════════════════════════════════
    //   2. INITIALIZE i18n
    // ═══════════════════════════════════

    if (typeof GrimaldiI18n !== 'undefined') {
        await GrimaldiI18n.init();
    }

    // ═══════════════════════════════════
    //   3. MOBILE NAVIGATION
    // ═══════════════════════════════════

    function initMobileNav() {
        const toggle = document.querySelector('.nav-toggle');
        const nav = document.querySelector('.header-nav');
        const overlay = document.querySelector('.nav-overlay');

        if (!toggle || !nav) return;

        function closeNav() {
            toggle.classList.remove('active');
            nav.classList.remove('open');
            if (overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        function openNav() {
            toggle.classList.add('active');
            nav.classList.add('open');
            if (overlay) overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        toggle.addEventListener('click', () => {
            if (nav.classList.contains('open')) {
                closeNav();
            } else {
                openNav();
            }
        });

        if (overlay) {
            overlay.addEventListener('click', closeNav);
        }

        // Close nav on link click (mobile)
        nav.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', closeNav);
        });

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && nav.classList.contains('open')) {
                closeNav();
            }
        });
    }

    // Use MutationObserver to wait for header to be injected
    const headerContainer = document.getElementById('grimaldi-header');
    if (headerContainer) {
        const observer = new MutationObserver(() => {
            if (headerContainer.querySelector('.nav-toggle')) {
                initMobileNav();
                initScrollShadow();
                initActiveNav();
                observer.disconnect();
            }
        });
        observer.observe(headerContainer, { childList: true, subtree: true });
    }

    // ═══════════════════════════════════
    //   4. SCROLL-BASED HEADER SHADOW
    // ═══════════════════════════════════

    function initScrollShadow() {
        const header = document.querySelector('.grimaldi-header');
        if (!header) return;

        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) {
                header.style.boxShadow = 'var(--grimaldi-shadow)';
            } else {
                header.style.boxShadow = 'var(--grimaldi-shadow-sm)';
            }
        }, { passive: true });
    }

    // ═══════════════════════════════════
    //   4.5 ACTIVE NAVIGATION LINK
    // ═══════════════════════════════════

    function initActiveNav() {
        const navLinks = document.querySelectorAll('.header-nav ul li a');
        if (!navLinks) return;

        const currentPath = window.location.pathname;
        let isHome = currentPath.endsWith('/') || currentPath.endsWith('index.html');

        navLinks.forEach(link => {
            // Remove hardcoded active class
            link.classList.remove('active');

            const linkHref = link.getAttribute('href');

            if (isHome && (linkHref === '/' || linkHref.includes('index.html'))) {
                link.classList.add('active');
            } else if (!isHome && linkHref && linkHref !== '/' && currentPath.includes(linkHref.replace('../', '').replace('./', ''))) {
                link.classList.add('active');
            }
        });
    }

    // ═══════════════════════════════════
    //   5. LAZY LOADING (NATIVE + FALLBACK)
    // ═══════════════════════════════════

    if ('IntersectionObserver' in window) {
        const lazyImages = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    if (img.dataset.srcset) {
                        img.srcset = img.dataset.srcset;
                    }
                    img.removeAttribute('data-src');
                    img.removeAttribute('data-srcset');
                    imageObserver.unobserve(img);
                }
            });
        }, { rootMargin: '200px 0px' });

        lazyImages.forEach(img => imageObserver.observe(img));
    }

    // ═══════════════════════════════════
    //   6. SMOOTH SCROLL FOR ANCHOR LINKS
    // ═══════════════════════════════════

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
});
