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
            'product' => 'nullable|string|max:255', // Validate product as a string
            'sub_product' => 'nullable|string|max:255', // Validate sub_product as a string
            'status' => 'required|string|max:50',
            'totaalbedrag' => 'required|numeric',
            'betaalmethode' => 'nullable|string|max:50',
            'betaalstatus' => 'required|string|max:20',
            'aantal' => 'required|integer',
            'opmerking' => 'nullable|string',
        ]);

        $validated['besteldatum'] = now();
        $validated['user_id'] = auth()->id() ?? 1;

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        // Check if the order is already processed
        if (in_array($order->status, ['In behandeling', 'Verzonden'])) {
            return redirect()->route('orders.index')->with('error', 'Bestelling kan niet meer worden aangepast');
        }

        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        // Check if the order is already processed
        if (in_array($order->status, ['In behandeling', 'Verzonden'])) {
            return redirect()->route('orders.index')->with('error', 'Bestelling kan niet meer worden aangepast');
        }

        $validated = $request->validate([
            'product' => 'nullable|string|max:255', // Validate product as a string
            'sub_product' => 'nullable|string|max:255', // Validate sub_product as a string
            'besteldatum' => 'required|date',
            'status' => 'required|string|max:50',
            'totaalbedrag' => 'required|numeric',
            'betaalmethode' => 'nullable|string|max:50',
            'betaalstatus' => 'required|string|max:20',
            'aantal' => 'required|integer',
            'opmerking' => 'nullable|string',
        ]);

        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Bestelling succesvol bijgewerkt');
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
