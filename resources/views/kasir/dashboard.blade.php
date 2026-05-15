<x-app-layout>
    <x-slot name="header">Transaksi</x-slot>
    <x-slot name="subheader">Kelola penjualan produk secara cepat dan rapi.</x-slot>

    <div class="space-y-6 w-full">
        @if(session('success'))
            <div class="rounded-3xl bg-emerald-50 border border-emerald-200 p-5 shadow-sm text-emerald-800">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="font-semibold text-lg">Transaksi berhasil</p>
                        <p class="text-sm text-slate-600">Total pembayaran: <span class="font-semibold text-slate-900">Rp {{ number_format(session('total'), 0, ',', '.') }}</span></p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @if(session('transaction_id'))
                            <a href="{{ route('transactions.struk', session('transaction_id')) }}" download class="inline-flex items-center gap-2 rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white shadow-md transition hover:bg-slate-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M6 2a1 1 0 00-1 1v3h10V3a1 1 0 00-1-1H6z" /><path fill-rule="evenodd" d="M3 9a2 2 0 012-2h10a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2V9zm3 1h8v3H6V10z" clip-rule="evenodd" /></svg>
                                Cetak Struk
                            </a>
                        @endif
                        <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-sm font-semibold text-emerald-700">Transaksi Selesai</span>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="rounded-3xl bg-red-50 border border-red-200 p-5 shadow-sm text-red-800">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.675-1.36 3.44 0l5.518 9.814c.75 1.334-.213 2.987-1.72 2.987H4.46c-1.507 0-2.47-1.653-1.72-2.987L8.257 3.1zM10 12a1 1 0 10-2 0 1 1 0 002 0zm-.25-4.75a.75.75 0 00-1.5 0v3.5a.75.75 0 001.5 0v-3.5z" clip-rule="evenodd" /></svg>
                    <span class="text-sm font-semibold">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <div class="grid w-full gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2 space-y-6">
                <div class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm w-full">
                    <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-600">Ringkasan Kasir</p>
                            <h2 class="mt-3 text-2xl font-semibold text-slate-900">Transaksi Hari Ini</h2>
                            <p class="mt-2 text-sm text-slate-500">Statistik singkat dan akses cepat untuk penjualan.</p>
                        </div>
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                            <div class="rounded-3xl bg-slate-50 p-4 text-slate-700 shadow-sm">
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Total Produk</p>
                                <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $totalProducts }}</p>
                            </div>
                            <div class="rounded-3xl bg-slate-50 p-4 text-slate-700 shadow-sm">
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Transaksi Hari Ini</p>
                                <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $todayTransactions }}</p>
                            </div>
                            <div class="rounded-3xl bg-slate-50 p-4 text-slate-700 shadow-sm">
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Pendapatan</p>
                                <p class="mt-3 text-3xl font-semibold text-slate-900">Rp {{ number_format($todaySales, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm w-full">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Transaksi Langsung</p>
                            <h3 class="mt-2 text-xl font-semibold text-slate-900">Pilih produk dan proses pembayaran</h3>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('transactions.history') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 shadow-sm transition hover:bg-slate-100">Riwayat Transaksi</a>
                        </div>
                    </div>
                </div>

                <div class="relative mb-4">
                    <input id="searchInput" type="text" placeholder="Cari produk..." class="w-full p-3 pl-10 border rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500" />
                    <span class="absolute left-3 top-3 text-gray-400">🔍</span>
                </div>

                @if($products->isEmpty())
                    <div class="rounded-3xl bg-white border border-slate-200 p-8 text-center shadow-sm">
                        <p class="text-lg font-semibold text-slate-900">Belum ada produk tersedia.</p>
                        <p class="mt-3 text-sm text-slate-500">Tambahkan produk terlebih dahulu agar kasir bisa memproses transaksi.</p>
                        <a href="{{ route('products.create') }}" class="mt-6 inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-indigo-700">Tambah Produk</a>
                    </div>
                @else
                    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($products as $product)
                            <div class="product-card group flex h-full flex-col justify-between overflow-hidden rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-lg hover:scale-[1.02]" data-product-id="{{ $product->id }}" data-name="{{ $product->name }}">
                                <div>
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <h2 class="text-lg font-semibold text-slate-900">{{ $product->name }}</h2>
                                            <p class="mt-2 text-sm text-slate-500">{{ $product->category }}</p>
                                        </div>
                                        <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 transition group-hover:bg-indigo-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3h18M9 3v18m6-18v18"/></svg>
                                        </span>
                                    </div>

                                    <div class="mt-4 overflow-hidden rounded-3xl border border-slate-200 bg-slate-50">
                                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/600x400?text=No+Image' }}" alt="{{ $product->name }}" class="h-36 w-full object-cover" />
                                    </div>

                                    <div class="mt-5 space-y-3 text-sm text-slate-600">
                                        <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3">
                                            <span>Harga</span>
                                            <span class="text-indigo-600 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex items-center justify-between rounded-2xl px-4 py-3 {{ $product->stock == 0 ? 'bg-red-50 text-red-700' : ($product->stock <= 5 ? 'bg-amber-50 text-amber-700' : 'bg-emerald-50 text-emerald-700') }}">
                                            <span>Stok</span>
                                            <span class="font-semibold">{{ $product->stock }}</span>
                                        </div>
                                        <div>
                                            @if($product->stock == 0)
                                                <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-red-700">Stok Habis</span>
                                            @elseif($product->stock <= 5)
                                                <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-amber-700">Stok Menipis</span>
                                            @else
                                                <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-emerald-700">Stok Aman</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if($product->stock == 0)
                                    <button type="button" class="w-full bg-gray-300 text-gray-500 py-2 rounded-lg text-sm mt-4 transition cursor-not-allowed" disabled>
                                        Stok Habis
                                    </button>
                                @else
                                    <button type="button" onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, {{ $product->stock }})" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg text-sm mt-4 transition transform hover:scale-105 active:scale-95">
                                        ➕ Tambah
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-6">
                    <div class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-slate-900">Keranjang</h3>
                            <span id="cart-count" class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-indigo-600 text-xs font-semibold text-white">0</span>
                        </div>
                        <p id="cart-item-count" class="text-sm text-gray-500 mb-4">Total Item: 0</p>

                        <div id="cart-items" class="space-y-4 mb-6 max-h-[70vh] overflow-y-auto">
                            <!-- Cart items will be added here -->
                        </div>

                        <div class="border-t border-slate-200 pt-4">
                            <div class="flex items-center justify-between text-lg font-semibold text-slate-900 mb-4">
                                <span>TOTAL</span>
                                <span id="cart-total">Rp 0</span>
                            </div>
                            <button id="checkout-btn" onclick="openPaymentModal()" class="w-full rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-xl transition hover:bg-indigo-700 disabled:bg-slate-300 disabled:cursor-not-allowed" disabled>
                                Bayar Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal - Professional POS Style -->
    <div id="payment-modal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-900 bg-opacity-50 transition-opacity duration-300" aria-hidden="true"></div>
            
            <!-- Modal Content -->
            <div class="inline-block align-middle bg-white rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:w-full sm:max-w-md">
                <!-- Header -->
                <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-5 sm:px-8">
                    <h3 class="text-xl font-bold text-white" id="modal-title">💳 Pembayaran</h3>
                    <p class="text-indigo-100 text-sm mt-1">Proses pembayaran transaksi</p>
                </div>

                <!-- Body -->
                <div class="px-6 py-6 sm:px-8 space-y-6">
                    <!-- Total Belanja -->
                    <div class="bg-slate-50 rounded-xl p-5 border border-slate-200">
                        <p class="text-sm font-medium text-slate-600 uppercase tracking-[0.1em]">Total Belanja</p>
                        <p id="modal-total" class="text-3xl font-bold text-slate-900 mt-2">Rp 0</p>
                    </div>

                    <!-- Input Uang -->
                    <div>
                        <label for="payment-amount" class="block text-sm font-semibold text-slate-700 mb-3">💰 Uang dari Pelanggan</label>
                        <input 
                            type="number" 
                            id="payment-amount" 
                            class="w-full rounded-xl border-2 border-slate-200 px-5 py-4 text-lg font-semibold placeholder-slate-400 transition duration-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 focus:outline-none" 
                            placeholder="Masukkan jumlah uang" 
                            min="0"
                            inputmode="numeric"
                        >
                    </div>

                    <!-- Validation Messages -->
                    <div class="space-y-2">
                        <!-- Insufficient Funds -->
                        <div id="insufficient-funds" class="hidden bg-red-50 border-2 border-red-200 rounded-xl p-4 transition duration-200">
                            <p class="text-sm font-semibold text-red-700">⚠️ Uang Tidak Cukup</p>
                            <p class="text-xs text-red-600 mt-1">Kekurangan: <span id="shortfall-amount" class="font-bold">Rp 0</span></p>
                        </div>

                        <!-- Change (Kembalian) - PROMINENT -->
                        <div id="change-section" class="hidden bg-gradient-to-br from-emerald-50 to-green-50 border-2 border-emerald-300 rounded-xl p-5 transition duration-200">
                            <p class="text-xs font-semibold text-emerald-600 uppercase tracking-[0.1em]">✓ Kembalian</p>
                            <p id="change-amount-value" class="text-4xl font-bold text-emerald-700 mt-2">Rp 0</p>
                            <p class="text-xs text-emerald-600 mt-2">💵 Pembayaran diterima</p>
                        </div>
                    </div>
                </div>

                <!-- Footer / Buttons -->
                <div class="bg-slate-50 px-6 py-4 sm:px-8 sm:flex sm:flex-row-reverse gap-3">
                    <button 
                        id="confirm-payment-btn" 
                        type="button" 
                        class="flex-1 inline-flex justify-center items-center gap-2 rounded-xl border border-transparent shadow-md px-4 py-3 bg-indigo-600 text-sm font-semibold text-white transition duration-200 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:bg-slate-300 disabled:cursor-not-allowed disabled:opacity-50" 
                        disabled
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/><path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/></svg>
                        Konfirmasi
                    </button>
                    <button 
                        type="button" 
                        onclick="closePaymentModal()" 
                        class="flex-1 inline-flex justify-center items-center gap-2 rounded-xl border-2 border-slate-300 shadow-sm px-4 py-3 bg-white text-sm font-semibold text-slate-700 transition duration-200 hover:bg-slate-50 hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        Batal
                    </button>
                </div>

                <!-- Keyboard Hint (optional) -->
                <div class="bg-blue-50 border-t border-blue-200 px-6 py-3 sm:px-8">
                    <p class="text-xs text-blue-700">
                        <span class="font-semibold">💡 Tip:</span> 
                        Tekan <kbd class="bg-white border border-blue-300 rounded px-2 py-1 text-xs font-mono">Enter</kbd> untuk konfirmasi atau <kbd class="bg-white border border-blue-300 rounded px-2 py-1 text-xs font-mono">Esc</kbd> untuk batal
                    </p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // ============ UTILITY FUNCTIONS ============
            // Format currency to Rupiah format
            function formatRupiah(amount) {
                return 'Rp ' + Math.floor(amount).toLocaleString('id-ID');
            }

            // ============ DOM ELEMENTS ============
            let cart = [];
            const cartItemsEl = document.getElementById('cart-items');
            const cartCountEl = document.getElementById('cart-count');
            const cartTotalEl = document.getElementById('cart-total');
            const checkoutBtn = document.getElementById('checkout-btn');
            const paymentModal = document.getElementById('payment-modal');
            const paymentAmountEl = document.getElementById('payment-amount');
            const insufficientFundsEl = document.getElementById('insufficient-funds');
            const confirmPaymentBtn = document.getElementById('confirm-payment-btn');
            const modalTotalEl = document.getElementById('modal-total');
            const searchInput = document.getElementById('searchInput');

            if (searchInput) {
                searchInput.addEventListener('keyup', function () {
                    const keyword = this.value.toLowerCase();
                    const products = document.querySelectorAll('.product-card');

                    products.forEach(product => {
                        const name = product.dataset.name.toLowerCase();
                        product.style.display = name.includes(keyword) ? 'block' : 'none';
                    });
                });
            }

            // ============ CART FUNCTIONS ============

            function addToCart(productId, name, price, stock) {
                if (stock <= 0) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Stok habis!',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    return;
                }

                const existingItem = cart.find(item => item.id === productId);
                if (existingItem) {
                    if (existingItem.qty >= stock) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'warning',
                            title: 'Stok tidak mencukupi!',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return;
                    }
                    existingItem.qty++;
                } else {
                    cart.push({
                        id: productId,
                        name: name,
                        price: price,
                        qty: 1,
                        stock: stock
                    });
                }

                updateCartUI();
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Produk ditambahkan ke keranjang!',
                    showConfirmButton: false,
                    timer: 2000
                });
            }

            function updateQty(productId, newQty) {
                const item = cart.find(item => item.id === productId);
                if (item) {
                    newQty = Math.max(1, Math.min(newQty, item.stock));
                    item.qty = newQty;
                    updateCartUI();
                }
            }

            function removeFromCart(productId) {
                cart = cart.filter(item => item.id !== productId);
                updateCartUI();
            }

            function updateCartUI() {
                const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
                cartCountEl.textContent = totalItems;
                document.getElementById('cart-item-count').textContent = `Total Item: ${totalItems}`;
                const total = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
                cartTotalEl.textContent = formatRupiah(total);

                cartItemsEl.innerHTML = cart.length ? cart.map(item => `
                    <div class="space-y-2 rounded-2xl border border-slate-200 bg-slate-50 p-3">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <h4 class="font-semibold text-slate-900 truncate">${item.name}</h4>
                                <p class="mt-1 text-sm text-slate-600">${formatRupiah(item.price)} x ${item.qty}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-slate-600">Subtotal</p>
                                <p class="font-semibold text-slate-900">${formatRupiah(item.price * item.qty)}</p>
                            </div>
                        </div>
                        <hr class="my-2 border-slate-200" />
                        <div class="flex items-center justify-between gap-2">
                            <div class="flex items-center gap-2">
                                <button onclick="event.stopPropagation(); updateQty(${item.id}, ${item.qty - 1})" class="w-8 h-8 rounded-full bg-slate-200 hover:bg-slate-300 flex items-center justify-center text-slate-600">-</button>
                                <span class="w-8 text-center font-semibold">${item.qty}</span>
                                <button onclick="event.stopPropagation(); updateQty(${item.id}, ${item.qty + 1})" class="w-8 h-8 rounded-full bg-slate-200 hover:bg-slate-300 flex items-center justify-center text-slate-600">+</button>
                            </div>
                            <button onclick="event.stopPropagation(); removeFromCart(${item.id})" class="rounded-full bg-red-100 hover:bg-red-200 px-3 py-2 text-sm font-semibold text-red-600">Hapus</button>
                        </div>
                    </div>
                `).join('') : '<p class="text-sm text-slate-500">Keranjang kosong. Tambahkan produk untuk memulai transaksi.</p>';

                checkoutBtn.disabled = cart.length === 0;
            }

            // ============ PAYMENT MODAL FUNCTIONS ============
            function openPaymentModal() {
                if (cart.length === 0) return;

                const total = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
                modalTotalEl.textContent = formatRupiah(total);
                paymentAmountEl.value = '';
                document.getElementById('change-section').classList.add('hidden');
                insufficientFundsEl.classList.add('hidden');
                confirmPaymentBtn.disabled = true;
                paymentModal.classList.remove('hidden');
                
                // Auto focus to input after modal appears
                setTimeout(() => {
                    paymentAmountEl.focus();
                    paymentAmountEl.select();
                }, 100);
            }

            function closePaymentModal() {
                paymentModal.classList.add('hidden');
                paymentAmountEl.value = '';
            }

            // Real-time payment calculation
            function updatePaymentDisplay() {
                const total = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
                const paid = parseInt(paymentAmountEl.value) || 0;
                const change = paid - total;
                const changeSection = document.getElementById('change-section');

                if (paid === 0) {
                    // No input yet
                    changeSection.classList.add('hidden');
                    insufficientFundsEl.classList.add('hidden');
                    confirmPaymentBtn.disabled = true;
                } else if (paid >= total) {
                    // Payment sufficient
                    document.getElementById('change-amount-value').textContent = formatRupiah(change);
                    changeSection.classList.remove('hidden');
                    insufficientFundsEl.classList.add('hidden');
                    confirmPaymentBtn.disabled = false;
                    confirmPaymentBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                } else {
                    // Payment insufficient
                    const shortfall = total - paid;
                    document.getElementById('shortfall-amount').textContent = formatRupiah(shortfall);
                    insufficientFundsEl.classList.remove('hidden');
                    changeSection.classList.add('hidden');
                    confirmPaymentBtn.disabled = true;
                    confirmPaymentBtn.classList.add('opacity-50', 'cursor-not-allowed');
                }
            }

            // Input event listener with real-time validation
            paymentAmountEl.addEventListener('input', updatePaymentDisplay);

            // Enter key to confirm payment
            paymentAmountEl.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !confirmPaymentBtn.disabled) {
                    e.preventDefault();
                    confirmPaymentBtn.click();
                }
            });

            // ESC key to close modal
            paymentAmountEl.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    e.preventDefault();
                    closePaymentModal();
                }
            });

            confirmPaymentBtn.addEventListener('click', async function() {
                const total = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
                const paid = parseInt(paymentAmountEl.value) || 0;

                if (paid < total) return;

                confirmPaymentBtn.disabled = true;
                const originalText = confirmPaymentBtn.innerHTML;
                confirmPaymentBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 animate-spin" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0010 2v3.5a1 1 0 00.823.983L19.822 9.69a1 1 0 01-.729 1.886L10.823 7.483 10 8.466V10a2 2 0 11-4 0V8.466L4.177 7.483 .378 7.468a1 1 0 01-.729-1.886l8.999-1.161A1 1 0 0010 2v3.5z" clip-rule="evenodd"/></svg> Memproses...';

                try {
                    const response = await fetch('{{ route("checkout") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            items: cart.map(item => ({
                                product_id: item.id,
                                qty: item.qty
                            })),
                            total: total,
                            paid: paid,
                            change: paid - total
                        })
                    });

                    const result = await response.json();

                    if (result.success) {
                        cart = [];
                        updateCartUI();
                        closePaymentModal();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Transaksi berhasil! ✓',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        // Redirect to receipt or refresh
                        setTimeout(() => {
                            window.location.href = '{{ route("transactions.struk", ":id") }}'.replace(':id', result.transaction_id);
                        }, 1500);
                    } else {
                        throw new Error(result.message || 'Terjadi kesalahan');
                    }
                } catch (error) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: error.message,
                        showConfirmButton: false,
                        timer: 4000
                    });
                } finally {
                    confirmPaymentBtn.disabled = false;
                    confirmPaymentBtn.innerHTML = originalText;
                }
            });

            // Close modal when clicking outside (backdrop)
            paymentModal.addEventListener('click', function(e) {
                if (e.target === paymentModal) {
                    closePaymentModal();
                }
            });

            // Global ESC key handler
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !paymentModal.classList.contains('hidden')) {
                    closePaymentModal();
                }
            });
        </script>
    @endpush
</x-app-layout>
