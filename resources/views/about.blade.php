@extends('layouts.app')
@section('title', 'About — ' . config('app.name'))

@section('content')
<section class="px-6 pt-32 pb-24 lg:px-10">
    <div class="mx-auto max-w-4xl text-center">
        <p class="eyebrow mb-4" data-reveal>Since 1962</p>
        <h1 data-reveal-lines class="font-display text-5xl font-light leading-tight md:text-6xl">
            A House Built on Patience
        </h1>
        <p class="mx-auto mt-8 max-w-2xl text-smoke" data-reveal>
            We believe a fragrance should be composed, not manufactured — every formula
            is refined for months before it ever reaches a bottle.
        </p>
    </div>

    <div class="mx-auto mt-24 grid max-w-5xl gap-16 lg:grid-cols-2">
        <div data-reveal-mask class="aspect-square w-full" style="clip-path: inset(0 0 100% 0)">
            <img src="{{ asset('assets/images/perfumes/atelier.jpg') }}" alt="Our mission" class="h-full w-full object-cover">
        </div>
        <div data-reveal class="flex flex-col justify-center">
            <p class="eyebrow mb-3">Our Mission</p>
            <p class="text-ivory/80">To keep fine perfumery honest: real materials, real time, no shortcuts.</p>
            <p class="eyebrow mb-3 mt-8">Our Vision</p>
            <p class="text-ivory/80">A bottle on every vanity that was chosen, not just bought.</p>
        </div>
    </div>
</section>
@endsection
