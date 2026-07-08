<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('pages.articles.index', compact('articles'));
    }

    public function show(string $id)
    {
        $article = Article::findOrFail($id);
        $more = Article::where('id', '!=', $id)->limit(3)->get();
        return view('pages.articles.show', compact('article', 'more'));
    }
}
