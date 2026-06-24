<x-app-layout>

    <div class="max-w-3xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6">

            Edit Supplier

        </h1>

        <div class="bg-white shadow rounded-lg p-6">

            <form method="POST"
                  action="{{ route('suppliers.update', $supplier) }}">

                @csrf
                @method('PUT')

                @include('suppliers.partials.form')

            </form>

        </div>

    </div>

</x-app-layout>