@extends('layouts.main')
@section('breadcrumbs')
    <nav class="flex text-white" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li>
                <a href="/admin" class="inline-flex items-center text-sm font-medium hover:underline">
                    Admin
                </a>
            </li>
        </ol>
    </nav>
@endsection
@section('content')
    @include('admin.delete')
    @include('admin.update')
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
    <h1 class="text-4xl font-bold">Admin</h1>
    <div class="container">
        <div class="flex justify-end mb-5">
            <div class="flex justify-end mb-5">
                <a class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    href="/admin/create">Add New Admin</a>
            </div>
        </div>
        <div class="tabel">
            <table id="admintable" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admin as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td class="flex gap-2">
                                <button
                                    class="block text-white bg-yellow-500 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-600"
                                    onclick="UpdateAdmin(this)" data-item="{{ json_encode($item) }}" type="button">
                                    Edit
                                </button>
                                <button
                                    class="block text-white bg-red-600 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-600"
                                    onclick="deleteAdmin(this)" data-item="{{ json_encode($item) }}" type="button">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // $('.js-example-basic-single').select2();
            $('#admintable').DataTable();

        });

        function UpdateAdmin(button) {
            var item = $(button).data('item');
            $('#update-modal').removeClass('hidden');
            document.getElementById('edit-id').value = item.id;
            document.getElementById('name').value = item.name;
            document.getElementById('email').value = item.email;
            document.querySelector('#update-modal form').action = `/admin/${item.id}`;
        }

        function deleteAdmin(button) {
            var item = $(button).data('item');
            $('#delete-modal').removeClass('hidden');
            document.getElementById('delete-id').value = item.id;
            document.querySelector('#delete-modal form').action = `/admin/${item.id}`;
            4
        }
    </script>
@endsection
