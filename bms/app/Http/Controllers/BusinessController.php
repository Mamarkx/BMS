<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessPermit;
use App\Mail\BusinessPermitReleased;
use Illuminate\Support\Facades\Mail;

class BusinessController extends Controller
{
    public function showbusinesspermit($id)
    {
        $business = BusinessPermit::find($id);

        if (!$business) {
            return redirect()->back()->with('error', 'Document not found.');
        }

        return view('AdminSide.viewData.business-permit', compact('business'));
    }

    public function UpdateBusinessPermit(Request $request)
    {

        $record = BusinessPermit::where('id', $request->id)->firstOrFail();

        $record->update([
            'name_owner'        => $request->name_owner,
            'name_business'     => $request->name_business,
            'address_business'  => $request->address_business,
            'email'             => $request->email,
            'amount'            => $request->amount,
            'purpose'           => $request->purpose,
        ]);

        return redirect()->back()->with('success', 'Business Record Updated successfully!');
    }
    public function DeleteBusinessPermit($id)
    {
        $record = BusinessPermit::find($id);

        if (!$record) {
            return redirect()->back()->with('error', 'Record not found.');
        }

        $record->delete();

        return redirect()->back()->with('success', 'Deleted successfully!');
    }

    public function approveBusinessPermit(Request $request, $id)
    {
        $document = BusinessPermit::find($id);


        if (!$document) {
            return redirect()->back()->with('error', 'Document not found.');
        }

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
        $document->status = 'To be Release';
        $document->save();

        $greeting = 'Dear ' . $document->name_owner . ',';
        $claim_date = $document->release_date->format('F j, Y');

        // Send an email notification
        Mail::to($document->user->email)->send(new BusinessPermitReleased($document, $greeting, $claim_date));

        // Redirect back with success message
        return redirect()->route('business.permit')->with('success', 'Document release scheduled successfully and email sent!');
    }
}
