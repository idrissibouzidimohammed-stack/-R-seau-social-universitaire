<x-app-layout>
    <div class="max-w-4xl mx-auto py-6 px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Liste des posts</h1>
            <a href="{{ route('posts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                Nouveau post
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @forelse($posts as $post)
            <div class="bg-white shadow rounded p-4 mb-4">
                <h2 class="font-bold text-lg">{{ $post->user->name }} {{ $post->user->prenom }}</h2>
                <p class="text-gray-700 mt-2">{{ $post->contenu }}</p>
                <p class="text-sm text-gray-500 mt-2">{{ $post->created_at->diffForHumans() }}</p>

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
            </div>
        @empty
            <div class="bg-yellow-100 text-yellow-700 p-4 rounded">
                Aucun post disponible.
            </div>
        @endforelse
    </div>
</x-app-layout>
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

    <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-3">
        @csrf
        <textarea name="contenu" rows="2" class="w-full border rounded p-2" placeholder="Ajouter un commentaire..."></textarea>
        <button class="bg-green-600 text-white px-3 py-1 rounded mt-2">Commenter</button>
    </form>
</div>