@extends('layouts.site')
@section('title', 'FAQ — ZANEXT STORE')

@section('content')
    <section class="mx-auto max-w-3xl px-6 lg:px-10">
        <div class="text-xs tracking-[0.3em] text-primary font-semibold mb-3">FAQ</div>
        <h1 class="font-display font-black text-5xl lg:text-6xl">Questions, answered.</h1>

        <div class="mt-12 space-y-3">
            @foreach([
                ['q' => 'How long does shipping take?', 'a' => 'Standard shipping is 2-5 business days within Indonesia. International orders take 7-14 days.'],
                ['q' => 'Are products authentic?', 'a' => 'Yes. Every item is verified by our authentication experts before being shipped.'],
                ['q' => 'How do returns work?', 'a' => 'You have 30 days to return unused items with original packaging. Returns are free for ZANEXT members.'],
                ['q' => 'When do new drops launch?', 'a' => 'Drops happen every Thursday at 10 AM WIB. Members get 24-hour early access.'],
                ['q' => 'Do you ship internationally?', 'a' => 'Yes, we ship to most countries. Shipping fees and tax vary by location.'],
            ] as $i => $faq)
                <div x-data="{ open: false }" class="rounded-2xl border border-border bg-card overflow-hidden">
                    <button @click="open = !open" class="w-full flex items-center justify-between gap-4 p-5 text-left hover:bg-white/[0.02]">
                        <span class="font-display font-semibold">{{ $faq['q'] }}</span>
                        <span x-text="open ? '−' : '+'" class="text-primary text-xl"></span>
                    </button>
                    <div x-show="open" x-collapse class="px-5 pb-5 text-sm text-muted-foreground" style="display: none;">{{ $faq['a'] }}</div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
