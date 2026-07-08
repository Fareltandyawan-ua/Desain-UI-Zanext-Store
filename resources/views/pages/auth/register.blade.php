@extends('layouts.site')

@section('title', 'Sign Up — ZANEXT STORE')

@section('content')
    <section class="mx-auto max-w-6xl px-6 lg:px-10 grid lg:grid-cols-2 gap-12 items-center">
        <div class="hidden lg:block">
            <span class="inline-flex items-center gap-2 text-xs uppercase tracking-[0.3em] text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3z"/></svg>
                Become a Member
            </span>
            <h1 class="font-display font-black text-5xl xl:text-6xl mt-6 leading-[1.05]">
                Join <span class="text-primary">ZANEXT</span>.
            </h1>
            <p class="text-muted-foreground mt-6 max-w-md">
                Create an account to access exclusive drops, member-only collections, and personalized recommendations.
            </p>
        </div>

        <div class="glass rounded-3xl p-8 lg:p-10">
            <h2 class="font-display font-black text-3xl">Create Account</h2>
            <p class="text-muted-foreground text-sm mt-2">Join the culture in 30 seconds.</p>

            <form method="POST" action="{{ route('register.attempt') }}" class="mt-8 space-y-5">
                @csrf
                <div>
                    <label class="text-xs uppercase tracking-widest text-muted-foreground">Full Name</label>
                    <input type="text" name="name" required value="{{ old('name') }}" placeholder="Alex Carter" class="mt-2 w-full h-12 px-4 rounded-xl border border-border bg-background/40 text-sm focus:outline-none focus:border-primary">
                    @error('name') <p class="text-xs text-destructive mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-xs uppercase tracking-widest text-muted-foreground">Email</label>
                    <input type="email" name="email" required value="{{ old('email') }}" placeholder="you@zanext.com" class="mt-2 w-full h-12 px-4 rounded-xl border border-border bg-background/40 text-sm focus:outline-none focus:border-primary">
                    @error('email') <p class="text-xs text-destructive mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-xs uppercase tracking-widest text-muted-foreground">Password</label>
                    <input type="password" name="password" required placeholder="••••••••" class="mt-2 w-full h-12 px-4 rounded-xl border border-border bg-background/40 text-sm focus:outline-none focus:border-primary">
                    @error('password') <p class="text-xs text-destructive mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-xs uppercase tracking-widest text-muted-foreground">Confirm Password</label>
                    <input type="password" name="password_confirmation" required placeholder="••••••••" class="mt-2 w-full h-12 px-4 rounded-xl border border-border bg-background/40 text-sm focus:outline-none focus:border-primary">
                </div>

                <button type="submit" class="w-full h-12 rounded-xl bg-primary text-primary-foreground font-display font-bold tracking-wide hover:opacity-90 transition-opacity glow-primary">
                    Create Account
                </button>
            </form>

            <p class="text-sm text-muted-foreground mt-6 text-center">
                Already a member?
                <a href="{{ route('login') }}" class="text-primary font-semibold hover:underline">Sign in</a>
            </p>
        </div>
    </section>
@endsection
