@props(['product'])

<div class="group relative rounded-2xl overflow-hidden bg-card border border-border card-hover">
    <div class="block aspect-square bg-surface relative overflow-hidden">
        <a href="{{ route('product.show', $product->id) }}" class="absolute inset-0 block" aria-label="View {{ $product->name }}">
            <img src="{{ asset('assets/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        </a>

        @if($product->tag)
            <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-primary text-primary-foreground text-[10px] font-bold tracking-widest uppercase z-10">
                {{ $product->tag }}
            </span>
        @endif

        <form method="POST" action="{{ route('wishlist.add', $product->id) }}" class="absolute top-4 right-4 z-20 opacity-0 group-hover:opacity-100 transition-opacity">
            @csrf
            <button type="submit" class="size-9 rounded-full bg-background/70 backdrop-blur grid place-items-center hover:text-primary" aria-label="Save to wishlist">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            </button>
        </form>

        <div class="absolute inset-x-3 bottom-3 z-20 flex gap-2 translate-y-5 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
            <form method="POST" action="{{ route('cart.add', $product->id) }}" class="flex-1 min-w-0">
                @csrf
                <input type="hidden" name="size" value="42">
                <input type="hidden" name="color" value="Core Black">
                <input type="hidden" name="qty" value="1">
                <button type="submit" class="w-full h-10 rounded-full bg-primary text-primary-foreground text-xs font-semibold flex items-center justify-center gap-2 hover:bg-primary-hover transition-colors shadow-lg shadow-black/25">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    Add to Cart
                </button>
            </form>
            <a href="{{ route('product.show', $product->id) }}" class="size-10 shrink-0 rounded-full bg-background/80 backdrop-blur border border-border grid place-items-center hover:text-primary transition-colors shadow-lg shadow-black/25" aria-label="View product">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7"/><circle cx="12" cy="12" r="3"/></svg>
            </a>
        </div>
    </div>
    <div class="p-5">
        <div class="flex items-center justify-between gap-2">
            <span class="text-[10px] font-semibold tracking-widest text-muted-foreground uppercase">{{ $product->brand }}</span>
            <div class="flex items-center gap-1 text-xs text-muted-foreground">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-3 fill-primary text-primary" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                {{ $product->rating }}
            </div>
        </div>
        <h3 class="mt-2 font-display font-semibold text-base">{{ $product->name }}</h3>
        <div class="mt-3 flex items-baseline gap-2">
            <span class="font-display font-bold text-lg">${{ $product->price }}</span>
            @if($product->old_price)
                <span class="text-xs text-muted-foreground line-through">${{ $product->old_price }}</span>
            @endif
        </div>
    </div>
</div>
