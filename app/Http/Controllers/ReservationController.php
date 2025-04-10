<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Lane;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the reservations.
     */
    public function index()
    {
        try {
            $reservations = Reservation::with(['user', 'lane'])->get();
            return view('reservations.index', compact('reservations'));
        } catch (\Exception $e) {
            \Log::error('Error fetching reservations: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }

    /**
     * Show the form for creating a new reservation.
     */
    public function create()
    {
        $users = User::all();
        $lanes = Lane::all();
        return view('reservations.create', compact('users', 'lanes'));
    }

    /**
     * Store a newly created reservation in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255', // Verander van user_id naar user_name
            'lane_id' => 'required|exists:lanes,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i:s', // Zorg ervoor dat start_time het juiste formaat heeft
            'end_time' => 'required|date_format:H:i:s|after:start_time', // Zorg ervoor dat end_time na start_time is
            'number_of_people' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        // Zoek de gebruiker op basis van de naam
        $user = User::where('name', $request->user_name)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['user_name' => 'User not found.']);
        }

        // Maak de reservering aan
        $reservation = new Reservation($validated);
        $reservation->user_id = $user->id; // Gebruik de gevonden gebruiker
        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
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
            'lane_id' => 'sometimes|exists:lanes,id',
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
