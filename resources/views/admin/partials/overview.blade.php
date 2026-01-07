<!-- Page Title -->
<div class="mb-10">
    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight mb-2">Dashboard Overview</h1>
    <p class="text-slate-500 dark:text-slate-400 font-medium">Welcome back! Here's what's happening with KaziLink today.</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    ] as $item)
    <div class="stat-card bg-white dark:bg-slate-800 p-8 rounded-[2rem] border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-xl transition-all">
        <div class="flex items-center justify-between mb-6">
            <div class="w-14 h-14 bg-{{ $item['color'] }}-50 rounded-2xl flex items-center justify-center text-{{ $item['color'] }}-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" />
                </svg>
            </div>
            <span class="text-[11px] font-black px-3 py-1 bg-{{ str_contains($item['prev'], '+') ? 'emerald' : 'rose' }}-50 text-{{ str_contains($item['prev'], '+') ? 'emerald' : 'rose' }}-600 rounded-full">
                {{ $item['prev'] }}
            </span>
        </div>
        </div>
        <p class="text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">{{ $item['label'] }}</p>
        <h4 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">{{ is_numeric($item['value']) ? number_format($item['value']) : $item['value'] }}</h4>
    </div>
    @endforeach
</div>

<!-- Charts Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
    <!-- User Growth Chart -->
    <div class="bg-white dark:bg-slate-800 p-8 rounded-[2.5rem] border border-slate-100 dark:border-slate-700 shadow-sm">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h3 class="text-lg font-black text-slate-900 dark:text-white tracking-tight">User Growth</h3>
                <p class="text-[11px] text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest">Last 7 Days Performance</p>
            </div>
            <select class="text-xs font-bold bg-slate-50 dark:bg-slate-700 border-none rounded-xl focus:ring-brand-500/20 text-slate-600 dark:text-slate-300">
                <option>Weekly</option>
                <option>Monthly</option>
            </select>
        </div>
        <div class="relative h-64 w-full">
            <canvas id="userChart"></canvas>
        </div>
    </div>

    <!-- Revenue Trend Chart -->
    <div class="bg-white dark:bg-slate-800 p-6 rounded-[2.5rem] border border-slate-100 dark:border-slate-700 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-black text-slate-900 dark:text-white tracking-tight">Revenue Trends</h3>
                <p class="text-[11px] text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest">Monthly Earnings Overview</p>
            </div>
            <div class="flex items-center space-x-2">
                <span class="w-3 h-3 bg-brand-500 rounded-full"></span>
                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Active Subs</span>
            </div>
        </div>
        <div class="relative h-64 w-full">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Recent Workers Table -->
    <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-[2.5rem] border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-50 dark:border-slate-700 flex items-center justify-between">
            <h3 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-wider">New Registrations</h3>
            <a href="?view=workers" class="text-[11px] font-bold text-brand-600 hover:text-brand-700 uppercase tracking-widest">See All Workers</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 dark:bg-slate-700/50">
                        <th class="px-8 py-4 text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Worker</th>
                        <th class="px-8 py-4 text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Category</th>
                        <th class="px-8 py-4 text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Status</th>
                        <th class="px-8 py-4 text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                    @foreach($recentWorkers as $worker)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/50 transition-colors">
                        <td class="px-8 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-300 font-black overflow-hidden mr-4 text-xs border border-slate-200 dark:border-slate-600">
                                    @if($worker->user->avatar)
                                        <img src="{{ asset('storage/' . $worker->user->avatar) }}" class="w-full h-full object-cover">
                                    @else
                                        {{ substr($worker->user->name, 0, 1) }}
                                    @endif
                                </div>
                                <div>
                                    <p class="text-[13px] font-bold text-slate-900 dark:text-white">{{ $worker->user->name }}</p>
                                    <p class="text-[10px] text-slate-500 dark:text-slate-400 font-medium">{{ $worker->district }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-4">
                            <span class="text-[11px] font-bold text-slate-600 dark:text-slate-300">{{ $worker->category->name }}</span>
                        </td>
                        <td class="px-8 py-4">
                            <span class="px-3 py-1 bg-{{ $worker->status === 'verified' ? 'emerald' : ($worker->status === 'pending' ? 'amber' : 'rose') }}-50 text-{{ $worker->status === 'verified' ? 'emerald' : ($worker->status === 'pending' ? 'amber' : 'rose') }}-600 text-[9px] font-black uppercase tracking-widest rounded-full">
                                {{ $worker->status }}
                            </span>
                        </td>
                        <td class="px-8 py-4">
                            <button class="p-2 hover:bg-slate-100 rounded-lg text-slate-400 hover:text-brand-500 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Security Logs -->
    <div class="bg-white dark:bg-slate-800 rounded-[2.5rem] border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-50 dark:border-slate-700 flex items-center justify-between">
            <h3 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-wider">System Activity</h3>
        </div>
        <div class="p-8 space-y-6">
            @foreach($recentLogs as $log)
            <div class="flex items-start space-x-4">
                <div class="w-2 h-2 mt-1.5 rounded-full {{ str_contains($log->action, 'Created') ? 'bg-emerald-500' : (str_contains($log->action, 'Deleted') ? 'bg-rose-500' : 'bg-brand-500') }} shrink-0"></div>
                <div>
                    <p class="text-[13px] font-bold text-slate-900 dark:text-white leading-snug">{{ $log->action }}</p>
                    <p class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-widest mt-1">{{ $log->created_at->diffForHumans() }} • BY {{ explode(' ', $log->user->name)[0] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="px-8 py-6 border-t border-slate-50 dark:border-slate-700">
            <a href="?view=logs" class="block text-center text-[11px] font-black text-slate-400 hover:text-brand-600 uppercase tracking-[0.2em] transition-all">View Full Audit Log</a>
        </div>
    </div>
</div>

<!-- Chart Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctxUser = document.getElementById('userChart').getContext('2d');
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');

        const chartData = @json($chartData);
        const isDark = document.documentElement.classList.contains('dark');
        const gridColor = isDark ? '#334155' : '#f1f5f9';
        const tickColor = isDark ? '#64748b' : '#94a3b8';

        new Chart(ctxUser, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Registrations',
                    data: chartData.users,
                    borderColor: '#3b82f6',
                    borderWidth: 4,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#3b82f6',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    fill: true,
                    backgroundColor: (context) => {
                        const gradient = context.chart.ctx.createLinearGradient(0, 0, 0, 400);
                        gradient.addColorStop(0, 'rgba(59, 130, 246, 0.1)');
                        gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');
                        return gradient;
                    },
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [5, 5], color: gridColor },
                        ticks: { font: { weight: 'bold', size: 10 }, color: tickColor }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { weight: 'bold', size: 10 }, color: tickColor }
                    }
                }
            }
        });

        new Chart(ctxRevenue, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Revenue',
                    data: chartData.revenue,
                    backgroundColor: '#3b82f6',
                    borderRadius: 8,
                    barThickness: 20
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [5, 5], color: gridColor },
                        ticks: { 
                            font: { weight: 'bold', size: 10 }, 
                            color: tickColor,
                            callback: function(value) { return 'TSh ' + value.toLocaleString(); }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { weight: 'bold', size: 10 }, color: tickColor }
                    }
                }
            }
        });
    });
</script>
