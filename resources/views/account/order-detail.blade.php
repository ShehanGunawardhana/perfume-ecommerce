@extends('layouts.app')
@section('title', 'Order ' . $order->order_number)

@section('content')
<section class="px-6 pt-32 pb-24 lg:px-10">
    <div class="mx-auto max-w-3xl">
        <h1 class="mb-2 font-display text-3xl font-light" data-reveal>{{ $order->order_number }}</h1>
        <p class="mb-10 text-xs uppercase tracking-widest2 text-amber-light">{{ $order->status }}</p>

        <div class="divide-y divide-line border-y border-line">
            @foreach ($order->items as $item)
                <div class="flex justify-between py-4 text-sm">
                    <span>{{ $item->perfume_name }} × {{ $item->quantity }}</span>
                    <span class="text-amber-light">${{ number_format($item->subtotal, 2) }}</span>
                </div>
            @endforeach
        </div>

        <div class="mt-4 flex justify-between text-lg">
            <span>Total</span>
            <span class="text-amber-light">${{ number_format($order->total, 2) }}</span>
        </div>

        <div class="mt-10 text-sm text-smoke">
            <p>{{ $order->customer_name }}</p>
            <p>{{ $order->shipping_address }}, {{ $order->shipping_city }}</p>
            <p>{{ $order->customer_phone }}</p>
        </div>
    </div>
</section>
@endsection
