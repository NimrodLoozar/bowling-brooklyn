<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of contacts.
     */
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new contact.
     */
    public function create()
    {
        $users = User::all(); // Or User::pluck('name', 'id') for a more compact select
        return view('contacts.create', compact('users'));
    }

    /**
     * Store a newly created contact.
     */
    public function store(Request $request)
    {
        // Check for simulated error from checkbox
        if ($request->input('simulate_error')) {
            return back()
                ->withInput()
                ->with('error', 'Could not create contact (simulated server error)');
        }
    
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'mobile' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);
    
        Contact::create($validated);
    
        return redirect()->route('contacts.index')
            ->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified contact.
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified contact.
     */
    public function edit(Contact $contact)
    {
        $users = User::all(); // Add this line
        return view('contacts.edit', compact('contact', 'users')); // Update this line
    }

    /**
     * Update the specified contact.
     */
    public function update(Request $request, Contact $contact)
    {
        // Check for simulated error
        if ($request->has('simulate_error')) {
            return back()
                ->withInput()
                ->with('error', 'Could not update contact (simulated server error)');
        }    
    
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'mobile' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);
    
        $contact->update($validated);
    
        return redirect()->route('contacts.index')
            ->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified contact.
     */
    public function destroy(Contact $contact)
{
    if (request()->has('simulate_error')) {
        return redirect()->route('contacts.index')
            ->with('error', 'Could not delete contact (simulated server error)');
    }

    try {
        $contact->delete();
        return redirect()->route('contacts.index')
            ->with('success', 'Contact deleted successfully.');
    } catch (\Exception $e) {
        // Log the actual error
        \Log::error('Contact deletion failed: ' . $e->getMessage());
        
        // Return user-friendly error message
        return redirect()->route('contacts.index')
            ->with('error', 'This contact could not be deleted. It may be referenced by other records.');
    }
}
}