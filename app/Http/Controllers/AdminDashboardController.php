<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VendorApplication;




class AdminDashboardController extends Controller
{
    public function index()
{
    $totalUsers = User::count();

    $pendingVendors = VendorApplication::where('status', 'pending')->count();

    $pendingVendorList = VendorApplication::where('status', 'pending')->with('user')->get();
    $users = User::where('id', '!=', auth()->id())->get();
   

    return view('dashboard.admin', compact(
        'totalUsers',
        'pendingVendors',
        'pendingVendorList',
        'users'
        
    ));
}

}
