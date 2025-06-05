@extends('layouts.main')
@section('breadcrumb')
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
    <h1 class="text-4xl font-bold">{{ $pelatfrom->platfrom }}</h1>
    <div class="container">
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
    </script>
@endsection
