{{-- admin.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">Welcome, Admin!</div>
            </div>
        </div>
    </div>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

{{-- Summary Cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    {{-- Total Users --}}
    <div class="bg-white overflow-hidden shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900">Total Users</h3>
        <p class="mt-2 text-3xl font-bold text-blue-600">{{ $totalUsers }}</p>
    </div>

    {{-- Pending Vendor Applications --}}
    <div class="bg-white overflow-hidden shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900">Pending Vendor Applications</h3>
        <p class="mt-2 text-3xl font-bold text-red-600">{{ $pendingVendors }}</p>
    </div>

    {{-- Placeholder for Another Stat --}}
    <div class="bg-white overflow-hidden shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900">Active Orders</h3>
        <p class="mt-2 text-3xl font-bold text-green-600">45</p> {{-- You can replace with real data --}}
    </div>
</div>

{{-- Pending Vendor Applications Table --}}
<div class="bg-white shadow rounded-lg p-6">
    <h3 class="text-xl font-semibold mb-4">Pending Vendor Applications</h3>

    @if($pendingVendorList->isEmpty())
        <p class="text-gray-600">No pending vendor applications.</p>
    @else
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Financial Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reputation</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Compliance</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied On</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($pendingVendorList as $vendor)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->financial_status }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->reputation_score }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $vendor->regulatory_compliance ? 'Yes' : 'No' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $vendor->created_at->format('Y-m-d') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('admin.vendor.approve', $vendor->id) }}" class="text-green-600 hover:text-green-900">Approve</a>
                        |
                        <a href="{{ route('admin.vendor.reject', $vendor->id) }}" class="text-red-600 hover:text-red-900">Reject</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

</div>
</x-app-layout>
