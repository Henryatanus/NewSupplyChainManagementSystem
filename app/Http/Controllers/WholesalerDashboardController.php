<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\ChatMessage;
use App\Models\Inventory;
use App\Models\SupplyCenter;
use App\Models\User;

class WholesalerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Orders to fulfill by this wholesaler
        $ordersToFulfill = Order::where('fulfilled_by', $user->id)
                               ->with('coffeeBean', 'placedBy')
                               ->latest()
                               ->take(10)
                               ->get();

        // Recent chat messages for wholesaler
        $chatMessages = ChatMessage::where('user_id', $user->id)
                                   ->latest()
                                   ->take(5)
                                   ->get();

        // Inventories at supply centers managed or associated with wholesaler
        // For simplicity, get all inventories; adjust filter if you have relations
        $inventories = Inventory::with('supplyCenter.manager', 'coffeeBean')->get();

        // Supply centers wholesaler manages - assuming a relation or you can query by user id
        $supplyCenters = SupplyCenter::where('manager_id', $user->id)->get();
        $users = User::where('id', '!=', auth()->id())->get();
        return view('dashboard.wholesaler', compact(
            'ordersToFulfill',
            'chatMessages',
            'inventories',
            'supplyCenters',
            'users'
           
        ));
    }
}
