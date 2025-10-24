<?php

namespace App\Http\Controllers;

use App\Models\Cedula;
use App\Models\FormID;
use App\Models\Resident;
use App\Models\GeneralForm;
use Illuminate\Http\Request;
use App\Models\EmployeeModel;
use App\Models\BusinessPermit;

class DashboardController extends Controller
{
    public function ShowDashboard()
    {
        $totalUsers = Resident::count();
        $totalEmpoyees = EmployeeModel::count();

        $pendingBusinessPermit = BusinessPermit::where('status', 'Pending')->count();
        $pendingCedula = Cedula::where('status', 'Pending')->count();
        $pendingFormID = FormID::where('status', 'Pending')->count();
        $pendingGeneralForm = GeneralForm::where('status', 'Pending')->count();

        $doneBusinessPermit = BusinessPermit::where('status', 'Pending')->count();
        $doneCedula = Cedula::where('status', 'Pending')->count();
        $doneFormID = FormID::where('status', 'Pending')->count();
        $doneGeneralForm = GeneralForm::where('status', 'Pending')->count();
        $totalPending =
            $pendingBusinessPermit +
            $pendingCedula +
            $pendingFormID +
            $pendingGeneralForm;

        $totalCertificate =
            $doneBusinessPermit +
            $doneCedula +
            $doneFormID +
            $doneGeneralForm;

        return view('AdminSide.Admin', compact(
            'totalUsers',
            'totalEmpoyees',
            'totalPending',
            'totalCertificate'
        ));
    }
}
