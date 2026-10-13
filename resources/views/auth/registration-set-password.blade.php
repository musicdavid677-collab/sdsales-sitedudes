<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <h2 class="text-xl font-semibold text-gray-900 mb-2">Set your password</h2>
        <p class="text-sm text-gray-600 mb-6">
            Welcome, {{ $user->first_name }}. Choose a password to finish setting up your account.
        </p>

        <form method="POST" action="{{ request()->fullUrl() }}">
            @csrf

            <div>
                <x-label for="password" value="{{ __('New Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autofocus autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-button>
                    {{ __('Save Password') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
