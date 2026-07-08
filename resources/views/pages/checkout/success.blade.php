@extends('layouts.site')
@section('title', 'Order Success — ZANEXT STORE')

@section('content')
    @php
        $shipping = $summary['shipping'] ?? [];
        $items = collect($summary['items'] ?? []);
        $total = $summary['total'] ?? null;
        $paymentMethod = strtoupper($summary['payment_method'] ?? 'CARD');
    @endphp

    <section class="mx-auto max-w-4xl px-6 lg:px-10 text-center">
        <div class="mx-auto size-20 rounded-3xl bg-success/10 text-success grid place-items-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
        </div>
        <div class="text-xs tracking-[0.3em] text-primary font-semibold mb-3">ORDER CONFIRMED</div>
        <h1 class="font-display font-black text-4xl lg:text-6xl">Your order is locked in.</h1>
        <p class="text-muted-foreground mt-5 text-lg">Thanks for shopping with ZANEXT. We are preparing your package and will send tracking updates soon.</p>

        <div class="mt-10 rounded-3xl border border-border bg-card p-6 text-left">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                <div>
                    <p class="text-xs text-muted-foreground">Order ID</p>
                    <p class="font-display font-bold text-xl">{{ $orderId }}</p>
                </div>
                @if($total !== null)
                    <div class="sm:text-right">
                        <p class="text-xs text-muted-foreground">Total</p>
                        <p class="font-display font-bold text-xl">${{ $total }}</p>
                    </div>
                @endif
            </div>

            <div class="mt-6 grid sm:grid-cols-3 gap-3 text-sm">
                <div class="rounded-2xl bg-background border border-border p-4"><p class="text-muted-foreground text-xs">Status</p><p class="font-semibold mt-1">{{ $summary['status'] ?? 'Processing' }}</p></div>
                <div class="rounded-2xl bg-background border border-border p-4"><p class="text-muted-foreground text-xs">Delivery</p><p class="font-semibold mt-1">2-5 days</p></div>
                <div class="rounded-2xl bg-background border border-border p-4"><p class="text-muted-foreground text-xs">Payment</p><p class="font-semibold mt-1">{{ $paymentMethod }}</p></div>
            </div>

            @if($items->isNotEmpty())
                <div class="mt-6">
                    <p class="text-xs text-muted-foreground mb-3">Items</p>
                    <div class="space-y-2">
                        @foreach($items as $item)
                            <div class="flex items-center justify-between gap-4 rounded-xl bg-background border border-border p-3 text-sm">
                                <span class="font-semibold truncate">{{ $item['name'] }}</span>
                                <span class="text-muted-foreground shrink-0">Qty {{ $item['qty'] }} · ${{ $item['price'] * $item['qty'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(collect($shipping)->filter()->isNotEmpty())
                <div class="mt-6 rounded-2xl bg-background border border-border p-4 text-sm">
                    <p class="text-xs text-muted-foreground mb-2">Shipping Details</p>
                    <p class="font-semibold">{{ $shipping['name'] ?: auth()->user()->name }}</p>
                    <p class="text-muted-foreground mt-1">{{ $shipping['email'] ?: auth()->user()->email }}{{ !empty($shipping['phone']) ? ' · ' . $shipping['phone'] : '' }}</p>
                    @if(!empty($shipping['address']) || !empty($shipping['city']) || !empty($shipping['postal_code']))
                        <p class="text-muted-foreground mt-1">{{ $shipping['address'] }}{{ !empty($shipping['city']) ? ', ' . $shipping['city'] : '' }} {{ $shipping['postal_code'] }}</p>
                    @endif
                </div>
            @endif
        </div>

        <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3">
            <a href="{{ route('catalog') }}" class="h-12 px-6 rounded-full bg-primary text-primary-foreground font-semibold inline-flex items-center justify-center gap-2">Continue Shopping</a>
            <a href="{{ route('history') }}" class="h-12 px-6 rounded-full border border-border bg-white/5 font-semibold inline-flex items-center justify-center">View Order History</a>
        </div>
    </section>
@endsection
