<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Notifications</h1>
            <p class="text-gray-500 mt-2">Retrouve ici toutes les activités liées à ton compte.</p>
        </div>

        @forelse($notifications as $notification)
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5 mb-4">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-gray-800 font-medium">
                            {{ $notification->message }}
                        </p>

                        <p class="text-sm text-gray-500 mt-2">
                            {{ $notification->created_at->diffForHumans() }}
                        </p>

                        <p class="mt-2 text-sm">
                            @if($notification->lu)
                                <span class="text-green-600 font-medium">Lue</span>
                            @else
                                <span class="text-orange-500 font-medium">Non lue</span>
                            @endif
                        </p>
                    </div>

                    @if(!$notification->lu)
                        <form action="{{ route('notifications.read', $notification) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-sm">
                                Marquer comme lue
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white border border-yellow-200 rounded-2xl p-8 text-center shadow-sm">
                <div class="text-4xl mb-3">🔔</div>
                <h2 class="text-xl font-semibold text-gray-800">Aucune notification</h2>
                <p class="text-gray-500 mt-2">Tes nouvelles activités apparaîtront ici.</p>
            </div>
        @endforelse
    </div>
</x-app-layout>