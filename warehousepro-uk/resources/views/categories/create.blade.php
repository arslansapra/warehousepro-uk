<x-app-layout>

    <div class="max-w-3xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6">

            Create Category

        </h1>

        <div class="bg-white shadow rounded-lg p-6">

            <form
                action="{{ route('categories.store') }}"
                method="POST"
            >

                @csrf

                @include('categories._partials.form')

            </form>

        </div>

    </div>

</x-app-layout>