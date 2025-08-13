@extends('layouts.main')
@section('breadcrumbs')
    <nav class="flex text-white" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li>
                <a href="/transaction" class="inline-flex items-center text-sm font-medium hover:underline">
                    Transaction
                </a>
                <span class="mx-2">/</span>
                <span class="text-sm font-medium">Detail Transaction</span>
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
    <h1 class="text-4xl font-bold mb-5">Detail Transaction</h1>
    <div class="container">
        <div class="tebel">
            <table class="table-auto w-full" id="TransaksiTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Platfrom</th>
                        <th>Menu</th>
                        <th>Jumlah Pesanan</th>
                        <th>Harga Jual</th>
                        <th>Laba Kotor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tanggal_transaksi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tanggal_transaksi }}</td>
                            <td>{{ $item->platfrom->platfrom }}</td>
                            {{-- <td>{{ $item->platfrom->komisi->komisi }}</td> --}}
                            <td>{{ $item->menu->menu_name }}</td>
                            <td>{{ $item->jumlah_pesanan }}</td>
                            <td>{{ 'Rp. ' . number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ 'Rp.' . number_format($item->laba_kotor, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#TransaksiTable').DataTable();
        });
    </script>
@endsection
