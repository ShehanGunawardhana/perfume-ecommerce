@extends('admin.layout')
@section('title', 'Orders')

@section('content')
<h1 class="mb-8 font-display text-3xl font-light">Orders</h1>
<table class="w-full text-left text-sm">
    <thead class="border-b border-line text-smoke">
        <tr>
            <th class="px-4 py-3">Order #</th>
            <th class="px-4 py-3">Customer</th>
            <th class="px-4 py-3">Total</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Date</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-line">
        @foreach ($orders as $order)
            <tr class="hover:bg-white/5 transition-colors">
                <td class="px-4 py-3"><a href="{{ route('admin.orders.show', $order) }}" class="text-amber-light font-medium">{{ $order->order_number }}</a></td>
                <td class="px-4 py-3">{{ $order->customer_name }}</td>
                <td class="px-4 py-3">${{ number_format($order->total, 2) }}</td>
                <td class="px-4 py-3">
                    <span class="inline-block rounded px-2 py-1 text-xs 
                        {{ $order->status === 'pending' ? 'bg-amber-light/20 text-amber-light' : '' }}
                        {{ $order->status === 'delivered' ? 'bg-green-500/20 text-green-400' : '' }}
                        {{ $order->status === 'cancelled' ? 'bg-red-500/20 text-red-400' : '' }}
                        {{ !in_array($order->status, ['pending', 'delivered', 'cancelled']) ? 'bg-blue-500/20 text-blue-400' : '' }}
                    ">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-smoke">{{ $order->created_at->format('M d, Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-8">{{ $orders->links() }}</div>
@endsection
