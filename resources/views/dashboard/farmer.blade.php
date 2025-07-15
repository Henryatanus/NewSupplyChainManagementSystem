<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Farmer Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            {{-- Available Coffee Beans --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Available Coffee Beans</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-700">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left font-medium">Name</th>
                                <th class="px-4 py-2 text-left font-medium">Type</th>
                                <th class="px-4 py-2 text-left font-medium">Form</th>
                                <th class="px-4 py-2 text-left font-medium">Quality</th>
                                <th class="px-4 py-2 text-left font-medium">Origin</th>
                                <th class="px-4 py-2 text-left font-medium">Price per Kg</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($coffeeBeans as $bean)
                                <tr>
                                    <td class="px-4 py-2">{{ $bean->name }}</td>
                                    <td class="px-4 py-2">{{ $bean->type }}</td>
                                    <td class="px-4 py-2">{{ $bean->form }}</td>
                                    <td class="px-4 py-2">{{ $bean->quality_grade }}</td>
                                    <td class="px-4 py-2">{{ $bean->origin }}</td>
                                    <td class="px-4 py-2">UGX {{ number_format($bean->price_per_kg, 0) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">No coffee beans available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Inventory at Supply Centers --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Inventory at Supply Centers</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-700">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left font-medium">Supply Center</th>
                                <th class="px-4 py-2 text-left font-medium">Manager</th>
                                <th class="px-4 py-2 text-left font-medium">Coffee Bean</th>
                                <th class="px-4 py-2 text-left font-medium">Quantity (kg)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($inventories as $inventory)
                                <tr>
                                    <td class="px-4 py-2">{{ $inventory->supplyCenter->name }}</td>
                                    <td class="px-4 py-2">{{ $inventory->supplyCenter->manager->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-2">{{ $inventory->coffeeBean->name }}</td>
                                    <td class="px-4 py-2">{{ $inventory->quantity_kg }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">No inventory data available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="p-4 border rounded mb-4">
    <h3 class="text-lg font-bold mb-2">Start a Chat</h3>

    @if($users->count())
        <ul class="space-y-2">
            @foreach($users as $user)
                <li class="flex items-center justify-between">
                    <span>{{ $user->name }} ({{ $user->getRoleNames()->first() }})</span>
                    <a href="{{ route('chat', ['receiverId' => $user->id]) }}"
                       class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                        Chat
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p>No users available for chat.</p>
    @endif
</div>
   <div>
   @foreach ($users as $user)
    @if($user->id !== auth()->id()) {{-- Don't show yourself --}}
        <a href="{{ route('chat', ['receiverId' => $user->id]) }}" class="block text-blue-600 hover:underline">
            Chat with {{ $user->name }}
        </a>
    @endif
@endforeach
   </div>
      

    </div>
    
</x-app-layout>

