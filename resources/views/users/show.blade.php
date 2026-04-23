<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-4">

        {{-- Profile card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-8 mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                <div class="flex items-center gap-5">
                    <div class="w-24 h-24 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-4xl font-bold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            {{ $user->name }} {{ $user->prenom }}
                        </h1>

                        <p class="text-gray-500 mt-2">
                            {{ $user->role ?? 'Utilisateur' }}
                            @if($user->filiere)
                                • {{ $user->filiere }}
                            @endif
                        </p>

                        @if($user->bio)
                            <p class="text-gray-700 mt-3 max-w-2xl">{{ $user->bio }}</p>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 text-center min-w-[280px]">
                    <div class="bg-gray-50 rounded-2xl p-4">
                        <div class="text-2xl font-bold text-gray-900">{{ $user->posts->count() }}</div>
                        <div class="text-sm text-gray-500">Posts</div>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-4">
                        <div class="text-2xl font-bold text-gray-900">{{ $user->followers->count() }}</div>
                        <div class="text-sm text-gray-500">Followers</div>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-4">
                        <div class="text-2xl font-bold text-gray-900">{{ $user->following->count() }}</div>
                        <div class="text-sm text-gray-500">Following</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Posts section --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Publications</h2>
            <p class="text-gray-500 mt-1">Tous les posts publiés par cet utilisateur.</p>
        </div>

        @forelse($user->posts as $post)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 mb-5">
                <p class="text-gray-800 leading-relaxed">{{ $post->contenu }}</p>

                <div class="mt-4 text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-sm border border-yellow-200 p-8 text-center">
                <div class="text-4xl mb-3">📝</div>
                <h3 class="text-lg font-semibold text-gray-800">Aucune publication</h3>
                <p class="text-gray-500 mt-2">Cet utilisateur n’a pas encore publié de post.</p>
            </div>
        @endforelse

    </div>
</x-app-layout>