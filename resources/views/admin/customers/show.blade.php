@extends('admin.layout')
@section('title', $customer->name)

@section('content')
<h1 class="mb-2 font-display text-3xl font-light">{{ $customer->name }}</h1>
<p class="mb-8 text-smoke">{{ $customer->email }} — {{ $customer->phone }}</p>

<h2 class="mb-4 text-lg">Order History</h2>
<table class="w-full text-left text-sm">
    <thead class="border-b border-line text-smoke"><tr><th class="py-3">Order #</th><th>Total</th><th>Status</th><th>Date</th></tr></thead>
    <tbody class="divide-y divide-line">
        @foreach ($orders as $order)
            <tr>
                <td class="py-3">{{ $order->order_number }}</td>
                <td>${{ number_format($order->total, 2) }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at->format('M d, Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
