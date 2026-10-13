<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Registration Review: {{ $user->first_name }} {{ $user->last_name }}
            </h2>
            <a href="{{ route('admin.registrations.index') }}" class="text-blue-600 hover:text-blue-900">
                ← Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Personal Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-medium text-gray-600">First Name</label>
                            <p class="text-gray-900">{{ $user->first_name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Last Name</label>
                            <p class="text-gray-900">{{ $user->last_name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Email</label>
                            <p class="text-gray-900">{{ $user->email }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Phone</label>
                            <p class="text-gray-900">{{ $user->phone }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Date of Birth</label>
                            <p class="text-gray-900">{{ $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('F j, Y') : 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Gender</label>
                            <p class="text-gray-900">{{ $user->gender ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Job Title</label>
                            <p class="text-gray-900">{{ $user->job_title ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Address</label>
                            <p class="text-gray-900">{{ $user->address }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Identity Verification Documents -->
            @if($user->profile)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Identity Documents</h3>
                            @if($user->profile->photo_id_front_path || $user->profile->photo_id_back_path)
                                <a href="{{ route('admin.registrations.download-documents', $user) }}"
                                   class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                    Download All Documents
                                </a>
                            @endif
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            @if($user->profile->photo_id_front_path)
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Photo ID - Front</label>
                                    <div class="mt-2 bg-gray-100 rounded p-4 text-center">
                                        <p class="text-sm text-gray-600 mb-2">{{ pathinfo($user->profile->photo_id_front_path, PATHINFO_BASENAME) }}</p>
                                        <a href="{{ route('admin.registrations.view-photo-id', [$user, 'front']) }}"
                                           class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                            View Document
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if($user->profile->photo_id_back_path)
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Photo ID - Back</label>
                                    <div class="mt-2 bg-gray-100 rounded p-4 text-center">
                                        <p class="text-sm text-gray-600 mb-2">{{ pathinfo($user->profile->photo_id_back_path, PATHINFO_BASENAME) }}</p>
                                        <a href="{{ route('admin.registrations.view-photo-id', [$user, 'back']) }}"
                                           class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                            View Document
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if($user->profile->signature_path)
                            <div class="mt-6">
                                <label class="text-sm font-medium text-gray-600">Electronic Signature</label>
                                <p class="text-sm text-gray-600 mt-1">Signed on {{ $user->profile->terms_accepted_at?->format('F j, Y \a\t g:i A') }}</p>
                            </div>
                        @endif

                        <div class="mt-6 pt-6 border-t">
                            <label class="text-sm font-medium text-gray-600">Terms Accepted</label>
                            <p class="text-gray-900">
                                @if($user->profile->terms_accepted_at)
                                    <span class="text-green-600 font-medium">✓ Accepted on {{ $user->profile->terms_accepted_at->format('F j, Y \a\t g:i A') }}</span>
                                @else
                                    <span class="text-red-600">Not accepted</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Approval Actions -->
            @if($user->registrationApproval->status === 'pending')
                <div class="grid grid-cols-2 gap-6">
                    <!-- Approve Form -->
                    <form action="{{ route('admin.registrations.approve', $user) }}" method="POST" class="bg-green-50 overflow-hidden shadow-sm sm:rounded-lg">
                        @csrf
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg font-medium text-green-900 mb-4">Approve Application</h3>
                            <p class="text-sm text-green-700 mb-4">
                                Approving will send an email verification link to the applicant.
                            </p>
                            <button type="submit"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded">
                                Approve Registration
                            </button>
                        </div>
                    </form>

                    <!-- Reject Form -->
                    <form action="{{ route('admin.registrations.reject', $user) }}" method="POST" class="bg-red-50 overflow-hidden shadow-sm sm:rounded-lg">
                        @csrf
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg font-medium text-red-900 mb-4">Reject Application</h3>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Rejection</label>
                                <textarea name="reason"
                                          rows="3"
                                          placeholder="Explain why this application is being rejected..."
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 @error('reason') border-red-500 @enderror"
                                          required></textarea>
                                @error('reason')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded"
                                    onclick="return confirm('Are you sure you want to reject this application?')">
                                Reject Registration
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <!-- Status Display -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Application Status</h3>
                        @if($user->registrationApproval->status === 'approved')
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                                <p class="font-medium">Approved</p>
                                <p class="text-sm">Approved by {{ $user->approver?->first_name }} {{ $user->approver?->last_name }} on {{ $user->approved_at?->format('F j, Y \a\t g:i A') }}</p>
                            </div>
                        @else
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                <p class="font-medium">Rejected</p>
                                <p class="text-sm">Rejected by {{ $user->approver?->first_name }} {{ $user->approver?->last_name }} on {{ $user->approved_at?->format('F j, Y \a\t g:i A') }}</p>
                                @if($user->registrationApproval->rejection_reason)
                                    <p class="text-sm mt-2"><strong>Reason:</strong> {{ $user->registrationApproval->rejection_reason }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
