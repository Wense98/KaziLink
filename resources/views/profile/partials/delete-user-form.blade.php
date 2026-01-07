<section class="space-y-6">
    <header>
        <h2 class="text-lg font-black text-red-500 font-outfit uppercase tracking-tight">
            {{ __('Terminal Protocol') }}
        </h2>

        <p class="mt-2 text-[10px] font-bold text-gray-600 uppercase tracking-widest">
            {{ __('Once this protocol is executed, all of your assets and data will be permanently purged from the collective.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Initialize Account Deletion') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-12 glass-card rounded-[3.5rem] border-white/5 shadow-2xl">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-black text-white font-outfit uppercase tracking-tight mb-4">
                {{ __('Confirm Purge Protocol') }}
            </h2>

            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest leading-relaxed">
                {{ __('This action is irreversible. All professional records and associated data will be permanently erased. Enter your primary credentials to authorize the final purge.') }}
            </p>

            <div class="mt-10 space-y-4">
                <x-input-label for="password" value="{{ __('Authorization Credentials') }}" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-full"
                    placeholder="{{ __('Credentials required') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-12 flex justify-end gap-6">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Abort') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('Authorize Purge') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
