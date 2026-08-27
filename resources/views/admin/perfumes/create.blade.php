@extends('admin.layout')
@section('title', 'Add Perfume')

@section('content')
<h1 class="mb-8 font-display text-3xl font-light">Add Perfume</h1>
<form method="POST" action="{{ route('admin.perfumes.store') }}" enctype="multipart/form-data" class="max-w-2xl space-y-4">
    @include('admin.perfumes._form')
    <button type="submit" class="btn-primary">Save Perfume</button>
</form>
@endsection
