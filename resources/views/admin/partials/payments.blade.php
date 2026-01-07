<!-- Page Title -->
<div class="mb-10 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-2">Payment Monitoring</h1>
        <p class="text-slate-500 font-medium">Track subscriptions, verify manual payments, and monitor revenue.</p>
    </div>
    <div class="flex items-center space-x-3">
        <div class="bg-white px-6 py-3 rounded-2xl border border-slate-100 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Active Subs</p>
            <p class="text-xl font-bold text-slate-900 leading-none">{{ number_format($stats['active_subscriptions']) }}</p>
        </div>
    </div>
</div>

<!-- Payments Table -->
<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Subscriber</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Subscription Plan</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Amount Paid</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Current Status</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Valid Until</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($subscriptions as $sub)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-8 py-6">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 font-black overflow-hidden mr-4 border border-slate-200">
                                @if($sub->user->avatar)
                                    <img src="{{ asset('storage/' . $sub->user->avatar) }}" class="w-full h-full object-cover">
                                @else
                                    {{ substr($sub->user->name, 0, 1) }}
                                @endif
                            </div>
                            <div>
                                <p class="text-[14px] font-bold text-slate-900 group-hover:text-brand-600 transition-colors">{{ $sub->user->name }}</p>
                                <p class="text-[11px] text-slate-400 font-medium">{{ $sub->user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="inline-flex items-center px-3 py-1 bg-brand-50 text-brand-600 text-[10px] font-black uppercase tracking-widest rounded-lg border border-brand-100">
                            {{ $sub->plan_type }} Plan
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-[14px] font-black text-slate-900 tracking-tight">TSh {{ number_format($sub->amount) }}</p>
                    </td>
                    <td class="px-8 py-6">
                        <span class="inline-flex items-center px-3 py-1.5 bg-{{ $sub->status === 'active' ? 'emerald' : ($sub->status === 'pending' ? 'amber' : 'rose') }}-50 text-{{ $sub->status === 'active' ? 'emerald' : ($sub->status === 'pending' ? 'amber' : 'rose') }}-600 text-[10px] font-black uppercase tracking-[0.1em] rounded-full border border-{{ $sub->status === 'active' ? 'emerald' : ($sub->status === 'pending' ? 'amber' : 'rose') }}-100">
                            {{ $sub->status }}
                        </span>
                    </td>
                    <td class="px-8 py-6 whitespace-nowrap">
                        <div class="flex flex-col">
                            <p class="text-[13px] font-bold text-slate-700">{{ $sub->ends_at ? $sub->ends_at->format('M d, Y') : 'Life-time' }}</p>
                            @if($sub->ends_at)
                                <p class="text-[10px] text-slate-400 font-medium lowercase tracking-tight">{{ $sub->ends_at->diffForHumans() }}</p>
                            @endif
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        @if($sub->status === 'pending')
                        <form action="{{ route('admin.payments.confirm', $sub) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center px-5 py-2.5 bg-brand-50 text-brand-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-brand-600 hover:text-white transition-all shadow-sm">
                                Confirm Receipt
                            </button>
                        </form>
                        @else
                        <button class="p-2.5 bg-slate-50 text-slate-400 rounded-xl hover:bg-slate-100 transition-all cursor-not-allowed" disabled>
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-8 py-6 border-t border-slate-50 bg-slate-50/30">
        {{ $subscriptions->links() }}
    </div>
</div>
