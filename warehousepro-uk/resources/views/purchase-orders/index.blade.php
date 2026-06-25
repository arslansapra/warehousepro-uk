<x-app-layout>

    <div class="max-w-7xl mx-auto p-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">

            <h1 class="text-3xl font-bold text-gray-800">
                Purchase Orders
            </h1>

            <a href="{{ route('purchase-orders.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">

                + Create Purchase Order

            </a>

        </div>

        {{-- Success Message --}}
        @if(session('success'))

            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">

                {{ session('success') }}

            </div>

        @endif

        {{-- Table Card --}}
        <div class="bg-white shadow rounded-lg overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left p-4 font-semibold text-gray-700">
                            PO Number
                        </th>

                        <th class="text-left p-4 font-semibold text-gray-700">
                            Supplier
                        </th>

                        <th class="text-left p-4 font-semibold text-gray-700">
                            Status
                        </th>

                        <th class="text-left p-4 font-semibold text-gray-700">
                            Created By
                        </th>

                        <th class="text-left p-4 font-semibold text-gray-700">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($purchaseOrders as $purchaseOrder)

                        <tr class="border-t hover:bg-gray-50 transition">

                            {{-- PO Number --}}
                            <td class="p-4 font-medium text-gray-800">
                                {{ $purchaseOrder->po_number }}
                            </td>

                            {{-- Supplier --}}
                            <td class="p-4 text-gray-700">
                                {{ $purchaseOrder->supplier->company_name }}
                            </td>

                            {{-- Status --}}
                            <td class="p-4">

                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-700">

                                    {{ ucfirst($purchaseOrder->status) }}

                                </span>

                            </td>

                            {{-- Created By --}}
                            <td class="p-4 text-gray-700">
                                {{ $purchaseOrder->orderedBy->name }}
                            </td>

                            {{-- Actions --}}
                            <td class="p-4">

                                <div class="flex gap-3">

                                    <a href="{{ route('purchase-orders.show', $purchaseOrder) }}"
                                       class="text-blue-600 hover:underline font-medium">

                                        View

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="p-6 text-center text-gray-500">

                                No purchase orders found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>