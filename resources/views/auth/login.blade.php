<x-guest-layout>
    <div class="glass-card rounded-[3.5rem] overflow-hidden flex flex-col md:flex-row shadow-2xl min-h-[650px]">
        <!-- Form Section -->
        <div class="flex-1 p-12 md:p-16 flex flex-col justify-center">
            <div class="mb-12">
                <a href="/" class="inline-block mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="KaziLink" class="h-12 w-auto dark:filter dark:invert">
                </a>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white uppercase tracking-tighter mb-4">
                    Secure <span class="gradient-text">Uplink</span>
                </h1>
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.3em]">Accessing Professional Network v2.0</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <div class="space-y-4">
                    <div class="group">
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4 mb-2 block">Identity Identifier</label>
                        <div class="bg-white/5 dark:bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-5 flex items-center gap-4 focus-within:border-brand-500/50 transition-all">
                            <svg class="h-4 w-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" /></svg>
                            <input id="email" type="text" name="email" placeholder="Email / Phone" class="bg-transparent border-none p-0 focus:ring-0 w-full text-slate-900 dark:text-white font-black text-xs uppercase tracking-widest placeholder:text-slate-400" required autofocus>
                        </div>
                    </div>

                    <div class="group">
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4 mb-2 block">Access Code</label>
                        <div class="bg-white/5 dark:bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-5 flex items-center gap-4 focus-within:border-brand-500/50 transition-all">
                            <svg class="h-4 w-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            <input id="password" type="password" name="password" placeholder="••••••••" class="bg-transparent border-none p-0 focus:ring-0 w-full text-slate-900 dark:text-white font-black text-xs tracking-[0.3em] placeholder:text-slate-400" required>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between px-2">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-white/10 bg-white/5 text-brand-500 focus:ring-brand-500 focus:ring-offset-0">
                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest group-hover:text-slate-700 dark:group-hover:text-slate-300 transition-colors">Maintain Session</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-[9px] font-black text-brand-500 uppercase tracking-widest hover:text-brand-400 transition" href="{{ route('password.request') }}">Recover Key</a>
                    @endif
                </div>

                <button type="submit" class="premium-button w-full py-6 rounded-[2rem] text-[10px] font-black uppercase tracking-[0.3em] shadow-xl mt-8">
                    Establish Connection
                </button>
            </form>
        </div>

        <!-- Info Section -->
        <div class="hidden md:flex w-[400px] bg-slate-900 relative flex-col justify-center p-16 text-white overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-brand-500 opacity-20 rounded-full blur-[100px] -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-500 opacity-20 rounded-full blur-[100px] -ml-32 -mb-32"></div>
            
            <div class="relative z-10">
                <h2 class="text-4xl font-black uppercase tracking-tighter leading-none mb-6">NEW HERE?</h2>
                <p class="text-sm text-slate-400 font-medium leading-relaxed mb-12">Join Tanzania's most sophisticated network of elite professionals and visionary clients.</p>
                <a href="{{ route('register') }}" class="inline-block px-10 py-5 border-2 border-white/20 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-white hover:text-slate-900 transition-all duration-500">
                    Create Identity
                </a>
            </div>

            <!-- Stats/Trust in the corner -->
            <div class="absolute bottom-12 left-16 right-16 flex items-center justify-between opacity-30">
                <div class="text-[8px] font-black uppercase tracking-[0.2em]">Verified Ops: 4.2k</div>
                <div class="text-[8px] font-black uppercase tracking-[0.2em]">SLA: 99.9%</div>
            </div>
        </div>
    </div>
</x-guest-layout>
