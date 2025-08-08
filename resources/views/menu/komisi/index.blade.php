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
                <span class="mx-2">/</span>
                <span class="text-sm font-medium">Commission</span>
            </li>
        </ol>
    </nav>
@endsection

@section('content')
    <h1 class="text-4xl font-bold mb-5">Commission</h1>
    <div class="container">
        <h2 class="text-3xl font-bold mb-5"></h2>
    </div>
@endsection
