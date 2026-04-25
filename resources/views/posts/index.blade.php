<x-app-layout>
    <div class="min-h-screen bg-[#fffaf0] py-10">
        <div class="max-w-6xl mx-auto px-6">

            <h1 class="text-4xl font-black text-gray-900 mb-8">UseIt</h1>

            {{-- SEARCH --}}
            <form action="{{ route('users.search') }}" method="GET" class="mb-8">
                <div class="bg-white border border-orange-200 rounded-2xl shadow-sm p-4 flex items-center gap-3">
                    <span class="bg-yellow-100 text-orange-500 w-10 h-10 rounded-full flex items-center justify-center text-xl">
                        🔍
                    </span>

                    <input
                        type="text"
                        name="q"
                        placeholder="Rechercher un utilisateur..."
                        class="flex-1 border-0 focus:ring-0 text-xl bg-transparent"
                    >
                </div>
            </form>

            {{-- POSTS --}}
            @forelse($posts as $post)
                <div class="bg-[#fffdf5] border border-orange-100 rounded-3xl shadow-md p-8 mb-8">

                    <div class="flex justify-between items-start mb-6">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-full bg-yellow-100 text-orange-500 flex items-center justify-center text-3xl">
                                ♙
                            </div>

                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">
                                    {{ $post->user->name }}
                                </h2>
                                <p class="text-gray-500">
                                    {{ $post->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>

                        <span class="text-gray-500 text-2xl">•••</span>
                    </div>

                    <p class="text-2xl text-gray-800 leading-relaxed mb-8">
                        {{ $post->contenu }}
                    </p>

                    <div class="flex items-center gap-6 text-2xl mb-6">
                        <form action="{{ route('posts.like', $post) }}" method="POST">
                            @csrf
                            <button class="hover:scale-110">🧡 Like</button>
                        </form>

                        <form action="{{ route('posts.unlike', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="hover:scale-110">💔 Unlike</button>
                        </form>

                        <span class="text-gray-500">
                            {{ $post->likes->count() }} likes
                        </span>
                    </div>

                    <div class="border-t border-orange-100 pt-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Commentaires</h3>

                        @foreach($post->comments as $comment)
                            <div class="bg-yellow-50 rounded-2xl px-5 py-3 mb-3">
                                <strong class="text-orange-600">{{ $comment->user->name }}</strong>
                                <span class="text-gray-700">{{ $comment->contenu }}</span>
                            </div>
                        @endforeach

                        <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-5 flex gap-3">
                            @csrf
                            <input
                                name="contenu"
                                placeholder="Ajouter un commentaire..."
                                class="flex-1 rounded-full border-orange-200 focus:ring-orange-300 px-6 py-4 text-lg"
                            >

                            <button class="bg-orange-400 hover:bg-orange-500 text-white px-6 py-3 rounded-full font-bold">
                                Publier
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white border border-orange-100 rounded-3xl p-10 text-center shadow">
                    Aucun post disponible.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>