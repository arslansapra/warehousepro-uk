<div class="space-y-6">

    {{-- Name --}}
    <div>
        <label class="block mb-2 font-medium">Name</label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $product->name ?? '') }}"
            class="w-full border rounded-lg px-4 py-2"
            placeholder="Product name"
        >

        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Description --}}
    <div>
        <label class="block mb-2 font-medium">Description</label>

        <textarea
            name="description"
            rows="4"
            class="w-full border rounded-lg px-4 py-2"
            placeholder="Product description"
        >{{ old('description', $product->description ?? '') }}</textarea>

        @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Price / Weight / Quantity --}}
    <div class="grid grid-cols-3 gap-4">

        <div>
            <label class="block mb-2 font-medium">Price</label>

            <input
                type="number"
                step="0.01"
                name="price"
                value="{{ old('price', $product->price ?? '') }}"
                class="w-full border rounded-lg px-4 py-2"
            >

            @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-2 font-medium">Weight</label>

            <input
                type="number"
                step="0.01"
                name="weight"
                value="{{ old('weight', $product->weight ?? '') }}"
                class="w-full border rounded-lg px-4 py-2"
            >

            @error('weight')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-2 font-medium">Quantity</label>

            <input
                type="number"
                name="quantity"
                value="{{ old('quantity', $product->quantity ?? '') }}"
                class="w-full border rounded-lg px-4 py-2"
            >

            @error('quantity')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

    </div>

    {{-- Category --}}
    <div>
        <label class="block mb-2 font-medium">Category</label>

        <select
            name="category_id"
            class="w-full border rounded-lg px-4 py-2"
        >

            <option value="">Select Category</option>

            @foreach($categories as $category)

                <option value="{{ $category->id }}"
                    {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>

            @endforeach

        </select>

        @error('category_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Location --}}
    <div>
        <label class="block mb-2 font-medium">Location</label>

        <select
            name="warehouse_location_id"
            class="w-full border rounded-lg px-4 py-2"
        >

            <option value="">Select Location</option>

            @foreach($locations as $location)

                <option value="{{ $location->id }}"
                    {{ old('warehouse_location_id', $product->warehouse_location_id ?? '') == $location->id ? 'selected' : '' }}>
                    {{ $location->code }}
                </option>

            @endforeach

        </select>

        @error('warehouse_location_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Image --}}
    <div>
        <label class="block mb-2 font-medium">Image</label>

        <input
            type="file"
            name="image"
            class="w-full border rounded-lg px-4 py-2"
        >

        @error('image')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        @if(isset($product) && $product->image)
            <img src="{{ asset('storage/' . $product->image) }}"
                 class="w-24 mt-3 rounded">
        @endif

    </div>

    {{-- Button --}}
    <button
        type="submit"
        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700"
    >
        Save Product
    </button>

</div>