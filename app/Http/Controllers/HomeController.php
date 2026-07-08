<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Product::limit(4)->get();
        $latest = Product::skip(4)->take(4)->get();
        $articles = Article::limit(3)->get();

        $categories = [
            ['name' => 'Lifestyle', 'count' => 124, 'image' => 'sneaker-1.jpg'],
            ['name' => 'Running', 'count' => 86, 'image' => 'sneaker-3.jpg'],
            ['name' => 'Streetwear', 'count' => 52, 'image' => 'sneaker-4.jpg'],
            ['name' => 'Training', 'count' => 38, 'image' => 'sneaker-2.jpg'],
        ];

        $brands = ['NIKE', 'ADIDAS', 'JORDAN', 'NEW BALANCE', 'PUMA', 'YEEZY', 'ASICS', 'REEBOK'];

        return view('pages.index', compact('featured', 'latest', 'articles', 'categories', 'brands'));
    }
}
