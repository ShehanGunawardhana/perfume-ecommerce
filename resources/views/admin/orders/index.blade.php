@extends('admin.layout')
@section('title', 'Orders')

@section('content')
<h1 class="mb-8 font-display text-3xl font-light">Orders</h1>
<table class="w-full text-left text-sm">
    <thead class="border-b border-line text-smoke"><tr><th class="py-3">Order #</th><th>Customer</th><th>Total</th><th>Status</th><th>Date</th></tr></thead>
    <tbody class="divide-y divide-line">
        @foreach ($orders as $order)
            <tr>
                <td class="py-3"><a href="{{ route('admin.orders.show', $order) }}" class="text-amber-light">{{ $order->order_number }}</a></td>
                <td>{{ $order->customer_name }}</td>
                <td>${{ number_format($order->total, 2) }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at->format('M d, Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-8">{{ $orders->links() }}</div>
@endsection
