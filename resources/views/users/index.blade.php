<x-app-layout>
    <div class="max-w-[600px] mx-auto py-10 px-4">

        {{-- Search Header --}}
        <div class="mb-8 border-b border-slate-100 pb-4">
            <h1 class="text-xl font-bold text-slate-900 tracking-tight">Recherche</h1>
        </div>

        {{-- Results List --}}
        <div class="bg-white rounded-lg border border-slate-200 overflow-hidden divide-y divide-slate-50">
            @forelse($users as $user)
                <div class="flex items-center justify-between p-4 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-4">
                        {{-- Avatar --}}
                        <div class="w-11 h-11 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-xl font-black text-slate-300 overflow-hidden">
                             <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=000&background=F1F5F9&size=44" alt="Avatar">
                        </div>

                        {{-- Infos --}}
                        <div>
                            <a href="{{ route('users.show', $user) }}" class="username block">
                                {{ $user->name }} {{ $user->prenom }}
                            </a>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">
                                {{ $user->role ?? 'Membre' }}
                                @if($user->filiere)
                                    <span class="mx-1">•</span> {{ $user->filiere }}
                                @endif
                            </p>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-3">
                        @if(auth()->id() !== $user->id)
                            @if(auth()->user()->following->contains($user->id))
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 py-1 bg-slate-100 rounded-md">Déjà suivi</span>
                            @else
                                <form action="{{ route('follow', $user) }}" method="POST">
                                    @csrf
                                    <button class="btn-primary !py-1 !px-4 text-[11px]">S'abonner</button>
                                </form>
                            @endif
                        @endif
                        <a href="{{ route('users.show', $user) }}" class="text-slate-400 hover:text-black">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="p-20 text-center">
                    <div class="text-6xl mb-4 opacity-10 filter grayscale">🔍</div>
                    <h2 class="text-sm font-bold text-slate-400">Aucun utilisateur trouvé</h2>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>