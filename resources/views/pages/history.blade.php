@extends('layouts.site')
@section('title', 'Order History — ZANEXT STORE')

@section('content')
    <section class="mx-auto max-w-6xl px-6 lg:px-10">
        <h1 class="font-display font-black text-4xl lg:text-5xl">Transaction History</h1>
        <p class="text-muted-foreground mt-3">All of your past purchases on ZANEXT.</p>

        @php
            $statusStyles = ['Delivered' => 'bg-success/10 text-success', 'Shipped' => 'bg-primary/10 text-primary', 'Processing' => 'bg-white/10 text-muted-foreground'];
        @endphp

        <div class="mt-12 rounded-2xl border border-border bg-card overflow-hidden">
            <div class="hidden sm:grid grid-cols-12 px-6 py-4 text-xs uppercase tracking-widest text-muted-foreground border-b border-border">
                <div class="col-span-3">Order ID</div>
                <div class="col-span-4">Product</div>
                <div class="col-span-2">Date</div>
                <div class="col-span-1 text-right">Amount</div>
                <div class="col-span-2 text-right">Status</div>
            </div>
            @forelse($transactions as $t)
                <div class="grid grid-cols-2 sm:grid-cols-12 px-6 py-5 gap-y-2 border-b border-border last:border-0 hover:bg-white/[0.02]">
                    <div class="sm:col-span-3 font-mono text-sm">{{ $t->id }}</div>
                    <div class="sm:col-span-4 font-display font-semibold">{{ $t->product }}</div>
                    <div class="sm:col-span-2 text-sm text-muted-foreground">{{ $t->date }}</div>
                    <div class="sm:col-span-1 sm:text-right font-display font-bold">${{ $t->amount }}</div>
                    <div class="sm:col-span-2 sm:text-right">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusStyles[$t->status] ?? 'bg-white/10 text-muted-foreground' }}">{{ $t->status }}</span>
                    </div>
                </div>
            @empty
                <div class="p-10 text-center text-muted-foreground">No transactions yet.</div>
            @endforelse
        </div>
    </section>
@endsection
