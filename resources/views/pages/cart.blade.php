@extends('layouts.site')
@section('title', 'Cart — ZANEXT STORE')

@section('content')
    <section class="mx-auto max-w-6xl px-6 lg:px-10">
        <h1 class="font-display font-black text-4xl lg:text-5xl">Your Cart</h1>
        <p class="text-muted-foreground mt-3">{{ count($items) }} items waiting for the streets.</p>

        @if(count($items) === 0)
            <div class="mt-16 rounded-3xl border border-border bg-card p-16 text-center">
                <p class="font-display font-bold text-2xl">Your cart is empty</p>
                <p class="text-muted-foreground mt-3">Start exploring the latest drops.</p>
                <a href="{{ route('catalog') }}" class="inline-flex mt-8 h-12 px-7 rounded-full bg-primary text-primary-foreground font-semibold items-center gap-2">Browse Catalog</a>
            </div>
        @else
            <div class="grid lg:grid-cols-3 gap-10 mt-12">
                <div class="lg:col-span-2 space-y-4">
                    @foreach($items as $item)
                        <div class="rounded-2xl border border-border bg-card p-5 flex gap-5">
                            <img src="{{ asset('assets/' . $item['image']) }}" alt="" class="size-24 rounded-xl object-cover">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs text-muted-foreground uppercase tracking-widest">{{ $item['brand'] }}</p>
                                <p class="font-display font-semibold mt-1">{{ $item['name'] }}</p>
                                <p class="text-xs text-muted-foreground mt-1">EU {{ $item['size'] }} · {{ $item['color'] }}</p>
                                <div class="mt-4 flex items-center gap-3">
                                    <form method="POST" action="{{ route('cart.update', $item['key']) }}" class="flex items-center border border-border rounded-full">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="qty" value="{{ max(1, $item['qty'] - 1) }}">
                                        <button type="submit" class="size-10 grid place-items-center hover:bg-white/5 rounded-l-full">−</button>
                                    </form>
                                    <span class="font-semibold">{{ $item['qty'] }}</span>
                                    <form method="POST" action="{{ route('cart.update', $item['key']) }}" class="flex items-center border border-border rounded-full">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="qty" value="{{ $item['qty'] + 1 }}">
                                        <button type="submit" class="size-10 grid place-items-center hover:bg-white/5 rounded-r-full">+</button>
                                    </form>
                                    <form method="POST" action="{{ route('cart.remove', $item['key']) }}" class="ml-auto">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-xs text-muted-foreground hover:text-destructive">Remove</button>
                                    </form>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-display font-bold text-xl">${{ $item['price'] * $item['qty'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <aside class="rounded-2xl border border-border bg-card p-6 h-fit lg:sticky lg:top-28 space-y-4">
                    <h2 class="font-display font-bold text-xl">Summary</h2>
                    <div class="space-y-2 text-sm text-muted-foreground">
                        <div class="flex justify-between"><span>Subtotal</span><span>${{ $subtotal }}</span></div>
                        <div class="flex justify-between"><span>Shipping</span><span>{{ $shipping === 0 ? 'Free' : '$' . $shipping }}</span></div>
                        <div class="flex justify-between"><span>Tax</span><span>$0</span></div>
                    </div>
                    <div class="h-px bg-border"></div>
                    <div class="flex justify-between font-display font-bold text-lg"><span>Total</span><span>${{ $total }}</span></div>
                    <a href="{{ route('checkout') }}" class="w-full h-12 rounded-full bg-primary text-primary-foreground font-semibold text-sm flex items-center justify-center gap-2 hover:bg-primary-hover">
                        Checkout
                    </a>
                    <a href="{{ route('catalog') }}" class="block text-center text-sm text-muted-foreground hover:text-foreground">Continue shopping</a>
                </aside>
            </div>
        @endif
    </section>
@endsection
