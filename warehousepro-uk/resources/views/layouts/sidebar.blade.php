
<aside class="w-64 bg-slate-900 text-white flex flex-col shadow-xl">

    {{-- Logo --}}
    <div class="px-6 py-6 border-b border-slate-700">

        <h1 class="text-2xl font-bold tracking-wide">
            WarehousePro
        </h1>

        <p class="text-sm text-slate-400 mt-1">
            Warehouse Management
        </p>

    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-6 space-y-2">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition
           {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow' : 'hover:bg-slate-800 text-slate-300' }}">

                <x-heroicon-o-home class="w-5 h-5" />
                <span>Dashboard</span>

        </a>

        {{-- Products --}}
        @if(in_array(auth()->user()->role->slug, ['admin','warehouse_manager','staff']))
            <a href="{{ route('products.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition
               {{ request()->routeIs('products.*') ? 'bg-blue-600 text-white shadow' : 'hover:bg-slate-800 text-slate-300' }}">

                <x-heroicon-o-cube class="w-5 h-5" />
                <span>Products</span>

            </a>
        @endif

        {{-- Manager/Admin --}}
        @if(in_array(auth()->user()->role->slug, ['admin','warehouse_manager']))

            <a href="{{ route('categories.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition
               {{ request()->routeIs('categories.*') ? 'bg-blue-600 text-white shadow' : 'hover:bg-slate-800 text-slate-300' }}">

                <x-heroicon-o-squares-2x2 class="w-5 h-5" />
                <span>Categories</span>

            </a>

            <a href="{{ route('warehouse-locations.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition
               {{ request()->routeIs('warehouse-locations.*') ? 'bg-blue-600 text-white shadow' : 'hover:bg-slate-800 text-slate-300' }}">

                <x-heroicon-o-map-pin class="w-5 h-5" />
                <span>Warehouse Locations</span>

            </a>

            <a href="{{ route('suppliers.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition
               {{ request()->routeIs('suppliers.*') ? 'bg-blue-600 text-white shadow' : 'hover:bg-slate-800 text-slate-300' }}">

                <x-heroicon-o-truck class="w-5 h-5" />
                <span>Suppliers</span>

            </a>

            <a href="{{ route('purchase-orders.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition
               {{ request()->routeIs('purchase-orders.*') ? 'bg-blue-600 text-white shadow' : 'hover:bg-slate-800 text-slate-300' }}">

                <x-heroicon-o-document-text class="w-5 h-5" />
                <span>Purchase Orders</span>

            </a>

            <a href="{{ route('stock-movements.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition
               {{ request()->routeIs('stock-movements.*') ? 'bg-blue-600 text-white shadow' : 'hover:bg-slate-800 text-slate-300' }}">

                <x-heroicon-o-arrow-path class="w-5 h-5" />
                <span>Stock Movements</span>

            </a>

        @endif

        {{-- Admin --}}
        @if(auth()->user()->role->slug === 'admin')

            <a href="/users"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition hover:bg-slate-800 text-slate-300">

                <x-heroicon-o-users class="w-5 h-5" />
                <span>User Management</span>

            </a>

        @endif

    </nav>

    {{-- Footer --}}
    <div class="border-t border-slate-700 px-6 py-4 text-xs text-slate-400">

        Logged in as:
        <br>

        <span class="text-white font-medium">
            {{ auth()->user()->role->name }}
        </span>

    </div>

</aside>
