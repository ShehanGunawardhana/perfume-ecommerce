@extends('layouts.app')
@section('title', 'Wishlist — ' . config('app.name'))

@section('content')
<section class="px-6 pt-32 pb-24 lg:px-10">
    <div class="mx-auto max-w-7xl">
        <h1 class="mb-12 font-display text-4xl font-light" data-reveal>Your Wishlist</h1>

        <div data-product-grid class="grid grid-cols-2 gap-6 md:grid-cols-4">
            @forelse ($items as $item)
                <article class="product-card">
                    <a href="{{ route('shop.show', $item->perfume->slug) }}" class="product-media block aspect-[3/4]">
                        <img src="{{ $item->perfume->main_image ? asset('storage/' . $item->perfume->main_image) : asset('assets/images/perfumes/placeholder.jpg') }}" alt="{{ $item->perfume->name }}" loading="lazy">
                    </a>
                    <div class="mt-4 flex items-start justify-between">
                        <p class="text-sm text-ivory">{{ $item->perfume->name }}</p>
                        <form method="POST" action="{{ route('wishlist.destroy', $item->perfume) }}">
                            @csrf @method('DELETE')
                            <button class="text-xs text-smoke hover:text-bordeaux">Remove</button>
                        </form>
                    </div>
                </article>
            @empty
                <p class="col-span-full text-smoke">Nothing saved yet.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
