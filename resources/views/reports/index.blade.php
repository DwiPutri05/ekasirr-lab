<x-app-layout>
    <x-slot name="header">Laporan Penjualan</x-slot>

    <div class="space-y-6">
        <div class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Ringkasan Laporan</p>
                    <h1 class="mt-3 text-3xl font-semibold text-slate-900">Laporan Penjualan</h1>
                    <p class="mt-2 text-sm text-slate-500">Lihat statistik harian dan bulanan serta grafik pemasukan 7 hari terakhir.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('reports.export') }}" class="inline-flex items-center justify-center rounded-xl bg-sky-600 px-5 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-sky-700">
                        Export Excel
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <div class="rounded-3xl bg-slate-900 p-6 text-white shadow-xl">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-300">Pendapatan Hari Ini</p>
                <p class="mt-4 text-4xl font-bold">Rp {{ number_format($dailyTotal, 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-slate-300">Total transaksi hari ini: {{ $dailyCount }}</p>
            </div>

            <div class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Jumlah Transaksi Hari Ini</p>
                <p class="mt-4 text-4xl font-bold text-slate-900">{{ $dailyCount }}</p>
                <p class="mt-2 text-sm text-slate-500">Ringkasan transaksi terakhir.</p>
            </div>

            <div class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Pendapatan Bulan Ini</p>
                <p class="mt-4 text-4xl font-bold text-slate-900">Rp {{ number_format($monthlyTotal, 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-slate-500">Total pemasukan selama bulan ini.</p>
            </div>

            <div class="rounded-3xl bg-slate-900 p-6 text-white shadow-xl">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-300">Jumlah Transaksi Bulan Ini</p>
                <p class="mt-4 text-4xl font-bold">{{ $monthlyCount }}</p>
                <p class="mt-2 text-sm text-slate-300">Performa penjualan bulanan.</p>
            </div>
        </div>

        <div class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Grafik Pemasukan</p>
                    <h2 class="mt-3 text-2xl font-semibold text-slate-900">7 Hari Terakhir</h2>
                </div>
            </div>
            <div class="mt-6">
                <canvas id="salesChart" class="w-full h-72"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = @json($labels);
        const dataPoints = @json($chartData);

        const ctx = document.getElementById('salesChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        label: 'Pemasukan (Rp)',
                        data: dataPoints,
                        fill: true,
                        backgroundColor: 'rgba(14, 165, 233, 0.12)',
                        borderColor: 'rgba(14, 165, 233, 1)',
                        tension: 0.35,
                        pointRadius: 4,
                        pointBackgroundColor: 'rgba(14, 165, 233, 1)',
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: value => 'Rp ' + value.toLocaleString('id-ID'),
                            },
                        },
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: context => 'Rp ' + Number(context.formattedValue).toLocaleString('id-ID'),
                            },
                        },
                    },
                },
            });
        }
    </script>
</x-app-layout>
