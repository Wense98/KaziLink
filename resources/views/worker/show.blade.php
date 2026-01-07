<x-public-layout>
    <div class="py-24 min-h-screen relative">
        <!-- Ambient Background -->
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-brand-500/5 rounded-full blur-[120px] -mr-48 -mt-48 -z-10 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-blue-500/5 rounded-full blur-[120px] -ml-48 -mb-48 -z-10 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Left Column: Profile Info -->
                <div class="flex-grow space-y-12">
                    <!-- Header Card -->
                    <div class="glass-card rounded-[3rem] p-12 relative overflow-hidden" data-aos="fade-right">
                        <div class="relative flex flex-col md:flex-row items-center md:items-start text-center md:text-left">
                            <div class="relative group">
                                <div class="absolute inset-0 bg-brand-500/20 blur-2xl rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                <div class="h-32 w-32 rounded-3xl bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-slate-900 dark:text-white text-4xl font-black shadow-2xl relative z-10 overflow-hidden border border-blue-500/20">
                                    @if($worker->user->avatar)
                                        <img src="{{ asset('storage/' . $worker->user->avatar) }}" alt="{{ $worker->user->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    @else
                                        {{ substr($worker->user->name, 0, 1) }}
                                    @endif
                                </div>
                                @if($worker->status === 'verified')
                                    <div class="absolute -bottom-2 -right-2 bg-brand-500 text-slate-900 p-2 rounded-full border-4 border-kazi-dark shadow-xl z-20">
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="md:ml-12 mt-8 md:mt-0">
                                <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-3 uppercase tracking-tight">{{ $worker->user->name }}</h1>
                                <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 mb-8">
                                    <span class="px-4 py-1.5 bg-brand-500/10 text-brand-500 text-[9px] font-bold uppercase tracking-[0.2em] rounded-full border border-brand-500/20">
                                        {{ $worker->category->name }}
                                    </span>
                                    @if($worker->status === 'verified')
                                        <span class="flex items-center text-brand-400 text-[8px] font-bold uppercase tracking-[0.2em] bg-brand-500/5 px-4 py-1.5 rounded-full border border-brand-500/10">
                                            <svg class="h-3 w-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            Identity Secure
                                        </span>
                                    @endif
                                </div>
                                <div class="flex items-center justify-center md:justify-start space-x-12 text-sm">
                                    <div class="text-center md:text-left">
                                        <p class="text-slate-600 dark:text-slate-400 font-bold uppercase text-[8px] tracking-[0.2em] mb-2">Performance</p>
                                        <div class="flex items-center text-amber-500 font-bold text-lg">
                                            {{ number_format($worker->averageRating(), 1) }}
                                            <svg class="h-3.5 w-3.5 ml-1.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                        </div>
                                    </div>
                                    <div class="text-center md:text-left">
                                        <p class="text-slate-600 dark:text-slate-400 font-bold uppercase text-[8px] tracking-[0.2em] mb-2">Engagements</p>
                                        <p class="font-bold text-slate-900 dark:text-white text-lg">{{ $worker->reviewsCount() }}</p>
                                    </div>
                                    <div class="text-center md:text-left border-l border-white/5 pl-12">
                                        <p class="text-slate-600 dark:text-slate-400 font-bold uppercase text-[8px] tracking-[0.2em] mb-2">Tenure</p>
                                        <p class="font-bold text-slate-900 dark:text-white text-lg">{{ $worker->experience_years }} <span class="text-[9px] text-slate-500 ml-1">Yrs</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- About Section -->
                    <div class="glass-card rounded-[3rem] p-12" data-aos="fade-up">
                        <h2 class="text-xs font-black text-slate-900 dark:text-white mb-8 uppercase tracking-[0.4em]">Professional Synopsis</h2>
                        <p class="text-slate-400 dark:text-slate-300 leading-loose text-lg font-medium italic">
                            "{{ $worker->bio }}"
                        </p>
                    </div>

                    <!-- Reviews Section -->
                    <div class="space-y-10" data-aos="fade-up">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-[0.4em]">Marketplace Feedback</h2>
                            <span class="px-4 py-1 bg-brand-500/10 text-brand-500 text-[8px] font-black uppercase tracking-[0.3em] rounded-full border border-brand-500/20">Live Stream</span>
                        </div>

                        <!-- Review Form -->
                        @auth
                            @if(Auth::id() !== $worker->user_id)
                            <div class="glass-card p-12 rounded-[3rem] border-brand-500/20 relative overflow-hidden">
                                <h3 class="text-xl font-black text-slate-900 dark:text-white mb-8 uppercase tracking-tight">Post Verified Feedback</h3>
                                <form action="{{ route('reviews.store', $worker) }}" method="POST">
                                    @csrf
                                    <div class="mb-10">
                                        <label class="block text-[10px] font-black text-slate-500 mb-6 uppercase tracking-[0.3em]">Quality Tier</label>
                                        <div class="flex items-center space-x-6">
                                            @for($i = 1; $i <= 5; $i++)
                                            <label class="cursor-pointer group">
                                                <input type="radio" name="rating" value="{{ $i }}" class="hidden peer" required>
                                                <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-600 peer-checked:bg-brand-500 peer-checked:border-brand-500 peer-checked:text-slate-900 transition-all duration-300 transform group-hover:scale-110">
                                                    <span class="text-lg font-black">{{ $i }}</span>
                                                </div>
                                            </label>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <label class="block text-[10px] font-black text-slate-500 dark:text-slate-400 mb-6 uppercase tracking-[0.3em]">Technical Commentary</label>
                                        <textarea name="comment" rows="4" class="w-full bg-white/5 border-white/10 rounded-[2rem] p-8 text-sm font-medium text-slate-900 dark:text-white focus:ring-brand-500 focus:border-brand-500 transition-all placeholder-gray-700 dark:placeholder-gray-500" placeholder="Analyze your experience with this professional..." required></textarea>
                                    </div>
                                    <button type="submit" class="premium-button inline-flex px-12 py-5 text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.3em]">
                                        Publish Verified Review
                                    </button>
                                </form>
                            </div>
                            @endif
                        @else
                            <div class="glass-card rounded-[3rem] p-12 text-center border-dashed border-white/10">
                                <p class="text-slate-500 font-bold text-sm">Authentication required to post feedback. <a href="{{ route('login') }}" class="text-brand-500 hover:text-brand-400 font-black uppercase tracking-widest ml-2">Log in &rarr;</a></p>
                            </div>
                        @endauth

                        <!-- Reviews List -->
                        <div class="grid grid-cols-1 gap-8">
                            @forelse($worker->user->reviewsReceived as $review)
                            <div class="glass-card rounded-[2.5rem] p-10 transition-all duration-300 hover:border-white/20">
                                <div class="flex items-start justify-between mb-8">
                                    <div class="flex items-center">
                                        <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 font-black text-lg">
                                            {{ substr($review->user->name, 0, 1) }}
                                        </div>
                                        <div class="ml-6">
                                            <h4 class="font-black text-slate-900 uppercase tracking-tight">{{ $review->user->name }}</h4>
                                            <p class="text-[9px] text-slate-600 font-black uppercase tracking-widest mt-1">{{ $review->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center px-4 py-2 bg-amber-500/10 rounded-full border border-amber-500/20">
                                        <span class="text-amber-500 font-black text-xs mr-2">{{ $review->rating }}.0</span>
                                        <div class="flex items-center text-amber-500">
                                            @for($i = 0; $i < $review->rating; $i++)
                                                <svg class="h-3 w-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <p class="text-slate-400 dark:text-slate-300 italic leading-relaxed font-medium">
                                    "{{ $review->comment }}"
                                </p>
                            </div>
                            @empty
                                <div class="p-20 text-center glass-card rounded-[3rem] border-dashed border-white/10">
                                    <p class="text-slate-600 font-black uppercase tracking-[0.2em] text-xs">Zero Marketplace Feedback</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Right Column: Sidebar Action -->
                <aside class="w-full lg:w-[400px] shrink-0">
                    <div class="glass-card p-10 rounded-[3.5rem] sticky top-32 shadow-2xl" data-aos="fade-left">
                        <div class="text-center mb-10 pb-10 border-b border-white/5">
                            <span class="block text-[8px] text-slate-600 dark:text-slate-400 font-bold uppercase tracking-[0.2em] mb-4">Investment Scale</span>
                            <div class="flex items-baseline justify-center space-x-2">
                                <span class="text-[10px] font-bold text-brand-500">TZS</span>
                                <h3 class="text-3xl font-bold text-slate-900 dark:text-white">{{ number_format($worker->hourly_rate) }}</h3>
                                <span class="text-[10px] font-bold text-gray-700 dark:text-gray-400 uppercase">/hr</span>
                            </div>
                            <div class="mt-6 inline-flex items-center px-4 py-2 bg-brand-500/5 rounded-full border border-brand-500/10">
                                <span class="w-2 h-2 bg-brand-500 rounded-full mr-3 anim-pulse shadow-[0_0_10px_rgba(34,197,94,0.8)]"></span>
                                <span class="text-[8px] text-brand-400 font-bold uppercase tracking-[0.15em]">Operational Now</span>
                            </div>
                        </div>

                        <div class="space-y-4 mb-10">
                            <div class="flex items-center p-5 bg-white/5 rounded-3xl border border-white/5 hover:border-white/10 transition-colors">
                                <div class="w-12 h-12 bg-brand-500/10 rounded-2xl flex items-center justify-center text-brand-500 mr-5 shrink-0 border border-brand-500/20">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-[9px] text-slate-600 font-black uppercase tracking-widest mb-1">Operational Zone</p>
                                    <p class="font-black text-slate-900 text-sm truncate uppercase">{{ $worker->location->name }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-5 bg-white/5 rounded-3xl border border-white/5 hover:border-white/10 transition-colors">
                                <div class="w-12 h-12 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-500 mr-5 shrink-0 border border-blue-500/20">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[9px] text-slate-600 font-black uppercase tracking-widest mb-1">Direct Liaison</p>
                                    <p class="font-black text-slate-900 text-sm">{{ $worker->user->phone }}</p>
                                </div>
                            </div>
                        </div>

                        @php
                            $whatsappPhone = $worker->user->phone;
                            if (str_starts_with($whatsappPhone, '0')) {
                                $whatsappPhone = '255' . substr($whatsappPhone, 1);
                            } elseif (!str_starts_with($whatsappPhone, '255')) {
                                $whatsappPhone = '255' . $whatsappPhone;
                            }
                            $whatsappPhone = str_replace(['+', ' '], '', $whatsappPhone);
                            
                            $whatsappMessage = urlencode("Hello " . $worker->user->name . ", I found your profile on KaziLink and I'm interested in hiring you for " . $worker->category->name . " services.");
                        @endphp
                        
                        <div x-data="{ showBookingModal: false }">
                            <a href="{{ route('messages.show', $worker->user_id) }}" class="premium-button block w-full text-center py-6 text-white rounded-2xl text-xs font-black uppercase tracking-[0.3em] mb-4">
                                Message Expert
                            </a>
                            
                            <button @click="showBookingModal = true" class="block w-full text-center py-5 bg-brand-500/10 text-brand-500 border border-brand-500/20 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-brand-500 hover:text-white transition-all mb-10">
                                Hire Expert via KaziLink
                            </button>

                            <!-- Booking Modal -->
                            <div x-show="showBookingModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/90 backdrop-blur-sm" x-cloak>
                                <div @click.away="showBookingModal = false" class="glass-card w-full max-w-xl rounded-[3rem] p-12 relative overflow-hidden">
                                    <div class="absolute top-0 right-0 w-32 h-32 bg-brand-500/10 blur-2xl rounded-full -mr-16 -mt-16"></div>
                                    <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-2 uppercase tracking-tight">Hire {{ $worker->user->name }}</h3>
                                    <p class="text-xs text-slate-500 font-bold uppercase tracking-widest mb-10">Define your project requirements</p>

                                    <form action="{{ route('job-requests.store', $worker->user_id) }}" method="POST">
                                        @csrf
                                        <div class="mb-8">
                                            <label class="block text-[10px] font-black text-slate-500 mb-3 uppercase tracking-widest">Project Details</label>
                                            <textarea name="details" rows="4" class="w-full bg-white/5 border-white/10 rounded-2xl p-6 text-sm text-slate-900 dark:text-white focus:ring-brand-500 focus:border-brand-500" placeholder="Describe what you need help with..." required></textarea>
                                        </div>
                                        <div class="mb-10">
                                            <label class="block text-[10px] font-black text-slate-500 mb-3 uppercase tracking-widest">Initial Budget (TZS)</label>
                                            <input type="number" name="budget" class="w-full bg-white/5 border-white/10 rounded-2xl p-6 text-sm text-slate-900 dark:text-white focus:ring-brand-500 focus:border-brand-500" placeholder="e.g. 50000">
                                        </div>
                                        <div class="flex space-x-4">
                                            <button type="submit" class="premium-button flex-grow py-5 text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.2em]">Submit Request</button>
                                            <button type="button" @click="showBookingModal = false" class="px-8 py-5 bg-white/5 text-slate-900 border border-white/10 rounded-2xl text-[10px] font-black uppercase tracking-widest">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="py-10 border-t border-white/5">
                            <h4 class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-6">Direct Channels</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <a href="https://wa.me/{{ $whatsappPhone }}?text={{ $whatsappMessage }}" target="_blank" class="flex items-center justify-center p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl text-[9px] font-black uppercase text-emerald-500 tracking-widest hover:bg-emerald-500 hover:text-white transition-all">WhatsApp</a>
                                <a href="mailto:{{ $worker->user->email }}" class="flex items-center justify-center p-4 bg-white/5 border border-white/10 rounded-2xl text-[9px] font-black uppercase text-slate-400 tracking-widest hover:bg-white/10 transition-all">Email</a>
                            </div>
                        </div>

                        <p class="mt-10 text-center text-[9px] text-slate-600 px-6 font-bold uppercase tracking-widest leading-relaxed">
                            KaziLink <span class="text-brand-500">Secure Protocol</span> Active. <br/>Escrow Protection Guaranteed.
                        </p>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</x-public-layout>
