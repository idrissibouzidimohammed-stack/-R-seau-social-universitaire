<nav x-data="{ open: false }" class="bg-white/90 backdrop-blur-md border-b border-white/20 sticky top-0 z-50 shadow-xl shadow-orange-950/10">
    <div class="max-w-[975px] mx-auto px-4 lg:px-0">
        <div class="flex justify-between h-20 items-center">
            
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('posts.index') }}" class="transition-transform hover:scale-105 active:scale-95 flex items-center gap-3">
                    <div class="w-10 h-10 gradient-bg rounded-2xl flex items-center justify-center shadow-lg shadow-orange-500/30">
                        <span class="text-white font-black text-lg">U</span>
                    </div>
                    <span class="text-2xl font-black text-slate-900 tracking-tighter" style="font-family: 'Billabong', cursive, sans-serif;">CampusGram</span>
                </a>
            </div>

            <!-- Search Bar (Desktop) -->
            <div class="hidden sm:block flex-1 max-w-[268px] mx-8">
                <form action="{{ route('users.search') }}" method="GET" class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="q" placeholder="Rechercher" 
                           class="w-full bg-slate-100 border-none h-9 rounded-lg pl-10 pr-3 text-sm focus:ring-0 focus:bg-slate-50 transition-all placeholder-slate-500">
                </form>
            </div>

            <!-- Icons (Right) -->
            <div class="flex items-center space-x-5">
                <a href="{{ route('posts.index') }}" class="nav-icon" title="Accueil">
                    <svg fill="{{ request()->routeIs('posts.index') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </a>

                <a href="{{ route('messages.index') }}" class="nav-icon" title="Messages">
                    <svg fill="{{ request()->routeIs('messages.*') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                </a>

                <a href="{{ route('posts.create') }}" class="nav-icon" title="Nouveau Post">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </a>

                <a href="{{ route('notifications.index') }}" class="nav-icon relative" title="Notifications">
                    <svg fill="{{ request()->routeIs('notifications.*') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    @php $unreadCount = auth()->user()->notificationsCustom()->where('lu', false)->count(); @endphp
                    @if($unreadCount > 0)
                        <span class="absolute -top-1 -right-1 bg-rose-500 text-white text-[8px] font-bold px-1 rounded-full border border-white">{{ $unreadCount }}</span>
                    @endif
                </a>

                <!-- Profile Dropdown (Simplified to Icon) -->
                <div class="ms-1">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex transition-all active:scale-90 ring-1 ring-offset-2 ring-transparent hover:ring-slate-300 rounded-full">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=000&background=F1F5F9&size=24" 
                                     class="w-6 h-6 rounded-full border border-slate-200" alt="Me">
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('users.show', auth()->user())">
                                {{ __('Profil') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Paramètres') }}
                            </x-dropdown-link>
                            <hr class="border-slate-100">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Se déconnecter') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Instagram Font (Simulation) -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
body { font-family: 'Roboto', sans-serif; }
</style>
