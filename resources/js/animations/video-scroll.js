import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

/**
 * "Scent Ribbon" — the signature scroll-scrubbed video section (see TODO
 * item #7). The section is 400vh tall with a sticky full-screen video
 * inside it (#scent-ribbon .ribbon-sticky). As the user scrolls through
 * that 400vh span, the video's currentTime is scrubbed forward (and
 * scrubbed back on scroll-up) in lockstep with scroll progress, and a
 * caption for each of the four stages fades in/out at its own segment.
 *
 * Video file: expects public/assets/video/perfume-showcase.mp4
 * (path is set in resources/views/home.blade.php via asset()).
 */
export function initVideoScroll() {
    const section = document.getElementById('scent-ribbon');
    const video = section?.querySelector('video');
    if (!section || !video) return;

    const captions = gsap.utils.toArray('#scent-ribbon .ribbon-caption');
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const ready = new Promise((resolve) => {
        if (video.readyState >= 1) return resolve();
        video.addEventListener('loadedmetadata', () => resolve(), { once: true });
    });

    ready.then(() => {
        video.pause();

        const state = { time: 0 };

        const scrub = gsap.to(state, {
            time: video.duration || 1,
            ease: 'none',
            scrollTrigger: {
                trigger: section,
                start: 'top top',
                end: 'bottom bottom',
                scrub: 0.6,
            },
            onUpdate: () => {
                if (!reducedMotion) {
                    video.currentTime = state.time;
                }
            },
        });

        // Fade each caption in for roughly one quarter of the scrub range.
        captions.forEach((caption, i) => {
            const start = i / captions.length;
            const end = (i + 1) / captions.length;

            ScrollTrigger.create({
                trigger: section,
                start: () => `top+=${start * (scrub.scrollTrigger.end - scrub.scrollTrigger.start)} top`,
                end: () => `top+=${end * (scrub.scrollTrigger.end - scrub.scrollTrigger.start)} top`,
                onEnter: () => gsap.to(caption, { opacity: 1, y: 0, duration: 0.6 }),
                onLeave: () => gsap.to(caption, { opacity: 0, y: -20, duration: 0.4 }),
                onEnterBack: () => gsap.to(caption, { opacity: 1, y: 0, duration: 0.6 }),
                onLeaveBack: () => gsap.to(caption, { opacity: 0, y: 20, duration: 0.4 }),
            });
        });

        // Gentle zoom on the video itself across the whole section.
        gsap.fromTo(
            video,
            { scale: 1.08 },
            {
                scale: 1,
                ease: 'none',
                scrollTrigger: { trigger: section, start: 'top top', end: 'bottom bottom', scrub: true },
            }
        );
    });

    // Fallback: if the browser can't/won't scrub smoothly (very old mobile
    // Safari, data-saver mode, reduced motion) just play the video normally
    // once it's in view.
    if (reducedMotion) {
        ScrollTrigger.create({
            trigger: section,
            start: 'top 60%',
            once: true,
            onEnter: () => video.play().catch(() => {}),
        });
    }
}
