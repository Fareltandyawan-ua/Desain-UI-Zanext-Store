@extends('layouts.site')
@section('title', 'Wishlist — ZANEXT STORE')

@section('content')
    <section class="mx-auto max-w-7xl px-6 lg:px-10">
        <h1 class="font-display font-black text-4xl lg:text-5xl">Wishlist</h1>
        <p class="text-muted-foreground mt-3">{{ count($products) }} items saved for later.</p>

        @if(count($products) === 0)
            <div class="mt-16 rounded-3xl border border-border bg-card p-16 text-center">
                <p class="font-display font-bold text-2xl">Your wishlist is empty</p>
                <p class="text-muted-foreground mt-3">Browse the catalog and save your favorites.</p>
                <a href="{{ route('catalog') }}" class="inline-flex mt-8 h-12 px-7 rounded-full bg-primary text-primary-foreground font-semibold items-center gap-2">Browse Catalog</a>
            </div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-12">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @endif
    </section>
@endsection
