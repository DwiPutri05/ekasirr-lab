<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Statistik utama hari ini
        $todayIncome = Transaction::whereDate('created_at', today())->sum('total_price');

        $todayTransactions = Transaction::whereDate('created_at', today())->count();

        $todayItems = TransactionItem::whereHas('transaction', function($q) {
            $q->whereDate('created_at', today());
        })->sum('qty');

        $totalUsers = User::count();

        // Transaksi terbaru (5 terakhir)
        $recentTransactions = Transaction::with('transactionItems', 'user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'todayIncome',
            'todayTransactions',
            'todayItems',
            'totalUsers',
            'recentTransactions'
        ));
    }
}