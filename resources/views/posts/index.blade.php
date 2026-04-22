<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Fil d'actualité</h1>
            <a href="{{ route('posts.create') }}" class="group relative inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white transition-all duration-200 bg-indigo-600 border border-transparent rounded-full hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 shadow-sm">
                <svg class="w-5 h-5 mr-2 -ml-1 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Publier
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 flex items-center p-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50" role="alert">
                <svg class="flex-shrink-0 inline w-5 h-5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                <span class="font-medium">Succès!</span>&nbsp;{{ session('success') }}
            </div>
        @endif

        <!-- Posts List -->
        <div class="space-y-6">
            @forelse($posts as $post)
                <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="p-6">
                        <!-- Post Header -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="relative">
                                    <img class="h-10 w-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name . ' ' . $post->user->prenom) }}&color=4F46E5&background=EEF2FF" alt="Avatar">
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">{{ $post->user->name }} {{ $post->user->prenom }}</div>
                                    <div class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            
                            <!-- Post Actions Dropdown / Links -->
                            <div class="flex space-x-2 text-sm">
                                <a href="{{ route('posts.show', $post) }}" class="text-gray-400 hover:text-indigo-600 transition-colors p-1" title="Voir">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>

                                @if(auth()->id() === $post->user_id)
                                    <a href="{{ route('posts.edit', $post) }}" class="text-gray-400 hover:text-blue-500 transition-colors p-1" title="Modifier">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>

                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors p-1" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce post ?');">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <!-- Post Content -->
                        <div class="text-gray-800 text-base leading-relaxed whitespace-pre-wrap">
                            {{ $post->contenu }}
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="bg-gray-50/50 border-t border-gray-100 p-6">
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4 border-b pb-2">Commentaires ({{ $post->comments->count() }})</h4>

                        <div class="space-y-4 mb-4">
                            @foreach($post->comments as $comment)
                                <div class="flex space-x-3 group">
                                    <img class="h-8 w-8 rounded-full object-cover shrink-0" src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&color=374151&background=F3F4F6&size=32" alt="Avatar">
                                    <div class="bg-gray-100 rounded-2xl rounded-tl-none px-4 py-2 flex-grow relative group-hover:bg-gray-200 transition-colors">
                                        <div class="flex justify-between items-baseline">
                                            <span class="font-medium text-sm text-gray-900">{{ $comment->user->name }}</span>
                                            
                                            @if(auth()->id() === $comment->user_id)
                                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity absolute top-2 right-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-gray-400 hover:text-red-500 px-1" title="Supprimer ce commentaire">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-700 mt-1">{{ $comment->contenu }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Comment Form -->
                        <form action="{{ route('comments.store', $post) }}" method="POST" class="flex gap-3 items-start mt-4 pt-4 border-t border-gray-100">
                            @csrf
                            <img class="h-8 w-8 rounded-full object-cover shrink-0 mt-0.5" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=4F46E5&background=EEF2FF&size=32" alt="Your Avatar">
                            <div class="flex-grow relative">
                                <textarea name="contenu" rows="1" class="block w-full rounded-2xl border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm resize-none py-2.5 px-4 pr-12 min-h-[44px]" placeholder="Écrire un commentaire..."></textarea>
                                <button type="submit" class="absolute right-2 bottom-1.5 p-1.5 text-white bg-indigo-600 hover:bg-indigo-700 rounded-full transition-colors flex items-center justify-center">
                                    <svg class="w-4 h-4 transform rotate-90" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </article>
            @empty
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100 border-dashed border-2">
                    <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Aucune publication</h3>
                    <p class="mt-1 text-sm text-gray-500">Le fil d'actualité est vide. Lancez la discussion !</p>
                    <div class="mt-6">
                        <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Créer le premier post
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>