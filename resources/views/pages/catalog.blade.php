@extends('layouts.site')

@section('title', 'Catalog — ZANEXT STORE')

@section('content')
    <section class="mx-auto max-w-7xl px-6 lg:px-10" x-data="{ filterOpen: false }">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-10">
            <div>
                <div class="text-xs tracking-[0.3em] text-primary font-semibold mb-3">CATALOG</div>
                <h1 class="font-display font-black text-4xl sm:text-5xl lg:text-6xl">All Sneakers</h1>
                <p class="text-muted-foreground mt-4 max-w-xl">
                    Discover {{ $allCount }}+ premium silhouettes curated from the world's boldest brands.
                </p>
            </div>
            <button @click="filterOpen = true" class="h-11 px-5 rounded-full border border-border bg-white/5 hover:bg-white/10 inline-flex items-center gap-2 text-sm self-start lg:self-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="21" x2="14" y1="4" y2="4"/><line x1="10" x2="3" y1="4" y2="4"/><line x1="21" x2="12" y1="12" y2="12"/><line x1="8" x2="3" y1="12" y2="12"/><line x1="21" x2="16" y1="20" y2="20"/><line x1="12" x2="3" y1="20" y2="20"/><line x1="14" x2="14" y1="2" y2="6"/><line x1="8" x2="8" y1="10" y2="14"/><line x1="16" x2="16" y1="18" y2="22"/></svg>
                Filter
            </button>
        </div>

        <form method="GET" action="{{ route('catalog') }}" class="grid lg:grid-cols-[1fr_auto] gap-3 mb-8">
            <input type="hidden" name="category" value="{{ $category }}">
            <input type="hidden" name="brand" value="{{ $brand }}">
            <input type="hidden" name="price" value="{{ $price }}">
            <input type="hidden" name="rating" value="{{ $minRating }}">

            <label class="h-12 px-4 rounded-full border border-border bg-card flex items-center gap-3 focus-within:border-primary transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                <input type="text" name="search" value="{{ $search }}" placeholder="Search by product, brand, category..." class="bg-transparent outline-none text-sm flex-1 placeholder:text-muted-foreground">
            </label>

            <label class="h-12 px-4 rounded-full border border-border bg-card flex items-center gap-3 min-w-56">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m21 16-4 4-4-4"/><path d="M17 20V4"/><path d="m3 8 4-4 4 4"/><path d="M7 4v16"/></svg>
                <select name="sort" onchange="this.form.submit()" class="bg-transparent outline-none text-sm flex-1">
                    <option class="bg-card" value="featured" @selected($sort === 'featured')>Featured</option>
                    <option class="bg-card" value="price-asc" @selected($sort === 'price-asc')>Price: Low to High</option>
                    <option class="bg-card" value="price-desc" @selected($sort === 'price-desc')>Price: High to Low</option>
                    <option class="bg-card" value="rating-desc" @selected($sort === 'rating-desc')>Highest Rated</option>
                    <option class="bg-card" value="name-asc" @selected($sort === 'name-asc')>Name A-Z</option>
                </select>
            </label>
        </form>

        <div class="flex gap-2 overflow-x-auto scrollbar-hide pb-2 mb-6">
            @foreach($categories as $c)
                <a href="{{ route('catalog', array_merge(request()->query(), ['category' => $c])) }}"
                   class="shrink-0 h-10 px-5 rounded-full text-sm font-medium transition-colors border flex items-center {{ $category === $c ? 'bg-primary text-primary-foreground border-primary' : 'bg-white/5 border-border text-muted-foreground hover:text-foreground' }}">
                    {{ $c }}
                </a>
            @endforeach
        </div>

        <div class="flex flex-wrap items-center justify-between gap-3 mb-10 text-sm text-muted-foreground">
            <div>
                Showing <span class="text-foreground font-semibold">{{ $products->count() }}</span> of {{ $allCount }} products
            </div>
            @if($category !== 'All' || $brand !== 'All' || $search || $price !== 'all' || $minRating > 0 || $sort !== 'featured')
                <a href="{{ route('catalog') }}" class="text-primary hover:text-primary-hover font-semibold">Reset filters</a>
            @endif
        </div>

        @if($products->count() > 0)
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @else
            <div class="py-20 text-center text-muted-foreground flex flex-col items-center gap-4 rounded-3xl border border-border bg-card">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                <div>
                    <p class="font-display font-bold text-foreground text-xl">No products found</p>
                    <p class="mt-2">Try another keyword, brand, category, or price range.</p>
                </div>
                <a href="{{ route('catalog') }}" class="h-10 px-5 rounded-full bg-primary text-primary-foreground text-sm font-semibold flex items-center">Reset filters</a>
            </div>
        @endif

        {{-- Filter drawer --}}
        <div x-show="filterOpen" x-transition.opacity class="fixed inset-0 z-50" style="display: none;">
            <button @click="filterOpen = false" class="absolute inset-0 bg-black/60 backdrop-blur-sm" aria-label="Close filters"></button>
            <aside class="absolute right-0 top-0 h-full w-full max-w-md bg-background border-l border-border p-6 overflow-y-auto animate-fade-up">
                <div class="flex items-center justify-between gap-4 mb-8">
                    <div>
                        <div class="text-xs tracking-[0.3em] text-primary font-semibold">FILTER</div>
                        <h2 class="font-display font-black text-3xl mt-2">Refine Results</h2>
                    </div>
                    <button @click="filterOpen = false" class="size-10 rounded-full border border-border grid place-items-center hover:bg-white/5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>

                <div class="mb-8">
                    <h3 class="font-display font-bold mb-3">Brand</h3>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach($brands as $b)
                            <a href="{{ route('catalog', array_merge(request()->query(), ['brand' => $b])) }}"
                               class="h-10 rounded-full border text-sm transition-colors flex items-center justify-center {{ $brand === $b ? 'bg-primary text-primary-foreground border-primary' : 'bg-card border-border text-muted-foreground hover:text-foreground' }}">
                                {{ $b }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="font-display font-bold mb-3">Price Range</h3>
                    <div class="space-y-2">
                        @foreach([['key' => 'all', 'label' => 'All prices'], ['key' => 'under-200', 'label' => 'Under $200'], ['key' => '200-250', 'label' => '$200 - $250'], ['key' => 'above-250', 'label' => 'Above $250']] as $range)
                            <a href="{{ route('catalog', array_merge(request()->query(), ['price' => $range['key']])) }}"
                               class="w-full h-11 px-4 rounded-xl border text-sm text-left transition-colors flex items-center {{ $price === $range['key'] ? 'bg-primary/10 border-primary text-foreground' : 'bg-card border-border text-muted-foreground hover:text-foreground' }}">
                                {{ $range['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="font-display font-bold mb-3">Minimum Rating</h3>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach([['label' => 'All', 'value' => 0], ['label' => '4.7+', 'value' => 4.7], ['label' => '4.8+', 'value' => 4.8]] as $rating)
                            <a href="{{ route('catalog', array_merge(request()->query(), ['rating' => $rating['value']])) }}"
                               class="h-10 rounded-full border text-sm transition-colors flex items-center justify-center {{ $minRating == $rating['value'] ? 'bg-primary text-primary-foreground border-primary' : 'bg-card border-border text-muted-foreground hover:text-foreground' }}">
                                {{ $rating['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 pt-4">
                    <a href="{{ route('catalog') }}" class="h-12 rounded-full border border-border bg-white/5 text-sm font-semibold hover:bg-white/10 flex items-center justify-center">Reset</a>
                    <button @click="filterOpen = false" class="h-12 rounded-full bg-primary text-primary-foreground text-sm font-semibold hover:bg-primary-hover">Show {{ $products->count() }} items</button>
                </div>
            </aside>
        </div>
    </section>
@endsection
