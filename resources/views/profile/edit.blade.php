<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="mb-10 border-b border-green-900/30 pb-6">
            <h1 class="text-4xl font-extrabold text-green-500 tracking-tight flex items-center">
                <span class="mr-4">⚙️</span> Paramètres du Profil
            </h1>
            <p class="text-gray-500 mt-2">Gère tes informations personnelles et la sécurité de ton compte.</p>
        </div>

        <div class="space-y-12">
            {{-- PHOTO DE PROFIL --}}
            <div class="bg-gray-900/50 rounded-[2.5rem] shadow-2xl border border-green-900/20 p-8 sm:p-10 relative overflow-hidden group">
                <div class="absolute -top-12 -right-12 w-32 h-32 bg-green-500/5 rounded-full blur-2xl group-hover:bg-green-500/10 transition-all duration-500"></div>
                
                <h3 class="text-xl font-black text-gray-100 flex items-center gap-3 mb-8">
                    <span class="w-8 h-8 rounded-lg bg-green-500/10 flex items-center justify-center text-green-500 text-sm italic">01</span>
                    Photo de Profil
                </h3>

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="relative z-10 flex flex-col md:flex-row items-center gap-10">
                    @csrf
                    @method('PUT')

                    <div class="shrink-0 flex flex-col items-center gap-4">
                        <div class="w-32 h-32 rounded-full p-1 bg-gradient-to-tr from-green-500 to-green-900 shadow-xl shadow-green-500/10">
                             <img class="w-full h-full rounded-full border-4 border-gray-900 object-cover" 
                                  src="{{ auth()->user()->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&color=10B981&background=064E3B&size=128' }}" 
                                  alt="Preview">
                        </div>
                        <p class="text-[10px] text-gray-600 font-bold uppercase tracking-widest">Aperçu actuel</p>
                    </div>

                    <div class="flex-grow space-y-6">
                        <div class="relative group/input">
                            <input type="file" name="photo" id="photo_input" class="hidden">
                            <label for="photo_input" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-green-900/30 rounded-3xl cursor-pointer bg-black/30 hover:bg-black/50 hover:border-green-500/50 transition-all text-gray-500">
                                <svg class="w-8 h-8 mb-2 group-hover/input:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-sm font-bold uppercase tracking-tight">Choisir un fichier</span>
                                <span class="text-[10px] opacity-40 mt-1 uppercase">JPG, PNG (Max 2MB)</span>
                            </label>
                            
                            @error('photo')
                                <p class="text-red-500 text-xs mt-3 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="bg-green-500 hover:bg-green-400 text-black px-8 py-3 rounded-2xl font-black text-sm transition-all shadow-lg shadow-green-500/20 active:scale-95 uppercase tracking-widest">
                            Mettre à jour la photo
                        </button>
                    </div>
                </form>
            </div>

            {{-- INFORMATIONS GENERALES (Lazy load original forms with custom styling in their files if possible, or just overwrite here) --}}
            <div class="bg-gray-900/50 rounded-[2.5rem] shadow-2xl border border-green-900/20 p-8 sm:p-10 relative overflow-hidden group">
                <h3 class="text-xl font-black text-gray-100 flex items-center gap-3 mb-8">
                    <span class="w-8 h-8 rounded-lg bg-green-500/10 flex items-center justify-center text-green-500 text-sm italic">02</span>
                    Informations du Compte
                </h3>
                <div class="text-gray-300 dark-form-fix">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- MOT DE PASSE --}}
            <div class="bg-gray-900/50 rounded-[2.5rem] shadow-2xl border border-green-900/20 p-8 sm:p-10 relative overflow-hidden group">
                <h3 class="text-xl font-black text-gray-100 flex items-center gap-3 mb-8">
                    <span class="w-8 h-8 rounded-lg bg-green-500/10 flex items-center justify-center text-green-500 text-sm italic">03</span>
                    Sécurité
                </h3>
                <div class="text-gray-300 dark-form-fix">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- SUPPRESSION --}}
            <div class="bg-gray-900/50 rounded-[2.5rem] shadow-2xl border border-red-950/20 p-8 sm:p-10 relative overflow-hidden group">
                <h3 class="text-xl font-black text-red-500 flex items-center gap-3 mb-8">
                    <span class="w-8 h-8 rounded-lg bg-red-500/10 flex items-center justify-center text-red-500 text-sm italic font-black">!!</span>
                    Zone de Danger
                </h3>
                <div class="text-gray-300 dark-form-fix opacity-70 hover:opacity-100 transition-opacity">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Force styles on original partials without editing them individually yet */
        .dark-form-fix input {
            background-color: rgba(0, 0, 0, 0.4) !important;
            border-color: rgba(6, 78, 59, 0.3) !important;
            color: #d1d5db !important;
            border-radius: 1rem !important;
        }
        .dark-form-fix input:focus {
            border-color: #22c55e !important;
            box-shadow: 0 0 10px rgba(34, 197, 94, 0.1) !important;
        }
        .dark-form-fix label {
            color: #4b5563 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.1em !important;
            font-size: 0.75rem !important;
            font-weight: 700 !important;
        }
        .dark-form-fix button[type="submit"] {
            background-color: #22c55e !important;
            color: #000 !important;
            font-weight: 900 !important;
            border-radius: 1rem !important;
            padding: 0.75rem 2rem !important;
            transition: all 0.2s !important;
        }
        .dark-form-fix button[type="submit"]:hover {
            background-color: #4ade80 !important;
            transform: scale(1.02) !important;
        }
        .dark-form-fix .text-danger, .dark-form-fix .text-red-600 {
            color: #ef4444 !important;
        }
    </style>
</x-app-layout>
