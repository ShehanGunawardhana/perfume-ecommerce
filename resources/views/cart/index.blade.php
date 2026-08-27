@extends('layouts.app')
@section('title', 'Your Cart — ' . config('app.name'))

@section('content')
<section class="px-6 pt-32 pb-24 lg:px-10">
    <div class="mx-auto max-w-4xl">
        <h1 class="mb-12 font-display text-4xl font-light" data-reveal>Your Cart</h1>

        @if ($cart->items->isEmpty())
            <p class="text-smoke">Your cart is empty. <a href="{{ route('shop.index') }}" class="text-amber-light">Continue shopping →</a></p>
        @else
            <div class="divide-y divide-line border-y border-line" data-reveal-stagger>
                @foreach ($cart->items as $item)
                    <div class="flex items-center gap-6 py-6">
                        <img src="{{ $item->perfume->main_image ? asset('storage/' . $item->perfume->main_image) : asset('assets/images/perfumes/placeholder.jpg') }}" class="h-24 w-20 object-cover" alt="{{ $item->perfume->name }}">
                        <div class="flex-1">
                            <p class="text-ivory">{{ $item->perfume->name }}</p>
                            <p class="text-sm text-smoke">${{ number_format($item->perfume->display_price, 2) }}</p>
                        </div>
                        <form method="POST" action="{{ route('cart.update', $item->id) }}" class="flex items-center gap-2">
                            @csrf @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 border border-line bg-transparent px-2 py-2 text-center" onchange="this.form.submit()">
                        </form>
                        <p class="w-24 text-right text-amber-light">${{ number_format($item->subtotal, 2) }}</p>
                        <form method="POST" action="{{ route('cart.destroy', $item->id) }}">
                            @csrf @method('DELETE')
                            <button class="text-smoke hover:text-bordeaux" aria-label="Remove">&times;</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex items-center justify-between">
                <p class="text-lg">Total</p>
                <p class="font-display text-2xl text-amber-light">${{ number_format($cart->total, 2) }}</p>
            </div>

            <a href="{{ route('checkout.index') }}" class="btn-primary mt-8 inline-flex" data-magnetic>Proceed to Checkout</a>
        @endif
    </div>
</section>
@endsection
