@extends('layouts.site')

@section('title', $product->name . ' — ZANEXT STORE')

@section('content')
    @php
        $sizes = ['39','40','41','42','43','44','45'];
        $colors = ['Core Black', 'Volt Orange', 'Cloud White'];
    @endphp

    <section class="mx-auto max-w-7xl px-6 lg:px-10 pb-24 lg:pb-0"
             x-data="{
                size: '42',
                qty: 1,
                color: 'Core Black',
                activeImage: '/assets/{{ $product->image }}',
                activeTab: 'description'
             }">
        <nav class="text-xs text-muted-foreground mb-8 flex gap-2">
            <a href="{{ route('home') }}" class="hover:text-foreground">Home</a> /
            <a href="{{ route('catalog') }}" class="hover:text-foreground">Catalog</a> /
            <span class="text-foreground">{{ $product->name }}</span>
        </nav>

        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16">
            <div class="space-y-4 lg:sticky lg:top-28 self-start">
                <div class="aspect-square rounded-3xl bg-card border border-border overflow-hidden relative">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="size-3/4 rounded-full bg-primary/20 blur-[100px]"></div>
                    </div>
                    <img :src="activeImage" alt="{{ $product->name }}" class="relative w-full h-full object-cover">
                    @if($product->tag)
                        <span class="absolute left-5 top-5 rounded-full bg-primary text-primary-foreground px-3 py-1 text-xs font-semibold">{{ $product->tag }}</span>
                    @endif
                </div>
                <div class="grid grid-cols-4 gap-3">
                    @foreach($gallery as $img)
                        @php $imgUrl = '/assets/' . $img; @endphp
                        <button @click="activeImage = '{{ $imgUrl }}'"
                                :class="activeImage === '{{ $imgUrl }}' ? 'border-primary' : 'border-border hover:border-primary/60'"
                                class="aspect-square rounded-xl bg-card border overflow-hidden transition-colors">
                            <img src="{{ $imgUrl }}" alt="Preview" loading="lazy" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <div class="text-xs tracking-[0.3em] text-primary font-semibold">{{ $product->brand }}</div>
                    <h1 class="font-display font-black text-4xl lg:text-5xl mt-3">{{ $product->name }}</h1>
                    <div class="flex flex-wrap items-center gap-4 mt-4">
                        <div class="flex items-center gap-1 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 fill-primary text-primary" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            {{ $product->rating }} <span class="text-muted-foreground">(2,341 reviews)</span>
                        </div>
                        <span class="text-xs text-muted-foreground">SKU: {{ strtoupper($product->id) }}</span>
                    </div>
                </div>

                <div class="flex flex-wrap items-baseline gap-3">
                    <div class="font-display font-black text-4xl">${{ $product->price }}</div>
                    @if($product->old_price)
                        <div class="text-lg text-muted-foreground line-through">${{ $product->old_price }}</div>
                        <span class="px-2 py-1 rounded-full bg-success/10 text-success text-xs font-semibold">Save ${{ $product->old_price - $product->price }}</span>
                    @endif
                </div>

                <p class="text-muted-foreground leading-relaxed">
                    Engineered with a precision-knit upper, responsive cushioning and a sculpted carbon-infused outsole. The {{ $product->name }} is built for the streets, the studio, and everywhere in between.
                </p>

                <div>
                    <div class="text-sm font-semibold mb-3">Color · <span class="text-muted-foreground" x-text="color"></span></div>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach($colors as $c)
                            <button @click="color = '{{ $c }}'"
                                    :class="color === '{{ $c }}' ? 'border-primary bg-primary/10' : 'border-border bg-white/5 text-muted-foreground hover:text-foreground'"
                                    class="h-11 rounded-xl border text-xs font-semibold transition-colors">
                                {{ $c }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-sm font-semibold">Select Size · EU</div>
                        <button @click="activeTab = 'size'" class="text-xs text-primary inline-flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21.3 15.3a2.4 2.4 0 0 1 0 3.4l-2.6 2.6a2.4 2.4 0 0 1-3.4 0L2.7 8.7a2.41 2.41 0 0 1 0-3.4l2.6-2.6a2.41 2.41 0 0 1 3.4 0Z"/><path d="m14.5 12.5 2-2"/><path d="m11.5 9.5 2-2"/><path d="m8.5 6.5 2-2"/><path d="m17.5 15.5 2-2"/></svg>
                            Size guide
                        </button>
                    </div>
                    <div class="grid grid-cols-7 gap-2">
                        @foreach($sizes as $s)
                            <button @click="size = '{{ $s }}'"
                                    :class="size === '{{ $s }}' ? 'border-primary bg-primary/10 text-foreground' : 'border-border bg-white/5 text-muted-foreground hover:text-foreground'"
                                    class="h-12 rounded-xl border text-sm font-semibold transition-colors">
                                {{ $s }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <form method="POST" action="{{ route('cart.add', $product->id) }}" class="flex items-center gap-4">
                    @csrf
                    <input type="hidden" name="size" :value="size">
                    <input type="hidden" name="color" :value="color">
                    <input type="hidden" name="qty" :value="qty">

                    <div class="flex items-center border border-border rounded-full">
                        <button type="button" @click="qty = Math.max(1, qty - 1)" class="size-12 grid place-items-center hover:bg-white/5 rounded-l-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/></svg>
                        </button>
                        <span class="w-10 text-center font-semibold" x-text="qty"></span>
                        <button type="button" @click="qty = qty + 1" class="size-12 grid place-items-center hover:bg-white/5 rounded-r-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                        </button>
                    </div>
                    <button type="submit" class="flex-1 h-14 rounded-full bg-primary text-primary-foreground font-semibold flex items-center justify-center gap-2 hover:bg-primary-hover transition-colors glow-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        Add to Cart
                    </button>
                </form>

                <form method="POST" action="{{ route('wishlist.add', $product->id) }}">
                    @csrf
                    <button type="submit" class="w-full h-12 rounded-full border border-border grid place-items-center hover:text-primary hover:border-primary transition-colors flex items-center justify-center gap-2 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                        Save to Wishlist
                    </button>
                </form>

                <div class="grid grid-cols-3 gap-3 pt-4">
                    @foreach([['icon' => 'truck', 't' => 'Free Shipping'], ['icon' => 'shield', 't' => 'Authentic'], ['icon' => 'rotate', 't' => '30-day return']] as $info)
                        <div class="rounded-xl border border-border bg-card p-4 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-primary mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                @if($info['icon'] === 'truck')
                                    <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/>
                                @elseif($info['icon'] === 'shield')
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/>
                                @else
                                    <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/>
                                @endif
                            </svg>
                            <div class="text-xs mt-2 text-muted-foreground">{{ $info['t'] }}</div>
                        </div>
                    @endforeach
                </div>

                {{-- Tabs --}}
                <div class="rounded-2xl border border-border bg-card overflow-hidden">
                    <div class="flex overflow-x-auto border-b border-border">
                        @foreach([['id' => 'description', 'label' => 'Description'], ['id' => 'size', 'label' => 'Size Guide'], ['id' => 'shipping', 'label' => 'Shipping & Return'], ['id' => 'reviews', 'label' => 'Reviews']] as $tab)
                            <button @click="activeTab = '{{ $tab['id'] }}'"
                                    :class="activeTab === '{{ $tab['id'] }}' ? 'text-primary border-b-2 border-primary' : 'text-muted-foreground hover:text-foreground'"
                                    class="shrink-0 px-5 py-4 text-sm font-semibold transition-colors">
                                {{ $tab['label'] }}
                            </button>
                        @endforeach
                    </div>
                    <div class="p-6 text-sm leading-relaxed text-muted-foreground">
                        <div x-show="activeTab === 'description'" class="space-y-3">
                            <p>{{ $product->name }} combines street-ready durability with lightweight comfort. The upper is breathable, the midsole is responsive, and the outsole is tuned for all-day grip.</p>
                            <ul class="grid sm:grid-cols-2 gap-2 text-foreground/80">
                                <li>• Precision-knit upper</li>
                                <li>• Carbon-infused outsole</li>
                                <li>• Responsive foam cushioning</li>
                                <li>• Premium limited release finish</li>
                            </ul>
                        </div>
                        <div x-show="activeTab === 'size'" class="space-y-4" style="display: none;">
                            <p>Fits true to size. If you prefer a relaxed fit or wear thick socks, choose one size up.</p>
                            <div class="grid grid-cols-4 gap-2 text-center text-xs">
                                @foreach(['EU 39', 'EU 40', 'EU 41', 'EU 42', 'EU 43', 'EU 44', 'EU 45'] as $s)
                                    <div class="rounded-lg border border-border bg-background p-3">{{ $s }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div x-show="activeTab === 'shipping'" class="grid sm:grid-cols-2 gap-4" style="display: none;">
                            <div class="rounded-xl border border-border bg-background p-4">
                                <div class="flex items-center gap-2 text-foreground font-semibold"><span class="text-primary">→</span> Fast delivery</div>
                                <p class="mt-2">Free shipping on eligible orders. Estimated delivery takes 2-5 business days.</p>
                            </div>
                            <div class="rounded-xl border border-border bg-background p-4">
                                <div class="flex items-center gap-2 text-foreground font-semibold"><span class="text-primary">↩</span> Easy return</div>
                                <p class="mt-2">Return unused items within 30 days with original packaging and tags.</p>
                            </div>
                        </div>
                        <div x-show="activeTab === 'reviews'" class="space-y-4" style="display: none;">
                            @foreach([['name' => 'Marcus', 'text' => 'Super comfortable and the silhouette looks premium in person.'], ['name' => 'Yuki', 'text' => 'The details are sharp. Fits true to size for me.']] as $review)
                                <div class="rounded-xl border border-border bg-background p-4">
                                    <div class="flex items-center gap-2 text-foreground font-semibold">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 fill-primary text-primary" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                        {{ $review['name'] }}
                                    </div>
                                    <p class="mt-2">{{ $review['text'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-24 lg:mt-32">
            <h2 class="font-display font-black text-3xl mb-8">You may also like</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($related as $p)
                    <x-product-card :product="$p" />
                @endforeach
            </div>
        </div>
    </section>
@endsection
