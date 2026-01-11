<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs / Greeting -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-800">Karibu, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
                <p class="text-slate-500 mt-1">Tunatumaini umepata kazi nzuri!</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Active Jobs -->
                <div class="card-ui p-6 flex items-center bg-blue-50 border-blue-100" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex-grow">
                        <p class="text-xs font-semibold text-blue-600 uppercase tracking-wider mb-1">Active Jobs</p>
                        <h3 class="text-3xl font-bold text-blue-900">3</h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-600/10 rounded-xl flex items-center justify-center text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    </div>
                </div>

                <!-- Total Earnings -->
                <div class="card-ui p-6 flex items-center bg-white" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex-grow">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Earnings</p>
                        <h3 class="text-2xl font-bold text-slate-900">TZS 1,200,000</h3>
                    </div>
                    <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                </div>

                <!-- Pending Requests -->
                <div class="card-ui p-6 flex items-center bg-white">
                    <div class="flex-grow">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Pending Requests</p>
                        <h3 class="text-3xl font-bold text-slate-900">2</h3>
                    </div>
                    <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                </div>

                <!-- New Messages -->
                <div class="card-ui p-6 flex items-center bg-blue-600 text-white">
                    <div class="flex-grow">
                        <p class="text-xs font-semibold text-blue-100 uppercase tracking-wider mb-1">New Messages</p>
                        <h3 class="text-3xl font-bold">4</h3>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Chart Area -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="card-ui p-8">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h4 class="text-lg font-bold text-slate-900">Job Stats</h4>
                                <p class="text-sm text-slate-500">Jobs Completed: 18 • Rating: 4.8 ★</p>
                            </div>
                            <select class="bg-slate-100 border-none rounded-lg text-xs font-bold text-slate-600 px-4 py-2 focus:ring-blue-500">
                                <option>This Month</option>
                                <option>Last Month</option>
                            </select>
                        </div>
                        <div class="h-64">
                            <canvas id="jobStatsChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="space-y-6">
                    <div class="card-ui p-8">
                        <h4 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-6">Quick Actions</h4>
                        <div class="space-y-3">
                            <a href="{{ route('search.index') }}" class="btn-primary w-full">
                                Find Work
                            </a>
                            <a href="{{ route('job-requests.index') }}" class="btn-success w-full">
                                Manage Jobs
                            </a>
                            <button class="btn-warning w-full">
                                Withdraw Funds
                            </button>
                        </div>
                    </div>

                    <!-- Upgrade / Tip Card -->
                    <div class="card-ui p-8 bg-gradient-to-br from-slate-900 to-blue-900 text-white border-none">
                        <h4 class="text-lg font-bold mb-2">Upgrade to Pro</h4>
                        <p class="text-blue-200 text-xs mb-6">Get 2x more visibility and lower platform fees.</p>
                        <a href="{{ route('subscriptions.index') }}" class="inline-flex items-center text-xs font-bold text-white border-b-2 border-blue-400 pb-1 hover:text-blue-400 transition-colors">
                            View Plans &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('jobStatsChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Earnings',
                        data: [400000, 300000, 600000, 450000, 700000, 900000],
                        borderColor: '#2563eb',
                        backgroundColor: (context) => {
                            const chart = context.chart;
                            const {ctx, chartArea} = chart;
                            if (!chartArea) return null;
                            const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                            gradient.addColorStop(0, 'rgba(37, 99, 235, 0)');
                            gradient.addColorStop(1, 'rgba(37, 99, 235, 0.1)');
                            return gradient;
                        },
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#2563eb',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
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
                            grid: { color: '#f1f5f9' },
                            ticks: { 
                                color: '#94a3b8',
                                font: { size: 10 },
                                callback: (value) => 'TZS ' + value.toLocaleString()
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#94a3b8', font: { size: 10 } }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
