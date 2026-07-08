@extends('layouts.site')

@section('title', 'Sign In — ZANEXT STORE')

@section('content')
    <section class="mx-auto max-w-6xl px-6 lg:px-10 grid lg:grid-cols-2 gap-12 items-center">
        <div class="hidden lg:block">
            <span class="inline-flex items-center gap-2 text-xs uppercase tracking-[0.3em] text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    <path d="m9 12 2 2 4-4" />
                </svg>
                Members Area
            </span>

            <h1 class="font-display font-black text-5xl xl:text-6xl mt-6 leading-[1.05]">
                Welcome to <span class="text-primary">ZANEXT</span>.
            </h1>

            <p class="text-muted-foreground mt-6 max-w-md">
                Sign in to access your account, manage your orders, and stay updated on the latest drops and releases.
            </p>

            <div class="mt-10 space-y-6">
                <div>
                    <p class="font-semibold">Manage Orders</p>
                    <p class="text-sm text-muted-foreground">View and track all your orders in one place.</p>
                </div>
                <div>
                    <p class="font-semibold">Stay Updated</p>
                    <p class="text-sm text-muted-foreground">Get early access to exclusive drops and releases.</p>
                </div>
                <div>
                    <p class="font-semibold">Your Account</p>
                    <p class="text-sm text-muted-foreground">Manage your profile and preferences easily.</p>
                </div>
            </div>
        </div>

        <div class="glass rounded-3xl p-8 lg:p-10">
            <div class="size-12 rounded-2xl bg-primary grid place-items-center mb-6 glow-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-primary-foreground" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
            </div>

            <h2 class="font-display font-black text-3xl">Sign In</h2>
            <p class="text-muted-foreground text-sm mt-2">Enter your credentials to continue.</p>

            <form method="POST" action="{{ route('login.attempt') }}" class="mt-8 space-y-5">
                @csrf
                <div>
                    <label class="text-xs uppercase tracking-widest text-muted-foreground">Email</label>
                    <div
                        class="mt-2 flex items-center gap-3 rounded-xl border border-border bg-background/40 px-4 h-12 focus-within:border-primary transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-muted-foreground" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <rect width="20" height="16" x="2" y="4" rx="2" />
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                        </svg>
                        <input type="email" name="email" required value="{{ old('email') }}" placeholder="you@zanext.com"
                            class="bg-transparent outline-none flex-1 text-sm">
                    </div>
                </div>

                <div>
                    <label class="text-xs uppercase tracking-widest text-muted-foreground">Password</label>
                    <div
                        class="mt-2 flex items-center gap-3 rounded-xl border border-border bg-background/40 px-4 h-12 focus-within:border-primary transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-muted-foreground" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                        <input type="password" name="password" required placeholder="••••••••"
                            class="bg-transparent outline-none flex-1 text-sm">
                    </div>
                </div>

                @error('email')
                    <p class="text-sm text-destructive bg-destructive/10 border border-destructive/30 rounded-lg px-3 py-2">
                        {{ $message }}</p>
                @enderror

                <button type="submit"
                    class="w-full h-12 rounded-xl bg-primary text-primary-foreground font-display font-bold tracking-wide hover:opacity-90 transition-opacity glow-primary">
                    Sign In
                </button>
            </form>

            <p class="text-sm text-muted-foreground mt-6 text-center">
                New to ZANEXT?
                <a href="{{ route('register') }}" class="text-primary font-semibold hover:underline">Create an account</a>
            </p>
        </div>
    </section>
@endsection