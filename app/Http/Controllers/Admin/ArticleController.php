<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $articles = Article::query()
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
            })
            ->orderBy('title')
            ->get();

        return view('pages.dashboard.articles', compact('articles', 'search'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'string', 'unique:articles,id'],
            'title' => ['required', 'string'],
            'excerpt' => ['required', 'string'],
            'image_file' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
            'category' => ['required', 'string'],
            'date' => ['required', 'string'],
            'author' => ['required', 'string'],
            'content' => ['nullable', 'string'],
        ]);
        $data['image'] = $this->uploadImage($request);
        unset($data['image_file']);

        Article::create($data);
        return back()->with('success', 'Article created');
    }

    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);
        $data = $request->validate([
            'title' => ['required', 'string'],
            'excerpt' => ['required', 'string'],
            'content' => ['nullable', 'string'],
            'category' => ['required', 'string'],
            'date' => ['required', 'string'],
            'author' => ['required', 'string'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
        ]);

        if ($request->hasFile('image_file')) {
            $data['image'] = $this->uploadImage($request);
        }
        unset($data['image_file']);

        $article->update($data);
        return back()->with('success', 'Article updated');
    }

    public function destroy(string $id)
    {
        Article::findOrFail($id)->delete();
        return back()->with('success', 'Article deleted');
    }

    private function uploadImage(Request $request): string
    {
        $file = $request->file('image_file');
        $filename = uniqid('article_', true) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets'), $filename);

        return $filename;
    }
}
