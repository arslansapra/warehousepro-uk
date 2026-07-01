@extends('layouts.app')

@section('title', 'Categories')

@section('content')

    <div class="max-w-7xl mx-auto p-6">

        <div class="flex items-center justify-between mb-6">

            <h1 class="text-3xl font-bold">
                Categories
            </h1>

            <a
                href="{{ route('categories.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
            >
                + Add Category
            </a>

        </div>

        @if(session('success'))

            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">

                {{ session('success') }}

            </div>

        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-4 text-left">Name</th>

                        <th class="p-4 text-left">Description</th>

                        <th class="p-4 text-left">Status</th>

                        <th class="p-4 text-left">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($categories as $category)

                        <tr class="border-t">

                            <td class="p-4">

                                {{ $category->name }}

                            </td>

                            <td class="p-4">

                                {{ $category->description }}

                            </td>

                            <td class="p-4">

                                @if($category->is_active)

                                    <span class="text-green-600">

                                        Active

                                    </span>

                                @else

                                    <span class="text-red-600">

                                        Inactive

                                    </span>

                                @endif

                            </td>

                            <td class="p-4 flex gap-3">

                                <a
                                    href="{{ route('categories.edit', $category) }}"
                                    class="text-blue-600"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('categories.destroy', $category) }}"
                                    method="POST"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Delete category?')"
                                        class="text-red-600"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="p-4 text-center"
                            >

                                No categories found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection