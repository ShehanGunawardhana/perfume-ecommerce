@extends('admin.layout')
@section('title', 'Perfumes')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <h1 class="font-display text-3xl font-light">Perfumes</h1>
    <a href="{{ route('admin.perfumes.create') }}" class="btn-primary">Add Perfume</a>
</div>

<table class="w-full text-left text-sm">
    <thead class="border-b border-line text-smoke">
        <tr><th class="py-3">Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Status</th><th></th></tr>
    </thead>
    <tbody class="divide-y divide-line">
        @foreach ($perfumes as $perfume)
            <tr>
                <td class="py-3">{{ $perfume->name }}</td>
                <td>{{ $perfume->category->name ?? '—' }}</td>
                <td>${{ number_format($perfume->price, 2) }}</td>
                <td>{{ $perfume->stock }}</td>
                <td>{{ $perfume->is_active ? 'Active' : 'Hidden' }}</td>
                <td class="space-x-3 text-right">
                    <a href="{{ route('admin.perfumes.edit', $perfume) }}" class="text-amber-light">Edit</a>
                    <form method="POST" action="{{ route('admin.perfumes.destroy', $perfume) }}" class="inline" onsubmit="return confirm('Delete this perfume?')">
                        @csrf @method('DELETE')
                        <button class="text-bordeaux">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-8">{{ $perfumes->links() }}</div>
@endsection
