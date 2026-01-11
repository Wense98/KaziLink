<x-app-layout>
    <x-slot name="header">
        {{ __('Professional Plans') }}
    </x-slot>

    <div class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white font-sans mb-6">Activate Your Professional Account</h1>
                <p class="text-lg text-slate-500 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed">Choose how you want to maintain your presence on KaziLink. New workers start with a <span class="text-brand-600 dark:text-brand-400 font-bold">1-week free trial</span> automatically!</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-1 gap-10 max-w-lg mx-auto">
                @foreach($plans as $plan)
                <div class="group relative bg-white dark:bg-slate-800 rounded-[3rem] shadow-sm border {{ $currentSubscription && $currentSubscription->plan_type == $plan['id'] ? 'border-brand-500 ring-4 ring-brand-50 dark:ring-brand-900/50' : 'border-slate-100 dark:border-slate-700 hover:border-brand-200 dark:hover:border-brand-500/50' }} overflow-hidden flex flex-col transition-all duration-500 hover:shadow-2xl hover:shadow-slate-200 dark:hover:shadow-slate-900/50 hover:-translate-y-2">
                    
                    @if($currentSubscription && $currentSubscription->plan_type == $plan['id'])
                        <div class="absolute top-8 right-8">
                            <span class="inline-flex items-center px-4 py-1.5 bg-brand-600 text-white text-[9px] font-bold uppercase tracking-[0.1em] rounded-full shadow-lg shadow-brand-500/30">
                                Active Plan
                            </span>
                        </div>
                    @endif

                    <div class="p-10 flex-grow text-center">
                        <h3 class="text-3xl font-bold text-slate-900 dark:text-white font-sans mb-4 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">{{ $plan['name'] }}</h3>
                        
                        <div class="mb-8 flex items-baseline justify-center">
                            <span class="text-5xl font-bold text-slate-900 dark:text-white font-sans">TPS {{ number_format($plan['price']) }}</span>
                            <span class="ml-2 text-slate-400 dark:text-slate-500 font-bold text-xs uppercase tracking-widest">/ Month</span>
                        </div>

                        <p class="text-slate-500 dark:text-slate-400 mb-8 leading-relaxed">{{ $plan['description'] }}</p>

                        <div class="space-y-4 text-left max-w-xs mx-auto">
                            @foreach($plan['features'] as $feature)
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded-full bg-brand-50 dark:bg-brand-500/10 flex items-center justify-center text-brand-600 dark:text-brand-400 shrink-0">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <span class="ml-4 text-sm font-semibold text-slate-700 dark:text-slate-300">{{ $feature }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="p-10 bg-slate-50 dark:bg-slate-900/30 border-t border-slate-100 dark:border-slate-700">
                        @if($currentSubscription && $currentSubscription->plan_type == $plan['id'])
                            <button disabled class="w-full px-8 py-5 bg-slate-200 dark:bg-slate-700 text-slate-500 dark:text-slate-400 rounded-2xl font-bold uppercase tracking-widest text-[10px] cursor-not-allowed">
                                Subscription Active
                            </button>
                        @else
                            <a href="{{ route('subscriptions.checkout', ['plan' => $plan['id']]) }}" class="block w-full text-center px-8 py-5 bg-brand-600 text-white rounded-2xl font-bold uppercase tracking-widest text-[10px] hover:bg-brand-700 hover:shadow-xl hover:shadow-brand-500/30 transition-all duration-300">
                                Pay Subscription Now
                            </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-20 text-center">
                <div class="inline-flex items-center px-6 py-4 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 text-xs font-bold gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 flex items-center justify-center bg-white dark:bg-slate-700 rounded-lg shadow-sm">🛡️</div>
                        <span>Secure Mobile Checkout</span>
                    </div>
                    <div class="w-px h-4 bg-slate-200 dark:bg-slate-600"></div>
                    <div>Simulated Experience</div>
                </div>
                <p class="mt-8 text-slate-400 text-[9px] font-bold uppercase tracking-[0.2em]">Built for the future of Tanzania's Workforce</p>
            </div>
        </div>
    </div>
</x-app-layout>
