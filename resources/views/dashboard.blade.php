<x-app-layout>
    <x-slot name="header">
        {{ __('Command Center') }}
    </x-slot>

    <div class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Bento Grid Header -->
            <div class="mb-12" data-aos="fade-down">
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white uppercase tracking-tighter leading-none mb-4">
                    COMMAND <span class="gradient-text">CENTER</span>
                </h2>
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.4em]">Protocol Active • Secure Uplink Established</p>
            </div>

            @if(Auth::user()->role === 'worker')
                <!-- Worker Bento Layout -->
                <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    
                    <!-- Welcome / Identity Card (Large) -->
                    <div class="col-span-1 md:col-span-4 glass-card rounded-[3rem] p-12 relative overflow-hidden group" data-aos="fade-up">
                        <div class="relative z-10">
                            <h3 class="text-3xl font-black text-slate-900 dark:text-white mb-6 tracking-tight uppercase">Welcome, Maestro <span class="gradient-text">{{ explode(' ', Auth::user()->name)[0] }}</span></h3>
                            <p class="text-slate-500 dark:text-slate-400 font-medium text-sm leading-relaxed max-w-xl mb-10">Your digital presence is active. You are currently visible to clients seeking elite {{ strtolower(Auth::user()->workerProfile->category->name) }} services.</p>
                            
                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('worker.show', Auth::user()->workerProfile) }}" class="px-8 py-4 bg-brand-500/10 text-brand-500 border border-brand-500/20 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-brand-500 hover:text-white transition-all">Live Dossier</a>
                                <a href="{{ route('worker.edit') }}" class="px-8 py-4 bg-white/5 text-slate-400 border border-white/10 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">Alter Identity</a>
                            </div>
                        </div>
                        <div class="absolute top-0 right-0 w-80 h-80 bg-brand-500/10 rounded-full -mr-24 -mt-24 blur-3xl group-hover:bg-brand-500/20 transition-all duration-700"></div>
                    </div>

                    <!-- Stat Card: Pro Rating (Small) -->
                    <div class="col-span-1 md:col-span-2 glass-card rounded-[3rem] p-8 flex flex-col justify-between group hover:border-amber-500/30 transition-all duration-500" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-12 h-12 bg-amber-500/10 rounded-2xl flex items-center justify-center text-amber-500 mb-6 border border-amber-500/20 group-hover:bg-amber-500 group-hover:text-white transition-all">
                            <span class="text-xl font-black">★</span>
                        </div>
                        <div>
                            <h4 class="text-3xl font-black text-slate-900 dark:text-white">{{ number_format(Auth::user()->workerProfile->averageRating(), 1) }}</h4>
                            <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mt-2">Elite Merit Score</p>
                        </div>
                    </div>

                    <!-- Stat Card: Category (Small) -->
                    <div class="col-span-1 md:col-span-2 lg:col-span-2 glass-card rounded-[3rem] p-8 flex flex-col justify-between group hover:border-brand-500/30 transition-all duration-500" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-12 h-12 bg-brand-500/10 rounded-2xl flex items-center justify-center text-brand-500 mb-6 border border-brand-500/20 group-hover:bg-brand-500 group-hover:text-white transition-all">
                            <span class="text-xl font-black">⊕</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-black text-slate-900 dark:text-white tracking-tighter uppercase line-clamp-1">{{ Auth::user()->workerProfile->category->name }}</h4>
                            <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mt-2">Niche Sector</p>
                        </div>
                    </div>

                    <!-- Work Requests Feed (Medium) -->
                    <div class="col-span-1 md:col-span-4 glass-card rounded-[3rem] p-10" data-aos="fade-up">
                        <div class="flex items-center justify-between mb-10 border-b border-white/5 pb-6">
                            <h4 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-[0.2em]">Incoming Requests</h4>
                            <a href="{{ route('job-requests.index') }}" class="text-[9px] font-black text-brand-500 uppercase tracking-widest">Archive &rarr;</a>
                        </div>
                        
                        <div class="space-y-6">
                            @forelse(Auth::user()->receivedJobRequests()->latest()->take(3)->get() as $request)
                                <div class="flex items-center justify-between p-6 bg-white/5 rounded-2xl border border-white/10 hover:border-brand-500/20 transition-all">
                                    <div class="flex items-center gap-6">
                                        <div class="w-10 h-10 rounded-xl bg-brand-500/10 flex items-center justify-center text-brand-500 font-black text-xs">
                                            {{ substr($request->client->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-xs font-black text-slate-900 dark:text-white uppercase">{{ $request->client->name }}</p>
                                            <p class="text-[10px] text-slate-500 font-medium">TZS {{ number_format($request->budget) }} • {{ $request->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <span class="px-4 py-1.5 bg-slate-900 dark:bg-slate-800 text-white text-[8px] font-black uppercase tracking-widest rounded-full">
                                        {{ $request->status }}
                                    </span>
                                </div>
                            @empty
                                <div class="py-12 text-center">
                                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest">No active requests found</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Analytics Section (Medium/Large) -->
                    <div class="col-span-1 md:col-span-4 lg:col-span-2 glass-card rounded-[3rem] p-10" data-aos="fade-up">
                        <h4 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-[0.2em] mb-10">Network Pulse</h4>
                        <div class="relative h-64">
                            <canvas id="ratingChart"></canvas>
                        </div>
                        <div class="mt-8 pt-8 border-t border-white/5">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Profile Views</span>
                                <span class="text-xs font-black text-slate-900 dark:text-white">Active</span>
                            </div>
                            <div class="w-full bg-white/5 rounded-full h-1">
                                <div class="bg-brand-500 h-1 rounded-full w-2/3"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Messages Feed (Medium) -->
                    <div class="col-span-1 md:col-span-6 glass-card rounded-[3.5rem] p-12" data-aos="fade-up">
                        <div class="flex items-center justify-between mb-10 border-b border-white/5 pb-8">
                            <h4 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-[0.2em]">Secure Communications</h4>
                            <a href="{{ route('messages.index') }}" class="text-[9px] font-black text-brand-500 uppercase tracking-widest">Terminal &rarr;</a>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse(Auth::user()->receivedMessages()->latest()->take(3)->get() as $msg)
                                <div class="group p-8 bg-white/5 rounded-[2.5rem] border border-white/10 hover:border-brand-500/20 transition-all relative overflow-hidden">
                                    <div class="flex items-center gap-4 mb-6">
                                        <div class="w-10 h-10 rounded-full bg-brand-500/10 flex items-center justify-center text-brand-500 font-black text-xs">
                                            {{ substr($msg->sender->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-slate-900 dark:text-white uppercase tracking-tighter">{{ $msg->sender->name }}</p>
                                            <p class="text-[9px] text-slate-500 font-bold">{{ $msg->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 italic line-clamp-2 mb-6">"{{ $msg->body }}"</p>
                                    <a href="{{ route('messages.show', $msg->sender_id) }}" class="text-[9px] font-black text-brand-500 uppercase tracking-widest group-hover:translate-x-2 transition-transform inline-block">Respond Protocol &rarr;</a>
                                </div>
                            @empty
                                <div class="col-span-3 py-16 text-center opacity-30 grayscale">
                                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">No communication history detected</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            @else
                <!-- Client/User Bento Layout -->
                <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    
                    <!-- Welcome Card (Large) -->
                    <div class="col-span-1 md:col-span-4 glass-card rounded-[3rem] p-16 relative overflow-hidden group" data-aos="fade-up">
                        <div class="relative z-10">
                            <h3 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-8 tracking-tighter uppercase leading-none">AWAITING YOUR <br/><span class="gradient-text">DIRECTION.</span></h3>
                            <p class="text-slate-500 dark:text-slate-400 font-medium text-base leading-relaxed max-w-xl mb-12">Search Tanzanian elite social workers or finalize your pending work requests from this command portal.</p>
                            
                            <div class="flex flex-wrap gap-6">
                                <a href="{{ route('search.index') }}" class="premium-button px-10 py-5 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] shadow-xl">Source Talent</a>
                                @if(!Auth::user()->workerProfile)
                                    <a href="{{ route('worker.create') }}" class="px-10 py-5 bg-white/5 text-slate-400 border border-white/10 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">Become an Expert</a>
                                @endif
                            </div>
                        </div>
                        <div class="absolute top-0 right-0 w-96 h-96 bg-brand-500/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
                    </div>

                    <!-- Active Requests Counter (Small) -->
                    <div class="col-span-1 md:col-span-2 glass-card rounded-[3rem] p-10 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-12 h-12 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-500 mb-6 border border-emerald-500/20">
                            <span class="text-xl font-black">⚡</span>
                        </div>
                        <div>
                            <h4 class="text-4xl font-black text-slate-900 dark:text-white">{{ Auth::user()->sentJobRequests()->count() }}</h4>
                            <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mt-2">Active Operations</p>
                        </div>
                    </div>

                     <!-- Recent Activity (Medium) -->
                     <div class="col-span-1 md:col-span-6 glass-card rounded-[3.5rem] p-12" data-aos="fade-up">
                        <div class="flex items-center justify-between mb-10 border-b border-white/5 pb-8">
                            <h4 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-[0.2em]">Recent Activity Feed</h4>
                            <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Live Updates</p>
                        </div>
                        
                        <div class="space-y-4">
                            @forelse(Auth::user()->sentJobRequests()->latest()->take(5)->get() as $request)
                                <div class="flex items-center justify-between p-6 bg-white/5 rounded-2xl border border-white/10">
                                    <div class="flex items-center gap-6">
                                        <div class="w-10 h-10 rounded-xl bg-brand-500/10 flex items-center justify-center text-brand-500 font-black text-xs">J</div>
                                        <div>
                                            <p class="text-[10px] font-black text-slate-900 dark:text-white uppercase tracking-widest">Job Request Sent to <span class="text-brand-500">{{ $request->worker->name }}</span></p>
                                            <p class="text-[9px] text-slate-500 font-bold uppercase">{{ $request->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <span class="text-[9px] font-black text-slate-400 uppercase">{{ $request->status }}</span>
                                </div>
                            @empty
                                <div class="py-16 text-center opacity-30">
                                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">System standby • No activity detected</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Theme Colors
            const isDark = document.documentElement.classList.contains('dark');
            const gridColor = isDark ? '#334155' : '#f1f5f9';
            const textColor = isDark ? '#94a3b8' : '#64748b';

            // Data from Controller
            @if(Auth::user()->role === 'worker' && isset($charts))
                const ratingData = @json($charts['ratings']);
                const activityData = @json($charts['activity']);

                // Rating Chart
                const ctxRating = document.getElementById('ratingChart').getContext('2d');
                new Chart(ctxRating, {
                    type: 'doughnut',
                    data: {
                        labels: ['5 Stars', '4 Stars', '3 Stars', '2 Stars', '1 Star'],
                        datasets: [{
                            data: ratingData.data, // [5, 2, 1, 0, 0]
                            backgroundColor: ['#3b82f6', '#60a5fa', '#93c5fd', '#bfdbfe', '#e2e8f0'],
                            borderWidth: 0,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%',
                        plugins: {
                            legend: {
                                position: 'right',
                                labels: { color: textColor, font: { family: "'Inter', sans-serif", size: 11 } }
                            }
                        }
                    }
                });

                // Activity Chart
                const ctxActivity = document.getElementById('activityChart').getContext('2d');
                new Chart(ctxActivity, {
                    type: 'line',
                    data: {
                        labels: activityData.labels,
                        datasets: [
                            {
                                label: 'Profile Views',
                                data: activityData.views,
                                borderColor: '#3b82f6',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                borderWidth: 3,
                                tension: 0.4,
                                fill: true,
                                pointBackgroundColor: '#ffffff',
                                pointBorderColor: '#3b82f6',
                                pointBorderWidth: 2,
                                pointRadius: 4
                            },
                            {
                                label: 'Interactions',
                                data: activityData.interactions,
                                borderColor: '#f59e0b',
                                backgroundColor: 'rgba(245, 158, 11, 0.05)',
                                borderWidth: 3,
                                tension: 0.4,
                                fill: true,
                                borderDash: [5, 5],
                                pointBackgroundColor: '#ffffff',
                                pointBorderColor: '#f59e0b',
                                pointBorderWidth: 2,
                                pointRadius: 4
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { labels: { color: textColor, usePointStyle: true, boxWidth: 6 } }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: gridColor, borderDash: [4, 4] },
                                ticks: { color: textColor, font: { size: 10 } }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { color: textColor, font: { size: 10 } }
                            }
                        }
                    }
                });
            @endif
        });
    </script>
</x-app-layout>
