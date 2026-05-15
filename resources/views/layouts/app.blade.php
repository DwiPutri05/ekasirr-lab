<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 font-sans antialiased">
        <div x-data="{ sidebarOpen: false }" class="min-h-screen flex">
            <div class="md:hidden">
                <div x-show="sidebarOpen" class="fixed inset-0 z-30 bg-slate-900/70" @click="sidebarOpen = false"></div>
                <aside x-show="sidebarOpen" class="fixed inset-y-0 left-0 z-40 w-64 bg-slate-900 text-white shadow-xl p-4" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">
                    @include('layouts.navigation')
                </aside>
            </div>

            <aside class="hidden md:fixed md:top-0 md:left-0 md:h-screen md:w-64 md:flex md:flex-col md:flex-shrink-0 bg-slate-900 text-white shadow-xl">
                @include('layouts.navigation')
            </aside>

            <div class="flex flex-col flex-1 md:ml-64">
                <header class="sticky top-0 z-20 border-b border-slate-200 bg-white/95 shadow-sm backdrop-blur">
                    <div class="w-full flex flex-col gap-4 px-4 py-2 md:flex-row md:items-center md:justify-between lg:px-8">
                        <div class="min-w-0">
                            <div class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-600">{{ isset($header) ? $header : 'Dashboard' }}</div>
                            @isset($subheader)
                                <p class="mt-2 text-sm text-slate-500">{{ $subheader }}</p>
                            @else
                                <p class="mt-2 text-sm text-slate-500">{{ isset($header) ? 'Kelola aktivitas terbaru dan statistik aplikasi.' : 'Ringkasan halaman dan status pengguna.' }}</p>
                            @endisset
                        </div>
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                            <div class="inline-flex items-center gap-3 rounded-2xl bg-slate-100 px-4 py-2 text-sm text-slate-700">
                                <span id="header-date">{{ now()->format('d M Y') }}</span>
                                <span class="hidden sm:inline">•</span>
                                <span id="clock">{{ now()->format('H:i:s') }}</span>
                            </div>
                            <span class="inline-flex items-center rounded-2xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white capitalize">{{ auth()->user()->role }}</span>
                        </div>
                    </div>
                </header>
                <main class="flex-1 bg-slate-100 overflow-y-auto">
                    <div class="w-full px-6 py-6 lg:px-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const success = @json(session('success'));
                const error = @json(session('error'));

                if (success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: success,
                        showConfirmButton: false,
                        timer: 3500,
                        timerProgressBar: true,
                        background: '#f8fafc',
                        color: '#0f172a'
                    });
                }

                if (error) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: error,
                        showConfirmButton: false,
                        timer: 4500,
                        timerProgressBar: true,
                        background: '#fef2f2',
                        color: '#991b1b'
                    });
                }

                function updateClock() {
                    const now = new Date();
                    const time = new Intl.DateTimeFormat('id-ID', {
                        timeZone: 'Asia/Jakarta',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit'
                    }).format(now);

                    const date = new Intl.DateTimeFormat('id-ID', {
                        timeZone: 'Asia/Jakarta',
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    }).format(now);

                    document.getElementById('clock').innerText = time;
                    document.getElementById('header-date').innerText = date;
                }

                updateClock();
                setInterval(updateClock, 1000);
            });
        </script>
        @stack('scripts')
    </body>
</html>
