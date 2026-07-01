@extends('layouts.app')

@section('title', 'Products')

@section('content')

    <div class="max-w-4xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6">Edit Product</h1>

        <div class="bg-white shadow rounded-lg p-6">

            <form method="POST"
                  action="{{ route('products.update', $product) }}"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                @include('products._form')

            </form>

        </div>

    </div>

@endsection