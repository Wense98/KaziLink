<x-app-layout>
    <div class="py-24 min-h-screen">
        <div class="max-w-[650px] mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
            <div class="glass-card rounded-[3.5rem] overflow-hidden shadow-2xl relative">
                <div class="p-10 sm:p-16">
                    <div class="text-center mb-16">
                        <div class="w-20 h-20 bg-brand-500/10 rounded-3xl flex items-center justify-center text-brand-500 mx-auto mb-8 border border-brand-500/20 shadow-[0_0_30px_rgba(34,197,94,0.15)] anim-pulse">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900 mb-3 uppercase tracking-tight">Ascend to <span class="gradient-text">Pro Status</span></h2>
                        <p class="text-slate-500 text-xs font-medium">Join Tanzania's elite professional ecosystem.</p>
                    </div>

                    <form method="POST" action="{{ route('worker.store') }}" class="space-y-10" enctype="multipart/form-data" x-data="{ showCustomCategory: false }">
                        @csrf

                        <!-- Profile Photo -->
                        <div class="space-y-4">
                            <label class="text-[9px] font-bold text-slate-600 uppercase tracking-[0.2em] px-1">Identity Portrait</label>
                            <div class="bg-white/5 rounded-[2rem] flex items-center px-6 py-5 border border-dashed border-white/10 hover:border-brand-500/50 transition-all group">
                                <div class="flex items-center space-x-2 border-r border-white/5 pr-5 mr-5 text-brand-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="file" name="avatar" id="avatar" accept="image/*" class="text-[10px] text-slate-500 file:mr-6 file:py-2 file:px-6 file:rounded-full file:border-0 file:text-[8px] file:font-bold file:bg-brand-500/10 file:text-brand-500 hover:file:bg-brand-500/20 transition-all cursor-pointer" />
                            </div>
                            <p class="text-[8px] text-slate-600 px-2 font-bold uppercase tracking-widest italic leading-relaxed">High-definition facial imagery recommended.</p>
                            <x-input-error :messages="$errors->get('avatar')" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                            <!-- Service Category -->
                            <div class="space-y-4">
                                <label class="text-[9px] font-bold text-slate-600 uppercase tracking-[0.2em] px-1">Field of Expertise</label>
                                <div class="bg-white/5 rounded-2xl flex items-center px-5 py-4 border border-white/10 focus-within:border-brand-500/50 transition-all">
                                    <select id="service_category_id" name="service_category_id" x-on:change="showCustomCategory = $event.target.value === 'other'" class="bg-transparent border-none text-slate-900 text-xs font-bold w-full focus:ring-0 appearance-none cursor-pointer">
                                        <option value="" class="bg-kazi-dark">Select Domain</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('service_category_id') == $category->id ? 'selected' : '' }} class="bg-kazi-dark text-slate-900">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                        <option value="other" class="bg-kazi-dark text-slate-900">Unlisted Expertise</option>
                                    </select>
                                </div>
                                <x-input-error :messages="$errors->get('service_category_id')" />
                            </div>

                            <!-- Hourly Rate -->
                            <div class="space-y-4">
                                <label class="text-[9px] font-bold text-slate-600 uppercase tracking-[0.2em] px-1">Investment Scale (TZS/hr)</label>
                                <div class="bg-white/5 rounded-2xl flex items-center px-5 py-4 border border-white/10 focus-within:border-brand-500/50 transition-all">
                                    <div class="text-[10px] font-bold text-brand-500 border-r border-white/5 pr-4 mr-4">TZS</div>
                                    <input id="hourly_rate" type="number" name="hourly_rate" class="bg-transparent border-none text-slate-900 text-xs font-bold w-full focus:ring-0 p-0" value="{{ old('hourly_rate') }}" required min="0" placeholder="5,000" />
                                </div>
                                <x-input-error :messages="$errors->get('hourly_rate')" />
                            </div>
                        </div>

                        <!-- Custom Category Input -->
                        <div class="space-y-4" x-show="showCustomCategory" x-transition x-cloak>
                            <label class="text-[9px] font-bold text-brand-500 uppercase tracking-[0.3em] px-1">Specify Expertise</label>
                            <div class="bg-white/5 rounded-2xl flex items-center px-5 py-5 border border-brand-500/30">
                                <input id="custom_category" type="text" name="custom_category" class="bg-transparent border-none text-slate-900 text-sm font-bold w-full focus:ring-0" value="{{ old('custom_category') }}" placeholder="Ex: Advanced Aerospace Logistics..." />
                            </div>
                        </div>

                        <!-- Location Section -->
                        <div class="space-y-8 pt-6 border-t border-white/5">
                            <h3 class="text-[9px] font-bold text-brand-500 uppercase tracking-[0.3em]">Geographical Domain</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Region -->
                                <div class="space-y-4">
                                    <label class="text-[8px] font-bold text-slate-600 uppercase tracking-[0.2em] px-1">Primary Region</label>
                                    <div class="bg-white/5 rounded-2xl flex items-center px-5 py-4 border border-white/10">
                                        <select id="location_id" name="location_id" class="bg-transparent border-none text-slate-900 text-xs font-bold w-full focus:ring-0 appearance-none cursor-pointer">
                                            <option value="" class="bg-kazi-dark">Select Region</option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }} class="bg-kazi-dark text-slate-900">
                                                    {{ $location->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('location_id')" />
                                </div>

                                <!-- District -->
                                <div class="space-y-4">
                                    <label class="text-[8px] font-bold text-slate-600 uppercase tracking-[0.2em] px-1">District Focus</label>
                                    <div class="bg-white/5 rounded-2xl px-5 py-4 border border-white/10">
                                        <input type="text" name="district" class="bg-transparent border-none text-slate-900 text-xs font-bold w-full focus:ring-0 p-0" placeholder="e.g. Kinondoni" value="{{ old('district') }}" required />
                                    </div>
                                    <x-input-error :messages="$errors->get('district')" />
                                </div>
                            </div>
                        </div>

                        <!-- Verification Section -->
                        <div class="space-y-8 pt-6 border-t border-white/5">
                            <div class="flex items-center justify-between">
                                <h3 class="text-[9px] font-bold text-brand-500 uppercase tracking-[0.3em]">Identity Verification</h3>
                                <span class="bg-brand-500/10 text-brand-500 text-[8px] font-bold uppercase tracking-[0.2em] px-3 py-1 rounded-full border border-brand-500/20 shadow-[0_0_15px_rgba(34,197,94,0.1)]">Required</span>
                            </div>
                            
                            <div class="space-y-4">
                                <label class="text-[8px] font-bold text-slate-600 uppercase tracking-[0.2em] px-1">Legal Identification Document</label>
                                <div class="bg-white/5 rounded-[2rem] flex items-center px-6 py-6 border-2 border-dashed border-white/10 hover:border-brand-500/50 transition-all cursor-pointer group">
                                    <div class="flex items-center space-x-2 border-r border-white/5 pr-6 mr-6 text-brand-500/60 group-hover:text-brand-500">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 012-2h2a2 2 0 012 2v1m-6 0h6" />
                                        </svg>
                                    </div>
                                    <input type="file" name="id_document" id="id_document" accept=".pdf,image/*" required class="text-[10px] text-slate-500 file:mr-6 file:py-2 file:px-6 file:rounded-full file:border-0 file:text-[8px] file:font-bold file:bg-brand-500/10 file:text-brand-500 hover:file:bg-brand-500/20 transition-all cursor-pointer" />
                                </div>
                                <p class="text-[8px] text-slate-700 px-2 font-bold uppercase tracking-widest italic">NIDA, Passport, or Certified License (MAX 5MB).</p>
                                <x-input-error :messages="$errors->get('id_document')" />
                            </div>
                        </div>

                        <!-- Bio -->
                        <div class="space-y-4">
                            <label class="text-[9px] font-bold text-slate-600 uppercase tracking-[0.2em] px-1">Professional Narrative</label>
                            <div class="bg-white/5 rounded-[2.5rem] p-8 border border-white/10 focus-within:border-brand-500/30 transition-all">
                                <textarea id="bio" name="bio" rows="4" class="bg-transparent border-none text-slate-900 text-sm font-medium w-full focus:ring-0 resize-none placeholder-gray-800 leading-relaxed" required placeholder="Elevate your profile with a synopsis of your technical prowess and unique value propositions...">{{ old('bio') }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('bio')" />
                        </div>

                        <button type="submit" class="premium-button w-full py-5 rounded-[1.5rem] text-white font-bold text-[11px] uppercase tracking-[0.2em] transform active:scale-[0.98] transition-all">
                            Initialize Professional Identity
                        </button>
                    </form>
                </div>
                
                <div class="absolute top-0 right-0 w-80 h-80 bg-brand-500/5 rounded-full -mr-40 -mt-40 blur-[100px]"></div>
            </div>
        </div>
    </div>
</x-app-layout>
