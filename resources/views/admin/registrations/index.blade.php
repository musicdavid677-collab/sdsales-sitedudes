<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registration Approvals
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Status Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 text-sm font-medium">Pending Review</div>
                    <div class="text-3xl font-bold text-orange-500 mt-2">{{ $stats['pending'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 text-sm font-medium">Approved</div>
                    <div class="text-3xl font-bold text-green-500 mt-2">{{ $stats['approved'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 text-sm font-medium">Rejected</div>
                    <div class="text-3xl font-bold text-red-500 mt-2">{{ $stats['rejected'] }}</div>
                </div>
            </div>

            <!-- Filter Tabs -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="flex border-b">
                    <a href="{{ route('admin.registrations.index', ['status' => 'pending']) }}"
                       class="px-6 py-3 font-medium text-sm {{ $status === 'pending' ? 'border-b-2 border-orange-500 text-orange-600' : 'text-gray-600' }}">
                        Pending ({{ $stats['pending'] }})
                    </a>
                    <a href="{{ route('admin.registrations.index', ['status' => 'approved']) }}"
                       class="px-6 py-3 font-medium text-sm {{ $status === 'approved' ? 'border-b-2 border-green-500 text-green-600' : 'text-gray-600' }}">
                        Approved ({{ $stats['approved'] }})
                    </a>
                    <a href="{{ route('admin.registrations.index', ['status' => 'rejected']) }}"
                       class="px-6 py-3 font-medium text-sm {{ $status === 'rejected' ? 'border-b-2 border-red-500 text-red-600' : 'text-gray-600' }}">
                        Rejected ({{ $stats['rejected'] }})
                    </a>
                </div>
            </div>

            <!-- Applications Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($registrations->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Submitted</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @foreach($registrations as $registration)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $registration->first_name }} {{ $registration->last_name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-600">{{ $registration->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-600">{{ $registration->phone }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($registration->approval_status === 'pending')
                                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">Pending</span>
                                            @elseif($registration->approval_status === 'approved')
                                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Approved</span>
                                            @else
                                                <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">Rejected</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-600">{{ $registration->created_at->format('M j, Y') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('admin.registrations.show', $registration) }}"
                                               class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                                Review
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t">
                        {{ $registrations->links() }}
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <p class="text-gray-600">No {{ $status }} registrations found.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
