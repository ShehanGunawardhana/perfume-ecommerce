import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

/**
 * Sticky nav background swap on scroll + a thin gold bar across the top
 * of the nav that fills according to total page scroll progress.
 */
export function initNav() {
    const nav = document.getElementById('site-nav');
    const progress = document.querySelector('.nav-progress');
    if (!nav) return;

    ScrollTrigger.create({
        start: 0,
        onUpdate: (self) => {
            const currentScroll = self.scroll();
            nav.classList.toggle('nav-scrolled', currentScroll > 80);

            // Hide on scroll down, show on scroll up (or if at the top)
            if (currentScroll > 150 && self.direction === 1) {
                gsap.to(nav, { yPercent: -100, duration: 0.4, ease: 'power3.out', overwrite: true });
            } else {
                gsap.to(nav, { yPercent: 0, duration: 0.4, ease: 'power3.out', overwrite: true });
            }
        },
    });

    if (progress) {
        gsap.to(progress, {
            scaleX: 1,
            ease: 'none',
            scrollTrigger: {
                start: 0,
                end: () => document.documentElement.scrollHeight - window.innerHeight,
                scrub: 0.3,
            },
        });
    }
}
