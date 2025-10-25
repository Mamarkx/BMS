<?php

namespace App\Http\Controllers;

use App\Models\Cedula;
use App\Models\FormID;
use App\Models\GeneralForm;
use Illuminate\Http\Request;
use App\Models\BusinessPermit;
use Google\Service\MyBusinessLodging\Business;

class E_Services extends Controller
{

    // Example: show General Form page
    public function generalForm()
    {
        $data = GeneralForm::orderBy('created_at', 'desc')->paginate(5);
        return view('AdminSide.services.generalForm', compact('data'));
    }

    // Show Business Permit page
    public function businessPermit()
    {
        $data = BusinessPermit::orderBy('created_at', 'desc')->paginate(5);
        return view('AdminSide.services.businessPermit', compact('data'));
    }

    // Show Barangay ID page
    public function barangayID()
    {
        $data = FormID::orderBy('created_at', 'desc')->paginate(5);
        return view('AdminSide.services.BrgyID', compact('data'));
    }

    // Show Cedula page
    public function cedula()
    {
        $data = Cedula::orderBy('created_at', 'desc')->paginate(5);
        return view('AdminSide.services.cedula', compact('data'));
    }
}
