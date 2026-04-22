<x-app-layout>
    <div class="max-w-4xl mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold mb-6">Messages</h1>

        @forelse($messages as $message)
            <div class="bg-white shadow rounded p-4 mb-4">

                <p><strong>De :</strong> {{ $message->sender->name }}</p>
                <p><strong>À :</strong> {{ $message->receiver->name }}</p>

                <p class="mt-2">{{ $message->contenu }}</p>

                <p class="text-sm text-gray-500 mt-2">
                    {{ $message->created_at->diffForHumans() }}
                </p>

            </div>
        @empty
            <p>Aucun message</p>
        @endforelse
    </div>
</x-app-layout>