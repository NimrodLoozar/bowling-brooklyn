<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the reservations.
     */
    public function index()
    {
        $reservations = Reservation::with(['user', 'lane'])->get();
        return response()->json($reservations);
    }

    /**
     * Store a newly created reservation in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'lane_id' => 'required|exists:lane,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
            'number_of_people' => 'required|integer|min:1',
            'status' => 'nullable|string|max:50',
            'cost' => 'nullable|numeric|min:0',
            'paid' => 'boolean',
            'note' => 'nullable|string',
        ]);

        $reservation = Reservation::create($validated);

        return response()->json($reservation, 201);
    }

    /**
     * Display the specified reservation.
     */
    public function show(Reservation $reservation)
    {
        $reservation->load(['user', 'lane']);
        return response()->json($reservation);
    }

    /**
     * Update the specified reservation in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'lane_id' => 'sometimes|exists:lane,id',
            'date' => 'sometimes|date',
            'start_time' => 'sometimes|date_format:H:i:s',
            'end_time' => 'sometimes|date_format:H:i:s|after:start_time',
            'number_of_people' => 'sometimes|integer|min:1',
            'status' => 'nullable|string|max:50',
            'cost' => 'nullable|numeric|min:0',
            'paid' => 'boolean',
            'note' => 'nullable|string',
        ]);

        $reservation->update($validated);

        return response()->json($reservation);
    }

    /**
     * Remove the specified reservation from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return response()->json(['message' => 'Reservation deleted successfully.']);
    }
}
