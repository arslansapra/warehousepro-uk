<div class="space-y-5">

    {{-- Company Name --}}
    <div>

        <label for="company_name" class="block mb-2 font-medium">
            Company
        </label>

        <input
            id="company_name"
            type="text"
            name="company_name"
            value="{{ old('company_name', $supplier->company_name ?? '') }}"
            class="w-full border rounded-lg px-4 py-2"
            placeholder="Company name"
        >

        @error('company_name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

    </div>

    {{-- Contact Person --}}
    <div>

        <label for="contact_person" class="block mb-2 font-medium">
            Contact Person
        </label>

        <input
            id="contact_person"
            type="text"
            name="contact_person"
            value="{{ old('contact_person', $supplier->contact_person ?? '') }}"
            class="w-full border rounded-lg px-4 py-2"
            placeholder="Contact person"
        >

        @error('contact_person')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

    </div>

    {{-- Email --}}
    <div>

        <label for="email" class="block mb-2 font-medium">
            Email
        </label>

        <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email', $supplier->email ?? '') }}"
            class="w-full border rounded-lg px-4 py-2"
            placeholder="Email address"
        >

        @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

    </div>

    {{-- Phone --}}
    <div>

        <label for="phone" class="block mb-2 font-medium">
            Phone
        </label>

        <input
            id="phone"
            type="text"
            name="phone"
            value="{{ old('phone', $supplier->phone ?? '') }}"
            class="w-full border rounded-lg px-4 py-2"
            placeholder="Phone number"
        >

        @error('phone')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

    </div>

    {{-- Address --}}
    <div>

        <label for="address" class="block mb-2 font-medium">
            Address
        </label>

        <textarea
            id="address"
            name="address"
            rows="3"
            class="w-full border rounded-lg px-4 py-2"
            placeholder="Supplier address"
        >{{ old('address', $supplier->address ?? '') }}</textarea>

        @error('address')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

    </div>

    {{-- Status --}}
    <div>

        <label for="is_active" class="block mb-2 font-medium">
            Status
        </label>

        <select
            id="is_active"
            name="is_active"
            class="w-full border rounded-lg px-4 py-2"
        >

            <option value="1"
                {{ old('is_active', $supplier->is_active ?? '') == 1 ? 'selected' : '' }}>
                Active
            </option>

            <option value="0"
                {{ old('is_active', $supplier->is_active ?? '') == 0 ? 'selected' : '' }}>
                Inactive
            </option>

        </select>

        @error('is_active')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

    </div>

    {{-- Submit --}}
    <div class="pt-2">

        <button
            type="submit"
            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700"
        >
            Save Supplier
        </button>

    </div>

</div>