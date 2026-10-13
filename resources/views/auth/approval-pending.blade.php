<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="text-center">
            <div class="mb-4">
                <svg class="mx-auto h-12 w-12 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-2">Registration Under Review</h2>
            <p class="text-gray-600 mb-6">
                Thank you for applying to be a Remote Sales Representative with SiteDudes!
            </p>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <p class="text-sm text-blue-800">
                    Your application is currently being reviewed by our team. We will send you an email as soon as a decision has been made.
                </p>
            </div>

            <div class="space-y-4 mb-8">
                <div class="text-left">
                    <h3 class="font-semibold text-gray-900 mb-2">What happens next?</h3>
                    <ol class="list-decimal list-inside space-y-2 text-sm text-gray-600">
                        <li>Our administrators will review your application and documents</li>
                        <li>You'll receive an approval notification via email</li>
                        <li>Follow the email instructions to verify your account</li>
                        <li>Set a secure password to access the dashboard</li>
                    </ol>
                </div>
            </div>

            <div class="space-y-4 mb-8">
                <div class="text-left">
                    <h3 class="font-semibold text-gray-900 mb-2">Questions?</h3>
                    <p class="text-sm text-gray-600">
                        If you have any questions about your application, please contact our support team at
                        <a href="mailto:support@sitedudes.com" class="text-blue-600 hover:text-blue-900">support@sitedudes.com</a>
                    </p>
                </div>
            </div>

            <div class="border-t pt-6">
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-blue-600 hover:text-blue-900 underline text-sm font-medium">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
