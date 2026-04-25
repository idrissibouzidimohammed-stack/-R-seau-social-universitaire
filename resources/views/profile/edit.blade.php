<x-app-layout>
    <div class="max-w-[700px] mx-auto py-10 px-4">
        
        <div class="card bg-white overflow-hidden">
            <div class="flex flex-col md:flex-row h-full">
                
                {{-- Sidebar --}}
                <div class="w-full md:w-1/3 border-b md:border-b-0 md:border-r border-slate-100 flex flex-col">
                    <button class="p-6 text-left border-l-2 border-black font-bold text-sm">Modifier le profil</button>
                    <button class="p-6 text-left border-l-2 border-transparent text-slate-500 hover:bg-slate-50 text-sm">Changer le mot de passe</button>
                    <button class="p-6 text-left border-l-2 border-transparent text-rose-500 hover:bg-slate-50 text-sm">Supprimer le compte</button>
                </div>

                {{-- Content Area --}}
                <div class="flex-grow p-10 space-y-12">
                    
                    {{-- Avatar Section --}}
                    <div class="flex items-center gap-6 mb-10">
                        <img class="w-10 h-10 rounded-full border border-slate-200 object-cover" 
                             src="{{ auth()->user()->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&color=000&background=F1F5F9&size=40' }}" 
                             alt="Avatar">
                        <div class="flex flex-col">
                            <span class="text-lg font-bold leading-tight">{{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <input type="file" name="photo" id="photo_input" class="hidden" onchange="this.form.submit()">
                                <label for="photo_input" class="text-blue-500 text-xs font-bold cursor-pointer hover:text-blue-600 transition-colors">Modifier la photo de profil</label>
                            </form>
                        </div>
                    </div>

                    {{-- Original Forms --}}
                    <div class="instagram-form-fix">
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <hr class="border-slate-100">

                    <div class="instagram-form-fix">
                        @include('profile.partials.update-password-form')
                    </div>

                    <hr class="border-slate-100 pt-8">

                    <div class="instagram-form-fix opacity-50 hover:opacity-100 transition-opacity">
                         <h3 class="text-sm font-bold text-rose-500 mb-4 uppercase tracking-widest">Zone critique</h3>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Instagram-like styling for Breeze partials */
        .instagram-form-fix input, .instagram-form-fix textarea, .instagram-form-fix select {
            background-color: #ffffff !important;
            border: 1px solid #dbdbdb !important;
            border-radius: 4px !important;
            padding: 8px 12px !important;
            color: #262626 !important;
            font-size: 14px !important;
            width: 100% !important;
        }
        .instagram-form-fix input:focus {
            border-color: #a8a8a8 !important;
            box-shadow: none !important;
            ring: 0 !important;
        }
        .instagram-form-fix label {
            color: #262626 !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            margin-bottom: 8px !important;
            display: block !important;
        }
        .instagram-form-fix button[type="submit"] {
            background-color: #0095f6 !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            font-size: 14px !important;
            border-radius: 8px !important;
            padding: 6px 16px !important;
            transition: all 0.2s !important;
            width: auto !important;
        }
        .instagram-form-fix button[type="submit"]:hover {
            background-color: #1877f2 !important;
        }
        .instagram-form-fix .text-danger, .instagram-form-fix .text-red-600 {
            color: #ed4956 !important;
            font-size: 11px !important;
        }
    </style>
</x-app-layout>
