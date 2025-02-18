<section class="bg-gradient-to-r from-blue-100 to-teal-200 p-8 rounded-lg shadow-lg">
    <header class="mb-6">
        <h2 class="text-2xl font-bold text-blue-800">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-blue-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-blue-700 font-semibold" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-white border border-blue-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500" 
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-red-500" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-blue-700 font-semibold" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-white border border-blue-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500" 
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 text-red-500" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-blue-50 border-l-4 border-teal-400 rounded-lg">
                    <p class="text-sm text-blue-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" 
                            class="underline text-sm text-teal-600 hover:text-teal-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-blue-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
