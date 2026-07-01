@extends('layouts.app')

@section('title', 'Warehouse Locations')

@section('content')

    <div class="max-w-7xl mx-auto p-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">

            <h1 class="text-3xl font-bold">
                Warehouse Locations
            </h1>

            <a href="{{ route('warehouse-locations.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                + Add Location
            </a>

        </div>

        {{-- Success Message --}}
        @if(session('success'))

            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">

                {{ session('success') }}

            </div>

        @endif

        {{-- Table Card --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-4 text-left">Code</th>

                        <th class="p-4 text-left">Zone</th>

                        <th class="p-4 text-left">Rack</th>

                        <th class="p-4 text-left">Shelf</th>

                        <th class="p-4 text-left">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($locations as $location)

                        <tr class="border-t">

                            <td class="p-4">
                                {{ $location->code }}
                            </td>

                            <td class="p-4">
                                {{ $location->zone }}
                            </td>

                            <td class="p-4">
                                {{ $location->rack }}
                            </td>

                            <td class="p-4">
                                {{ $location->shelf }}
                            </td>

                            <td class="p-4 flex gap-4">

                                <a href="{{ route('warehouse-locations.edit', $location) }}"
                                   class="text-blue-600 hover:underline">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('warehouse-locations.destroy', $location) }}">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Delete location?')"
                                        class="text-red-600 hover:underline">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="p-6 text-center text-gray-500">

                                No warehouse locations found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection