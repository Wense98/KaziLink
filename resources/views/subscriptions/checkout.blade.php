<x-app-layout>
    <x-slot name="header">
        {{ __('Account Activation') }}
    </x-slot>

    <div class="py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 rounded-[3rem] shadow-2xl shadow-slate-200 dark:shadow-slate-900/50 border border-slate-100 dark:border-slate-700 overflow-hidden">
                <div class="p-10 md:p-16">
                    <div class="mb-12 border-b border-slate-100 dark:border-slate-700 pb-10">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="w-8 h-8 bg-brand-600 text-white rounded-full flex items-center justify-center font-bold text-xs shadow-lg shadow-brand-500/30">1</span>
                            <h1 class="text-3xl font-black text-slate-900 dark:text-white font-sans">Review Order</h1>
                        </div>
                        
                        <div class="bg-slate-50 dark:bg-slate-700/50 rounded-3xl p-8 flex flex-col md:flex-row justify-between items-center gap-6 border border-slate-100 dark:border-slate-700">
                            <div>
                                <p class="text-[10px] text-slate-400 dark:text-slate-500 font-black uppercase tracking-[0.2em] mb-2">Selected Professional Plan</p>
                                <p class="text-2xl font-black text-slate-900 dark:text-white font-sans">{{ $planName }}</p>
                            </div>
                            <div class="text-center md:text-right">
                                <p class="text-[10px] text-slate-400 dark:text-slate-500 font-black uppercase tracking-[0.2em] mb-2">Total Amount Due</p>
                                <p class="text-3xl font-black text-brand-600 dark:text-brand-400 font-sans">TZS {{ number_format($price) }}</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('subscriptions.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan_type" value="{{ $planId }}">
                        <input type="hidden" name="amount" value="{{ $price }}">

                        <div class="flex items-center gap-3 mb-8">
                            <span class="w-8 h-8 bg-brand-600 text-white rounded-full flex items-center justify-center font-bold text-xs shadow-lg shadow-brand-500/30">2</span>
                            <h3 class="text-2xl font-black text-slate-900 dark:text-white font-sans">Payment Method</h3>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mb-12">
                            <label class="group relative flex cursor-pointer rounded-[2rem] border-2 bg-white dark:bg-slate-700/30 p-8 transition-all duration-300 hover:border-brand-500 has-[:checked]:border-brand-600 has-[:checked]:bg-brand-50/30 dark:has-[:checked]:bg-brand-500/10 border-slate-100 dark:border-slate-700">
                                <input type="radio" name="payment_method" value="M-Pesa" class="hidden peer" checked>
                                <div class="w-6 h-6 rounded-full border-2 border-slate-200 dark:border-slate-600 peer-checked:border-brand-600 peer-checked:bg-brand-600 flex items-center justify-center transition-all mr-6">
                                    <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                </div>
                                <span class="flex flex-col">
                                    <span class="block text-lg font-black text-slate-900 dark:text-white font-sans">Vodacom M-Pesa</span>
                                    <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Pay securely via your mobile wallet. Standard rates apply.</span>
                                </span>
                                <div class="ml-auto opacity-40 group-hover:opacity-100 transition-opacity">
                                     <span class="text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Instant</span>
                                </div>
                            </label>

                            <label class="group relative flex cursor-pointer rounded-[2rem] border-2 bg-white dark:bg-slate-700/30 p-8 transition-all duration-300 hover:border-brand-500 has-[:checked]:border-brand-600 has-[:checked]:bg-brand-50/30 dark:has-[:checked]:bg-brand-500/10 border-slate-100 dark:border-slate-700">
                                <input type="radio" name="payment_method" value="Tigo Pesa" class="hidden peer">
                                <div class="w-6 h-6 rounded-full border-2 border-slate-200 dark:border-slate-600 peer-checked:border-brand-600 peer-checked:bg-brand-600 flex items-center justify-center transition-all mr-6">
                                    <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                </div>
                                <span class="flex flex-col">
                                    <span class="block text-lg font-black text-slate-900 dark:text-white font-sans">Tigo Pesa</span>
                                    <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Fast and reliable mobile network transaction.</span>
                                </span>
                            </label>
                        </div>

                        <div class="bg-amber-50 dark:bg-amber-900/10 rounded-2xl p-6 mb-12 flex gap-4 border border-amber-100 dark:border-amber-900/20">
                            <svg class="h-6 w-6 text-amber-600 dark:text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-xs font-bold text-amber-700 dark:text-amber-500 leading-relaxed italic">
                                This is a simulated checkout. By clicking the button below, your professional account will be upgraded immediately for demonstration purposes. No real money will be deducted.
                            </p>
                        </div>

                        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                            <a href="{{ route('subscriptions.index') }}" class="text-sm font-black text-slate-400 hover:text-slate-900 dark:hover:text-slate-300 uppercase tracking-widest transition">Cancel Transaction</a>
                            <button type="submit" class="w-full md:w-auto px-12 py-5 bg-brand-600 text-white rounded-2xl text-xl font-bold hover:bg-brand-700 hover:shadow-2xl hover:shadow-brand-500/40 transition-all duration-300 transform hover:scale-105">
                                Complete Upgrade &rarr;
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
