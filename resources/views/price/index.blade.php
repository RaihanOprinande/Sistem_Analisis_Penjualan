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
        <div class="tobul">
            <table id="priceTable" class="display">
                <thead>
                    <tr>
                        <th rowspan="2" class="">Menu</th>
                        @foreach ($platfrom as $pf)
                            <th colspan="2" class=""> {{ $pf->platfrom }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach ($platfrom as $pf)
                            <th>Harga</th>
                            <th>Laba</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menu as $m)
                        <tr>
                            <td>{{ $m->menu_name }}</td>
                            @foreach ($platfrom as $pf)
                                @php
                                    $harga = $price->where('menu_id', $m->id)->where('platfrom_id', $pf->id)->first();
                                    $get_komisi = $komisi
                                        ->where('platfrom_id', $pf->id)
                                        ->sortByDesc('created_at')
                                        ->first();
                                @endphp
                                <td>
                                    @if ($harga)
                                        <a href="/update_price/{{ $harga->id }}">
                                            {{ 'Rp. ' . number_format($harga->harga, 0, ',', '.') }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if ($harga)
                                        {{-- Laba = target_laba (menu) * harga / 100 --}}
                                        {{-- {{ 'Rp. ' . number_format(($m->target_laba * $harga->harga) / 100, 0, ',', '.') }} --}}
                                        {{ 'RP. ' . number_format($harga->harga * (1 - $get_komisi->komisi / 100) - $m->hpp, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            $('#priceTable').DataTable();

        });
    </script>
@endsection
