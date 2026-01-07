<x-public-layout>
    <!-- Hero Section -->
    <div class="relative min-h-[90vh] flex items-center justify-center overflow-hidden pt-20 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10" data-aos="zoom-out">
            <div class="inline-flex items-center px-6 py-2 rounded-full bg-brand-500/10 border border-brand-500/20 text-brand-500 text-[10px] font-black uppercase tracking-[0.4em] mb-10 animate-pulse">
                🚀 Elite Talent Nexus • Tanzania
            </div>
            
            <h1 class="text-6xl md:text-8xl font-black text-slate-900 dark:text-white tracking-tighter mb-10 leading-[0.9]">
                CRAFTING <span class="gradient-text">EXCELLENCE</span><br/>
                IN EVERY CONNECTION.
            </h1>
            
            <p class="max-w-3xl mx-auto text-xl text-slate-500 dark:text-slate-400 mb-16 leading-relaxed font-medium">
                KaziLink isn't just a directory. It's a premium ecosystem where high-caliber professionals meet visionary clients to execute superior craftsmanship.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-8" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('search.index') }}" class="premium-button w-full sm:w-auto px-12 py-6 rounded-[2rem] text-xs font-black uppercase tracking-[0.2em] shadow-2xl">
                    Discover Elite Talent
                </a>
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-12 py-6 bg-white/5 dark:bg-slate-800/50 text-slate-900 dark:text-white border border-white/10 rounded-[2rem] text-xs font-black uppercase tracking-[0.2em] hover:bg-white/10 transition-all backdrop-blur-3xl">
                    Join the Collective
                </a>
            </div>

            <!-- Scroll Indicator -->
            <div class="mt-24 animate-bounce opacity-20 hidden md:block">
                <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
            </div>
        </div>
    </div>

    <!-- Process Section -->
    <div class="py-32 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-24">
                <h2 class="text-brand-500 font-black tracking-[0.4em] uppercase text-[10px] mb-4">The Standard</h2>
                <h3 class="text-4xl md:text-6xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">How We Define <span class="gradient-text">Success</span></h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
                <!-- Connector Line -->
                <div class="hidden lg:block absolute top-1/2 left-0 w-full h-px border-t-2 border-dashed border-brand-500/20 -z-10"></div>
                
                <div class="glass-card rounded-[3rem] p-12 text-left group hover:bg-brand-500 transition-all duration-700" data-aos="fade-up">
                    <div class="w-16 h-16 bg-brand-500/10 rounded-2xl flex items-center justify-center text-brand-500 mb-8 border border-brand-500/20 group-hover:bg-white group-hover:text-brand-500 transition-all">
                        <span class="text-2xl font-black">01</span>
                    </div>
                    <h4 class="text-xl font-black text-slate-900 dark:text-white mb-4 uppercase tracking-tight group-hover:text-white transition-all">Verification</h4>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium leading-loose group-hover:text-brand-100 transition-all">Every professional undergoes a rigorous identity and skill assessment to ensure they meet the KaziLink standard.</p>
                </div>

                <div class="glass-card rounded-[3rem] p-12 text-left group hover:bg-brand-500 transition-all duration-700" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-brand-500/10 rounded-2xl flex items-center justify-center text-brand-500 mb-8 border border-brand-500/20 group-hover:bg-white group-hover:text-brand-500 transition-all">
                        <span class="text-2xl font-black">02</span>
                    </div>
                    <h4 class="text-xl font-black text-slate-900 dark:text-white mb-4 uppercase tracking-tight group-hover:text-white transition-all">Collaboration</h4>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium leading-loose group-hover:text-brand-100 transition-all">Utilize our secure messaging protocol to align expectations, share files, and define project scopes with precision.</p>
                </div>

                <div class="glass-card rounded-[3rem] p-12 text-left group hover:bg-brand-500 transition-all duration-700" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-16 h-16 bg-brand-500/10 rounded-2xl flex items-center justify-center text-brand-500 mb-8 border border-brand-500/20 group-hover:bg-white group-hover:text-brand-500 transition-all">
                        <span class="text-2xl font-black">03</span>
                    </div>
                    <h4 class="text-xl font-black text-slate-900 dark:text-white mb-4 uppercase tracking-tight group-hover:text-white transition-all">Execution</h4>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium leading-loose group-hover:text-brand-100 transition-all">Work is completed, verified by the client, and secure payments are processed through our proprietary escrow system.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Trust Section (Dynamic Logo Slider) -->
    <div class="py-20 bg-white/5 backdrop-blur-3xl overflow-hidden border-y border-white/10 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
            <p class="text-center text-[10px] font-black text-slate-500 uppercase tracking-[0.4em]">Authorized by Industry Titans</p>
        </div>
        
        <div class="relative flex overflow-hidden">
            <div class="flex animate-marquee whitespace-nowrap gap-16 items-center opacity-30 grayscale hover:grayscale-0 transition-opacity duration-1000">
                <span class="text-4xl font-black text-slate-900 dark:text-white tracking-widest px-8">VODACOM</span>
                <span class="text-4xl font-black text-slate-900 dark:text-white tracking-widest px-8">M-PESA</span>
                <span class="text-4xl font-black text-slate-900 dark:text-white tracking-widest px-8">TIGO PESA</span>
                <span class="text-4xl font-black text-slate-900 dark:text-white tracking-widest px-8">AIRTEL</span>
                <span class="text-4xl font-black text-slate-900 dark:text-white tracking-widest px-8">CRDB BANK</span>
                <span class="text-4xl font-black text-slate-900 dark:text-white tracking-widest px-8">NBC</span>
                <span class="text-4xl font-black text-slate-900 dark:text-white tracking-widest px-8">NMB BANK</span>
                <!-- Duplicate for seamless loop -->
                <span class="text-4xl font-black text-slate-900 dark:text-white tracking-widest px-8">VODACOM</span>
                <span class="text-4xl font-black text-slate-900 dark:text-white tracking-widest px-8">M-PESA</span>
                <span class="text-4xl font-black text-slate-900 dark:text-white tracking-widest px-8">TIGO PESA</span>
                <span class="text-4xl font-black text-slate-900 dark:text-white tracking-widest px-8">AIRTEL</span>
                <span class="text-4xl font-black text-slate-900 dark:text-white tracking-widest px-8">CRDB BANK</span>
                <span class="text-4xl font-black text-slate-900 dark:text-white tracking-widest px-8">NBC</span>
                <span class="text-4xl font-black text-slate-900 dark:text-white tracking-widest px-8">NMB BANK</span>
            </div>
        </div>

        <style>
            @keyframes marquee {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
            }
            .animate-marquee {
                display: flex;
                width: max-content;
                animation: marquee 30s linear infinite;
            }
            .animate-marquee:hover {
                animation-play-state: paused;
            }
        </style>
    </div>

    <!-- Featured Categories / Experts Showcase -->
    <div class="py-32 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-24 gap-8" data-aos="fade-right">
                <div class="max-w-2xl text-left">
                    <h2 class="text-brand-500 font-black tracking-[0.4em] uppercase text-[10px] mb-4">The Selection</h2>
                    <h3 class="text-4xl md:text-6xl font-black text-slate-900 dark:text-white leading-[0.9] tracking-tighter">ELITE PROFESSIONS.<br/>UNCOMPROMISED SKILL.</h3>
                </div>
                <a href="{{ route('search.index') }}" class="text-[10px] font-black text-brand-500 hover:text-brand-400 uppercase tracking-widest border-b-2 border-brand-500/20 pb-2 transition-all">Explore Entire Ecosystem &rarr;</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($categories as $category)
                <div class="group glass-card rounded-[3rem] p-10 transition-all duration-500 hover:-translate-y-3 relative overflow-hidden" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-brand-500/5 blur-2xl rounded-full -mr-16 -mt-16 group-hover:bg-brand-500/10 transition-colors"></div>
                    
                    <div class="w-20 h-20 rounded-3xl bg-brand-500/10 flex items-center justify-center text-brand-500 mb-10 border border-brand-500/20 group-hover:bg-brand-500 group-hover:text-white transition-all duration-500">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    
                    <h4 class="text-2xl font-black text-slate-900 dark:text-white mb-6 uppercase tracking-tight">{{ $category->name }}</h4>
                    <p class="text-slate-500 dark:text-slate-400 mb-10 leading-loose text-sm font-medium">
                        {{ $category->description ?? 'Access elite ' . strtolower($category->name) . ' professionals recognized for their technical excellence.' }}
                    </p>
                    
                    <a href="{{ route('search.index', ['category' => $category->id]) }}" class="inline-flex items-center text-[11px] font-black text-brand-500 uppercase tracking-[0.2em] group-hover:text-brand-400 transition-colors">
                        Commence Search
                        <svg class="ml-3 w-4 h-4 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-24" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass-card rounded-[3rem] p-16 md:p-24 text-center relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-5xl font-bold text-slate-900 dark:text-white mb-8 uppercase leading-tight tracking-tight">Elevate Your <br/><span class="gradient-text">Professional Reach</span></h2>
                    <p class="text-lg text-slate-400 dark:text-slate-300 mb-12 max-w-2xl mx-auto">Join Tanzania's premier ecosystem of verified experts and unlock unparalleled job opportunities.</p>
                    <a href="{{ Auth::check() ? route('worker.create') : route('register') }}" class="premium-button inline-flex px-12 py-5 !text-white rounded-xl text-xs font-bold uppercase tracking-[0.3em]">
                        {{ Auth::check() ? 'Start Earning Now' : 'Join the Elite' }}
                    </a>
                </div>
                
                <!-- Background Decoration -->
                <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-brand-500/5 rounded-full -mr-48 -mt-48 blur-[100px]"></div>
                <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-brand-500/5 rounded-full -ml-48 -mb-48 blur-[100px]"></div>
            </div>
        </div>
    </div>
</x-public-layout>
