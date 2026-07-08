@extends('layouts.admin')
@section('title', 'Manage Products')
@section('breadcrumb', 'Admin / Products')
@section('page-title', 'Products')

@section('content')
    <div x-data="{ createOpen: false, editOpen: null }" class="space-y-5">
        <div class="rounded-2xl border border-border bg-card p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-display font-bold text-lg">All Products ({{ $products->count() }})</h2>
                <p class="text-sm text-muted-foreground mt-1">Add, edit, or delete products to keep the catalog clean and easy to manage.</p>
            </div>
            <button @click="createOpen = true" class="h-10 px-4 rounded-full bg-primary text-primary-foreground text-sm font-semibold">+ New Product</button>
        </div>

        <form method="GET" action="{{ route('dashboard.products') }}" class="rounded-2xl border border-border bg-card p-4 flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search products, brand, category..." class="flex-1 h-11 px-4 rounded-xl bg-background border border-border text-sm focus:outline-none focus:border-primary">
            <div class="flex gap-2">
                <button class="h-11 px-5 rounded-xl bg-primary text-primary-foreground text-sm font-semibold">Search</button>
                @if(!empty($search))
                    <a href="{{ route('dashboard.products') }}" class="h-11 px-5 rounded-xl border border-border bg-white/5 text-sm font-semibold flex items-center">Reset</a>
                @endif
            </div>
        </form>

        <div class="grid gap-3 lg:hidden">
            @forelse($products as $p)
                <div class="rounded-2xl border border-border bg-card p-4">
                    <div class="flex gap-3">
                        <img src="{{ asset('assets/' . $p->image) }}" class="size-16 rounded-xl object-cover" alt="">
                        <div class="min-w-0 flex-1">
                            <p class="font-display font-semibold truncate">{{ $p->name }}</p>
                            <p class="text-xs text-muted-foreground mt-1">{{ $p->brand }} · {{ $p->category }}</p>
                            <div class="mt-3 flex items-center justify-between text-sm">
                                <span class="font-bold">${{ $p->price }}</span>
                                <span class="text-muted-foreground">Stock {{ $p->stock }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end gap-3">
                        <button @click="editOpen = '{{ $p->id }}'" class="h-9 px-4 rounded-full border border-primary/50 text-primary text-xs font-semibold">Edit</button>
                        <form method="POST" action="{{ route('dashboard.products.destroy', $p->id) }}">@csrf @method('DELETE')<button class="h-9 px-4 rounded-full border border-destructive/50 text-destructive text-xs font-semibold" onclick="return confirm('Delete this product?')">Delete</button></form>
                    </div>
                </div>
            @empty
                <div class="rounded-2xl border border-border bg-card p-8 text-center text-muted-foreground">No products found.</div>
            @endforelse
        </div>

        <div class="hidden lg:block rounded-2xl border border-border bg-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px] text-sm">
                    <thead class="border-b border-border text-muted-foreground text-xs uppercase tracking-widest">
                        <tr>
                            <th class="text-left p-4">Product</th><th class="text-left p-4">Brand</th><th class="text-left p-4">Category</th><th class="text-right p-4">Price</th><th class="text-right p-4">Stock</th><th class="text-right p-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $p)
                            <tr class="border-b border-border last:border-0 hover:bg-white/[0.02]">
                                <td class="p-4 flex items-center gap-3"><img src="{{ asset('assets/' . $p->image) }}" class="size-10 rounded-lg object-cover" alt=""><span class="font-semibold">{{ $p->name }}</span></td>
                                <td class="p-4">{{ $p->brand }}</td>
                                <td class="p-4 text-muted-foreground">{{ $p->category }}</td>
                                <td class="p-4 text-right font-bold">${{ $p->price }}</td>
                                <td class="p-4 text-right">{{ $p->stock }}</td>
                                <td class="p-4 text-right space-x-3">
                                    <button @click="editOpen = '{{ $p->id }}'" class="text-xs text-primary hover:underline">Edit</button>
                                    <form method="POST" action="{{ route('dashboard.products.destroy', $p->id) }}" class="inline">@csrf @method('DELETE')<button class="text-xs text-destructive hover:underline" onclick="return confirm('Delete this product?')">Delete</button></form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="createOpen" x-transition.opacity class="fixed inset-0 z-50 grid place-items-center p-4" style="display:none">
            <button @click="createOpen = false" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></button>
            <form method="POST" action="{{ route('dashboard.products.store') }}" enctype="multipart/form-data" class="relative w-full max-w-3xl rounded-2xl border border-border bg-background p-6 max-h-[90vh] overflow-y-auto">
                @csrf
                <div class="flex items-center justify-between mb-5"><h3 class="font-display font-bold text-xl">New Product</h3><button type="button" @click="createOpen = false">✕</button></div>
                @include('pages.dashboard.partials.product-form', ['product' => null])
                <button class="mt-5 h-11 px-5 rounded-full bg-primary text-primary-foreground text-sm font-semibold">Save Product</button>
            </form>
        </div>

        @foreach($products as $p)
            <div x-show="editOpen === '{{ $p->id }}'" x-transition.opacity class="fixed inset-0 z-50 grid place-items-center p-4" style="display:none">
                <button @click="editOpen = null" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></button>
                <form method="POST" action="{{ route('dashboard.products.update', $p->id) }}" enctype="multipart/form-data" class="relative w-full max-w-3xl rounded-2xl border border-border bg-background p-6 max-h-[90vh] overflow-y-auto">
                    @csrf @method('PATCH')
                    <div class="flex items-center justify-between mb-5"><h3 class="font-display font-bold text-xl">Edit Product</h3><button type="button" @click="editOpen = null">✕</button></div>
                    @include('pages.dashboard.partials.product-form', ['product' => $p])
                    <button class="mt-5 h-11 px-5 rounded-full bg-primary text-primary-foreground text-sm font-semibold">Update Product</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
