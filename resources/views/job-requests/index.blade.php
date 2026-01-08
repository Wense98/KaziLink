<x-app-layout>
    <x-slot name="header">
        {{ __('Job Requests') }}
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Header Section -->
            <div class="flex items-center justify-between bg-blue-600 rounded-3xl p-6 text-white shadow-xl shadow-blue-600/20">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-white/20 rounded-2xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                    </div>
                    <h2 class="text-xl font-bold uppercase tracking-tight">Work Request</h2>
                </div>
                <div class="flex items-center gap-3">
                    <button class="p-2 bg-white/10 rounded-full hover:bg-white/20 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </button>
                    <button class="p-2 bg-white/10 rounded-full hover:bg-white/20 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    </button>
                </div>
            </div>

            @forelse($requests as $request)
                <!-- Detailed Request Card -->
                <div class="card-ui bg-white mb-8">
                    <!-- Request Summary -->
                    <div class="p-8 border-b border-slate-100">
                        <div class="grid grid-cols-2 gap-y-6">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Job Title:</p>
                                <p class="text-sm font-bold text-slate-800">
                                    {{ Auth::user()->role === 'worker' ? 'New Service Request' : 'Request to ' . $request->worker->name }}
                                </p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Location:</p>
                                <p class="text-sm font-bold text-slate-800">{{ $request->location ?? 'Arusha' }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Budget:</p>
                                <p class="text-sm font-bold text-slate-800">TZS {{ number_format($request->budget) }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Date:</p>
                                <p class="text-sm font-bold text-slate-800">{{ $request->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-8">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 border-b border-slate-100 pb-2">Job Details</p>
                            <p class="text-sm text-slate-600 leading-relaxed italic">
                                "{{ $request->details }}"
                            </p>
                        </div>
                    </div>

                    <!-- Client/Status Info -->
                    <div class="p-8 bg-slate-50/50">
                        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-slate-200 overflow-hidden flex-shrink-0">
                                    <div class="w-full h-full flex items-center justify-center text-slate-500 font-bold">
                                        {{ substr(Auth::user()->role === 'worker' ? $request->client->name : $request->worker->name, 0, 1) }}
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-900">{{ Auth::user()->role === 'worker' ? $request->client->name : $request->worker->name }}</h4>
                                    <p class="text-[10px] text-slate-500 font-medium uppercase tracking-widest mt-0.5">Contact: +255 739 123 455</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 w-full md:w-auto">
                                @if(Auth::user()->role === 'worker' && $request->status === 'pending')
                                    <form action="{{ route('job-requests.update', $request) }}" method="POST" class="flex-grow md:flex-none">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit" class="w-full btn-success !py-2.5 !px-6 text-[10px] uppercase tracking-widest ring-offset-2 hover:ring-2 ring-emerald-500/20">
                                            Accept Job
                                        </button>
                                    </form>
                                    <form action="{{ route('job-requests.update', $request) }}" method="POST" class="flex-grow md:flex-none">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="w-full btn-danger !py-2.5 !px-6 text-[10px] uppercase tracking-widest ring-offset-2 hover:ring-2 ring-rose-500/20">
                                            Decline
                                        </button>
                                    </form>
                                @else
                                    <div class="px-6 py-2.5 bg-slate-200 text-slate-600 rounded-xl text-[10px] font-bold uppercase tracking-widest">
                                        Status: {{ $request->status }}
                                    </div>
                                @endif
                                
                                <a href="{{ route('messages.show', Auth::user()->role === 'worker' ? $request->client_id : $request->worker_id) }}" 
                                   class="p-3 bg-white border border-slate-200 text-slate-500 rounded-xl hover:text-blue-600 transition-all shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card-ui p-20 text-center">
                    <p class="text-slate-400 font-bold uppercase tracking-widest">No Active Work Requests</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
