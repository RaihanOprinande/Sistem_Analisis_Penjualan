@extends('layouts.main')
@section('breadcrumbs')
    <nav class="flex text-white" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li>
                <a href="/dashboard" class="inline-flex items-center text-sm font-medium hover:underline">
                    Dashboard
                </a>
                <span class="mx-2">/</span>
                <a href="/platfrom" class="inline-flex items-center text-sm font-medium hover:underline">
                    Platfrom
                </a>
                <span class="mx-2">/</span>
                <span class="text-sm font-medium">Commission</span>
            </li>
        </ol>
    </nav>
@endsection

@section('content')
    @include('platfrom.komisi.create')
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
    <h1 class="text-4xl font-bold mb-5">Commission</h1>
    <div class="container">
        <h2 class="text-3xl font-medium mb-5">{{ $platfrom->platfrom }} Commission</h2>
        <div class="flex justify-end mb-5">
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Add New Commission
            </button>
        </div>
        <table id="komisiTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Commission</th>
                    <th>Effective Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($komisi as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->komisi }}%</td>
                        <td>{{ $item->tanggal_berlaku }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#komisiTable').DataTable();
        });
    </script>
@endsection
