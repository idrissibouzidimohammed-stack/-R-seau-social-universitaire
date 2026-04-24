<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="mb-10 border-b border-green-900/30 pb-6">
            <h1 class="text-4xl font-extrabold text-green-500 tracking-tight flex items-center">
                <span class="mr-4">✉️</span> Messages
            </h1>
            <p class="text-gray-500 mt-2">Tes conversations privées avec la communauté.</p>
        </div>

        <div class="space-y-6">
            @forelse($messages as $message)
                @php
                    $isSent = $message->sender_id === auth()->id();
                @endphp
                <div class="flex {{ $isSent ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-xl group">
                        <div class="flex items-center {{ $isSent ? 'justify-end' : 'justify-start' }} mb-2 gap-2">
                            @if(!$isSent)
                                <img class="h-6 w-6 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($message->sender->name) }}&color=10B981&background=064E3B&size=24" alt="Avatar">
                            @endif
                            <span class="text-[10px] uppercase tracking-widest font-bold {{ $isSent ? 'text-green-800' : 'text-gray-600' }}">
                                {{ $isSent ? 'Moi' : $message->sender->name }}
                            </span>
                            @if($isSent)
                                <img class="h-6 w-6 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($message->sender->name) }}&color=10B981&background=064E3B&size=24" alt="Avatar">
                            @endif
                        </div>
                        
                        <div class="relative p-5 rounded-3xl {{ $isSent ? 'bg-green-600 text-black rounded-tr-none shadow-[0_10px_20px_-5px_rgba(22,163,74,0.3)]' : 'bg-gray-900 border border-green-900/20 text-gray-200 rounded-tl-none' }}">
                            <p class="text-base leading-relaxed break-words">{{ $message->contenu }}</p>
                        </div>
                        
                        <div class="mt-2 flex {{ $isSent ? 'justify-end' : 'justify-start' }}">
                            <span class="text-[10px] font-mono text-gray-700 italic">{{ $message->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-gray-900/30 rounded-[2.5rem] border-2 border-dashed border-green-900/10">
                    <div class="text-6xl mb-6 opacity-10">💬</div>
                    <h2 class="text-xl font-bold text-gray-500">Aucune conversation</h2>
                    <p class="text-gray-600 mt-2">Va sur le profil d'un utilisateur pour lui envoyer un message !</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>