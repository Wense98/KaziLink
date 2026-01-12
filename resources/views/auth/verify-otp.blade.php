<x-guest-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute top-0 left-0 w-full h-64 bg-slate-900 skew-y-3 -mt-32 transform origin-top-left -z-10"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-brand-100 rounded-full blur-3xl opacity-50 -mb-32 -mr-32 -z-10"></div>

        <div class="sm:mx-auto sm:w-full sm:max-w-md relative">
            <!-- Branding -->
            <div class="flex justify-center mb-8">
                <div class="p-3 bg-white rounded-2xl shadow-xl shadow-slate-200/50">
                    <img src="{{ asset('images/logo.png') }}" alt="KaziLink" class="h-10 w-auto">
                </div>
            </div>

            <div class="bg-white py-10 px-6 shadow-2xl shadow-slate-200/60 rounded-3xl sm:px-12 border border-slate-100">
                <div class="text-center mb-8">
                    <!-- Icon Container -->
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-brand-50 rounded-full mb-6 relative">
                        <div class="absolute inset-0 bg-brand-200 rounded-full animate-ping opacity-20"></div>
                        <svg class="w-10 h-10 text-brand-600 relative" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-1.34-1.34c-1.39-1.39-2.253-3.321-2.253-5.454 0-2.133.864-4.064 2.253-5.454l1.34-1.34m4.232 4.232c1.39 1.39 2.253 3.321 2.253 5.454 0 2.133-.864 4.064-2.253 5.454l-1.34 1.34m-9.906-3.366l1.34-1.34m12.022-12.022l1.34-1.34"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 10l.948-2.055a3.033 3.033 0 015.547 1.832v.404"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h1m4 0h1m-7 4h.01M11 17h.01M13 17h.01M15 17h.01"></path>
                        </svg>
                    </div>
                    
                    <h2 class="text-3xl font-display font-bold text-slate-900 tracking-tight">Security Code</h2>
                    <p class="mt-3 text-slate-500 text-lg leading-relaxed px-2">
                        {{ __('We\'ve sent a 4-digit verification code to your phone number. Please enter it below to securely activate your account.') }}
                    </p>
                </div>

                @if (session('success'))
                    <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-3">
                        <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <p class="text-sm font-semibold text-emerald-800">
                            {{ session('success') }}
                        </p>
                    </div>
                @endif

                <div class="space-y-6">
                    <form method="POST" action="{{ route('otp.verify') }}">
                        @csrf
                        
                        <div class="mb-8">
                            <label for="otp_code" class="sr-only">OTP Code</label>
                            <div class="flex justify-center">
                                <input id="otp_code" name="otp_code" type="text" required maxlength="4" autofocus
                                    class="w-full max-w-[240px] text-center text-4xl font-display font-bold tracking-[0.75em] py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-brand-500 focus:ring-0 transition-all placeholder:text-slate-200"
                                    placeholder="0000">
                            </div>
                            <x-input-error :messages="$errors->get('otp_code')" class="mt-4 text-center text-sm font-bold text-red-500" />
                        </div>

                        <button type="submit" class="w-full group relative flex justify-center py-4 px-4 border border-transparent text-sm font-bold rounded-2xl text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all shadow-xl shadow-brand-600/30 overflow-hidden transform active:scale-95">
                            <span class="relative z-10 text-lg">{{ __('Verify Account') }}</span>
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        </button>
                    </form>

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-slate-100"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-3 bg-white text-slate-400 font-medium italic">Wait for it...</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('otp.resend') }}">
                        @csrf
                        <button type="submit" class="w-full flex justify-center py-4 px-4 bg-slate-50 hover:bg-slate-100 text-slate-600 font-bold rounded-2xl transition-all border border-slate-100 hover:border-slate-200">
                            {{ __('Didn\'t receive code? Resend Now') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Footer Help -->
            <p class="mt-8 text-center text-sm text-slate-400">
                Facing issues? <a href="mailto:support@kazilink.co.tz" class="text-brand-600 font-bold hover:text-brand-500 underline">Contact KaziLink Support</a>
            </p>
        </div>
    </div>
</x-guest-layout>
