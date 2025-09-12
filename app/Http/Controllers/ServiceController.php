<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
                'title' => 'Community Tax Certificate (Cedula)',
                'description' => 'Request and pay for your cedula online, required for various legal and official transactions.',
                'icon' => '<i class="fa-solid fa-id-card text-xl"></i>'
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
        $services = [
            'barangay-clearance' => [
                'title' => 'Barangay Clearance',
                'description' => 'A clearance from the Barangay certifying your good standing.',
                'requirements' => [
                    'Valid government-issued ID (e.g., passport, driver\'s license)',
                    'Proof of Residency (e.g., utility bill, lease agreement, or voter\'s ID)'
                ],
                'service_fee' => '100',
                'processing_time' => '3-5 business days',
                'icon' => '<i class="fas fa-check-circle"></i>'
            ],
            'cedula' => [
                'title' => 'Community Tax Certificate (Cedula)',
                'description' => 'The Community Tax Certificate (cedula) is required for various legal and official transactions.',
                'requirements' => [
                    'Valid government-issued ID (e.g., passport, driver\'s license)',
                    'Proof of Residence (e.g., utility bill, lease agreement, or any other document that proves your residency)',
                    'Payment of community tax (if required)'
                ],
                'service_fee' => '50',
                'processing_time' => '1-2 business days',
                'icon' => '<i class="fas fa-id-card"></i>'
            ],
            'certificate-of-residency' => [
                'title' => 'Certificate of Residency',
                'description' => 'A certificate from the Barangay confirming your place of residence.',
                'requirements' => [
                    'Valid government-issued ID (e.g., passport, driver\'s license)',
                    'Proof of Residency (e.g., utility bill, lease contract, or any valid proof of address)',
                ],
                'service_fee' => '100',
                'processing_time' => '2-4 business days',
                'icon' => '<i class="fas fa-home"></i>'
            ],
            'certificate-of-indigency' => [
                'title' => 'Certificate of Indigency',
                'description' => 'A certificate from the Barangay certifying your indigent status.',
                'requirements' => [
                    'Valid government-issued ID (e.g., passport, driver\'s license)',
                    'Proof of Indigency (e.g., government aid certificate, low-income declaration, or certification from a social welfare office)',
                ],
                'service_fee' => '50',
                'processing_time' => '3-5 business days',
                'icon' => '<i class="fas fa-hand-holding-heart"></i>'
            ],
            'business-permit-endorsement' => [
                'title' => 'Business Permit Endorsement',
                'description' => 'Endorsement for obtaining a business permit from the Barangay.',
                'requirements' => [
                    'Business Registration Certificate (e.g., DTI/SEC registration)',
                    'Valid government-issued ID',
                    'Proof of Business Location (e.g., lease contract, title of property, or Barangay Business Permit)',
                ],
                'service_fee' => '200',
                'processing_time' => '5-7 business days',
                'icon' => '<i class="fas fa-clipboard-check"></i>'
            ],
            'barangay-id-scheduling' => [
                'title' => 'Barangay ID Scheduling',
                'description' => 'Apply for your Barangay ID by scheduling an appointment for ID capture and issuance.',
                'requirements' => [
                    'Valid government-issued ID (e.g., passport, driver\'s license)',
                    'Barangay ID Application Form',
                    'Proof of Residency (e.g., utility bill, lease agreement)'
                ],
                'service_fee' => '50',
                'processing_time' => '1-2 business days',
                'icon' => '<i class="fas fa-calendar-alt"></i>'
            ]
        ];

        $service = $services[$service_slug] ?? null;

        if (!$service) {
            abort(404);
        }

        return view('website.Barangay-Services.form', compact('service'));
    }


    // Handle form submission
    public function submitForm(Request $request, $service_slug)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'purpose' => 'required|string|max:255',
        ]);

        return redirect()->route('home')->with('status', 'Your application has been successfully submitted!');
    }
}
