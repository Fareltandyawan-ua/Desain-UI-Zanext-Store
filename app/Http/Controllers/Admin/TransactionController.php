<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $status = $request->query('status', 'all');

        $transactions = Transaction::query()
            ->when($search, function ($query) use ($search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhere('product', 'like', "%{$search}%")
                    ->orWhere('payment_method', 'like', "%{$search}%");
            })
            ->when($status !== 'all', fn ($query) => $query->where('status', $status))
            ->latest()
            ->get();

        return view('pages.dashboard.transactions', compact('transactions', 'search', 'status'));
    }

    public function update(Request $request, string $id)
    {
        $tx = Transaction::findOrFail($id);
        $tx->update($request->only(['status']));
        return back()->with('success', 'Transaction updated');
    }
}
