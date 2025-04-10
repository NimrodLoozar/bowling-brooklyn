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
                'users.name as reservation_owner_name', // Include reservation owner's name
                DB::raw('IF(reservation_participants.name = users.name, 1, 0) as is_owner') // Flag to indicate if the participant is the owner
            )
            ->get();

        return view('scores.index', compact('reservations'));
    }

    public function create()
    {
        // Logic to show score creation form
        return view('scores.create');
    }

    public function store(Request $request)
    {
        // Logic to store a new score
        // Validate and save the score data
    }

    public function show($id)
    {
        // Logic to display a specific score
        return view('scores.show', compact('id'));
    }

    public function edit($id)
    {
        // Logic to show edit form for a specific score
        return view('scores.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update a specific score
        // Validate and update the score data
    }

    public function destroy($id)
    {
        // Logic to delete a specific score
    }
}
