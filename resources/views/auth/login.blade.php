<x-guest-layout>
    <div class="glass-card overflow-hidden">
        <!-- Glossy Accent Top -->
        <div class="h-1.5 w-full bg-gradient-to-r from-brand-600 via-emerald-400 to-brand-600"></div>

        <div class="p-10 md:p-12">
            <!-- Branding Section -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center p-4 bg-brand-600/10 rounded-3xl border border-brand-600/20 mb-6 group transition-all hover:bg-brand-600/20">
                    <svg class="w-10 h-10 text-brand-600 transition-transform group-hover:scale-110 duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h1 class="text-4xl font-extrabold font-outfit tracking-tight text-white mb-2">Welcome Back</h1>
                <p class="text-white/50 font-medium italic">KaziLink: Connect. Work. Grow.</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-8" x-data="{ state: 'phone' }">
                @csrf
                
                <div class="space-y-6">
                    <!-- Phone Input Section -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-white/40 uppercase tracking-[0.2em] ml-2">Phone Number</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-6 flex items-center pr-4 border-r border-white/10">
                                <span class="text-brand-600 font-bold text-sm">+255</span>
                            </div>
                            <input type="text" name="phone" placeholder="789 123 456" required
                                   class="input-premium !pl-24 group-hover:border-white/20">
                            
                            <!-- Success indicator (decorative) -->
                            <div class="absolute right-6 inset-y-0 flex items-center text-emerald-500 opacity-0 group-focus-within:opacity-100 transition-opacity">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- OTP Grid (Hidden initially, shown after send) -->
                    <div x-show="state === 'otp'" x-cloak x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4" class="space-y-4">
                        <div class="flex justify-between gap-3">
                            @foreach(range(1,4) as $i)
                            <input type="text" maxlength="1" 
                                   class="w-full h-16 bg-white/5 border border-white/10 rounded-2xl text-center font-bold text-2xl text-white focus:ring-2 focus:ring-brand-600/50 focus:border-brand-600 outline-none">
                            @endforeach
                        </div>
                        <div class="text-center">
                            <button type="button" class="text-xs font-bold text-white/30 uppercase tracking-widest hover:text-brand-600 transition-colors">
                                Resend code in <span class="text-brand-600">00:59</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="pt-2">
                    <button type="button" @click="state = 'otp'" x-show="state === 'phone'" class="btn-premium py-5 text-sm uppercase tracking-widest">
                        <span>Authenticate</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </button>
                    
                    <button type="submit" x-show="state === 'otp'" class="btn-premium py-5 text-sm uppercase tracking-widest bg-emerald-600 shadow-emerald-600/20 hover:bg-emerald-700">
                        <span>Continue to Dashboard</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </button>
                </div>
            </form>

            <div class="mt-12 pt-10 border-t border-white/5 text-center">
                <p class="text-white/30 text-xs font-semibold uppercase tracking-widest mb-6">Secured by KaziLink Infrastructure</p>
                <div class="flex items-center justify-center gap-4 opacity-20 hover:opacity-100 transition-opacity duration-700 grayscale cursor-default">
                    @php $carriers = ['M-Pesa', 'Tigo-Pesa', 'Airtel Money', 'HaloPesa']; @endphp
                    @foreach($carriers as $carrier)
                        <span class="text-[10px] font-black text-white px-3 py-1.5 border border-white/10 rounded-lg whitespace-nowrap">{{ $carrier }}</span>
                    @endforeach
                </div>
            </div>

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-white/40 text-xs font-medium">New here? <a href="{{ route('register') }}" class="text-brand-600 font-bold hover:underline underline-offset-4">Create account</a></p>
                <div class="flex gap-4">
                    <a href="#" class="text-white/20 text-[10px] uppercase font-bold tracking-widest hover:text-white transition-colors">Safety</a>
                    <a href="#" class="text-white/20 text-[10px] uppercase font-bold tracking-widest hover:text-white transition-colors">Privacy</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
