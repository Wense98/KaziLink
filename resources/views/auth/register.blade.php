<x-guest-layout>
    <div class="glass-card rounded-[3.5rem] overflow-hidden flex flex-col md:flex-row shadow-2xl min-h-[700px]">
        
        <!-- Info Section (Mobile First / Desktop Left) -->
        <div class="hidden md:flex w-[400px] bg-slate-900 relative flex-col justify-center p-16 text-white overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 left-0 w-64 h-64 bg-brand-500 opacity-20 rounded-full blur-[100px] -ml-32 -mt-32"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-emerald-500 opacity-20 rounded-full blur-[100px] -mr-32 -mb-32"></div>
            
            <div class="relative z-10">
                <h2 class="text-4xl font-black uppercase tracking-tighter leading-none mb-6">WELCOME <br/>BACK</h2>
                <p class="text-sm text-slate-400 font-medium leading-relaxed mb-12">Already have an established identity? Sign in to resume your operations.</p>
                <a href="{{ route('login') }}" class="inline-block px-10 py-5 border-2 border-white/20 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-white hover:text-slate-900 transition-all duration-500">
                    Sign In Protocol
                </a>
            </div>

            <!-- Stats/Trust in the corner -->
            <div class="absolute bottom-12 left-16 right-16 flex items-center justify-between opacity-30">
                <div class="text-[8px] font-black uppercase tracking-[0.2em]">Nodes: 154 Active</div>
                <div class="text-[8px] font-black uppercase tracking-[0.2em]">Latency: 14ms</div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="flex-1 p-12 md:p-16 flex flex-col justify-center">
            <div class="mb-10">
                <a href="/" class="inline-block mb-8 md:hidden">
                    <img src="{{ asset('images/logo.png') }}" alt="KaziLink" class="h-10 w-auto dark:filter dark:invert">
                </a>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white uppercase tracking-tighter mb-4">
                    Initialize <span class="gradient-text">Identity</span>
                </h1>
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.3em]">Registering Unique Professional Signature</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="group col-span-1 md:col-span-2">
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4 mb-2 block">Full Legal Name</label>
                        <div class="bg-white/5 dark:bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 flex items-center gap-4 focus-within:border-brand-500/50 transition-all">
                            <svg class="h-4 w-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            <input id="name" type="text" name="name" placeholder="John Doe" class="bg-transparent border-none p-0 focus:ring-0 w-full text-slate-900 dark:text-white font-black text-xs uppercase tracking-widest placeholder:text-slate-400" required autofocus>
                        </div>
                    </div>

                    <div class="group">
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4 mb-2 block">Comm Link (Email)</label>
                        <div class="bg-white/5 dark:bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 flex items-center gap-4 focus-within:border-brand-500/50 transition-all">
                            <svg class="h-4 w-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" /></svg>
                            <input id="email" type="email" name="email" placeholder="john@example.com" class="bg-transparent border-none p-0 focus:ring-0 w-full text-slate-900 dark:text-white font-black text-xs uppercase tracking-widest placeholder:text-slate-400" required>
                        </div>
                    </div>

                    <div class="group">
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4 mb-2 block">Direct Line (Phone)</label>
                        <div class="bg-white/5 dark:bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 flex items-center gap-4 focus-within:border-brand-500/50 transition-all">
                            <svg class="h-4 w-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            <input id="phone" type="text" name="phone" placeholder="0XXXXXXXXX" class="bg-transparent border-none p-0 focus:ring-0 w-full text-slate-900 dark:text-white font-black text-xs uppercase tracking-widest placeholder:text-slate-400" required>
                        </div>
                    </div>

                    <div class="group col-span-1 md:col-span-2">
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4 mb-2 block">Access Code (Password)</label>
                        <div class="bg-white/5 dark:bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 flex items-center gap-4 focus-within:border-brand-500/50 transition-all">
                            <svg class="h-4 w-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            <input id="password" type="password" name="password" placeholder="••••••••" class="bg-transparent border-none p-0 focus:ring-0 w-full text-slate-900 dark:text-white font-black text-xs tracking-[0.3em] placeholder:text-slate-400" required>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3 px-2 mt-4">
                    <input type="checkbox" id="terms" required class="w-4 h-4 rounded border-white/10 bg-white/5 text-brand-500 focus:ring-brand-500 focus:ring-offset-0">
                    <label for="terms" class="text-[9px] font-black text-slate-500 uppercase tracking-widest cursor-pointer hover:text-slate-700 dark:hover:text-slate-300 transition-colors">I accept the Professional Conduct Protocol</label>
                </div>

                <button type="submit" class="premium-button w-full py-6 rounded-[2rem] text-[10px] font-black uppercase tracking-[0.3em] shadow-xl mt-8">
                    Confirm Registration
                </button>
            </form>
            
            <p class="mt-8 text-center md:hidden text-[9px] font-black text-slate-500 uppercase tracking-widest">
                Have an account? <a href="{{ route('login') }}" class="text-brand-500 ml-1">Sign In</a>
            </p>
        </div>
    </div>
</x-guest-layout>
