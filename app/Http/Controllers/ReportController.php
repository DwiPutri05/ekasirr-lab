<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $today = now();
        $dailyTotal = Transaction::whereDate('created_at', $today->toDateString())->sum('total_price');
        $dailyCount = Transaction::whereDate('created_at', $today->toDateString())->count();

        $monthlyTotal = Transaction::whereMonth('created_at', $today->month)
            ->whereYear('created_at', $today->year)
            ->sum('total_price');
        $monthlyCount = Transaction::whereMonth('created_at', $today->month)
            ->whereYear('created_at', $today->year)
            ->count();

        $range = collect(range(6, 0));
        $labels = [];
        $chartData = [];

        foreach ($range as $day) {
            $date = $today->copy()->subDays($day);
            $labels[] = $date->format('d M');
            $chartData[] = Transaction::whereDate('created_at', $date)->sum('total_price');
        }

        return view('reports.index', compact('dailyTotal', 'dailyCount', 'monthlyTotal', 'monthlyCount', 'labels', 'chartData'));
    }

    public function exportExcel()
    {
        return Excel::download(new TransactionsExport(), 'laporan-transaksi.xlsx');
    }
}
