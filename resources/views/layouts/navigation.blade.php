<nav class="nav-blur">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-24">

            {{-- LOGO --}}
            <a href="{{ route('posts.index') }}" class="flex items-center gap-4 group">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-sky-400 to-pink-400 flex items-center justify-center shadow-lg group-hover:rotate-12 transition-transform duration-500">
                    <span class="text-white font-black text-2xl">C</span>
                </div>
                <div class="leading-tight">
                    <div class="text-2xl font-black tracking-tighter text-slate-900">
                        Campus<span class="gradient-text">Gram</span>
                    </div>
                    <div class="text-[10px] font-black uppercase tracking-widest text-sky-400">
                        University Social
                    </div>
                </div>
            </a>

            {{-- NAV ITEMS --}}
            <div class="flex items-center gap-4">
                <a href="{{ route('posts.index') }}" class="w-12 h-12 glass-card flex items-center justify-center text-xl hover:bg-sky-50 transition-all" title="Home">
                    🏠
                </a>
                
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="w-12 h-12 glass-card flex items-center justify-center text-xl hover:bg-sky-50" title="Admin">
                        ⚙️
                    </a>
                @elseif(auth()->user()->role === 'professeur')
                    <a href="{{ route('professor.dashboard') }}" class="w-12 h-12 glass-card flex items-center justify-center text-xl hover:bg-sky-50" title="Professor">
                        👨‍🏫
                    </a>
                @else
                    <a href="{{ route('student.dashboard') }}" class="w-12 h-12 glass-card flex items-center justify-center text-xl hover:bg-sky-50" title="Student">
                        🎓
                    </a>
                @endif

                <a href="{{ route('messages.index') }}" class="w-12 h-12 glass-card flex items-center justify-center text-xl hover:bg-sky-50" title="Messages">
                    ✉️
                </a>
                <a href="{{ route('posts.create') }}" class="w-12 h-12 glass-card flex items-center justify-center text-xl hover:bg-sky-50" title="Create Post">
                    ✨
                </a>
                <a href="{{ route('notifications.index') }}" class="w-12 h-12 glass-card flex items-center justify-center text-xl hover:bg-sky-50" title="Notifications">
                    🔔
                </a>

                <div class="h-8 w-[1px] bg-white/40 mx-2"></div>

                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 glass-card pl-2 pr-4 py-2 hover:bg-white/60">
                    <div class="w-10 h-10 rounded-xl bg-sky-100 flex items-center justify-center font-black text-sky-600 text-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="hidden sm:block">
                        <div class="text-xs font-black text-slate-900 leading-none">
                            {{ auth()->user()->name }}
                        </div>
                        <div class="text-[10px] font-bold text-slate-400 capitalize">
                            {{ auth()->user()->role }}
                        </div>
                    </div>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="w-12 h-12 glass-card flex items-center justify-center text-xl hover:bg-rose-50 hover:text-rose-500" title="Logout">
                        👋
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>