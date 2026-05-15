<x-app-layout>
    <x-slot name="header">Produk</x-slot>

    <div class="space-y-4">
        @if(session('success'))
            <div class="rounded-3xl bg-emerald-50 border border-emerald-200 p-4 text-emerald-800 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid gap-4 md:grid-cols-[1fr_auto] items-center bg-white rounded-3xl border border-slate-200 p-4 shadow-sm">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Halaman Produk</p>
                <h1 class="mt-2 text-2xl font-semibold text-slate-900">Kelola Produk Anda</h1>
                <p class="mt-2 text-sm text-slate-500">Lihat dan cari produk dengan cepat, tampilan user-friendly untuk kasir dan admin.</p>
            </div>

            <form method="GET" action="{{ route('products.index') }}" class="flex w-full items-center gap-3 md:w-auto">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-full md:w-72 rounded-xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20" />
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('products.create') }}" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                        + Tambah
                    </a>
                @endif
            </form>
        </div>

        @if($products->isEmpty())
            <div class="rounded-3xl bg-white border border-slate-200 p-6 text-center shadow-sm">
                <p class="text-lg font-semibold text-slate-900">Belum ada produk</p>
                <p class="mt-2 text-sm text-slate-500">Tambahkan produk untuk mulai menjual.</p>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('products.create') }}" class="mt-4 inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                        Tambah Produk
                    </a>
                @endif
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($products as $product)
                    <div class="overflow-hidden rounded-xl bg-white shadow-md transition-all duration-200 hover:shadow-xl">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/600x400?text=No+Image' }}" alt="{{ $product->name }}" class="w-full h-40 object-cover" />
                        <div class="p-4 space-y-3">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <h3 class="truncate text-lg font-semibold text-slate-900">{{ $product->name }}</h3>
                                </div>
                                <span class="rounded-full bg-indigo-100 px-2 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-indigo-700">
                                    {{ $product->category }}
                                </span>
                            </div>

                            <div class="space-y-1 text-sm text-slate-500">
                                <p class="text-base font-semibold text-slate-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="flex items-center gap-2">Stok: <span class="font-semibold text-slate-900">{{ $product->stock }}</span></p>
                            </div>

                            @if($product->stock == 0)
                                <p class="text-red-500 text-xs font-semibold uppercase tracking-[0.16em]">Stok Habis</p>
                            @elseif($product->stock < 10)
                                <p class="text-yellow-500 text-xs font-semibold uppercase tracking-[0.16em]">Stok Menipis</p>
                            @else
                                <p class="text-green-500 text-xs font-semibold uppercase tracking-[0.16em]">Stok Aman</p>
                            @endif

                            @if(auth()->user()->role === 'admin')
                                <div class="flex gap-2 pt-3">
                                    <a href="{{ route('products.edit', $product) }}" class="flex-1 rounded-lg bg-yellow-400 px-3 py-2 text-center text-sm font-semibold text-white transition hover:bg-yellow-500">
                                        Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full rounded-lg bg-red-500 px-3 py-2 text-sm font-semibold text-white transition hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>