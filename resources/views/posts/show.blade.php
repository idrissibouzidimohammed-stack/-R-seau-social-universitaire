<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- BACK BUTTON --}}
        <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-slate-900 font-bold mb-10 transition-all group">
            <span class="w-10 h-10 rounded-full bg-white border border-slate-100 flex items-center justify-center group-hover:-translate-x-1 transition-transform">←</span>
            Back to Feed
        </a>

        <div class="bg-white/60 backdrop-blur-md border border-white/20 rounded-[2.5rem] shadow-sm overflow-hidden">
            <div class="p-10">
                {{-- HEADER --}}
                <div class="flex items-center gap-5 mb-10">
                    <div class="w-16 h-16 rounded-[1.5rem] bg-gradient-to-br from-orange-400 to-orange-500 flex items-center justify-center font-black text-white text-xl shadow-lg shadow-orange-500/20">
                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h1 class="text-2xl font-black text-slate-900">{{ $post->user->name }}</h1>
                        <p class="text-sm font-bold text-slate-400 tracking-widest uppercase">
                            {{ $post->created_at->format('M d, Y • H:i') }} ({{ $post->created_at->diffForHumans() }})
                        </p>
                    </div>
                </div>

                {{-- CONTENT --}}
                <div class="text-2xl text-slate-800 leading-relaxed font-medium mb-12">
                    {{ $post->contenu }}
                </div>

                {{-- INTERACTIONS --}}
                <div class="flex items-center gap-8 py-8 border-y border-slate-100/50">
                    <div class="flex items-center gap-3">
                        <form action="{{ route('posts.like', $post) }}" method="POST">
                            @csrf
                            <button class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center hover:bg-orange-500 hover:text-white transition-all shadow-sm">
                                🧡
                            </button>
                        </form>
                        <div class="leading-none">
                            <span class="text-xl font-black text-slate-900 block">{{ $post->likes->count() }}</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Likes</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400">
                            💬
                        </div>
                        <div class="leading-none">
                            <span class="text-xl font-black text-slate-900 block">{{ $post->comments->count() }}</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Comments</span>
                        </div>
                    </div>
                </div>

                {{-- COMMENTS SECTION --}}
                <div class="mt-12">
                    <h3 class="text-xl font-black text-slate-900 mb-8 flex items-center gap-3">
                        Discussion <span class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-xs text-slate-500">{{ $post->comments->count() }}</span>
                    </h3>

                    <div class="space-y-6 mb-12">
                        @foreach($post->comments as $comment)
                            <div class="flex gap-4 group">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 flex-shrink-0 flex items-center justify-center font-bold text-slate-400 text-xs">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <div class="bg-slate-50 rounded-2xl rounded-tl-none p-5 relative">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="font-black text-slate-900 text-sm">{{ $comment->user->name }}</span>
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-slate-600 text-sm leading-relaxed">{{ $comment->contenu }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- POST COMMENT --}}
                    <div class="sticky bottom-8 bg-white/80 backdrop-blur-xl border border-slate-100 rounded-3xl p-4 shadow-2xl">
                        <form action="{{ route('comments.store', $post) }}" method="POST" class="flex gap-4">
                            @csrf
                            <input name="contenu"
                                   placeholder="Add to the conversation..."
                                   class="flex-1 bg-transparent border-0 focus:ring-0 px-4 text-slate-700 font-medium"
                                   required>
                            <button class="bg-orange-500 text-white px-8 py-3 rounded-2xl font-black shadow-lg shadow-orange-500/20 hover:scale-105 transition-all">
                                Post
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>