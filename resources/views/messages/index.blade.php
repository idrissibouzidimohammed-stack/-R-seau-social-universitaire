<x-app-layout>
    <div class="max-w-[935px] mx-auto py-10 px-4 h-[calc(100vh-120px)]">
        <div class="card h-full flex overflow-hidden">
            
            {{-- Left Side: Contacts List (Simplified) --}}
            <div class="w-1/3 border-r border-slate-200 flex flex-col">
                <div class="p-5 border-b border-slate-200 flex items-center justify-between">
                    <span class="font-bold text-sm tracking-tight mx-auto">{{ auth()->user()->name }}</span>
                </div>
                <div class="flex-grow overflow-y-auto">
                    {{-- Here we would ideally group by conversation, for now just show a cleaner message list --}}
                    @foreach($messages->unique('sender_id') as $conv)
                         <div class="flex items-center gap-3 p-4 hover:bg-slate-50 cursor-pointer border-b border-slate-50">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($conv->sender->name) }}&color=000&background=F1F5F9&size=40" class="w-10 h-10 rounded-full border border-slate-100" alt="Avatar">
                            <div class="flex flex-col">
                                <span class="text-xs font-bold">{{ $conv->sender->name }}</span>
                                <span class="text-[10px] text-slate-400">Actif(ve) récemment</span>
                            </div>
                         </div>
                    @endforeach
                </div>
            </div>

            {{-- Right Side: Chat Window --}}
            <div class="flex-1 flex flex-col bg-white">
                <div class="flex-grow p-6 overflow-y-auto space-y-4">
                    @forelse($messages as $message)
                        @php $isSent = $message->sender_id === auth()->id(); @endphp
                        <div class="flex {{ $isSent ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[70%] {{ $isSent ? 'bg-slate-100 text-slate-900 border border-slate-200' : 'bg-white text-slate-900 border border-slate-200' }} px-4 py-3 rounded-[20px] text-xs leading-relaxed font-medium">
                                {{ $message->contenu }}
                            </div>
                        </div>
                    @empty
                        <div class="h-full flex flex-col items-center justify-center text-center p-10">
                            <div class="w-24 h-24 rounded-full border-2 border-slate-900 flex items-center justify-center mb-6">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"></path></svg>
                            </div>
                            <h3 class="text-xl font-light">Vos messages</h3>
                            <p class="text-slate-400 text-xs mt-2">Envoyez des messages privés à un ami ou à un groupe.</p>
                        </div>
                    @endforelse
                </div>
                
                {{-- Quick Info --}}
                @if($messages->count() > 0)
                    <div class="p-5 text-center bg-slate-50 border-t border-slate-100">
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Allez sur le profil de quelqu'un pour lui répondre</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>