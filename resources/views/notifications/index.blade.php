<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="mb-10 border-b border-green-900/30 pb-6">
            <h1 class="text-3xl font-extrabold text-green-500 tracking-tight flex items-center">
                <span class="mr-3">🔔</span> Notifications
            </h1>
            <p class="text-gray-500 mt-2">Retrouve ici toutes les activités liées à ton compte.</p>
        </div>

        <div class="space-y-4">
            @forelse($notifications as $notification)
                <div class="bg-gray-900/50 border {{ $notification->lu ? 'border-green-900/20 opacity-60' : 'border-green-500/30 shadow-[0_0_15px_rgba(34,197,94,0.1)]' }} rounded-2xl p-6 transition-all hover:bg-gray-900">
                    <div class="flex items-start justify-between gap-6">
                        <div class="flex-grow">
                            <p class="text-lg {{ $notification->lu ? 'text-gray-400' : 'text-gray-100 font-semibold' }}">
                                {{ $notification->message }}
                            </p>

                            <div class="flex items-center gap-4 mt-3">
                                <p class="text-xs text-gray-500 font-mono">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                                
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-widest border {{ $notification->lu ? 'text-green-800 border-green-900/30 bg-green-950/20' : 'text-green-400 border-green-500/30 bg-green-500/10' }}">
                                    {{ $notification->lu ? 'Lue' : 'Nouvelle' }}
                                </span>
                            </div>
                        </div>

                        @if(!$notification->lu)
                            <form action="{{ route('notifications.read', $notification) }}" method="POST" class="shrink-0">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-green-500 hover:bg-green-400 text-black px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-lg shadow-green-500/20 active:scale-95">
                                    Marquer comme lue
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-gray-900/30 rounded-3xl border-2 border-dashed border-green-900/30">
                    <div class="text-5xl mb-6 opacity-30">🔔</div>
                    <h2 class="text-xl font-bold text-gray-400">Aucune notification</h2>
                    <p class="text-gray-600 mt-2">Tes nouvelles activités apparaîtront ici.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>