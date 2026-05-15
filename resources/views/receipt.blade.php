<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi #{{ $transaction->id }}</title>
    <style>
        @page {
            size: 58mm auto;
            margin: 0;
        }

        body {
            width: 58mm;
            margin: 0;
            padding: 5px;
            font-family: "Courier New", Courier, monospace;
            font-size: 11px;
            color: #000;
            background: #fff;
        }

        .receipt {
            width: 58mm;
            margin: 0;
            padding: 0;
        }

        .center {
            text-align: center;
        }

        .small {
            font-size: 10px;
        }

        .separator {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }

        .line {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            white-space: nowrap;
        }

        .line .label {
            display: inline-block;
        }

        .item-name {
            margin: 4px 0 0;
            word-break: break-word;
        }

        .item-detail {
            display: flex;
            justify-content: space-between;
            margin-top: 2px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            margin-top: 6px;
            font-size: 12px;
        }

        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 10px;
            line-height: 1.3;
        }

        .wide {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="center">
            <div style="font-weight:700;">e-KASIR LAB</div>
            <div>Mini Kampus / Lab</div>
        </div>

        <div class="separator"></div>

        <div class="line">
            <span>Tanggal</span>
            <span>{{ $transaction->created_at->format('d-m-Y') }}</span>
        </div>
        <div class="line">
            <span>Jam</span>
            <span>{{ $transaction->created_at->format('H:i') }}</span>
        </div>
        <div class="line">
            <span>Kasir</span>
            <span>{{ $transaction->user->name ?? 'Kasir' }}</span>
        </div>
        <div class="line">
            <span>ID</span>
            <span>{{ $transaction->id }}</span>
        </div>

        <div class="separator"></div>

        @foreach($transaction->transactionItems as $item)
            <div class="item-name">{{ $item->product->name }}</div>
            <div class="item-detail">
                <span>{{ $item->qty }} x {{ number_format($item->price, 0, ',', '.') }}</span>
                <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
            </div>
        @endforeach

        <div class="separator"></div>

        <div class="total-row">
            <span>TOTAL</span>
            <span>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
        </div>
        <div class="line">
            <span>BAYAR</span>
            <span>Rp {{ number_format($transaction->paid_amount, 0, ',', '.') }}</span>
        </div>
        <div class="line">
            <span>KEMBALIAN</span>
            <span>Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</span>
        </div>

        <div class="separator"></div>

        <div class="footer">
            <div>Terima kasih</div>
            <div>Simpan struk ini</div>
        </div>
    </div>
</body>
</html>
