<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'revenue' => Transaction::sum('amount'),
            'orders' => Transaction::count(),
            'products' => Product::count(),
            'users' => User::count(),
        ];
        $recent = Transaction::latest()->limit(5)->get();

        return view('pages.dashboard.index', compact('stats', 'recent'));
    }
}
