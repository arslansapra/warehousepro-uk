@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@php
    $user = auth()->user();
    $role = $user->role->slug;
@endphp

<div class="py-8">
    <div class="max-w-7xl mx-auto px-6">

        {{-- ================= ADMIN / MANAGER / STAFF SUMMARY ================= --}}
        @if(in_array($role, ['admin','warehouse_manager','staff']))

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

                {{-- Total Products --}}
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-gray-500 text-sm">Total Products</p>
                    <h2 class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $stats['total_products'] }}
                    </h2>
                </div>

                {{-- Low Stock (Manager/Admin only) --}}
                @if(in_array($role, ['admin','warehouse_manager']))
                    <div class="bg-red-50 rounded-xl shadow p-6">
                        <p class="text-red-600 text-sm">Low Stock Items</p>
                        <h2 class="text-3xl font-bold text-red-700 mt-2">
                            {{ $stats['low_stock'] }}
                        </h2>
                    </div>

                    <div class="bg-yellow-50 rounded-xl shadow p-6">
                        <p class="text-yellow-700 text-sm">Pending Purchase Orders</p>
                        <h2 class="text-3xl font-bold text-yellow-800 mt-2">
                            {{ $stats['pending_po'] }}
                        </h2>
                    </div>

                    <div class="bg-green-50 rounded-xl shadow p-6">
                        <p class="text-green-700 text-sm">Active Suppliers</p>
                        <h2 class="text-3xl font-bold text-green-800 mt-2">
                            {{ $stats['total_suppliers'] }}
                        </h2>
                    </div>
                @endif

            </div>

            {{-- ================= SECOND ROW ================= --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- STOCK ACTIVITY --}}
                <div class="bg-white rounded-xl shadow">

                    <div class="border-b px-6 py-4">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Today's Stock Activity
                        </h3>
                    </div>

                    <div class="p-6 space-y-4">

                        <div class="flex justify-between">
                            <span class="text-gray-600">Stock In</span>
                            <span class="font-bold text-green-600">
                                {{ $stats['today_stock_in'] }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-600">Stock Out</span>
                            <span class="font-bold text-red-600">
                                {{ $stats['today_stock_out'] }}
                            </span>
                        </div>

                    </div>
                </div>

                {{-- RECENT MOVEMENTS --}}
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

        @endif


        {{-- ================= PICKER DASHBOARD ================= --}}
        @if($role === 'picker')
            <div class="bg-white p-6 rounded-xl shadow">
                <h2 class="text-xl font-bold mb-4">My Picking Tasks</h2>
                <p class="text-gray-500">(Next step: assign orders to picker)</p>
            </div>
        @endif


        {{-- ================= PACKER DASHBOARD ================= --}}
        @if($role === 'packer')
            <div class="bg-white p-6 rounded-xl shadow">
                <h2 class="text-xl font-bold mb-4">Packing Queue</h2>
                <p class="text-gray-500">(Next step: packing workflow)</p>
            </div>
        @endif

    </div>
</div>

@endsection