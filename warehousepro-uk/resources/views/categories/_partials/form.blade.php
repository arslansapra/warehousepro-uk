<div class="space-y-6">

    <div>

        <label class="block mb-2 font-medium">

            Name

        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $category->name ?? '') }}"
            class="w-full border rounded-lg px-4 py-2"
        >

        @error('name')

            <p class="text-red-500 text-sm mt-1">

                {{ $message }}

            </p>

        @enderror

    </div>

    <div>

        <label class="block mb-2 font-medium">

            Description

        </label>

        <textarea
            name="description"
            rows="4"
            class="w-full border rounded-lg px-4 py-2"
        >{{ old('description', $category->description ?? '') }}</textarea>

    </div>

    <button
        type="submit"
        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700"
    >

        Save Category

    </button>

</div>