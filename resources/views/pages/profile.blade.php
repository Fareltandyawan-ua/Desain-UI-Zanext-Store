@extends('layouts.site')
@section('title', 'Profile — ZANEXT STORE')

@section('content')
    <section class="mx-auto max-w-3xl px-6 lg:px-10">
        <h1 class="font-display font-black text-4xl lg:text-5xl">Your Profile</h1>
        <p class="text-muted-foreground mt-3">Manage your account information.</p>

        <div class="mt-12 rounded-2xl border border-border bg-card p-7">
            <div class="flex items-center gap-4 mb-8">
                <div class="size-16 rounded-2xl bg-primary text-primary-foreground grid place-items-center font-display font-black text-2xl">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <p class="font-display font-bold text-xl">{{ $user->name }}</p>
                    <p class="text-xs uppercase tracking-widest text-primary">{{ $user->role }}</p>
                </div>
            </div>

            @if(session('success'))
                <p class="text-success text-sm mb-4">{{ session('success') }}</p>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
                @csrf @method('PATCH')
                <div>
                    <label class="text-xs uppercase tracking-widest text-muted-foreground">Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="mt-2 w-full h-12 px-4 rounded-xl border border-border bg-background text-sm focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="text-xs uppercase tracking-widest text-muted-foreground">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="mt-2 w-full h-12 px-4 rounded-xl border border-border bg-background text-sm focus:outline-none focus:border-primary">
                </div>
                <button type="submit" class="h-12 px-7 rounded-full bg-primary text-primary-foreground font-semibold text-sm">Save Changes</button>
            </form>
        </div>
    </section>
@endsection
