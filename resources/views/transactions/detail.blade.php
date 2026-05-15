<x-app-layout>
    <x-slot name="header">Detail Transaksi</x-slot>

    <div class="space-y-6">
        <div class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Detail Transaksi</p>
                    <h1 class="mt-3 text-3xl font-semibold text-slate-900">Transaksi #{{ $transaction->id }}</h1>
                    <p class="mt-2 text-sm text-slate-500">Tanggal: {{ $transaction->created_at->format('d M Y H:i') }}</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('transactions.history') }}" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-indigo-700">
                        Kembali ke Riwayat
                    </a>
                    <a href="{{ route('transactions.struk', $transaction->id) }}" download class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-slate-800">
                        Cetak Struk
                    </a>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900">Informasi Transaksi</h2>
                <div class="mt-5 space-y-4 text-sm text-slate-600">
                    <div class="flex items-center justify-between">
                        <span>Status</span>
                        <span class="font-semibold text-slate-900">Selesai</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Total Harga</span>
                        <span class="font-semibold text-slate-900">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Jumlah Item</span>
                        <span class="font-semibold text-slate-900">{{ $transaction->transactionItems->count() }}</span>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50 text-slate-700">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold uppercase tracking-[0.16em]">Produk</th>
                            <th class="px-6 py-3 text-right font-semibold uppercase tracking-[0.16em]">Qty</th>
                            <th class="px-6 py-3 text-right font-semibold uppercase tracking-[0.16em]">Harga</th>
                            <th class="px-6 py-3 text-right font-semibold uppercase tracking-[0.16em]">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @foreach($transaction->transactionItems as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-slate-900">{{ $item->product->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-slate-900">{{ $item->qty }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-slate-900">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-slate-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
