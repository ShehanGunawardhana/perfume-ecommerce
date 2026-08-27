@extends('layouts.app')
@section('title', 'Shop — ' . config('app.name'))

@section('content')
<section class="px-6 pt-32 pb-24 lg:px-10">
    <div class="mx-auto max-w-7xl">
        <p class="eyebrow mb-3" data-reveal>Collection</p>
        <h1 class="mb-12 font-display text-4xl font-light md:text-5xl" data-reveal>Shop All Fragrances</h1>

        <div class="grid gap-10 lg:grid-cols-[240px_1fr]">
            {{-- Filters --}}
            <aside class="space-y-8">
                <form method="GET" action="{{ route('shop.index') }}" class="space-y-8">
                    <div>
                        <p class="eyebrow mb-3">Category</p>
                        <div class="space-y-2 text-sm">
                            @foreach ($categories as $category)
                                <label class="flex items-center gap-2 text-ivory/80">
                                    <input type="radio" name="category" value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'checked' : '' }} onchange="this.form.submit()">
                                    {{ $category->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <p class="eyebrow mb-3">Gender</p>
                        <div class="space-y-2 text-sm">
                            @foreach (['men' => 'Men', 'women' => 'Women', 'unisex' => 'Unisex'] as $value => $label)
                                <label class="flex items-center gap-2 text-ivory/80">
                                    <input type="radio" name="gender" value="{{ $value }}" {{ request('gender') == $value ? 'checked' : '' }} onchange="this.form.submit()">
                                    {{ $label }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <p class="eyebrow mb-3">Price</p>
                        <div class="flex gap-2">
                            <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}" class="w-full border border-line bg-transparent px-3 py-2 text-sm">
                            <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}" class="w-full border border-line bg-transparent px-3 py-2 text-sm">
                        </div>
                        <button class="btn-ghost mt-3 border border-line text-xs">Apply</button>
                    </div>
                </form>
            </aside>

            {{-- Results --}}
            <div>
                <div class="mb-6 flex items-center justify-between">
                    <p class="text-sm text-smoke">{{ $perfumes->total() }} fragrances</p>
                    <form method="GET">
                        @foreach (request()->except('sort') as $k => $v)
                            <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                        @endforeach
                        <select name="sort" onchange="this.form.submit()" class="border border-line bg-void px-3 py-2 text-sm">
                            <option value="">Newest</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popular</option>
                        </select>
                    </form>
                </div>

                <div data-product-grid class="grid grid-cols-2 gap-6 md:grid-cols-3">
                    @forelse ($perfumes as $perfume)
                        <article class="product-card">
                            <a href="{{ route('shop.show', $perfume->slug) }}" class="product-media block aspect-[3/4]">
                                @if ($perfume->main_image)
                                    <img src="{{ asset('storage/' . $perfume->main_image) }}" alt="{{ $perfume->name }}" loading="lazy">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-surface">
                                        <span class="text-xs text-smoke">No Image</span>
                                    </div>
                                @endif
                                <div class="product-actions">
                                    <span class="text-xs uppercase tracking-widest2 text-ivory">View</span>
                                </div>
                            </a>
                            <div class="mt-4 flex items-start justify-between">
                                <div>
                                    <p class="text-sm text-ivory">{{ $perfume->name }}</p>
                                    <p class="text-xs text-smoke">{{ $perfume->brand }}</p>
                                </div>
                                <div class="text-right">
                            <p class="text-sm text-amber-light">${{ number_format($perfume->display_price, 2) }}</p>
                            @auth
                                <form method="POST" action="{{ route('wishlist.store', $perfume) }}" class="mt-1 inline-block">
                                    @csrf
                                    <button class="text-xs text-smoke hover:text-bordeaux" title="Add to Wishlist">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                    </button>
                                </form>
                            @endauth
                        </div>
                            </div>
                        </article>
                    @empty
                        <p class="col-span-full text-smoke">No fragrances match those filters yet.</p>
                    @endforelse
                </div>

                <div class="mt-12">{{ $perfumes->links() }}</div>
            </div>
        </div>
    </div>
</section>
@endsection
