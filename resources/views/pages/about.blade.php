@extends('layouts.site')
@section('title', 'About — ZANEXT STORE')

@section('content')
    <section class="mx-auto max-w-5xl px-6 lg:px-10 text-center">
        <div class="text-xs tracking-[0.3em] text-primary font-semibold mb-3">ABOUT US</div>
        <h1 class="font-display font-black text-5xl lg:text-7xl">We don't just sell sneakers.<br><span class="gradient-text">We shape culture.</span></h1>
        <p class="text-muted-foreground mt-8 max-w-2xl mx-auto text-lg">
            ZANEXT is a futuristic marketplace built for sneakerheads, streetwear enthusiasts, and the bold creators redefining fashion in 2026 and beyond.
        </p>
    </section>

    <section class="mx-auto max-w-7xl px-6 lg:px-10 mt-32 grid lg:grid-cols-3 gap-6">
        @foreach([
            ['t' => 'Our Mission', 'd' => 'Curate the boldest drops from the world\'s most innovative brands and put them in the hands of the culture.'],
            ['t' => 'Our Promise', 'd' => 'Every product is verified by experts. Authenticity is non-negotiable. Speed and service are paramount.'],
            ['t' => 'Our Future', 'd' => 'Beyond commerce — we\'re building a community where street culture and high fashion converge.'],
        ] as $b)
            <div class="rounded-2xl border border-border bg-card p-8 card-hover">
                <h3 class="font-display font-bold text-2xl">{{ $b['t'] }}</h3>
                <p class="text-muted-foreground mt-3">{{ $b['d'] }}</p>
            </div>
        @endforeach
    </section>
@endsection
