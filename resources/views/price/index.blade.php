@extends('layouts.main')
@section('breadcrumbs')
    <nav class="flex text-white" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li>
                <span class="mx-2 inline-flex items-center text-sm font-medium">Price Recomendation </span>
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
    <h1 class="text-4xl font-bold mb-5">Price Recomendation</h1>
    <div class="container">
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
                                    {{ 'Rp. ' . number_format($harga->harga, 0, ',', '.') }}
                                @else
                                    -
                            @endif
                            </td>
                            <td>
                                @if ($harga)
                                    {{ 'RP. ' . number_format($harga->laba, 0, ',', '.') }}
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
