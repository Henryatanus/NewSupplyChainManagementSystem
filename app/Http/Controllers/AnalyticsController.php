<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // or your actual model
use App\Models\Product;
use Carbon\Carbon;
    

class AnalyticsController extends Controller
{
    
    
    public function index()
    {
        $ordersPerDay = Order::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take(7)
            ->get();

        return view('analytics.dashboard', compact('ordersPerDay'));
    }
}
