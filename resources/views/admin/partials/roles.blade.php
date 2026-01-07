<!-- Page Title -->
<div class="mb-10 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-2">Administrative Roles</h1>
        <p class="text-slate-500 font-medium">Manage access levels and permissions for the KaziLink admin team.</p>
    </div>
    <button class="px-6 py-3 bg-brand-600 text-white text-[11px] font-black uppercase tracking-widest rounded-2xl hover:bg-brand-700 transition-all shadow-lg shadow-brand-500/10">
        + Invite New Admin
    </button>
</div>

<!-- Admins Table -->
<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Administrator</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Access Level</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Security Status</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Last Activity</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($admins as $admin)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-8 py-6">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center text-white font-black overflow-hidden mr-4 shadow-lg shadow-slate-900/10">
                                {{ substr($admin->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-[14px] font-bold text-slate-900">{{ $admin->name }}</p>
                                <p class="text-[11px] text-slate-400 font-medium">{{ $admin->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="inline-flex items-center px-3 py-1 bg-brand-50 text-brand-600 text-[10px] font-black uppercase tracking-widest rounded-lg border border-brand-100">
                            Super Admin
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <span class="inline-flex items-center px-3 py-1.5 bg-emerald-50 text-emerald-600 text-[9px] font-black uppercase tracking-widest rounded-full border border-emerald-100">
                            Verified Auth
                        </span>
                    </td>
                    <td class="px-8 py-6 text-[13px] font-medium text-slate-500 whitespace-nowrap">
                        {{ $admin->updated_at->diffForHumans() }}
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center space-x-2">
                            <button class="p-2.5 bg-slate-50 text-slate-400 rounded-xl hover:bg-slate-100 transition-all">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-8 py-6 border-t border-slate-50 bg-slate-50/30">
        {{ $admins->links() }}
    </div>
</div>
