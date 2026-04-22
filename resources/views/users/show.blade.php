<x-app-layout>
    <div class="max-w-4xl mx-auto py-6 px-4">
        <div class="bg-white shadow rounded p-6 mb-6">
            <h1 class="text-2xl font-bold">
                {{ $user->name }} {{ $user->prenom }}
            </h1>

            <p class="text-gray-600 mt-2"><strong>Rôle :</strong> {{ $user->role }}</p>
            <p class="text-gray-600"><strong>Filière :</strong> {{ $user->filiere }}</p>
            <p class="text-gray-600"><strong>Bio :</strong> {{ $user->bio }}</p>

            <div class="mt-4 flex gap-6 text-sm text-gray-600">
                <span>{{ $user->followers->count() }} followers</span>
                <span>{{ $user->following->count() }} following</span>
                <span>{{ $user->posts->count() }} posts</span>
            </div>
        </div>

        <h2 class="text-xl font-bold mb-4">Publications</h2>

        @forelse($user->posts as $post)
            <div class="bg-white shadow rounded p-4 mb-4">
                <p>{{ $post->contenu }}</p>
                <p class="text-sm text-gray-500 mt-2">{{ $post->created_at->diffForHumans() }}</p>
            </div>
        @empty
            <div class="bg-yellow-100 text-yellow-700 p-4 rounded">
                Aucun post disponible.
            </div>
        @endforelse
    </div>
</x-app-layout>