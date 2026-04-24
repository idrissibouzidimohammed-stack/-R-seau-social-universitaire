<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-10 border-b border-green-900/30 pb-8">
            <h1 class="text-4xl font-extrabold text-green-500 tracking-tight flex items-center">
                <span class="mr-4">🔍</span> Recherche d’utilisateurs
            </h1>
            <p class="text-gray-500 mt-2 text-lg">Retrouve rapidement un étudiant ou un enseignant.</p>
        </div>

        {{-- Search bar --}}
        <div class="mb-12">
            <form action="{{ route('users.search') }}" method="GET">
                <div class="bg-gray-900/80 rounded-2xl shadow-[0_0_20px_rgba(34,197,94,0.1)] border border-green-900/30 p-2 flex items-center gap-3 focus-within:border-green-500/50 transition-all">
                    <div class="text-green-500 text-2xl px-3 opacity-70">🔍</div>

                    <input
                        type="text"
                        name="q"
                        value="{{ $query }}"
                        placeholder="Tapez un nom ou prénom..."
                        class="w-full bg-transparent border-0 focus:ring-0 text-gray-100 placeholder-gray-600 text-lg py-4"
                    >

                    <button
                        type="submit"
                        class="bg-green-500 hover:bg-green-400 text-black px-8 py-4 rounded-xl font-bold transition-all shadow-lg shadow-green-500/20 active:scale-95"
                    >
                        Rechercher
                    </button>
                </div>
            </form>
        </div>

        {{-- Query info --}}
        @if($query)
            <div class="mb-10 bg-green-500/5 border border-green-500/20 rounded-xl p-4 inline-block">
                <p class="text-gray-400">
                    Résultats pour :
                    <span class="font-bold text-green-500 ml-1">"{{ $query }}"</span>
                </p>
            </div>
        @endif

        {{-- Results grid --}}
        <div class="grid gap-6">
            @forelse($users as $user)
                <div class="group bg-gray-900/40 border border-green-900/20 rounded-3xl p-6 hover:bg-gray-900/60 hover:border-green-500/30 transition-all duration-300 shadow-sm hover:shadow-[0_10px_30px_-10px_rgba(0,0,0,0.5)]">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                        <div class="flex items-center gap-6">
                            {{-- Avatar --}}
                            <div class="w-20 h-20 rounded-full border-2 border-green-500/20 bg-gray-950 text-green-500 flex items-center justify-center text-3xl font-black shadow-inner shadow-green-500/5 group-hover:border-green-500/50 transition-colors">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>

                            {{-- Infos --}}
                            <div>
                                <h2 class="text-2xl font-bold text-gray-100 group-hover:text-green-400 transition-colors">
                                    {{ $user->name }} {{ $user->prenom }}
                                </h2>

                                <p class="text-green-800 font-mono text-sm uppercase tracking-widest mt-1">
                                    {{ $user->role ?? 'Utilisateur' }}
                                    @if($user->filiere)
                                        <span class="mx-2 text-green-900">•</span> {{ $user->filiere }}
                                    @endif
                                </p>

                                <div class="flex flex-wrap gap-6 mt-4 text-sm text-gray-500 font-medium">
                                    <span class="flex items-center gap-1.5"><span class="text-green-600">👥</span> {{ $user->followers->count() }} followers</span>
                                    <span class="flex items-center gap-1.5"><span class="text-green-600">📌</span> {{ $user->posts->count() }} posts</span>
                                </div>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center gap-4">
                            <a
                                href="{{ route('users.show', $user) }}"
                                class="w-full md:w-auto text-center bg-gray-950 border border-green-900/50 hover:border-green-500 text-green-500 hover:text-white hover:bg-green-600 px-8 py-3.5 rounded-2xl font-bold transition-all"
                            >
                                Voir le profil
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-gray-900/20 rounded-3xl border-2 border-dashed border-green-900/20">
                    <div class="text-6xl mb-6 opacity-20 filter grayscale">😕</div>
                    <h2 class="text-2xl font-bold text-gray-400">Aucun utilisateur trouvé</h2>
                    <p class="text-gray-600 mt-2">Essaie avec un autre nom ou prénom.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>