<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CoffeeBean;







class OrderController extends Controller
{
    public function index()
{
    return view('orders.index', [
        'orders' => Order::with(['placedBy', 'fulfilledBy', 'coffeeBean'])->get(),
    ]);
}

public function store(Request $request)
{
    $request->validate([
        'coffee_bean_id' => 'required|exists:coffee_beans,id',
        'quantity_kg' => 'required|numeric',
    ]);

    $coffee = CoffeeBean::findOrFail($request->coffee_bean_id);
    $total = $coffee->price_per_kg * $request->quantity_kg;

    Order::create([
        'placed_by' => auth()->id(),
        'coffee_bean_id' => $coffee->id,
        'quantity_kg' => $request->quantity_kg,
        'price_total' => $total,
        'status' => 'pending',
    ]);

    return redirect()->back()->with('success', 'Order placed.');
}

public function update(Request $request, Order $order)
{
    $order->update([
        'status' => $request->status,
        'fulfilled_by' => auth()->id(),
    ]);

    return redirect()->back()->with('success', 'Order status updated.');
}

public function destroy(Order $order)
{
    $order->delete();

    return redirect()->back()->with('success', 'Order removed.');
}
}
