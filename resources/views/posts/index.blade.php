<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Feed Header -->
        <div class="mb-10 flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-black text-slate-900 leading-tight">Campus<span class="text-orange-500">Feed</span></h1>
                <p class="text-slate-500 font-medium">What's happening in your university today?</p>
            </div>
            <a href="{{ route('posts.create') }}" class="bg-slate-900 text-white px-8 py-4 rounded-[1.5rem] font-bold shadow-2xl shadow-slate-900/20 hover:scale-105 transition-all flex items-center gap-2">
                <span class="text-2xl leading-none">＋</span> Create Post
            </a>
        </div>

        {{-- SEARCH --}}
        <form action="{{ route('users.search') }}" method="GET" class="mb-12">
            <div class="bg-white/70 backdrop-blur-xl border border-white/20 rounded-[2rem] shadow-xl shadow-orange-500/5 p-2 flex gap-3 focus-within:ring-2 focus-within:ring-orange-500/20 transition-all">
                <div class="flex-1 flex items-center px-4 gap-3">
                    <span class="text-slate-400">🔍</span>
                    <input type="text"
                           name="q"
                           placeholder="Search for students or professors..."
                           class="w-full border-0 focus:ring-0 bg-transparent text-slate-700 placeholder:text-slate-300 font-medium">
                </div>
                <button class="bg-orange-500 text-white px-8 py-3 rounded-[1.5rem] font-bold">Search</button>
            </div>
        </form>

        {{-- POSTS --}}
        <div class="space-y-10">
            @forelse($posts as $post)
                <div class="bg-white/60 backdrop-blur-md border border-white/20 rounded-[2.5rem] shadow-sm overflow-hidden hover:shadow-xl hover:shadow-orange-500/5 transition-all duration-500 group">
                    <div class="p-8">
                        {{-- HEADER --}}
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200 border border-slate-200 flex items-center justify-center font-black text-slate-400">
                                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h2 class="font-black text-slate-900 text-lg group-hover:text-orange-500 transition-colors">
                                        {{ $post->user->name }}
                                    </h2>
                                    <p class="text-xs font-bold text-slate-400 tracking-widest uppercase">
                                        {{ $post->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            <div class="relative">
                                <button onclick="toggleMenu(event, {{ $post->id }})" class="w-10 h-10 rounded-full hover:bg-slate-100 flex items-center justify-center text-slate-400 font-bold transition-colors">
                                    ⋯
                                </button>
                                <div id="menu-{{ $post->id }}" class="hidden absolute right-0 mt-2 w-48 bg-white/90 backdrop-blur-xl border border-slate-100 rounded-3xl shadow-2xl z-50 p-2 overflow-hidden">
                                    <a href="{{ route('posts.show', $post) }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-slate-50 text-slate-600 font-bold text-sm transition-colors">
                                        <span>👁</span> View Post
                                    </a>
                                    @if(auth()->id() === $post->user_id)
                                        <a href="{{ route('posts.edit', $post) }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-slate-50 text-slate-600 font-bold text-sm transition-colors">
                                            <span>✏</span> Edit
                                        </a>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="mt-1">
                                            @csrf
                                            @method('DELETE')
                                            <button class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-red-50 text-red-500 font-bold text-sm transition-colors text-left">
                                                <span>🗑</span> Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- CONTENT --}}
                        <div class="text-slate-700 text-lg leading-relaxed mb-8">
                            {{ $post->contenu }}
                        </div>

                        {{-- INTERACTIONS --}}
                        <div class="flex items-center gap-6 pt-6 border-t border-slate-100/50">
                            <div class="flex items-center gap-2">
                                <form action="{{ route('posts.like', $post) }}" method="POST">
                                    @csrf
                                    <button class="w-12 h-12 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center hover:bg-orange-500 hover:text-white transition-all shadow-sm">
                                        🧡
                                    </button>
                                </form>
                                <span class="text-sm font-black text-slate-900 ml-1">{{ $post->likes->count() }}</span>
                            </div>

                            <a href="{{ route('posts.show', $post) }}" class="flex items-center gap-2 text-slate-400 hover:text-slate-900 transition-colors">
                                <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center">
                                    💬
                                </div>
                                <span class="text-sm font-bold">{{ $post->comments->count() }} Comments</span>
                            </a>
                        </div>
                    </div>

                    {{-- QUICK COMMENT --}}
                    <div class="bg-slate-50/50 p-6 border-t border-slate-100">
                        <form action="{{ route('comments.store', $post) }}" method="POST" class="flex gap-4">
                            @csrf
                            <input name="contenu"
                                   placeholder="Share your thoughts..."
                                   class="flex-1 bg-white border-slate-200 rounded-2xl px-6 focus:ring-orange-500/20 focus:border-orange-500 text-sm font-medium">
                            <button class="bg-white border border-slate-200 text-slate-900 w-12 h-12 rounded-2xl font-bold flex items-center justify-center hover:bg-slate-900 hover:text-white transition-all shadow-sm">
                                ↵
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white/40 backdrop-blur-md border-2 border-dashed border-slate-200 rounded-[3rem] p-20 text-center">
                    <div class="text-6xl mb-6">🏜</div>
                    <h3 class="text-xl font-black text-slate-900 mb-2">No posts yet</h3>
                    <p class="text-slate-500">Be the first to share something with the campus!</p>
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