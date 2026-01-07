<section>
    <header>
        <h2 class="text-lg font-black text-white font-outfit uppercase tracking-tight">
            {{ __('Access Protocol') }}
        </h2>

        <p class="mt-2 text-[10px] font-bold text-gray-600 uppercase tracking-widest">
            {{ __('Calibrate your credentials to ensure maximum identity security.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-10 space-y-8">
        @csrf
        @method('put')

        <div class="space-y-4">
            <x-input-label for="update_password_current_password" :value="__('Current Protocol')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="space-y-4">
            <x-input-label for="update_password_password" :value="__('New Credentials')" />
            <x-text-input id="update_password_password" name="password" type="password" class="block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="space-y-4">
            <x-input-label for="update_password_password_confirmation" :value="__('Verify Credentials')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-6 pt-4">
            <x-primary-button>{{ __('Seal Credentials') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-[10px] font-black text-brand-500 uppercase tracking-widest"
                >{{ __('Protocol Synchronized.') }}</p>
            @endif
        </div>
    </form>
</section>
