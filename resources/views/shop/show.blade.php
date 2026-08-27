@extends('layouts.app')
@section('title', $perfume->name . ' — ' . config('app.name'))

@section('content')
<section class="px-6 pt-32 pb-24 lg:px-10">
    <div class="mx-auto grid max-w-7xl gap-16 lg:grid-cols-12">
        <div class="lg:col-span-5 max-w-md mx-auto w-full" x-data="{ 
            @php $allImages = collect([$perfume->main_image])->concat($perfume->images->pluck('image_path'))->filter()->values(); @endphp
            count: {{ $allImages->count() }},
            active: 0,
            interval: null,
            init() {
                if (this.count > 1) {
                    this.start();
                }
            },
            start() {
                this.interval = setInterval(() => {
                    this.active = (this.active + 1) % this.count;
                }, 7000);
            },
            stop() {
                if (this.interval) clearInterval(this.interval);
            },
            setActive(index) {
                this.active = index;
                this.stop();
                this.start();
            }
        }" @mouseenter="stop()" @mouseleave="start()">
            
            <div data-reveal-mask class="relative aspect-[4/5] w-full mb-6 bg-surface overflow-hidden rounded-2xl border border-line" style="clip-path: inset(0 0 100% 0)">
                @if ($allImages->isNotEmpty())
                    @foreach ($allImages as $index => $imgPath)
                        <img src="{{ asset('storage/' . $imgPath) }}" 
                             alt="{{ $perfume->name }}" 
                             class="absolute inset-0 h-full w-full object-cover transition-opacity duration-700 ease-in-out"
                             :class="active === {{ $index }} ? 'opacity-100 z-10' : 'opacity-0 z-0'">
                    @endforeach
                @else
                    <div class="flex h-full w-full items-center justify-center bg-surface">
                        <span class="text-sm text-smoke">No Image</span>
                    </div>
                @endif
            </div>

            @if ($allImages->count() > 1)
                <div class="grid grid-cols-4 gap-4" data-reveal>
                    @foreach ($allImages as $index => $imgPath)
                        <button @click="setActive({{ $index }})" 
                                class="aspect-[4/5] bg-surface overflow-hidden rounded-xl border-2 transition-colors duration-300" 
                                :class="active === {{ $index }} ? 'border-amber-light' : 'border-transparent hover:border-line'">
                            <img src="{{ asset('storage/' . $imgPath) }}" alt="Thumbnail" class="h-full w-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="lg:col-span-7" data-reveal>
            <p class="eyebrow mb-3">{{ $perfume->category->name ?? '' }}</p>
            <h1 class="font-display text-4xl font-light md:text-5xl">{{ $perfume->name }}</h1>
            <p class="mt-2 text-smoke">{{ $perfume->brand }}</p>

            <p class="mt-6 text-2xl text-amber-light">
                ${{ number_format($perfume->display_price, 2) }}
                @if ($perfume->is_on_sale)
                    <span class="ml-2 text-base text-smoke line-through">${{ number_format($perfume->price, 2) }}</span>
                @endif
            </p>

            <p class="mt-6 max-w-lg text-sm leading-relaxed text-ivory/80">{{ $perfume->description }}</p>

            <div class="mt-8 grid grid-cols-2 gap-4 text-sm text-smoke">
                <p><span class="text-ivory/70">Top notes:</span> {{ $perfume->top_notes }}</p>
                <p><span class="text-ivory/70">Heart notes:</span> {{ $perfume->middle_notes }}</p>
                <p><span class="text-ivory/70">Base notes:</span> {{ $perfume->base_notes }}</p>
                <p><span class="text-ivory/70">Concentration:</span> {{ $perfume->concentration }}</p>
                <p><span class="text-ivory/70">Volume:</span> {{ $perfume->volume }}</p>
                <p><span class="text-ivory/70">Family:</span> {{ $perfume->fragrance_family }}</p>
            </div>

            <form method="POST" action="{{ route('cart.store', $perfume) }}" class="mt-10 flex gap-4">
                @csrf
                <input type="number" name="quantity" value="1" min="1" class="w-20 border border-line bg-transparent px-3 py-3 text-center">
                <button type="submit" class="btn-primary" data-magnetic data-quick-action>
                    {{ $perfume->in_stock ? 'Add to Cart' : 'Out of Stock' }}
                </button>
            </form>

            @auth
                <form method="POST" action="{{ route('wishlist.store', $perfume) }}" class="mt-4">
                    @csrf
                    <button class="nav-link">Add to Wishlist</button>
                </form>
            @endauth
        </div>
    </div>

    @if ($related->isNotEmpty())
        <div class="mx-auto mt-28 max-w-7xl">
            <h2 class="mb-10 font-display text-3xl font-light" data-reveal>You May Also Like</h2>
            <div data-product-grid class="grid grid-cols-2 gap-6 md:grid-cols-4">
                @foreach ($related as $item)
                    <article class="product-card">
                        <a href="{{ route('shop.show', $item->slug) }}" class="product-media block aspect-[3/4]">
                            @if ($item->main_image)
                                <img src="{{ asset('storage/' . $item->main_image) }}" alt="{{ $item->name }}" loading="lazy">
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-surface">
                                    <span class="text-xs text-smoke">No Image</span>
                                </div>
                            @endif
                        </a>
                        <div class="mt-4 flex items-start justify-between">
                            <p class="text-sm text-ivory">{{ $item->name }}</p>
                            <p class="text-sm text-amber-light">${{ number_format($item->display_price, 2) }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection
