<x-app-layout>
    <div class="min-h-screen bg-[#fff8df] py-10">
        <div class="max-w-3xl mx-auto px-6">
            <div class="bg-white rounded-2xl shadow p-6">
                <h1 class="text-2xl font-bold mb-2">{{ $post->user->name }}</h1>

                <p class="text-sm text-gray-500 mb-4">
                    {{ $post->created_at->diffForHumans() }}
                </p>

                <p class="text-gray-700 mb-6">
                    {{ $post->contenu }}
                </p>

                <a href="{{ route('posts.index') }}" class="text-orange-500">
                    ← Retour aux posts
                </a>
            </div>
        </div>
    </div>
</x-app-layout>