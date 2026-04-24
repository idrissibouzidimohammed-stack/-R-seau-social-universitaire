<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <div class="mb-10 text-center">
            <div class="inline-block p-1 rounded-full bg-gradient-to-tr from-green-500 to-green-900 mb-6 shadow-2xl shadow-green-500/20">
                <img class="h-24 w-24 rounded-full border-4 border-gray-900 object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($user->name . ' ' . $user->prenom) }}&color=10B981&background=064E3B&size=96" alt="Avatar">
            </div>
            <h1 class="text-3xl font-black text-gray-100 tracking-tight">
                Message privé à <span class="text-green-500">{{ $user->name }}</span>
            </h1>
            <p class="text-gray-500 mt-2 font-mono text-sm uppercase tracking-widest">Connecté avec la communauté</p>
        </div>

        <div class="bg-gray-900 rounded-[2.5rem] shadow-2xl border border-green-900/20 p-8 sm:p-12 relative overflow-hidden">
             <!-- Background flare -->
            <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-green-500/5 rounded-full blur-3xl"></div>
            
            <form action="{{ route('messages.store', $user) }}" method="POST" class="relative z-10">
                @csrf

                <div class="mb-8">
                    <label class="block text-green-800 font-bold uppercase tracking-[0.2em] text-xs mb-4 ml-1">VOTRE MESSAGE</label>

                    <textarea name="contenu" rows="6" 
                        class="w-full bg-black/50 border-2 border-green-900/30 rounded-3xl p-6 text-gray-100 placeholder-gray-700 focus:border-green-500/50 focus:ring-0 transition-all text-lg leading-relaxed" 
                        placeholder="Écrire quelque chose de sympa à {{ $user->name }}..."
                    ></textarea>

                    @error('contenu')
                        <p class="text-red-500 text-sm mt-3 font-medium flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('users.show', $user) }}" class="text-gray-500 hover:text-gray-300 font-bold text-sm transition-colors flex items-center gap-2 group">
                        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Retour
                    </a>
                    
                    <button type="submit" class="group bg-green-500 hover:bg-green-400 text-black px-10 py-4 rounded-2xl font-black text-lg transition-all shadow-[0_15px_30px_-10px_rgba(34,197,94,0.3)] hover:shadow-[0_20px_40px_-10px_rgba(34,197,94,0.4)] active:scale-95 flex items-center gap-3">
                        Envoyer
                        <svg class="w-5 h-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>