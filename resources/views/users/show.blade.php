<x-app-layout>
    <div class="container-profile">
        
        {{-- Profile Header --}}
        <div class="flex flex-col md:flex-row gap-10 md:gap-20 items-center md:items-start mb-12 pb-12 border-b border-slate-200">
            
            {{-- Avatar --}}
            <div class="relative shrink-0">
                <div class="w-32 h-32 md:w-36 md:h-36 rounded-full p-1 gradient-bg shadow-xl shadow-orange-500/20">
                    <div class="w-full h-full rounded-full bg-white flex items-center justify-center p-1">
                        <div class="w-full h-full rounded-full bg-slate-50 flex items-center justify-center text-5xl font-black text-slate-300 overflow-hidden">
                             <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=F97316&background=FFF&size=128" alt="Profile">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-grow text-center md:text-left">
                <div class="flex flex-col md:flex-row md:items-center gap-6 mb-8">
                    <h1 class="text-3xl font-black gradient-text tracking-tight uppercase">{{ $user->name }}</h1>
                    
                    <div class="flex items-center gap-2">
                        @if(auth()->id() === $user->id)
                            <a href="{{ route('profile.edit') }}" class="btn-outline text-xs">Modifier le profil</a>
                        @else
                            @if(auth()->user()->following->contains($user->id))
                                <form action="{{ route('unfollow', $user) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="btn-secondary text-xs">Suivi(e)</button>
                                </form>
                            @else
                                <form action="{{ route('follow', $user) }}" method="POST">
                                    @csrf
                                    <button class="btn-primary !bg-blue-500 hover:!bg-blue-600 text-xs px-6">S'abonner</button>
                                </form>
                            @endif
                            
                            <a href="{{ route('messages.create', $user) }}" class="btn-secondary text-xs px-4">Message</a>
                        @endif
                    </div>
                </div>

                <div class="flex gap-10 mb-8 border-y border-slate-200/50 py-4">
                    <div class="text-sm text-slate-800"><span class="font-black">{{ $user->posts->count() }}</span> publications</div>
                    <div class="text-sm text-slate-800"><span class="font-black">{{ $user->followers->count() }}</span> abonnés</div>
                    <div class="text-sm text-slate-800"><span class="font-black">{{ $user->following->count() }}</span> abonnements</div>
                </div>

                <div class="space-y-1">
                    <h2 class="font-bold text-sm">{{ $user->name }} {{ $user->prenom }}</h2>
                    <p class="text-slate-500 text-xs uppercase tracking-widest font-black">{{ $user->role ?? 'Membre' }} @if($user->filiere) • {{ $user->filiere }} @endif</p>
                    @if($user->bio)
                        <p class="text-sm mt-3 leading-relaxed max-w-sm">{{ $user->bio }}</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Posts Grid --}}
        <div class="grid grid-cols-3 gap-1 md:gap-8">
            @forelse($user->posts as $post)
                <a href="{{ route('posts.show', $post) }}" class="relative group aspect-square block bg-white overflow-hidden rounded-xl hover:opacity-90 transition-all border border-slate-100 shadow-lg">
                    <div class="p-4 h-full flex flex-col justify-center items-center text-center">
                        <p class="text-[10px] md:text-xs text-slate-600 font-medium line-clamp-3 md:line-clamp-6">
                            {{ $post->contenu }}
                        </p>
                    </div>
                    
                    {{-- Hover Overlay --}}
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 flex items-center justify-center gap-6 text-white font-bold transition-opacity">
                         <div class="flex items-center gap-1.5">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"></path></svg>
                            <span>{{ $post->likes->count() }}</span>
                         </div>
                         <div class="flex items-center gap-1.5">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zm-4 0H9v2h2V9z" clip-rule="evenodd"></path></svg>
                            <span>{{ $post->comments->count() }}</span>
                         </div>
                    </div>
                </a>
            @empty
                <div class="col-span-3 py-20 text-center">
                    <div class="text-4xl opacity-20 mb-4">📸</div>
                    <p class="text-slate-400 text-sm italic">Aucune publication pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>