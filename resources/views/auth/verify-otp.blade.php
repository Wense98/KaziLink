<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Thanks for signing up! Before getting started, please verify your phone number by entering the 4-digit code we just sent to you.') }}
    </div>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ session('status') }}
        </div>
    @endif

    @if (session('success'))
        <div class="mb-4 font-medium text-sm text-blue-600 dark:text-blue-400">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.verify') }}">
        @csrf

        <!-- OTP Code -->
        <div>
            <x-input-label for="otp_code" :value="__('OTP Code')" />
            <x-text-input id="otp_code" class="block mt-1 w-full text-center text-2xl tracking-widest" type="text" name="otp_code" required autofocus autocomplete="one-time-code" maxlength="4" />
            <x-input-error :messages="$errors->get('otp_code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    {{ __('Resend Code') }}
                </button>
            </form>

            <x-primary-button class="ml-4">
                {{ __('Verify') }}
            </x-primary-button>
        </div>
    </form>
    
    <!-- Resend Form (Separate to avoid nesting) -->
    <div class="mt-4 text-center">
         <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="text-xs text-brand-600 hover:text-brand-800 underline">
                {{ __('Didn\'t receive code? Resend') }}
            </button>
        </form>
    </div>
</x-guest-layout>
