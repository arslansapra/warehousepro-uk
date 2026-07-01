<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WarehousePro UK</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    @auth
        @include('layouts.sidebar')
    @endauth

    <div class="flex-1 flex flex-col">

        {{-- Top Navigation --}}
        @auth
            @include('layouts.navigation')
        @endauth

        {{-- Page Header --}}
        <header class="bg-white border-b px-8 py-5">

            <h1 class="text-2xl font-bold text-gray-800">
                @yield('title')
            </h1>

        </header>

        {{-- Main Content --}}
        <main class="flex-1 p-8">

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>