@extends('layouts.app')

@section('title', 'Warehouse Locations')

@section('content')

    <div class="max-w-3xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6">

            {{ isset($warehouseLocation) ? 'Edit Location' : 'Create Location' }}

        </h1>

        <div class="bg-white shadow rounded-lg p-6">

            <form method="POST"
                  action="{{ isset($warehouseLocation)
                        ? route('warehouse-locations.update', $warehouseLocation)
                        : route('warehouse-locations.store') }}">

                @csrf

                @isset($warehouseLocation)
                    @method('PUT')
                @endisset

                {{-- Zone --}}
                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Zone
                    </label>

                    <input
                        name="zone"
                        type="text"
                        value="{{ old('zone', $warehouseLocation->zone ?? '') }}"
                        class="w-full border rounded-lg px-4 py-2"
                        placeholder="Enter zone"
                    >

                    @error('zone')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Rack --}}
                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Rack
                    </label>

                    <input
                        name="rack"
                        type="text"
                        value="{{ old('rack', $warehouseLocation->rack ?? '') }}"
                        class="w-full border rounded-lg px-4 py-2"
                        placeholder="Enter rack"
                    >

                    @error('rack')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Shelf --}}
                <div class="mb-6">

                    <label class="block mb-2 font-medium">
                        Shelf
                    </label>

                    <input
                        name="shelf"
                        type="text"
                        value="{{ old('shelf', $warehouseLocation->shelf ?? '') }}"
                        class="w-full border rounded-lg px-4 py-2"
                        placeholder="Enter shelf"
                    >

                    @error('shelf')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Button --}}
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">

                    Save Location

                </button>

            </form>

        </div>

    </div>

@endsection