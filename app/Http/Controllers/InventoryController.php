<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Inventory;




class InventoryController extends Controller
{
    public function index()
{
    return view('inventories.index', [
        'inventories' => Inventory::with('supplyCenter', 'coffeeBean')->get(),
    ]);
}

public function store(Request $request)
{
    $request->validate([
        'supply_center_id' => 'required|exists:supply_centers,id',
        'coffee_bean_id' => 'required|exists:coffee_beans,id',
        'quantity_kg' => 'required|numeric',
    ]);

    Inventory::create($request->all());

    return redirect()->back()->with('success', 'Inventory updated.');
}

public function update(Request $request, Inventory $inventory)
{
    $inventory->update($request->all());

    return redirect()->back()->with('success', 'Inventory changed.');
}

public function destroy(Inventory $inventory)
{
    $inventory->delete();

    return redirect()->back()->with('success', 'Removed.');
}
}
