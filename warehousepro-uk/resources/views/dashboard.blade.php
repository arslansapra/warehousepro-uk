<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Warehouse Dashboard
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Welcome back,
                    <span class="font-semibold">{{ auth()->user()->name }}</span>
                    ({{ auth()->user()->role->name }})
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto px-6">

            <!-- {{-- Welcome Card --}}
            <div class="bg-white rounded-xl shadow p-6 mb-8">
                
                <h3 class="text-xl font-semibold text-gray-800">
                    Welcome back, {{ auth()->user()->name }} 👋
                </h3>

                <p class="text-gray-600 mt-2">
                    Here's a quick overview of your warehouse operations.
                </p>

            </div> -->

            {{-- Statistics --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

                {{-- Total Products --}}
                <div class="bg-white rounded-xl shadow p-6">

                    <p class="text-gray-500 text-sm">
                        Total Products
                    </p>

                    <h2 class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $stats['total_products'] }}
                    </h2>

                </div>

                {{-- Low Stock --}}
                <div class="bg-red-50 rounded-xl shadow p-6">

                    <p class="text-red-600 text-sm">
                        Low Stock Items
                    </p>

                    <h2 class="text-3xl font-bold text-red-700 mt-2">
                        {{ $stats['low_stock'] }}
                    </h2>

                </div>

                {{-- Pending Purchase Orders --}}
                <div class="bg-yellow-50 rounded-xl shadow p-6">

                    <p class="text-yellow-700 text-sm">
                        Pending Purchase Orders
                    </p>

                    <h2 class="text-3xl font-bold text-yellow-800 mt-2">
                        {{ $stats['pending_po'] }}
                    </h2>

                </div>

                {{-- Suppliers --}}
                <div class="bg-green-50 rounded-xl shadow p-6">

                    <p class="text-green-700 text-sm">
                        Active Suppliers
                    </p>

                    <h2 class="text-3xl font-bold text-green-800 mt-2">
                        {{ $stats['total_suppliers'] }}
                    </h2>

                </div>

            </div>

            {{-- Second Row --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- Stock Activity --}}
                <div class="bg-white rounded-xl shadow">

                    <div class="border-b px-6 py-4">

                        <h3 class="text-lg font-semibold text-gray-800">
                            Today's Stock Activity
                        </h3>

                    </div>

                    <div class="p-6 space-y-4">

                        <div class="flex justify-between">

                            <span class="text-gray-600">
                                Stock In
                            </span>

                            <span class="font-bold text-green-600">
                                {{ $stats['today_stock_in'] }}
                            </span>

                        </div>

                        <div class="flex justify-between">

                            <span class="text-gray-600">
                                Stock Out
                            </span>

                            <span class="font-bold text-red-600">
                                {{ $stats['today_stock_out'] }}
                            </span>

                        </div>

                    </div>

                </div>

                {{-- Recent Movements --}}
                <div class="bg-white rounded-xl shadow">

                    <div class="border-b px-6 py-4">

                        <h3 class="text-lg font-semibold text-gray-800">
                            Recent Stock Movements
                        </h3>

                    </div>

                    <div class="divide-y">

                        @forelse($stats['recent_movements'] as $movement)

                            <div class="px-6 py-4 flex justify-between items-center">

                                <div>

                                    <p class="font-medium text-gray-800">

                                        {{ $movement->product->name }}

                                    </p>

                                    <p class="text-sm text-gray-500">

                                        {{ ucfirst(str_replace('_', ' ', $movement->type)) }}

                                    </p>

                                </div>

                                <div class="text-right">

                                    <p class="font-semibold">

                                        Qty: {{ $movement->quantity }}

                                    </p>

                                    <p class="text-xs text-gray-400">

                                        {{ $movement->created_at->format('d M Y H:i') }}

                                    </p>

                                </div>

                            </div>

                        @empty

                            <div class="p-6 text-center text-gray-500">

                                No recent stock movements.

                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>