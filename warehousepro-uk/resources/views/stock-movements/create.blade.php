<x-app-layout>

    <div class="max-w-3xl mx-auto p-6">

        {{-- Title --}}
        <h1 class="text-3xl font-bold mb-6">

            Create Stock Movement

        </h1>

        {{-- Card --}}
        <div class="bg-white shadow rounded-lg p-6">

            <form
                method="POST"
                action="{{ route('stock-movements.store') }}"
            >

                @csrf

                {{-- Product --}}
                <div class="mb-4">

                    <label class="block mb-2 font-medium">

                        Select Product

                    </label>

                    <select
                        name="product_id"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="">

                            Select Product

                        </option>

                        @foreach($products as $product)

                            <option
                                value="{{ $product->id }}"
                                {{ old('product_id') == $product->id ? 'selected' : '' }}
                            >

                                {{ $product->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('product_id')

                        <p class="text-red-500 text-sm mt-1">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

                {{-- Type --}}
                <div class="mb-4">

                    <label class="block mb-2 font-medium">

                        Select Type

                    </label>

                    <select
                        name="type"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="">

                            Select Type

                        </option>

                        <option
                            value="stock_in"
                            {{ old('type') == 'stock_in' ? 'selected' : '' }}
                        >

                            Stock In

                        </option>

                        <option
                            value="stock_out"
                            {{ old('type') == 'stock_out' ? 'selected' : '' }}
                        >

                            Stock Out

                        </option>

                        <option
                            value="adjustment"
                            {{ old('type') == 'adjustment' ? 'selected' : '' }}
                        >

                            Adjustment

                        </option>

                    </select>

                    @error('type')

                        <p class="text-red-500 text-sm mt-1">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

                {{-- Quantity --}}
                <div class="mb-4">

                    <label class="block mb-2 font-medium">

                        Quantity

                    </label>

                    <input
                        type="number"
                        name="quantity"
                        min="1"
                        value="{{ old('quantity') }}"
                        class="w-full border rounded-lg px-4 py-2"
                        placeholder="Enter quantity"
                    >

                    @error('quantity')

                        <p class="text-red-500 text-sm mt-1">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

                {{-- Reason --}}
                <div class="mb-6">

                    <label class="block mb-2 font-medium">

                        Reason

                    </label>

                    <textarea
                        name="reason"
                        rows="4"
                        class="w-full border rounded-lg px-4 py-2"
                        placeholder="Enter reason"
                    >{{ old('reason') }}</textarea>

                    @error('reason')

                        <p class="text-red-500 text-sm mt-1">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

                {{-- Button --}}
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700"
                >

                    Save Movement

                </button>

            </form>

        </div>

    </div>

</x-app-layout>