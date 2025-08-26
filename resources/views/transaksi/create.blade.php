@extends('layouts.main')
@section('breadcrumbs')
    <nav class="flex text-white" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li>
                <a href="/transaction" class="inline-flex items-center text-sm font-medium hover:underline">
                    Transaction
                </a>
                <span class="mx-2">/</span>
                <span class="text-sm font-medium">Add New Transaction</span>

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
    <h1 class="text-4xl font-bold">Add New Transaction</h1>
    <div class="container">
        <form action="/transaction/store" method="POST">
            @csrf
            <div class="date-input">
                <div class="mt-10">Transaction Date</div>
                <input type="date" name="tanggal_transaksi" id="date"
                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 @error('tanggal_transaksi') is-invalid @enderror"
                    value="{{ old('tanggal_transaksi') }}" />
            </div>
            <div class="date-input">
                <div class="mt-3">Platfrom</div>
                <select class="js-example-basic-single w-full" name="platfrom_id" id="platfrom_id">
                    <option value="">Select Menu</option>
                    @foreach ($platfroms as $item)
                        <option value="{{ $item->id }}">{{ $item->platfrom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="date-input">
                <div class="mt-3">Menu</div>
                <select class="js-example-basic-single w-full" name="menu_id" id="menu_id">
                    <option value="">Select Menu</option>
                    @foreach ($menus as $item)
                        <option value="{{ $item->id }}">{{ $item->menu_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="date-input">
                <div class="mt-3">Quantity</div>
                <input type="number" name="jumlah_pesanan" id="jumlah_pesanan"
                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 @error('jumlah_pesanan') is-invalid @enderror"
                    value="{{ old('jumlah_pesanan') }}" />
            </div>
            <div class="date-input">
                <div class="mt-3">Price</div>
                <input type="number" name="harga" id="harga"
                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 @error('harga') is-invalid @enderror"
                    value="{{ old('harga') }}" />
            </div>
            <input type="hidden" name="role" value="0">

            <button type="submit"
                class="text-white flex justify-center items-center btn cursor-pointer bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-35 h-10 mt-5 col-span-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">
                <p class=" ">
                    Submit
                </p>
            </button>
        </form>
        {{-- <h1 class="text-4xl font-bold mt-5">Or Import Your Data</h1> --}}


    </div>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
