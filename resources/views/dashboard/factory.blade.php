{{-- resources/views/factory/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Factory Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Unique Coffee Types --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
                    <h5 class="text-lg font-semibold">Unique Coffee Types Processed</h5>
                    <p class="text-3xl mt-2">{{ $coffeeBeansProcessed }}</p>
                </div>
            </div>

            {{-- Recent Orders --}}
            <div class="bg-white shadow rounded-lg p-6 mb-8">
                <h3 class="text-xl font-semibold mb-4">Recent Orders to Fulfill</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left">Placed By</th>
                                <th class="px-4 py-2 text-left">Coffee Bean</th>
                                <th class="px-4 py-2 text-left">Quantity (kg)</th>
                                <th class="px-4 py-2 text-left">Total Price</th>
                                <th class="px-4 py-2 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($ordersToFulfill as $order)
                                <tr class="border-t">
                                    <td class="px-4 py-2">{{ $order->placedBy->name }}</td>
                                    <td class="px-4 py-2">{{ $order->coffeeBean->type }}</td>
                                    <td class="px-4 py-2">{{ $order->quantity_kg }}</td>
                                    <td class="px-4 py-2">${{ number_format($order->price_total, 2) }}</td>
                                    <td class="px-4 py-2">{{ ucfirst($order->status) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-2 text-center text-gray-500">No orders to fulfill.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Inventory --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Inventory Managed</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left">Coffee Type</th>
                                <th class="px-4 py-2 text-left">Supply Center</th>
                                <th class="px-4 py-2 text-left">Quantity (kg)</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($inventory as $item)
                                <tr class="border-t">
                                    <td class="px-4 py-2">{{ $item->coffeeBean->type }}</td>
                                    <td class="px-4 py-2">{{ $item->supplyCenter->name }}</td>
                                    <td class="px-4 py-2">{{ $item->quantity_kg }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-2 text-center text-gray-500">No inventory available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
