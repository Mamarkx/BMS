<?php

namespace App\Http\Controllers;

use App\Models\FormID;
use Illuminate\Http\Request;
use App\Mail\DocumentReleased;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BarangayIDController extends Controller
{
    public function ShowBarangayID()
    {
        $BrgyIDs = FormID::orderBy('created_at', 'desc')->paginate(5);
        return view('AdminSide.viewData.barangay-id', compact('BrgyIDs'));
    }

    public function UpdateBrgyID(Request $request)
    {

        $record = FormID::where('id', $request->id)->firstOrFail();

        $record->update([
            'name'              => $request->name,
            'address'           => $request->address,
            'dob'               => $request->dob,
            'age'               => $request->age,
            'place_of_birth'    => $request->place_of_birth,
            'civil_status'      => $request->civil_status,
            'email'             => $request->email,
            'religion'          => $request->religion,
            'height'            => $request->height,
            'weight'            => $request->weight,
            'amount'            => $request->amount,
            'gender'            => $request->gender,
            'citezenship'       => $request->citezenship,
            'precint_number'    => $request->precint_number,
            'emergency_name'    => $request->emergency_name,
            'cellphone_number'  => $request->cellphone_number,
            'emergency_address' => $request->emergency_address,
        ]);

        return redirect()->back()->with('success', 'Record updated successfully!');
    }
    public function DeleteBrgyID($id)
    {
        $record = FormID::find($id);

        if (!$record) {
            return redirect()->back()->with('error', 'Record not found.');
        }

        $record->delete();

        return redirect()->back()->with('success', 'Deleted successfully!');
    }
    public function approveID(Request $request, $id)
    {
        $document = FormID::find($id);


        if (!$document) {
            return redirect()->back()->with('error', 'Document not found.');
        }

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
