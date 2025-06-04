@extends('layouts.main')
@section('breadcrumbs')
    <nav class="flex text-white" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li>
                <a href="/dashboard" class="inline-flex items-center text-sm font-medium hover:underline">
                    Dashboard
                </a>
                <span class="mx-2">/</span>
                <span class="text-sm font-medium">Menu</span>
            </li>
        </ol>
    </nav>
@endsection
@section('content')
    @include('menu.create')
    @include('menu.update')
    @include('menu.delete')

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
    <h1 class="text-4xl font-bold">Menu</h1>
    <div class="container">

        <div class="flex justify-end mb-5">
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Add New Menu
            </button>
        </div>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>HPP</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menu as $menu)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $menu->menu_name }}</td>
                        <td>Rp. {{ number_format($menu->hpp, 0, ',', '.') }}</td>
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
                @endforeach
            </tbody>
        </table>
        <div class="container mt-10">

        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        function UpdateMenu(button) {
            var menu = $(button).data('menu');
            $('#update-modal').removeClass('hidden');
            document.getElementById('edit-id').value = menu.id;
            document.getElementById('menu_name').value = menu.menu_name;
            document.getElementById('hpp').value = menu.hpp;
            document.querySelector('#update-modal form').action = `/menu/${menu.id}`;
        }

        function deleteMenu(button) {
            var menu = $(button).data('menu');
            $('#delete-modal').removeClass('hidden');
            document.getElementById('delete-id').value = menu.id;
            document.querySelector('#delete-modal form').action = `/menu/${menu.id}`;
        }

        setTimeout(function() {
            const alertBox = document.getElementById('alert-box');
            if (alertBox) {
                alertBox.style.display = 'none';
            }
        }, 3000);
    </script>
@endsection
