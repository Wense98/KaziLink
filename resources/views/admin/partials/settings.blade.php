<!-- Page Title -->
<div class="mb-10">
    <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-2">System Configuration (v2)</h1>
    <p class="text-slate-500 font-medium">Control global platform parameters, pricing, and operational status.</p>
</div>

<div class="max-w-4xl">
    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
        @csrf
        <!-- Subscription Pricing -->
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50">
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider">Subscription Pricing (TZS)</h3>
            </div>
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Monthly Plan Rate</label>
                        <div class="relative">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-sm">TZS</span>
                            <input type="number" name="monthly_price" value="{{ $settings['subscription_price_monthly'] }}" 
                                   class="w-full bg-slate-50 border-slate-200 rounded-2xl py-4 pl-16 pr-6 text-sm font-bold focus:ring-brand-500/20 focus:border-brand-500 transition-all">
                        </div>
                    </div>
                    <div class="space-y-3">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Annual Plan Rate</label>
                        <div class="relative">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-sm">TZS</span>
                            <input type="number" name="annual_price" value="{{ $settings['subscription_price_annual'] }}" 
                                   class="w-full bg-slate-50 border-slate-200 rounded-2xl py-4 pl-16 pr-6 text-sm font-bold focus:ring-brand-500/20 focus:border-brand-500 transition-all">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security & Access -->
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50">
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider">Security & Access Control</h3>
            </div>
            <div class="p-8 space-y-6">
                <div class="flex items-center justify-between p-6 bg-slate-50 rounded-3xl border border-slate-100">
                    <div>
                        <p class="text-sm font-black text-slate-900 mb-1">Require ID Verification</p>
                        <p class="text-[11px] text-slate-500 font-medium">Workers cannot be listed until documents are approved.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-14 h-8 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-brand-500"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between p-6 bg-slate-50 rounded-3xl border border-slate-100">
                    <div>
                        <p class="text-sm font-black text-slate-900 mb-1">OTP Login Enforcement</p>
                        <p class="text-[11px] text-slate-500 font-medium">Require phone verification for every new session.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="w-14 h-8 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-brand-500"></div>
                    </label>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="bg-white rounded-[2.5rem] border border-rose-100 shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-rose-50 bg-rose-50/30">
                <h3 class="text-sm font-black text-rose-900 uppercase tracking-wider">Danger Zone</h3>
            </div>
            <div class="p-8">
                <div class="flex items-center justify-between p-6 bg-rose-50/50 rounded-3xl border border-rose-100">
                    <div>
                        <p class="text-sm font-black text-rose-900 mb-1">Maintenance Mode</p>
                        <p class="text-[11px] text-rose-600 font-medium font-bold uppercase tracking-wider">Disable Public Access Immediately</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="w-14 h-8 bg-rose-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-rose-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-rose-600"></div>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-4 pt-6">
            <button type="reset" class="px-8 py-4 text-[11px] font-black uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-all">Discard Changes</button>
            <button type="submit" class="px-12 py-5 bg-slate-900 text-white text-[11px] font-black uppercase tracking-widest rounded-3xl hover:bg-slate-800 transition-all shadow-xl shadow-slate-900/20">
                Apply System Configuration
            </button>
        </div>
    </form>
</div>
