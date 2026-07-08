@extends('layouts.site')
@section('title', 'Checkout — ZANEXT STORE')

@section('content')
    <section class="mx-auto max-w-6xl px-6 lg:px-10" x-data="{ step: 0, payment: 'card' }">
        <h1 class="font-display font-black text-4xl lg:text-5xl">Checkout</h1>

        <div class="mt-8 grid grid-cols-4 gap-2">
            @foreach(['Contact', 'Shipping', 'Payment', 'Review'] as $i => $label)
                <button @click="step = {{ $i }}"
                        :class="step >= {{ $i }} ? 'border-primary bg-primary/10' : 'border-border bg-card text-muted-foreground'"
                        class="rounded-2xl border p-3 text-left transition-colors">
                    <div class="flex items-center gap-2 text-xs font-semibold">
                        <span :class="step >= {{ $i }} ? 'bg-primary text-primary-foreground' : 'bg-white/5'" class="size-6 rounded-full grid place-items-center">{{ $i + 1 }}</span>
                        <span class="hidden sm:inline">{{ $label }}</span>
                    </div>
                </button>
            @endforeach
        </div>

        <form method="POST" action="{{ route('checkout.place') }}" class="grid lg:grid-cols-3 gap-10 mt-10">
            @csrf
            <input type="hidden" name="payment_method" :value="payment">

            <div class="lg:col-span-2 space-y-8">
                <div x-show="step === 0" class="rounded-2xl border border-border bg-card p-7">
                    <h2 class="font-display font-bold text-lg mb-6">Contact Information</h2>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <label class="block"><span class="block text-xs text-muted-foreground mb-2">Email</span><input type="email" name="email" class="w-full h-12 px-4 rounded-xl bg-background border border-border text-sm focus:outline-none focus:border-primary"></label>
                        <label class="block"><span class="block text-xs text-muted-foreground mb-2">Phone</span><input name="phone" class="w-full h-12 px-4 rounded-xl bg-background border border-border text-sm focus:outline-none focus:border-primary"></label>
                    </div>
                </div>

                <div x-show="step === 1" class="rounded-2xl border border-border bg-card p-7" style="display: none;">
                    <h2 class="font-display font-bold text-lg mb-6">Shipping Address</h2>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <label class="block"><span class="block text-xs text-muted-foreground mb-2">First Name</span><input name="first_name" class="w-full h-12 px-4 rounded-xl bg-background border border-border text-sm"></label>
                        <label class="block"><span class="block text-xs text-muted-foreground mb-2">Last Name</span><input name="last_name" class="w-full h-12 px-4 rounded-xl bg-background border border-border text-sm"></label>
                        <label class="block sm:col-span-2"><span class="block text-xs text-muted-foreground mb-2">Address</span><input name="address" class="w-full h-12 px-4 rounded-xl bg-background border border-border text-sm"></label>
                        <label class="block"><span class="block text-xs text-muted-foreground mb-2">City</span><input name="city" class="w-full h-12 px-4 rounded-xl bg-background border border-border text-sm"></label>
                        <label class="block"><span class="block text-xs text-muted-foreground mb-2">Postal Code</span><input name="postal_code" class="w-full h-12 px-4 rounded-xl bg-background border border-border text-sm"></label>
                    </div>
                </div>

                <div x-show="step === 2" class="rounded-2xl border border-border bg-card p-7" style="display: none;">
                    <h2 class="font-display font-bold text-lg mb-6">Payment Method</h2>
                    <div class="grid sm:grid-cols-2 gap-3">
                        @foreach([['v' => 'card', 'l' => 'Credit Card'], ['v' => 'zanext', 'l' => 'ZANEXT Pay'], ['v' => 'bank', 'l' => 'Bank Transfer'], ['v' => 'qris', 'l' => 'QRIS']] as $pm)
                            <button type="button" @click="payment = '{{ $pm['v'] }}'"
                                    :class="payment === '{{ $pm['v'] }}' ? 'border-primary bg-primary/10' : 'border-border bg-background'"
                                    class="h-12 px-4 rounded-xl border flex items-center gap-2 text-sm font-medium transition-colors">
                                {{ $pm['l'] }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div x-show="step === 3" class="rounded-2xl border border-border bg-card p-7" style="display: none;">
                    <h2 class="font-display font-bold text-lg mb-6">Review Order</h2>
                    @foreach($items as $item)
                        <div class="flex items-center gap-4 rounded-xl border border-border bg-background p-4 mb-3">
                            <img src="{{ asset('assets/' . $item['image']) }}" alt="" class="size-16 rounded-lg object-cover">
                            <div class="flex-1 min-w-0">
                                <p class="font-display font-semibold truncate">{{ $item['name'] }}</p>
                                <p class="text-xs text-muted-foreground">EU {{ $item['size'] }} · {{ $item['color'] }} · Qty {{ $item['qty'] }}</p>
                            </div>
                            <p class="font-display font-bold">${{ $item['price'] * $item['qty'] }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="flex items-center justify-between gap-3">
                    <button type="button" @click="step = Math.max(0, step - 1)" x-show="step > 0" class="h-11 px-5 rounded-full border border-border bg-white/5 text-sm font-semibold" style="display: none;">Back</button>
                    <a href="{{ route('cart') }}" x-show="step === 0" class="h-11 px-5 rounded-full border border-border bg-white/5 text-sm font-semibold flex items-center">Cart</a>
                    <button type="button" @click="step = Math.min(3, step + 1)" x-show="step < 3" class="h-11 px-6 rounded-full bg-primary text-primary-foreground text-sm font-semibold ml-auto">Continue</button>
                    <button type="submit" x-show="step === 3" {{ count($items) === 0 ? 'disabled' : '' }} class="h-11 px-6 rounded-full bg-primary text-primary-foreground text-sm font-semibold ml-auto disabled:opacity-50" style="display: none;">Place Order</button>
                </div>
            </div>

            <aside class="rounded-2xl border border-border bg-card p-6 h-fit space-y-4 lg:sticky lg:top-28">
                <div class="font-display font-bold text-xl">Summary</div>
                <div class="space-y-2 text-sm text-muted-foreground">
                    <div class="flex justify-between"><span>Subtotal</span><span>${{ $subtotal }}</span></div>
                    <div class="flex justify-between"><span>Shipping</span><span>{{ $shipping === 0 ? 'Free' : '$' . $shipping }}</span></div>
                    <div class="flex justify-between"><span>Tax</span><span>$0</span></div>
                </div>
                <div class="h-px bg-border"></div>
                <div class="flex justify-between font-display font-bold text-lg"><span>Total</span><span>${{ $total }}</span></div>
            </aside>
        </form>
    </section>
@endsection
