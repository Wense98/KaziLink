<x-app-layout>
    <x-slot name="header">
        {{ __('Secure Messaging') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass-card rounded-[2.5rem] overflow-hidden flex flex-col md:flex-row h-[75vh]" data-aos="zoom-in">
                <!-- Sidebar: Contacts -->
                <div class="w-full md:w-80 border-r border-white/5 flex flex-col">
                    <div class="p-8 border-b border-white/5">
                        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-brand-500 mb-2">Conversations</h3>
                        <div class="relative">
                            <input type="text" placeholder="Search contacts..." class="w-full bg-white/5 border-white/10 rounded-xl px-4 py-2 text-xs text-slate-300 placeholder:text-slate-500 focus:ring-brand-500 focus:border-brand-500">
                        </div>
                    </div>
                    
                    <div class="flex-grow overflow-y-auto">
                        @forelse($contacts as $contact)
                            <a href="{{ route('messages.show', $contact) }}" 
                               class="flex items-center px-8 py-6 transition-all border-b border-white/5 hover:bg-white/5 {{ isset($activeContact) && $activeContact->id === $contact->id ? 'bg-brand-500/10 border-l-4 border-l-brand-500' : '' }}">
                                <div class="relative">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-900 font-bold">
                                        {{ substr($contact->name, 0, 1) }}
                                    </div>
                                    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-500 border-2 border-slate-900 rounded-full"></div>
                                </div>
                                <div class="ml-4 truncate">
                                    <h4 class="text-sm font-bold text-slate-900 dark:text-white">{{ $contact->name }}</h4>
                                    <p class="text-[10px] text-slate-500 font-medium uppercase tracking-widest mt-0.5">{{ $contact->role }}</p>
                                </div>
                            </a>
                        @empty
                            <div class="p-12 text-center">
                                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">No conversations yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Chat Area -->
                <div class="flex-grow flex flex-col relative bg-white/5 backdrop-blur-3xl">
                    @if(isset($messages))
                        <!-- Chat Header -->
                        <div class="p-8 border-b border-white/5 flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-xl bg-brand-500/10 flex items-center justify-center text-brand-500 font-bold">
                                    {{ substr($activeContact->name, 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-base font-black text-slate-900 dark:text-white uppercase tracking-tight">{{ $activeContact->name }}</h3>
                                    <div class="flex items-center space-x-2">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                        <span class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">Online Now</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button class="p-3 bg-white/5 rounded-xl text-slate-400 hover:text-white transition-all border border-white/10">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                </button>
                                <button class="p-3 bg-white/5 rounded-xl text-slate-400 hover:text-white transition-all border border-white/10">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" /></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Messages Loop -->
                        <div class="flex-grow overflow-y-auto p-10 space-y-8" id="message-container">
                            @foreach($messages as $message)
                                <div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                                    <div class="max-w-[70%] {{ $message->sender_id === Auth::id() ? 'bg-brand-600 text-white rounded-[1.5rem_1.5rem_0_1.5rem]' : 'bg-white/10 text-slate-900 dark:text-white rounded-[1.5rem_1.5rem_1.5rem_0] border border-white/10' }} p-6 shadow-xl">
                                        <p class="text-sm font-medium leading-relaxed">{{ $message->body }}</p>
                                        <div class="mt-2 flex items-center justify-end space-x-1 opacity-50">
                                            <span class="text-[8px] font-bold uppercase tracking-tighter">{{ $message->created_at->format('H:i') }}</span>
                                            @if($message->sender_id === Auth::id())
                                                <svg class="w-3 h-3 {{ $message->read_at ? 'text-emerald-300' : '' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" /></svg>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Input Area -->
                        <div class="p-8 border-t border-white/5">
                            <form action="{{ route('messages.store', $activeContact) }}" method="POST" class="flex space-x-4">
                                @csrf
                                <div class="relative flex-grow">
                                    <input type="text" name="body" placeholder="Type a message..." required
                                           class="w-full bg-white/5 border-white/10 rounded-2xl px-6 py-4 text-sm text-slate-100 placeholder:text-slate-500 focus:ring-brand-500 focus:border-brand-500 transition-all">
                                    <div class="absolute inset-y-0 right-0 py-2 pr-4 flex space-x-2">
                                        <button type="button" class="text-slate-500 hover:text-brand-500 transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg></button>
                                        <button type="button" class="text-slate-500 hover:text-brand-500 transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></button>
                                    </div>
                                </div>
                                <button type="submit" class="premium-button p-4 rounded-2xl flex items-center justify-center min-w-[60px]">
                                    <svg class="w-5 h-5 rotate-90" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" /></svg>
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex-grow flex flex-col items-center justify-center p-20 text-center">
                            <div class="w-32 h-32 bg-brand-500/5 rounded-[3rem] flex items-center justify-center text-brand-500 mb-10 border border-brand-500/10 shadow-2xl pulse-slow">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                            </div>
                            <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tight mb-4">Elite Communication</h2>
                            <p class="text-slate-500 max-w-sm font-medium leading-relaxed">Select a professional from your contact list to initiate a high-level collaboration.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(isset($activeContact))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('message-container');
            container.scrollTop = container.scrollHeight;
        });
    </script>
    @endif
</x-app-layout>
