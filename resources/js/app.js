import './bootstrap';
import { Alpine, gsap } from './bootstrap';

import { initLoader } from './animations/loader';
import { initCursor } from './animations/cursor';
import { initNav } from './animations/nav';
import { initHero } from './animations/hero';
import { initScrollReveal } from './animations/scroll-reveal';
import { initVideoScroll } from './animations/video-scroll';
import { initProductCards } from './animations/product-cards';

document.addEventListener('DOMContentLoaded', () => {
    document.body.classList.add('overflow-hidden');

    initLoader();
    initCursor();
    initNav();
    initHero();
    initScrollReveal();
    initVideoScroll();
    initProductCards();

    Alpine.start();
});

/**
 * Lightweight toast notifications, used for "added to cart", "added to
 * wishlist", form success/error, etc. Call window.toast('Added to cart').
 */
window.toast = function toast(message, type = 'success') {
    const root = document.getElementById('toast-root');
    if (!root) return;

    const el = document.createElement('div');
    el.className = 'toast';
    el.innerHTML = `<span class="h-1.5 w-1.5 rounded-full ${type === 'success' ? 'bg-amber' : 'bg-bordeaux'}"></span><span>${message}</span>`;
    root.appendChild(el);

    gsap.to(el, { x: 0, duration: 0.5, ease: 'power3.out' });
    gsap.to(el, {
        x: '120%',
        duration: 0.4,
        delay: 3,
        ease: 'power3.in',
        onComplete: () => el.remove(),
    });
};

// Auto-fire toasts for Laravel flash messages rendered into #flash-data.
document.addEventListener('DOMContentLoaded', () => {
    const flash = document.getElementById('flash-data');
    if (flash?.dataset.success) window.toast(flash.dataset.success, 'success');
    if (flash?.dataset.error) window.toast(flash.dataset.error, 'error');
});
