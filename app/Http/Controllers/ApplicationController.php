<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function ShowAllReq()
    {
        $data = Application::paginate(10);
        return view('AdminSide.Clearance-Certificate', compact('data'));
    }



    public function submitForm(Request $request)
    {
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
<<<<<<< HEAD
            'user_id'  =>   3
=======
            'user_id'       => Auth::user()->id
>>>>>>> 97e5c4327a9502e504f2e962a53b10d5c930df82
        ]));
        return redirect()->route('Services')->with('success', 'Application submitted successfully.');
    }


    public function approve(Request $request, $id)
    {
        $document = Application::find($id);


        if (!$document) {
            return redirect()->back()->with('error', 'Document not found.');
        }

        // Update the status to 'Approved'
        $document->status = 'Approved';
        $document->approval_date = now();
        $document->approved_by = 'barangay Chairman'; // Assuming you're tracking the user who approved it
        $document->save();

        return redirect()->route('ShowReq')->with('success', 'Document approved successfully!');
    }

    public function scheduleRelease(Request $request, $id)
    {
        $request->validate([
            'release_date' => 'required|date|after_or_equal:today', // Ensure release date is valid
        ]);

        // Find the document by ID
        $document = Application::find($id);

        // Ensure the document exists
        if (!$document) {
            return redirect()->back()->with('error', 'Document not found.');
        }

        $document->release_date = $request->input('release_date');
        $document->released_by = 'Chairman';
        $document->status = 'Released';
        $document->save();

        return redirect()->route('ShowReq')->with('success', 'Document release scheduled successfully!');
    }
    public function showApplications()
    {
        // Fetch applications where the user is the applicant (assuming user_id field in applications)
        $id = Auth::user()->id;
        $applications = Application::where('user_id',  $id)->get();

        // Pass applications data to the view
        return view('website.application', compact('applications'));
    }
}
