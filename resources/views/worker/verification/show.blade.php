<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Verify Your Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        Step 1: Upload Your Documents
                    </h3>
                    
                    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                        To become a verified worker, you must upload a valid NIDA ID or Passport.
                        Once uploaded, our admin team will review your documents.
                    </p>

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('worker.verification.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- NIDA Number -->
                        <div class="mb-4">
                            <x-input-label for="nida_number" :value="__('NIDA Number / ID Number')" />
                            <x-text-input id="nida_number" class="block mt-1 w-full" type="text" name="nida_number" :value="old('nida_number')" required autofocus />
                            <x-input-error :messages="$errors->get('nida_number')" class="mt-2" />
                        </div>

                        <!-- ID Document (File) -->
                        <div class="mb-4">
                            <x-input-label for="id_document" :value="__('Upload ID/NIDA (PDF or Image)')" />
                            <input id="id_document" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="id_document" required />
                            <x-input-error :messages="$errors->get('id_document')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Submit for Verification') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
