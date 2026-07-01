@extends('layouts.app')

@section('title', 'Suppliers')

@section('content')

    <div class="max-w-3xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6">

            Create Supplier

        </h1>

        <div class="bg-white shadow rounded-lg p-6">

            <form method="POST"
                  action="{{ route('suppliers.store') }}">

                @csrf

                @include('suppliers.partials.form')

            </form>

        </div>

    </div>

@endsection