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
                <li>+94 00 000 0000</li>
            </ul>
            <div class="mt-4 flex gap-4 text-ivory/70">
                <a href="#" class="hover:text-amber" aria-label="Instagram">IG</a>
                <a href="#" class="hover:text-amber" aria-label="TikTok">TT</a>
                <a href="#" class="hover:text-amber" aria-label="Pinterest">PT</a>
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
