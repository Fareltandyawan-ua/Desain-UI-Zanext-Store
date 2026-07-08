<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $products = Product::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->get();

        return view('pages.dashboard.products', compact('products', 'search'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'string', 'unique:products,id'],
            'name' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'rating' => ['required', 'numeric'],
            'image_file' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
            'category' => ['required', 'string'],
            'old_price' => ['nullable', 'integer'],
            'tag' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'stock' => ['nullable', 'integer'],
        ]);
        $data['stock'] = $data['stock'] ?? 0;
        $data['image'] = $this->uploadImage($request);
        unset($data['image_file']);

        Product::create($data);
        return back()->with('success', 'Product created');
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validate([
            'name' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'old_price' => ['nullable', 'integer'],
            'rating' => ['required', 'numeric'],
            'category' => ['required', 'string'],
            'tag' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'stock' => ['nullable', 'integer'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
        ]);

        if ($request->hasFile('image_file')) {
            $data['image'] = $this->uploadImage($request);
        }
        unset($data['image_file']);

        $product->update($data);
        return back()->with('success', 'Product updated');
    }

    public function destroy(string $id)
    {
        Product::findOrFail($id)->delete();
        return back()->with('success', 'Product deleted');
    }

    private function uploadImage(Request $request): string
    {
        $file = $request->file('image_file');
        $filename = uniqid('product_', true) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets'), $filename);

        return $filename;
    }
}
