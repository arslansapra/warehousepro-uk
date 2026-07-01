
<nav class="bg-white border-b shadow-sm">

    <div class="px-8 h-16 flex items-center justify-between">

        {{-- Left --}}
        <div>

            <h2 class="text-lg font-semibold text-gray-700">
                WarehousePro UK
            </h2>

        </div>

        {{-- Right --}}
        <div class="flex items-center gap-6">

            {{-- Notifications --}}
            <div class="relative group">

                <button class="relative">

                    <x-heroicon-o-bell class="w-6 h-6" />

                    @if(auth()->user()->unreadNotifications->count())

                        <span
                            class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">

                            {{ auth()->user()->unreadNotifications->count() }}

                        </span>

                    @endif

                </button>

                <div
                    class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border hidden group-hover:block z-50">

                    <div class="px-4 py-3 border-b font-semibold">

                        Notifications

                    </div>

                    @forelse(auth()->user()->notifications->take(5) as $notification)

                        <form
                            method="POST"
                            action="{{ route('notifications.read', $notification->id) }}">

                            @csrf

                            <button
                                class="w-full text-left px-4 py-3 hover:bg-gray-50 border-b">

                                <div class="{{ $notification->read_at ? 'text-gray-500' : 'font-semibold' }}">

                                    {{ $notification->data['message'] }}

                                </div>

                                <div class="text-xs text-gray-500 mt-1">

                                    {{ $notification->created_at->diffForHumans() }}

                                </div>

                            </button>

                        </form>

                    @empty

                        <div class="p-4 text-gray-500">

                            No notifications.

                        </div>

                    @endforelse

                    <div class="p-3 text-center">

                        <a
                            href="{{ route('notifications.index') }}"
                            class="text-blue-600 hover:underline">

                            View All Notifications

                        </a>

                    </div>

                </div>

            </div>

            {{-- User Dropdown --}}
            <div class="relative group">

                <button
                    class="flex items-center gap-3">

                    <div class="text-right">

                        <div class="font-semibold">

                            {{ auth()->user()->name }}

                        </div>

                        <div class="text-xs text-gray-500">

                            {{ auth()->user()->role->name }}

                        </div>

                    </div>

                    <x-heroicon-o-chevron-down class="w-4 h-4" />

                </button>

                <div
                    class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border hidden group-hover:block z-50">

                    <a
                        href="{{ route('profile.edit') }}"
                        class="block px-4 py-3 hover:bg-gray-100">

                        Profile Settings

                    </a>

                    <form
                        method="POST"
                        action="{{ route('logout') }}">

                        @csrf

                        <button
                            class="w-full text-left px-4 py-3 hover:bg-gray-100">

                            Logout

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</nav>

