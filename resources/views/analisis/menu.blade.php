@extends('layouts.main')
@section('breadcrumbs')
    <nav class="flex text-white" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li>
                <span class="mx-2 inline-flex items-center text-sm font-medium">Menu Analysis</span>
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
    <h1 class="text-4xl font-bold">Menu Analysis</h1>
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
            <canvas id="chartMenu"></canvas>
        </div>

        <div class="detail-chart mt-10">
            <h1 class="text-2xl font-bold">Chart Insight</h1>
            <div class="bulan-tertinggi">
                <p>
                    Menu paling laris adalah <b>{{ $menu_terlaris->menu_name }}</b>
                    dipesan sebanyak <b>{{ $menu_terlaris->total_pesanan }}</b> kali
                </p>

            </div>
        </div>
        <div class="table w-full">
            <h1 class="text-2xl mb-5 mt-10 font-bold">Menu Table </h1>
            <table class=" table-auto w-full" id="menu">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Menu</th>
                        <th>HPP</th>
                        <th>Profit Percentage</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($menu as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaction->menu_name }}</td>
                            <td>Rp. {{ number_format($transaction->hpp, '0', ',', '.') }}</td>
                            <td>{{ $transaction->target_laba }} %</td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#menu').DataTable();
            // $('#grossprofit').DataTable();
        });
        // Menerima data dari PHP dan menggunakannya di JavaScript
        // Kita menggunakan `json_encode` agar data bisa dibaca oleh JavaScript dengan aman
        const labels = @json($labels);
        const data = @json($jumlah_pesanan);

        const ctx = document.getElementById('chartMenu').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Unit Sold',
                    data: data,
                    backgroundColor: [
                        //     'rgba(255, 99, 132, 0.5)',
                        //     'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        // 'rgba(75, 192, 192, 0.5)',
                        // 'rgba(153, 102, 255, 0.5)',
                        // 'rgba(255, 159, 64, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        // 'rgba(54, 162, 235, 1)',
                        // 'rgba(255, 206, 86, 1)',
                        // 'rgba(75, 192, 192, 1)',
                        // 'rgba(153, 102, 255, 1)',
                        // 'rgba(255, 159, 64, 1)'
                    ],
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
                            text: 'Unit Sold'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Menus'
                        }
                    }
                }
            }
        });
    </script>
@endsection
