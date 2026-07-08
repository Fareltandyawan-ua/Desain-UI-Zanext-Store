@php $a = $article; @endphp
<div class="grid sm:grid-cols-2 gap-4">
    @if(!$a)
        <label class="block"><span class="block text-xs text-muted-foreground mb-2">Article ID</span><input name="id" required placeholder="trend-sneaker-2026" class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm"></label>
    @endif
    <label class="block sm:col-span-2"><span class="block text-xs text-muted-foreground mb-2">Title</span><input name="title" required value="{{ old('title', $a?->title) }}" class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm"></label>
    <label class="block"><span class="block text-xs text-muted-foreground mb-2">Category</span><input name="category" required value="{{ old('category', $a?->category) }}" class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm"></label>
    <label class="block"><span class="block text-xs text-muted-foreground mb-2">Author</span><input name="author" required value="{{ old('author', $a?->author) }}" class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm"></label>
    <label class="block"><span class="block text-xs text-muted-foreground mb-2">Date</span><input name="date" required value="{{ old('date', $a?->date ?? date('M d, Y')) }}" class="w-full h-11 px-4 rounded-xl bg-card border border-border text-sm"></label>
    <label class="block">
        <span class="block text-xs text-muted-foreground mb-2">Article Image</span>
        @if($a?->image)
            <div class="mb-3 flex items-center gap-3 rounded-xl border border-border bg-card p-3">
                <img src="{{ asset('assets/' . $a->image) }}" alt="{{ $a->title }}" class="size-14 rounded-lg object-cover">
                <div>
                    <p class="text-sm font-semibold">Current image</p>
                    <p class="text-xs text-muted-foreground">{{ $a->image }}</p>
                </div>
            </div>
        @endif
        <input type="file" name="image_file" accept="image/jpeg,image/png,image/webp,image/gif" {{ $a ? '' : 'required' }} class="w-full rounded-xl bg-card border border-border text-sm file:mr-4 file:h-11 file:border-0 file:bg-primary file:px-4 file:text-primary-foreground file:font-semibold">
        <span class="block mt-2 text-xs text-muted-foreground">JPG, PNG, WEBP, or GIF. Max 2MB. {{ $a ? 'Leave empty to keep current image.' : '' }}</span>
    </label>
    <label class="block sm:col-span-2"><span class="block text-xs text-muted-foreground mb-2">Excerpt</span><textarea name="excerpt" required rows="3" class="w-full px-4 py-3 rounded-xl bg-card border border-border text-sm">{{ old('excerpt', $a?->excerpt) }}</textarea></label>
    <label class="block sm:col-span-2"><span class="block text-xs text-muted-foreground mb-2">Content</span><textarea name="content" rows="7" class="w-full px-4 py-3 rounded-xl bg-card border border-border text-sm">{{ old('content', $a?->content) }}</textarea></label>
</div>
