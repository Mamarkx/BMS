<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function submitForm(Request $request)
    {
        // Validate the incoming form data
        $validatedData = $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'middle_name'   => 'nullable|string|max:255',
            'suffix'        => 'nullable|string|max:255',
            'dob'           => 'required|date',
            'civil_status'  => 'required|in:Single,Married,Widowed,Divorced',
            'phone'         => 'required|string|max:20',
            'email'         => 'required|email|max:255',
            'address'       => 'required|string|max:255',
            'type'          => 'required|string|max:255',
            'purpose'       => 'required|string|max:255',
            'id_proof'      => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'address_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        $idProofPath = $request->file('id_proof')->store('documents/id_proof', 'public');
        $addressProofPath = $request->file('address_proof')->store('documents/address_proof', 'public');
        Application::create(array_merge($validatedData, [
            'issue_date'    => now(),
            'status'        => 'Pending',
            'id_proof'      => $idProofPath,
            'address_proof' => $addressProofPath,
        ]));
        return redirect()->route('Services')->with('success', 'Application submitted successfully.');
    }
}
