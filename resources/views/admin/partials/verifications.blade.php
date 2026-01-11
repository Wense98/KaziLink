<div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
    <div class="p-8 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center">
        <div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white font-sans">Pending Verifications</h3>
            <p class="text-slate-500 text-sm mt-1">Review validation documents from new workers.</p>
        </div>
        <span class="px-4 py-2 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 rounded-xl text-xs font-bold uppercase tracking-wider">
            {{ $workers->total() }} Pending
        </span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-slate-900/30 text-xs uppercase tracking-widest text-slate-500 dark:text-slate-400 border-b border-slate-100 dark:border-slate-700">
                    <th class="px-8 py-6 font-bold">Worker</th>
                    <th class="px-8 py-6 font-bold">NIDA / ID</th>
                    <th class="px-8 py-6 font-bold">Documents</th>
                    <th class="px-8 py-6 font-bold">Submitted</th>
                    <th class="px-8 py-6 font-bold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700 text-sm">
                @forelse($workers as $worker)
                    <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                @if($worker->user->avatar)
                                    <img src="{{ asset('storage/' . $worker->user->avatar) }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-white dark:ring-slate-700 shadow-sm" alt="">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-brand-100 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 flex items-center justify-center font-bold text-sm">
                                        {{ substr($worker->user->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <p class="font-bold text-slate-900 dark:text-white">{{ $worker->user->name }}</p>
                                    <p class="text-slate-500 text-xs">{{ $worker->user->email }}</p>
                                    <p class="text-slate-400 text-xs mt-0.5">{{ $worker->user->phone }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            {{-- Assuming we stored NIDA in simple way or need to fetch from JSON --}}
                            {{-- For now, display 'N/A' if not in separate column, or use accessor --}}
                            <span class="font-mono text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 px-2 py-1 rounded">
                                {{ $worker->nida_number ?? 'Stored in Doc' }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            @if($worker->id_document)
                                <a href="{{ asset('storage/' . $worker->id_document) }}" target="_blank" class="inline-flex items-center gap-2 text-brand-600 dark:text-brand-400 hover:underline font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    View ID
                                </a>
                            @else
                                <span class="text-slate-400 italic">No document uploaded</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-slate-500">
                            {{ $worker->updated_at->diffForHumans() }}
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <form action="{{ route('admin.workers.verify', $worker->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to REJECT this worker?');">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="p-2 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-lg transition-colors tooltip" title="Reject">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </form>

                                <form action="{{ route('admin.workers.verify', $worker->id) }}" method="POST" onsubmit="return confirm('Verify this worker? They will become visible if subscribed.');">
                                    @csrf
                                    <input type="hidden" name="status" value="verified">
                                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg text-xs font-bold uppercase tracking-wider hover:bg-green-700 shadow-lg shadow-green-500/30 transition-all">
                                        Approve
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-8 py-16 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 mb-4 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <p class="text-lg font-medium">No pending verifications</p>
                                <p class="text-sm">Great job! You're all caught up.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t border-slate-100 dark:border-slate-700">
        {{ $workers->links() }}
    </div>
</div>
