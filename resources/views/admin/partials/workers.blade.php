<!-- Page Title -->
<div class="mb-10 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight mb-2">Worker Verification</h1>
        <p class="text-slate-500 dark:text-slate-400 font-medium">Verify documents and manage professional worker profiles.</p>
    </div>
    <div class="flex items-center space-x-3">
        <div class="bg-white dark:bg-slate-800 px-6 py-3 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest leading-none mb-1">Total Workers</p>
            <p class="text-xl font-bold text-slate-900 dark:text-white leading-none">{{ $workers->total() }}</p>
        </div>
    </div>
</div>

<!-- Workers Table -->
<div class="bg-white dark:bg-slate-800 rounded-[2.5rem] border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 dark:bg-slate-700/50">
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest whitespace-nowrap">Worker Professional</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Service Category</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Location</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Documents</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Status</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                @foreach($workers as $worker)
                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/50 transition-colors group">
                    <td class="px-8 py-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-300 font-black overflow-hidden mr-4 border border-slate-200 dark:border-slate-600">
                                @if($worker->user->avatar)
                                    <img src="{{ asset('storage/' . $worker->user->avatar) }}" class="w-full h-full object-cover">
                                @else
                                    {{ substr($worker->user->name, 0, 1) }}
                                @endif
                            </div>
                            <div>
                                <p class="text-[14px] font-bold text-slate-900 dark:text-white group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">{{ $worker->user->name }}</p>
                                <p class="text-[11px] text-slate-400 dark:text-slate-500 font-medium">Joined {{ $worker->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="inline-flex items-center px-3 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-[10px] font-black uppercase tracking-widest rounded-lg">
                            {{ $worker->category->name }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center text-slate-500 dark:text-slate-400">
                            <svg class="w-4 h-4 mr-2 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-[13px] font-medium">{{ $worker->district }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        @if($worker->id_document)
                        <a href="{{ asset('storage/' . $worker->id_document) }}" target="_blank" class="inline-flex items-center text-brand-600 hover:text-brand-700 font-bold text-[11px] uppercase tracking-wider group-hover:underline">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Verify ID
                        </a>
                        @else
                        <span class="text-[11px] text-slate-300 uppercase font-black tracking-widest">No Docs</span>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        <span class="inline-flex items-center px-3 py-1.5 bg-{{ $worker->status === 'verified' ? 'emerald' : ($worker->status === 'pending' ? 'amber' : 'rose') }}-50 text-{{ $worker->status === 'verified' ? 'emerald' : ($worker->status === 'pending' ? 'amber' : 'rose') }}-600 text-[10px] font-black uppercase tracking-[0.1em] rounded-full border border-{{ $worker->status === 'verified' ? 'emerald' : ($worker->status === 'pending' ? 'amber' : 'rose') }}-100">
                            {{ $worker->status }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center space-x-2">
                            @if($worker->status !== 'verified')
                            <form action="{{ route('admin.workers.verify', $worker) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="verified">
                                <button type="submit" class="p-2.5 bg-emerald-50 text-emerald-600 rounded-xl hover:bg-emerald-600 hover:text-white transition-all shadow-sm" title="Approve Worker">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                            </form>
                            @endif
                            @if($worker->status !== 'rejected')
                            <form action="{{ route('admin.workers.verify', $worker) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition-all shadow-sm" title="Reject Worker">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-8 py-6 border-t border-slate-50 dark:border-slate-700 bg-slate-50/30 dark:bg-slate-800/30">
        {{ $workers->links() }}
    </div>
</div>
