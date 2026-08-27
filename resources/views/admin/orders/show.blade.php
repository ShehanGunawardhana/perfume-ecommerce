@extends('admin.layout')
@section('title', $order->order_number)

@section('content')
<h1 class="mb-2 font-display text-3xl font-light">{{ $order->order_number }}</h1>
<p class="mb-8 text-smoke">{{ $order->customer_name }} — {{ $order->customer_email }} — {{ $order->customer_phone }}</p>

<table class="w-full text-left text-sm">
    <thead class="border-b border-line text-smoke">
        <tr>
            <th class="px-4 py-3">Item</th>
            <th class="px-4 py-3 text-center">Qty</th>
            <th class="px-4 py-3 text-right">Price</th>
            <th class="px-4 py-3 text-right">Subtotal</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-line">
        @foreach ($order->items as $item)
            <tr class="hover:bg-white/5 transition-colors">
                <td class="px-4 py-3 font-medium">{{ $item->perfume_name }}</td>
                <td class="px-4 py-3 text-center text-smoke">{{ $item->quantity }}</td>
                <td class="px-4 py-3 text-right text-smoke">${{ number_format($item->price, 2) }}</td>
                <td class="px-4 py-3 text-right">${{ number_format($item->subtotal, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<p class="mt-6 text-lg">Total: <span class="text-amber-light">${{ number_format($order->total, 2) }}</span></p>

<form method="POST" action="{{ route('admin.orders.update', $order) }}" class="mt-8 flex items-center gap-4">
    @csrf @method('PATCH')
    <select name="status" class="w-40 border border-line bg-void pl-4 pr-10 py-2 text-sm appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23F2E9E4%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E')] bg-no-repeat bg-[position:right_0.75rem_center] bg-[length:0.65em]">
        @foreach (['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
            <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn-primary">Update Status</button>
</form>
@endsection