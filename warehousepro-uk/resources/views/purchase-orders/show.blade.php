<x-app-layout>

    <div class="max-w-5xl mx-auto p-6">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-3xl font-bold">
                Purchase Order Details
            </h1>

            <a href="{{ route('purchase-orders.index') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg">

                Back

            </a>

        </div>

        <div class="bg-white shadow rounded-lg p-6 mb-6">

            <div class="grid grid-cols-2 gap-6">

                <div>

                    <p class="text-sm text-gray-500">
                        PO Number
                    </p>

                    <p class="font-semibold">
                        {{ $purchaseOrder->po_number }}
                    </p>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Supplier
                    </p>

                    <p class="font-semibold">
                        {{ $purchaseOrder->supplier->company_name }}
                    </p>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Status
                    </p>

                    <p class="font-semibold">
                        {{ ucfirst($purchaseOrder->status) }}
                    </p>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Created By
                    </p>

                    <p class="font-semibold">
                        {{ $purchaseOrder->orderedBy->name }}
                    </p>

                </div>

            </div>

            @if($purchaseOrder->notes)

                <div class="mt-6">

                    <p class="text-sm text-gray-500">
                        Notes
                    </p>

                    <p>
                        {{ $purchaseOrder->notes }}
                    </p>

                </div>

            @endif

        </div>

        {{-- ✅ UPDATED TABLE START --}}
        <div class="bg-white shadow rounded-lg overflow-x-auto">

            <div class="p-6 border-b">

                <h2 class="text-xl font-semibold">
                    Products
                </h2>

            </div>

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left p-4 font-semibold text-gray-700">
                            Product
                        </th>

                        <th class="text-left p-4 font-semibold text-gray-700">
                            Quantity
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($purchaseOrder->items as $item)

                        <tr class="border-t hover:bg-gray-50 transition">

                            <td class="p-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-8 h-8 bg-blue-100 text-blue-700 flex items-center justify-center rounded-full text-sm font-bold">

                                        {{ strtoupper(substr($item->product->name, 0, 1)) }}

                                    </div>

                                    <span class="font-medium text-gray-800">

                                        {{ $item->product->name }}

                                    </span>

                                </div>

                            </td>

                            <td class="p-4">

                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-800">

                                    {{ $item->quantity }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="2"
                                class="p-6 text-center text-gray-500">

                                No products found in this purchase order.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
        {{-- ✅ UPDATED TABLE END --}}

    </div>

</x-app-layout>