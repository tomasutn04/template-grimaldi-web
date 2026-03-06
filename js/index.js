/**
 * GRIMALDI INDEX.JS
 * 
 * Page-specific JavaScript for the Index/Landing page:
 * - FAQ accordion with accessibility
 * - Animated stat counters (IntersectionObserver)
 */

document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    // ═══════════════════════════════════
    //   1. FAQ ACCORDION
    // ═══════════════════════════════════

    function initFAQ() {
        const faqItems = document.querySelectorAll('.faq-item');
        if (faqItems.length === 0) return;

        faqItems.forEach(item => {
            const pregunta = item.querySelector('.faq-pregunta');
            if (!pregunta) return;

            pregunta.addEventListener('click', () => {
                const isOpen = item.classList.contains('abierto');

                // Close all other FAQs (accordion behavior)
                faqItems.forEach(other => {
                    if (other !== item) {
                        other.classList.remove('abierto');
                        const otherBtn = other.querySelector('.faq-pregunta');
                        if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
                        const otherResp = other.querySelector('.faq-respuesta');
                        if (otherResp) otherResp.setAttribute('hidden', '');
                    }
                });

                // Toggle current FAQ
                if (isOpen) {
                    item.classList.remove('abierto');
                    pregunta.setAttribute('aria-expanded', 'false');
                    item.querySelector('.faq-respuesta').setAttribute('hidden', '');
                } else {
                    item.classList.add('abierto');
                    pregunta.setAttribute('aria-expanded', 'true');
                    item.querySelector('.faq-respuesta').removeAttribute('hidden');
                }
            });
        });
    }

    // ═══════════════════════════════════
    //   2. ANIMATED STAT COUNTERS
    // ═══════════════════════════════════

    function initStatCounters() {
        const statNumbers = document.querySelectorAll('.stat-number[data-target]');
        if (statNumbers.length === 0) return;

        let hasAnimated = false;

        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-target'), 10);
            const duration = 2000;
            const start = performance.now();

            function update(timestamp) {
                const elapsed = timestamp - start;
                const progress = Math.min(elapsed / duration, 1);

                // Ease-out cubic for natural deceleration
                const eased = 1 - Math.pow(1 - progress, 3);
                const current = Math.round(eased * target);

                element.textContent = current;

                if (progress < 1) {
                    requestAnimationFrame(update);
                } else {
                    // Add the "+" suffix after animation completes
                    const plus = element.querySelector('.stat-plus') || document.createElement('span');
                    plus.className = 'stat-plus';
                    plus.textContent = '+';
                    element.textContent = target;
                    element.appendChild(plus);
                }
            }

            requestAnimationFrame(update);
        }

        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !hasAnimated) {
                        hasAnimated = true;
                        statNumbers.forEach(el => animateCounter(el));
                        observer.disconnect();
                    }
                });
            }, { threshold: 0.3 });

            // Observe the stats section container
            const statsSection = document.querySelector('.stats-section');
            if (statsSection) {
                observer.observe(statsSection);
            }
        } else {
            // Fallback: animate immediately
            statNumbers.forEach(el => animateCounter(el));
        }
    }

    // ═══════════════════════════════════
    //   3. HERO PARALLAX (subtle)
    // ═══════════════════════════════════

    function initHeroParallax() {
        const heroBg = document.querySelector('.hero-banner__bg');
        if (!heroBg) return;

        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            if (scrollY < window.innerHeight) {
                heroBg.style.transform = `translateY(${scrollY * 0.3}px)`;
            }
        }, { passive: true });
    }

    // ═══════════════════════════════════
    //   INIT ALL
    // ═══════════════════════════════════

    initFAQ();
    initStatCounters();
    initHeroParallax();
});
