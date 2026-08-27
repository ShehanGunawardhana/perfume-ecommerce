import { gsap } from 'gsap';

/**
 * Home hero entrance: staggered headline lines, fade-up subcopy/buttons,
 * a slow parallax + mouse-tilt on the hero bottle image, and a soft
 * ambient parallax on the background glow.
 */
export function initHero() {
    const hero = document.getElementById('hero');
    if (!hero) return;

    const tl = gsap.timeline({ defaults: { ease: 'power4.out' } });

    tl.to('#hero [data-hero-eyebrow]', { opacity: 1, y: 0, duration: 0.8 })
        .to('#hero .reveal-line span', { y: 0, duration: 1, stagger: 0.05 }, '-=0.5')
        .to('#hero [data-hero-copy]', { opacity: 1, y: 0, duration: 0.8 }, '-=0.6')
        .to('#hero [data-hero-cta]', { opacity: 1, y: 0, duration: 0.8, stagger: 0.1 }, '-=0.6')
        .to('#hero [data-hero-image]', { opacity: 1, scale: 1, duration: 1.4, ease: 'power3.out' }, '-=1.1');

    // Parallax background glow on scroll
    gsap.to('#hero [data-hero-glow]', {
        yPercent: 30,
        ease: 'none',
        scrollTrigger: { trigger: hero, start: 'top top', end: 'bottom top', scrub: true },
    });

    // Subtle mouse-tilt on the bottle image
    const image = hero.querySelector('[data-hero-image]');
    if (image && !window.matchMedia('(pointer: coarse)').matches) {
        hero.addEventListener('mousemove', (e) => {
            const { innerWidth, innerHeight } = window;
            const x = (e.clientX / innerWidth - 0.5) * 20;
            const y = (e.clientY / innerHeight - 0.5) * 20;
            gsap.to(image, { rotateY: x, rotateX: -y, duration: 0.6, ease: 'power2.out' });
        });
    }
}
