<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        $category = $request->query('category', 'All');
        $brand = $request->query('brand', 'All');
        $search = trim((string) $request->query('search', ''));
        $price = $request->query('price', 'all');
        $minRating = (float) $request->query('rating', 0);
        $sort = $request->query('sort', 'featured');

        if ($category !== 'All') {
            $query->where('category', $category);
        }

        if ($brand !== 'All') {
            $query->where('brand', $brand);
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('tag', 'like', "%{$search}%");
            });
        }

        match ($price) {
            'under-200' => $query->where('price', '<', 200),
            '200-250' => $query->whereBetween('price', [200, 250]),
            'above-250' => $query->where('price', '>', 250),
            default => null,
        };

        if ($minRating > 0) {
            $query->where('rating', '>=', $minRating);
        }

        match ($sort) {
            'price-asc' => $query->orderBy('price'),
            'price-desc' => $query->orderByDesc('price'),
            'rating-desc' => $query->orderByDesc('rating'),
            'name-asc' => $query->orderBy('name'),
            default => null,
        };

        $products = $query->get();
        $allCount = Product::count();
        $brands = ['All', ...Product::distinct()->pluck('brand')->toArray()];
        $categories = ['All', 'Lifestyle', 'Running', 'Streetwear', 'Training'];

        return view('pages.catalog', compact(
            'products', 'allCount', 'brands', 'categories',
            'category', 'brand', 'search', 'price', 'minRating', 'sort'
        ));
    }
}
