<nav x-data="{ open: false }" class="glass-nav sticky top-0 z-50 dark:bg-slate-900/80 dark:border-slate-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-24">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-4 group">
                        <div class="relative">
                            <div class="absolute inset-0 bg-brand-500/10 blur-xl rounded-full scale-0 group-hover:scale-150 transition-transform duration-500"></div>
                            <img src="{{ asset('images/logo.png') }}" alt="KaziLink Logo" class="h-12 w-auto relative z-10 transition-transform duration-300 group-hover:scale-110">
                        </div>
                        <span class="text-2xl font-black tracking-tight uppercase">
                            <span class="gradient-text">Kazi</span><span class="text-slate-900 dark:text-white">Link</span>
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-10 sm:-my-px sm:ms-16 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="relative group text-[10px] font-bold uppercase tracking-[0.2em] hover:text-brand-600 transition-colors duration-300">
                        {{ __('Dashboard') }}
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-brand-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                    </x-nav-link>
                    <x-nav-link :href="route('search.index')" :active="request()->routeIs('search.index')" class="relative group text-[10px] font-bold uppercase tracking-[0.2em] hover:text-brand-600 transition-colors duration-300">
                        {{ __('Find Workers') }}
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-brand-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                    </x-nav-link>
                    <x-nav-link :href="route('messages.index')" :active="request()->routeIs('messages.*')" class="relative group text-[10px] font-bold uppercase tracking-[0.2em] hover:text-brand-600 transition-colors duration-300">
                        {{ __('Messages') }}
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-brand-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                    </x-nav-link>
                    <x-nav-link :href="route('job-requests.index')" :active="request()->routeIs('job-requests.*')" class="relative group text-[10px] font-bold uppercase tracking-[0.2em] hover:text-brand-600 transition-colors duration-300">
                        {{ __('Work Requests') }}
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-brand-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                    </x-nav-link>
                </div>
            </div>

            <!-- Theme Toggle & Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                <!-- Theme Toggle -->
                <button @click="toggleTheme()" class="p-2.5 rounded-2xl bg-slate-50 border border-slate-100 text-slate-500 hover:bg-white hover:border-brand-500/30 hover:text-brand-500 transition-all duration-300 active:scale-90 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-400">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>
                @auth
                    <x-dropdown align="right" width="72">
                        <x-slot name="trigger">
                            <button class="group flex items-center space-x-3 px-5 py-2.5 bg-slate-50 border border-slate-100 rounded-2xl hover:bg-white hover:border-brand-500/30 hover:shadow-xl hover:shadow-brand-500/5 transition-all duration-500 active:scale-95">
                                <div class="relative w-8 h-8 rounded-xl bg-slate-900 flex items-center justify-center text-[10px] font-black text-white group-hover:bg-brand-500 transition-colors shadow-lg shadow-slate-900/10 group-hover:shadow-brand-500/20">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="text-left hidden lg:block">
                                    <p class="text-[10px] font-black text-slate-900 uppercase tracking-wider leading-none mb-1">{{ Auth::user()->name }}</p>
                                    <div class="flex items-center space-x-1.5">
                                        <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Online</span>
                                    </div>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-brand-500 transition-all duration-300 transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- User Header -->
                            <div class="p-6 bg-slate-900 text-white relative overflow-hidden">
                                <div class="absolute top-0 right-0 w-32 h-32 bg-brand-500/20 blur-[50px] rounded-full -mr-16 -mt-16"></div>
                                <div class="relative z-10">
                                    <p class="text-[9px] font-black text-brand-400 uppercase tracking-widest leading-none mb-2">Signed in as</p>
                                    <p class="text-sm font-bold truncate">{{ Auth::user()->email }}</p>
                                </div>
                            </div>

                            <div class="p-2 space-y-1">
                                @if(Auth::user()->role === 'admin')
                                    <x-dropdown-link :href="route('admin.dashboard')" class="!rounded-2xl !bg-brand-50 !text-brand-600 hover:!bg-brand-100 group flex items-center">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        {{ __('Admin Control Panel') }}
                                    </x-dropdown-link>
                                @endif

                                <x-dropdown-link :href="route('profile.edit')" class="!rounded-2xl group flex items-center">
                                    <svg class="w-4 h-4 mr-3 text-slate-400 group-hover:text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ __('Account Settings') }}
                                </x-dropdown-link>

                                @if(Auth::user()->role === 'worker')
                                    <x-dropdown-link :href="route('worker.edit')" class="!rounded-2xl group flex items-center">
                                        <svg class="w-4 h-4 mr-3 text-slate-400 group-hover:text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ __('My Worker Profile') }}
                                    </x-dropdown-link>
                                @endif

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            class="!rounded-2xl !text-rose-500 hover:!bg-rose-50 hover:!text-rose-600 group flex items-center"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        {{ __('Secure Logout') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center gap-6">
                        <a href="{{ route('login') }}" class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] hover:text-slate-900 transition-colors relative group">
                            Login
                            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-slate-900 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="{{ route('register') }}" class="px-8 py-3 bg-slate-900 text-[10px] font-black text-white uppercase tracking-[0.2em] rounded-2xl hover:bg-brand-600 hover:shadow-2xl hover:shadow-brand-500/30 transition-all duration-500 transform hover:-translate-y-0.5 active:scale-95">
                            Join Nexus
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-3 rounded-2xl text-gray-400 hover:text-slate-900 hover:bg-slate-100 dark:hover:text-white dark:hover:bg-white/5 transition-all">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-slate-100 dark:border-slate-800 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl">
        <div class="pt-6 pb-6 space-y-2 px-6">
            <div class="flex items-center justify-between mb-6 px-4 py-3 bg-slate-50 dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700">
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">Appearance Settings</span>
                <button @click="toggleTheme()" class="flex items-center space-x-2 px-4 py-2 bg-white dark:bg-slate-700 rounded-xl shadow-sm border border-slate-100 dark:border-slate-600 active:scale-95 transition-all">
                    <template x-if="!darkMode">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                            <span class="text-[10px] font-black text-slate-900 uppercase tracking-widest">Dark</span>
                        </div>
                    </template>
                    <template x-if="darkMode">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span class="text-[10px] font-black text-white uppercase tracking-widest">Light</span>
                        </div>
                    </template>
                </button>
            </div>
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="!rounded-2xl !py-4 !px-6 font-black uppercase text-[10px] tracking-widest transition-all">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('search.index')" :active="request()->routeIs('search.index')" class="!rounded-2xl !py-4 !px-6 font-black uppercase text-[10px] tracking-widest transition-all">
                {{ __('Find Workers') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('messages.index')" :active="request()->routeIs('messages.*')" class="!rounded-2xl !py-4 !px-6 font-black uppercase text-[10px] tracking-widest transition-all">
                {{ __('Messages') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('job-requests.index')" :active="request()->routeIs('job-requests.*')" class="!rounded-2xl !py-4 !px-6 font-black uppercase text-[10px] tracking-widest transition-all">
                {{ __('Work Requests') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-8 pb-10 border-t border-slate-50 dark:border-slate-800 bg-slate-50/30 dark:bg-slate-800/50">
            @auth
                <div class="px-8 mb-8 flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-2xl bg-slate-900 dark:bg-brand-500 flex items-center justify-center text-xs font-black text-white shadow-xl shadow-slate-900/10">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-black text-slate-900 dark:text-white uppercase tracking-widest text-[11px] mb-1">{{ Auth::user()->name }}</div>
                        <div class="font-bold text-slate-400 dark:text-slate-500 text-[10px]">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="space-y-2 px-6">
                    <x-responsive-nav-link :href="route('profile.edit')" class="!rounded-2xl !py-4 !px-6 font-black uppercase text-[9px] tracking-widest">
                        {{ __('Profile Settings') }}
                    </x-responsive-nav-link>

                    @if(Auth::user()->role === 'worker')
                        <x-responsive-nav-link :href="route('worker.edit')" class="!rounded-2xl !py-4 !px-6 font-black uppercase text-[9px] tracking-widest">
                            {{ __('My Worker Profile') }}
                        </x-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                class="!text-rose-500 !rounded-2xl !py-4 !px-6 font-black uppercase text-[9px] tracking-widest"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Secure Logout') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="space-y-3 px-6">
                    <a href="{{ route('login') }}" class="block w-full text-center py-4 bg-slate-100 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] text-slate-900 transition-all">
                        {{ __('Sign In') }}
                    </a>
                    <a href="{{ route('register') }}" class="block w-full text-center py-4 bg-slate-900 text-white rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] shadow-xl shadow-slate-900/20 active:scale-95 transition-all">
                        {{ __('Initialize Account') }}
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
