@extends('layouts.main')
@section('breadcrumb')
@endsection
@section('content')
    @include('komisi.create')
    @include('komisi.update')
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
    <h1 class="text-4xl font-bold">{{ $pelatfrom->platfrom }}</h1>
    <div class="container">
        <div class="flex justify-end mb-5">
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Add New Commission
            </button>
        </div>
        <div class="tebel">
            <table id="komisitable" class="display">
                <thead>
                    <tr>
                        {{-- <th>Platfrom</th> --}}
                        <th>Commission</th>
                        <th>Effective Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($komisi as $km)
                        <tr>
                            {{-- <td>{{ $km->platfrom->platfrom }}</td> --}}
                            <td>{{ $km->komisi }}%</td>
                            <td>{{ $km->tanggal_berlaku }}</td>
                            <td class="flex gap-2">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#komisitable').DataTable();
        });

        function UpdateKomisi(button) {
            var komisi = $(button).data('komisi');
            $('#update-modal').removeClass('hidden');
            document.getElementById('edit-id').value = komisi.id;
            document.getElementById('komisi').value = komisi.komisi;
            document.getElementById('tanggal_berlaku').value = komisi.tanggal_berlaku;
            document.querySelector('#update-modal form').action = `/komisi/${komisi.id}`;
        }

        function deleteKomisi(button) {
            var komisi = $(button).data('komisi');
            $('#delete-modal').removeClass('hidden');
            document.getElementById('delete-id').value = komisi.id;
            document.querySelector('#delete-modal form').action = `/komisi/${komisi.id}`;
        }

        setTimeout(function() {
            const alertBox = document.getElementById('alert-box');
            if (alertBox) {
                alertBox.style.display = 'none';
            }
        }, 3000);
    </script>
@endsection
