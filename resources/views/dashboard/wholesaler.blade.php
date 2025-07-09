<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Wholesaler Dashboard</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Orders to Fulfill --}}
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h3 class="text-xl font-semibold mb-4">Orders To Fulfill</h3>

            @if($ordersToFulfill->isEmpty())
                <p class="text-gray-600">No orders assigned to you currently.</p>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th>Order ID</th>
                            <th>Placed By</th>
                            <th>Coffee Bean</th>
                            <th>Quantity (kg)</th>
                            <th>Status</th>
                            <th>Order Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($ordersToFulfill as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order->placedBy->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order->coffeeBean->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order->quantity_kg }}</td>
                            <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $order->status }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- Supply Centers Managed --}}
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h3 class="text-xl font-semibold mb-4">Your Supply Centers</h3>

            @if($supplyCenters->isEmpty())
                <p class="text-gray-600">You are not managing any supply centers currently.</p>
            @else
                <ul class="list-disc list-inside">
                    @foreach($supplyCenters as $center)
                    <li>{{ $center->name }} ({{ $center->type }}) - Location: {{ $center->location }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Inventory at Supply Centers --}}
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h3 class="text-xl font-semibold mb-4">Inventory at Supply Centers</h3>

            @if($inventories->isEmpty())
                <p class="text-gray-600">No inventory data available.</p>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th>Supply Center</th>
                            <th>Manager</th>
                            <th>Coffee Bean</th>
                            <th>Quantity (kg)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventories as $inventory)
                        <tr>
                            <td>{{ $inventory->supplyCenter->name }}</td>
                            <td>{{ $inventory->supplyCenter->manager->name ?? 'N/A' }}</td>
                            <td>{{ $inventory->coffeeBean->name }}</td>
                            <td>{{ $inventory->quantity_kg }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- Recent Chat Messages --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4">Recent Chat Messages</h3>

            @if($chatMessages->isEmpty())
                <p class="text-gray-600">No recent messages.</p>
            @else
                <ul class="space-y-3 max-h-64 overflow-y-auto">
                    @foreach($chatMessages as $chat)
                        <li class="p-3 border rounded shadow-sm">
                            <p class="text-gray-800">{{ $chat->message }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $chat->created_at->diffForHumans() }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>
</x-app-layout>

