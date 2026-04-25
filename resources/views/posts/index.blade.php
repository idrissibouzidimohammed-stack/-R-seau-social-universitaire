<x-app-layout>
    <div class="container-feed">
        
        {{-- POSTS FEED --}}
        <div class="space-y-4">
            @forelse($posts as $post)
                <article class="card">
                    {{-- Header --}}
                    <div class="flex items-center justify-between p-5 border-b border-slate-50 w-full">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('users.show', $post->user) }}" class="flex-shrink-0 p-0.5 gradient-bg rounded-full">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&color=F97316&background=FFF&size=32" 
                                     class="w-8 h-8 rounded-full border-2 border-white" alt="Avatar">
                            </a>
                            <div class="flex flex-col">
                                <a href="{{ route('users.show', $post->user) }}" class="username">
                                    {{ $post->user->name }}
                                </a>
                                @if($post->user->filiere)
                                    <span class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">{{ $post->user->filiere }}</span>
                                @endif
                            </div>
                        </div>
                        
                        {{-- Post Options Dropdown (3 Dots) --}}
                        <div class="flex items-center">
                            <x-dropdown align="right" width="56">
                                <x-slot name="trigger">
                                    <button class="text-slate-400 hover:text-black transition-colors p-1">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM18 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    {{-- Global Actions --}}
                                    <button onclick="copyPostLink('{{ route('posts.show', $post) }}')" class="w-full text-left px-4 py-2.5 text-xs font-bold text-slate-700 hover:bg-slate-50 flex items-center gap-3 border-b border-slate-50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                        Copier le lien
                                    </button>

                                    <button class="w-full text-left px-4 py-2.5 text-xs font-bold text-slate-700 hover:bg-slate-50 flex items-center gap-3 border-b border-slate-50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                                        Partager le poste
                                    </button>

                                    <button class="w-full text-left px-4 py-2.5 text-xs font-bold text-slate-700 hover:bg-slate-50 flex items-center gap-3 border-b border-slate-50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                                        Enregistrer sur le profil
                                    </button>

                                    <button class="w-full text-left px-4 py-2.5 text-xs font-black text-rose-500 hover:bg-rose-50 flex items-center gap-3 {{ auth()->id() === $post->user_id ? 'border-b border-slate-100' : '' }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        Signaler ce poste
                                    </button>

                                    {{-- Owner Actions --}}
                                    @if(auth()->id() === $post->user_id)
                                        <x-dropdown-link :href="route('posts.edit', $post)" class="text-xs font-bold text-slate-600 flex items-center gap-3">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            Modifier
                                        </x-dropdown-link>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-full text-left px-4 py-2 text-xs font-bold text-rose-600 hover:bg-rose-50 flex items-center gap-3">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Supprimer
                                            </button>
                                        </form>
                                    @endif
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>

                    {{-- Post Content --}}
                    <div class="post-content">
                        <p class="whitespace-pre-wrap">{{ $post->contenu }}</p>
                    </div>

                    {{-- Actions Row --}}
                    <div class="px-4 py-2 flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            @if($post->likes->contains('user_id', auth()->id()))
                                <form action="{{ route('posts.unlike', $post) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-rose-500 animate-heart">
                                        <svg fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path></svg>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('posts.like', $post) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-slate-800 hover:text-slate-500">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                    </button>
                                </form>
                            @endif

                            <button class="text-slate-800 hover:text-slate-500">
                                <svg fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            </button>
                        </div>
                    </div>

                    {{-- Likes Count --}}
                    <div class="px-4 pb-1">
                        <span class="text-xs font-black text-slate-900 border-b-2 border-orange-200">{{ $post->likes->count() }} J'aime</span>
                    </div>

                    {{-- Captions / Comments --}}
                    <div class="px-4 pb-3 space-y-1">
                        <div class="text-xs">
                            <a href="{{ route('users.show', $post->user) }}" class="font-bold mr-1">{{ $post->user->name }}</a>
                            <span>{{ Str::limit($post->contenu, 100) }}</span>
                        </div>

                        {{-- Comments Preview --}}
                        @if($post->comments->count() > 0)
                            <div class="pt-1">
                                @foreach($post->comments->take(1) as $comment)
                                    <div class="text-xs">
                                        <span class="font-bold mr-1">{{ $comment->user->name }}</span>
                                        <span class="text-slate-600">{{ $comment->contenu }}</span>
                                    </div>
                                @endforeach
                                @if($post->comments->count() > 1)
                                    <a href="{{ route('posts.show', $post) }}" class="text-[10px] text-slate-400 font-medium">Voir les {{ $post->comments->count() }} commentaires</a>
                                @endif
                            </div>
                        @endif

                        <div class="pt-2">
                            <span class="timestamp">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    {{-- Quick Comment Input --}}
                    <form action="{{ route('comments.store', $post) }}" method="POST" class="border-t border-slate-100 flex items-center px-4 py-2">
                        @csrf
                        <input name="contenu" placeholder="Ajouter un commentaire..." 
                               class="flex-1 bg-transparent border-none text-xs focus:ring-0 placeholder-slate-400 p-0 py-1" autocomplete="off">
                        <button type="submit" class="text-blue-500 font-bold text-xs disabled:opacity-50">Publier</button>
                    </form>
                </article>
            @empty
                <div class="card p-20 text-center">
                    <p class="text-slate-400 text-sm">Le fil est vide. Suivez des gens pour voir leurs publications !</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        function copyPostLink(url) {
            navigator.clipboard.writeText(url).then(() => {
                alert('Lien du post copié dans le presse-papiers !');
            }).catch(err => {
                console.error('Erreur lors de la copie : ', err);
            });
        }
    </script>
</x-app-layout>