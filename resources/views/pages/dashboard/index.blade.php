@extends('layouts.admin')
@section('title', 'Dashboard — ZANEXT')
@section('breadcrumb', 'Admin')
@section('page-title', 'Overview')

@section('content')
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @foreach([
            ['l' => 'Revenue', 'v' => '$' . number_format($stats['revenue']), 'd' => '+12.4%'],
            ['l' => 'Orders', 'v' => $stats['orders'], 'd' => '+8.2%'],
            ['l' => 'Products', 'v' => $stats['products'], 'd' => '+3'],
            ['l' => 'Customers', 'v' => $stats['users'], 'd' => '+18%'],
        ] as $stat)
            <div class="rounded-2xl border border-border bg-card p-6">
                <p class="text-xs uppercase tracking-widest text-muted-foreground">{{ $stat['l'] }}</p>
                <p class="font-display font-black text-3xl mt-3">{{ $stat['v'] }}</p>
                <p class="text-xs text-success mt-2">{{ $stat['d'] }} vs last month</p>
            </div>
        @endforeach
    </div>

    <div class="mt-10 rounded-2xl border border-border bg-card overflow-hidden">
        <div class="p-6 flex items-center justify-between border-b border-border">
            <h2 class="font-display font-bold text-lg">Recent Transactions</h2>
            <a href="{{ route('dashboard.transactions') }}" class="text-sm text-primary">View all</a>
        </div>
        <div class="overflow-x-auto">
            <div class="min-w-[720px]">
                @foreach($recent as $t)
                    <div class="grid grid-cols-4 px-6 py-4 border-b border-border last:border-0 text-sm">
                        <span class="font-mono">{{ $t->id }}</span>
                        <span class="font-semibold">{{ $t->product }}</span>
                        <span class="text-muted-foreground">{{ $t->date }}</span>
                        <span class="text-right font-bold">${{ $t->amount }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
