@extends('layouts.main')
@section('breadcrumbs')
    <nav class="flex text-white" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li>
                <a href="/transaction" class="inline-flex items-center text-sm font-medium hover:underline">
                    Transaction
                </a>
            </li>
        </ol>
    </nav>
@endsection
@section('content')
    @include('transaksi.filter')
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
    <h1 class="text-4xl font-bold mb-5">
        Transaction
    </h1>
    <div class="container">

        <div class="flex justify-end mb-5 gap-5">
            <div class="flex justify-end mb-5">
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                    class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                    type="button">
                    Print Transaction
                </button>
            </div>
            <div class="flex justify-end mb-5">
                <a class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    href="/transaction/create">Add New Transaction</a>
            </div>
        </div>
        <div class="filter ">
            <form action="/transaction" class="flex mb-5">
                <select class="js-example-basic-single w-full" name="filter_bulan" id="filter_bulan">
                    <option value="{{ null }}">All Month</option>
                    @foreach ($month as $item)
                        <option value="{{ $item['value'] }}">{{ $item['label'] }}</option>
                    @endforeach
                </select>
                <button type="submit"
                    class="text-white bg-blue-500 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm ms-5 w-46 px-5 py-2.5 text-center dark:bg-blue-900 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <p class="">
                        Filter
                    </p>
                </button>
            </form>
        </div>
        <table class=" table-auto w-full" id="transaksitable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Order Quantity</th>
                    <th>Gross Profit</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->tanggal_transaksi_formatted }}</td>
                        {{-- <td>{{ $transaction->platfrom->platfrom }}</td> --}}
                        {{-- <td>{{ $transaction->menu->menu_name }}</td> --}}
                        <td>{{ $transaction->sum_jumlah_pesanan }}</td>
                        <td>{{ 'Rp.' . number_format($transaction->sum_laba_kotor, 0, ',', '.') }}</td>
                        <td> <a class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                href="/transaction/detail/{{ $transaction->tanggal_transaksi }}">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- <form method="GET" action="/transaksi/pdf" class="mb-3">
            <h1 class="text-4xl font-bold mb-5">
                Print Transaction
            </h1>
            <div class="row">
                <div class="col-md-3">
                    <input type="date" name="start_date" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                        value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="end_date" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                        value="{{ request('end_date') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-success">Cetak PDF</button>
                </div>
            </div>
        </form> --}}
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#transaksitable').DataTable();
            $('.js-example-basic-single').select2();
        });
    </script>
    <script>
        $('#filter_bulan').change(function() {
            let bulan = $(this).val();

            $.ajax({
                url: '/transaction', // Ganti dengan URL API atau route yang sesuai
                type: 'GET',
                data: {
                    filter_bulan: bulan
                },
                success: function(response) {
                    // Di sini Anda memperbarui tabel dengan data yang diterima
                    console.log(response); // Cek data di konsol

                    // Contoh memperbarui tabel:
                    // $('#tabel-transaksi tbody').empty();
                    // response.forEach(function(transaksi) {
                    //     $('#tabel-transaksi tbody').append('<tr>...</tr>');
                    // });
                }
            });
        });
    </script>
@endsection
