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

    if (reducedMotion) return;

    // Fetch the video as a Blob to guarantee smooth scrubbing without network/server range-request latency
    const src = video.querySelector('source')?.src || video.src;
    fetch(src)
        .then(response => response.blob())
        .then(blob => {
            const blobURL = URL.createObjectURL(blob);
            video.src = blobURL;
            video.load();
            video.pause();

            video.addEventListener('loadedmetadata', () => {
                const state = { time: 0 };
                const duration = video.duration && !isNaN(video.duration) && video.duration !== Infinity ? video.duration : 10;

                gsap.to(state, {
                    time: duration,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: section,
                        start: 'top top',
                        end: 'bottom bottom',
                        scrub: 0.1,
                    },
                    onUpdate: () => {
                        video.currentTime = state.time;
                    },
                });

                // Fade each caption in for roughly one quarter of the scrub range.
                captions.forEach((caption, i) => {
                    const start = i / captions.length;
                    const end = (i + 1) / captions.length;

                    ScrollTrigger.create({
                        trigger: section,
                        start: `${start * 100}% top`,
                        end: `${end * 100}% top`,
                        onEnter: () => gsap.to(caption, { opacity: 1, y: 0, duration: 0.4, overwrite: true }),
                        onLeave: () => gsap.to(caption, { opacity: 0, y: -20, duration: 0.4, overwrite: true }),
                        onEnterBack: () => gsap.to(caption, { opacity: 1, y: 0, duration: 0.4, overwrite: true }),
                        onLeaveBack: () => gsap.to(caption, { opacity: 0, y: 20, duration: 0.4, overwrite: true }),
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

                ScrollTrigger.refresh();
            }, { once: true });
        });
}