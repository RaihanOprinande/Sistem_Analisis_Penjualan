@extends('layouts.main')
@section('breadcrumbs')
    <nav class="flex text-white" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li>
                <a href="/Admin" class="inline-flex items-center text-sm font-medium hover:underline">
                    Admin
                </a>
                <span class="mx-2">/</span>
                <a href="/Admin/create" class="inline-flex items-center text-sm font-medium hover:underline">
                    Create Admin
                </a>
            </li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="alert mx-auto" id="alert-box">
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

    <h1 class="text-4xl font-bold">Create Admin</h1>
    <div class="container">
        <form class="space-y-6 mt-5" method="POST" action="/register">
            @csrf
            <div>
                <label for="name" class="block mb-2 text-sm font-medium ">Name</label>
                <input type="name" name="name" id="name" value="{{ old('name') }}"
                    class="@error('name') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400 "
                    placeholder="Denis" required />
            </div>

            <div>
                <label for="email" class="block mb-2 text-sm font-medium ">Email</label>
                <input type="email" name="email" id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400 "
                    placeholder="name@gmail.com" required />
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium ">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400 "
                    required />
            </div>
            <div>
                <label for="password_confirmation" class="block mb-2 text-sm font-medium ">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400 "
                    required />
            </div>
            <button type="submit"
                class="text-white flex justify-center items-center btn cursor-pointer bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-35 h-10 mt-5 col-span-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">
                <p class=" ">
                    Submit
                </p>
            </button>
        </form>
    </div>
    <script>
        setTimeout(function() {
            const alertBox = document.getElementById('alert-box');
            if (alertBox) {
                alertBox.style.display = 'none';
            }
        }, 3000);
    </script>
@endsection
