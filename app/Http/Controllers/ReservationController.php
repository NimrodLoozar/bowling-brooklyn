<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        // Logic to display reservations
        return view('reservations.index');
    }

    public function create()
    {
        // Logic to show reservation form
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'lane_id' => 'required|exists:lanes,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'number_of_people' => 'required|integer|min:2', // Ensure at least 2 participants
            'participants' => 'required|array|min:2', // Ensure at least 2 participants
            'participants.*.name' => 'required|string|max:100',
        ]);

        $reservation = Reservation::create($request->only([
            'user_id', 'lane_id', 'date', 'start_time', 'end_time', 'number_of_people', 'status', 'cost', 'paid', 'note'
        ]));

        // Add the owner as a participant
        $owner = $reservation->participants()->create([
            'name' => $reservation->user->name,
        ]);

        // Add other participants
        foreach ($request->participants as $participant) {
            $reservation->participants()->create(['name' => $participant['name']]);
        }

        // Ensure the owner is set
        $reservation->update(['owner_id' => $owner->id]);

        return response()->json(['message' => 'Reservation created successfully']);
    }

    public function show($id)
    {
        // Logic to display a specific reservation
        return view('reservations.show', compact('id'));
    }

    public function edit($id)
    {
        // Logic to show edit form for a specific reservation
        return view('reservations.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update a specific reservation
        // Validate and update the reservation data
    }

    public function destroy($id)
    {
        // Logic to delete a specific reservation
    }
}
