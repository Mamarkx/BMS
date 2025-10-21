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
        $data = GeneralForm::paginate(10); // 10 records per page
        return view('AdminSide.services.generalForm', compact('data'));
    }

    // Example: show Business Permit page
    public function businessPermit()
    {
        $data = BusinessPermit::paginate(10);
        return view('AdminSide.services.businessPermit', compact('data'));
    }

    // Example: show Barangay ID page
    public function barangayID()
    {
        // Use paginate instead of all()
        $data = FormID::paginate(10); // 10 records per page
        return view('AdminSide.services.BrgyID', compact('data'));
    }


    // Example: show Cedula page
    public function cedula()
    {
        $data = Cedula::paginate(10); // 10 records per page
        return view('AdminSide.services.cedula', compact('data'));
    }
}
