<x-app-layout>
    <div class="max-w-3xl mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold mb-6">Détail du post</h1>

        <div class="bg-white shadow rounded p-6">
            <h2 class="font-bold text-lg">{{ $post->user->name }} {{ $post->user->prenom }}</h2>
            <p class="mt-3 text-gray-700">{{ $post->contenu }}</p>
            <p class="text-sm text-gray-500 mt-3">{{ $post->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>
</x-app-layout>