@extends('layouts.app')
@section('title', 'Checkout — ' . config('app.name'))

@section('content')
<section class="px-6 pt-32 pb-24 lg:px-10">
    <div class="mx-auto grid max-w-5xl gap-16 lg:grid-cols-2">
        <div data-reveal>
            <h1 class="mb-8 font-display text-4xl font-light">Checkout</h1>

            <form method="POST" action="{{ route('checkout.store') }}" class="space-y-5">
                @csrf
                <input type="text" name="customer_name" placeholder="Full Name" value="{{ old('customer_name', auth()->user()->name ?? '') }}" required class="w-full border border-line bg-transparent px-4 py-3 text-sm">
                <input type="email" name="customer_email" placeholder="Email" value="{{ old('customer_email', auth()->user()->email ?? '') }}" required class="w-full border border-line bg-transparent px-4 py-3 text-sm">
                <input type="text" name="customer_phone" placeholder="Phone" value="{{ old('customer_phone') }}" required class="w-full border border-line bg-transparent px-4 py-3 text-sm">
                <textarea name="shipping_address" placeholder="Shipping Address" required rows="3" class="w-full border border-line bg-transparent px-4 py-3 text-sm">{{ old('shipping_address') }}</textarea>
                <div class="flex gap-4">
                    <input type="text" name="shipping_city" placeholder="City" value="{{ old('shipping_city') }}" required class="w-full border border-line bg-transparent px-4 py-3 text-sm">
                    <input type="text" name="shipping_postal_code" placeholder="Postal Code" value="{{ old('shipping_postal_code') }}" class="w-full border border-line bg-transparent px-4 py-3 text-sm">
                </div>

                <div class="border border-line px-4 py-3 text-sm text-smoke">Payment method: Cash on Delivery</div>

                @if ($errors->any())
                    <p class="text-sm text-bordeaux">{{ $errors->first() }}</p>
                @endif

                <button type="submit" class="btn-primary w-full" data-magnetic>Place Order</button>
            </form>
        </div>

        <div data-reveal>
            <p class="eyebrow mb-4">Order Summary</p>
            <div class="divide-y divide-line border-y border-line">
                @foreach ($cart->items as $item)
                    <div class="flex justify-between py-3 text-sm">
                        <span>{{ $item->perfume->name }} × {{ $item->quantity }}</span>
                        <span class="text-amber-light">${{ number_format($item->subtotal, 2) }}</span>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 flex justify-between text-lg">
                <span>Total</span>
                <span class="text-amber-light">${{ number_format($cart->total, 2) }}</span>
            </div>
        </div>
    </div>
</section>
@endsection
