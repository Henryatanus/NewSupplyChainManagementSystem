<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\ChatMessage;
use App\Models\CoffeeBean;
use App\Models\Inventory;
use App\Models\User;

class FarmerDashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();

    $recentOrders = Order::where('placed_by', $user->id)
                         ->with('coffeeBean')
                         ->latest()
                         ->take(5)
                         ->get();

    $chatMessages = ChatMessage::where('user_id', $user->id)
                               ->latest()
                               ->take(5)
                               ->get();

    $coffeeBeans = CoffeeBean::all();

    // Assuming farmer has access to supply centers; you can filter by location/assigned centers as needed
    $inventories = Inventory::with('supplyCenter.manager', 'coffeeBean')->get();
    $recentOrders=[];

    $users = User::where('id', '!=', auth()->id())->get();
    

    $userId = Auth::id();

    // Example: orders where current supplier is the one supplying
    $orders = Order::where('supplier_id', $userId)->latest()->get();

    $monthlyOrders = $orders->groupBy(function ($order) {
        return $order->created_at->format('F');
    })->map(function ($group) {
        return count($group);
    });

    $totalRevenue = $orders->sum('total_price');

    return view('dashboard.farmer', 
    compact('recentOrders', 'chatMessages', 'coffeeBeans', 'inventories','users','monthlyOrders', 'totalRevenue'));



}
}
