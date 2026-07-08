@extends('layouts.site')
@section('title', 'Contact — ZANEXT STORE')

@section('content')
    <section class="mx-auto max-w-3xl px-6 lg:px-10 text-center">
        <div class="text-xs tracking-[0.3em] text-primary font-semibold mb-3">CONTACT</div>
        <h1 class="font-display font-black text-5xl lg:text-6xl">Let's talk.</h1>
        <p class="text-muted-foreground mt-6">We respond to all messages within 24 hours.</p>

        <form class="mt-12 space-y-5 text-left">
            <div class="grid sm:grid-cols-2 gap-4">
                <input placeholder="Your name" class="h-12 px-4 rounded-xl border border-border bg-card text-sm focus:outline-none focus:border-primary">
                <input type="email" placeholder="Your email" class="h-12 px-4 rounded-xl border border-border bg-card text-sm focus:outline-none focus:border-primary">
            </div>
            <input placeholder="Subject" class="w-full h-12 px-4 rounded-xl border border-border bg-card text-sm focus:outline-none focus:border-primary">
            <textarea placeholder="Your message" rows="6" class="w-full px-4 py-3 rounded-xl border border-border bg-card text-sm focus:outline-none focus:border-primary"></textarea>
            <button class="h-12 px-7 rounded-full bg-primary text-primary-foreground font-semibold text-sm">Send Message</button>
        </form>
    </section>
@endsection
