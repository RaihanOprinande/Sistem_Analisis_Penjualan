@extends('layouts.main')
@section('content')
    @include('platfrom.update')
    @include('platfrom.delete')

    <h1 class="text-4xl font-bold mb-5">
        Platfrom
    </h1>
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
    <div class="container">

        <form action="price/platfrom/store" method="POST" class="mb-5">
            @csrf
            <label for="platfrom">New Plafrom</label>
            <div class="md:col-span-5 flex">
                <input type="text" name="platfrom" id="platfrom" class="h-10 border mt-1 rounded px-4 w-250 bg-gray-50"
                    value="" />
                <button type="submit"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm ms-5 w-40 mt-1 col-span-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <p class="ms-5">
                        Add new platfrom
                    </p>
                </button>
            </div>
        </form>

        <table id="platfromTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Platfrom</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($platfrom as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->platfrom }}</td>
                        <td class="flex gap-2">
                            <button
                                class="block text-white bg-yellow-500 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-600"
                                onclick="UpdatePlatfrom(this)" data-platfrom="{{ json_encode($item) }}" type="button">
                                Edit
                            </button>
                            <button
                                class="block text-white bg-red-600 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-600"
                                onclick="DeletePlatfrom(this)" data-platfrom="{{ json_encode($item) }}" type="button">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#platfromTable').DataTable();
        });

        function UpdatePlatfrom(button) {
            var platfrom = $(button).data('platfrom');
            $('#update-modal').removeClass('hidden');
            document.getElementById('edit-id').value = platfrom.id;
            document.getElementById('platfrom').value = platfrom.platfrom;
            document.querySelector('#update-modal form').action = `/platfrom/${platfrom.id}`;
        }

        function DeletePlatfrom(button) {
            var platfrom = $(button).data('platfrom');
            $('#delete-modal').removeClass('hidden');
            document.getElementById('delete-id').value = platfrom.id;
            document.querySelector('#delete-modal form').action = `/platfrom/${platfrom.id}`;
        }
    </script>
@endsection
