@extends('layouts.main')
@section('breadcrumbs')
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
    <h1 class="text-4xl font-bold mb-5">Price</h1>
    <div class="container">
        <div class="flex justify-end mb-5">
            <a class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                href="/create_price">Add New Price</a>

        </div>
        {{-- <form action="/price/store" method="POST">
            @csrf
            <div class="platfrom mb-5">
                <label class="font-semibold text-2xl" for="platfrom_id">Pilih Platfrom</label>
                <select class="js-example-basic-single w-full " name="platfrom_id" id="platfrom_id">
                    <option value="">Pilih Platfrom</option>
                    @foreach ($platfrom as $item)
                        <option value="{{ $item->id }}">{{ $item->platfrom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="menu mb-5">
                <label class="font-semibold text-2xl" for="platfrom_id">Pilih Menu</label>
                <select class="js-example-basic-single w-full" name="menu_id" id="menu_id">
                    <option value="">Pilih Menu</option>
                    @foreach ($menu as $item)
                        <option value="{{ $item->id }}" data-hpp="{{ $item->hpp }}">{{ $item->menu_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label for="hpp" class="font-semibold text-2xl ">HPP Dari Menu</label>
                <input type="number" name="hpp" id="hpp"
                    class=" border text-sm rounded-sm focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5   dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="" required="" readonly>
            </div>

            <div class="mb-5">
                <label for="target_laba" class="font-semibold text-2xl ">Persenan Target Laba</label>
                <input type="number" name="target_laba" id="target_laba"
                    class=" border text-sm rounded-sm focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5   dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="30" required="">
            </div>

            <div class="mb-5">
                <label for="komisi" class="font-semibold text-2xl ">Persenan Komisi Platfrom</label>
                <input type="number" name="komisi" id="komisi"
                    class=" border text-sm rounded-sm focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5   dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="25" required="">
            </div>

            <div class="mb-10">
                <label for="rekomendasi_harga" class="font-semibold text-2xl ">Rekomendasi Harga</label>
                <input type="number" name="rekomendasi_harga" id="rekomendasi"
                    class=" border text-sm rounded-sm focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5   dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="" required="" readonly>
            </div>
            <button type="submit"
                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-1 text-center col-span-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd"></path>
                </svg>
                Add new price
            </button>
        </form> --}}

        <div class="platfrom mb-5">
            {{-- <label class="font-semibold text-1xl " for="platfrom_id">Select Platfrom</label> --}}
            <select class="js-example-basic-single w-full " name="platfrom_id" id="platfrom_id_filter">
                <option value="">Select Platfrom</option>
                @foreach ($platfrom as $item)
                    <option value="{{ $item->id }}">{{ $item->platfrom }}</option>
                @endforeach
            </select>
        </div>
        <div class="tobul">
            <table id="priceTable" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Menu</th>
                        <th>HPP</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="priceTableBody">
                    {{-- @foreach ($price as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->menu_name }}</td>
                            <td>Rp. {{ number_format($item->hpp, 0, ',', '.') }}</td>
                            <td></td>
                            <td class="flex gap-2">
                                <button
                                    class="block text-white bg-yellow-500 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-600"
                                    onclick="UpdateMenu(this)" data-menu="{{ json_encode($menu) }}" type="button">
                                    Edit
                                </button>
                                <button
                                    class="block text-white bg-red-600 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-600"
                                    onclick="deleteMenu(this)" data-menu="{{ json_encode($menu) }}" type="button">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            $('#priceTable').DataTable();

            $('#menu_id').on('change', function() {
                let selected = this.options[this.selectedIndex];
                window.selectedHpp = parseFloat(selected.getAttribute('data-hpp')) || 0;
                $('#hpp').val(window.selectedHpp).toLocaleString('id-ID');
                hitungRekomendasi();
            });

            $('#target_laba').on('input', hitungRekomendasi);
            $('#komisi').on('input', hitungRekomendasi);

            function hitungRekomendasi() {
                let hpp = parseFloat(window.selectedHpp) || 0;
                let targetLaba = parseFloat($('#target_laba').val()) || 0;
                let komisi = parseFloat($('#komisi').val()) || 0;
                let rekomendasiHarga = (hpp + (hpp * (targetLaba / 100))) / (1 - (komisi / 100));
                $('#rekomendasi').val(rekomendasiHarga.toFixed(2));
            }

            $('#platfrom_id_filter').on('change', function() {
                let platfromId = $(this).val();
                $.get('/price/' + platfromId, function(data) {
                    let html = '';
                    data.forEach(function(item, idx) {
                        html += `<tr>
                <td>${idx + 1}</td>
                <td>${item.menu.menu_name}</td>
                <td>Rp. ${parseInt(item.menu.hpp).toLocaleString('id-ID')}</td>
                <td>Rp. ${parseInt(item.harga).toLocaleString('id-ID')}</td>
                <td class="flex gap-2">
                                                    <button
                                    class="block text-white bg-yellow-500 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-600"
                                    onclick="UpdateMenu(this)" data-menu="{{ json_encode($menu) }}" type="button">
                                    Edit
                                </button>
                                <button
                                    class="block text-white bg-red-600 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-600"
                                    onclick="deleteMenu(this)" data-menu="{{ json_encode($menu) }}" type="button">
                                    Delete
                                </button>
                </td>
            </tr>`;
                    });
                    $('#priceTableBody').html(html);
                });
            });
        });
    </script>
@endsection
