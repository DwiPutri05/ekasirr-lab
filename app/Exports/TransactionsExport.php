<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public function query()
    {
        return Transaction::with('user')
            ->select(['id', 'user_id', 'total_price', 'created_at'])
            ->orderByDesc('created_at');
    }

    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Kasir',
            'Total',
            'Tanggal',
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->id,
            $transaction->user->name ?? 'Unknown',
            $transaction->total_price,
            $transaction->created_at->format('d-m-Y H:i'),
        ];
    }
}
