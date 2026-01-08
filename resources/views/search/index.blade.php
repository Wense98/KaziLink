<x-public-layout>
    <!-- Search Filter Bar -->
    <div class="bg-white border-b border-slate-200 sticky top-0 z-50 py-4 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('search.index') }}" method="GET" class="flex flex-col lg:flex-row items-center gap-4">
                <!-- Search Input -->
                <div class="relative flex-grow w-full">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </span>
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="Search for jobs..." 
                           class="w-full bg-slate-100 border-none rounded-xl pl-12 pr-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20">
                </div>

                <!-- Filters -->
                <div class="flex items-center gap-2 w-full lg:w-auto overflow-x-auto pb-2 lg:pb-0 no-scrollbar">
                    <button type="submit" name="category" value="" class="px-4 py-2 {{ !request('category') ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-600' }} rounded-lg text-xs font-bold whitespace-nowrap transition-all">All</button>
                    
                    <div class="relative min-w-[120px]">
                        <select name="category" onchange="this.form.submit()" class="w-full bg-slate-100 border-none rounded-lg py-2 pl-4 pr-10 text-xs font-bold text-slate-600 appearance-none cursor-pointer">
                            <option value="">Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <svg class="w-4 h-4 absolute right-3 top-2.5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </div>

                    <div class="relative min-w-[120px]">
                        <select name="location" onchange="this.form.submit()" class="w-full bg-slate-100 border-none rounded-lg py-2 pl-4 pr-10 text-xs font-bold text-slate-600 appearance-none cursor-pointer">
                            <option value="">Location</option>
                            @foreach($locations ?? [] as $loc)
                                <option value="{{ $loc->id }}" {{ request('location') == $loc->id ? 'selected' : '' }}>{{ $loc->name }}</option>
                            @endforeach
                        </select>
                        <svg class="w-4 h-4 absolute right-3 top-2.5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </div>

                    <div class="relative min-w-[120px]">
                        <select name="sort" onchange="this.form.submit()" class="w-full bg-slate-100 border-none rounded-lg py-2 pl-4 pr-10 text-xs font-bold text-slate-600 appearance-none cursor-pointer">
                            <option value="newest">Newest</option>
                            <option value="rating">Rating</option>
                            <option value="price_low">Price: Low to High</option>
                        </select>
                        <svg class="w-4 h-4 absolute right-3 top-2.5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </div>

                    <button type="button" class="p-2 bg-slate-100 text-slate-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Results Section -->
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-4">
                @forelse($workers as $worker)
                    <div class="card-ui hover:border-blue-300 transition-all group p-4 sm:p-6 bg-white">
                        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                            <!-- Avatar -->
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-slate-200 overflow-hidden flex-shrink-0">
                                @if($worker->user->avatar)
                                    <img src="{{ asset('storage/' . $worker->user->avatar) }}" alt="" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-500 font-bold text-2xl">
                                        {{ substr($worker->user->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>

                            <!-- Info -->
                            <div class="flex-grow text-center sm:text-left">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                    <div>
                                        <h3 class="text-xl font-bold text-slate-900">{{ $worker->user->name }}</h3>
                                        <div class="text-sm text-slate-500 font-medium flex items-center justify-center sm:justify-start gap-3 mt-1">
                                            <span>TZS {{ number_format($worker->hourly_rate ?? 50000) }} • One Time Task</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('worker.show', $worker) }}" class="btn-primary whitespace-nowrap px-8">
                                        Apply Now
                                    </a>
                                </div>
                                <p class="text-sm text-slate-600 mt-4 line-clamp-2">
                                    {{ $worker->bio ?? 'Highly skilled professional ready to handle your plumbing, electrical, or home repair needs with precision and care.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="py-24 text-center">
                        <div class="w-20 h-20 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-400">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <h4 class="text-xl font-bold text-slate-800">No results found</h4>
                        <p class="text-slate-500 mt-2">Adjust your filters or try a different search term.</p>
                    </div>
                @endforelse

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $workers->links() }}
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
