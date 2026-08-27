import { gsap } from 'gsap';

/**
 * Full-screen preloader with an animated logo mark and a gold line-wipe.
 * Runs once per page load, then reveals the page content.
 */
export function initLoader() {
    const loader = document.getElementById('loader');
    if (!loader) return;

    const mark = loader.querySelector('.loader-mark');
    const line = loader.querySelector('.loader-line');

    const tl = gsap.timeline({
        defaults: { ease: 'power3.out' },
        onComplete: () => loader.remove(),
    });

    tl.to(mark, { opacity: 1, duration: 0.6 })
        .to(line, { scaleX: 1, duration: 0.9, ease: 'power4.inOut' }, '+=0.1')
        .to(mark, { opacity: 0, duration: 0.4 }, '+=0.2')
        .to(loader, { yPercent: -100, duration: 0.8, ease: 'power4.inOut' }, '-=0.1')
        .call(() => document.body.classList.remove('overflow-hidden'));
}
