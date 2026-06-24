<x-app-layout>

    <div class="max-w-7xl mx-auto p-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">

            <h1 class="text-3xl font-bold">
                Stock Movement History
            </h1>

            <a
                href="{{ route('stock-movements.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
            >

                + Create Movement

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

                        <th class="p-4 text-left">
                            Product
                        </th>

                        <th class="p-4 text-left">
                            Type
                        </th>

                        <th class="p-4 text-left">
                            Quantity
                        </th>

                        <th class="p-4 text-left">
                            Created By
                        </th>

                        <th class="p-4 text-left">
                            Date
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($movements as $movement)

                        <tr class="border-t hover:bg-gray-50">

                            {{-- Product --}}
                            <td class="p-4 font-medium">

                                {{ $movement->product->name }}

                            </td>

                            {{-- Type --}}
                            <td class="p-4">

                                @if($movement->type === 'stock_in')

                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">

                                        Stock In

                                    </span>

                                @elseif($movement->type === 'stock_out')

                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm">

                                        Stock Out

                                    </span>

                                @else

                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-sm">

                                        Adjustment

                                    </span>

                                @endif

                            </td>

                            {{-- Quantity --}}
                            <td class="p-4">

                                {{ $movement->quantity }}

                            </td>

                            {{-- Created By --}}
                            <td class="p-4">

                                {{ $movement->user->name }}

                            </td>

                            {{-- Date --}}
                            <td class="p-4 text-gray-600">

                                {{ $movement->created_at->format('d M Y') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="p-6 text-center text-gray-500"
                            >

                                No stock movements found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>