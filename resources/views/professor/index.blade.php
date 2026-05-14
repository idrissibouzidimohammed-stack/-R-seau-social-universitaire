<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Dashboard Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-black text-slate-900 mb-2">Professor <span class="text-blue-500">Portal</span></h1>
            <p class="text-slate-500">Manage your classes, students, and curriculum from your premium workspace.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Stats Cards -->
            <div class="bg-white/70 backdrop-blur-xl border border-white/20 p-6 rounded-[2rem] shadow-xl shadow-blue-500/5 flex flex-col justify-between hover:scale-[1.02] transition-transform">
                <div class="text-blue-500 text-3xl mb-4">👨‍🏫</div>
                <div>
                    <h3 class="text-slate-400 font-medium uppercase tracking-wider text-[10px] mb-1">Total Students</h3>
                    <p class="text-2xl font-bold text-slate-900">154</p>
                </div>
            </div>

            <div class="bg-white/70 backdrop-blur-xl border border-white/20 p-6 rounded-[2rem] shadow-xl shadow-blue-500/5 flex flex-col justify-between hover:scale-[1.02] transition-transform">
                <div class="text-green-500 text-3xl mb-4">📖</div>
                <div>
                    <h3 class="text-slate-400 font-medium uppercase tracking-wider text-[10px] mb-1">Active Courses</h3>
                    <p class="text-2xl font-bold text-slate-900">4</p>
                </div>
            </div>

            <div class="bg-white/70 backdrop-blur-xl border border-white/20 p-6 rounded-[2rem] shadow-xl shadow-blue-500/5 flex flex-col justify-between hover:scale-[1.02] transition-transform">
                <div class="text-red-500 text-3xl mb-4">📝</div>
                <div>
                    <h3 class="text-slate-400 font-medium uppercase tracking-wider text-[10px] mb-1">Pending Grades</h3>
                    <p class="text-2xl font-bold text-slate-900">28</p>
                </div>
            </div>

            <div class="bg-white/70 backdrop-blur-xl border border-white/20 p-6 rounded-[2rem] shadow-xl shadow-blue-500/5 flex flex-col justify-between hover:scale-[1.02] transition-transform">
                <div class="text-yellow-500 text-3xl mb-4">💬</div>
                <div>
                    <h3 class="text-slate-400 font-medium uppercase tracking-wider text-[10px] mb-1">New Messages</h3>
                    <p class="text-2xl font-bold text-slate-900">12</p>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-12">
            <!-- Classes List -->
            <div class="lg:col-span-2 bg-white/40 backdrop-blur-md border border-white/10 rounded-[2.5rem] p-8 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-slate-900">Upcoming Lectures</h2>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-bold shadow-lg shadow-blue-500/20 hover:bg-blue-700 transition-colors">Add Lecture</button>
                </div>
                <div class="space-y-4">
                    @php
                        $lectures = [
                            ['title' => 'Advanced Database Systems', 'time' => '10:00 AM - 12:00 PM', 'room' => 'Lab 4', 'color' => 'blue'],
                            ['title' => 'Software Engineering', 'time' => '02:00 PM - 04:00 PM', 'room' => 'Hall A', 'color' => 'indigo'],
                        ];
                    @endphp
                    @foreach($lectures as $lecture)
                    <div class="flex items-center justify-between p-6 rounded-3xl bg-white/50 border border-slate-100 group hover:border-{{ $lecture['color'] }}-200 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-{{ $lecture['color'] }}-100 flex items-center justify-center text-{{ $lecture['color'] }}-600">
                                <span class="text-2xl">⚡</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900">{{ $lecture['title'] }}</h4>
                                <p class="text-sm text-slate-500">{{ $lecture['time'] }} • {{ $lecture['room'] }}</p>
                            </div>
                        </div>
                        <button class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center hover:bg-{{ $lecture['color'] }}-500 hover:text-white transition-all">
                            →
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white/40 backdrop-blur-md border border-white/10 rounded-[2.5rem] p-8 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Quick Tools</h2>
                <div class="grid grid-cols-2 gap-4">
                    <button class="p-6 rounded-3xl bg-slate-900 text-white flex flex-col items-center gap-2 hover:bg-slate-800 transition-colors">
                        <span class="text-2xl">📋</span>
                        <span class="text-[10px] font-bold uppercase tracking-widest">Attendance</span>
                    </button>
                    <button class="p-6 rounded-3xl bg-white border border-slate-200 text-slate-900 flex flex-col items-center gap-2 hover:border-blue-500 transition-colors">
                        <span class="text-2xl">🏆</span>
                        <span class="text-[10px] font-bold uppercase tracking-widest">Grades</span>
                    </button>
                    <button class="p-6 rounded-3xl bg-white border border-slate-200 text-slate-900 flex flex-col items-center gap-2 hover:border-blue-500 transition-colors">
                        <span class="text-2xl">📂</span>
                        <span class="text-[10px] font-bold uppercase tracking-widest">Files</span>
                    </button>
                    <button class="p-6 rounded-3xl bg-white border border-slate-200 text-slate-900 flex flex-col items-center gap-2 hover:border-blue-500 transition-colors">
                        <span class="text-2xl">✉️</span>
                        <span class="text-[10px] font-bold uppercase tracking-widest">Blast</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
