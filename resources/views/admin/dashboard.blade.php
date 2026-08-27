@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')
<h1 class="mb-8 font-display text-3xl font-light">Dashboard</h1>

<div class="mb-12 grid grid-cols-2 gap-6 lg:grid-cols-4">
    <div class="border border-line px-6 py-5">
        <p class="text-xs uppercase tracking-widest2 text-smoke">Customers</p>
        <p class="mt-2 font-display text-3xl"><span data-counter="{{ $stats['customers'] }}">0</span></p>
    </div>
    <div class="border border-line px-6 py-5">
        <p class="text-xs uppercase tracking-widest2 text-smoke">Orders</p>
        <p class="mt-2 font-display text-3xl"><span data-counter="{{ $stats['orders'] }}">0</span></p>
    </div>
    <div class="border border-line px-6 py-5">
        <p class="text-xs uppercase tracking-widest2 text-smoke">Products</p>
        <p class="mt-2 font-display text-3xl"><span data-counter="{{ $stats['products'] }}">0</span></p>
    </div>
    <div class="border border-line px-6 py-5">
        <p class="text-xs uppercase tracking-widest2 text-smoke">Low Stock</p>
        <p class="mt-2 font-display text-3xl text-bordeaux"><span data-counter="{{ $stats['low_stock'] }}">0</span></p>
    </div>
</div>

<div class="grid gap-10 lg:grid-cols-2">
    <div>
        <h2 class="mb-4 text-lg">Recent Orders</h2>
        <div class="divide-y divide-line border-y border-line">
            @forelse ($recentOrders as $order)
                <a href="{{ route('admin.orders.show', $order) }}" class="flex justify-between py-3 text-sm hover:text-amber-light">
                    <span>{{ $order->order_number }}</span>
                    <span>{{ $order->status }}</span>
                </a>
            @empty
                <p class="py-4 text-sm text-smoke">No orders yet.</p>
            @endforelse
        </div>
    </div>
    <div>
        <h2 class="mb-4 text-lg">Low Stock</h2>
        <div class="divide-y divide-line border-y border-line">
            @forelse ($lowStockPerfumes as $perfume)
                <div class="flex justify-between py-3 text-sm">
                    <span>{{ $perfume->name }}</span>
                    <span class="text-bordeaux">{{ $perfume->stock }} left</span>
                </div>
            @empty
                <p class="py-4 text-sm text-smoke">Stock levels look healthy.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
