<x-app-layout>
    <div class="max-w-4xl mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold mb-6">Résultats de recherche</h1>

        <form action="{{ route('users.search') }}" method="GET" class="mb-6">
            <div class="flex gap-2">
                <input 
                    type="text" 
                    name="q" 
                    value="{{ $query }}"
                    placeholder="Rechercher un utilisateur..."
                    class="w-full border rounded px-4 py-2"
                >
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Rechercher
                </button>
            </div>
        </form>

        @if($query)
            <p class="mb-4 text-gray-600">Recherche : <strong>{{ $query }}</strong></p>
        @endif

        @forelse($users as $user)
            <div class="bg-white shadow rounded p-4 mb-4">
                <h2 class="font-bold text-lg">
                    {{ $user->name }} {{ $user->prenom }}
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    {{ $user->followers->count() }} followers
                </p>

                <a href="{{ route('users.show', $user) }}" class="text-blue-600 mt-2 inline-block">
                    Voir le profil
                </a>
            </div>
        @empty
            <div class="bg-yellow-100 text-yellow-700 p-4 rounded">
                Aucun utilisateur trouvé.
            </div>
        @endforelse
    </div>
</x-app-layout>