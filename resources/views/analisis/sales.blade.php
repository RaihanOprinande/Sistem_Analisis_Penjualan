@extends('layouts.main')
@section('breadcrumbs')
    <nav class="flex text-white" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li>
                <span class="mx-2 inline-flex items-center text-sm font-medium">Sales Analysis</span>
            </li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="alert mx-auto" id="alert-box mb-2">
        @if ($message = Session::get('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-gray-800 p-4" role="alert">
                <p class="font-bold">Success</p>
                <p>{{ $message }}</p>
            </div>
        @elseif($message = Session::get('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-gray-800 p-4" role="alert">
                <p class="font-bold">Oops!</p>
                <p>{{ $message }}</p>
            </div>
        @endif
    </div>
    <h1 class="text-4xl font-bold">Sales Analysis {{ $tahun_ini }}</h1>
    <div class="container mt-5">
        {{-- <div class="radiobutton">
            <ul class="grid w-full md:grid-cols-12">
                <li>
                    <input type="radio" id="sales" name="chartType" value="hosting-small" class="hidden peer"
                        required />
                    <label for="sales"
                        class="inline-flex items-center justify-between p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">Sales</div>
                        </div>
                    </label>
                </li>
                <li>
                    <input type="radio" id="platfroms" name="chartType" value="platfroms" class="hidden peer" required />
                    <label for="platfroms"
                        class="inline-flex items-center mr-10 justify-between p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">Platfrom</div>
                        </div>
                    </label>
                </li>
                <li>
                    <input type="radio" id="menus" name="chartType" value="hosting-small" class="hidden peer"
                        required />
                    <label for="menu"
                        class="inline-flex items-center justify-between ms-5 p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">Menu</div>
                        </div>
                    </label>
                </li>
            </ul>

        </div> --}}
        <div class="chart">
            <canvas id="chartPenjualan"></canvas>
        </div>
        <div class="detail-chart mt-10">
            <h1 class="text-2xl font-bold">Chart Insight</h1>
            <div class="bulan-tertinggi">
                <p>
                    Omset mencapai puncaknya pada bulan <b>{{ $omset_bulan }}</b>
                    dengan nilai <b>Rp. {{ number_format($omset->omset, '0', ',', '.') }}</b>

                </p>
                <p>
                    Keuntungan (laba kotor) tertinggi terjadi pada bulan <b>{{ $laba_kotor_bulan }}</b>
                    dengan nilai <b>Rp. {{ number_format($laba_kotor->laba_kotor, 0, ',', '.') }}</b>.
                </p>
            </div>
        </div>
        <div class="table w-full">
            {{-- <h1 class="text-2xl mb-5 mt-10 font-bold">Highest Month Units Sold Table </h1>
            <table class=" table-auto w-full" id="order">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>Platfrom</th>
                        <th>Menu</th>
                        <th>Order Quantity</th>
                        <th>Gross Profit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tableorder as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaction->tanggal_transaksi }}</td>
                            <td>{{ $transaction->platfrom->platfrom }}</td>
                            <td>{{ $transaction->menu->menu_name }}</td>
                            <td>{{ $transaction->jumlah_pesanan }}</td>
                            <td>{{ 'Rp.' . number_format($transaction->laba_kotor, 0, ',', '.') }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table> --}}
            <h1 class="text-2xl mb-5 mt-10 font-bold">Highest Month Gross Profit Table </h1>
            <table class=" table-auto w-full" id="grossprofit">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>Platfrom</th>
                        <th>Menu</th>
                        <th>Order Quantity</th>
                        <th>Gross Profit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tablesale as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaction->tanggal_transaksi }}</td>
                            <td>{{ $transaction->platfrom->platfrom }}</td>
                            <td>{{ $transaction->menu->menu_name }}</td>
                            <td>{{ $transaction->jumlah_pesanan }}</td>
                            <td>{{ 'Rp.' . number_format($transaction->laba_kotor, 0, ',', '.') }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#order').DataTable();
            $('#grossprofit').DataTable();
        });
        const ctx = document.getElementById('chartPenjualan');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                        label: 'Gross Profit',
                        data: @json($laba_kotor_grafik),
                        borderWidth: 2,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        tension: 0.3,
                        yAxisID: 'y1'
                    },
                    {
                        label: 'Omset',
                        data: @json($omset_grafik),
                        borderWidth: 2,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.3,
                        yAxisID: 'y2'
                    }

                ]
            },

            options: {
                responsive: true,
                scales: {
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'left', // Posisikan di kiri
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Omset' // Label sumbu Y1
                        }
                    },
                    y2: {
                        type: 'linear',
                        display: true,
                        position: 'right', // Posisikan di kanan
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Gross Profit (Rp)' // Label sumbu Y2
                        },
                        grid: {
                            drawOnChartArea: false, // Penting agar grid sumbu y2 tidak tumpang tindih
                        }
                    }
                }
            }
        });
    </script>
@endsection
