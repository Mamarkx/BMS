<?php

namespace App\Http\Controllers;

use App\Models\GeneralForm;
use Illuminate\Http\Request;
use App\Mail\GeneralFormReleased;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class GeneralFormController extends Controller
{
    public function approveGeneral(Request $request, $id)
    {
        $document = GeneralForm::find($id);


        if (!$document) {
            return redirect()->back()->with('error', 'Document not found.');
        }

        // Update the status to 'Approved'
        $document->status = 'Approved';
        $document->approval_date = now();
        $document->approved_by = 'barangay Chairman';
        $document->save();

        return redirect()->route('general.form')->with('success', 'Document approved successfully!');
    }

    public function GeneralReleaseID(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'release_date' => 'required|date|after_or_equal:today', // Ensure release date is valid
        ]);

        // Find the document by ID
        $document = GeneralForm::find($id);

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
        Mail::to($document->user->email)->send(new GeneralFormReleased($document, $greeting, $claim_date));

        // Redirect back with success message
        return redirect()->route('general.form')->with('success', 'Document release scheduled successfully and email sent!');
    }
    public function show($id)
    {
        $form = GeneralForm::findOrFail($id);
        return view('AdminSide.viewData.show-General-ID', compact('form'));
    }
}
