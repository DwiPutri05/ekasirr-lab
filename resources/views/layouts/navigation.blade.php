<div class="flex h-full flex-col">
    <div class="px-6 py-8 border-b border-slate-800 bg-slate-950/95">
        <div class="inline-flex items-center gap-3">
            <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-indigo-500/15 text-indigo-200 ring-1 ring-white/10">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 7h18M6 7v12a2 2 0 002 2h8a2 2 0 002-2V7" />
                    <path d="M9 7V4h6v3" />
                    <path d="M11 13h2" />
                    <path d="M8 11h8" />
                </svg>
            </div>
            <div>
                <div class="text-2xl font-semibold text-white">e-KASIR LAB</div>
                <p class="mt-1 text-sm text-slate-400">Sistem Kasir Lab</p>
            </div>
        </div>

        <div class="mt-8 rounded-3xl border border-white/10 bg-slate-900/80 p-4 text-slate-100 shadow-inner shadow-slate-950/10">
            <div class="flex items-center gap-4">
                <div class="h-14 w-14 overflow-hidden rounded-3xl bg-slate-700 flex items-center justify-center">
                    @if(auth()->user()->profile_photo_path)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Foto profil {{ auth()->user()->name }}" class="h-full w-full object-cover" />
                    @else
                        <span class="text-2xl font-semibold text-slate-200">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    @endif
                </div>
                <div class="min-w-0">
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Info Pengguna</p>
                    <p class="mt-3 truncate text-base font-semibold text-white">{{ auth()->user()->name }}</p>
                    <p class="truncate text-sm text-slate-400">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <span class="mt-4 inline-flex rounded-full bg-indigo-500/15 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-indigo-100">{{ auth()->user()->role }}</span>
        </div>
    </div>

    <div class="flex-1 px-4 py-6 space-y-3 overflow-y-auto">
        <div class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Menu Utama</div>
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5 {{ request()->routeIs('admin.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('products.index') }}" class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('products.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5 {{ request()->routeIs('products.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0h-6m6 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6m16 0H4" />
                </svg>
                Produk
            </a>
            <a href="{{ route('reports.index') }}" class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('reports.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5 {{ request()->routeIs('reports.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h5m-1 5v6M5 13v6m4-6v6m4-6v6" />
                </svg>
                Laporan
            </a>
            <a href="{{ route('profile.edit') }}" class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('profile.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5 {{ request()->routeIs('profile.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Edit Profil
            </a>
        @elseif(auth()->user()->role === 'kasir')
            <a href="{{ route('kasir.dashboard') }}" class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('kasir.dashboard') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5 {{ request()->routeIs('kasir.dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 6h18M3 14h18M3 18h18" />
                </svg>
                Transaksi
            </a>
            <a href="{{ route('transactions.history') }}" class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('transactions.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5 {{ request()->routeIs('transactions.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M8 3v4M16 3v4M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
                </svg>
                Riwayat
            </a>
            <a href="{{ route('profile.edit') }}" class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('profile.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5 {{ request()->routeIs('profile.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Edit Profil
            </a>
        @endif
    </div>

    <div class="px-4 py-6 border-t border-slate-800">
        <hr class="my-4 border-slate-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-500 text-white py-2 rounded-xl hover:bg-red-600 transition">
                🔓 Logout
            </button>
        </form>
    </div>
</div>
