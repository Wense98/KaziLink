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
                            
                            <!-- Status Badges -->
                            <div class="flex flex-col gap-2 text-right">
                                <span class="px-3 py-1 bg-slate-200 rounded-full text-[10px] font-bold uppercase tracking-widest text-slate-600">
                                    Status: {{ $request->status }}
                                </span>
                                @if($request->payment_status !== 'pending')
                                    <span class="px-3 py-1 {{ $request->payment_status === 'released' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }} rounded-full text-[10px] font-bold uppercase tracking-widest">
                                        Payment: {{ $request->payment_status }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center gap-3 w-full md:w-auto">
                                
                                {{-- WORKER ACTIONS --}}
                                @if(Auth::user()->role === 'worker')
                                    @if($request->status === 'pending')
                                        <div class="flex gap-2">
                                            <form action="{{ route('job-requests.update', $request) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="action" value="quote">
                                                <div class="flex items-center gap-2">
                                                    <input type="number" name="agreed_price" placeholder="Your Price (TZS)" required class="text-xs rounded-lg border-slate-300 w-32 focus:border-blue-500 focus:ring-blue-500">
                                                    <button type="submit" class="btn-primary !py-2.5 !px-4 text-[10px] uppercase tracking-widest">
                                                        Accept & Quote
                                                    </button>
                                                </div>
                                            </form>
                                            <form action="{{ route('job-requests.update', $request) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="p-2.5 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-100">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    @elseif($request->status === 'accepted' && $request->payment_status === 'in_escrow' && $request->work_status === 'pending')
                                        <form action="{{ route('job-requests.update', $request) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="action" value="start_work">
                                            <button type="submit" class="btn-primary !py-2.5 !px-6 text-[10px] uppercase tracking-widest">
                                                Start Work
                                            </button>
                                        </form>
                                    @elseif($request->work_status === 'in_progress')
                                        <form action="{{ route('job-requests.update', $request) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="action" value="finish_work">
                                            <button type="submit" class="btn-success !py-2.5 !px-6 text-[10px] uppercase tracking-widest">
                                                Mark Complete
                                            </button>
                                        </form>
                                    @endif
                                @endif

                                {{-- CLIENT ACTIONS --}}
                                @if(Auth::user()->role === 'customer')
                                    @if($request->status === 'accepted' && $request->payment_status === 'pending')
                                        <div class="text-right">
                                            <p class="text-xs font-bold text-slate-500 mb-1">Quote: TZS {{ number_format($request->agreed_price) }}</p>
                                            <form action="{{ route('job-requests.update', $request) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="action" value="pay">
                                                <button type="submit" class="btn-primary !py-2.5 !px-6 text-[10px] uppercase tracking-widest">
                                                    Deposit to Escrow
                                                </button>
                                            </form>
                                        </div>
                                    @elseif($request->work_status === 'completed' && $request->payment_status === 'in_escrow')
                                        <form action="{{ route('job-requests.update', $request) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="action" value="confirm_work">
                                            <button type="submit" class="btn-success !py-2.5 !px-6 text-[10px] uppercase tracking-widest">
                                                Confirm & Release Funds
                                            </button>
                                        </form>
                                    @elseif($request->status === 'completed' && $request->payment_status === 'released')
                                        @if(!$request->review)
                                            <button onclick="document.getElementById('review-modal-{{ $request->id }}').showModal()" class="btn-primary !py-2.5 !px-6 text-[10px] uppercase tracking-widest">
                                                Leave Review
                                            </button>
                                            
                                            <dialog id="review-modal-{{ $request->id }}" class="modal p-0 rounded-2xl backdrop:bg-slate-900/50 open:animate-fade-in backdrop:animate-fade-in">
                                                <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl relative">
                                                    <button onclick="document.getElementById('review-modal-{{ $request->id }}').close()" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                    </button>
                                                    
                                                    <h3 class="text-xl font-bold text-slate-900 mb-2">Rate Your Experience</h3>
                                                    <p class="text-slate-500 text-sm mb-6">How was working with {{ $request->worker->name }}?</p>
                                                    
                                                    <form action="{{ route('reviews.store', $request->worker->workerProfile) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="job_request_id" value="{{ $request->id }}">
                                                        
                                                        <div class="flex justify-center gap-2 mb-6" x-data="{ rating: 0 }">
                                                            <input type="hidden" name="rating" x-model="rating" required>
                                                            @foreach(range(1, 5) as $star)
                                                                <button type="button" @click="rating = {{ $star }}" class="text-3xl transition-colors focus:outline-none" :class="rating >= {{ $star }} ? 'text-amber-400' : 'text-slate-200'">
                                                                    ★
                                                                </button>
                                                            @endforeach
                                                        </div>
                                                        
                                                        <textarea name="comment" rows="3" placeholder="Share your feedback..." required class="w-full rounded-xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500 mb-6"></textarea>
                                                        
                                                        <button type="submit" class="btn-primary w-full py-3">Submit Review</button>
                                                    </form>
                                                </div>
                                            </dialog>
                                        @else
                                            <span class="text-xs font-bold text-slate-400 flex items-center gap-1">
                                                <span class="text-amber-400">★</span> {{ $request->review->rating }}.0 Reviewed
                                            </span>
                                        @endif
                                    @endif
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
