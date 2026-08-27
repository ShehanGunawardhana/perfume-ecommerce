@extends('layouts.app')
@section('title', 'Search — ' . config('app.name'))

@section('content')
<section class="px-6 pt-32 pb-24 lg:px-10">
    <div class="mx-auto max-w-7xl">
        <form method="GET" action="{{ route('search') }}" class="mb-14 max-w-xl">
            <input type="text" name="q" value="{{ $term }}" placeholder="Search perfumes, brands..." autofocus
                   class="w-full border-b border-line bg-transparent py-3 font-display text-2xl focus:outline-none">
        </form>

        @if ($term)
            <p class="mb-8 text-sm text-smoke">{{ $results->total() ?? 0 }} results for "{{ $term }}"</p>
            <div data-product-grid class="grid grid-cols-2 gap-6 md:grid-cols-4">
                @forelse ($results as $perfume)
                    <article class="product-card">
                        <a href="{{ route('shop.show', $perfume->slug) }}" class="product-media block aspect-[3/4]">
                            @if ($perfume->main_image)
                                <img src="{{ asset('storage/' . $perfume->main_image) }}" alt="{{ $perfume->name }}" loading="lazy">
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-surface">
                                    <span class="text-xs text-smoke">No Image</span>
                                </div>
                            @endif
                        </a>
                        <p class="mt-4 text-sm text-ivory">{{ $perfume->name }}</p>
                    </article>
                @empty
                    <div class="col-span-full">
                        <p class="text-smoke">No fragrances found. Try another name or brand.</p>
                    </div>
                @endforelse
            </div>
        @endif
    </div>
</section>
@endsection
