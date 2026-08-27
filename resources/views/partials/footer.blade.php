<footer class="border-t border-line bg-void px-6 py-16 lg:px-10">
    <div class="mx-auto grid max-w-7xl gap-12 lg:grid-cols-4">
        <div>
            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="{{ config('app.name') }}" class="mb-4 h-10 w-auto">
            <p class="max-w-xs text-sm text-smoke">
                Rare ingredients, patient composition, and fragrances built to be remembered.
            </p>
        </div>

        <div>
            <p class="eyebrow mb-4">Quick Links</p>
            <ul class="space-y-2 text-sm text-ivory/80">
                <li><a href="{{ route('home') }}" class="hover:text-amber">Home</a></li>
                <li><a href="{{ route('shop.index') }}" class="hover:text-amber">Shop</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-amber">About</a></li>
                <li><a href="{{ route('contact.index') }}" class="hover:text-amber">Contact</a></li>
            </ul>
        </div>

        <div>
            <p class="eyebrow mb-4">Shop</p>
            <ul class="space-y-2 text-sm text-ivory/80">
                <li><a href="{{ route('shop.index', ['gender' => 'women']) }}" class="hover:text-amber">Women</a></li>
                <li><a href="{{ route('shop.index', ['gender' => 'men']) }}" class="hover:text-amber">Men</a></li>
                <li><a href="{{ route('shop.index', ['gender' => 'unisex']) }}" class="hover:text-amber">Unisex</a></li>
            </ul>
        </div>

        <div>
            <p class="eyebrow mb-4">Contact</p>
            <ul class="space-y-2 text-sm text-ivory/80">
                <li>hello@maisonnoir.example</li>
                <li>+94 71 541 5568</li>
            </ul>
            <div class="mt-4 flex gap-5 text-ivory/70">
                <a href="https://www.instagram.com/malintha_sh3han?igsi=aTRoODJqanJkOGds" class="hover:text-amber transition-colors" aria-label="Instagram">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
                <a href="https://www.tiktok.com/@malintha_sh3han?_r=1&_t=ZS-99EeQ15yfVV" class="hover:text-amber transition-colors" aria-label="TikTok">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 2.22-1.15 4.31-2.92 5.56-1.78 1.25-4.14 1.57-6.23.95-2.09-.62-3.79-2.31-4.44-4.38-.66-2.07-.22-4.47 1.15-6.19 1.36-1.72 3.52-2.58 5.71-2.28v4.14c-1.3-.18-2.67.24-3.5 1.16-.84.92-1.11 2.32-.69 3.51.42 1.19 1.52 2.06 2.78 2.19 1.26.12 2.58-.33 3.39-1.28.82-.95 1.12-2.3 1.09-3.57V.02z"/></svg>
                </a>
                <a href="https://www.facebook.com/share/1CeKFzDh3i/" class="hover:text-amber transition-colors" aria-label="Facebook">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
            </div>
        </div>
    </div>

    <div class="mx-auto mt-12 flex max-w-7xl flex-col items-center justify-between gap-4 border-t border-line pt-6 text-xs text-smoke lg:flex-row">
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        <button
            onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="btn-ghost border border-line"
            data-magnetic
        >
            Back to top
        </button>
    </div>
</footer>
