@extends('layouts.app')
@section('title', 'My Orders — ' . config('app.name'))

@section('content')
<section class="px-6 pt-32 pb-24 lg:px-10">
    <div class="mx-auto max-w-4xl">
        <h1 class="mb-12 font-display text-4xl font-light" data-reveal>My Orders</h1>

        <div class="divide-y divide-line border-y border-line">
            @forelse ($orders as $order)
                <a href="{{ route('orders.show', $order) }}" class="flex items-center justify-between py-5 hover:text-amber-light">
                    <div>
                        <p>{{ $order->order_number }}</p>
                        <p class="text-xs text-smoke">{{ $order->created_at->format('M d, Y') }}</p>
                    </div>
                    <span class="text-xs uppercase tracking-widest2">{{ $order->status }}</span>
                    <p class="text-amber-light">${{ number_format($order->total, 2) }}</p>
                </a>
            @empty
                <p class="py-8 text-smoke">No orders yet.</p>
            @endforelse
        </div>

        <div class="mt-8">{{ $orders->links() }}</div>
    </div>
</section>
@endsection
