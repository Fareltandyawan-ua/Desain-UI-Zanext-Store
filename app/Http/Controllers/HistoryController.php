<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class HistoryController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->id())
            ->orWhereNull('user_id')
            ->latest()
            ->get();
        return view('pages.history', compact('transactions'));
    }
}
