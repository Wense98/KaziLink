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
                    <h2 class="text-2xl font-black text-slate-800">Login to <span class="text-blue-600">KaziLink</span></h2>
                    <p class="text-xs text-slate-400 mt-1">Paglamban Kimzamal bel itif amawrara!</p>
                </div>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <div class="space-y-4">
                    <!-- Phone Input with Indicator -->
                    <div class="relative group">
                        <div class="flex items-center bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 focus-within:ring-4 focus-within:ring-blue-500/10 focus-within:border-blue-600 focus-within:bg-white transition-all">
                            <span class="flex items-center gap-2 pr-4 border-r border-slate-200 mr-4">
                                <span class="w-5 h-3 bg-emerald-500 rounded-sm shadow-sm ring-1 ring-slate-200"></span>
                                <span class="text-sm font-bold text-slate-700">+255</span>
                            </span>
                            <input type="text" name="phone" placeholder="789 123 456" required
                                   class="bg-transparent border-none p-0 focus:ring-0 w-full text-base font-bold text-slate-900 placeholder:text-slate-300">
                        </div>
                    </div>

                    <!-- OTP Grid -->
                    <div class="flex justify-between gap-3">
                        <input type="text" maxlength="1" class="otp-box-kazi" placeholder="•">
                        <input type="text" maxlength="1" class="otp-box-kazi" placeholder="•">
                        <input type="text" maxlength="1" class="otp-box-kazi" placeholder="•">
                        <input type="text" maxlength="1" class="otp-box-kazi" placeholder="•">
                    </div>
                    <div class="text-center">
                        <button type="button" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-blue-600 transition-colors">
                            Resend OTP in <span class="text-blue-600">00:39</span>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-primary-kazi uppercase tracking-[0.2em] text-xs">
                    Send OTP
                </button>
            </form>

            <!-- Secure Login Features Section -->
            <div class="mt-10 p-6 bg-slate-50 rounded-[2rem] border border-slate-100 flex items-start gap-5">
                <div class="flex-grow space-y-4">
                    <div class="flex items-center gap-2 mb-1">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest">Secure Login</h4>
                    </div>
                    
                    <div class="space-y-2.5">
                        <div class="flex items-center gap-2.5">
                            <div class="checklist-bullet">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" /></svg>
                            </div>
                            <span class="text-[9px] font-bold text-slate-600 uppercase tracking-widest">Verify number with OTP</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <div class="checklist-bullet">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" /></svg>
                            </div>
                            <span class="text-[9px] font-bold text-slate-600 uppercase tracking-widest">Data encryption</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <div class="checklist-bullet">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" /></svg>
                            </div>
                            <span class="text-[9px] font-bold text-slate-600 uppercase tracking-widest">Location protected</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <div class="checklist-bullet">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" /></svg>
                            </div>
                            <span class="text-[9px] font-bold text-slate-600 uppercase tracking-widest">Verified workers</span>
                        </div>
                    </div>

                    <div class="pt-2 border-t border-slate-200/50">
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest leading-loose">
                            Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 transition-colors">Sign Up &rarr;</a>
                        </p>
                    </div>
                </div>

                <!-- Biometric Mockup -->
                <div class="flex-shrink-0 flex flex-col items-center gap-3">
                    <div class="w-20 h-20 bg-white border border-slate-100 rounded-[1.5rem] flex items-center justify-center text-blue-600 shadow-xl shadow-blue-500/5 relative">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A10.003 10.003 0 0012 21a10.003 10.003 0 008.139-4.139l.054.09m-8.194-1.04C10.009 13.201 9 9.919 9 6.401 9 5.378 9.117 4.383 9.339 3.43M12 11c1.744 2.772 2.753 6.054 2.753 9.571m3.44-2.04l-.054-.09c.512-.906.866-1.892 1.05-2.93m-8.194-1.04C13.991 13.201 15 9.919 15 6.401c0-1.023-.117-2.017-.339-2.97M12 11c0-3.517 1.009-6.799 2.753-9.571M8.56 5.139a9.961 9.961 0 011.833-3.089m8.194 10.4c-.512.906-.866 1.892-1.05 2.93M15.44 5.139a9.961 9.961 0 00-1.833-3.089" /></svg>
                    </div>
                    <button type="button" class="bg-blue-600 text-[8px] font-black text-white px-4 py-2 rounded-xl uppercase tracking-widest shadow-md hover:bg-blue-700 transition-colors">Upload Photo</button>
                </div>
            </div>

            <!-- Footer: Operator Logos -->
            <div class="mt-10 pt-6 border-t border-slate-100">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center mb-6">Login Help</p>
                <div class="flex items-center justify-center gap-6 opacity-40 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-700">
                    <span class="text-[10px] font-black text-slate-500">M-PESA</span>
                    <span class="text-[10px] font-black text-slate-500">TIGO PESA</span>
                    <span class="text-[10px] font-black text-slate-500">Airtel</span>
                    <span class="text-[10px] font-black text-slate-500">Halopesa</span>
                </div>
            </div>

            <div class="flex justify-center gap-6 mt-6 pb-2">
                <a href="#" class="text-[9px] font-bold text-slate-400 uppercase tracking-widest hover:text-blue-600 transition-colors">Privacy Policy</a>
                <a href="#" class="text-[9px] font-bold text-slate-400 uppercase tracking-widest hover:text-blue-600 transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</x-guest-layout>
