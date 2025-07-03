<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FactoryDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.factory');
    }
}
