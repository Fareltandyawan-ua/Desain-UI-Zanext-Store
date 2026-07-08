@php $p = $product; @endphp
<div class="grid sm:grid-cols-2 gap-4">
    @if(!$p)
        <label class="block"><span class="block text-xs text-muted-foreground mb-2">Product ID</span><input name="id" required placeholder="phantom-flux-01" class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm"></label>
    @endif
    <label class="block"><span class="block text-xs text-muted-foreground mb-2">Product Name</span><input name="name" required value="{{ old('name', $p?->name) }}" class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm"></label>
    <label class="block"><span class="block text-xs text-muted-foreground mb-2">Brand</span><input name="brand" required value="{{ old('brand', $p?->brand) }}" class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm"></label>
    <label class="block"><span class="block text-xs text-muted-foreground mb-2">Base Price</span><input type="number" name="price" required value="{{ old('price', $p?->price) }}" class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm"></label>
    <label class="block"><span class="block text-xs text-muted-foreground mb-2">Old Price</span><input type="number" name="old_price" value="{{ old('old_price', $p?->old_price) }}" class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm"></label>
    <label class="block"><span class="block text-xs text-muted-foreground mb-2">Rating</span><input type="number" step="0.1" name="rating" required value="{{ old('rating', $p?->rating ?? 4.8) }}" class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm"></label>
    <label class="block"><span class="block text-xs text-muted-foreground mb-2">Stock</span><input type="number" name="stock" value="{{ old('stock', $p?->stock ?? 0) }}" class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm"></label>
    <label class="block"><span class="block text-xs text-muted-foreground mb-2">Category</span><input name="category" required value="{{ old('category', $p?->category) }}" class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm"></label>
    <label class="block"><span class="block text-xs text-muted-foreground mb-2">Tag</span><input name="tag" value="{{ old('tag', $p?->tag) }}" placeholder="Limited" class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm"></label>
    <label class="block sm:col-span-2">
        <span class="block text-xs text-muted-foreground mb-2">Product Image</span>
        @if($p?->image)
            <div class="mb-3 flex items-center gap-3 rounded-xl border border-border bg-card p-3">
                <img src="{{ asset('assets/' . $p->image) }}" alt="{{ $p->name }}" class="size-14 rounded-lg object-cover">
                <div>
                    <p class="text-sm font-semibold">Current image</p>
                    <p class="text-xs text-muted-foreground">{{ $p->image }}</p>
                </div>
            </div>
        @endif
        <input type="file" name="image_file" accept="image/jpeg,image/png,image/webp,image/gif" {{ $p ? '' : 'required' }} class="w-full rounded-xl bg-card border border-border text-sm file:mr-4 file:h-11 file:border-0 file:bg-primary file:px-4 file:text-primary-foreground file:font-semibold">
        <span class="block mt-2 text-xs text-muted-foreground">JPG, PNG, WEBP, or GIF. Max 2MB. {{ $p ? 'Leave empty to keep current image.' : '' }}</span>
    </label>
    <label class="block sm:col-span-2"><span class="block text-xs text-muted-foreground mb-2">Description</span><textarea name="description" rows="4" class="w-full px-4 py-3 rounded-xl bg-card border border-border text-sm">{{ old('description', $p?->description) }}</textarea></label>
</div>
