<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard — ZANEXT STORE')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @php
        $navItems = [
            ['url' => route('dashboard.index'), 'label' => 'Overview', 'active' => request()->routeIs('dashboard.index')],
            ['url' => route('dashboard.products'), 'label' => 'Products', 'active' => request()->routeIs('dashboard.products')],
            ['url' => route('dashboard.transactions'), 'label' => 'Transactions', 'active' => request()->routeIs('dashboard.transactions')],
            ['url' => route('dashboard.users'), 'label' => 'Users', 'active' => request()->routeIs('dashboard.users')],
            ['url' => route('dashboard.articles'), 'label' => 'Articles', 'active' => request()->routeIs('dashboard.articles')],
        ];
    @endphp

    <div class="min-h-screen flex">
        <aside class="w-64 border-r border-border bg-card/40 backdrop-blur-xl hidden lg:flex flex-col">
            <div class="h-20 px-6 flex items-center gap-2 border-b border-border">
                <div class="size-9 rounded-lg bg-primary grid place-items-center font-display font-black text-primary-foreground glow-primary">Z</div>
                <span class="font-display font-extrabold tracking-tight text-lg">ZANEXT<span class="text-primary">.</span></span>
            </div>
            <nav class="flex-1 px-3 py-6 space-y-1">
                @foreach($navItems as $item)
                    <a href="{{ $item['url'] }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm transition-colors {{ $item['active'] ? 'bg-primary/10 text-primary font-semibold' : 'text-muted-foreground hover:text-foreground hover:bg-white/5' }}">
                        <span class="size-2 rounded-full {{ $item['active'] ? 'bg-primary' : 'bg-white/20' }}"></span>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
            <div class="p-4 border-t border-border">
                <a href="{{ route('home') }}" class="block text-xs text-muted-foreground hover:text-foreground">← Back to Store</a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="min-h-20 px-4 sm:px-8 border-b border-border flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-background/60 backdrop-blur-xl sticky top-0 z-30 py-4">
                <div>
                    <p class="text-xs text-muted-foreground">@yield('breadcrumb', 'Dashboard')</p>
                    <h1 class="font-display font-bold text-xl">@yield('page-title', 'Overview')</h1>
                </div>
                <div class="flex items-center gap-3">
                    @auth
                        <span class="text-sm text-muted-foreground hidden sm:inline">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="h-10 px-4 rounded-full border border-border bg-white/5 hover:bg-white/10 text-xs font-semibold">Sign out</button>
                        </form>
                    @endauth
                </div>
                <nav class="lg:hidden w-full flex gap-2 overflow-x-auto scrollbar-hide pb-1">
                    @foreach($navItems as $item)
                        <a href="{{ $item['url'] }}" class="shrink-0 h-9 px-4 rounded-full border text-xs flex items-center {{ $item['active'] ? 'bg-primary text-primary-foreground border-primary' : 'bg-card border-border text-muted-foreground' }}">{{ $item['label'] }}</a>
                    @endforeach
                </nav>
            </header>
            <main class="flex-1 p-4 sm:p-8">
                @if(session('success'))
                    <div class="mb-5 rounded-xl border border-success/30 bg-success/10 text-success px-4 py-3 text-sm">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="mb-5 rounded-xl border border-destructive/30 bg-destructive/10 text-destructive px-4 py-3 text-sm">{{ $errors->first() }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
