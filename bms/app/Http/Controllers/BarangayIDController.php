<?php

namespace App\Http\Controllers;

use App\Models\FormID;
use Illuminate\Http\Request;
use App\Mail\DocumentReleased;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BarangayIDController extends Controller
{
    public function approveID(Request $request, $id)
    {
        $document = FormID::find($id);


        if (!$document) {
            return redirect()->back()->with('error', 'Document not found.');
        }

        // Update the status to 'Approved'
        $document->status = 'Approved';
        $document->approval_date = now();
        $document->approved_by = 'barangay Chairman';
        $document->save();

        return redirect()->route('barangay.id')->with('success', 'Document approved successfully!');
    }

    public function scheduleReleaseID(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'release_date' => 'required|date|after_or_equal:today', // Ensure release date is valid
        ]);

        // Find the document by ID
        $document = FormID::find($id);

        // Ensure the document exists
        if (!$document) {
            return redirect()->back()->with('error', 'Document not found.');
        }


        $document->release_date = $request->input('release_date');
        $document->released_by = 'Chairman';
        $document->status = 'To be Release';
        $document->save();

        $greeting = 'Dear ' . $document->name . ',';
        $claim_date = $document->release_date->format('F j, Y');

        // Send an email notification
        Mail::to($document->user->email)->send(new DocumentReleased($document, $greeting, $claim_date));

        // Redirect back with success message
        return redirect()->route('barangay.id')->with('success', 'Document release scheduled successfully and email sent!');
    }
    public function show($id)
    {
        $document = FormID::findOrFail($id);
        return view('AdminSide.services.showBrgyID', compact('document'));
    }
}
