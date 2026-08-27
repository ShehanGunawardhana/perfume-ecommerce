@extends('admin.layout')
@section('title', 'Customers')

@section('content')
<h1 class="mb-8 font-display text-3xl font-light">Customers</h1>
<table class="w-full text-left text-sm">
    <thead class="border-b border-line text-smoke"><tr><th class="py-3">Name</th><th>Email</th><th>Phone</th><th></th></tr></thead>
    <tbody class="divide-y divide-line">
        @foreach ($customers as $customer)
            <tr>
                <td class="py-3">{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone }}</td>
                <td class="text-right"><a href="{{ route('admin.customers.show', $customer) }}" class="text-amber-light">View</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-8">{{ $customers->links() }}</div>
@endsection
