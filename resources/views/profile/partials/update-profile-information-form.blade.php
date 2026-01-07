<section>
    <header>
        <h2 class="text-lg font-black text-white font-outfit uppercase tracking-tight">
            {{ __('Account Essence') }}
        </h2>

        <p class="mt-2 text-[10px] font-bold text-gray-600 uppercase tracking-widest">
            {{ __("Synchronize your professional identity and communication channels.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-10 space-y-8">
        @csrf
        @method('patch')

        <div class="space-y-4">
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" name="name" type="text" class="block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="space-y-4">
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" name="email" type="email" class="block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-[10px] mt-4 text-gray-500 font-bold uppercase tracking-widest">
                        {{ __('Identity unverified.') }}

                        <button form="send-verification" class="text-brand-500 hover:text-brand-400 font-black uppercase tracking-[0.2em] ml-2">
                            {{ __('Resend Protocol &rarr;') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-3 text-[9px] font-black text-brand-500 uppercase tracking-widest bg-brand-500/5 px-4 py-2 rounded-full border border-brand-500/10 inline-block">
                            {{ __('Verification protocol transmitted.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-6 pt-4">
            <x-primary-button>{{ __('Update Identity') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-[10px] font-black text-brand-500 uppercase tracking-widest"
                >{{ __('Protocol Updated.') }}</p>
            @endif
        </div>
    </form>
</section>
