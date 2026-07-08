@extends('layouts.site')
@section('title', $article->title . ' — ZANEXT STORE')

@section('content')
    <article class="mx-auto max-w-4xl px-6 lg:px-10">
        <nav class="text-xs text-muted-foreground mb-8 flex gap-2">
            <a href="{{ route('home') }}" class="hover:text-foreground">Home</a> /
            <a href="{{ route('articles.index') }}" class="hover:text-foreground">Articles</a> /
            <span class="text-foreground">{{ $article->title }}</span>
        </nav>

        <div class="flex items-center gap-3 text-xs text-muted-foreground mb-4">
            <span class="px-2 py-1 rounded-full bg-white/5 border border-border">{{ $article->category }}</span>
            <span>{{ $article->date }}</span>
            <span>· {{ $article->author }}</span>
        </div>

        <h1 class="font-display font-black text-4xl lg:text-6xl leading-[1.05]">{{ $article->title }}</h1>

        <div class="aspect-[16/9] rounded-3xl overflow-hidden mt-10 border border-border">
            <img src="{{ asset('assets/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
        </div>

        <div class="mt-12 prose prose-invert max-w-none text-foreground/90 leading-relaxed">
            {!! $article->content ?? '<p>' . $article->excerpt . '</p>' !!}
        </div>

        <div class="mt-20">
            <h2 class="font-display font-bold text-2xl mb-6">More from the journal</h2>
            <div class="grid sm:grid-cols-3 gap-5">
                @foreach($more as $a)
                    <a href="{{ route('articles.show', $a->id) }}" class="rounded-2xl border border-border bg-card overflow-hidden card-hover">
                        <img src="{{ asset('assets/' . $a->image) }}" alt="" class="w-full aspect-[16/10] object-cover">
                        <div class="p-5">
                            <p class="text-xs text-muted-foreground">{{ $a->category }} · {{ $a->date }}</p>
                            <p class="font-display font-semibold mt-2">{{ $a->title }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </article>
@endsection
