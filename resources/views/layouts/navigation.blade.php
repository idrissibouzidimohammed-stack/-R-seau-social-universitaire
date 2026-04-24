<nav x-data="{ open: false }" class="bg-black border-b border-green-900/50 shadow-lg shadow-green-900/10 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('posts.index') }}" class="transition-transform hover:scale-105 active:scale-95">
                        <x-application-logo class="block h-9 w-auto fill-current text-green-500" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.*')" class="text-gray-400 hover:text-green-400 active:text-green-500 font-bold uppercase tracking-widest text-[10px]">
                        Fil d'actu
                    </x-nav-link>
                    
                    <x-nav-link :href="route('users.search')" :active="request()->routeIs('users.*')" class="text-gray-400 hover:text-green-400 active:text-green-500 font-bold uppercase tracking-widest text-[10px]">
                        Recherche
                    </x-nav-link>

                    <x-nav-link :href="route('messages.index')" :active="request()->routeIs('messages.*')" class="text-gray-400 hover:text-green-400 active:text-green-500 font-bold uppercase tracking-widest text-[10px]">
                        Messages
                    </x-nav-link>

                    <x-nav-link :href="route('notifications.index')" :active="request()->routeIs('notifications.*')" class="text-gray-400 hover:text-green-400 active:text-green-500 font-bold uppercase tracking-widest text-[10px]">
                        Notifications
                        @php $unreadCount = auth()->user()->notificationsCustom()->where('lu', false)->count(); @endphp
                        @if($unreadCount > 0)
                            <span class="ml-2 bg-green-500 text-black px-1.5 py-0.5 rounded-full text-[8px] animate-pulse">{{ $unreadCount }}</span>
                        @endif
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-green-900/30 text-xs leading-4 font-black uppercase tracking-widest rounded-xl text-gray-400 bg-gray-900/50 hover:text-green-400 hover:border-green-500/50 transition-all duration-150">
                            <div class="mr-2">{{ Auth::user()->name }}</div>
                            <div class="w-6 h-6 rounded-full overflow-hidden border border-green-500/30">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=10B981&background=064E3B&size=24" alt="Me">
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-gray-900 border border-green-900/50 rounded-xl shadow-2xl py-2 overflow-hidden">
                            <x-dropdown-link :href="route('profile.edit')" class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:bg-green-500 hover:text-black transition-colors px-6 py-3">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                        class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:bg-red-500 hover:text-white transition-colors px-6 py-3">
                                    {{ __('Deconnexion') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-green-500 hover:text-green-400 hover:bg-gray-950 focus:outline-none transition duration-150 ease-in-out border border-green-900/30 shadow-lg shadow-green-500/10">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-black border-t border-green-900/30">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.*')" class="text-gray-400 hover:text-green-400 border-l-4 border-transparent active:border-green-500 active:bg-green-500/10">
                Fil d'actu
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('users.search')" :active="request()->routeIs('users.*')" class="text-gray-400 hover:text-green-400 border-l-4 border-transparent active:border-green-500 active:bg-green-500/10">
                Recherche
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('messages.index')" :active="request()->routeIs('messages.*')" class="text-gray-400 hover:text-green-400 border-l-4 border-transparent active:border-green-500 active:bg-green-500/10">
                Messages
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('notifications.index')" :active="request()->routeIs('notifications.*')" class="text-gray-400 hover:text-green-400 border-l-4 border-transparent active:border-green-500 active:bg-green-500/10">
                Notifications
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-4 border-t border-green-900/30 bg-gray-950/50">
            <div class="px-6 flex items-center gap-4">
                <div class="w-10 h-10 rounded-full border border-green-500/50 overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=10B981&background=064E3B&size=40" alt="Me">
                </div>
                <div>
                    <div class="font-bold text-base text-green-500">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-xs text-gray-600">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-4 space-y-1 px-4">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-xl text-gray-400 hover:text-green-400 hover:bg-green-500/5">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="rounded-xl text-gray-400 hover:text-red-500 hover:bg-red-500/5">
                        {{ __('Deconnexion') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
