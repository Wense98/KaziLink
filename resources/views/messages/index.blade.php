<x-app-layout>
    <x-slot name="header">
        {{ __('Messages') }}
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="card-ui flex flex-col md:flex-row h-[75vh]">
                <!-- Sidebar: Contacts -->
                <div class="w-full md:w-80 border-r border-slate-200 flex flex-col bg-white">
                    <div class="p-6 border-b border-slate-200 bg-slate-50/50">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-slate-900">Messages</h3>
                            <button class="text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            </button>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </span>
                            <input type="text" placeholder="Search..." class="w-full bg-white border-slate-200 rounded-xl pl-9 pr-4 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    
                    <div class="flex-grow overflow-y-auto">
                        @forelse($contacts as $contact)
                            <a href="{{ route('messages.show', $contact) }}" 
                               class="flex items-center px-6 py-4 transition-all border-b border-slate-100 hover:bg-slate-50 {{ isset($activeContact) && $activeContact->id === $contact->id ? 'bg-blue-50 border-r-4 border-r-blue-600' : '' }}">
                                <div class="relative flex-shrink-0">
                                    <div class="w-12 h-12 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-bold overflow-hidden">
                                        @if($contact->avatar)
                                            <img src="{{ asset('storage/' . $contact->avatar) }}" alt="" class="w-full h-full object-cover">
                                        @else
                                            {{ substr($contact->name, 0, 1) }}
                                        @endif
                                    </div>
                                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-500 border-2 border-white rounded-full"></div>
                                </div>
                                <div class="ml-4 flex-grow truncate">
                                    <div class="flex justify-between items-baseline">
                                        <h4 class="text-sm font-bold text-slate-900 truncate">{{ $contact->name }}</h4>
                                        <span class="text-[10px] text-slate-400">Just now</span>
                                    </div>
                                    <p class="text-xs text-slate-500 truncate">Re: House Painting Job</p>
                                </div>
                            </a>
                        @empty
                            <div class="p-12 text-center">
                                <p class="text-slate-400 text-sm italic">No conversations yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Chat Area -->
                <div class="flex-grow flex flex-col bg-white">
                    @if(isset($messages))
                        <!-- Chat Header -->
                        <div class="px-8 py-4 border-b border-slate-200 flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-bold overflow-hidden">
                                    @if($activeContact->avatar)
                                        <img src="{{ asset('storage/' . $activeContact->avatar) }}" alt="" class="w-full h-full object-cover">
                                    @else
                                        {{ substr($activeContact->name, 0, 1) }}
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-base font-bold text-slate-900">{{ $activeContact->name }}</h3>
                                    <div class="flex items-center gap-1.5">
                                        <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                        <span class="text-xs text-slate-400 font-medium">Active now</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <button class="p-2 text-slate-400 hover:text-blue-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                </button>
                                <button class="p-2 text-slate-400 hover:text-blue-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                                </button>
                                <button class="p-2 text-slate-400 hover:text-blue-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Messages Loop -->
                        <div class="flex-grow overflow-y-auto p-8 space-y-6 bg-slate-50/50" id="message-container">
                            <div class="text-center py-4">
                                <span class="bg-white px-4 py-1.5 rounded-full text-[10px] font-bold text-slate-400 border border-slate-100 uppercase tracking-widest shadow-sm">Yesterday</span>
                            </div>

                            @foreach($messages as $message)
                                <div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                                    @if($message->sender_id !== Auth::id())
                                        <div class="w-8 h-8 rounded-full bg-slate-200 mr-3 flex-shrink-0">
                                            @if($activeContact->avatar)
                                                <img src="{{ asset('storage/' . $activeContact->avatar) }}" alt="" class="w-full h-full object-cover rounded-full">
                                            @endif
                                        </div>
                                    @endif
                                    <div class="max-w-[70%]">
                                        <div class="p-4 {{ $message->sender_id === Auth::id() ? 'bg-blue-600 text-white rounded-2xl rounded-tr-none' : 'bg-white text-slate-800 rounded-2xl rounded-tl-none border border-slate-100 shadow-sm' }}">
                                            @if($message->attachment_type === 'image')
                                                <img src="{{ asset('storage/' . $message->attachment_path) }}" class="rounded-lg mb-2 max-w-full h-auto" alt="Attachment">
                                            @elseif($message->attachment_type === 'audio')
                                                <div class="flex items-center gap-2 mb-2 bg-black/10 p-2 rounded-lg">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/></svg>
                                                    <audio controls class="h-8 w-48 max-w-full">
                                                        <source src="{{ asset('storage/' . $message->attachment_path) }}" type="audio/mpeg">
                                                        Your browser does not support the audio element.
                                                    </audio>
                                                </div>
                                            @endif
                                            
                                            @if($message->body)
                                                <p class="text-sm leading-relaxed">{{ $message->body }}</p>
                                            @endif
                                        </div>
                                        <p class="text-[10px] text-slate-400 mt-1 {{ $message->sender_id === Auth::id() ? 'text-right' : 'text-left' }}">
                                            {{ $message->created_at->format('g:i A') }}
                                            @if($message->sender_id === Auth::id())
                                                <span class="ml-1 {{ $message->read_at ? 'text-blue-500' : 'text-slate-300' }}">✓✓</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Input Area -->
                        <div class="p-6 bg-white border-t border-slate-200">
                            <form action="{{ route('messages.store', $activeContact) }}" method="POST" enctype="multipart/form-data" class="flex gap-4 items-end">
                                @csrf
                                <div class="flex-grow relative bg-slate-100 rounded-2xl flex items-center pr-2">
                                    <input type="text" name="body" placeholder="Type a message..." 
                                           class="flex-grow bg-transparent border-none px-6 py-4 text-sm focus:ring-0 focus:border-none">
                                    
                                    <label class="p-2 text-slate-400 hover:text-blue-600 cursor-pointer transition-colors block" title="Attach Image or Audio">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                                        <input type="file" name="attachment" class="hidden" accept="image/*,audio/*">
                                    </label>
                                </div>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-2xl shadow-lg shadow-blue-600/20 transition-all flex-shrink-0 mb-px">
                                    <svg class="w-6 h-6 rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex-grow flex flex-col items-center justify-center p-20 text-center bg-slate-50/50">
                            <div class="w-24 h-24 bg-white rounded-3xl flex items-center justify-center text-blue-600 mb-8 shadow-xl border border-slate-100">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-800 mb-4">Your Inbox</h2>
                            <p class="text-slate-500 max-w-xs mx-auto text-sm leading-relaxed">Select a conversation to start messaging. Your communications are safe and secure.</p>
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
            if(container) container.scrollTop = container.scrollHeight;
        });
    </script>
    @endif
</x-app-layout>
