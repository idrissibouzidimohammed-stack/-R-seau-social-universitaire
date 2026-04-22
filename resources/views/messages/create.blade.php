<x-app-layout>
    <div class="max-w-3xl mx-auto py-6 px-4">

        <h1 class="text-2xl font-bold mb-6">
            Envoyer un message à {{ $user->name }} {{ $user->prenom }}
        </h1>

        <form action="{{ route('messages.store', $user) }}" method="POST" class="bg-white shadow rounded p-6">
            @csrf

            <div class="mb-4">
                <label class="block font-medium mb-2">Message</label>

                <textarea name="contenu" rows="5" class="w-full border rounded p-3" placeholder="Écrire votre message..."></textarea>

                @error('contenu')
                    <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Envoyer
            </button>
        </form>

    </div>
</x-app-layout>