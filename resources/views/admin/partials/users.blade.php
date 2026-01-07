<!-- Page Title -->
<div class="mb-10 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-2">User Directory</h1>
        <p class="text-slate-500 font-medium">Manage all platform users, monitor activity, and control access.</p>
    </div>
    <div class="flex items-center space-x-3">
        <div class="bg-white px-6 py-3 rounded-2xl border border-slate-100 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Total Active</p>
            <p class="text-xl font-bold text-slate-900 leading-none">{{ $users->total() }}</p>
        </div>
    </div>
</div>

<!-- Users Table -->
<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">User Identity</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Contact Information</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Role</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Account Status</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($users as $user)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-8 py-6">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 font-black overflow-hidden mr-4 border border-slate-200">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
                                @else
                                    {{ substr($user->name, 0, 1) }}
                                @endif
                            </div>
                            <div>
                                <p class="text-[14px] font-bold text-slate-900 group-hover:text-brand-600 transition-colors">{{ $user->name }}</p>
                                <p class="text-[11px] text-slate-400 font-medium uppercase tracking-widest">UID: #{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-[13px] font-bold text-slate-700 leading-tight mb-0.5">{{ $user->email }}</p>
                        <p class="text-[11px] text-slate-400 font-medium">{{ $user->phone }}</p>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <span class="inline-flex items-center px-3 py-1 bg-{{ $user->role === 'admin' ? 'brand-50' : 'slate-50' }} text-{{ $user->role === 'admin' ? 'brand-600' : 'slate-500' }} text-[10px] font-black uppercase tracking-widest rounded-lg border border-{{ $user->role === 'admin' ? 'brand-100' : 'slate-100' }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <span class="inline-flex items-center px-3 py-1.5 bg-{{ $user->is_active ? 'emerald' : 'rose' }}-50 text-{{ $user->is_active ? 'emerald' : 'rose' }}-600 text-[10px] font-black uppercase tracking-[0.15em] rounded-full border border-{{ $user->is_active ? 'emerald' : 'rose' }}-100">
                            <span class="w-1.5 h-1.5 rounded-full bg-current mr-2"></span>
                            {{ $user->is_active ? 'Active' : 'Banned' }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <form action="{{ route('admin.users.toggle', $user) }}" method="POST" onsubmit="return confirm('Change status for this user?')">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ $user->is_active ? 'bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white' }} shadow-sm">
                                {{ $user->is_active ? 'Deactivate' : 'Reactivate' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-8 py-6 border-t border-slate-50 bg-slate-50/30">
        {{ $users->links() }}
    </div>
</div>
