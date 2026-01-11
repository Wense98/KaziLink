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
                    <h1 class="text-4xl font-display font-bold leading-tight mb-6">Start Your Journey.</h1>
                    <p class="text-lg text-brand-100 font-light leading-relaxed">Join thousands of verified workers and clients building the future of work in Tanzania.</p>
                </div>
                
                <div class="grid grid-cols-1 gap-6">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/10">
                        <div class="text-2xl font-bold mb-1">15k+</div>
                        <div class="text-sm text-brand-200">Active Jobs Posted</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/10">
                        <div class="text-2xl font-bold mb-1">4.9/5</div>
                        <div class="text-sm text-brand-200">Average Worker Rating</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Signup Form -->
        <div class="flex flex-col justify-center items-center p-8 lg:p-12 bg-white overflow-y-auto h-screen">
            <div class="w-full max-w-md space-y-8 my-auto">
                <div class="lg:hidden mb-8">
                    <img src="{{ asset('images/logo.png') }}" class="h-8 w-auto">
                </div>
                
                <div class="text-center lg:text-left">
                    <h2 class="text-3xl font-display font-bold text-slate-900 tracking-tight">Create an account</h2>
                    <p class="mt-2 text-slate-500">Choose your role to get started.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6" x-data="{ role: 'customer' }">
                    @csrf
                    
                    <!-- Role Selection -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="relative">
                            <input type="radio" name="role" value="customer" id="role-customer" class="peer sr-only" x-model="role">
                            <label for="role-customer" class="flex flex-col items-center justify-center p-4 bg-white border-2 border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 peer-checked:border-brand-600 peer-checked:bg-brand-50 transition-all">
                                <svg class="w-8 h-8 text-slate-400 peer-checked:text-brand-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                <span class="text-sm font-bold text-slate-700 peer-checked:text-brand-700">Client</span>
                            </label>
                            <!-- Checkmark overlay -->
                            <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 text-brand-600 transition-opacity">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            </div>
                        </div>

                        <div class="relative">
                            <input type="radio" name="role" value="worker" id="role-worker" class="peer sr-only" x-model="role">
                            <label for="role-worker" class="flex flex-col items-center justify-center p-4 bg-white border-2 border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 peer-checked:border-brand-600 peer-checked:bg-brand-50 transition-all">
                                <svg class="w-8 h-8 text-slate-400 peer-checked:text-brand-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span class="text-sm font-bold text-slate-700 peer-checked:text-brand-700">Worker</span>
                            </label>
                            <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 text-brand-600 transition-opacity">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Full Legal Name</label>
                            <input id="name" name="name" type="text" required
                                class="form-input-premium"
                                placeholder="John Doe">
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs font-bold text-red-500" />
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-semibold text-slate-700 mb-2">Phone Number</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-slate-500 font-bold text-sm">+255</span>
                                </div>
                                <input id="phone" name="phone" type="text" required
                                    class="form-input-premium !pl-16"
                                    placeholder="712 345 678">
                            </div>
                            <x-input-error :messages="$errors->get('phone')" class="mt-2 text-xs font-bold text-red-500" />
                        </div>

                        <!-- Location Grid -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="region" class="block text-sm font-semibold text-slate-700 mb-2">Region</label>
                                <div class="relative">
                                    <select id="region" name="region" class="form-input-premium appearance-none">
                                        <option value="">Select Region</option>
                                        <option value="Dar es Salaam">Dar es Salaam</option>
                                        <option value="Arusha">Arusha</option>
                                        <option value="Mwanza">Mwanza</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('region')" class="mt-2 text-xs font-bold text-red-500" />
                            </div>
                            <div>
                                <label for="district" class="block text-sm font-semibold text-slate-700 mb-2">District</label>
                                <div class="relative">
                                    <input id="district" name="district" type="text" required
                                           class="form-input-premium"
                                           placeholder="e.g. Kinondoni">
                                </div>
                                <x-input-error :messages="$errors->get('district')" class="mt-2 text-xs font-bold text-red-500" />
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Create Password</label>
                            <input id="password" name="password" type="password" required
                                class="form-input-premium"
                                placeholder="Min. 8 characters">
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-red-500" />
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-brand-600 focus:ring-brand-500 border-slate-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-medium text-slate-600">I agree to the <a href="#" class="text-brand-600 hover:text-brand-500 underline">Terms</a> and <a href="#" class="text-brand-600 hover:text-brand-500 underline">Privacy Policy</a></label>
                        </div>
                    </div>

                    <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-brand-600/20 text-sm font-bold text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all transform active:scale-[0.98]">
                        Create Account
                    </button>

                    <p class="mt-8 text-center text-sm text-slate-500">
                        Already have an account? <a href="{{ route('login') }}" class="font-bold text-brand-600 hover:text-brand-500">Sign in</a>
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
