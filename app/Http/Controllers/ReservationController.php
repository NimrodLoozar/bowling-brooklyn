<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {   
        $reservations = Reservation::with(['user', 'lane'])->get();
        return view('reservations.index');
    }

    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        // Logic to store reservation
        // Validate and save the reservation data
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
