@extends('layouts.app')

@section('title', config('app.name') . ' — Rare Fragrances')

@section('content')

{{-- =================== HERO =================== --}}
<section id="hero" class="relative flex min-h-screen items-center overflow-hidden px-6 lg:px-10">
    <div data-hero-glow class="pointer-events-none absolute -right-40 top-1/4 h-[36rem] w-[36rem] rounded-full bg-bordeaux/30 blur-[140px]"></div>

    <div class="mx-auto grid max-w-7xl items-center gap-16 lg:grid-cols-2">
        <div>
            <p data-hero-eyebrow class="eyebrow mb-6 opacity-0" style="transform: translateY(20px)">The 2026 Collection</p>

            <h1 data-reveal-lines class="font-display text-5xl font-light leading-[1.05] text-ivory md:text-7xl">
                Discover Your Signature
            </h1>

            <p data-hero-copy class="mt-6 max-w-md text-base text-smoke opacity-0" style="transform: translateY(20px)">
                Each bottle is composed in small batches from rare top, heart, and base notes —
                built to open on your skin and linger long after you've left the room.
            </p>

            <div class="mt-10 flex flex-wrap gap-4">
                <a data-hero-cta href="{{ route('shop.index') }}" class="btn-primary opacity-0" style="transform: translateY(20px)" data-magnetic>Shop Now</a>
                <a data-hero-cta href="#collection" class="btn-ghost border border-line opacity-0" style="transform: translateY(20px)" data-magnetic>Explore Collection</a>
            </div>
        </div>

        <div data-hero-image class="relative mx-auto aspect-[3/4] w-full max-w-md scale-95 opacity-0" style="perspective: 1000px">
            <img src="{{ asset('assets/images/perfumes/hero-bottle.png') }}" alt="Featured perfume bottle" class="h-full w-full object-contain drop-shadow-2xl">
        </div>
    </div>
</section>

{{-- =================== FEATURED PERFUMES =================== --}}
<section id="collection" class="px-6 py-28 lg:px-10">
    <div class="mx-auto max-w-7xl">
        <div class="mb-14 flex items-end justify-between" data-reveal>
            <div>
                <p class="eyebrow mb-3">Featured</p>
                <h2 class="font-display text-4xl font-light md:text-5xl">This Season's Edit</h2>
            </div>
            <a href="{{ route('shop.index') }}" class="nav-link hidden md:inline-flex">View all</a>
        </div>

        <div data-product-grid class="grid grid-cols-2 gap-6 md:grid-cols-4">
            @forelse ($featuredPerfumes as $perfume)
                <article class="product-card">
                    <a href="{{ route('shop.show', $perfume->slug) }}" class="product-media block aspect-[3/4]">
                        <img src="{{ $perfume->main_image ? asset('storage/' . $perfume->main_image) : asset('assets/images/perfumes/placeholder.jpg') }}" alt="{{ $perfume->name }}" loading="lazy">

                        <div class="product-actions">
                            <button type="button" class="text-xs uppercase tracking-widest2 text-ivory hover:text-amber" data-quick-action>Quick View</button>
                        </div>
                    </a>

                    <div class="mt-4 flex items-start justify-between">
                        <div>
                            <p class="text-sm text-ivory">{{ $perfume->name }}</p>
                            <p class="text-xs text-smoke">{{ $perfume->brand }}</p>
                        </div>
                        <p class="text-sm text-amber-light">${{ number_format($perfume->display_price, 2) }}</p>
                    </div>
                </article>
            @empty
                @for ($i = 0; $i < 4; $i++)
                    <div class="skeleton aspect-[3/4]"></div>
                @endfor
            @endforelse
        </div>
    </div>
</section>

{{-- =================== CATEGORIES =================== --}}
<section id="categories" class="px-6 py-28 lg:px-10">
    <div class="mx-auto max-w-7xl">
        <p class="eyebrow mb-3" data-reveal>Explore</p>
        <h2 class="mb-14 font-display text-4xl font-light md:text-5xl" data-reveal>Shop by Category</h2>

        <div class="grid gap-6 md:grid-cols-3" data-reveal-stagger>
            @forelse ($categories as $category)
                <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="group relative block aspect-[4/5] overflow-hidden">
                    <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('assets/images/categories/placeholder.jpg') }}" alt="{{ $category->name }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-void/90 via-void/10 to-transparent"></div>
                    <p class="absolute bottom-6 left-6 font-display text-2xl font-light text-ivory">{{ $category->name }}</p>
                </a>
            @empty
                @for ($i = 0; $i < 3; $i++)
                    <div class="skeleton aspect-[4/5]"></div>
                @endfor
            @endforelse
        </div>
    </div>
</section>

{{-- =================== BRAND STORY =================== --}}
<section class="px-6 py-28 lg:px-10">
    <div class="mx-auto grid max-w-7xl items-center gap-16 lg:grid-cols-2">
        <div data-reveal-mask class="aspect-[4/5] w-full" style="clip-path: inset(0 0 100% 0)">
            <img src="{{ asset('assets/images/perfumes/atelier.jpg') }}" alt="The atelier" class="h-full w-full object-cover">
        </div>

        <div>
            <p class="eyebrow mb-3">Our Story</p>
            <h2 data-reveal-lines class="font-display text-4xl font-light leading-tight md:text-5xl">
                Composed by Hand, Worn for Life
            </h2>
            <p class="mt-6 max-w-md text-smoke" data-reveal>
                For three generations our perfumers have sourced the rarest naturals —
                Grasse jasmine, Mysore sandalwood, Calabrian bergamot — and blended them
                in small batches so every bottle carries the same quiet precision.
            </p>

            <div class="mt-10 flex gap-12" data-reveal>
                <div>
                    <p class="font-display text-4xl text-amber-light"><span data-counter="38">0</span>+</p>
                    <p class="mt-1 text-xs uppercase tracking-widest2 text-smoke">Signature Scents</p>
                </div>
                <div>
                    <p class="font-display text-4xl text-amber-light"><span data-counter="1962">0</span></p>
                    <p class="mt-1 text-xs uppercase tracking-widest2 text-smoke">Founded</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =================== SCENT RIBBON — scroll-scrubbed video =================== --}}
{{--
    Video file: place your perfume usage video at
    public/assets/video/perfume-showcase.mp4
    (see /public/assets/video/README.md). The scrub behaviour lives in
    resources/js/animations/video-scroll.js — DO NOT set autoplay/loop here,
    the scroll handler drives currentTime directly.
--}}
<section id="scent-ribbon">
    <div class="ribbon-sticky">
        <video muted playsinline preload="auto">
            <source src="{{ asset('assets/video/perfume-showcase.mp4') }}" type="video/mp4">
        </video>

        <div class="ribbon-caption" style="transform: translateY(20px)">
            <h3>Discover Your Signature</h3>
        </div>
        <div class="ribbon-caption" style="transform: translateY(20px)">
            <h3>Every Fragrance Tells a Story</h3>
        </div>
        <div class="ribbon-caption" style="transform: translateY(20px)">
            <h3>Leave a Lasting Impression</h3>
        </div>
        <div class="ribbon-caption" style="transform: translateY(20px)">
            <h3>Find Your Scent</h3>
        </div>
    </div>
</section>

{{-- =================== CTA =================== --}}
<section class="px-6 py-32 text-center lg:px-10">
    <p class="eyebrow mb-4" data-reveal>Ready When You Are</p>
    <h2 data-reveal-lines class="mx-auto max-w-2xl font-display text-4xl font-light leading-tight md:text-6xl">
        Find the Scent That Finds You
    </h2>
    <a href="{{ route('shop.index') }}" class="btn-primary mt-10 inline-flex" data-reveal data-magnetic>Shop the Collection</a>
</section>

@endsection
