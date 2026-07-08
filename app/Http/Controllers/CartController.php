<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items = collect(session('cart', []))->values();
        $subtotal = $items->sum(fn ($i) => $i['price'] * $i['qty']);
        $shipping = ($subtotal === 0 || $subtotal >= 200) ? 0 : 12;
        $total = $subtotal + $shipping;

        return view('pages.cart', compact('items', 'subtotal', 'shipping', 'total'));
    }

    public function add(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $size = $request->input('size', '42');
        $color = $request->input('color', 'Core Black');
        $qty = max(1, (int) $request->input('qty', 1));
        $key = "{$id}:{$size}:{$color}";

        $cart = session('cart', []);
        if (isset($cart[$key])) {
            $cart[$key]['qty'] += $qty;
        } else {
            $cart[$key] = [
                'key' => $key,
                'product_id' => $product->id,
                'name' => $product->name,
                'brand' => $product->brand,
                'price' => $product->price,
                'image' => $product->image,
                'size' => $size,
                'color' => $color,
                'qty' => $qty,
            ];
        }
        session(['cart' => $cart]);

        return back()->with('success', "Added {$product->name} to cart");
    }

    public function update(Request $request, string $key)
    {
        $qty = (int) $request->input('qty', 1);
        $cart = session('cart', []);
        if (isset($cart[$key])) {
            if ($qty <= 0) {
                unset($cart[$key]);
            } else {
                $cart[$key]['qty'] = $qty;
            }
            session(['cart' => $cart]);
        }
        return back();
    }

    public function remove(string $key)
    {
        $cart = session('cart', []);
        unset($cart[$key]);
        session(['cart' => $cart]);
        return back();
    }

    public function clear()
    {
        session()->forget('cart');
        return back();
    }
}
