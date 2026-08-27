@extends('admin.layout')
@section('title', 'Edit Perfume')

@section('content')
<h1 class="mb-8 font-display text-3xl font-light">Edit Perfume</h1>
<form method="POST" action="{{ route('admin.perfumes.update', $perfume) }}" enctype="multipart/form-data" class="max-w-2xl space-y-4">
    @csrf @method('PUT')
    @include('admin.perfumes._form')
    <button type="submit" class="btn-primary">Update Perfume</button>
</form>
@endsection
