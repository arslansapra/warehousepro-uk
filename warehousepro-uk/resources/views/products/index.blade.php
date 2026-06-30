<x-app-layout>

    <div class="max-w-7xl mx-auto p-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">

            <h1 class="text-3xl font-bold">
                Products
            </h1>
@can('create', App\Models\Product::class)
            <a href="{{ route('products.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                + Add Product
            </a>
@endcan
        </div>

        {{-- Success Message --}}
        @if(session('success'))

            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">

                {{ session('success') }}

            </div>

        @endif

        {{-- Table Card --}}
        <div class="bg-white shadow rounded-lg overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-4 text-left">Product</th>

                        <th class="p-4 text-left">SKU</th>

                        <th class="p-4 text-left">Category</th>

                        <th class="p-4 text-left">Location</th>

                        <th class="p-4 text-left">Qty</th>

                        <th class="p-4 text-left">Price</th>
                        @can('create', App\Models\Product::class)
                        <th class="p-4 text-left">Actions</th>
                        @endcan

                    </tr>

                </thead>

                <tbody>

                    @forelse($products as $product)

                        <tr class="border-t hover:bg-gray-50">

                            {{-- Product --}}
                            <td class="p-4 flex items-center gap-3">

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    class="w-10 h-10 rounded object-cover"
                                    alt=""
                                >

                                <div>

                                    <div class="font-semibold">

                                        {{ $product->name }}

                                    </div>

                                    <div class="text-sm text-gray-500">

                                        {{ Str::limit($product->description, 30) }}

                                    </div>

                                </div>

                            </td>

                            {{-- SKU --}}
                            <td class="p-4 text-gray-600">
                                {{ $product->sku }}
                            </td>

                            {{-- Category --}}
                            <td class="p-4">
                                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-sm">
                                    {{ $product->category->name ?? '-' }}
                                </span>
                            </td>

                            {{-- Location --}}
                            <td class="p-4 text-gray-600">
                                {{ $product->location->code ?? '-' }}
                            </td>

                            {{-- Qty --}}
                            <td class="p-4">
                                @if($product->quantity <= 5)
                                    <span class="text-red-600 font-bold">
                                        {{ $product->quantity }}
                                    </span>
                                @else
                                    <span class="text-green-600">
                                        {{ $product->quantity }}
                                    </span>
                                @endif
                            </td>

                            {{-- Price --}}
                            <td class="p-4 font-semibold">
                                £{{ number_format($product->price, 2) }}
                            </td>
                            @can('create', App\Models\Product::class)
                            {{-- Actions --}}
                            <td class="p-4 flex gap-4">
                                @can('update', $product)
                                <a href="{{ route('products.edit', $product) }}"
                                   class="text-blue-600 hover:underline">
                                    Edit
                                </a>
                                @endcan
                                @can('delete', $product)
                                <form method="POST"
                                      action="{{ route('products.destroy', $product) }}">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Delete product?')"
                                        class="text-red-600 hover:underline">

                                        Delete

                                    </button>
                                @endcan    

                                </form>

                            </td>
                            @endcan

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="p-6 text-center text-gray-500">

                                No products found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>