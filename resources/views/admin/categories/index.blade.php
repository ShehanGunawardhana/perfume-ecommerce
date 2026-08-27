@extends('admin.layout')
@section('title', 'Categories')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <h1 class="font-display text-3xl font-light">Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn-primary">Add Category</a>
</div>

<table class="w-full text-left text-sm">
    <thead class="border-b border-line text-smoke"><tr><th class="py-3">Name</th><th>Status</th><th></th></tr></thead>
    <tbody class="divide-y divide-line">
        @foreach ($categories as $category)
            <tr>
                <td class="py-3">{{ $category->name }}</td>
                <td>{{ $category->is_active ? 'Active' : 'Hidden' }}</td>
                <td class="space-x-3 text-right">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-amber-light">Edit</a>
                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline" onsubmit="return confirm('Delete this category?')">
                        @csrf @method('DELETE')
                        <button class="text-bordeaux">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-8">{{ $categories->links() }}</div>
@endsection
