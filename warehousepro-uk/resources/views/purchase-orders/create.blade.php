<x-app-layout>

    <div class="max-w-5xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6">

            Create Purchase Order

        </h1>

        <div class="bg-white shadow rounded-lg p-6">

            <form method="POST"
                  action="{{ route('purchase-orders.store') }}">

                @csrf

                {{-- Supplier --}}
                <div class="mb-6">

                    <label
                        for="supplier_id"
                        class="block mb-2 font-medium">

                        Supplier

                    </label>

                    <select
                        id="supplier_id"
                        name="supplier_id"
                        class="w-full border rounded-lg px-4 py-2">

                        <option value="">
                            Select Supplier
                        </option>

                        @foreach($suppliers as $supplier)

                            <option value="{{ $supplier->id }}">

                                {{ $supplier->company_name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Products --}}
                <div class="mb-6">

                    <h2 class="text-lg font-semibold mb-4">

                        Products

                    </h2>

                    <div id="products-container">

                        <div class="grid grid-cols-2 gap-4 mb-4 product-row">

                            <div>

                                <select
                                    name="items[0][product_id]"
                                    class="w-full border rounded-lg px-4 py-2">

                                    <option value="">
                                        Select Product
                                    </option>

                                    @foreach($products as $product)

                                        <option value="{{ $product->id }}">

                                            {{ $product->name }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <div>

                                <input
                                    type="number"
                                    min="1"
                                    name="items[0][quantity]"
                                    placeholder="Quantity"
                                    class="w-full border rounded-lg px-4 py-2">

                            </div>

                        </div>

                    </div>

                    <button
                        type="button"
                        id="add-product"
                        class="bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300">

                        + Add Product

                    </button>

                </div>

                {{-- Notes --}}
                <div class="mb-6">

                    <label
                        for="notes"
                        class="block mb-2 font-medium">

                        Notes

                    </label>

                    <textarea
                        id="notes"
                        name="notes"
                        rows="4"
                        class="w-full border rounded-lg px-4 py-2"
                        placeholder="Additional notes..."></textarea>

                </div>

                <button
                    type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">

                    Create Purchase Order

                </button>

            </form>

        </div>

    </div>

    <script>

        let index = 1;

        document
            .getElementById('add-product')
            .addEventListener('click', function () {

                const container =
                    document.getElementById('products-container');

                const row = document.createElement('div');

                row.classList.add(
                    'grid',
                    'grid-cols-2',
                    'gap-4',
                    'mb-4'
                );

                row.innerHTML = `
                    <div>
                        <select
                            name="items[${index}][product_id]"
                            class="w-full border rounded-lg px-4 py-2">

                            <option value="">
                                Select Product
                            </option>

                            @foreach($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div>
                        <input
                            type="number"
                            min="1"
                            name="items[${index}][quantity]"
                            placeholder="Quantity"
                            class="w-full border rounded-lg px-4 py-2">
                    </div>
                `;

                container.appendChild(row);

                index++;

            });

    </script>

</x-app-layout>