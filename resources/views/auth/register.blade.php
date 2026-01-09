<x-guest-layout>
    <div class="glass-card overflow-hidden" x-data="{ role: 'customer' }">
        <!-- Glossy Accent Top -->
        <div class="h-1.5 w-full bg-gradient-to-r from-brand-600 via-purple-400 to-brand-600"></div>

        <div class="p-10 md:p-12">
            <!-- Branding/Title Section -->
            <div class="text-center mb-10">
                <h1 class="text-4xl font-extrabold font-outfit tracking-tight text-white mb-2">Create Account</h1>
                <p class="text-white/40 text-sm font-medium">Join the premium service network of Tanzania</p>
            </div>

            <!-- Signup Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                
                <!-- Role Selector -->
                <div class="grid grid-cols-2 gap-4 p-1.5 bg-white/5 rounded-3xl border border-white/5 mb-8">
                    <button type="button" 
                            @click="role = 'customer'"
                            :class="role === 'customer' ? 'bg-brand-600 text-white shadow-lg' : 'text-white/40 hover:text-white/60'"
                            class="py-3.5 rounded-2xl text-[10px] uppercase font-black tracking-widest transition-all">
                        I am a Client
                    </button>
                    <button type="button" 
                            @click="role = 'worker'"
                            :class="role === 'worker' ? 'bg-brand-600 text-white shadow-lg' : 'text-white/40 hover:text-white/60'"
                            class="py-3.5 rounded-2xl text-[10px] uppercase font-black tracking-widest transition-all">
                        I am a Worker
                    </button>
                    <input type="hidden" name="role" :value="role">
                </div>

                <div class="space-y-4">
                    <!-- Full Name -->
                    <div class="group">
                        <input type="text" name="name" placeholder="Full Name" required 
                               class="input-premium group-hover:border-white/20">
                    </div>

                    <!-- Phone -->
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-6 flex items-center pr-4 border-r border-white/10">
                            <span class="text-brand-600 font-bold text-sm">+255</span>
                        </div>
                        <input type="text" name="phone" placeholder="789 123 456" required
                               class="input-premium !pl-24 group-hover:border-white/20">
                    </div>

                    <!-- Location Split -->
                    <div class="grid grid-cols-2 gap-4">
                        <select name="region" required class="input-premium !text-xs !py-4 appearance-none group hover:border-white/20">
                            <option value="" class="bg-[#020617]">Region</option>
                            <option value="Dar es Salaam" class="bg-[#020617]">Dar es Salaam</option>
                            <option value="Arusha" class="bg-[#020617]">Arusha</option>
                            <option value="Mwanza" class="bg-[#020617]">Mwanza</option>
                        </select>
                        <select name="district" required class="input-premium !text-xs !py-4 appearance-none group hover:border-white/20">
                            <option value="" class="bg-[#020617]">District</option>
                            <option value="Kinondoni" class="bg-[#020617]">Kinondoni</option>
                            <option value="Ilala" class="bg-[#020617]">Ilala</option>
                            <option value="Temeke" class="bg-[#020617]">Temeke</option>
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="group">
                        <input type="password" name="password" placeholder="Account Password" required 
                               class="input-premium group-hover:border-white/20">
                    </div>
                </div>

                <!-- Terms -->
                <div class="pt-2 px-2">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" required class="w-5 h-5 rounded-lg bg-white/5 border-white/10 text-brand-600 focus:ring-brand-600/30">
                        <span class="text-[10px] text-white/40 font-medium leading-normal group-hover:text-white/60 transition-colors">
                            I agree to the <a href="#" class="text-brand-600 font-bold hover:underline">Privacy Policy</a> and <a href="#" class="text-brand-600 font-bold hover:underline">Terms of Service</a>
                        </span>
                    </label>
                </div>

                <!-- Action Button -->
                <div class="pt-4">
                    <button type="submit" class="btn-premium py-5 text-sm uppercase tracking-widest">
                        <span>Initialize Account</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </div>
            </form>

            <div class="mt-10 flex items-center justify-center">
                <p class="text-white/40 text-xs font-medium">Already have an account? <a href="{{ route('login') }}" class="text-brand-600 font-bold hover:underline underline-offset-4 ml-1">Sign In</a></p>
            </div>
        </div>
    </div>
</x-guest-layout>
