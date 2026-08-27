import { gsap } from 'gsap';

/**
 * Custom cursor (dot + trailing ring) with magnetic pull on [data-magnetic]
 * elements. Disabled automatically on touch devices.
 */
export function initCursor() {
    if (window.matchMedia('(pointer: coarse)').matches) return;

    const dot = document.querySelector('.cursor-dot');
    const ring = document.querySelector('.cursor-ring');
    if (!dot || !ring) return;

    const ringPos = { x: 0, y: 0 };

    window.addEventListener('mousemove', (e) => {
        gsap.to(dot, { x: e.clientX, y: e.clientY, duration: 0.1 });
        ringPos.x = e.clientX;
        ringPos.y = e.clientY;
        gsap.to(ring, { x: ringPos.x, y: ringPos.y, duration: 0.45, ease: 'power3.out' });
    });

    document.querySelectorAll('a, button, [data-magnetic]').forEach((el) => {
        el.addEventListener('mouseenter', () => gsap.to(ring, { scale: 1.8, duration: 0.3 }));
        el.addEventListener('mouseleave', () => gsap.to(ring, { scale: 1, duration: 0.3 }));
    });

    initMagnetic();
}

function initMagnetic() {
    document.querySelectorAll('[data-magnetic]').forEach((el) => {
        el.addEventListener('mousemove', (e) => {
            const rect = el.getBoundingClientRect();
            const relX = e.clientX - rect.left - rect.width / 2;
            const relY = e.clientY - rect.top - rect.height / 2;
            gsap.to(el, { x: relX * 0.35, y: relY * 0.35, duration: 0.4, ease: 'power3.out' });
        });
        el.addEventListener('mouseleave', () => {
            gsap.to(el, { x: 0, y: 0, duration: 0.5, ease: 'elastic.out(1, 0.4)' });
        });
    });
}
