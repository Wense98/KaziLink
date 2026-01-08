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

        <div class="auth-card relative z-10 flex flex-col gap-8">
            <!-- Logo & Greeting -->
            <div class="text-center">
                <div class="flex items-center justify-center gap-2 mb-2">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold rotate-12">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-slate-800">KaziLink</span>
                </div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Unganisha Wafanyakazi na Wateja Tanzania</p>
                
                <div class="mt-8">
                    <h2 class="text-2xl font-bold text-slate-800">Login to <span class="text-blue-600">KaziLink</span></h2>
                    <p class="text-xs text-slate-400 mt-1">Karibu tena! Ingia uendelee na kazi zako.</p>
                </div>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <div class="space-y-4">
                    <!-- Phone Input -->
                    <div class="relative">
                        <div class="flex items-center bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus-within:ring-2 focus-within:ring-blue-500/20 focus-within:border-blue-600 transition-all">
                            <span class="flex items-center gap-2 pr-3 border-r border-slate-200 mr-3">
                                <span class="w-4 h-3 bg-emerald-500 rounded-sm"></span>
                                <span class="text-xs font-bold text-slate-600">+255</span>
                            </span>
                            <input type="text" name="phone" placeholder="789 123 456" 
                                   class="bg-transparent border-none p-0 focus:ring-0 w-full text-sm font-bold text-slate-800 placeholder:text-slate-300">
                        </div>
                    </div>

                    <!-- OTP Inputs -->
                    <div class="flex justify-between gap-2">
                        <input type="text" maxlength="1" class="otp-input" value="•">
                        <input type="text" maxlength="1" class="otp-input" value="•">
                        <input type="text" maxlength="1" class="otp-input" value="•">
                        <input type="text" maxlength="1" class="otp-input" value="•">
                    </div>
                    <div class="text-center">
                        <button type="button" class="text-[10px] font-bold text-slate-400 hover:text-blue-600 uppercase tracking-wider transition-colors">
                            Resend OTP in <span class="text-slate-600">00:39</span>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full !rounded-2xl py-4 shadow-lg shadow-blue-600/20 uppercase tracking-widest text-xs">
                    Send OTP
                </button>
            </form>

            <!-- Secure Login Features -->
            <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100 flex items-start gap-4">
                <div class="flex-grow space-y-3">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Secure Login</h4>
                    </div>
                    
                    <ul class="space-y-2">
                        <li class="checklist-item">
                            <svg class="checklist-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></li>
                            <span>Verify number with OTP</span>
                        </li>
                        <li class="checklist-item">
                            <svg class="checklist-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></li>
                            <span>Data encryption</span>
                        </li>
                        <li class="checklist-item">
                            <svg class="checklist-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></li>
                            <span>Location protected</span>
                        </li>
                        <li class="checklist-item">
                            <svg class="checklist-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></li>
                            <span>Verified workers</span>
                        </li>
                    </ul>

                    <div class="pt-2">
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                            Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 ml-1">Sign Up &rarr;</a>
                        </p>
                    </div>
                </div>

                <!-- Biometric Mockup Icon -->
                <div class="flex-shrink-0 flex flex-col items-center gap-2">
                    <div class="w-16 h-16 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-blue-600 shadow-sm p-3">
                        <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A10.003 10.003 0 0012 21a10.003 10.003 0 008.139-4.139l.054.09m-8.194-1.04C10.009 13.201 9 9.919 9 6.401 9 5.378 9.117 4.383 9.339 3.43M12 11c1.744 2.772 2.753 6.054 2.753 9.571m3.44-2.04l-.054-.09c.512-.906.866-1.892 1.05-2.93m-8.194-1.04C13.991 13.201 15 9.919 15 6.401c0-1.023-.117-2.017-.339-2.97M12 11c0-3.517 1.009-6.799 2.753-9.571M8.56 5.139a9.961 9.961 0 011.833-3.089m8.194 10.4c-.512.906-.866 1.892-1.05 2.93M15.44 5.139a9.961 9.961 0 00-1.833-3.089" /></svg>
                    </div>
                    <button type="button" class="bg-blue-600 text-[8px] font-black text-white px-3 py-1.5 rounded-lg uppercase tracking-widest leading-none">Upload Photo</button>
                </div>
            </div>

            <!-- Footer Logos -->
            <div class="pt-4 border-t border-slate-100">
                <p class="text-center text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Login Help</p>
                <div class="flex items-center justify-center gap-4 opacity-50 grayscale hover:grayscale-0 transition-all">
                    <!-- Placeholder logos representing M-Pesa, etc. -->
                    <span class="text-[8px] font-black border border-slate-300 px-1.5 py-0.5 rounded leading-none text-slate-500">M-PESA</span>
                    <span class="text-[8px] font-black border border-slate-300 px-1.5 py-0.5 rounded leading-none text-slate-500">TIGO PESA</span>
                    <span class="text-[8px] font-black border border-slate-300 px-1.5 py-0.5 rounded leading-none text-slate-500">AIRTEL</span>
                    <span class="text-[8px] font-black border border-slate-300 px-1.5 py-0.5 rounded leading-none text-slate-500">HALOPESA</span>
                </div>
            </div>

            <div class="flex justify-center gap-6 mt-2">
                <a href="#" class="text-[10px] font-bold text-slate-400 hover:text-blue-600 uppercase tracking-widest">Privacy Policy</a>
                <a href="#" class="text-[10px] font-bold text-slate-400 hover:text-blue-600 uppercase tracking-widest">Terms of Service</a>
            </div>
        </div>
    </div>
</x-guest-layout>
