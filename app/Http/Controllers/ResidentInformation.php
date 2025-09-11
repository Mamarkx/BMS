<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class ResidentInformation extends Controller
{
    public function ShowResident()
    {
        $residents = Resident::paginate(10);
        return view('AdminSide.Resident', compact('residents'));
    }
    public function StoreResident(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'sex' => 'required|string|in:Male,Female,Other',
            'birth_date' => 'required|date',
            'civil_status' => 'required|string|in:Single,Married,Divorced,Widowed',
            'address' => 'required|string|max:500',
            'photo_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|string|in:Active,Inactive',
        ]);

        // Handle file upload for profile photo
        $photoPath = null;
        if ($request->hasFile('photo_path')) {
            $photoPath = $request->file('photo_path')->store('public/photos');
        }

        // Store resident data
        Resident::create([
            'first_name' => $validated['fname'],
            'middle_name' => $validated['mname'],
            'last_name' => $validated['lname'],
            'sex' => $validated['sex'],
            'birth_date' => $validated['birth_date'],
            'civil_status' => $validated['civil_status'],
            'address' => $validated['address'],
            'photo_path' => $photoPath,
            'status' => $validated['status'],
        ]);

        // Redirect with success message
        return redirect()->route('ShowRes')->with('success', 'Resident added successfully!');
    }


    public function edit($id)
    {
        // Get the resident by ID
        $resident = Resident::findOrFail($id);
        return view('Modal.edit-resident', compact('resident'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female,Other',
            'birth_date' => 'required|date',
            'civil_status' => 'required|string|in:Single,Married,Widowed',
            'address' => 'required|string|max:500',
            'status' => 'required|string|in:Active,Inactive',
        ]);

        // Find the resident by ID and update their data
        $resident = Resident::findOrFail($id);
        $resident->update([
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'gender' => $validated['gender'],
            'birth_date' => $validated['birth_date'],
            'civil_status' => $validated['civil_status'],
            'address' => $validated['address'],
            'status' => $validated['status'],
        ]);

        return response()->json(['status' => 'success', 'message' => 'Resident updated successfully']);
    }
}
