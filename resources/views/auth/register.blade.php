<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center p-4 bg-slate-50 relative overflow-hidden">
        <!-- City silhouette decorative background (top) -->
        <div class="absolute top-0 left-0 right-0 h-48 bg-gradient-to-b from-blue-100/50 to-transparent pointer-events-none">
             <div class="absolute bottom-0 w-full opacity-10">
                <svg viewBox="0 0 1000 100" preserveAspectRatio="none" class="w-full h-24 fill-blue-900">
                    <path d="M0 100 L0 80 L50 40 L100 80 L150 20 L200 80 L250 50 L300 90 L350 30 L400 70 L450 10 L500 80 L550 40 L600 70 L650 30 L700 80 L750 50 L800 90 L850 40 L900 70 L950 20 L1000 80 L1000 100 Z" />
                </svg>
             </div>
        </div>

        <div class="auth-card relative z-10 flex flex-col gap-6">
            <!-- Logo & Greeting -->
            <div class="text-center">
                <div class="flex items-center justify-center gap-2 mb-2">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold rotate-12">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-slate-800">KaziLink</span>
                </div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Unganisha Wafanyakazi na Wateja Tanzania</p>
                
                <div class="mt-6">
                    <h2 class="text-2xl font-bold text-slate-800">Create a New Account</h2>
                    <p class="text-xs text-slate-400 mt-1">Anza safari yako na KaziLink leo.</p>
                </div>
            </div>

            <!-- Signup Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                
                <div class="space-y-3">
                    <!-- Full Name -->
                    <input type="text" name="name" placeholder="Full Name" required
                           class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition-all font-medium text-slate-800">

                    <!-- Phone Input -->
                    <div class="flex items-center bg-white border border-slate-200 rounded-xl px-4 py-3 focus-within:ring-2 focus-within:ring-blue-500/20 focus-within:border-blue-600 transition-all">
                        <select class="bg-transparent border-none p-0 focus:ring-0 text-xs font-bold text-slate-600 pr-4 mr-3 border-r border-slate-200 appearance-none">
                            <option>+255</option>
                        </select>
                        <input type="text" name="phone" placeholder="789 123 456" required
                               class="bg-transparent border-none p-0 focus:ring-0 w-full text-sm font-medium text-slate-800 placeholder:text-slate-300">
                    </div>

                    <!-- Location Dropdowns -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="relative">
                            <select name="region" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs font-bold text-slate-600 appearance-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition-all">
                                <option value="">Select Region</option>
                                <option value="Dar es Salaam">Dar es Salaam</option>
                                <option value="Arusha">Arusha</option>
                                <option value="Mwanza">Mwanza</option>
                            </select>
                            <svg class="w-4 h-4 absolute right-3 top-3.5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                        <div class="relative">
                            <select name="district" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs font-bold text-slate-600 appearance-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition-all">
                                <option value="">Select District</option>
                            </select>
                            <svg class="w-4 h-4 absolute right-3 top-3.5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="space-y-1 text-right">
                        <input id="password" type="password" name="password" placeholder="••••••••••••" required
                               class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition-all font-medium text-slate-800">
                        <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest pr-2">8+ characters minimum</p>
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full !rounded-2xl py-4 shadow-lg shadow-blue-600/20 uppercase tracking-[0.2em] text-xs font-bold">
                    Sign Up
                </button>
            </form>

            <div class="text-center">
                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest leading-loose">
                    By signing up, you agree to our <br/>
                    <a href="#" class="text-blue-600">Privacy Policy</a> and <a href="#" class="text-blue-600">Terms of Service</a>
                </p>
            </div>

            <!-- Secure Signup Features -->
            <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100 flex items-start gap-4">
                <div class="flex-grow space-y-3">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Secure Signup</h4>
                    </div>
                    
                    <ul class="space-y-2">
                        <li class="checklist-item">
                            <svg class="checklist-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></li>
                            <span>OTP verification</span>
                        </li>
                        <li class="checklist-item">
                            <svg class="checklist-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></li>
                            <span>Upload NIDA, license, or voter ID</span>
                        </li>
                        <li class="checklist-item">
                            <svg class="checklist-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></li>
                            <span>Verified badge for trusted workers</span>
                        </li>
                    </ul>

                    <div class="pt-2">
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                            Already have an account? <a href="{{ route('login') }}" class="text-blue-600 ml-1">Log In &rarr;</a>
                        </p>
                    </div>
                </div>

                <!-- Profile Mockup Icon -->
                <div class="flex-shrink-0 flex flex-col items-center gap-2">
                    <div class="w-20 h-20 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-300 shadow-sm overflow-hidden">
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" /></svg>
                    </div>
                    <button type="button" class="bg-blue-600 text-[8px] font-black text-white px-3 py-1.5 rounded-lg uppercase tracking-widest leading-none">Upload Photo</button>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
