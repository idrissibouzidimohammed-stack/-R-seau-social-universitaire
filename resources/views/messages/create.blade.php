<x-app-layout>
    <div class="max-w-[600px] mx-auto py-10 px-4">
        
        <div class="card p-10 flex flex-col items-center">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=000&background=F1F5F9&size=96" 
                 class="w-24 h-24 rounded-full border border-slate-200 mb-6 shadow-sm" alt="Avatar">
            
            <h1 class="text-xl font-bold text-slate-900 tracking-tight mb-2">
                {{ $user->name }} {{ $user->prenom }}
            </h1>
            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mb-8">{{ $user->role ?? 'Membre' }}</p>

            <form action="{{ route('messages.store', $user) }}" method="POST" class="w-full">
                @csrf

                <div class="mb-6">
                    <textarea name="contenu" rows="4" 
                        class="w-full bg-white border border-slate-200 rounded-lg p-5 text-sm font-medium focus:border-slate-400 focus:ring-0 transition-all placeholder-slate-300" 
                        placeholder="Écrivez un message..."
                    ></textarea>

                    @error('contenu')
                        <p class="text-rose-500 text-[10px] mt-2 font-bold uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between gap-4">
                    <a href="{{ route('users.show', $user) }}" class="text-slate-400 hover:text-black font-bold text-xs uppercase tracking-widest transition-colors flex items-center gap-2">
                         <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                         Retour
                    </a>
                    
                    <button type="submit" class="btn-primary !bg-blue-500 px-8">
                        Envoyer
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>