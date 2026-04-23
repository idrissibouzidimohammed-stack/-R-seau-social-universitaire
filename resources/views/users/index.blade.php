<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-4">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Recherche d’utilisateurs</h1>
            <p class="text-gray-500 mt-2">Retrouve rapidement un étudiant ou un enseignant.</p>
        </div>

        {{-- Search bar --}}
        <div class="mb-8">
            <form action="{{ route('users.search') }}" method="GET">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-3 flex items-center gap-3">
                    <div class="text-gray-400 text-xl px-2">🔍</div>

                    <input
                        type="text"
                        name="q"
                        value="{{ $query }}"
                        placeholder="Tapez un nom ou prénom..."
                        class="w-full border-0 focus:ring-0 text-gray-700 placeholder-gray-400"
                    >

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 transition text-white px-5 py-2.5 rounded-xl font-medium"
                    >
                        Rechercher
                    </button>
                </div>
            </form>
        </div>

        {{-- Query info --}}
        @if($query)
            <div class="mb-6">
                <p class="text-gray-600">
                    Résultats pour :
                    <span class="font-semibold text-blue-600">{{ $query }}</span>
                </p>
            </div>
        @endif

        {{-- Results grid --}}
        @forelse($users as $user)
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 mb-5 hover:shadow-md transition">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div class="flex items-center gap-4">
                        {{-- Avatar --}}
                        <div class="w-16 h-16 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-2xl font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        {{-- Infos --}}
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">
                                {{ $user->name }} {{ $user->prenom }}
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $user->role ?? 'Utilisateur' }}
                                @if($user->filiere)
                                    • {{ $user->filiere }}
                                @endif
                            </p>

                            <div class="flex flex-wrap gap-4 mt-3 text-sm text-gray-600">
                                <span>👥 {{ $user->followers->count() }} followers</span>
                                <span>📌 {{ $user->posts->count() }} posts</span>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-3">
                        <a
                            href="{{ route('users.show', $user) }}"
                            class="bg-blue-600 hover:bg-blue-700 transition text-white px-5 py-2.5 rounded-xl font-medium"
                        >
                            Voir le profil
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white border border-yellow-200 rounded-2xl p-8 text-center shadow-sm">
                <div class="text-4xl mb-3">😕</div>
                <h2 class="text-xl font-semibold text-gray-800">Aucun utilisateur trouvé</h2>
                <p class="text-gray-500 mt-2">Essaie avec un autre nom ou prénom.</p>
            </div>
        @endforelse
    </div>
</x-app-layout>