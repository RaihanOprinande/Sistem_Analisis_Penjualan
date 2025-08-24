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
                        <th>Komisi</th>
                        <th>Menu</th>
                        <th>Hpp</th>
                        <th class="w-4">Jumlah Pesanan</th>
                        <th>Harga Jual</th>
                        <th>Omset</th>
                        <th>Laba Kotor</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tanggal_transaksi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tanggal_transaksi }}</td>
                            <td>{{ $item->platfrom->platfrom }}</td>
                            <td>{{ $item->komisi->komisi }} %</td>
                            <td>{{ $item->menu->menu_name }}</td>
                            <td>{{ 'Rp. ' . number_format($item->menu->hpp, 0, ',', '.') }}</td>
                            <td class="w-5">{{ $item->jumlah_pesanan }}</td>
                            <td>{{ 'Rp. ' . number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ 'Rp. ' . number_format($item->harga * $item->jumlah_pesanan, 0, ',', '.') }}</td>
                            <td>{{ 'Rp. ' . number_format($item->laba_kotor, 0, ',', '.') }}</td>
                            <td>
                                {{-- Ubah ID agar unik --}}
                                @switch($item->status)
                                    @case('voided')
                                        <button id="dropdownDefaultButton-{{ $item->id }}"
                                            data-dropdown-toggle="dropdown-{{ $item->id }}"
                                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                            type="button">
                                            {{-- Bungkus teks di dalam span --}}
                                            <span id="status-text-{{ $item->id }}">{{ $item->status }}</span>
                                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>
                                    @break

                                    @default
                                        <button id="dropdownDefaultButton-{{ $item->id }}"
                                            data-dropdown-toggle="dropdown-{{ $item->id }}"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                            type="button">
                                            {{-- Bungkus teks di dalam span --}}
                                            <span id="status-text-{{ $item->id }}">{{ $item->status }}</span>
                                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>
                                @endswitch


                                {{-- Ubah ID agar unik --}}

                                <div id="dropdown-{{ $item->id }}"
                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownDefaultButton-{{ $item->id }}">
                                        <li>
                                            {{-- Tambahkan atribut data-status dan data-id di sini --}}
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white status-option"
                                                data-status="valid" data-id="{{ $item->id }}">Valid</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white status-option"
                                                data-status="voided" data-id="{{ $item->id }}">Voided</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
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
        // Pastikan Anda sudah menyertakan jQuery di proyek Anda
        $(document).ready(function() {
            $('.status-option').on('click', function(e) {
                e.preventDefault(); // Mencegah link memuat ulang halaman

                let transactionId = $(this).data('id');
                let newStatus = $(this).data('status');
                let csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Mengirim permintaan AJAX ke server
                $.ajax({
                    url: `/transactions/${transactionId}/status`,
                    type: 'PUT',
                    data: {
                        _token: csrfToken,
                        status: newStatus,
                        reason: 'Perubahan manual dari dashboard'
                    },
                    success: function(response) {
                        // Beri umpan balik ke pengguna
                        // alert('Status berhasil diubah menjadi ' + newStatus + '!');

                        // Perbarui teks dan warna tombol tanpa memuat ulang halaman
                        let button = $(`#dropdownDefaultButton-${transactionId}`);
                        button.text(newStatus);

                        // Hapus semua kelas warna yang ada dan tambahkan yang baru
                        button.removeClass('bg-green-500 bg-red-500 bg-yellow-400');
                        if (newStatus === 'valid') {
                            button.addClass('bg-green-500');
                        } else if (newStatus === 'voided') {
                            button.addClass('bg-red-500');
                        } else {
                            button.addClass('bg-yellow-400');
                        }
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('Gagal mengubah status. Silakan coba lagi.');
                    }
                });
            });
        });
    </script>
@endsection
