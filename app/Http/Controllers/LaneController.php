<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaneController extends Controller
{
    public function index()
    {
        // Fetch all lanes from the database
        $lanes = \App\Models\Lane::all();

        // Return the lanes to the view
        return view('lanes.index', compact('lanes'));
    }

    public function create()
    {
        // Show the form to create a new lane
        return view('lanes.create');
    }

    public function store(Request $request)
    {
        // Validate and store the new lane
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|string|max:50',
            'comment' => 'nullable|string|max:255',
            'validated' => 'boolean',
        ]);

        \App\Models\Lane::create($validatedData);

        return redirect()->route('lanes.index')->with('success', 'Lane created successfully.');
    }
}
