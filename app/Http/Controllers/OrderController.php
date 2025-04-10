<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'besteldatum' => 'required|date',
            'status' => 'required|string|max:50',
            'totaalbedrag' => 'required|numeric',
            'betaalmethode' => 'nullable|string|max:50',
            'betaalstatus' => 'required|string|max:20',
            'aantal' => 'required|integer',
            'opmerking' => 'nullable|string',
        ]);

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'besteldatum' => 'required|date',
            'status' => 'required|string|max:50',
            'totaalbedrag' => 'required|numeric',
            'betaalmethode' => 'nullable|string|max:50',
            'betaalstatus' => 'required|string|max:20',
            'aantal' => 'required|integer',
            'opmerking' => 'nullable|string',
        ]);

        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
