<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Maison de Parfum'))</title>
    <meta name="description" content="@yield('meta_description', 'A house of rare and lasting fragrances.')">

    {{-- Logo used as favicon — see /public/assets/images/logo/README.md for exact filenames --}}
    <link rel="icon" href="{{ asset('assets/images/logo/favicon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="overflow-hidden">

    {{-- Preloader, see resources/js/animations/loader.js --}}
    <div id="loader">
        <span class="loader-mark">MAISON&nbsp;&mdash;&nbsp;NOIR</span>
        <span class="loader-line"></span>
    </div>

    {{-- Custom cursor, see resources/js/animations/cursor.js --}}
    <div class="cursor-dot"></div>
    <div class="cursor-ring"></div>

    {{-- Flash messages consumed by resources/js/app.js to fire toasts --}}
    <div id="flash-data"
         @if (session('success')) data-success="{{ session('success') }}" @endif
         @if ($errors->any()) data-error="{{ $errors->first() }}" @endif
         class="hidden"></div>
    <div id="toast-root"></div>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
