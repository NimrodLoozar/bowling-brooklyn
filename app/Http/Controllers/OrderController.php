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
            'product' => 'required|string|max:255',
            'sub_product' => 'required|string|max:255', // Ensure sub_product is required
            'status' => 'required|string|max:50',
            'totaalbedrag' => 'required|numeric',
            'betaalmethode' => 'nullable|string|max:50',
            'betaalstatus' => 'required|string|max:20',
            'aantal' => 'required|integer',
            'opmerking' => 'nullable|string',
        ]);

        // Automatically set the current date and time for besteldatum
        $validated['besteldatum'] = now();

        // Assign a default user_id (e.g., the currently authenticated user)
        $validated['user_id'] = auth()->id() ?? 1; // Replace 1 with a default user ID if needed

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
            'product' => 'required|string|max:255',
            'sub_product' => 'required|string|max:255', // Ensure sub_product is required
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
