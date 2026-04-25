<x-app-layout>
    <div class="max-w-[500px] mx-auto py-10 px-4">
        
        <div class="card overflow-hidden">
            <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                 <a href="{{ route('posts.index') }}" class="text-xs font-bold text-slate-400 hover:text-black">Annuler</a>
                 <h1 class="text-sm font-bold absolute left-1/2 -translate-x-1/2">Nouvelle publication</h1>
            </div>

            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                
                <div class="flex p-4 gap-4 items-start bg-slate-50/30">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=000&background=F1F5F9&size=32" 
                         class="w-8 h-8 rounded-full border border-slate-200" alt="Me">
                    
                    <textarea name="contenu" rows="6" 
                              class="flex-1 bg-transparent border-none text-sm focus:ring-0 placeholder-slate-400 p-0 py-1 font-medium" 
                              placeholder="Quoi de neuf sur le campus ?">{{ old('contenu') }}</textarea>
                </div>

                <div class="p-4 border-t border-slate-100 bg-white flex justify-end">
                    <button type="submit" class="text-blue-500 font-bold text-sm hover:text-blue-600 transition-colors">
                        Partager
                    </button>
                </div>
            </form>
        </div>

        @error('contenu')
            <div class="mt-4 p-3 bg-rose-50 border border-rose-100 rounded-lg text-rose-500 text-[10px] font-bold uppercase tracking-widest text-center animate-pulse">
                {{ $message }}
            </div>
        @enderror
    </div>
</x-app-layout>