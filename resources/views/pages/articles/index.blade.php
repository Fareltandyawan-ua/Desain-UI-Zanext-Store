@extends('layouts.site')
@section('title', 'Articles — ZANEXT STORE')

@section('content')
    <section class="mx-auto max-w-7xl px-6 lg:px-10">
        <div class="text-xs tracking-[0.3em] text-primary font-semibold mb-3">THE JOURNAL</div>
        <h1 class="font-display font-black text-4xl sm:text-5xl lg:text-6xl">Stories from the culture.</h1>
        <p class="text-muted-foreground mt-4 max-w-xl">Long-form pieces about sneakers, streetwear and the people shaping it.</p>

        <div class="grid lg:grid-cols-3 gap-6 mt-12">
            @foreach($articles as $article)
                <a href="{{ route('articles.show', $article->id) }}" class="group rounded-2xl overflow-hidden bg-card border border-border card-hover">
                    <div class="aspect-[16/10] overflow-hidden">
                        <img src="{{ asset('assets/' . $article->image) }}" alt="{{ $article->title }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    </div>
                    <div class="p-6 space-y-3">
                        <div class="flex items-center gap-3 text-xs text-muted-foreground">
                            <span class="px-2 py-1 rounded-full bg-white/5 border border-border">{{ $article->category }}</span>
                            <span>{{ $article->date }}</span>
                        </div>
                        <h3 class="font-display font-semibold text-xl group-hover:text-primary transition-colors">{{ $article->title }}</h3>
                        <p class="text-sm text-muted-foreground">{{ $article->excerpt }}</p>
                        <p class="text-xs text-muted-foreground mt-3">By {{ $article->author }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endsection
