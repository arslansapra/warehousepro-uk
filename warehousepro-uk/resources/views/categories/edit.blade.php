@extends('layouts.app')

@section('title', 'Categories')

@section('content')

    <div class="max-w-3xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6">

            Edit Category

        </h1>

        <div class="bg-white shadow rounded-lg p-6">

            <form
                action="{{ route('categories.update', $category) }}"
                method="POST"
            >

                @csrf

                @method('PUT')

                @include('categories._partials.form')

            </form>

        </div>

    </div>

@endsection