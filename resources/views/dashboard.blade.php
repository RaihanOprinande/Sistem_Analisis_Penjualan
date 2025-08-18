@extends('layouts.main')
@section('breadcrumbs')
    <nav class="flex text-white" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li>
                <span>Dashboard</span>
            </li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="dashboard">
        <h1 class="text-4xl font-bold mt mb-5">This Month Summary</h1>

        <div class="cards flex gap-4  text-center mb-5">

            <a href="#"
                class="block  w-55 h-30 p-5 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Omzet</h5>
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Rp.
                    {{ number_format($omzet, '0', ',', '.') }}</h5>
            </a>
            {{-- {{ $data2 }} --}}
            <a href="#"
                class="block  w-55 h-30 p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Gross Profit</h5>
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Rp.
                    {{ number_format($sum_laba_kotor, '0', ',', '.') }}</h5>
            </a>
            <a href="#"
                class="block  w-55 h-30 p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Unit Sold</h5>
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $jumlah_pesanan }}</h5>
            </a>
            <a href="#"
                class="block  w-55 h-30 p-1 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Average Order Value</h5>
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Rp.{{ number_format($aov, '0', ',', '.') }}</h5>
            </a>
            <a href="#"
                class="block  w-55 h-30 p-1 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Most Profitable Platfrom
                </h5>
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $platfrom }}
                </h5>
            </a>

        </div>
        <div class="chart w-full ">
            <h1 class="text-3xl font-bold mt">Sales Chart</h1>
            <a href="/analisis/sales">
                <canvas id="linechart"></canvas>
                {{-- <canvas id="linechart"></canvas> --}}
            </a>
        </div>

    </div>

    <script>
        const ctx = document.getElementById('linechart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Omset',
                    // omset: @json($omset_grafik),
                    data: @json($omset_grafik),
                    labaKotor: @json($laba_kotor_grafik),
                    borderWidth: 2,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.3
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const omset = context.parsed.y;
                                // const penjualan = context.parsed.y;
                                const labaKotor = context.dataset.labaKotor[context.dataIndex];

                                function formatRupiah(angka) {
                                    return angka.toLocaleString('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR'
                                    });
                                }
                                return [
                                    'Omset: ' + formatRupiah(omset),
                                    // 'Penjualan: ' + penjualan,
                                    'Laba Kotor: ' + formatRupiah(labaKotor)
                                ];
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        title: {
                            display: true,
                            text: 'Omset (Rp)'
                        }
                    }
                }
            }
        });
    </script>
@endsection
