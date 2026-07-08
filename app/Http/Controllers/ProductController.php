<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        $related = Product::where('id', '!=', $id)->limit(4)->get();
        $gallery = $related->take(3)->pluck('image')->prepend($product->image)->take(4);

        return view('pages.product', compact('product', 'related', 'gallery'));
    }
}
