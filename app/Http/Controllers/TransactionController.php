<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name')->get();
        $totalProducts = Product::count();
        $todayTransactions = Transaction::where('user_id', auth()->id())
            ->whereDate('created_at', now())
            ->count();
        $todaySales = Transaction::where('user_id', auth()->id())
            ->whereDate('created_at', now())
            ->sum('total_price');

        return view('kasir.dashboard', compact('products', 'totalProducts', 'todayTransactions', 'todaySales'));
    }

    public function checkout(CheckoutRequest $request)
    {
        $data = $request->validated();

        $items = [];
        $totalPrice = 0;

        foreach ($data['items'] as $item) {
            $product = Product::find($item['product_id']);
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan.'
                ], 404);
            }

            if ($product->stock < $item['qty']) {
                return response()->json([
                    'success' => false,
                    'message' => "Stok untuk produk {$product->name} tidak cukup."
                ], 400);
            }

            $subtotal = $product->price * $item['qty'];
            $items[] = [
                'product_id' => $product->id,
                'quantity' => $item['qty'],
                'price' => $product->price,
                'subtotal' => $subtotal,
            ];

            $totalPrice += $subtotal;
        }

        if (empty($items)) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan pilih setidaknya satu produk.'
            ], 400);
        }

        // Verify total matches
        if (abs($totalPrice - $data['total']) > 0.01) {
            return response()->json([
                'success' => false,
                'message' => 'Total harga tidak sesuai.'
            ], 400);
        }

        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'total_price' => $totalPrice,
            'paid_amount' => $data['paid'],
            'change_amount' => $data['change'],
        ]);

        foreach ($items as $item) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item['product_id'],
                'qty' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal'],
            ]);

            Product::where('id', $item['product_id'])
                ->decrement('stock', $item['quantity']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil.',
            'transaction_id' => $transaction->id,
            'total' => $totalPrice,
            'paid' => $data['paid'],
            'change' => $data['change']
        ]);
    }

    public function printReceipt($id)
    {
        $transaction = Transaction::with(['transactionItems.product', 'user'])
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $itemCount = $transaction->transactionItems->count();
        $dynamicHeight = 200 + ($itemCount * 40);

        $pdf = Pdf::loadView('receipt', compact('transaction'));
        $pdf->setPaper([0, 0, 164.57, $dynamicHeight], 'portrait');

        return $pdf->download('struk-transaksi-'.$transaction->id.'.pdf');
    }

    public function history()
    {
        $transactions = Transaction::with(['transactionItems.product', 'user'])
            ->withCount('transactionItems')
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();

        return view('transactions.history', compact('transactions'));
    }

    public function detail($id)
    {
        $transaction = Transaction::with(['transactionItems.product'])
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('transactions.detail', compact('transaction'));
    }
}
