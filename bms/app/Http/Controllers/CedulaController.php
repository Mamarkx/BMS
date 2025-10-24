<?php

namespace App\Http\Controllers;

use App\Models\Cedula;
use App\Mail\CedulaReleased;
use Illuminate\Http\Request;
use App\Mail\GeneralFormReleased;
use Illuminate\Support\Facades\Mail;

class CedulaController extends Controller
{
    public function CedulaShow($id)
    {
        $cedula = Cedula::findOrFail($id);
        return view('AdminSide.viewData.cedula', compact('cedula'));
    }


    public function UpdateCedula(Request $request)
    {
        $record = Cedula::where('id', $request->id)->firstOrFail();

        $record->update([
            'name'                                => $request->name,
            'tin'                                 => $request->tin,
            'address'                             => $request->address,
            'citezenship'                         => $request->citezenship,
            'civil_status'                        => $request->civil_status,
            'dob'                                 => $request->dob,
            'place_of_birth'                      => $request->place_of_birth,
            'height'                              => $request->height,
            'weight'                              => $request->weight,
            'total_gross_receipt_fr_business'     => $request->total_gross_receipt_fr_business,
            'total_earning_fr_salaries'           => $request->total_earning_fr_salaries,
            'total_income_fr_realproperty'        => $request->total_income_fr_realproperty,
            'amount'                              => $request->amount, // added this field
        ]);

        return redirect()->back()->with('success', 'Cedula Updated successfully!');
    }


    public function DeleteCedula($id)
    {
        $record = Cedula::find($id);

        if (!$record) {
            return redirect()->back()->with('error', 'Record not found.');
        }

        $record->delete();

        return redirect()->back()->with('success', 'Deleted successfully!');
    }














    public function approveCedula(Request $request, $id)
    {
        $document = Cedula::find($id);


        if (!$document) {
            return redirect()->back()->with('error', 'Document not found.');
        }

        // Update the status to 'Approved'
        $document->status = 'Approved';
        $document->approval_date = now();
        $document->approved_by = 'barangay Chairman';
        $document->save();

        return redirect()->route('cedula')->with('success', 'Document approved successfully!');
    }

    public function CedulaRelease(Request $request, $id)
    {
        $request->validate([
            'release_date' => 'required|date|after_or_equal:today', // Ensure release date is valid
        ]);

        // Find the document by ID
        $document = Cedula::find($id);

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
        Mail::to($document->user->email)->send(new CedulaReleased($document, $greeting, $claim_date));

        // Redirect back with success message
        return redirect()->route('cedula')->with('success', 'Document release scheduled successfully and email sent!');
    }
}
