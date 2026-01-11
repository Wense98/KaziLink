<x-guest-layout>
    <div class="grid lg:grid-cols-2 min-h-screen">
        <!-- Left Side: Brand Panel -->
        <div class="hidden lg:flex relative bg-slate-900 justify-center items-center overflow-hidden">
            <!-- Background Image -->
            <img src="{{ asset('images/auth_sidebar.png') }}" alt="City Skyline" class="absolute inset-0 w-full h-full object-cover opacity-80 mix-blend-overlay">
            
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-tr from-brand-900/90 to-slate-900/40 mix-blend-multiply"></div>

            <!-- Content -->
            <div class="relative z-10 w-full max-w-md px-12 text-white">
                <div class="mb-12">
                    <img src="{{ asset('images/logo.png') }}" alt="KaziLink" class="h-10 w-auto mb-8 filter brightness-0 invert">
                    <h1 class="text-5xl font-display font-bold leading-tight mb-6">Connect with Tanzania's Top Talent.</h1>
                    <p class="text-lg text-brand-100 font-light leading-relaxed">Join the most trusted network of verified professionals. Fast, secure, and built for growth.</p>
                </div>
                
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center border border-white/20 backdrop-blur-sm">
                            <svg class="w-6 h-6 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <div class="font-bold text-white">Verified Identity</div>
                            <div class="text-sm text-brand-200">Every professional is rigorously vetted.</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center border border-white/20 backdrop-blur-sm">
                            <svg class="w-6 h-6 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <div>
                            <div class="font-bold text-white">Bank-Grade Security</div>
                            <div class="text-sm text-brand-200">Your data is encrypted and protected.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="flex flex-col justify-center items-center p-8 lg:p-12 bg-white">
            <div class="w-full max-w-md space-y-8">
                <div class="lg:hidden mb-8">
                    <img src="{{ asset('images/logo.png') }}" class="h-8 w-auto">
                </div>
                
                <div class="text-center lg:text-left">
                    <h2 class="text-3xl font-display font-bold text-slate-900 tracking-tight">Welcome back</h2>
                    <p class="mt-2 text-slate-500">Please enter your credentials to access your dashboard.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                    @csrf
                    
                    <div class="space-y-4">
                        <div>
                            <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email or Phone</label>
                            <input id="email" name="email" type="text" autocomplete="email" required
                                class="form-input-premium"
                                placeholder="name@example.com or 07XXXXXXXX">
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-red-500" />
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
                                <a href="{{ route('password.request') }}" class="text-xs font-semibold text-brand-600 hover:text-brand-500">Forgot password?</a>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="form-input-premium"
                                placeholder="••••••••">
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-red-500" />
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember" type="checkbox" class="h-4 w-4 text-brand-600 focus:ring-brand-500 border-slate-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-slate-600 font-medium">Remember me</label>
                        </div>
                    </div>

                    <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-brand-600/20 text-sm font-bold text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all transform active:scale-[0.98]">
                        Sign in to account
                    </button>
                    
                    <!-- Social / Alt Login Placeholder -->
                    <div class="relative mt-8">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-slate-400 font-medium tracking-wide text-xs uppercase">Or continue with</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-6">
                        <button type="button" class="flex items-center justify-center px-4 py-2.5 border border-slate-200 rounded-lg shadow-sm bg-white text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12.24 10.285V14.4h6.806c-.275 1.765-2.056 5.174-6.806 5.174-4.095 0-7.439-3.389-7.439-7.574s3.345-7.574 7.439-7.574c2.33 0 3.891.989 4.785 1.849l3.254-3.138C18.189 1.186 15.479 0 12.24 0c-6.635 0-12 5.365-12 12s5.365 12 12 12c6.926 0 11.52-4.869 11.52-11.726 0-.788-.085-1.39-.189-1.989H12.24z"/></svg>
                            Google
                        </button>
                        <button type="button" class="flex items-center justify-center px-4 py-2.5 border border-slate-200 rounded-lg shadow-sm bg-white text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors">
                            <span class="sr-only">Phone</span>
                            <svg class="h-5 w-5 mr-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            Phone OTP
                        </button>
                    </div>

                    <p class="mt-8 text-center text-sm text-slate-500">
                        Don't have an account? <a href="{{ route('register') }}" class="font-bold text-brand-600 hover:text-brand-500">Create one for free</a>
                    </p>
                </form>

                 <div class="mt-4">
                     @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">
                                {{ __('Whoops! Something went wrong.') }}
                            </div>

                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
