<?php

namespace App\Http\Controllers;

use App\Models\Product;

class WishlistController extends Controller
{
    public function index()
    {
        $ids = session('wishlist', []);
        $products = Product::whereIn('id', $ids)->get();
        return view('pages.wishlist', compact('products'));
    }

    public function add(string $id)
    {
        $ids = session('wishlist', []);
        if (!in_array($id, $ids, true)) {
            $ids[] = $id;
            session(['wishlist' => $ids]);
        }
        return back()->with('success', 'Saved to wishlist');
    }

    public function remove(string $id)
    {
        $ids = array_values(array_filter(session('wishlist', []), fn ($x) => $x !== $id));
        session(['wishlist' => $ids]);
        return back();
    }
}
