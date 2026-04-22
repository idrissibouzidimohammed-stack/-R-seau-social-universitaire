<x-app-layout>
    <div class="max-w-3xl mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold mb-6">Créer un post</h1>

        <form action="{{ route('posts.store') }}" method="POST" class="bg-white shadow rounded p-6">
            @csrf

            <div class="mb-4">
                <label for="contenu" class="block font-medium mb-2">Contenu</label>
                <textarea name="contenu" id="contenu" rows="5" class="w-full border rounded p-3">{{ old('contenu') }}</textarea>
                @error('contenu')
                    <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Publier
            </button>
        </form>
    </div>
</x-app-layout>