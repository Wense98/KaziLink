<!-- Page Title -->
<div class="mb-10">
    <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-2">Platform Data Control</h1>
    <p class="text-slate-500 font-medium">Manage geographic regions and service categories available on KaziLink.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Locations Card -->
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col">
        <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider">Regions (Mikoa)</h3>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">{{ $locations->count() }} active zones</p>
            </div>
            <button @click="$dispatch('open-modal', 'add-location')" class="px-5 py-2.5 bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/10">
                + Add Region
            </button>
        </div>
        <div class="p-8 flex-grow">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach($locations as $loc)
                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 flex items-center justify-between group hover:border-brand-500/30 hover:bg-white transition-all">
                    <span class="text-[13px] font-bold text-slate-700">{{ $loc->name }}</span>
                    <form action="{{ route('admin.data.locations.destroy', $loc) }}" method="POST" onsubmit="return confirm('Delete this region?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="opacity-0 group-hover:opacity-100 text-slate-400 hover:text-rose-600 transition-all p-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
            @if($locations->isEmpty())
                <div class="text-center py-10">
                    <p class="text-[11px] font-black text-slate-300 uppercase tracking-[0.2em]">No Regions Found</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Categories Card -->
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col">
        <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider">Service Categories</h3>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">{{ $categories->count() }} specialized areas</p>
            </div>
            <button @click="$dispatch('open-modal', 'add-category')" class="px-5 py-2.5 bg-brand-600 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-brand-700 transition-all shadow-lg shadow-brand-500/10">
                + Add Category
            </button>
        </div>
        <div class="p-8 flex-grow">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach($categories as $cat)
                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 flex items-center justify-between group hover:border-brand-500/30 hover:bg-white transition-all">
                    <span class="text-[13px] font-bold text-slate-700">{{ $cat->name }}</span>
                    <form action="{{ route('admin.data.categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="opacity-0 group-hover:opacity-100 text-slate-400 hover:text-rose-600 transition-all p-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
            @if($categories->isEmpty())
                <div class="text-center py-10">
                    <p class="text-[11px] font-black text-slate-300 uppercase tracking-[0.2em]">No Categories Found</p>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="mt-8 p-8 bg-white/50 rounded-[2.5rem] border border-dashed border-slate-200 text-center">
    <p class="text-slate-400 text-[11px] font-bold uppercase tracking-widest">System Architecture Security: Every data modification is signed and logged.</p>
</div>

<!-- Modals -->
<x-modal name="add-location">
    <form action="{{ route('admin.data.locations.store') }}" method="POST" class="p-10">
        @csrf
        <div class="mb-8">
            <h2 class="text-2xl font-black text-slate-900 tracking-tight leading-none mb-2">New Geographic Region</h2>
            <p class="text-slate-500 text-sm font-medium">Add a new area where KaziLink services will be available.</p>
        </div>
        
        <input type="hidden" name="type" value="region">
        
        <div class="space-y-6">
            <div class="space-y-3">
                <label for="name" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Region Name (Mkoa)</label>
                <input id="name" name="name" type="text" 
                       class="w-full bg-slate-50 border-slate-200 rounded-2xl py-4 px-6 text-sm font-bold focus:ring-brand-500/20 focus:border-brand-500 transition-all" 
                       placeholder="e.g. Mwanza" required />
            </div>
        </div>

        <div class="mt-10 flex items-center justify-end space-x-4">
            <button type="button" @click="$dispatch('close')" class="px-8 py-3.5 text-[11px] font-black uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-all">Cancel</button>
            <button type="submit" class="px-10 py-4 bg-slate-900 text-white text-[11px] font-black uppercase tracking-widest rounded-2xl hover:bg-slate-800 transition-all shadow-xl shadow-slate-900/10">
                Register Region
            </button>
        </div>
    </form>
</x-modal>

<x-modal name="add-category">
    <form action="{{ route('admin.data.categories.store') }}" method="POST" class="p-10">
        @csrf
        <div class="mb-8">
            <h2 class="text-2xl font-black text-slate-900 tracking-tight leading-none mb-2">New Service Category</h2>
            <p class="text-slate-500 text-sm font-medium">Define a new professional field for worker registration.</p>
        </div>
        
        <div class="space-y-6">
            <div class="space-y-3">
                <label for="cat_name" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Category Title</label>
                <input id="cat_name" name="name" type="text" 
                       class="w-full bg-slate-50 border-slate-200 rounded-2xl py-4 px-6 text-sm font-bold focus:ring-brand-500/20 focus:border-brand-500 transition-all" 
                       placeholder="e.g. Graphic Designer" required />
            </div>
            <div class="space-y-3">
                <label for="cat_desc" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Brief Description</label>
                <textarea id="cat_desc" name="description" rows="3"
                          class="w-full bg-slate-50 border-slate-200 rounded-2xl py-4 px-6 text-sm font-bold focus:ring-brand-500/20 focus:border-brand-500 transition-all" 
                          placeholder="What kind of services does this professional offer?"></textarea>
            </div>
        </div>

        <div class="mt-10 flex items-center justify-end space-x-4">
            <button type="button" @click="$dispatch('close')" class="px-8 py-3.5 text-[11px] font-black uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-all">Cancel</button>
            <button type="submit" class="px-10 py-4 bg-brand-600 text-white text-[11px] font-black uppercase tracking-widest rounded-2xl hover:bg-brand-700 transition-all shadow-xl shadow-brand-500/10">
                Deploy Category
            </button>
        </div>
    </form>
</x-modal>
