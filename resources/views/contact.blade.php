@extends('layouts.app')
@section('title', 'Contact — ' . config('app.name'))

@section('content')
<section class="px-6 pt-32 pb-24 lg:px-10">
    <div class="mx-auto max-w-2xl">
        <h1 class="mb-4 font-display text-4xl font-light" data-reveal>Get in Touch</h1>
        <p class="mb-12 text-smoke" data-reveal>Questions about a fragrance, an order, or a collaboration — we read every message.</p>

        <form method="POST" action="{{ route('contact.store') }}" class="space-y-5" data-reveal>
            @csrf
            <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required class="w-full border border-line bg-transparent px-4 py-3 text-sm">
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required class="w-full border border-line bg-transparent px-4 py-3 text-sm">
            <input type="text" name="subject" placeholder="Subject" value="{{ old('subject') }}" class="w-full border border-line bg-transparent px-4 py-3 text-sm">
            <textarea name="message" placeholder="Message" rows="5" required class="w-full border border-line bg-transparent px-4 py-3 text-sm">{{ old('message') }}</textarea>

            @if (session('success'))
                <p class="text-sm text-amber-light">{{ session('success') }}</p>
            @endif

            <button type="submit" class="btn-primary" data-magnetic>Send Message</button>
        </form>
    </div>
</section>
@endsection
