<nav id="site-nav" x-data="{ 
    open: false, 
    searchOpen: false, 
    query: '', 
    results: [], 
    isLoading: false,
    fetchResults() {
        if (this.query.length < 2) {
            this.results = [];
            return;
        }
        this.isLoading = true;
        fetch('{{ route('search') }}?q=' + encodeURIComponent(this.query), {
            headers: { 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            this.results = data.items || [];
            this.isLoading = false;
        });
    }
}" @keydown.escape.window="searchOpen = false">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 lg:px-10">

        {{-- Logo — see /public/assets/images/logo/README.md for exact filenames --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3" data-magnetic>
            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="{{ config('app.name') }}" class="h-12 w-auto">
        </a>

        <div class="hidden items-center gap-9 lg:flex">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('shop.index') }}" class="nav-link {{ request()->routeIs('shop.*') ? 'active' : '' }}">Shop</a>
            <a href="{{ route('shop.index') }}#categories" class="nav-link">Categories</a>
            <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <a href="{{ route('contact.index') }}" class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}">Contact</a>
        </div>

        <div class="flex items-center gap-5">
            <a href="{{ route('search') }}" @click.prevent="searchOpen = true; $nextTick(() => $refs.searchInput.focus())" aria-label="Search" data-magnetic>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
            </a>

            @auth
                <a href="{{ route('wishlist.index') }}" aria-label="Wishlist" data-magnetic>
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </a>
            @endauth

            <a href="{{ route('cart.index') }}" aria-label="Cart" data-magnetic>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.981-4.706 2.57-7.19a1.125 1.125 0 00-1.1-1.36H5.25M7.5 14.25L5.106 5.272M7.5 14.25L5.25 14.25m0 0L4.5 6"/></svg>
            </a>

            @auth
                <a href="{{ route('orders.index') }}" aria-label="Account" data-magnetic>
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0"/></svg>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="nav-link">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-link">Login</a>
            @endauth

            <button @click="open = !open" class="lg:hidden" aria-label="Menu">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/></svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="open" x-transition x-cloak class="border-t border-line bg-void px-6 py-6 lg:hidden">
        <div class="flex flex-col gap-4">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
            <a href="{{ route('shop.index') }}" class="nav-link">Shop</a>
            <a href="{{ route('about') }}" class="nav-link">About</a>
            <a href="{{ route('contact.index') }}" class="nav-link">Contact</a>
        </div>
    </div>

    {{-- Search Overlay --}}
    <div x-show="searchOpen" x-transition x-cloak class="absolute inset-x-0 top-full border-t border-line bg-void px-6 py-8 shadow-2xl lg:px-10 z-50">
        <div class="mx-auto max-w-5xl relative">
            <button @click="searchOpen = false; query = ''; results = []" class="absolute right-0 top-0 p-2 text-smoke hover:text-ivory">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <input x-ref="searchInput" x-model.debounce.300ms="query" @input="fetchResults()" type="text" placeholder="Search for perfumes, brands..." class="w-full border-b border-line bg-transparent pb-4 pt-2 font-display text-2xl lg:text-3xl focus:outline-none placeholder:text-smoke/30">
            
            <div class="mt-8 min-h-[150px]">
                <div x-show="isLoading" class="text-sm text-smoke">Searching...</div>
                
                <div x-show="!isLoading && results.length > 0" class="grid grid-cols-2 gap-6 md:grid-cols-4">
                    <template x-for="perfume in results" :key="perfume.id">
                        <a :href="perfume.url" class="group block">
                            <div class="aspect-[3/4] overflow-hidden bg-surface">
                                <img :src="perfume.image" :alt="perfume.name" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            </div>
                            <p class="mt-3 text-sm text-ivory" x-text="perfume.name"></p>
                            <p class="text-xs text-smoke" x-text="perfume.brand"></p>
                        </a>
                    </template>
                </div>
                
                <div x-show="!isLoading && query.length >= 2 && results.length === 0" class="text-sm text-smoke">
                    No results found for "<span x-text="query"></span>".
                </div>
                
                <div x-show="!isLoading && query.length < 2 && query.length > 0" class="text-sm text-smoke">
                    Type at least 2 characters to search.
                </div>
            </div>
            
            <div class="mt-8 text-center" x-show="results.length > 0">
                <a :href="'{{ route('search') }}?q=' + encodeURIComponent(query)" class="text-xs uppercase tracking-widest text-ivory underline underline-offset-4 hover:text-white">View all results</a>
            </div>
        </div>
    </div>

    <span class="nav-progress"></span>
</nav>
