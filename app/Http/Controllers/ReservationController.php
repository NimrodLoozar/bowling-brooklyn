<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        // Fetch all reservations from the database
        $reservations = \App\Models\Reservation::all();

        // Return the reservations to the view
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        // Show the form to create a new reservation
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        // Validate and store the new reservation
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'lane_id' => 'required|exists:lanes,id',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date_format:Y-m-d H:i:s|after:start_time',
            'status' => 'required|string|max:50',
            'comment' => 'nullable|string|max:255',
            'validated' => 'boolean',
        ]);

        \App\Models\Reservation::create($validatedData);

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    }
}
