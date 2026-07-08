@extends('layouts.site')

@section('title', 'ZANEXT STORE — Step Beyond Limits')
@section('description', 'A futuristic marketplace for sneakers and streetwear. Premium drops, limited collaborations, and the boldest collections of 2026.')

@section('content')
    {{-- HERO --}}
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 grid-bg pointer-events-none"></div>
        <div class="mx-auto max-w-7xl px-6 lg:px-10 pt-10 pb-32 lg:pt-20 lg:pb-40 grid lg:grid-cols-12 gap-10 items-center relative">
            <div class="lg:col-span-6 space-y-8 animate-fade-up">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-border bg-white/5 text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3z"/></svg>
                    <span class="text-muted-foreground">New 2026 Spring Drop is live</span>
                </div>
                <h1 class="font-display font-black text-5xl sm:text-6xl lg:text-7xl xl:text-8xl leading-[0.95] tracking-tight text-balance">
                    Step Beyond <span class="gradient-text">Limits.</span>
                </h1>
                <p class="text-muted-foreground text-lg max-w-xl">
                    A curated marketplace of premium sneakers, techwear and streetwear from the world's boldest creators. Engineered for the future of fashion.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('catalog') }}" class="h-12 px-7 rounded-full bg-primary text-primary-foreground font-semibold text-sm flex items-center gap-2 hover:bg-primary-hover transition-colors glow-primary">
                        Shop Collection
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('articles.index') }}" class="h-12 px-7 rounded-full border border-border bg-white/5 hover:bg-white/10 font-semibold text-sm flex items-center gap-2 transition-colors">
                        Explore Stories
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M7 7h10v10"/><path d="M7 17 17 7"/></svg>
                    </a>
                </div>
                <div class="grid grid-cols-3 gap-6 pt-8 border-t border-border max-w-md">
                    @foreach([['v' => '1.2M+', 'l' => 'Members'], ['v' => '8K+', 'l' => 'Drops'], ['v' => '120+', 'l' => 'Brands']] as $stat)
                        <div>
                            <div class="font-display font-bold text-2xl">{{ $stat['v'] }}</div>
                            <div class="text-xs text-muted-foreground mt-1">{{ $stat['l'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-6 relative h-[420px] sm:h-[520px] lg:h-[640px]">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="absolute size-[80%] rounded-full bg-primary/30 blur-[120px]"></div>
                    <div class="absolute size-[55%] rounded-full bg-primary/40 blur-[60px]"></div>
                </div>
                <img src="{{ asset('assets/hero-sneaker.png') }}" alt="ZANEXT Phantom Flux sneaker" class="relative z-10 w-full h-full object-contain animate-float drop-shadow-[0_40px_60px_rgba(255,92,0,0.35)]">
                <div class="absolute bottom-6 left-6 z-20 glass rounded-2xl p-4 max-w-[200px]">
                    <div class="text-xs text-muted-foreground">Phantom Flux 01</div>
                    <div class="font-display font-bold text-lg mt-1">$249</div>
                    <div class="flex items-center gap-1 text-xs text-muted-foreground mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3 fill-primary text-primary" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        4.9 · 2.3k reviews
                    </div>
                </div>
                <div class="absolute top-10 right-0 z-20 glass rounded-2xl px-4 py-3">
                    <div class="text-[10px] uppercase tracking-widest text-muted-foreground">Limited</div>
                    <div class="font-display font-bold text-sm">Only 124 pairs</div>
                </div>
            </div>
        </div>

        {{-- Brand marquee --}}
        <div class="border-y border-border bg-surface/50 overflow-hidden">
            <div class="flex gap-16 py-6 marquee whitespace-nowrap">
                @foreach(array_merge($brands, $brands) as $brand)
                    <span class="font-display font-bold text-2xl text-muted-foreground/60 tracking-widest">{{ $brand }}</span>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FEATURED --}}
    <section class="mx-auto max-w-7xl px-6 lg:px-10 mt-32">
        <div class="flex items-end justify-between gap-6 mb-10">
            <div>
                <div class="text-xs tracking-[0.3em] text-primary font-semibold mb-3">Featured Drops</div>
                <h2 class="font-display font-black text-3xl sm:text-4xl lg:text-5xl text-balance">Most-wanted this week</h2>
            </div>
            <a href="{{ route('catalog') }}" class="text-sm text-muted-foreground hover:text-primary inline-flex items-center gap-1">
                View all
                <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featured as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </section>

    {{-- CATEGORIES --}}
    <section class="mx-auto max-w-7xl px-6 lg:px-10 mt-32">
        <div class="flex items-end justify-between gap-6 mb-10">
            <div>
                <div class="text-xs tracking-[0.3em] text-primary font-semibold mb-3">Shop by Category</div>
                <h2 class="font-display font-black text-3xl sm:text-4xl lg:text-5xl text-balance">Built for every street.</h2>
            </div>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($categories as $cat)
                <a href="{{ route('catalog') }}?category={{ $cat['name'] }}" class="group relative aspect-[4/5] rounded-2xl overflow-hidden border border-border card-hover">
                    <img src="{{ asset('assets/' . $cat['image']) }}" alt="{{ $cat['name'] }}" loading="lazy" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-background via-background/30 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-6">
                        <div class="text-xs text-muted-foreground">{{ $cat['count'] }} products</div>
                        <div class="font-display font-bold text-2xl mt-1 flex items-center gap-2">
                            {{ $cat['name'] }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-primary opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M7 7h10v10"/><path d="M7 17 17 7"/></svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- COLLAB BANNER --}}
    <section class="mx-auto max-w-7xl px-6 lg:px-10 mt-32">
        <div class="relative overflow-hidden rounded-3xl border border-border bg-gradient-to-br from-surface via-surface to-background grid lg:grid-cols-2 min-h-[440px]">
            <div class="absolute -right-20 top-1/2 -translate-y-1/2 size-[500px] rounded-full bg-primary/20 blur-[120px] pointer-events-none"></div>
            <div class="p-10 lg:p-16 flex flex-col justify-center relative z-10 space-y-6">
                <div class="text-xs tracking-[0.3em] text-primary font-semibold">ZANEXT × AERO</div>
                <h2 class="font-display font-black text-4xl lg:text-5xl leading-tight">
                    The collab that<br>redefines streetwear.
                </h2>
                <p class="text-muted-foreground max-w-md">
                    A 12-piece capsule pushing the boundaries of techwear, runner silhouettes and bold orange detailing.
                </p>
                <div class="flex gap-3">
                    <a href="{{ route('catalog') }}" class="h-12 px-6 rounded-full bg-primary text-primary-foreground font-semibold text-sm flex items-center gap-2 hover:bg-primary-hover transition-colors">
                        Shop Capsule
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
            <div class="relative h-72 lg:h-auto">
                <img src="{{ asset('assets/lifestyle-1.jpg') }}" alt="Collaboration lookbook" loading="lazy" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-background via-background/40 to-transparent lg:bg-gradient-to-r lg:from-background lg:to-transparent"></div>
            </div>
        </div>
    </section>

    {{-- LATEST --}}
    <section class="mx-auto max-w-7xl px-6 lg:px-10 mt-32">
        <div class="flex items-end justify-between gap-6 mb-10">
            <div>
                <div class="text-xs tracking-[0.3em] text-primary font-semibold mb-3">Latest Collection</div>
                <h2 class="font-display font-black text-3xl sm:text-4xl lg:text-5xl text-balance">Fresh on the racks.</h2>
            </div>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($latest as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </section>

    {{-- PROMO STRIP --}}
    <section class="mx-auto max-w-7xl px-6 lg:px-10 mt-32">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @php
                $promos = [
                    ['icon' => 'truck', 't' => 'Free Shipping', 'd' => 'On orders over $150'],
                    ['icon' => 'shield', 't' => 'Authenticity', 'd' => 'Verified by experts'],
                    ['icon' => 'rotate', 't' => 'Easy Returns', 'd' => '30-day guarantee'],
                    ['icon' => 'sparkles', 't' => 'Member Drops', 'd' => 'Exclusive access'],
                ];
            @endphp
            @foreach($promos as $promo)
                <div class="rounded-2xl border border-border bg-card p-6 card-hover">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        @if($promo['icon'] === 'truck')
                            <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/>
                        @elseif($promo['icon'] === 'shield')
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/>
                        @elseif($promo['icon'] === 'rotate')
                            <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/>
                        @else
                            <path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3z"/>
                        @endif
                    </svg>
                    <div class="font-display font-semibold mt-4">{{ $promo['t'] }}</div>
                    <div class="text-sm text-muted-foreground mt-1">{{ $promo['d'] }}</div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ARTICLES --}}
    <section class="mx-auto max-w-7xl px-6 lg:px-10 mt-32">
        <div class="flex items-end justify-between gap-6 mb-10">
            <div>
                <div class="text-xs tracking-[0.3em] text-primary font-semibold mb-3">The Journal</div>
                <h2 class="font-display font-black text-3xl sm:text-4xl lg:text-5xl text-balance">Stories from the culture.</h2>
            </div>
            <a href="{{ route('articles.index') }}" class="text-sm text-muted-foreground hover:text-primary inline-flex items-center gap-1">
                All stories
                <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
        </div>
        <div class="grid lg:grid-cols-3 gap-6">
            @foreach($articles as $article)
                <a href="{{ route('articles.show', $article->id) }}" class="group rounded-2xl overflow-hidden bg-card border border-border card-hover">
                    <div class="aspect-[16/10] overflow-hidden">
                        <img src="{{ asset('assets/' . $article->image) }}" alt="{{ $article->title }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    </div>
                    <div class="p-6 space-y-3">
                        <div class="flex items-center gap-3 text-xs text-muted-foreground">
                            <span class="px-2 py-1 rounded-full bg-white/5 border border-border">{{ $article->category }}</span>
                            <span>{{ $article->date }}</span>
                        </div>
                        <h3 class="font-display font-semibold text-xl group-hover:text-primary transition-colors">{{ $article->title }}</h3>
                        <p class="text-sm text-muted-foreground">{{ $article->excerpt }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- TESTIMONIALS --}}
    <section class="mx-auto max-w-7xl px-6 lg:px-10 mt-32">
        <div class="flex items-end justify-between gap-6 mb-10">
            <div>
                <div class="text-xs tracking-[0.3em] text-primary font-semibold mb-3">Loved by the community</div>
                <h2 class="font-display font-black text-3xl sm:text-4xl lg:text-5xl text-balance">The voices behind the culture.</h2>
            </div>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @php
                $testimonials = [
                    ['n' => 'Marcus L.', 'r' => "Sneakerhead since '08", 'q' => "ZANEXT changed how I shop. Premium curation, lightning fast, and the drops are unreal."],
                    ['n' => 'Yuki T.', 'r' => 'Tokyo, JP', 'q' => 'The Phantom Flux is hands-down the boldest silhouette of the year. Customer service is elite.'],
                    ['n' => 'Alex R.', 'r' => 'NYC', 'q' => 'Finally a marketplace that gets streetwear right. The journal alone is worth the visit.'],
                ];
            @endphp
            @foreach($testimonials as $t)
                <div class="rounded-2xl bg-card border border-border p-7 card-hover">
                    <div class="flex gap-1">
                        @for($i = 0; $i < 5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 fill-primary text-primary" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        @endfor
                    </div>
                    <p class="mt-5 text-foreground/90 leading-relaxed">"{{ $t['q'] }}"</p>
                    <div class="mt-6 flex items-center gap-3">
                        <div class="size-10 rounded-full bg-gradient-to-br from-primary to-primary-hover"></div>
                        <div>
                            <div class="font-semibold text-sm">{{ $t['n'] }}</div>
                            <div class="text-xs text-muted-foreground">{{ $t['r'] }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- NEWSLETTER --}}
    <section class="mx-auto max-w-7xl px-6 lg:px-10 mt-32">
        <div class="relative overflow-hidden rounded-3xl border border-border bg-card p-10 lg:p-16 text-center">
            <div class="absolute inset-0 grid-bg opacity-50 pointer-events-none"></div>
            <div class="absolute -top-20 left-1/2 -translate-x-1/2 size-[500px] rounded-full bg-primary/20 blur-[120px]"></div>
            <div class="relative space-y-6 max-w-2xl mx-auto">
                <div class="text-xs tracking-[0.3em] text-primary font-semibold">JOIN THE INSIDERS</div>
                <h2 class="font-display font-black text-4xl lg:text-5xl">Get the next drop first.</h2>
                <p class="text-muted-foreground">Early access, exclusive raffles, and members-only collections delivered to your inbox.</p>
                <form class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto pt-2">
                    <input type="email" required placeholder="Enter your email" class="flex-1 h-12 px-5 rounded-full bg-background/60 border border-border placeholder:text-muted-foreground text-sm focus:outline-none focus:border-primary transition-colors">
                    <button type="submit" class="h-12 px-7 rounded-full bg-primary text-primary-foreground font-semibold text-sm hover:bg-primary-hover transition-colors">Subscribe</button>
                </form>
            </div>
        </div>
    </section>
@endsection
