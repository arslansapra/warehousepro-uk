<x-app-layout>

    <div class="max-w-7xl mx-auto p-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">

            <h1 class="text-3xl font-bold">
                Suppliers
            </h1>

            <a href="{{ route('suppliers.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">

                + Add Supplier

            </a>

        </div>

        {{-- Success --}}
        @if(session('success'))

            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">

                {{ session('success') }}

            </div>

        @endif

        {{-- Table --}}
        <div class="bg-white shadow rounded-lg overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-4 text-left">Company</th>

                        <th class="p-4 text-left">Contact Person</th>

                        <th class="p-4 text-left">Email</th>

                        <th class="p-4 text-left">Phone</th>

                        <th class="p-4 text-left">Status</th>

                        <th class="p-4 text-left">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($suppliers as $supplier)

                        <tr class="border-t hover:bg-gray-50">

                            <td class="p-4 font-medium">
                                {{ $supplier->company_name }}
                            </td>

                            <td class="p-4">
                                {{ $supplier->contact_person }}
                            </td>

                            <td class="p-4 text-gray-600">
                                {{ $supplier->email }}
                            </td>

                            <td class="p-4">
                                {{ $supplier->phone }}
                            </td>

                            <td class="p-4">

                                @if($supplier->is_active)

                                    <span class="inline-flex items-center px-2 py-1 text-sm rounded bg-green-100 text-green-700">

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex items-center px-2 py-1 text-sm rounded bg-red-100 text-red-700">

                                        Inactive

                                    </span>

                                @endif

                            </td>

                            <td class="p-4 flex gap-4">

                                <a href="{{ route('suppliers.edit', $supplier) }}"
                                   class="text-blue-600 hover:underline">

                                    Edit

                                </a>

                                <form method="POST"
                                      action="{{ route('suppliers.destroy', $supplier) }}">

                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-600 hover:underline"
                                            onclick="return confirm('Delete supplier?')">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="p-6 text-center text-gray-500">

                                No suppliers found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>