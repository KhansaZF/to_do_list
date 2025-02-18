<section class="bg-gradient-to-r from-blue-100 to-teal-200 p-8 rounded-lg shadow-lg">
    <header class="mb-6">
        <h2 class="text-2xl font-bold text-blue-800">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-blue-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-blue-700 font-semibold" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" 
                class="mt-1 block w-full bg-white border border-blue-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-500" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" class="text-blue-700 font-semibold" />
            <x-text-input id="update_password_password" name="password" type="password" 
                class="mt-1 block w-full bg-white border border-blue-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-500" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-blue-700 font-semibold" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                class="mt-1 block w-full bg-white border border-blue-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-500" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-blue-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" 
                    class="text-sm text-blue-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
