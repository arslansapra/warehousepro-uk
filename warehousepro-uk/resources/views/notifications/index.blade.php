<x-app-layout>

    <div class="max-w-5xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6">
            Notifications
        </h1>

        <div class="bg-white rounded-lg shadow overflow-hidden">

            @forelse($notifications as $notification)

                <div class="border-b p-5">

                    <div class="flex justify-between items-start">

                        <div>

                            <p class="{{ $notification->read_at ? 'text-gray-500' : 'font-semibold' }}">

                                {{ $notification->data['message'] }}

                            </p>

                            <p class="text-sm text-gray-500 mt-2">

                                {{ $notification->created_at->format('d M Y H:i') }}

                            </p>

                        </div>

                        @if(!$notification->read_at)

                            <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                                @csrf

                                <button class="text-blue-600 hover:underline text-sm">
                                    Mark as Read
                                </button>

                            </form>

                        @endif

                    </div>

                </div>

            @empty

                <div class="p-6 text-center text-gray-500">
                    No notifications found.
                </div>

            @endforelse

        </div>

        <div class="mt-6">
            {{ $notifications->links() }}
        </div>

    </div>

</x-app-layout>