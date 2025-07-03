<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\SupplyCenter;









class SupplyCenterController extends Controller
{
    public function index()
    {
        return view('supply_centers.index', [
            'centers' => SupplyCenter::with('manager')->get(),
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'location' => 'required',
            'manager_id' => 'nullable|exists:users,id',
        ]);
    
        SupplyCenter::create($request->all());
    
        return redirect()->back()->with('success', 'Center created.');
    }
    
    public function update(Request $request, SupplyCenter $supplyCenter)
    {
        $supplyCenter->update($request->all());
    
        return redirect()->back()->with('success', 'Center updated.');
    }
    
    public function destroy(SupplyCenter $supplyCenter)
    {
        $supplyCenter->delete();
    
        return redirect()->back()->with('success', 'Deleted successfully.');
    }
}
