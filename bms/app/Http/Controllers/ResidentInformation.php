<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class ResidentInformation extends Controller
{
    public function ShowResident()
    {
        $residents = Resident::orderBy('created_at', 'desc')->paginate(5);
        return view('AdminSide.Resident', compact('residents'));
    }
    public function StoreResident(Request $request)
    {

        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'sex' => 'required|string|in:Male,Female,Other',
            'birth_date' => 'required|date',
            'contact_number' => 'required',
            'civil_status' => 'required|string|in:Single,Married,Divorced,Widowed',
            'address' => 'required|string|max:500',
        ]);

        Resident::create([
            'first_name' => $validated['fname'],
            'middle_name' => $validated['mname'],
            'last_name' => $validated['lname'],
            'sex' => $validated['sex'],
            'birth_date' => $validated['birth_date'],
            'contact_number' => $validated['contact_number'],
            'civil_status' => $validated['civil_status'],
            'address' => $validated['address'],
        ]);


        return redirect()->route('ShowRes')->with('success', 'Resident added successfully!');
    }


    public function edit($id)
    {

        $resident = Resident::findOrFail($id);
        return view('Modal.edit-resident', compact('resident'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female,Other',
            'birth_date' => 'required|date',
            'civil_status' => 'required|string|in:Single,Married,Widowed',
            'address' => 'required|string|max:500',
            'status' => 'required|string|in:Active,Inactive',
            'contact_number' => 'required|', // Adjust range as needed
        ]);

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
            'contact_number' => $validated['contact_number'],
        ]);

        return response()->json(['status' => 'success', 'message' => 'Resident updated successfully']);
    }

    public function DestroyResident($id)
    {
        $personnel = Resident::find($id);

        if (!$personnel) {
            return redirect()->back()->with('error', 'Employee not found.');
        }

        $personnel->delete();

        return redirect()->back()->with('success', 'Resident deleted successfully.');
    }
}
