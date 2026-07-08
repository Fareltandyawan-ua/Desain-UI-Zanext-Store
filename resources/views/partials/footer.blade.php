<footer class="border-t border-border mt-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-10 py-20">
        <div class="grid lg:grid-cols-12 gap-12">
            <div class="lg:col-span-5 space-y-6">
                <div class="flex items-center gap-2">
                    <div class="size-10 rounded-lg bg-primary grid place-items-center font-display font-black text-primary-foreground">Z</div>
                    <span class="font-display font-extrabold text-xl">ZANEXT<span class="text-primary">.</span></span>
                </div>
                <p class="text-muted-foreground max-w-md">
                    Step Beyond Limits. A futuristic marketplace for sneakers and streetwear engineered for the bold.
                </p>
                <div class="flex items-center gap-3">
                    @foreach(['instagram', 'twitter', 'youtube'] as $social)
                        <a href="#" class="size-10 rounded-full border border-border hover:border-primary hover:text-primary grid place-items-center transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                @if($social === 'instagram')
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                                @elseif($social === 'twitter')
                                    <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/>
                                @else
                                    <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/>
                                @endif
                            </svg>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-7 grid grid-cols-2 sm:grid-cols-3 gap-8 text-sm">
                <div class="space-y-3">
                    <h4 class="font-display font-semibold text-xs tracking-widest text-muted-foreground uppercase">Shop</h4>
                    <a href="{{ route('catalog') }}" class="block text-muted-foreground hover:text-foreground">Catalog</a>
                    <a href="{{ route('wishlist') }}" class="block text-muted-foreground hover:text-foreground">Wishlist</a>
                    <a href="{{ route('cart') }}" class="block text-muted-foreground hover:text-foreground">Cart</a>
                    <a href="{{ route('checkout') }}" class="block text-muted-foreground hover:text-foreground">Checkout</a>
                </div>
                <div class="space-y-3">
                    <h4 class="font-display font-semibold text-xs tracking-widest text-muted-foreground uppercase">Company</h4>
                    <a href="{{ route('about') }}" class="block text-muted-foreground hover:text-foreground">About</a>
                    <a href="{{ route('articles.index') }}" class="block text-muted-foreground hover:text-foreground">Stories</a>
                    <a href="{{ route('profile') }}" class="block text-muted-foreground hover:text-foreground">Profile</a>
                    <a href="{{ route('history') }}" class="block text-muted-foreground hover:text-foreground">Order History</a>
                </div>
                <div class="space-y-3">
                    <h4 class="font-display font-semibold text-xs tracking-widest text-muted-foreground uppercase">Support</h4>
                    <a href="{{ route('faq') }}" class="block text-muted-foreground hover:text-foreground">FAQ</a>
                    <a href="{{ route('faq') }}" class="block text-muted-foreground hover:text-foreground">Shipping</a>
                    <a href="{{ route('faq') }}" class="block text-muted-foreground hover:text-foreground">Returns</a>
                    <a href="{{ route('contact') }}" class="block text-muted-foreground hover:text-foreground">Contact</a>
                </div>
            </div>
        </div>

        <div class="mt-16 pt-8 border-t border-border flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-muted-foreground">
            <p>&copy; 2026 ZANEXT STORE. All rights reserved.</p>
            <div class="flex gap-6">
                <a class="hover:text-foreground">Privacy</a>
                <a class="hover:text-foreground">Terms</a>
                <a class="hover:text-foreground">Cookies</a>
            </div>
        </div>
    </div>
</footer>
