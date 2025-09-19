<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Mail\DocumentReleased;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\BusinessPermit;
use App\Models\Cedula;
use App\Models\FormID;
use App\Models\GeneralForm;

class ApplicationController extends Controller
{

    public function ShowAllReq()
    {
        $businessPermits = BusinessPermit::select(
            'id',
            'name_owner',
            'name_business as request_name',
            'email',
            'status',
            'created_at'
        )->get()->map(function ($item) {
            $item->form_type = 'Business Permit';
            return $item;
        });

        $cedulas = Cedula::select(
            'id',
            'name_owner',
            'purpose as request_name',
            'email',
            'status',
            'created_at'
        )->get()->map(function ($item) {
            $item->form_type = 'Cedula';
            return $item;
        });

        $formIDs = FormID::select(
            'id',
            'name_owner',
            'type as request_name',
            'email',
            'status',
            'created_at'
        )->get()->map(function ($item) {
            $item->form_type = 'Form ID';
            return $item;
        });

        $generalForms = GeneralForm::select(
            'id',
            'name_owner',
            'type as request_name',
            'email',
            'status',
            'created_at'
        )->get()->map(function ($item) {
            $item->form_type = 'General Form';
            return $item;
        });

        $allRequests = $businessPermits->merge($cedulas)->merge($formIDs)->merge($generalForms)
            ->sortByDesc('created_at');

        return view('AdminSide.Clearance-Certificate', compact('allRequests'));
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
        ]);

        $referenceNumber = Str::random(10);
        $idProofPath = $request->file('id_proof')->store('documents/id_proof', 'public');

        Application::create(array_merge($validatedData, [
            'issue_date'    => now(),
            'status'        => 'Pending',
            'id_proof'      => $idProofPath,
            'user_id'       => Auth::user()->id,
            'reference_number' => $referenceNumber,
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
        $document->approved_by = 'barangay Chairman';
        $document->save();

        return redirect()->route('ShowReq')->with('success', 'Document approved successfully!');
    }

    public function scheduleRelease(Request $request, $id)
    {
        // Validate the input
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
        $document->status = 'To be Released';
        $document->save();

        $greeting = 'Dear ' . $document->first_name . ' ' . $document->last_name . ',';
        $claim_date = $document->release_date->format('F j, Y');

        // Send an email notification
        Mail::to($document->user->email)->send(new DocumentReleased($document, $greeting, $claim_date));

        // Redirect back with success message
        return redirect()->route('ShowReq')->with('success', 'Document release scheduled successfully and email sent!');
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
