@extends('layouts.admin')
@section('title', 'Manage Transactions')
@section('breadcrumb', 'Admin / Transactions')
@section('page-title', 'Transactions')

@section('content')
    @php
        $statusStyles = ['Delivered' => 'bg-success/10 text-success', 'Shipped' => 'bg-primary/10 text-primary', 'Processing' => 'bg-white/10 text-muted-foreground', 'Cancelled' => 'bg-destructive/10 text-destructive'];
        $statusOptions = ['all' => 'All Status', 'Processing' => 'Processing', 'Shipped' => 'Shipped', 'Delivered' => 'Delivered', 'Cancelled' => 'Cancelled'];
    @endphp

    <div class="space-y-5">
        <div class="rounded-2xl border border-border bg-card p-6">
            <h2 class="font-display font-bold text-lg">Transaction List</h2>
            <p class="text-sm text-muted-foreground mt-1">Search, filter, and update order status directly.</p>
        </div>

        <form method="GET" action="{{ route('dashboard.transactions') }}" class="rounded-2xl border border-border bg-card p-4 grid sm:grid-cols-[1fr_auto_auto] gap-3">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search order, product, payment..." class="h-11 px-4 rounded-xl bg-background border border-border text-sm focus:outline-none focus:border-primary">
            <select name="status" class="h-11 px-4 rounded-xl bg-background border border-border text-sm">
                @foreach($statusOptions as $value => $label)
                    <option value="{{ $value }}" @selected(($status ?? 'all') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <div class="flex gap-2">
                <button class="h-11 px-5 rounded-xl bg-primary text-primary-foreground text-sm font-semibold">Apply</button>
                @if(!empty($search) || ($status ?? 'all') !== 'all')
                    <a href="{{ route('dashboard.transactions') }}" class="h-11 px-5 rounded-xl border border-border bg-white/5 text-sm font-semibold flex items-center">Reset</a>
                @endif
            </div>
        </form>

        <div class="grid gap-3 lg:hidden">
            @forelse($transactions as $t)
                <div class="rounded-2xl border border-border bg-card p-4">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <p class="font-mono text-sm">{{ $t->id }}</p>
                            <p class="font-display font-semibold mt-1 truncate">{{ $t->product }}</p>
                            <p class="text-xs text-muted-foreground mt-1">{{ $t->date }} · ${{ $t->amount }}</p>
                        </div>
                        <span class="shrink-0 px-3 py-1 rounded-full text-xs font-semibold {{ $statusStyles[$t->status] ?? 'bg-white/10 text-muted-foreground' }}">{{ $t->status }}</span>
                    </div>
                    <form method="POST" action="{{ route('dashboard.transactions.update', $t->id) }}" class="mt-4 flex gap-2">@csrf @method('PATCH')
                        <select name="status" class="min-w-0 flex-1 h-10 rounded-full bg-background border border-border px-3 text-xs">
                            @foreach(['Processing','Shipped','Delivered','Cancelled'] as $s)
                                <option value="{{ $s }}" @selected($t->status === $s)>{{ $s }}</option>
                            @endforeach
                        </select>
                        <button class="h-10 px-4 rounded-full bg-primary text-primary-foreground text-xs font-semibold">Update</button>
                    </form>
                </div>
            @empty
                <div class="rounded-2xl border border-border bg-card p-8 text-center text-muted-foreground">No transactions found.</div>
            @endforelse
        </div>

        <div class="hidden lg:block rounded-2xl border border-border bg-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[850px] text-sm">
                    <thead class="border-b border-border text-muted-foreground text-xs uppercase tracking-widest">
                        <tr><th class="text-left p-4">Order ID</th><th class="text-left p-4">Product</th><th class="text-left p-4">Date</th><th class="text-right p-4">Amount</th><th class="text-left p-4">Status</th><th class="text-right p-4">Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $t)
                            <tr class="border-b border-border last:border-0 hover:bg-white/[0.02]">
                                <td class="p-4 font-mono">{{ $t->id }}</td><td class="p-4 font-semibold">{{ $t->product }}</td><td class="p-4 text-muted-foreground">{{ $t->date }}</td><td class="p-4 text-right font-bold">${{ $t->amount }}</td>
                                <td class="p-4"><span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusStyles[$t->status] ?? 'bg-white/10 text-muted-foreground' }}">{{ $t->status }}</span></td>
                                <td class="p-4 text-right">
                                    <form method="POST" action="{{ route('dashboard.transactions.update', $t->id) }}" class="inline-flex items-center gap-2">@csrf @method('PATCH')
                                        <select name="status" class="h-9 rounded-full bg-background border border-border px-3 text-xs">
                                            @foreach(['Processing','Shipped','Delivered','Cancelled'] as $s)
                                                <option value="{{ $s }}" @selected($t->status === $s)>{{ $s }}</option>
                                            @endforeach
                                        </select>
                                        <button class="h-9 px-3 rounded-full bg-primary text-primary-foreground text-xs font-semibold">Update</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
