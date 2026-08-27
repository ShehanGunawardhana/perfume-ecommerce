@extends('admin.layout')
@section('title', 'Add Category')

@section('content')
<h1 class="mb-8 font-display text-3xl font-light">Add Category</h1>
<form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" class="max-w-xl space-y-4">
    @include('admin.categories._form')
    <button type="submit" class="btn-primary">Save Category</button>
</form>
@endsection
