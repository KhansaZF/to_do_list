<section class="bg-gradient-to-r from-[#85A1AE] to-[#B1E4EA] p-8 rounded-lg shadow-lg space-y-6">
    <header>
        <h2 class="text-2xl font-bold text-[#37474F]">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-[#455A64]">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300 shadow-md"
    >
        {{ __('Delete Account') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-[#EDF8F9] rounded-lg shadow-xl">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-[#37474F]">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-[#455A64]">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 border border-[#85A1AE] rounded-lg focus:ring-[#B1E4EA] focus:border-[#B1E4EA] shadow-sm"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-500" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button 
                    x-on:click="$dispatch('close')"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300 shadow-md"
                >
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button 
                    class="ms-3 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300 shadow-md"
                >
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
