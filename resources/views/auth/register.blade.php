<x-guest-layout>
    <div class="auth-card-premium">
        <!-- Skyline Header Image -->
        <div class="skyline-header"></div>
        
        <div class="p-8 md:p-10">
            <!-- Logo & Greeting -->
            <div class="text-center mb-8">
                <div class="flex items-center justify-center gap-3 mb-2">
                    <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-xl rotate-12">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <span class="text-3xl font-extrabold tracking-tighter text-slate-900">Kazilink</span>
                </div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">Unganisha Wafanyakazi na Wateja Tanzania</p>
                
                <div class="mt-8">
                    <h2 class="text-2xl font-black text-slate-800">Create a New Account</h2>
                    <p class="text-xs text-slate-400 mt-1">Anza safari yako na KaziLink leo!</p>
                </div>
            </div>

            <!-- Signup Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                
                <div class="space-y-4">
                    <!-- Full Name -->
                    <input type="text" name="name" placeholder="Full Name" required class="input-auth">

                    <!-- Phone Input with Indicator -->
                    <div class="flex items-center bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 focus-within:ring-4 focus-within:ring-blue-500/10 focus-within:border-blue-600 focus-within:bg-white transition-all">
                        <div class="flex items-center gap-2 pr-4 border-r border-slate-200 mr-4">
                            <span class="text-sm font-bold text-slate-700">+255</span>
                        </div>
                        <input type="text" name="phone" placeholder="789 123 456" required
                               class="bg-transparent border-none p-0 focus:ring-0 w-full text-base font-bold text-slate-900 placeholder:text-slate-300">
                    </div>

                    <!-- Location Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <select name="region" required class="input-auth !text-xs !py-4 appearance-none">
                            <option value="">Select Region</option>
                            <option value="Dar es Salaam">Dar es Salaam</option>
                            <option value="Arusha">Arusha</option>
                            <option value="Mwanza">Mwanza</option>
                        </select>
                        <select name="district" required class="input-auth !text-xs !py-4 appearance-none">
                            <option value="">Select District</option>
                            <option value="Kinondoni">Kinondoni</option>
                            <option value="Ilala">Ilala</option>
                            <option value="Temeke">Temeke</option>
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="space-y-1">
                        <input type="password" name="password" placeholder="••••••••••••" required class="input-auth">
                        <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest text-right pr-2">8+ characters minimum</p>
                    </div>
                </div>

                <button type="submit" class="btn-primary-kazi uppercase tracking-[0.2em] text-xs mt-2">
                    Sign Up
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest leading-relaxed">
                    By signing up, you agree to our <br/>
                    <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a> and <a href="#" class="text-blue-600 hover:underline">Terms of Service</a>
                </p>
            </div>

            <!-- Secure Signup Features Section -->
            <div class="mt-10 p-6 bg-slate-50 rounded-[2rem] border border-slate-100 flex items-start gap-5">
                <div class="flex-grow space-y-4">
                    <div class="flex items-center gap-2 mb-1">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest">Secure Signup</h4>
                    </div>
                    
                    <div class="space-y-2.5">
                        <div class="flex items-center gap-2.5">
                            <div class="checklist-bullet">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" /></svg>
                            </div>
                            <span class="text-[9px] font-bold text-slate-600 uppercase tracking-widest">OTP verification</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <div class="checklist-bullet">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" /></svg>
                            </div>
                            <span class="text-[9px] font-bold text-slate-600 uppercase tracking-widest">Upload NIDA or voter ID</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <div class="checklist-bullet">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" /></svg>
                            </div>
                            <span class="text-[9px] font-bold text-slate-600 uppercase tracking-widest">Verified badge for experts</span>
                        </div>
                    </div>

                    <div class="pt-2 border-t border-slate-200/50">
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest leading-loose">
                            Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 transition-colors">Log In &rarr;</a>
                        </p>
                    </div>
                </div>

                <!-- Profile Photo Mockup -->
                <div class="flex-shrink-0 flex flex-col items-center gap-3">
                    <div class="w-24 h-24 bg-white border border-slate-100 rounded-[2rem] flex items-center justify-center text-slate-300 shadow-xl shadow-blue-500/5 relative overflow-hidden group">
                        <svg class="w-12 h-12 transition-transform group-hover:scale-110 duration-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" /></svg>
                        
                        <div class="absolute bottom-2 right-2 w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center text-white border-2 border-white">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" /></svg>
                        </div>
                    </div>
                    <button type="button" class="bg-blue-600 text-[8px] font-black text-white px-4 py-2 rounded-xl uppercase tracking-widest shadow-md hover:bg-blue-700 transition-colors">Upload Photo</button>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
