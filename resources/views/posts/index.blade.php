<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Feed Header -->
        <div class="mb-10 flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-black text-slate-900 leading-tight">Campus<span class="gradient-text">Feed</span></h1>
                <p class="text-slate-500 font-medium italic">What's happening in your university today?</p>
            </div>
            <a href="{{ route('posts.create') }}" class="btn-primary">
                ✨ Create Post
            </a>
        </div>

        {{-- SEARCH --}}
        <form action="{{ route('users.search') }}" method="GET" class="mb-12">
            <div class="glass-card p-2 flex gap-3 focus-within:ring-4 focus-within:ring-sky-500/10 transition-all">
                <div class="flex-1 flex items-center px-4 gap-3">
                    <span class="text-2xl">🔍</span>
                    <input type="text"
                           name="q"
                           placeholder="Search for students or professors..."
                           class="w-full border-0 focus:ring-0 bg-transparent text-slate-700 placeholder:text-slate-300 font-bold">
                </div>
                <button class="bg-sky-500 text-white px-8 py-3 rounded-[1.5rem] font-bold hover:bg-sky-600 transition-all shadow-lg shadow-sky-500/20">Search</button>
            </div>
        </form>

        {{-- POSTS --}}
        <div class="space-y-10">
            @forelse($posts as $post)
                <div class="glass-card overflow-hidden group">
                    <div class="p-8">
                        {{-- HEADER --}}
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-100 to-pink-50 border border-white/60 flex items-center justify-center font-black text-sky-400 text-xl shadow-inner">
                                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h2 class="font-black text-slate-900 text-lg group-hover:text-sky-600 transition-colors">
                                        {{ $post->user->name }}
                                    </h2>
                                    <p class="timestamp">
                                        {{ $post->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            <div class="relative">
                                <button onclick="toggleMenu(event, {{ $post->id }})" class="w-10 h-10 rounded-full hover:bg-white/40 flex items-center justify-center text-slate-400 font-black text-xl transition-colors">
                                    ⋮
                                </button>
                                <div id="menu-{{ $post->id }}" class="hidden absolute right-0 mt-2 w-48 bg-white/90 backdrop-blur-xl border border-white/40 rounded-3xl shadow-2xl z-50 p-2 overflow-hidden">
                                    <a href="{{ route('posts.show', $post) }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-sky-50 text-slate-600 font-bold text-sm transition-colors">
                                        <span>👁️</span> View Post
                                    </a>
                                    @if(auth()->id() === $post->user_id)
                                        <a href="{{ route('posts.edit', $post) }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-sky-50 text-slate-600 font-bold text-sm transition-colors">
                                            <span>✏️</span> Edit
                                        </a>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="mt-1">
                                            @csrf
                                            @method('DELETE')
                                            <button class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-rose-50 text-rose-500 font-bold text-sm transition-colors text-left">
                                                <span>🗑️</span> Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- CONTENT --}}
                        <div class="text-slate-700 text-lg leading-relaxed mb-8 font-medium">
                            {{ $post->contenu }}
                        </div>

                        {{-- INTERACTIONS --}}
                        <div class="flex items-center gap-6 pt-6 border-t border-white/20">
                            <div class="flex items-center gap-2">
                                <form action="{{ route('posts.like', $post) }}" method="POST">
                                    @csrf
                                    <button class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all shadow-sm group/like">
                                        ❤️
                                    </button>
                                </form>
                                <span class="text-sm font-black text-slate-900 ml-1">{{ $post->likes->count() }}</span>
                            </div>

                            <a href="{{ route('posts.show', $post) }}" class="flex items-center gap-2 text-slate-400 hover:text-sky-600 transition-colors">
                                <div class="w-12 h-12 rounded-2xl bg-sky-50 flex items-center justify-center text-xl">
                                    💬
                                </div>
                                <span class="text-sm font-black">{{ $post->comments->count() }} Comments</span>
                            </a>
                        </div>
                    </div>

                    {{-- QUICK COMMENT --}}
                    <div class="bg-white/30 p-6 border-t border-white/20">
                        <form action="{{ route('comments.store', $post) }}" method="POST" class="flex gap-4">
                            @csrf
                            <input name="contenu"
                                   placeholder="Share your thoughts..."
                                   class="flex-1 bg-white/50 border-white/40 rounded-2xl px-6 focus:ring-sky-500/20 focus:border-sky-300 text-sm font-bold placeholder-slate-300">
                            <button class="bg-sky-500 text-white w-12 h-12 rounded-2xl font-black flex items-center justify-center hover:bg-sky-600 transition-all shadow-lg shadow-sky-500/10">
                                ↵
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="glass-card border-2 border-dashed border-white/60 p-20 text-center">
                    <div class="text-7xl mb-6">🏜️</div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2">No posts yet</h3>
                    <p class="text-slate-500 font-bold">Be the first to share something with the campus!</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- SCRIPT MENU --}}
    <script>
        function toggleMenu(event, id) {
            event.stopPropagation();
            const allMenus = document.querySelectorAll('[id^="menu-"]');
            const targetMenu = document.getElementById('menu-' + id);
            
            allMenus.forEach(menu => {
                if (menu.id !== 'menu-' + id) menu.classList.add('hidden');
            });
            
            targetMenu.classList.toggle('hidden');
        }

        document.addEventListener('click', () => {
            document.querySelectorAll('[id^="menu-"]').forEach(menu => menu.classList.add('hidden'));
        });
    </script>
</x-app-layout>