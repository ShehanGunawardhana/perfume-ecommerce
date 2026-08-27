@extends('layouts.app')
@section('title', 'Login — ' . config('app.name'))

@section('content')
<section class="flex min-h-screen items-center px-6 lg:px-10">
    <div class="mx-auto w-full max-w-md" data-reveal>
        <h1 class="mb-8 font-display text-4xl font-light">Welcome Back</h1>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <input type="email" name="email" placeholder="Email" required class="w-full border border-line bg-transparent px-4 py-3 text-sm">
            <input type="password" name="password" placeholder="Password" required class="w-full border border-line bg-transparent px-4 py-3 text-sm">
            <label class="flex items-center gap-2 text-sm text-smoke">
                <input type="checkbox" name="remember"> Remember me
            </label>

            @if ($errors->any())
                <p class="text-sm text-bordeaux">{{ $errors->first() }}</p>
            @endif

            <button type="submit" class="btn-primary w-full" data-magnetic>Login</button>
        </form>

        <p class="mt-6 text-sm text-smoke">
            New here? <a href="{{ route('register') }}" class="text-amber-light">Create an account</a>
        </p>
    </div>
</section>
@endsection
