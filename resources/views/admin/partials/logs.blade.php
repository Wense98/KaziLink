<!-- Page Title -->
<div class="mb-10 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-2">Security Audit Trail</h1>
        <p class="text-slate-500 font-medium">Immutable record of every administrative action performed in the system.</p>
    </div>
    <div class="flex items-center space-x-3">
        <div class="bg-white px-6 py-3 rounded-2xl border border-slate-100 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Total Logs</p>
            <p class="text-xl font-bold text-slate-900 leading-none">{{ $logs->total() }}</p>
        </div>
    </div>
</div>

<!-- Logs Table -->
<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Timestamp</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Administrator</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Action Performed</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">IP Address</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap text-right">Resource Data</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($logs as $log)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-8 py-6">
                        <div class="flex flex-col">
                            <p class="text-[13px] font-bold text-slate-700">{{ $log->created_at->format('M d, Y') }}</p>
                            <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">{{ $log->created_at->format('H:i:s A') }}</p>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-500 font-black text-[10px] mr-3 border border-slate-200">
                                {{ substr($log->user->name, 0, 1) }}
                            </div>
                            <p class="text-[13px] font-bold text-slate-900">{{ $log->user->name }}</p>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="inline-flex items-center px-3 py-1 bg-{{ str_contains($log->action, 'Created') ? 'emerald' : (str_contains($log->action, 'Deleted') ? 'rose' : 'brand') }}-50 text-{{ str_contains($log->action, 'Created') ? 'emerald' : (str_contains($log->action, 'Deleted') ? 'rose' : 'brand') }}-600 text-[10px] font-black uppercase tracking-widest rounded-lg border border-{{ str_contains($log->action, 'Created') ? 'emerald' : (str_contains($log->action, 'Deleted') ? 'rose' : 'brand') }}-100">
                            {{ $log->action }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-[12px] text-slate-400 font-mono">
                        {{ $log->ip_address }}
                    </td>
                    <td class="px-8 py-6 text-right">
                        @if($log->changes)
                        <div x-data="{ open: false }" class="inline-block relative">
                            <button @click="open = !open" 
                                    class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-brand-600 underline decoration-slate-200 underline-offset-4 transition-all">
                                Inspect Payload
                            </button>
                            
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="absolute right-0 mt-4 w-80 z-50">
                                <div class="bg-slate-900 rounded-3xl p-6 shadow-2xl border border-slate-800 text-left">
                                    <div class="flex items-center justify-between mb-4 border-b border-slate-800 pb-3">
                                        <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Metadata Fragment</p>
                                        <button @click="open = false" class="text-slate-500 hover:text-white">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                        </button>
                                    </div>
                                    <pre class="text-[10px] font-mono text-emerald-400 whitespace-pre-wrap leading-relaxed overflow-x-auto custom-scrollbar">{{ json_encode($log->changes, JSON_PRETTY_PRINT) }}</pre>
                                </div>
                            </div>
                        </div>
                        @else
                        <span class="text-[10px] text-slate-300 font-black uppercase tracking-widest">Signed Only</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-8 py-6 border-t border-slate-50 bg-slate-50/30">
        {{ $logs->links() }}
    </div>
</div>
