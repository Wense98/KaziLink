<x-public-layout>
    <!-- Search Hero -->
    <div class="relative pt-32 pb-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h1 class="text-5xl md:text-7xl font-black text-slate-900 dark:text-white tracking-tighter mb-6 leading-none">
                FIND YOUR <span class="gradient-text">MAESTRO</span>
            </h1>
            <p class="text-slate-500 dark:text-slate-400 font-medium max-w-2xl mx-auto mb-16 uppercase tracking-widest text-xs">
                Sourcing the top 1% of professionals for your most critical projects.
            </p>

            <!-- Floating Glass Search -->
            <form action="{{ route('search.index') }}" method="GET" class="max-w-5xl mx-auto glass-card rounded-[3rem] p-4 flex flex-col lg:flex-row gap-4 shadow-2xl items-center relative" data-aos="zoom-in">
                <div class="flex-grow w-full relative">
                    <div class="absolute inset-y-0 left-0 pl-8 flex items-center pointer-events-none text-brand-500">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </div>
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="What specific skill are you seeking?" class="w-full bg-transparent border-transparent focus:ring-0 pl-16 pr-8 py-6 text-slate-900 dark:text-white font-black text-sm uppercase tracking-widest placeholder:text-slate-400 dark:placeholder:text-slate-600 rounded-[2.5rem]">
                </div>
                
                <div class="flex flex-col lg:flex-row gap-4 w-full lg:w-auto p-2">
                    <div class="relative">
                        <select name="category" onchange="this.form.submit()" class="w-full lg:w-56 bg-white/5 dark:bg-slate-900/50 border-white/10 rounded-[2rem] px-8 py-5 text-slate-900 dark:text-white font-black text-[10px] uppercase tracking-widest focus:ring-2 focus:ring-brand-500 appearance-none cursor-pointer">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>
                    
                    <button type="submit" class="premium-button px-12 py-5 rounded-[2rem] text-[10px] font-black uppercase tracking-[0.2em] shadow-xl">
                        Locate Pro
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-32">
        <!-- Results Info -->
        <div class="flex items-center justify-between mb-16 border-b border-white/5 pb-8" data-aos="fade-up">
            <div>
                <h2 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-[0.3em]">
                    Available Professionals <span class="text-brand-500 ml-4">{{ $workers->total() }} FOUND</span>
                </h2>
            </div>
            <div class="flex items-center gap-6">
                <!-- Sorting etc could go here -->
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sort: Relevance</span>
            </div>
        </div>

        @if($workers->isEmpty())
            <div class="glass-card rounded-[4rem] p-32 text-center" data-aos="zoom-in">
                <div class="w-24 h-24 bg-brand-500/10 rounded-full flex items-center justify-center text-brand-500 mx-auto mb-10 border border-brand-500/20">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
                <h3 class="text-3xl font-black text-slate-900 dark:text-white mb-6 uppercase tracking-tight">Zero Matches Found</h3>
                <p class="text-slate-500 dark:text-slate-400 mb-12 max-w-md mx-auto font-medium leading-loose">The specific skill combination you requested is currently unavailable in our elite network. Adjust your parameters to broaden the search.</p>
                <a href="{{ route('search.index') }}" class="inline-flex premium-button px-12 py-6 rounded-[2rem] text-[10px] font-black uppercase tracking-[0.3em]">Reset Global Parameters</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
                @foreach($workers as $worker)
                    <div class="group relative" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                        <div class="glass-card rounded-[3rem] overflow-hidden transition-all duration-700 hover:-translate-y-4 hover:shadow-[0_40px_80px_-20px_rgba(59,130,246,0.2)]">
                            <!-- Image Wrapper -->
                            <div class="aspect-[1/1.2] relative overflow-hidden">
                                @if($worker->user->avatar)
                                    <img src="{{ asset('storage/' . $worker->user->avatar) }}" alt="{{ $worker->user->name }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-1000 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-700 text-6xl font-black">
                                        {{ substr($worker->user->name, 0, 1) }}
                                    </div>
                                @endif
                                
                                <!-- Hover Overlay Info -->
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 flex flex-col justify-end p-8">
                                    <div class="flex items-center justify-between text-white text-[10px] font-black uppercase tracking-[0.2em]">
                                        <span>Status: Available</span>
                                        <span class="text-brand-400">View Dossier &rarr;</span>
                                    </div>
                                </div>

                                <!-- Badge -->
                                <div class="absolute top-6 left-6">
                                    <span class="px-4 py-2 bg-slate-900/80 backdrop-blur-md text-white text-[9px] font-black uppercase tracking-widest rounded-full border border-white/10 shadow-2xl">
                                        {{ $worker->category->name }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-10">
                                <div class="flex justify-between items-start mb-4">
                                    <h4 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight leading-none">{{ $worker->user->name }}</h4>
                                    <div class="flex items-center text-amber-500">
                                        <svg class="h-3 w-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                        <span class="ml-1 text-[10px] font-black">{{ number_format($worker->averageRating(), 1) }}</span>
                                    </div>
                                </div>

                                <p class="text-slate-500 dark:text-slate-400 text-xs mb-10 line-clamp-2 leading-relaxed font-medium">
                                    {{ $worker->bio }}
                                </p>

                                <div class="flex items-center justify-between mb-8">
                                    <div class="flex flex-col">
                                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Rate</span>
                                        <span class="text-sm font-black text-slate-900 dark:text-white tracking-tighter">{{ number_format($worker->hourly_rate) }} <span class="text-[10px] text-slate-400">TZS/hr</span></span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Identity Verified</span>
                                    </div>
                                </div>

                                <a href="{{ route('worker.show', $worker) }}" class="block w-full text-center py-5 bg-slate-900 dark:bg-slate-800 text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl transition-all group-hover:bg-brand-500 shadow-xl group-hover:shadow-brand-500/30">
                                    Inspect Profile
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-20">
                {{ $workers->appends(request()->query())->links() }}
            </div>
        @endif

        <!-- Category Quick Jumps -->
        <div class="mt-40">
            <div class="text-center mb-24">
                <h2 class="text-brand-500 font-black tracking-[0.4em] uppercase text-[10px] mb-4">Network Graph</h2>
                <h3 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">Navigate by Specialization</h3>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('search.index', ['category' => $category->id]) }}" class="group glass-card p-8 rounded-3xl text-center transition-all duration-500 hover:bg-brand-500 border border-white/5">
                        <div class="w-12 h-12 bg-brand-500/10 rounded-2xl flex items-center justify-center text-brand-500 mx-auto mb-6 group-hover:bg-white group-hover:text-brand-500 transition-all">
                            <span class="text-lg font-black">{{ substr($category->name, 0, 1) }}</span>
                        </div>
                        <span class="text-[10px] font-black text-slate-900 dark:text-white uppercase tracking-widest group-hover:text-white transition-all">{{ $category->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-public-layout>
