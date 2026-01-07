<!-- Page Title -->
<div class="mb-10">
    <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-2">Reports & Complaints</h1>
    <p class="text-slate-500 font-medium">Monitor user flags, system error reports, and worker complaints.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
    <!-- Quick Stats -->
    @foreach([
        ['label' => 'Open Tickets', 'value' => '0', 'color' => 'brand'],
        ['label' => 'Pending Flags', 'value' => '0', 'color' => 'amber'],
        ['label' => 'Resolved', 'value' => '0', 'color' => 'emerald'],
    ] as $stat)
    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">{{ $stat['label'] }}</p>
        <h4 class="text-3xl font-black text-{{ $stat['color'] === 'brand' ? 'brand-600' : ($stat['color'] === 'amber' ? 'amber-600' : 'emerald-600') }} tracking-tight">{{ $stat['value'] }}</h4>
    </div>
    @endforeach
</div>

<!-- Main Reports Table -->
<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden min-h-[400px] flex flex-col items-center justify-center text-center p-20">
    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mb-6">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
    </div>
    <h3 class="text-xl font-black text-slate-900 mb-2">System Tranquility</h3>
    <p class="text-slate-400 text-sm font-medium max-w-xs">There are no active reports or complaints to process at this time. Everything is running smoothly!</p>
</div>
