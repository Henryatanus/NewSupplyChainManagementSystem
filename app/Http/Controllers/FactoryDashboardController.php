<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Inventory;
use App\Models\CoffeeBean;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FactoryDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get orders assigned to this factory
        $ordersToFulfill = Order::with('placedBy', 'coffeeBean')
            ->where('fulfilled_by', $user->id)
            ->latest()
            ->take(5)
            ->get();

        // Inventory managed by this factory (assuming supply center managed by user)
        $inventory = Inventory::with('coffeeBean', 'supplyCenter')
            ->whereHas('supplyCenter', function ($q) use ($user) {
                $q->where('manager_id', $user->id);
            })
            ->get();

        // Count how many unique coffee beans this factory has processed
        $coffeeBeansProcessed = $ordersToFulfill->pluck('coffeeBean')->unique('id')->count();
        
        $users = User::where('id', '!=', auth()->id())->get(); // optionally filter by role
   
        return view('dashboard.factory', compact(
            'ordersToFulfill',
            'inventory',
            'coffeeBeansProcessed',
            'users'
        ));
    }
}