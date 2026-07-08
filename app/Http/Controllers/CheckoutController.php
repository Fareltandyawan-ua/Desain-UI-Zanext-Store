<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $items = collect(session('cart', []))->values();
        $subtotal = $items->sum(fn ($i) => $i['price'] * $i['qty']);
        $shipping = ($subtotal === 0 || $subtotal >= 200) ? 0 : 12;
        $total = $subtotal + $shipping;

        return view('pages.checkout.index', compact('items', 'subtotal', 'shipping', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $items = collect(session('cart', []));
        if ($items->isEmpty()) {
            return back()->with('error', 'Cart is empty.');
        }

        $total = $items->sum(fn ($i) => $i['price'] * $i['qty']);
        $orderId = 'ZNX-' . date('Y') . '-' . random_int(1000, 9999);
        $firstItem = $items->first();
        $productLabel = $items->count() > 1
            ? (($firstItem['name'] ?? 'Order') . ' + ' . ($items->count() - 1) . ' items')
            : ($firstItem['name'] ?? 'Order');
        $paymentMethod = $request->input('payment_method', 'card');

        Transaction::create([
            'id' => $orderId,
            'user_id' => auth()->id(),
            'product' => $productLabel,
            'date' => date('M d, Y'),
            'amount' => $total,
            'status' => 'Processing',
            'payment_method' => $paymentMethod,
        ]);

        session()->forget('cart');
        session([
            'last_order_id' => $orderId,
            'last_order_summary' => [
                'status' => 'Processing',
                'payment_method' => $paymentMethod,
                'total' => $total,
                'items' => $items->values()->all(),
                'shipping' => [
                    'name' => trim($request->input('first_name') . ' ' . $request->input('last_name')),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'city' => $request->input('city'),
                    'postal_code' => $request->input('postal_code'),
                ],
            ],
        ]);

        return redirect()->route('checkout.success');
    }

    public function success()
    {
        $orderId = session('last_order_id', 'ZNX-' . date('Y') . '-' . random_int(1000, 9999));
        $summary = session('last_order_summary', []);
        return view('pages.checkout.success', compact('orderId', 'summary'));
    }
}
