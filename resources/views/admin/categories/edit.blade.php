@extends('admin.layout')
@section('title', 'Edit Category')

@section('content')
<h1 class="mb-8 font-display text-3xl font-light">Edit Category</h1>
<form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data" class="max-w-xl space-y-4">
    @csrf @method('PUT')
    @include('admin.categories._form')
    <button type="submit" class="btn-primary">Update Category</button>
</form>
@endsection
