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
                    <!-- Modern Icon Container -->
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-brand-50 rounded-full mb-6 relative">
                        <div class="absolute inset-0 bg-brand-200 rounded-full animate-ping opacity-20"></div>
                        <svg class="w-10 h-10 text-brand-600 relative" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    
                    <h2 class="text-3xl font-display font-bold text-slate-900 tracking-tight">Verify your identity</h2>
                    <p class="mt-3 text-slate-500 text-lg leading-relaxed px-2">
                        {{ __('To keep KaziLink secure, we\'ve sent a verification link to your email. Please click it to continue.') }}
                    </p>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-3">
                        <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <p class="text-sm font-semibold text-emerald-800">
                            {{ __('Success! A new link has been sent to your inbox.') }}
                        </p>
                    </div>
                @endif

                <div class="space-y-6">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full group relative flex justify-center py-4 px-4 border border-transparent text-sm font-bold rounded-2xl text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all shadow-xl shadow-brand-600/30 overflow-hidden transform active:scale-95">
                            <span class="relative z-10">{{ __('Resend Activation Email') }}</span>
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        </button>
                    </form>

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-slate-100"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-slate-400">or</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex justify-center py-3.5 px-4 bg-slate-50 hover:bg-slate-100 text-slate-600 font-bold rounded-2xl transition-all border border-slate-100">
                            {{ __('Return to home') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Footer Help -->
            <p class="mt-8 text-center text-sm text-slate-400">
                Can't find the email? Check your <span class="text-slate-500 font-semibold">Spam folder</span> or <a href="#" class="text-brand-600 font-bold hover:text-brand-500">Contact Support</a>
            </p>
        </div>
    </div>
</x-guest-layout>
