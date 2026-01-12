<x-guest-layout>
    <div class="min-h-screen grid lg:grid-cols-2">
        <!-- Left Side: Visual -->
        <div class="hidden lg:flex relative bg-slate-900 justify-center items-center overflow-hidden">
            <img src="{{ asset('images/auth_sidebar.png') }}" alt="Background" class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-overlay">
            <div class="absolute inset-0 bg-gradient-to-tr from-brand-900/90 to-slate-900/50 mix-blend-multiply"></div>
            
            <div class="relative z-10 p-12 text-center text-white max-w-lg">
                <div class="mb-8 flex justify-center">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <h2 class="text-3xl font-display font-bold mb-4">Check your inbox</h2>
                <p class="text-brand-100/80 text-lg leading-relaxed">
                    We've sent a secure verification link to your email address. Please click the link to activate your KaziLink account and start exploring verified workers.
                </p>
            </div>
        </div>

        <!-- Right Side: Content -->
        <div class="flex flex-col justify-center items-center p-8 lg:p-12 bg-white">
            <div class="w-full max-w-md space-y-8">
                <div class="text-center">
                    <img src="{{ asset('images/logo.png') }}" class="h-10 w-auto mx-auto mb-6 lg:hidden">
                    <h2 class="text-3xl font-display font-bold text-slate-900">Verify Email</h2>
                    <p class="mt-2 text-slate-600">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?') }}
                    </p>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="rounded-xl bg-green-50 p-4 border border-green-200">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">
                                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="space-y-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-brand-600/20 text-sm font-bold text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all transform active:scale-[0.98]">
                            {{ __('Resend Verification Email') }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex justify-center py-3.5 px-4 rounded-xl text-sm font-bold text-slate-600 hover:text-slate-900 bg-slate-50 hover:bg-slate-100 transition-colors">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
