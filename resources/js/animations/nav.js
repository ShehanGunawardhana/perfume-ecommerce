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
        start: 'top -80',
        onUpdate: (self) => nav.classList.toggle('nav-scrolled', self.scroll() > 80),
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
