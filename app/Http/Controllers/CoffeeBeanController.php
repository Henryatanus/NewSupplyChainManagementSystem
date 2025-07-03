<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CoffeeBean;








class CoffeeBeanController extends Controller
{
    public function index()
{
    return view('coffee_beans.index', [
        'coffeeBeans' => CoffeeBean::all(),
    ]);
}

public function store(Request $request)
{
    $request->validate([
        'type' => 'required|string',
        'form' => 'required|string',
        'quality_grade' => 'required|string',
        'origin' => 'required|string',
        'price_per_kg' => 'required|numeric',
    ]);

    CoffeeBean::create($request->all());

    return redirect()->back()->with('success', 'Coffee bean added.');
}

public function update(Request $request, CoffeeBean $coffeeBean)
{
    $coffeeBean->update($request->all());

    return redirect()->back()->with('success', 'Coffee bean updated.');
}

public function destroy(CoffeeBean $coffeeBean)
{
    $coffeeBean->delete();

    return redirect()->back()->with('success', 'Deleted successfully.');
}
}
