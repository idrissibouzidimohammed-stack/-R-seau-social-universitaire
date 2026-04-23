<x-app-layout>
    <div class="max-w-4xl mx-auto py-6 px-4">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Posts</h1>
            <a href="{{ route('posts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                Nouveau post
            </a>
        </div>

        {{-- POSTS --}}
        @forelse($posts as $post)
            <div class="bg-white shadow rounded p-4 mb-4">
                <div class="mb-8">
    <form action="{{ route('users.search') }}" method="GET">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-3 flex items-center gap-3">
            <div class="text-gray-400 text-xl px-2">
                🔍
            </div>

            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                placeholder="Rechercher un étudiant ou enseignant..."
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

                {{-- USER --}}
                <div class="font-semibold text-gray-900 text-base">
                    {{ $post->user->name }} {{ $post->user->prenom }}
                </div>

                <div class="text-xs text-gray-500 mt-1">
                    {{ $post->user->followers->count() }} followers
                </div>
                

                {{-- FOLLOW BUTTON --}}
                @if(auth()->id() !== $post->user_id)
                    @if(auth()->user()->following->contains($post->user_id))
                        <form action="{{ route('unfollow', $post->user) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 text-sm">
                                Unfollow
                            </button>
                        </form>
                    @else
                        <form action="{{ route('follow', $post->user) }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="text-blue-600 text-sm">
                                Follow
                            </button>
                        </form>
                    @endif
                @endif

                {{-- CONTENT --}}
                <p class="mt-3 text-gray-700">{{ $post->contenu }}</p>

                {{-- ❤️ LIKES --}}
                <div class="mt-3 flex items-center gap-3">
                    <form action="{{ route('posts.like', $post) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-blue-600">❤️ Like</button>
                    </form>

                    <form action="{{ route('posts.unlike', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">💔 Unlike</button>
                    </form>

                    <span>{{ $post->likes->count() }} likes</span>
                </div>

                {{-- DATE --}}
                <p class="text-sm text-gray-500 mt-2">
                    {{ $post->created_at->diffForHumans() }}
                </p>

                {{-- ACTIONS --}}
                <div class="mt-4 flex gap-3">
                    <a href="{{ route('posts.show', $post) }}" class="text-green-600">Voir</a>

                    @if(auth()->id() === $post->user_id)
                        <a href="{{ route('posts.edit', $post) }}" class="text-blue-600">Modifier</a>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Supprimer</button>
                        </form>
                    @endif
                </div>

                {{-- 💬 COMMENTAIRES --}}
                <div class="mt-4">
                    <h3 class="font-semibold mb-2">Commentaires</h3>

                    @foreach($post->comments as $comment)
                        <div class="border-t pt-2 mt-2 flex justify-between">
                            <div>
                                <strong>{{ $comment->user->name }}</strong> :
                                {{ $comment->contenu }}
                            </div>

                            @if(auth()->id() === $comment->user_id)
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 text-sm">Supprimer</button>
                                </form>
                            @endif
                        </div>
                    @endforeach

                    {{-- AJOUT COMMENTAIRE --}}
                    <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-3">
                        @csrf
                        <textarea name="contenu" rows="2" class="w-full border rounded p-2" placeholder="Ajouter un commentaire..."></textarea>
                        <button class="bg-green-600 text-white px-3 py-1 rounded mt-2">
                            Commenter
                        </button>
                    </form>
                </div>

            </div>

        @empty
            <div class="bg-yellow-100 text-yellow-700 p-4 rounded">
                Aucun post disponible.
            </div>
        @endforelse

    </div>
</x-app-layout>