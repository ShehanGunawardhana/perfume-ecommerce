@extends('layouts.app')
@section('title', 'Register — ' . config('app.name'))

@section('content')
<section class="flex min-h-screen items-center px-6 lg:px-10">
    <div class="mx-auto w-full max-w-md" data-reveal>
        <h1 class="mb-8 font-display text-4xl font-light">Create Account</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf
            <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required class="w-full border border-line bg-transparent px-4 py-3 text-sm">
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required class="w-full border border-line bg-transparent px-4 py-3 text-sm">
            <input type="text" name="phone" placeholder="Phone (optional)" value="{{ old('phone') }}" class="w-full border border-line bg-transparent px-4 py-3 text-sm">
            <input type="password" name="password" placeholder="Password" required class="w-full border border-line bg-transparent px-4 py-3 text-sm">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="w-full border border-line bg-transparent px-4 py-3 text-sm">

            @if ($errors->any())
                <p class="text-sm text-bordeaux">{{ $errors->first() }}</p>
            @endif

            <button type="submit" class="btn-primary w-full" data-magnetic>Create Account</button>
        </form>

        <p class="mt-6 text-sm text-smoke">
            Already have an account? <a href="{{ route('login') }}" class="text-amber-light">Login</a>
        </p>
    </div>
</section>
@endsection
