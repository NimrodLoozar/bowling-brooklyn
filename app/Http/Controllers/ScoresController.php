<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScoresController extends Controller
{
    public function index()
    {
        // Fetch all scores from the database
        $scores = \App\Models\Score::all();

        // Return the scores to the view
        return view('scores.index', compact('scores'));
    }

    public function create()
    {
        // Show the form to create a new score
        return view('scores.create');
    }

    public function store(Request $request)
    {
        // Validate and store the new score
        $validatedData = $request->validate([
            'reservations_id' => 'required|exists:reservations,id',
            'score' => 'required|integer|min:0|max:100',
            'player_name' => 'required|string|max:100',
            'round' => 'nullable|integer|min:1',
            'date' => 'required|date',
            'time' => 'nullable|date_format:H:i',
            'comment' => 'nullable|string|max:255',
            'validated' => 'boolean',
        ]);

        \App\Models\Score::create($validatedData);

        return redirect()->route('scores.index')->with('success', 'Score created successfully.');
    }
}
