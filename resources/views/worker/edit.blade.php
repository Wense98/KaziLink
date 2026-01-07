<x-app-layout>
    <div class="py-24 min-h-screen">
        <div class="max-w-[650px] mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
            <div class="glass-card rounded-[3.5rem] overflow-hidden shadow-2xl relative">
                <div class="p-10 sm:p-16">
                    <div class="text-center mb-16">
                        <div class="w-20 h-20 bg-brand-500/10 rounded-3xl flex items-center justify-center text-brand-500 mx-auto mb-8 border border-brand-500/20 shadow-[0_0_30px_rgba(34,197,94,0.15)]">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <h2 class="text-4xl font-black text-white font-outfit mb-3 uppercase tracking-tight">Refine <span class="gradient-text">Identity</span></h2>
                        <p class="text-gray-500 text-sm font-medium">Calibrate your professional presence for the marketplace.</p>
                    </div>

                    <form method="POST" action="{{ route('worker.update') }}" class="space-y-10" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Profile Photo -->
                        <div class="space-y-6">
                            <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.3em] px-1">Identity Portrait</label>
                            <div class="flex items-center gap-8">
                                <div class="h-24 w-24 rounded-3xl bg-white/5 border border-white/10 flex items-center justify-center overflow-hidden shrink-0 shadow-xl relative group">
                                    @if($worker->user->avatar)
                                        <img src="{{ asset('storage/' . $worker->user->avatar) }}" alt="Avatar" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    @else
                                        <span class="text-3xl font-black text-gray-700 font-outfit uppercase">{{ substr($worker->user->name, 0, 1) }}</span>
                                    @endif
                                    <div class="absolute inset-0 bg-brand-500/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                </div>
                                <div class="flex-grow">
                                    <div class="bg-white/5 rounded-2xl flex items-center px-5 py-4 border border-dashed border-white/10 hover:border-brand-500/50 transition-all">
                                        <input type="file" name="avatar" id="avatar" accept="image/*" class="text-[10px] text-gray-500 file:mr-4 file:py-1.5 file:px-4 file:rounded-full file:border-0 file:text-[9px] file:font-black file:bg-brand-500/10 file:text-brand-500 hover:file:bg-brand-500/20 transition-all cursor-pointer" />
                                    </div>
                                    <p class="text-[9px] text-gray-700 mt-3 font-bold uppercase tracking-widest italic">Portrait update will override current imagery.</p>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('avatar')" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                            <!-- Service Category -->
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.3em] px-1">Domain of Expertise</label>
                                <div class="bg-white/5 rounded-2xl flex items-center px-5 py-4 border border-white/10 focus-within:border-brand-500/50 transition-all">
                                    <select id="service_category_id" name="service_category_id" class="bg-transparent border-none text-white text-xs font-bold w-full focus:ring-0 appearance-none cursor-pointer">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $worker->service_category_id == $category->id ? 'selected' : '' }} class="bg-kazi-dark text-white">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <x-input-error :messages="$errors->get('service_category_id')" />
                            </div>

                            <!-- Hourly Rate -->
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.3em] px-1">Investment Scale (TZS/hr)</label>
                                <div class="bg-white/5 rounded-2xl flex items-center px-5 py-4 border border-white/10 focus-within:border-brand-500/50 transition-all">
                                    <div class="text-[10px] font-black text-brand-500 border-r border-white/5 pr-4 mr-4">TZS</div>
                                    <input id="hourly_rate" type="number" name="hourly_rate" class="bg-transparent border-none text-white text-xs font-bold w-full focus:ring-0 p-0" value="{{ old('hourly_rate', $worker->hourly_rate) }}" required min="0" />
                                </div>
                                <x-input-error :messages="$errors->get('hourly_rate')" />
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="space-y-4">
                            <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.3em] px-1">Operational Zone</label>
                            <div class="bg-white/5 rounded-2xl flex items-center px-5 py-4 border border-white/10 focus-within:border-brand-500/50 transition-all">
                                <select id="location_id" name="location_id" class="bg-transparent border-none text-white text-xs font-bold w-full focus:ring-0 appearance-none cursor-pointer">
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ $worker->location_id == $location->id ? 'selected' : '' }} class="bg-kazi-dark text-white">
                                            {{ $location->name }} ({{ ucfirst($location->type) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('location_id')" />
                        </div>

                        <!-- Experience Years -->
                        <div class="space-y-4">
                            <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.3em] px-1">Industry Tenure (Years)</label>
                            <div class="bg-white/5 rounded-2xl flex items-center px-5 py-4 border border-white/10 focus-within:border-brand-500/50 transition-all">
                                <div class="text-brand-500 border-r border-white/5 pr-4 mr-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input id="experience_years" type="number" name="experience_years" class="bg-transparent border-none text-white text-xs font-bold w-full focus:ring-0 p-0" value="{{ old('experience_years', $worker->experience_years) }}" required min="0" />
                            </div>
                            <x-input-error :messages="$errors->get('experience_years')" />
                        </div>

                        <!-- Bio -->
                        <div class="space-y-4">
                            <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.3em] px-1">Professional Synopsis</label>
                            <div class="bg-white/5 rounded-[2.5rem] p-8 border border-white/10 focus-within:border-brand-500/30 transition-all">
                                <textarea id="bio" name="bio" rows="4" class="bg-transparent border-none text-white text-sm font-medium w-full focus:ring-0 resize-none placeholder-gray-800 leading-relaxed" required>{{ old('bio', $worker->bio) }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('bio')" />
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="premium-button w-full py-6 rounded-[2rem] text-white font-black text-xs uppercase tracking-[0.4em] transform active:scale-[0.98] transition-all">
                                Synchronize Profile Changes
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="absolute top-0 left-0 w-80 h-80 bg-brand-500/5 rounded-full -ml-40 -mt-40 blur-[100px]"></div>
            </div>
        </div>
    </div>
</x-app-layout>
