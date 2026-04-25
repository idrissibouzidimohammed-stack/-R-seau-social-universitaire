<x-app-layout>
    <div class="container-feed">
        
        {{-- POSTS FEED --}}
        <div class="space-y-4">
            @forelse($posts as $post)
                <article class="card">
                    {{-- Header --}}
                    <div class="post-header">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('users.show', $post->user) }}" class="flex-shrink-0 p-0.5 gradient-bg rounded-full">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&color=000&background=FFF&size=32" 
                                     class="w-8 h-8 rounded-full border-2 border-white" alt="Avatar">
                            </a>
                            <div class="flex flex-col">
                                <a href="{{ route('users.show', $post->user) }}" class="username">
                                    {{ $post->user->name }}
                                </a>
                                @if($post->user->filiere)
                                    <span class="text-[10px] text-slate-500">{{ $post->user->filiere }}</span>
                                @endif
                            </div>
                        </div>
                        
                        {{-- Controls (Only if Owner) --}}
                        <div class="flex items-center">
                            @if(auth()->id() === $post->user_id)
                                <x-dropdown align="right" width="40">
                                    <x-slot name="trigger">
                                        <button class="text-slate-400 hover:text-black">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM18 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('posts.edit', $post)" class="text-sm">Modifier</x-dropdown-link>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-rose-500 hover:bg-slate-50">Supprimer</button>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @endif
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
</x-app-layout>