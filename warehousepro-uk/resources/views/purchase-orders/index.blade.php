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

        {{-- Table --}}
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

                    @forelse($purchaseOrders as $po)

                        <tr class="border-t hover:bg-gray-50 transition">

                            {{-- PO Number --}}
                            <td class="p-4 font-medium text-gray-800">
                                {{ $po->po_number }}
                            </td>

                            {{-- Supplier --}}
                            <td class="p-4 text-gray-700">
                                {{ $po->supplier->company_name }}
                            </td>

                            {{-- Status --}}
                            <td class="p-4">

                                @if($po->status === 'pending')

                                    <span class="inline-flex px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-700">
                                        Pending
                                    </span>

                                @elseif($po->status === 'approved')

                                    <span class="inline-flex px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-700">
                                        Approved
                                    </span>

                                @elseif($po->status === 'received')

                                    <span class="inline-flex px-3 py-1 rounded-full text-sm bg-green-100 text-green-700">
                                        Received
                                    </span>

                                @else

                                    <span class="inline-flex px-3 py-1 rounded-full text-sm bg-red-100 text-red-700">
                                        Cancelled
                                    </span>

                                @endif

                            </td>

                            {{-- Created By --}}
                            <td class="p-4 text-gray-700">
                                {{ $po->orderedBy->name }}
                            </td>

                            {{-- Actions --}}
                            <td class="p-4">

                                <div class="flex flex-wrap gap-3 items-center">

                                    {{-- View --}}
                                    <a href="{{ route('purchase-orders.show', $po) }}"
                                       class="text-blue-600 hover:underline font-medium">

                                        View

                                    </a>

                                    {{-- Approve --}}
                                    @if($po->status === 'pending')

                                        <form method="POST"
                                              action="{{ route('purchase-orders.approve', $po) }}">

                                            @csrf
                                            @can('approve', $po)
                                            <button type="submit"
                                                    class="text-green-600 hover:underline font-medium">

                                                Approve

                                            </button>
                                            @endcan

                                        </form>

                                    @endif

                                    {{-- Receive --}}
                                    @if($po->status === 'approved')

                                        <form method="POST"
                                              action="{{ route('purchase-orders.receive', $po) }}">

                                            @csrf
                                            @can('receive', $po)
                                            <button type="submit"
                                                    class="text-blue-600 hover:underline font-medium">

                                                Receive

                                            </button>
                                            @endcan    

                                        </form>

                                    @endif

                                    {{-- Cancel --}}
                                    @if($po->status !== 'received')

                                        <form method="POST"
                                              action="{{ route('purchase-orders.cancel', $po) }}">

                                            @csrf
                                            @can('cancel', $po)
                                            <button type="submit"
                                                    class="text-red-600 hover:underline font-medium">

                                                Cancel

                                            </button>
                                            @endcan
                                            
                                        </form>

                                    @endif

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