<x-app-layout>
    <x-slot name="header">
        {{ __('Job Requests') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass-card rounded-[2.5rem] p-10" data-aos="fade-up">
                <div class="flex items-center justify-between mb-12">
                    <div>
                        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-brand-500 mb-2">Service Pipeline</h3>
                        <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Active Opportunities</h2>
                    </div>
                    <div class="flex space-x-2">
                        <span class="px-4 py-2 bg-brand-500/10 text-brand-500 rounded-xl text-[10px] font-bold uppercase tracking-widest border border-brand-500/20">Total: {{ $requests->count() }}</span>
                    </div>
                </div>

                @if($requests->isEmpty())
                    <div class="py-20 text-center">
                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-400 mx-auto mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">No requests found at this time.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left border-b border-white/5">
                                    <th class="pb-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Context</th>
                                    <th class="pb-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Details</th>
                                    <th class="pb-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Budget</th>
                                    <th class="pb-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Status</th>
                                    <th class="pb-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($requests as $request)
                                    <tr class="group hover:bg-white/5 transition-all">
                                        <td class="py-8">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-900 font-bold border border-white/10">
                                                    {{ substr(Auth::user()->role === 'worker' ? $request->client->name : $request->worker->name, 0, 1) }}
                                                </div>
                                                <div class="ml-4">
                                                    <h4 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-tight">
                                                        {{ Auth::user()->role === 'worker' ? $request->client->name : $request->worker->name }}
                                                    </h4>
                                                    <p class="text-[9px] text-slate-500 font-bold uppercase tracking-widest mt-0.5">
                                                        {{ $request->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-8">
                                            <p class="text-xs text-slate-600 dark:text-slate-400 font-medium line-clamp-2 max-w-xs transition-all group-hover:line-clamp-none">
                                                {{ $request->details }}
                                            </p>
                                        </td>
                                        <td class="py-8">
                                            <span class="text-xs font-black text-slate-900 dark:text-white">
                                                {{ $request->budget ? number_format($request->budget) . ' TZS' : 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="py-8">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                                    'accepted' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                                                    'rejected' => 'bg-rose-500/10 text-rose-500 border-rose-500/20',
                                                    'completed' => 'bg-brand-500/10 text-brand-500 border-brand-500/20',
                                                    'cancelled' => 'bg-slate-500/10 text-slate-500 border-slate-500/20',
                                                ];
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-[0.1em] border {{ $statusColors[$request->status] ?? 'bg-slate-500/10 text-slate-500' }}">
                                                {{ $request->status }}
                                            </span>
                                        </td>
                                        <td class="py-8">
                                            <div class="flex space-x-2">
                                                @if(Auth::user()->role === 'worker' && $request->status === 'pending')
                                                    <form action="{{ route('job-requests.update', $request) }}" method="POST">
                                                        @csrf @method('PATCH')
                                                        <input type="hidden" name="status" value="accepted">
                                                        <button type="submit" class="px-3 py-2 bg-emerald-500 text-white rounded-lg text-[9px] font-black uppercase tracking-widest hover:bg-emerald-600 transition-all shadow-lg hover:shadow-emerald-500/20">Accept</button>
                                                    </form>
                                                    <form action="{{ route('job-requests.update', $request) }}" method="POST">
                                                        @csrf @method('PATCH')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit" class="px-3 py-2 bg-white/5 text-slate-900 dark:text-white border border-white/10 rounded-lg text-[9px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">Decline</button>
                                                    </form>
                                                @endif
                                                
                                                <a href="{{ route('messages.show', Auth::user()->role === 'worker' ? $request->client_id : $request->worker_id) }}" class="p-2 transition-all text-slate-400 hover:text-brand-500">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
