<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        {{-- Profile card --}}
        <div class="bg-gray-900/50 rounded-[2.5rem] shadow-2xl border border-green-900/20 p-10 mb-12 relative overflow-hidden group">
            <!-- Decorative gradient blur -->
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-green-500/10 rounded-full blur-3xl group-hover:bg-green-500/20 transition-all duration-700"></div>
            
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10 relative z-10">
                <div class="flex flex-col md:flex-row items-center md:items-start gap-8 text-center md:text-left">
                    <div class="relative">
                        <div class="w-32 h-32 rounded-full p-1 bg-gradient-to-tr from-green-500 to-green-900 shadow-[0_0_30px_rgba(34,197,94,0.2)]">
                            <div class="w-full h-full rounded-full bg-gray-950 flex items-center justify-center text-5xl font-black text-green-500 border-4 border-gray-900">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        </div>
                        @if(auth()->id() !== $user->id)
                            <div class="absolute -bottom-2 -right-2">
                                <a href="{{ route('messages.create', $user) }}" class="bg-green-500 hover:bg-green-400 text-black p-3 rounded-full shadow-lg transition-transform hover:scale-110 active:scale-95 flex items-center justify-center" title="Envoyer un message">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="flex-grow">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <h1 class="text-4xl font-extrabold text-gray-100 tracking-tight">
                                {{ $user->name }} <span class="text-green-500">{{ $user->prenom }}</span>
                            </h1>
                            
                            @if(auth()->id() !== $user->id)
                                @if(auth()->user()->following->contains($user->id))
                                    <form action="{{ route('unfollow', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-5 py-1.5 rounded-full border border-red-900/50 text-red-500 text-xs font-bold uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all">Ne plus suivre</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', $user) }}" method="POST">
                                        @csrf
                                        <button class="px-5 py-1.5 rounded-full bg-green-500 text-black text-xs font-bold uppercase tracking-widest hover:bg-green-400 transition-all shadow-lg shadow-green-500/20">Suivre</button>
                                    </form>
                                @endif
                            @endif
                        </div>

                        <p class="text-green-800 font-mono text-sm uppercase tracking-[0.2em] mt-2 font-bold italic">
                            {{ $user->role ?? 'Étudiant' }}
                            @if($user->filiere)
                                <span class="mx-3 text-green-900/30">/</span> {{ $user->filiere }}
                            @endif
                        </p>

                        @if($user->bio)
                            <p class="text-gray-400 mt-5 max-w-2xl leading-relaxed text-lg italic border-l-2 border-green-500/20 pl-4">"{{ $user->bio }}"</p>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-6 text-center w-full lg:w-auto">
                    <div class="bg-gray-950/50 border border-green-900/20 rounded-3xl p-6 min-w-[120px] backdrop-blur-sm">
                        <div class="text-3xl font-black text-gray-100">{{ $user->posts->count() }}</div>
                        <div class="text-[10px] uppercase tracking-widest text-green-700 font-bold mt-1">Posts</div>
                    </div>
                    <div class="bg-gray-950/50 border border-green-900/20 rounded-3xl p-6 min-w-[120px] backdrop-blur-sm">
                        <div class="text-3xl font-black text-gray-100">{{ $user->followers->count() }}</div>
                        <div class="text-[10px] uppercase tracking-widest text-green-700 font-bold mt-1">Followers</div>
                    </div>
                    <div class="bg-gray-950/50 border border-green-900/20 rounded-3xl p-6 min-w-[120px] backdrop-blur-sm">
                        <div class="text-3xl font-black text-gray-100">{{ $user->following->count() }}</div>
                        <div class="text-[10px] uppercase tracking-widest text-green-700 font-bold mt-1">Following</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Posts section --}}
        <div class="mb-10 flex items-center justify-between">
            <h2 class="text-3xl font-black text-gray-100 tracking-tight">
                <span class="text-green-500">#</span> Publications
            </h2>
            <div class="h-px flex-grow bg-green-900/20 ml-6"></div>
        </div>

        <div class="grid gap-8">
            @forelse($user->posts as $post)
                <div class="bg-gray-900/40 border border-green-900/10 rounded-[2rem] p-8 hover:border-green-500/20 transition-all duration-300">
                    <p class="text-gray-300 text-xl leading-relaxed">{{ $post->contenu }}</p>

                    <div class="mt-6 flex items-center gap-4 text-xs font-mono text-gray-600">
                        <span class="bg-gray-950 px-3 py-1 rounded-full border border-green-900/20">{{ $post->created_at->format('d M Y') }}</span>
                        <span class="text-green-900/50">•</span>
                        <span>{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-gray-900/20 rounded-[2.5rem] border-2 border-dashed border-green-900/10">
                    <div class="text-6xl mb-6 opacity-10">📝</div>
                    <h3 class="text-2xl font-bold text-gray-500">Aucune publication</h3>
                    <p class="text-gray-600 mt-2 italic">Cet utilisateur n’a pas encore partagé de contenu.</p>
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>