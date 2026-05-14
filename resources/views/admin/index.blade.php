<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Dashboard Header -->
        <div class="mb-8 flex justify-between items-end">
            <div>
                <h1 class="text-4xl font-black text-slate-900 mb-2">System <span class="text-indigo-600">Admin</span></h1>
                <p class="text-slate-500">Comprehensive control over the CampusGram ecosystem.</p>
            </div>
            <div class="flex gap-4">
                <button class="bg-indigo-600 text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-indigo-500/20 hover:bg-indigo-700 transition-all">Export Logs</button>
                <button class="bg-slate-900 text-white px-6 py-3 rounded-2xl font-bold hover:bg-slate-800 transition-all">Settings</button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Global Stats -->
            <div class="bg-white/70 backdrop-blur-xl border border-white/20 p-6 rounded-[2rem] shadow-xl shadow-indigo-500/5">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-100 flex items-center justify-center text-indigo-600">👥</div>
                    <h3 class="text-slate-400 font-medium uppercase tracking-wider text-[10px]">Users</h3>
                </div>
                <p class="text-3xl font-bold text-slate-900">2,543</p>
                <p class="text-xs text-green-500 font-bold mt-2">+12 this week</p>
            </div>

            <div class="bg-white/70 backdrop-blur-xl border border-white/20 p-6 rounded-[2rem] shadow-xl shadow-indigo-500/5">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-purple-100 flex items-center justify-center text-purple-600">📝</div>
                    <h3 class="text-slate-400 font-medium uppercase tracking-wider text-[10px]">Posts</h3>
                </div>
                <p class="text-3xl font-bold text-slate-900">18,290</p>
                <p class="text-xs text-green-500 font-bold mt-2">+430 today</p>
            </div>

            <div class="bg-white/70 backdrop-blur-xl border border-white/20 p-6 rounded-[2rem] shadow-xl shadow-indigo-500/5">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center text-red-600">⚠️</div>
                    <h3 class="text-slate-400 font-medium uppercase tracking-wider text-[10px]">Reports</h3>
                </div>
                <p class="text-3xl font-bold text-slate-900">4</p>
                <p class="text-xs text-slate-400 mt-2">All resolved</p>
            </div>

            <div class="bg-white/70 backdrop-blur-xl border border-white/20 p-6 rounded-[2rem] shadow-xl shadow-indigo-500/5">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center text-green-600">🟢</div>
                    <h3 class="text-slate-400 font-medium uppercase tracking-wider text-[10px]">Server</h3>
                </div>
                <p class="text-3xl font-bold text-slate-900">Online</p>
                <p class="text-xs text-slate-400 mt-2">Latency: 42ms</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-12">
            <!-- User Management Preview -->
            <div class="bg-white/40 backdrop-blur-md border border-white/10 rounded-[2.5rem] p-8">
                <h2 class="text-xl font-bold text-slate-900 mb-6">User Management</h2>
                <div class="overflow-hidden">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">
                                <th class="pb-4">Name</th>
                                <th class="pb-4">Role</th>
                                <th class="pb-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @php
                                $users = [
                                    ['name' => 'Ahmed Alaoui', 'role' => 'Etudiant', 'status' => 'Active'],
                                    ['name' => 'Prof. Myriam', 'role' => 'Professeur', 'status' => 'Active'],
                                    ['name' => 'Yassine Ben', 'role' => 'Etudiant', 'status' => 'Active'],
                                ];
                            @endphp
                            @foreach($users as $user)
                            <tr class="group hover:bg-white/50 transition-colors">
                                <td class="py-4">
                                    <div class="font-bold text-slate-900">{{ $user['name'] }}</div>
                                </td>
                                <td class="py-4">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold {{ $user['role'] === 'Professeur' ? 'bg-blue-100 text-blue-600' : 'bg-orange-100 text-orange-600' }}">
                                        {{ $user['role'] }}
                                    </span>
                                </td>
                                <td class="py-4 text-right">
                                    <button class="text-slate-400 hover:text-slate-900 transition-colors">Manage</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- System Logs -->
            <div class="bg-white/40 backdrop-blur-md border border-white/10 rounded-[2.5rem] p-8">
                <h2 class="text-xl font-bold text-slate-900 mb-6">System Logs</h2>
                <div class="space-y-4 font-mono text-[11px]">
                    <div class="p-4 rounded-2xl bg-slate-900 text-indigo-300">
                        <span class="text-slate-500">[14:48:22]</span> Auth attempt: user_id=41 successful
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-900 text-indigo-300">
                        <span class="text-slate-500">[14:49:05]</span> Route hit: GET /admin/dashboard
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-900 text-indigo-300">
                        <span class="text-slate-500">[14:50:11]</span> Database migration completed: 2026_05_...
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
