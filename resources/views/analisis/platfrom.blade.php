@extends('layouts.main')
@section('breadcrumbs')
    <nav class="flex text-white" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li>
                <span class="mx-2 inline-flex items-center text-sm font-medium">Platfrom Analysis</span>
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
    <h1 class="text-4xl font-bold">Platfrom Analysis</h1>
    <div class="container mt-5">

        <div class="chart">
            <canvas id="chartPlatfrom"></canvas>
        </div>

        <div class="detail-chart mt-10">
            <h1 class="text-2xl font-bold">Chart Insight</h1>
            <div class="bulan-tertinggi">
                <p>
                    Platfrom paling menguntungkan adalah <b>{{ $pfuntung->platfrom }}</b>
                    dengan laba kotor sebanyak Rp. <b>{{ number_format($pfuntung->total_laba_kotor, '2', ',', '.') }}</b>
                </p>

            </div>
        </div>
        <div class="table w-full">
            <h1 class="text-2xl mb-5 mt-10 font-bold">Highest Platfrom Gross Profit Table </h1>
            <table class=" table-auto w-full" id="platfrom">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>Platfrom</th>
                        <th>Menu</th>
                        <th>Order Quantity</th>
                        <th>Gross Profit</th>
                        {{-- <th>Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($platfrom as $transaction)
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
            $('#platfrom').DataTable();

        });

        const labels = @json($labels);
        const laba_kotor = @json($laba_kotor_grafik);
        const omset = @json($omset_grafik);

        const ctx = document.getElementById('chartPlatfrom').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,

                datasets: [{
                    label: 'Total Laba Kotor',
                    data: laba_kotor,
                    backgroundColor: 'rgba(255, 99, 132, 0.7)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }, {
                    label: 'Omset',
                    data: omset,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]

            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nilai'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Platform'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true // Tampilkan legenda untuk membedakan kedua batang
                    }
                }
            }
        });
    </script>
@endsection
