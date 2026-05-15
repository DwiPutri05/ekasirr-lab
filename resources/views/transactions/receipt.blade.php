<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi #{{ $transaction->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; color: #111827; margin: 0; padding: 0; }
        .container { width: 100%; padding: 24px; }
        .header { text-align: center; margin-bottom: 24px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header p { margin: 4px 0 0; color: #4b5563; }
        .card { border: 1px solid #e5e7eb; border-radius: 16px; padding: 18px; }
        .meta { display: flex; justify-content: space-between; flex-wrap: wrap; margin-bottom: 18px; }
        .label { color: #6b7280; font-size: 12px; text-transform: uppercase; letter-spacing: .08em; }
        .value { color: #111827; font-weight: 600; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { padding: 10px 8px; border-bottom: 1px solid #e5e7eb; text-align: left; }
        th { background: #f8fafc; color: #374151; font-size: 13px; }
        tbody tr:last-child td { border-bottom: none; }
        .text-right { text-align: right; }
        .total { margin-top: 18px; display: flex; justify-content: space-between; font-size: 16px; font-weight: 700; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>e-KASIR LAB</h1>
            <p>Struk Transaksi Resmi</p>
        </div>

        <div class="card">
            <div class="meta">
                <div>
                    <p class="label">No. Transaksi</p>
                    <p class="value">#{{ $transaction->id }}</p>
                </div>
                <div>
                    <p class="label">Tanggal</p>
                    <p class="value">{{ $transaction->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th class="text-right">Qty</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->transactionItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td class="text-right">{{ $item->qty }}</td>
                            <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total">
                <span>Total Pembayaran</span>
                <span>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</body>
</html>
