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
            'date' => 'required|date', // Zorg ervoor dat de date wordt gevalideerd
            'start_time' => 'required|date_format:H:i:s', // Zorg ervoor dat start_time het juiste formaat heeft
            'end_time' => 'required|date_format:H:i:s|after:start_time', // Zorg ervoor dat end_time na start_time is
            'number_of_people' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);
    
        // Zoek de gebruiker op basis van de naam of maak de gebruiker aan
        $user = User::firstOrCreate(
            ['name' => $request->user_name],
            ['email' => $request->user_name.'@example.com', 'password' => bcrypt('defaultpassword')] // Voeg een default email en wachtwoord toe
        );
    
        // Maak de reservering aan met de gevalideerde data
        $reservation = new Reservation();
        $reservation->user_id = $user->id; // Gebruik de gevonden gebruiker
        $reservation->lane_id = $validated['lane_id'];
        $reservation->date = $validated['date'];  // Voeg de date toe
        $reservation->start_time = $validated['start_time'];
        $reservation->end_time = $validated['end_time'];
        $reservation->number_of_people = $validated['number_of_people'];
        $reservation->note = $validated['note'] ?? null; // Als er een notitie is, voeg die toe
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
            'user_name' => 'required|string|max:255',
            'lane_id' => 'required|exists:lanes,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',  // Veranderd naar H:i zonder seconden
            'end_time' => 'required|date_format:H:i|after:start_time',  // Veranderd naar H:i zonder seconden
            'number_of_people' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);
        

        $reservation->update($validated);

        return response()->json($reservation);
    }

    /**
     * Remove the specified reservation from storage.
     */
    public function destroy($id)
    {
        try {
            $reservation = Reservation::findOrFail($id);  // Zoek de reservering op basis van ID
            $reservation->delete();  // Verwijder de reservering
            return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Error deleting reservation: ' . $e->getMessage());
            return redirect()->route('reservations.index')->with('error', 'Error deleting reservation.');
        }
    }
    
}
