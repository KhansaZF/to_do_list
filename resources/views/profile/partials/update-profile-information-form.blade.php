<section class="bg-gradient-to-r from-[#85A1AE] to-[#B1E4EA] p-8 rounded-lg shadow-lg">
    <header class="mb-6">
        <h2 class="text-2xl font-bold text-[#37474F]">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-[#546E7A]">
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
            <x-input-label for="name" :value="__('Name')" class="text-[#37474F] font-semibold" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-[#EDF8F9] border border-[#85A1AE] rounded-lg shadow-sm focus:ring-[#B1E4EA] focus:border-[#B1E4EA]" 
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-red-500" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#37474F] font-semibold" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-[#EDF8F9] border border-[#85A1AE] rounded-lg shadow-sm focus:ring-[#B1E4EA] focus:border-[#B1E4EA]" 
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 text-red-500" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-[#EDF8F9] border-l-4 border-[#85A1AE] rounded-lg">
                    <p class="text-sm text-[#37474F]">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" 
                            class="underline text-sm text-[#00796B] hover:text-[#004D40] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B1E4EA]">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-[#00796B]">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-[#00796B] hover:bg-[#004D40] text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-[#37474F]">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
