@extends('layouts.app')
@section('title', $perfume->name . ' — ' . config('app.name'))

@section('content')
<section class="px-6 pt-32 pb-24 lg:px-10">
    <div class="mx-auto grid max-w-7xl gap-16 lg:grid-cols-2">
        <div>
            <div data-reveal-mask class="aspect-[3/4] w-full mb-4" style="clip-path: inset(0 0 100% 0)">
                @if ($perfume->main_image)
                    <img src="{{ asset('storage/' . $perfume->main_image) }}" alt="{{ $perfume->name }}" class="h-full w-full object-cover">
                @else
                    <div class="flex h-full w-full items-center justify-center bg-surface">
                        <span class="text-sm text-smoke">No Image</span>
                    </div>
                @endif
            </div>
            @if ($perfume->images->isNotEmpty())
                <div class="grid grid-cols-4 gap-4" data-reveal>
                    @foreach ($perfume->images as $img)
                        <div class="aspect-square bg-surface">
                            <img src="{{ asset('storage/' . $img->image_path) }}" alt="{{ $perfume->name }}" class="h-full w-full object-cover">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div data-reveal>
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
