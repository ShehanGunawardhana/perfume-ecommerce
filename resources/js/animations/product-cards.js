import { gsap } from 'gsap';

/**
 * Staggered entrance for product grids (shop page, featured perfumes,
 * category tiles) plus quick "added to cart" / "added to wishlist"
 * micro-feedback on the action buttons.
 */
export function initProductCards() {
    document.querySelectorAll('[data-product-grid]').forEach((grid) => {
        const cards = grid.querySelectorAll('.product-card');
        cards.forEach((c) => c.classList.add('reveal-up'));

        gsap.to(cards, {
            opacity: 1,
            y: 0,
            duration: 0.7,
            ease: 'power3.out',
            stagger: 0.08,
            scrollTrigger: { trigger: grid, start: 'top 85%' },
        });
    });

    document.querySelectorAll('[data-quick-action]').forEach((btn) => {
        btn.addEventListener('click', () => {
            gsap.fromTo(btn, { scale: 0.85 }, { scale: 1, duration: 0.4, ease: 'back.out(3)' });
        });
    });
}
