<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessPermit;
use App\Mail\BusinessPermitReleased;
use Illuminate\Support\Facades\Mail;

class BusinessController extends Controller
{
    public function approveBusinessPermit(Request $request, $id)
    {
        $document = BusinessPermit::find($id);


        if (!$document) {
            return redirect()->back()->with('error', 'Document not found.');
        }

        // Update the status to 'Approved'
        $document->status = 'Approved';
        $document->approval_date = now();
        $document->approved_by = 'barangay Chairman';
        $document->save();

        return redirect()->route('business.permit')->with('success', 'Document approved successfully!');
    }

    public function CedulaBusinessPermit(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'release_date' => 'required|date|after_or_equal:today',
        ]);

        // Find the document by ID
        $document = BusinessPermit::find($id);

        // Ensure the document exists
        if (!$document) {
            return redirect()->back()->with('error', 'Document not found.');
        }


        $document->release_date = $request->input('release_date');
        $document->released_by = 'Chairman';
        $document->status = 'To be Released';
        $document->save();

        $greeting = 'Dear ' . $document->name_owner . ',';
        $claim_date = $document->release_date->format('F j, Y');

        // Send an email notification
        Mail::to($document->user->email)->send(new BusinessPermitReleased($document, $greeting, $claim_date));

        // Redirect back with success message
        return redirect()->route('business.permit')->with('success', 'Document release scheduled successfully and email sent!');
    }
}
