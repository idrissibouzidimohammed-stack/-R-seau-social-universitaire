<x-app-layout>
    <div class="min-h-screen bg-[#fff8df] py-10">
        <div class="max-w-4xl mx-auto px-6">

            {{-- TITLE --}}
            <h1 class="text-3xl font-bold text-gray-800 mb-6">UseIt</h1>

            {{-- SEARCH --}}
            <form action="{{ route('users.search') }}" method="GET" class="mb-8">
                <div class="bg-white border border-orange-200 rounded-xl shadow p-3 flex gap-3">
                    <input type="text"
                           name="q"
                           placeholder="🔍 Rechercher un utilisateur..."
                           class="flex-1 border-0 focus:ring-0 bg-transparent">
                </div>
            </form>

            {{-- POSTS --}}
            @forelse($posts as $post)
                <div class="bg-white border border-orange-100 rounded-2xl shadow p-6 mb-6 relative">

                    {{-- HEADER --}}
                    <div class="flex justify-between items-center mb-3">
                        <div>
                            <h2 class="font-bold text-gray-800">
                                {{ $post->user->name }}
                            </h2>
                            <p class="text-sm text-gray-500">
                                {{ $post->created_at->diffForHumans() }}
                            </p>
                        </div>

                        {{-- MENU ⋯ --}}
                        <div class="relative">
                            <button onclick="toggleMenu(event, {{ $post->id }})"
                                    style="font-size: 22px; cursor: pointer;">
                                ⋯
                            </button>

                            <div id="menu-{{ $post->id }}"
                                 style="display:none; position:absolute; right:0; top:30px; background:white; border:1px solid #ddd; border-radius:10px; width:150px; box-shadow:0 5px 20px rgba(0,0,0,0.2); z-index:999;">

                                <a href="{{ route('posts.show', $post) }}"
                                   style="display:block; padding:10px;">
                                    👁 Voir
                                </a>

                                @if(auth()->id() === $post->user_id)
                                    <a href="{{ route('posts.edit', $post) }}"
                                       style="display:block; padding:10px;">
                                        ✏ Modifier
                                    </a>

                                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button style="display:block; width:100%; text-align:left; padding:10px; color:red;">
                                            🗑 Supprimer
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- CONTENT --}}
                    <p class="text-gray-700 mb-4">
                        {{ $post->contenu }}
                    </p>

                    {{-- LIKE --}}
                    <div class="flex items-center gap-4 mb-4">
                        <form action="{{ route('posts.like', $post) }}" method="POST">
                            @csrf
                            <button class="text-orange-500">🧡 Like</button>
                        </form>

                        <form action="{{ route('posts.unlike', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="text-gray-500">💔 Unlike</button>
                        </form>

                        <span class="text-gray-600">
                            {{ $post->likes->count() }} likes
                        </span>
                    </div>

                    {{-- COMMENTS --}}
                    <div class="border-t pt-4">
                        <h3 class="font-semibold mb-2">Commentaires</h3>

                        @foreach($post->comments as $comment)
                            <p class="text-sm mb-1">
                                <strong>{{ $comment->user->name }}</strong> :
                                {{ $comment->contenu }}
                            </p>
                        @endforeach

                        <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-3 flex gap-2">
                            @csrf
                            <input name="contenu"
                                   placeholder="Ajouter un commentaire..."
                                   class="flex-1 rounded-full border-gray-300">
                            <button class="bg-orange-400 text-white px-4 rounded-full">
                                OK
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="text-center text-gray-500 mt-20">
                    Aucun post 😢
                </div>
            @endforelse

        </div>
    </div>

    {{-- SCRIPT MENU --}}
    <script>
        function toggleMenu(event, id) {
            event.stopPropagation();

            document.querySelectorAll('[id^="menu-"]').forEach(menu => {
                if (menu.id !== 'menu-' + id) {
                    menu.style.display = 'none';
                }
            });

            const menu = document.getElementById('menu-' + id);
            menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
        }

        document.addEventListener('click', function () {
            document.querySelectorAll('[id^="menu-"]').forEach(menu => {
                menu.style.display = 'none';
            });
        });
    </script>
</x-app-layout>