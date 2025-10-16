<?php

namespace App\Http\Controllers;

use App\Models\Cedula;
use App\Models\FormID;
use App\Models\GeneralForm;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BusinessPermit;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function ShowServices()
    {
        $services = [
            [
                'title' => 'Barangay Clearance',
                'description' => 'Request a clearance for employment, travel, or other legal needs.',
                'icon' => '<i class="fa-solid fa-file-circle-check text-xl"></i>'
            ],
            [
                'title' => 'Certificate of Residency',
                'description' => 'Obtain a digital copy verifying your residency in the barangay.',
                'icon' => '<i class="fa-solid fa-house-user text-xl"></i>'
            ],
            [
                'title' => 'Certificate of Indigency',
                'description' => 'Request assistance documentation with quick verification.',
                'icon' => '<i class="fa-solid fa-file-waveform text-xl"></i>'
            ],
            [
                'title' => 'Business Permit Endorsement',
                'description' => 'Submit endorsements and track approvals online.',
                'icon' => '<i class="fa-solid fa-id-card-clip text-xl"></i>'
            ],
            [
                'title' => 'Barangay ID',
                'description' => 'Apply for your Barangay ID by scheduling an appointment for ID capture and issuance.',
                'icon' => '<i class="fa-solid fa-calendar-check text-xl"></i>'
            ],
            [
                'title' => 'Cedula',
                'description' => 'Request and pay for your cedula online, required for various legal and official transactions.',
                'icon' => '<i class="fa-solid fa-id-card text-xl"></i>'
            ],
            [
                'title' => 'First Time Job Seeker',
                'description' => 'Apply for your First Time Job Seeker Certificate, required for fresh graduates entering the workforce.',
                'icon' => '<i class="fa-solid fa-briefcase text-xl"></i>'
            ],
        ];

        return view('website.Service', compact('services'));
    }

    public function landingPage()
    {
        return view('website.Home');
    }

    public function showForm($service_slug)
    {
        $titles = [
            'barangay-clearance' => 'Barangay Clearance',
            'certificate-of-indigency' => 'Certificate of Indigency',
            'certificate-of-residency' => 'Certificate of Residency',
            'first-time-job-seeker' => 'First-Time Job Seeker',
            'cedula' => 'Cedula',
            'barangay-id' => 'Barangay ID',
            'business-permit-endorsement' => 'Business Permit Endorsement',
        ];

        $title = $titles[$service_slug] ?? 'Service Not Found';

        switch ($service_slug) {
            case 'barangay-clearance':
            case 'certificate-of-indigency':
            case 'certificate-of-residency':
            case 'first-time-job-seeker':
                return view('website.Barangay-Services.General_form', compact('service_slug', 'title'));

            case 'cedula':
                return view('website.Barangay-Services.cedula', compact('service_slug', 'title'));

            case 'barangay-id':
                return view('website.Barangay-Services.form_id', compact('service_slug', 'title'));

            case 'business-permit-endorsement':
                return view('website.Barangay-Services.business_permit', compact('service_slug', 'title'));

            default:
                abort(404);
        }
    }


    // Handle form submission
    public function submitGeneralForm(Request $request, $service_slug)
    {
        $request->validate([
            'dob' => 'required|date',
            'civil_status' => 'required|string',
            'year_of_residency' => 'required|integer',
            'age' => 'required|integer',
            'place_of_birth' => 'required|string',
            'type' => 'required|string',
            'purpose' => 'required|string',
            'id_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // File upload
        $idProofPath = $request->file('id_proof')->store('documents/id_proofs', 'public');

        // Normalize type (avoid case sensitivity issues)
        $type = strtolower(trim($request->type));

        // Set amount based on type
        switch ($type) {
            case 'certificate of residency':
                $amount = 40;
                break;

            case 'barangay clearance':
                $amount = 50;
                break;

            case 'certificate of indigency':
            case 'first-time job seeker':
                $amount = 0;
                break;

            default:
                $amount = 0;
                break;
        }

        // Save to DB
        $application = GeneralForm::create([
            'user_id' => Auth::id(),
            'reference_number' => Str::random(10),
            'first_name' => Auth::user()->first_name,
            'last_name' => Auth::user()->last_name,
            'middle_name' => Auth::user()->middle_name,
            'suffix' => Auth::user()->suffix,
            'dob' => $request->dob,
            'civil_status' => $request->civil_status,
            'year_of_residency' => $request->year_of_residency,
            'email' => Auth::user()->email,
            'place_of_birth' => $request->place_of_birth,
            'age' => $request->age,
            'address' => Auth::user()->address,
            'amount' => $amount,
            'type' => $request->type, // keep original format (e.g., "Barangay Clearance")
            'purpose' => $request->purpose,
            'status' => 'Pending',
            'issue_date' => now(),
            'id_proof' => $idProofPath,
        ]);

        return redirect()->route('Services')
            ->with('success', 'Application submitted successfully! Reference No: ' . $application->reference_number);
    }
    public function submitFormID(Request $request, $service_slug)
    {
        // ✅ Validate input
        $request->validate([
            'dob' => 'required|date',
            'gender' => 'required|string',
            'civil_status' => 'required|string',
            'age' => 'required|integer',
            'religion' => 'nullable|string',
            'citizenship' => 'nullable|string',
            'height' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'precint_number' => 'nullable|string',
            'emergency_name' => 'required|string',
            'cellphone_number' => 'required|string',
            'emergency_address' => 'required|string',
            'id_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // ✅ Handle file upload
        $idProofPath = $request->file('id_proof')->store('documents/id_proofs', 'public');

        // ✅ Amount handling (Barangay ID is usually free or fixed fee)
        $amount = 0;
        if (strtolower($service_slug) === 'barangay id') {
            $amount = 40; // <-- set fee if needed
        }

        // ✅ Save to DB
        $application = FormID::create([
            'user_id' => Auth::id(),
            'reference_number' => Str::random(10),
            'name' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
            'address' => Auth::user()->address,
            'dob' => $request->dob,
            'age' => $request->age,
            'place_of_birth' => $request->place_of_birth, // from user profile
            'civil_status' => $request->civil_status,
            'email' => Auth::user()->email,
            'type' => $service_slug, // Barangay ID
            'purpose' => 'Barangay ID Application',
            'status' => 'Pending',
            'issue_date' => now(),
            'religion' => $request->religion,
            'height' => $request->height,
            'weight' => $request->weight,
            'amount' => $amount,
            'gender' => $request->gender,
            'citezenship' => $request->citizenship,
            'id_proof' => $idProofPath,
            'precint_number' => $request->precint_number,
            'emergency_name' => $request->emergency_name,
            'cellphone_number' => $request->cellphone_number,
            'emergency_address' => $request->emergency_address,
        ]);

        return redirect()->route('Services')
            ->with('success', 'Barangay ID Application submitted successfully! Reference No: ' . $application->reference_number);
    }

    public function submitCedula(Request $request, $service_slug)
    {
        $request->validate([
            'dob' => 'required|date',
            'civil_status' => 'required|string',
            'citizenship' => 'required|string',
            'place_of_birth' => 'required|string',
            'id_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'e_signature' => 'required',
        ]);

        $idProofPath = $request->file('id_proof')->store('documents/id_proofs', 'public');

        // Handle uploaded file OR base64 string in the same field
        if ($request->hasFile('e_signature')) {
            $signaturePath = $request->file('e_signature')->store('documents/signatures', 'public');
        } elseif (Str::startsWith($request->e_signature, 'data:image')) {
            $image = $request->e_signature;
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'signature_' . time() . '.png';
            Storage::disk('public')->put('documents/signatures/' . $imageName, base64_decode($image));
            $signaturePath = 'documents/signatures/' . $imageName;
        } else {
            return back()->withErrors(['e_signature' => 'Invalid signature format.']);
        }

        $amount = strtolower($service_slug) === 'cedula' ? 50 : 0;

        $application = Cedula::create([
            'user_id' => Auth::id(),
            'reference_number' => Str::random(10),
            'name' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
            'address' => Auth::user()->address,
            'tin' => $request->tin,
            'citezenship' => $request->citizenship,
            'civil_status' => $request->civil_status,
            'dob' => $request->dob,
            'place_of_birth' => $request->place_of_birth,
            'height' => $request->height,
            'weight' => $request->weight,
            'total_gross_receipt_fr_business' => $request->total_gross_receipt_fr_business,
            'total_earning_fr_salaries' => $request->total_earning_fr_salaries,
            'total_income_fr_realproperty' => $request->total_income_fr_realproperty,
            'e-signature' => $signaturePath,
            'email' => Auth::user()->email,
            'type' => $service_slug,
            'purpose' => 'Cedula Application',
            'amount' => $amount,
            'issue_date' => now(),
            'status' => 'Pending',
            'id_proof' => $idProofPath,
        ]);

        return redirect()->route('Services')
            ->with('success', 'Cedula Application submitted successfully! Reference No: ' . $application->reference_number);
    }
    public function submitpermit(Request $request, $service_slug)
    {
        $request->validate([
            'owner_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            'id_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $idProofPath = null;
        if ($request->hasFile('id_proof')) {
            $idProofPath = $request->file('id_proof')->store('id_proofs', 'public');
        }

        $amount = strtolower($service_slug) === 'business permit endorsement' ? 50 : 0;
        BusinessPermit::create([
            'user_id' => Auth::id(),
            'reference_number' => Str::random(10),
            'amount' => $amount,
            'name_owner' => $request->owner_name,
            'name_business' => $request->business_name,
            'address_business' => $request->address,
            'email' => Auth::user()->email,
            'type' => $service_slug,
            'purpose' => 'Business Permit Application',
            'id_proof' => $idProofPath,
            'issue_date' => now(),
            'status' => 'pending',
        ]);

        return redirect()->route('Services')->with('success', 'Business permit submitted successfully!');
    }
}
