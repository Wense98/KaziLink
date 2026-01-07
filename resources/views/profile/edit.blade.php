<x-app-layout>
    <div class="py-24 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12" data-aos="fade-up">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-black text-slate-900 uppercase tracking-tight">Security & <span class="gradient-text">Identity</span></h2>
                <p class="text-slate-500 text-sm font-medium mt-3">Manage your account credentials and personal information.</p>
            </div>

            <div class="glass-card p-8 sm:p-12 rounded-[3.5rem] border-white/5 shadow-2xl transition-all hover:border-white/10">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="glass-card p-8 sm:p-12 rounded-[3.5rem] border-white/5 shadow-2xl transition-all hover:border-white/10">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="glass-card p-8 sm:p-12 rounded-[3.5rem] border-red-500/5 shadow-2xl transition-all hover:border-red-500/10">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
