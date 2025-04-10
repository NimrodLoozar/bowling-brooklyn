<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\Lane;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class ScoresController extends Controller
{
    public function index()
    {
        $reservations = DB::table('scores')
            ->join('reservation_participants', 'scores.participant_id', '=', 'reservation_participants.id')
            ->join('reservations', 'reservation_participants.reservation_id', '=', 'reservations.id')
            ->join('lanes', 'reservations.lane_id', '=', 'lanes.id')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->select(
                'scores.score as participant_score', // Include participant's score
                'reservation_participants.name as participant_name', // Include participant's name
                'reservations.id as reservation_id', // Include reservation ID
                'users.name as user_name', // Alias the user's name
                DB::raw('IF(reservation_participants.name = users.name, 1, 0) as is_owner') // Flag to indicate if the participant is the owner
            )
            ->get();

        return view('scores.index', compact('reservations'));
    }

    public function create()
    {
        $reservations = Reservation::all(); // Fetch all reservations for the dropdown
        return view('scores.create', compact('reservations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'participant_name' => 'required|string|max:255',
            'score' => 'required|integer|min:0',
            'date' => 'required|date', // Validate the date field
        ]);

        try {
            // Add a new participant to the reservation
            $participantId = DB::table('reservation_participants')->insertGetId([
                'reservation_id' => $request->reservation_id,
                'name' => $request->participant_name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Add a score for the new participant
            DB::table('scores')->insert([
                'participant_id' => $participantId,
                'score' => $request->score,
                'date' => $request->date, // Include the date field
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('scores.index')->with('success', __('Participant and score added successfully.'));
        } catch (\Exception $e) {
            return redirect()->route('scores.create')->with('error', __('Failed to add participant and score. Please try again.'));
        }
    }

    public function show($id)
    {
        // Logic to display a specific score
        return view('scores.show', compact('id'));
    }

    public function edit($id)
    {
        $reservation = DB::table('reservations')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->select('reservations.id as reservation_id', 'users.name as user_name')
            ->where('reservations.id', $id)
            ->first();

        if (!$reservation) {
            return redirect()->route('scores.index')->with('error', __('Reservation not found.'));
        }

        $scores = DB::table('scores')
            ->join('reservation_participants', 'scores.participant_id', '=', 'reservation_participants.id')
            ->select(
                'scores.id as score_id',
                'scores.score',
                'scores.date',
                'reservation_participants.id as participant_id',
                'reservation_participants.name as participant_name'
            )
            ->where('reservation_participants.reservation_id', $id)
            ->get();

        $participants = DB::table('reservation_participants')
            ->where('reservation_id', $id)
            ->get();

        return view('scores.edit', compact('reservation', 'scores', 'participants'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'participant_id' => 'required|exists:reservation_participants,id',
            'score' => 'required|integer|min:0',
            'date' => 'required|date',
        ]);

        try {
            DB::table('scores')->where('id', $id)->update([
                'participant_id' => $request->participant_id,
                'score' => $request->score,
                'date' => $request->date,
                'updated_at' => now(),
            ]);

            return redirect()->route('scores.index')->with('success', __('Score updated successfully.'));
        } catch (\Exception $e) {
            return redirect()->route('scores.edit', $id)->with('error', __('Failed to update the score. Please try again.'));
        }
    }

    public function destroy($id)
    {
        try {
            $participants = DB::table('reservation_participants')->where('reservation_id', $id)->get();

            if ($participants->isEmpty()) {
                return redirect()->route('scores.index')->with('error', __('No scores found for this reservation.'));
            }

            foreach ($participants as $participant) {
                Score::where('participant_id', $participant->id)->delete();
            }

            DB::table('reservations')->where('id', $id)->delete(); // Delete the reservation itself

            return redirect()->route('scores.index')->with('success', __('Scores and reservation deleted successfully.'));
        } catch (\Exception $e) {
            return redirect()->route('scores.index')->with('error', __('Failed to delete the scores and reservation. Please confirm and try again.'));
        }
    }
}
