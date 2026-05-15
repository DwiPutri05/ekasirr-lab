<x-app-layout>
    <x-slot name="header">Riwayat Transaksi</x-slot>

    <div class="space-y-6">
        <div class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Riwayat Kasir</p>
                    <h1 class="mt-3 text-3xl font-semibold text-slate-900">Riwayat Transaksi</h1>
                    <p class="mt-2 text-sm text-slate-500">Lihat semua transaksi yang sudah Anda proses.</p>
                </div>
                <a href="{{ route('kasir.dashboard') }}" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-indigo-700">
                    Kembali ke Kasir
                </a>
            </div>
        </div>

        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-slate-700">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold uppercase tracking-[0.16em]">Kode</th>
                        <th class="px-6 py-3 text-left font-semibold uppercase tracking-[0.16em]">Tanggal</th>
                        <th class="px-6 py-3 text-right font-semibold uppercase tracking-[0.16em]">Total</th>
                        <th class="px-6 py-3 text-right font-semibold uppercase tracking-[0.16em]">Item</th>
                        <th class="px-6 py-3 text-right font-semibold uppercase tracking-[0.16em]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($transactions as $transaction)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-slate-900 font-medium">#{{ $transaction->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-slate-500">{{ $transaction->created_at->format('d M Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-slate-900 font-semibold">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-slate-900">{{ $transaction->transaction_items_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                                <button onclick="openDetailModal({{ $transaction->id }})" class="inline-flex items-center rounded-full bg-indigo-600 px-4 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-white transition hover:bg-indigo-700">Detail</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-6 py-12 text-center text-slate-500" colspan="5">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Detail Transaction Modal -->
    <div id="detail-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center pt-4 px-4 pb-20 sm:p-0 bg-black/50 backdrop-blur-sm" role="dialog" aria-modal="true">
        <div class="transform transition-all duration-300 opacity-100 scale-100 inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-2xl sm:my-8 sm:align-middle sm:w-full sm:max-w-2xl">
            
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-5 sm:px-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-white" id="detail-modal-title">Detail Transaksi</h3>
                        <p class="text-indigo-100 text-sm mt-1">Informasi lengkap pembayaran</p>
                    </div>
                    <button onclick="closeDetailModal()" class="text-white hover:text-indigo-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </button>
                </div>
            </div>

            <!-- Body - Scrollable -->
            <div class="px-6 py-6 sm:px-8 max-h-[calc(100vh-300px)] overflow-y-auto">
                
                <!-- Section 1: Transaction Info -->
                <div class="space-y-4">
                    <h4 class="text-sm font-semibold text-slate-700 uppercase tracking-[0.1em]">📋 Informasi Transaksi</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                            <p class="text-xs font-medium text-slate-600">Kode Transaksi</p>
                            <p id="detail-transaction-id" class="text-lg font-bold text-slate-900 mt-1">#12345</p>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                            <p class="text-xs font-medium text-slate-600">Tanggal & Jam</p>
                            <p id="detail-transaction-date" class="text-lg font-bold text-slate-900 mt-1">01 Jan 2026 12:30</p>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                            <p class="text-xs font-medium text-slate-600">Nama Kasir</p>
                            <p id="detail-cashier-name" class="text-lg font-bold text-slate-900 mt-1">-</p>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                            <p class="text-xs font-medium text-slate-600">Status</p>
                            <p id="detail-status" class="text-lg font-bold text-slate-900 mt-1">
                                <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">✓ Selesai</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-slate-200 my-6"></div>

                <!-- Section 2: Item Details -->
                <div class="space-y-4">
                    <h4 class="text-sm font-semibold text-slate-700 uppercase tracking-[0.1em]">📦 Daftar Item</h4>
                    <div class="space-y-3" id="detail-items-list">
                        <!-- Items will be populated here -->
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-slate-200 my-6"></div>

                <!-- Section 3: Payment Summary -->
                <div class="space-y-4">
                    <h4 class="text-sm font-semibold text-slate-700 uppercase tracking-[0.1em]">💰 Ringkasan Pembayaran</h4>
                    <div class="space-y-3">
                        <!-- Total Belanja -->
                        <div class="flex items-center justify-between bg-slate-50 rounded-xl p-4 border border-slate-200">
                            <span class="text-sm text-slate-600 font-medium">Total Belanja</span>
                            <span id="detail-total-price" class="text-lg font-semibold text-slate-900">Rp 0</span>
                        </div>

                        <!-- Paid Amount -->
                        <div class="flex items-center justify-between bg-slate-50 rounded-xl p-4 border border-slate-200">
                            <span class="text-sm text-slate-600 font-medium">Uang Diterima</span>
                            <span id="detail-paid-amount" class="text-lg font-semibold text-slate-900">Rp 0</span>
                        </div>

                        <!-- Change/Kembalian - PROMINENT -->
                        <div class="flex items-center justify-between bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl p-4 border-2 border-emerald-300">
                            <span class="text-sm font-semibold text-emerald-700">💵 Kembalian</span>
                            <span id="detail-change-amount" class="text-2xl font-bold text-emerald-700">Rp 0</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer -->
            <div class="bg-slate-50 border-t border-slate-200 px-6 py-4 sm:px-8 flex gap-3">
                <a id="detail-print-button" href="#" download class="flex-1 inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-slate-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M6 2a1 1 0 00-1 1v3h10V3a1 1 0 00-1-1H6z"/><path fill-rule="evenodd" d="M3 9a2 2 0 012-2h10a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2V9zm3 1h8v3H6V10z" clip-rule="evenodd"/></svg>
                    Cetak Struk
                </a>
                <button onclick="closeDetailModal()" class="flex-1 inline-flex items-center justify-center gap-2 rounded-xl bg-white border-2 border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:border-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    Tutup
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // ============ TRANSACTION DETAIL MODAL ============
            
            // Store all transactions data for quick access
            const transactionsData = @json($transactions);

            // Open Detail Modal
            function openDetailModal(transactionId) {
                const modal = document.getElementById('detail-modal');
                const transaction = transactionsData.find(t => t.id === transactionId);
                
                if (!transaction) {
                    console.error('Transaction not found:', transactionId);
                    return;
                }

                // Format date
                const dateObj = new Date(transaction.created_at);
                const formattedDate = dateObj.toLocaleDateString('id-ID', { 
                    day: '2-digit', 
                    month: 'long', 
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

                // Update header info
                document.getElementById('detail-transaction-id').textContent = '#' + transaction.id;
                document.getElementById('detail-transaction-date').textContent = formattedDate;
                document.getElementById('detail-cashier-name').textContent = transaction.user?.name || '-';
                
                // Update payment summary
                document.getElementById('detail-total-price').textContent = 'Rp ' + Math.floor(transaction.total_price).toLocaleString('id-ID');
                document.getElementById('detail-paid-amount').textContent = 'Rp ' + Math.floor(transaction.paid_amount || 0).toLocaleString('id-ID');
                document.getElementById('detail-change-amount').textContent = 'Rp ' + Math.floor(transaction.change_amount || 0).toLocaleString('id-ID');

                // Build items list
                const itemsList = document.getElementById('detail-items-list');
                itemsList.innerHTML = transaction.transaction_items.map(item => `
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-200 hover:border-slate-300 transition">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <h5 class="font-semibold text-slate-900">${item.product?.name || 'Produk'}</h5>
                                <p class="text-sm text-slate-600 mt-1">
                                    <span class="font-medium">${item.qty}x</span> 
                                    <span class="text-slate-500">@ Rp ${Math.floor(item.price).toLocaleString('id-ID')}</span>
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-slate-900">Rp ${Math.floor(item.subtotal).toLocaleString('id-ID')}</p>
                            </div>
                        </div>
                    </div>
                `).join('');

                // Update print button
                document.getElementById('detail-print-button').href = `/struk/${transaction.id}`;

                // Show modal
                modal.classList.remove('hidden');
            }

            // Close Detail Modal
            function closeDetailModal() {
                const modal = document.getElementById('detail-modal');
                modal.classList.add('hidden');
            }

            // Close modal when clicking outside
            document.getElementById('detail-modal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeDetailModal();
                }
            });

            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !document.getElementById('detail-modal').classList.contains('hidden')) {
                    closeDetailModal();
                }
            });
        </script>
    @endpush
</x-app-layout>
