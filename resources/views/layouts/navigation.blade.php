<nav class="bg-[#fff8df] border-b border-orange-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-24">

            {{-- LOGO --}}
            <a href="{{ route('posts.index') }}" class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center shadow">
        <span class="text-white font-bold text-xl">ü</span>
    </div>

    <!-- TEXT -->
    <div class="leading-tight">
        <div class="text-xl font-extrabold text-gray-900">
            Use<span class="text-orange-500">It</span>
        </div>
        <div class="text-xs text-gray-400 tracking-wide">
            social network
        </div>
    </div>

            </a>

            {{-- ICONS --}}
            <div class="flex items-center gap-6 text-3xl text-gray-900">
                <a href="{{ route('posts.index') }}" class="bg-yellow-100 p-3 rounded-2xl hover:bg-yellow-200">⌂</a>
                <a href="{{ route('messages.index') }}" class="hover:text-orange-500">☁</a>
                <a href="{{ route('posts.create') }}" class="hover:text-orange-500">＋</a>
                <a href="{{ route('notifications.index') }}" class="hover:text-orange-500">♡</a>

                <a href="{{ route('profile.edit') }}" class="w-12 h-12 rounded-full border border-orange-300 flex items-center justify-center text-base font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </a>
            </div>
        </div>
    </div>
</nav>