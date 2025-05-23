@extends('layouts.main')
@section('content')
    <div class="container">
        <h1 class="text-3xl font-bold text-center mb-18">Price for Platfrom</h1>


        <div class="flex gap-6 justify-center">
            {{-- CARD 1 GOFOOD --}}
            <a href="/">
                <div
                    class="ms-30 max-w-sm bg-white border flex flex-col items-center justify-center border-gray-200 rounded-lg shadow-sm h-140 w-500">
                    <img class="p-8 rounded-t-lg w-60  h-auto" src="images/logo_Gofood.png" alt="product image" />
                    <div class="px-5 pb-5">
                        {{-- <a href="#">
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 text-center">GOFOOD</h5>
                    </a> --}}
                        {{-- <div class="flex items-center justify-center">
                        <span class="text-3xl font-bold text-gray-900 ">RP. 955,000</span>
                    </div> --}}

                        {{-- <button href=""
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 w-80 mt-20 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                        to cart</button> --}}
                    </div>
                </div>
            </a>
            {{-- CARD 2 FOR GRABFOOD --}}
            <a href="/">
                <div
                    class=" max-w-sm bg-white border flex flex-col items-center justify-center border-gray-200 rounded-lg shadow-sm h-140 w-500">
                    <img class="p-8 rounded-t-lg w-60  h-auto" src="images/logo_Shopee.png" alt="product image" />
                    <div class="px-5 pb-5">
                        {{-- <a href="#">
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 text-center">GOFOOD</h5>
                    </a> --}}
                        {{-- <div class="flex items-center justify-center">
                        <span class="text-3xl font-bold text-gray-900 ">RP. 955,000</span>
                    </div> --}}

                        {{-- <button href=""
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 w-80 mt-20 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                        to cart</button> --}}
                    </div>
                </div>
            </a>
            {{-- CARD 3 SHOPEE --}}
            <a href="/">
                <div
                    class=" max-w-sm bg-white border flex flex-col items-center justify-center border-gray-200 rounded-lg shadow-sm h-140 w-500">
                    <img class="p-8 rounded-t-lg w-60  h-auto" src="images/logo_Gofood.png" alt="product image" />
                    <div class="px-5 pb-5">
                        {{-- <a href="#">
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 text-center">GOFOOD</h5>
                    </a> --}}
                        {{-- <div class="flex items-center justify-center">
                        <span class="text-3xl font-bold text-gray-900 ">RP. 955,000</span>
                    </div> --}}

                        {{-- <button href=""
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 w-80 mt-20 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                        to cart</button> --}}
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
