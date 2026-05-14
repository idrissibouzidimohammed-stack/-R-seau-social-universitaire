<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Dashboard Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-black text-slate-900 mb-2">Student <span class="text-orange-500">Dashboard</span></h1>
            <p class="text-slate-500">Welcome back, {{ auth()->user()->name }}! Here's your academic overview.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Stats Cards -->
            <div class="bg-white/70 backdrop-blur-xl border border-white/20 p-8 rounded-[2rem] shadow-xl shadow-orange-500/5 flex flex-col justify-between hover:scale-[1.02] transition-transform">
                <div class="text-orange-500 text-4xl mb-4">📚</div>
                <div>
                    <h3 class="text-slate-400 font-medium uppercase tracking-wider text-xs mb-1">Courses</h3>
                    <p class="text-3xl font-bold text-slate-900">12</p>
                </div>
            </div>

            <div class="bg-white/70 backdrop-blur-xl border border-white/20 p-8 rounded-[2rem] shadow-xl shadow-orange-500/5 flex flex-col justify-between hover:scale-[1.02] transition-transform">
                <div class="text-blue-500 text-4xl mb-4">📝</div>
                <div>
                    <h3 class="text-slate-400 font-medium uppercase tracking-wider text-xs mb-1">Assignments</h3>
                    <p class="text-3xl font-bold text-slate-900">4 Pending</p>
                </div>
            </div>

            <div class="bg-white/70 backdrop-blur-xl border border-white/20 p-8 rounded-[2rem] shadow-xl shadow-orange-500/5 flex flex-col justify-between hover:scale-[1.02] transition-transform">
                <div class="text-purple-500 text-4xl mb-4">📅</div>
                <div>
                    <h3 class="text-slate-400 font-medium uppercase tracking-wider text-xs mb-1">Next Class</h3>
                    <p class="text-xl font-bold text-slate-900">Web Dev @ 2 PM</p>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-12">
            <!-- Recent Activity -->
            <div class="bg-white/40 backdrop-blur-md border border-white/10 rounded-[2.5rem] p-8 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-slate-900">Recent Activity</h2>
                    <button class="text-orange-500 font-bold hover:underline">View All</button>
                </div>
                <div class="space-y-6">
                    @for($i = 0; $i < 4; $i++)
                    <div class="flex items-center gap-4 group">
                        <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center text-orange-600 font-bold group-hover:bg-orange-500 group-hover:text-white transition-colors">
                            A
                        </div>
                        <div>
                            <p class="font-bold text-slate-900">Assignment Submitted</p>
                            <p class="text-sm text-slate-500">Advanced PHP Frameworks • 2h ago</p>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

            <!-- Notifications / Messages -->
            <div class="bg-white/40 backdrop-blur-md border border-white/10 rounded-[2.5rem] p-8 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-slate-900">Announcements</h2>
                    <span class="bg-red-500 text-white text-[10px] font-black px-2 py-1 rounded-full uppercase">New</span>
                </div>
                <div class="space-y-4">
                    <div class="p-6 rounded-3xl bg-gradient-to-r from-orange-500 to-orange-400 text-white shadow-lg shadow-orange-500/20">
                        <h4 class="font-bold mb-1">Exam Schedule Released</h4>
                        <p class="text-orange-50 text-sm">Check the downloads section for the full PDF of S2 exams.</p>
                    </div>
                    <div class="p-6 rounded-3xl bg-white border border-slate-100">
                        <h4 class="font-bold text-slate-900 mb-1">New Study Group</h4>
                        <p class="text-slate-500 text-sm">Join the "Machine Learning 101" group created by Prof. Amrani.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
