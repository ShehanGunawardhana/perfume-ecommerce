<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-void text-ivory font-body">
    <div class="flex min-h-screen">
        <aside class="w-64 shrink-0 border-r border-line px-6 py-8">
            <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="Logo" class="mb-10 h-10 w-auto">
            <nav class="space-y-1 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="block rounded px-3 py-2 hover:bg-white/5 {{ request()->routeIs('admin.dashboard') ? 'text-amber-light' : 'text-ivory/80' }}">Dashboard</a>
                <a href="{{ route('admin.perfumes.index') }}" class="block rounded px-3 py-2 hover:bg-white/5 {{ request()->routeIs('admin.perfumes.*') ? 'text-amber-light' : 'text-ivory/80' }}">Perfumes</a>
                <a href="{{ route('admin.categories.index') }}" class="block rounded px-3 py-2 hover:bg-white/5 {{ request()->routeIs('admin.categories.*') ? 'text-amber-light' : 'text-ivory/80' }}">Categories</a>
                <a href="{{ route('admin.orders.index') }}" class="block rounded px-3 py-2 hover:bg-white/5 {{ request()->routeIs('admin.orders.*') ? 'text-amber-light' : 'text-ivory/80' }}">Orders</a>
                <a href="{{ route('admin.customers.index') }}" class="block rounded px-3 py-2 hover:bg-white/5 {{ request()->routeIs('admin.customers.*') ? 'text-amber-light' : 'text-ivory/80' }}">Customers</a>
            </nav>
            <form method="POST" action="{{ route('logout') }}" class="mt-10">
                @csrf
                <button class="text-sm text-smoke hover:text-ivory">Logout</button>
            </form>
        </aside>

        <main class="flex-1 px-10 py-8">
            @if (session('success'))
                <div class="mb-6 border border-amber/40 bg-amber/10 px-4 py-3 text-sm text-amber-light">{{ session('success') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
