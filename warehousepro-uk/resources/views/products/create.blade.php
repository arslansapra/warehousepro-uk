@extends('layouts.app')

@section('title', 'Products')

@section('content')


    <div class="max-w-4xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6">Create Product</h1>

        <div class="bg-white shadow rounded-lg p-6">

            <form method="POST"
                  action="{{ route('products.store') }}"
                  enctype="multipart/form-data">

                @csrf

                @include('products._form', [
                    'product' => null
                ])

            </form>

        </div>

    </div>

@endsection