@php
    $baseLinks = [
        ['url' => route('home'), 'label' => 'Home', 'active' => request()->routeIs('home')],
        ['url' => route('catalog'), 'label' => 'Catalog', 'active' => request()->routeIs('catalog')],
        ['url' => route('articles.index'), 'label' => 'Article', 'active' => request()->routeIs('articles.*')],
        ['url' => route('about'), 'label' => 'About', 'active' => request()->routeIs('about')],
    ];
    $user = auth()->user();
    if ($user && $user->isAdmin()) {
        $baseLinks[] = ['url' => route('dashboard.index'), 'label' => 'Dashboard', 'active' => request()->routeIs('dashboard.*')];
    }
    $cartCount = collect(session('cart', []))->sum('qty');
@endphp

<header
    x-data="{ scrolled: false, open: false, menu: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
    :class="scrolled ? 'bg-background/70 backdrop-blur-xl border-b border-border' : 'bg-transparent'"
    class="fixed top-0 inset-x-0 z-50 transition-all duration-500"
>
    <div class="mx-auto max-w-7xl px-6 lg:px-10 h-18 flex items-center justify-between py-4">
        <a href="{{ route('home') }}" class="flex items-center gap-2 group">
            <div class="size-9 rounded-lg bg-primary grid place-items-center font-display font-black text-primary-foreground glow-primary">Z</div>
            <span class="font-display font-extrabold tracking-tight text-lg">ZANEXT<span class="text-primary">.</span></span>
        </a>

        <nav class="hidden lg:flex items-center gap-1">
            @foreach($baseLinks as $link)
                <a href="{{ $link['url'] }}" class="px-4 py-2 rounded-full text-sm transition-colors {{ $link['active'] ? 'text-foreground bg-white/5' : 'text-muted-foreground hover:text-foreground' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="flex items-center gap-2">
            <button aria-label="Search" class="size-10 rounded-full hover:bg-white/5 grid place-items-center transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            </button>

            @auth
                <div class="relative" @click.outside="menu = false">
                    <button @click="menu = !menu" class="h-10 pl-2 pr-3 rounded-full bg-white/5 hover:bg-white/10 border border-border flex items-center gap-2 transition-colors">
                        <span class="size-6 rounded-full bg-primary text-primary-foreground grid place-items-center text-[11px] font-bold">{{ substr($user->name, 0, 1) }}</span>
                        <span class="text-xs font-medium hidden sm:inline">{{ explode(' ', $user->name)[0] }}</span>
                        @if($user->isAdmin())
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        @endif
                    </button>
                    <div x-show="menu" x-transition class="absolute right-0 mt-2 w-56 glass rounded-2xl p-2 border border-border z-50" style="display: none;">
                        <div class="px-3 py-2">
                            <p class="text-sm font-semibold">{{ $user->name }}</p>
                            <p class="text-xs text-muted-foreground truncate">{{ $user->email }}</p>
                            <span class="inline-block mt-1 text-[10px] uppercase tracking-widest text-primary">{{ $user->role }}</span>
                        </div>
                        <div class="h-px bg-border my-1"></div>
                        <a href="{{ route('profile') }}" class="block px-3 py-2 text-sm rounded-lg hover:bg-white/5">Profile</a>
                        <a href="{{ route('history') }}" class="block px-3 py-2 text-sm rounded-lg hover:bg-white/5">Order History</a>
                        @if($user->isAdmin())
                            <a href="{{ route('dashboard.index') }}" class="block px-3 py-2 text-sm rounded-lg hover:bg-white/5">Admin Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 text-sm rounded-lg hover:bg-white/5 flex items-center gap-2 text-destructive">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="h-10 px-3 rounded-full hover:bg-white/5 hidden sm:flex items-center gap-2 text-sm transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Sign in
                </a>
            @endauth

            <a href="{{ route('wishlist') }}" aria-label="Wishlist" class="size-10 rounded-full hover:bg-white/5 hidden sm:grid place-items-center transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            </a>

            <a href="{{ route('cart') }}" class="relative h-10 px-4 rounded-full bg-white/5 hover:bg-white/10 border border-border flex items-center gap-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                <span class="text-xs font-medium hidden sm:inline">Cart</span>
                @if($cartCount > 0)
                    <span class="absolute -top-1 -right-1 size-5 rounded-full bg-primary text-primary-foreground text-[10px] font-bold grid place-items-center">
                        {{ $cartCount > 9 ? '9+' : $cartCount }}
                    </span>
                @endif
            </a>
            <button @click="open = !open" aria-label="Menu" class="lg:hidden size-10 rounded-full hover:bg-white/5 grid place-items-center">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display: none;"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-transition class="lg:hidden border-t border-border bg-background/95 backdrop-blur-xl" style="display: none;">
        <nav class="px-6 py-4 flex flex-col">
            @foreach($baseLinks as $link)
                <a href="{{ $link['url'] }}" class="py-3 text-base text-muted-foreground hover:text-foreground">{{ $link['label'] }}</a>
            @endforeach
            <a href="{{ route('wishlist') }}" class="py-3 text-base text-muted-foreground hover:text-foreground">Wishlist</a>
            <a href="{{ route('contact') }}" class="py-3 text-base text-muted-foreground hover:text-foreground">Contact</a>
            @guest
                <a href="{{ route('login') }}" class="py-3 text-base text-primary font-semibold">Sign in / Register</a>
            @endguest
        </nav>
    </div>
</header>
