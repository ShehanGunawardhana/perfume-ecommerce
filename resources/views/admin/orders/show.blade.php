@extends('admin.layout')
@section('title', $order->order_number)

@section('content')
<h1 class="mb-2 font-display text-3xl font-light">{{ $order->order_number }}</h1>
<p class="mb-8 text-smoke">{{ $order->customer_name }} — {{ $order->customer_email }} — {{ $order->customer_phone }}</p>

<table class="w-full text-left text-sm">
    <thead class="border-b border-line text-smoke"><tr><th class="py-3">Item</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr></thead>
    <tbody class="divide-y divide-line">
        @foreach ($order->items as $item)
            <tr>
                <td class="py-3">{{ $item->perfume_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->price, 2) }}</td>
                <td>${{ number_format($item->subtotal, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<p class="mt-6 text-lg">Total: <span class="text-amber-light">${{ number_format($order->total, 2) }}</span></p>

<form method="POST" action="{{ route('admin.orders.update', $order) }}" class="mt-8 flex items-center gap-4">
    @csrf @method('PATCH')
    <select name="status" class="border border-line bg-void px-4 py-2 text-sm">
        @foreach (['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
            <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn-primary">Update Status</button>
</form>
