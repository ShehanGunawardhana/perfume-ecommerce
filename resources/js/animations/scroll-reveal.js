import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

/**
 * Generic scroll-triggered reveal system driven entirely by data attributes,
 * so any Blade partial can opt in without touching JS:
 *
 *   <div data-reveal>...</div>                    fade + rise, single element
 *   <div data-reveal data-reveal-delay="0.2">      optional delay (seconds)
 *   <div data-reveal-stagger>                      stagger children in on scroll
 *     <div class="reveal-up">card 1</div>
 *     <div class="reveal-up">card 2</div>
 *   </div>
 *   <div data-reveal-mask><img ...></div>          clip-path / scale image reveal
 *   <h2 data-reveal-lines>Heading text</h2>         per-line text reveal
 */
export function initScrollReveal() {
    document.querySelectorAll('[data-reveal]').forEach((el) => {
        el.classList.add('reveal-up');
        gsap.to(el, {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: 'power3.out',
            delay: parseFloat(el.dataset.revealDelay || 0),
            scrollTrigger: { trigger: el, start: 'top 85%' },
        });
    });

    document.querySelectorAll('[data-reveal-stagger]').forEach((group) => {
        const items = group.querySelectorAll(':scope > *');
        items.forEach((el) => el.classList.add('reveal-up'));
        gsap.to(items, {
            opacity: 1,
            y: 0,
            duration: 0.9,
            ease: 'power3.out',
            stagger: 0.12,
            scrollTrigger: { trigger: group, start: 'top 80%' },
        });
    });

    document.querySelectorAll('[data-reveal-mask]').forEach((wrap) => {
        wrap.classList.add('reveal-mask');
        const media = wrap.querySelector('img, video');
        gsap.timeline({ scrollTrigger: { trigger: wrap, start: 'top 80%' } })
            .to(wrap, { clipPath: 'inset(0% 0% 0% 0%)', duration: 1.1, ease: 'power4.inOut' }, 0)
            .to(media, { scale: 1, duration: 1.4, ease: 'power3.out' }, 0);
    });

    document.querySelectorAll('[data-reveal-lines]').forEach((heading) => {
        const words = heading.textContent.trim().split(' ');
        heading.innerHTML = words
            .map((w) => `<span class="reveal-line inline-block overflow-hidden align-bottom"><span>${w}&nbsp;</span></span>`)
            .join('');

        gsap.to(heading.querySelectorAll('.reveal-line span'), {
            y: 0,
            duration: 0.9,
            ease: 'power4.out',
            stagger: 0.03,
            scrollTrigger: { trigger: heading, start: 'top 85%' },
        });
    });

    // Animated counters, e.g. <span data-counter="1200">0</span>
    document.querySelectorAll('[data-counter]').forEach((el) => {
        const target = parseFloat(el.dataset.counter);
        const counter = { value: 0 };
        ScrollTrigger.create({
            trigger: el,
            start: 'top 90%',
            once: true,
            onEnter: () => {
                gsap.to(counter, {
                    value: target,
                    duration: 1.6,
                    ease: 'power2.out',
                    onUpdate: () => (el.textContent = Math.floor(counter.value).toLocaleString()),
                });
            },
        });
    });
}
