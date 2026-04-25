<x-app-layout>
    <div class="max-w-[600px] mx-auto py-10 px-4">
        <div class="mb-8 flex items-center justify-between border-b border-slate-100 pb-4">
            <h1 class="text-xl font-bold text-slate-900 tracking-tight">Notifications</h1>
        </div>

        <div class="bg-white rounded-lg border border-slate-200 overflow-hidden divide-y divide-slate-50">
            @forelse($notifications as $notification)
                <div class="flex items-center justify-between p-4 {{ $notification->lu ? 'opacity-60' : 'bg-blue-50/20' }} hover:bg-slate-50 transition-all">
                    <div class="flex items-center gap-4 flex-grow">
                         @php
                            $icon = match($notification->type) {
                                'like' => '❤️',
                                'comment' => '💬',
                                'follow' => '👤',
                                default => '🔔'
                            };
                        @endphp
                        <div class="w-10 h-10 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center text-lg shrink-0">
                            {{ $icon }}
                        </div>
                        <div class="flex flex-col">
                            <p class="text-xs text-slate-800 leading-snug">
                                <span class="font-bold">{{ $notification->message }}</span>
                            </p>
                            <span class="text-[10px] font-medium text-slate-400 mt-1 uppercase tracking-tight">{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    @if(!$notification->lu)
                        <form action="{{ route('notifications.read', $notification) }}" method="POST" class="shrink-0">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-primary !py-1 !px-3 !bg-blue-500 text-[10px]">
                                Ok
                            </button>
                        </form>
                    @endif
                </div>
            @empty
                <div class="p-20 text-center">
                    <div class="text-5xl mb-4 opacity-10 filter grayscale">🔔</div>
                    <p class="text-sm font-bold text-slate-300">Aucune nouvelle notification</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>